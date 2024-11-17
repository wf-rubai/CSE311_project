-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 17, 2024 at 07:13 PM
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
-- Database: `311_Project_database`
--

-- --------------------------------------------------------

--
-- Table structure for table `faculty`
--

CREATE TABLE `faculty` (
  `initial` varchar(255) NOT NULL,
  `fullname` varchar(150) NOT NULL,
  `faculty_pic` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `faculty`
--

INSERT INTO `faculty` (`initial`, `fullname`, `faculty_pic`) VALUES
('AbO', 'Mr. Abu Obaidah', 'no_profile_pic.jpg'),
('AJH', 'Dr. ASM Jahid Hasan', 'no_profile_pic.jpg'),
('AML', 'Amelia Lee', 'amelia_lee_pic.jpg'),
('Aqu', 'Dr. Atiqur Rahman', 'no_profile_pic.jpg'),
('ARa2', 'Dr. Ahsanur Rahman', 'no_profile_pic.jpg'),
('AzK', 'Dr. Mohammad Ashrafuzzaman Khan', 'no_profile_pic.jpg'),
('FKr', 'Mr. Syed Fateh Al Kastur', 'no_profile_pic.jpg'),
('FMA', 'Dr. Fariah Mahzabeen', 'no_profile_pic.jpg'),
('HSM', 'Md. Shahriar Hussain', 'no_profile_pic.jpg'),
('HzR', 'Dr. Hafiz Abdur Rahman', 'no_profile_pic.jpg'),
('IAH', 'Mr. Md. Ishan Arefin Hossain', 'no_profile_pic.jpg'),
('IqN', 'Mr. AKM Iqtidar Newaz', 'no_profile_pic.jpg'),
('IqR', 'Mr. Iqbalur Rahman Rokon', 'no_profile_pic.jpg'),
('ITN', 'Mr. Intisar Tahmid Naheen', 'no_profile_pic.jpg'),
('JSM', 'John Smith', 'john_smith_pic.jpg'),
('KAS', 'Dr. K. M. A. Salam', 'no_profile_pic.jpg'),
('KMM', 'Dr. Mohammad Monirujjaman Khan', 'no_profile_pic.jpg'),
('Lih', 'Dr. Lamia Iftekhar', 'no_profile_pic.jpg'),
('LSN', 'Lisa Nguyen', 'lisa_nguyen_pic.jpg'),
('MAQm', 'Dr. Mohammad Abdul Qayum', 'no_profile_pic.jpg'),
('Mdy', 'Dr. Mahdy Rahman Chowdhury', 'no_profile_pic.jpg'),
('MEZ', 'Ms. Meem Tasfia Zaman', 'no_profile_pic.jpg'),
('MLE', 'Mirza Mohammad Lutfe Elahi', 'no_profile_pic.jpg'),
('MMBA', 'Dr. Maktuba Mohid Binni', 'no_profile_pic.jpg'),
('MRK', 'Mark Robinson', 'mark_robinson_pic.jpg'),
('MSJ', 'Dr. Mohsin Sajjad', 'no_profile_pic.jpg'),
('MSK1', 'Dr. Md Shahriar Karim', 'no_profile_pic.jpg'),
('MSRb', 'Dr. Mohammad Shifat-E-Rabbi', 'no_profile_pic.jpg'),
('mtn', 'Dr. Mohammad Abdul Matin', 'no_profile_pic.jpg'),
('MUO', 'Mr. Muhammad Shafayat Oshman', 'no_profile_pic.jpg'),
('NaNr', 'Dr. Nafisa Noor', 'no_profile_pic.jpg'),
('NbM', 'Dr. Nabeel Mohammed', 'no_profile_pic.jpg'),
('NLH', 'Mr. Nabil Bin Hannan', 'no_profile_pic.jpg'),
('NqH', 'Md. Naqib Imtiaz Hussain', 'no_profile_pic.jpg'),
('NvA', 'Dr. Nova Ahmed', 'no_profile_pic.jpg'),
('OISD', 'Mr. Omar-Ibne Shahid', 'no_profile_pic.jpg'),
('RIH', 'Mr. Rifat Ahmed Hassan', 'no_profile_pic.jpg'),
('RjP', 'Dr. Rajesh Palit', 'no_profile_pic.jpg'),
('RkZ', 'Dr. M. Rokonuzzaman', 'no_profile_pic.jpg'),
('RRn', 'Dr. Mohammad Rashedur Rahman', 'no_profile_pic.jpg'),
('RtK', 'Dr. Riasat Khan', 'no_profile_pic.jpg'),
('SfM1', 'Dr. Sifat Momen', 'no_profile_pic.jpg'),
('SfR1', 'Dr. Shafin Rahman', 'no_profile_pic.jpg'),
('SLE', 'Dr. Salekul Islam', 'no_profile_pic.jpg'),
('SLf', 'Dr. Abu Sayed Mohammad Latiful Hoque', 'no_profile_pic.jpg'),
('SnS1', 'Dr. Shahnewaz Siddique', 'no_profile_pic.jpg'),
('SSH1', 'Ms. Syeda Sarita Hassan', 'no_profile_pic.jpg'),
('SvA', 'Ms. Silvia Ahmed', 'no_profile_pic.jpg'),
('SVD', 'Mr. Shaurov Das', 'no_profile_pic.jpg'),
('Szz', 'Dr. Shazzad Hosain', 'no_profile_pic.jpg'),
('TanjF', 'Ms. Tanjila Farah', 'no_profile_pic.jpg'),
('TnS1', 'Ms. Tanzilah Noor Shabnam', 'no_profile_pic.jpg'),
('TPH', 'Tom Phillips', 'tom_phillips_pic.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `faculty`
--
ALTER TABLE `faculty`
  ADD PRIMARY KEY (`initial`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
