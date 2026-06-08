CREATE DATABASE IF NOT EXISTS loan_system;
USE loan_system;

CREATE TABLE users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  full_name VARCHAR(120) NOT NULL,
  email VARCHAR(120) NOT NULL UNIQUE,
  phone VARCHAR(30) NOT NULL,
  password VARCHAR(255) NOT NULL,
  role ENUM('admin','borrower') NOT NULL DEFAULT 'borrower',
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE borrower_profiles (
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT NOT NULL UNIQUE,
  national_id VARCHAR(80),
  address VARCHAR(180),
  occupation VARCHAR(120),
  monthly_income DECIMAL(12,2) DEFAULT 0,
  document_name VARCHAR(255),
  FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

CREATE TABLE guarantors (
  id INT AUTO_INCREMENT PRIMARY KEY,
  borrower_id INT NOT NULL,
  full_name VARCHAR(120) NOT NULL,
  phone VARCHAR(30) NOT NULL,
  relationship VARCHAR(60) NOT NULL,
  address VARCHAR(180),
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (borrower_id) REFERENCES users(id) ON DELETE CASCADE
);

CREATE TABLE loans (
  id INT AUTO_INCREMENT PRIMARY KEY,
  borrower_id INT NOT NULL,
  amount DECIMAL(12,2) NOT NULL,
  purpose VARCHAR(120) NOT NULL,
  term_months INT NOT NULL,
  status ENUM('pending','approved','rejected','paid') NOT NULL DEFAULT 'pending',
  admin_note TEXT,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (borrower_id) REFERENCES users(id) ON DELETE CASCADE
);

CREATE TABLE payments (
  id INT AUTO_INCREMENT PRIMARY KEY,
  loan_id INT NOT NULL,
  amount DECIMAL(12,2) NOT NULL,
  paid_at DATE NOT NULL,
  note VARCHAR(180),
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (loan_id) REFERENCES loans(id) ON DELETE CASCADE
);

-- Default admin login:
-- Email: admin@loan.test
-- Password: admin123
INSERT INTO users (full_name, email, phone, password, role)
VALUES (
  'System Admin',
  'admin@loan.test',
  '0700000000',
  '$2y$10$u9v1ENq9cD9G6b3oQFz7dO4MTdYV5uC5hBKFfBawOBUeU/o7S0j4K',
  'admin'
);
