<?php

namespace Ksdev\ShoppingCart\Test;

use Ksdev\ShoppingCart\Currency;

class CurrencyTest extends \PHPUnit_Framework_TestCase
{
    public function testGetCode()
    {
        $currency = new Currency('PLN');
        $this->assertEquals('PLN', $currency->getCode());

        $currency = new Currency('usd');
        $this->assertEquals('USD', $currency->getCode());
    }

    /**
     * @expectedException \Exception
     * @expectedExceptionMessage Invalid currency code
     */
    public function testInvalidCode()
    {
        new Currency('123');
    }
}
