<?php
$table1 = "CREATE TABLE IF NOT EXISTS `Messages` (
  `message_id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `unit_id` int(10) NOT NULL,
  `reply_id` int(10) DEFAULT NULL,
  `message_status_id` int(10) NOT NULL,
  `priority_id` int(10) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `message_title` varchar(255) COLLATE utf8_persian_ci NOT NULL,
  `message` longtext COLLATE utf8_persian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;";
$table2 = "CREATE TABLE IF NOT EXISTS `Message_Status` (
  `id` int(10) NOT NULL,
  `message_status_id` int(10) NOT NULL,
  `message_status_description` varchar(255) COLLATE utf8_persian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;";
$table3 = "CREATE TABLE IF NOT EXISTS `Priority` (
  `id` int(10) NOT NULL,
  `priority_id` int(10) NOT NULL,
  `priority_description` varchar(255) COLLATE utf8_persian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;";
$table4 = "CREATE TABLE IF NOT EXISTS `Reply_Messages` (
  `reply_id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `unit_id` int(10) NOT NULL,
  `message_id` int(10) NOT NULL,
  `message_status_id` int(10) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `message_reply` longtext COLLATE utf8_persian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;";
$table5 = "CREATE TABLE IF NOT EXISTS `Rolls` (
  `id` int(10) NOT NULL,
  `roll_id` int(10) NOT NULL,
  `roll_name` varchar(255) COLLATE utf8_persian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;";
$table6 = "CREATE TABLE IF NOT EXISTS `Units` (
  `id` int(10) NOT NULL,
  `unit_id` int(10) NOT NULL,
  `unit_name` varchar(255) COLLATE utf8_persian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;";
$table7 = "CREATE TABLE IF NOT EXISTS `Users` (
  `user_id` int(10) NOT NULL,
  `roll_id` int(10) NOT NULL,
  `unit_id` int(10) NOT NULL,
  `user_status_id` int(10) NOT NULL,
  `username` varchar(255) COLLATE utf8_persian_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_persian_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_persian_ci NOT NULL,
  `family` varchar(255) COLLATE utf8_persian_ci NOT NULL,
  `phone` varchar(20) COLLATE utf8_persian_ci NOT NULL,
  `address` text COLLATE utf8_persian_ci NOT NULL,
  `email` varchar(100) COLLATE utf8_persian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;";
$table8 = "CREATE TABLE IF NOT EXISTS `User_Status` (
  `id` int(10) NOT NULL,
  `user_status_id` int(10) NOT NULL,
  `user_status_description` varchar(255) COLLATE utf8_persian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;";

$insert1 = "INSERT INTO `Message_Status` (`id`, `message_status_id`, `message_status_description`) VALUES
            (1, 1, 'خوانده نشده'),
            (2, 2, 'خوانده شده و بی پاسخ'),
            (3, 3, 'خوانده شده و پاسخ داده شده'),
            (4, 4, 'بسته شده توسط مدیر یا واحد مربوطه'),
            (5, 5, 'بسته شده توسط خود کاربر'),
            (6, 6, 'مسدود شده توسط مدیر یا واحد مربوطه');";
$insert2 = "INSERT INTO `Priority` (`id`, `priority_id`, `priority_description`) VALUES
            (1, 1, 'فوری'),
            (2, 2, 'متوسط'),
            (3, 3, 'کم');";
$insert3 = "INSERT INTO `Rolls` (`id`, `roll_id`, `roll_name`) VALUES
            (1, 1, 'مدیریت'),
            (2, 2, 'پشتیبانی'),
            (3, 3, 'کاربر عادی');";
$insert4 = "INSERT INTO `Units` (`id`, `unit_id`, `unit_name`) VALUES
            (1, 1, 'مدیریت'),
            (2, 2, 'امور هاستینگ'),
            (3, 3, 'امور دامنه ها'),
            (4, 4, 'امور فنی'),
            (5, 5, 'کاربران');";
$insert5 = "INSERT INTO `Users` (`user_id`, `roll_id`, `unit_id`, `user_status_id`, `username`, `password`, `name`, `family`, `phone`, `address`, `email`) VALUES
            (1, 1, 1, 1, 'admin', 'fed9bbfe40a459ab80c8b8f6b178722d', 'مدیر', 'مدیری', '09123456789', 'خیابان ایرانی', 'info@example.com');";
$insert6 = "INSERT INTO `User_Status` (`id`, `user_status_id`, `user_status_description`) VALUES
            (1, 1, 'آزاد'),
            (2, 2, 'مسدود شده توسط پشتیبانی'),
            (3, 3, 'مسدود شده توسط مدیریت');";
$alter1 = "ALTER TABLE `Messages`
              ADD PRIMARY KEY (`message_id`),
              ADD KEY `user_id` (`user_id`),
              ADD KEY `unit_id` (`unit_id`),
              ADD KEY `message_status_id` (`message_status_id`),
              ADD KEY `reply_id` (`reply_id`),
              ADD KEY `priority_id` (`priority_id`);";
$alter2 = "ALTER TABLE `Message_Status`
              ADD PRIMARY KEY (`id`),
              ADD UNIQUE KEY `message_status_id` (`message_status_id`);";
$alter3 = "ALTER TABLE `Priority`
              ADD PRIMARY KEY (`id`),
              ADD UNIQUE KEY `priority_id` (`priority_id`);";
$alter4 = "ALTER TABLE `Reply_Messages`
              ADD PRIMARY KEY (`reply_id`),
              ADD KEY `user_id` (`user_id`),
              ADD KEY `unit_id` (`unit_id`),
              ADD KEY `message_status_id` (`message_status_id`),
              ADD KEY `message_id` (`message_id`);";
$alter5 = "ALTER TABLE `Rolls`
              ADD PRIMARY KEY (`id`),
              ADD UNIQUE KEY `roll_id` (`roll_id`);";
$alter6 = "ALTER TABLE `Units`
              ADD PRIMARY KEY (`id`),
              ADD UNIQUE KEY `unit_id` (`unit_id`);";
$alter7 = "ALTER TABLE `Users`
              ADD PRIMARY KEY (`user_id`),
              ADD KEY `roll_id` (`roll_id`),
              ADD KEY `user_status_id` (`user_status_id`),
              ADD KEY `Users_ibfk_3` (`unit_id`);";
$alter8 = "ALTER TABLE `User_Status`
              ADD PRIMARY KEY (`id`),
              ADD UNIQUE KEY `user_status_id` (`user_status_id`);";
$alter9 = "ALTER TABLE `Messages`
              MODIFY `message_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;";
$alter10 = "ALTER TABLE `Message_Status`
              MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;";
$alter11 = "ALTER TABLE `Priority`
              MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;";
$alter12 = "ALTER TABLE `Reply_Messages`
              MODIFY `reply_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;";
$alter13 = "ALTER TABLE `Rolls`
              MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;";
$alter14 = "ALTER TABLE `Units`
              MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;";
$alter15 = "ALTER TABLE `Users`
              MODIFY `user_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;";
$alter16 = "ALTER TABLE `User_Status`
              MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;";
$alter17 = "ALTER TABLE `Messages`
              ADD CONSTRAINT `Messages_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `Users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
              ADD CONSTRAINT `Messages_ibfk_2` FOREIGN KEY (`unit_id`) REFERENCES `Units` (`unit_id`) ON DELETE CASCADE ON UPDATE CASCADE,
              ADD CONSTRAINT `Messages_ibfk_3` FOREIGN KEY (`message_status_id`) REFERENCES `Message_Status` (`message_status_id`) ON DELETE CASCADE ON UPDATE CASCADE,
              ADD CONSTRAINT `Messages_ibfk_4` FOREIGN KEY (`reply_id`) REFERENCES `Reply_Messages` (`reply_id`) ON DELETE CASCADE ON UPDATE CASCADE,
              ADD CONSTRAINT `Messages_ibfk_5` FOREIGN KEY (`priority_id`) REFERENCES `Priority` (`priority_id`) ON DELETE CASCADE ON UPDATE CASCADE;";
$alter18 = "ALTER TABLE `Reply_Messages`
              ADD CONSTRAINT `Reply_Messages_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `Users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
              ADD CONSTRAINT `Reply_Messages_ibfk_2` FOREIGN KEY (`unit_id`) REFERENCES `Units` (`unit_id`) ON DELETE CASCADE ON UPDATE CASCADE,
              ADD CONSTRAINT `Reply_Messages_ibfk_3` FOREIGN KEY (`message_status_id`) REFERENCES `Message_Status` (`message_status_id`) ON DELETE CASCADE ON UPDATE CASCADE,
              ADD CONSTRAINT `Reply_Messages_ibfk_4` FOREIGN KEY (`message_id`) REFERENCES `Messages` (`message_id`) ON DELETE CASCADE ON UPDATE CASCADE;";
$alter19 = "ALTER TABLE `Users`
              ADD CONSTRAINT `Users_ibfk_1` FOREIGN KEY (`user_status_id`) REFERENCES `User_Status` (`user_status_id`) ON DELETE CASCADE ON UPDATE CASCADE,
              ADD CONSTRAINT `Users_ibfk_2` FOREIGN KEY (`roll_id`) REFERENCES `Rolls` (`roll_id`) ON DELETE CASCADE ON UPDATE CASCADE,
              ADD CONSTRAINT `Users_ibfk_3` FOREIGN KEY (`unit_id`) REFERENCES `Units` (`unit_id`) ON DELETE CASCADE ON UPDATE CASCADE;
            COMMIT;";