<?php

class storys {
    private ?int $id;
    private ?string $title;
    private ?string $subjects;
    private ?DateTime $dates;
    private ?string $adminuser;
    private ?float $likes;
    

    // Constructor
    public function __construct(?int $id, ?string $title, ?string $subjects, ?DateTime $dates, ?string $adminuser,?float $likes) {
        $this->id = $id;
        $this->title = $title;
        $this->subjects = $subjects;
        $this->dates = $dates;
        $this->adminuser = $adminuser;
        $this->likes = $likes;
    }

    // Getters and Setters

    public function getId(): ?int {
        return $this->id;
    }

    public function setId(?int $id): void {
        $this->id = $id;
    }

    public function getTitle(): ?string {
        return $this->title;
    }

    public function setTitle(?string $title): void {
        $this->title = $title;
    }

    public function getsubjects(): ?string {
        return $this->subjects;
    }

    public function setsubjects(?string $subjects): void {
        $this->subjects = $subjects;
    }

    public function getdates(): ?DateTime {
        return $this->dates;
    }

    public function setdates(?DateTime $dates): void {
        $this->dates = $dates;
    }

    public function getadminuser(): string {
        return $this->adminuser;
    }

    public function setadminuser(string $adminuser): void {
        $this->adminuser = $adminuser;
    }


    public function getlikes(): ?float {
        return $this->likes;
    }

    public function setlikes(float $likes): void {
        $this->likes = $likes;
    }


}

?>
