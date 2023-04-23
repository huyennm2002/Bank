CREATE TABLE Customer (
  ID INT PRIMARY KEY AUTO_INCREMENT,
  name VARCHAR(255) NOT NULL,
  email VARCHAR(255) NOT NULL,
  password VARCHAR(255) NOT NULL,
  Phone VARCHAR(255),
  SSN VARCHAR(255) NOT NULL,
  Address VARCHAR(255)
);

CREATE TABLE Account (
  ID INT PRIMARY KEY AUTO_INCREMENT,
  BankID INT NOT NULL,
  CustomerID INT NOT NULL,
  AccountType VARCHAR(255) NOT NULL,
  Balance DECIMAL(10, 2) NOT NULL,
  FOREIGN KEY (BankID) REFERENCES BankBranch(ID),
  FOREIGN KEY (CustomerID) REFERENCES Customer(ID)
);

CREATE TABLE Transaction (
  ID INT PRIMARY KEY AUTO_INCREMENT,
  SenderID INT NOT NULL,
  ReceiverID INT NOT NULL,
  Note VARCHAR(255),
  Amount DECIMAL(10, 2) NOT NULL,
  TransactionDate DATE NOT NULL,
  FOREIGN KEY (SenderID) REFERENCES Account(ID),
  FOREIGN KEY (ReceiverID) REFERENCES Account(ID)
);

CREATE TABLE Action (
  ID INT PRIMARY KEY AUTO_INCREMENT,
  AccountID INT NOT NULL,
  Amount DECIMAL(10, 2) NOT NULL,
  ActionType VARCHAR(255) NOT NULL,
  ActionDate DATE NOT NULL,
  FOREIGN KEY (AccountID) REFERENCES Account(ID)
);
