--clear library tables?
if exists (select * from sysobjects where id = object_id('Library'))
  drop table Library
if exists (select * from sysobjects where id = object_id('Author'))
  drop table Author
if exists (select * from sysobjects where id = object_id('Patron'))
  drop table Patron
if exists (select * from sysobjects where id = object_id('Book'))
  drop table Book
if exists (select * from sysobjects where id = object_id('CopyBook'))
  drop table CopyBook
if exists (select * from sysobjects where id = object_id('Loan'))
  drop table Loan
  
GO --may or may not be necessary 

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
{
  libNo int PRIMARY KEY,
  libName varchar(100),
  location varchar(100),
  noRooms int
};

create table Author
{
  authorNo int PRIMARY KEY,
  authorName varchar(100)
};

create table Patron
{
  patronNo int PRIMARY KEY,
  patronName varchar(100),
  patronType varchar(100) check (patronType IN ('old', 'young', 'other', 'idunno'))

};

create table Book
{
  bookNo int PRIMARY KEY,
  title varchar(100),
  authorNo int references Author(authorNo)

};

create table CopyBook
{
  copyNo int PRIMARY KEY,
  libNo int references Library(libNo),
  bookNo int references Book(bookNo),
  cost decimal(6,2)
};

create table Loan
{
  loanNo int PRIMARY KEY,
  copyNo int references Copy(copyNo),
  patronNo int references Patron(patronNo),
  checkOutDate datetime,
  dueDate datetime

};

--populate library?
insert into Library(1, 'Rapid City Public Library', 'Rapid City', 10);
insert into Library (2, 'Sturgis Library', 'Sturgis', 3);

insert into Author(1, 'Charles Dickens');
insert into Author(2, 'Jane Austen');
insert into Author(3, 'Steven King');
insert into Author(4, 'Harper Lee');

insert into Patron(1, 'Jane Doe', 'old');
insert into Patron(2, 'John Doe', 'young');

insert into Book(1, 'Matilda', 1);
insert into Book(2, 'Emma', 2);
insert into Book(3, 'The Shining', 3);
insert into Book(4, 'To Kill a Mocking Bird', 4);

insert into CopyBook(1, 1, 1, 10.50); --copyno, libno, bookno, cost
insert into CopyBook(2, 1, 1, 10.50);
insert into CopyBook(3, 2, 2, 5.75);
insert into CopyBook(4, 1, 3, 7.50);
insert into CopyBook(5, 2, 3, 7.50);
insert into CopyBook(6, 1, 4, 4.25);
insert into CopyBook(7, 1, 5, 15.00);
insert into CopyBook(8, 1, 5, 10.95);
insert into CopyBook(9, 2, 5, 10.95);
insert into CopyBook(10, 1, 5, 10.95);
insert into CopyBook(11, 1, 5, 10.95);
insert into CopyBook(12, 2, 5, 10.95);

insert into Loan(1, 11, 1, '03/13/14', '04/13/14');
insert into Loan(2, 10, 1, '03/14/14', '04/14/14');
insert into Loan(3, 8, 1, '03/15/14', '04/15/14');
insert into Loan(4, 1, 2, '04/12/14', '05/12/14');
insert into Loan(5, 3, 3, '04/15/14', '05/15/14');	
