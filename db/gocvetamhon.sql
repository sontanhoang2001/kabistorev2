-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th7 09, 2020 lúc 09:26 AM
-- Phiên bản máy phục vụ: 10.4.11-MariaDB
-- Phiên bản PHP: 7.4.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `gocvetamhon`
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
(6, 'Samsum'),
(7, 'Apple'),
(8, 'Huawei'),
(9, 'Oppo'),
(10, 'Dell'),
(12, 'Viettel'),
(13, 'OEM'),
(14, 'TP-Link'),
(16, 'Tấn Hoàng Shop'),
(17, 'Người');

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
  `image` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_cart`
--

INSERT INTO `tbl_cart` (`cartId`, `productId`, `sId`, `productName`, `price`, `quantity`, `image`) VALUES
(1, 7, '0omn99jipm7namf6srjhj4kva2', 'Äiá»‡n thoáº¡i samsung S10+', '12000000', 3, '6deaf01c29.jpg'),
(2, 7, 'up8l6ff347ik19fsoa18qff452', 'Äiá»‡n thoáº¡i samsung S10+', '12000000', 1, '6deaf01c29.jpg'),
(3, 7, '9lmppj5kalib60o1s7soiiaqo4', 'Äiá»‡n thoáº¡i samsung S10+', '12000000', 1, '6deaf01c29.jpg'),
(4, 8, '9lmppj5kalib60o1s7soiiaqo4', 'Äiá»‡n Thoáº¡i Huawei Pro', '5000000', 1, 'd611667f13.jpg'),
(8, 6, 'c6o66m1rfnpfhqmdffk77pu083', 'MÃ¡y tÃ­nh Dell A503', '10000000', 1, 'dbb417a309.jpg'),
(9, 8, '3e1a29t1pgb3ock6s8hi8ho2d5', 'Äiá»‡n Thoáº¡i Huawei Pro', '5000000', 1, 'd611667f13.jpg'),
(13, 17, 'grfc2bmmrmga6mn5q7484i87f2', 'á»” Cá»©ng SSD Samsung 860 Evo 250GB Sata III 2.5 inch - HÃ ng Nháº­p Kháº©u', '1099000', 1, '785e8d373d.jpg'),
(14, 19, '39p4lauudimhcb91i8mhna4bf2', 'Äá»“ng Há»“ ThÃ´ng Minh Apple Watch Series 4 GPS Aluminum Case With Sport Loop', '9700000', 3, '6d72eb58ae.jpg'),
(18, 18, '3eg83l0tcklmed91e5h8raqsa2', 'Laptop Dell G7 7588 N7588A Core i7-8750H/Win10 (15.6 inch)', '2589900', 1000, '32942e9470.jpg'),
(19, 19, 'hlkksgphiqn70b37sjg3u89unu', 'Äá»“ng Há»“ ThÃ´ng Minh Apple Watch Series 4 GPS Aluminum Case With Sport Loop', '9700000', 1, '6d72eb58ae.jpg'),
(26, 19, 'fdrpintelpoq9rkpgbsh09k86o', 'Äá»“ng Há»“ ThÃ´ng Minh Apple Watch Series 4 GPS Aluminum Case With Sport Loop', '9700000', 1, '6d72eb58ae.jpg'),
(29, 20, 'ctap0b4ikk7neb62v6el7nfllp', 'Router Wifi 4G Huawei 300Mbps B593S-12', '1240000', 1, '49b106217c.jpg'),
(31, 22, 'qlq9je4aonbup8o927lsjjk0fb', 'Apple New For Mysql Server', '60000', 1, '643929ce40.jpg'),
(37, 22, 'kugv17e6opoqm9k5lvdptct9a5', 'Apple New For Mysql Server', '60000', 3, '643929ce40.jpg'),
(46, 20, 'apkm25ftbbk9j07vdneihf4t2o', 'Router Wifi 4G Huawei 300Mbps B593S-12', '1240000', 5, '49b106217c.jpg'),
(56, 21, '5cio4li1aou698rfbksi4416om', 'Apple New For Mysql Server', '50000', 8, 'ad351ef94f.png'),
(60, 20, '5cio4li1aou698rfbksi4416om', 'Router Wifi 4G Huawei 300Mbps B593S-12', '1240000', 4, '49b106217c.jpg'),
(61, 19, '5cio4li1aou698rfbksi4416om', 'Äá»“ng Há»“ ThÃ´ng Minh Apple Watch Series 4 GPS Aluminum Case With Sport Loop', '9700000', 5, '6d72eb58ae.jpg'),
(67, 20, '2vo4ekv0j7hef0phsanhpggipt', 'Router Wifi 4G Huawei 300Mbps B593S-12', '1240000', 1, '49b106217c.jpg'),
(68, 22, 'd4s1822furnl2oevt52rmq22hv', 'Apple New For Mysql Server', '60000', 7, '643929ce40.jpg'),
(69, 23, '1s004ss8mhld61auuop6njb92r', 'Vẽ áo thun - phiên bản trà sữa', '99000', 3, '04ac96b348.jpg'),
(70, 22, '1s004ss8mhld61auuop6njb92r', 'Apple New For Mysql Server', '60000', 10, '643929ce40.jpg'),
(71, 23, '1s004ss8mhld61auuop6njb92r', 'Vẽ áo thun - phiên bản trà sữa', '99000', 4, '04ac96b348.jpg'),
(73, 29, 'd250m0ima0p03q3jigfvqqvl2e', 'Túi vẽ nghệ thuật Doremon', '12000', 1, '07e5c4bd9f.jpg'),
(74, 27, 'e1gj3q4fs1fl1ssl1kvc44erae', 'Áo vẽ nghệ thuật - phiên bản trà sửa', '99000', 1, '30980cdf91.jpg'),
(75, 30, 'e1gj3q4fs1fl1ssl1kvc44erae', 'Giày vẽ nghệ thuật - v1', '200000', 1, '1a6ba7b922.jpg'),
(77, 29, 'kn3k134c904s1i2sarrp6cks32', 'Túi vẽ nghệ thuật Doremon', '12000', 9, '07e5c4bd9f.jpg'),
(78, 30, 'kn3k134c904s1i2sarrp6cks32', 'Giày vẽ nghệ thuật - v1', '200000', 1, '1a6ba7b922.jpg'),
(79, 29, 'o08tsl9atdhh23a0usbqlsdant', 'Túi vẽ nghệ thuật Doremon', '12000', 1, '07e5c4bd9f.jpg'),
(80, 30, 't0q0vd5t2mreaf89p2svcon39i', 'Giày vẽ nghệ thuật - v1', '200000', 5, '1a6ba7b922.jpg'),
(82, 27, 't0q0vd5t2mreaf89p2svcon39i', 'Áo vẽ nghệ thuật - phiên bản trà sửa', '99000', 1, '30980cdf91.jpg'),
(84, 27, 'jn339dsf18sgltmqrkvpou5hsk', 'Áo vẽ nghệ thuật - phiên bản trà sửa', '99000', 1, '30980cdf91.jpg'),
(85, 29, 'j9i9a3h6546hfitpqa8anq7tb1', 'Túi vẽ nghệ thuật Doremon', '12000', 1, '07e5c4bd9f.jpg'),
(86, 29, 'u3pbrmggblanffbdkd95adpk1u', 'Túi vẽ nghệ thuật Doremon', '12000', 1, '07e5c4bd9f.jpg'),
(87, 30, 'u3pbrmggblanffbdkd95adpk1u', 'Giày vẽ nghệ thuật - v1', '200000', 7, '1a6ba7b922.jpg'),
(88, 30, 'c5hsp87i0nkfe3cbhm5m5ci7et', 'Giày vẽ nghệ thuật - v1', '200000', 3, '1a6ba7b922.jpg'),
(93, 29, 'lka1676921it618cmsgvguqtpv', 'Túi vẽ nghệ thuật Doremon', '12000', 4, '07e5c4bd9f.jpg'),
(94, 29, 'gjifrsdfi33kl970m5tcr5tp70', 'Túi vẽ nghệ thuật Doremon', '12000', 1, '07e5c4bd9f.jpg'),
(95, 29, 'gjifrsdfi33kl970m5tcr5tp70', 'Túi vẽ nghệ thuật Doremon', '12000', 1, '07e5c4bd9f.jpg'),
(96, 27, 'm1oe27ocbvp6b2ai85q3muleui', 'Áo vẽ nghệ thuật - phiên bản trà sửa', '99000', 1, '30980cdf91.jpg'),
(97, 29, '9t4bshir9u1tbi7au0dfr51mpn', 'Túi vẽ nghệ thuật Doremon', '12000', 6, '07e5c4bd9f.jpg'),
(99, 28, '9t4bshir9u1tbi7au0dfr51mpn', 'Áo vẽ nghệ thuật - phiên bản trà sửa v2', '85000', 4, '2659d64d54.jpg'),
(101, 27, '9t4bshir9u1tbi7au0dfr51mpn', 'Áo vẽ nghệ thuật - phiên bản trà sửa', '99000', 4, '30980cdf91.jpg'),
(102, 28, 'uivt9s6ocs09sm8m1u1f9u7def', 'Áo vẽ nghệ thuật - phiên bản trà sửa v2', '85000', 1, '2659d64d54.jpg'),
(103, 27, 'uivt9s6ocs09sm8m1u1f9u7def', 'Áo vẽ nghệ thuật - phiên bản trà sửa', '99000', 1, '30980cdf91.jpg'),
(104, 27, 'srq8pq35mj467ad92neibkn8pi', 'Áo vẽ nghệ thuật - phiên bản trà sửa', '99000', 1, '30980cdf91.jpg'),
(108, 29, 'sohjsp3l57i6is297tsu675kok', 'Túi vẽ nghệ thuật Doremon', '12000', 1, '07e5c4bd9f.jpg'),
(109, 27, 'sohjsp3l57i6is297tsu675kok', 'Áo vẽ nghệ thuật - phiên bản trà sửa', '99000', 1, '30980cdf91.jpg'),
(111, 29, 'uv0u7ajr27bpbr9ab0crbb77ck', 'Túi vẽ nghệ thuật Doremon', '12000', 1, '07e5c4bd9f.jpg'),
(112, 27, 'j0siim2uc9suoqj86kq65n3r88', 'Áo vẽ nghệ thuật - phiên bản trà sửa', '99000', 1, '30980cdf91.jpg'),
(113, 29, 'flckmi2sj7aeg9gd42pi3rht9u', 'Túi vẽ nghệ thuật Doremon', '12000', 1, '07e5c4bd9f.jpg'),
(114, 29, 'probghaidtfmgp8i4lr8g5jilu', 'Túi vẽ nghệ thuật Doremon', '12000', 4, '07e5c4bd9f.jpg'),
(115, 29, 'mh7vpsct261imcap616chrf5oe', 'Túi vẽ nghệ thuật Doremon', '12000', 1, '07e5c4bd9f.jpg'),
(117, 28, 'siit9heupt92qek7duoscuderv', 'Áo vẽ nghệ thuật - phiên bản trà sửa v2', '85000', 1, '2659d64d54.jpg'),
(118, 27, 'siit9heupt92qek7duoscuderv', 'Áo vẽ nghệ thuật - phiên bản trà sửa', '99000', 1, '30980cdf91.jpg'),
(126, 28, '96uvao4d8jdg3jd9nlj3bl4j56', 'Áo vẽ nghệ thuật - phiên bản trà sửa v2', '85000', 1, '2659d64d54.jpg'),
(129, 29, '3ndk2o81egd5lrrtiq5u9l3q5i', 'Túi vẽ nghệ thuật Doremon', '12000', 1, '07e5c4bd9f.jpg'),
(130, 29, '3ndk2o81egd5lrrtiq5u9l3q5i', 'Túi vẽ nghệ thuật Doremon', '12000', 1, '07e5c4bd9f.jpg'),
(137, 28, '71i4kujv93h77jdcteiucbtv34', 'Áo vẽ nghệ thuật - phiên bản trà sửa v2', '85000', 1, '2659d64d54.jpg'),
(138, 27, 'gv4rf9uk5de8jgpv6od6catddi', 'Áo vẽ nghệ thuật - phiên bản trà sửa', '99000', 1, '30980cdf91.jpg'),
(139, 28, 'gv4rf9uk5de8jgpv6od6catddi', 'Áo vẽ nghệ thuật - phiên bản trà sửa v2', '85000', 1, '2659d64d54.jpg'),
(140, 28, '9dilktjqluolm6hto269eueteo', 'Áo vẽ nghệ thuật - phiên bản trà sửa v2', '85000', 6, '2659d64d54.jpg');

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
(3, 'Laptop'),
(4, 'Desktop'),
(5, 'Mobile Phones'),
(6, 'Accessories'),
(7, 'Software'),
(15, 'Test'),
(16, 'Äá»“ng Há»“ ThÃ´ng Minh'),
(17, 'Thiáº¿t bá»‹ máº¡ng'),
(18, 'Áo vẽ nghệ thuật');

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

--
-- Đang đổ dữ liệu cho bảng `tbl_compare`
--

INSERT INTO `tbl_compare` (`id`, `customer_id`, `productId`, `productName`, `price`, `image`) VALUES
(5, 6, 28, 'Áo vẽ nghệ thuật - phiên bản trà sửa v2', '85000', '2659d64d54.jpg'),
(6, 6, 27, 'Áo vẽ nghệ thuật - phiên bản trà sửa', '99000', '30980cdf91.jpg'),
(7, 6, 31, 'Huỳnh Trúc Mai', '9999999999', '4b9d5609c2.jpg');

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
(6, 'sontanhoang', 'Sơn Tấn Hoàng', '27051fb5b6833d78a4eb34d26d97d922.jpg', '06-06-2001', 'nam', '0921838021', 'hoangsonytb123@gmail.com', 'Xuân Khánh', 'Ninh Kiều', 'Cần Thơ', 'ct', '10.032167808794744', '105.78152660941525', 'e10adc3949ba59abbe56e057f20f883e'),
(7, '', 'Nguyễn Ngọc Độ', 'ngocdo.jpg', '0000-00-00', '0', '', '', '', '', 'bibione stdio', 'ct', '0', '0', 'e10adc3949ba59abbe56e057f20f883e'),
(8, 'nguyentruonggiang', '', 'default-user-image.jpg', '', '', '', '', '', '', '', '', '', '', 'e10adc3949ba59abbe56e057f20f883e'),
(9, 'tranquotoan', '', '', '', '', '', '', '', '', '', '', '', '', 'e10adc3949ba59abbe56e057f20f883e'),
(10, 'nguyenngocdo', '', '', '', '', '', '', '', '', '', '', '', '', 'e10adc3949ba59abbe56e057f20f883e');

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
(56, 22, 'Apple New For Mysql Server', 3, 5, '300000', '643929ce40.jpg', 1, '2019-07-17 00:54:42'),
(57, 22, 'Apple New For Mysql Server', 3, 4, '240000', '643929ce40.jpg', 1, '2019-07-17 00:56:49'),
(58, 22, 'Apple New For Mysql Server', 3, 5, '300000', '643929ce40.jpg', 1, '2019-07-17 00:57:49'),
(59, 20, 'Router Wifi 4G Huawei 300Mbps B593S-12', 3, 10, '12400000', '49b106217c.jpg', 1, '2019-07-17 01:51:22'),
(62, 30, 'Giày vẽ nghệ thuật - v1', 6, 7, '1400000', '1a6ba7b922.jpg', 2, '2020-05-12 14:01:25'),
(63, 29, 'Túi vẽ nghệ thuật Doremon', 6, 7, '84000', '07e5c4bd9f.jpg', 0, '2020-05-16 11:18:54'),
(64, 30, 'Giày vẽ nghệ thuật - v1', 6, 1, '200000', '1a6ba7b922.jpg', 0, '2020-05-16 11:18:54'),
(65, 29, 'Túi vẽ nghệ thuật Doremon', 6, 1, '12000', '07e5c4bd9f.jpg', 0, '2020-05-16 16:05:01'),
(66, 29, 'Túi vẽ nghệ thuật Doremon', 6, 1, '12000', '07e5c4bd9f.jpg', 0, '2020-05-26 12:15:13'),
(67, 29, 'Túi vẽ nghệ thuật Doremon', 6, 1, '12000', '07e5c4bd9f.jpg', 0, '2020-05-26 12:50:39');

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
  `price` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_product`
--

INSERT INTO `tbl_product` (`productId`, `productName`, `product_code`, `productQuantity`, `product_soldout`, `product_remain`, `catId`, `brandId`, `product_desc`, `type`, `price`, `image`) VALUES
(27, 'Áo vẽ nghệ thuật - phiên bản trà sửa', 'TS-0001', '5', '0', '5', 18, 16, '<p>&Aacute;o vẽ nghệ thuật....</p>', 0, '99000', '30980cdf91.jpg'),
(28, 'Áo vẽ nghệ thuật - phiên bản trà sửa v2', 'MH0002', '10', '0', '10', 18, 16, '<p>&Aacute;o vẽ nghệ thuật....</p>', 0, '85000', '2659d64d54.jpg'),
(29, 'Túi vẽ nghệ thuật Doremon', 'TX-0001', '20', '0', '20', 18, 16, '<p>&Aacute;o vẽ nghệ thuật....</p>', 0, '12000', '07e5c4bd9f.jpg'),
(30, 'Giày vẽ nghệ thuật - v1', 'GG-0001', '10', '77', '-67', 18, 16, '<p>&Aacute;o vẽ nghệ thuật....</p>', 0, '200000', '1a6ba7b922.jpg'),
(31, 'Huỳnh Trúc Mai', 'GG-0002', '1', '0', '1', 15, 16, '<p>Đẹp g&aacute;i, vui t&iacute;nh, vẽ đẹp, mặt h&agrave;ng n&agrave;y đang rất hiếm!!!...</p>', 0, '9999999999', '4b9d5609c2.jpg');

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
(5, 'slider1', '720bc173fa.png', 0),
(6, 'slider2', 'ff79579ac7.png', 0),
(7, 'slider3', 'a94222690e.png', 0),
(8, 'slider4', '5b2e64d6ab.jpg', 0),
(9, 'slider5', 'f50b2e4171.png', 0),
(11, 'slider6', '72a159f760.jpg', 0),
(12, 'slider1', 'fbffe7fc5d.jpg', 1),
(13, 'slider2', 'dc1b803c80.jpg', 1),
(14, 'slider3', '5c9770556f.jpg', 1);

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
(3, 3, 6, 'MÃ¡y tÃ­nh Dell A503', '10000000', 'dbb417a309.jpg'),
(4, 3, 18, 'Laptop Dell G7 7588 N7588A Core i7-8750H/Win10 (15.6 inch)', '2589900', '32942e9470.jpg'),
(25, 6, 28, 'Áo vẽ nghệ thuật - phiên bản trà sửa v2', '85000', '2659d64d54.jpg'),
(26, 6, 27, 'Áo vẽ nghệ thuật - phiên bản trà sửa', '99000', '30980cdf91.jpg'),
(27, 0, 28, 'Áo vẽ nghệ thuật - phiên bản trà sửa v2', '85000', '2659d64d54.jpg'),
(28, 6, 31, 'Huỳnh Trúc Mai', '9999999999', '4b9d5609c2.jpg');

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
  MODIFY `brandId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT cho bảng `tbl_cart`
--
ALTER TABLE `tbl_cart`
  MODIFY `cartId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=142;

--
-- AUTO_INCREMENT cho bảng `tbl_category`
--
ALTER TABLE `tbl_category`
  MODIFY `catId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT cho bảng `tbl_compare`
--
ALTER TABLE `tbl_compare`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT cho bảng `tbl_customer`
--
ALTER TABLE `tbl_customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT cho bảng `tbl_order`
--
ALTER TABLE `tbl_order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT cho bảng `tbl_product`
--
ALTER TABLE `tbl_product`
  MODIFY `productId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT cho bảng `tbl_slider`
--
ALTER TABLE `tbl_slider`
  MODIFY `sliderId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT cho bảng `tbl_warehouse`
--
ALTER TABLE `tbl_warehouse`
  MODIFY `id_warehouse` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `tbl_wishlist`
--
ALTER TABLE `tbl_wishlist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
