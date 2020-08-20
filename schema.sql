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

DROP TABLE IF EXISTS `profile_portfolios`;

DROP TABLE IF EXISTS `task_files`;

DROP TABLE IF EXISTS `task_response`;

DROP TABLE IF EXISTS `task_message`;

DROP TABLE IF EXISTS `task_feedbacks`;

CREATE TABLE `categories` (
	`id` int NOT NULL AUTO_INCREMENT,
	`name` varchar(255) NOT NULL UNIQUE,
	PRIMARY KEY (`id`)
);

CREATE TABLE `users` (
	`id` int NOT NULL AUTO_INCREMENT,
	`email` varchar(255) NOT NULL UNIQUE,
	`password` varchar(255) NOT NULL,
	`creation_time` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
	PRIMARY KEY (`id`)
);

CREATE TABLE `cities` (
	`id` int NOT NULL AUTO_INCREMENT,
	`name` varchar(255) NOT NULL UNIQUE,
	PRIMARY KEY (`id`)
);

CREATE TABLE `files` (
	`id` int NOT NULL AUTO_INCREMENT,
	`path` varchar(255) NOT NULL UNIQUE,
	PRIMARY KEY (`id`)
);

CREATE TABLE `profiles` (
	`id` int NOT NULL AUTO_INCREMENT,
	`user_id` int NOT NULL,
	`name` varchar(255) NOT NULL,
	`city_id` int(255) NOT NULL,
	`birthday` DATE,
	`info` TEXT(255),
	`phone` varchar(255),
	`skype` varchar(255),
	`telegram` varchar(255),
	`avatar_file_id` int,
	PRIMARY KEY (`id`)
);

CREATE TABLE `profile_categories` (
	`id` int NOT NULL AUTO_INCREMENT,
	`profile_id` int NOT NULL,
	`category_id` int NOT NULL,
	PRIMARY KEY (`id`)
);

CREATE TABLE `profile_settings` (
	`id` int NOT NULL AUTO_INCREMENT,
	`profile_id` int NOT NULL,
	`notify_message` bool NOT NULL DEFAULT true,
	`notify_action` bool NOT NULL DEFAULT true,
	`notify_review` bool NOT NULL DEFAULT true,
	`show_contacts` bool NOT NULL DEFAULT false,
	`show_profile` bool NOT NULL DEFAULT false,
	PRIMARY KEY (`id`)
);

CREATE TABLE `tasks` (
	`id` int NOT NULL AUTO_INCREMENT,
	`profile_id` int NOT NULL,
	`creation_time` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
	`category_id` int NOT NULL,
	`title` varchar(255) NOT NULL,
	`description` TEXT NOT NULL,
	`budget` int,
	`expire_date` DATETIME,
	`city_id` int NOT NULL,
	`coordinate` point,
	`contractor_id` int,
	`assign_time` DATETIME,
	`canceled_time` DATETIME,
	`failed_time` DATETIME,
	`status` tinyint NOT NULL,
	PRIMARY KEY (`id`)
);

CREATE TABLE `profile_portfolios` (
	`id` int NOT NULL AUTO_INCREMENT,
	`profile_id` int NOT NULL,
	`file_id` int NOT NULL,
	PRIMARY KEY (`id`)
);

CREATE TABLE `task_files` (
	`id` int NOT NULL AUTO_INCREMENT,
	`task_id` int NOT NULL,
	`name` varchar(255) NOT NULL,
	`file_id` int NOT NULL,
	PRIMARY KEY (`id`)
);

CREATE TABLE `task_response` (
	`id` int NOT NULL AUTO_INCREMENT,
	`creation_time` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
	`task_id` int NOT NULL,
	`comment` TEXT,
	`profile_id` int NOT NULL,
	PRIMARY KEY (`id`)
);

CREATE TABLE `task_message` (
	`id` int NOT NULL AUTO_INCREMENT,
	`creation_time` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
	`task_id` int NOT NULL,
	`from_id` int NOT NULL,
	`to_id` int NOT NULL,
	`text` TEXT NOT NULL,
	PRIMARY KEY (`id`)
);

CREATE TABLE `task_feedbacks` (
	`id` int NOT NULL AUTO_INCREMENT,
	`task_id` int NOT NULL,
	`profile_id` int NOT NULL,
	`text` TEXT NOT NULL,
	`rating` int NOT NULL,
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

ALTER TABLE `profile_portfolios` ADD CONSTRAINT `profile_portfolios_fk0` FOREIGN KEY (`profile_id`) REFERENCES `profiles`(`id`);

ALTER TABLE `profile_portfolios` ADD CONSTRAINT `profile_portfolios_fk1` FOREIGN KEY (`file_id`) REFERENCES `files`(`id`);

ALTER TABLE `task_files` ADD CONSTRAINT `task_files_fk0` FOREIGN KEY (`task_id`) REFERENCES `tasks`(`id`);

ALTER TABLE `task_files` ADD CONSTRAINT `task_files_fk1` FOREIGN KEY (`file_id`) REFERENCES `files`(`id`);

ALTER TABLE `task_response` ADD CONSTRAINT `task_response_fk0` FOREIGN KEY (`task_id`) REFERENCES `tasks`(`id`);

ALTER TABLE `task_response` ADD CONSTRAINT `task_response_fk1` FOREIGN KEY (`profile_id`) REFERENCES `profiles`(`id`);

ALTER TABLE `task_message` ADD CONSTRAINT `task_message_fk0` FOREIGN KEY (`task_id`) REFERENCES `tasks`(`id`);

ALTER TABLE `task_message` ADD CONSTRAINT `task_message_fk1` FOREIGN KEY (`from_id`) REFERENCES `profiles`(`id`);

ALTER TABLE `task_message` ADD CONSTRAINT `task_message_fk2` FOREIGN KEY (`to_id`) REFERENCES `profiles`(`id`);

ALTER TABLE `task_feedbacks` ADD CONSTRAINT `task_feedbacks_fk0` FOREIGN KEY (`task_id`) REFERENCES `tasks`(`id`);

ALTER TABLE `task_feedbacks` ADD CONSTRAINT `task_feedbacks_fk1` FOREIGN KEY (`profile_id`) REFERENCES `profiles`(`id`);
