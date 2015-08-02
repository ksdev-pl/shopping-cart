# Shopping Cart

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE.md)
[![Build Status][ico-travis]][link-travis]
[![Coverage Status][ico-scrutinizer]][link-scrutinizer]
[![Quality Score][ico-code-quality]][link-code-quality]

Original source: http://www.peachpit.com/articles/article.aspx?p=1962481 by Larry Ullman. See the article for 
description and compare source code for changes.

## Install

Via Composer

``` bash
$ composer require ksdev/shopping-cart
```

## Usage

``` php
use Ksdev\ShoppingCart\Cart;
use Ksdev\ShoppingCart\Currency;
use Ksdev\ShoppingCart\Item;

$cart = new Cart(new Currency('PLN'));

$item1 = new Item('SKU1', 'Item 1', '100.00');
$item2 = new Item('SKU2', 'Item 2', '200.00');
$item3 = new Item('SKU3', 'Item 3', '300.00');

$cart->addItem($item1);
$cart->addItem($item2);
$cart->addItem($item3);

if (!$cart->isEmpty()) {
    foreach ($cart as $arr) {
        $item = $arr['item'];
        var_dump($item->getSku());              // E.g. string(4) "SKU1"
        var_dump($item->getName());             // E.g. string(6) "Item 1"
        var_dump($item->getPrice());            // E.g. string(6) "100.00"
        var_dump($arr['qty']);                  // E.g. int(1)
    }
}

var_dump($cart->total());                       // string(6) "600.00"
var_dump($cart->getCurrency()->getCode());      // string(3) "PLN"

$item4 = new Item('SKU1', 'Item 1', '100.00');  // Same as $item1
$cart->addItem($item4);

var_dump($cart->total());                       // string(6) "700.00"
var_dump($cart->count());                       // int(4); also: count($cart)
var_dump($cart->countUnique());                 // int(3)

$cart->updateItem($item2, 3);                   // 3 is the new quantity

var_dump($cart->count());                       // int(6)
var_dump($cart->countUnique());                 // int(3)

$cart->updateItem($item2, 0);                   // Removes the item from the cart

var_dump($cart->count());                       // int(3)
var_dump($cart->countUnique());                 // int(2)

$cart->deleteItem($item1);                      // Removes the item from the cart

var_dump($cart->count());                       // int(1)
var_dump($cart->countUnique());                 // int(1)

var_dump($cart->getItem('SKU3'));               // Get item by Stock Keeping Unit 
/*
    array(2) {
        'item' => class Ksdev\ShoppingCart\Item#270 (3) {
            protected $sku   => string(4) "SKU3"
            protected $name  => string(6) "Item 3"
            protected $price => string(6) "300.00"
        }
        'qty' => int(1)
    }
*/
```

## Testing

``` bash
$ composer test
```

## Credits

- Larry Ullman

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/ksdev/shopping-cart.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/ksdev-pl/shopping-cart/master.svg?style=flat-square
[ico-scrutinizer]: https://img.shields.io/scrutinizer/coverage/g/ksdev-pl/shopping-cart.svg?style=flat-square
[ico-code-quality]: https://img.shields.io/scrutinizer/g/ksdev-pl/shopping-cart.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/ksdev/shopping-cart
[link-travis]: https://travis-ci.org/ksdev-pl/shopping-cart
[link-scrutinizer]: https://scrutinizer-ci.com/g/ksdev-pl/shopping-cart/code-structure
[link-code-quality]: https://scrutinizer-ci.com/g/ksdev-pl/shopping-cart
