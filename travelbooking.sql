-- Create Database
CREATE DATABASE travelbooking;
USE travelbooking;

-- Flights Table (ONLY REQUIRED TABLE)
CREATE TABLE flights (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `from` VARCHAR(100) NOT NULL,
    `to` VARCHAR(100) NOT NULL,
    departure_date DATE NOT NULL,
    departure_time TIME NOT NULL,
    price DECIMAL(8,2) NOT NULL,
    available_seats INT NOT NULL,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL
);

CREATE TABLE destinations (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(150),
    starting_price DECIMAL(8,2),
    color VARCHAR(20),
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL
);

CREATE TABLE packages (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(200),
    price DECIMAL(10,2),
    duration_days INT,
    duration_nights INT,
    meal_plan VARCHAR(100),
    type VARCHAR(50),
    emoji VARCHAR(10),
    is_featured BOOLEAN DEFAULT 0,
    is_active BOOLEAN DEFAULT 1,
    destination_id BIGINT UNSIGNED,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL
);

CREATE TABLE testimonials (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    user_id BIGINT UNSIGNED,
    content TEXT,
    location VARCHAR(100),
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL
);

-- Sample Data (for testing search)
INSERT INTO flights (`from`, `to`, departure_date, departure_time, price, available_seats) VALUES
('Kuala Lumpur', 'Penang', '2026-05-01', '08:00:00', 120.00, 50),
('Kuala Lumpur', 'Penang', '2026-05-01', '15:00:00', 130.00, 60),
('Kuala Lumpur', 'Johor Bahru', '2026-05-01', '09:30:00', 150.00, 30),
('Penang', 'Kuala Lumpur', '2026-05-02', '14:00:00', 110.00, 40),
('Kuala Lumpur', 'Langkawi', '2026-05-03', '07:45:00', 200.00, 20);

INSERT INTO destinations (name, starting_price, color) VALUES
('Bali', 899, '#E6A57E'),
('Tokyo', 1999, '#7AA6C2'),
('Paris', 2599, '#BFA5D6'),
('Maldives', 3299, '#80C9C3');

INSERT INTO packages (name, price, duration_days, duration_nights, meal_plan, type, emoji, is_featured, is_active, destination_id) VALUES
('Bali Beach Escape', 899.00, 5, 4, 'Breakfast Only', 'Relaxation', '🏖️', 1, 1, 1),
('Tokyo City Explorer', 1999.00, 7, 6, 'Breakfast and Dinner', 'City Tour', '🗼', 1, 1, 2),
('Paris Romantic Getaway', 2599.00, 6, 5, 'All Inclusive', 'Romantic', '❤️', 0, 1, 3),
('Maldives Luxury Retreat', 3299.00, 8, 7, 'All Inclusive', 'Luxury', '🌴', 1, 1, 4);

INSERT INTO testimonials (user_id,  content, location)
VALUES
(1,'Amazing trip! Everything was perfectly organized.','Malaysia'),
(1,'Best travel experience ever!','Singapore'),
(1,'Highly recommended travel packages.','Thailand');