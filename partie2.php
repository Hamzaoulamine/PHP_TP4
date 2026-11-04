<?php

class VoiturePromo {
    public function __construct(
        public string $couleur = "Blanche",
        public int $vitesse = 0
    ) {}

    public function afficher(): void {
        echo "Couleur : {$this->couleur} | Vitesse : {$this->vitesse} km/h" . PHP_EOL;
    }
}

$v1 = new VoiturePromo();
$v2 = new VoiturePromo("Rouge", 50);
$v1->afficher();
$v2->afficher();

class PersonneMulti {
    public function __construct(
        public string $nom = "Anonyme",
        public string $prenom = "Inconnu"
    ) {
        echo "Création de " . __CLASS__ . " : $prenom $nom" . PHP_EOL;
    }
}

$p1 = new PersonneMulti();
$p2 = new PersonneMulti("El Amrani", "Youssef");

class VoitureDestruct {
    public function __construct(public string $couleur) {
        echo "Voiture {$this->couleur} créée." . PHP_EOL;
    }

    public function __destruct() {
        echo "Voiture {$this->couleur} détruite." . PHP_EOL;
    }
}

$maVoiture = new VoitureDestruct("Blanche");
unset($maVoiture);
echo "Fin du script." . PHP_EOL;
