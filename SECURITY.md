# Politique de Sécurité - VELOUR CTRL

## 🛡️ Versions supportées

| Version | Support de sécurité     |
| ------- | ----------------------- |
| 1.0.x   | ✅ Support actif        |
| < 1.0   | ❌ Non supportée        |

---

## 🚨 Signaler une vulnérabilité

La sécurité de **VELOUR CTRL** est notre priorité absolue. Si vous découvrez une vulnérabilité de sécurité, nous vous remercions de nous aider à la résoudre de manière responsable.

### Processus de divulgation responsable

**⚠️ IMPORTANT : Ne créez PAS d'issue publique pour les vulnérabilités de sécurité.**

#### 1. Signalement privé

Envoyez un email à : **security@velour-ctrl.com** (ou à votre email académique)

Incluez dans votre rapport :
- Type de vulnérabilité
- Localisation complète du code/fichier concerné
- Étapes de reproduction détaillées
- Impact potentiel
- Preuve de concept (PoC) si possible
- Suggestions de correctif (optionnel)

#### 2. Délai de réponse

- **24-48h** : Accusé de réception de votre rapport
- **7 jours** : Évaluation initiale et classification
- **30 jours** : Publication d'un correctif (dans la mesure du possible)

#### 3. Coordination

Nous vous tiendrons informé de :
- La validation de la vulnérabilité
- L'avancement du correctif
- La date de publication du patch
- Les crédits dans le CHANGELOG (si souhaité)

### Programme de récompenses

Pour le moment, il n'y a pas de programme de bug bounty financier, mais :
- ✨ Crédit dans le CHANGELOG et SECURITY.md
- 🏆 Reconnaissance publique (avec votre accord)
- 🤝 Invitation à devenir contributeur

---

## 🔒 Mesures de sécurité implémentées

### Authentification et autorisation
- ✅ **Hashing bcrypt** : Tous les mots de passe utilisent `password_hash()` avec bcrypt
- ✅ **Validation stricte** : Vérification des entrées utilisateurs
- ✅ **Contrôle d'accès** : Vérification des rôles (USER/ADMIN) sur routes sensibles
- ✅ **Propriété des ressources** : Vérification user_id avant modification d'articles
- ✅ **Régénération de session** : À la déconnexion pour prévenir la fixation

### Protection contre les injections
- ✅ **PDO Prepared Statements** : 100% des requêtes SQL utilisent des prepared statements
- ✅ **Paramètres liés** : Aucune concaténation directe dans les requêtes
- ✅ **Échappement des sorties** : `htmlspecialchars()` systématique dans les vues

### Gestion des transactions
- ✅ **Transactions ACID** : Rollback automatique en cas d'erreur
- ✅ **Verrouillage pessimiste** : `FOR UPDATE` sur les stocks et soldes
- ✅ **Vérifications multiples** : Stock ET solde avant validation de commande
- ✅ **Atomicité** : Opérations critiques groupées en transactions

### Configuration
- ✅ **Affichage des erreurs** : Désactivable pour la production
- ✅ **Logs séparés** : Séparation des logs applicatifs et système
- ✅ **Connexions persistantes** : Pattern Singleton pour PDO

---

## ⚠️ Vulnérabilités connues et limitations

### Actuellement non implémenté (À corriger avant production)

#### 🔴 Critique

1. **Tokens CSRF manquants**
   - **Risque** : Attaques CSRF sur formulaires POST
   - **Statut** : Non implémenté
   - **Priorité** : HAUTE
   - **Action** : Ajouter tokens CSRF sur tous les formulaires

2. **Rate limiting absent**
   - **Risque** : Attaques par force brute sur login
   - **Statut** : Non implémenté
   - **Priorité** : HAUTE
   - **Action** : Limiter tentatives de connexion (ex: 5/5min)

3. **Headers de sécurité manquants**
   - **Risque** : Clickjacking, XSS, MIME sniffing
   - **Statut** : Non implémenté
   - **Priorité** : HAUTE
   - **Action** : Ajouter X-Frame-Options, X-Content-Type-Options, CSP

#### 🟡 Moyenne

4. **Validation d'email insuffisante**
   - **Risque** : Comptes avec emails invalides
   - **Statut** : Validation basique uniquement
   - **Priorité** : MOYENNE
   - **Action** : Ajouter vérification par email

5. **Pas de 2FA**
   - **Risque** : Compromission de compte
   - **Statut** : Non implémenté
   - **Priorité** : MOYENNE
   - **Action** : Ajouter authentification à deux facteurs

6. **Logs de sécurité incomplets**
   - **Risque** : Difficulté à tracer les attaques
   - **Statut** : Logs minimaux
   - **Priorité** : MOYENNE
   - **Action** : Logger toutes actions sensibles

#### 🟢 Basse

7. **Pas de politique de mots de passe**
   - **Risque** : Mots de passe faibles acceptés
   - **Statut** : Longueur minimale (6) seulement
   - **Priorité** : BASSE
   - **Action** : Complexité, expiration, historique

8. **Sessions sans timeout**
   - **Risque** : Sessions perpétuelles
   - **Statut** : Timeout par défaut PHP
   - **Priorité** : BASSE
   - **Action** : Timeout configurable (ex: 30min)

---

## 🎯 Bonnes pratiques pour les contributeurs

### Lors de l'écriture de code

#### ✅ À FAIRE

```php
// ✅ Toujours utiliser prepared statements
$stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
$stmt->execute([$userId]);

// ✅ Toujours échapper les sorties
echo htmlspecialchars($user['username'], ENT_QUOTES, 'UTF-8');

// ✅ Valider les entrées
$email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
if (!$email) {
    throw new InvalidArgumentException("Email invalide");
}

// ✅ Vérifier les autorisations
if (!is_admin() && $article['user_id'] !== $_SESSION['user']['id']) {
    http_response_code(403);
    exit;
}

// ✅ Utiliser des transactions pour opérations critiques
$pdo->beginTransaction();
try {
    // Opérations...
    $pdo->commit();
} catch (Exception $e) {
    $pdo->rollBack();
    throw $e;
}
```

#### ❌ À ÉVITER

```php
// ❌ JAMAIS de concaténation directe
$query = "SELECT * FROM users WHERE email = '$email'"; // DANGER!

// ❌ JAMAIS afficher directement les entrées utilisateurs
echo $_POST['username']; // XSS!

// ❌ JAMAIS stocker de mots de passe en clair
$pdo->exec("INSERT INTO users (password) VALUES ('{$_POST['password']}')"); // DANGER!

// ❌ JAMAIS faire confiance aux données utilisateurs
$userId = $_GET['user_id']; // Sans validation!
$isAdmin = $_POST['is_admin']; // L'utilisateur se définit admin!
```

### Checklist de sécurité pour Pull Requests

Avant de soumettre une PR, vérifiez :

- [ ] Aucune requête SQL brute (toujours PDO prepared)
- [ ] Toutes les sorties utilisent `htmlspecialchars()`
- [ ] Validation des entrées (type, format, longueur)
- [ ] Vérification des autorisations sur routes sensibles
- [ ] Transactions pour opérations multi-étapes
- [ ] Gestion appropriée des erreurs (pas de stack traces en prod)
- [ ] Pas de credentials hardcodés
- [ ] Pas de `eval()`, `exec()`, `system()` sans validation stricte
- [ ] Pas de `extract()` sur données utilisateurs

---

## 📚 Ressources de sécurité

### Documentation recommandée

- **OWASP Top 10** : [https://owasp.org/www-project-top-ten/](https://owasp.org/www-project-top-ten/)
- **PHP Security Cheat Sheet** : [https://cheatsheetseries.owasp.org/cheatsheets/PHP_Configuration_Cheat_Sheet.html](https://cheatsheetseries.owasp.org/cheatsheets/PHP_Configuration_Cheat_Sheet.html)
- **SQL Injection Prevention** : [https://cheatsheetseries.owasp.org/cheatsheets/SQL_Injection_Prevention_Cheat_Sheet.html](https://cheatsheetseries.owasp.org/cheatsheets/SQL_Injection_Prevention_Cheat_Sheet.html)

### Outils de test

- **SQLMap** : Test d'injections SQL
- **Burp Suite** : Proxy d'interception et tests
- **OWASP ZAP** : Scanner de vulnérabilités web
- **PHPStan / Psalm** : Analyse statique PHP

---

## 🔐 Checklist de déploiement en production

Avant de déployer en production :

### Configuration

- [ ] `display_errors = 0` dans php.ini ou config.php
- [ ] `error_reporting = 0` en production
- [ ] Logs d'erreurs activés dans un fichier séparé
- [ ] HTTPS obligatoire (redirection HTTP → HTTPS)
- [ ] Certificat SSL/TLS valide

### Base de données

- [ ] Utilisateur MySQL dédié (pas root)
- [ ] Permissions MySQL minimales (SELECT, INSERT, UPDATE, DELETE uniquement)
- [ ] Mot de passe MySQL fort (20+ caractères)
- [ ] Base de données non accessible depuis l'extérieur

### Application

- [ ] Changer mot de passe admin par défaut
- [ ] BASE_URL configuré correctement
- [ ] Credentials BDD dans variables d'environnement (pas config.php)
- [ ] Dossiers sensibles protégés (.htaccess)
- [ ] Headers de sécurité configurés
- [ ] Tokens CSRF implémentés
- [ ] Rate limiting activé

### Fichiers

- [ ] Supprimer seed.sql en production
- [ ] Supprimer fichiers de test
- [ ] .gitignore à jour
- [ ] Permissions fichiers correctes (755 dossiers, 644 fichiers)

### Monitoring

- [ ] Logs de sécurité activés
- [ ] Monitoring des erreurs (Sentry, Rollbar, etc.)
- [ ] Alertes sur actions sensibles
- [ ] Backups automatiques de la BDD

---

## 📞 Contact sécurité

- **Email** : security@velour-ctrl.com (ou votre email académique)
- **PGP Key** : [Télécharger la clé publique](#) (si applicable)
- **Response Time** : 24-48 heures

---

## 📝 Historique des incidents

*Aucun incident de sécurité signalé à ce jour.*

### Format de publication

Lorsqu'une vulnérabilité est corrigée, elle sera documentée ici :

```
## [CVE-YYYY-XXXXX] Nom de la vulnérabilité - DATE

**Sévérité** : Critique/Haute/Moyenne/Basse
**Impact** : Description de l'impact
**Versions affectées** : X.X.X
**Correctif** : Version X.X.X
**Crédit** : @username (si divulgation responsable)

### Description
Détails techniques de la vulnérabilité.

### Mitigation
Comment les utilisateurs peuvent se protéger.
```

---

## 🏆 Hall of Fame

Nous remercions les chercheurs en sécurité qui ont contribué à améliorer VELOUR CTRL :

*Liste vide pour le moment - soyez le premier !*

---

<div align="center">

**La sécurité est l'affaire de tous** 🛡️

Merci de contribuer à rendre VELOUR CTRL plus sûr !

</div>
