--clear library tables?
if exists (select * from sysobjects where id = object_id('Loan'))
  drop table Loan
if exists (select * from sysobjects where id = object_id('CopyBook'))
  drop table CopyBook
if exists (select * from sysobjects where id = object_id('Book'))
  drop table Book
if exists (select * from sysobjects where id = object_id('Author'))
  drop table Author
if exists (select * from sysobjects where id = object_id('Library'))
  drop table Library
if exists (select * from sysobjects where id = object_id('Patron'))
  drop table Patron

  
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
(
  libNo int PRIMARY KEY,
  libName varchar(100),
  location varchar(100),
  noRooms int
)
GO

create table Author
(
  authorNo int PRIMARY KEY,
  authorName varchar(100)
)
GO

create table Patron
(
  patronNo int PRIMARY KEY,
  patronName varchar(100),
  patronType varchar(100) check (patronType IN ('old', 'young', 'other', 'idunno'))

)
GO

create table Book
(
  bookNo int PRIMARY KEY,
  title varchar(100),
  authorNo int references Author(authorNo)
)
GO

create table CopyBook
(
  copyNo int PRIMARY KEY,
  libNo int references Library(libNo),
  bookNo int references Book(bookNo),
  cost decimal(6,2)
)
GO

create table Loan
(
  loanNo int PRIMARY KEY,
  copyNo int references CopyBook(copyNo),
  patronNo int references Patron(patronNo),
  checkOutDate datetime,
  dueDate datetime
)
GO

--populate library?
insert into Library values(1, 'Rapid City Public Library', 'Rapid City', 10);
insert into Library values(2, 'Sturgis Library', 'Sturgis', 3);

insert into Author values(1, 'Charles Dickens');
insert into Author values(2, 'Jane Austen');
insert into Author values(3, 'Steven King');
insert into Author values(4, 'Harper Lee');
insert into Author values(5, 'Suzanne Collins');

insert into Patron values(1, 'Jane Doe', 'old');
insert into Patron values(2, 'John Doe', 'young');
insert into Patron values(3, 'Sam Samson', 'other');

insert into Book values(1, 'Matilda', 1); --bookno, title, authorno
insert into Book values(2, 'Emma', 2);
insert into Book values(3, 'The Shining', 3);
insert into Book values(4, 'To Kill a Mocking Bird', 4);
insert into Book values(5, 'The Hunger Games', 5);

insert into CopyBook values(1, 1, 1, 10.50); --copyno, libno, bookno, cost
insert into CopyBook values(2, 1, 1, 10.50);
insert into CopyBook values(3, 2, 2, 5.75);
insert into CopyBook values(4, 1, 3, 7.50);
insert into CopyBook values(5, 2, 3, 7.50);
insert into CopyBook values(6, 1, 4, 4.25);
insert into CopyBook values(7, 1, 5, 15.00);
insert into CopyBook values(8, 1, 5, 10.95);
insert into CopyBook values(9, 2, 5, 10.95);
insert into CopyBook values(10, 1, 5, 10.95);
insert into CopyBook values(11, 1, 5, 10.95);
insert into CopyBook values(12, 2, 5, 10.95);

insert into Loan values(1, 11, 1, '03/13/14', '04/13/14'); --loanno, copyno, patronno, checkout, checkin
insert into Loan values(2, 10, 1, '03/14/14', '04/14/14');
insert into Loan values(3, 8, 1, '03/15/14', '04/15/14');
insert into Loan values(4, 1, 2, '04/12/14', '05/12/14');
insert into Loan values(5, 3, 3, '04/15/14', '05/15/14');	
