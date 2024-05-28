<?php
class Order
{
    public $user_id;
    public $product_id;
    public $selling_price;
    public $quantity;
    public $image;
    public $slug;
    public $name;

    // Constructor
    public function __construct($user_id, $product_id, $selling_price, $quantity, $image, $slug, $name)
    {
        $this->user_id = $user_id;
        $this->product_id = $product_id;
        $this->selling_price = $selling_price;
        $this->quantity = $quantity;
        $this->image = $image;
        $this->slug = $slug;
        $this->name = $name;
    }
}
?>