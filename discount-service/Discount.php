<?php

final class Discount
{

    private IBasket $basket;
    private string $flag;

    public const PERCENT = 'percent';
    public const NUMERICAL = 'numerical';

    public function __construct(IBasket $basket, string $flag)
    {
        $this->basket = $basket;
        $this->flag = $flag;
    }

    public function calculate(float $discount): float
    {

        if ($this->flag === self::NUMERICAL && $discount > $this->basket->getTotalPrice()) {
            throw new Exception('Discount cannot be greather than total price');
        }
        if ($this->flag === self::PERCENT && $discount > 100) {
            throw new Exception('Discount be greahter than 100%');
        }

        if ($this->flag === self::NUMERICAL) {
            return $this->basket->getTotalPrice() - $discount;
        }
        return  $this->basket->getTotalPrice() - (($discount * $this->basket->getTotalPrice()) / 100);
    }
}
