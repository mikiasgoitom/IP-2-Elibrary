-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 27, 2024 at 02:12 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `library`
--

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `bid` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `author` varchar(100) NOT NULL,
  `img` text NOT NULL,
  `path` text NOT NULL,
  `description` text NOT NULL,
  `genre` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`bid`, `title`, `author`, `img`, `path`, `description`, `genre`, `created_at`) VALUES
(1, 'python', 'mihret', 'clean code.jpg', 'hjkl', 'this is a python book', 'programming', '2024-05-25 17:16:04'),
(1, 'python', 'mihret', 'clean code.jpg', 'hjkl', 'this is a python book', 'programming', '2024-05-25 17:16:04'),
(2, 'b', 'c', 'design pattern.jpg', 'uploads\\Chapter 1 - Introduction to Database system.pdf', 'this is test', 'no', '2024-05-25 17:16:04'),
(3, 'th', 'hg', 'Python.jpg', '\\books\\book1.pdf', 'hjk', 'hj', '2024-05-25 17:16:04'),
(3, 'jk', 'hj', 'FET.jpg', 'final_project\\HTML_CSS_eLibrary_project\\books\\book1.pdf', '', '', '2024-05-25 17:16:04'),
(5, 'new', 'th', 'Screenshot (6).png', 'uploads/Sorting Part 1.pdf', 'no description ', 'physics', '2024-05-26 17:12:06');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
