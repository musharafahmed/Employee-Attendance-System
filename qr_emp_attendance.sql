-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 04, 2023 at 08:52 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `qr_emp_attendance`
--

-- --------------------------------------------------------

--
-- Table structure for table `assign_module`
--

CREATE TABLE `assign_module` (
  `assign_module_id` int(11) NOT NULL,
  `user_role` varchar(300) DEFAULT NULL,
  `menu_page` varchar(300) DEFAULT NULL,
  `assign_module_add_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `assign_module`
--

INSERT INTO `assign_module` (`assign_module_id`, `user_role`, `menu_page`, `assign_module_add_date`) VALUES
(347, 'Data Entry Operator', 'mark_attendance.php', '2020-11-06 12:35:27'),
(348, 'Data Entry Operator', 'attendance_report.php', '2020-11-06 12:35:27'),
(349, 'Data Entry Operator', 'manual_attendance.php', '2020-11-06 12:35:27'),
(463, 'manager', 'system_setting.php', '2022-02-12 13:05:35'),
(464, 'manager', 'add_employee.php', '2022-02-12 13:05:35'),
(465, 'manager', 'search_employee.php', '2022-02-12 13:05:35'),
(466, 'manager', 'employee_card.php', '2022-02-12 13:05:35'),
(467, 'manager', 'mark_attendance.php', '2022-02-12 13:05:35'),
(468, 'manager', 'attendance_report.php', '2022-02-12 13:05:35'),
(469, 'manager', 'emp_salary.php', '2022-02-12 13:05:35'),
(470, 'manager', 'manual_attendance.php', '2022-02-12 13:05:35'),
(471, 'manager', 'print_qr.php', '2022-02-12 13:05:35'),
(472, 'manager', 'attendance_sheet.php', '2022-02-12 13:05:35'),
(473, 'manager', 'leave_management.php', '2022-02-12 13:05:35'),
(564, 'employee', 'employee_card.php', '2022-07-28 05:51:19'),
(565, 'employee', 'attendance_report.php', '2022-07-28 05:51:19'),
(566, 'employee', 'print_qr.php', '2022-07-28 05:51:19'),
(567, 'employee', 'attendance_sheet.php', '2022-07-28 05:51:19'),
(568, 'Painters', 'employee_card.php', '2022-07-28 05:52:10'),
(569, 'Painters', 'mark_attendance.php', '2022-07-28 05:52:10'),
(570, 'Painters', 'attendance_report.php', '2022-07-28 05:52:10'),
(571, 'Painters', 'print_qr.php', '2022-07-28 05:52:10'),
(572, 'Painters', 'attendance_sheet.php', '2022-07-28 05:52:10'),
(586, 'administrator', 'system_setting.php', '2023-11-04 19:05:17'),
(587, 'administrator', 'add_employee.php', '2023-11-04 19:05:17'),
(588, 'administrator', 'search_employee.php', '2023-11-04 19:05:17'),
(589, 'administrator', 'employee_card.php', '2023-11-04 19:05:17'),
(590, 'administrator', 'mark_attendance.php', '2023-11-04 19:05:17'),
(591, 'administrator', 'attendance_report.php', '2023-11-04 19:05:17'),
(592, 'administrator', 'manual_attendance.php', '2023-11-04 19:05:17'),
(593, 'administrator', 'attendance_sheet.php', '2023-11-04 19:05:17'),
(594, 'administrator', 'leave_management.php', '2023-11-04 19:05:17');

-- --------------------------------------------------------

--
-- Table structure for table `assign_user_role`
--

CREATE TABLE `assign_user_role` (
  `assign_user_role_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `user_role` varchar(300) DEFAULT NULL,
  `assign_user_role_remarks` text DEFAULT NULL,
  `assign_user_role_add_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `assign_user_role`
--

INSERT INTO `assign_user_role` (`assign_user_role_id`, `user_id`, `user_role`, `assign_user_role_remarks`, `assign_user_role_add_date`) VALUES
(33, 1, 'administrator', 'Assign by User: admin', '2019-02-28 19:20:26');

-- --------------------------------------------------------

--
-- Table structure for table `branch`
--

CREATE TABLE `branch` (
  `branch_id` int(11) NOT NULL,
  `branch_name` varchar(500) DEFAULT NULL,
  `branch_logo` varchar(300) NOT NULL DEFAULT 'user_default.png',
  `branch_location` text DEFAULT NULL,
  `branch_timing` longtext DEFAULT NULL,
  `distance` text DEFAULT NULL,
  `minute_allowed` varchar(300) DEFAULT NULL,
  `branch_add_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `branch`
--

INSERT INTO `branch` (`branch_id`, `branch_name`, `branch_logo`, `branch_location`, `branch_timing`, `distance`, `minute_allowed`, `branch_add_date`) VALUES
(1, 'King Painting', '1694238441616d69f8840c5.png', '3.2351983,101.7143028', '[{\"sunday\":{\"opening_time\":\"08:00:00\",\"closing_time\":\"17:30:00\"}},{\"monday\":{\"opening_time\":\"08:00:00\",\"closing_time\":\"17:30:00\"}},{\"tuesday\":{\"opening_time\":\"08:00:00\",\"closing_time\":\"17:30:00\"}},{\"wednesday\":{\"opening_time\":\"08:00:00\",\"closing_time\":\"17:30:00\"}},{\"thursday\":{\"opening_time\":\"08:00:00\",\"closing_time\":\"17:30:00\"}},{\"friday\":{\"opening_time\":\"08:00:00\",\"closing_time\":\"17:30:00\"}},{\"saturday\":{\"opening_time\":\"08:00:00\",\"closing_time\":\"17:30:00\"}}]', '1000', '30', '2019-02-07 10:34:16');

-- --------------------------------------------------------

--
-- Table structure for table `emp_attendance`
--

CREATE TABLE `emp_attendance` (
  `att_id` int(11) NOT NULL,
  `emp_id` varchar(100) DEFAULT NULL,
  `att_date` date DEFAULT NULL,
  `att_sts` varchar(300) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `in_time` varchar(300) DEFAULT NULL,
  `out_time` varchar(300) DEFAULT NULL,
  `break_start` varchar(300) DEFAULT NULL,
  `break_end` varchar(300) DEFAULT NULL,
  `admin_id` varchar(100) DEFAULT NULL,
  `description` mediumtext CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `att_add_date` timestamp NULL DEFAULT current_timestamp(),
  `location` mediumtext CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `menus`
--

CREATE TABLE `menus` (
  `id` int(11) NOT NULL,
  `title` text DEFAULT NULL,
  `page` text DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `icon` varchar(300) NOT NULL DEFAULT 'fa fa-link',
  `sort_order` varchar(20) DEFAULT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `menus`
--

INSERT INTO `menus` (`id`, `title`, `page`, `parent_id`, `icon`, `sort_order`, `created_date`) VALUES
(4, 'Permissions', 'assign_rights.php', 5, 'fa fa-unlock-alt\r\n', NULL, '2019-02-05 19:47:33'),
(5, 'Users', '#', NULL, 'fa fa-users', '3', '2019-02-05 19:47:58'),
(6, 'role management', 'add_remove_user_roles.php', 5, 'fa fa-cog', NULL, '2019-02-05 20:33:23'),
(7, 'users', 'users.php', 5, 'fa fa-users', NULL, '2019-02-05 20:33:23'),
(9, 'define roles', 'user_role_management.php', 5, 'fa fa-cog', NULL, '2019-02-10 19:04:56'),
(11, 'Manage Branch', 'branch.php', 11, 'fa fa-link', NULL, '2019-02-13 22:07:26'),
(37, 'Preferences', '', 0, 'fa fa-cogs\r\n', NULL, '2020-01-11 14:04:00'),
(38, 'System Settings', 'system_setting.php', 37, 'fa fa-cog\r\n', NULL, '2020-01-11 14:05:03'),
(39, 'Employees', '', 0, 'fa fa-user-o\r\n', NULL, '2020-01-15 08:30:05'),
(40, 'Register Employee', 'add_employee.php', 39, 'fa fa-user-plus\r\n', NULL, '2020-01-15 08:30:39'),
(41, 'Search Employee', 'search_employee.php', 39, 'fa fa-search\r\n', NULL, '2020-01-15 09:01:28'),
(42, 'Print Card', 'employee_card.php', 39, 'fa fa-500px\r\n', NULL, '2020-01-15 09:25:32'),
(43, 'Mark Attendance', 'mark_attendance.php', 39, 'fa fa-qrcode\r\n', NULL, '2020-01-15 18:33:43'),
(44, 'Report', '', 0, 'fa fa-bar-chart-o\r\n', NULL, '2020-01-18 15:02:06'),
(45, 'Attendance Report', 'attendance_report.php', 44, 'fa fa-calendar-check-o\r\n', NULL, '2020-01-18 15:02:58'),
(46, 'Salary', 'emp_salary.php', 39, 'fa fa-money\r\n', NULL, '2020-02-23 20:05:11'),
(47, 'Manual Attendance', 'manual_attendance.php', 39, 'fa fa-file-o\r\n', NULL, '2020-02-24 16:59:11'),
(48, 'Get QR', 'print_qr.php', 37, 'fa fa-qrcode\r\n', NULL, '2020-05-15 19:14:07'),
(49, 'Attendance Sheet', 'attendance_sheet.php', 44, 'fa fa-bar-chart-o\r\n', NULL, '2020-11-25 17:12:27'),
(50, 'Leave Management', 'leave_management.php', 39, 'fa fa-edit\r\n', NULL, '2020-11-25 17:28:36');

-- --------------------------------------------------------

--
-- Table structure for table `request_leaves`
--

CREATE TABLE `request_leaves` (
  `id` int(11) NOT NULL,
  `emp_id` varchar(300) DEFAULT NULL,
  `from_date` date DEFAULT NULL,
  `to_date` date DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `status` varchar(300) DEFAULT 'pending',
  `timestamp` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `salary`
--

CREATE TABLE `salary` (
  `id` int(11) NOT NULL,
  `emp_id` int(11) DEFAULT NULL,
  `amount` double DEFAULT 0,
  `dated` date DEFAULT NULL,
  `remarks` text DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `timestamp` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `company_name` text DEFAULT NULL,
  `title` text DEFAULT NULL,
  `logo` text DEFAULT NULL,
  `email` text DEFAULT NULL,
  `phone` text DEFAULT NULL,
  `timezone` varchar(500) DEFAULT 'America/Los_Angeles',
  `open_hour` time DEFAULT NULL,
  `close_hour` time DEFAULT NULL,
  `minute_allowed` varchar(300) DEFAULT '5',
  `status` varchar(300) NOT NULL DEFAULT 'deactivate',
  `location` text DEFAULT NULL,
  `distance` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `company_name`, `title`, `logo`, `email`, `phone`, `timezone`, `open_hour`, `close_hour`, `minute_allowed`, `status`, `location`, `distance`) VALUES
(2, 'Convert Generation', 'Information Technology', '6400418966546958286d45.png', 'info@cgit.pk', '+923226224202', 'Asia/Karachi', '08:30:00', '17:30:00', '15', 'activate', '31.418577,73.0589922', '1000');

-- --------------------------------------------------------

--
-- Table structure for table `tracking`
--

CREATE TABLE `tracking` (
  `id` int(11) NOT NULL,
  `pic_name` text DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `dated` date DEFAULT NULL,
  `datetime` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(300) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `user_email` varchar(400) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `user_phone` varchar(300) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `user_password` text CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `user_fullname` varchar(300) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `user_branch` varchar(300) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `user_address` text CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `user_cnic` varchar(300) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `designation` varchar(300) CHARACTER SET utf8 COLLATE utf8_general_mysql500_ci DEFAULT NULL,
  `device_id` varchar(300) DEFAULT NULL,
  `comment` text DEFAULT NULL,
  `user_work_status` text DEFAULT NULL,
  `allow_multiple_login` varchar(300) DEFAULT 'no',
  `user_status` varchar(300) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'enable',
  `user_created_id` int(11) DEFAULT NULL,
  `user_add_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `user_pic` varchar(300) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT 'default.png'
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `user_email`, `user_phone`, `user_password`, `user_fullname`, `user_branch`, `user_address`, `user_cnic`, `designation`, `device_id`, `comment`, `user_work_status`, `allow_multiple_login`, `user_status`, `user_created_id`, `user_add_date`, `user_pic`) VALUES
(1, 'admin', 'info@cgit.pk', '', 'abc123', 'Admin', '1', '81 Campbell St, Surry Hills NSW 2010', '', '', '2cbbc099194b8451', NULL, NULL, 'yes', 'enable', 1, '2019-02-06 11:23:46', '153963164062df70807ff54.png');

-- --------------------------------------------------------

--
-- Table structure for table `user_roles`
--

CREATE TABLE `user_roles` (
  `user_role_id` int(11) NOT NULL,
  `user_role_name` varchar(300) DEFAULT NULL,
  `user_role_status` varchar(300) NOT NULL DEFAULT 'enable',
  `user_role_add_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `user_roles`
--

INSERT INTO `user_roles` (`user_role_id`, `user_role_name`, `user_role_status`, `user_role_add_date`) VALUES
(1, 'administrator', 'enable', '2019-02-07 19:26:05'),
(3, 'Painters', 'enable', '2019-02-07 19:59:38'),
(5, 'Project Manager', 'enable', '2019-02-07 20:02:24'),
(6, 'Accountant', 'enable', '2019-03-23 17:00:18'),
(7, 'Remote Employee', 'enable', '2020-11-06 12:33:40'),
(9, 'Virtual Assistant ', 'enable', '2022-07-27 09:16:25'),
(10, 'Project Coordinator ', 'enable', '2022-07-27 09:17:30'),
(11, 'IT Support', 'enable', '2022-07-27 09:17:53'),
(12, 'Supervisor ', 'enable', '2022-07-27 09:18:23'),
(13, 'Cleaner', 'enable', '2022-07-27 09:36:36'),
(14, 'employee', 'enable', '2022-07-27 11:10:24');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `assign_module`
--
ALTER TABLE `assign_module`
  ADD PRIMARY KEY (`assign_module_id`);

--
-- Indexes for table `assign_user_role`
--
ALTER TABLE `assign_user_role`
  ADD PRIMARY KEY (`assign_user_role_id`);

--
-- Indexes for table `branch`
--
ALTER TABLE `branch`
  ADD PRIMARY KEY (`branch_id`),
  ADD UNIQUE KEY `branch_name` (`branch_name`);

--
-- Indexes for table `emp_attendance`
--
ALTER TABLE `emp_attendance`
  ADD PRIMARY KEY (`att_id`);

--
-- Indexes for table `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `request_leaves`
--
ALTER TABLE `request_leaves`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `salary`
--
ALTER TABLE `salary`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tracking`
--
ALTER TABLE `tracking`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `user_email` (`user_email`);

--
-- Indexes for table `user_roles`
--
ALTER TABLE `user_roles`
  ADD PRIMARY KEY (`user_role_id`),
  ADD UNIQUE KEY `user_role_name` (`user_role_name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `assign_module`
--
ALTER TABLE `assign_module`
  MODIFY `assign_module_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=595;

--
-- AUTO_INCREMENT for table `assign_user_role`
--
ALTER TABLE `assign_user_role`
  MODIFY `assign_user_role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=226;

--
-- AUTO_INCREMENT for table `branch`
--
ALTER TABLE `branch`
  MODIFY `branch_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `emp_attendance`
--
ALTER TABLE `emp_attendance`
  MODIFY `att_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `menus`
--
ALTER TABLE `menus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `request_leaves`
--
ALTER TABLE `request_leaves`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `salary`
--
ALTER TABLE `salary`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tracking`
--
ALTER TABLE `tracking`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=141;

--
-- AUTO_INCREMENT for table `user_roles`
--
ALTER TABLE `user_roles`
  MODIFY `user_role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
