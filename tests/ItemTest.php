<?php

namespace Ksdev\ShoppingCart\Test;

use Ksdev\ShoppingCart\Item;

class ItemTest extends \PHPUnit_Framework_TestCase
{
    public function testNewInstance()
    {
        $item = new Item('SKU', 'Name', '123.45');

        $this->assertEquals('SKU', $item->getSku());
        $this->assertEquals('Name', $item->getName());
        $this->assertEquals('123.45', $item->getPrice());
        $this->assertEquals('0.00', $item->getTax());
    }

    public function testInvalidPriceFormat()
    {
        $numExceptions = 0;
        try {
            new Item('SKU', 'Name', 123);
        } catch (\Exception $e) {
            $this->assertEquals('Invalid amount format', $e->getMessage());
            $numExceptions++;
        }
        try {
            new Item('SKU', 'Name', '123,45');
        } catch (\Exception $e) {
            $this->assertEquals('Invalid amount format', $e->getMessage());
            $numExceptions++;
        }
        try {
            new Item('SKU', 'Name', '123.4567');
        } catch (\Exception $e) {
            $this->assertEquals('Invalid amount format', $e->getMessage());
            $numExceptions++;
        }
        $this->assertEquals(3, $numExceptions);
    }

    public function testInvalidTaxFormat()
    {
        $numExceptions = 0;
        try {
            new Item('SKU', 'Name', '123.45', 123);
        } catch (\Exception $e) {
            $this->assertEquals('Invalid amount format', $e->getMessage());
            $numExceptions++;
        }
        try {
            new Item('SKU', 'Name', '123.45', '123,45');
        } catch (\Exception $e) {
            $this->assertEquals('Invalid amount format', $e->getMessage());
            $numExceptions++;
        }
        try {
            new Item('SKU', 'Name', '123.45', '123.4567');
        } catch (\Exception $e) {
            $this->assertEquals('Invalid amount format', $e->getMessage());
            $numExceptions++;
        }
        $this->assertEquals(3, $numExceptions);
    }
}
