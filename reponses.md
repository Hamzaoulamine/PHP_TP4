# Réponses aux questions théoriques – TP 4 POO PHP
**Nom & Prénom :** Hamza Oulamine
**Groupe :** G4

---

## Partie 0
- **0.3 :** Non, `$v1` et `$v2` ne partagent pas la même valeur de `$marque`. Une classe est un modèle, mais chaque objet instancié possède son propre espace mémoire et ses propres valeurs d'attributs.

---

## Partie 1
- **1.1 :** 
  - `echo $p->cin;` provoque une erreur `Fatal error: Cannot access private property Personne::$cin`.
  - `echo $p->dateNaissance;` provoque une erreur `Fatal error: Cannot access private property Personne::$dateNaissance`.
  - `echo $p->getAge();` provoque une erreur `Fatal error: Call to private method Personne::getAge()`.
- **1.2 :** Le CIN est une donnée sensible et confidentielle. Le laisser en `public` permettrait à n'importe quel code externe de le modifier ou d'y accéder sans contrôle.
- **1.3 :** `getAge()` n'est pas inutile. Elle sert de méthode auxiliaire (helper) interne pour calculer l'âge nécessaire à d'autres méthodes publiques de la classe (ex: `__toString()`).
- **1.4 :** Non, l'accès depuis l'extérieur reste interdit (`Fatal error: Cannot access protected property`). La différence avec `private` apparaît uniquement lors de l'héritage.

---

## Partie 2
- **2.1.a :** `new Voiture("Noire")` initialise la couleur à "Noire" et conserve la vitesse par défaut (0). `new Voiture(120)` provoquera un avertissement ou une erreur de typage (`TypeError`) car une chaîne de caractères est attendue pour la couleur.
- **2.1.b :** L'avantage de la promotion de propriétés (PHP 8) est la concision du code : elle évite la répétition de la déclaration des attributs et de leur assignation `$this->prop = $prop`.
- **2.2.a :** PHP ne supporte pas la surcharge de méthodes (méthodes avec le même nom et des signatures différentes dans une même classe). Déclarer deux `__construct()` provoque une erreur `Fatal error: Cannot redeclare Personne::__construct()`.
- **2.2.b :** On utilise des valeurs par défaut dans la signature d'un unique constructeur.
- **2.3.a :** 
  1. `Voiture Blanche créée.`
  2. `Voiture Blanche détruite.` (déclenché par `unset`)
  3. `Fin du script.`
- **2.3.b :** L'ordre devient :
  1. `Voiture Blanche créée.`
  2. `Fin du script.`
  3. `Voiture Blanche détruite.` (déclenché automatiquement à la fin de l'exécution du script)
- **2.3.c :** Ils sont détruits dans l'ordre inverse de leur création (LIFO) ou selon la libération de la mémoire par le garbage collector.

---

## Partie 3
- **3.2 :** Sans `__set`, écrire `$p->nom = "X"` sur une propriété `private` génère une erreur fatale. Avec `__set`, l'accès est intercepté et la méthode magique s'exécute.
- **3.3 :** Oui, si `__set` affecte la valeur sans contrôle, l'encapsulation est brisée. Pour éviter cela, il faut intégrer des validations (ex: vérifier la longueur du texte, le format, etc.).

---

## Partie 4
- **4.1 :** `__toString()` est une méthode membre de la classe `Personne`, elle a donc accès à toutes les méthodes et propriétés privées de sa propre classe.
- **4.2 :** PHP lève une erreur fatale (`TypeError: __toString() must return a string`).
- **4.3 :** `__toString()` permet l'utilisation directe de l'objet dans un contexte de chaîne (ex: `echo $objet`, interpolation `"Bonjour $objet"`, concaténation) sans devoir appeler explicitement une méthode.

---

## Partie 5
- **5.1 :** Non, le mot de passe n'apparaît pas car il a été exclu du tableau retourné par `__serialize()`.
- **5.2 :** Sans `__serialize()`, tous les attributs (y compris `private $motDePasse`) sont sérialisés. Cela présente un risque majeur de fuite de données sensibles si la chaîne est stockée ou transmise.
- **5.3 :** `$motDePasse` vaut `""` (chaîne vide). Dans une vraie application, il faudrait recharger le mot de passe depuis la base de données ou forcer une réauthentification.
- **5.4 :** **Sécurité (PHP Object Injection) :** `unserialize()` peut instancier des objets et exécuter leurs méthodes magiques (`__wakeup`, `__destruct`), permettant à un attaquant d'injecter du كود ضار (Remote Code Execution). **Alternative :** Utiliser `json_encode()` et `json_decode()`.

---

## Partie 6
- **6.1.b :** Non, `$c->miauler()` provoquera une erreur car la méthode `miauler()` appartient à la classe `Chat`, et `Chien` n'hérite pas de `Chat`.
- **6.2.a :** L'attribut `$nom` n'est pas initialisé et reste indéfini, générant une erreur ou un avertissement lors de l'appel de `presentation()`.
- **6.2.b :** `$nom` doit être `protected` pour que la classe fille `Etudiant` puisse y accéder ou que le constructeur parent l'initialise correctement.
- **6.3.a :** 
  1. Redéfinir `afficher()` : `Fatal error: Cannot override final method Base::afficher()`.
  2. Étendre `Outil` : `Fatal error: Class SousOutil may not inherit from final class (Outil)`.
  3. Modifier `$p->reference` : `Fatal error: Cannot modify readonly property Produit::$reference`.
- **6.3.b :** 
  - `readonly` : Adapté pour un identifiant unique (UUID, ID base de données) ou une date de création.
  - `final` : Adapté pour une classe de sécurité (ex: `GestionnaireAuthentification`) dont la logique ne doit pas être altérée par héritage.
- **6.4.a :** L'accès échoue si `getAge()` est `private` dans `Personne`. Il faut changer sa visibilité en `protected` (ou `public`).
- **6.4.b :** Car `$dateNaissance` est déclarée en `private` dans `Personne`. Les membres `private` ne sont pas accessibles par les classes filles (il faudrait la passer en `protected`).
- **6.4.c :** Évite la duplication de code et garantit la maintenabilité (si le format de présentation d'une Personne change, `Etudiant` s'adapte automatiquement).

---

## Partie 7
- **7.1 :** Erreur de syntaxe dans `$this->montant 1 * $this->interet`. Il y a un espace au lieu d'un opérateur (ou un `1` en trop).
- **7.2 :** Formule correcte : `Nouveau Montant = Montant actuel * (1 + Taux / 100)`.
- **7.3 :** Incohérence dans l'ordre des paramètres. Passer le montant puis l'intérêt est plus naturel. Si l'ordre est inversé sans faire attention lors de l'instanciation, les calculs seront complètement faux.
- **7.4 :** Voir le code corrigé dans `partie7.php`.

---

## Questions de synthèse
1. **Classe vs Objet :** Une classe est la structure/plan théorique (types, attributs, méthodes), tandis qu'un objet est une instance concrète en mémoire créée à partir de ce plan.
2. **Avantages POO :** Meilleure organisation/modularité du code, réutilisabilité grâce à l'héritage, et protection des données via l'encapsulation.
3. **Attributs `private`/`protected` :** Pour appliquer le principe d'encapsulation, empêcher la corruption des données depuis l'extérieur et contrôler les modifications via des getters/setters.
4. **`private` vs `protected` :** `private` est accessible **uniquement** dans la classe d'origine. `protected` est également accessible dans les classes filles qui en héritent.
5. **Méthodes magiques publiques :** Oui, toutes les méthodes magiques PHP doivent obligatoirement être déclarées en `public`.
