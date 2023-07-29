<?php

namespace MLV\MyCart;

class Cart
{
    private array $products;
    private int $index; 

    public function __construct()
    {
        $this->index = 0;
    }

    public function addItem($product)
    {
        $this->products[] = $product;
    }

    public function removeItem($product)
    {
        $this->products = array_filter($this->products, function ($item) use ($product) {
            return $item['slug'] !== $product['slug'];
        });
    }

    public function current()
    {
        return $this->products[$this->index];
    }

    public function next()
    {
        $this->index++;   
    }

    public function key()
    {
        return $this->index;
    }

    public function reset()
    {
        $this->index = 0;
    }

    public function valid()
    {
        if (isset($this->products[$this->index])) {
            return true;
        } else {
            return false;
        }
    }

    public function count()
    {
        return count($this->products);    
    }

    private function productIncrement($product)
    {
        return array_map(function ($item) use ($product) {
            if ($product['slug'] === $item['slug']) {
                $item['quantity'] += $product['quantity'];
            }
            return $item;
        }, $this->products);
    }
}