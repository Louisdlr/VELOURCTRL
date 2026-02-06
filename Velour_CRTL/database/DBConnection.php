<?php
namespace Database;

use PDO;
use PDOException;

class DBConnection {

    private string $dbname;
    private string $host;
    private string $user;
    private string $password;
    private ?PDO $pdo = null;
    private int $port = 3306;

    public function __construct(
        string $dbname,
        string $host = 'localhost',
        string $user = 'root',
        string $password = '',
        int $port = 3306
    ) {
        $this->dbname = $dbname;
        $this->host = $host;
        $this->user = $user;
        $this->password = $password;
        $this->port = $port;
    }

    // Connexion PDO (Singleton)
    public function getPDO(): PDO
    {
        if ($this->pdo === null) {
            try {
                $dsn = "mysql:dbname={$this->dbname};host={$this->host};port={$this->port};charset=utf8mb4";
                
                $this->pdo = new PDO(
                    $dsn,
                    $this->user,
                    $this->password,
                    [
                        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
                        PDO::ATTR_EMULATE_PREPARES => false,
                        PDO::MYSQL_ATTR_INIT_COMMAND => 'SET CHARACTER SET utf8mb4',
                    ]
                );
                
                error_log("Connexion BDD réussie", 3, dirname(__FILE__) . '/db.log');
                
            } catch (PDOException $e) {
                error_log("Connexion BDD échouée: " . $e->getMessage(), 3, dirname(__FILE__) . '/db.log');
                throw new PDOException("Erreur connexion BDD");
            }
        }
        return $this->pdo;
    }

    // Fermer la connexion
    public function closeConnection(): void
    {
        $this->pdo = null;
    }

    // Vérifier si connecté
    public function isConnected(): bool
    {
        return $this->pdo !== null;
    }

    // Exécuter requête (Prepared Statement - sécurité SQL Injection)
    public function executeQuery(string $sql, array $params = []): \PDOStatement
    {
        try {
            $stmt = $this->getPDO()->prepare($sql);
            $stmt->execute($params);
            return $stmt;
        } catch (PDOException $e) {
            error_log("Erreur requête: " . $e->getMessage(), 3, dirname(__FILE__) . '/db.log');
            throw new PDOException("Erreur exécution requête");
        }
    }

    // Récupérer une ligne
    public function fetchOne(string $sql, array $params = []): ?object
    {
        $stmt = $this->executeQuery($sql, $params);
        return $stmt->fetch() ?: null;
    }

    // Récupérer toutes les lignes
    public function fetchAll(string $sql, array $params = []): array
    {
        $stmt = $this->executeQuery($sql, $params);
        return $stmt->fetchAll() ?: [];
    }

    // Dernier ID inséré
    public function getLastInsertId(): string
    {
        return $this->getPDO()->lastInsertId();
    }
}