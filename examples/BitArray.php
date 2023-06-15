<?php

/**
 * BitArray example
 *
 * @package BitArray
 *
 * @author    Christophe Demko <chdemko@gmail.com>
 * @copyright Copyright (C) 2012-2023 Christophe Demko. All rights reserved.
 *
 * @license BSD 3-Clause License
 *
 * This file is part of the php-bitarray package https://github.com/chdemko/php-bitarray
 */

require __DIR__ . '/../vendor/autoload.php';

use chdemko\BitArray\BitArray;

// Print 10010
$bits = BitArray::fromString('10010');
echo $bits . PHP_EOL;

// Print 01101
$bits->applyComplement();
echo $bits . PHP_EOL;

// Print 11100
$bits->applyXor(BitArray::fromTraversable(array(true, false, false, false, true)));
echo $bits . PHP_EOL;

// Print 11101
$bits[4] = true;
echo $bits . PHP_EOL;

// Print 0:1;1:1;2:1;3:;4:1;
foreach ($bits as $index => $value) {
    echo $index . ':' . $value . ';';
}

echo PHP_EOL;

// Print [true,true,true,false,true]
echo json_encode($bits) . PHP_EOL;
