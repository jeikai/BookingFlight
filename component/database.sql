-- CREATE DATABASE BookingFlight;
-- USE BookingFlight;
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
    flightName VARCHAR(150) NOT NULL,
    price VARCHAR(150) NOT NULL,
    quantity VARCHAR(150) NOT NULL,   
    userId INT,
    orderDate VARCHAR(30),
    description NVARCHAR(1000) DEFAULT '',
    price_sum FLOAT 
);

CREATE TABLE OrderDetails(
    OrderDetailID INT PRIMARY KEY,
    flightId INT,
    price FLOAT,
    quantity INT,
    userId INT
);

CREATE TABLE Flight(
    flightId INT PRIMARY KEY,    
    brand varchar(20) NOT NULL,
    startCity varchar(20) NOT NULL,
    endCity varchar(20) NOT NULL,
    startTime varchar(20) NOT NULL,
    endTime varchar(20) NOT NULL,
    totalCustomer INT NOT NULL,
    remainingCustomer INT,
    standardPrice float NOT NULL,
    isRoundTrip INT
);

INSERT INTO Flight (flightId, startCity, endCity, startTime, endTime, totalCustomer, remainingCustomer, standardPrice, isRoundTrip)
VALUES
  (1, 'Vietnam Airlines','New York', 'Los Angeles', '2024-05-18 10:00:00', '2024-05-18 15:00:00', 150, 150, 250.00, 0),  
  (2, 'Jetstar', 'London', 'Paris', '2024-05-19 08:30:00', '2024-05-19 11:00:00', 100, 100, 180.50, 0), 
  (3, 'Bamboo', 'Tokyo', 'Singapore', '2024-05-20 12:15:00', '2024-05-21 08:45:00', 200, 200, 520.75, 1), 
  (4, 'Vietjet Air', 'Berlin', 'Rome', '2024-05-21 17:45:00', '2024-05-22 14:00:00', 75, 75, 315.25, 1);


INSERT INTO Users(userId, userName, phoneNumber, password, address, role) VALUES 
(1659320946 ,'jeikai' ,'0981933574', '123456', 'A8 An Bình City Phạm Văn Đồng Hà Nội', 'admin'), 
(1659321007, 'Trần Quang Phúc', '0989194097', 'phucdepzai123', 'Việt Nam', 'user');

