-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 18, 2025 at 08:47 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ratingfilm`
--

CREATE DATABASE IF NOT EXISTS ratingfilm;
USE ratingfilm;

-- --------------------------------------------------------

--
-- Table structure for table `actor`
--

CREATE TABLE `actor` (
  `id` int(11) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `birthday` date DEFAULT NULL,
  `img_url` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `actor`
--

INSERT INTO `actor` (`id`, `fullname`, `birthday`, `img_url`) VALUES
(1, 'Stephen Chow', '1962-06-22', 'http://localhost/rating-web/app/resource/actor/1/image.jpg'),
(2, 'Wah Yuen', '1950-09-02', ''),
(3, 'Qiu Yuen', '1950-04-19', ''),
(4, 'Matthew McConaughey', '1969-11-04', ''),
(5, 'Ellen Burstyn', '1932-12-07', ''),
(6, 'Mackenzie Foy', '2000-11-10', ''),
(7, 'Mason Thames', '2007-07-10', ''),
(8, 'Nico Parker', '2004-12-09', ''),
(9, 'Gerard Butler', '1969-11-13', ''),
(10, 'Arnold Schwarzenegger', '1947-07-30', ''),
(11, 'Linda Hamilton', '1956-09-26', ''),
(12, 'Michael Biehn', '1956-07-31', ''),
(13, 'Kikunosuke Toya', '1998-11-30', ''),
(14, 'Tomori Kusunoki', '1999-12-22', ''),
(15, 'Reina Ueda', '1994-01-17', ''),
(16, 'Bruce Willis', '1955-03-19', ''),
(17, 'Alan Rickman', '1946-02-21', ''),
(18, 'Bonnie Bedelia', '1948-03-25', ''),
(19, 'Leonardo DiCaprio', '1974-11-11', ''),
(20, 'Kate Winslet', '1975-10-05', ''),
(21, 'Billy Zane', '1966-02-24', ''),
(22, 'Tim Robbins', '1958-10-16', ''),
(23, 'Morgan Freeman', '1937-06-01', ''),
(24, 'Bob Gunton', '1945-11-15', ''),
(25, 'Michael J. Fox', '2016-06-09', ''),
(26, 'Christopher Lloyd', '1938-10-22', 'https://en.wikipedia.org/wiki/File:Christopher_Lloyd_2015.jpg'),
(27, 'Lea Thompson', '1961-05-31', 'https://en.wikipedia.org/wiki/File:Lea_Thompson_2019.jpg'),
(28, 'Tom Hardy', '1977-09-15', 'https://en.wikipedia.org/wiki/File:Tom_Hardy_2014.jpg'),
(29, 'Charlize Theron', '1975-08-07', 'https://en.wikipedia.org/wiki/File:Charlize_Theron_2019.jpg'),
(30, 'Nicholas Hoult', '1989-12-07', 'https://en.wikipedia.org/wiki/File:Nicholas_Hoult_2019.jpg'),
(31, 'Ryan Gosling', '1980-11-12', 'https://en.wikipedia.org/wiki/File:Ryan_Gosling_2018.jpg'),
(32, 'Rachel McAdams', '1978-11-17', 'https://en.wikipedia.org/wiki/File:Rachel_McAdams_2016.jpg'),
(33, 'James Garner', '1928-04-07', 'https://en.wikipedia.org/wiki/File:James_Garner_1990.jpg'),
(34, 'Rumi Hiiragi', '1987-08-01', 'https://en.wikipedia.org/wiki/File:Rumi_Hiiragi_2019.jpg'),
(35, 'Miyu Irino', '1988-02-19', 'https://en.wikipedia.org/wiki/File:Miyu_Irino_2020.jpg'),
(36, 'Mari Natsuki', '1952-05-02', 'https://en.wikipedia.org/wiki/File:Mari_Natsuki_2019.jpg'),
(37, 'Robert Downey Jr.', '1965-04-04', 'https://en.wikipedia.org/wiki/File:Robert_Downey_Jr_2014.jpg'),
(38, 'Chris Evans', '1981-06-13', 'https://en.wikipedia.org/wiki/File:Chris_Evans_2020.jpg'),
(39, 'Scarlett Johansson', '1984-11-22', 'https://en.wikipedia.org/wiki/File:Scarlett_Johansson_2021.jpg'),
(40, 'Tom Hanks', '1956-07-09', 'https://en.wikipedia.org/wiki/File:Tom_Hanks_2020.jpg'),
(41, 'Robin Wright', '1966-04-08', 'https://en.wikipedia.org/wiki/File:Robin_Wright_2019.jpg'),
(42, 'Gary Sinise', '1955-03-17', 'https://en.wikipedia.org/wiki/File:Gary_Sinise_2019.jpg'),
(44, 'Dan Aykroyd', '1952-07-01', 'https://en.wikipedia.org/wiki/File:Dan_Aykroyd_2014.jpg'),
(45, 'Sigourney Weaver', '1949-10-08', 'https://en.wikipedia.org/wiki/File:Sigourney_Weaver_2016.jpg');

-- --------------------------------------------------------

--
-- Stand-in structure for view `actor_movies`
-- (See below for the actual view)
--
CREATE TABLE `actor_movies` (
`actor_id` int(11)
,`img_cover` text
,`title` varchar(100)
,`movie_id` int(11)
);

-- --------------------------------------------------------

--
-- Table structure for table `cast_movie`
--

CREATE TABLE `cast_movie` (
  `id` int(11) NOT NULL,
  `movie_id` int(11) DEFAULT NULL,
  `actor_id` int(11) DEFAULT NULL,
  `play_as` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cast_movie`
--

INSERT INTO `cast_movie` (`id`, `movie_id`, `actor_id`, `play_as`) VALUES
(1, 1, 4, 'Cooper'),
(2, 1, 5, 'Murphy Cooper'),
(3, 1, 6, 'Little Murphy Cooper'),
(4, 2, 10, 'Terminator'),
(5, 2, 11, 'Sarah Connor'),
(6, 2, 12, 'Kyle Reeze'),
(7, 4, 1, 'Sing'),
(8, 4, 2, 'Mr. Boss'),
(9, 4, 3, 'Mrs. Boss'),
(10, 5, 13, 'Denji'),
(11, 5, 14, 'Makima'),
(12, 5, 15, 'Reze'),
(13, 6, 16, 'John McClane'),
(14, 6, 17, 'Hans Grubber'),
(15, 6, 18, 'Holly Gennalo McClane'),
(16, 7, 19, 'Jack Dawson'),
(17, 7, 20, 'Rose Dewitt Bukater'),
(18, 7, 21, 'Caledon Hockley'),
(19, 8, 22, 'Andy Dufresno'),
(20, 8, 23, 'Ellis Boy \'Red\' Redding'),
(21, 8, 24, 'Warden Norton'),
(22, 9, 25, 'Marty McFly'),
(23, 9, 26, 'Dr. Emmet Brown'),
(24, 9, 27, 'Lorraine Baines'),
(25, 10, 28, 'Max Rockatansky'),
(26, 10, 29, 'Imperator Furiosa'),
(27, 10, 30, 'Nux'),
(28, 11, 31, 'Noah Junior'),
(29, 11, 32, 'Allison Hamilton'),
(30, 11, 33, 'Noah Junior'),
(31, 12, 34, 'Chihiro Ogino'),
(32, 12, 35, 'Haku'),
(33, 12, 36, 'Yubaba'),
(34, 13, 37, 'Tony Stark'),
(35, 13, 38, 'Steve Rogers'),
(36, 13, 39, 'Natasha Romanova'),
(37, 14, 40, 'Forrest Gump'),
(38, 14, 41, 'Jenny Curran'),
(39, 14, 42, 'Lieutenant Dan Taylor'),
(41, 15, 44, 'Ray Stantz'),
(42, 15, 45, 'Dana Barrett'),
(47, 1, 14, 'Mar-K');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(1, 'Action'),
(2, 'Drama'),
(3, 'Comedy'),
(4, 'Sci-Fi'),
(5, 'Romance');

-- --------------------------------------------------------

--
-- Stand-in structure for view `list_movies`
-- (See below for the actual view)
--
CREATE TABLE `list_movies` (
`id` int(11)
,`img_cover` text
,`title` varchar(100)
,`categories_id` int(11)
,`name` varchar(50)
);

-- --------------------------------------------------------

--
-- Table structure for table `movies`
--

CREATE TABLE `movies` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `img_cover` text DEFAULT NULL,
  `categories_id` int(11) DEFAULT NULL,
  `duration` varchar(50) DEFAULT NULL,
  `release_year` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `movies`
--

INSERT INTO `movies` (`id`, `title`, `description`, `img_cover`, `categories_id`, `duration`, `release_year`) VALUES
(1, 'Interstellar', 'When Earth becomes uninhabitable in the future, a farmer and ex-NASA pilot, Joseph Cooper, is tasked to pilot a spacecraft, along with a team of researchers, to find a new planet for humans uiiai.', 'http://localhost/rating-web/app/resource/movie/1/cover.jpg', 4, '2h 49m', '2014-11-06'),
(2, 'The Terminator', 'A cyborg assassin from the future attempts to find and kill a young woman who is destined to give birth to a warrior that will lead a resistance to save humankind from extinction.', '', 1, '1h 42m', '1984-10-26'),
(3, 'How to Train Your Dragon', 'As an ancient threat endangers both Vikings and dragons alike on the isle of Berk, the friendship between Hiccup, an inventive Viking, and Toothless, a Night Fury dragon, becomes the key to both species forging a new future together.', '', 2, '2h 5m', '2025-06-13'),
(4, 'Kung Fu Hustle', 'In Shanghai, China in the 1940s, a wannabe gangster aspires to join the notorious \"Axe Gang\" while residents of a housing complex exhibit extraordinary powers in defending their turf.', '', 3, '1h 39m', '2004-12-23'),
(5, 'Chainsaw Man - The Movie: Reze Arc', 'Denji encounters a new romantic interest, Reze, who works at a coffee café.', '', 5, '1h 40m', '2025-09-19'),
(6, 'Die Hard', 'NYPD officer John McClane fights to save hostages from terrorists in a Los Angeles skyscraper during a Christmas Eve party.', '', 1, '2h 12m', '1988-07-15'),
(7, 'Titanic', 'Two members of different social classes fall in love aboard the ill-fated RMS Titanic during its maiden voyage.', '', 5, '3h 15m', '1997-12-19'),
(8, 'The Shawshank Redemption', 'Wrongfully convicted banker Andy Dufresne befriends a fellow prisoner and finds hope and eventual redemption behind bars.', '', 2, '2h 22m', '1994-09-23'),
(9, 'Back to the Future', 'Teenager Marty McFly is accidentally sent back to 1955 in a time-traveling DeLorean and must ensure his parents fall in love to restore the future.', '', 4, '1h 56m', '1985-07-03'),
(10, 'Mad Max: Fury Road', 'In a post-apocalyptic wasteland, Max Rockatansky joins forces with Imperator Furiosa to escape warlord Immortan Joe and his army in a high-speed desert chase.', '', 1, '2h 0m', '2015-05-15'),
(11, 'The Notebook', 'A young couple falls deeply in love in 1940s South Carolina, but family pressures and circumstances test their bond over time.', '', 5, '2h 3m', '2004-06-25'),
(12, 'Spirited Away', 'During her family move to a new town, young Chihiro enters the spirit world, and after her parents are turned into pigs by a witch, she must work in a mystical bathhouse to save them and return home.', '', 2, '2h 5m', '2001-07-20'),
(13, 'Avengers: Endgame', 'After the devastating events of Infinity War, the remaining Avengers and allies attempt to undo Thanos actions and restore the universe.', '', 1, '3h 1m', '2019-04-26'),
(14, 'Forrest Gump', 'Forrest Gump is a simple and kindhearted man from Alabama who unwittingly influences several major events in the 20th-century United States while pursuing his childhood love.', '', 2, '2h 22m', '1994-07-06'),
(15, 'Ghostbusters', 'Three eccentric parapsychologists start a ghost-catching business in New York City and face off against supernatural forces.', '', 3, '1h 45m', '1984-06-08'),
(19, 'Ghostrunner', '   kkkak', 'http://localhost/rating-web/app/resource/movie/19/cover.jpg', 2, '1h 2m', '2025-10-16');

-- --------------------------------------------------------

--
-- Stand-in structure for view `movie_casts`
-- (See below for the actual view)
--
CREATE TABLE `movie_casts` (
`id` int(11)
,`movie_id` int(11)
,`img_url` text
,`fullname` varchar(255)
,`play_as` varchar(50)
,`actor_id` int(11)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `movie_details`
-- (See below for the actual view)
--
CREATE TABLE `movie_details` (
`id` int(11)
,`img_cover` text
,`title` varchar(100)
,`description` text
,`category_id` int(11)
,`name` varchar(50)
,`duration` varchar(50)
,`release_year` date
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `movie_reviews`
-- (See below for the actual view)
--
CREATE TABLE `movie_reviews` (
`movie_id` int(11)
,`avg_rating` decimal(14,4)
,`name` varchar(50)
,`username` varchar(50)
,`rating` int(11)
,`review` text
,`created_at` datetime
);

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` int(11) NOT NULL,
  `movie_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `rating` int(11) DEFAULT NULL,
  `review` text DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `movie_id`, `user_id`, `rating`, `review`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 5, 'Great movie!', '2025-10-11 08:31:22', '2025-10-11 08:31:22'),
(2, 2, 2, 4, 'Good movie!', '2025-10-11 08:31:22', '2025-10-11 08:31:22'),
(3, 3, 1, 3, 'Average movie!', '2025-10-11 08:31:22', '2025-10-11 08:31:22'),
(4, 4, 2, 4, 'Really funny movie!', '2025-10-11 08:31:22', '2025-10-11 08:31:22'),
(5, 5, 1, 5, 'Great anime!', '2025-10-11 08:31:22', '2025-10-11 08:31:22'),
(6, 1, 1, 4, 'Great movie!', '2025-10-11 09:14:57', '2025-10-11 09:14:57'),
(7, 2, 1, 5, 'Good movie!', '2025-10-11 09:14:57', '2025-10-11 09:14:57'),
(8, 1, 3, 3, 'Average movie!', '2025-10-11 09:14:57', '2025-10-11 09:14:57'),
(10, 2, 70, 4, 'Real or madrid? This is really great!', '2025-10-16 06:26:21', '2025-10-16 06:26:21'),
(11, 11, 50, 5, 'UIIAI UIIIAI, WHAT A GREAT FILM', '2025-10-16 15:33:39', '2025-10-16 15:33:39'),
(13, 1, 50, 3, 'now this film feel mid, nuh uh jk', '2025-10-18 09:45:47', '2025-10-18 09:46:17');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(64) NOT NULL,
  `password` varchar(64) NOT NULL,
  `isAdmin` tinyint(1) DEFAULT 0,
  `img_url` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `isAdmin`, `img_url`) VALUES
(1, 'dary', 'dary@gmail.com', 'password', 0, NULL),
(2, 'akna', 'akna@gmail.com', 'password', 0, NULL),
(3, 'fady', 'fady@gmail.com', 'password', 0, NULL),
(4, 'kazen', 'kazen@gmail.com', 'password', 0, NULL),
(5, 'admin1', 'admin1@gmail.com', 'password', 1, NULL),
(39, 'aoao', 'aoaoao@mail.co', '$2y$10$QSUrCmELLn2X2ZlbV055ce/ck9EdIqjtcUMitdeqVWxsSEyjIgv5O', 0, NULL),
(50, 'mamang', 'mamang@gmail.com', '$2y$10$ND1wD1rw0Xrfg2OFQld3aOtBFORhhtHmgGcnoa1yuiJHBkIUWd646', 0, 'http://localhost/rating-web/app/resource/profile/50/profiles.jpg'),
(52, 'supakido', 'supa@gmail.com', '$2y$10$0UXh/uo5.idTS7I59872iup4/r8IK0gvUd73eHtwi/ATJO9N7EcXS', 0, NULL),
(64, 'uiiai', 'uiiai@mail.co', '$2y$10$IrkyGUw93RklJN9mPMjWE.WOndu4SJ6sTbczBXZi13LFr1NlJ/uja', 0, NULL),
(69, 'sumbul', 'sumbul@gmail.co', '$2y$10$xLWkOsZ.J36QhTAUinHMAupvZb3U5mXYuGXswBLRwtWLNiil1wf/S', 0, NULL),
(70, 'gedagedi', 'geda@gmail.com', '$2y$10$qybn5flBV8sRkIulw1Dc5.wGpEM4XU542HlPBzyb/iab5Dndl15je', 0, NULL),
(71, 'superidol', 'superidol@mail.co', '$2y$10$9pJfA24y1h8PTeUc4CDeguLOF/2BFMmvixSmg6wRWlvrSeXpg1dmO', 1, 'http://localhost/rating-web/app/resource/profile/71/profiles.jpg'),
(72, 'khidr', 'khidr@gmail.com', '$2y$10$ua3EMxmQ5dfdV6cNmRiUtupt5Sfvrj85cFCqODHq1Sh5u8khKMe/K', 0, NULL);

-- --------------------------------------------------------

--
-- Stand-in structure for view `user_reviews`
-- (See below for the actual view)
--
CREATE TABLE `user_reviews` (
`id` int(11)
,`user_id` int(11)
,`movie_id` int(11)
,`rating` int(11)
,`review` text
,`img_cover` text
,`title` varchar(100)
,`release_year` date
);

-- --------------------------------------------------------

--
-- Structure for view `actor_movies`
--
DROP TABLE IF EXISTS `actor_movies`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `actor_movies`  AS SELECT `a`.`id` AS `actor_id`, `m`.`img_cover` AS `img_cover`, `m`.`title` AS `title`, `m`.`id` AS `movie_id` FROM ((`cast_movie` `cm` join `movies` `m` on(`m`.`id` = `cm`.`movie_id`)) join `actor` `a` on(`a`.`id` = `cm`.`actor_id`))  ;

-- --------------------------------------------------------

--
-- Structure for view `list_movies`
--
DROP TABLE IF EXISTS `list_movies`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `list_movies`  AS SELECT `m`.`id` AS `id`, `m`.`img_cover` AS `img_cover`, `m`.`title` AS `title`, `m`.`categories_id` AS `categories_id`, `c`.`name` AS `name` FROM (`movies` `m` join `categories` `c` on(`c`.`id` = `m`.`categories_id`))  ;

-- --------------------------------------------------------

--
-- Structure for view `movie_casts`
--
DROP TABLE IF EXISTS `movie_casts`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `movie_casts`  AS SELECT `cm`.`id` AS `id`, `m`.`id` AS `movie_id`, `a`.`img_url` AS `img_url`, `a`.`fullname` AS `fullname`, `cm`.`play_as` AS `play_as`, `a`.`id` AS `actor_id` FROM ((`cast_movie` `cm` join `movies` `m` on(`m`.`id` = `cm`.`movie_id`)) join `actor` `a` on(`a`.`id` = `cm`.`actor_id`))  ;

-- --------------------------------------------------------

--
-- Structure for view `movie_details`
--
DROP TABLE IF EXISTS `movie_details`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `movie_details`  AS SELECT `m`.`id` AS `id`, `m`.`img_cover` AS `img_cover`, `m`.`title` AS `title`, `m`.`description` AS `description`, `c`.`id` AS `category_id`, `c`.`name` AS `name`, `m`.`duration` AS `duration`, `m`.`release_year` AS `release_year` FROM (`movies` `m` join `categories` `c` on(`c`.`id` = `m`.`categories_id`))  ;

-- --------------------------------------------------------

--
-- Structure for view `movie_reviews`
--
DROP TABLE IF EXISTS `movie_reviews`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `movie_reviews`  AS SELECT `m`.`id` AS `movie_id`, `avg`.`avg_rating` AS `avg_rating`, `c`.`name` AS `name`, `u`.`username` AS `username`, `r`.`rating` AS `rating`, `r`.`review` AS `review`, `r`.`created_at` AS `created_at` FROM ((((`movies` `m` join `categories` `c` on(`c`.`id` = `m`.`categories_id`)) join `reviews` `r` on(`r`.`movie_id` = `m`.`id`)) join `users` `u` on(`u`.`id` = `r`.`user_id`)) join (select `reviews`.`movie_id` AS `movie_id`,avg(`reviews`.`rating`) AS `avg_rating` from `reviews` group by `reviews`.`movie_id`) `avg` on(`avg`.`movie_id` = `m`.`id`)) ORDER BY `m`.`id` ASC  ;

-- --------------------------------------------------------

--
-- Structure for view `user_reviews`
--
DROP TABLE IF EXISTS `user_reviews`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `user_reviews`  AS SELECT `r`.`id` AS `id`, `r`.`user_id` AS `user_id`, `r`.`movie_id` AS `movie_id`, `r`.`rating` AS `rating`, `r`.`review` AS `review`, `m`.`img_cover` AS `img_cover`, `m`.`title` AS `title`, `m`.`release_year` AS `release_year` FROM (`reviews` `r` join `movies` `m` on(`m`.`id` = `r`.`movie_id`))  ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `actor`
--
ALTER TABLE `actor`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cast_movie`
--
ALTER TABLE `cast_movie`
  ADD PRIMARY KEY (`id`),
  ADD KEY `movie_id` (`movie_id`),
  ADD KEY `actor_id` (`actor_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `movies`
--
ALTER TABLE `movies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `movie_id` (`movie_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `actor`
--
ALTER TABLE `actor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `cast_movie`
--
ALTER TABLE `cast_movie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `movies`
--
ALTER TABLE `movies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cast_movie`
--
ALTER TABLE `cast_movie`
  ADD CONSTRAINT `cast_movie_ibfk_1` FOREIGN KEY (`movie_id`) REFERENCES `movies` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cast_movie_ibfk_2` FOREIGN KEY (`actor_id`) REFERENCES `actor` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `reviews_ibfk_2` FOREIGN KEY (`movie_id`) REFERENCES `movies` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;