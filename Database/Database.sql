
use id16109064_sluiterappsdev;

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
	(`userTypeID`, `email`, `password`)
values
(1, 'jordan@yahoo.com', 'test'),
(1, 'test@gmail.com', 'test'),
(2, 'squishycat@hotmail.com', 'test'),
(2, 'tcace@yahoo.com', 'test'),
(2, 'heythatsmine@outlook.com', 'test');

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
values (1, 3),
	   (1, 2),
       (2, 2);

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

create table `task`
(
  `id` int primary key AUTO_INCREMENT,
  `listID` int,
  `taskTypeID` int,
  `task` varchar(255),
  `completed` boolean,
  `repeatTime` int,
  `productID` int,
  `productVolume` int,
  `productPurchaseLimit` int,
  `created` timestamp default NOW(),
  `updated` timestamp default NOW()
);

create table `taskType`
(
  `id` int primary key AUTO_INCREMENT,
  `description` varchar(30),
  `created` timestamp default NOW(),
  `updated` timestamp default NOW()
);

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
