<?php

/**
 * chdemko\BitArray\Iterator class
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

/**
 * Iterator
 *
 * @package BitArray
 *
 * @since 1.0.0
 */
class Iterator implements \Iterator
{
    /**
     * @var integer  Index
     *
     * @since 1.0.0
     */
    private $index;

    /**
     * @var BitArray  bits
     *
     * @since 1.0.0
     */
    private $bits;

    /**
     * Constructor
     *
     * @param BitArray $bits BitArray
     *
     * @since 1.0.0
     */
    public function __construct(BitArray $bits)
    {
        $this->bits = $bits;
        $this->rewind();
    }

    /**
     * Rewind the Iterator to the first element
     *
     * @return void
     *
     * @since 1.0.0
     */
    public function rewind(): void
    {
        $this->index = 0;
    }

    /**
     * Return the current key
     *
     * @return mixed  The current key
     *
     * @since 1.0.0
     */
    public function key(): mixed
    {
        return $this->index;
    }

    /**
     * Return the current value
     *
     * @return mixed  The current value
     *
     * @since 1.0.0
     */
    public function current(): mixed
    {
        return $this->bits[$this->index];
    }

    /**
     * Move forward to the next element
     *
     * @return void
     *
     * @since 1.0.0
     */
    public function next(): void
    {
        $this->index++;
    }

    /**
     * Checks if current position is valid
     *
     * @return boolean
     *
     * @since 1.0.0
     */
    public function valid(): bool
    {
        return $this->index < $this->bits->size;
    }
}
