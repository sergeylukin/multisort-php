<?php
use Codeception\Util\Stub;
use Mockery as m;

class FunctionsTest extends \Codeception\TestCase\Test
{
   /**
    * @var \CodeGuy
    */
    protected $codeGuy;

    protected function _before()
    {
    }

    protected function _after()
    {
      m::close();
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

      Multisort::deepsort($array, 'sales', SORT_DESC);

      assertThat($array === $sorted_array, equalTo(true));
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

      Multisort::deepsort($array, 'sales', SORT_DESC, -2);

      assertThat($array === $sorted_array, equalTo(true));
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

      Multisort::sort($array, 'profit', SORT_DESC, false);

      assertThat($array === $sorted_array, equalTo(true));
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

      Multisort::sort($array, 'profit', SORT_DESC, true);

      assertThat($array === $sorted_array, equalTo(true));
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

      assertThat(Multisort::getValueOfKeyInMultiDimensionalArray('profit', $array), is(3000));
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

      assertThat(Multisort::getValueOfKeyInMultiDimensionalArray('profit', $array), is(array(3000, 5000, 1000, 1300)));
    }
}
