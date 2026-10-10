CREATE DATABASE IF NOT EXISTS nexasecure CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE nexasecure;

CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(150) UNIQUE NOT NULL,
    password_hash VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS contact_messages (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL,
    message TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS threats (
    id INT AUTO_INCREMENT PRIMARY KEY,
    threat_name VARCHAR(150) NOT NULL,
    source VARCHAR(100),
    severity ENUM('Low','Medium','High','Critical') DEFAULT 'Medium',
    status VARCHAR(50) DEFAULT 'Investigating',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO threats(threat_name,source,severity,status) VALUES
('Credential Harvesting','185.22.91.14','Critical','Blocked'),
('Phishing Campaign','mail-node-04','High','Quarantined'),
('Port Scan','10.0.4.91','Medium','Investigating'),
('SQL Injection Attempt','91.203.12.77','Critical','Blocked');
