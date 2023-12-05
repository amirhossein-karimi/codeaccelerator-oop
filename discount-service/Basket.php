<?php


final class Basket implements IBasket
{

    private string $userEmail;

    private array $products;

    private float $basketPrice;

    public function __construct(string $userEmail)
    {
        $this->userEmail = $userEmail;
        $this->products = [];
        $this->basketPrice = 0;
    }

    public function getUser(): string
    {
        return $this->userEmail;
    }
    
    public function addProduct(IProduct $product, int $count): void
    {

        if ($count <= 0) {
            throw new Exception('Product count cannot be 0 or less than');
        }

        $price = $product->getPrice() * $count;

        $this->products[$product->getID()] = [
            'count' => $count,
            'product_name' => $product->getTitle(),
            'product_price' => $product->getPrice(),
            'price' => $price
        ];

        $this->increaseTotalPrice($price);
    }

    private function increaseTotalPrice(float $price): void
    {
        $this->basketPrice += $price;
    }


    private function decreaseTotalPrice(float $price): void
    {
        $this->basketPrice -= $price;
    }
    public function removeProduct(string $productID, int $count = 1): void
    {

        if (!isset($this->products[$productID]) || $this->products[$productID]['count'] < $count) {
            throw new Exception('Product not exists');
        }

        if ($count === $this->products[$productID]['count']) {

            $this->decreaseTotalPrice($this->products[$productID]['price']);

            unset($this->products[$productID]);
        } else {

            $price = $this->products[$productID]['product_price'] * $count;

            $this->decreaseTotalPrice($price);

            $this->products[$productID]['count'] -= $count;
        }
    }

    public function getTotalPrice(): float
    {
        return $this->basketPrice;
    }
}
