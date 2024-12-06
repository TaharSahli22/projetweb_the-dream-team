<?php

class reclamation {
    private ?int $id;
    private ?string $nom;
    private ?string $prenom;
    private ?int $telephone;
    private ?string $email;
    private ?DateTime $dates;
    private ?string $messages;

    // Constructor
    public function __construct(
        ?int $id,
        ?string $nom,
        ?string $prenom,
        ?int $telephone,
        ?string $email,
        ?DateTime $dates, 
        ?string $messages
    ) {
        $this->id = $id;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->telephone = $telephone;
        $this->email = $email;
        $this->dates = $dates;
        $this->messages = $messages;
    }

    // Getters and Setters
    public function getId(): ?int {
        return $this->id;
    }

    public function setId(?int $id): void {
        $this->id = $id;
    }

    public function getNom(): ?string {
        return $this->nom;
    }

    public function setNom(?string $nom): void {
        $this->nom = $nom;
    }

    public function getPrenom(): ?string {
        return $this->prenom;
    }

    public function setPrenom(?string $prenom): void {
        $this->prenom = $prenom;
    }

    public function getTelephone(): ?int {
        return $this->telephone;
    }

    public function setTelephone(?int $telephone): void {
        $this->telephone = $telephone;
    }

    public function getEmail(): ?string {
        return $this->email;
    }

    public function setEmail(?string $email): void {
        $this->email = $email;
    }

    public function getDate(): ?DateTime {
        return $this->dates;
    }

    public function setDate(?DateTime $dates): void {
        $this->dates = $dates;
    }

    
    public function getMessages(): ?string {
        return $this->messages;
    }

    public function setMessages(?string $messages): void {
        $this->messages = $messages;
    }
}
?>
