# Changelog

Toutes les modifications notables de ce projet sont documentées dans ce fichier.

Le format est basé sur [Keep a Changelog](https://keepachangelog.com/fr/1.0.0/),
et ce projet adhère au [Semantic Versioning](https://semver.org/lang/fr/).

---

## [1.0.0] - 2024-02-25

### Version initiale - Release académique

#### Ajouté
- **Système d'authentification complet**
  - Inscription utilisateur avec validation
  - Connexion sécurisée avec password hashing (bcrypt)
  - Gestion de sessions PHP
  - Déconnexion avec régénération d'ID session

- **Gestion des articles**
  - Création d'articles par les utilisateurs connectés
  - Modification et suppression (propriétaire + admin)
  - Activation/désactivation des articles
  - Upload d'images via URL
  - Système de stock intégré

- **Système de panier intelligent**
  - Ajout/suppression d'articles
  - Gestion des quantités
  - Calcul automatique des totaux
  - Persistance en session
  - Validation de disponibilité en temps réel

- **Gestion des commandes**
  - Validation de panier avec vérifications multiples :
    - Stock disponible (avec verrouillage FOR UPDATE)
    - Solde suffisant
    - Articles actifs uniquement
  - Génération automatique de factures
  - Historique complet des achats
  - Débit automatique du solde utilisateur
  - Transactions ACID compliant

- **Espace utilisateur**
  - Profil personnel avec statistiques
  - Gestion du solde (ajout de fonds)
  - Modification email et mot de passe
  - Historique des factures
  - Visualisation des articles publiés

- **Panneau d'administration**
  - Dashboard avec accès rapide aux modules
  - Gestion globale des articles (CRUD complet)
  - Gestion des utilisateurs (visualisation, monitoring)
  - Activation/désactivation rapide des produits
  - Contrôles d'accès basés sur les rôles

- **Design et UX**
  - Interface cyberpunk immersive
  - Palette de couleurs néon (violet/vert)
  - Effets visuels avancés :
    - Background mesh gradients
    - Grid overlay
    - Glow effects
    - Animations hover
  - Typography personnalisée (Unbounded, Space Mono, Syncopate)
  - Responsive design
  - Navigation intuitive avec indicateurs d'état

- **Base de données**
  - Schéma relationnel complet
  - 7 tables principales (users, articles, stock, cart, invoices, invoice_items, likes)
  - Contraintes d'intégrité référentielle
  - Indexes optimisés
  - Support des transactions
  - Scripts de seed pour données de test

- **Sécurité**
  - Protection contre les injections SQL (PDO prepared statements)
  - Hashing sécurisé des mots de passe
  - Échappement XSS dans toutes les vues
  - Validation côté serveur
  - Contrôles d'autorisation sur toutes les routes sensibles
  - Gestion de la concurrence avec verrouillages optimistes

- **Documentation**
  - README.md professionnel et détaillé
  - Structure du projet documentée
  - Instructions d'installation complètes
  - Guide d'utilisation pour chaque rôle
  - Documentation de la base de données
  - Exemples de requêtes SQL
  - FAQ et troubleshooting

#### Technique
- Architecture MVC simplifiée
- Routing personnalisé dans index.php
- Système de templates avec layouts
- Helper functions (render, require_login, is_admin, require_admin)
- Configuration centralisée
- Gestion d'erreurs structurée

#### Structure
```
VELOUR_CTRL/
├── api/          # Endpoints API futurs
├── config/       # Configuration application
├── database/     # Scripts SQL et documentation
├── public/       # Point d'entrée et assets
└── views/        # Templates et vues
    ├── auth/
    └── admin/
```

---

## [Unreleased] - Fonctionnalités prévues

### À venir (Court terme)
- Système de likes/favoris fonctionnel
- Pagination du catalogue
- Recherche et filtres avancés
- Upload d'images direct (vs URL)
- Export PDF des factures
- Notifications système améliorées

### En réflexion (Moyen terme)
- API RESTful complète (JSON)
- Système de reviews et notes
- Catégories et tags
- Statistiques vendeur détaillées
- Multi-images par produit
- Historique de prix

### Vision long terme
- Intégration paiement réel (Stripe/PayPal)
- Multi-devises et internationalisation
- Progressive Web App (PWA)
- Chat support temps réel
- Système de promotions
- Tests automatisés complets

---

## Légende

- **Ajouté** : Nouvelles fonctionnalités
- **Modifié** : Changements dans les fonctionnalités existantes
- **Corrigé** : Corrections de bugs
- **Sécurité** : Améliorations de sécurité
- **Déprécié** : Fonctionnalités bientôt supprimées
- **Supprimé** : Fonctionnalités retirées
- **Documentation** : Modifications de la documentation
- **Performance** : Optimisations de performance

---

*Pour plus de détails sur chaque version, consultez les [releases GitHub](https://github.com/votre-username/VELOUR_CTRL/releases)*
