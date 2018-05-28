<?php

/**
 * chdemko\BitArray\BitArrayTest class
 *
 * @author     Christophe Demko <chdemko@gmail.com>
 * @copyright  Copyright (C) 2012-2018 Christophe Demko. All rights reserved.
 *
 * @license    BSD 3-Clause License
 *
 * This file is part of the php-bitarray package https://github.com/chdemko/php-bitarray
 */

// Declare chdemko\BitArray namespace
namespace chdemko\BitArray;

use PHPUnit\Framework\TestCase;

/**
 * BitArray class test
 *
 * @package  BitArray
 *
 * @since    1.0.0
 */
class BitArrayTest extends TestCase
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
	public function testClone()
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
	 * Data provider for testoffsetExists
	 *
	 * @return  array
	 *
	 * @since   1.0.0
	 */
	public function casesOffsetExists()
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
	 * @dataProvider  casesOffsetExists
	 *
	 * @since   1.0.0
	 */
	public function testOffsetExists($string, $offset, $expected)
	{
		$bits = BitArray::fromString($string);

		$this->assertEquals(
			$expected,
			isset($bits[$offset])
		);
	}

	/**
	 * Data provider for testoffsetGet
	 *
	 * @return  array
	 *
	 * @since   1.0.0
	 */
	public function casesOffsetGet()
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
	 * @dataProvider  casesOffsetGet
	 *
	 * @since   1.0.0
	 */
	public function testOffsetGet($string, $offset, $expected, $exception)
	{
		$bits = BitArray::fromString($string);

		if ($exception)
		{
			$this->expectException('OutOfRangeException');
		}

		$this->assertEquals(
			$expected,
			$bits[$offset]
		);
	}

	/**
	 * Data provider for testoffsetSet
	 *
	 * @return  array
	 *
	 * @since   1.0.0
	 */
	public function casesOffsetSet()
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
	 * @dataProvider  casesOffsetSet
	 *
	 * @since   1.0.0
	 */
	public function testOffsetSet($string, $offset, $value, $expected, $exception)
	{
		$bits = BitArray::fromString($string);

		if ($exception)
		{
			$this->expectException('OutOfRangeException');
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
	public function testOffsetUnset()
	{
		$bits = BitArray::fromString('10');

		$this->expectException('RuntimeException');

		unset($bits[0]);
	}

	/**
	 * Tests  BitArray::count
	 *
	 * @return  void
	 *
	 * @covers  chdemko\BitArray\BitArray::count
	 * @covers  chdemko\BitArray\BitArray::__construct
	 * @covers  chdemko\BitArray\BitArray::fromInteger
	 *
	 * @since   1.0.0
	 */
	public function testCount()
	{
		$bits = BitArray::fromString('1001000011001100');

		$this->assertEquals(
			6,
			$bits->count
		);

		$bits = BitArray::fromInteger(14, true);

		$this->assertEquals(
			14,
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
	public function testGet()
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
		$this->expectException('RuntimeException');
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
	public function testJsonSerialize()
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
	public function testGetIterator()
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
	public function testSize()
	{
		$bits = BitArray::fromString('1001');

		$this->assertEquals(
			4,
			$bits->size()
		);
	}

	/**
	 * Data provider for testdirectCopy
	 *
	 * @return  array
	 *
	 * @since   1.1.0
	 */
	public function casesDirectCopy()
	{
		return array(
			array('11010011', 0, 3, 5, '10011011', false),
			array('11010011', 3, 0, 5, '11011010', false),
			array('11010011', 3, 0, 6, '11011010', true),
			array('11010011', 3, 7, 4, '11011010', true),
		);
	}

	/**
	 * Tests  BitArray::directCopy
	 *
	 * @param   string   $string     Initial values
	 * @param   int      $index      Index to copy to
	 * @param   int      $offset     Offset to copy from
	 * @param   int      $size       Copy size
	 * @param   string   $result     Expected result
	 * @param   boolean  $exception  Expected OutOfRangeException
	 *
	 * @return  void
	 *
	 * @covers  chdemko\BitArray\BitArray::directCopy
	 * @covers  chdemko\BitArray\BitArray::fromString
	 * @covers  chdemko\BitArray\BitArray::__construct
	 * @covers  chdemko\BitArray\BitArray::__toString
	 *
	 * @dataProvider  casesDirectCopy
	 *
	 * @since   1.1.0
	 */
	public function testDirectCopy($string, $index, $offset, $size, $result, $exception)
	{
		$bits = BitArray::fromString($string);

		if ($exception)
		{
			$this->expectException('OutOfRangeException');
		}

		$bits->directCopy($bits, $index, $offset, $size);

		$this->assertEquals(
			$result,
			(string) $bits
		);
	}

	/**
	 * Data provider for testCopy
	 *
	 * @return  array
	 *
	 * @since   1.1.0
	 */
	public function casesCopy()
	{
		return array(
			array('11010011', 0, 3, 5, '10011011'),
			array('11010011', 3, 0, 5, '11011010'),
			array('11010011', 3, 0, 6, '11011010'),
			array('11010011', 2, 7, 4, '11110011'),
			array('11010011', 2, -4, 4, '11001111'),
			array('11010011', 9, -4, 4, '11010011'),
			array('11010011', 2, -9, 4, '11110111'),
			array('11010011', 0, 3, null, '10011011'),
			array('11010011', 0, 3, -3, '10010011'),
			array('11010011', 0, 3, -9, '11010011'),
		);
	}

	/**
	 * Tests  BitArray::Copy
	 *
	 * @param   string  $string  Initial values
	 * @param   int     $index   Index to copy to
	 * @param   int     $offset  Offset to copy from
	 * @param   int     $size    Copy size
	 * @param   string  $result  Expected result
	 *
	 * @return  void
	 *
	 * @covers  chdemko\BitArray\BitArray::copy
	 * @covers  chdemko\BitArray\BitArray::getRealOffset
	 * @covers  chdemko\BitArray\BitArray::getRealSize
	 * @covers  chdemko\BitArray\BitArray::fromString
	 * @covers  chdemko\BitArray\BitArray::__construct
	 * @covers  chdemko\BitArray\BitArray::__toString
	 *
	 * @dataProvider  casesCopy
	 *
	 * @since   1.1.0
	 */
	public function testCopy($string, $index, $offset, $size, $result)
	{
		$bits = BitArray::fromString($string);

		$bits->copy($bits, $index, $offset, $size);

		$this->assertEquals(
			$result,
			(string) $bits
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
	public function testFromInteger()
	{
		$bits = BitArray::fromInteger(10);

		$this->assertEquals(
			'0000000000',
			(string) $bits
		);
	}

	/**
	 * Tests  BitArray::fromDecimal
	 *
	 * @return  void
	 *
	 * @covers  chdemko\BitArray\BitArray::fromDecimal
	 * @covers  chdemko\BitArray\BitArray::__construct
	 * @covers  chdemko\BitArray\BitArray::__toString
	 *
	 * @since   1.2.0
	 */
	public function testFromDecimal()
	{
		$bits = BitArray::fromDecimal(10, 255);

		$this->assertEquals(
			'0011111111',
			(string) $bits
		);
	}

	/**
	 * Data provider for testfromTraversable
	 *
	 * @return  array
	 *
	 * @since   1.0.0
	 */
	public function casesFromTraversable()
	{
		return array(
			array(array(), ''),
			array(array(true, false, true, false, true), '10101'),
			array(array(true, false, true, false, true, false, false, true), '10101001'),
			array(array(true, false, true, false, true, false, false, true, false), '101010010'),
		);
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
	 * @dataProvider  casesFromTraversable
	 *
	 * @since   1.0.0
	 */
	public function testFromTraversable($traversable, $expected)
	{
		$bits = BitArray::fromTraversable($traversable);

		$this->assertEquals(
			$expected,
			(string) $bits
		);
	}

	/**
	 * Data provider for testfromString
	 *
	 * @return  array
	 *
	 * @since   1.0.0
	 */
	public function casesFromString()
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
	 * @param   string  $string  bits
	 *
	 * @return  void
	 *
	 * @covers  chdemko\BitArray\BitArray::fromString
	 * @covers  chdemko\BitArray\BitArray::__construct
	 * @covers  chdemko\BitArray\BitArray::__toString
	 *
	 * @dataProvider  casesFromString
	 *
	 * @since   1.0.0
	 */
	public function testFromString($string)
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
	public function testFromJson()
	{
		$bits = BitArray::fromJson('[true,false,false,true]');

		$this->assertEquals(
			'1001',
			(string) $bits
		);
	}

	/**
	 * Data provider for testfromSlice
	 *
	 * @return  array
	 *
	 * @since   1.1.0
	 */
	public function casesFromSlice()
	{
		return array(
			array('', 0, null, ''),
			array('11010110', 0, null, '11010110'),
			array('11010110', 1, null, '1010110'),
			array('11010110', 8, null, ''),
			array('11010110', 9, null, ''),
			array('11010110', -7, null, '1010110'),
			array('11010110', -8, null, '11010110'),
			array('11010110', -9, null, '11010110'),

			array('', 0, 4, ''),
			array('11010110', 0, 4, '1101'),
			array('11010110', 1, 4, '1010'),
			array('11010110', 8, 4, ''),
			array('11010110', 9, 4, ''),
			array('11010110', -7, 4, '1010'),
			array('11010110', -8, 4, '1101'),
			array('11010110', -9, 4, '1101'),

			array('', 0, 8, ''),
			array('11010110', 0, 8, '11010110'),
			array('11010110', 1, 8, '1010110'),
			array('11010110', 8, 8, ''),
			array('11010110', 9, 8, ''),
			array('11010110', -7, 8, '1010110'),
			array('11010110', -8, 8, '11010110'),
			array('11010110', -9, 8, '11010110'),

			array('', 0, 9, ''),
			array('11010110', 0, 9, '11010110'),
			array('11010110', 1, 9, '1010110'),
			array('11010110', 8, 9, ''),
			array('11010110', 9, 9, ''),
			array('11010110', -7, 9, '1010110'),
			array('11010110', -8, 9, '11010110'),
			array('11010110', -9, 9, '11010110'),

			array('', 0, -4, ''),
			array('11010110', 0, -4, '1101'),
			array('11010110', 1, -4, '101'),
			array('11010110', 8, -4, ''),
			array('11010110', 9, -4, ''),
			array('11010110', -7, -4, '101'),
			array('11010110', -8, -4, '1101'),
			array('11010110', -9, -4, '1101'),

			array('', 0, -8, ''),
			array('11010110', 0, -8, ''),
			array('11010110', 1, -8, ''),
			array('11010110', 8, -8, ''),
			array('11010110', 9, -8, ''),
			array('11010110', -7, -8, ''),
			array('11010110', -8, -8, ''),
			array('11010110', -9, -8, ''),

			array('', 0, -9, ''),
			array('11010110', 0, -9, ''),
			array('11010110', 1, -9, ''),
			array('11010110', 8, -9, ''),
			array('11010110', 9, -9, ''),
			array('11010110', -7, -9, ''),
			array('11010110', -8, -9, ''),
			array('11010110', -9, -9, ''),
		);
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
	 * @dataProvider  casesFromSlice
	 *
	 * @since   1.0.0
	 */
	public function testFromSlice($string, $offset, $size, $result)
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
	public function testFromConcat()
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
	 * @covers  chdemko\BitArray\BitArray::restrict
	 *
	 * @since   1.0.0
	 */
	public function testApplyComplement()
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
	public function testApplyOr()
	{
		$bits = BitArray::fromString('10011');

		$this->assertEquals(
			'11011',
			(string) $bits->applyOr(BitArray::fromString('01011'))
		);

		$this->expectException('InvalidArgumentException');

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
	public function testApplyAnd()
	{
		$bits = BitArray::fromString('10011');

		$this->assertEquals(
			'00011',
			(string) $bits->applyAnd(BitArray::fromString('01011'))
		);

		$this->expectException('InvalidArgumentException');

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
	public function testApplyXor()
	{
		$bits = BitArray::fromString('10011');

		$this->assertEquals(
			'11000',
			(string) $bits->applyXor(BitArray::fromString('01011'))
		);

		$this->expectException('InvalidArgumentException');

		$bits->applyXor(BitArray::fromString('010111'));
	}

	/**
	 * Tests  BitArray::shift
	 *
	 * @return  void
	 *
	 * @covers  chdemko\BitArray\BitArray::shift
	 *
	 * @since   1.2.0
	 */
	public function testShift()
	{
		$bits = BitArray::fromString('10111');

		$this->assertEquals(
			'00101',
			(string) $bits->shift(2)
		);

		$bits = BitArray::fromString('10111');

		$this->assertEquals(
			'01111',
			(string) $bits->shift(-1, true)
		);
	}
}
