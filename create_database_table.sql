CREATE DATABASE IF NOT EXISTS cricket_registration;
USE cricket_registration;

CREATE TABLE IF NOT EXISTS players (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    age INT NOT NULL,
    email VARCHAR(255) NOT NULL,
    phone VARCHAR(15) NOT NULL,
    college_name VARCHAR(255) NOT NULL,
    registration_number VARCHAR(255) NOT NULL,
    address TEXT NOT NULL,
    bonafide_certificate VARCHAR(255) NOT NULL
);
