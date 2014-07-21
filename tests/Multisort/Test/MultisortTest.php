<?php

namespace Multisort\Test;

use Multisort\Multisort;

class MultisortTest extends \PHPUnit_Framework_TestCase
{
    private $Multisort;

    protected function setUp()
    {
        $this->Multisort = new Multisort();
    }

    public function testThatDeepsortSortsOneLevelUpperTheLevelWhereSortingKeyWasFound()
    {
        $array = array(
            '2012'  => array(
                'Feb'  => array(
                    'will' => array(
                        'sales' => 300,
                        'commissions' => 90,
                    ),
                    'joe' => array(
                        'sales' => 400,
                        'commissions' => 120,
                    ),
                ),
                'Jan'  => array(
                    'will' => array(
                        'sales' => 200,
                        'commissions' => 60,
                    ),
                    'joe' => array(
                        'sales' => 100,
                        'commissions' => 30,
                    ),
                ),
            ),
            '2013'  => array(
                'Jan'  => array(
                    'will' => array(
                        'sales' => 200,
                        'commissions' => 60,
                    ),
                    'joe' => array(
                        'sales' => 300,
                        'commissions' => 30,
                    ),
                ),
                'Feb'  => array(
                    'joe' => array(
                        'sales' => 800,
                        'commissions' => 420,
                    ),
                    'will' => array(
                        'sales' => 500,
                        'commissions' => 390,
                    ),
                ),
            ),
        );

        $sorted_array = array(
            '2012'  => array(
                'Feb'  => array(
                    'joe' => array(
                        'sales' => 400,
                        'commissions' => 120,
                    ),
                    'will' => array(
                        'sales' => 300,
                        'commissions' => 90,
                    ),
                ),
                'Jan'  => array(
                    'will' => array(
                        'sales' => 200,
                        'commissions' => 60,
                    ),
                    'joe' => array(
                        'sales' => 100,
                        'commissions' => 30,
                    ),
                ),
            ),
            '2013'  => array(
                'Jan'  => array(
                    'joe' => array(
                        'sales' => 300,
                        'commissions' => 30,
                    ),
                    'will' => array(
                        'sales' => 200,
                        'commissions' => 60,
                    ),
                ),
                'Feb'  => array(
                    'joe' => array(
                        'sales' => 800,
                        'commissions' => 420,
                    ),
                    'will' => array(
                        'sales' => 500,
                        'commissions' => 390,
                    ),
                ),
            ),
        );

        $this->Multisort->deepsort($array, 'sales', SORT_DESC);

        $this->assertSame($array, $sorted_array, 'array is sorted one level upper found key by default');
    }

    public function testThatDeepsortCanSortTwoLevelsUpperTheLevelWhereSortingKeyWasFound()
    {
        $array = array(
            '2012'  => array(
                'Feb'  => array(
                    'will' => array(
                        'sales' => 300,
                        'commissions' => 90,
                    ),
                    'joe' => array(
                        'sales' => 400,
                        'commissions' => 120,
                    ),
                ),
                'Jan'  => array(
                    'will' => array(
                        'sales' => 200,
                        'commissions' => 60,
                    ),
                    'joe' => array(
                        'sales' => 100,
                        'commissions' => 30,
                    ),
                ),
            ),
            '2013'  => array(
                'Jan'  => array(
                    'will' => array(
                        'sales' => 200,
                        'commissions' => 60,
                    ),
                    'joe' => array(
                        'sales' => 300,
                        'commissions' => 30,
                    ),
                ),
                'Feb'  => array(
                    'joe' => array(
                        'sales' => 800,
                        'commissions' => 420,
                    ),
                    'will' => array(
                        'sales' => 500,
                        'commissions' => 390,
                    ),
                ),
            ),
        );

        $sorted_array = array(
            '2012'  => array(
                'Feb'  => array(
                    'joe' => array(
                        'sales' => 400,
                        'commissions' => 120,
                    ),
                    'will' => array(
                        'sales' => 300,
                        'commissions' => 90,
                    ),
                ),
                'Jan'  => array(
                    'will' => array(
                        'sales' => 200,
                        'commissions' => 60,
                    ),
                    'joe' => array(
                        'sales' => 100,
                        'commissions' => 30,
                    ),
                ),
            ),
            '2013'  => array(
                'Feb'  => array(
                    'joe' => array(
                        'sales' => 800,
                        'commissions' => 420,
                    ),
                    'will' => array(
                        'sales' => 500,
                        'commissions' => 390,
                    ),
                ),
                'Jan'  => array(
                    'joe' => array(
                        'sales' => 300,
                        'commissions' => 30,
                    ),
                    'will' => array(
                        'sales' => 200,
                        'commissions' => 60,
                    ),
                ),
            ),
        );

        $this->Multisort->deepsort($array, 'sales', SORT_DESC, -2);

        $this->assertSame($array, $sorted_array, 'array is sorted 2 layers above found key if specified so');
    }

    public function testThatMultidimensionalArrayCanBeSortedByKeyWithoutTouchingChildrenArraysOrder()
    {
        $array = array(
            '2013'  => array(
                'feb' => array(
                    'profit'  => 1000,
                ),
                'jul' => array(
                    'profit'  => 3000,
                ),
            ),
            '2014'  => array(
                'jan' => array(
                    'profit'  => 2000,
                ),
                'may' => array(
                    'profit'  => 5000,
                ),
            ),
        );

        $sorted_array = array(
            '2014'  => array(
                'jan' => array(
                    'profit'  => 2000,
                ),
                'may' => array(
                    'profit'  => 5000,
                ),
            ),
            '2013'  => array(
                'feb' => array(
                    'profit'  => 1000,
                ),
                'jul' => array(
                    'profit'  => 3000,
                ),
            ),
        );

        $this->Multisort->sort($array, 'profit', SORT_DESC, false);

        $this->assertSame($array, $sorted_array, "array is sorted in it's root");
    }

    public function testThatMultidimensionalArrayCanBeSortedByKeyIncludingChildrenArrays()
    {
        $array = array(
            '2013'  => array(
                'feb' => array(
                    'profit'  => 1000,
                ),
                'jul' => array(
                    'profit'  => 3000,
                ),
            ),
            '2014'  => array(
                'jan' => array(
                    'profit'  => 2000,
                ),
                'may' => array(
                    'profit'  => 5000,
                ),
            ),
        );

        $sorted_array = array(
            '2014'  => array(
                'may' => array(
                    'profit'  => 5000,
                ),
                'jan' => array(
                    'profit'  => 2000,
                ),
            ),
            '2013'  => array(
                'jul' => array(
                    'profit'  => 3000,
                ),
                'feb' => array(
                    'profit'  => 1000,
                ),
            ),
        );

        $this->Multisort->sort($array, 'profit', SORT_DESC, true);

        $this->assertSame($array, $sorted_array, 'array is sorted all the way down to the level of sorting key');
    }

    public function testThatKeyValueCanBeFetchedFromMultidimensionalArray()
    {
        $array = array(
            '2014'  => array(
                'Jan'   => array(
                    'profit'  => 3000,
                ),
            ),
        );

        $this->assertSame($this->Multisort->getValueOfKeyInMultiDimensionalArray('profit', $array), 3000);
    }

    public function testThatMultipleValuesOfKeyAreReturnedInArray()
    {
        $array = array(
            '2014'  => array(
                'Jan'   => array(
                    'profit'  => 3000,
                ),
                'Feb'   => array(
                    'profit'  => 5000,
                ),
            ),
            '2013'  => array(
                'Jul'   => array(
                    'profit'  => 1000,
                ),
                'Dec'   => array(
                    'profit'  => 1300,
                ),
            ),
        );

        $this->assertSame(
            $this->Multisort->getValueOfKeyInMultiDimensionalArray('profit', $array),
            array(3000, 5000, 1000, 1300)
        );
    }
}
