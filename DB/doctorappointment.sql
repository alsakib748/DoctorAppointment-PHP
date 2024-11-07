-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 07, 2024 at 08:52 PM
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
-- Database: `doctorappointment`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(200) NOT NULL,
  `profile` varchar(150) NOT NULL,
  `contact` varchar(150) NOT NULL,
  `role` varchar(100) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `email`, `password`, `profile`, `contact`, `role`, `status`) VALUES
(1, 'Al Sakib', 'admin7882@gmail.com', '$2y$10$erkZt.znjbYERN.UaWfE7ur1PMtyAEONiogcQQPq6PWYIaGGkxVtG', '1100373467.jpg', '01608566928', 'Admin', 1);

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `id` int(11) NOT NULL,
  `apt_no` varchar(100) NOT NULL,
  `current_date` date NOT NULL DEFAULT current_timestamp(),
  `apt_date` varchar(150) NOT NULL,
  `shift` varchar(150) NOT NULL,
  `start_time` varchar(150) NOT NULL,
  `consultation_time` varchar(150) NOT NULL,
  `end_time` varchar(150) NOT NULL,
  `status` varchar(150) NOT NULL DEFAULT 'Pending',
  `patient_id` int(11) DEFAULT NULL,
  `doctor_id` int(11) NOT NULL,
  `admin_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`id`, `apt_no`, `current_date`, `apt_date`, `shift`, `start_time`, `consultation_time`, `end_time`, `status`, `patient_id`, `doctor_id`, `admin_id`) VALUES
(39, '7b0bd7', '2024-03-22', '2024-03-28', 'Shift 1', '06:30 PM', '10', '06:40 PM', 'Pending', 5, 13, NULL),
(40, '7e10cd', '2024-03-23', '2024-03-23', 'Shift 1', '07:30 PM', '10', '07:40 PM', 'Booked', 5, 13, NULL),
(41, 'e4fe8d', '2024-03-23', '2024-03-23', 'Shift 1', '08:10 AM', '10', '08:20 AM', 'Pending', 5, 11, NULL),
(42, '686440', '2024-03-23', '2024-03-23', 'Shift 1', '09:00 AM', '10', '09:10 AM', 'Pending', 5, 11, NULL),
(43, 'e4e565', '2024-03-23', '2024-03-23', 'Shift 1', '10:00 AM', '15', '10:15 AM', 'Pending', 5, 16, NULL),
(44, '1972c2', '2024-03-23', '2024-03-29', 'Shift 1', '10:45 AM', '15', '11:00 AM', 'Pending', 5, 16, NULL),
(45, 'b9c2f9', '2024-03-23', '2024-03-29', 'Shift 2', '07:40 PM', '20', '08:00 PM', 'Pending', 5, 16, NULL),
(46, 'a447ed', '2024-03-23', '2024-03-29', 'Shift 1', '10:00 AM', '15', '10:15 AM', 'Booked', 5, 16, NULL),
(47, 'e6e43d', '2024-03-23', '2024-03-23', 'Shift 1', '08:00 AM', '15', '08:15 AM', 'Pending', NULL, 16, 1),
(48, '3fef89', '2024-03-23', '2024-03-28', 'Shift 1', '07:00 PM', '10', '07:10 PM', 'Pending', NULL, 13, 1),
(49, '2a5653', '2024-03-23', '2024-03-28', 'Shift 2', '08:20 PM', '10', '08:30 PM', 'Pending', NULL, 12, 1),
(50, '545f51', '2024-03-23', '2024-03-28', 'Shift 1', '07:30 PM', '10', '07:40 PM', 'Pending', NULL, 14, 1),
(51, 'de074e', '2024-03-23', '2024-03-28', 'Shift 1', '08:10 PM', '10', '08:20 PM', 'Pending', NULL, 14, 1),
(52, '3609bc', '2024-03-23', '2024-03-28', 'Shift 1', '10:00 PM', '10', '10:10 PM', 'Booked', NULL, 14, 1),
(83, '24cefc', '2024-11-05', '08 - 11 - 2024', 'Shift 1', '07:10 PM', '20', '07:30 PM', 'Booked', 1, 20, NULL),
(84, 'dc7c7d', '2024-11-05', '09 - 11 - 2024', 'Shift 1', '09:00 PM', '20', '09:20 PM', 'Booked', 4, 20, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `appointments_feedback`
--

CREATE TABLE `appointments_feedback` (
  `id` int(11) NOT NULL,
  `user_comment` text DEFAULT NULL,
  `doctor_comment` text DEFAULT NULL,
  `appointment_status` varchar(150) DEFAULT NULL,
  `fees_status` varchar(150) DEFAULT NULL,
  `appointment_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `appointments_feedback`
--

INSERT INTO `appointments_feedback` (`id`, `user_comment`, `doctor_comment`, `appointment_status`, `fees_status`, `appointment_id`) VALUES
(1, NULL, 'You will be fell well very soon.', 'Completed', 'Completed', 46),
(21, NULL, 'He is good now.', 'Completed', 'Completed', 83),
(22, NULL, '', 'Completed', 'Completed', 84);

-- --------------------------------------------------------

--
-- Table structure for table `appointment_bookings`
--

CREATE TABLE `appointment_bookings` (
  `id` int(11) NOT NULL,
  `trans_date` varchar(150) NOT NULL,
  `card_type` varchar(200) NOT NULL,
  `amount` bigint(20) NOT NULL,
  `trans_id` varchar(150) NOT NULL,
  `status` varchar(100) NOT NULL DEFAULT 'Unpaid',
  `appointment_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `appointment_bookings`
--

INSERT INTO `appointment_bookings` (`id`, `trans_date`, `card_type`, `amount`, `trans_id`, `status`, `appointment_id`) VALUES
(1, '2024-03-23 00:10:53', 'BKASH-BKash', 2000, 'SSLCZ_TEST_65fdc9acc6b3c', 'VALID', 40),
(2, '2024-03-23 02:01:16', 'IBBL-Islami Bank', 2000, 'SSLCZ_TEST_65fde38c555a4', 'VALID', 46),
(3, '2024-03-23 13:30:30', 'IBBL-Islami Bank', 800, 'SSLCZ_TEST_65fe851563c4f', 'VALID', 52),
(27, '2024-11-05 12:50:27', 'BKASH-BKash', 5000, 'SSLCZ_TEST_6729c03237bd1', 'VALID', 83),
(28, '2024-11-05 14:37:44', 'DBBLMOBILEB-Dbbl Mobile Banking', 5000, 'SSLCZ_TEST_6729d957bf579', 'VALID', 84);

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `avatar` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `name`, `avatar`) VALUES
(7, 'Neurology', '1296638858.png'),
(8, 'Medicine', '1041459067.jpg'),
(9, 'Orthopedics', '1961530566.jpg'),
(10, 'Dental', '1073654860.jpg'),
(11, 'Hematology', '872737404.png'),
(12, 'Surgery', '573657454.png'),
(13, 'Cardiology', '662535574.webp'),
(14, 'ENT', '481645604.webp');

-- --------------------------------------------------------

--
-- Table structure for table `doctors`
--

CREATE TABLE `doctors` (
  `id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `contact` varchar(150) NOT NULL,
  `department` varchar(150) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(150) NOT NULL,
  `gender` varchar(150) NOT NULL,
  `designation` varchar(255) NOT NULL,
  `qualification` varchar(255) NOT NULL,
  `experience` varchar(255) NOT NULL,
  `specialization` text NOT NULL,
  `bio` text NOT NULL,
  `fees` varchar(150) NOT NULL,
  `profile` varchar(150) NOT NULL,
  `address` text NOT NULL,
  `active` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `doctors`
--

INSERT INTO `doctors` (`id`, `name`, `contact`, `department`, `email`, `password`, `gender`, `designation`, `qualification`, `experience`, `specialization`, `bio`, `fees`, `profile`, `address`, `active`) VALUES
(6, 'Dr. Sarah Johnson', '01798523664', 'Neurology', 'sarah786@gmail.com', '$2y$10$aSyU/RfXgPyiB9LSetLA4eM9CtKg8cl..4FDeWMXdZyBwhtmPg7Wi', 'Female', 'Senior Neurologist', 'M.D., Neurology', '12 years', 'Epilepsy', 'Dr. Sarah Johnson is a dedicated neurologist specializing in epilepsy management. She completed her medical training at [University Name] and has been actively involved in epilepsy research and patient care for over a decade.', '2500', '1416636926.jpg', 'Krawan bazar, Dhaka', 1),
(7, 'Dr. Mark Thompson', '01795326884', 'Medicine', 'mark658@gmail.com', '$2y$10$WJl2H3uQLrpVWUhWDQm3weA56sjLtC1fn4GgR7jusjnIoIyu0Gwhy', 'Male', 'Internal Medicine Specialist', 'M.B.B.S, M.D.', '15 years', 'Diabetes Management', 'Dr. Mark Thompson is a highly experienced internal medicine specialist, focusing on diabetes management. He completed his medical education at [University Name] and has been actively involved in providing comprehensive care to patients with diabetes for over a decade.', '3000', '1042547535.jpg', 'Dhanmondi, Dhaka', 1),
(8, 'Dr. Robert Johnson', '01954123657', 'Orthopedics', 'robert569@gmail.com', '$2y$10$lgnNywzhem4L8jBdH7vv5OqXcw1BG513kucaI3vgoLB8H0RM7XYvm', 'Male', 'Orthopedic Surgeon', 'M.B.B.S,F.C.P.S,M.D.', '15 years', 'Joint Replacement Surgery', 'Dr. Robert Johnson is a highly experienced orthopedic surgeon specializing in joint replacement surgery. He completed his orthopedic residency at [Hospital Name] and has performed numerous successful joint replacement procedures, restoring mobility and improving quality of life for his patients.', '3500', '958713579.jpg', 'Kolabagan, Dhaka', 1),
(9, 'Dr. Jessica Roberts', '01874523692', 'Surgery', 'jessica268@gmail.com', '$2y$10$f62OBs28dVFMgW8PAi3MkeSqpBrSqZFTjQgfx3V6QidFnSv5/pK2i', 'Female', 'General Surgeon', 'MBBS, MD', '15 years', 'Laparoscopic Surgery', 'Dr. Jessica Roberts is a highly skilled general surgeon with expertise in laparoscopic surgery. She completed her surgical residency at [Hospital Name] and has performed numerous laparoscopic procedures for conditions such as appendicitis, gallstones, and hernias.', '3000', '359079974.jpg', 'Mirpur-10, Dhaka', 1),
(10, 'Dr. Christopher White', '01952364127', 'ENT', 'white662@gmail.com', '$2y$10$AXs0LhMDu2rtXCr/Osjp/unw6lRcGUxTot51QR9xMCEplRy3nOT0K', 'Male', 'Otolaryngologist', 'M.B.B.S, M.D.', '15 years', 'Head and Neck Cancer Surgery', 'Dr. Christopher White is a highly experienced otolaryngologist specializing in head and neck cancer surgery. He completed his residency training in otolaryngology at [Hospital Name] and has expertise in performing complex surgeries such as laryngectomies, thyroidectomies, and neck dissections.', '2500', '1507055628.jpg', 'Dhanmondi, Dhaka', 1),
(11, 'Dr. Jennifer Carter', '01756321548', 'Hematology', 'carter550@gmail.com', '$2y$10$Fsf08f8vAUE5GmFbyyTAC.WZWoMBNvaHAj8B5C.CR92dPIgo4KvzS', 'Female', 'Hematologist', 'MBBS, FCPS', '10+ years', 'Hematologic Malignancies', 'Dr. Jennifer Carter is a highly skilled hematologist specializing in the diagnosis and treatment of hematologic malignancies such as leukemia, lymphoma, and multiple myeloma. She completed her fellowship training in hematology-oncology at [Cancer Center Name] and is dedicated to providing personalized care to cancer patients.', '3000', '1220540564.jpg', 'Agargaon, Dhaka', 1),
(12, 'Dr. Michael Chen', '01725641236', 'Neurology', 'chen156@gmail.com', '$2y$10$UW.4V6KOHvzWxXmsQDjnguWTaGBHdM0tpkkRUDLi6GFdFKEEqDTYu', 'Male', 'Consultant Neurologist', 'M.D., Ph.D. (Neuroscience)', '8 years', 'Stroke', 'Dr. Michael Chen is a highly skilled neurologist with expertise in stroke management. He earned his medical degree from [Medical School Name] and conducted groundbreaking research in stroke rehabilitation during his doctoral studies.', '4000', '1853602012.jpg', 'Dhanmondi, Dhaka', 1),
(13, 'Dr. Jessica Wong', '01745632156', 'Medicine', 'wong45@gmail.com', '$2y$10$RquiIgjOi8oRXdkLpHhTQeVSaY76lONjf30cVzFlZT/PCqgOKlYQi', 'Female', 'Cardiologist', 'M.D.', '12 years', 'Interventional Cardiology', 'Dr. Jessica Wong is a skilled cardiologist specializing in interventional cardiology procedures. She obtained her medical degree from [Medical School Name] and has extensive experience in performing cardiac catheterizations and stent placements to treat coronary artery disease.', '2000', '902713759.jpg', 'Shahbag, Dhaka', 1),
(14, 'Dr. Emily Davis', '01745632889', 'Dental', 'davis65@gmail.com', '$2y$10$IeO0kt6Y8ftkJgQN.5NAb.qNF/IVPwD.Bqx90LVUPhtyZCSpwz89C', 'Female', 'General Dentist', 'D.D.S.', '10 years', 'Preventive Dentistry', 'Dr. Emily Davis is a dedicated general dentist with a focus on preventive dentistry. She earned her dental degree from [Dental School Name] and is committed to educating patients about proper oral hygiene practices to maintain optimal dental health.', '800', '1946449044.jpg', 'Tejgaon, Dhaka', 1),
(15, 'Dr. Samantha Patel', '01952412365', 'Orthopedics', 'patel775@gmail.com', '$2y$10$L8eehaiXOPm8j4tdjUVSve2BCjDTGAscsbdNKbPJa0ehMjx2NSwvq', 'Male', 'Orthopedic Surgeon', 'M.B.B.S, M.D.', '15 years', 'Joint Replacement Surgery', 'Dr. Robert Johnson is a highly experienced orthopedic surgeon specializing in joint replacement surgery. He completed his orthopedic residency at [Hospital Name] and has performed numerous successful joint replacement procedures, restoring mobility and improving quality of life for his patients.', '2000', '10933546.jpg', 'Gulshan, Dhaka', 1),
(16, 'Dr. Andrew Miller', '01797514326', 'Orthopedics', 'miller450@gmail.com', '$2y$10$qDQqG1cNKVOc4/MSa4NaU.RsVn3bho97je1RdT9aTAfYTZeapfbGW', 'Male', 'Spine Surgeon', 'M.B.B.S, M.D.', '15 years', 'Spine Surgery', 'Dr. Andrew Miller is a skilled spine surgeon specializing in the surgical treatment of spinal disorders. He completed his fellowship training in spine surgery at [Spine Center Name] and has expertise in performing minimally invasive spine procedures, spinal fusions, and disc replacements.', '2000', '93245441.jpg', 'Dhanmondi, Dhaka', 1),
(17, 'Dr. Sarah Lewis', '01952436128', 'Surgery', 'lewis557@gmail.com', '$2y$10$aOY2NL.K6SL0OfA0tqrySeNaS.Ai3q2Hj/h.zqavqoqvYEVnJGX4W', 'Female', 'Vascular Surgeon', 'M.B.B.S, M.D.', '10 years', 'Vascular Surgery', 'Dr. Sarah Lewis is a skilled vascular surgeon with expertise in the diagnosis and treatment of vascular diseases. She completed her vascular surgery fellowship at [Vascular Center Name] and has performed a wide range of vascular procedures, including endovascular interventions and bypass surgeries.', '2500', '1939935558.jpg', 'Mirpur-10, Dhaka', 1),
(18, 'Dr. Andrew Thompson', '01854263785', 'ENT', 'thompson79@gmail.com', '$2y$10$rUjUGEN2kvWwnw/kyCB0B.iVGdjLDbuJpSV.IPqIh6Q.zTRbcuh96', 'Male', 'Facial Plastic Surgeon', 'M.B.B.S, M.D.', '10 years', 'Facial Plastic and Reconstructive Surgery', 'Dr. Andrew Thompson is a skilled facial plastic surgeon specializing in cosmetic and reconstructive procedures of the face and neck. He completed his fellowship training in facial plastic surgery at [Facial Plastic Surgery Center Name] and has expertise in performing facelifts, rhinoplasty, and facial reconstruction surgeries.', '2000', '311683510.jpg', 'Puran Dhaka, Dhaka', 1),
(19, 'Dr. Michael Brown', '01756324692', 'Hematology', 'brown850@gmail.com', '$2y$10$dQI304miYLeD9svLirqQrukaGPK.0ArfPXrFlPPG/x6Sr7tXutkTy', 'Male', 'Hematopathologist', 'M.D., Ph.D. (Hematopathology)', '15 years', 'Hematopathology', 'Dr. Michael Brown is a board-certified hematopathologist with expertise in the diagnosis of hematologic disorders. He earned his medical degree and Ph.D. in hematopathology from [University Name] and has served as a consultant pathologist, interpreting bone marrow biopsies and peripheral blood smears.', '3000', '813305978.jpg', 'Agargaon, Dhaka', 1),
(20, 'Dr. Zehad Khan', '01796532481', 'Surgery', 'zehad759@gmail.com', '$2y$10$G4vchCG8KOxYsISA2aj/w.wqBOqqYaw7bq87bdcuU7gnLn0jbgYHG', 'Male', 'Senior Consultant Surgeon / Chief of Surgery', ' MBBS, MS (Master of Surgery), FACS (Fellow of the American College of Surgeons)', '15 Years', 'General Surgery, Laparoscopic Surgery, and Trauma Surgery', 'Dr. Zehad Khan is an experienced and highly skilled surgeon with over 15 years of expertise in general and laparoscopic surgeries. Trained in advanced minimally invasive procedures, Dr. [Name] has a reputation for precision and compassionate patient care. He/She has successfully performed thousands of surgeries, ranging from routine appendectomies to complex trauma surgeries. Dr. [Name] is dedicated to continually improving surgical outcomes through innovative techniques and personalized treatment plans. He/She actively participates in surgical conferences globally and has published numerous papers in prominent medical journals.', '5000', '713811468.jpg', 'Mirpur-2, Dhaka', 1);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `url` varchar(150) NOT NULL,
  `copyright` varchar(150) NOT NULL,
  `logo` varchar(150) NOT NULL,
  `favicon` varchar(150) NOT NULL,
  `femail` varchar(150) NOT NULL,
  `semail` varchar(150) NOT NULL,
  `fcontact` varchar(150) NOT NULL,
  `scontact` varchar(150) NOT NULL,
  `fax` varchar(150) NOT NULL,
  `whatsapp` varchar(150) NOT NULL,
  `address` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `name`, `url`, `copyright`, `logo`, `favicon`, `femail`, `semail`, `fcontact`, `scontact`, `fax`, `whatsapp`, `address`) VALUES
(1, 'Sheba', 'https://www.asasheba.com', '@Copyright ASA IT. All rights reserved 2024.', '2088912496.jpg', '1020446095.png', 'sakibcse282@gmail.com', 'ayon2465@gmail.com', '01797256448', '01995245698', '213-456-7896', '01608542795', 'Mirpur-10, Dhaka, Bangladesh');

-- --------------------------------------------------------

--
-- Table structure for table `timings`
--

CREATE TABLE `timings` (
  `id` int(11) NOT NULL,
  `day` varchar(100) NOT NULL,
  `shift` varchar(100) NOT NULL,
  `start_time` varchar(100) NOT NULL,
  `end_time` varchar(100) NOT NULL,
  `avg_time` int(11) NOT NULL,
  `doctor_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `timings`
--

INSERT INTO `timings` (`id`, `day`, `shift`, `start_time`, `end_time`, `avg_time`, `doctor_id`) VALUES
(10, 'Saturday', 'Shift 1', '8:00:00 am', '10:00:00 am', 10, 7),
(11, 'Saturday', 'Shift 2', '6:00:00 pm', '10:00:00 pm', 15, 7),
(12, 'Friday', 'Shift 1', '8:00:00 am', '1:00:00 pm', 15, 7),
(13, 'Friday', 'Shift 2', '5:00:00 pm', '11:00:00 pm', 20, 7),
(14, 'Saturday', 'Shift 1', '7:00:00 am', '10:00:00 am', 15, 16),
(15, 'Saturday', 'Shift 2', '6:00:00 pm', '10:00:00 pm', 10, 16),
(16, 'Friday', 'Shift 1', '9:00:00 am', '1:00:00 pm', 15, 16),
(17, 'Friday', 'Shift 2', '6:00:00 pm', '11:00:00 pm', 20, 16),
(18, 'Saturday', 'Shift 1', '7:00:00 am', '10:00:00 am', 10, 11),
(19, 'Saturday', 'Shift 2', '5:00:00 pm', '10:00:00 pm', 15, 11),
(20, 'Friday', 'Shift 1', '8:00:00 am', '10:00:00 am', 15, 11),
(21, 'Friday', 'Shift 2', '5:00:00 pm', '11:00:00 pm', 20, 11),
(22, 'Saturday', 'Shift 1', '6:00:00 pm', '10:00:00 pm', 10, 6),
(23, 'Sunday', 'Shift 2', '6:00:00 pm', '10:00:00 pm', 10, 6),
(24, 'Thursday', 'Shift 1', '6:00:00 pm', '10:00:00 pm', 15, 6),
(25, 'Saturday', 'Shift 2', '6:00:00 pm', '10:00:00 pm', 10, 10),
(26, 'Thursday', 'Shift 2', '6:00:00 pm', '10:00:00 pm', 15, 10),
(27, 'Saturday', 'Shift 1', '6:00:00 pm', '10:00:00 pm', 15, 14),
(28, 'Monday', 'Shift 2', '6:00:00 pm', '10:00:00 pm', 10, 14),
(29, 'Thursday', 'Shift 1', '6:00:00 pm', '10:00:00 pm', 10, 14),
(30, 'Saturday', 'Shift 1', '6:00:00 pm', '10:00:00 pm', 10, 13),
(31, 'Tuesday', 'Shift 2', '6:00:00 pm', '10:00:00 pm', 15, 13),
(32, 'Thursday', 'Shift 1', '6:00:00 pm', '10:00:00 pm', 10, 13),
(33, 'Saturday', 'Shift 2', '6:00:00 pm', '10:00:00 pm', 10, 12),
(34, 'Thursday', 'Shift 2', '6:00:00 pm', '10:00:00 pm', 10, 12),
(35, 'Saturday', 'Shift 1', '7:00:00 pm', '10:00:00 pm', 20, 20),
(36, 'Friday', 'Shift 1', '7:30:00 am', '10:30:00 pm', 20, 20),
(37, 'Friday', 'Shift 2', '7:30:00 pm', '10:30:00 pm', 15, 20);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `email` varchar(150) NOT NULL,
  `contact` varchar(100) NOT NULL,
  `pass` varchar(100) NOT NULL,
  `age` varchar(50) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `gender` varchar(100) DEFAULT NULL,
  `token` varchar(255) NOT NULL,
  `is_verified` tinyint(4) NOT NULL DEFAULT 0,
  `status` tinyint(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `contact`, `pass`, `age`, `dob`, `gender`, `token`, `is_verified`, `status`) VALUES
(1, 'Ayon', 'ayon2465@gmail.com', '01797327882', '$2y$10$htPfh3PJLR.WJRq/vocZLebYWfJqffFlSWLeMmyMMqqyYVY6pAsUm', '24', '2000-06-05', 'male', 'eadbe3f4c0cf4390ab714fa9cbded1e6', 1, 1),
(2, 'user', 'user38@gmail.com', '01728288797', '$2y$10$NwoFGQzwro.KQbgx6pSmYeeJYxUBAsJhPYwvdgrCniQgCuZAQvxpS', '', NULL, NULL, 'e49cca5651e98f8ed3ac4813ba953a17', 1, 1),
(3, 'Sakib Cse', 'sakibcse282@gmail.com', '01995244438', '$2y$10$yJRl0jnjcEI1wIqbaW2/euJA1jRjyeuixbAYlZyoz40OlgzCsqK4W', NULL, NULL, NULL, '6c70525a6286fe930455c19e76d5c777', 1, 1),
(4, 'green birds', 'greenbirds97@gmail.com', '01797327892', '$2y$10$YYWLdVdGqY5.duZwH8V5n.wz5c4x5tRPcymkHUTAmReqFbGM91IBS', '24', '2001-07-25', 'male', '8f290b9abf0ab7a3a8fdb50861627920', 1, 1),
(5, 'ariyan', 'ariyan55@gmail.com', '01995244439', '$2y$10$t6CG/Wor8LJYhk09ML.xZeNdQYRqPmddFbr8sBBxpUZuNO0Ncu5H2', NULL, NULL, NULL, '4eb153650ff7b6883492871599841b94', 1, 1),
(6, 'Hridoy Haldar', 'hridoy505@gmail.com', '01995244437', '$2y$10$tBjOIdoF1qSWuBQdPHCt9OmldFKWYXT31DehcwN5qxiBV0p0cLxyS', NULL, NULL, NULL, '8743760798321e492ed98dc4f5d6e004', 1, 1),
(7, 'The beast', 'beast987@gmail.com', '01797327872', '$2y$10$vcRh7WokkUAkwsoa7eSGpe1vIwotAnuiDtUpU7OzeTgrJHcVGwM8.', NULL, NULL, NULL, '01e72d7268389a58fed68e1cc42dccd6', 1, 1),
(8, 'myself', 'myself123@gmail.com', '01995244436', '$2y$10$e.OEEns0Aj687FniV9jijOFAueP1bAGirDZZk.UWW9mvbK7jqwuWG', NULL, NULL, NULL, '22fa3d78c7aa7269a39a6e8a265d4e83', 1, 1),
(9, 'BUBT', '22231203028@cse.bubt.edu.bd', '01797327865', '$2y$10$lJF9kVijwd3PTtVw1KYsOOO9uhm/SbEQkT1g9a5/QUTqkS5IjSdS2', NULL, NULL, NULL, '810322931e142f9053dcfa38023a952f', 1, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `patient_id` (`patient_id`),
  ADD KEY `doctor_id` (`doctor_id`),
  ADD KEY `admin_id` (`admin_id`);

--
-- Indexes for table `appointments_feedback`
--
ALTER TABLE `appointments_feedback`
  ADD PRIMARY KEY (`id`),
  ADD KEY `appointment_id` (`appointment_id`);

--
-- Indexes for table `appointment_bookings`
--
ALTER TABLE `appointment_bookings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `appointment_id` (`appointment_id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `doctors`
--
ALTER TABLE `doctors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `timings`
--
ALTER TABLE `timings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `doctor_id` (`doctor_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- AUTO_INCREMENT for table `appointments_feedback`
--
ALTER TABLE `appointments_feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `appointment_bookings`
--
ALTER TABLE `appointment_bookings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `doctors`
--
ALTER TABLE `doctors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `timings`
--
ALTER TABLE `timings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `appointments`
--
ALTER TABLE `appointments`
  ADD CONSTRAINT `appointments_ibfk_1` FOREIGN KEY (`patient_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `appointments_ibfk_2` FOREIGN KEY (`doctor_id`) REFERENCES `doctors` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `appointments_ibfk_3` FOREIGN KEY (`admin_id`) REFERENCES `admin` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `appointments_feedback`
--
ALTER TABLE `appointments_feedback`
  ADD CONSTRAINT `appointments_feedback_ibfk_1` FOREIGN KEY (`appointment_id`) REFERENCES `appointments` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `appointment_bookings`
--
ALTER TABLE `appointment_bookings`
  ADD CONSTRAINT `appointment_bookings_ibfk_1` FOREIGN KEY (`appointment_id`) REFERENCES `appointments` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `timings`
--
ALTER TABLE `timings`
  ADD CONSTRAINT `timings_ibfk_1` FOREIGN KEY (`doctor_id`) REFERENCES `doctors` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
