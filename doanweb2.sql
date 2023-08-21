-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th4 28, 2021 lúc 03:16 AM
-- Phiên bản máy phục vụ: 10.4.18-MariaDB
-- Phiên bản PHP: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `doanweb2`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_account`
--

DROP TABLE IF EXISTS `tbl_account`;
CREATE TABLE `tbl_account` (
  `accountType` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `tbl_account`
--

INSERT INTO `tbl_account` (`accountType`, `username`, `password`) VALUES
('Administrator', 'admin', '63a9f0ea7bb98050796b649e85481845'),
('Administrator', 'hello', '202cb962ac59075b964b07152d234b70'),
('Customer', 'loc', '202cb962ac59075b964b07152d234b70');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_cart`
--

DROP TABLE IF EXISTS `tbl_cart`;
CREATE TABLE `tbl_cart` (
  `cartID` int(10) NOT NULL,
  `userName` varchar(100) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_cart_info`
--

DROP TABLE IF EXISTS `tbl_cart_info`;
CREATE TABLE `tbl_cart_info` (
  `cartID` int(10) NOT NULL,
  `productID` int(10) NOT NULL,
  `qty` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_category`
--

DROP TABLE IF EXISTS `tbl_category`;
CREATE TABLE `tbl_category` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(100) NOT NULL,
  `image_name` varchar(255) NOT NULL,
  `featured` varchar(10) NOT NULL,
  `active` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `tbl_category`
--

INSERT INTO `tbl_category` (`id`, `title`, `image_name`, `featured`, `active`) VALUES
(10, 'Món Gà', 'Food_Category_359.jpg', 'Yes', 'Yes'),
(11, 'Món Bò', 'Food_Category_214.png', 'Yes', 'Yes'),
(12, 'Món Cá', 'Food_Category_244.jpg', 'Yes', 'Yes'),
(13, 'Món Tôm', 'Food_Category_104.png', 'Yes', 'Yes'),
(14, 'Pizza', 'Food_Category_864.jpg', 'Yes', 'Yes'),
(15, 'Burger', 'Food_Category_46.jpg', 'Yes', 'Yes');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_food`
--

DROP TABLE IF EXISTS `tbl_food`;
CREATE TABLE `tbl_food` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `price` varchar(255) NOT NULL,
  `image_name` varchar(255) NOT NULL,
  `category_id` int(10) UNSIGNED NOT NULL,
  `featured` varchar(10) NOT NULL,
  `active` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `tbl_food`
--

INSERT INTO `tbl_food` (`id`, `title`, `description`, `price`, `image_name`, `category_id`, `featured`, `active`) VALUES
(12, 'Gà Chiên Xá Xị', 'Gà Chiên Xá Xị', '25000', 'Food-Name-6638.jpg', 10, 'Yes', 'Yes'),
(13, 'Cánh Gà Chiên Tỏi Lá Chanh', 'Cánh Gà Chiên Tỏi Lá Chanh', '30000', 'Food-Name-7698.jpg', 10, 'Yes', 'Yes'),
(14, 'Gà Xốt Mật Ong Mù Tạt', 'Gà Xốt Mật Ong Mù Tạt', '50000', 'Food-Name-9046.jpg', 10, 'Yes', 'Yes'),
(15, 'Gà Rim Ngũ Vị', 'Gà Rim Ngũ Vị', '35000', 'Food-Name-6449.jpg', 10, 'Yes', 'Yes'),
(16, 'Bò Kho Nước Dừa', 'Bò Kho Nước Dừa', '50000', 'Food-Name-1067.jpg', 11, 'Yes', 'Yes'),
(17, 'Gân Bò Áp Chảo', 'Gân Bò Áp Chảo', '40000', 'Food-Name-9637.png', 11, 'Yes', 'Yes'),
(18, 'Bắp Bò Hầm Gừng Xả', 'Bắp Bò Hầm Gừng Xả', '50000', 'Food-Name-7276.jpg', 11, 'Yes', 'Yes'),
(19, 'Cá Kho Quẹt', 'Cá Kho Quẹt', '35000', 'Food-Name-5581.jpg', 12, 'Yes', 'Yes'),
(20, 'Cá Kèo Nướng Muối Ớt', 'Cá Kèo Nướng Muối Ớt', '40000', 'Food-Name-8713.jpg', 12, 'Yes', 'Yes'),
(21, 'Cá Xiêm Nướng Ớt Xiêm', 'Cá Xiêm Nướng Ớt Xiêm', '60000', 'Food-Name-109.jpg', 12, 'Yes', 'Yes'),
(22, 'Cá Chẽm Chiên Hạnh Nhân', 'Cá Chẽm Chiên Hạnh Nhân', '55000', 'Food-Name-7198.jpg', 12, 'Yes', 'Yes'),
(23, 'Tôm Chiên Dừa Xốt Bạc Hà', 'Tôm Chiên Dừa Xốt Bạc Hà', '45000', 'Food-Name-2909.jpg', 13, 'Yes', 'Yes'),
(24, 'Pizza Hải Sản', 'Pizza Hải Sản', '150000', 'Food-Name-1695.jpg', 14, 'Yes', 'Yes'),
(25, 'Bánh Tôm Hẹ Chiên Giòn', 'Bánh Tôm Hẹ Chiên Giòn', '60000', 'Food-Name-7102.jpg', 13, 'Yes', 'Yes'),
(26, 'Pizza Mì Sợi', 'Pizza Mì Sợi', '100000', 'Food-Name-1745.jpg', 14, 'Yes', 'Yes'),
(27, 'Tôm Nướng Muối Ớt', 'Tôm Nướng Muối Ớt', '50000', 'Food-Name-6642.png', 13, 'Yes', 'Yes'),
(28, 'Tôm Chiên Hoành Thánh', 'Tôm Chiên Hoành Thánh', '37000', 'Food-Name-1798.png', 13, 'Yes', 'Yes'),
(29, 'Burger Cá Ngừ', 'Burger Cá Ngừ', '45000', 'Food-Name-2634.png', 15, 'Yes', 'Yes'),
(30, 'Burger Cá Hồi', 'Burger Cá Hồi', '55000', 'Food-Name-1318.jpg', 15, 'Yes', 'Yes'),
(31, 'Burger Kiểu Mexico', 'Burger Kiểu Mexico', '60000', 'Food-Name-9666.jpg', 15, 'Yes', 'Yes'),
(32, 'Burger Gà Xé', 'Burger Gà Xé', '42000', 'Food-Name-183.jpg', 15, 'Yes', 'Yes');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_order`
--

DROP TABLE IF EXISTS `tbl_order`;
CREATE TABLE `tbl_order` (
  `id` int(10) NOT NULL,
  `cartID` int(11) NOT NULL,
  `total` int(10) DEFAULT NULL,
  `order_date` datetime NOT NULL,
  `status` varchar(50) NOT NULL,
  `customer_name` varchar(150) NOT NULL,
  `customer_contact` varchar(20) NOT NULL,
  `customer_email` varchar(150) NOT NULL,
  `customer_address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_order_info`
--

DROP TABLE IF EXISTS `tbl_order_info`;
CREATE TABLE `tbl_order_info` (
  `orderID` int(11) NOT NULL,
  `cartID` int(11) NOT NULL,
  `productID` int(11) NOT NULL,
  `title` varchar(30) NOT NULL,
  `qty` int(11) NOT NULL,
  `price` int(10) NOT NULL,
  `total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `tbl_account`
--
ALTER TABLE `tbl_account`
  ADD PRIMARY KEY (`username`);

--
-- Chỉ mục cho bảng `tbl_cart`
--
ALTER TABLE `tbl_cart`
  ADD PRIMARY KEY (`cartID`),
  ADD KEY `userName` (`userName`);

--
-- Chỉ mục cho bảng `tbl_cart_info`
--
ALTER TABLE `tbl_cart_info`
  ADD PRIMARY KEY (`cartID`,`productID`);

--
-- Chỉ mục cho bảng `tbl_category`
--
ALTER TABLE `tbl_category`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `tbl_food`
--
ALTER TABLE `tbl_food`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `tbl_order`
--
ALTER TABLE `tbl_order`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `tbl_order_info`
--
ALTER TABLE `tbl_order_info`
  ADD PRIMARY KEY (`orderID`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `tbl_category`
--
ALTER TABLE `tbl_category`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT cho bảng `tbl_food`
--
ALTER TABLE `tbl_food`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT cho bảng `tbl_order`
--
ALTER TABLE `tbl_order`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `tbl_cart_info`
--
ALTER TABLE `tbl_cart_info`
  ADD CONSTRAINT `tbl_cart_info_ibfk_1` FOREIGN KEY (`cartID`) REFERENCES `tbl_cart` (`cartID`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `tbl_order_info`
--
ALTER TABLE `tbl_order_info`
  ADD CONSTRAINT `tbl_order_info_ibfk_1` FOREIGN KEY (`orderID`) REFERENCES `tbl_order` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
