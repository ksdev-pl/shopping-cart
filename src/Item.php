<?php

namespace Ksdev\ShoppingCart;

class Item
{
    /**
     * Item Stock Keeping Unit
     *
     * @var string $sku
     */
    protected $sku;

    /**
     * Item name
     *
     * @var string $name
     */
    protected $name;

    /**
     * Item price
     *
     * @var string $price
     */
    protected $price;

    /**
     * Item tax
     *
     * @var string $price
     */
    protected $tax;

    /**
     * @param string $sku Item Stock Keeping Unit
     * @param string $name Item name
     * @param string $price Item price with two digits after decimal point, e.g. '123.00'
     * @param string $tax Optional tax with two digits after decimal point, e.g. '23.00'
     *
     * @throws \Exception When the price format is invalid
     */
    public function __construct($sku, $name, $price, $tax = '0.00')
    {
        $this->setSku($sku);
        $this->setName($name);
        $this->setPrice($price);
        $this->setTax($tax);
    }

    // Setters

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = (string)$name;
    }

    /**
     * @param string $sku
     */
    public function setSku($sku)
    {
        $this->sku = (string)$sku;
    }

    /**
     * @param string $price Item price with two digits after decimal point, e.g. '123.00'
     *
     * @throws \Exception When the price format is invalid
     */
    public function setPrice($price)
    {
        $this->validateAmountFormat($price);
        $this->price = (string)$price;
    }

    /**
     * @param string $tax Optional tax with two digits after decimal point, e.g. '23.00'
     *
     * @throws \Exception When the tax format is invalid
     */
    public function setTax($tax)
    {
        $this->validateAmountFormat($tax);
        $this->tax = (string)$tax;
    }

    // Getters

    /**
     * @return string
     */
    public function getSku()
    {
        return $this->sku;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @return string
     */
    public function getTax()
    {
        return $this->tax;
    }

    /**
     * Validate amount format
     *
     * Checks if amount is a number with two digits after decimal point
     *
     * @param mixed $amount
     *
     * @throws \Exception When the amount format is invalid
     */
    protected function validateAmountFormat($amount)
    {
        if (! preg_match('/^\d+\.\d{2}$/', $amount)) {
            throw new \Exception('Invalid amount format');
        }
    }
}
