-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 12, 2025 at 08:04 AM
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
-- Database: `achievement_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `faculty_achievements`
--

CREATE TABLE `faculty_achievements` (
  `id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `empid` varchar(50) NOT NULL,
  `department` varchar(100) NOT NULL,
  `event` varchar(100) NOT NULL,
  `details` text NOT NULL,
  `certificate` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `faculty_achievements`
--

INSERT INTO `faculty_achievements` (`id`, `name`, `empid`, `department`, `event`, `details`, `certificate`, `created_at`) VALUES
(1, 'Sagar badjate', '123456789', 'IT', 'International Journal Paper', 'abcde...', 'uploads/faculty/fac_1758388507_1fbf656342602092.docx', '2025-09-20 17:15:07'),
(4, 'Sagar badjate', '123456', 'IT', 'International Journal Paper', 'asdf', 'uploads/faculty/fac_1758614463_f8eb4325551f6304.docx', '2025-09-23 08:01:03'),
(5, 'Sagar badjate', '123456', 'IT', 'International Journal Paper', 'abcd...', 'uploads/faculty/fac_1758876187_bb19ee0aea34d844.docx', '2025-09-26 08:43:07'),
(6, 'Sagar badjate', '123456', 'IT', 'International Conference Paper', 'sdfghjk', 'uploads/faculty/fac_1759076528_81280df47fb544e3.docx', '2025-09-28 16:22:08'),
(7, 'Sagar badjate', '123456', 'IT', 'International Conference Paper', 'asdfghjhgfds', 'uploads/faculty/fac_1759077104_71ac9a03143a5c87.docx', '2025-09-28 16:31:44'),
(8, 'Sagar badjate', '123456', 'IT', 'FDP', 'sdfghjmjhgfdsasdfg', 'uploads/faculty/fac_1759077197_87163373cb50b263.pdf', '2025-09-28 16:33:17'),
(9, 'Sagar badjate', '123456', 'IT', 'International Journal Paper', 'asdfghnbgfds', 'uploads/faculty/fac_1759077262_68dc9f491e75c531.pdf', '2025-09-28 16:34:22'),
(10, 'Sagar badjate', '123456', 'IT', 'International Conference Paper', 'asdfghjkjhgfdsa', 'uploads/faculty/fac_1759160716_394462af5e9115b9.pdf', '2025-09-29 15:45:16'),
(11, 'Sagar Badjate', '14004230036', 'IT', 'Workshop', 'Workshop on Paper presentation.', 'uploads/faculty/fac_1759161617_53a7ab8feea97a96.pdf', '2025-09-29 16:00:17');

-- --------------------------------------------------------

--
-- Table structure for table `faculty_users`
--

CREATE TABLE `faculty_users` (
  `id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `empid` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `faculty_users`
--

INSERT INTO `faculty_users` (`id`, `name`, `empid`, `password`, `created_at`) VALUES
(1, 'meghana', '123456789', '$2y$10$4InGxsHQyOV/V70COzf.OuO3SeOxaLTOlRoRTjvjEMGXGoYX/QC02', '2025-09-20 18:06:02'),
(3, 'anushka', '1234567890', '$2y$10$JVnG2CRg3Q4J4ofJN1R6FOSw/3xNlwGkN9I0y7T/3x2.BqH8iOWOS', '2025-09-20 18:38:35'),
(4, 'dipali', '12345', '$2y$10$pZiVJQN9X/7gWaMHWIBSlu9/0pcvbKSO00jHHX0gIYOu7UuDFxPUa', '2025-09-20 18:55:07'),
(5, 'Sagar Badjate', '14004230036', '$2y$10$.oUn00xJN9f6CdFztd7rzu/sGgNTGJV7ROrsmw0RyftviquOiRFDG', '2025-09-29 15:57:12');

-- --------------------------------------------------------

--
-- Table structure for table `students_achievements`
--

CREATE TABLE `students_achievements` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `class` varchar(50) DEFAULT NULL,
  `event` varchar(100) DEFAULT NULL,
  `prn` varchar(20) NOT NULL,
  `department` varchar(100) DEFAULT NULL,
  `course` varchar(100) NOT NULL,
  `year` varchar(10) NOT NULL,
  `achievement_type` varchar(150) NOT NULL,
  `certificate` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `students_achievements`
--

INSERT INTO `students_achievements` (`id`, `name`, `class`, `event`, `prn`, `department`, `course`, `year`, `achievement_type`, `certificate`, `created_at`) VALUES
(8, 'meghana', 'B.Tech IT', 'zonal level Avishkar', '23054491246033', NULL, '', '', '2nd Runner up', 'uploads/students/stud_1758345157_ef857077e09fe559.pdf', '2025-09-20 05:12:37'),
(9, 'anushka', 'TY IT', 'zonal level Avishkar', '23054491246030', NULL, '', '', 'Winner 3rd position', 'uploads/students/stud_1758345299_f555e31322d4559f.pdf', '2025-09-20 05:14:59'),
(10, 'shravani', 'SY', 'zonal level cricket', '23054491246052', 'IT', '', '', 'Participation', 'uploads/students/stud_1758348949_1ebc4b94a90ac915.docx', '2025-09-20 06:15:49'),
(11, 'Bhumika', 'SY', 'zonal level cricket', '23054491246007', 'IT', '', '', 'Participation', 'uploads/students/stud_1758348987_a0aecbcb4453d29a.docx', '2025-09-20 06:16:27'),
(12, 'dhanshri', 'TY', 'zonal level cricket', '23054491246038', 'IT', '', '', 'Winner 2nd position', 'uploads/students/stud_1758601487_6bdb889d69b773b8.docx', '2025-09-23 04:24:47'),
(13, 'dhanshri', 'TY', 'zonal level cricket', '23054491246038', 'IT', '', '', 'Winner 1st position', 'uploads/students/stud_1758876016_d7ba7bb7a14ca1af.docx', '2025-09-26 08:40:16'),
(14, 'dhanshri', 'SY', 'zonal level cricket', '23054491246038', 'IT', '', '', '2nd Runner up', 'uploads/students/stud_1759073927_8f84aea279020bc9.pdf', '2025-09-28 15:38:47'),
(15, 'dhanshri', '', 'zonal level cricket', '23054491246038', 'IT', '', '', '1st Runner up', 'uploads/students/stud_1759076227_f081332c3b5ab2c9.pdf', '2025-09-28 16:17:07'),
(16, 'anushka lingayat', 'TY', 'zonal level', '23054491246006', 'IT', '', '', 'Winner 1st position', 'uploads/students/stud_1759160684_6f21d84d5cd9fe24.pdf', '2025-09-29 15:44:44'),
(17, 'Dhanshri Nerkar', 'TY', 'zonal level chess', '23054491246060', 'IT', '', '', 'Winner 2nd position', 'uploads/students/stud_1759161145_54fcc6450ef3e8b3.jpeg', '2025-09-29 15:52:25'),
(18, 'Dhanshri Nerkar', 'TY', 'zonal level chess', '23054491246060', 'IT', '', '', 'Winner 1st position', 'uploads/students/stud_1759161227_634b4247895062ac.jpeg', '2025-09-29 15:53:47');

-- --------------------------------------------------------

--
-- Table structure for table `student_users`
--

CREATE TABLE `student_users` (
  `id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `prn` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student_users`
--

INSERT INTO `student_users` (`id`, `name`, `prn`, `password`, `created_at`) VALUES
(1, 'dhanshri', '23054491246038', '$2y$10$NMs3PzNvPBrFzHXc3zaQguE3EKGkPlfd25dv04UkPOqGlMmTHYOwy', '2025-09-20 18:01:43'),
(4, 'anushka', '23054491246033', '$2y$10$QFx2l3ly0WuMQ7OnHYijhOymKBi/GHJffV46bjPb.sTJet7AisBae', '2025-09-20 18:23:42'),
(5, 'meghana', '23054491246028', '$2y$10$gmp.Ogq/ksClUk4yvxyHFuPojjBQewUvb1hoRoUTyE6ELQssPOKRy', '2025-09-24 10:42:18'),
(6, 'dhanshri', '23054491246001', '$2y$10$0NqS9RcxMA4gMyPaNsz/iuetp3ANWP51tklyzRQLt4GIcV5Dxv7gq', '2025-09-28 15:58:18'),
(7, 'Dhanshri Nerkar', '23054491246060', '$2y$10$4EBRKYQJb42r/L4OhWKY6OX0.3/eQyccbrGXVy//ritCwF9WRn5hW', '2025-09-29 15:50:59');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `faculty_achievements`
--
ALTER TABLE `faculty_achievements`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `faculty_users`
--
ALTER TABLE `faculty_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `empid` (`empid`);

--
-- Indexes for table `students_achievements`
--
ALTER TABLE `students_achievements`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student_users`
--
ALTER TABLE `student_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `prn` (`prn`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `faculty_achievements`
--
ALTER TABLE `faculty_achievements`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `faculty_users`
--
ALTER TABLE `faculty_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `students_achievements`
--
ALTER TABLE `students_achievements`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `student_users`
--
ALTER TABLE `student_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
