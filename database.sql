CREATE DATABASE IF NOT EXISTS student_registration
CHARACTER SET utf8mb4
COLLATE utf8mb4_unicode_ci;

USE student_registration;

CREATE TABLE IF NOT EXISTS students (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    age TINYINT UNSIGNED NOT NULL,
    gender ENUM('Male', 'Female') NULL,
    class VARCHAR(50) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

ALTER TABLE students
    ADD COLUMN IF NOT EXISTS gender ENUM('Male', 'Female') NULL AFTER age;