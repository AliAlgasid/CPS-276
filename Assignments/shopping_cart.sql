
CREATE TABLE Customer (
    id INT AUTO_INCREMENT PRIMARY KEY,
    firstname VARCHAR(50),
    lastname VARCHAR(50),
    address VARCHAR(100),
    city VARCHAR(50),
    state VARCHAR(50),
    zip VARCHAR(20),
    phone VARCHAR(20),
    email VARCHAR(100),
    password VARCHAR(255)
) ENGINE=InnoDB;


CREATE TABLE Product_Group (
    id INT AUTO_INCREMENT PRIMARY KEY,
    groupname VARCHAR(100),
    imagefolder VARCHAR(255)
) ENGINE=InnoDB;



CREATE TABLE Product (
    id INT AUTO_INCREMENT PRIMARY KEY,
    groupid INT,
    productname VARCHAR(100),
    productprice VARCHAR(20),
    image VARCHAR(255),
    description TEXT
) ENGINE=InnoDB;


CREATE TABLE Orders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    timestamp INT,
    customerid INT
) ENGINE=InnoDB;

CREATE TABLE Order_Info (
    id INT AUTO_INCREMENT PRIMARY KEY,
    orderid INT,
    productid INT,
    amount INT
) ENGINE=InnoDB;
