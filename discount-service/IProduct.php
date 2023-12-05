<?php

interface IProduct
{

    public function getTitle(): string;
    public function setTitle(string $title): void;

    public function getPrice(): float;
    public function setPrice(float $price): void;

    public function getID(): string;
}
