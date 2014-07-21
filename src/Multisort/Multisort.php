<?php

namespace Multisort;

class Multisort
{

    public function deepsort(
        &$array,
        $sort_by_key,
        $direction = SORT_ASC,
        $level_to_sort = -1,
        $sort_deeper_levels = true,
        $current_level = 0,
        &$original_array = array(),
        $path_to_level_that_should_be_sorted = ''
    ) {
        // Initialize current level
        $current_level++;

        // Do the preparation work
        if ($current_level === 1) {
            $level_of_sorting_key_parent = $this->returnLevelOfArrayKey($sort_by_key, $array) - 1;

            if ($level_to_sort < 0) {
                $level_to_sort = $level_of_sorting_key_parent + $level_to_sort;
            }

            $level_to_sort === 0 && $level_to_sort = 1;

            $original_array = & $array;
        }

        if ($current_level !== $level_to_sort + 1) {
            foreach ($array as $key => $value) {
                $new_path = $path_to_level_that_should_be_sorted
                    . (!empty($path_to_level_that_should_be_sorted)?'|:|':'')
                    . $key;

                $this->deepsort(
                    $array[$key],
                    $sort_by_key,
                    $direction,
                    $level_to_sort,
                    $sort_deeper_levels,
                    $current_level,
                    $original_array,
                    $new_path
                );
            }

        } else {

            $loc = & $this->getArrayItemByPath($original_array, $path_to_level_that_should_be_sorted);
            $this->sort($loc, $sort_by_key, $direction, $sort_deeper_levels);

        }

    }

    public function returnLevelOfArrayKey($needle, $array, $level = 1)
    {
        foreach ($array as $key => $value) {
            if ($key === $needle) {
                return $level;
            } else {
                $level++;
                if (is_array($value)) {
                    return $this->returnLevelOfArrayKey($needle, $value, $level);
                }
            }
        }

        return null;
    }

    public function & getArrayItemByPath(&$array, $path)
    {
        if (empty($path)) {
            return $array;
        }

        $loc = &$array;

        foreach (explode('|:|', $path) as $step) {
            $loc = &$loc[$step];
        }

        return $loc;
    }

    public function getTotalLevelsInArray($array)
    {
        if (is_array(reset($array))) {
            $return = $this->getTotalLevelsInArray(reset($array)) + 1;
        } else {
            $return = 1;
        }

        return $return;
    }

    public function getValueOfKeyInMultiDimensionalArray($needle, $array, $level = 1)
    {
        if (!is_array($array)) {
            return null;
        }

        if (isset($array[$needle])) {
            return $array[$needle];
        }

        $found_values = array();

        $next_level = $level + 1;
        foreach ($array as $key => $value) {

            if (isset($value[$key])) {
                $found_value = $value[$key];
            } else {
                $found_value = $this->getValueOfKeyInMultiDimensionalArray($needle, $value, $next_level);
            }

            if ($found_value !== null) {
                if (is_array($found_value)) {
                    foreach ($found_value as $found_value_node) {
                        array_push($found_values, $found_value_node);
                    }
                } else {
                    array_push($found_values, $found_value);
                }
            }

        }

        if ($level === 1) {

            if (count($found_values) > 1) {
                return $found_values;
            } elseif (count($found_values) === 1) {
                return $found_values[0];
            }

        } elseif (!empty($found_values)) {
            return $found_values;
        }

        return null;
    }

    public function sort(&$array, $sort_key, $direction = SORT_ASC, $deep = true)
    {
        if (!is_array($array)) {
            return null;
        }

        $sorter = array();
        $ret=array();
        reset($array);
        foreach ($array as $key => $subarray) {
            if (is_array($subarray)) {
                if ($deep && $this->getTotalLevelsInArray($subarray) > 1) {
                    $this->sort($array[$key], $sort_key, $direction, $deep);
                }

                $value = $this->getValueOfKeyInMultiDimensionalArray($sort_key, $subarray);

                if (is_array($value)) {
                    $numeric = is_numeric($value[0]);
                    if ($direction === SORT_ASC) {
                        if ($numeric) {
                            sort($value, SORT_NUMERIC);
                        } else {
                            sort($value);
                        }
                    } else {
                        if ($numeric) {
                            rsort($value, SORT_NUMERIC);
                        } else {
                            rsort($value);
                        }
                    }
                    $value = $value[0];
                }

            } else {
                $value = $subarray;
            }
            $sorter[$key] = $value;
        }

        // Detect type of value - numeric/string
        $numeric = is_numeric($value);

        if ($direction === SORT_ASC) {
            if ($numeric) {
                asort($sorter);
            } else {
                ksort($sorter);
            }
        } else {
            if ($numeric) {
                arsort($sorter);
            } else {
                krsort($sorter);
            }
        }
        foreach ($sorter as $key => $value) {
            $ret[$key] = $array[$key];
        }
        $array = $ret;
    }
}
