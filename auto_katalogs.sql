CREATE DATABASE auto_katalogs;
use auto_katalogs;

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password_hash` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `admins` (`id`, `username`, `password_hash`) VALUES
(2, 'neitralsX', '$2y$10$rFl0cscCjE1ohkzh1pdBfeczgrh0jhxDyOwSh8I9mUnrEl2Xxdsp2');

CREATE TABLE `applies` (
  `id` int(11) NOT NULL,
  `wantedcar` varchar(255) DEFAULT NULL,
  `fullname` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phonenumber` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `applies` (`id`, `wantedcar`, `fullname`, `email`, `phonenumber`) VALUES
(16, 'Audi Q7 dzeltens', 'Ģirts Pulle', 'girt.pulle@gmail.com', '20336009'),
(17, 'Audi Q7 dzeltens', 'Ģirts Pulle', 'girt.pulle@gmail.com', '20336009');

CREATE TABLE `cars` (
  `id` int(11) NOT NULL,
  `brand` varchar(255) DEFAULT NULL,
  `model` varchar(255) DEFAULT NULL,
  `year` int(4) DEFAULT NULL,
  `fueltype` varchar(255) DEFAULT NULL,
  `engine` varchar(255) DEFAULT NULL,
  `cartype` varchar(255) DEFAULT NULL,
  `price` varchar(255) DEFAULT NULL,
  `photo` blob,
  `gearbox` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `feedback` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `submitted_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `users` (`id`, `username`, `password`, `is_admin`) VALUES
(1, 'neitralsX', '$2y$10$rFl0cscCjE1ohkzh1pdBfeczgrh0jhxDyOwSh8I9mUnrEl2Xxdsp2', 1),
(14, 'user', '$2y$10$QDXxITanluhqAs9NSAN/OOKrQsqwHWZayjRhmKe952nC5d2moqaBe', 0),
(15, 'admin', '$2y$10$c1CugSAT2ZIyOzJLz6kZMu18Bk/vsegxeWovOYvCiHXk6dd1NULL.', 0);

ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `applies`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `cars`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

ALTER TABLE `applies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

ALTER TABLE `cars`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

ALTER TABLE `feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;