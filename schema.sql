CREATE DATABASE cema;

USE cema;

CREATE TABLE programs(
    program_id VARCHAR(100) PRIMARY KEY,
    program_name VARCHAR(100) NOT NULL,
    program_description TEXT,
    created_by VARCHAR(20) DEFAULT 'admin',
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE clients (
    id_number varchar(20) PRIMARY KEY,
    full_name varchar(255) NOT NULL,
    gender varchar(10) NOT NULL,
    date_of_birth date,
    deceased boolean DEFAULT false,
    decease_date_time datetime,
    marital_status varchar(20),
    multiple_birth boolean DEFAULT false,
    phone_number1 varchar(20),
    phone_number2 varchar(20),
    email varchar(200),
    nationality varchar(50),
    physical_address varchar(255),
    permanent_address varchar(255),
    photo_url varchar(255),
    next_of_kin_name varchar(255),
    next_of_kin_relationship varchar(50),
    next_of_kin_phone_number varchar(20),
    next_of_kin_email varchar(200),
    next_of_kin_physical_address varchar(255),
    next_of_kin_permanent_address varchar(255),
    created_at datetime DEFAULT CURRENT_TIMESTAMP,
    created_by varchar(20) DEFAULT 'admin'
);


CREATE TABLE client_programs (
    id INT(20) AUTO_INCREMENT PRIMARY KEY,
    client_id varchar(20) NOT NULL,
    program_id varchar(100) NOT NULL,
    enrollment_date date DEFAULT CURRENT_TIMESTAMP,
    enrolled_by varchar(20)
);


CREATE TABLE users (
    id_number varchar(20) PRIMARY KEY,
    active boolean DEFAULT true,
    full_name varchar(255) NOT NULL,
    gender varchar(10) NOT NULL,
    date_of_birth date,
    deceased boolean DEFAULT false,
    decease_date_time datetime,
    marital_status varchar(20),
    multiple_birth boolean DEFAULT false,
    phone_number1 varchar(20),
    phone_number2 varchar(20),
    email varchar(200),
    nationality varchar(50),
    physical_address varchar(255),
    permanent_address varchar(255),
    photo_url varchar(255),
    passkey text DEFAULT '$2y$10$.16Q.6Wc7gkmPzQTSRDHeOqFdKmN5lTs8ufZxl/m2jZroPpbur0r6', -- DEFAULTS TO 'Password@123'
    token varchar(200),
    token_expiry datetime,
    created_at datetime DEFAULT CURRENT_TIMESTAMP,
    created_by varchar(20) DEFAULT 'admin'
);