<?php

class monuments {
    private ?string $name;
    private ?string $description;
    private ?float $price;
    private ?string $image;
    
    public function __construct(?string $name, ?string $description,?float $price ,?string $image) {
        $this->name = $name;
        $this->description = $description;
        $this->image = $image;
        $this->price = $price;
    }

    public function getName(): ?string {
        return $this->name;
    }

    public function setName(?string $name): void {
        $this->name = $name;
    }

    public function getDescription(): ?string {
        return $this->description;
    }

    public function setDescription(?string $description): void {
        $this->description = $description;
    }

    public function getPrice(): ?float {
        return $this->price;
        }
        public function setPrice(?float $price): void {
            $this->price = $price;
            }

    public function getImage(): ?string {
        return $this->image;
    }

    public function setImage(?string $image): void {
        $this->image = $image;
    }


}

?>
