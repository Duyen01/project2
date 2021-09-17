-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Máy chủ: localhost:3306
-- Thời gian đã tạo: Th8 30, 2021 lúc 11:05 AM
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
-- Cơ sở dữ liệu: `pmd`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `admin`
--

CREATE TABLE `admin` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `admin`
--

INSERT INTO `admin` (`id`, `name`, `email`, `password`) VALUES
(1, 'Trần Văn Đức', 'ductran0207.bkhn@gmail.com', '1234567');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `bill`
--

CREATE TABLE `bill` (
  `id` int(10) UNSIGNED NOT NULL,
  `idStudent` int(10) UNSIGNED NOT NULL,
  `dateTime` date NOT NULL,
  `money` double NOT NULL,
  `idAdmin` int(10) UNSIGNED NOT NULL,
  `note` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `sholarship` double NOT NULL
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
(2, 'K12');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `grade`
--

CREATE TABLE `grade` (
  `id` int(10) UNSIGNED NOT NULL,
  `idMajor` int(10) UNSIGNED NOT NULL,
  `idCourse` int(10) UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `grade`
--

INSERT INTO `grade` (`id`, `idMajor`, `idCourse`, `name`) VALUES
(1, 2, 1, 'BKN01K11'),
(2, 1, 1, 'BKD01K11'),
(3, 1, 2, 'BKD02K10');

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
(1, 'Lập trình máy tínhhhh'),
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
(1, 10000000),
(2, 6000000);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `student`
--

CREATE TABLE `student` (
  `id` int(10) UNSIGNED NOT NULL,
  `firstname` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastname` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` tinyint(1) NOT NULL,
  `idGrade` int(10) UNSIGNED NOT NULL,
  `idScholarship` int(10) UNSIGNED NOT NULL,
  `idTypePay` int(10) UNSIGNED NOT NULL,
  `email` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `student`
--

INSERT INTO `student` (`id`, `firstname`, `lastname`, `gender`, `idGrade`, `idScholarship`, `idTypePay`, `email`, `password`, `status`) VALUES
(1, 'Tran', 'Duc', 1, 1, 1, 1, 'ductran0207.bkhn@gmail.com', '$2y$10$vBtD/XSCKwRofVxncHX3IOxQlqRwf1G9tkJ4Lk7zCkIW6cXXDe3Be', 1),
(2, 'Mai', 'Duyen', 0, 1, 1, 1, 'ductran7207.bkhn@gmail.com', '$2y$10$p.CbGkR0RM1Y97frRYhI6utEM0dvGZo.tKK4DhlA4zSTt4QSprRKC', 1),
(3, 'Tran', 'Van Duc', 0, 1, 1, 2, 'ductran@gmail.com', '$2y$10$xwUvLo2DfnrUaZ4/JVcsr.NEQb4Q1eHa.2rAv6uAaGqYCj7S9Exui', 0);

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
(1, 1, 332500000),
(1, 2, 2500000),
(2, 2, 2500000);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `typepay`
--

CREATE TABLE `typepay` (
  `id` int(10) UNSIGNED NOT NULL,
  `typeofpay` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `begin` date NOT NULL,
  `end` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `typepay`
--

INSERT INTO `typepay` (`id`, `typeofpay`, `begin`, `end`) VALUES
(1, 'Months', '2021-08-02', '2021-08-20'),
(2, 'Years', '2021-08-03', '2021-08-06'),
(3, 'Semester', '2021-08-01', '2021-08-02');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `major`
--
ALTER TABLE `major`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `scholarship`
--
ALTER TABLE `scholarship`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `student`
--
ALTER TABLE `student`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `typepay`
--
ALTER TABLE `typepay`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
