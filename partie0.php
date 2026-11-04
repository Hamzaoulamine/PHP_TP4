<?php


class Voiture {
    public string $marque;
    public string $couleur;

    public function setMarque(string $m): void {
        $this->marque = $m;
    }

    public function setCouleur(string $c): void {
        $this->couleur = $c;
    }

    public function afficher(): void {
        echo "Marque : " . $this->marque . " | Couleur : " . ($this->couleur ?? "Non définie") . PHP_EOL;
    }
}


$v1 = new Voiture();
$v1->setMarque("Toyota");
$v1->setCouleur("Noire");
$v1->afficher();

$v2 = new Voiture();
$v2->setMarque("Renault");
$v2->setCouleur("Rouge");
$v2->afficher();
