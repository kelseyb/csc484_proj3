-- Create tables for LIBRARY
/*
Library(libNo, libName, location, noRooms)
Author(authorNo, authorName)
Patron(patronNo, patronName, patronType)
Book(bookNo, title, noPages, authorNo)
CopyBook(copyNo, libNo, bookNo, cost)
Loan(loanNo, copyNo, patronNo, checkOutDate, dueDate)
*/

create table Library
(
  libNo int PRIMARY KEY,
  libName varchar(100),
  location varchar(100),
  noRooms int
);

create table Author
(
  authorNo int PRIMARY KEY,
  authorName varchar(100)
);

create table Patron
(
  patronNo int PRIMARY KEY,
  patronName varchar(100),
  patronType varchar(100) check (patronType IN ('old', 'young', 'other', 'idunno'))
);

create table Book
(
  bookNo int PRIMARY KEY,
  title varchar(100),
  authorNo int references Author(authorNo)
);

create table CopyBook
(
  copyNo int PRIMARY KEY,
  libNo int references Library(libNo),
  bookNo int references Book(bookNo),
  cost decimal(6,2)
);

create table Loan
(
  loanNo int PRIMARY KEY,
  copyNo int references CopyBook(copyNo),
  patronNo int references Patron(patronNo),
  checkOutDate datetime,
  dueDate datetime
);

