<?php

class client {
    private ?string $nom;
    private ?string $pre;
    private ?string $email;
    private ?string $psw;
    private ?string $cpsw;

    // Constructor
    public function __construct(?string $nom, ?string $pre,?string $email,?string $psw, ?string $cpsw){
        $this->nom = $nom;
        $this->pre = $pre;
        $this->email = $email;
        $this->psw = $psw;
        $this->cpsw = $cpsw;
    }

    // Getters and Setters

    public function getName(): ?string {
        return $this->nom;
    }
    public function setName(?string $nom): void {
        $this->nom = $nom;
    }


    public function getLast_name(): ?string {
        return $this->pre;
    }
    public function setLast_name(?string $pre): void {
        $this->pre = $pre;
    }
    
    
    public function getemail(): ?string {
        return $this->email;
    }
    public function setemail(?string $email): void {
        $this->email = $email;
    }


    public function getpassword(): ?string {
        return $this->psw;
    }
    public function setpassword(?string $psw): void {
        $this->psw = $psw;
    }
    


    public function getcpassword(): ?string {
        return $this->cpsw;
    }
    public function setcpassword(?string $cpsw): void {
        $this->cpsw = $cpsw;
    }
}

?>
