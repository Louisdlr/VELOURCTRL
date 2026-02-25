USE velour_ctrl_db;

INSERT INTO articles (user_id, name, description, price, image_url, is_active)
VALUES
(NULL, 'T-shirt KREED Shadow', 'T-shirt noir, coupe oversize, print minimal.', 29.90, NULL, 1),
(NULL, 'Hoodie URBAN FOG', 'Hoodie épais gris, esprit techwear.', 59.90, NULL, 1);

-- Stock (lié par article_id)
INSERT INTO stock (article_id, quantity)
SELECT id, 10
FROM articles
WHERE name IN ('T-shirt KREED Shadow', 'Hoodie URBAN FOG');

INSERT INTO users (username, email, password, role)
VALUES ('admin', 'admin@admin.admin', '$2y$10$ZmuQEa.MCujyJpWANR7aFOxVr1KAA2atQhwSUe3Mn3LuosCJTYUBq', 'ADMIN');