<?php

require_once('../../config.php');
require_once('../../Controller/OrdersC.php');
class orders
{
    private ?int $OrderId = null;
    private ?string $fullName = null;
    private ?string $Email = null;
    private ?int $phoneNumber = null;
    private ?string $Clocation = null;
    private ?string $Productname = null;
    private ?string $Productprice= null; 
    private ?int $Quantity =null;
    private ?float $TotalPrice =null;
    private $DatePurchase; // New property
    private ?int $ProdId =null;
    
    public function __construct($OrderId = null,$fullName,$Email,$Pnbr,$loc,$Productname,$Productprice,$Quantity, $TotalPrice,$ProdId)
    {
        $this->OrderId = $OrderId;
        $this->fullName = $fullName;
        $this->Email = $Email;
        $this->phoneNumber = $Pnbr;
        $this->Clocation = $loc;
        $this->Productname = $Productname;
        $this->Productprice = $Productprice;
        $this->Quantity = $Quantity;
        $this->TotalPrice = $TotalPrice;
        $this->DatePurchase = $DatePurchase ?? date('Y-m-d H:i:s'); // Initialize the datePurchase property
        $this->ProdId = $ProdId;
    }
    public function getOrderId()
    {
        return $this->OrderId;
    }
    public function getfullName()
    {
        return $this->fullName;
    }
    public function setfullName($fullName)
    {
        $this->fullName = $fullName;
        return $this;
    }
    public function getEmail()
    {
        return $this->Email;
    }
    public function getphoneNumber()
    {
        return $this->phoneNumber;
    }
    public function setphoneNumber($phoneNumber)
    {
        $this->phoneNumber = $phoneNumber;
        return $this;
    }
    public function getClocation()
    {
        return $this->Clocation;
    }
    public function setClocation($Clocation)
    {
        $this->Clocation = $Clocation;
        return $this;
    }
    
    public function getProductname()
    {
        return $this->Productname;
    }
    public function setProductname($Productname)
    {
        $this->Productname = $Productname;
        return $this;
    }
    public function getProductprice()
    {
        return $this->Productprice;
    }
    public function setProductprice($Productprice)
    {
        $this->Productprice = $Productprice;
        return $this;
    }
    public function getQuantity()
    {
        return $this->Quantity;
    }
    public function setQuantity($Quantity)
    {
        $this->Quantity = $Quantity;
        return $this;
    }
    public function getTotalPrice()
    {
        return $this->TotalPrice;
    }
    public function setTotalPrice($TotalPrice)
    {
        $this->TotalPrice = $TotalPrice;
        return $this;
    }
    public function getDatePurchase() {
        return $this->DatePurchase;
    }
    public function getProdId()
    {
        return $this->ProdId;
    }
    public function setProdId($ProdId)
    {
        $this->ProdId = $ProdId;
        return $this;
    }
}