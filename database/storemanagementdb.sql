CREATE DATABASE storemanagementdb;
USE storemanagementdb;
CREATE TABLE Manager (
    manager_id INT NOT NULL AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    PRIMARY KEY (manager_id),
    UNIQUE (email)
);
CREATE TABLE Product (
    price FLOAT NOT NULL,
    product_id INT NOT NULL AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    image VARCHAR(255) NOT NULL,
    brand VARCHAR(255) NOT NULL,
    category VARCHAR(255) NOT NULL,
    manage INT,
    PRIMARY KEY (product_id),
    FOREIGN KEY (manage) REFERENCES Manager(manager_id) ON UPDATE CASCADE ON DELETE
    SET NULL
);
CREATE TABLE Salesman (
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    seller_id INT NOT NULL AUTO_INCREMENT,
    password VARCHAR(255) NOT NULL,
    PRIMARY KEY (seller_id),
    UNIQUE (email)
);
CREATE TABLE Customer (
    address VARCHAR(255) NOT NULL,
    customer_id INT NOT NULL AUTO_INCREMENT,
    name VARCHAR(10) NOT NULL,
    seller_id INT,
    PRIMARY KEY (customer_id),
    FOREIGN KEY (seller_id) REFERENCES Salesman(seller_id) ON UPDATE CASCADE ON DELETE
    SET NULL
);
CREATE TABLE Customer_Phonenumbers (
    customer_id INT NOT NULL,
    phone_numbers INT NOT NULL,
    PRIMARY KEY (customer_id, phone_numbers),
    FOREIGN KEY (customer_id) REFERENCES Customer(customer_id) ON UPDATE CASCADE ON DELETE CASCADE,
    UNIQUE (phone_numbers)
);
CREATE TABLE Bill (
    bill_id INT NOT NULL AUTO_INCREMENT,
    seller_id INT,
    customer_id INT,
    date_time DATETIME NOT NULL,
    PRIMARY KEY (bill_id),
    FOREIGN KEY (seller_id) REFERENCES Salesman(seller_id) ON UPDATE CASCADE ON DELETE
    SET NULL
);
CREATE TABLE Bill_Products (
    bill_id INT NOT NULL,
    product_id INT NOT NULL,
    PRIMARY KEY (bill_id, product_id),
    item_code VARCHAR(10) NOT NULL,
    price FLOAT NOT NULL,
    quantity INT NOT NULL,
    FOREIGN KEY (bill_id) REFERENCES Bill(bill_id) ON UPDATE CASCADE ON DELETE CASCADE,
    FOREIGN KEY (product_id) REFERENCES Product(product_id) ON UPDATE CASCADE ON DELETE CASCADE
);
CREATE TABLE Selection (
    product_id INT NOT NULL,
    customer_id INT NOT NULL,
    PRIMARY KEY (customer_id, product_id),
    FOREIGN KEY (product_id) REFERENCES Product(product_id) ON UPDATE CASCADE ON DELETE CASCADE,
    FOREIGN KEY (customer_id) REFERENCES Customer(customer_id) ON UPDATE CASCADE ON DELETE CASCADE
);
INSERT INTO `Manager` (`name`, `email`, `password`)
VALUES ('manager1', 'manager1@gmail.com', 'admin1'),
    ('manager2', 'manager2@gmail.com', 'admin2');
INSERT INTO `Product` (
        `price`,
        `name`,
        `image`,
        `brand`,
        `category`,
        `manage`
    )
VALUES (
        '100',
        'sope',
        'https://www.solidbackgrounds.com/images/2560x1600/2560x1600-dark-gray-solid-color-background.jpg',
        'brand1',
        'category1',
        '1'
    ),
    (
        '101',
        'sope2',
        'https://www.solidbackgrounds.com/images/2560x1600/2560x1600-dark-gray-solid-color-background.jpg',
        'brand1',
        'category2',
        '2'
    ),
    (
        '110',
        'sope3',
        'https://www.solidbackgrounds.com/images/2560x1600/2560x1600-dark-gray-solid-color-background.jpg',
        'brand2',
        'category2',
        '1'
    ),
    (
        '150',
        'sope4',
        'https://www.solidbackgrounds.com/images/2560x1600/2560x1600-dark-gray-solid-color-background.jpg',
        'brand2',
        'category3',
        '2'
    );
INSERT INTO `Salesman` (`name`, `email`, `password`)
VALUES ('ABC', 'abc@gmail.com', '1234'),
    ('XYZ', 'xyz@gmail.com', '1234'),
    ('PQR', 'pqr@gmail.com', '1234');
INSERT INTO `customer` (`address`, `name`, `seller_id`)
VALUES ('Dhaka', 'mila', '1'),
    ('Dhaka', 'mitu', '2'),
    ('Dhaka', 'maliha', '1'),
    ('Dhaka', 'jamal', '3');
INSERT INTO `Customer_Phonenumbers` (`customer_id`, `phone_numbers`)
VALUES ('1', '0177'),
    ('1', '0179'),
    ('2', '0178');
INSERT INTO `Bill` (`seller_id`, `customer_id`, `date_time`)
VALUES ('1', '1', '2022-10-29 14:56:59'),
    ('2', '1', '2022-11-11 11:12:01'),
    ('1', '1', '2022-11-13 13:23:44');
INSERT INTO `Bill_Products` (
        `bill_id`,
        `product_id`,
        `item_code`,
        `price`,
        `quantity`
    )
VALUES (1, 1, ' aaa ', 100, 2),
    (2, 1, ' abc ', 100, 2),
    (3, 2, ' acd ', 100, 4);
INSERT INTO `Selection`(`product_id`, `customer_id`)
VALUES (1, 1),
    (1, 2),
    (2, 2);