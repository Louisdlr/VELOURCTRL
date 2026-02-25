# 🌌 VELOUR CTRL - Cyber Opulence V.2025

<div align="center">

![Version](https://img.shields.io/badge/version-1.0.0-purple)
![PHP](https://img.shields.io/badge/PHP-8.x-777BB4?logo=php)
![MySQL](https://img.shields.io/badge/MySQL-8.x-4479A1?logo=mysql)
![License](https://img.shields.io/badge/license-MIT-green)

**Plateforme e-commerce de streetwear cyberpunk nouvelle génération**

*High-fidelity streetwear for the post-digital age*

[Fonctionnalités](#-fonctionnalités) • [Installation](#-installation) • [Documentation](#-documentation) • [Architecture](#-architecture)

</div>

---

##  Table des matières

- [À propos](#-à-propos)
- [Fonctionnalités](#-fonctionnalités)
- [Technologies utilisées](#-technologies-utilisées)
- [Architecture](#-architecture)
- [Prérequis](#-prérequis)
- [Installation](#-installation)
- [Configuration](#-configuration)
- [Utilisation](#-utilisation)
- [Base de données](#-base-de-données)
- [Sécurité](#-sécurité)
- [API](#-api)
- [Captures d'écran](#-captures-décran)
- [Améliorations futures](#-améliorations-futures)
- [Auteur](#-auteur)
- [License](#-license)

---

##  À propos

**VELOUR CTRL** est une plateforme e-commerce moderne et immersive dédiée au streetwear haut de gamme avec une identité visuelle cyberpunk affirmée. Le projet propose une expérience d'achat complète avec gestion des stocks en temps réel, système de paiement intégré et interface d'administration puissante.

### Vision du projet

Créer une expérience d'achat en ligne qui transcende le commerce traditionnel en combinant :
-  Design avant-gardiste inspiré de l'esthétique cyberpunk
-  Système de transactions sécurisé avec gestion de solde
-  Gestion intelligente des stocks en temps réel
-  Authentification robuste et rôles utilisateurs
-  Panneau d'administration complet

---

##  Fonctionnalités

###  Espace Client

- **Catalogue produits dynamique**
  - Affichage des articles actifs avec filtrage intelligent
  - Pages détaillées avec informations complètes (prix, description, stock)
  - Images et visuels haute qualité

- **Système de panier avancé**
  - Ajout/modification/suppression d'articles
  - Calcul automatique des totaux
  - Gestion des quantités en temps réel
  - Validation de disponibilité avant achat

- **Gestion de compte utilisateur**
  - Inscription et connexion sécurisées
  - Modification du profil (email, mot de passe)
  - Historique des commandes et factures
  - Gestion du solde personnel
  - Visualisation des articles publiés

- **Système de facturation**
  - Génération automatique de factures PDF-friendly
  - Historique complet des achats
  - Détails ligne par ligne des commandes
  - Adresse de facturation personnalisée

###  Espace Vendeur

- **Publication d'articles**
  - Création de nouveaux produits
  - Upload d'images et descriptions
  - Définition des prix
  - Gestion du stock initial
  - Activation/désactivation des articles

- **Gestion de son catalogue**
  - Modification des articles existants
  - Suppression de produits
  - Suivi des ventes

###  Panneau Administrateur

- **Dashboard de contrôle**
  - Vue d'ensemble de l'activité
  - Statistiques en temps réel
  - Accès rapide aux modules

- **Gestion des articles**
  - Vue globale de tous les produits
  - Création/modification/suppression
  - Activation/désactivation en masse
  - Contrôle du stock

- **Gestion des utilisateurs**
  - Liste complète des comptes
  - Visualisation des détails (balance, rôle, statut)
  - Administration des droits
  - Suivi de l'activité

###  Sécurité & Performance

- Transactions atomiques (ACID compliant)
- Gestion optimiste des stocks avec verrouillage
- Validation côté serveur de toutes les entrées
- Protection contre les injections SQL (PDO prepared statements)
- Hashing sécurisé des mots de passe (bcrypt)
- Gestion de sessions sécurisée
- Vérification des droits d'accès à chaque route

---

## Technologies utilisées

### Backend
- **PHP 8.x** - Langage serveur
- **PDO** - Abstraction de base de données
- **Sessions PHP** - Gestion de l'authentification

### Base de données
- **MySQL 8.x** - Système de gestion de base de données relationnelle
- Transactions ACID
- Contraintes d'intégrité référentielle
- Indexes optimisés

### Frontend
- **HTML5** - Structure sémantique
- **CSS3** - Stylisation moderne avec variables CSS
- Design responsive et accessible
- Animations et effets visuels avancés
- Typography personnalisée (Unbounded, Space Mono, Syncopate)

### Architecture
- **MVC Pattern** - Séparation des préoccupations
- **Routing personnalisé** - Gestion des URLs propres
- **Template System** - Système de vues avec layouts
- **RESTful approaches** - API endpoints structurés

### Environnement de développement
- **XAMPP** - Environnement de développement local
- **Apache** - Serveur web
- **phpMyAdmin** - Administration base de données

---

##  Architecture

### Structure du projet

```
VELOUR_CTRL/
│
├── api/                        # Endpoints API (futurs développements)
│   ├── admin.php
│   ├── articles.php
│   ├── cart.php
│   ├── likes.php
│   └── orders.php
│
├── config/                     # Configuration de l'application
│   └── config.php             # Paramètres DB, constantes, helper db()
│
├── database/                   # Scripts et documentation BDD
│   ├── DBConnection.php       # Classe de connexion (alternative)
│   ├── velour_ctrl_db.sql    # Schéma complet de la base
│   ├── seed.sql              # Données de test
│   ├── README.md
│   └── queries/              # Requêtes SQL organisées
│       ├── articles.sql
│       ├── auth.sql
│       ├── cart.sql
│       ├── likes.sql
│       └── orders.sql
│
├── public/                     # Point d'entrée public
│   ├── index.php              # Router principal et logique métier
│   └── assets/
│       └── css/
│           └── style.css      # Styles cyberpunk globaux
│
└── views/                      # Templates et vues
    ├── layout.php             # Template principal (nav, footer)
    ├── home.php               # Page d'accueil / catalogue
    ├── detail.php             # Page détail article
    ├── cart.php               # Panier d'achat
    ├── cart_validate.php      # Validation de commande
    ├── invoice.php            # Affichage facture
    ├── account.php            # Profil utilisateur
    ├── article_new.php        # Création d'article
    ├── edit.php               # Édition d'article
    ├── auth/
    │   ├── login.php
    │   └── register.php
    └── admin/
        ├── dashboard.php      # Dashboard admin
        ├── articles.php       # Gestion articles admin
        └── users.php          # Gestion utilisateurs admin
```

### Modèle de données

```
users                articles              stock
├── id              ├── id               ├── id
├── username        ├── user_id (FK)     ├── article_id (FK) UNIQUE
├── email           ├── name             └── quantity
├── password        ├── description
├── balance         ├── price
├── role            ├── image_url
├── is_active       ├── is_active
└── created_at      └── created_at

invoices                    invoice_items
├── id                     ├── id
├── user_id (FK)           ├── invoice_id (FK)
├── total_amount           ├── article_id (FK)
├── billing_address        ├── quantity
├── billing_city           └── price_at_purchase
├── billing_postal_code
└── created_at

cart                        likes
├── id                     ├── id
├── user_id (FK)           ├── user_id (FK)
├── article_id (FK)        ├── article_id (FK)
└── quantity               └── created_at
```

---

##  Prérequis

Avant de commencer, assurez-vous d'avoir installé :

- **PHP** >= 8.0
  ```bash
  php --version
  ```

- **MySQL** >= 8.0 ou MariaDB >= 10.5
  ```bash
  mysql --version
  ```

- **Apache** ou tout autre serveur web compatible PHP

- **Composer** (optionnel, pour futures dépendances)

### Recommandations

Pour un environnement de développement complet, nous recommandons :
- **XAMPP** (Windows/Mac/Linux) - [Télécharger](https://www.apachefriends.org/)
- **MAMP** (Mac) - [Télécharger](https://www.mamp.info/)
- **Laragon** (Windows) - [Télécharger](https://laragon.org/)

---

##  Installation

### Étape 1 : Cloner ou télécharger le projet

```bash
# Si vous utilisez Git
git clone https://github.com/votre-username/VELOUR_CTRL.git

# Ou téléchargez et extrayez le ZIP dans votre dossier htdocs
# Exemple XAMPP : C:\xampp\htdocs\VELOUR_CTRL
```

### Étape 2 : Créer la base de données

1. Démarrez **Apache** et **MySQL** depuis XAMPP Control Panel

2. Accédez à phpMyAdmin : [http://localhost/phpmyadmin](http://localhost/phpmyadmin)

3. Créez la base de données en important le schéma :
   - Cliquez sur "Nouveau" dans la barre latérale
   - Ou exécutez directement le fichier SQL :
     - Cliquez sur l'onglet "SQL"
     - Copiez/collez le contenu de `database/velour_ctrl_db.sql`
     - Cliquez sur "Exécuter"

4. **(Optionnel)** Ajoutez des données de test :
   - Sélectionnez la base `velour_ctrl_db`
   - Onglet "SQL"
   - Copiez/collez le contenu de `database/seed.sql`
   - Exécutez

### Étape 3 : Configuration de l'application

Ouvrez le fichier `config/config.php` et ajustez si nécessaire :

```php
// Configuration base de données
define('DB_HOST', 'localhost');
define('DB_NAME', 'velour_ctrl_db');  
define('DB_USER', 'root');
define('DB_PASS', '');  // Votre mot de passe MySQL (vide par défaut sur XAMPP)

// URL de base du projet
define('BASE_URL', '/VELOUR_CTRL/public');
```

>  **Important** : Adaptez `BASE_URL` selon votre configuration :
> - XAMPP par défaut : `/VELOUR_CTRL/public`
> - Sous-dossier personnalisé : `/mon-dossier/VELOUR_CTRL/public`
> - Virtual host : `` (chaîne vide)

### Étape 4 : Permissions (Linux/Mac)

```bash
# Donnez les permissions d'écriture si nécessaire
chmod -R 755 VELOUR_CTRL/
chmod -R 777 VELOUR_CTRL/database/  # Pour les logs éventuels
```

### Étape 5 : Accéder à l'application

Ouvrez votre navigateur et accédez à :

```
http://localhost/VELOUR_CTRL/public
```

---

##  Configuration

### Informations de connexion par défaut

#### Compte administrateur (après exécution de seed.sql)
- **Email** : `admin@admin.admin`
- **Mot de passe** : `admin`

>  **Sécurité** : Changez immédiatement ces identifiants en production !

### Configuration avancée

#### Mode développement / production

Dans `config/config.php`, ajustez l'affichage des erreurs :

```php
// MODE DÉVELOPPEMENT
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// MODE PRODUCTION (commentez les lignes ci-dessus et décommentez ci-dessous)
// ini_set('display_errors', 0);
// ini_set('display_startup_errors', 0);
// error_reporting(0);
```

#### Personnalisation des URLs

Le routing est géré dans `public/index.php`. Exemples de routes disponibles :

| Route | Méthode | Description |
|-------|---------|-------------|
| `/` | GET | Page d'accueil / catalogue |
| `/detail/{id}` | GET | Détail d'un article |
| `/cart` | GET | Panier d'achat |
| `/cart/add/{id}` | POST | Ajouter au panier |
| `/cart/validate` | POST | Valider la commande |
| `/login` | GET/POST | Connexion |
| `/register` | GET/POST | Inscription |
| `/account` | GET | Profil utilisateur |
| `/admin` | GET | Dashboard admin |
| `/admin/articles` | GET | Gestion articles |
| `/admin/users` | GET | Gestion utilisateurs |

---

##  Utilisation

### Pour les utilisateurs

#### 1. Inscription et connexion

1. Cliquez sur **Register** dans la navigation
2. Remplissez le formulaire (username, email, password)
3. Connectez-vous avec vos identifiants

#### 2. Navigation du catalogue

- La page d'accueil affiche tous les articles actifs
- Cliquez sur un article pour voir les détails
- Vérifiez le stock disponible avant d'acheter

#### 3. Achat d'articles

1. Sur la page de détail, cliquez sur **Add to Cart**
2. Accédez à votre panier via **Cart** dans le menu
3. Ajustez les quantités si nécessaire
4. Cliquez sur **Valider la commande**
5. Remplissez l'adresse de facturation
6. Confirmez (le solde sera débité automatiquement)

#### 4. Gestion du compte

- Accédez à votre profil via votre nom d'utilisateur
- **Ajouter du solde** : Entrez un montant et validez
- **Modifier profil** : Changez email ou mot de passe
- **Historique** : Consultez vos factures passées

### Pour les vendeurs

#### 1. Créer un article

1. Connectez-vous
2. Cliquez sur **Créer un article** (ou accédez à `/article/new`)
3. Remplissez :
   - Nom du produit
   - Description détaillée
   - Prix (format décimal)
   - URL de l'image
   - Stock initial
   - Statut (actif/inactif)
4. Validez

#### 2. Gérer ses articles

1. Accédez à votre profil (**/account**)
2. Section "Articles publiés" :
   - **Modifier** : Changez les informations
   - **Supprimer** : Retirez définitivement l'article
   - **Activer/Désactiver** : Contrôlez la visibilité

### Pour les administrateurs

#### 1. Accès au panneau admin

- Connectez-vous avec un compte ADMIN
- Cliquez sur **System_Admin** dans la navigation
- Accédez au dashboard

#### 2. Gestion globale des articles

- `/admin/articles` : Vue de tous les produits
- **Créer** : Ajoutez des articles système
- **Toggle Active** : Activez/désactivez rapidement
- **Supprimer** : Retirez des articles (CASCADE sur stock/panier)

#### 3. Gestion des utilisateurs

- `/admin/users` : Liste complète
- Visualisez : username, email, balance, rôle, statut
- Monitorer l'activité des comptes

---

##  Base de données

### Schéma relationnel

La base de données est conçue pour garantir l'intégrité des données avec des contraintes strictes :

#### Contraintes d'intégrité

- **Foreign Keys** : Relations entre tables avec CASCADE/SET NULL
- **UNIQUE** : Évite les doublons (email, username, article_id dans stock)
- **NOT NULL** : Champs obligatoires clairement définis
- **DEFAULT** : Valeurs par défaut pour simplicité

#### Gestion transactionnelle

Le système utilise des **transactions ACID** pour les opérations critiques :

```php
// Exemple : Validation de commande
$pdo->beginTransaction();
try {
    // 1. Vérouillage des articles (FOR UPDATE)
    // 2. Vérification stock + solde
    // 3. Création facture
    // 4. Création invoice_items
    // 5. Décrémentation stock
    // 6. Débit solde
    $pdo->commit();
} catch (Exception $e) {
    $pdo->rollBack();
    // Gestion erreur
}
```

### Scripts SQL utiles

#### Voir le stock disponible
```sql
SELECT a.name, a.price, COALESCE(s.quantity, 0) as stock
FROM articles a
LEFT JOIN stock s ON s.article_id = a.id
WHERE a.is_active = 1
ORDER BY a.created_at DESC;
```

#### Statistiques utilisateurs
```sql
SELECT 
    u.username,
    COUNT(DISTINCT a.id) as articles_posted,
    COUNT(DISTINCT i.id) as total_purchases,
    u.balance
FROM users u
LEFT JOIN articles a ON a.user_id = u.id
LEFT JOIN invoices i ON i.user_id = u.id
GROUP BY u.id;
```

#### Articles les plus vendus
```sql
SELECT 
    a.name,
    SUM(ii.quantity) as total_sold,
    SUM(ii.quantity * ii.price_at_purchase) as revenue
FROM invoice_items ii
JOIN articles a ON a.id = ii.article_id
GROUP BY a.id
ORDER BY total_sold DESC
LIMIT 10;
```

---

##  Sécurité

### Mesures implementées

#### 1. Authentification et autorisation
- ✅ **Hashing de mots de passe** : `password_hash()` avec bcrypt
- ✅ **Vérification sécurisée** : `password_verify()`
- ✅ **Gestion de sessions** : Régénération d'ID à la déconnexion
- ✅ **Contrôle d'accès** : Vérification des rôles (USER/ADMIN)
- ✅ **Propriété des ressources** : Vérification user_id avant modification

#### 2. Injection SQL
- ✅ **Prepared statements** : 100% des requêtes utilisent PDO avec placeholders
- ✅ **Paramètres liés** : `execute($params)` systématique
- ✅ **Échappement automatique** : PDO gère l'échappement

```php
// ✅ BON
$stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
$stmt->execute([$email]);


#### 3. XSS (Cross-Site Scripting)
- ✅ **Échappement de sortie** : `htmlspecialchars()` dans toutes les vues
- ✅ **Content-Type** : Headers appropriés

```php
// Dans les vues
<?= htmlspecialchars($user['username']) ?>
```

### Recommandations pour la production

1. **HTTPS obligatoire** : Certificat SSL/TLS
2. **Variables d'environnement** : Déplacer identifiants BDD dans `.env`
3. **CSRF tokens** : Protéger tous les formulaires
4. **Rate limiting** : Limiter tentatives de connexion
5. **Logs sécurité** : Tracer les actions sensibles
6. **Validation stricte** : Renforcer les validations côté serveur
7. **Headers sécurité** :
   ```php
   header("X-Frame-Options: DENY");
   header("X-Content-Type-Options: nosniff");
   header("X-XSS-Protection: 1; mode=block");
   ```

---

## API

Le dossier `api/` contient des placeholders pour une future API RESTful. Structure prévue :

### Endpoints futurs

| Endpoint | Méthode | Description |
|----------|---------|-------------|
| `/api/articles` | GET | Liste des articles (JSON) |
| `/api/articles/{id}` | GET | Détail article |
| `/api/articles` | POST | Créer article (auth) |
| `/api/cart` | GET | Contenu panier |
| `/api/cart/add` | POST | Ajouter au panier |
| `/api/likes` | POST | Liker un article |
| `/api/orders` | GET | Historique commandes |

### Exemple de réponse JSON

```json
{
  "articles": [
    {
      "id": 1,
      "name": "T-shirt KREED Shadow",
      "price": 29.90,
      "stock": 10,
      "image_url": null,
      "is_active": true
    }
  ],
  "total": 1,
  "page": 1
}
```

---

## Captures d'écran

### Interface utilisateur

#### Page d'accueil - Hero Section
```
┌─────────────────────────────────────────────────────┐
│  VELOUR                              Collection Cart│
│                                                     │
│   ╔═══════════════════════════════════════╗        │
│   ║  CYBER                                ║        │
│   ║  OPULENCE                             ║        │
│   ║  V.2025                               ║        │
│   ║                                       ║        │
│   ║  High-fidelity streetwear for the     ║        │
│   ║  post-digital age.                    ║        │
│   ║                                       ║        │
│   ║  [INIT_SEQUENCE]                      ║        │
│   ╚═══════════════════════════════════════╝        │
│                                                     │
└─────────────────────────────────────────────────────┘
```

#### Catalogue produits
```
┌──────────────────────────────────────────────────┐
│  [ Article 1 ]  [ Article 2 ]  [ Article 3 ]    │
│                                                  │
│  T-shirt KREED   Hoodie URBAN   Void Data        │
│  29.90 €         59.90 €        85.00 €          │
│  Stock: 10       Stock: 15      Stock: 5         │
│                                                  │
│  [VIEW]          [VIEW]         [VIEW]           │
└──────────────────────────────────────────────────┘
```

### Design Highlights

- **Palette Cyberpunk** :
  - Neon Green: `#DCD0FF`
  - Toxic Purple: `#B57BFF`
  - Cyber Cyan: `#E8D5FF`
  - Void (background): `#030303`

-  **Effets visuels** :
  - Mesh gradients en background
  - Grid overlay semi-transparent
  - Glow effects sur textes et boutons
  - Animations au hover
  - Clip-path futuristes sur boutons

-  **Typography** :
  - Display: Unbounded (titres)
  - UI: Space Mono (interface)
  - Logo: Syncopate (branding)

---

##  Améliorations futures

### Fonctionnalités prévues

#### Court terme
- [ ] Système de likes/favoris fonctionnel
- [ ] Pagination du catalogue (50+ articles)
- [ ] Recherche et filtres (prix, catégorie, etc.)
- [ ] Upload d'images direct (vs URL)
- [ ] Notification système (messages flash améliorés)
- [ ] Export PDF réel des factures

#### Moyen terme
- [ ] **API RESTful complète** (JSON responses)
- [ ] **Système de reviews et notes**
- [ ] **Wishlist persistante**
- [ ] **Catégories et tags d'articles**
- [ ] **Multi-images par produit**
- [ ] **Statistiques vendeur** (dashboard personnel)
- [ ] **Historique de prix**

#### Long terme
- [ ] **Paiement réel** (Stripe/PayPal integration)
- [ ] **Multi-devises**
- [ ] **Internationalisation** (i18n: EN/FR/DE)
- [ ] **Mode dark/light toggle**
- [ ] **Progressive Web App** (PWA)
- [ ] **Chat support** (en temps réel)
- [ ] **Système de coupons/promotions**
- [ ] **Notifications push**

### Optimisations techniques

- [ ] Migration vers **architecture MVC stricte**
- [ ] Utilisation d'un **ORM** (ex: Doctrine)
- [ ] **Caching** (Redis/Memcached)
- [ ] **CDN** pour assets statiques
- [ ] **Lazy loading** des images
- [ ] **Compression** et minification
- [ ] **Tests unitaires** (PHPUnit)
- [ ] **CI/CD** pipeline (GitHub Actions)
- [ ] **Docker** containerization
- [ ] **Monitoring** (New Relic, Sentry)

---

## 👨 Auteur

**Projet académique - VELOUR CTRL**

Développé dans le cadre d'un cours de développement web.

- Professeurs et encadrants du cours
- Communauté PHP et MySQL
- Design inspiration : Cyberpunk aesthetics, Brutalism, Y2K revival
- Fonts : Google Fonts (Unbounded, Space Mono, Syncopate)

---

##  License

Ce projet est sous licence **MIT**.

```
MIT License

Copyright (c) 2024 VELOUR CTRL

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.
```

---

**VELOUR CTRL** -

[⬆ Retour en haut](#-velour-ctrl---cyber-opulence-v2025)

</div>
