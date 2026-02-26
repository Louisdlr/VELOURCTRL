CREATE DATABASE IF NOT EXISTS velour_ctrl_db;
USE velour_ctrl_db;

-- =========================
-- USERS
-- =========================
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    balance DECIMAL(10,2) DEFAULT 0.00,
    role ENUM('USER','ADMIN') DEFAULT 'USER',
    is_active TINYINT(1) DEFAULT 1,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);

-- =========================
-- ARTICLES
-- =========================
CREATE TABLE IF NOT EXISTS articles (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NULL,
    name VARCHAR(100) NOT NULL,
    description TEXT NOT NULL,
    price DECIMAL(10,2) NOT NULL,
    image_url VARCHAR(255),
    is_active TINYINT(1) DEFAULT 1,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_articles_user
      FOREIGN KEY (user_id) REFERENCES users(id)
      ON DELETE SET NULL
);

-- =========================
-- STOCK
-- =========================
CREATE TABLE IF NOT EXISTS stock (
    id INT AUTO_INCREMENT PRIMARY KEY,
    article_id INT NOT NULL UNIQUE,
    quantity INT NOT NULL,
    CONSTRAINT fk_stock_article
      FOREIGN KEY (article_id) REFERENCES articles(id)
      ON DELETE CASCADE
);

-- =========================
-- CART
-- =========================
CREATE TABLE IF NOT EXISTS cart (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    article_id INT NOT NULL,
    quantity INT NOT NULL,
    CONSTRAINT fk_cart_user
      FOREIGN KEY (user_id) REFERENCES users(id)
      ON DELETE CASCADE,
    CONSTRAINT fk_cart_article
      FOREIGN KEY (article_id) REFERENCES articles(id)
      ON DELETE CASCADE,
    UNIQUE (user_id, article_id)
);

-- =========================
-- INVOICES
-- =========================
CREATE TABLE IF NOT EXISTS invoices (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    total_amount DECIMAL(10,2) NOT NULL,
    billing_address VARCHAR(255) NOT NULL,
    billing_city VARCHAR(100) NOT NULL,
    billing_postal_code VARCHAR(20) NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_invoices_user
      FOREIGN KEY (user_id) REFERENCES users(id)
      ON DELETE CASCADE
);

-- =========================
-- INVOICE ITEMS
-- =========================
CREATE TABLE IF NOT EXISTS invoice_items (
    id INT AUTO_INCREMENT PRIMARY KEY,
    invoice_id INT NOT NULL,
    -- On garde l'historique des factures même si un article est supprimé
    article_id INT NULL,
    quantity INT NOT NULL,
    price_at_purchase DECIMAL(10,2) NOT NULL,
    CONSTRAINT fk_items_invoice
      FOREIGN KEY (invoice_id) REFERENCES invoices(id)
      ON DELETE CASCADE,
    CONSTRAINT fk_items_article
      FOREIGN KEY (article_id) REFERENCES articles(id)
      ON DELETE SET NULL
);

-- =========================
-- LIKES
-- =========================
CREATE TABLE IF NOT EXISTS likes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    article_id INT NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_likes_user
      FOREIGN KEY (user_id) REFERENCES users(id)
      ON DELETE CASCADE,
    CONSTRAINT fk_likes_article
      FOREIGN KEY (article_id) REFERENCES articles(id)
      ON DELETE CASCADE,
    UNIQUE (user_id, article_id)
);