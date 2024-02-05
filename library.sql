-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 14, 2023 at 09:46 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lib`
--

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `publisher` varchar(255) NOT NULL,
  `publication_year` int(11) NOT NULL,
  `version` int(20) NOT NULL,
  `field` varchar(255) NOT NULL,
  `quantity` int(255) DEFAULT NULL,
  `borrowed` int(11) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`id`, `title`, `publisher`, `publication_year`, `version`, `field`, `quantity`, `borrowed`, `created_at`) VALUES
(1, 'Academic Voices', 'Imprint', 2020, 1, 'Education', 99, 1, '2023-11-14 06:09:13'),
(2, '1984', 'Secker &amp; Warburg', 1949, 1, 'Political Satire', 49, 1, '2023-11-14 06:14:01'),
(3, 'The Great Gatsby', 'Charles Scribner&#039;s Sons', 1925, 1, 'Literary Fiction', 74, 1, '2023-11-14 06:15:00');

-- --------------------------------------------------------

--
-- Table structure for table `books_borrowed`
--

CREATE TABLE `books_borrowed` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `unique_id` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `fine_amount` int(11) DEFAULT NULL,
  `returned_date` date DEFAULT NULL,
  `status` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `books_borrowed`
--

INSERT INTO `books_borrowed` (`id`, `user_id`, `book_id`, `unique_id`, `date`, `fine_amount`, `returned_date`, `status`, `created_at`) VALUES
(1, 10, 1, 'S-304', '2023-11-01', NULL, NULL, 'Borrowed', '2023-11-14 06:16:07'),
(2, 10, 2, 'S-39', '2023-07-13', NULL, NULL, 'Borrowed', '2023-11-14 06:53:02'),
(3, 10, 3, 'S-47', '2023-11-01', NULL, NULL, 'Borrowed', '2023-11-14 07:00:26');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_type` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `user_type`, `created_at`) VALUES
(9, 'Admin', 'admin@mail.com', '8cb2237d0679ca88db6464eac60da96345513964', 'Admin', '2023-11-13 17:18:28'),
(10, 'Student Name', 'student@mail.com', '8cb2237d0679ca88db6464eac60da96345513964', 'Student', '2023-11-14 04:26:42');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `books_borrowed`
--
ALTER TABLE `books_borrowed`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `books_borrowed`
--
ALTER TABLE `books_borrowed`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
