CREATE DATABASE IF NOT EXISTS taskforce
CHARACTER SET utf8;

USE taskforce;

DROP TABLE IF EXISTS `categories`;

DROP TABLE IF EXISTS `users`;

DROP TABLE IF EXISTS `cities`;

DROP TABLE IF EXISTS `files`;

DROP TABLE IF EXISTS `profiles`;

DROP TABLE IF EXISTS `profile_categories`;

DROP TABLE IF EXISTS `profile_settings`;

DROP TABLE IF EXISTS `tasks`;

DROP TABLE IF EXISTS `profile_stats`;

DROP TABLE IF EXISTS `profile_portfolios`;

DROP TABLE IF EXISTS `task_files`;

DROP TABLE IF EXISTS `task_feedbacks`;

DROP TABLE IF EXISTS `task_message`;


CREATE TABLE `categories` (
	`id` int NOT NULL AUTO_INCREMENT,
	`name` varchar(255) UNIQUE,
	PRIMARY KEY (`id`)
);

CREATE TABLE `users` (
	`id` int NOT NULL AUTO_INCREMENT,
	`email` varchar(255) UNIQUE,
	`password` varchar(255),
	PRIMARY KEY (`id`)
);

CREATE TABLE `cities` (
	`id` int NOT NULL AUTO_INCREMENT,
	`name` varchar(255) UNIQUE,
	PRIMARY KEY (`id`)
);

CREATE TABLE `files` (
	`id` int NOT NULL AUTO_INCREMENT,
	`path` varchar(255) UNIQUE,
	PRIMARY KEY (`id`)
);

CREATE TABLE `profiles` (
	`id` int NOT NULL AUTO_INCREMENT,
	`user_id` int UNIQUE,
	`name` varchar(255),
	`city_id` int(255) UNIQUE,
	`birthday` DATE,
	`info` TEXT(255) NOT NULL,
	`phone` varchar(255) NOT NULL,
	`skype` varchar(255) NOT NULL,
	`telegram` varchar(255) NOT NULL,
	`avatar_file_id` int NOT NULL,
	PRIMARY KEY (`id`)
);

CREATE TABLE `profile_categories` (
	`id` int NOT NULL AUTO_INCREMENT,
	`profile_id` int,
	`category_id` int,
	PRIMARY KEY (`id`)
);

CREATE TABLE `profile_settings` (
	`id` int NOT NULL AUTO_INCREMENT,
	`profile_id` int,
	`notify_message` bool DEFAULT true,
	`notify_action` bool DEFAULT true,
	`notify_review` bool DEFAULT true,
	`show_contacts` bool DEFAULT false,
	`show_profile` bool DEFAULT false,
	PRIMARY KEY (`id`)
);

CREATE TABLE `tasks` (
	`id` int NOT NULL AUTO_INCREMENT,
	`profile_id` int,
	`creation_time` DATETIME DEFAULT CURRENT_TIMESTAMP,
	`category_id` int,
	`title` varchar(255),
	`description` TEXT,
	`budget` int NOT NULL,
	`expire_date` DATETIME NOT NULL,
	`city_id` int,
	`coordinate` point NOT NULL,
	`contractor_id` int NOT NULL,
	`assign_time` DATETIME NOT NULL,
	`canceled_time` DATETIME NOT NULL,
	`failed_time` DATETIME NOT NULL,
	`status` tinyint NOT NULL,
	PRIMARY KEY (`id`)
);

CREATE TABLE `profile_stats` (
	`id` int NOT NULL AUTO_INCREMENT,
	`profile_id` int,
	`tasks_total` int DEFAULT '0',
	`tasks_failed` int DEFAULT '0',
	`views` int DEFAULT '0',
	`rating` tinyint DEFAULT '0',
	PRIMARY KEY (`id`)
);

CREATE TABLE `profile_portfolios` (
	`id` int NOT NULL AUTO_INCREMENT,
	`profile_id` int,
	`file_id` int,
	PRIMARY KEY (`id`)
);

CREATE TABLE `task_files` (
	`id` int NOT NULL AUTO_INCREMENT,
	`task_id` int,
	`name` varchar(255),
	`file_id` int NOT NULL,
	PRIMARY KEY (`id`)
);

CREATE TABLE `task_feedbacks` (
	`id` int NOT NULL AUTO_INCREMENT,
	`creation_time` DATETIME DEFAULT CURRENT_TIMESTAMP,
	`task_id` int,
	`comment` TEXT NOT NULL,
	`profile_id` int NOT NULL,
	PRIMARY KEY (`id`)
);

CREATE TABLE `task_message` (
	`id` int NOT NULL AUTO_INCREMENT,
	`creation_time` DATETIME DEFAULT CURRENT_TIMESTAMP,
	`task_id` int,
	`from_id` int,
	`to_id` int,
	`text` TEXT,
	PRIMARY KEY (`id`)
);

ALTER TABLE `profiles` ADD CONSTRAINT `profiles_fk0` FOREIGN KEY (`user_id`) REFERENCES `users`(`id`);

ALTER TABLE `profiles` ADD CONSTRAINT `profiles_fk1` FOREIGN KEY (`city_id`) REFERENCES `cities`(`id`);

ALTER TABLE `profiles` ADD CONSTRAINT `profiles_fk2` FOREIGN KEY (`avatar_file_id`) REFERENCES `files`(`id`);

ALTER TABLE `profile_categories` ADD CONSTRAINT `profile_categories_fk0` FOREIGN KEY (`profile_id`) REFERENCES `profiles`(`id`);

ALTER TABLE `profile_categories` ADD CONSTRAINT `profile_categories_fk1` FOREIGN KEY (`category_id`) REFERENCES `categories`(`id`);

ALTER TABLE `profile_settings` ADD CONSTRAINT `profile_settings_fk0` FOREIGN KEY (`profile_id`) REFERENCES `profiles`(`id`);

ALTER TABLE `tasks` ADD CONSTRAINT `tasks_fk0` FOREIGN KEY (`profile_id`) REFERENCES `profiles`(`id`);

ALTER TABLE `tasks` ADD CONSTRAINT `tasks_fk1` FOREIGN KEY (`category_id`) REFERENCES `categories`(`id`);

ALTER TABLE `tasks` ADD CONSTRAINT `tasks_fk2` FOREIGN KEY (`city_id`) REFERENCES `cities`(`id`);

ALTER TABLE `profile_stats` ADD CONSTRAINT `profile_stats_fk0` FOREIGN KEY (`profile_id`) REFERENCES `profiles`(`id`);

ALTER TABLE `profile_portfolios` ADD CONSTRAINT `profile_portfolios_fk0` FOREIGN KEY (`profile_id`) REFERENCES `profiles`(`id`);

ALTER TABLE `profile_portfolios` ADD CONSTRAINT `profile_portfolios_fk1` FOREIGN KEY (`file_id`) REFERENCES `files`(`id`);

ALTER TABLE `task_files` ADD CONSTRAINT `task_files_fk0` FOREIGN KEY (`task_id`) REFERENCES `tasks`(`id`);

ALTER TABLE `task_files` ADD CONSTRAINT `task_files_fk1` FOREIGN KEY (`file_id`) REFERENCES `files`(`id`);

ALTER TABLE `task_feedbacks` ADD CONSTRAINT `task_feedbacks_fk0` FOREIGN KEY (`task_id`) REFERENCES `tasks`(`id`);

ALTER TABLE `task_feedbacks` ADD CONSTRAINT `task_feedbacks_fk1` FOREIGN KEY (`profile_id`) REFERENCES `profiles`(`id`);

ALTER TABLE `task_message` ADD CONSTRAINT `task_message_fk0` FOREIGN KEY (`task_id`) REFERENCES `tasks`(`id`);

ALTER TABLE `task_message` ADD CONSTRAINT `task_message_fk1` FOREIGN KEY (`from_id`) REFERENCES `profiles`(`id`);

ALTER TABLE `task_message` ADD CONSTRAINT `task_message_fk2` FOREIGN KEY (`to_id`) REFERENCES `profiles`(`id`);

