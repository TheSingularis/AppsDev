drop database if exists AppsDev;
create database AppsDev;
use AppsDev;

create table `user`
(
  `id` int primary key AUTO_INCREMENT,
  `userTypeID` int default 2,
  `firstName` varchar(30),
  `lastName` varchar(30),
  `email` varchar(255),
  `password` varchar(255),
  `created` timestamp default NOW(),
  `updated` timestamp default NOW()
);

insert into `user`
	(`userTypeID`, `firstName`, `lastName`, `email`, `password`)
values
(1, 'jordan', 'sluiter', 'jordan@yahoo.com', 'test'),
(1, 'andy', 'bangsberg', 'test@gmail.com', 'test'),
(2, 'firstName', 'lastName', 'squishycat@hotmail.com', 'test'),
(2, 'spongebob', 'squarepants', 'tcace@yahoo.com', 'test'),
(2, 'panda', 'express', 'heythatsmine@outlook.com', 'test');

create table `list`
(
  `id` int primary key AUTO_INCREMENT,
  `title` varchar(30),
  `description` varchar(255),
  `created` timestamp default NOW(),
  `updated` timestamp default NOW()
);

insert into `list` (`title`,`description`)
values
('Cats', 'The indoor cats'),
('Chickens', 'Front two chicken coops'),
('Dogs', 'The big dogs');

create table `userList`
( `id` int primary key AUTO_INCREMENT,
  `listID` int,
  `userID` int,
  `created` timestamp default NOW(),
  `updated` timestamp default NOW()
);

insert into `userList` (`listID`, `userID`)
values (1, 1),
	   (1, 2),
       (2, 1);

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
  `taskTypeID` int default 1,	/* 1 is a checkbox task with no complications */
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

create table `stores`
(
  `id` int primary key AUTO_INCREMENT,
  `storeName` varchar(25),
  `created` timestamp default NOW(),
  `updated` timestamp default NOW()
);

create table `products`
(
  `id` int primary key AUTO_INCREMENT,
  `productName` varchar(255),
  `productLink` varchar(255),
  `created` timestamp default NOW(),
  `updated` timestamp default NOW()
);

create table `productStore`
(
  `id` int primary key AUTO_INCREMENT,
  `productID` int,
  `storeID` int,
  `created` timestamp default NOW(),
  `updated` timestamp default NOW()
);

alter table `userList` add foreign key (`listID`) references `list` (`id`);

alter table `userList` add foreign key (`userID`) references `user` (`id`);

alter table `user` add foreign key (`userTypeID`) references `userType` (`id`);

alter table `task` add foreign key (`productID`) references `products` (`id`);

alter table `task` add foreign key (`taskTypeID`) references `taskType` (`id`);

alter table `productStore` add foreign key (`productID`) references `products` (`id`);

alter table `productStore` add foreign key (`storeID`) references `stores` (`id`);

alter table `task` add foreign key (`listID`) references `list` (`id`);
