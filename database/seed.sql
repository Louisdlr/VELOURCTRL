-- USERS
INSERT INTO users (username, email, password, balance, role, is_active)
VALUES (
    'testuser',
    'test@test.com',
    '$2y$10$abcdefghijklmnopqrstuv', -- fake hash
    100.00,
    'USER',
    1
);

-- ARTICLES
INSERT INTO articles (name, description, price, image_url, is_active)
VALUES (
    'T-Shirt VELOUR',
    'T-Shirt officiel VEØUR_CRTL',
    29.99,
    'tshirt.jpg',
    1
);

-- STOCK
INSERT INTO stock (article_id, quantity)
VALUES (1, 10);
