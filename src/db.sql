CREATE TABLE IF NOT EXISTS Customers (
  ID INT PRIMARY KEY AUTO_INCREMENT,
  Name VARCHAR(255) NOT NULL,
  Email VARCHAR(255) NOT NULL,
  Password VARCHAR(255) NOT NULL,
  SSN VARCHAR(255) NOT NULL,
  Address VARCHAR(255),
  Phone VARCHAR(255)
);

CREATE TABLE IF NOT EXISTS Accounts (
  ID INT PRIMARY KEY AUTO_INCREMENT,
  CustomerID INT NOT NULL,
  AccountType VARCHAR(255) NOT NULL,
  Balance DECIMAL(10, 2) NOT NULL,
  FOREIGN KEY (CustomerID) REFERENCES Customers(ID)
);

CREATE TABLE IF NOT EXISTS Transactions (
  ID INT PRIMARY KEY AUTO_INCREMENT,
  SenderID INT NOT NULL,
  ReceiverID INT NOT NULL,
  Note VARCHAR(255),
  Amount DECIMAL(10, 2) NOT NULL,
  TransactionDate DATE NOT NULL,
  FOREIGN KEY (SenderID) REFERENCES Accounts(ID),
  FOREIGN KEY (ReceiverID) REFERENCES Accounts(ID)
);

CREATE TABLE IF NOT EXISTS Actions (
  ID INT PRIMARY KEY AUTO_INCREMENT,
  AccountID INT NOT NULL,
  Amount DECIMAL(10, 2) NOT NULL,
  ActionType VARCHAR(255) NOT NULL,
  ActionDate DATE NOT NULL,
  FOREIGN KEY (AccountID) REFERENCES Accounts(ID)
);

-- Update table
ALTER TABLE Customers
ADD profileImage longblob,
ADD imageType VARCHAR(255);