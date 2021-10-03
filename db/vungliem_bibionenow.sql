-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th8 25, 2021 lúc 01:32 PM
-- Phiên bản máy phục vụ: 10.4.19-MariaDB
-- Phiên bản PHP: 7.4.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `vungliem_bibionenow`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_address`
--

CREATE TABLE `tbl_address` (
  `address_id` int(11) NOT NULL,
  `maps_maplat` varchar(18) NOT NULL,
  `maps_maplng` varchar(18) NOT NULL,
  `geocoder` varchar(100) NOT NULL,
  `note_address` varchar(100) NOT NULL,
  `date_create` datetime NOT NULL,
  `customer_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `tbl_address`
--

INSERT INTO `tbl_address` (`address_id`, `maps_maplat`, `maps_maplng`, `geocoder`, `note_address`, `date_create`, `customer_id`) VALUES
(317, '10.029249667451964', '105.75940770617717', '', '', '2021-08-25 17:37:09', 6),
(318, '10.028799372182476', '105.76069381408934', '', '', '2021-08-25 18:20:14', 6),
(319, '10.027167045658388', '105.76125112751674', '', '', '2021-08-25 18:23:03', 6),
(320, '10.029784392401396', '105.75992214934251', '', '', '2021-08-25 18:26:55', 6);

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
(18, '4KFarm'),
(19, 'TMTC'),
(20, 'Kio Tobi'),
(21, 'Kabifood'),
(22, 'Taiwan Lattea'),
(24, 'Hevi Voo');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_cart`
--

CREATE TABLE `tbl_cart` (
  `cartId` int(11) NOT NULL,
  `customerId` int(11) NOT NULL,
  `productId` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `tbl_cart`
--

INSERT INTO `tbl_cart` (`cartId`, `customerId`, `productId`, `quantity`) VALUES
(4, 10, 108, 1),
(5, 10, 108, 1),
(143, 6, 102, 3),
(145, 6, 108, 2);

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
(19, 'Thức uống'),
(20, 'Bánh kẹo'),
(21, 'Đồ đông lạnh'),
(22, 'Chăm sóc cá nhân'),
(23, 'Rau - Thịt');

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
  `email` varchar(255) CHARACTER SET utf8 NOT NULL,
  `maps_maplat` varchar(18) COLLATE utf8_unicode_ci NOT NULL,
  `maps_maplng` varchar(18) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `date_Joined` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_customer`
--

INSERT INTO `tbl_customer` (`id`, `username`, `name`, `avatar`, `date_of_birth`, `gender`, `phone`, `email`, `maps_maplat`, `maps_maplng`, `password`, `date_Joined`) VALUES
(6, 'sontanhoang', 'Sơn Tấn Hoàng', '27051fb5b6833d78a4eb34d26d97d922.jpg', '2001-06-06', 'nam', '0921838021', 'hoangsonytb123@gmail.com', '105.7599936', '10.0312192', '67afdb0fe736bc695ff4290ebfca77e8', '2021-06-15 09:54:50'),
(7, '', 'Nguyễn Ngọc Độ', 'ngocdo.jpg', '0000-00-00', '0', '', '', '0', '0', 'e10adc3949ba59abbe56e057f20f883e', '2021-06-14 07:51:29'),
(8, 'nguyentruonggiang', '', 'default-user-image.jpg', '', '', '', '', '0', '0', 'e10adc3949ba59abbe56e057f20f883e', '2021-06-14 07:51:29'),
(9, 'tranquotoan', '', 'default-user-image.jpg', '', '', '', '', '0', '0', 'e10adc3949ba59abbe56e057f20f883e', '2021-06-14 07:51:29'),
(10, 'nguyenngocdo', '', 'default-user-image.jpg', '', '', '', '', '0', '0', 'e10adc3949ba59abbe56e057f20f883e', '2021-06-14 07:51:29'),
(13, 'khiem', '', 'default-user-image.jpg', '', '', '', '', '0', '0', 'd41d8cd98f00b204e9800998ecf8427e', '2021-06-14 07:51:29'),
(28, 'testweb', 'test', 'd0f22cb36574fe0802975279a2aa5104.jpg', '2001-06-01', 'nam', '0921838021', 'testsonytb123@gmail.com', '0', '0', '67afdb0fe736bc695ff4290ebfca77e8', '2021-06-14 07:51:29'),
(29, 'mastercover0', 'h', '00d7de768b09bddd02ced428080bf4fb.jpg', '2001-01-01', 'nam', '0921838021', 'tashgdha@gmail.com', '0', '0', '67afdb0fe736bc695ff4290ebfca77e8', '2021-06-14 07:51:29'),
(30, '2972570506406872', 'Tấn Hoàng', '', '', '', '', 'hoangson.zing.vn@gmail.com', '0', '0', '', '2021-06-14 07:51:29');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_order`
--

CREATE TABLE `tbl_order` (
  `id` int(11) NOT NULL,
  `productId` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `address_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `totalPayment` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `date_order` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_order`
--

INSERT INTO `tbl_order` (`id`, `productId`, `customer_id`, `address_id`, `quantity`, `totalPayment`, `status`, `date_order`) VALUES
(784, 102, 6, 317, 3, '2500', 0, '2021-08-25 10:37:09'),
(785, 108, 6, 317, 1, '2500', 0, '2021-08-25 10:37:09'),
(786, 102, 6, 318, 3, '27500', 0, '2021-08-25 11:20:14'),
(787, 108, 6, 318, 2, '192621', 0, '2021-08-25 11:20:14'),
(788, 102, 6, 319, 3, '27500', 0, '2021-08-25 11:23:03'),
(789, 108, 6, 319, 2, '192621', 0, '2021-08-25 11:23:03'),
(790, 102, 6, 320, 3, '87500', 0, '2021-08-25 11:26:55'),
(791, 108, 6, 320, 2, '387742', 0, '2021-08-25 11:26:55');

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
(1, 'Giao hàng tiêu chuẩn', '5000');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_product`
--

CREATE TABLE `tbl_product` (
  `productId` int(11) NOT NULL,
  `productName` tinytext COLLATE utf8_unicode_ci NOT NULL,
  `product_code` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `productQuantity` int(11) NOT NULL,
  `product_soldout` int(11) NOT NULL DEFAULT 0,
  `product_remain` int(11) NOT NULL,
  `catId` int(11) NOT NULL,
  `brandId` int(11) NOT NULL,
  `product_desc` text COLLATE utf8_unicode_ci NOT NULL,
  `type` int(11) NOT NULL,
  `old_price` varchar(15) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0.000',
  `price` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_product`
--

INSERT INTO `tbl_product` (`productId`, `productName`, `product_code`, `productQuantity`, `product_soldout`, `product_remain`, `catId`, `brandId`, `product_desc`, `type`, `old_price`, `price`, `image`) VALUES
(33, 'Thùng 48 hộp sữa chua uống vị lựu YoMost 170ml', 'tu-002', 40, 0, 30, 19, 22, '<ul class=\"infoproduct\">\n<li><span>Hương vị</span>&nbsp;: Lựu</li>\n<li><span>Ph&ugrave; hợp</span>&nbsp;: Trẻ em tr&ecirc;n 2 tuổi</li>\n<li><span>Thể t&iacute;ch</span>&nbsp;: 170ml</li>\n<li><span>Th&agrave;nh phần</span>&nbsp;: Nước, sữa chua l&ecirc;n men, đường,...</li>\n<li><span>Thương hiệu</span>&nbsp;: YoMost (Việt Nam)</li>\n<li><span>Sản xuất</span>&nbsp;: Việt Nam</li>\n</ul>\n<div class=\"description   show-moreinfo\">\n<h3><strong>Gi&aacute; trị dinh dưỡng:</strong></h3>\n<img class=\"lazy initial loaded\" src=\"https://cdn.tgdd.vn/Products/Images/2944/85880/bhx/scu-yomost-luu-170ml-thung-48-hop-6.jpg\" alt=\"Bảng gi&aacute; trị dinh dưỡng sữa chua uống YoMost lựu hộp 170ml \" data-src=\"https://cdn.tgdd.vn/Products/Images/2944/85880/bhx/scu-yomost-luu-170ml-thung-48-hop-6.jpg\" data-was-processed=\"true\" />\n<h3><strong>Hướng dẫn sử dụng:</strong></h3>\n<ul>\n<li>Lắc đều trước khi uống. Ngon hơn khi uống lạnh.</li>\n<li>Lưu &yacute;: d&ugrave;ng cho trẻ&nbsp;lớn hơn 2&nbsp;tuổi.</li>\n</ul>\n<h3><strong>Bảo quản:</strong></h3>\n<ul>\n<li>Bảo quản nơi kh&ocirc; r&aacute;o tho&aacute;ng m&aacute;t.</li>\n</ul>\n</div>\n<div id=\"eJOY__extension_root\" class=\"eJOY__extension_root_class\" style=\"all: unset;\">&nbsp;</div>', 0, '999.990', '99.999', '3fe42f417b.jpg'),
(34, 'Thùng 24 lon Strongbow dâu đen 330ml', 'tu-003', 100, 7, 23, 19, 21, '<ul class=\"infoproduct\">\r\n<li><span>Thương hiệu :&nbsp;</span>Strongbow (Việt Nam)</li>\r\n<li><span>Sản xuất tại</span>&nbsp;: Việt Nam</li>\r\n<li><span>Nồng độ cồn</span>&nbsp;: 4.5%</li>\r\n<li><span>Thể t&iacute;ch</span>&nbsp;: 330ml</li>\r\n<li><span>Hương vị</span>&nbsp;: d&acirc;u đen</li>\r\n<li><span>Số lượng</span>&nbsp;: Th&ugrave;ng 24 lon</li>\r\n<li><span>Lưu &yacute;</span>&nbsp;\r\n<div>Sản phẩm d&agrave;nh cho người tr&ecirc;n 18 tuổi v&agrave; kh&ocirc;ng d&agrave;nh cho phụ nữ mang thai. Thưởng thức c&oacute; tr&aacute;ch nhiệm, đ&atilde; uống đồ uống c&oacute; cồn th&igrave; kh&ocirc;ng l&aacute;i xe!</div>\r\n</li>\r\n</ul>\r\n<div class=\"description   show-moreinfo\"><strong>STRONGBOW DARK FRUIT - VỊ D&Acirc;U ĐEN</strong><br /><img class=\"lazy initial loaded\" src=\"https://cdn.tgdd.vn/Products/Images//2282/193600/bhx/files/stdf1.jpg\" alt=\"\" data-src=\"//cdn.tgdd.vn/Products/Images//2282/193600/bhx/files/stdf1.jpg\" data-was-processed=\"true\" /><br />Vị chua thanh m&aacute;t của&nbsp;<strong>quả l&yacute; chua đen</strong>&nbsp;kết hợp với vị ngọt nhẹ nh&agrave;ng của t&aacute;o, tạo n&ecirc;n sự đột ph&aacute; trong hương vị&nbsp;của&nbsp;<strong>Strongbow Dark Fruit</strong>.<br /><img class=\"lazy initial loaded\" src=\"https://cdn.tgdd.vn/Products/Images//2282/193600/bhx/files/stdf2.jpg\" alt=\"\" data-src=\"//cdn.tgdd.vn/Products/Images//2282/193600/bhx/files/stdf2.jpg\" data-was-processed=\"true\" /><br />Được l&agrave;m từ những quả t&aacute;o tươi ngon nhất,<strong>&nbsp;<a title=\"Strongbow đang b&aacute;n tại B&aacute;ch Ho&aacute; XANH\" href=\"https://www.bachhoaxanh.com/bia-strongbow\" target=\"_blank\">Strongbow</a></strong>&nbsp;mang đến cho bạn sự trải nghiệm tươi mới đầy sức sống.&nbsp;Với&nbsp;<strong>độ cồn chỉ 4.5%</strong>&nbsp;được&nbsp;<strong><a title=\"Nước &eacute;p t&aacute;o l&ecirc;n men Strongbow\" href=\"https://www.bachhoaxanh.com/bia-strongbow\" target=\"_blank\">l&ecirc;n men từ nước &eacute;p của t&aacute;o tươi</a>&nbsp;</strong>đủ để bạn c&oacute; thể chill c&ugrave;ng bạn b&egrave; trong c&aacute;c bữa tiệc nếu bạn l&agrave; người kh&ocirc;ng chuộng<strong>&nbsp;<a title=\"Bia việt, bia nhập khẩu ch&iacute;nh h&atilde;ng tại B&aacute;ch Ho&aacute; XANH\" href=\"https://www.bachhoaxanh.com/bia\" target=\"_blank\">bia</a></strong>.<br /><img class=\"lazy initial loaded\" src=\"https://cdn.tgdd.vn/Products/Images//2282/193600/bhx/files/stdf3.jpg\" alt=\"\" data-src=\"//cdn.tgdd.vn/Products/Images//2282/193600/bhx/files/stdf3.jpg\" data-was-processed=\"true\" /></div>', 0, '0.000', '99.999', '3ef7516728.jpg'),
(96, 'Thùng 24 lon trà bí đao Fuze Tea la hán quả 330ml', 'tu-004', 70, 3, 67, 19, 20, '<ul class=\"infoproduct nospeci\">\r\n<li><span>Thương hiệu</span>&nbsp;: Fuze Tea (Việt Nam)</li>\r\n<li><span>Loại tr&agrave;</span>&nbsp; :Tr&agrave; b&iacute; đao la h&aacute;n quả</li>\r\n<li><span>Dung t&iacute;ch</span>&nbsp;: 330ml</li>\r\n<li><span>Lượng đường</span>&nbsp;: C&oacute; đường</li>\r\n<li><span>Hướng dẫn sử dụng</span>&nbsp;: Lắc đều trước khi d&ugrave;ng. Ngon hơn khi uống lạnh</li>\r\n<li><span>Bảo quản</span>&nbsp;: Để nơi kh&ocirc; r&aacute;o, tho&aacute;ng m&aacute;t, tr&aacute;nh &aacute;nh s&aacute;ng trực tiếp hoặc nơi c&oacute; nhiệt độ cao.</li>\r\n</ul>\r\n<div id=\"eJOY__extension_root\" class=\"eJOY__extension_root_class\" style=\"all: unset;\">&nbsp;</div>', 0, '999.990', '99.999', '4eab4def00.jpg'),
(97, '6 lon nước cam ép Minute Maid Splash 320ml', 'tu-005', 300, 0, 300, 19, 19, '<ul class=\"infoproduct\">\r\n<li><span>Thương hiệu</span>&nbsp;\r\n<div>Minute Maid (Mỹ)</div>\r\n</li>\r\n<li><span>Loại tr&aacute;i c&acirc;y</span>&nbsp;\r\n<div>Cam &eacute;p</div>\r\n</li>\r\n<li><span>Lượng đường</span>&nbsp;\r\n<div>C&oacute; đường</div>\r\n</li>\r\n<li><span>Thể t&iacute;ch</span>&nbsp;\r\n<div>320ml</div>\r\n</li>\r\n<li><span>Hướng dẫn sử dụng</span>&nbsp;\r\n<div>Lắc đều trước khi sử dụng. Ngon hơn khi uống lạnh.</div>\r\n</li>\r\n<li><span>Bảo quản</span>&nbsp;\r\n<div>Để nơi kh&ocirc; r&aacute;o v&agrave; tho&aacute;ng m&aacute;t, tr&aacute;nh &aacute;nh nắng trực tiếp hoặc nơi c&oacute; nhiệt độ cao.</div>\r\n</li>\r\n</ul>\r\n<div class=\"description   show-moreinfo\">\r\n<p>Trong&nbsp;<a href=\"https://www.bachhoaxanh.com/nuoc-ep-trai-cay\" target=\"_blank\">nước &eacute;p</a>&nbsp;cam c&ograve;n chứa nhiều hợp chất kh&aacute;c c&oacute; khả năng chống oxy h&oacute;a cao hơn gấp 6 lần so với vitamin C như: hesperidin từ flavonoid, c&oacute; nhiều trong lớp vỏ xơ trắng, m&agrave;ng bao m&uacute;i cam v&agrave; một &iacute;t trong t&eacute;p v&agrave; hạt cam, gi&uacute;p giảm cholesterol xấu v&agrave; tăng cholesterol tốt. Do đ&oacute;, với lượng dưỡng chất trong nước cam lu&ocirc;n được được ti&ecirc;u thụ kh&aacute; phổ biến ở cả dạng nước cam đ&oacute;ng chai lẫn nước cam vắt.<br /><img class=\"lazy initial loaded\" src=\"https://cdn.tgdd.vn/Products/Images/3265/225632/bhx/6-lon-nuoc-cam-ep-minute-maid-splash-320ml-202008101326274990.jpg\" alt=\"6 lon nước cam &eacute;p Minute Maid Splash 320ml 2\" data-src=\"https://cdn.tgdd.vn/Products/Images/3265/225632/bhx/6-lon-nuoc-cam-ep-minute-maid-splash-320ml-202008101326274990.jpg\" data-was-processed=\"true\" /><br /><a href=\"http://www.bachhoaxanh.com/nuoc-ep-trai-cay-minute-maid\" target=\"_blank\">Nước &eacute;p&nbsp;Minute maid Splash</a>&nbsp;l&agrave; loại nước cam c&oacute; t&eacute;p kh&aacute;c biệt hẳn với c&aacute;c sản phẩm nước cam &eacute;p c&ograve;n lại bởi vị cam tươi ngon, hương cam thơm m&aacute;t v&agrave; m&agrave;u cam ho&agrave;n to&agrave;n tự nhi&ecirc;n.Mang hương vị tươi nguy&ecirc;n từ thi&ecirc;n nhi&ecirc;n, Minute Maid Splash l&agrave; thức uống tuyệt hảo rất ph&ugrave; hợp với nhu cầu ti&ecirc;u d&ugrave;ng th&ocirc;ng minh hiện nay.<br /><img class=\"lazy initial loaded\" src=\"https://cdn.tgdd.vn/Products/Images/3265/225632/bhx/6-lon-nuoc-cam-ep-minute-maid-splash-320ml-202008101326291631.jpg\" alt=\"6 lon nước cam &eacute;p Minute Maid Splash 320ml 7\" data-src=\"https://cdn.tgdd.vn/Products/Images/3265/225632/bhx/6-lon-nuoc-cam-ep-minute-maid-splash-320ml-202008101326291631.jpg\" data-was-processed=\"true\" /><br />Do thiếu sắt trong cơ thể n&ecirc;n dẫn đến g&acirc;y thiếu tế b&agrave;o m&aacute;u trong hemoglobin. V&igrave; vậy cần uống nước cam vắt mỗi ng&agrave;y để bổ sung c&aacute;c chất kho&aacute;ng như sắt, magie, mangan&hellip; v&agrave; vitamin thiết yếu, đặc biệt l&agrave; h&agrave;m lượng lớn vitamin C gi&uacute;p cơ thể hấp thu sắt dễ d&agrave;ng v&agrave;o m&aacute;u, từ đ&oacute; cải thiện hiệu quả t&igrave;nh trạng thiếu m&aacute;u.<br /><a href=\"https://www.bachhoaxanh.com/nuoc-ep-trai-cay/6-lon-nuoc-cam-ep-minute-maid-splash-320ml\" target=\"_blank\">6 lon nước cam &eacute;p Minute Maid Splash 320ml</a>&nbsp;l&agrave; sản phẩm độc đ&aacute;o được sản xuất dưới quy tr&igrave;nh v&agrave; c&ocirc;ng nghệ của hai thương hiệu đắt gi&aacute; l&agrave; Coca-Cola v&agrave; nh&agrave; sản xuất nước tr&aacute;i c&acirc;y h&agrave;ng đầu thế giới Minute Maid.<br /><img class=\"lazy initial loaded\" src=\"https://cdn.tgdd.vn/Products/Images/3265/225632/bhx/6-lon-nuoc-cam-ep-minute-maid-splash-320ml-202008101326278243.jpg\" alt=\"6 lon nước cam &eacute;p Minute Maid Splash 320ml 3\" data-src=\"https://cdn.tgdd.vn/Products/Images/3265/225632/bhx/6-lon-nuoc-cam-ep-minute-maid-splash-320ml-202008101326278243.jpg\" data-was-processed=\"true\" /><br />Sự kh&aacute;c biệt khi mua 1 lon v&agrave; 6 lon dạng lốc rất kh&aacute;c biệt, khi mua 6 lon th&igrave; sẽ giảm chi ph&iacute; nhất định k&egrave;m theo đ&oacute; kh&ocirc;ng phải tốn thời gian ra v&agrave;o tiệm b&aacute;ch h&oacute;a nhiều lần khi ta sử dụng hết đối với những người bận rộn.<br />Xem th&ecirc;m:&nbsp;<a href=\"https://www.bachhoaxanh.com/kinh-nghiem-hay/nhung-tac-dung-tuyet-voi-cua-trai-cam-co-the-ban-chua-biet-het-1154482\" target=\"_blank\">Những t&aacute;c dụng tuyệt vời của tr&aacute;i cam c&oacute; thể bạn chưa biết hết</a></p>\r\n</div>\r\n<div id=\"eJOY__extension_root\" class=\"eJOY__extension_root_class\" style=\"all: unset;\">&nbsp;</div>', 0, '0.000', '99.999', '5853f40f08.jpg'),
(98, 'Thùng 24 hộp sữa bắp non LiF 180ml', 'tu-006', 400, 0, 400, 19, 18, '<ul class=\"infoproduct nospeci\">\r\n<li><span>Loại sữa</span>&nbsp;\r\n<div>Bắp non c&oacute; đường</div>\r\n</li>\r\n<li><span>Ph&ugrave; hợp</span>&nbsp;\r\n<div>D&ugrave;ng cho trẻ từ 3 tuổi trở l&ecirc;n v&agrave; người lớn</div>\r\n</li>\r\n<li><span>Th&agrave;nh phần</span>&nbsp;\r\n<div>Nước, bắp non, sữa bột gầy, bột kem thực vật,...</div>\r\n</li>\r\n<li><span>Thể t&iacute;ch</span>&nbsp;\r\n<div>180ml</div>\r\n</li>\r\n<li><span>Thương hiệu</span>&nbsp;\r\n<div>LiF (&Uacute;c)</div>\r\n</li>\r\n<li><span>Nơi sản xuất</span>&nbsp;\r\n<div>Việt Nam</div>\r\n</li>\r\n</ul>\r\n<div id=\"eJOY__extension_root\" class=\"eJOY__extension_root_class\" style=\"all: unset;\">&nbsp;</div>', 0, '999.990', '99.999', '7bcad80256.jpg'),
(99, '6 chai nước ngọt Mirinda hương cam 390ml', 'tu-007', 300, 0, 300, 19, 20, '<ul class=\"infoproduct\">\r\n<li><span>Thương hiệu</span>&nbsp;\r\n<div>Mirinda (Việt Nam)</div>\r\n</li>\r\n<li><span>Sản xuất tại</span>&nbsp;\r\n<div>Việt Nam</div>\r\n</li>\r\n<li><span>Loại nước</span>&nbsp;\r\n<div>nước ngọt</div>\r\n</li>\r\n<li><span>Hương vị</span>&nbsp;\r\n<div>hương cam</div>\r\n</li>\r\n<li><span>Lượng ga</span>&nbsp;\r\n<div>C&oacute; ga</div>\r\n</li>\r\n<li><span>Lượng đường</span>&nbsp;\r\n<div>C&oacute; đường</div>\r\n</li>\r\n<li><span>Thể t&iacute;ch</span>&nbsp;\r\n<div>390ml</div>\r\n</li>\r\n<li><span>Số lượng</span>&nbsp;\r\n<div>6 chai</div>\r\n</li>\r\n<li><span>Sử dụng</span>&nbsp;\r\n<div>Ngon hơn khi uống lạnh</div>\r\n</li>\r\n</ul>\r\n<div class=\"description   show-moreinfo\">\r\n<h3>Th&agrave;nh phần</h3>\r\n<p>Nước b&atilde;o h&ograve;a CO2, đường m&iacute;a, chất điều chỉnh độ acid(330, 331ii), tinh bột biến t&iacute;nh, chất bảo quản(211), chất nhũ h&oacute;a(445iii), hương cam tự nhi&ecirc;n, m&agrave;u tổng hợp(110).</p>\r\n<h3>Hướng dẫn sử dụng</h3>\r\n<p>D&ugrave;ng trực tiếp, ngon hơn khi uống lạnh.</p>\r\n<h3>Bảo quản</h3>\r\n<p>Để nơi kh&ocirc; r&aacute;o, tho&aacute;ng m&aacute;t, tr&aacute;nh &aacute;nh nắng trực tiếp.</p>\r\n</div>\r\n<div id=\"eJOY__extension_root\" class=\"eJOY__extension_root_class\" style=\"all: unset;\">&nbsp;</div>', 0, '999.990', '99.999', '4999842b9e.jpg'),
(100, '6 chai nước ngọt 7 Up vị chanh 390ml', 'tu-008', 500, 10, 490, 19, 20, '<ul class=\"infoproduct\">\r\n<li><span>Thương hiệu</span>&nbsp;\r\n<div>7 Up (Mỹ)</div>\r\n</li>\r\n<li><span>Sản xuất tại</span>&nbsp;\r\n<div>Việt Nam</div>\r\n</li>\r\n<li><span>Loại nước</span>&nbsp;\r\n<div>nước ngọt</div>\r\n</li>\r\n<li><span>Hương vị</span>&nbsp;\r\n<div>vị chanh</div>\r\n</li>\r\n<li><span>Lượng ga</span>&nbsp;\r\n<div>C&oacute; ga</div>\r\n</li>\r\n<li><span>Lượng đường</span>&nbsp;\r\n<div>C&oacute; đường</div>\r\n</li>\r\n<li><span>Thể t&iacute;ch</span>&nbsp;\r\n<div>390ml</div>\r\n</li>\r\n<li><span>Số lượng</span>&nbsp;\r\n<div>6 chai</div>\r\n</li>\r\n<li><span>Sử dụng</span>&nbsp;\r\n<div>Ngon hơn khi uống lạnh</div>\r\n</li>\r\n</ul>\r\n<div class=\"description   show-moreinfo\">\r\n<h3>Th&agrave;nh phần</h3>\r\n<p>Nước b&atilde;o h&ograve;a CO2, đường m&iacute;a, chất điều chỉnh độ acid, hương chanh tự nhi&ecirc;n,...</p>\r\n<h3>Hướng dẫn sử dụng</h3>\r\n<p>D&ugrave;ng trực tiếp, ngon hơn khi uống lạnh.</p>\r\n<h3>Bảo quản</h3>\r\n<p>Đ&ecirc;̉ nơi kh&ocirc; r&aacute;o, tho&aacute;ng m&aacute;t tr&aacute;nh &aacute;nh nắng trực tiếp.</p>\r\n</div>\r\n<div id=\"eJOY__extension_root\" class=\"eJOY__extension_root_class\" style=\"all: unset;\">&nbsp;</div>', 0, '0.000', '99.999', '054d0dad80.jpg'),
(101, '6 chai nước ngọt Mirinda hương xá xị 390ml', 'tu-009', 200, 0, 200, 19, 21, '<ul class=\"infoproduct\">\r\n<li><span>Thương hiệu</span>&nbsp;\r\n<div>Mirinda (Việt Nam)</div>\r\n</li>\r\n<li><span>Sản xuất tại</span>&nbsp;\r\n<div>Việt Nam</div>\r\n</li>\r\n<li><span>Loại nước</span>&nbsp;\r\n<div>nước ngọt</div>\r\n</li>\r\n<li><span>Hương vị</span>&nbsp;\r\n<div>hương x&aacute; xị</div>\r\n</li>\r\n<li><span>Lượng ga</span>&nbsp;\r\n<div>C&oacute; ga</div>\r\n</li>\r\n<li><span>Lượng đường</span>&nbsp;\r\n<div>C&oacute; đường</div>\r\n</li>\r\n<li><span>Thể t&iacute;ch</span>&nbsp;\r\n<div>390ml</div>\r\n</li>\r\n<li><span>Số lượng</span>&nbsp;\r\n<div>6 chai</div>\r\n</li>\r\n<li><span>Sử dụng</span>&nbsp;\r\n<div>Ngon hơn khi uống lạnh</div>\r\n</li>\r\n</ul>\r\n<div class=\"description   show-moreinfo\">\r\n<h3>Th&agrave;nh phần</h3>\r\n<p>Nước b&atilde;o h&ograve;a CO2, đường m&iacute;a, m&agrave;u thực phẩm, hương x&aacute; xị tổng hợp, chất điều chỉnh độ axit.</p>\r\n<h3>Hướng dẫn sử dụng</h3>\r\n<p>D&ugrave;ng trực tiếp, ngon hơn khi uống lạnh.</p>\r\n<h3>Bảo quản</h3>\r\n<p>Để nơi kh&ocirc; r&aacute;o, tho&aacute;ng m&aacute;t, tr&aacute;nh &aacute;nh nắng trực tiếp.</p>\r\n</div>\r\n<div id=\"eJOY__extension_root\" class=\"eJOY__extension_root_class\" style=\"all: unset;\">&nbsp;</div>', 0, '0.000', '99.999', '31e20f5f85.jpg'),
(102, '6 chai nước ngọt Pepsi Cola 390ml', 'tu-0010', 150, 22, 128, 19, 21, '<ul class=\"infoproduct\">\r\n<li><span>Thương hiệu</span>\r\n<p><a title=\"Pepsi, nước ngọt Pepsi\" href=\"https://www.bachhoaxanh.com/nuoc-ngot-pepsi\" target=\"_blank\">Pepsi</a>&nbsp;(Mỹ)</p>\r\n</li>\r\n<li><span>Sản xuất tại</span>&nbsp;\r\n<div>Việt Nam</div>\r\n</li>\r\n<li><span>Loại nước</span>&nbsp;\r\n<div>nước ngọt</div>\r\n</li>\r\n<li><span>Lượng ga</span>&nbsp;\r\n<div>C&oacute; ga</div>\r\n</li>\r\n<li><span>Lượng đường</span>&nbsp;\r\n<div>C&oacute; đường</div>\r\n</li>\r\n<li><span>Thể t&iacute;ch</span>&nbsp;\r\n<div>390ml</div>\r\n</li>\r\n<li><span>Số lượng</span>&nbsp;\r\n<div>6 chai</div>\r\n</li>\r\n<li><span>Sử dụng</span>&nbsp;\r\n<div>Ngon hơn khi uống lạnh</div>\r\n</li>\r\n</ul>\r\n<div class=\"description   show-moreinfo\">\r\n<h3>Pepsi - Thương hiệu&nbsp;<a title=\"Nước ngọt, nước ngọt c&oacute; ga c&aacute;c loại tại B&aacute;ch Ho&aacute; XANH\" href=\"https://www.bachhoaxanh.com/nuoc-ngot\" target=\"_blank\">nước ngọt c&oacute; ga</a>&nbsp;nổi tiếng tr&ecirc;n to&agrave;n cầu</h3>\r\n<img class=\"lazy initial loaded\" src=\"https://cdn.tgdd.vn/Products/Images//2443/88121/bhx/files/ps3.jpg\" alt=\"\" data-src=\"//cdn.tgdd.vn/Products/Images//2443/88121/bhx/files/ps3.jpg\" data-was-processed=\"true\" />\r\n<p><a title=\"Nước ngọt Pepsi tại B&aacute;ch Ho&aacute; XANH\" href=\"https://www.bachhoaxanh.com/nuoc-ngot-pepsi\" target=\"_blank\"><strong>Nước ngọt Pepsi</strong></a>&nbsp;lần đầu ti&ecirc;n được tạo ra từ&nbsp;nước cacbonat, đường, vani v&agrave; một ch&uacute;t dầu ăn rất đơn giản để trở th&agrave;nh một loại<strong>&nbsp;thức uống gi&uacute;p bạn dễ ti&ecirc;u ho&aacute;</strong>&nbsp;v&agrave; được mệnh danh l&agrave;&nbsp;<strong>nước uống của Brad</strong>&nbsp;do &ocirc;ng&nbsp;<strong>Bradham</strong>&nbsp;đ&atilde; t&igrave;m ra c&ocirc;ng thức n&agrave;y v&agrave;o<strong>&nbsp;năm 1886</strong>.<br /><img class=\"lazy initial loaded\" src=\"https://cdn.tgdd.vn/Products/Images//2443/88121/bhx/files/ps4.jpg\" alt=\"\" data-src=\"//cdn.tgdd.vn/Products/Images//2443/88121/bhx/files/ps4.jpg\" data-was-processed=\"true\" /><br />Trong những&nbsp;<strong>năm 1980</strong>, Pepsi&nbsp;đ&atilde; chuyển từ&nbsp;<strong>đường</strong>&nbsp;sang d&ugrave;ng&nbsp;<strong>syro ng&ocirc;</strong>, một chất tạo ngọt rẻ hơn. Đồng thời sau đ&oacute;, c&ocirc;ng ty cũng thay đổi&nbsp;<strong>chất tạo m&agrave;u caramel</strong>&nbsp;trong nước uống của m&igrave;nh để tr&aacute;nh việc bị gắn m&aacute;c g&acirc;y ung thư cho người ti&ecirc;u d&ugrave;ng.<br /><img class=\"lazy initial loaded\" src=\"https://cdn.tgdd.vn/Products/Images//2443/88121/bhx/files/ps1.jpg\" alt=\"\" data-src=\"//cdn.tgdd.vn/Products/Images//2443/88121/bhx/files/ps1.jpg\" data-was-processed=\"true\" /><br />Với&nbsp;<strong>lượng ga cực mạnh</strong>&nbsp;Pepsi đ&atilde; g&acirc;y ấn tượng tốt với người ti&ecirc;u d&ugrave;ng. Kh&ocirc;ng những gi&uacute;p bao tử<strong>&nbsp;dễ ti&ecirc;u ho&aacute; khi ăn</strong>, Pepsi c&ograve;n gi&uacute;p bạn&nbsp;<strong>giải nhiệt cực nhanh</strong>&nbsp;trong nhũng ng&agrave;y h&egrave; n&oacute;ng bức&nbsp;hoặc&nbsp;<strong>những khi mệt mỏi</strong>, chỉ với&nbsp;<strong>1 ly Pepsi cực lạnh</strong>&nbsp;sẽ đưa cơn sảng kho&aacute;i đến với bạn ngay lập tức&nbsp;<br /><img class=\"lazy initial loaded\" src=\"https://cdn.tgdd.vn/Products/Images//2443/88121/bhx/files/ps2.jpg\" alt=\"\" data-src=\"//cdn.tgdd.vn/Products/Images//2443/88121/bhx/files/ps2.jpg\" data-was-processed=\"true\" /></p>\r\n</div>\r\n<div id=\"eJOY__extension_root\" class=\"eJOY__extension_root_class\" style=\"all: unset;\">&nbsp;</div>', 1, '40000', '30000', '69e3a052af.jpg'),
(103, 'Bánh que Glico Pejoy vị hỗn hợp hộp 117g', 'bk-001', 400, 0, 400, 20, 21, '<ul class=\"infoproduct nospeci\">\r\n<li><span>Loại b&aacute;nh</span>&nbsp;\r\n<div>B&aacute;nh que vị hỗn hợp</div>\r\n</li>\r\n<li><span>Khối lượng</span>&nbsp;\r\n<div>117g</div>\r\n</li>\r\n<li><span>Lưu &yacute;</span>&nbsp;\r\n<div>Kh&ocirc;ng d&ugrave;ng cho người bị dị ứng với sữa, bột m&igrave;, đậu n&agrave;nh</div>\r\n</li>\r\n<li><span>Bảo quản</span>&nbsp;\r\n<div>Bảo quản nơi kh&ocirc; r&aacute;o, tho&aacute;ng m&aacute;t, tr&aacute;nh &aacute;nh nắng trực tiếp</div>\r\n</li>\r\n<li><span>Thương hiệu</span>&nbsp;\r\n<div>Glico ()</div>\r\n</li>\r\n<li><span>Nơi sản xuất</span>&nbsp;\r\n<div>Nhật Bản</div>\r\n</li>\r\n</ul>\r\n<div id=\"eJOY__extension_root\" class=\"eJOY__extension_root_class\" style=\"all: unset;\">&nbsp;</div>', 0, '999.990', '99.999', '29a4dc451c.jpg'),
(104, 'Bánh que Meiji Yan Yan Premium yến mạch cao cấp dâu và phô mai ly 44g', 'bk-002', 500, 0, 500, 20, 20, '<ul class=\"infoproduct nospeci\">\r\n<li><span>Loại b&aacute;nh</span>&nbsp;\r\n<div>B&aacute;nh que yến mạch cao cấp d&acirc;u v&agrave; ph&ocirc; mai</div>\r\n</li>\r\n<li><span>Khối lượng</span>&nbsp;\r\n<div>44g</div>\r\n</li>\r\n<li><span>Th&agrave;nh phần</span>&nbsp;\r\n<div>Bột m&igrave;, dầu thực vật (cọ, đậu n&agrave;nh, hướng dương cao oleic, hạt cải hydro ho&aacute;), đường, Lactose, bột sữa nguy&ecirc;n chất, bột whey, yến mạch, sữa bột t&aacute;ch kem, bột ph&ocirc; mai Mascarbone (ph&ocirc; mai Macarbone), muối, chất tạo xốp (Sodium carbonate-INS 500(ii), Ammonium bicarbonate-&Iacute;N 503(II)), chất nhũ ho&aacute; (lecithin đậu n&agrave;nh-INS 322), bột ph&ocirc; mai (ph&ocirc; mai Cheddar (microbial enzyme), whey, chất ổn định (dinatri orthophosphat-INS 339(ii)), chất điều chỉnh độ acid (acid lactic-INS 270), men, bột việt quất, bột d&acirc;u, m&agrave;u tự nhi&ecirc;n (beet red-INS 162), hương liệu nh&acirc;n tạo (b&aacute;nh ph&ocirc; mai, d&acirc;u, sữa chua), chất điều chỉnh độ acid (acid citric-INS 330). Chứa hương liệu v&agrave; m&agrave;u được cho ph&eacute;p. Chứa chất nhũ ho&aacute; v&agrave; chất điều chỉnh độ acid như l&agrave; một chất điều chế thực phẩm được cho ph&eacute;p. Phụ gia thực phẩm c&oacute; nguồn gốc thực vật v&agrave; tổng hợp. Dầu thực vật c&oacute; nguồn gốc thực vật. C&aacute;c chất g&acirc;y dị ứng (chứa bột m&igrave;, yến mạch (ngũ cốc chứa gluten) sữa v&agrave; đậu n&agrave;nh). Sản phẩm c&oacute; chứa hạt m&egrave; v&agrave; hạt phỉ.</div>\r\n</li>\r\n<li><span>Năng lượng</span>&nbsp;\r\n<div>238kcal/44g</div>\r\n</li>\r\n<li><span>Lưu &yacute;</span>&nbsp;\r\n<div>Kh&ocirc;ng d&ugrave;ng cho người bị dị ứng với sữa, bột m&igrave;, đậu n&agrave;nh v&agrave; m&egrave;</div>\r\n</li>\r\n<li><span>Bảo quản</span>&nbsp;\r\n<div>Bảo quản nơi kh&ocirc; r&aacute;o, tho&aacute;ng m&aacute;t, đậy k&iacute;n bao b&igrave; sau khi mở</div>\r\n</li>\r\n<li><span>Thương hiệu</span>&nbsp;\r\n<div>Meiji (Nepal)</div>\r\n</li>\r\n<li><span>Nơi sản xuất</span>&nbsp;\r\n<div>Singapore</div>\r\n</li>\r\n</ul>\r\n<div id=\"eJOY__extension_root\" class=\"eJOY__extension_root_class\" style=\"all: unset;\">&nbsp;</div>', 0, '0.000', '99.999', '41e4b0b566.jpg'),
(105, 'Bánh kem trứng Custas hộp 470g (20 cái)', 'bk-003', 260, 10, 250, 20, 21, '<ul class=\"infoproduct\">\r\n<li><span>Loại b&aacute;nh</span>&nbsp;\r\n<div>B&aacute;nh custas kem trứng</div>\r\n</li>\r\n<li><span>Số lượng</span>&nbsp;\r\n<div>20 c&aacute;i x 23.5g</div>\r\n</li>\r\n<li><span>Năng lượng</span>&nbsp;\r\n<div>110 kcal/1 c&aacute;i</div>\r\n</li>\r\n<li><span>Th&agrave;nh phần</span>&nbsp;\r\n<div>Trứng, bột m&igrave;, đường, chất b&eacute;o thực vật, chất giữ ẩm, chất nhũ ho&aacute;, sữa bột nguy&ecirc;n kem, bột l&ograve;ng đỏ trứng, chất ổn định,...</div>\r\n</li>\r\n<li><span>Khối lượng tổng</span>&nbsp;\r\n<div>470g</div>\r\n</li>\r\n<li><span>Thương hiệu</span>&nbsp;\r\n<div>Custas (H&agrave;n Quốc)</div>\r\n</li>\r\n<li><span>Nơi sản xuất</span>&nbsp;\r\n<div>Việt Nam</div>\r\n</li>\r\n</ul>\r\n<div class=\"description   show-moreinfo\"><strong>B&aacute;nh custas kem trứng Orion</strong>&nbsp;l&agrave; chiếc&nbsp;<strong><a href=\"https://www.bachhoaxanh.com/banh-bong-lan\" target=\"_blank\">b&aacute;nh b&ocirc;ng lan</a></strong>&nbsp;rất được y&ecirc;u th&iacute;ch bởi hương vị thơm ngon từ vỏ b&aacute;nh cho đến lớp kem trứng ngọt ng&agrave;o, mềm mịn v&agrave; đậm vị được l&agrave;m từ trứng tươi.&nbsp;<br /><img class=\"lazy initial loaded\" src=\"https://cdn.tgdd.vn/Products/Images//3358/77008/bhx/files/000%20(6).jpg\" alt=\"B&aacute;nh custas Orion 1\" data-src=\"//cdn.tgdd.vn/Products/Images//3358/77008/bhx/files/000%20(6).jpg\" data-was-processed=\"true\" />\r\n<h2>Chất lượng tuyệt hảo từ nguy&ecirc;n liệu</h2>\r\nB&aacute;nh custas Orion được l&agrave;m từ những nguy&ecirc;n liệu tươi ngon, c&oacute; nguồn gốc kiểm định r&otilde; r&agrave;ng.<br /><br />Từ những quả trứng tươi chọn lọc cho đến l&uacute;a m&igrave; nhập khẩu 100% từ Mỹ, tất cả tạo n&ecirc;n chiếc b&aacute;nh Orion custas mịn m&agrave;n, ngọt ng&agrave;o v&agrave; hấp dẫn.&nbsp;<br /><img class=\"lazy initial loaded\" src=\"https://cdn.tgdd.vn/Products/Images//3358/77008/bhx/files/001%20(9).jpg\" alt=\"B&aacute;nh custas kem trứng 2\" data-src=\"//cdn.tgdd.vn/Products/Images//3358/77008/bhx/files/001%20(9).jpg\" data-was-processed=\"true\" />\r\n<h2>Th&ecirc;m 10% kem trứng, cho trải nghiệm trọn vẹn hơn</h2>\r\nQua thời gian d&agrave;i t&igrave;m hiểu khẩu vị của người Việt Nam, Custas nay đ&atilde; cho ra đời chiếc b&aacute;nh b&ocirc;ng lanh th&ecirc;m 10% nh&acirc;n kem trứng b&ecirc;n trong, cho trải nghiệm vị gi&aacute;c ho&agrave;n hảo hơn, mười ph&acirc;n vẹn mười.&nbsp;<br /><img class=\"lazy initial loaded\" src=\"https://cdn.tgdd.vn/Products/Images//3358/77008/bhx/files/002%20(7).jpg\" alt=\"B&aacute;nh custas kem trứng 3\" data-src=\"//cdn.tgdd.vn/Products/Images//3358/77008/bhx/files/002%20(7).jpg\" data-was-processed=\"true\" />\r\n<h2>Bữa ăn nhẹ thơm ngon, hấp dẫn</h2>\r\nB&aacute;nh b&ocirc;ng lan Orion Custas l&agrave; lựa chọn tuyệt vời cho bữa ăn nhẹ mỗi ng&agrave;y. B&aacute;nh cung cấp đủ dinh dưỡng v&agrave; năng lượng gi&uacute;p bạn tho&aacute;t khỏi cơn đ&oacute;i m&agrave; vẫn thưởng thức được vị ngon của vỏ b&aacute;nh v&agrave; nh&acirc;n kem trứng.<br /><img class=\"lazy initial loaded\" src=\"https://cdn.tgdd.vn/Products/Images//3358/77008/bhx/files/003%20(5).jpg\" alt=\"B&aacute;nh custas kem trứng 4\" data-src=\"//cdn.tgdd.vn/Products/Images//3358/77008/bhx/files/003%20(5).jpg\" data-was-processed=\"true\" /></div>\r\n<div id=\"eJOY__extension_root\" class=\"eJOY__extension_root_class\" style=\"all: unset;\">&nbsp;</div>', 1, '300000', '50000', '33caa3d697.jpg'),
(106, 'Cơm sấy chà bông heo vị truyền thống Vĩnh Tiến gói 90g', 'bk-004', 60, 0, 60, 20, 19, '<ul class=\"infoproduct nospeci\">\r\n<li><span>Loại sản phẩm</span>&nbsp;\r\n<div>Cơm sấy ch&agrave; b&ocirc;ng</div>\r\n</li>\r\n<li><span>Khối lượng</span>&nbsp;\r\n<div>90g</div>\r\n</li>\r\n<li><span>Th&agrave;nh phần</span>&nbsp;\r\n<div>Gạo Jasmine 72%, ch&agrave; b&ocirc;ng thịt heo 18%, gia vị 6%, trứng 3%,...</div>\r\n</li>\r\n<li><span>C&aacute;ch d&ugrave;ng</span>&nbsp;\r\n<div>Sử dụng trực tiếp</div>\r\n</li>\r\n<li><span>Bảo quản</span>&nbsp;\r\n<div>Nơi kh&ocirc; r&aacute;o, tho&aacute;ng m&aacute;t, đảm bảo vệ sinh an to&agrave;n thực phẩm, tr&aacute;nh &aacute;nh s&aacute;ng mặt trới chiếu trực tiếp</div>\r\n</li>\r\n<li><span>Lưu &yacute;</span>&nbsp;\r\n<div>Sản phẩm c&oacute; chứa trứng v&agrave; đậu n&agrave;nh</div>\r\n</li>\r\n<li><span>Thương hiệu</span>&nbsp;\r\n<div>Vĩnh Tiến (Việt Nam)</div>\r\n</li>\r\n<li><span>Sản xuất tại</span>&nbsp;\r\n<div>Th&aacute;i Lan</div>\r\n</li>\r\n</ul>\r\n<div id=\"eJOY__extension_root\" class=\"eJOY__extension_root_class\" style=\"all: unset;\">&nbsp;</div>', 0, '0.000', '99.999', '1f91597b60.jpg'),
(107, 'Mận sấy Bakalland hộp 400g', 'bk-005', 600, 0, 600, 20, 20, '<ul class=\"infoproduct\">\r\n<li><span>Loại sản phẩm</span>&nbsp;\r\n<div>Mận sấy</div>\r\n</li>\r\n<li><span>Dạng sấy</span>&nbsp;\r\n<div>Sấy dẻo - sử dụng nhiệt độ cao (50 - 70 độ C) để l&agrave;m mất đi một phần hơi nước của sản phẩm rồi đem đi l&agrave;m m&aacute;t</div>\r\n</li>\r\n<li><span>Đặc t&iacute;nh</span>&nbsp;\r\n<div>Dẻo, mềm, hơi dai</div>\r\n</li>\r\n<li><span>Khối lượng</span>&nbsp;\r\n<div>400g</div>\r\n</li>\r\n<li><span>Th&agrave;nh phần</span>&nbsp;\r\n<div>Mận sấy kh&ocirc; 99.9%, chất bảo quản E202</div>\r\n</li>\r\n<li><span>Bảo quản</span>&nbsp;\r\n<div>Nơi kh&ocirc; r&aacute;o, tho&aacute;ng m&aacute;t, tr&aacute;nh &aacute;nh nắng</div>\r\n</li>\r\n<li><span>Thương hiệu</span>&nbsp;\r\n<div>Bakalland ()</div>\r\n</li>\r\n<li><span>Nơi sản xuất</span>&nbsp;\r\n<div>Ba Lan</div>\r\n</li>\r\n</ul>\r\n<div class=\"description   show-moreinfo\">\r\n<p>Mận chứa nhiều Vitamin C hỗ trợ cơ thể hấp thụ sắt tốt hơn, đồng thời tăng cường hệ miễn dịch. Chất chống oxy h&oacute;a v&agrave; c&aacute;c vi chất dinh dưỡng kh&aacute;c nhau. Do đ&oacute; một thương hiệu&nbsp;<a href=\"http://www.bachhoaxanh.com/trai-cay-say-bakalland\" target=\"_blank\">tr&aacute;i c&acirc;y sấy Bakalland</a>&nbsp;đến từ Balan sẽ cho bạn thưởng thức một sản phẩm đặc biệt đ&oacute; l&agrave;&nbsp;<a href=\"https://www.bachhoaxanh.com/trai-cay-say/man-say-bakalland-hop-400g\" target=\"_blank\">Mận sấy Bakalland hộp 400g&nbsp;</a>nhằm tận dụng được gi&aacute; trị dinh dưỡng trong từng tr&aacute;i mận.Quy tr&igrave;nh theo c&ocirc;ng nghệ hiện đại ti&ecirc;u chuẩn của ch&acirc;u &acirc;u v&agrave; nhập khẩu trực tiếp.<br /><a href=\"https://www.bachhoaxanh.com/trai-cay-say\" target=\"_blank\">Tr&aacute;i c&acirc;y sấy&nbsp;</a>l&agrave; một c&aacute;ch m&agrave; nh&agrave; sản xuất sử dụng để tạo ra m&oacute;n ăn tuyệt vời bởi với c&ocirc;ng thức hiện đại kh&ocirc;ng d&ugrave;ng chất phụ gia bảo quản v&agrave; kiểm so&aacute;t nghi&ecirc;m ngặt tất cả c&aacute;c kh&acirc;u chế biến gi&uacute;p quả mận giữ được m&agrave;u sắc tự nhi&ecirc;n, an to&agrave;n vệ sinh cho người d&ugrave;ng. C&aacute;c sản phẩm tr&aacute;i c&acirc;y sấy kh&ocirc;ng những ăn dẻo, ngon m&agrave; c&ograve;n cung cấp được dinh dưỡng v&agrave; năng lượng cho người sử dụng.</p>\r\n<p><img class=\"lazy initial loaded\" src=\"https://lh6.googleusercontent.com/fsFf4A4hSz58Pfl2120tiG0Ho0alnW7BLRcZXnyXMnogimvV_CiGCNGFGc53lrCJ1AuG1A2OsedeQ0BGDchkwAomNsR_CKXt-XaYo_I4y8Xp3xaR4CLXU5uZ6pgnRAC6Uspu6snf\" alt=\"\" data-src=\"https://lh6.googleusercontent.com/fsFf4A4hSz58Pfl2120tiG0Ho0alnW7BLRcZXnyXMnogimvV_CiGCNGFGc53lrCJ1AuG1A2OsedeQ0BGDchkwAomNsR_CKXt-XaYo_I4y8Xp3xaR4CLXU5uZ6pgnRAC6Uspu6snf\" data-was-processed=\"true\" /><br />Cắn mỗi miếng mận mềm dẻo, dai v&agrave; tận hưởng trong buổi tiệc c&ograve;n g&igrave; c&oacute; thể tuyệt vời hơn. Miếng mận cho hương vị chua nhẹ kh&ocirc;ng thể lẫn v&agrave;o đ&acirc;u được. Bao b&igrave; được thiết kế đẹp mắt v&agrave; hiện đại, dễ mở v&agrave; dễ sử dụng đối với mọ người.<br />Bạn c&oacute; thể tham khảo th&ecirc;m c&aacute;ch d&ugrave;ng mận sấy để tạo ra m&oacute;n ăn mới nha<a href=\"https://www.bachhoaxanh.com/kinh-nghiem-hay/kem-man-sua-chua-mat-lanh-ngay-he-1090812\" target=\"_blank\">: Kem mận sữa chua m&aacute;t lạnh ng&agrave;y h&egrave;</a></p>\r\n</div>\r\n<div id=\"eJOY__extension_root\" class=\"eJOY__extension_root_class\" style=\"all: unset;\">&nbsp;</div>', 0, '0.000', '99.999', '588b8a68ca.jpg'),
(108, 'Bánh quy bơ Danisa hộp 681g', 'bk-006', 700, 3, 697, 20, 19, '<ul class=\"infoproduct\">\r\n<li><span>Loại</span>&nbsp;\r\n<div>B&aacute;nh quy bơ (b&aacute;nh rắc đường, dừa sấy v&agrave; nho kh&ocirc;)</div>\r\n</li>\r\n<li><span>Khối lượng</span>&nbsp;\r\n<div>681g</div>\r\n</li>\r\n<li><span>Năng lượng</span>&nbsp;\r\n<div>508cal/100g</div>\r\n</li>\r\n<li><span>Th&agrave;nh phần</span>&nbsp;\r\n<div>Bột l&uacute;a m&igrave;, đường, bơ (18.67%), dầu thực vật (chứa chất chống oxy h&oacute;a tocopherol), glucose syrup, trứng, dừa sấy, nho kho, bột sữa t&aacute;ch b&eacute;o, muối, chất tạo xốp E503, hương vani tổng hợp.</div>\r\n</li>\r\n<li><span>Bảo quản</span>&nbsp;\r\n<div>Để nơi kh&ocirc; r&aacute;o, tho&aacute;ng m&aacute;t, tr&aacute;nh &aacute;nh nắng trực tiếp</div>\r\n</li>\r\n<li><span>Thương hiệu</span>&nbsp;\r\n<div>Danisa (Đan Mạch)</div>\r\n</li>\r\n<li><span>Nơi sản xuất</span>&nbsp;\r\n<div>Indonesia</div>\r\n</li>\r\n</ul>\r\n<div class=\"description   show-moreinfo\"><a name=\"B&aacute;nh quy Danisa bơ 681g\" href=\"https://www.bachhoaxanh.com/banh-quy/banh-quy-ngot-danisa-butter-cookies-bo-sua-681g\" target=\"_blank\"></a>B&aacute;nh quy Danisa bơ 681g&nbsp;được sản xuất từ c&ocirc;ng thức&nbsp;ch&iacute;nh gốc của Đan Mạch, với nguy&ecirc;n liệu được lựa chọn kỹ c&agrave;ng, tinh t&uacute;y nhất, sử dụng&nbsp;loại bơ thượng hạng gi&agrave;u hương vị g&oacute;p phần tạo n&ecirc;n sự kh&aacute;c biệt độc đ&aacute;o so với c&aacute;c d&ograve;ng b&aacute;nh quy bơ kh&aacute;c.<br /><img class=\"lazy initial loaded\" src=\"https://cdn.tgdd.vn/Products/Images//3357/90678/bhx/files/banh-quy.JPG\" alt=\"B&aacute;nh quy Danisa bơ 681g\" data-src=\"//cdn.tgdd.vn/Products/Images//3357/90678/bhx/files/banh-quy.JPG\" data-was-processed=\"true\" /><br /><br />B&aacute;nh quy bơ Danisa gi&ograve;n tan, thơm ngon, cung cấp nhiều năng lượng, protein v&agrave; một số vitamin, l&agrave; sự lựa chọn ho&agrave;n hảo cho ng&agrave;y mới đầy năng lượng.<br /><br />Hộp&nbsp;<a name=\"B&aacute;nh quy Danisa\" href=\"https://www.bachhoaxanh.com/banh-quy-danisa\" target=\"_blank\"></a>B&aacute;nh quy Danisa&nbsp;được l&agrave;m từ thiếc sang trọng, thiết kế theo phong c&aacute;ch ho&agrave;ng gia sẽ l&agrave; m&oacute;n qu&agrave; tuyệt vời d&agrave;nh cho người th&acirc;n, bạn b&egrave;.</div>\r\n<div id=\"eJOY__extension_root\" class=\"eJOY__extension_root_class\" style=\"all: unset;\">&nbsp;</div>', 1, '300000', '195121', 'a708dfe4b6.jpg'),
(109, 'Lốc 6 hũ phô mai sữa chua Kids Mix hoa quả Premium 50g', 'ddk-001', 500, 0, 500, 21, 20, '<ul class=\"infoproduct\">\r\n<li><span>Loại sản ph&acirc;̉m</span>&nbsp;\r\n<div>Ph&ocirc; mai sữa chua Hoa quả</div>\r\n</li>\r\n<li><span>Kh&ocirc;́i lượng</span>&nbsp;\r\n<div>50g/hộp</div>\r\n</li>\r\n<li><span>Thành ph&acirc;̀n</span>&nbsp;\r\n<div>Pho m&aacute;t, sữa chua &iacute;t b&eacute;o, đường, nước hoa quả nghiền c&ocirc; đặc, tinh bột, siro fructose, chất ổn định, nước &eacute;p t&aacute;o c&ocirc; đặc,...</div>\r\n</li>\r\n<li><span>Bảo quản</span>&nbsp;\r\n<div>Bảo quản lạnh ở nhi&ecirc;̣t đ&ocirc;̣ 6 - 8 đ&ocirc;̣ C</div>\r\n</li>\r\n<li><span>Thương hi&ecirc;̣u</span>&nbsp;\r\n<div>Kids Mix ()</div>\r\n</li>\r\n<li><span>Nơi sản xu&acirc;́t</span>&nbsp;\r\n<div>Đức</div>\r\n</li>\r\n</ul>\r\n<div class=\"description   show-moreinfo\">\r\n<p><a href=\"https://www.bachhoaxanh.com/sua-chua-an\" target=\"_blank\">Sữa chua</a>&nbsp;l&agrave; một loại thực phẩm l&ecirc;n men rất tốt cho hoạt động của hệ ti&ecirc;u h&oacute;a con người. Trong đa dạng sự lựa chọn, người ti&ecirc;u d&ugrave;ng vẫn tin tưởng v&agrave;o chất lượng của&nbsp;<a href=\"https://www.bachhoaxanh.com/sua-chua-an-kids-mix\" target=\"_blank\">Kids Mix</a>&nbsp;cũng như sản phẩm&nbsp;<a href=\"https://www.bachhoaxanh.com/sua-chua-an/loc-6-hu-pho-mai-sua-chua-hoa-qua-kids-mix-premium-50g\" target=\"_blank\">Lốc 6 hũ ph&ocirc; mai sữa chua Kids Mix hoa quả Premium 50g</a>&nbsp;với hương vị thơm ngon v&agrave; độc đ&aacute;o.</p>\r\n<p><img class=\"lazy initial loaded\" src=\"https://lh5.googleusercontent.com/Blon5bw7mETylZTIP-sSVpaeVlFFkxQR-to44mFOSbCnwkMeafQooEK4NrtDF6r1LDGqtFF6UFBpEFfLuIyiMP5oBLyPQc19Kd-EiB2Fi39-GSLH6wHFO9gsNDxQpAeAdJYwMf-E\" alt=\"\" data-src=\"https://lh5.googleusercontent.com/Blon5bw7mETylZTIP-sSVpaeVlFFkxQR-to44mFOSbCnwkMeafQooEK4NrtDF6r1LDGqtFF6UFBpEFfLuIyiMP5oBLyPQc19Kd-EiB2Fi39-GSLH6wHFO9gsNDxQpAeAdJYwMf-E\" data-was-processed=\"true\" /></p>\r\n<h2><span>B&iacute; quyết ngon khỏe mỗi ng&agrave;y</span></h2>\r\n<p>Sản phẩm c&oacute; qu&aacute; tr&igrave;nh&nbsp;<strong>l&ecirc;n men tự nhi&ecirc;n, kh&ocirc;ng sử dụng chất bảo quản</strong>. Hỗ trợ ti&ecirc;u h&oacute;a v&agrave; gi&uacute;p hấp thu dưỡng chất tốt hơn,&nbsp;<strong>bổ sung canxi &amp; vitamin cho hệ xương chắc khoẻ</strong>, cơ thể dẻo dai.</p>\r\n<h2><span>Hương vị độc đ&aacute;o</span></h2>\r\n<p>Với th&agrave;nh phần nguy&ecirc;n liệu l&agrave;&nbsp;<strong>pho m&aacute;t, sữa chua &iacute;t b&eacute;o, nước hoa quả nghiền c&ocirc; đặc,</strong>&nbsp;sản phẩm c&oacute; hương<strong>&nbsp;vị sữa chua thơm ngon truyền thống kết hợp h&agrave;i h&ograve;a với hương vị mới lạ từ tr&aacute;i c&acirc;y tươi m&aacute;t v&agrave; beo b&eacute;o của pho m&aacute;t,</strong>&nbsp;l&agrave;m h&agrave;i l&ograve;ng khẩu vị của người ti&ecirc;u d&ugrave;ng.</p>\r\n<p><img class=\"lazy initial loaded\" src=\"https://lh4.googleusercontent.com/amLSR1dH8t9mI0Jm0ap5_uiqEjKevpXYGRgSgb0uJ8uTLMDGFmA8oy9tnov2rEaw_WA-WxwSMbo5q8Oiw4eyLS_bTINAKOjRTDn4vNxKYViOnNAcCWs5CIW50DPgp0MJKJxJrZd2\" alt=\"\" data-src=\"https://lh4.googleusercontent.com/amLSR1dH8t9mI0Jm0ap5_uiqEjKevpXYGRgSgb0uJ8uTLMDGFmA8oy9tnov2rEaw_WA-WxwSMbo5q8Oiw4eyLS_bTINAKOjRTDn4vNxKYViOnNAcCWs5CIW50DPgp0MJKJxJrZd2\" data-was-processed=\"true\" /></p>\r\n<h2><span>C&ocirc;ng dụng tuyệt vời</span></h2>\r\n<p><a href=\"https://www.bachhoaxanh.com/kinh-nghiem-hay/an-sua-chua-hang-ngay-co-tot-khong-1032221\" target=\"_blank\">T&aacute;c dụng của sữa chua c&oacute; thể kể đến v&ocirc; c&ugrave;ng nhiều</a>, cụ thể, loại sản phẩm n&agrave;y c&oacute; thể:</p>\r\n<p>- Tốt cho ti&ecirc;u h&oacute;a<br />-&nbsp;Gi&uacute;p kiểm so&aacute;t c&acirc;n nặng<br />- Tăng cường hệ thống miễn dịch<br />- Trị vi&ecirc;m nhiễm v&ugrave;ng k&iacute;n<br />-&nbsp;Tẩy tế b&agrave;o chết cho da<br />-&nbsp;Gi&uacute;p chữa da ch&aacute;y nắng<br />-&nbsp;Gi&uacute;p trị th&acirc;m v&agrave; trị mụn<br /><img class=\"lazy initial loaded\" src=\"https://thammyviengangwhoo.vn/wp-content/uploads/2020/07/mat-na-sua-chua-co-tac-dung-gi-tmv-gangwhoo.jpg\" alt=\"B&iacute; Quyết&quot; Da Trắng S&aacute;ng Với Mặt Nạ Sữa Chua Kh&ocirc;ng Đường\" data-src=\"https://thammyviengangwhoo.vn/wp-content/uploads/2020/07/mat-na-sua-chua-co-tac-dung-gi-tmv-gangwhoo.jpg\" data-was-processed=\"true\" /></p>\r\n<h2>Dưỡng da hiệu quả</h2>\r\n<p>Sữa chua cũng được biết đến như một nguy&ecirc;n liệu tự nhi&ecirc;n, th&uacute;c đẩy qu&aacute; tr&igrave;nh l&agrave;m đẹp ở chị em phụ nữ. Kh&ocirc;ng chỉ ăn trực tiếp để cung cấp chất chống oxy h&oacute;a m&agrave; ph&aacute;i đẹp cũng&nbsp;<a href=\"https://www.bachhoaxanh.com/kinh-nghiem-hay/cach-duong-trang-da-voi-mat-na-sua-chua-971464\" target=\"_blank\">d&ugrave;ng sữa chua để đắp mặt nạ</a>, hoặc&nbsp;<a href=\"https://www.bachhoaxanh.com/kinh-nghiem-hay/rua-mat-bang-sua-chua-hang-ngay-co-tot-khong-1112159\" target=\"_blank\">rửa mặt trực tiếp với sữa chua</a>.</p>\r\n</div>\r\n<div id=\"eJOY__extension_root\" class=\"eJOY__extension_root_class\" style=\"all: unset;\">&nbsp;</div>', 0, '0.000', '99.999', 'de973b8c64.jpg'),
(110, 'Phô mai Teama hộp 240g (16 miếng)', 'ddk-002', 450, 0, 450, 21, 20, '<ul class=\"infoproduct nospeci\">\r\n<li><span>Loại sản ph&acirc;̉m</span>&nbsp;\r\n<div>Ph&ocirc; mai ăn</div>\r\n</li>\r\n<li><span>Kh&ocirc;́i lượng</span>&nbsp;\r\n<div>240g</div>\r\n</li>\r\n<li><span>Năng lượng</span>&nbsp;\r\n<div>257 - 314 kcal/100g</div>\r\n</li>\r\n<li><span>Khuy&ecirc;n dùng</span>&nbsp;\r\n<div>Ăn trực tiếp hoặc kết hợp với nhiều m&oacute;n ăn kh&aacute;c.&nbsp;Kh&ocirc;ng d&agrave;nh cho trẻ dưới 1 tuổi</div>\r\n</li>\r\n<li><span>Thành ph&acirc;̀n</span>&nbsp;\r\n<div>Sữa b&ograve; kh&ocirc;ng b&eacute;o tiệt tr&ugrave;ng, pho m&aacute;t, bơ, whey, muối tạo nhũ, chất l&agrave;m d&agrave;y, chất bảo quản,...</div>\r\n</li>\r\n<li><span>Bảo quản</span>&nbsp;\r\n<div>Bảo quản nơi kh&ocirc; r&aacute;o, tho&aacute;ng m&aacute;t, dưới 25 độ C</div>\r\n</li>\r\n<li><span>Thương hi&ecirc;̣u</span>&nbsp;\r\n<div>Teama</div>\r\n</li>\r\n<li><span>Nơi sản xu&acirc;́t</span>&nbsp;\r\n<div>Ai Cập</div>\r\n</li>\r\n</ul>\r\n<div id=\"eJOY__extension_root\" class=\"eJOY__extension_root_class\" style=\"all: unset;\">&nbsp;</div>', 0, '0.000', '99.999', '84c49860a4.jpg'),
(111, 'Phô mai lát Lactima Cheddar gói 200g (12 lát)', 'ddk-003', 300, 1, 299, 21, 20, '<ul class=\"infoproduct\">\r\n<li><span>Loại sản ph&acirc;̉m</span>&nbsp;\r\n<div>Ph&ocirc; mai lát</div>\r\n</li>\r\n<li><span>Kh&ocirc;́i lượng</span>&nbsp;\r\n<div>200g</div>\r\n</li>\r\n<li><span>Thành ph&acirc;̀n</span>&nbsp;\r\n<div>Ph&ocirc; mai Cheddar 50% (trong đ&oacute; Cheddar 15%), nước, bơ, sữa bột t&aacute;ch b&eacute;o, chất nhũ h&oacute;a (E331, E339, E450, E452), đạm sữa bột whey từ sữa, chất l&agrave;m đặc. H&agrave;m lượng b&eacute;o sữa t&iacute;nh theo chất kh&ocirc; 36,2%</div>\r\n</li>\r\n<li><span>Bảo quản</span>&nbsp;\r\n<div>Bảo quản từ 4 - 10 độ C</div>\r\n</li>\r\n<li><span>Thương hi&ecirc;̣u</span>&nbsp;\r\n<div>Lactima</div>\r\n</li>\r\n<li><span>Nơi sản xu&acirc;́t</span>&nbsp;\r\n<div>Ba Lan</div>\r\n</li>\r\n</ul>\r\n<div class=\"description   show-moreinfo\">\r\n<p><a href=\"https://www.bachhoaxanh.com/pho-mai-an\" target=\"_blank\">Ph&ocirc; mai</a>&nbsp;l&agrave; nguy&ecirc;n liệu quen thuộc trong nấu ăn v&agrave; l&agrave;m b&aacute;nh được ưa chuộng tr&ecirc;n thế giới.&nbsp;<a href=\"https://www.bachhoaxanh.com/pho-mai-an/pho-mai-lat-lactima-cheddar-goi-200g-12-lat\" target=\"_blank\">Ph&ocirc; mai lát Lactima Cheddar gói 200g (12 l&aacute;t)</a>&nbsp;của&nbsp;<a href=\"https://www.bachhoaxanh.com/pho-mai-an-lactima\" target=\"_blank\">Lactima</a>&nbsp;l&agrave; sản phẩm được nhiều người ti&ecirc;u d&ugrave;ng tin tưởng v&agrave; lựa chọn cho bữa ăn của gia đ&igrave;nh.</p>\r\n<p><img class=\"lazy initial loaded\" src=\"https://lh5.googleusercontent.com/d0AuY-hB2Ji4214FgFL5DW-9_cLLnvWSHwOa8fAwqmodMrAYw4-4oBzB0w2N7YETcmUPFegXn4elERn469Lt2S1oMXP4xJe3S2RzEyYtMC1VBTiHYkM23M-gsE2EgMe9lKhQdlOr\" alt=\"\" data-src=\"https://lh5.googleusercontent.com/d0AuY-hB2Ji4214FgFL5DW-9_cLLnvWSHwOa8fAwqmodMrAYw4-4oBzB0w2N7YETcmUPFegXn4elERn469Lt2S1oMXP4xJe3S2RzEyYtMC1VBTiHYkM23M-gsE2EgMe9lKhQdlOr\" data-was-processed=\"true\" /></p>\r\n<h2><span>H&agrave;m lượng dinh dưỡng cao</span></h2>\r\n<p>Theo c&aacute;c chuy&ecirc;n gia, 100 gram ph&ocirc; mai mang đến h&agrave;m lượng dinh dưỡng như sau:</p>\r\n<p>Calo: 403 kcal</p>\r\n<p>Carbohydrate: 1,3g</p>\r\n<p>Chất xơ: 0g</p>\r\n<p>Đường: 0,5g</p>\r\n<p>Chất b&eacute;o: 33,1g</p>\r\n<p>Chất b&eacute;o b&atilde;o h&ograve;a: 21,1g</p>\r\n<p>Chất b&eacute;o kh&ocirc;ng b&atilde;o h&ograve;a đơn: 9,4g</p>\r\n<p>Chất b&eacute;o kh&ocirc;ng b&atilde;o h&ograve;a đa: 0,9g</p>\r\n<p>Omega-3: 365 mg</p>\r\n<p>Omega-6: 577 mg</p>\r\n<p>Protein: 24,9g</p>\r\n<p>Đa dạng c&aacute;ch chế biến</p>\r\n<p>Ph&ocirc; mai Cheddar l&agrave; loại ph&ocirc; mai rất được mọi người y&ecirc;u th&iacute;ch, thuộc loại ph&ocirc; mai cứng, c&oacute; m&agrave;u v&agrave;ng nhạt, v&agrave;ng đậm hoặc ng&agrave; trắng, c&oacute; hương vị rất tuyệt vời, dễ d&agrave;ng kết hợp v&agrave;o bất cứ c&ocirc;ng thức nấu ăn n&agrave;o m&agrave; bạn kh&ocirc;ng thể bỏ qua.</p>\r\n<p><img class=\"lazy initial loaded\" src=\"https://lh4.googleusercontent.com/SsFfuLUSvDH1uysS_m_IyhIX4xYUb99kJaY2cbIFcS3qJGNlp05SwH6z69xmmZN5wrbgo31ZfQuym3Hhjk_LA22RJ5pGJNJLPU8iHEhXmHCwJQgIXxcz1MRXk7Vx_M7mro2Wc-Jw\" alt=\"\" data-src=\"https://lh4.googleusercontent.com/SsFfuLUSvDH1uysS_m_IyhIX4xYUb99kJaY2cbIFcS3qJGNlp05SwH6z69xmmZN5wrbgo31ZfQuym3Hhjk_LA22RJ5pGJNJLPU8iHEhXmHCwJQgIXxcz1MRXk7Vx_M7mro2Wc-Jw\" data-was-processed=\"true\" /></p>\r\n<h2><span>Tiện lợi khi sử dụng</span></h2>\r\n<p>12 l&aacute;t ph&ocirc; mai được sản xuất sẵn theo k&iacute;ch cỡ tiện dụng nhất, gi&uacute;p người ti&ecirc;u d&ugrave;ng dễ d&agrave;ng sử dụng cho nhiều m&oacute;n ăn kh&aacute;c nhau lại c&ograve;n c&oacute; gi&aacute; cả phải chăng, l&agrave; sự lựa chọn ho&agrave;n hảo d&agrave;nh cho bạn.</p>\r\n<p>M&oacute;n ngon mỗi ng&agrave;y</p>\r\n<p><a href=\"https://www.bachhoaxanh.com/kinh-nghiem-hay/phan-biet-cac-loai-pho-mai-975332\" target=\"_blank\">C&oacute; rất nhiều loại ph&ocirc; mai kh&aacute;c nhau</a>, nhưng cheddar vẫn c&oacute; một vị tr&iacute; kh&ocirc;ng nhỏ trong c&ocirc;ng thức nấu ăn của nhiều gia đ&igrave;nh, c&ugrave;ng B&aacute;ch H&oacute;a Xanh &ldquo;ngh&iacute;a&rdquo; qua c&aacute;ch chế biến m&oacute;n B&aacute;nh m&igrave; sandwich kẹp ph&ocirc; mai cheddar thơm ngon nh&eacute;:</p>\r\n<p>Nguy&ecirc;n liệu: B&aacute;nh m&igrave; sandwich: 2 l&aacute;t, bơ lạt: 30g, ph&ocirc; mai cheddar.</p>\r\n<p><img class=\"lazy initial loaded\" src=\"https://lh6.googleusercontent.com/-7abU8I7io4L43PkYawyYDfeXlH399WVh5ZeId7T6-L4NwZyncxrFSw3dydbbearsjpI9gG5dwBFR1x9X4xf09PgVKD_n6M15MJ987GDkCWoAvSN0S0-E7b9cnbMCgiTwbsDpeLw\" alt=\"\" data-src=\"https://lh6.googleusercontent.com/-7abU8I7io4L43PkYawyYDfeXlH399WVh5ZeId7T6-L4NwZyncxrFSw3dydbbearsjpI9gG5dwBFR1x9X4xf09PgVKD_n6M15MJ987GDkCWoAvSN0S0-E7b9cnbMCgiTwbsDpeLw\" data-was-processed=\"true\" /></p>\r\n<h2><span>C&aacute;ch thực hiện</span></h2>\r\n<ul>\r\n<li>\r\n<p>Cho một th&igrave;a bơ v&agrave;o trong chảo, bật bếp ở lừa vừa v&agrave; đợi bơ chảy.</p>\r\n</li>\r\n<li>\r\n<p>Phết đều phần bơ c&ograve;n lại l&ecirc;n b&aacute;nh m&igrave;, ch&uacute; &yacute; chỉ phết 1 mặt.</p>\r\n</li>\r\n<li>\r\n<p>Đặt b&aacute;nh m&igrave; v&agrave;o chảo, &uacute;p mặt b&aacute;nh m&igrave; phết bơ xuống mặt chảo, bỏ th&ecirc;m 2 l&aacute;t ph&ocirc; mai cheddar v&agrave;o.</p>\r\n</li>\r\n<li>\r\n<p>Đậy nắp chảo lại v&agrave; để b&aacute;nh m&igrave; được nướng ch&aacute;y cạnh cũng như ph&ocirc; mai c&oacute; điều kiện chảy ra.</p>\r\n</li>\r\n<li>\r\n<p>Sau 2 ph&uacute;t, th&ecirc;m l&aacute;t b&aacute;nh m&igrave; c&ograve;n lại v&agrave;o, quay mặt đ&atilde; phết bơ l&ecirc;n tr&ecirc;n v&agrave; ấn nhẹ để b&aacute;nh m&igrave; ngấm ph&ocirc; mai.</p>\r\n</li>\r\n<li>\r\n<p>Cuối c&ugrave;ng, nhẹ nh&agrave;ng lật c&aacute;c mặt b&aacute;nh m&igrave; để cả hai mặt đều được nướng v&agrave;ng ch&aacute;y cạnh.</p>\r\n</li>\r\n</ul>\r\n<p>Đợi g&igrave; nữa m&agrave; kh&ocirc;ng trổ t&agrave;i ngay c&aacute;c b&agrave; nội trợ ơi.</p>\r\n<p><img class=\"lazy initial loaded\" src=\"https://lh6.googleusercontent.com/4mMiG1JX1vvX-eOyS_WzXqIzs0cJvc0kxLPi417mwkwlAFthAjxM28BhPHUV6HKvQw_nLOkvDegg8njx8FOuIpsNeo6GR0qAyyYJG7fHpiyQPiyMJBw51APFtXRMcbUZQ5LX2D71\" alt=\"\" data-src=\"https://lh6.googleusercontent.com/4mMiG1JX1vvX-eOyS_WzXqIzs0cJvc0kxLPi417mwkwlAFthAjxM28BhPHUV6HKvQw_nLOkvDegg8njx8FOuIpsNeo6GR0qAyyYJG7fHpiyQPiyMJBw51APFtXRMcbUZQ5LX2D71\" data-was-processed=\"true\" /></p>\r\n<div>&nbsp;</div>\r\n</div>\r\n<div id=\"eJOY__extension_root\" class=\"eJOY__extension_root_class\" style=\"all: unset;\">&nbsp;</div>', 1, '0.000', '200000', '869f4baab6.jpg'),
(112, 'Kiệu ngâm chua ngọt Sông Hương hũ 370g', 'ddk-004', 600, 0, 600, 21, 18, '<ul class=\"infoproduct\">\r\n<li><span>Thương hiệu</span>&nbsp;\r\n<div>S&ocirc;ng Hương (Việt Nam)</div>\r\n</li>\r\n<li><span>Nơi sản xuất</span>&nbsp;\r\n<div>Việt Nam</div>\r\n</li>\r\n<li><span>Khối lượng</span>&nbsp;\r\n<div>370g</div>\r\n</li>\r\n<li><span>Th&agrave;nh phần</span>&nbsp;\r\n<div>Củ kiệu, giấm, nước, muối, đường, ớt, &hellip;</div>\r\n</li>\r\n<li><span>C&aacute;ch d&ugrave;ng</span>&nbsp;\r\n<div>D&ugrave;ng như đồ chua, hoặc ăn k&egrave;m với t&ocirc;m kh&ocirc;, nem chả</div>\r\n</li>\r\n<li><span>Bảo quản</span>&nbsp;\r\n<div>Nơi kh&ocirc; r&aacute;o, tho&aacute;ng m&aacute;t, đậy k&iacute;n sau khi d&ugrave;ng</div>\r\n</li>\r\n</ul>\r\n<div class=\"description   show-moreinfo\"><img class=\"lazy initial loaded\" src=\"https://cdn.tgdd.vn/Products/Images//7085/197530/bhx/files/kieungam(1).jpg\" alt=\"Kiệu ng&acirc;m ng&agrave;y tết\" data-src=\"//cdn.tgdd.vn/Products/Images//7085/197530/bhx/files/kieungam(1).jpg\" data-was-processed=\"true\" /><br />Kiệu ng&acirc;m từ l&acirc;u đ&atilde; l&agrave; m&oacute;n ăn kh&ocirc;ng thể thiếu trong ng&agrave;y Tết của người Việt. Tuy chỉ l&agrave; m&oacute;n ăn d&acirc;n d&atilde;, nhưng c&ocirc;ng đoạn chế biến lại rất c&ocirc;ng phu từ ng&acirc;m nước tro đến cắt, lột, phơi nắng,...&nbsp;<strong>Kiệu ng&acirc;m chua ngọt S&ocirc;ng Hương</strong>&nbsp;được l&agrave;m theo phương ph&aacute;p truyền thống, cho bữa cơm ng&agrave;y Tết thơm ngon tr&ograve;n vị, lại tiết kiệm thời gian chế biến.<br /><img class=\"lazy initial loaded\" src=\"https://cdn.tgdd.vn/Products/Images//7085/197530/bhx/files/sh.jpg\" alt=\"Kiệu S&ocirc;ng Hương được l&agrave;m theo phương ph&aacute;p truyền thống\" data-src=\"//cdn.tgdd.vn/Products/Images//7085/197530/bhx/files/sh.jpg\" data-was-processed=\"true\" /><br /><strong>Kiệu S&ocirc;ng Hương</strong>&nbsp;l&agrave;m từ những nguy&ecirc;n liệu tươi ngon, được tuyển chọn kỹ lưỡng, l&ecirc;n men tự nhi&ecirc;n theo phương ph&aacute;p truyền thống.<br />Củ kiệu được bao phủ bởi vị chua ngọt của nước giấm đường. Chỉ cần cắn một miếng, bạn ngay lập tức cảm nhận được từng tầng hương vị: gi&ograve;n ngọt - cay the - chua dịu - ngọt thanh h&agrave;i h&ograve;a vị gi&aacute;c.<br />Củ kiệu ăn ngon nhất l&agrave; với t&ocirc;m kh&ocirc; v&agrave; trứng bắc thảo, vừa gi&uacute;p c&acirc;n bằng hương vị của kiệu ng&acirc;m, lại t&ocirc;n l&ecirc;n vị ngọt của thịt t&ocirc;m v&agrave; vị b&ugrave;i b&eacute;o của trứng.&nbsp;</div>', 0, '0.000', '99.999', '40e07e27a6.jpg'),
(113, 'Chả quế mini C.P gói 300g', 'ddk-005', 80, 0, 80, 21, 20, '<ul class=\"infoproduct nospeci\">\r\n<li><span>Khối lượng</span>&nbsp;\r\n<div>300g</div>\r\n</li>\r\n<li><span>Th&agrave;nh phần</span>&nbsp;\r\n<div>C&aacute;, dầu cọ, bột đậu n&agrave;nh, tinh bột bắp, tỏi, h&agrave;nh l&aacute;, nước mắm, muối, đường, hạt n&ecirc;m, ti&ecirc;u.</div>\r\n</li>\r\n<li><span>C&aacute;ch d&ugrave;ng</span>&nbsp;\r\n<div>D&ugrave;ng ngay hoặc chế biến th&agrave;nh c&aacute;c m&oacute;n ăn</div>\r\n</li>\r\n<li><span>Thương hiệu</span>&nbsp;\r\n<div>C.P (Việt Nam)</div>\r\n</li>\r\n<li><span>Sản xuất tại</span>&nbsp;\r\n<div>Việt Nam</div>\r\n</li>\r\n</ul>\r\n<div id=\"eJOY__extension_root\" class=\"eJOY__extension_root_class\" style=\"all: unset;\">&nbsp;</div>', 0, '0.000', '99.999', '5a45dde96d.jpg');
INSERT INTO `tbl_product` (`productId`, `productName`, `product_code`, `productQuantity`, `product_soldout`, `product_remain`, `catId`, `brandId`, `product_desc`, `type`, `old_price`, `price`, `image`) VALUES
(114, 'Kem đánh răng Colgate ngừa sâu răng chắc khoẻ 250g', 'cscn', 400, 0, 400, 22, 20, '<ul class=\"infoproduct\">\r\n<li><span>Thương hiệu</span>&nbsp;\r\n<div>Colgate (Mỹ)</div>\r\n</li>\r\n<li><span>Sản xuất tại</span>&nbsp;\r\n<div>Việt Nam</div>\r\n</li>\r\n<li><span>C&ocirc;ng dụng</span>&nbsp;\r\n<div>Ngăn ngừa s&acirc;u răng tối đa, hơi thở thơm m&aacute;t, răng chắc khỏe</div>\r\n</li>\r\n<li><span>Hương</span>&nbsp;\r\n<div>Bạc h&agrave; the m&aacute;t</div>\r\n</li>\r\n<li><span>Khối lượng</span>&nbsp;\r\n<div>250g</div>\r\n</li>\r\n<li><span>Lưu &yacute;</span>&nbsp;\r\n<div>Trẻ dưới 6 tuổi chỉ sử dụng một lượng kem nhỏ bằng hạt đậu v&agrave; cần sự hướng dẫn của người lớn. Hạn chế nuốt. Trẻ em n&ecirc;n s&uacute;c miệng kỹ sau khi đ&aacute;nh răng</div>\r\n</li>\r\n<li><span>Bảo quản</span>&nbsp;\r\n<div>Nơi kh&ocirc; tho&aacute;ng, tr&aacute;nh &aacute;nh nắng trực tiếp</div>\r\n</li>\r\n</ul>\r\n<div class=\"description   show-moreinfo\">\r\n<p><strong>Hướng dẫn sử dụng:</strong></p>\r\n<p>Đ&aacute;nh răng sau mỗi bữa ăn hoặc theo hướng dẫn của nha sĩ.<br />D&ugrave;ng &iacute;t nhất 1g kem đ&aacute;nh răng mỗi lần.<br />Trẻ em dưới 6 tuổi chỉ sử dụng một lượng nhỏ bằng hạt đậu dưới sự hướng dẫn của người lớn.<br /><br /><strong>Bảo quản:</strong></p>\r\n<p>Bảo quản nơi kh&ocirc; r&aacute;o, tr&aacute;nh &aacute;nh s&aacute;ng trực tiếp. Đậy nắp k&iacute;n sau khi sử dụng.</p>\r\n</div>\r\n<div id=\"eJOY__extension_root\" class=\"eJOY__extension_root_class\" style=\"all: unset;\">&nbsp;</div>', 0, '999.990', '99.999', '5ca0790b33.jpg'),
(115, 'Kem đánh răng Closeup trắng răng dừa than hoạt tính 180g', 'cscn-002', 380, 4, 376, 22, 21, '<ul class=\"infoproduct\">\r\n<li><span>Thương hiệu</span>&nbsp;\r\n<div>Closeup (Anh v&agrave; H&agrave; Lan)</div>\r\n</li>\r\n<li><span>C&ocirc;ng dụng</span>&nbsp;\r\n<div>Gi&uacute;p trắng răng</div>\r\n</li>\r\n<li><span>Th&agrave;nh phần</span>&nbsp;\r\n<div>Dừa, than hoạt t&iacute;nh</div>\r\n</li>\r\n<li><span>Khối lượng</span>&nbsp;\r\n<div>180g</div>\r\n</li>\r\n<li><span>Sản xuất tại</span>&nbsp;\r\n<div>Việt Nam</div>\r\n</li>\r\n</ul>\r\n<div class=\"description   show-moreinfo\">\r\n<p><strong>Hướng dẫn sử dụng:</strong></p>\r\n<p>Đ&aacute;nh răng sau mỗi bữa ăn hoặc theo hướng dẫn của nha sĩ.<br />D&ugrave;ng &iacute;t nhất 1g kem đ&aacute;nh răng mỗi lần.<br />Trẻ em dưới 6 tuổi chỉ sử dụng một lượng nhỏ bằng hạt đậu dưới sự hướng dẫn của người lớn.<br /><br /><strong>Bảo quản:</strong></p>\r\n<p>Bảo quản nơi kh&ocirc; r&aacute;o, tr&aacute;nh &aacute;nh s&aacute;ng trực tiếp. Đậy nắp k&iacute;n sau khi sử dụng.</p>\r\n</div>\r\n<div id=\"eJOY__extension_root\" class=\"eJOY__extension_root_class\" style=\"all: unset;\">&nbsp;</div>', 1, '40000', '34000', 'fee8329a1a.jpeg'),
(116, 'Dầu gội Kerasys sạch gàu mát lạnh bạc hà 600ml', 'cscn-003', 80, 0, 80, 22, 19, '<ul class=\"infoproduct\">\r\n<li><span>Thương hiệu</span>&nbsp;\r\n<div>Kerasys (H&agrave;n Quốc)</div>\r\n</li>\r\n<li><span>Sản xuất tại</span>&nbsp;\r\n<div>H&agrave;n Quốc</div>\r\n</li>\r\n<li><span>C&ocirc;ng dụng</span>&nbsp;\r\n<div>Sạch g&agrave;u hiệu quả, mang đến cảm gi&aacute;c m&aacute;t lạnh the m&aacute;t sảng khoải cho da đầu</div>\r\n</li>\r\n<li><span>M&ugrave;i hương</span>&nbsp;\r\n<div>Bạc h&agrave;</div>\r\n</li>\r\n<li><span>Ph&ugrave; hợp với</span>&nbsp;\r\n<div>T&oacute;c g&agrave;u</div>\r\n</li>\r\n<li><span>Dung t&iacute;ch</span>&nbsp;\r\n<div>600ml</div>\r\n</li>\r\n<li><span>Hướng dẫn sử dụng</span>&nbsp;\r\n<div>Cho 1 &iacute;t dầu gội xả ra tay tạo bọt v&agrave; thoa nhẹ nh&agrave;ng l&ecirc;n t&oacute;c, sau đ&oacute; xả lại bằng nước sạch</div>\r\n</li>\r\n<li><span>Lưu &yacute;</span>&nbsp;\r\n<div>Tr&aacute;nh để sản phẩm d&iacute;nh v&agrave;o mắt. Nếu d&iacute;nh v&agrave;o mắt h&atilde;y rửa sạch với nước</div>\r\n</li>\r\n<li><span>Bảo quản</span>&nbsp;\r\n<div>Tr&aacute;nh nhiệt độ cao v&agrave; &aacute;nh nắng trực tiếp</div>\r\n</li>\r\n</ul>\r\n<div class=\"description   show-moreinfo\">\r\n<h2><a title=\"Dầu gội Kerasys\" href=\"https://www.bachhoaxanh.com/dau-goi-kerasys\" target=\"_blank\">Dầu gội Kerasys</a>&nbsp;nhập khẩu H&agrave;n Quốc</h2>\r\nSản phẩm được&nbsp;<strong>sản xuất trực tiếp từ H&agrave;n Quốc</strong>&nbsp;th&ocirc;ng qua quy tr&igrave;nh nghi&ecirc;m ngặt,&nbsp;<strong>đảm bảo an to&agrave;n sức khỏe cho người sử dụng</strong>.<br /><br /><img class=\"lazy initial loaded\" src=\"https://cdn.tgdd.vn/Products/Images//2483/223545/bhx/files/dau-goi-kerasys-sach-gau-mat-lanh-bac-ha-600ml-202006021044339997.jpg\" alt=\"\" data-src=\"//cdn.tgdd.vn/Products/Images//2483/223545/bhx/files/dau-goi-kerasys-sach-gau-mat-lanh-bac-ha-600ml-202006021044339997.jpg\" data-was-processed=\"true\" />\r\n<h2>Sạch g&agrave;u hiệu quả</h2>\r\n<p><a title=\"Dầu gội \" href=\"https://www.bachhoaxanh.com/dau-goi\" target=\"_blank\">Dầu gội&nbsp;</a><span>Kerasys Anti Dandruff</span>&nbsp;gi&uacute;p chăm s&oacute;c&nbsp;<strong>da đầu nhạy cảm, kh&ocirc; hoặc nhiều g&agrave;u</strong>. Với hệ thống chăm s&oacute;c k&eacute;p l&agrave;m giảm g&agrave;u, giữ cho da đầu sạch sẽ, tạo cảm gi&aacute;c thoải m&aacute;i cho da đầu.<br />Tham khảo:&nbsp;<a title=\"Những loại dầu gội gi&uacute;p trị dứt điểm g&agrave;u trong v&agrave;i lần gội\" href=\"https://www.bachhoaxanh.com/kinh-nghiem-hay/nhung-loai-dau-goi-giup-tri-gau-hieu-qua-981404\" target=\"_blank\">Những loại dầu gội gi&uacute;p trị dứt điểm g&agrave;u trong v&agrave;i lần gội</a>.<br /><img class=\"lazy initial loaded\" src=\"https://cdn.tgdd.vn/Products/Images//2483/223545/bhx/files/la.jpg\" alt=\"\" data-src=\"//cdn.tgdd.vn/Products/Images//2483/223545/bhx/files/la.jpg\" data-was-processed=\"true\" /></p>\r\n<h2>Hương bạc h&agrave; m&aacute;t lạnh</h2>\r\n<p>Sản phẩm với m&ugrave;i<strong>&nbsp;hương bạc h&agrave; the m&aacute;t&nbsp;</strong>mang lại cảm gi&aacute;c sảng kho&aacute;i, thư th&aacute;i khi gội<br />Xem th&ecirc;m:&nbsp;<a title=\"Sưu tầm những nguy&ecirc;n liệu v&agrave; mẹo điều trị g&agrave;u hiệu quả ngay\" href=\"http://s%C6%B0u%20t%E1%BA%A7m%20nh%E1%BB%AFng%20nguy%C3%AAn%20li%E1%BB%87u%20v%C3%A0%20m%E1%BA%B9o%20%C4%91i%E1%BB%81u%20tr%E1%BB%8B%20g%C3%A0u%20hi%E1%BB%87u%20qu%E1%BA%A3%20ngay/\" target=\"_blank\">Sưu tầm những nguy&ecirc;n liệu v&agrave; mẹo điều trị g&agrave;u hiệu quả ngay</a>.<br /><img class=\"lazy initial loaded\" src=\"https://cdn.tgdd.vn/Products/Images//2483/223543/bhx/files/nhung-sai-lam-khi-su-dung-dau-goi-collagen.jpg\" alt=\"\" data-src=\"//cdn.tgdd.vn/Products/Images//2483/223543/bhx/files/nhung-sai-lam-khi-su-dung-dau-goi-collagen.jpg\" data-was-processed=\"true\" /></p>\r\n<p><a title=\"Dầu gội Kerasys sạch g&agrave;u m&aacute;t lạnh bạc h&agrave; 600ml\" href=\"http://d%E1%BA%A7u%20g%E1%BB%99i%20kerasys%20s%E1%BA%A1ch%20g%C3%A0u%20m%C3%A1t%20l%E1%BA%A1nh%20b%E1%BA%A1c%20h%C3%A0%20600ml/\" target=\"_blank\">Dầu gội Kerasys sạch g&agrave;u m&aacute;t lạnh bạc h&agrave; 600ml</a>, sản phẩm chất lượng,&nbsp;đ&aacute;p ứng tốt nhu cầu cả gia đ&igrave;nh bạn, gi&aacute; cả phải chăng.</p>\r\n</div>\r\n<div id=\"eJOY__extension_root\" class=\"eJOY__extension_root_class\" style=\"all: unset;\">&nbsp;</div>', 0, '0.000', '99.999', '015db398df.jpg'),
(117, 'Sữa rửa mặt E100 dưa leo 100g', 'cscn-004', 500, 0, 800, 22, 20, '<ul class=\"infoproduct\">\r\n<li><span>Thương hiệu</span>&nbsp;\r\n<div>E100 (Việt Nam)</div>\r\n</li>\r\n<li><span>Sản xuất tại</span>&nbsp;\r\n<div>Việt Nam</div>\r\n</li>\r\n<li><span>Khối lượng</span>&nbsp;\r\n<div>100g</div>\r\n</li>\r\n<li><span>Độ tuổi ph&ugrave; hợp</span>&nbsp;\r\n<div>15 tuổi trở l&ecirc;n</div>\r\n</li>\r\n<li><span>Bảo quản</span>&nbsp;\r\n<div>Nơi tho&aacute;ng m&aacute;t, tr&aacute;nh nhiệt độ cao v&agrave; &aacute;nh nắng trực tiếp</div>\r\n</li>\r\n</ul>\r\n<div class=\"description   show-moreinfo\">\r\n<p><strong>Hướng dẫn sử dụng:</strong><br />L&agrave;m ướt mặt, cho một &iacute;t sữa rửa mặt v&agrave;o l&ograve;ng b&agrave;n tay, tạo bọt v&agrave; m&aacute;t-xa l&ecirc;n da mặt, tr&aacute;nh v&ugrave;ng mắt. Rửa thật sạch với nước. Th&iacute;ch hợp sử dụng hằng ng&agrave;y cho c&aacute;c loại da.<br /><strong>Bảo quản:</strong><br />Tr&aacute;nh nhiệt độ cao, &aacute;nh nắng trực tiếp.<br /><strong>Ch&uacute; &yacute;:</strong><br />Để xa tầm tay trẻ em, tr&aacute;nh tiếp x&uacute;c với mắt. Nếu d&iacute;nh v&agrave;o mắt h&atilde;y rửa ngay bằng nước sạch.</p>\r\n</div>', 0, '0.000', '99.999', 'fc54e80bd6.jpg'),
(118, 'Nước súc miệng Listerine Cool Mint 750ml', 'cscn-005', 60, 4, 66, 22, 21, '<ul class=\"infoproduct\">\r\n<li><span>Thương hiệu</span>&nbsp;\r\n<div>Listerine</div>\r\n</li>\r\n<li><span>Sản xuất tại</span>&nbsp;\r\n<div>Th&aacute;i Lan</div>\r\n</li>\r\n<li><span>C&ocirc;ng dụng</span>&nbsp;\r\n<div>Bảo vệ suốt 24 giờ, ngăn ngừa vi khuẩn g&acirc;y mảng b&aacute;m v&agrave; vi&ecirc;m nướu. L&agrave;m sạch khoang miệng gấp 6 lần so với đ&aacute;nh răng v&agrave; d&ugrave;ng chỉ nha khoa đơn thuần. C&ocirc;ng thức độc đ&aacute;o với 4 tinh dầu gi&uacute;p th&acirc;m nhập s&acirc;u b&ecirc;n trong khoang miệng ti&ecirc;u diệt vi khuẩn trong m&agrave;ng sinh học</div>\r\n</li>\r\n<li><span>Hương</span>&nbsp;\r\n<div>Bạc h&agrave;</div>\r\n</li>\r\n<li><span>Cay/kh&ocirc;ng cay</span>&nbsp;\r\n<div>Cay</div>\r\n</li>\r\n<li><span>Dung t&iacute;ch</span>&nbsp;\r\n<div>750ml</div>\r\n</li>\r\n<li><span>Hướng dẫn sử dụng</span>&nbsp;\r\n<div>Sau khi đ&aacute;nh răng, s&uacute;c miệng với 20ml trong 30 gi&acirc;y rồi nhổ đi. Sử dụng 2 lần/ng&agrave;y</div>\r\n</li>\r\n<li><span>Khuy&ecirc;n d&ugrave;ng</span>&nbsp;\r\n<div>Sử dụng h&agrave;ng ng&agrave;y</div>\r\n</li>\r\n<li><span>Lưu &yacute;</span>&nbsp;\r\n<div>Kh&ocirc;ng được nuốt. Kh&ocirc;ng d&ugrave;ng cho trẻ em dưới 12 tuổi</div>\r\n</li>\r\n</ul>\r\n<div class=\"description   show-moreinfo\">\r\n<h2>Ti&ecirc;u diệt 99,9% vi khuẩn, khoang miệng sạch hơn gấp 6&nbsp;lần</h2>\r\n<p><a title=\"Nước S&uacute;c Miệng Hương Bạc H&agrave; Listerine Cool Mint (750ml) \" href=\"https://www.bachhoaxanh.com/nuoc-suc-mieng/nsm-listerine-coolmint-750ml\" target=\"_blank\">Nước S&uacute;c Miệng Hương Bạc H&agrave; Listerine Cool Mint (750ml)</a>&nbsp;với th&agrave;nh phần đặc biệt chứa chất khử tr&ugrave;ng c&oacute; khả năng&nbsp;<strong>loại bỏ mảng b&aacute;m</strong>, vi khuẩn tr&ecirc;n răng,&nbsp;<strong>bảo vệ răng miệng suốt 24h</strong>&nbsp;với c&ocirc;ng thức kh&ocirc;ng chứa cồn, kh&ocirc;ng cay. C&ocirc;ng thức độc đ&aacute;o với 4 tinh dầu gi&uacute;p th&acirc;m nhập s&acirc;u b&ecirc;n trong khoang miệng ti&ecirc;u diệt vi khuẩn trong m&agrave;ng sinh học.</p>\r\n<img class=\"lazy initial loaded\" src=\"https://cdn.tgdd.vn/Products/Images/2490/232528/bhx/nuoc-suc-mieng-listerine-cool-mint-750ml-202012180941015835.jpg\" alt=\"Nước s&uacute;c miệng Listerine Cool Mint 750ml 1\" data-src=\"https://cdn.tgdd.vn/Products/Images/2490/232528/bhx/nuoc-suc-mieng-listerine-cool-mint-750ml-202012180941015835.jpg\" data-was-processed=\"true\" />\r\n<h2>Hơi thở thơm m&aacute;t d&agrave;i l&acirc;u</h2>\r\n<p>Sản phẩm&nbsp;<a title=\"nước s&uacute;c miệng\" href=\"https://www.bachhoaxanh.com/nuoc-suc-mieng\" target=\"_blank\">nước s&uacute;c miệng</a>&nbsp;c&oacute;&nbsp;<strong>hương bạc h&agrave; tươi m&aacute;t</strong>, gi&uacute;p hơi thở&nbsp;<strong>thơm tho</strong>&nbsp;v&agrave; mang lại cảm gi&aacute;c sảng kho&aacute;i khi sử dụng. Kh&ocirc;ng chỉ mang đến cho bạn hơi thở thơm tho m&agrave; c&ograve;n gi&uacute;p bảo vệ răng, nướu chắc khỏe,<strong>&nbsp;trắng s&aacute;ng đầy tự tin.</strong><br />Xem th&ecirc;m:&nbsp;<a title=\"Nước s&uacute;c miệng Listerine c&oacute; lợi hay c&oacute; hại\" href=\"https://www.bachhoaxanh.com/kinh-nghiem-hay/nuoc-suc-mieng-listerine-co-loi-hay-hai-1046975\" target=\"_blank\">Nước s&uacute;c miệng Listerine c&oacute; lợi hay c&oacute; hại</a>.<br /><img class=\"lazy initial loaded\" src=\"https://cdn.tgdd.vn/Products/Images/2490/232528/bhx/nuoc-suc-mieng-listerine-cool-mint-750ml-202012180941009982.jpg\" alt=\"Nước s&uacute;c miệng Listerine Cool Mint 750ml 3\" data-src=\"https://cdn.tgdd.vn/Products/Images/2490/232528/bhx/nuoc-suc-mieng-listerine-cool-mint-750ml-202012180941009982.jpg\" data-was-processed=\"true\" /><br />Nước&nbsp;<a title=\"s&uacute;c miệng Listerine\" href=\"https://www.bachhoaxanh.com/nuoc-suc-mieng-listerine\" target=\"_blank\">s&uacute;c miệng Listerine</a>&nbsp;- sản phẩm được Hiệp hội Nha khoa Th&aacute;i Lan chứng nhận v&agrave; khuy&ecirc;n d&ugrave;ng.</p>\r\n</div>\r\n<div id=\"eJOY__extension_root\" class=\"eJOY__extension_root_class\" style=\"all: unset;\">&nbsp;</div>', 1, '150000', '99000', '8e70a8e36f.jpg'),
(119, 'Cải Thìa 4KFarm túi 200-300g', 'rt-001', 300, 0, 300, 23, 19, '<h2><span style=\"font-size: 1.5em;\">Điểm kh&aacute;c biệt rau 4KFarm</span></h2>\r\n<p><img class=\"lazy initial loaded\" src=\"https://cdn.tgdd.vn/Products/Images//8784/226023/bhx/files/khacbiet4kfarm1.jpg\" alt=\"\" data-src=\"//cdn.tgdd.vn/Products/Images//8784/226023/bhx/files/khacbiet4kfarm1.jpg\" data-was-processed=\"true\" /></p>\r\n<h2><span>H&igrave;nh ảnh canh t&aacute;c tại nh&agrave; m&agrave;ng</span></h2>\r\n<p><strong><img class=\"lazy initial loaded\" src=\"https://cdn.tgdd.vn/Products/Images//8784/223839/bhx/files/1.jpg\" alt=\"\" data-src=\"//cdn.tgdd.vn/Products/Images//8784/223839/bhx/files/1.jpg\" data-was-processed=\"true\" /><br /><img class=\"lazy initial loaded\" src=\"https://cdn.tgdd.vn/Products/Images//8784/223839/bhx/files/2.jpg\" alt=\"\" data-src=\"//cdn.tgdd.vn/Products/Images//8784/223839/bhx/files/2.jpg\" data-was-processed=\"true\" /><br /><img class=\"lazy initial loaded\" src=\"https://cdn.tgdd.vn/Products/Images//8784/223839/bhx/files/3.jpg\" alt=\"\" data-src=\"//cdn.tgdd.vn/Products/Images//8784/223839/bhx/files/3.jpg\" data-was-processed=\"true\" /><br /><img class=\"lazy initial loaded\" src=\"https://cdn.tgdd.vn/Products/Images//8784/223839/bhx/files/4.jpg\" alt=\"\" data-src=\"//cdn.tgdd.vn/Products/Images//8784/223839/bhx/files/4.jpg\" data-was-processed=\"true\" /><br /><img class=\"lazy initial loaded\" src=\"https://cdn.tgdd.vn/Products/Images//8784/223839/bhx/files/5.jpg\" alt=\"\" data-src=\"//cdn.tgdd.vn/Products/Images//8784/223839/bhx/files/5.jpg\" data-was-processed=\"true\" /></strong></p>\r\n<h2><span>4KFarm l&agrave;&nbsp;ai?</span></h2>\r\n<p><a href=\"https://www.bachhoaxanh.com/rau\" target=\"_blank\">4KFarm</a>&nbsp;l&agrave; TH&Agrave;NH VI&Ecirc;N MỚI của tập đo&agrave;n Thế Giới Di Động, tiền th&acirc;n l&agrave; Vifarm.<br />Đội ngũ chuy&ecirc;n gia về n&ocirc;ng nghiệp của 4KFarm chuyển giao c&ocirc;ng nghệ v&agrave; hỗ trợ n&ocirc;ng d&acirc;n trồng rau an to&agrave;n 4 KH&Ocirc;NG v&agrave; thu mua 100% sản lượng rau an to&agrave;n n&agrave;y cung cấp độc quyền cho chuỗi B&aacute;ch H&oacute;a Xanh.<br />Xem th&ecirc;m th&ocirc;ng tin<a href=\"https://4kfarm.com/\" target=\"_blank\">&nbsp;tại đ&acirc;y</a></p>\r\n<div id=\"eJOY__extension_root\" class=\"eJOY__extension_root_class\" style=\"all: unset;\">&nbsp;</div>', 0, '0.000', '99.999', 'ba61b1d1eb.jpg'),
(120, 'Rau Muống 4KFarm túi 200-300g', 'rt-002', 400, 1, 399, 23, 20, '<h2><span>Điểm kh&aacute;c biệt rau 4KFarm</span></h2>\r\n<p><img class=\"lazy initial loaded\" src=\"https://cdn.tgdd.vn/Products/Images//8784/227419/bhx/files/khacbiet4kfarm1.jpg\" alt=\"\" data-src=\"//cdn.tgdd.vn/Products/Images//8784/227419/bhx/files/khacbiet4kfarm1.jpg\" data-was-processed=\"true\" /></p>\r\n<h2><span>H&igrave;nh ảnh canh t&aacute;c tại nh&agrave; m&agrave;ng</span></h2>\r\n<p><strong><img class=\"lazy initial loaded\" src=\"https://cdn.tgdd.vn/Products/Images//8784/223837/bhx/files/1.jpg\" alt=\"\" data-src=\"//cdn.tgdd.vn/Products/Images//8784/223837/bhx/files/1.jpg\" data-was-processed=\"true\" /><br /><img class=\"lazy initial loaded\" src=\"https://cdn.tgdd.vn/Products/Images//8784/223837/bhx/files/11.jpg\" alt=\"\" data-src=\"//cdn.tgdd.vn/Products/Images//8784/223837/bhx/files/11.jpg\" data-was-processed=\"true\" /><br /><img class=\"lazy initial loaded\" src=\"https://cdn.tgdd.vn/Products/Images//8784/223837/bhx/files/3.jpg\" alt=\"\" data-src=\"//cdn.tgdd.vn/Products/Images//8784/223837/bhx/files/3.jpg\" data-was-processed=\"true\" /><br /><img class=\"lazy initial loaded\" src=\"https://cdn.tgdd.vn/Products/Images//8784/223837/bhx/files/02.jpg\" alt=\"\" data-src=\"//cdn.tgdd.vn/Products/Images//8784/223837/bhx/files/02.jpg\" data-was-processed=\"true\" /><br /><img class=\"lazy initial loaded\" src=\"https://cdn.tgdd.vn/Products/Images//8784/223837/bhx/files/4.jpg\" alt=\"\" data-src=\"//cdn.tgdd.vn/Products/Images//8784/223837/bhx/files/4.jpg\" data-was-processed=\"true\" /></strong></p>\r\n<h2><span>4KFarm l&agrave;&nbsp;ai?</span></h2>\r\n<p><a href=\"https://www.bachhoaxanh.com/rau\" target=\"_blank\">4KFarm</a>&nbsp;l&agrave; TH&Agrave;NH VI&Ecirc;N MỚI của tập đo&agrave;n Thế Giới Di Động, tiền th&acirc;n l&agrave; Vifarm.<br />Đội ngũ chuy&ecirc;n gia về n&ocirc;ng nghiệp của 4KFarm chuyển giao c&ocirc;ng nghệ v&agrave; hỗ trợ n&ocirc;ng d&acirc;n trồng rau an to&agrave;n 4 KH&Ocirc;NG v&agrave; thu mua 100% sản lượng rau an to&agrave;n n&agrave;y cung cấp độc quyền cho chuỗi B&aacute;ch H&oacute;a Xanh.<br />Xem th&ecirc;m th&ocirc;ng tin<a href=\"https://4kfarm.com/\" target=\"_blank\">&nbsp;tại đ&acirc;y</a></p>\r\n<div id=\"eJOY__extension_root\" class=\"eJOY__extension_root_class\" style=\"all: unset;\">&nbsp;</div>', 1, '0.000', '99.999', '5a793cdee3.jpg'),
(121, 'Rau Dền 4KFarm túi 200-300g', 'rt-003', 300, 0, 300, 23, 20, '<h2><span>Điểm kh&aacute;c biệt rau 4KFarm</span></h2>\r\n<p><img class=\"lazy initial loaded\" src=\"https://cdn.tgdd.vn/Products/Images//8784/226208/bhx/files/khacbiet4kfarm1.jpg\" alt=\"\" data-src=\"//cdn.tgdd.vn/Products/Images//8784/226208/bhx/files/khacbiet4kfarm1.jpg\" data-was-processed=\"true\" /></p>\r\n<h2><span>H&igrave;nh ảnh canh t&aacute;c tại nh&agrave; m&agrave;ng</span></h2>\r\n<p><strong><img class=\"lazy initial loaded\" src=\"https://cdn.tgdd.vn/Products/Images//8784/223837/bhx/files/1.jpg\" alt=\"\" data-src=\"//cdn.tgdd.vn/Products/Images//8784/223837/bhx/files/1.jpg\" data-was-processed=\"true\" /><br /><img class=\"lazy initial loaded\" src=\"https://cdn.tgdd.vn/Products/Images//8784/223837/bhx/files/11.jpg\" alt=\"\" data-src=\"//cdn.tgdd.vn/Products/Images//8784/223837/bhx/files/11.jpg\" data-was-processed=\"true\" /><br /><img class=\"lazy initial loaded\" src=\"https://cdn.tgdd.vn/Products/Images//8784/223837/bhx/files/3.jpg\" alt=\"\" data-src=\"//cdn.tgdd.vn/Products/Images//8784/223837/bhx/files/3.jpg\" data-was-processed=\"true\" /><br /><img class=\"lazy initial loaded\" src=\"https://cdn.tgdd.vn/Products/Images//8784/223837/bhx/files/02.jpg\" alt=\"\" data-src=\"//cdn.tgdd.vn/Products/Images//8784/223837/bhx/files/02.jpg\" data-was-processed=\"true\" /><br /><img class=\"lazy initial loaded\" src=\"https://cdn.tgdd.vn/Products/Images//8784/223837/bhx/files/4.jpg\" alt=\"\" data-src=\"//cdn.tgdd.vn/Products/Images//8784/223837/bhx/files/4.jpg\" data-was-processed=\"true\" /></strong></p>\r\n<h2><span>4KFarm l&agrave;&nbsp;ai?</span></h2>\r\n<p><a href=\"https://www.bachhoaxanh.com/rau\" target=\"_blank\">4KFarm</a>&nbsp;l&agrave; TH&Agrave;NH VI&Ecirc;N MỚI của tập đo&agrave;n Thế Giới Di Động, tiền th&acirc;n l&agrave; Vifarm.<br />Đội ngũ chuy&ecirc;n gia về n&ocirc;ng nghiệp của 4KFarm chuyển giao c&ocirc;ng nghệ v&agrave; hỗ trợ n&ocirc;ng d&acirc;n trồng rau an to&agrave;n 4 KH&Ocirc;NG v&agrave; thu mua 100% sản lượng rau an to&agrave;n n&agrave;y cung cấp độc quyền cho chuỗi B&aacute;ch H&oacute;a Xanh.<br />Xem th&ecirc;m th&ocirc;ng tin<a href=\"https://4kfarm.com/\" target=\"_blank\">&nbsp;tại đ&acirc;y</a></p>\r\n<div id=\"eJOY__extension_root\" class=\"eJOY__extension_root_class\" style=\"all: unset;\">&nbsp;</div>', 0, '0.000', '99.999', '0f403f8eff.jpg'),
(122, 'Gầu bò Mỹ đông lạnh Thảo Tiên Foods khay 300g', 'rt-004', 300, 11, 539, 23, 19, '<ul class=\"infoproduct\">\r\n<li><span>C&aacute;ch d&ugrave;ng</span>&nbsp;\r\n<div>D&ugrave;ng để nấu c&aacute;c m&oacute;n ăn tuỳ th&iacute;ch. Kh&ocirc;ng t&aacute;i cấp đ&ocirc;ng sau khi đ&atilde; r&atilde; đ&ocirc;ng.</div>\r\n</li>\r\n<li><span>Th&agrave;nh phần</span>&nbsp;\r\n<div>Thịt b&ograve; Mỹ nhập khẩu 100%</div>\r\n</li>\r\n<li><span>Nhiệt độ bảo quản</span>&nbsp;\r\n<div>-18 độ C hoặc ngăn đ&aacute; tủ lạnh</div>\r\n</li>\r\n<li><span>Khối lượng</span>&nbsp;\r\n<div>300g</div>\r\n</li>\r\n<li><span>Thương hiệu</span>&nbsp;\r\n<div>Thảo Ti&ecirc;n Foods (Việt Nam)</div>\r\n</li>\r\n<li><span>Nơi sản xuất</span>&nbsp;\r\n<div>Việt Nam</div>\r\n</li>\r\n</ul>\r\n<div class=\"description   show-moreinfo\"><img class=\"lazy initial loaded\" src=\"https://cdn.tgdd.vn/Products/Images//7172/213846/bhx/files/1.png\" alt=\"Đặc t&iacute;nh gầu b&ograve; Mỹ\" data-src=\"//cdn.tgdd.vn/Products/Images//7172/213846/bhx/files/1.png\" data-was-processed=\"true\" />\r\n<div>Gầu b&ograve; được t&aacute;ch ra từ phần ức bởi một đường cắt giữa đốt sườn thứ 5 v&agrave; 6, từ g&oacute;c phải bả vai đến phần đầu ti&ecirc;n tr&ecirc;n ống khuỷu.&nbsp;Đ&acirc;y l&agrave; phần&nbsp;<a title=\"C&aacute;c loại thịt, hải sản đ&ocirc;ng lạnh c&oacute; b&aacute;n tại B&aacute;ch ho&aacute; XANH\" href=\"https://www.bachhoaxanh.com/hai-san-dong-lanh\" target=\"_blank\">thịt</a>&nbsp;c&oacute; g&acirc;n mỡ xen kẽ nhưng nhiều nạc hơn so với ba chỉ.</div>\r\n<div><img class=\"lazy initial loaded\" src=\"https://cdn.tgdd.vn/Products/Images//7172/213864/bhx/files/thit-gau-bo.png\" alt=\"Vị tr&iacute; gầu b&ograve;\" data-src=\"//cdn.tgdd.vn/Products/Images//7172/213864/bhx/files/thit-gau-bo.png\" data-was-processed=\"true\" /></div>\r\n<div>Thịt g&acirc;̀u bò thuộc ph&acirc;̀n cơ hoạt đ&ocirc;̣ng chính của con bò. Khi b&ograve; ăn v&agrave; nhai th&igrave; to&agrave;n bộ phần thịt ở ức được vận động l&agrave;m cho v&ugrave;ng thịt n&agrave;y c&oacute; kết cấu chắc, thớ thịt r&otilde; r&agrave;ng, vị thịt mềm ngọt tự nhi&ecirc;n.&nbsp;</div>\r\n<br /><img class=\"lazy initial loaded\" src=\"https://cdn.tgdd.vn/Products/Images//7172/213846/bhx/files/2.png\" alt=\"C&aacute;ch chế biến gầu b&ograve; ngon nhất\" data-src=\"//cdn.tgdd.vn/Products/Images//7172/213846/bhx/files/2.png\" data-was-processed=\"true\" /><br />Thịt gầu b&ograve; rất gi&agrave;u dinh dưỡng v&agrave; dễ chế biến. Đặc biệt với&nbsp;<a title=\"Thịt b&ograve; nhập khẩu Mỹ Thảo Ti&ecirc;n\" href=\"https://www.bachhoaxanh.com/hai-san-dong-lanh-thao-tien-foods\" target=\"_blank\">Mỹ Thảo Ti&ecirc;n Foods</a>, thịt&nbsp;được th&aacute;i bằng m&aacute;y trong m&ocirc;i trường lạnh, cho ra những l&aacute;t thịt với độ mỏng l&yacute; tưởng để kh&ocirc;ng bị qu&aacute; dai nhưng cũng kh&ocirc;ng bị r&atilde; thớ thịt khi nấu.<br /><img class=\"lazy initial loaded\" src=\"https://cdn.tgdd.vn/Products/Images//7172/213846/bhx/files/gau-bo-nuong.jpg\" alt=\"Gầu b&ograve; nướng \" data-src=\"//cdn.tgdd.vn/Products/Images//7172/213846/bhx/files/gau-bo-nuong.jpg\" data-was-processed=\"true\" /><img class=\"lazy initial loaded\" src=\"https://cdn.tgdd.vn/Products/Images//7172/213846/bhx/files/gau-bo(1).gif\" alt=\"Gầu b&ograve; nướng\" data-src=\"//cdn.tgdd.vn/Products/Images//7172/213846/bhx/files/gau-bo(1).gif\" data-was-processed=\"true\" />\r\n<div>Ướp gầu b&ograve;&nbsp;với&nbsp;<a title=\"C&aacute;c loại gia vị cơ bản\" href=\"https://www.bachhoaxanh.com/duong-hat-nem-bot-ngot-muoi\" target=\"_blank\">gia vị</a>&nbsp;hoặc&nbsp;<a title=\"C&aacute;c loại sốt ướp thịt nướng tiện dụng c&oacute; b&aacute;n tại B&aacute;ch h&oacute;a XANH\" href=\"https://www.bachhoaxanh.com/gia-vi-tam-uop-gia-vi-uop-thit-nuong\" target=\"_blank\">sốt ướp thịt nướng</a>, đặt miếng thịt tr&ecirc;n bếp than hoa v&agrave; tận hưởng hương thơm lan tỏa&nbsp;khi miếng thịt vừa ch&iacute;n tới. Từng miếng thịt mềm ngọt, thơm ngậy, kh&ocirc;ng kh&ocirc; cũng kh&ocirc;ng ngấy.<br /><img class=\"lazy initial loaded\" src=\"https://cdn.tgdd.vn/Products/Images//7172/213846/bhx/files/pho-gau.png\" alt=\"\" data-src=\"//cdn.tgdd.vn/Products/Images//7172/213846/bhx/files/pho-gau.png\" data-was-processed=\"true\" /><img class=\"lazy initial loaded\" src=\"https://cdn.tgdd.vn/Products/Images//7172/213846/bhx/files/lau-gau-bo.jpg\" alt=\"\" data-src=\"//cdn.tgdd.vn/Products/Images//7172/213846/bhx/files/lau-gau-bo.jpg\" data-was-processed=\"true\" /><br />Cầu kỳ hơn, bạn c&oacute; thể d&ugrave;ng gầu b&ograve; để nấu phở - một m&oacute;n ăn&nbsp;quen thuộc trong ẩm thực của người Việt. Vị thịt thơm ngậy, từng miếng tan trong miệng h&ograve;a c&ugrave;ng nước d&ugrave;ng&nbsp;thanh ngọt quyến rũ. Hoặc d&ugrave;ng thịt nh&uacute;ng lẩu để mang đến hương vị tươi mới, kết hợp vị ngọt tự nhi&ecirc;n của thịt v&agrave; nước lẩu chua cay hấp dẫn, khiến bạn kh&ocirc;ng thể ngừng đũa.</div>\r\n</div>\r\n<div id=\"eJOY__extension_root\" class=\"eJOY__extension_root_class\" style=\"all: unset;\">&nbsp;</div>', 1, '0.000', '99.999', '2014acab32.jpg'),
(123, 'Cá lóc sống khay 500g', 'rt-005', 600, 0, 600, 23, 18, '<p>Kh&ocirc;ng c&oacute; th&ocirc;ng tin về sản phẩm</p>\r\n<div id=\"eJOY__extension_root\" class=\"eJOY__extension_root_class\" style=\"all: unset;\">&nbsp;</div>', 0, '0.000', '99.999', '12bcb423c3.jpg'),
(124, 'Tôm thẻ khay 300g', 'rt-006', 340, 0, 340, 23, 18, '<ul class=\"infoproduct\">\r\n<li><span>Loại sản phẩm</span>&nbsp;\r\n<div>T&ocirc;m thẻ</div>\r\n</li>\r\n<li><span>Khối lượng</span>&nbsp;\r\n<div>300g</div>\r\n</li>\r\n<li><span>Đ&oacute;ng g&oacute;i</span>&nbsp;\r\n<div>H&uacute;t ch&acirc;n kh&ocirc;ng</div>\r\n</li>\r\n<li><span>Bảo quản</span>&nbsp;\r\n<div>4 ng&agrave;y kể từ ng&agrave;y đ&oacute;ng g&oacute;i (nhiệt độ từ 2 - 5 độ C)</div>\r\n</li>\r\n</ul>\r\n<div class=\"description   show-moreinfo\">\r\n<p><a title=\"T&ocirc;m thẻ vỉ 300g\" href=\"https://www.bachhoaxanh.com/ca-tom-muc-ech/tom-the-vi-300g\" target=\"_blank\">T&ocirc;m thẻ</a>&nbsp;l&agrave;&nbsp;một m&oacute;n ăn rất được nhiều người ưa th&iacute;ch, c&oacute; kh&aacute; nhiều loại t&ocirc;m kh&aacute;c nhau như:&nbsp;T&ocirc;m thẻ&nbsp;ch&acirc;n trắng,&nbsp;t&ocirc;m thẻ&nbsp;ch&acirc;n đỏ,&nbsp;t&ocirc;m thẻ&nbsp;bạc. Loại&nbsp;<a title=\"T&ocirc;m tươi\" href=\"https://www.bachhoaxanh.com/ca-tom-muc-ech\" target=\"_blank\">t&ocirc;m</a>&nbsp;<strong>chứa rất nhiều nguồn năng lượng, dưỡng chất</strong>&nbsp;cần thiết cho cơ thể con người bao gồm: Protein, chất b&eacute;o, Kali, Vitamin B12, vitamin A, D, canxi,... Với gi&aacute; trị dinh dưỡng vượt trội rất&nbsp;<strong>hữu &iacute;ch cho qu&aacute; tr&igrave;nh ph&aacute;t triển thể chất, n&atilde;o bộ ở trẻ em</strong>. Đồng thời, tăng cường sức đề kh&aacute;ng cho người cao tuổi.&nbsp;<br /><img class=\"lazy initial loaded\" src=\"https://cdn.tgdd.vn/Products/Images/8782/226869/bhx/tom-the-khay-300g-202011141606293632.jpg\" alt=\"T&ocirc;m thẻ khay 300g 3\" data-src=\"https://cdn.tgdd.vn/Products/Images/8782/226869/bhx/tom-the-khay-300g-202011141606293632.jpg\" data-was-processed=\"true\" /></p>\r\n<h2>C&aacute;ch sơ chế t&ocirc;m thẻ</h2>\r\n- Rửa t&ocirc;m với nước sạch. Cắt bỏ phần r&acirc;u.&nbsp;<br />-&nbsp;Lột vỏ t&ocirc;m nhanh, bạn c&oacute; thể h&ograve;a tan một ch&uacute;t ph&egrave;n chua với nước rồi cho t&ocirc;m v&agrave;o ng&acirc;m một l&uacute;c.<br />- Khứa nhẹ nh&agrave;ng t&aacute;ch lấy phần chỉ đen ở lưng t&ocirc;m.<br />- Tẩm ướt&nbsp;<a title=\"Gia vị n&ecirc;m sẵn\" href=\"https://www.bachhoaxanh.com/gia-vi-nem-san\" target=\"_blank\">gia vị</a>&nbsp;khi nấu ngon hơn.<br /><img class=\"lazy initial loaded\" src=\"https://cdn.tgdd.vn/Products/Images/8782/226869/bhx/tom-the-khay-300g-202011141606304789.jpg\" alt=\"T&ocirc;m thẻ khay 300g 5\" data-src=\"https://cdn.tgdd.vn/Products/Images/8782/226869/bhx/tom-the-khay-300g-202011141606304789.jpg\" data-was-processed=\"true\" />\r\n<h2>M&oacute;n ăn ngon với t&ocirc;m thẻ</h2>\r\n- T&ocirc;m thẻ hấp&nbsp;<a title=\"Bia\" href=\"https://www.bachhoaxanh.com/bia\" target=\"_blank\">bia</a>&nbsp;sả.<br />-&nbsp;<a title=\"T&ocirc;m luộc b&igrave;nh thường xưa rồi, t&ocirc;m luộc nước dừa mới chuẩn ngon\" href=\"https://www.bachhoaxanh.com/kinh-nghiem-hay/tom-luoc-binh-thuong-xua-roi-tom-luoc-nuoc-dua-moi-chuan-ngon-1175546\" target=\"_blank\">T&ocirc;m thẻ luộc nước dừa.</a><br />- Một số m&oacute;n canh gi&uacute;p ngọt nước, t&ocirc;m x&agrave;o&nbsp;<a title=\"Củ quả tươi\" href=\"https://www.bachhoaxanh.com/cu\" target=\"_blank\">rau củ</a>,...<br /><strong>Lưu &yacute;:&nbsp;</strong>Sản phẩm nhận được c&oacute; thể kh&aacute;c với h&igrave;nh ảnh về m&agrave;u sắc v&agrave; số lượng nhưng vẫn đảm bảo về mặt khối lượng v&agrave; chất lượng.</div>\r\n<div id=\"eJOY__extension_root\" class=\"eJOY__extension_root_class\" style=\"all: unset;\">&nbsp;</div>', 1, '0.000', '99.999', 'e33668a757.png');

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
  `creation_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `start_date` datetime NOT NULL,
  `end_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `tbl_promotions`
--

INSERT INTO `tbl_promotions` (`promotionsId`, `promotionsCode`, `promotionsName`, `description`, `condition`, `discountMoney`, `creation_date`, `start_date`, `end_date`) VALUES
(1, 'tanhoang', 'Khuyến mãi khai trương', 'Mừng ngày khai trương khuến mãi 20.000đ cho đơn tối thiểu 40.000đ', '50000', '5000', '2021-08-25 06:47:58', '2021-08-25 07:01:34', '2021-08-29 18:01:34'),
(5, 'navy', 'Khuyến mãi cuối tuần', 'd', '100000', '30000', '2021-07-02 08:27:07', '2021-06-28 12:05:32', '2021-06-28 12:05:32');

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
(22, 's1', 'af1c35fd6c.jpg', 1),
(23, 's2', '430e4023a8.jpg', 1),
(24, 's3', '3a713fcd56.jpg', 0),
(25, 's4', '99457b8c38.jpg', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_warehouse`
--

CREATE TABLE `tbl_warehouse` (
  `id_warehouse` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `inport_quantity` int(11) NOT NULL,
  `inport_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `tbl_warehouse`
--

INSERT INTO `tbl_warehouse` (`id_warehouse`, `product_id`, `inport_quantity`, `inport_date`) VALUES
(8, 122, 150, '2021-02-23 01:40:19'),
(9, 117, 300, '2021-02-23 03:45:34'),
(10, 118, 10, '2021-02-23 03:45:43'),
(11, 122, 100, '2021-02-23 03:45:59');

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
(791, 118, 6),
(794, 102, 6),
(798, 99, 6),
(799, 98, 6),
(800, 33, 6),
(801, 108, 28),
(802, 102, 28),
(803, 111, 28),
(804, 118, 28),
(838, 108, 6),
(839, 111, 6);

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
  MODIFY `address_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=321;

--
-- AUTO_INCREMENT cho bảng `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `adminId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `tbl_brand`
--
ALTER TABLE `tbl_brand`
  MODIFY `brandId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT cho bảng `tbl_cart`
--
ALTER TABLE `tbl_cart`
  MODIFY `cartId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=146;

--
-- AUTO_INCREMENT cho bảng `tbl_category`
--
ALTER TABLE `tbl_category`
  MODIFY `catId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT cho bảng `tbl_customer`
--
ALTER TABLE `tbl_customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT cho bảng `tbl_order`
--
ALTER TABLE `tbl_order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=792;

--
-- AUTO_INCREMENT cho bảng `tbl_priceshipping`
--
ALTER TABLE `tbl_priceshipping`
  MODIFY `priceshippingId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `tbl_product`
--
ALTER TABLE `tbl_product`
  MODIFY `productId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=126;

--
-- AUTO_INCREMENT cho bảng `tbl_promotions`
--
ALTER TABLE `tbl_promotions`
  MODIFY `promotionsId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `tbl_slider`
--
ALTER TABLE `tbl_slider`
  MODIFY `sliderId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT cho bảng `tbl_warehouse`
--
ALTER TABLE `tbl_warehouse`
  MODIFY `id_warehouse` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT cho bảng `tbl_wishlist`
--
ALTER TABLE `tbl_wishlist`
  MODIFY `wishlistId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=840;

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
