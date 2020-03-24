CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `login` varchar(20) NOT NULL,
  `password` varchar(32) NOT NULL,
  PRIMARY KEY (`id`)
);

CREATE TABLE `finance` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `balance` decimal(15,2) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `finance_users_FK` (`user_id`),
  CONSTRAINT `finance_users_FK` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
);

insert into users (id, login, password) value (1, 'user1', '111');
insert into users (id, login, password) value (2, 'user2', '222');
insert into users (id, login, password) value (3, 'user3', '333');

insert into finance (user_id, balance) value (1, 100);
insert into finance (user_id, balance) value (2, 200);
insert into finance (user_id, balance) value (3, 300);
