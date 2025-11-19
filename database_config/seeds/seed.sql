-- Aunt Joy Restaurant - Seed Data

USE aunt_joy_db;

-- 1. Ensure roles exist (in case schema.sql not run with INSERT)
INSERT INTO roles (name) VALUES
    ('customer'),
    ('admin'),
    ('sales'),
    ('manager')
ON DUPLICATE KEY UPDATE name = VALUES(name);

-- 2. Basic categories
INSERT INTO categories (name, description) VALUES
    ('Main Dishes', 'Core meals served hot'),
    ('Drinks', 'Cold and hot beverages')
ON DUPLICATE KEY UPDATE description = VALUES(description);

-- 3. Example meals
INSERT INTO meals (category_id, name, description, price, image_path, status)
VALUES
    (1, 'Grilled Chicken Plate', 'Grilled chicken with chips and salad', 6500.00, 'assets/images/uploads/meals/grilled_chicken.jpg', 'in_stock'),
    (2, 'Fresh Mango Juice', 'Chilled mango juice (glass)', 2000.00, 'assets/images/uploads/meals/mango_juice.jpg', 'in_stock');

-- 4. Admin user (password: admin123 in plain text for demo purposes)
-- NOTE: For real apps you should hash with PHP (password_hash) and insert the hash value here.
INSERT INTO users (name, email, password_hash, role_id)
SELECT 'System Admin', 'admin@auntjoy.test', 'admin123', r.id
FROM roles r
WHERE r.name = 'admin'
ON DUPLICATE KEY UPDATE name = VALUES(name);
