<?php

class Personne {
    public function __construct(
        protected string $nom,
        protected string $prenom,
        protected string $dateNaissance
    ) {}

    protected function getAge(): int {
        $naissance = new DateTime($this->dateNaissance);
        $aujourdhui = new DateTime();
        return $naissance->diff($aujourdhui)->y;
    }

    public function __toString(): string {
        return "{$this->prenom} {$this->nom} ({$this->getAge()} ans)";
    }
}

class Etudiant extends Personne {
    private string $cne;

    public function __construct(
        string $nom,
        string $prenom,
        string $dateNaissance,
        string $cne
    ) {
        parent::__construct($nom, $prenom, $dateNaissance);
        $this->cne = $cne;
    }

    public function getCne(): string {
        return $this->cne;
    }

    public function __toString(): string {
        return parent::__toString() . " - CNE: {$this->cne}";
    }
}
$etudiants = [
    new Etudiant("Benali", "Ahmed", "2002-01-15", "K13001122"),
    new Etudiant("Alami", "Sara", "2001-08-20", "G14005566"),
    new Etudiant("Chraibi", "Omar", "2003-03-10", "R12009988"),
    new Etudiant("Sabri", "Lina", "2002-11-05", "D11003344"),
    new Etudiant("Oulamine", "Hamza", "2001-04-12", "M15007788")
];

foreach ($etudiants as $e) {
    echo $e . PHP_EOL;
}
