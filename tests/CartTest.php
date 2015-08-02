<?php

namespace Ksdev\ShoppingCart\Test;

use Ksdev\ShoppingCart\Cart;
use Ksdev\ShoppingCart\Currency;
use Ksdev\ShoppingCart\Item;

class CartTest extends \PHPUnit_Framework_TestCase
{
    public function testIsEmpty()
    {
        $cart = $this->initTestCart();
        $this->assertEquals(true, $cart->isEmpty());
    }

    public function testIsNotEmpty()
    {
        $cart = $this->initTestCart();
        $cart = $this->addTestItems($cart, 2);
        $this->assertEquals(false, $cart->isEmpty());
    }

    public function testAddItem()
    {
        $cart = $this->initTestCart();
        $cart = $this->addTestItems($cart, 2);

        $i = 1;
        foreach ($cart as $item) {
            $this->assertEquals("TestClass_$i", $item['item']->getSku());
            $this->assertEquals("Test Item $i", $item['item']->getName());
            $this->assertEquals("123$i", $item['item']->getPrice());
            $i++;
        }
    }

    public function testCountAll()
    {
        $cart = $this->initTestCart();
        $cart = $this->addTestItems($cart, 4);
        $this->assertEquals(4, count($cart));

        $cart = $this->addTestItems($cart, 4, false);
        $this->assertEquals(8, count($cart));
    }

    public function testCountUnique()
    {
        $cart = $this->initTestCart();
        $cart = $this->addTestItems($cart, 4);
        $this->assertEquals(4, $cart->countUnique());

        $cart = $this->addTestItems($cart, 4, false);
        $this->assertEquals(5, $cart->countUnique());
    }

    public function testUpdateWhenAddedExistingItem()
    {
        $cart = $this->initTestCart();
        $cart = $this->addTestItems($cart, 4);
        $this->assertEquals(1, $cart->getItem('TestClass_1')['qty']);

        $cart->addItem(new Item("TestClass_1", "Test Item 1", "1231"));
        $this->assertEquals(2, $cart->getItem('TestClass_1')['qty']);
    }

    public function testUpdateItem()
    {
        $cart = $this->initTestCart();
        $cart = $this->addTestItems($cart, 4);
        $cart->updateItem($cart->getItem('TestClass_1')['item'], 3);
        $this->assertEquals(3, $cart->getItem('TestClass_1')['qty']);

        $cart->updateItem($cart->getItem('TestClass_1')['item'], 0);
        $this->assertEquals([], $cart->getItem('TestClass_1'));
    }

    public function testDeleteItem()
    {
        $cart = $this->initTestCart();
        $cart = $this->addTestItems($cart, 4);
        $cart->deleteItem($cart->getItem('TestClass_2')['item']);
        $this->assertEquals([], $cart->getItem('TestClass_2'));

        $i = 0;
        foreach ($cart as $key => $item) {
            $this->assertEquals($i, $key);
            $i++;
        }
        $this->assertEquals(3, $i);
    }

    public function testGetCurrency()
    {
        $cart = $this->initTestCart();
        $this->assertEquals('PLN', $cart->getCurrency()->getCode());
    }

    private function initTestCart()
    {
        $cart = new Cart(new Currency('PLN'));
        return $cart;
    }

    private function addTestItems(Cart $cart, $num, $unique = true)
    {
        $first = count($cart) + 1;
        for ($i = 1, $id = $first; $i <= $num; $i++, $id++) {
            $id = $unique ? $id : 0;
            $cart->addItem(new Item("TestClass_$id", "Test Item $id", "123$id"));
        }
        return $cart;
    }
}
