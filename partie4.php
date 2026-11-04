<?php

class PersonneString {
    private string $nom;
    private string $prenom;
    private string $dateNaissance;

    public function __construct(string $nom, string $prenom, string $dateNaissance) {
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->dateNaissance = $dateNaissance;
    }

    private function getAge(): int {
        $naissance = new DateTime($this->dateNaissance);
        $aujourdhui = new DateTime();
        return $naissance->diff($aujourdhui)->y;
    }

    public function __toString(): string {
        return "{$this->prenom} {$this->nom} ({$this->getAge()} ans)";
    }
}

$p = new PersonneString("Hachimi", "Sara", "2000-05-14");
echo $p . PHP_EOL;
