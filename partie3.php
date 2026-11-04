<?php

class PersonneMagique {
    private string $nom = "";
    private string $prenom = "";
    private string $dateNaissance = "";

    public function __set(string $name, mixed $value): void {
        if (!property_exists($this, $name)) {
            echo "Propriété '$name' inexistante." . PHP_EOL;
            return;
        }
        if ($name === 'nom') {
            if (empty($value) || strlen($value) < 2) {
                throw new InvalidArgumentException("Le nom doit contenir au moins 2 caractères.");
            }
        }

        $this->$name = $value;
    }

    public function __get(string $name): mixed {
        return property_exists($this, $name) ? $this->$name : null;
    }

    public function __isset(string $name): bool {
        return property_exists($this, $name) && !empty($this->$name);
    }

    public function __unset(string $name): void {
        if (property_exists($this, $name)) {
            $this->$name = "";
        }
    }
}

$p = new PersonneMagique();
$p->nom = "Hachimi";
echo "Nom : " . $p->nom . PHP_EOL;
var_dump(isset($p->nom));
unset($p->nom);
var_dump(isset($p->nom));
$p->telephone = "0600000000";
