# Guide de Contribution - VELOUR CTRL

Merci de votre intérêt pour contribuer à **VELOUR CTRL** ! Ce document vous guidera à travers le processus de contribution.

---

## Table des matières

- [Code de conduite](#code-de-conduite)
- [Comment contribuer](#comment-contribuer)
- [Standards de code](#standards-de-code)
- [Workflow Git](#workflow-git)
- [Rapport de bugs](#rapport-de-bugs)
- [Propositions de fonctionnalités](#propositions-de-fonctionnalités)
- [Pull Requests](#pull-requests)
- [Style de commits](#style-de-commits)

---

## Code de conduite

### Notre engagement

En participant à ce projet, vous vous engagez à :

- Être respectueux et inclusif
- Accepter les critiques constructives
- Se concentrer sur ce qui est meilleur pour la communauté
- Faire preuve d'empathie envers les autres contributeurs

### Comportements inacceptables

- Harcèlement ou discrimination
- Commentaires offensants
- Trolling ou insultes
- Violation de la vie privée

---

## Comment contribuer

Il existe plusieurs façons de contribuer au projet :

### 1. Signaler des bugs
Consultez la section [Rapport de bugs](#rapport-de-bugs)

### 2. Proposer des fonctionnalités
Consultez la section [Propositions de fonctionnalités](#propositions-de-fonctionnalités)

### 3. Améliorer la documentation
- Corriger des typos
- Clarifier des explications
- Ajouter des exemples
- Traduire la documentation

### 4. Contribuer au code
- Corriger des bugs
- Implémenter de nouvelles fonctionnalités
- Optimiser les performances
- Améliorer l'accessibilité

### 5. Design et UX
- Améliorer l'interface
- Proposer des prototypes
- Optimiser l'expérience utilisateur

---

## Standards de code

### PHP

#### Style général
```php
<?php
// PSR-12 compliant

namespace App\Controllers;

use PDO;
use Exception;

class ArticleController
{
    private PDO $pdo;
    
    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }
    
    public function getAll(): array
    {
        $stmt = $this->pdo->query("SELECT * FROM articles WHERE is_active = 1");
        return $stmt->fetchAll();
    }
}
```

#### Conventions de nommage
- **Classes** : `PascalCase` (ex: `ArticleController`)
- **Méthodes** : `camelCase` (ex: `getUserById`)
- **Variables** : `camelCase` (ex: `$userName`)
- **Constantes** : `SCREAMING_SNAKE_CASE` (ex: `DB_HOST`)
- **Fonctions** : `snake_case` (ex: `require_login`)

#### Sécurité
```php
// TOUJOURS utiliser prepared statements
$stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
$stmt->execute([$userId]);

// TOUJOURS échapper les sorties
<?= htmlspecialchars($user['username']) ?>

// TOUJOURS valider les entrées
$email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
if (!$email) {
    throw new InvalidArgumentException("Email invalide");
}
```

### CSS

#### Organisation
```css
/* 1. Variables */
:root {
    --color-primary: #B57BFF;
    --spacing-unit: 8px;
}

/* 2. Reset et base */
* { box-sizing: border-box; }

/* 3. Composants */
.btn { /* ... */ }

/* 4. Layout */
.grid { /* ... */ }

/* 5. Utilities */
.hidden { display: none; }
```

#### Naming (BEM-like)
```css
.card { }
.card__header { }
.card__body { }
.card--featured { }
```

### SQL

#### Format
```sql
-- Lisible et indenté
SELECT 
    u.id,
    u.username,
    COUNT(a.id) AS article_count
FROM users u
LEFT JOIN articles a ON a.user_id = u.id
WHERE u.is_active = 1
GROUP BY u.id
ORDER BY article_count DESC
LIMIT 10;
```

#### Conventions
- Mots-clés SQL en **MAJUSCULES**
- Noms de tables/colonnes en **snake_case**
- Indentation cohérente
- Toujours utiliser des alias explicites

---

## Workflow Git

### 1. Fork et clone

```bash
# Fork le repo sur GitHub, puis :
git clone https://github.com/votre-username/VELOUR_CTRL.git
cd VELOUR_CTRL
```

### 2. Créer une branche

```bash
# Créez une branche descriptive
git checkout -b feature/nom-fonctionnalite
# ou
git checkout -b fix/nom-bug
```

#### Convention de nommage des branches
- `feature/` : Nouvelle fonctionnalité
- `fix/` : Correction de bug
- `docs/` : Documentation
- `style/` : Changements cosmétiques
- `refactor/` : Refactoring
- `test/` : Ajout de tests
- `chore/` : Maintenance

### 3. Développer

```bash
# Faites vos modifications...
# Testez localement

# Ajoutez vos fichiers
git add .

# Commitez (voir style de commits ci-dessous)
git commit -m "feat: ajout du système de likes"
```

### 4. Push et Pull Request

```bash
# Pushez votre branche
git push origin feature/nom-fonctionnalite

# Créez une Pull Request sur GitHub
```

---

## Rapport de bugs

### Avant de signaler

1. Vérifiez que le bug n'a pas déjà été signalé
2. Testez sur la dernière version
3. Isolez le problème (étapes minimales pour reproduire)

### Template de rapport

```markdown
## Description du bug
Une description claire et concise du problème.

## Étapes pour reproduire
1. Aller sur la page '...'
2. Cliquer sur '...'
3. Faire défiler jusqu'à '...'
4. Voir l'erreur

## Comportement attendu
Ce qui devrait se passer normalement.

## Comportement actuel
Ce qui se passe réellement.

## Captures d'écran
Si applicable, ajoutez des captures d'écran.

## Environnement
- OS: [ex: Windows 11]
- Navigateur: [ex: Chrome 120]
- PHP: [ex: 8.2]
- MySQL: [ex: 8.0.35]

## Informations supplémentaires
Tout contexte additionnel utile.
```

---

## Propositions de fonctionnalités

### Avant de proposer

1. Vérifiez la [roadmap](README.md#améliorations-futures)
2. Assurez-vous que la fonctionnalité n'existe pas déjà
3. Réfléchissez à la valeur ajoutée

### Template de proposition

```markdown
## Problème à résoudre
Décrivez le problème ou le besoin utilisateur.

## Solution proposée
Décrivez votre idée de solution.

## Alternatives considérées
Quelles autres approches avez-vous envisagées ?

## Complexité estimée
- [ ] Simple (quelques heures)
- [ ] Moyenne (quelques jours)
- [ ] Complexe (semaines)

## Impact utilisateur
Comment cela améliore-t-il l'expérience utilisateur ?
```

---

## Pull Requests

### Checklist avant soumission

- [ ] **Code** : Respecte les standards de code
- [ ] **Tests** : Fonctionne localement sans erreur
- [ ] **Documentation** : README mis à jour si nécessaire
- [ ] **Commits** : Messages clairs et descriptifs
- [ ] **Dépendances** : Aucune dépendance inutile ajoutée
- [ ] **Sécurité** : Pas de failles introduites
- [ ] **Performance** : Pas de régression de performance

### Template de Pull Request

```markdown
## Type de changement
- [ ] Bug fix (non-breaking change)
- [ ] Nouvelle fonctionnalité (non-breaking change)
- [ ] Breaking change (modification incompatible)
- [ ] Documentation

## Description
Décrivez vos changements en détail.

## Motivation et contexte
Pourquoi ce changement est-il nécessaire ? Quel problème résout-il ?

## Comment a-t-il été testé ?
Décrivez les tests effectués.

## Screenshots (si applicable)
Ajoutez des captures avant/après.

## Checklist
- [ ] Mon code respecte les standards du projet
- [ ] J'ai commenté les parties complexes
- [ ] J'ai mis à jour la documentation
- [ ] Mes changements ne génèrent aucun warning
- [ ] J'ai testé tous les cas limites
```

### Processus de review

1. Un mainteneur reviewera votre PR
2. Des changements peuvent être demandés
3. Une fois approuvée, la PR sera mergée
4. Votre contribution sera créditée dans le CHANGELOG

---

## Style de commits

Nous utilisons la convention [Conventional Commits](https://www.conventionalcommits.org/).

### Format

```
<type>(<scope>): <subject>

<body>

<footer>
```

### Types

- `feat`: Nouvelle fonctionnalité
- `fix`: Correction de bug
- `docs`: Documentation uniquement
- `style`: Formatting, missing semi colons, etc
- `refactor`: Refactoring de code
- `perf`: Amélioration de performance
- `test`: Ajout de tests
- `chore`: Maintenance, dépendances, etc
- `security`: Correctif de sécurité

### Exemples

```bash
# Simple
git commit -m "feat: ajout du système de likes"

# Avec scope
git commit -m "fix(cart): correction calcul du total avec réduction"

# Avec body
git commit -m "feat(admin): ajout statistiques avancées

Ajout d'un dashboard avec :
- Graphiques de ventes
- Top produits
- Revenus par mois"

# Breaking change
git commit -m "feat!: refonte du système d'authentification

BREAKING CHANGE: l'ancien système de tokens est obsolète"
```

---

## Tests

### Avant de soumettre une PR

#### Tests manuels
1. Testez le happy path (cas nominal)
2. Testez les cas limites (valeurs nulles, vides, négatives)
3. Testez les permissions (utilisateur non connecté, user, admin)
4. Testez sur différents navigateurs

#### Tests de non-régression
1. Parcourez les principales fonctionnalités
2. Vérifiez qu'aucune feature existante n'est cassée

### Tests futurs (à implémenter)

```php
// Exemple de test unitaire (PHPUnit)
public function testUserCannotBuyWithInsufficientBalance()
{
    $user = $this->createUser(['balance' => 10.00]);
    $article = $this->createArticle(['price' => 50.00]);
    
    $response = $this->postJson('/cart/validate', [
        'user_id' => $user->id,
        'items' => [['article_id' => $article->id, 'qty' => 1]]
    ]);
    
    $response->assertStatus(400);
    $response->assertJson(['error' => 'Solde insuffisant']);
}
```

---

## Priorités actuelles

Consultez les [issues GitHub](https://github.com/votre-username/VELOUR_CTRL/issues) pour voir les besoins actuels.

### Domaines recherchés

- **Sécurité** : CSRF tokens, rate limiting
- **Tests** : Mise en place de PHPUnit
- **Responsive** : Optimisation mobile
- **Accessibilité** : ARIA, navigation clavier
- **Performance** : Caching, optimisation requêtes
- **i18n** : Internationalisation

---

## Contact

- **Issues** : [GitHub Issues](https://github.com/votre-username/VELOUR_CTRL/issues)
- **Discussions** : [GitHub Discussions](https://github.com/votre-username/VELOUR_CTRL/discussions)
- **Email** : maintainer@velour-ctrl.com

---

## Remerciements

Merci à tous les contributeurs qui rendent ce projet meilleur !

### Contributeurs principaux
- @votre-username - Créateur et mainteneur principal

---

<div align="center">

**Ensemble, construisons la plateforme cyberpunk ultime**

[Retour en haut](#guide-de-contribution---velour-ctrl)

</div>
