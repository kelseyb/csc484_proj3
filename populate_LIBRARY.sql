
-- populate library?
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

insert into Book values(1, 'Matilda', 1); -- bookno, title, authorno
insert into Book values(2, 'Emma', 2);
insert into Book values(3, 'The Shining', 3);
insert into Book values(4, 'To Kill a Mocking Bird', 4);
insert into Book values(5, 'The Hunger Games', 5);

insert into CopyBook values(1, 1, 1, 10.50); -- copyno, libno, bookno, cost
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

insert into Loan values(1, 11, 1, '03/13/14', '04/13/14'); -- loanno, copyno, patronno, checkout, checkin
insert into Loan values(2, 10, 1, '03/14/14', '04/14/14');
insert into Loan values(3, 8, 1, '03/15/14', '04/15/14');
insert into Loan values(4, 1, 2, '04/12/14', '05/12/14');
insert into Loan values(5, 3, 3, '04/15/14', '05/15/14');	
