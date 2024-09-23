-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 22, 2024 at 09:12 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ams`
--

-- --------------------------------------------------------

--
-- Table structure for table `batches`
--

CREATE TABLE `batches` (
  `BATCH_ID` int(11) NOT NULL,
  `BATCH` varchar(200) NOT NULL,
  `YEARR` int(11) NOT NULL,
  `CLASS` varchar(100) NOT NULL,
  `SEMESTER_1` int(11) NOT NULL DEFAULT 0,
  `SEMESTER_2` int(11) NOT NULL DEFAULT 0,
  `SEMESTER_3` int(11) NOT NULL DEFAULT 0,
  `SEMESTER_4` int(11) NOT NULL DEFAULT 0,
  `SEMESTER_5` int(11) NOT NULL DEFAULT 0,
  `SEMESTER_6` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `batches`
--

INSERT INTO `batches` (`BATCH_ID`, `BATCH`, `YEARR`, `CLASS`, `SEMESTER_1`, `SEMESTER_2`, `SEMESTER_3`, `SEMESTER_4`, `SEMESTER_5`, `SEMESTER_6`) VALUES
(16, 'BCOM CA2022', 2022, 'BCOM CA', 0, 0, 0, 1, 0, 0),
(19, 'CINEMA2022', 2022, 'CINEMA', 0, 0, 0, 0, 0, 0),
(21, 'DOCTOR2021', 2021, 'DOCTOR', 0, 0, 0, 0, 0, 0),
(22, 'BCA2022', 2022, 'BCA', 0, 0, 0, 0, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `classes`
--

CREATE TABLE `classes` (
  `CLASS_ID` int(11) NOT NULL,
  `CLASS_NAME` varchar(100) NOT NULL,
  `SEMESTER` int(11) NOT NULL,
  `SUBJECT_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `notes`
--

CREATE TABLE `notes` (
  `NOTE_ID` int(11) NOT NULL,
  `SUBJECT_ID` int(11) NOT NULL,
  `TEACHER_ID` int(11) NOT NULL,
  `MODULE` int(11) NOT NULL,
  `MODULE_NAME` varchar(200) NOT NULL,
  `DESCRIPTIONN` varchar(255) NOT NULL,
  `CATEGORY` enum('NOTE','ASSIGNMENT') NOT NULL,
  `FILE_NAME` varchar(255) NOT NULL,
  `UPLOAD_DATE` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `notes`
--

INSERT INTO `notes` (`NOTE_ID`, `SUBJECT_ID`, `TEACHER_ID`, `MODULE`, `MODULE_NAME`, `DESCRIPTIONN`, `CATEGORY`, `FILE_NAME`, `UPLOAD_DATE`) VALUES
(13, 32, 6, 1, 'chapter1', 'bbbbbbb', '', '../notesAndAssignments/NOTES/OPERATING SYSTEMS_Modulenotadded_1_note_2024-09-22.pdf', '2024-09-22 19:08:29'),
(14, 32, 6, 2, 'chapter2', 'frfg', '', '../notesAndAssignments/NOTES/OPERATING SYSTEMS_Module not added_2_note_2024-09-22.pdf', '2024-09-22 19:09:14');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `STUDENT_ID` int(11) NOT NULL,
  `USER_ID` int(11) NOT NULL,
  `NAMEE` varchar(100) NOT NULL,
  `CLASS_NAME` varchar(100) NOT NULL,
  `PARENT_CONTACT` varchar(100) NOT NULL,
  `BATCH_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`STUDENT_ID`, `USER_ID`, `NAMEE`, `CLASS_NAME`, `PARENT_CONTACT`, `BATCH_ID`) VALUES
(62, 68, 'ANULAL', 'BCOM CA', '3456789234', 16),
(65, 71, 'DERON', 'CINEMA', '8765434565', 19),
(69, 81, 'THOUFEEK', 'DOCTOR', '5654567876', 21),
(70, 82, 'SULU', 'BCA', '7907574463', 22),
(71, 83, 'RAASHID', 'BCA', '9048494618', 22),
(72, 84, 'ALTHAF', 'BCA', '9585462148', 22),
(73, 85, 'SHAMSU', 'BCA', '9584625784', 22),
(74, 86, 'RIHAN', 'BCA', '9854756985', 22),
(75, 87, 'PRATHAP', 'BCA', '9854758486', 22);

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `SUBJECT_ID` int(11) NOT NULL,
  `SUBJECT_NAME` varchar(200) NOT NULL,
  `CLASS_NAME` varchar(200) NOT NULL,
  `SEMESTER` int(11) NOT NULL,
  `TEACHER_ID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`SUBJECT_ID`, `SUBJECT_NAME`, `CLASS_NAME`, `SEMESTER`, `TEACHER_ID`) VALUES
(29, 'ADVANCED STATISTICAL METHODS', 'BCA', 3, 10),
(30, 'COMPUTER GRAPHICS', 'BCA', 3, 10),
(31, 'MICROPROCESSOR AND PC HARDWARE', 'BCA', 3, NULL),
(32, 'OPERATING SYSTEMS', 'BCA', 3, 6),
(33, 'DATA STRUCTURE USING C++', 'BCA', 3, 7),
(34, 'COMPUTER NETWORKS', 'BCA', 5, NULL),
(35, 'IT AND ENVIRONMENT', 'BCA', 5, 9),
(36, 'JAVA PROGRMMING USING LINUX', 'BCA', 5, 8),
(37, 'OPEN COURSE', 'BCA', 5, NULL),
(38, 'SYSTEM ANALYSIS AND SOFTWARE ENGINEERING', 'BCA', 4, NULL),
(39, 'LINUX ADMINISTRATION', 'BCA', 4, NULL),
(40, 'DESIGN AND ANALYSIS OF ALGORITHM', 'BCA', 4, 9),
(41, 'WEB PROGRAMING USING PHP', 'BCA', 4, 8),
(42, 'OPERATION RESEARCH', 'BCA', 4, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `teachers`
--

CREATE TABLE `teachers` (
  `TEACHER_ID` int(11) NOT NULL,
  `USER_ID` int(11) NOT NULL,
  `NAMEE` varchar(100) NOT NULL,
  `DEPARTMENT` varchar(100) NOT NULL,
  `JOINING_DATE` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `teachers`
--

INSERT INTO `teachers` (`TEACHER_ID`, `USER_ID`, `NAMEE`, `DEPARTMENT`, `JOINING_DATE`) VALUES
(6, 74, 'LEENA', 'BCA', 'JULY 14, 2022'),
(7, 75, 'DERIL', 'BCA', 'JULY 14, 2022'),
(8, 76, 'SALIM', 'BCA', 'JULY 14, 2022'),
(9, 77, 'JASEENA', 'BCA', 'JULY 14, 2022'),
(10, 78, 'BISMIN', 'BCA', 'JULY 14, 2022');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `USER_ID` int(11) NOT NULL,
  `USER_NAME` varchar(100) NOT NULL,
  `PASSWORDD` varchar(100) NOT NULL,
  `EMAIL` varchar(100) NOT NULL,
  `ROLEE` enum('ADMIN','TEACHERS','STUDENTS') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`USER_ID`, `USER_NAME`, `PASSWORDD`, `EMAIL`, `ROLEE`) VALUES
(68, '220210', '220210', 'anulal@gmail.com', 'STUDENTS'),
(71, '220308', '220308', 'deron@gmail.com', 'STUDENTS'),
(73, 'admin', 'admin', 'admin2gmail.com', 'ADMIN'),
(74, '192022', '192022', 'leena@gmail.com', 'TEACHERS'),
(75, '192023', '192023', 'deril@gmail.com', 'TEACHERS'),
(76, '192024', '192024', 'salim@gmail.com', 'TEACHERS'),
(77, '192025', '192025', 'jaseena@gmail.com', 'TEACHERS'),
(78, '192026', '192026', 'bisminNew@gmail.com', 'TEACHERS'),
(81, '210532', '210532', 'thoufeek@gmail.com', 'STUDENTS'),
(82, '220168', '220168', 'sulu@gmail.com', 'STUDENTS'),
(83, '220157', '220157', 'raashid@gmail.com', 'STUDENTS'),
(84, '220111', '220111', 'althaf@gmail.com', 'STUDENTS'),
(85, '220166', '220166', 'shamsu@gmail.com', 'STUDENTS'),
(86, '220158', '220158', 'rihan@gmail.com', 'STUDENTS'),
(87, '220156', '220156', 'prathap@gmail.com', 'STUDENTS');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `batches`
--
ALTER TABLE `batches`
  ADD PRIMARY KEY (`BATCH_ID`),
  ADD UNIQUE KEY `BATCH` (`BATCH`);

--
-- Indexes for table `classes`
--
ALTER TABLE `classes`
  ADD PRIMARY KEY (`CLASS_ID`);

--
-- Indexes for table `notes`
--
ALTER TABLE `notes`
  ADD PRIMARY KEY (`NOTE_ID`),
  ADD UNIQUE KEY `FILE_NAME` (`FILE_NAME`),
  ADD KEY `SUBJECT_ID` (`SUBJECT_ID`),
  ADD KEY `TEACHER_ID` (`TEACHER_ID`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`STUDENT_ID`),
  ADD KEY `USER_ID` (`USER_ID`),
  ADD KEY `BATCH_ID` (`BATCH_ID`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`SUBJECT_ID`),
  ADD UNIQUE KEY `SUBJECT_NAME` (`SUBJECT_NAME`),
  ADD KEY `TEACHER_ID` (`TEACHER_ID`);

--
-- Indexes for table `teachers`
--
ALTER TABLE `teachers`
  ADD PRIMARY KEY (`TEACHER_ID`),
  ADD KEY `USER_ID` (`USER_ID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`USER_ID`),
  ADD UNIQUE KEY `USER_NAME` (`USER_NAME`),
  ADD UNIQUE KEY `EMAIL` (`EMAIL`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `batches`
--
ALTER TABLE `batches`
  MODIFY `BATCH_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `classes`
--
ALTER TABLE `classes`
  MODIFY `CLASS_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `notes`
--
ALTER TABLE `notes`
  MODIFY `NOTE_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `STUDENT_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `SUBJECT_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `teachers`
--
ALTER TABLE `teachers`
  MODIFY `TEACHER_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `USER_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `notes`
--
ALTER TABLE `notes`
  ADD CONSTRAINT `notes_ibfk_1` FOREIGN KEY (`SUBJECT_ID`) REFERENCES `subjects` (`SUBJECT_ID`),
  ADD CONSTRAINT `notes_ibfk_2` FOREIGN KEY (`TEACHER_ID`) REFERENCES `teachers` (`TEACHER_ID`);

--
-- Constraints for table `students`
--
ALTER TABLE `students`
  ADD CONSTRAINT `students_ibfk_1` FOREIGN KEY (`USER_ID`) REFERENCES `users` (`USER_ID`),
  ADD CONSTRAINT `students_ibfk_2` FOREIGN KEY (`BATCH_ID`) REFERENCES `batches` (`BATCH_ID`);

--
-- Constraints for table `subjects`
--
ALTER TABLE `subjects`
  ADD CONSTRAINT `subjects_ibfk_1` FOREIGN KEY (`TEACHER_ID`) REFERENCES `teachers` (`TEACHER_ID`);

--
-- Constraints for table `teachers`
--
ALTER TABLE `teachers`
  ADD CONSTRAINT `teachers_ibfk_1` FOREIGN KEY (`USER_ID`) REFERENCES `users` (`USER_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
