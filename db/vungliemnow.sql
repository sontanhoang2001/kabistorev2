-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th1 12, 2021 lúc 08:28 AM
-- Phiên bản máy phục vụ: 10.4.14-MariaDB
-- Phiên bản PHP: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `vungliemnow`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `adminId` int(11) NOT NULL,
  `adminName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `adminEmail` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `adminUser` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `adminPass` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `level` int(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_admin`
--

INSERT INTO `tbl_admin` (`adminId`, `adminName`, `adminEmail`, `adminUser`, `adminPass`, `level`) VALUES
(1, 'phu', 'phu@gmail.com', 'phuAdmin', 'e10adc3949ba59abbe56e057f20f883e', 0),
(2, 'admin', 'admin@gmail.com', 'admin', 'e10adc3949ba59abbe56e057f20f883e', 0),
(3, 'ng TRuong Giang', 'Giang@gmail.com', 'admingang', '123456', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_brand`
--

CREATE TABLE `tbl_brand` (
  `brandId` int(11) NOT NULL,
  `brandName` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_brand`
--

INSERT INTO `tbl_brand` (`brandId`, `brandName`) VALUES
(18, 'Tấn Hoàng Shop'),
(19, 'TMT Tea'),
(20, 'Tí Nị Coffee'),
(21, 'Ớt Sim'),
(22, 'Taiwan Lattea');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_cart`
--

CREATE TABLE `tbl_cart` (
  `cartId` int(11) NOT NULL,
  `productId` int(11) NOT NULL,
  `sId` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `productName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `price` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `quantity` int(11) NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `customerId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_cart`
--

INSERT INTO `tbl_cart` (`cartId`, `productId`, `sId`, `productName`, `price`, `quantity`, `image`, `customerId`) VALUES
(270, 34, 'com8p3l9dibvf38spmh8h791dv', 'Trà Sửa TMT', '25000', 1, '2a32e6f826.png', 0),
(273, 35, '8e5n1kd4s7f4opjd0oosmmjdi4', 'Trà Sửa 100%', '28000', 1, 'ba97e37e36.jpg', 0),
(277, 35, 'i8oig2g9g1anlji5jhplanvr5p', 'Trà Sửa 100%', '28000', 5, 'ba97e37e36.jpg', 0),
(278, 35, 'i8oig2g9g1anlji5jhplanvr5p', 'Trà Sửa 100%', '28000', 5, 'ba97e37e36.jpg', 0),
(280, 37, 'b1d3abagi0fq3ieqoqqrdp6t67', 'Trà Sửa BoBa PoP', '25000', 1, 'ceb6a1e6a7.jpg', 0),
(283, 36, '1gv64gmthd5r2ajbb92s86o11o', 'Trà Sửa Maria Cheese Tea', '24000', 1, 'a1ec21098e.jpg', 0),
(285, 37, 'uinl8f030en99hlh7pahsqnpms', 'Trà Sửa BoBa PoP', '25000', 1, 'ceb6a1e6a7.jpg', 0),
(286, 37, 'uinl8f030en99hlh7pahsqnpms', 'Trà Sửa BoBa PoP', '25000', 1, 'ceb6a1e6a7.jpg', 0),
(287, 37, 'uinl8f030en99hlh7pahsqnpms', 'Trà Sửa BoBa PoP', '25000', 1, 'ceb6a1e6a7.jpg', 0),
(288, 35, 'j55h1ua68061n329a1j0dsp7lv', 'Trà Sửa 100%', '28000', 4, 'ba97e37e36.jpg', 0),
(289, 37, 'guid6ntgla1ah3ia8qgbd5ca0d', 'Trà Sửa BoBa PoP', '25000', 1, 'ceb6a1e6a7.jpg', 0),
(290, 34, 'guid6ntgla1ah3ia8qgbd5ca0d', 'Trà Sửa TMT', '25000', 1, '2a32e6f826.png', 0),
(291, 36, 'ceeifi6qtd3slstqijuoqp66rv', 'Trà Sửa Maria Cheese Tea', '24000', 1, 'a1ec21098e.jpg', 0),
(292, 37, 'ceeifi6qtd3slstqijuoqp66rv', 'Trà Sửa BoBa PoP', '25000', 1, 'ceb6a1e6a7.jpg', 0),
(297, 43, 'raj70vi72bbgk2n73j0jqcuqpf', 'test6', '50000', 1, '2c21a29afa.jpg', 0),
(303, 44, '95qmdh92a4lm5b2k5edl63fc0u', 'test7', '30000', 1, '936be34735.jpg', 6),
(304, 41, 'b3kd4olq836gu02f29os95lm36', 'test4', '50000', 1, 'c7377e09fe.jpg', 0),
(305, 41, 'b3kd4olq836gu02f29os95lm36', 'test4', '50000', 1, 'c7377e09fe.jpg', 6);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_category`
--

CREATE TABLE `tbl_category` (
  `catId` int(11) NOT NULL,
  `catName` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_category`
--

INSERT INTO `tbl_category` (`catId`, `catName`) VALUES
(19, 'Trà Sửa'),
(20, 'Sinh Tố');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_compare`
--

CREATE TABLE `tbl_compare` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `productId` int(11) NOT NULL,
  `productName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `price` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_customer`
--

CREATE TABLE `tbl_customer` (
  `id` int(11) NOT NULL,
  `username` varchar(25) CHARACTER SET utf8 NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `avatar` varchar(255) CHARACTER SET utf8 NOT NULL,
  `date_of_birth` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `gender` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(30) CHARACTER SET utf8 NOT NULL,
  `email` varchar(50) CHARACTER SET utf8 NOT NULL,
  `area` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `district` varchar(50) CHARACTER SET utf8 NOT NULL,
  `city` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `country` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `maps_maplat` varchar(18) COLLATE utf8_unicode_ci NOT NULL,
  `maps_maplng` varchar(18) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_customer`
--

INSERT INTO `tbl_customer` (`id`, `username`, `name`, `avatar`, `date_of_birth`, `gender`, `phone`, `email`, `area`, `district`, `city`, `country`, `maps_maplat`, `maps_maplng`, `password`) VALUES
(4, '', 'gocvetamhon', '', '0000-00-00', '0', '', '', '', '', 'TPHCM', 'hcm', '0', '0', 'e10adc3949ba59abbe56e057f20f883e'),
(6, 'sontanhoang', 'Sơn Tấn Hoàng', '27051fb5b6833d78a4eb34d26d97d922.jpg', '06-06-2001', 'nam', '0921838021', 'hoangsonytb123@gmail.com', 'Xuân Khánh', 'Ninh Kiều', 'Cần Thơ', 'ct', '10.084898764896588', '106.19016003584703', 'e10adc3949ba59abbe56e057f20f883e'),
(7, '', 'Nguyễn Ngọc Độ', 'ngocdo.jpg', '0000-00-00', '0', '', '', '', '', 'bibione stdio', 'ct', '0', '0', 'e10adc3949ba59abbe56e057f20f883e'),
(8, 'nguyentruonggiang', '', 'default-user-image.jpg', '', '', '', '', '', '', '', '', '', '', 'e10adc3949ba59abbe56e057f20f883e'),
(9, 'tranquotoan', '', '', '', '', '', '', '', '', '', '', '', '', 'e10adc3949ba59abbe56e057f20f883e'),
(10, 'nguyenngocdo', '', '', '', '', '', '', '', '', '', '', '', '', 'e10adc3949ba59abbe56e057f20f883e'),
(13, 'khiem', '', '', '', '', '', '', '', '', '', '', '', '', 'd41d8cd98f00b204e9800998ecf8427e'),
(14, 'Meomeo', '', '', '', '', '', '', '', '', '', '', '', '', '202cb962ac59075b964b07152d234b70');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_order`
--

CREATE TABLE `tbl_order` (
  `id` int(11) NOT NULL,
  `productId` int(11) NOT NULL,
  `productName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `customer_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `date_order` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_order`
--

INSERT INTO `tbl_order` (`id`, `productId`, `productName`, `customer_id`, `quantity`, `price`, `image`, `status`, `date_order`) VALUES
(78, 35, 'Trà Sửa 100%', 6, 1, '28000', 'ba97e37e36.jpg', 0, '2020-12-16 16:59:09'),
(79, 35, 'Trà Sửa 100%', 6, 1, '28000', 'ba97e37e36.jpg', 0, '2020-12-16 16:59:09'),
(80, 34, 'Trà Sửa TMT', 6, 1, '25000', '2a32e6f826.png', 0, '2020-12-16 17:00:50'),
(81, 36, 'Trà Sửa Maria Cheese Tea', 6, 1, '24000', 'a1ec21098e.jpg', 0, '2020-12-16 17:00:50'),
(82, 36, 'Trà Sửa Maria Cheese Tea', 6, 1, '24000', 'a1ec21098e.jpg', 0, '2020-12-16 17:00:50'),
(83, 36, 'Trà Sửa Maria Cheese Tea', 6, 1, '24000', 'a1ec21098e.jpg', 0, '2020-12-18 18:30:52'),
(84, 37, 'Trà Sửa BoBa PoP', 6, 1, '25000', 'ceb6a1e6a7.jpg', 0, '2020-12-18 18:32:56'),
(85, 36, 'Trà Sửa Maria Cheese Tea', 6, 1, '24000', 'a1ec21098e.jpg', 0, '2020-12-18 18:32:56'),
(86, 36, 'Trà Sửa Maria Cheese Tea', 6, 1, '24000', 'a1ec21098e.jpg', 0, '2020-12-18 18:34:19'),
(87, 36, 'Trà Sửa Maria Cheese Tea', 6, 1, '24000', 'a1ec21098e.jpg', 0, '2020-12-18 18:35:05'),
(88, 36, 'Trà Sửa Maria Cheese Tea', 6, 1, '24000', 'a1ec21098e.jpg', 0, '2020-12-18 20:01:14'),
(89, 36, 'Trà Sửa Maria Cheese Tea', 6, 1, '24000', 'a1ec21098e.jpg', 0, '2020-12-18 21:56:50'),
(90, 37, 'Trà Sửa BoBa PoP', 6, 1, '25000', 'ceb6a1e6a7.jpg', 0, '2020-12-19 15:06:48'),
(91, 37, 'Trà Sửa BoBa PoP', 6, 1, '25000', 'ceb6a1e6a7.jpg', 0, '2020-12-19 15:06:48'),
(92, 44, 'test7', 6, 3, '90000', '936be34735.jpg', 0, '2021-01-05 20:46:55');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_product`
--

CREATE TABLE `tbl_product` (
  `productId` int(11) NOT NULL,
  `productName` tinytext COLLATE utf8_unicode_ci NOT NULL,
  `product_code` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `productQuantity` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `product_soldout` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `product_remain` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `catId` int(11) NOT NULL,
  `brandId` int(11) NOT NULL,
  `product_desc` text COLLATE utf8_unicode_ci NOT NULL,
  `type` int(11) NOT NULL,
  `old_price` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `price` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_product`
--

INSERT INTO `tbl_product` (`productId`, `productName`, `product_code`, `productQuantity`, `product_soldout`, `product_remain`, `catId`, `brandId`, `product_desc`, `type`, `old_price`, `price`, `image`) VALUES
(32, 'Trà Sửa Nhà Làm', '', '40', '0', '40', 19, 21, '<p><span>Tr&agrave; sữa l&agrave; loại thức uống đa dạng được t&igrave;m thấy ở nhiều nền văn h&oacute;a, bao gồm một v&agrave;i c&aacute;ch kết hợp giữa tr&agrave; v&agrave; sữa. C&aacute;c loại thức uống kh&aacute;c nhau t&ugrave;y thuộc v&agrave;o lượng th&agrave;nh phần ch&iacute;nh của mỗi loại, phương ph&aacute;p pha chế, v&agrave; c&aacute;c th&agrave;nh phần kh&aacute;c được th&ecirc;m v&agrave;o. Bột tr&agrave; sữa pha sẵn l&agrave; một sản phẩm được sản xuất h&agrave;ng loạt.</span></p>', 0, '25000', '18000', 'd22235825b.jpg'),
(33, 'Trà Sửa Tí Nị', 'fdsf', '30', '0', '30', 19, 20, '<p><span>Tr&agrave; sữa l&agrave; loại thức uống đa dạng được t&igrave;m thấy ở nhiều nền văn h&oacute;a, bao gồm một v&agrave;i c&aacute;ch kết hợp giữa tr&agrave; v&agrave; sữa. C&aacute;c loại thức uống kh&aacute;c nhau t&ugrave;y thuộc v&agrave;o lượng th&agrave;nh phần ch&iacute;nh của mỗi loại, phương ph&aacute;p pha chế, v&agrave; c&aacute;c th&agrave;nh phần kh&aacute;c được th&ecirc;m v&agrave;o. Bột tr&agrave; sữa pha sẵn l&agrave; một sản phẩm được sản xuất h&agrave;ng loạt.</span></p>', 0, '22000', '20000', 'bc62fd8ca7.jpg'),
(34, 'Trà Sửa TMT', '', '30', '0', '30', 19, 19, '<p><span>Tr&agrave; sữa l&agrave; loại thức uống đa dạng được t&igrave;m thấy ở nhiều nền văn h&oacute;a, bao gồm một v&agrave;i c&aacute;ch kết hợp giữa tr&agrave; v&agrave; sữa. C&aacute;c loại thức uống kh&aacute;c nhau t&ugrave;y thuộc v&agrave;o lượng th&agrave;nh phần ch&iacute;nh của mỗi loại, phương ph&aacute;p pha chế, v&agrave; c&aacute;c th&agrave;nh phần kh&aacute;c được th&ecirc;m v&agrave;o. Bột tr&agrave; sữa pha sẵn l&agrave; một sản phẩm được sản xuất h&agrave;ng loạt.</span></p>', 0, '35000', '25000', '2a32e6f826.png'),
(35, 'Trà Sửa 100%', '', '20', '0', '20', 19, 19, '<p><span>Tr&agrave; sữa l&agrave; loại thức uống đa dạng được t&igrave;m thấy ở nhiều nền văn h&oacute;a, bao gồm một v&agrave;i c&aacute;ch kết hợp giữa tr&agrave; v&agrave; sữa. C&aacute;c loại thức uống kh&aacute;c nhau t&ugrave;y thuộc v&agrave;o lượng th&agrave;nh phần ch&iacute;nh của mỗi loại, phương ph&aacute;p pha chế, v&agrave; c&aacute;c th&agrave;nh phần kh&aacute;c được th&ecirc;m v&agrave;o. Bột tr&agrave; sữa pha sẵn l&agrave; một sản phẩm được sản xuất h&agrave;ng loạt.</span></p>', 0, '30000', '28000', 'ba97e37e36.jpg'),
(36, 'Trà Sửa Maria Cheese Tea', '', '30', '0', '30', 19, 18, '<p><span>Tr&agrave; sữa l&agrave; loại thức uống đa dạng được t&igrave;m thấy ở nhiều nền văn h&oacute;a, bao gồm một v&agrave;i c&aacute;ch kết hợp giữa tr&agrave; v&agrave; sữa. C&aacute;c loại thức uống kh&aacute;c nhau t&ugrave;y thuộc v&agrave;o lượng th&agrave;nh phần ch&iacute;nh của mỗi loại, phương ph&aacute;p pha chế, v&agrave; c&aacute;c th&agrave;nh phần kh&aacute;c được th&ecirc;m v&agrave;o. Bột tr&agrave; sữa pha sẵn l&agrave; một sản phẩm được sản xuất h&agrave;ng loạt.</span></p>', 0, '45000', '24000', 'a1ec21098e.jpg'),
(37, 'Trà Sửa BoBa PoP', '', '30', '0', '30', 19, 22, '<p><span>Tr&agrave; sữa l&agrave; loại thức uống đa dạng được t&igrave;m thấy ở nhiều nền văn h&oacute;a, bao gồm một v&agrave;i c&aacute;ch kết hợp giữa tr&agrave; v&agrave; sữa. C&aacute;c loại thức uống kh&aacute;c nhau t&ugrave;y thuộc v&agrave;o lượng th&agrave;nh phần ch&iacute;nh của mỗi loại, phương ph&aacute;p pha chế, v&agrave; c&aacute;c th&agrave;nh phần kh&aacute;c được th&ecirc;m v&agrave;o. Bột tr&agrave; sữa pha sẵn l&agrave; một sản phẩm được sản xuất h&agrave;ng loạt.</span></p>', 0, '40000', '25000', 'ceb6a1e6a7.jpg'),
(38, 'test', 'fdsf', '12', '0', '12', 19, 21, '<p>dsf</p>', 0, '45000', '30000', '4fc9964609.jpg'),
(39, 'test2', 'dsf', '12', '0', '12', 19, 20, '<p>dfsdf</p>', 0, '40000', '30000', 'b326e9de67.jpg'),
(40, 'test3', 'fsdf', '12', '0', '12', 19, 18, '<p>fsdfsd</p>', 0, '45000', '30000', '6399301520.jpg'),
(41, 'test4', 'fsdf', '12', '0', '12', 19, 18, '<p>fdsfds</p>', 0, '60000', '50000', 'c7377e09fe.jpg'),
(43, 'test6', 'sfsd', '46', '0', '46', 19, 18, '<p>dsfsd</p>', 0, '40000', '50000', '2c21a29afa.jpg'),
(44, 'test7', 'fdsf', '46', '0', '46', 19, 19, '<p>sdfsd</p>', 0, '45000', '30000', '936be34735.jpg');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_slider`
--

CREATE TABLE `tbl_slider` (
  `sliderId` int(11) NOT NULL,
  `sliderName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slider_image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `type` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_slider`
--

INSERT INTO `tbl_slider` (`sliderId`, `sliderName`, `slider_image`, `type`) VALUES
(15, 's2', '9621446986.jpg', 1),
(16, 's3', 'e3caa74ea8.jpg', 1),
(17, 's1', '04b52fea1f.jpg', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_warehouse`
--

CREATE TABLE `tbl_warehouse` (
  `id_warehouse` int(11) NOT NULL,
  `id_sanpham` int(11) NOT NULL,
  `sl_nhap` varchar(50) NOT NULL,
  `sl_ngaynhap` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `tbl_warehouse`
--

INSERT INTO `tbl_warehouse` (`id_warehouse`, `id_sanpham`, `sl_nhap`, `sl_ngaynhap`) VALUES
(1, 22, '5', '2019-07-16 18:31:22'),
(2, 21, '10', '2019-07-16 18:32:03'),
(3, 21, '3', '2019-07-16 18:42:59'),
(4, 20, '5', '2019-07-16 18:51:40');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_wishlist`
--

CREATE TABLE `tbl_wishlist` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `productId` int(11) NOT NULL,
  `productName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `price` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_wishlist`
--

INSERT INTO `tbl_wishlist` (`id`, `customer_id`, `productId`, `productName`, `price`, `image`) VALUES
(38, 0, 35, 'Trà Sửa 100%', '28000', 'ba97e37e36.jpg'),
(43, 6, 37, 'Trà Sửa BoBa PoP', '25000', 'ceb6a1e6a7.jpg'),
(46, 0, 34, 'Trà Sửa TMT', '25000', '2a32e6f826.png'),
(47, 6, 35, 'Trà Sửa 100%', '28000', 'ba97e37e36.jpg'),
(48, 6, 41, 'test4', '50000', 'c7377e09fe.jpg'),
(49, 6, 43, 'test6', '50000', '2c21a29afa.jpg');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`adminId`);

--
-- Chỉ mục cho bảng `tbl_brand`
--
ALTER TABLE `tbl_brand`
  ADD PRIMARY KEY (`brandId`);

--
-- Chỉ mục cho bảng `tbl_cart`
--
ALTER TABLE `tbl_cart`
  ADD PRIMARY KEY (`cartId`);

--
-- Chỉ mục cho bảng `tbl_category`
--
ALTER TABLE `tbl_category`
  ADD PRIMARY KEY (`catId`);

--
-- Chỉ mục cho bảng `tbl_compare`
--
ALTER TABLE `tbl_compare`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `tbl_customer`
--
ALTER TABLE `tbl_customer`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `tbl_order`
--
ALTER TABLE `tbl_order`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `tbl_product`
--
ALTER TABLE `tbl_product`
  ADD PRIMARY KEY (`productId`);

--
-- Chỉ mục cho bảng `tbl_slider`
--
ALTER TABLE `tbl_slider`
  ADD PRIMARY KEY (`sliderId`);

--
-- Chỉ mục cho bảng `tbl_warehouse`
--
ALTER TABLE `tbl_warehouse`
  ADD PRIMARY KEY (`id_warehouse`);

--
-- Chỉ mục cho bảng `tbl_wishlist`
--
ALTER TABLE `tbl_wishlist`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `adminId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `tbl_brand`
--
ALTER TABLE `tbl_brand`
  MODIFY `brandId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT cho bảng `tbl_cart`
--
ALTER TABLE `tbl_cart`
  MODIFY `cartId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=306;

--
-- AUTO_INCREMENT cho bảng `tbl_category`
--
ALTER TABLE `tbl_category`
  MODIFY `catId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT cho bảng `tbl_compare`
--
ALTER TABLE `tbl_compare`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT cho bảng `tbl_customer`
--
ALTER TABLE `tbl_customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT cho bảng `tbl_order`
--
ALTER TABLE `tbl_order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=93;

--
-- AUTO_INCREMENT cho bảng `tbl_product`
--
ALTER TABLE `tbl_product`
  MODIFY `productId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT cho bảng `tbl_slider`
--
ALTER TABLE `tbl_slider`
  MODIFY `sliderId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT cho bảng `tbl_warehouse`
--
ALTER TABLE `tbl_warehouse`
  MODIFY `id_warehouse` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `tbl_wishlist`
--
ALTER TABLE `tbl_wishlist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
