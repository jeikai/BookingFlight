CREATE DATABASE eProject;
USE eProject;
CREATE TABLE Users(
    userId INT  PRIMARY KEY,
    userName NVARCHAR(20),
    phoneNumber VARCHAR(20) NOT NULL,
    password VARCHAR(100) NOT NULL, 
    address NVARCHAR(100) DEFAULT '',
    role VARCHAR(10) DEFAULT 'user'
);

CREATE TABLE Orders(
    Id_don_hang INT PRIMARY KEY,
    productName VARCHAR(150) NOT NULL,
    price VARCHAR(150) NOT NULL,
    quantity VARCHAR(150) NOT NULL,   
    userId INT,
    orderDate VARCHAR(30),
    description NVARCHAR(1000) DEFAULT '',
    price_sum FLOAT 
);

CREATE TABLE OrderDetails(
    OrderDetailID INT PRIMARY KEY,
    productId INT,
    price FLOAT,
    quantity INT,
    userId INT
);

CREATE TABLE Products(
    productId INT PRIMARY KEY,
    weight float NOT NULL,    
    color varchar(20) NOT NULL,
    price float NOT NULL,
    productName VARCHAR(150) NOT NULL,
    categoryName NVARCHAR(100),
    gender VARCHAR(10),
    brand VARCHAR(50)
);

CREATE TABLE Image_Product(
    productId INT,
    imageUrls VARCHAR(300)
);
INSERT INTO Products(productId, weight, color, price, productName, categoryName, gender, brand) VALUES 
(1659031232 ,5, 'black',5, 'Vali Fendi', 'adult', 'male'  , 'Fendi'),
( 1659031263 ,4, 'black',7, 'Vali Fendi', 'teenager', 'male', 'Fendi'),
( 1659031318 ,8, 'black',8, 'Túi Fossil', 'adult', 'male', 'Fossil'),
( 1659031394 ,3, 'black',6, 'Fossil Vali', 'teenager', 'male', 'Fossil'),
( 1659031445 ,3, 'black',3, 'hublot Bag', 'children', 'male', 'hublot'),
( 1659031534 ,4, 'black',5, 'hublot Bag', 'adult', 'male', 'hublot'),
( 1659031627 ,2, 'black',3, 'Vali Hublot', 'teenager', 'female', 'hublot'),
( 1659031766 ,4, 'black',5, 'samsonite Bag', 'children', 'female', 'Samsonite'),
( 1659031802 ,2, 'black',6, 'samsonite Bag', 'teenager', 'male', 'Samsonite'),
( 1659031889 ,3, 'black',4, 'samsonite Bag', 'adult', 'female', 'Samsonite'),
( 1659055540 ,3, 'blue' ,7, 'Vali Fendi', 'children', 'female', 'Fendi'),
( 1659055776 ,1, 'blue' ,4, 'samsonite Bag', 'teenager', 'male', 'Samsonite'),
( 1659055876 ,3, 'brown',6, 'Brown Fendi Bag' , 'teenager', 'male', 'Fendi'),
( 1659056113 ,2, 'brown',6, 'Fendi Bag' , 'teenager', 'male', 'Fendi'),
( 1659056288 ,2, 'brown',4, 'Brown Fossil Bag', 'adult' , 'female', 'Fossil'),
( 1659056845 ,2, 'brown',3, 'vali Victorinox' , 'adult' , 'male', 'Victorinox'),
( 1659056928 ,3, 'grey' ,6, 'Grey Victorinox Bag' , 'adult' , 'female', 'Victorinox'),
( 1659056975 ,1, 'purple' ,3, 'purple Bag', 'teenager', 'male', 'Samsonite'),
( 1659057054 ,3, 'red',4, 'Lipault Vali' , 'adult' , 'male', 'Lipault'),
( 1659057118 ,2, 'red',4, 'vali Victorinox' , 'teenager', 'female', 'Victorinox'),
( 1659057263 ,1, 'white',4, 'Victorinox Bag', 'adult' , 'male' , 'Victorinox'),
( 1659057315 ,3, 'black',4, 'Vali lipalt', 'teenager', 'male', 'Lipault'),
( 1659057386 ,2, 'brown',5, 'Vali lipault' , 'children', 'female', 'Lipault'),
( 1659057419 ,5, 'brown',4, 'Lipault Vali' , 'adult', 'male', 'Lipault');

INSERT INTO Image_Product(productId, imageUrls) VALUES
( 1659031232 ,'black_fendi (2).jpeg, black_fendi.jpeg'),

( 1659031263 ,'black_fendi.jpeg, black_hublot (3).jpeg, black_fossil.jpeg'),

( 1659031318 , 'black_fossil (2).jpeg, black_hublot (2).jpeg, black_samsonite (2).jpeg, black_samsonite (3).jpeg' ),

( 1659031394 ,'black_fossil.jpeg, black_samsonite (2).jpeg, black_samsonite (3).jpeg, black_samsonite.jpeg'),

( 1659031445 ,'black_hublot (2).jpeg, black_hublot (3).jpeg, black_hublot.jpeg' ),

( 1659031534 ,'black_hublot (3).jpeg, black_fendi.jpeg, black_hublot (3).jpeg' ),

( 1659031627 ,'black_hublot.jpeg'),

( 1659031766 ,'black_samsonite (2).jpeg, black_hublot (3).jpeg'),

( 1659031802 ,'black_samsonite (3).jpeg, black_fossil.jpeg, black_samsonite (2).jpeg, black_samsonite (3).jpeg, black_samsonite.jpeg'),

( 1659031889 ,'black_samsonite.jpeg'),

( 1659055540 ,'blue_fendi.jpeg' ),

( 1659055776 ,'blue_samsonite.jpeg'),

( 1659055876 ,'brown_fendi (2).jpeg, brown_fendi.jpeg, brown_fossil.jpeg, brown_victorinox.jpeg'),

( 1659056113 ,'brown_fendi.jpeg, brown_victorinox.jpeg'),

( 1659056288 ,'brown_fossil.jpeg, brown_lipault (2).jpeg'),

( 1659056845 ,'brown_victorinox.jpeg' ),

( 1659056928 ,'grey_victorinox.jpeg'),

( 1659056975 ,'purple_samsonite.jpeg' ),

( 1659057054 ,'red_lipalt.jpeg' ),
( 1659057118 ,'red_victorinox.jpeg'),
( 1659057263 ,'white_victorinox.jpeg' ),
( 1659057315 ,'black_lipault.jpeg' ),
( 1659057386 ,'brown_lipault (2).jpeg'),
( 1659057419 ,'brown_lipault.jpeg' );

INSERT INTO Users(userId, userName, phoneNumber, password, address, role) VALUES 
(1659320946 ,'jeikai' ,'0981933574', '123456', 'A8 An Bình City Phạm Văn Đồng Hà Nội', 'admin'), 
(1659321007, 'Trần Quang Phúc', '0989194097', 'phucdepzai123', 'Việt Nam', 'user');

