<?php

/**
 * chdemko\BitArray\BitArrayTest class
 *
 * @author     Christophe Demko <chdemko@gmail.com>
 * @copyright  Copyright (C) 2012-2014 Christophe Demko. All rights reserved.
 *
 * @license    http://www.cecill.info/licences/Licence_CeCILL-B_V1-en.html The CeCILL B license
 *
 * This file is part of the php-bitarray package https://github.com/chdemko/php-bitarray
 */

// Declare chdemko\BitArray namespace
namespace chdemko\BitArray;

/**
 * BitArray class test
 *
 * @package  BitArray
 *
 * @since    1.0.0
 */
class BitArrayTest extends \PHPUnit_Framework_TestCase
{
	/**
	 * Tests  BitArray::fromInteger
	 *
	 * @return  void
	 *
	 * @covers  chdemko\BitArray\BitArray::fromInteger
	 * @covers  chdemko\BitArray\BitArray::__construct
	 * @covers  chdemko\BitArray\BitArray::__toString
	 *
	 * @since   1.0.0
	 */
	public function test_fromInteger()
	{
		$bits = BitArray::fromInteger(10);

		$this->assertEquals(
			'0000000000',
			(string) $bits
		);
	}

	/**
	 * Data provider for test_fromIterable
	 *
	 * @return  array
	 *
	 * @since   1.0.0
	 */
	public function cases_fromIterable()
	{
		return array(
			array([], ''),
			array([true, false, true, false, true], '10101'),
			array([true, false, true, false, true, false, false, true], '10101001'),
			array([true, false, true, false, true, false, false, true, false], '101010010'),
		);
	}

	/**
	 * Tests  BitArray::fromIterable
	 *
	 * @param   array   $iterable  Initial values
	 * @param   string  $expected  Expected string representation
	 *
	 * @return  void
	 *
	 * @covers  chdemko\BitArray\BitArray::fromIterable
	 * @covers  chdemko\BitArray\BitArray::__construct
	 * @covers  chdemko\BitArray\BitArray::__toString
	 *
	 * @dataProvider  cases_fromIterable
	 *
	 * @since   1.0.0
	 */
	public function test_fromIterable($iterable, $expected)
	{
		$bits = BitArray::fromIterable($iterable);

		$this->assertEquals(
			$expected,
			(string) $bits
		);
	}

	/**
	 * Data provider for test_fromString
	 *
	 * @return  array
	 *
	 * @since   1.0.0
	 */
	public function cases_fromString()
	{
		return array(
			array(''),
			array('10101'),
			array('10101001'),
			array('101010010'),
		);
	}

	/**
	 * Tests  BitArray::fromString
	 *
	 * @param   array  $string  Initial values
	 *
	 * @return  void
	 *
	 * @covers  chdemko\BitArray\BitArray::fromString
	 * @covers  chdemko\BitArray\BitArray::__construct
	 * @covers  chdemko\BitArray\BitArray::__toString
	 *
	 * @dataProvider  cases_fromString
	 *
	 * @since   1.0.0
	 */
	public function test_fromString($string)
	{
		$bits = BitArray::fromString($string);

		$this->assertEquals(
			$string,
			(string) $bits
		);
	}

	/**
	 * Tests  BitArray::fromJson
	 *
	 * @return  void
	 *
	 * @covers  chdemko\BitArray\BitArray::fromJson
	 * @covers  chdemko\BitArray\BitArray::__construct
	 * @covers  chdemko\BitArray\BitArray::__toString
	 *
	 * @since   1.0.0
	 */
	public function test_fromJson()
	{
		$bits = BitArray::fromJson('[true,false,false,true]');

		$this->assertEquals(
			'1001',
			(string) $bits
		);
	}

	/**
	 * Tests  BitArray::__clone
	 *
	 * @return  void
	 *
	 * @covers  chdemko\BitArray\BitArray::__clone
	 * @covers  chdemko\BitArray\BitArray::__toString
	 *
	 * @since   1.0.0
	 */
	public function test___clone()
	{
		$bits = BitArray::fromString('1001');
		$clone = clone $bits;

		$this->assertEquals(
			'1001',
			(string) $clone
		);

		$bits[0] = false;

		$this->assertEquals(
			'1001',
			(string) $clone
		);
	}

	/**
	 * Data provider for test_offsetExists
	 *
	 * @return  array
	 *
	 * @since   1.0.0
	 */
	public function cases_offsetExists()
	{
		return array(
			array('', 'a', false),
			array('', -1, false),
			array('', 0, false),
			array('10101', 0, true),
			array('10101', 4, true),
			array('10101', 5, false),
			array('10101001', 0, true),
			array('10101001', 7, true),
			array('10101001', 8, false),
			array('10101001', 0, true),
			array('10101001', 7, true),
			array('10101001', 8, false),
			array('101010010', 0, true),
			array('101010010', 8, true),
			array('101010010', 9, false),
		);
	}

	/**
	 * Tests  BitArray::offsetExists
	 *
	 * @param   array    $string    Initial values
	 * @param   integer  $offset    Integer offset
	 * @param   bool     $expected  Boolean value expected
	 *
	 * @return  void
	 *
	 * @covers  chdemko\BitArray\BitArray::offsetExists
	 *
	 * @dataProvider  cases_offsetExists
	 *
	 * @since   1.0.0
	 */
	public function test_offsetExists($string, $offset, $expected)
	{
		$bits = BitArray::fromString($string);

		$this->assertEquals(
			$expected,
			isset($bits[$offset])
		);
	}

	/**
	 * Data provider for test_offsetGet
	 *
	 * @return  array
	 *
	 * @since   1.0.0
	 */
	public function cases_offsetGet()
	{
		return array(
			array('', 'a', null, true),
			array('', -1, null, true),
			array('', 0, null, true),
			array('10101', 0, true, false),
			array('10101', 4, true, false),
			array('10101', 5, null, true),
			array('10101001', 0, true, false),
			array('10101001', 7, true, false),
			array('10101001', 8, null, true),
			array('10101001', 0, true, false),
			array('10101001', 7, true, false),
			array('10101001', 8, null, true),
			array('101010010', 0, true, false),
			array('101010010', 8, false, false),
			array('101010010', 9, null, true),
		);
	}

	/**
	 * Tests  BitArray::offsetGet
	 *
	 * @param   array    $string     Initial values
	 * @param   integer  $offset     Integer offset
	 * @param   bool     $expected   Boolean value expected
	 * @param   bool     $exception  Throw an exception
	 *
	 * @return  void
	 *
	 * @covers  chdemko\BitArray\BitArray::offsetGet
	 *
	 * @dataProvider  cases_offsetGet
	 *
	 * @since   1.0.0
	 */
	public function test_offsetGet($string, $offset, $expected, $exception)
	{
		$bits = BitArray::fromString($string);

		if ($exception)
		{
			$this->setExpectedException('InvalidArgumentException');
		}

		$this->assertEquals(
			$expected,
			$bits[$offset]
		);
	}

	/**
	 * Data provider for test_offsetSet
	 *
	 * @return  array
	 *
	 * @since   1.0.0
	 */
	public function cases_offsetSet()
	{
		return array(
			array('', 'a', null, null, true),
			array('', -1, null, null, true),
			array('', 0, null, null, true),
			array('10101', 0, false, false, false),
			array('10101', 4, false, false, false),
			array('10101', 5, null, null, true),
			array('10101001', 0, false, false, false),
			array('10101001', 7, false, false, false),
			array('10101001', 8, null, null, true),
			array('10101001', 0, false, false, false),
			array('10101001', 7, false, false, false),
			array('10101001', 8, null, null, true),
			array('101010010', 0, false, false, false),
			array('101010010', 8, true, true, false),
			array('101010010', 9, null, null, true),
		);
	}

	/**
	 * Tests  BitArray::offsetSet
	 *
	 * @param   array    $string     Initial values
	 * @param   integer  $offset     Integer offset
	 * @param   integer  $value      Boolean value
	 * @param   bool     $expected   Boolean value expected
	 * @param   bool     $exception  Throw an exception
	 *
	 * @return  void
	 *
	 * @covers  chdemko\BitArray\BitArray::offsetSet
	 *
	 * @dataProvider  cases_offsetSet
	 *
	 * @since   1.0.0
	 */
	public function test_offsetSet($string, $offset, $value, $expected, $exception)
	{
		$bits = BitArray::fromString($string);

		if ($exception)
		{
			$this->setExpectedException('InvalidArgumentException');
		}

		$bits[$offset] = $value;
		$this->assertEquals(
			$expected,
			$bits[$offset]
		);
	}

	/**
	 * Tests  BitArray::offsetUnset
	 *
	 * @return  void
	 *
	 * @covers  chdemko\BitArray\BitArray::offsetUnset
	 *
	 * @since   1.0.0
	 */
	public function test_offsetUnset()
	{
		$bits = BitArray::fromString('10');

		$this->setExpectedException('RuntimeException');

		unset($bits[0]);
	}

	/**
	 * Tests  BitArray::count
	 *
	 * @return  void
	 *
	 * @covers  chdemko\BitArray\BitArray::count
	 *
	 * @since   1.0.0
	 */
	public function test_count()
	{
		$bits = BitArray::fromString('1001');

		$this->assertEquals(
			4,
			count($bits)
		);
	}

	/**
	 * Tests  BitArray::jsonSerialize
	 *
	 * @return  void
	 *
	 * @covers  chdemko\BitArray\BitArray::jsonSerialize
	 *
	 * @since   1.0.0
	 */
	public function test_jsonSerialize()
	{
		$bits = BitArray::fromString('1001');

		$this->assertEquals(
			'[true,false,false,true]',
			json_encode($bits)
		);
	}

	/**
	 * Tests  BitArray::getIterator
	 *
	 * @return  void
	 *
	 * @covers  chdemko\BitArray\BitArray::getIterator
	 * @covers  chdemko\BitArray\Iterator::__construct
	 * @covers  chdemko\BitArray\Iterator::rewind
	 * @covers  chdemko\BitArray\Iterator::key
	 * @covers  chdemko\BitArray\Iterator::current
	 * @covers  chdemko\BitArray\Iterator::next
	 * @covers  chdemko\BitArray\Iterator::valid
	 *
	 * @since   1.0.0
	 */
	public function test_getIterator()
	{
		$bits = BitArray::fromString('1001');

		foreach ($bits as $index => $value)
		{
			$this->assertEquals(
				$bits[$index],
				$value
			);
		}
	}

	/**
	 * Tests  BitArray::applyComplement
	 *
	 * @return  void
	 *
	 * @covers  chdemko\BitArray\BitArray::applyComplement
	 *
	 * @since   1.0.0
	 */
	public function test_applyComplement()
	{
		$bits = BitArray::fromString('10011');

		$this->assertEquals(
			'01100',
			(string) $bits->applyComplement()
		);
	}

	/**
	 * Tests  BitArray::applyOr
	 *
	 * @return  void
	 *
	 * @covers  chdemko\BitArray\BitArray::applyOr
	 *
	 * @since   1.0.0
	 */
	public function test_applyOr()
	{
		$bits = BitArray::fromString('10011');

		$this->assertEquals(
			'11011',
			(string) $bits->applyOr(BitArray::fromString('01011'))
		);

		$this->setExpectedException('InvalidArgumentException');

		$bits->applyOr(BitArray::fromString('010111'));
	}

	/**
	 * Tests  BitArray::applyAnd
	 *
	 * @return  void
	 *
	 * @covers  chdemko\BitArray\BitArray::applyAnd
	 *
	 * @since   1.0.0
	 */
	public function test_applyAnd()
	{
		$bits = BitArray::fromString('10011');

		$this->assertEquals(
			'00011',
			(string) $bits->applyAnd(BitArray::fromString('01011'))
		);

		$this->setExpectedException('InvalidArgumentException');

		$bits->applyAnd(BitArray::fromString('010111'));
	}

	/**
	 * Tests  BitArray::applyXor
	 *
	 * @return  void
	 *
	 * @covers  chdemko\BitArray\BitArray::applyXor
	 *
	 * @since   1.0.0
	 */
	public function test_applyXor()
	{
		$bits = BitArray::fromString('10011');

		$this->assertEquals(
			'11000',
			(string) $bits->applyXor(BitArray::fromString('01011'))
		);

		$this->setExpectedException('InvalidArgumentException');

		$bits->applyXor(BitArray::fromString('010111'));
	}
}
