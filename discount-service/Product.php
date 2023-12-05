<?php



final class Product implements IProduct
{

    private float $price;

    private string $title;


    public function __construct()
    {
        $this->price = 0;
        $this->title = '';
    }

    public function setPrice(float $price): void
    {
        if ($price <= 0) {
            throw new Exception('Price is not valid');
        }
        $this->price = $price;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function getTitle(): string
    {

        return $this->title;
    }

    public function getID(): string
    {
        return md5($this->title);
    }
}
