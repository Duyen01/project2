-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Máy chủ: localhost:3306
-- Thời gian đã tạo: Th9 03, 2021 lúc 11:57 PM
-- Phiên bản máy phục vụ: 5.7.35-0ubuntu0.18.04.1
-- Phiên bản PHP: 7.4.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `laravel`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `admin`
--

CREATE TABLE `admin` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `admin`
--

INSERT INTO `admin` (`id`, `name`, `email`, `password`) VALUES
(1, 'Trần Văn Đức', 'ductran0207.bkhn@gmail.com', '$2y$10$UHJpR8Y/G21Q/NSo0XNYAe9HjS48c3lXDUWM1xUnjvNsUAsPDGAkO');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `bill`
--

CREATE TABLE `bill` (
  `id` int(10) UNSIGNED NOT NULL,
  `idStudent` int(10) UNSIGNED NOT NULL,
  `idTypepay` int(11) NOT NULL,
  `idAdmin` int(10) UNSIGNED NOT NULL,
  `dateTime` date NOT NULL,
  `money` double NOT NULL,
  `note` text COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `course`
--

CREATE TABLE `course` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `course`
--

INSERT INTO `course` (`id`, `name`) VALUES
(1, 'K11'),
(2, 'K10');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `grade`
--

CREATE TABLE `grade` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `idMajor` int(10) UNSIGNED NOT NULL,
  `idCourse` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `grade`
--

INSERT INTO `grade` (`id`, `name`, `idMajor`, `idCourse`) VALUES
(1, 'BKD01K11', 1, 1),
(2, 'BKD02K11', 1, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `major`
--

CREATE TABLE `major` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `major`
--

INSERT INTO `major` (`id`, `name`) VALUES
(1, 'Lập trình máy tính'),
(2, 'Quản trị mạng');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `scholarship`
--

CREATE TABLE `scholarship` (
  `id` int(10) UNSIGNED NOT NULL,
  `money` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `scholarship`
--

INSERT INTO `scholarship` (`id`, `money`) VALUES
(1, 10000000);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `student`
--

CREATE TABLE `student` (
  `id` int(10) UNSIGNED NOT NULL,
  `firstname` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastname` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` tinyint(1) NOT NULL,
  `email` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dob` date NOT NULL,
  `status` tinyint(4) NOT NULL,
  `idGrade` int(10) UNSIGNED NOT NULL,
  `idScholarship` int(10) UNSIGNED NOT NULL,
  `idTypePay` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `student`
--

INSERT INTO `student` (`id`, `firstname`, `lastname`, `gender`, `email`, `phone`, `password`, `address`, `dob`, `status`, `idGrade`, `idScholarship`, `idTypePay`) VALUES
(1, 'Trần Văn', 'Đức', 1, 'ductran0207.bkhn@gmail.com', '1234567890', '$2y$10$vRIbK0z8/jJkEg0IcnGxEenQBa6I0mx0FRQzU.fWqqL2dMaGPJtDC', 'Thanh Hoa', '2021-08-30', 1, 1, 1, 2);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tuition`
--

CREATE TABLE `tuition` (
  `idMajor` int(10) UNSIGNED NOT NULL,
  `idCourse` int(10) UNSIGNED NOT NULL,
  `tuitionNorm` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tuition`
--

INSERT INTO `tuition` (`idMajor`, `idCourse`, `tuitionNorm`) VALUES
(1, 1, 2500000);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `typepay`
--

CREATE TABLE `typepay` (
  `id` int(10) UNSIGNED NOT NULL,
  `typeofpay` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `begin` tinyint(4) NOT NULL,
  `end` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `typepay`
--

INSERT INTO `typepay` (`id`, `typeofpay`, `begin`, `end`) VALUES
(1, 'Months', 1, 20),
(2, 'Years', 1, 40);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admin_email_unique` (`email`);

--
-- Chỉ mục cho bảng `bill`
--
ALTER TABLE `bill`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bill_idstudent_foreign` (`idStudent`),
  ADD KEY `bill_idadmin_foreign` (`idAdmin`);

--
-- Chỉ mục cho bảng `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `grade`
--
ALTER TABLE `grade`
  ADD PRIMARY KEY (`id`),
  ADD KEY `grade_idmajor_foreign` (`idMajor`),
  ADD KEY `grade_idcourse_foreign` (`idCourse`);

--
-- Chỉ mục cho bảng `major`
--
ALTER TABLE `major`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `scholarship`
--
ALTER TABLE `scholarship`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `student_email_unique` (`email`),
  ADD UNIQUE KEY `student_phone_unique` (`phone`),
  ADD KEY `student_idgrade_foreign` (`idGrade`),
  ADD KEY `student_idscholarship_foreign` (`idScholarship`),
  ADD KEY `student_idtypepay_foreign` (`idTypePay`);

--
-- Chỉ mục cho bảng `tuition`
--
ALTER TABLE `tuition`
  ADD PRIMARY KEY (`idCourse`,`idMajor`),
  ADD KEY `tuition_idmajor_foreign` (`idMajor`);

--
-- Chỉ mục cho bảng `typepay`
--
ALTER TABLE `typepay`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `bill`
--
ALTER TABLE `bill`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `course`
--
ALTER TABLE `course`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `grade`
--
ALTER TABLE `grade`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `major`
--
ALTER TABLE `major`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `scholarship`
--
ALTER TABLE `scholarship`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `student`
--
ALTER TABLE `student`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `typepay`
--
ALTER TABLE `typepay`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `bill`
--
ALTER TABLE `bill`
  ADD CONSTRAINT `bill_idadmin_foreign` FOREIGN KEY (`idAdmin`) REFERENCES `admin` (`id`),
  ADD CONSTRAINT `bill_idstudent_foreign` FOREIGN KEY (`idStudent`) REFERENCES `student` (`id`);

--
-- Các ràng buộc cho bảng `grade`
--
ALTER TABLE `grade`
  ADD CONSTRAINT `grade_idcourse_foreign` FOREIGN KEY (`idCourse`) REFERENCES `course` (`id`),
  ADD CONSTRAINT `grade_idmajor_foreign` FOREIGN KEY (`idMajor`) REFERENCES `major` (`id`);

--
-- Các ràng buộc cho bảng `student`
--
ALTER TABLE `student`
  ADD CONSTRAINT `student_idgrade_foreign` FOREIGN KEY (`idGrade`) REFERENCES `grade` (`id`),
  ADD CONSTRAINT `student_idscholarship_foreign` FOREIGN KEY (`idScholarship`) REFERENCES `scholarship` (`id`),
  ADD CONSTRAINT `student_idtypepay_foreign` FOREIGN KEY (`idTypePay`) REFERENCES `typepay` (`id`);

--
-- Các ràng buộc cho bảng `tuition`
--
ALTER TABLE `tuition`
  ADD CONSTRAINT `tuition_idcourse_foreign` FOREIGN KEY (`idCourse`) REFERENCES `course` (`id`),
  ADD CONSTRAINT `tuition_idmajor_foreign` FOREIGN KEY (`idMajor`) REFERENCES `major` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
