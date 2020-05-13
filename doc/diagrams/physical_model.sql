CREATE TABLE `users` (
  `id` bigint PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role_id` bigint NOT NULL
);

CREATE TABLE `roles` (
  `id` bigint PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL
);

CREATE TABLE `grants` (
  `id` bigint PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL
);

CREATE TABLE `grants_users` (
  `id` bigint PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `user_id` bigint NOT NULL,
  `grant_id` bigint UNIQUE NOT NULL
);

CREATE TABLE `samples` (
  `id` bigint PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `user_id` bigint NOT NULL,
  `name` varchar(255) NOT NULL,
  `amount` int NOT NULL,
  `structure` text NOT NULL,
  `note` text,
  `created_at` timestamp NOT NULL,
  `modified_at` timestamp,
  `spectrometer_id` bigint NOT NULL,
  `analysis_id` bigint,
  `solvent_id` bigint NOT NULL,
  `grant_id` bigint
);

CREATE TABLE `statuses` (
  `id` bigint PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `name` varchar(255)
);

CREATE TABLE `analyses` (
  `id` bigint PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `user_id` bigint NOT NULL,
  `status_id` bigint,
  `modified_at` timestamp,
  `lab_id` bigint NOT NULL
);

CREATE TABLE `solvents` (
  `id` bigint PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL
);

CREATE TABLE `spectrometers` (
  `id` bigint PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL
);

CREATE TABLE `labs` (
  `id` bigint PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `name` varchar(255),
  `addresss` text
);

ALTER TABLE `users` ADD FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`);

ALTER TABLE `grants_users` ADD FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

ALTER TABLE `grants_users` ADD FOREIGN KEY (`grant_id`) REFERENCES `grants` (`id`);

ALTER TABLE `samples` ADD FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

ALTER TABLE `samples` ADD FOREIGN KEY (`spectrometer_id`) REFERENCES `spectrometers` (`id`);

ALTER TABLE `analyses` ADD FOREIGN KEY (`status_id`) REFERENCES `statuses` (`id`);

ALTER TABLE `analyses` ADD FOREIGN KEY (`id`) REFERENCES `samples` (`analysis_id`);

ALTER TABLE `samples` ADD FOREIGN KEY (`solvent_id`) REFERENCES `solvents` (`id`);

ALTER TABLE `samples` ADD FOREIGN KEY (`grant_id`) REFERENCES `grants` (`id`);

ALTER TABLE `analyses` ADD FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

ALTER TABLE `analyses` ADD FOREIGN KEY (`lab_id`) REFERENCES `labs` (`id`);
