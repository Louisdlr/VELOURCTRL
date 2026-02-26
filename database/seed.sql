USE velour_ctrl_db;

INSERT INTO articles (user_id, name, description, price, image_url, is_active)
VALUES
(
  NULL,
  'T-shirt KREED Shadow',
  'T-shirt noir oversized en coton premium 260gsm. Print minimal chrome glitch centré, signature KREED SHADOW. Edition Cyber Opulence.',
  49.90,
  'tshirt_face_velour.webp',
  1
),
(
  NULL,
  'Hoodie URBAN FOG',
  'Hoodie heavyweight 480gsm gris brume. Coupe oversized structurée, broderie ton-sur-ton et détail technique discret. Esprit techwear urbain.',
  89.90,
  'hoodie_face_velour.webp',
  1
),
(
  NULL,
  'Casquette KREED',
  'Casquette structurée noir mat. Broderie minimaliste KREED ton-sur-ton, détail intérieur cryptique. Accessoire signature VELOUR CTRL.',
  25.00,
  'casquette_velour.webp',
  1
);

INSERT INTO stock (article_id, quantity)
SELECT id, 10
FROM articles
WHERE name IN (
  'T-shirt KREED Shadow',
  'Hoodie URBAN FOG',
  'Casquette KREED'
);

INSERT INTO users (username, email, password, role)
VALUES (
  'admin',
  'admin@admin.admin',
  '$2y$10$ZmuQEa.MCujyJpWANR7aFOxVr1KAA2atQhwSUe3Mn3LuosCJTYUBq',
  'ADMIN'
);