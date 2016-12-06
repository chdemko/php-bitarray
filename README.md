PHP BitArray
======================
[![Travis](https://img.shields.io/travis/chdemko/php-bitarray.svg)](http://travis-ci.org/chdemko/php-bitarray)
[![Coveralls](https://img.shields.io/coveralls/chdemko/php-bitarray.svg)](https://coveralls.io/r/chdemko/php-bitarray?branch=master)
[![Scrutinizer](https://img.shields.io/scrutinizer/g/chdemko/php-bitarray.svg)](https://scrutinizer-ci.com/g/chdemko/php-bitarray/?branch=master)
[![Dependency Status](https://www.versioneye.com/package/php--chdemko--bitarray/badge.svg)](https://www.versioneye.com/package/php--chdemko--bitarray)
[![Latest Stable Version](https://img.shields.io/packagist/v/chdemko/bitarray.svg)](https://packagist.org/packages/chdemko/bitarray)
[![Packagist](https://img.shields.io/packagist/dt/chdemko/bitarray.svg)](https://packagist.org/packages/chdemko/bitarray)
[![Latest Unstable Version](https://poser.pugx.org/chdemko/bitarray/v/unstable.svg)](https://packagist.org/packages/chdemko/bitarray)
[![License](https://poser.pugx.org/chdemko/bitarray/license.svg)](http://www.cecill.info/licences/Licence_CeCILL-B_V1-en.html)

BitArray for PHP.

This project uses:

* [PHP Code Sniffer](http://pear.php.net/package/PHP_CodeSniffer) for checking PHP code style using [Joomla Coding Standards](https://github.com/joomla/coding-standards)
* [PHPUnit](http://phpunit.de/) for unit test (100% covered)
* [phpDocumentor](http://http://www.phpdoc.org/) for api documentation

Installation
------------

Using composer: either

~~~
$ composer create-project chdemko/bitarray:1.1.x-dev --dev; cd bitarray
~~~

or create a `composer.json` file containing

~~~json
{
    "require": {
        "chdemko/bitarray": "1.1.x-dev"
    }
}
~~~
and run
~~~
$ composer install
~~~

Create a `test.php` file containing
~~~php
<?php
require __DIR__ . '/vendor/autoload.php';

use chdemko\BitArray\BitArray;

$bits = BitArray::fromTraversable([true,false,false,true]);
echo $bits . PHP_EOL;
~~~
This should print
~~~
1001
~~~
See the [examples](https://github.com/chdemko/php-bitarray/tree/master/examples) folder for more information.

Documentation
-------------

* [http://chdemko.github.io/php-bitarray](http://chdemko.github.io/php-bitarray)

Citation
--------

If you are using this project including publication in research activities, you have to cite it using ([BibTeX format](https://raw.github.com/chdemko/php-bitarray/master/cite.bib)). You are also pleased to send me an email to chdemko@gmail.com.
* authors: Christophe Demko
* title: php-bitarray: a PHP library for handling bit arrays
* year: 2014
* how published: http://chdemko.github.io/php-bitarray

