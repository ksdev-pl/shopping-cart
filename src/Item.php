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
     * @param string $sku Item Stock Keeping Unit
     * @param string $name Item name
     * @param string $price Item price with two digits after decimal point, e.g. '123.00'
     *
     * @throws \Exception When the price format is invalid
     */
    public function __construct($sku, $name, $price)
    {
        $this->setSku($sku);
        $this->setName($name);
        $this->setPrice($price);
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
        $price = (string)$price;
        if (preg_match('/^\d+\.\d{2}$/', $price)) {
            $this->price = $price;
        } else {
            throw new \Exception('Invalid format of price');
        }
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
}
