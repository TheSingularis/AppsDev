drop database if exists sluiterj_AppsDev;
create database sluiterj_AppsDev;
use sluiterj_AppsDev;

create table `user`
(
  `id` int primary key AUTO_INCREMENT,
  `userTypeID` int default 2,
  `firstName` varchar(30),
  `lastName` varchar(30),
  `email` varchar(255),
  `password` varchar(255),
  `salt` varchar(255),
  `created` timestamp default NOW(),
  `updated` timestamp default NOW()
);

insert into `user`
	(`userTypeID`, `firstName`, `lastName`, `email`, `password`)
values
(1, 'jordan', 'sluiter', 'jordan@yahoo.com', 'test'),
(1, 'test', 'admin', 'testadmin@test.com', 'admin'),
(2, 'test', 'user', 'testuser@test.com', 'user'),
(2, 'andy', 'bangsberg', 'test@gmail.com', 'test'),
(2, 'firstName', 'lastName', 'squishycat@hotmail.com', 'test'),
(2, 'spongebob', 'squarepants', 'tcace@yahoo.com', 'test'),
(2, 'panda', 'express', 'heythatsmine@outlook.com', 'test');

create table `list`
(
  `id` int primary key AUTO_INCREMENT,
  `title` varchar(30),
  `description` varchar(255),
  `shareUUID` varchar(8),
  `created` timestamp default NOW(),
  `updated` timestamp default NOW()
);

insert into `list` (`title`,`description`, `shareUUID`)
values
('Cats', 'The indoor cats', 'abcdefgh'),
('Chickens', 'Front two chicken coops', 12345678),
('Dogs', 'The big dogs', 'a1b2c3d4');

create table `userList`
( `id` int primary key AUTO_INCREMENT,
  `listID` int,
  `userID` int,
  `created` timestamp default NOW(),
  `updated` timestamp default NOW()
);

insert into `userList` (`listID`, `userID`)
values (1, 2),
	   (2, 2),
       (2, 3),
       (3, 3);

create table `userType`
(
  `id` int primary key AUTO_INCREMENT,
  `description` varchar(255),
  `created` timestamp default NOW(),
  `updated` timestamp default NOW()
);

insert into `userType` (`id`,`description`)
values
(1, 'Admin'),
(2, 'End User');

create table `taskType`
(
  `id` int primary key AUTO_INCREMENT,
  `description` varchar(30),
  `created` timestamp default NOW(),
  `updated` timestamp default NOW()
);

insert into `taskType` (`id`, `description`)
values 
(1, 'Basic boolean check'),
(2, 'Time based check');

create table `task`
(
  `id` int primary key AUTO_INCREMENT,
  `listID` int,
  `taskTypeID` int default 1,	/* 1 for single check, 2 for daily recurring */
  `description` varchar(255),
  `completed` boolean default false,
  `repeatTime` int default -1,
  `productID` int,
  `productVolume` int default -1,
  `productPurchaseLimit` int default -1,
  `created` timestamp default NOW(),
  `updated` timestamp default NOW()
);

insert into `task` (`listID`, `description`)
values
(1, 'Feed the Chickens'),
(1, 'Feed the Dogs'),
(2, 'Replace the kitty litter'),
(2, 'collect chicken eggs'),
(2, 'Fill the cats water');

create table `store`
(
  `id` int primary key AUTO_INCREMENT,
  `storeName` varchar(25),
  `created` timestamp default NOW(),
  `updated` timestamp default NOW()
);

insert into `store` (`storeName`)
values
('Chewy'),
('Amazon(NYI)');

create table `product`
(
  `id` int primary key AUTO_INCREMENT,
  `productName` varchar(255),
  `productUrl` varchar(1000),
  `storeID` int,
  `created` timestamp default NOW(),
  `updated` timestamp default NOW()
);

create table `history`
(
  `id` int primary key AUTO_INCREMENT,
  `taskID` int,
  `dateComplete` timestamp
);

insert into `history` (`taskID`, `dateComplete`)
values
(1, '2021-01-01'),
(1, '2021-02-02'),
(1, '2021-03-01'),
(1, '2021-03-02'),
(1, '2021-03-03'),
(1, '2021-03-04'),
(1, '2021-03-05'),
(1, '2021-03-06'),
(1, '2021-03-07'),
(1, '2021-03-08'),
(1, '2021-03-09'),
(1, '2021-03-10'),
(1, '2021-04-11'),
(1, '2021-05-02'),
(1, '2021-06-01');


alter table `userList` add foreign key (`listID`) references `list` (`id`);

alter table `userList` add foreign key (`userID`) references `user` (`id`);

alter table `user` add foreign key (`userTypeID`) references `userType` (`id`);

alter table `task` add foreign key (`productID`) references `product` (`id`);

alter table `task` add foreign key (`taskTypeID`) references `taskType` (`id`);

alter table `task` add foreign key (`listID`) references `list` (`id`);

alter table `product` add foreign key (`storeID`) references `store` (`id`);

alter table `history` add foreign key (`taskID`) references `task` (`id`);

/* -------------------- */
/*  Completion History  */
/*
set global event_scheduler = on;

create event taskHistory
  on schedule
    every 1 day
    starts (timestamp(current_date) + interval 23 hour + interval 59 minute)
  do
    insert into `history` (`taskID`, `dateComplete`)
	select id, now() as dateComplete from task where completed is true 

/* -------------------- */
/*      Encryption      */

--Inserts new user
delimiter //
create procedure spAddUser (
	pUserTypeId int,
	pFirstName varchar(30),
	pLastName varchar(30),
	pEmail varchar(255),
	pPassword varchar(255)
) 
begin    
    
    declare salt varchar(255) default '';
    declare encryptedPassword varchar(255) default '';
    set salt = substring(sha1(rand()), 1, 6);
    set encryptedPassword = sha1(concat(salt, pPassword));
    
	insert into `user` (`userTypeID`, `firstName`, `lastName`, `email`, `password`, `salt`)
    values (pUserTypeId, pFirstName, pLastName, pEmail, encryptedPassword, salt);
    
end //
delimiter ;
go

--Updates user password
delimiter //
create procedure spUpdateUserPassword (
	pEmail varchar(255),
    pPassword varchar(255)
)
begin

	declare salt varchar(255) default '';
    declare encryptedPassword varchar(255) default '';
    set salt = select salt from user where email = pEmail;
    set encryptedPassword = sha1(concat(salt, pPassword));
    
    update `user` set password = encryptedPassword where email = pEmail;

end //
delimiter ;
go

--Outputs true or false if the login is good or not
delimiter //
create procedure spLoginUser (
	pEmail varchar(255),
    pPassword varchar(255)
)
begin
	
    declare salt varchar(255) default '';
    declare encryptedPassword varchar(255) default '';
    declare newPassword varchar(255) default '';
    
    set salt = select salt from user where email = pEmail;
    set encryptedPassword = select password from user where email = pEmail;
	set password = sha1(concat(salt, pPassword));
    
    select if (encryptedPassword equals password, true, false)
    
end //
delimiter ;
