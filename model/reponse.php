<?php

class reponse {
    private ?int $id;
    private ?DateTime $date_reponse;
    private ?string $reponse;
    private ?int $id_reclamations;

    public function __construct(
        ?int $id,
        ?DateTime $date_reponse,
        ?string $reponse,
        ?int $id_reclamations,
        
    ) {
        $this->id= $id;
        $this->date_reponse = $date_reponse;
        $this->reponse= $reponse;
        $this->id_reclamations = $id_reclamations;
        
    }

    // Getters and Setters
    public function getId(): ?int {
        return $this->id;
    }

    public function setId(?int $id): void {
        $this->id = $id;
    }

    public function getDate(): ?DateTime {
        return $this->date_reponse;
    }

    public function setDate(?DateTime $date_reponse): void {
        $this->date_reponse = $date_reponse;
    }

    public function getReponse(): ?string {
        return $this->reponse;
    }

    public function setReponse(?string $reponse): void {
        $this->response = $reponse;
    }

    public function getId_reclamations(): ?int {
        return $this->id_reclamations;
    }

    public function setId_reclamations(?int $id_reclamations): void {
        $this->id_reclamations = $id_reclamations;
    }
}
?>


