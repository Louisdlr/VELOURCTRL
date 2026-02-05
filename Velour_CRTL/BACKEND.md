# Documentation Back-end E-Commerce

## 🏗️ Architecture MVC

### Structure générale
```
MVC (Model-View-Controller)
├── Models      → Gestion des données (BDD)
├── Views       → Templates d'affichage
├── Controllers → Logique métier
└── Router      → Gestion des routes
```

## 🔌 Connexion à la base de données

**Fichier** : `database/DBConnection.php`

```php
// Configuration dans public/index.php
define('DB_NAME', "e_commerce");
define('DB_HOST', "127.0.0.1");
define('DB_USER', "root");
define('DB_PASSWORD', "");
```

**Utilisation** :
```php
$db = new Database\DBConnection(DB_NAME, DB_HOST, DB_USER, DB_PASSWORD);
$pdo = $db->getPDO(); // Retourne une instance PDO
```

## 📦 Models

**Fichier parent** : `app/models/Model.php`

### Méthodes disponibles dans tous les Models

| Méthode | Description | Exemple |
|---------|-------------|---------|
| `all()` | Récupère tous les enregistrements | `$user->all()` |
| `findById($id)` | Trouve par ID | `$user->findById(1)` |
| `findByColumn($value, $column)` | Trouve par colonne | `$user->findByColumn('email@test.com', 'email')` |
| `create($data)` | Crée un enregistrement | `$user->create(['email' => '...'])` |
| `update($id, $data)` | Met à jour | `$user->update(1, ['name' => '...'])` |
| `destroy($id)` | Supprime | `$user->destroy(1)` |
| `query($sql, $params, $single)` | Requête personnalisée | `$user->query("SELECT...", [1])` |

### Models existants

#### User (`app/models/User.php`)
- Table : `users`
- Méthodes spécifiques :
  - `getById($id)` : Récupère un utilisateur par ID
  - `destroyUser($id)` : Supprime un utilisateur
  - `changeRole($id, $role)` : Change le rôle
  - `searchUserByEmail($search)` : Recherche par email
  - `updateMdp($id, $data)` : Met à jour le mot de passe
  - `createAddress($id, $data)` : Crée une adresse

#### Product (`app/models/Product.php`)
- Table : `products`
- Méthodes spécifiques :
  - `getProductsByLastAdd()` : 3 derniers produits ajoutés
  - `searchProductByNameAndCategory($search, $category)` : Recherche multicritère
  - `getRandomProductsByCategory($category)` : 3 produits aléatoires par catégorie

#### Category (`app/models/Category.php`)
- Table : `categories`
- Méthodes spécifiques :
  - `destroyCategory($id)`
  - `searchCategory($search)`

#### Order (`app/models/Order.php`)
- Table : `orders`
- Méthodes spécifiques :
  - `getOrders()` : Tous les orders avec jointure users
  - `getOrderById($id)` : Order par ID avec user
  - `getProductByOrder($id)` : Produits d'une commande
  - `acceptOrder($id)` : Change statut à 1
  - `rejectOrder($id)` : Change statut à 3
  - `validateOrder($id)` : Change statut à 2
  - `archive($id)` : Change statut à 4
  - `isArchived()` : Orders archivées (statut 3 ou 4)
  - `searchOrder($search, $status)` : Recherche avec filtres
  - `getUserOrders($id)` : Commandes d'un utilisateur

#### Cart (`app/models/Cart.php`)
- Table : `products`
- Méthodes : `getCart($ids)` : Récupère produits du panier

#### Address (`app/models/Address.php`)
- Table : `address`
- Méthodes : `find_adress($id)` : Adresses d'un user

#### OrderProduct (`app/models/OrderProduct.php`)
- Table : `order_products`
- Table de liaison orders ↔ products

## 🎮 Controllers

**Fichier parent** : `app/controllers/Controller.php`

### Méthodes disponibles

| Méthode | Description |
|---------|-------------|
| `view($path, $params)` | Affiche une vue avec layout |
| `display($path, $params)` | Affiche sans layout |
| `getDB()` | Retourne l'objet DBConnection |
| `isAdmin()` | Vérifie si user est admin |

### Controllers existants

1. **UserController** : Gestion utilisateurs (inscription, modification, adresses)
2. **ProductController** : Affichage produits
3. **CartController** : Gestion panier
4. **HomepageController** : Page d'accueil, recherche
5. **OrderController** : Création commandes
6. **UserManagementController** : Admin - gestion users
7. **ProductManagementController** : Admin - gestion produits
8. **CategoryManagementController** : Admin - gestion catégories
9. **OrderManagementController** : Admin - gestion commandes
10. **UserOrderController** : Historique commandes user
11. **ConnectionController** : Login/logout

## 🛣️ Routing

**Fichier** : `routes/Router.php`

### Définir une route

```php
// GET
$router->get('/chemin', 'App\controllers\NomController@methode');

// POST
$router->post('/chemin', 'App\controllers\NomController@methode');

// Route avec paramètre
$router->get('/product/:id', 'App\controllers\ProductController@show');
```

### Routes actuelles

Voir `public/index.php` lignes 15-80 pour toutes les routes définies.

**Exemples** :
- `/login` → Affiche formulaire login
- `/homepage` → Page d'accueil
- `/product/:id` → Fiche produit
- `/cart` → Panier
- `/productManagement` → Admin produits

## 🔒 Sessions

Démarrage automatique dans le constructeur de `Controller.php`

```php
$_SESSION['auth'] = 1;  // User connecté et admin
$_SESSION['auth'] = 2;  // User connecté normal
```

## 📝 Views

**Emplacement** : `views/`

### Structure
```
views/
├── layout.php           # Template principal
├── auth/               # Login, inscription
├── cart/               # Panier
├── homepage/           # Accueil
├── product/            # Fiche produit
├── user/               # Compte utilisateur
├── productManagement/  # Admin produits
├── categoryManagement/ # Admin catégories
├── orderManagement/    # Admin commandes
└── userManagement/     # Admin users
```

### Utilisation dans controller

```php
// Avec layout
$this->view('homepage.index', compact('products'));

// Sans layout
$this->display('homepage.index', compact('products'));
```

## 🔧 Configuration

### Composer autoload (PSR-4)

```json
{
    "autoload": {
        "psr-4": {
            "Router\\": "routes/",
            "App\\": "app/",
            "Database\\": "database"
        }
    }
}
```

Après modification : `composer dump-autoload`

## ⚠️ Points d'attention

### À faire en Phase 3 (Base de données)
1. Ajouter les clés étrangères
2. Définir les contraintes CASCADE
3. Optimiser les index
4. Revoir la table `client_address` (redondante)

### Sécurité à améliorer
1. Protection CSRF sur les formulaires
2. Validation des données côté serveur
3. Échappement des sorties
4. Limitation des tentatives de connexion

### Bonnes pratiques
- Toujours utiliser les requêtes préparées (déjà en place)
- Hasher les mots de passe avec `password_hash()` (déjà en place)
- Vérifier les droits avant les actions admin

## 🚀 Prochaines étapes

1. **Phase 2** : Définir la direction artistique
2. **Phase 3** : Créer la nouvelle BDD avec contraintes
3. **Phase 4** : Développer l'API si nécessaire
4. **Phase 5** : Créer le front-end digital et excentrique
