<?php

class donations {
    private ?string $name;
    private ?string $address;
    private ?int $phone;
    private ?int $bank;
    private ?string $account;
    private ?int $iban;
    private ?float $amount;
    
    public function __construct(
        ?string $name, 
        ?string $address, 
        ?int $phone, 
        ?int $bank, 
        ?string $account, 
        ?int $iban, 
        ?float $amount
    ) {
        $this->name = $name;
        $this->address = $address;
        $this->phone = $phone;
        $this->bank = $bank;
        $this->account = $account;
        $this->iban = $iban;
        $this->amount = $amount;
    }

    public function getName(): ?string {
        return $this->name;
    }

    public function setName(?string $name): void {
        $this->name = $name;
    }

    public function getAddress(): ?string {
        return $this->address;
    }

    public function setAddress(?string $address): void {
        $this->address = $address;
    }

    public function getPhone(): ?int {
        return $this->phone;
    }

    public function setPhone(?int $phone): void {
        $this->phone = $phone;
    }

    public function getBank(): ?int {
        return $this->bank;
    }

    public function setBank(?int $bank): void {
        $this->bank = $bank;
    }

    public function getAccount(): ?string {
        return $this->account;
    }

    public function setAccount(?string $account): void {
        $this->account = $account;
    }

    public function getIban(): ?int {
        return $this->iban;
    }

    public function setIban(?int $iban): void {
        $this->iban = $iban;
    }

    public function getAmount(): ?float {
        return $this->amount;
    }

    public function setAmount(?float $amount): void {
        $this->amount = $amount;
    }
}
?>
