# Projet E-Commerce BTS SIO - Année 2

## Contexte du projet
Projet e-commerce majeur de 2ème année BTS SIO.
Style : **Digital et excentrique**

## Objectifs principaux

### Phase 1 : Nettoyage et consolidation du back-end
- ✅ Intégrer claude.md au projet
- ⏳ Analyser le code back-end existant (controllers, models, routes, database)
- ⏳ Supprimer les éléments front-end inutiles
- ⏳ Garder uniquement le back-end fonctionnel
- ⏳ Vérifier et corriger les problèmes
- ⏳ Documenter l'architecture

### Phase 2 : Direction artistique et planification
- Plan détaillé de l'e-commerce
- Design digital et excentrique
- Maquettes et wireframes

### Phase 3 : Base de données
- Révision/création du schéma BDD
- Optimisation des tables
- Relations et contraintes

### Phase 4 : API
- Création de l'API si nécessaire
- Endpoints RESTful
- Documentation

### Phase 5 : Front-end
- Intégration du design
- Développement des interfaces
- Tests et validation

## Contraintes impératives
- ✅ Explications simples, claires et sûres
- ✅ Commandes basiques, sans risque
- ✅ Niveau débutant adapté
- ✅ Réponses courtes et directes
- ✅ Aucune hypothèse sans preuve
- ✅ Alertes si action incorrecte ou dangereuse

## Architecture actuelle

### Structure back-end
```
app/
├── controllers/
│   ├── CartController.php
│   ├── CategoryManagementController.php
│   ├── connectionController.php
│   ├── Controller.php
│   ├── HomepageController.php
│   ├── orderController.php
│   ├── OrderManagementController.php
│   ├── productController.php
│   ├── productManagementController.php
│   ├── UserController.php
│   ├── UserManagementController.php
│   └── userOrderController.php
├── models/
│   ├── Address.php
│   ├── Cart.php
│   ├── Category.php
│   ├── Model.php
│   ├── Order.php
│   ├── OrderProduct.php
│   ├── Product.php
│   └── User.php
└── Exceptions/
    └── NotFoundException.php

database/
├── DBConnection.php
└── e_commerce.sql

routes/
├── Route.php
└── Router.php
```

## État actuel
**Phase en cours : Phase 1 - Nettoyage du back-end (TERMINÉ ✅)**

**Prochaine phase : Phase 2 - Direction artistique**

## Notes de progression
- [05/02/2026] Création du fichier claude.md
- [05/02/2026] Analyse complète du code back-end
- [05/02/2026] Suppression des fichiers front-end inutiles (template_AMLEO, etc.)
- [05/02/2026] Base de données vidée pour refonte complète
- [05/02/2026] Correction des namespaces incohérents dans tous les Models
- [05/02/2026] Code back-end nettoyé et vérifié

### ✅ Corrections effectuées
1. **Namespaces unifiés** : `Database\DBConnection` dans tous les Models
2. **Fichiers supprimés** : template_AMLEO, fichiers CSS/JS externes, exemples
3. **Structure allégée** : Conservé uniquement le nécessaire pour le back-end
4. **README mis à jour** : Documentation claire du projet

### 🎯 Prêt pour Phase 2
Le back-end est maintenant propre et fonctionnel. En attente de la direction artistique pour planifier le front-end digital et excentrique.


## Questions en attente
_Aucune pour le moment_

## Décisions importantes
_À documenter au fur et à mesure_
