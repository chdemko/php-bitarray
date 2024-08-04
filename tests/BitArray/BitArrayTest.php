<?php

/**
 * chdemko\BitArray\BitArrayTest class
 *
 * @author    Christophe Demko <chdemko@gmail.com>
 * @copyright Copyright (C) 2012-2024 Christophe Demko. All rights reserved.
 *
 * @license BSD 3-Clause License
 *
 * This file is part of the php-bitarray package https://github.com/chdemko/php-bitarray
 */

// Declare chdemko\BitArray namespace
namespace chdemko\BitArray;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

/**
 * BitArray class test
 *
 * @package BitArray
 *
 * @since 1.0.0
 */
class BitArrayTest extends TestCase
{
    /**
     * Tests  BitArray::__clone
     *
     * @return void
     *
     * @since 1.0.0
     */
    #[CoversFunction('chdemko\BitArray\BitArray::__clone')]
    #[CoversFunction('chdemko\BitArray\BitArray::__toString')]
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
     * @return array
     *
     * @since 1.0.0
     */
    public static function casesOffsetExists()
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
     * @param array   $string   Initial values
     * @param integer $offset   Integer offset
     * @param bool    $expected Boolean value expected
     *
     * @return void
     *
     * @since 1.0.0
     */
    #[DataProvider('casesOffsetExists')]
    #[CoversFunction('chdemko\BitArray\BitArray::offsetExists')]
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
     * @return array
     *
     * @since 1.0.0
     */
    public static function casesOffsetGet()
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
     * @param array   $string    Initial values
     * @param integer $offset    Integer offset
     * @param bool    $expected  Boolean value expected
     * @param bool    $exception Throw an exception
     *
     * @return void
     *
     * @since 1.0.0
     */
    #[DataProvider('casesOffsetGet')]
    #[CoversFunction('chdemko\BitArray\BitArray::offsetGet')]
    public function testOffsetGet($string, $offset, $expected, $exception)
    {
        $bits = BitArray::fromString($string);

        if ($exception) {
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
     * @return array
     *
     * @since 1.0.0
     */
    public static function casesOffsetSet()
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
     * @param array   $string    Initial values
     * @param integer $offset    Integer offset
     * @param integer $value     Boolean value
     * @param bool    $expected  Boolean value expected
     * @param bool    $exception Throw an exception
     *
     * @return void
     *
     * @since 1.0.0
     */
    #[DataProvider('casesOffsetSet')]
    #[CoversFunction('chdemko\BitArray\BitArray::offsetSet')]
    public function testOffsetSet($string, $offset, $value, $expected, $exception)
    {
        $bits = BitArray::fromString($string);

        if ($exception) {
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
     * @return void
     *
     * @since 1.0.0
     */
    #[CoversFunction('chdemko\BitArray\BitArray::offsetUnset')]
    public function testOffsetUnset()
    {
        $bits = BitArray::fromString('10');

        $this->expectException('RuntimeException');

        unset($bits[0]);
    }

    /**
     * Tests  BitArray::count
     *
     * @return void
     *
     * @since 1.0.0
     */
    #[CoversFunction('chdemko\BitArray\BitArray::count')]
    #[CoversFunction('chdemko\BitArray\BitArray::__construct')]
    #[CoversFunction('chdemko\BitArray\BitArray::fromInteger')]
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
     * @return void
     *
     * @since 1.0.0
     */
    #[CoversFunction('chdemko\BitArray\BitArray::__get')]
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
     * @return void
     *
     * @since 1.0.0
     */
    #[CoversFunction('chdemko\BitArray\BitArray::jsonSerialize')]
    #[CoversFunction('chdemko\BitArray\BitArray::toArray')]
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
     * @return void
     *
     * @since 1.0.0
     */
    #[CoversFunction('chdemko\BitArray\BitArray::getIterator')]
    #[CoversFunction('chdemko\BitArray\Iterator::__construct')]
    #[CoversFunction('chdemko\BitArray\Iterator::rewind')]
    #[CoversFunction('chdemko\BitArray\Iterator::key')]
    #[CoversFunction('chdemko\BitArray\Iterator::current')]
    #[CoversFunction('chdemko\BitArray\Iterator::next')]
    #[CoversFunction('chdemko\BitArray\Iterator::valid')]
    public function testGetIterator()
    {
        $bits = BitArray::fromString('1001');

        foreach ($bits as $index => $value) {
            $this->assertEquals(
                $bits[$index],
                $value
            );
        }
    }

    /**
     * Tests  BitArray::size
     *
     * @return void
     *
     * @since 1.0.0
     */
    #[CoversFunction('chdemko\BitArray\BitArray::size')]
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
     * @return array
     *
     * @since 1.1.0
     */
    public static function casesDirectCopy()
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
     * @param string  $string    Initial values
     * @param int     $index     Index to copy to
     * @param int     $offset    Offset to copy from
     * @param int     $size      Copy size
     * @param string  $result    Expected result
     * @param boolean $exception Expected OutOfRangeException
     *
     * @return void
     *
     * @since 1.1.0
     */
    #[DataProvider('casesDirectCopy')]
    #[CoversFunction('chdemko\BitArray\BitArray::directCopy')]
    #[CoversFunction('chdemko\BitArray\BitArray::fromString')]
    #[CoversFunction('chdemko\BitArray\BitArray::__construct')]
    #[CoversFunction('chdemko\BitArray\BitArray::__toString')]
    public function testDirectCopy($string, $index, $offset, $size, $result, $exception)
    {
        $bits = BitArray::fromString($string);

        if ($exception) {
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
     * @return array
     *
     * @since 1.1.0
     */
    public static function casesCopy()
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
     * @param string $string Initial values
     * @param int    $index  Index to copy to
     * @param int    $offset Offset to copy from
     * @param int    $size   Copy size
     * @param string $result Expected result
     *
     * @return void
     *
     * @since 1.1.0
     */
    #[DataProvider('casesCopy')]
    #[CoversFunction('chdemko\BitArray\BitArray::copy')]
    #[CoversFunction('chdemko\BitArray\BitArray::getRealOffset')]
    #[CoversFunction('chdemko\BitArray\BitArray::getRealSize')]
    #[CoversFunction('chdemko\BitArray\BitArray::fromString')]
    #[CoversFunction('chdemko\BitArray\BitArray::__construct')]
    #[CoversFunction('chdemko\BitArray\BitArray::__toString')]
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
     * @return void
     *
     * @since 1.0.0
     */
    #[CoversFunction('chdemko\BitArray\BitArray::fromInteger')]
    #[CoversFunction('chdemko\BitArray\BitArray::__construct')]
    #[CoversFunction('chdemko\BitArray\BitArray::__toString')]
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
     * @return void
     *
     * @since 1.2.0
     */
    #[CoversFunction('chdemko\BitArray\BitArray::fromDecimal')]
    #[CoversFunction('chdemko\BitArray\BitArray::__construct')]
    #[CoversFunction('chdemko\BitArray\BitArray::__toString')]
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
     * @return array
     *
     * @since 1.0.0
     */
    public static function casesFromTraversable()
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
     * @param array  $traversable Initial values
     * @param string $expected    Expected string representation
     *
     * @return void
     *
     * @since 1.0.0
     */
    #[DataProvider('casesFromTraversable')]
    #[CoversFunction('chdemko\BitArray\BitArray::fromTraversable')]
    #[CoversFunction('chdemko\BitArray\BitArray::__construct')]
    #[CoversFunction('chdemko\BitArray\BitArray::__toString')]
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
     * @return array
     *
     * @since 1.0.0
     */
    public static function casesFromString()
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
     * @param string $string bits
     *
     * @return void
     *
     * @since 1.0.0
     */
    #[DataProvider('casesFromString')]
    #[CoversFunction('chdemko\BitArray\BitArray::fromString')]
    #[CoversFunction('chdemko\BitArray\BitArray::__construct')]
    #[CoversFunction('chdemko\BitArray\BitArray::__toString')]
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
     * @return void
     *
     * @since 1.1.0
     */
    #[CoversFunction('chdemko\BitArray\BitArray::fromJson')]
    #[CoversFunction('chdemko\BitArray\BitArray::__construct')]
    #[CoversFunction('chdemko\BitArray\BitArray::__toString')]
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
     * @return array
     *
     * @since 1.1.0
     */
    public static function casesFromSlice()
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
     * @param string  $string Initial values
     * @param integer $offset Slice offset
     * @param integer $size   Slice size
     * @param string  $result Expected result
     *
     * @return void
     *
     * @since 1.0.0
     */
    #[DataProvider('casesFromSlice')]
    #[CoversFunction('chdemko\BitArray\BitArray::fromSlice')]
    #[CoversFunction('chdemko\BitArray\BitArray::__construct')]
    #[CoversFunction('chdemko\BitArray\BitArray::__toString')]
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
     * @return void
     *
     * @since 1.1.0
     */
    #[CoversFunction('chdemko\BitArray\BitArray::fromConcat')]
    #[CoversFunction('chdemko\BitArray\BitArray::__construct')]
    #[CoversFunction('chdemko\BitArray\BitArray::__toString')]
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
     * @return void
     *
     * @since 1.0.0
     */
    #[CoversFunction('chdemko\BitArray\BitArray::applyComplement')]
    #[CoversFunction('chdemko\BitArray\BitArray::restrict')]
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
     * @return void
     *
     * @since 1.0.0
     */
    #[CoversFunction('chdemko\BitArray\BitArray::applyOr')]
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
     * @return void
     *
     * @since 1.0.0
     */
    #[CoversFunction('chdemko\BitArray\BitArray::applyAnd')]
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
     * @return void
     *
     * @since 1.0.0
     */
    #[CoversFunction('chdemko\BitArray\BitArray::applyXor')]
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
     * @return void
     *
     * @since 1.2.0
     */
    #[CoversFunction('chdemko\BitArray\BitArray::shift')]
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
