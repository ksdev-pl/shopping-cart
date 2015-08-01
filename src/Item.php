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
     * @param string $price Item price
     */
    public function __construct($sku, $name, $price)
    {
        $this->sku = $sku;
        $this->name = $name;
        $this->price = $price;
    }

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
