<?php

/**
 * BitArray example
 *
 * @package    BitArray
 *
 * @author     Christophe Demko <chdemko@gmail.com>
 * @copyright  Copyright (C) 2012-2014 Christophe Demko. All rights reserved.
 *
 * @license    http://www.cecill.info/licences/Licence_CeCILL-B_V1-en.html The CeCILL B license
 *
 * This file is part of the php-bitarray package https://github.com/chdemko/php-bitarray
 */

require __DIR__ . '/../vendor/autoload.php';

use chdemko\BitArray\BitArray;

$bits = BitArray::fromString('10010');

// Print 10010
echo $bits . PHP_EOL;

// Print 01101
$bits->applyComplement();
echo $bits . PHP_EOL;

// Print 11100
$bits->applyXor(BitArray::fromIterable([true, false, false, false, true]));
echo $bits . PHP_EOL;

// Print 11101
$bits[4] = true;
echo $bits . PHP_EOL;

// Print 0:1;1:1;2:1;3:;4:1;
foreach ($bits as $index => $value)
{
	echo $index . ':' . $value . ';';
}

echo PHP_EOL;

// Print [true,true,true,false,true]
echo json_encode($bits) . PHP_EOL;
