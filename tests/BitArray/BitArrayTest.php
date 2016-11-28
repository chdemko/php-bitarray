<?php

/**
 * chdemko\BitArray\BitArrayTest class
 *
 * @author     Christophe Demko <chdemko@gmail.com>
 * @copyright  Copyright (C) 2012-2016 Christophe Demko. All rights reserved.
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
		return [
			['', 'a', false],
			['', -1, false],
			['', 0, false],
			['10101', 0, true],
			['10101', 4, true],
			['10101', 5, false],
			['10101001', 0, true],
			['10101001', 7, true],
			['10101001', 8, false],
			['10101001', 0, true],
			['10101001', 7, true],
			['10101001', 8, false],
			['101010010', 0, true],
			['101010010', 8, true],
			['101010010', 9, false],
		];
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
		return [
			['', 'a', null, true],
			['', -1, null, true],
			['', 0, null, true],
			['10101', 0, true, false],
			['10101', 4, true, false],
			['10101', 5, null, true],
			['10101001', 0, true, false],
			['10101001', 7, true, false],
			['10101001', 8, null, true],
			['10101001', 0, true, false],
			['10101001', 7, true, false],
			['10101001', 8, null, true],
			['101010010', 0, true, false],
			['101010010', 8, false, false],
			['101010010', 9, null, true],
		];
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
			$this->setExpectedException('OutOfRangeException');
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
		return [
			['', 'a', null, null, true],
			['', -1, null, null, true],
			['', 0, null, null, true],
			['10101', 0, false, false, false],
			['10101', 4, false, false, false],
			['10101', 5, null, null, true],
			['10101001', 0, false, false, false],
			['10101001', 7, false, false, false],
			['10101001', 8, null, null, true],
			['10101001', 0, false, false, false],
			['10101001', 7, false, false, false],
			['10101001', 8, null, null, true],
			['101010010', 0, false, false, false],
			['101010010', 8, true, true, false],
			['101010010', 9, null, null, true],
		];
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
			$this->setExpectedException('OutOfRangeException');
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
		$bits = BitArray::fromString('1001000011001100');

		$this->assertEquals(
			6,
			$bits->count
		);
	}

	/**
	 * Tests  BitArray::__get
	 *
	 * @return  void
	 *
	 * @covers  chdemko\BitArray\BitArray::__get
	 *
	 * @since   1.0.0
	 */
	public function test___get()
	{
		$bits = BitArray::fromString('1001000011001100');

		$this->assertEquals(
			6,
			$bits->count
		);
		$this->assertEquals(
			16,
			$bits->size
		);
		$this->setExpectedException('RuntimeException');
		$unexisting = $bits->unexisting;
	}

	/**
	 * Tests  BitArray::jsonSerialize
	 *
	 * @return  void
	 *
	 * @covers  chdemko\BitArray\BitArray::jsonSerialize
	 * @covers  chdemko\BitArray\BitArray::toArray
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
	 * Tests  BitArray::size
	 *
	 * @return  void
	 *
	 * @covers  chdemko\BitArray\BitArray::size
	 *
	 * @since   1.0.0
	 */
	public function test_size()
	{
		$bits = BitArray::fromString('1001');

		$this->assertEquals(
			4,
			$bits->size()
		);
	}

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
	 * Data provider for test_fromTraversable
	 *
	 * @return  array
	 *
	 * @since   1.0.0
	 */
	public function cases_fromTraversable()
	{
		return [
			[[], ''],
			[[true, false, true, false, true], '10101'],
			[[true, false, true, false, true, false, false, true], '10101001'],
			[[true, false, true, false, true, false, false, true, false], '101010010'],
		];
	}

	/**
	 * Tests  BitArray::fromTraversable
	 *
	 * @param   array   $traversable  Initial values
	 * @param   string  $expected     Expected string representation
	 *
	 * @return  void
	 *
	 * @covers  chdemko\BitArray\BitArray::fromTraversable
	 * @covers  chdemko\BitArray\BitArray::__construct
	 * @covers  chdemko\BitArray\BitArray::__toString
	 *
	 * @dataProvider  cases_fromTraversable
	 *
	 * @since   1.0.0
	 */
	public function test_fromTraversable($traversable, $expected)
	{
		$bits = BitArray::fromTraversable($traversable);

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
		return [
			[''],
			['10101'],
			['10101001'],
			['101010010'],
		];
	}

	/**
	 * Tests  BitArray::fromString
	 *
	 * @param   string  $string  bits
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
	 * @since   1.1.0
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
	 * Data provider for test_fromSlice
	 *
	 * @return  array
	 *
	 * @since   1.1.0
	 */
	public function cases_fromSlice()
	{
		return [
			['', 0, null, ''],
			['11010110', 0, null, '11010110'],
			['11010110', 1, null, '1010110'],
			['11010110', 8, null, ''],
			['11010110', 9, null, ''],
			['11010110', -7, null, '1010110'],
			['11010110', -8, null, '11010110'],
			['11010110', -9, null, '11010110'],

			['', 0, 4, ''],
			['11010110', 0, 4, '1101'],
			['11010110', 1, 4, '1010'],
			['11010110', 8, 4, ''],
			['11010110', 9, 4, ''],
			['11010110', -7, 4, '1010'],
			['11010110', -8, 4, '1101'],
			['11010110', -9, 4, '1101'],

			['', 0, 8, ''],
			['11010110', 0, 8, '11010110'],
			['11010110', 1, 8, '1010110'],
			['11010110', 8, 8, ''],
			['11010110', 9, 8, ''],
			['11010110', -7, 8, '1010110'],
			['11010110', -8, 8, '11010110'],
			['11010110', -9, 8, '11010110'],

			['', 0, 9, ''],
			['11010110', 0, 9, '11010110'],
			['11010110', 1, 9, '1010110'],
			['11010110', 8, 9, ''],
			['11010110', 9, 9, ''],
			['11010110', -7, 9, '1010110'],
			['11010110', -8, 9, '11010110'],
			['11010110', -9, 9, '11010110'],

			['', 0, -4, ''],
			['11010110', 0, -4, '1101'],
			['11010110', 1, -4, '101'],
			['11010110', 8, -4, ''],
			['11010110', 9, -4, ''],
			['11010110', -7, -4, '101'],
			['11010110', -8, -4, '1101'],
			['11010110', -9, -4, '1101'],

			['', 0, -8, ''],
			['11010110', 0, -8, ''],
			['11010110', 1, -8, ''],
			['11010110', 8, -8, ''],
			['11010110', 9, -8, ''],
			['11010110', -7, -8, ''],
			['11010110', -8, -8, ''],
			['11010110', -9, -8, ''],

			['', 0, -9, ''],
			['11010110', 0, -9, ''],
			['11010110', 1, -9, ''],
			['11010110', 8, -9, ''],
			['11010110', 9, -9, ''],
			['11010110', -7, -9, ''],
			['11010110', -8, -9, ''],
			['11010110', -9, -9, ''],
		];
	}

	/**
	 * Tests  BitArray::fromSlice
	 *
	 * @param   string   $string  Initial values
	 * @param   integer  $offset  Slice offset
	 * @param   integer  $size    Slice size
	 * @param   string   $result  Expected result
	 *
	 * @return  void
	 *
	 * @covers  chdemko\BitArray\BitArray::fromSlice
	 * @covers  chdemko\BitArray\BitArray::__construct
	 * @covers  chdemko\BitArray\BitArray::__toString
	 *
	 * @dataProvider  cases_fromSlice
	 *
	 * @since   1.0.0
	 */
	public function test_fromSlice($string, $offset, $size, $result)
	{
		$this->assertEquals(
			$result,
			(string) BitArray::fromSlice(BitArray::fromString($string), $offset, $size)
		);
	}

	/**
	 * Tests  BitArray::fromConcat
	 *
	 * @return  void
	 *
	 * @covers  chdemko\BitArray\BitArray::fromConcat
	 * @covers  chdemko\BitArray\BitArray::__construct
	 * @covers  chdemko\BitArray\BitArray::__toString
	 *
	 * @since   1.1.0
	 */
	public function test_fromConcat()
	{
		$bits1 = BitArray::fromString('1001');
		$bits2 = BitArray::fromString('111');

		$this->assertEquals(
			'1001111',
			(string) BitArray::fromConcat($bits1, $bits2)
		);
		$this->assertEquals(
			'1111001',
			(string) BitArray::fromConcat($bits2, $bits1)
		);
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
		$this->assertEquals(
			2,
			count($bits)
		);
		$this->assertEquals(
			5,
			$bits->size
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
