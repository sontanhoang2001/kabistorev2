-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Máy chủ: localhost:3306
-- Thời gian đã tạo: Th10 14, 2021 lúc 11:15 PM
-- Phiên bản máy phục vụ: 5.7.35-cll-lve
-- Phiên bản PHP: 7.3.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `kabistor_kabistore`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_address`
--

CREATE TABLE `tbl_address` (
  `address_id` int(11) NOT NULL,
  `maps_maplat` varchar(18) NOT NULL,
  `maps_maplng` varchar(18) NOT NULL,
  `note_address` varchar(100) NOT NULL,
  `date_create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `sId` varchar(100) NOT NULL,
  `customer_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `tbl_address`
--

INSERT INTO `tbl_address` (`address_id`, `maps_maplat`, `maps_maplng`, `note_address`, `date_create`, `sId`, `customer_id`) VALUES
(541, '10.084140081984216', '106.18968675762648', '', '2021-11-12 03:07:01', '6945b0888ec0900e84dcebea3eae919c-12/11/2021 10:11:01', 6),
(542, '10.087413090689694', '106.18903235239225', '', '2021-11-12 04:04:47', 'cf76a9240ffb2dee86c68548f18c9abc-12/11/2021 11:11:47', 6),
(543, '10.087413090689694', '106.18903235239225', '', '2021-11-12 04:09:58', 'cf76a9240ffb2dee86c68548f18c9abc-12/11/2021 11:11:58', 6),
(544, '10.087413090689694', '106.18903235239225', '', '2021-11-12 04:10:55', 'df93e5b7a96e960bdcfc43e58354112f-12/11/2021 11:11:55', 6),
(545, '10.087413090689694', '106.18903235239225', '', '2021-11-12 04:15:04', 'df93e5b7a96e960bdcfc43e58354112f-12/11/2021 11:11:04', 6),
(546, '10.0614065', '106.1875016', '', '2021-11-12 04:17:22', 'df93e5b7a96e960bdcfc43e58354112f-12/11/2021 11:11:22', 6),
(547, '10.087413090689694', '106.18903235239225', '', '2021-11-12 04:27:57', '16bbac024fc236e67798159cc98e8fd7-12/11/2021 11:11:57', 6),
(548, '10.087413090689694', '106.18903235239225', '', '2021-11-12 04:31:36', 'c2bdd7b90d10a1f5c6e573468eef08f8-12/11/2021 11:11:36', 6),
(549, '10.087413090689694', '106.18903235239225', '', '2021-11-12 04:36:05', 'cf537cecbf4967678e623b70569cda95-12/11/2021 11:11:05', 6),
(550, '10.087413090689694', '106.18903235239225', '', '2021-11-12 04:37:46', 'cf537cecbf4967678e623b70569cda95-12/11/2021 11:11:46', 6),
(551, '10.087413090689694', '106.18903235239225', '', '2021-11-12 04:39:40', 'abe3751a114981a9cab69367870aefcf-12/11/2021 11:11:40', 6),
(552, '10.087413090689694', '106.18903235239225', '', '2021-11-12 04:42:18', 'cab703ff8672e140f414e7821e340c40-12/11/2021 11:11:18', 6),
(553, '10.087413090689694', '106.18903235239225', '', '2021-11-12 04:44:20', 'cab703ff8672e140f414e7821e340c40-12/11/2021 11:11:20', 6),
(554, '10.087413090689694', '106.18903235239225', '', '2021-11-12 04:49:09', '7660d17c63d097d6297754d70b735820-12/11/2021 11:11:09', 6),
(555, '10.087413090689694', '106.18903235239225', '', '2021-11-12 07:42:33', '7660d17c63d097d6297754d70b735820-12/11/2021 02:11:33', 6),
(556, '10.0614065', '106.1875016', '', '2021-11-12 07:43:54', 'e2f0aad067abea887fed778f9572490f-12/11/2021 02:11:54', 6),
(557, '10.087413090689694', '106.18903235239225', '', '2021-11-12 07:46:23', 'e2f0aad067abea887fed778f9572490f-12/11/2021 02:11:23', 6),
(558, '10.087413090689694', '106.18903235239225', '', '2021-11-12 07:47:32', 'e2f0aad067abea887fed778f9572490f-12/11/2021 02:11:32', 6),
(559, '10.087413090689694', '106.18903235239225', '', '2021-11-12 08:49:16', '9126d904ed57464843fd741298ef3500-12/11/2021 03:11:16', 6),
(560, '10.087413090689694', '106.18903235239225', '', '2021-11-12 09:11:20', 'de4b4250410e96f6913611594b5e1466-12/11/2021 04:11:20', 6);

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
(2, 'admin', 'admin@gmail.com', 'admin', 'ab0c2eade54f3ef43595233be1fd4326', 0);

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
(18, 'Vĩnh Long - vsvl001');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_cart`
--

CREATE TABLE `tbl_cart` (
  `cartId` int(11) NOT NULL,
  `customerId` int(11) NOT NULL,
  `productId` int(11) NOT NULL,
  `productSize` int(1) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `tbl_cart`
--

INSERT INTO `tbl_cart` (`cartId`, `customerId`, `productId`, `productSize`, `quantity`) VALUES
(1151, 6, 145, 0, 1);

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
(19, 'Đồ gia dụng'),
(22, 'Chăm sóc cá nhân'),
(23, 'Quần áo &amp; thời trang'),
(132, 'Son môi'),
(133, 'Nước hoa'),
(134, 'Giày dép nam - nữ'),
(135, 'Trang sức - phụ kiện'),
(136, 'Mỹ phẩm'),
(139, 'Phụ kiện &amp; công nghệ');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_customer`
--

CREATE TABLE `tbl_customer` (
  `id` int(11) NOT NULL,
  `username` varchar(25) CHARACTER SET utf8 NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `avatar` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `date_of_birth` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `gender` int(1) NOT NULL,
  `phone` int(10) DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8 NOT NULL,
  `maps_maplat` varchar(18) COLLATE utf8_unicode_ci DEFAULT NULL,
  `maps_maplng` varchar(18) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `date_Joined` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_customer`
--

INSERT INTO `tbl_customer` (`id`, `username`, `name`, `avatar`, `date_of_birth`, `gender`, `phone`, `email`, `maps_maplat`, `maps_maplng`, `password`, `date_Joined`) VALUES
(6, 'sontanhoang', 'Sơn Tấn Hoàng', '8caf5f402a15190ae8c035beec24f11c.jpg', '2001-06-07', 0, 921838021, 'hoangsonytb123@gmail.com', '10.087413090689694', '106.18903235239225', 'de782de8442d2e2b2c74c2c1ea42c4f5', '2021-10-31 08:37:38'),
(44, '2972570506406872', 'Tấn Hoàng', NULL, '2021-10-06', 0, 921838021, 'hoangsonytb123@gmail.com', '10.034204740293106', '105.77000248133373', 'ddbc79d71fa74323f26a159c78d623f1', '2021-10-23 07:54:22'),
(46, 'dinhcoixxx', 'Nguyễn Đức Hiệp Định', '0df4f0e53a7a2ddca75b9ff2685e8961.jpg', '2001-09-16', 0, 335808794, 'hiepngang123@gmail.com', '10.026109849924737', '105.76952281943875', '63178fadd550c92e376157129dbb3b4c', '2021-11-09 03:33:49'),
(47, '1584801238535210', 'Nguyễn Định', NULL, '', 0, NULL, 'hiepngang123@gmail.com', NULL, NULL, 'e3defbc864fc6e431b6cfcd001280954', '2021-11-09 03:50:21');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_music`
--

CREATE TABLE `tbl_music` (
  `id` int(11) NOT NULL,
  `trackName` varchar(50) NOT NULL,
  `albumArtwork` varchar(255) NOT NULL,
  `trackUrl` varchar(255) NOT NULL,
  `enable` tinyint(1) NOT NULL,
  `rank` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `tbl_music`
--

INSERT INTO `tbl_music` (`id`, `trackName`, `albumArtwork`, `trackUrl`, `enable`, `rank`) VALUES
(1, 'Pink Sweat$ - At My Worst', '1iNJtsJ1oAC7mISCdmYfabLZlWQ4b4xeU', '19U2cEaZ0Y1qPDJ3E7bPJ4C8iTbBxdkUK', 1, 3),
(2, 'Ava Max - Kings & Queens', '1OVXHo1HxE63foBe17OqnIzhQ4Gdw9HiI', '1VteX_5Uae6WESw0W46mJwKNBt_V6ihJ7', 1, 2),
(4, 'Ava Max - Sweet but Psycho', '1OVXHo1HxE63foBe17OqnIzhQ4Gdw9HiI', '1GZHNX8Qb4twgyoQ9LdzsyxaClajYy3hH', 1, 4),
(5, 'Maggie Lindemann - Pretty Girl', '1gSIQ_FGIBh2I_W6UBYKUQTx92IJLglsF', '1IWQGrhl0b-jqoJhQsWQ_Saq0yjsrRkWA', 1, 2),
(6, 'Camila Cabello - Havana', '1nKXskxmMm_icuK-cuj5OImf94GNNJgU0', '1ZD2BewNataearoMvowxL7s4J1_QSiGIZ', 1, 6),
(7, 'Clara Mae - I\'m Not Her', '1qf5HqwEwr0h59WxoHZnYSEflbZX9gvh8', '1ysQwZk1YvSflnTIoiWBLIOKSvgmRvACA', 1, 1),
(8, 'Alec Benjamin - Let Me Down Slowly', '1dVLV_Y1QafoR3u-JhYG3Kw-AaTylyN8I', '1UcclCwlHnFa7bOfMe9xkKNWtzY8TkFZN', 1, 7),
(9, 'Ava Max - Salt', '1OVXHo1HxE63foBe17OqnIzhQ4Gdw9HiI', '1W4cNYjRdgW3L4kKL2YMWTsGzIWzYwQXa', 1, 8),
(10, 'Alan Walker - All Falls Down', '1XiBj0nUtoxdmlECjprhuZBMDo88MdzXM', '1MCUN5PnNgQGgJLOP8QLKhSi5qPYG_Z8u', 1, 9),
(11, 'Charlie Puth - We Don\'t Talk Anymore', '1XB14MR3YixtV0A4eTzpaGA0PcSKnH0wR', '1Jhm4nGCY1kkyKTKAUgjoGzbF6ivB2v0p', 1, 10),
(12, 'Clean Bandit - Symphony', '1P5a6Bh6f6p_KZwDfOLESocz7HfGahT_Z', '1jcO-23Ru-QbmurEe9LAnOq0N4Yt5DDJB', 1, 11),
(13, 'The Chainsmokers - Something Just Like This', '1kUhb9Y4-08CozdrErXQJmzzpHVMouOLz', '1lrJMltmyGF240JyjDZNPn4886YkaqJF7', 1, 12),
(14, 'Alan Walker - Alone', '1XiBj0nUtoxdmlECjprhuZBMDo88MdzXM', '1zfJmo7rE-kETu03j7ojzic2QR--f9YVS', 1, 13),
(15, 'Alan Walker - Faded', '1XiBj0nUtoxdmlECjprhuZBMDo88MdzXM', '15W0iH-Zt8SK3o53W7EwIOcgjltmLPirR', 1, 14),
(16, 'Alan Walker - The Spectre', '1XiBj0nUtoxdmlECjprhuZBMDo88MdzXM', '1ELJuTS_Gn2-CuUx7F-4-gQjw1T3EW60I', 1, 15),
(17, 'Alan Walker - Darkside', '1XiBj0nUtoxdmlECjprhuZBMDo88MdzXM', '1JwVyTHqNt1d_geHSGOUxHj6oanyDghiu', 1, 16),
(18, 'Alan Walker - On My Way', '1XiBj0nUtoxdmlECjprhuZBMDo88MdzXM', '10I2uaipn_wbVNU4mejm9TbzL_IHuRChx', 1, 17),
(19, 'Katy Perry - Dark Horse', '13WN3mXj8-ODPYkX8dnmxDhPq03a7_Cpw', '1-BBXW45DIlY_0JiulrWYF3N36OPidcuy', 1, 18),
(20, 'Selena Gomez - Wolves', '1ob2y7ruQ6O4f2evrZLggnpmT70R1ZGwR', '1daLP6n7X1FAYDa-7enUJscQI9w1ViJUG', 1, 19),
(21, 'Maroon 5 - Girls Like You', '1_PCu1msiS2ZqwYsadUpSWyIxk6yHOhHQ', '1sOa_OiAhgF94thUWIDriNRqIVBrTNskI', 1, 20);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_order`
--

CREATE TABLE `tbl_order` (
  `id` int(11) NOT NULL,
  `productId` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `address_id` int(11) NOT NULL,
  `productSize` int(2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `totalPayment` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `status` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_order`
--

INSERT INTO `tbl_order` (`id`, `productId`, `customer_id`, `address_id`, `productSize`, `quantity`, `totalPayment`, `status`) VALUES
(1222, 140, 6, 541, 0, 1, '55000', 0),
(1223, 142, 6, 541, 0, 1, '25000', 0),
(1224, 144, 6, 541, 0, 1, '49000', 0),
(1225, 142, 6, 542, 0, 1, '28750', 0),
(1226, 139, 6, 542, 0, 1, '54750', 0),
(1227, 144, 6, 543, 0, 1, '64000', 0),
(1228, 143, 6, 544, 0, 1, '60000', 0),
(1229, 139, 6, 545, 0, 1, '66000', 0),
(1230, 139, 6, 546, 0, 1, '66000', 0),
(1231, 144, 6, 547, 0, 1, '64000', 0),
(1232, 139, 6, 548, 0, 1, '66000', 0),
(1233, 139, 6, 549, 0, 1, '66000', 0),
(1234, 139, 6, 550, 0, 1, '66000', 0),
(1235, 139, 6, 551, 0, 1, '66000', 0),
(1236, 139, 6, 552, 0, 1, '66000', 0),
(1237, 139, 6, 553, 0, 1, '66000', 0),
(1238, 139, 6, 554, 0, 1, '66000', 0),
(1239, 139, 6, 555, 0, 1, '66000', 0),
(1240, 139, 6, 556, 0, 1, '66000', 0),
(1241, 139, 6, 557, 0, 1, '66000', 0),
(1242, 139, 6, 558, 0, 1, '66000', 0),
(1243, 139, 6, 559, 0, 1, '66000', 0),
(1244, 139, 6, 560, 0, 1, '66000', 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_priceshipping`
--

CREATE TABLE `tbl_priceshipping` (
  `priceshippingId` int(11) NOT NULL,
  `name_service` varchar(50) NOT NULL,
  `price` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `tbl_priceshipping`
--

INSERT INTO `tbl_priceshipping` (`priceshippingId`, `name_service`, `price`) VALUES
(1, 'Giao hàng tiêu chuẩn', '25000');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_product`
--

CREATE TABLE `tbl_product` (
  `productId` int(11) NOT NULL,
  `productName` tinytext COLLATE utf8_unicode_ci NOT NULL,
  `product_code` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `productQuantity` int(4) NOT NULL,
  `product_soldout` int(11) NOT NULL DEFAULT '0',
  `product_remain` int(11) NOT NULL,
  `catId` int(11) NOT NULL,
  `brandId` int(11) NOT NULL,
  `product_desc` text COLLATE utf8_unicode_ci NOT NULL,
  `type` int(1) NOT NULL,
  `root_price` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `old_price` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `price` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `image` json NOT NULL,
  `size` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_product`
--

INSERT INTO `tbl_product` (`productId`, `productName`, `product_code`, `productQuantity`, `product_soldout`, `product_remain`, `catId`, `brandId`, `product_desc`, `type`, `root_price`, `old_price`, `price`, `image`, `size`) VALUES
(139, 'Set tất vớ 5 đôi Sp như hình', '127515753005891', 999, 1, 999, 23, 18, '<p><strong>MÔ TẢ:</strong></p><p>Chất liệu: Cotton</p><p>Đảm bảo khử mùi hiệu quả, kháng khuẩn.</p><p>Chất liệu vải mềm, nhẹ, co giãn 4 chiều , thấm hút mồ hôi, bền màu.</p><p>Nhiều kiểu dáng khác nhau thoải mái lựa chọn</p><p>----------------------------</p><p><a href=\"https://www.facebook.com/hashtag/kabistorecomvn?__eep__=6&amp;__cft__[0]=AZUyNzRXtjL7TypEfq6pS7riP4ynaLhrhN3szLyU2AzCTS19QozMbJGfgMe85lldPE4TIp7w-z7h3QA5DHg1cHTJnSYu0b9XQVkDUKcdst6iVRsn3DN4th-qjaBOQkc5OmC4hiTg_Z1PMNISspTwLLNJ6jqtfoY-Hp_Q5eDK1kLAqA&amp;__tn__=*NK-R\">#kabistorecomvn</a></p><p><a href=\"https://www.facebook.com/hashtag/ilovekabistore?__eep__=6&amp;__cft__[0]=AZUyNzRXtjL7TypEfq6pS7riP4ynaLhrhN3szLyU2AzCTS19QozMbJGfgMe85lldPE4TIp7w-z7h3QA5DHg1cHTJnSYu0b9XQVkDUKcdst6iVRsn3DN4th-qjaBOQkc5OmC4hiTg_Z1PMNISspTwLLNJ6jqtfoY-Hp_Q5eDK1kLAqA&amp;__tn__=*NK-R\">#ilovekabistore</a> <a href=\"https://www.facebook.com/hashtag/kabistoregiasieure?__eep__=6&amp;__cft__[0]=AZUyNzRXtjL7TypEfq6pS7riP4ynaLhrhN3szLyU2AzCTS19QozMbJGfgMe85lldPE4TIp7w-z7h3QA5DHg1cHTJnSYu0b9XQVkDUKcdst6iVRsn3DN4th-qjaBOQkc5OmC4hiTg_Z1PMNISspTwLLNJ6jqtfoY-Hp_Q5eDK1kLAqA&amp;__tn__=*NK-R\">#kabistoregiasieure</a> <a href=\"https://www.facebook.com/hashtag/tat?__eep__=6&amp;__cft__[0]=AZUyNzRXtjL7TypEfq6pS7riP4ynaLhrhN3szLyU2AzCTS19QozMbJGfgMe85lldPE4TIp7w-z7h3QA5DHg1cHTJnSYu0b9XQVkDUKcdst6iVRsn3DN4th-qjaBOQkc5OmC4hiTg_Z1PMNISspTwLLNJ6jqtfoY-Hp_Q5eDK1kLAqA&amp;__tn__=*NK-R\">#tat</a> <a href=\"https://www.facebook.com/hashtag/set5doivo?__eep__=6&amp;__cft__[0]=AZUyNzRXtjL7TypEfq6pS7riP4ynaLhrhN3szLyU2AzCTS19QozMbJGfgMe85lldPE4TIp7w-z7h3QA5DHg1cHTJnSYu0b9XQVkDUKcdst6iVRsn3DN4th-qjaBOQkc5OmC4hiTg_Z1PMNISspTwLLNJ6jqtfoY-Hp_Q5eDK1kLAqA&amp;__tn__=*NK-R\">#set5doivo</a> <a href=\"https://www.facebook.com/hashtag/tatngan?__eep__=6&amp;__cft__[0]=AZUyNzRXtjL7TypEfq6pS7riP4ynaLhrhN3szLyU2AzCTS19QozMbJGfgMe85lldPE4TIp7w-z7h3QA5DHg1cHTJnSYu0b9XQVkDUKcdst6iVRsn3DN4th-qjaBOQkc5OmC4hiTg_Z1PMNISspTwLLNJ6jqtfoY-Hp_Q5eDK1kLAqA&amp;__tn__=*NK-R\">#tatngan</a> <a href=\"https://www.facebook.com/hashtag/vongan?__eep__=6&amp;__cft__[0]=AZUyNzRXtjL7TypEfq6pS7riP4ynaLhrhN3szLyU2AzCTS19QozMbJGfgMe85lldPE4TIp7w-z7h3QA5DHg1cHTJnSYu0b9XQVkDUKcdst6iVRsn3DN4th-qjaBOQkc5OmC4hiTg_Z1PMNISspTwLLNJ6jqtfoY-Hp_Q5eDK1kLAqA&amp;__tn__=*NK-R\">#vongan</a> <a href=\"https://www.facebook.com/hashtag/vocao?__eep__=6&amp;__cft__[0]=AZUyNzRXtjL7TypEfq6pS7riP4ynaLhrhN3szLyU2AzCTS19QozMbJGfgMe85lldPE4TIp7w-z7h3QA5DHg1cHTJnSYu0b9XQVkDUKcdst6iVRsn3DN4th-qjaBOQkc5OmC4hiTg_Z1PMNISspTwLLNJ6jqtfoY-Hp_Q5eDK1kLAqA&amp;__tn__=*NK-R\">#vocao</a> <a href=\"https://www.facebook.com/hashtag/tatcao?__eep__=6&amp;__cft__[0]=AZUyNzRXtjL7TypEfq6pS7riP4ynaLhrhN3szLyU2AzCTS19QozMbJGfgMe85lldPE4TIp7w-z7h3QA5DHg1cHTJnSYu0b9XQVkDUKcdst6iVRsn3DN4th-qjaBOQkc5OmC4hiTg_Z1PMNISspTwLLNJ6jqtfoY-Hp_Q5eDK1kLAqA&amp;__tn__=*NK-R\">#tatcao</a></p>', 1, '31000', '49000', '41000', '[{\"image\": \"https://scontent.fvca1-1.fna.fbcdn.net/v/t39.30808-6/250635109_127439199680213_1940678742107403359_n.jpg?_nc_cat=102&ccb=1-5&_nc_sid=730e14&_nc_ohc=RbO8L73Ge40AX8sw9pI&_nc_ht=scontent.fvca1-1.fna&oh=13927762d797d4a60c067c2cfee616fa&oe=619617CB\"}, {\"image\": \"https://scontent.fvca1-1.fna.fbcdn.net/v/t39.30808-6/248145927_127439163013550_1645686581566575236_n.jpg?_nc_cat=105&ccb=1-5&_nc_sid=730e14&_nc_ohc=3UlNPum5CbcAX_W9CR4&tn=3KEBYS8SET_aSR4c&_nc_ht=scontent.fvca1-1.fna&oh=56fd1253b2afd0363180608b9382dea3&oe=619628D9\"}, {\"image\": \"https://scontent.fvca1-2.fna.fbcdn.net/v/t39.30808-6/254074341_127439259680207_4641090080336933937_n.jpg?_nc_cat=100&ccb=1-5&_nc_sid=730e14&_nc_ohc=ZbXfDkWV3MsAX-lUjjc&_nc_ht=scontent.fvca1-2.fna&oh=6775a6fc8500b94f72bdd9ab785dbcbb&oe=619624C4\"}, {\"image\": \"https://scontent.fvca1-1.fna.fbcdn.net/v/t39.30808-6/256218305_127439173013549_2409727080035108866_n.jpg?_nc_cat=106&ccb=1-5&_nc_sid=730e14&_nc_ohc=HrNmJ_98pgEAX9xg2k7&_nc_ht=scontent.fvca1-1.fna&oh=1eeab48b497eb99f5f7eab3d4457a756&oe=6196687D\"}, {\"image\": \"https://scontent.fvca1-3.fna.fbcdn.net/v/t39.30808-6/248036940_127439249680208_3722930515453506974_n.jpg?_nc_cat=110&ccb=1-5&_nc_sid=730e14&_nc_ohc=HmAU78XacPcAX_PK1LJ&_nc_ht=scontent.fvca1-3.fna&oh=9d28494e074ae6c724a66956dd4b99e0&oe=619621FD\"}, {\"image\": \"https://scontent.fvca1-2.fna.fbcdn.net/v/t39.30808-6/250665713_127439279680205_8911326675553255703_n.jpg?_nc_cat=104&ccb=1-5&_nc_sid=730e14&_nc_ohc=sIMndfDeL7UAX-qQAmk&tn=3KEBYS8SET_aSR4c&_nc_ht=scontent.fvca1-2.fna&oh=e7a04ff3d83df63fb3b56e79320909ec&oe=6195CCC1\"}]', 0),
(140, 'Set 5 đôi tất - 5 đôi 5 màu', '127531923004274', 999, 3, 999, 23, 18, '<div dir=\"auto\"><span style=\"font-size: small;\">Phong c&aacute;ch c&aacute; t&iacute;nh, năng động.</span></div>\n<div dir=\"auto\"><span style=\"font-size: small;\">Chất liệu co d&atilde;n tốt, form đẹp, &ocirc;m ch&acirc;n cho n&agrave;ng thoải m&aacute;i PHI&Ecirc;U c&ugrave;ng tuổi trẻ, ch&aacute;y hết m&igrave;nh.</span></div>\n<div dir=\"auto\"><span style=\"font-size: small;\">Set tất đặc biệt, cực nhanh hết h&agrave;ng, ib ngay để giữ h&agrave;ng n&agrave;o</span></div>\n<div dir=\"auto\"><span style=\"font-size: small;\">M&agrave;u đẹp, chất len sợi cotton d&agrave;y dặn, đi &ecirc;m ch&acirc;n, kh&ocirc;ng b&iacute; ch&acirc;n như c&aacute;c d&ograve;ng vải kh&aacute;c.</span></div>\n<div dir=\"auto\"><span style=\"font-size: small;\">Thiết kế họa tiết si&ecirc;u Cute , &ocirc;m ch&acirc;n thon gọn.</span></div>\n<div dir=\"auto\">\n<div dir=\"auto\"><span style=\"font-size: small;\">-----------------------------------------------------------</span></div>\n<div class=\"o9v6fnle cxmmr5t8 oygrvhab hcukyx3x c1et5uql ii04i59q\">\n<div dir=\"auto\"><span style=\"font-size: small;\"><a class=\"oajrlxb2 g5ia77u1 qu0x051f esr5mh6w e9989ue4 r7d6kgcz rq0escxv nhd2j8a9 nc684nl6 p7hjln8o kvgmc6g5 cxmmr5t8 oygrvhab hcukyx3x jb3vyjys rz4wbd8a qt6c0cv9 a8nywdso i1ao9s8h esuyzwwr f1sip0of lzcic4wl q66pz984 gpro0wi8 b1v8xokw\" tabindex=\"0\" href=\"https://www.facebook.com/hashtag/ilovekabistore?__eep__=6&amp;__cft__[0]=AZXP6gb0WHkSyc2jtYIh9y8cRhLYwshfx32GttJJ2yHXMl-o3oc-TcJ0Sf5Ugiugv_d45nIm335lprDeAqd-49XkbBzMcUOWXElxdt5w9eOjnjb-Ed9yFgwCAVaa28mfjHBu6DQmuXspmRFZhGE4e5DTmxlH0lNuSyOtfqGGi2zGMg&amp;__tn__=*NK-R\">#ilovekabistore</a> <a class=\"oajrlxb2 g5ia77u1 qu0x051f esr5mh6w e9989ue4 r7d6kgcz rq0escxv nhd2j8a9 nc684nl6 p7hjln8o kvgmc6g5 cxmmr5t8 oygrvhab hcukyx3x jb3vyjys rz4wbd8a qt6c0cv9 a8nywdso i1ao9s8h esuyzwwr f1sip0of lzcic4wl q66pz984 gpro0wi8 b1v8xokw\" tabindex=\"0\" href=\"https://www.facebook.com/hashtag/kabistoregiasieure?__eep__=6&amp;__cft__[0]=AZXP6gb0WHkSyc2jtYIh9y8cRhLYwshfx32GttJJ2yHXMl-o3oc-TcJ0Sf5Ugiugv_d45nIm335lprDeAqd-49XkbBzMcUOWXElxdt5w9eOjnjb-Ed9yFgwCAVaa28mfjHBu6DQmuXspmRFZhGE4e5DTmxlH0lNuSyOtfqGGi2zGMg&amp;__tn__=*NK-R\">#kabistoregiasieure</a> <a class=\"oajrlxb2 g5ia77u1 qu0x051f esr5mh6w e9989ue4 r7d6kgcz rq0escxv nhd2j8a9 nc684nl6 p7hjln8o kvgmc6g5 cxmmr5t8 oygrvhab hcukyx3x jb3vyjys rz4wbd8a qt6c0cv9 a8nywdso i1ao9s8h esuyzwwr f1sip0of lzcic4wl q66pz984 gpro0wi8 b1v8xokw\" tabindex=\"0\" href=\"https://www.facebook.com/hashtag/tat?__eep__=6&amp;__cft__[0]=AZXP6gb0WHkSyc2jtYIh9y8cRhLYwshfx32GttJJ2yHXMl-o3oc-TcJ0Sf5Ugiugv_d45nIm335lprDeAqd-49XkbBzMcUOWXElxdt5w9eOjnjb-Ed9yFgwCAVaa28mfjHBu6DQmuXspmRFZhGE4e5DTmxlH0lNuSyOtfqGGi2zGMg&amp;__tn__=*NK-R\">#tat</a> <a class=\"oajrlxb2 g5ia77u1 qu0x051f esr5mh6w e9989ue4 r7d6kgcz rq0escxv nhd2j8a9 nc684nl6 p7hjln8o kvgmc6g5 cxmmr5t8 oygrvhab hcukyx3x jb3vyjys rz4wbd8a qt6c0cv9 a8nywdso i1ao9s8h esuyzwwr f1sip0of lzcic4wl q66pz984 gpro0wi8 b1v8xokw\" tabindex=\"0\" href=\"https://www.facebook.com/hashtag/set5doivo?__eep__=6&amp;__cft__[0]=AZXP6gb0WHkSyc2jtYIh9y8cRhLYwshfx32GttJJ2yHXMl-o3oc-TcJ0Sf5Ugiugv_d45nIm335lprDeAqd-49XkbBzMcUOWXElxdt5w9eOjnjb-Ed9yFgwCAVaa28mfjHBu6DQmuXspmRFZhGE4e5DTmxlH0lNuSyOtfqGGi2zGMg&amp;__tn__=*NK-R\">#set5doivo</a> <a class=\"oajrlxb2 g5ia77u1 qu0x051f esr5mh6w e9989ue4 r7d6kgcz rq0escxv nhd2j8a9 nc684nl6 p7hjln8o kvgmc6g5 cxmmr5t8 oygrvhab hcukyx3x jb3vyjys rz4wbd8a qt6c0cv9 a8nywdso i1ao9s8h esuyzwwr f1sip0of lzcic4wl q66pz984 gpro0wi8 b1v8xokw\" tabindex=\"0\" href=\"https://www.facebook.com/hashtag/tatngan?__eep__=6&amp;__cft__[0]=AZXP6gb0WHkSyc2jtYIh9y8cRhLYwshfx32GttJJ2yHXMl-o3oc-TcJ0Sf5Ugiugv_d45nIm335lprDeAqd-49XkbBzMcUOWXElxdt5w9eOjnjb-Ed9yFgwCAVaa28mfjHBu6DQmuXspmRFZhGE4e5DTmxlH0lNuSyOtfqGGi2zGMg&amp;__tn__=*NK-R\">#tatngan</a> <a class=\"oajrlxb2 g5ia77u1 qu0x051f esr5mh6w e9989ue4 r7d6kgcz rq0escxv nhd2j8a9 nc684nl6 p7hjln8o kvgmc6g5 cxmmr5t8 oygrvhab hcukyx3x jb3vyjys rz4wbd8a qt6c0cv9 a8nywdso i1ao9s8h esuyzwwr f1sip0of lzcic4wl q66pz984 gpro0wi8 b1v8xokw\" tabindex=\"0\" href=\"https://www.facebook.com/hashtag/vongan?__eep__=6&amp;__cft__[0]=AZXP6gb0WHkSyc2jtYIh9y8cRhLYwshfx32GttJJ2yHXMl-o3oc-TcJ0Sf5Ugiugv_d45nIm335lprDeAqd-49XkbBzMcUOWXElxdt5w9eOjnjb-Ed9yFgwCAVaa28mfjHBu6DQmuXspmRFZhGE4e5DTmxlH0lNuSyOtfqGGi2zGMg&amp;__tn__=*NK-R\">#vongan</a> <a class=\"oajrlxb2 g5ia77u1 qu0x051f esr5mh6w e9989ue4 r7d6kgcz rq0escxv nhd2j8a9 nc684nl6 p7hjln8o kvgmc6g5 cxmmr5t8 oygrvhab hcukyx3x jb3vyjys rz4wbd8a qt6c0cv9 a8nywdso i1ao9s8h esuyzwwr f1sip0of lzcic4wl q66pz984 gpro0wi8 b1v8xokw\" tabindex=\"0\" href=\"https://www.facebook.com/hashtag/vocao?__eep__=6&amp;__cft__[0]=AZXP6gb0WHkSyc2jtYIh9y8cRhLYwshfx32GttJJ2yHXMl-o3oc-TcJ0Sf5Ugiugv_d45nIm335lprDeAqd-49XkbBzMcUOWXElxdt5w9eOjnjb-Ed9yFgwCAVaa28mfjHBu6DQmuXspmRFZhGE4e5DTmxlH0lNuSyOtfqGGi2zGMg&amp;__tn__=*NK-R\">#vocao</a> <a class=\"oajrlxb2 g5ia77u1 qu0x051f esr5mh6w e9989ue4 r7d6kgcz rq0escxv nhd2j8a9 nc684nl6 p7hjln8o kvgmc6g5 cxmmr5t8 oygrvhab hcukyx3x jb3vyjys rz4wbd8a qt6c0cv9 a8nywdso i1ao9s8h esuyzwwr f1sip0of lzcic4wl q66pz984 gpro0wi8 b1v8xokw\" tabindex=\"0\" href=\"https://www.facebook.com/hashtag/tatcao?__eep__=6&amp;__cft__[0]=AZXP6gb0WHkSyc2jtYIh9y8cRhLYwshfx32GttJJ2yHXMl-o3oc-TcJ0Sf5Ugiugv_d45nIm335lprDeAqd-49XkbBzMcUOWXElxdt5w9eOjnjb-Ed9yFgwCAVaa28mfjHBu6DQmuXspmRFZhGE4e5DTmxlH0lNuSyOtfqGGi2zGMg&amp;__tn__=*NK-R\">#tatcao</a></span></div>\n</div>\n</div>', 2, '35000', '53000', '45000', '[{\"image\": \"https://scontent.fvca1-2.fna.fbcdn.net/v/t1.6435-9/253880578_127531789670954_864983966133243286_n.jpg?_nc_cat=100&ccb=1-5&_nc_sid=8bfeb9&_nc_ohc=jMwF-q-m-v8AX8fUYMD&_nc_ht=scontent.fvca1-2.fna&oh=b687782d68b71387a12b7770460edc8f&oe=61B14169\"}, {\"image\": \"https://scontent.fvca1-3.fna.fbcdn.net/v/t1.6435-9/253932704_127531829670950_5639147505656472198_n.jpg?_nc_cat=103&ccb=1-5&_nc_sid=8bfeb9&_nc_ohc=4KFV4HARtvIAX_7dnpP&_nc_ht=scontent.fvca1-3.fna&oh=d9b3e3ed035e5a9bb3d963cce05cd44b&oe=61B34721\"}, {\"image\": \"https://scontent.fvca1-2.fna.fbcdn.net/v/t1.6435-9/254801694_127531856337614_8705933056558289380_n.jpg?_nc_cat=107&ccb=1-5&_nc_sid=8bfeb9&_nc_ohc=Gd8NLpmsl5gAX82z-fI&_nc_ht=scontent.fvca1-2.fna&oh=f234b7d12263c025de714404e78ce8af&oe=61B40494\"}, {\"image\": \"https://scontent.fvca1-2.fna.fbcdn.net/v/t1.6435-9/254695883_127531889670944_6830973144970386610_n.jpg?_nc_cat=104&ccb=1-5&_nc_sid=8bfeb9&_nc_ohc=HbMEsT2nOYIAX-MXdDh&_nc_ht=scontent.fvca1-2.fna&oh=41a45cedae98b1bed29a0bd44d7e7f18&oe=61B3EE7E\"}]', 0),
(141, 'Set 5 đôi tất cổ tim viền bèo', '127545949669538', 999, 2, 999, 23, 18, '<div dir=\"auto\">\n<div data-block=\"true\" data-editor=\"fvp79\" data-offset-key=\"860er-0-0\">\n<div class=\"_1mf _1mj\" data-offset-key=\"860er-0-0\"><span style=\"font-size: small;\">M&ugrave;a đ&ocirc;ng lạnh lắm sắm sửa đ&ocirc;i vớ mới đi n&agrave;o ?</span></div>\n</div>\n<div data-block=\"true\" data-editor=\"fvp79\" data-offset-key=\"4cr4t-0-0\">\n<div class=\"_1mf _1mj\" data-offset-key=\"4cr4t-0-0\">&nbsp;</div>\n</div>\n<div data-block=\"true\" data-editor=\"fvp79\" data-offset-key=\"9b2p8-0-0\">\n<div class=\"_1mf _1mj\" data-offset-key=\"9b2p8-0-0\"><span style=\"font-size: small;\" data-offset-key=\"9b2p8-0-0\">Chất liệu: Cotton</span></div>\n</div>\n<div data-block=\"true\" data-editor=\"fvp79\" data-offset-key=\"a53ke-0-0\">\n<div class=\"_1mf _1mj\" data-offset-key=\"a53ke-0-0\"><span style=\"font-size: small;\" data-offset-key=\"a53ke-0-0\">Đảm bảo khử m&ugrave;i hiệu quả, kh&aacute;ng khuẩn.</span></div>\n</div>\n<div data-block=\"true\" data-editor=\"fvp79\" data-offset-key=\"bet83-0-0\">\n<div class=\"_1mf _1mj\" data-offset-key=\"bet83-0-0\"><span style=\"font-size: small;\" data-offset-key=\"bet83-0-0\">Chất liệu vải mềm, nhẹ, co gi&atilde;n 4 chiều , thấm h&uacute;t mồ h&ocirc;i, bền m&agrave;u.</span></div>\n</div>\n<div data-block=\"true\" data-editor=\"fvp79\" data-offset-key=\"3q1au-0-0\">\n<div class=\"_1mf _1mj\" data-offset-key=\"3q1au-0-0\"><span style=\"font-size: small;\" data-offset-key=\"3q1au-0-0\">Nhiều kiểu d&aacute;ng kh&aacute;c nhau thoải m&aacute;i lựa chọn</span></div>\n</div>\n<div data-block=\"true\" data-editor=\"fvp79\" data-offset-key=\"b2ntq-0-0\">\n<div class=\"_1mf _1mj\" data-offset-key=\"b2ntq-0-0\"><span style=\"font-size: small;\" data-offset-key=\"b2ntq-0-0\">-----------------------------------------------------------</span></div>\n</div>\n<div data-block=\"true\" data-editor=\"fvp79\" data-offset-key=\"c7h7k-0-0\">\n<div class=\"_1mf _1mj\" data-offset-key=\"c7h7k-0-0\"><span class=\"_5zk7\" style=\"font-size: small;\" data-offset-key=\"c7h7k-0-0\"><span data-offset-key=\"c7h7k-0-0\">#kabistorecomvn</span></span></div>\n</div>\n<div data-block=\"true\" data-editor=\"fvp79\" data-offset-key=\"9rg6i-0-0\">\n<div class=\"_1mf _1mj\" data-offset-key=\"9rg6i-0-0\"><span style=\"font-size: small;\"><span class=\"_5zk7\" data-offset-key=\"9rg6i-0-0\"><span data-offset-key=\"9rg6i-0-0\">#ilovekabistore</span></span></span></div>\n<div class=\"_1mf _1mj\" data-offset-key=\"9rg6i-0-0\"><span style=\"font-size: small;\"><span class=\"_5zk7\" data-offset-key=\"9rg6i-2-0\"><span data-offset-key=\"9rg6i-2-0\">#kabistoregiasieure</span></span></span></div>\n<div class=\"_1mf _1mj\" data-offset-key=\"9rg6i-0-0\"><span style=\"font-size: small;\"><span class=\"_5zk7\" data-offset-key=\"9rg6i-4-0\"><span data-offset-key=\"9rg6i-4-0\">#tat</span></span><span class=\"_5zk7\" data-offset-key=\"9rg6i-6-0\"><span data-offset-key=\"9rg6i-6-0\">#set5doivo</span></span><span class=\"_5zk7\" data-offset-key=\"9rg6i-8-0\"><span data-offset-key=\"9rg6i-8-0\">#tatngan</span></span></span></div>\n<div class=\"_1mf _1mj\" data-offset-key=\"9rg6i-0-0\"><span style=\"font-size: small;\"><span class=\"_5zk7\" data-offset-key=\"9rg6i-10-0\"><span data-offset-key=\"9rg6i-10-0\">#vongan</span></span><span class=\"_5zk7\" data-offset-key=\"9rg6i-12-0\"><span data-offset-key=\"9rg6i-12-0\">#vocao</span></span><span class=\"_5zk7\" data-offset-key=\"9rg6i-14-0\"><span data-offset-key=\"9rg6i-14-0\">#tatcao</span></span></span></div>\n</div>\n</div>\n<div dir=\"auto\">&nbsp;</div>', 2, '35000', '53000', '45000', '[{\"image\": \"https://scontent.fvca1-4.fna.fbcdn.net/v/t1.6435-9/247878253_127545826336217_3568216077494008291_n.jpg?_nc_cat=109&ccb=1-5&_nc_sid=8bfeb9&_nc_ohc=_rWebgcI4EkAX96tqEt&_nc_ht=scontent.fvca1-4.fna&oh=be55d2c10b13cad29bb7cf9da4e93b9c&oe=61B25729\"}, {\"image\": \"https://scontent.fvca1-1.fna.fbcdn.net/v/t1.6435-9/254326183_127545856336214_2333712944150777900_n.jpg?_nc_cat=106&ccb=1-5&_nc_sid=8bfeb9&_nc_ohc=TnIP4g9KGE4AX-SgG28&tn=3KEBYS8SET_aSR4c&_nc_ht=scontent.fvca1-1.fna&oh=cd1cb69b9da63cc82a031bb0c12a589a&oe=61B41571\"}, {\"image\": \"https://scontent.fvca1-3.fna.fbcdn.net/v/t1.6435-9/254295109_127545896336210_4614974244157700576_n.jpg?_nc_cat=111&ccb=1-5&_nc_sid=8bfeb9&_nc_ohc=Ff8r2dXQg9MAX_809k1&_nc_ht=scontent.fvca1-3.fna&oh=805fb5f50537e6fa918b761fce327a01&oe=61B44437\"}, {\"image\": \"https://scontent.fvca1-1.fna.fbcdn.net/v/t1.6435-9/255445794_127545926336207_5082034704224020139_n.jpg?_nc_cat=102&ccb=1-5&_nc_sid=8bfeb9&_nc_ohc=AlQOV0B29U8AX_9UC9P&_nc_ht=scontent.fvca1-1.fna&oh=f73235c28d2fa5bbc1849e4a46308295&oe=61B38849\"}, {\"image\": \"\"}]', 0),
(142, 'Xà phòng cám gạo Thái Lan Jam milk soap', '127549959669137', 999, 3, 999, 22, 18, '<div dir=\"auto\">\n<div data-block=\"true\" data-editor=\"fvp79\" data-offset-key=\"860er-0-0\">\n<div class=\"_1mf _1mj\" data-offset-key=\"860er-0-0\">\n<div data-block=\"true\" data-editor=\"3mei\" data-offset-key=\"3afmj-0-0\">\n<div class=\"_1mf _1mj\" data-offset-key=\"3afmj-0-0\"><span style=\"font-size: small;\" data-offset-key=\"3afmj-0-0\"><strong>T&aacute;c dụng:</strong></span></div>\n</div>\n<div data-block=\"true\" data-editor=\"3mei\" data-offset-key=\"1v7aa-0-0\">\n<div class=\"_1mf _1mj\" data-offset-key=\"1v7aa-0-0\"><span style=\"font-size: small;\" data-offset-key=\"1v7aa-0-0\">- An to&agrave;n, d&ugrave;ng được cho phụ nữ đang mang thai.</span></div>\n</div>\n<div data-block=\"true\" data-editor=\"3mei\" data-offset-key=\"i5h6-0-0\">\n<div class=\"_1mf _1mj\" data-offset-key=\"i5h6-0-0\"><span style=\"font-size: small;\" data-offset-key=\"i5h6-0-0\">- Th&iacute;ch hợp cho mọi loại da, kể cả da kh&ocirc; v&agrave; nhạy cảm.</span></div>\n</div>\n<div data-block=\"true\" data-editor=\"3mei\" data-offset-key=\"98v9b-0-0\">\n<div class=\"_1mf _1mj\" data-offset-key=\"98v9b-0-0\"><span style=\"font-size: small;\" data-offset-key=\"98v9b-0-0\">- D&ugrave;ng để rửa mặt hoặc tắm to&agrave;n th&acirc;n.</span></div>\n</div>\n<div data-block=\"true\" data-editor=\"3mei\" data-offset-key=\"84i1k-0-0\">\n<div class=\"_1mf _1mj\" data-offset-key=\"84i1k-0-0\"><span style=\"font-size: small;\" data-offset-key=\"84i1k-0-0\">T&aacute;c dụng với da mặt:</span></div>\n</div>\n<div data-block=\"true\" data-editor=\"3mei\" data-offset-key=\"edht9-0-0\">\n<div class=\"_1mf _1mj\" data-offset-key=\"edht9-0-0\"><span style=\"font-size: small;\" data-offset-key=\"edht9-0-0\">Vitamin trong sữa gạo gi&uacute;p da s&aacute;ng dần l&ecirc;n v&agrave; mềm mại.</span></div>\n</div>\n<div data-block=\"true\" data-editor=\"3mei\" data-offset-key=\"19klo-0-0\">\n<div class=\"_1mf _1mj\" data-offset-key=\"19klo-0-0\"><span style=\"font-size: small;\" data-offset-key=\"19klo-0-0\">Loại bỏ c&aacute;c chất bụi bẩn, dầu v&agrave; tế b&agrave;o chết.</span></div>\n</div>\n<div data-block=\"true\" data-editor=\"3mei\" data-offset-key=\"f06mm-0-0\">\n<div class=\"_1mf _1mj\" data-offset-key=\"f06mm-0-0\"><span style=\"font-size: small;\" data-offset-key=\"f06mm-0-0\">Gi&uacute;p loại bỏ mụn v&agrave; da dầu.</span></div>\n</div>\n<div data-block=\"true\" data-editor=\"3mei\" data-offset-key=\"elds0-0-0\">\n<div class=\"_1mf _1mj\" data-offset-key=\"elds0-0-0\"><span style=\"font-size: small;\" data-offset-key=\"elds0-0-0\">Sử dụng thay sữa rửa mặt để l&agrave;m sạch da.</span></div>\n</div>\n<div data-block=\"true\" data-editor=\"3mei\" data-offset-key=\"6gm2k-0-0\">\n<div class=\"_1mf _1mj\" data-offset-key=\"6gm2k-0-0\"><span style=\"font-size: small;\" data-offset-key=\"6gm2k-0-0\">T&aacute;c dụng với l&agrave;n da của cơ thể:</span></div>\n</div>\n<div data-block=\"true\" data-editor=\"3mei\" data-offset-key=\"ehl9-0-0\">\n<div class=\"_1mf _1mj\" data-offset-key=\"ehl9-0-0\"><span style=\"font-size: small;\" data-offset-key=\"ehl9-0-0\">Loại bỏ v&ugrave;ng th&acirc;m đen ở n&aacute;ch, bẹn, h&aacute;ng, khuỷu tay ch&acirc;n&hellip;</span></div>\n</div>\n<div data-block=\"true\" data-editor=\"3mei\" data-offset-key=\"4iunk-0-0\">\n<div class=\"_1mf _1mj\" data-offset-key=\"4iunk-0-0\"><span style=\"font-size: small;\" data-offset-key=\"4iunk-0-0\">Cung cấp do da c&aacute;c Vitamin dưỡng chất, tươi trẻ mỗi ng&agrave;y.</span></div>\n</div>\n<div data-block=\"true\" data-editor=\"3mei\" data-offset-key=\"j41k-0-0\">\n<div class=\"_1mf _1mj\" data-offset-key=\"j41k-0-0\"><span style=\"font-size: small;\" data-offset-key=\"j41k-0-0\">Loại bỏ m&ugrave;i cơ thể v&agrave; bụi bẩn.</span></div>\n</div>\n<div data-block=\"true\" data-editor=\"3mei\" data-offset-key=\"bdu9r-0-0\">\n<div class=\"_1mf _1mj\" data-offset-key=\"bdu9r-0-0\"><span style=\"font-size: small;\" data-offset-key=\"bdu9r-0-0\"><strong>Trọng lượng:</strong> 50 gram.</span></div>\n</div>\n<div data-block=\"true\" data-editor=\"3mei\" data-offset-key=\"fvfcs-0-0\">\n<div class=\"_1mf _1mj\" data-offset-key=\"fvfcs-0-0\"><span style=\"font-size: small;\" data-offset-key=\"fvfcs-0-0\"><strong>Xuất xứ:</strong> Th&aacute;i Lan.</span></div>\n</div>\n<div data-block=\"true\" data-editor=\"3mei\" data-offset-key=\"dr7u3-0-0\">\n<div class=\"_1mf _1mj\" data-offset-key=\"dr7u3-0-0\"><span style=\"font-size: small;\" data-offset-key=\"dr7u3-0-0\">-----------------------------------------------------------</span></div>\n</div>\n<div data-block=\"true\" data-editor=\"3mei\" data-offset-key=\"bj9ge-0-0\">\n<div class=\"_1mf _1mj\" data-offset-key=\"bj9ge-0-0\"><span class=\"diy96o5h\" style=\"font-size: small;\">#kabistorecomvn</span></div>\n</div>\n<div data-block=\"true\" data-editor=\"3mei\" data-offset-key=\"6lop7-0-0\">\n<div class=\"_1mf _1mj\" data-offset-key=\"6lop7-0-0\"><span style=\"font-size: small;\"><span class=\"diy96o5h\">#ilovekabistore</span><span class=\"diy96o5h\">#kabistoregiasieure</span></span></div>\n</div>\n</div>\n</div>\n</div>\n<div dir=\"auto\">&nbsp;</div>', 1, '9000', '', '15000', '[{\"image\": \"https://scontent.fvca1-3.fna.fbcdn.net/v/t1.6435-9/255639936_127549869669146_7248277540217020141_n.jpg?_nc_cat=103&ccb=1-5&_nc_sid=8bfeb9&_nc_ohc=PALz6rbR0zoAX_QqBBZ&tn=3KEBYS8SET_aSR4c&_nc_ht=scontent.fvca1-3.fna&oh=1c825bdebb094f7c475873314b1ee776&oe=61B11066\"}, {\"image\": \"https://scontent.fvca1-4.fna.fbcdn.net/v/t1.6435-9/254965805_127549896335810_3792615878429208457_n.jpg?_nc_cat=101&ccb=1-5&_nc_sid=8bfeb9&_nc_ohc=-rlJ-Yc8G80AX9BLlB6&_nc_ht=scontent.fvca1-4.fna&oh=fc4fd5bc27906abf9b31fae794e84da4&oe=61B16DEA\"}, {\"image\": \"https://scontent-sin6-3.xx.fbcdn.net/v/t1.6435-9/254549765_127549933002473_310141981810018341_n.jpg?_nc_cat=106&ccb=1-5&_nc_sid=8bfeb9&_nc_ohc=yPdp3JRHnpAAX-MlnRe&_nc_ht=scontent-sin6-3.xx&oh=59f7b9eff570e709b1716930b8aeb419&oe=61B12A04\"}]', 0),
(143, 'Bông tẩy trang Bông tẩy trang 3 lớp Cotton Pads - Túi 222 miếng', '127552596335540', 999, 1, 999, 22, 18, '<div dir=\"auto\">\n<div data-block=\"true\" data-editor=\"fvp79\" data-offset-key=\"860er-0-0\">\n<div class=\"_1mf _1mj\" data-offset-key=\"860er-0-0\">\n<div data-block=\"true\" data-editor=\"3mei\" data-offset-key=\"3afmj-0-0\">\n<div class=\"_1mf _1mj\" data-offset-key=\"3afmj-0-0\">\n<div dir=\"auto\"><span class=\"pq6dq46d tbxw36s4 knj5qynh kvgmc6g5 ditlmg2l oygrvhab nvdbi5me sf5mxxl7 gl3lb2sf hhz5lgdu\" style=\"font-size: small;\"><img src=\"https://static.xx.fbcdn.net/images/emoji.php/v9/t33/1/16/2705.png\" alt=\"✅\" width=\"16\" height=\"16\" /></span><span style=\"font-size: small;\"> B&ocirc;ng tẩy trang n&agrave;y d&ugrave;ng si&ecirc;u th&iacute;ch lu&ocirc;n &iacute;, d&agrave;y dặn, &iacute;t xơ m&agrave; gi&aacute; lại qu&aacute; ưu đ&atilde;i hihi.</span></div>\n<div dir=\"auto\"><span style=\"font-size: small;\"><span class=\"pq6dq46d tbxw36s4 knj5qynh kvgmc6g5 ditlmg2l oygrvhab nvdbi5me sf5mxxl7 gl3lb2sf hhz5lgdu\"><img src=\"https://static.xx.fbcdn.net/images/emoji.php/v9/t33/1/16/2705.png\" alt=\"✅\" width=\"16\" height=\"16\" /></span> 100% b&ocirc;ng tự nhi&ecirc;n.</span></div>\n<div dir=\"auto\"><span style=\"font-size: small;\"><span class=\"pq6dq46d tbxw36s4 knj5qynh kvgmc6g5 ditlmg2l oygrvhab nvdbi5me sf5mxxl7 gl3lb2sf hhz5lgdu\"><img src=\"https://static.xx.fbcdn.net/images/emoji.php/v9/t33/1/16/2705.png\" alt=\"✅\" width=\"16\" height=\"16\" /></span> C&oacute; t&uacute;i PP r&uacute;t si&ecirc;u tiện lợi v&agrave; giữ vệ sinh. Miếng b&ocirc;ng được viền xung quanh để tr&aacute;nh bị r&aacute;ch, hay x&ugrave; b&ocirc;ng.</span></div>\n<div dir=\"auto\"><span style=\"font-size: small;\"><span class=\"pq6dq46d tbxw36s4 knj5qynh kvgmc6g5 ditlmg2l oygrvhab nvdbi5me sf5mxxl7 gl3lb2sf hhz5lgdu\"><img src=\"https://static.xx.fbcdn.net/images/emoji.php/v9/t33/1/16/2705.png\" alt=\"✅\" width=\"16\" height=\"16\" /></span> Thiết kế với 2 mặt b&ocirc;ng vơi 2 c&ocirc;ng dụng kh&aacute;c nhau:</span></div>\n<div dir=\"auto\"><span style=\"font-size: small;\"><span class=\"pq6dq46d tbxw36s4 knj5qynh kvgmc6g5 ditlmg2l oygrvhab nvdbi5me sf5mxxl7 gl3lb2sf hhz5lgdu\"><img src=\"https://static.xx.fbcdn.net/images/emoji.php/v9/tca/1/16/2795.png\" alt=\"➕\" width=\"16\" height=\"16\" /></span> Một mặt được d&ugrave;ng để lấy lớp trang, bụi bẩn được dễ d&agrave;ng.</span></div>\n<div dir=\"auto\"><span style=\"font-size: small;\"><span class=\"pq6dq46d tbxw36s4 knj5qynh kvgmc6g5 ditlmg2l oygrvhab nvdbi5me sf5mxxl7 gl3lb2sf hhz5lgdu\"><img src=\"https://static.xx.fbcdn.net/images/emoji.php/v9/tca/1/16/2795.png\" alt=\"➕\" width=\"16\" height=\"16\" /></span> Mặt c&ograve;n lại được d&ugrave;ng để l&agrave;m sạch nhẹ nh&agrave;ng sau khi lớp trang điểm v&agrave; bụi bẩn đ&atilde; được lấy đi.</span></div>\n<div class=\"o9v6fnle cxmmr5t8 oygrvhab hcukyx3x c1et5uql ii04i59q\">\n<div dir=\"auto\"><span style=\"font-size: small;\"><span class=\"pq6dq46d tbxw36s4 knj5qynh kvgmc6g5 ditlmg2l oygrvhab nvdbi5me sf5mxxl7 gl3lb2sf hhz5lgdu\"><img src=\"https://static.xx.fbcdn.net/images/emoji.php/v9/t33/1/16/2705.png\" alt=\"✅\" width=\"16\" height=\"16\" /></span> Hướng dẫn sử dụng: B&ocirc;ng tẩy trang 3 lớp Cotton Pads [T&uacute;i 222 miếng]</span></div>\n<div dir=\"auto\"><span style=\"font-size: small;\">- Khi dưỡng da: Tẩm nước hoa hồng cơ bản l&ecirc;n miếng b&ocirc;ng tẩy trang rồi sử dụng</span></div>\n<div dir=\"auto\"><span style=\"font-size: small;\">- Khi tẩy trang: + D&ugrave;ng dung dịch tẩy trang massage mặt, tiếp theo đ&oacute; sử dụng b&ocirc;ng tẩy trang lau sạch + Thấm dung dịch tẩy trang l&ecirc;n b&ocirc;ng, sau đ&oacute; d&ugrave;ng b&ocirc;ng lau những v&ugrave;ng da cần tẩy trang</span></div>\n<div dir=\"auto\"><span style=\"font-size: small;\">-----------------------------------------------------------</span></div>\n<div dir=\"auto\"><span style=\"font-size: small;\"><a class=\"oajrlxb2 g5ia77u1 qu0x051f esr5mh6w e9989ue4 r7d6kgcz rq0escxv nhd2j8a9 nc684nl6 p7hjln8o kvgmc6g5 cxmmr5t8 oygrvhab hcukyx3x jb3vyjys rz4wbd8a qt6c0cv9 a8nywdso i1ao9s8h esuyzwwr f1sip0of lzcic4wl q66pz984 gpro0wi8 b1v8xokw\" tabindex=\"0\" href=\"https://www.facebook.com/hashtag/kabistorecomvn?__eep__=6&amp;__cft__[0]=AZVy6FyyMCkiIFkXxUlxoZoVtD2OzkRv1aEMeLOdBQbT6qTvVr45Om0Rlnt6U0XcI0Shoj4DiBmVtkcOHcUF8UrJBqMXCVPb4tCNxQP1LA9x8Tc8-ryKQhG24NQFak-H0pYOpkZcGAjiGTpqDln61tcUzQZP5I6m50Xkxz-XSO8R-Q&amp;__tn__=*NK-R\">#kabistorecomvn</a></span></div>\n<div dir=\"auto\"><span style=\"font-size: small;\"><a class=\"oajrlxb2 g5ia77u1 qu0x051f esr5mh6w e9989ue4 r7d6kgcz rq0escxv nhd2j8a9 nc684nl6 p7hjln8o kvgmc6g5 cxmmr5t8 oygrvhab hcukyx3x jb3vyjys rz4wbd8a qt6c0cv9 a8nywdso i1ao9s8h esuyzwwr f1sip0of lzcic4wl q66pz984 gpro0wi8 b1v8xokw\" tabindex=\"0\" href=\"https://www.facebook.com/hashtag/ilovekabistore?__eep__=6&amp;__cft__[0]=AZVy6FyyMCkiIFkXxUlxoZoVtD2OzkRv1aEMeLOdBQbT6qTvVr45Om0Rlnt6U0XcI0Shoj4DiBmVtkcOHcUF8UrJBqMXCVPb4tCNxQP1LA9x8Tc8-ryKQhG24NQFak-H0pYOpkZcGAjiGTpqDln61tcUzQZP5I6m50Xkxz-XSO8R-Q&amp;__tn__=*NK-R\">#ilovekabistore</a> <a class=\"oajrlxb2 g5ia77u1 qu0x051f esr5mh6w e9989ue4 r7d6kgcz rq0escxv nhd2j8a9 nc684nl6 p7hjln8o kvgmc6g5 cxmmr5t8 oygrvhab hcukyx3x jb3vyjys rz4wbd8a qt6c0cv9 a8nywdso i1ao9s8h esuyzwwr f1sip0of lzcic4wl q66pz984 gpro0wi8 b1v8xokw\" tabindex=\"0\" href=\"https://www.facebook.com/hashtag/kabistoregiasieure?__eep__=6&amp;__cft__[0]=AZVy6FyyMCkiIFkXxUlxoZoVtD2OzkRv1aEMeLOdBQbT6qTvVr45Om0Rlnt6U0XcI0Shoj4DiBmVtkcOHcUF8UrJBqMXCVPb4tCNxQP1LA9x8Tc8-ryKQhG24NQFak-H0pYOpkZcGAjiGTpqDln61tcUzQZP5I6m50Xkxz-XSO8R-Q&amp;__tn__=*NK-R\">#kabistoregiasieure</a></span></div>\n<div dir=\"auto\"><span style=\"font-size: small;\"><a class=\"oajrlxb2 g5ia77u1 qu0x051f esr5mh6w e9989ue4 r7d6kgcz rq0escxv nhd2j8a9 nc684nl6 p7hjln8o kvgmc6g5 cxmmr5t8 oygrvhab hcukyx3x jb3vyjys rz4wbd8a qt6c0cv9 a8nywdso i1ao9s8h esuyzwwr f1sip0of lzcic4wl q66pz984 gpro0wi8 b1v8xokw\" tabindex=\"0\" href=\"https://www.facebook.com/hashtag/bongtaytrang?__eep__=6&amp;__cft__[0]=AZVy6FyyMCkiIFkXxUlxoZoVtD2OzkRv1aEMeLOdBQbT6qTvVr45Om0Rlnt6U0XcI0Shoj4DiBmVtkcOHcUF8UrJBqMXCVPb4tCNxQP1LA9x8Tc8-ryKQhG24NQFak-H0pYOpkZcGAjiGTpqDln61tcUzQZP5I6m50Xkxz-XSO8R-Q&amp;__tn__=*NK-R\">#bongtaytrang</a> <a class=\"oajrlxb2 g5ia77u1 qu0x051f esr5mh6w e9989ue4 r7d6kgcz rq0escxv nhd2j8a9 nc684nl6 p7hjln8o kvgmc6g5 cxmmr5t8 oygrvhab hcukyx3x jb3vyjys rz4wbd8a qt6c0cv9 a8nywdso i1ao9s8h esuyzwwr f1sip0of lzcic4wl q66pz984 gpro0wi8 b1v8xokw\" tabindex=\"0\" href=\"https://www.facebook.com/hashtag/bongtaytrangcottonpads?__eep__=6&amp;__cft__[0]=AZVy6FyyMCkiIFkXxUlxoZoVtD2OzkRv1aEMeLOdBQbT6qTvVr45Om0Rlnt6U0XcI0Shoj4DiBmVtkcOHcUF8UrJBqMXCVPb4tCNxQP1LA9x8Tc8-ryKQhG24NQFak-H0pYOpkZcGAjiGTpqDln61tcUzQZP5I6m50Xkxz-XSO8R-Q&amp;__tn__=*NK-R\">#bongtaytrangcottonpads</a></span></div>\n</div>\n</div>\n</div>\n</div>\n</div>\n</div>\n<div dir=\"auto\">&nbsp;</div>', 0, '27000', '', '35000', '[{\"image\": \"https://scontent.fvca1-1.fna.fbcdn.net/v/t1.6435-9/252937690_127552566335543_7448853969126590553_n.jpg?_nc_cat=105&ccb=1-5&_nc_sid=8bfeb9&_nc_ohc=e4o3UKNh2b4AX95n9oX&_nc_ht=scontent.fvca1-1.fna&oh=53f8589ee5b098e7edb94e72d12a86a1&oe=61B293BB\"}, {\"image\": \"https://scontent.fvca1-2.fna.fbcdn.net/v/t1.6435-9/247979782_127552496335550_2058696485428625165_n.jpg?_nc_cat=100&ccb=1-5&_nc_sid=8bfeb9&_nc_ohc=0A62wgWX5RwAX8D7USk&_nc_ht=scontent.fvca1-2.fna&oh=6ccc1ff5a6d587911ce73b4178a33683&oe=61B3F83B\"}, {\"image\": \"https://scontent.fvca1-2.fna.fbcdn.net/v/t1.6435-9/254942475_127552536335546_1913486345528641393_n.jpg?_nc_cat=107&ccb=1-5&_nc_sid=8bfeb9&_nc_ohc=zotU6QoRqF0AX93NbVl&_nc_ht=scontent.fvca1-2.fna&oh=572951307d57d748c54c4725a3ba6e73&oe=61B4652D\"}]', 0),
(144, 'Khăn lau mặt 1 lần Animerry', '127554369668696', 999, 0, 999, 22, 18, '<div style=\"text-align: justify;\" dir=\"auto\"><strong><span class=\"pq6dq46d tbxw36s4 knj5qynh kvgmc6g5 ditlmg2l oygrvhab nvdbi5me sf5mxxl7 gl3lb2sf hhz5lgdu\" style=\"font-size: small;\">M&ocirc; tả:</span></strong></div>\n<div style=\"text-align: justify;\" dir=\"auto\"><span class=\"pq6dq46d tbxw36s4 knj5qynh kvgmc6g5 ditlmg2l oygrvhab nvdbi5me sf5mxxl7 gl3lb2sf hhz5lgdu\" style=\"font-size: small;\"><img src=\"https://static.xx.fbcdn.net/images/emoji.php/v9/tdd/1/16/274c.png\" alt=\"❌\" width=\"16\" height=\"16\" /></span><span class=\"pq6dq46d tbxw36s4 knj5qynh kvgmc6g5 ditlmg2l oygrvhab nvdbi5me sf5mxxl7 gl3lb2sf hhz5lgdu\" style=\"font-size: small;\"><img src=\"https://static.xx.fbcdn.net/images/emoji.php/v9/tdd/1/16/274c.png\" alt=\"❌\" width=\"16\" height=\"16\" /></span><span style=\"font-size: small;\"> Xu hướng &ldquo;bỏ khăn mặt vải&rdquo; thay thế bằng khăn 1 lần. </span><span style=\"font-size: small;\">Khăn mặt qu&aacute; nhiều vi khuẩn th&igrave; chuyển sang d&ugrave;ng \" KHĂN LAU MẶT 1 LẦN ANIMERRY \" Chỉ với 4xk l&agrave; đ&atilde; c&oacute; ngay một bịch khăn lau si&ecirc;u to m&agrave; c&ograve;n tr&aacute;nh được việc vi khuẩn t&iacute;ch tụ tr&ecirc;n khăn nh&eacute;. </span><span style=\"font-size: small;\">&nbsp;Gần đ&acirc;y khăn lau mặt d&ugrave;ng 1 lần đang trở th&agrave;nh xu hướng mới với c&aacute;c t&iacute;n đồ l&agrave;m đẹp, loại khăn n&agrave;y đến từ thương hiệu ANIMERRY sang xịn mịn cực kỳ. Ch&uacute;ng m&igrave;nh c&oacute; thể d&ugrave;ng để rửa mặt hoặc thấm kh&ocirc; mặt sau khi rửa, d&ugrave;ng thay b&ocirc;ng tẩy trang. D&ugrave;ng kh&ocirc; hay ướt đều OK nh&eacute;. </span><span style=\"font-size: small;\">&nbsp;Em n&agrave;y được l&agrave;m ho&agrave;n to&agrave;n từ 100% b&ocirc;ng tự nhi&ecirc;n được tuyển chọn gắt gao từ v&ugrave;ng nguy&ecirc;n liệu chuy&ecirc;n biệt (kh&ocirc;ng l&agrave;m từ xơ Vicose như hầu hết c&aacute;c sp kh&aacute;c) n&ecirc;n mềm mại hơn, thấm nước tốt hơn rất nhiều, tự ph&acirc;n hủy được, an to&agrave;n tuyệt đối với da v&agrave; m&ocirc;i trường </span><span style=\"font-size: small;\">Giấy kh&ocirc;ng b&aacute;m bụi kh&ocirc;ng xổ l&ocirc;ng, thấm h&uacute;t si&ecirc;u nhanh </span><span style=\"font-size: small;\">Nếp khăn d&agrave;y hơn, b&ocirc;ng hơn so với khăn thường, tăng 80% khả năng thấm h&uacute;t v&agrave; t&aacute;i sử dụng </span><span style=\"font-size: small;\">Bề mặt massage lồi l&otilde;m với thiết kế đặc biệt, tối ưu khả năng l&agrave;m sạch, giữ lại độ ẩm tr&ecirc;n da.</span></div>\n<div class=\"o9v6fnle cxmmr5t8 oygrvhab hcukyx3x c1et5uql ii04i59q\" style=\"text-align: justify;\">\n<div dir=\"auto\"><span style=\"font-size: small;\">-----------------------------------------------------------</span></div>\n</div>\n<div class=\"o9v6fnle cxmmr5t8 oygrvhab hcukyx3x c1et5uql ii04i59q\">\n<div style=\"text-align: justify;\" dir=\"auto\"><span style=\"font-size: small;\"><a class=\"oajrlxb2 g5ia77u1 qu0x051f esr5mh6w e9989ue4 r7d6kgcz rq0escxv nhd2j8a9 nc684nl6 p7hjln8o kvgmc6g5 cxmmr5t8 oygrvhab hcukyx3x jb3vyjys rz4wbd8a qt6c0cv9 a8nywdso i1ao9s8h esuyzwwr f1sip0of lzcic4wl q66pz984 gpro0wi8 b1v8xokw\" tabindex=\"0\" href=\"https://www.facebook.com/hashtag/kabistorecomvn?__eep__=6&amp;__cft__[0]=AZWOkS8iCiyuDCiwPh8KoWbWrZLEmawV8LeNdVi3vvvmRw_sv7unMxxmtA-EJjoX6KIIWOhbpf7lvlrr5bozK6QQewQJodnwKE1xZFo2n1fP1rUrUnpkwehFJ627OUHVrOuxckY24dkU_WhR7UbnCTSg7_dCusdl4AganHSqL4gCmQ&amp;__tn__=*NK-R\">#kabistorecomvn</a></span></div>\n<div style=\"text-align: justify;\" dir=\"auto\"><span style=\"font-size: small;\"><a class=\"oajrlxb2 g5ia77u1 qu0x051f esr5mh6w e9989ue4 r7d6kgcz rq0escxv nhd2j8a9 nc684nl6 p7hjln8o kvgmc6g5 cxmmr5t8 oygrvhab hcukyx3x jb3vyjys rz4wbd8a qt6c0cv9 a8nywdso i1ao9s8h esuyzwwr f1sip0of lzcic4wl q66pz984 gpro0wi8 b1v8xokw\" tabindex=\"0\" href=\"https://www.facebook.com/hashtag/ilovekabistore?__eep__=6&amp;__cft__[0]=AZWOkS8iCiyuDCiwPh8KoWbWrZLEmawV8LeNdVi3vvvmRw_sv7unMxxmtA-EJjoX6KIIWOhbpf7lvlrr5bozK6QQewQJodnwKE1xZFo2n1fP1rUrUnpkwehFJ627OUHVrOuxckY24dkU_WhR7UbnCTSg7_dCusdl4AganHSqL4gCmQ&amp;__tn__=*NK-R\">#ilovekabistore</a> <a class=\"oajrlxb2 g5ia77u1 qu0x051f esr5mh6w e9989ue4 r7d6kgcz rq0escxv nhd2j8a9 nc684nl6 p7hjln8o kvgmc6g5 cxmmr5t8 oygrvhab hcukyx3x jb3vyjys rz4wbd8a qt6c0cv9 a8nywdso i1ao9s8h esuyzwwr f1sip0of lzcic4wl q66pz984 gpro0wi8 b1v8xokw\" tabindex=\"0\" href=\"https://www.facebook.com/hashtag/kabistoregiasieure?__eep__=6&amp;__cft__[0]=AZWOkS8iCiyuDCiwPh8KoWbWrZLEmawV8LeNdVi3vvvmRw_sv7unMxxmtA-EJjoX6KIIWOhbpf7lvlrr5bozK6QQewQJodnwKE1xZFo2n1fP1rUrUnpkwehFJ627OUHVrOuxckY24dkU_WhR7UbnCTSg7_dCusdl4AganHSqL4gCmQ&amp;__tn__=*NK-R\">#kabistoregiasieure</a></span></div>\n<div style=\"text-align: justify;\" dir=\"auto\"><span style=\"font-size: small;\"><a class=\"oajrlxb2 g5ia77u1 qu0x051f esr5mh6w e9989ue4 r7d6kgcz rq0escxv nhd2j8a9 nc684nl6 p7hjln8o kvgmc6g5 cxmmr5t8 oygrvhab hcukyx3x jb3vyjys rz4wbd8a qt6c0cv9 a8nywdso i1ao9s8h esuyzwwr f1sip0of lzcic4wl q66pz984 gpro0wi8 b1v8xokw\" tabindex=\"0\" href=\"https://www.facebook.com/hashtag/khanlaumatanimerry?__eep__=6&amp;__cft__[0]=AZWOkS8iCiyuDCiwPh8KoWbWrZLEmawV8LeNdVi3vvvmRw_sv7unMxxmtA-EJjoX6KIIWOhbpf7lvlrr5bozK6QQewQJodnwKE1xZFo2n1fP1rUrUnpkwehFJ627OUHVrOuxckY24dkU_WhR7UbnCTSg7_dCusdl4AganHSqL4gCmQ&amp;__tn__=*NK-R\">#khanlaumatanimerry</a></span></div>\n<div style=\"text-align: justify;\" dir=\"auto\"><span style=\"font-size: small;\"><a class=\"oajrlxb2 g5ia77u1 qu0x051f esr5mh6w e9989ue4 r7d6kgcz rq0escxv nhd2j8a9 nc684nl6 p7hjln8o kvgmc6g5 cxmmr5t8 oygrvhab hcukyx3x jb3vyjys rz4wbd8a qt6c0cv9 a8nywdso i1ao9s8h esuyzwwr f1sip0of lzcic4wl q66pz984 gpro0wi8 b1v8xokw\" tabindex=\"0\" href=\"https://www.facebook.com/hashtag/animerry?__eep__=6&amp;__cft__[0]=AZWOkS8iCiyuDCiwPh8KoWbWrZLEmawV8LeNdVi3vvvmRw_sv7unMxxmtA-EJjoX6KIIWOhbpf7lvlrr5bozK6QQewQJodnwKE1xZFo2n1fP1rUrUnpkwehFJ627OUHVrOuxckY24dkU_WhR7UbnCTSg7_dCusdl4AganHSqL4gCmQ&amp;__tn__=*NK-R\">#ANIMERRY</a></span></div>\n</div>', 2, '29000', '0', '39000', '[{\"image\": \"https://scontent.fvca1-3.fna.fbcdn.net/v/t1.6435-9/254019532_127554126335387_7267864244330999684_n.jpg?_nc_cat=103&ccb=1-5&_nc_sid=8bfeb9&_nc_ohc=L-o0EwdBvscAX-qLYxD&tn=3KEBYS8SET_aSR4c&_nc_ht=scontent.fvca1-3.fna&oh=0a0ba4f23fbf84bbc706533c065c00e2&oe=61B2CD88\"}, {\"image\": \"https://scontent.fvca1-1.fna.fbcdn.net/v/t1.6435-9/254437944_127554156335384_8697824479807713001_n.jpg?_nc_cat=102&ccb=1-5&_nc_sid=8bfeb9&_nc_ohc=pjBo5R7ugb8AX_vpIr6&_nc_oc=AQk8WHbgQlx1-V2YUMu6izdphsau9SlJdoa7Q22clRYgVRvu5DngO9DY54LoIfyb7rJjhqTNZwBKHJagNBQfgHKF&_nc_ht=scontent.fvca1-1.fna&oh=d3697833458da5b0ddc081a4e272311b&oe=61B1BAD3\"}, {\"image\": \"https://scontent.fvca1-2.fna.fbcdn.net/v/t1.6435-9/253932702_127554189668714_2655375128099538360_n.jpg?_nc_cat=104&ccb=1-5&_nc_sid=8bfeb9&_nc_ohc=3tKYpx-MLRUAX8NOBtc&_nc_ht=scontent.fvca1-2.fna&oh=877dc0b5da99047fa02a3a11d839d68c&oe=61B1B3BD\"}, {\"image\": \"https://scontent.fvca1-3.fna.fbcdn.net/v/t1.6435-9/253479927_127554219668711_4624833561340842742_n.jpg?_nc_cat=111&ccb=1-5&_nc_sid=8bfeb9&_nc_ohc=ULODcF3i778AX_a5BBD&tn=3KEBYS8SET_aSR4c&_nc_ht=scontent.fvca1-3.fna&oh=7139229677e479ef433c87c829fe847a&oe=61B46439\"}]', 0),
(145, 'Máy duỗi tóc hình thú mini', '127555463001920', 999, 5, 999, 139, 18, '<div dir=\"auto\"><span style=\"font-size: small;\"><strong>M&ocirc; tả:</strong></span><br /><span style=\"font-size: small;\"><img src=\"https://static.xx.fbcdn.net/images/emoji.php/v9/t14/1/16/2618.png\" alt=\"☘\" width=\"16\" height=\"16\" />&nbsp; Với thiết kế nhỏ gọn, si&ecirc;u tiện lợi gi&uacute;p c&aacute;c n&agrave;ng c&oacute; thể dễ d&agrave;ng bỏ vừa t&uacute;i trang điểm, t&uacute;i x&aacute;ch, balo, đ&aacute;p ứng nhu cầu l&agrave;m đẹp cho m&aacute;i t&oacute;c mọi l&uacute;c mọi nơi</span></div>\n<div dir=\"auto\"><span style=\"font-size: small;\"><img src=\"https://static.xx.fbcdn.net/images/emoji.php/v9/t14/1/16/2618.png\" alt=\"☘\" width=\"16\" height=\"16\" /><span>&nbsp;&nbsp;</span>M&aacute;y c&oacute; nhiệt độ n&oacute;ng vừa phải, đủ để c&aacute;c sợi t&oacute;c ngoan ngo&atilde;n gi&uacute;p bạn dễ d&agrave;ng tạo kiểu m&agrave; vẫn đảm bảo t&oacute;c lu&ocirc;n khỏe mạnh, kh&ocirc;ng sợ bị kh&ocirc; xơ hay g&atilde;y rụng.</span></div>\n<div dir=\"auto\"><span style=\"font-size: small;\"><img src=\"https://static.xx.fbcdn.net/images/emoji.php/v9/t14/1/16/2618.png\" alt=\"☘\" width=\"16\" height=\"16\" /><span>&nbsp;&nbsp;</span>Thiết kế bằng chất liệu chắc chắn, tay cầm vừa vặn lại được trang bị lớp c&aacute;ch nhiệt an to&agrave;n, chẳng sợ bị bỏng tay. Ngo&agrave;i ra, em ấy c&ograve;n c&oacute; n&uacute;t bật tắt v&agrave; n&uacute;t kh&oacute;a/mở gi&uacute;p bạn dễ d&agrave;ng điều chỉnh mỗi khi sử dụng.</span></div>\n<div dir=\"auto\"><span style=\"font-size: small;\"><img src=\"https://static.xx.fbcdn.net/images/emoji.php/v9/t14/1/16/2618.png\" alt=\"☘\" width=\"16\" height=\"16\" /><span>&nbsp;&nbsp;</span>Phần d&acirc;y điện của sản phẩm được thiết kế c&oacute; khả năng xoay 360 độ dễ d&agrave;ng cho việc chải, xoay m&agrave; kh&ocirc;ng l&agrave;m ảnh hưởng đến chất lượng đầu d&acirc;y sau một thời gian sử dụng. Sản phẩm bao b&igrave; hộp nhựa</span></div>\n<div>\n<div dir=\"auto\">-----------------------------------------</div>\n<div class=\"o9v6fnle cxmmr5t8 oygrvhab hcukyx3x c1et5uql ii04i59q\">\n<div dir=\"auto\"><span><a class=\"oajrlxb2 g5ia77u1 qu0x051f esr5mh6w e9989ue4 r7d6kgcz rq0escxv nhd2j8a9 nc684nl6 p7hjln8o kvgmc6g5 cxmmr5t8 oygrvhab hcukyx3x jb3vyjys rz4wbd8a qt6c0cv9 a8nywdso i1ao9s8h esuyzwwr f1sip0of lzcic4wl q66pz984 gpro0wi8 b1v8xokw\" tabindex=\"0\" href=\"https://www.facebook.com/hashtag/kabistorecomvn?__eep__=6&amp;__cft__[0]=AZW2IAjapmAlA4vZlsJ5UFQ7Y1R3Gs1z0R4o1o5enys-B39A7TgR9BMtuqhYElgZekLYZoWmpBL-mbLVV8cOHI2DvACIiOBXvbbWFmOcIoBbeJ9FROQLuKGjaq1DDDDMI1dFayTTlZaCIMvv7ZmgdpDpmudmoc7RG4g6tzzxsy-cbQ&amp;__tn__=*NK-R\">#kabistorecomvn</a></span></div>\n<div dir=\"auto\"><span><a class=\"oajrlxb2 g5ia77u1 qu0x051f esr5mh6w e9989ue4 r7d6kgcz rq0escxv nhd2j8a9 nc684nl6 p7hjln8o kvgmc6g5 cxmmr5t8 oygrvhab hcukyx3x jb3vyjys rz4wbd8a qt6c0cv9 a8nywdso i1ao9s8h esuyzwwr f1sip0of lzcic4wl q66pz984 gpro0wi8 b1v8xokw\" tabindex=\"0\" href=\"https://www.facebook.com/hashtag/ilovekabistore?__eep__=6&amp;__cft__[0]=AZW2IAjapmAlA4vZlsJ5UFQ7Y1R3Gs1z0R4o1o5enys-B39A7TgR9BMtuqhYElgZekLYZoWmpBL-mbLVV8cOHI2DvACIiOBXvbbWFmOcIoBbeJ9FROQLuKGjaq1DDDDMI1dFayTTlZaCIMvv7ZmgdpDpmudmoc7RG4g6tzzxsy-cbQ&amp;__tn__=*NK-R\">#ilovekabistore</a></span> <span><a class=\"oajrlxb2 g5ia77u1 qu0x051f esr5mh6w e9989ue4 r7d6kgcz rq0escxv nhd2j8a9 nc684nl6 p7hjln8o kvgmc6g5 cxmmr5t8 oygrvhab hcukyx3x jb3vyjys rz4wbd8a qt6c0cv9 a8nywdso i1ao9s8h esuyzwwr f1sip0of lzcic4wl q66pz984 gpro0wi8 b1v8xokw\" tabindex=\"0\" href=\"https://www.facebook.com/hashtag/kabistoregiasieure?__eep__=6&amp;__cft__[0]=AZW2IAjapmAlA4vZlsJ5UFQ7Y1R3Gs1z0R4o1o5enys-B39A7TgR9BMtuqhYElgZekLYZoWmpBL-mbLVV8cOHI2DvACIiOBXvbbWFmOcIoBbeJ9FROQLuKGjaq1DDDDMI1dFayTTlZaCIMvv7ZmgdpDpmudmoc7RG4g6tzzxsy-cbQ&amp;__tn__=*NK-R\">#kabistoregiasieure</a></span></div>\n<div dir=\"auto\"><span><a class=\"oajrlxb2 g5ia77u1 qu0x051f esr5mh6w e9989ue4 r7d6kgcz rq0escxv nhd2j8a9 nc684nl6 p7hjln8o kvgmc6g5 cxmmr5t8 oygrvhab hcukyx3x jb3vyjys rz4wbd8a qt6c0cv9 a8nywdso i1ao9s8h esuyzwwr f1sip0of lzcic4wl q66pz984 gpro0wi8 b1v8xokw\" tabindex=\"0\" href=\"https://www.facebook.com/hashtag/mayduoitochinhthumini?__eep__=6&amp;__cft__[0]=AZW2IAjapmAlA4vZlsJ5UFQ7Y1R3Gs1z0R4o1o5enys-B39A7TgR9BMtuqhYElgZekLYZoWmpBL-mbLVV8cOHI2DvACIiOBXvbbWFmOcIoBbeJ9FROQLuKGjaq1DDDDMI1dFayTTlZaCIMvv7ZmgdpDpmudmoc7RG4g6tzzxsy-cbQ&amp;__tn__=*NK-R\">#mayduoitochinhthumini</a></span></div>\n</div>\n</div>', 1, '35000', '0', '45000', '[{\"image\": \"https://scontent.fvca1-2.fna.fbcdn.net/v/t39.30808-6/241370172_127555399668593_5671069732069301571_n.jpg?_nc_cat=107&ccb=1-5&_nc_sid=8bfeb9&_nc_ohc=iDZqBGjYKW0AX9FEHZ8&_nc_ht=scontent.fvca1-2.fna&oh=643cf22deb44ed265462fea5a831984c&oe=61951518\"}, {\"image\": \"https://scontent.fvca1-4.fna.fbcdn.net/v/t39.30808-6/247939207_127555429668590_7308874721964941664_n.jpg?_nc_cat=101&ccb=1-5&_nc_sid=8bfeb9&_nc_ohc=Yq778l-N5hQAX87i5S_&_nc_oc=AQmQZ6aGsEITgmERV7Lrz4r1CBc5zdJ3EJiueTdJjElarkkm5JfwNdJC53Ij0w41AITfotRWW-0Cwa-tTmbQhcV9&_nc_ht=scontent.fvca1-4.fna&oh=a77ce0c410d0a674c4075f1d7e9d848c&oe=61950E00\"}]', 0);
INSERT INTO `tbl_product` (`productId`, `productName`, `product_code`, `productQuantity`, `product_soldout`, `product_remain`, `catId`, `brandId`, `product_desc`, `type`, `root_price`, `old_price`, `price`, `image`, `size`) VALUES
(146, 'Xịt thơm miệng hương đào bạc hà heyxi thơm mát quyến rũ', '127560933001373', 999, 1, 999, 139, 18, '<div dir=\"auto\"><span style=\"font-size: small;\"><strong>M&ocirc; tả:</strong></span></div>\n<div dir=\"auto\"><span style=\"font-size: small;\">Gi&aacute; xem tr&ecirc;n website: đang cập nhật</span></div>\n<div dir=\"auto\"><span style=\"font-size: small;\">- Hanayuki Asia Điểm nội bật sản phẩm: <span class=\"pq6dq46d tbxw36s4 knj5qynh kvgmc6g5 ditlmg2l oygrvhab nvdbi5me sf5mxxl7 gl3lb2sf hhz5lgdu\"><img src=\"https://static.xx.fbcdn.net/images/emoji.php/v9/t14/1/16/2618.png\" alt=\"☘\" width=\"16\" height=\"16\" /></span> Chỉ v&agrave;i lần xịt những m&ugrave;i h&ocirc;i của thức ăn, thức uống, t&igrave;nh trạng h&ocirc;i miệng g&acirc;y ra ho&agrave;n to&agrave;n biến mất, cho hơi thở thơm m&aacute;t đến 2h để bạn tự tin trong giao tiếp. <span class=\"pq6dq46d tbxw36s4 knj5qynh kvgmc6g5 ditlmg2l oygrvhab nvdbi5me sf5mxxl7 gl3lb2sf hhz5lgdu\"><img src=\"https://static.xx.fbcdn.net/images/emoji.php/v9/t14/1/16/2618.png\" alt=\"☘\" width=\"16\" height=\"16\" /></span> Xịt thơm miệng được chiết xuất từ c&aacute;c thảo dược thi&ecirc;n nhi&ecirc;n, kh&ocirc;ng c&oacute; đường, kh&ocirc;ng cồn (Alcohol), c&oacute; thể d&ugrave;ng hơn 130 lần v&agrave; th&ecirc;m chức năng kh&aacute;ng khuẩn, an to&agrave;n khi nuốt. <span class=\"pq6dq46d tbxw36s4 knj5qynh kvgmc6g5 ditlmg2l oygrvhab nvdbi5me sf5mxxl7 gl3lb2sf hhz5lgdu\"><img src=\"https://static.xx.fbcdn.net/images/emoji.php/v9/t14/1/16/2618.png\" alt=\"☘\" width=\"16\" height=\"16\" /></span> Thiết kế nhỏ gọn tiện lợi, c&oacute; thể mang theo b&ecirc;n m&igrave;nh d&ugrave;ng bất cứ khi n&agrave;o cần. Bạn c&oacute; thể mang theo khi đi tr&ecirc;n m&aacute;y bay, đủ ti&ecirc;u chuẩn theo qui định h&agrave;ng kh&ocirc;ng. <span class=\"pq6dq46d tbxw36s4 knj5qynh kvgmc6g5 ditlmg2l oygrvhab nvdbi5me sf5mxxl7 gl3lb2sf hhz5lgdu\"><img src=\"https://static.xx.fbcdn.net/images/emoji.php/v9/t14/1/16/2618.png\" alt=\"☘\" width=\"16\" height=\"16\" /></span> Sản phẩm n&agrave;y kh&ocirc;ng được d&ugrave;ng để thay thế cho kem đ&aacute;nh răng v&agrave; nước s&uacute;c miệng. Bạn n&ecirc;n kết hợp cả đ&aacute;nh răng, s&uacute;c miệng, xịt miệng để đảm bảo sức khỏe răng miệng, gi&uacute;p hơi thở thơm m&aacute;t suốt cả ng&agrave;y d&agrave;i để bạn tự tin hơn trong giao tiếp. <span class=\"pq6dq46d tbxw36s4 knj5qynh kvgmc6g5 ditlmg2l oygrvhab nvdbi5me sf5mxxl7 gl3lb2sf hhz5lgdu\"><img src=\"https://static.xx.fbcdn.net/images/emoji.php/v9/t14/1/16/2618.png\" alt=\"☘\" width=\"16\" height=\"16\" /></span> Sản phẩm n&agrave;y kh&ocirc;ng được d&ugrave;ng để thay thế cho kem đ&aacute;nh răng v&agrave; nước s&uacute;c miệng. Bạn n&ecirc;n kết hợp cả đ&aacute;nh răng, s&uacute;c miệng, xịt miệng để đảm bảo sức khỏe răng miệng, gi&uacute;p hơi thở thơm m&aacute;t suốt cả ng&agrave;y d&agrave;i để bạn tự tin hơn trong giao tiếp.</span></div>\n<div dir=\"auto\"><span style=\"font-size: small;\"><img src=\"https://static.xx.fbcdn.net/images/emoji.php/v9/t14/1/16/2618.png\" alt=\"☘\" width=\"16\" height=\"16\" />&nbsp;Th&agrave;nh phần: - Aqua, Glycerin, PEG 40 Hydrogenated Castor oil, Aroma, Menthol, Citric Acid, Cetyl pyridinium Chloride, Sodium Benzoate, Sodium Saccharin.</span></div>\n<div dir=\"auto\"><span style=\"font-size: small;\"><img src=\"https://static.xx.fbcdn.net/images/emoji.php/v9/t14/1/16/2618.png\" alt=\"☘\" width=\"16\" height=\"16\" />&nbsp;Ai n&ecirc;n sử dụng:</span></div>\n<div dir=\"auto\"><span style=\"font-size: small;\">- Người hay phải giao tiếp, người kh&ocirc;ng tự tin về hơi thở</span></div>\n<div dir=\"auto\"><span style=\"font-size: small;\">- Người bị h&ocirc;i miệng v&agrave; muốn chăm s&oacute;c hơi thở tự tin.</span></div>\n<div dir=\"auto\"><span style=\"font-size: small;\"><img src=\"https://static.xx.fbcdn.net/images/emoji.php/v9/t14/1/16/2618.png\" alt=\"☘\" width=\"16\" height=\"16\" />&nbsp;C&ocirc;ng dụng: - Xịt thơm miệng tức th&igrave;, gi&uacute;p ngăn ngừa sự ph&aacute;t triển của vi khuẩn, giảm h&ocirc;i miệng, cho hơi thở thơm m&aacute;t.</span></div>\n<div dir=\"auto\"><span style=\"font-size: small;\"><img src=\"https://static.xx.fbcdn.net/images/emoji.php/v9/t14/1/16/2618.png\" alt=\"☘\" width=\"16\" height=\"16\" />&nbsp;C&aacute;ch d&ugrave;ng:</span></div>\n<div dir=\"auto\"><span style=\"font-size: small;\">-Mở nắp, xịt trực tiếp v&agrave;o miệng 1-2 lần. An to&agrave;n khi nuốt.</span></div>\n<div dir=\"auto\"><span style=\"font-size: small;\">-Xịt trực tiếp v&agrave;o 2 b&ecirc;n khoang miệng. Mỗi b&ecirc;n 1 &ndash; 2 nh&aacute;t xịt hoặc nhiều hơn theo nhu cầu. Sử dụng sau khi ăn uống hoặc trước khi tiếp x&uacute;c, n&oacute;i chuyện, h&ocirc;n&hellip;để l&agrave;m thơm miệng.</span></div>\n<div dir=\"auto\"><span style=\"font-size: small;\"><img src=\"https://static.xx.fbcdn.net/images/emoji.php/v9/t14/1/16/2618.png\" alt=\"☘\" width=\"16\" height=\"16\" />&nbsp;Bảo quản:</span></div>\n<div dir=\"auto\"><span style=\"font-size: small;\">- Sản phẩm được bảo quản nơi kh&ocirc; r&aacute;o, sạch sẽ, kh&ocirc;ng nhiễm bụi bẩn, tr&aacute;nh va chạm.</span></div>\n<div dir=\"auto\"><span style=\"font-size: small;\">- Bảo quản ở nhiệt độ b&igrave;nh thường.</span></div>\n<div dir=\"auto\">\n<div dir=\"auto\">--------------------------------------------</div>\n<div class=\"o9v6fnle cxmmr5t8 oygrvhab hcukyx3x c1et5uql ii04i59q\">\n<div dir=\"auto\"><span><a class=\"oajrlxb2 g5ia77u1 qu0x051f esr5mh6w e9989ue4 r7d6kgcz rq0escxv nhd2j8a9 nc684nl6 p7hjln8o kvgmc6g5 cxmmr5t8 oygrvhab hcukyx3x jb3vyjys rz4wbd8a qt6c0cv9 a8nywdso i1ao9s8h esuyzwwr f1sip0of lzcic4wl q66pz984 gpro0wi8 b1v8xokw\" tabindex=\"0\" href=\"https://www.facebook.com/hashtag/kabistorecomvn?__eep__=6&amp;__cft__[0]=AZUZSMRUJUA9GQeQ4rWJRsyrt0zaGwi1RhcwOGDPlo4QcJ7PM2bzaN_LqwhIrVVTMszp5cTHPf_NB9SfsT5n56UKBJEOMkG25ChgxaBZ-mA0xJzkqhhX-eDGqjfi5Le5WwAAJBkFcTy5GzVddi489NfZb0inI3L09MLyzjcFzdKa2A&amp;__tn__=*NK-R\">#kabistorecomvn</a></span></div>\n<div dir=\"auto\"><span><a class=\"oajrlxb2 g5ia77u1 qu0x051f esr5mh6w e9989ue4 r7d6kgcz rq0escxv nhd2j8a9 nc684nl6 p7hjln8o kvgmc6g5 cxmmr5t8 oygrvhab hcukyx3x jb3vyjys rz4wbd8a qt6c0cv9 a8nywdso i1ao9s8h esuyzwwr f1sip0of lzcic4wl q66pz984 gpro0wi8 b1v8xokw\" tabindex=\"0\" href=\"https://www.facebook.com/hashtag/ilovekabistore?__eep__=6&amp;__cft__[0]=AZUZSMRUJUA9GQeQ4rWJRsyrt0zaGwi1RhcwOGDPlo4QcJ7PM2bzaN_LqwhIrVVTMszp5cTHPf_NB9SfsT5n56UKBJEOMkG25ChgxaBZ-mA0xJzkqhhX-eDGqjfi5Le5WwAAJBkFcTy5GzVddi489NfZb0inI3L09MLyzjcFzdKa2A&amp;__tn__=*NK-R\">#ilovekabistore</a></span> <span><a class=\"oajrlxb2 g5ia77u1 qu0x051f esr5mh6w e9989ue4 r7d6kgcz rq0escxv nhd2j8a9 nc684nl6 p7hjln8o kvgmc6g5 cxmmr5t8 oygrvhab hcukyx3x jb3vyjys rz4wbd8a qt6c0cv9 a8nywdso i1ao9s8h esuyzwwr f1sip0of lzcic4wl q66pz984 gpro0wi8 b1v8xokw\" tabindex=\"0\" href=\"https://www.facebook.com/hashtag/kabistoregiasieure?__eep__=6&amp;__cft__[0]=AZUZSMRUJUA9GQeQ4rWJRsyrt0zaGwi1RhcwOGDPlo4QcJ7PM2bzaN_LqwhIrVVTMszp5cTHPf_NB9SfsT5n56UKBJEOMkG25ChgxaBZ-mA0xJzkqhhX-eDGqjfi5Le5WwAAJBkFcTy5GzVddi489NfZb0inI3L09MLyzjcFzdKa2A&amp;__tn__=*NK-R\">#kabistoregiasieure</a></span> <span><a class=\"oajrlxb2 g5ia77u1 qu0x051f esr5mh6w e9989ue4 r7d6kgcz rq0escxv nhd2j8a9 nc684nl6 p7hjln8o kvgmc6g5 cxmmr5t8 oygrvhab hcukyx3x jb3vyjys rz4wbd8a qt6c0cv9 a8nywdso i1ao9s8h esuyzwwr f1sip0of lzcic4wl q66pz984 gpro0wi8 b1v8xokw\" tabindex=\"0\" href=\"https://www.facebook.com/hashtag/xitthommiengheyxi?__eep__=6&amp;__cft__[0]=AZUZSMRUJUA9GQeQ4rWJRsyrt0zaGwi1RhcwOGDPlo4QcJ7PM2bzaN_LqwhIrVVTMszp5cTHPf_NB9SfsT5n56UKBJEOMkG25ChgxaBZ-mA0xJzkqhhX-eDGqjfi5Le5WwAAJBkFcTy5GzVddi489NfZb0inI3L09MLyzjcFzdKa2A&amp;__tn__=*NK-R\">#xitthommiengheyxi</a></span></div>\n</div>\n</div>', 2, '16000', '0', '25000', '[{\"image\": \"https://scontent.fvca1-2.fna.fbcdn.net/v/t39.30808-6/247959525_127560759668057_2525208425421206195_n.jpg?_nc_cat=104&ccb=1-5&_nc_sid=8bfeb9&_nc_ohc=2heRjlJUR8kAX8AP5xM&_nc_ht=scontent.fvca1-2.fna&oh=cf46bf48d408c1d2798f92f83e96095f&oe=61956455\"}, {\"image\": \"https://scontent.fvca1-4.fna.fbcdn.net/v/t39.30808-6/248002255_127560796334720_8480737259929281509_n.jpg?_nc_cat=101&ccb=1-5&_nc_sid=8bfeb9&_nc_ohc=tbNeSB1S3dEAX8QWgGY&_nc_ht=scontent.fvca1-4.fna&oh=21ef144018930bfcbfa6820331f81836&oe=61965806\"}, {\"image\": \"https://scontent.fvca1-2.fna.fbcdn.net/v/t39.30808-6/254317391_127560829668050_2393443056681998495_n.jpg?_nc_cat=104&ccb=1-5&_nc_sid=8bfeb9&_nc_ohc=pnjrjR9oiH4AX8xjKEr&tn=3KEBYS8SET_aSR4c&_nc_ht=scontent.fvca1-2.fna&oh=433c36a2a6dfafd620cdc8065fedaf9b&oe=6196905D\"}, {\"image\": \"https://scontent.fvca1-1.fna.fbcdn.net/v/t39.30808-6/242430351_127560866334713_163652151183398301_n.jpg?_nc_cat=102&ccb=1-5&_nc_sid=8bfeb9&_nc_ohc=t8fsts-QGZEAX-eg83z&_nc_ht=scontent.fvca1-1.fna&oh=ee150f16c5e10f22662b0fc55c4484da&oe=61954CBF\"}]', 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_promotions`
--

CREATE TABLE `tbl_promotions` (
  `promotionsId` int(11) NOT NULL,
  `promotionsCode` varchar(10) NOT NULL,
  `promotionsName` varchar(30) NOT NULL,
  `description` varchar(100) NOT NULL,
  `condition` varchar(15) NOT NULL,
  `discountMoney` varchar(15) NOT NULL,
  `style` int(1) NOT NULL DEFAULT '1',
  `creation_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `start_date` datetime NOT NULL,
  `end_date` datetime NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `tbl_promotions`
--

INSERT INTO `tbl_promotions` (`promotionsId`, `promotionsCode`, `promotionsName`, `description`, `condition`, `discountMoney`, `style`, `creation_date`, `start_date`, `end_date`, `status`) VALUES
(1, 'tanhoang', 'Khuyến mãi khai trương', '<p>Mừng ng&agrave;y khai trương khuyến m&atilde;i 20.000đ cho đơn tối thiểu 40.000đ ok</p>', '50000', '5000', 1, '2021-11-04 09:13:33', '2021-08-25 13:01:00', '2021-10-31 13:26:00', 1),
(15, 'navy', 'fdfsfd', 'sdf', '10000', '30000', 2, '2021-11-04 09:13:35', '2021-11-28 12:52:00', '2021-11-19 12:52:00', 1),
(16, 'navy', 'f', 'sdf', '10000', '30000', 3, '2021-11-04 09:13:36', '2021-11-27 22:52:15', '2021-11-18 22:52:15', 1),
(17, 'navy', 'f', 'sdf', '10000', '30000', 4, '2021-11-04 09:13:39', '2021-11-27 22:52:15', '2021-11-18 22:52:15', 1),
(18, 'navy', 'f', 'sdf', '10000', '30000', 5, '2021-11-04 09:13:41', '2021-11-27 22:52:15', '2021-11-18 22:52:15', 1),
(19, 'navy', 'f', 'sdf', '10000', '30000', 6, '2021-11-04 09:22:17', '2021-11-27 22:52:15', '2021-11-18 22:52:15', 1),
(20, 'navy', 'f', 'sdf', '10000', '30000', 5, '2021-11-04 09:17:27', '2021-11-27 22:52:15', '2021-11-18 22:52:15', 0),
(21, 'navy', 'f', 'sdf', '10000', '30000', 1, '2021-11-04 09:17:25', '2021-11-27 22:52:15', '2021-11-18 22:52:15', 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_slider`
--

CREATE TABLE `tbl_slider` (
  `sliderId` int(11) NOT NULL,
  `sliderTitle` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sliderContent` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sliderLink` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `slider_image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `type` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_slider`
--

INSERT INTO `tbl_slider` (`sliderId`, `sliderTitle`, `sliderContent`, `sliderLink`, `slider_image`, `type`) VALUES
(22, 'Hãy ở nhà', 'Ở nhà an toàn với kabi Store', 'san-pham-f0p1t0smem.html', 'af1c35fd6c.jpg', 0),
(23, NULL, 's2', NULL, '430e4023a8.jpg', 0),
(24, NULL, 's3', NULL, '3a713fcd56.jpg', 0),
(25, NULL, 's4', NULL, '99457b8c38.jpg', 0),
(34, 'Khuyến mãi', '', '', '6d33f7ae44.jpg', 1),
(38, 'Khuyến mãi', 'Giảm tới 30%', 'san-pham-f2p1t0s0e500000.html', '67abc42107.jpg', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_warehouse`
--

CREATE TABLE `tbl_warehouse` (
  `id_warehouse` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `inport_quantity` int(11) NOT NULL,
  `inport_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `tbl_warehouse`
--

INSERT INTO `tbl_warehouse` (`id_warehouse`, `product_id`, `inport_quantity`, `inport_date`) VALUES
(8, 122, 150, '2021-02-23 01:40:19'),
(9, 117, 300, '2021-02-23 03:45:34'),
(10, 118, 10, '2021-02-23 03:45:43'),
(11, 122, 100, '2021-02-23 03:45:59'),
(12, 124, 100, '2021-10-19 15:44:42'),
(13, 129, 100, '2021-10-24 09:36:20'),
(14, 129, 100, '2021-10-24 09:36:57'),
(15, 129, 100, '2021-10-24 09:37:19'),
(16, 129, 100, '2021-10-24 09:37:35'),
(17, 129, 102, '2021-10-24 09:39:22'),
(18, 129, 1003, '2021-10-24 09:43:45'),
(19, 129, 11, '2021-10-24 09:44:11'),
(20, 129, 123, '2021-10-24 09:47:44'),
(21, 129, 2, '2021-10-24 09:48:22'),
(22, 129, 222, '2021-10-24 09:50:15'),
(23, 129, 34, '2021-10-24 09:52:44'),
(24, 129, 223, '2021-10-24 09:53:57'),
(25, 129, 333, '2021-10-24 09:58:48'),
(26, 129, 66, '2021-10-24 15:41:47'),
(27, 129, 15, '2021-10-24 15:42:07'),
(28, 129, 14, '2021-10-24 15:42:33'),
(29, 129, 1, '2021-10-24 15:43:10'),
(30, 129, 1, '2021-10-24 15:43:25'),
(31, 129, 1, '2021-10-24 15:43:35'),
(32, 129, 22, '2021-10-24 15:49:59'),
(33, 129, 22, '2021-10-24 15:51:15'),
(34, 129, 11, '2021-10-24 15:51:51'),
(35, 129, 11, '2021-10-24 15:53:08'),
(36, 129, 22, '2021-10-24 15:53:19'),
(37, 129, 23, '2021-10-24 16:06:25'),
(38, 129, 1, '2021-10-24 16:06:33'),
(39, 129, 11, '2021-10-25 01:27:04'),
(40, 129, 1, '2021-10-25 01:27:11'),
(41, 129, 11, '2021-10-25 08:21:42'),
(42, 129, 11, '2021-10-25 09:19:01');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_wishlist`
--

CREATE TABLE `tbl_wishlist` (
  `wishlistId` int(11) NOT NULL,
  `productId` int(11) NOT NULL,
  `customerId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_wishlist`
--

INSERT INTO `tbl_wishlist` (`wishlistId`, `productId`, `customerId`) VALUES
(1051, 140, 6);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `tbl_address`
--
ALTER TABLE `tbl_address`
  ADD PRIMARY KEY (`address_id`),
  ADD KEY `fk_tbl_address_customer` (`customer_id`);

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
  ADD PRIMARY KEY (`cartId`),
  ADD KEY `fk_tbl_cart_customerId` (`customerId`),
  ADD KEY `fk_tbl_cart_productId` (`productId`);

--
-- Chỉ mục cho bảng `tbl_category`
--
ALTER TABLE `tbl_category`
  ADD PRIMARY KEY (`catId`);

--
-- Chỉ mục cho bảng `tbl_customer`
--
ALTER TABLE `tbl_customer`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `tbl_music`
--
ALTER TABLE `tbl_music`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `tbl_order`
--
ALTER TABLE `tbl_order`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_tbl_order:productId_idx` (`productId`),
  ADD KEY `fk_tbl_order:customerId_idx` (`customer_id`),
  ADD KEY `fk_tbl_order_addressId` (`address_id`);

--
-- Chỉ mục cho bảng `tbl_priceshipping`
--
ALTER TABLE `tbl_priceshipping`
  ADD PRIMARY KEY (`priceshippingId`);

--
-- Chỉ mục cho bảng `tbl_product`
--
ALTER TABLE `tbl_product`
  ADD PRIMARY KEY (`productId`),
  ADD KEY `fk_tbl_product:catId_idx` (`catId`);

--
-- Chỉ mục cho bảng `tbl_promotions`
--
ALTER TABLE `tbl_promotions`
  ADD PRIMARY KEY (`promotionsId`);

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
  ADD PRIMARY KEY (`wishlistId`),
  ADD KEY `fk_tbl_cart:productId_idx` (`productId`),
  ADD KEY `fk_tbl_cart:cútomerId_idx` (`customerId`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `tbl_address`
--
ALTER TABLE `tbl_address`
  MODIFY `address_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=561;

--
-- AUTO_INCREMENT cho bảng `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `adminId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `tbl_brand`
--
ALTER TABLE `tbl_brand`
  MODIFY `brandId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT cho bảng `tbl_cart`
--
ALTER TABLE `tbl_cart`
  MODIFY `cartId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1152;

--
-- AUTO_INCREMENT cho bảng `tbl_category`
--
ALTER TABLE `tbl_category`
  MODIFY `catId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=140;

--
-- AUTO_INCREMENT cho bảng `tbl_customer`
--
ALTER TABLE `tbl_customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT cho bảng `tbl_music`
--
ALTER TABLE `tbl_music`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT cho bảng `tbl_order`
--
ALTER TABLE `tbl_order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1245;

--
-- AUTO_INCREMENT cho bảng `tbl_priceshipping`
--
ALTER TABLE `tbl_priceshipping`
  MODIFY `priceshippingId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `tbl_product`
--
ALTER TABLE `tbl_product`
  MODIFY `productId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=147;

--
-- AUTO_INCREMENT cho bảng `tbl_promotions`
--
ALTER TABLE `tbl_promotions`
  MODIFY `promotionsId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT cho bảng `tbl_slider`
--
ALTER TABLE `tbl_slider`
  MODIFY `sliderId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT cho bảng `tbl_warehouse`
--
ALTER TABLE `tbl_warehouse`
  MODIFY `id_warehouse` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT cho bảng `tbl_wishlist`
--
ALTER TABLE `tbl_wishlist`
  MODIFY `wishlistId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1052;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `tbl_address`
--
ALTER TABLE `tbl_address`
  ADD CONSTRAINT `fk_tbl_address_customer` FOREIGN KEY (`customer_id`) REFERENCES `tbl_customer` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `tbl_cart`
--
ALTER TABLE `tbl_cart`
  ADD CONSTRAINT `fk_tbl_cart_productId` FOREIGN KEY (`productId`) REFERENCES `tbl_product` (`productId`);

--
-- Các ràng buộc cho bảng `tbl_order`
--
ALTER TABLE `tbl_order`
  ADD CONSTRAINT `fk_tbl_order_addressId` FOREIGN KEY (`address_id`) REFERENCES `tbl_address` (`address_id`),
  ADD CONSTRAINT `fk_tbl_order_customerId` FOREIGN KEY (`customer_id`) REFERENCES `tbl_customer` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tbl_order_productId` FOREIGN KEY (`productId`) REFERENCES `tbl_product` (`productId`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Các ràng buộc cho bảng `tbl_product`
--
ALTER TABLE `tbl_product`
  ADD CONSTRAINT `fk_tbl_product_catId` FOREIGN KEY (`catId`) REFERENCES `tbl_category` (`catId`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Các ràng buộc cho bảng `tbl_wishlist`
--
ALTER TABLE `tbl_wishlist`
  ADD CONSTRAINT `tbl_wishlist_ibfk_1` FOREIGN KEY (`customerId`) REFERENCES `tbl_customer` (`id`),
  ADD CONSTRAINT `tbl_wishlist_ibfk_2` FOREIGN KEY (`productId`) REFERENCES `tbl_product` (`productId`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
