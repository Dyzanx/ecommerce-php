CREATE DATABASE ecommerce;
USE ecommerce;

CREATE TABLE IF NOT EXISTS users(
    id int NOT NULL PRIMARY KEY AUTO_INCREMENT,
    rol varchar(100),
    name varchar(150),
    surname varchar(150),
    email varchar(255) UNIQUE,
    password varchar(100),
    image varchar(255)
)Engine=InnoDB;

INSERT INTO users VALUES(NULL, 'admin', 'admin', 'ecommerce', 'admin@ecommerce.com', "contraseña", NULL);


CREATE TABLE IF NOT EXISTS categories(
    id int NOT NULL PRIMARY KEY AUTO_INCREMENT,
    name varchar(255)
)Engine=InnoDB;

INSERT INTO categories VALUES(NULL, 'Manga corta');
INSERT INTO categories VALUES(NULL, 'Manga larga');
INSERT INTO categories VALUES(NULL, 'Tirantes');
INSERT INTO categories VALUES(NULL, 'Sudaderas');


CREATE TABLE IF NOT EXISTS products(
    id int NOT NULL PRIMARY KEY AUTO_INCREMENT,
    category_id int(255),
    name varchar(255) NOT NULL,
    description text,
    price float(100, 2) NOT NULL,
    stock int(100) NOT NULL,
    offer varchar(2),
    image varchar(255) NOT NULL,
    date date NOT NULL,
    
    CONSTRAINT fk_products_categories FOREIGN KEY (category_id) REFERENCES categories(id)
)Engine=InnoDB;


CREATE TABLE IF NOT EXISTS orders(
    id int NOT NULL PRIMARY KEY AUTO_INCREMENT,
    user_id int(255) NOT NULL,
    country varchar(255) NOT NULL,
    location varchar(255) NOT NULL,
    adress varchar(255) NOT NULL,
    cost float(200, 2) NOT NULL,
    status varchar(100) NOT NULL,
    date date,
    hour time,

    CONSTRAINT fk_orders_users FOREIGN KEY (user_id) REFERENCES users(id)
)Engine=InnoDB;

CREATE TABLE IF NOT EXISTS lines_orders(
    id int NOT NULL PRIMARY KEY AUTO_INCREMENT,
    order_id int(255) NOT NULL,
    product_id int(255) NOT NULL,
    units int(255) NOT NULL,

    CONSTRAINT fk_lines_orders FOREIGN KEY (order_id) REFERENCES orders(id),
    CONSTRAINT fk_lines_products FOREIGN KEY (product_id) REFERENCES products(id)
)Engine=InnoDB;