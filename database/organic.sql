-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th6 13, 2023 lúc 09:14 AM
-- Phiên bản máy phục vụ: 10.4.24-MariaDB
-- Phiên bản PHP: 7.4.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `organic`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_account`
--

CREATE TABLE `tbl_account` (
  `accID` int(12) NOT NULL,
  `cusUser` varchar(50) NOT NULL,
  `cusPass` varchar(25) NOT NULL,
  `level` int(10) NOT NULL,
  `cusID` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `adminID` int(11) NOT NULL,
  `adminName` varchar(255) NOT NULL,
  `adminEmail` varchar(150) NOT NULL,
  `adminUser` varchar(255) NOT NULL,
  `adminPass` varchar(255) NOT NULL,
  `level` int(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `tbl_admin`
--

INSERT INTO `tbl_admin` (`adminID`, `adminName`, `adminEmail`, `adminUser`, `adminPass`, `level`) VALUES
(1, 'manh', 'manh@gmail.com', 'suanmanh', '202cb962ac59075b964b07152d234b70', 1),
(2, 'Xuân Mạnh', 'manh8t@gmail.com', 'manh8t', '202cb962ac59075b964b07152d234b70', 3);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_bill`
--

CREATE TABLE `tbl_bill` (
  `billID` int(12) NOT NULL,
  `total` decimal(10,3) NOT NULL,
  `status` text DEFAULT NULL,
  `pttt` tinyint(1) NOT NULL COMMENT '1: thanh toán tiền mặt, 2: thanh toán thẻ, 3: shipcod',
  `cusID` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `tbl_bill`
--

INSERT INTO `tbl_bill` (`billID`, `total`, `status`, `pttt`, `cusID`) VALUES
(108, '152.000', 'Chờ xử lý', 2, 90),
(109, '225.000', 'Đã giao hàng', 1, 91),
(110, '169.000', 'Đã thanh toán', 3, 92);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_blog`
--

CREATE TABLE `tbl_blog` (
  `blogID` int(12) NOT NULL,
  `title` varchar(200) NOT NULL,
  `catID` int(11) NOT NULL,
  `blogImages` varchar(200) NOT NULL,
  `create_date` date NOT NULL,
  `description` longtext NOT NULL,
  `blogContent` mediumtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `tbl_blog`
--

INSERT INTO `tbl_blog` (`blogID`, `title`, `catID`, `blogImages`, `create_date`, `description`, `blogContent`) VALUES
(27, 'PHÁ ĐẢO SOKFARM CÙNG ORGANICFOOD TEAM', 71, 'uploads/post/Phá đảo.jpg', '2023-06-12', 'Tiếp tục hành trình khám phá nông nghiệp hữu cơ Organicfood team đã có chuyến đi ghé thăm TRANG TRẠI HẠNH PHÚC của nhà Mật Hoa Dừa Sokfarm.', '<span style=\"font-family: Roboto, sans-serif;\">\"Ở những thời điểm, trái dừa được vụ giá cao lắm, 1 khu vườn vài hecta cũng đủ nuôi cả một gia đình. Nhưng kể từ 2018, giá dừa lao dốc khiến cho nhiều gia đình phụ thuộc vào cái cây dừa rất khó khăn\".</span>'),
(30, 'Chuyến hành trình khám phá nông nghiệp hữu cơ của nhà Organicfood tại Trà Vinh', 71, 'uploads/post/Tham quan trang trại.jpg', '2023-06-12', 'Chuyến hành trình khám phá nông nghiệp hữu cơ của nhà Organicfood đã có mặt tại Trà Vinh, một tỉnh nằm giáp biển thuộc MIỀN TÂY  vs rất nhiều những sông ngòi và kênh rạch. Đặc sản nơi đây là những ngôi chùa của người Khơ Me nằm dọc trên tuyến đường nơi chúng tôi di chuyển xuống trang trại.', '<p style=\"font-family: Roboto, sans-serif;\">Sunny Farm là đối tác rất thân của nhà Organicfood đã hơn 2 năm nay. Đây cũng gần như là thời gian thành lập của trang trại. Tuy còn khá mới nhưng trang trại được định hướng làm hữu cơ ngay từ những ngày đầu khởi nghiệp.</p><p style=\"font-family: Roboto, sans-serif;\">Những sản phẩm của Sunny Farm tuy không đa dạng nhưng được trồng và kiểm soát rất nghiêm ngặt theo tiêu chuẩn hữu cơ của USDA (bộ nông nghiệp Hoa Kỳ) và Eu (Liên minh Châu Âu)&nbsp;&nbsp;từ khâu chọn giống cho đến phân bón cho rau củ quả.</p><p style=\"font-family: Roboto, sans-serif;\">Cả đoàn được đi một vòng tham quan những luống dưa leo, luống rau sắp được thu hoạch để bày bán tại 5 cửa hàng Organicfood.vn. Điều đặc biệt của làm hữu cơ mà chắc chắn các khu vườn khác không có được đó là sự tươi mát, không khí trong lành, đôi lúc chúng tôi thấy có sự xuất hiện của bướm, rẹp, thì đó là điều bình thường. Làm hữu cơ thì phải chấp nhận những gì THIÊN NHIÊN BAN TẶNG, và không dùng chất hóa học để tác động xua đuổi.<br></p>'),
(31, 'Bạn đã thử Cafe chuẩn Organic?', 58, 'uploads/post/coffee organic.jpg', '2023-06-12', 'Cà phê chuẩn Organic #USDA thì cũng có thể oder TẠI ĐÂY  🌿Cà phê Theorganikcoffee.vn được sản xuất từ những hạt cà phê hữu cơ tốt nhất với hương vị thuần khiết và chuẩn vị \"cà phê\" nhất và vẫn đảm bảo sức khỏe cho những người yêu thích cà phê trên toàn thế giới.', '<p style=\"font-family: Roboto, sans-serif;\">Muốn uống cà phê ngon, cà phê hữu cơ đầu tiên của Việt Nam thì hãy tìm đến Organicfood.vn nhé ạ.</p><p style=\"font-family: Roboto, sans-serif;\">Chúc cả nhà mình một tuần thật nhiều niềm vui!!!</p>');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_cart`
--

CREATE TABLE `tbl_cart` (
  `cartID` int(11) NOT NULL,
  `sID` varchar(255) NOT NULL,
  `productName` varchar(255) NOT NULL,
  `productID` int(11) NOT NULL,
  `price` decimal(10,3) NOT NULL,
  `quantity` int(11) NOT NULL,
  `productImages` varchar(500) NOT NULL,
  `total` decimal(10,3) NOT NULL,
  `billID` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `tbl_cart`
--

INSERT INTO `tbl_cart` (`cartID`, `sID`, `productName`, `productID`, `price`, `quantity`, `productImages`, `total`, `billID`) VALUES
(84, 'fpmcgs0ea7q4e592h4ms4s33ja', 'Khoai tây hữu cơ - 500g', 41, '57.000', 1, 'uploads/product/Khoai tây.jpg', '57.000', 108),
(85, 'fpmcgs0ea7q4e592h4ms4s33ja', 'Bơ booth org - 1kg', 51, '95.000', 1, 'uploads/product/Bơ.jpg', '95.000', 108),
(86, 'fpmcgs0ea7q4e592h4ms4s33ja', 'Bưởi da xanh hữu cơ loại 1 - 1kg', 52, '110.000', 1, 'uploads/product/Bưởi da xanh.jpg', '110.000', 109),
(87, 'fpmcgs0ea7q4e592h4ms4s33ja', 'Cá rô phi phile 450g', 45, '115.000', 1, 'uploads/product/Cá rô phi.jpg', '115.000', 109),
(88, 'fpmcgs0ea7q4e592h4ms4s33ja', 'Bưởi da xanh hữu cơ loại 1 - 1kg', 52, '110.000', 1, 'uploads/product/Bưởi da xanh.jpg', '110.000', 110),
(89, 'fpmcgs0ea7q4e592h4ms4s33ja', 'Chuối già hữu cơ - 1 pack', 54, '59.000', 1, 'uploads/product/Chuối hữu cơ.jpg', '59.000', 110);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_category`
--

CREATE TABLE `tbl_category` (
  `catID` int(11) NOT NULL,
  `catName` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `tbl_category`
--

INSERT INTO `tbl_category` (`catID`, `catName`) VALUES
(6, 'Rau củ'),
(9, 'Thịt'),
(58, 'Hoa quả'),
(71, 'Trải nghiệm'),
(73, 'Sữa');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_contact`
--

CREATE TABLE `tbl_contact` (
  `conID` int(12) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(50) NOT NULL,
  `message` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `tbl_contact`
--

INSERT INTO `tbl_contact` (`conID`, `name`, `email`, `message`) VALUES
(7, 'Nguyễn Mạnh', 'manh8t@gmail.com', 'Website xấu quá');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_customer`
--

CREATE TABLE `tbl_customer` (
  `cusID` int(12) NOT NULL,
  `firstName` text NOT NULL,
  `lastName` text NOT NULL,
  `address` varchar(255) NOT NULL,
  `city` varchar(30) NOT NULL,
  `sdt` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `note` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `tbl_customer`
--

INSERT INTO `tbl_customer` (`cusID`, `firstName`, `lastName`, `address`, `city`, `sdt`, `email`, `note`) VALUES
(88, 'Mạnh', 'Nguyễn Xuân', 'Thăng Long', 'Vinh, Nghệ An', 364494459, 'manh8t@gmail.com', 'a'),
(89, 'Mạnh', 'Nguyễn Xuân', 'Thăng Long', 'Vinh, Nghệ An', 364494459, 'manh8t@gmail.com', 'a'),
(90, 'Mạnh', 'Nguyễn Xuân', 'Thăng Long', 'Vinh, Nghệ An', 364494459, 'manh8t@gmail.com', 'a'),
(91, 'Mạnh', 'Nguyễn Xuân', 'Thăng Long', 'Vinh, Nghệ An', 364494459, 'manh8t@gmail.com', 'a'),
(92, 'Mạnh', 'Nguyễn Xuân', 'Thăng Long', 'Vinh, Nghệ An', 364494459, 'manh8t@gmail.com', 'giao vào buổi chiều nhé bro'),
(93, 'Mạnh', 'Nguyễn Xuân', 'Thăng Long', 'Vinh, Nghệ An', 364494459, 'manh8t@gmail.com', 'a');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_product`
--

CREATE TABLE `tbl_product` (
  `productID` int(11) NOT NULL,
  `productImages` varchar(500) NOT NULL,
  `productName` varchar(50) NOT NULL,
  `catID` int(11) NOT NULL,
  `price` decimal(10,3) NOT NULL,
  `type` text NOT NULL COMMENT 'Normal items, Featured item',
  `description` longtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `tbl_product`
--

INSERT INTO `tbl_product` (`productID`, `productImages`, `productName`, `catID`, `price`, `type`, `description`) VALUES
(37, 'uploads/product/Bắp cải tím.jpg', 'Bắp cải tím hữu cơ', 6, '55.000', 'Nổi bật', 'Bắp cải tím: tên khoa học là Brassica oleracea var capitata ruba là cây bắp cải có màu tím. Xuất xứ từ Địa Trung Hải, hiện nay được trồng rộng rãi khắp thế giới, thích hợp với khí hậu ôn đới và tại Việt Nam bắp cải tím được trồng nhiều ở Đà Lạt. \n• Sở dĩ bắp cải tím có màu như vậy là vì nó có hàm lượng cao polyphenol anthocyanin, chất này có tính kháng viêm, bảo vệ tế bào khỏi những tổn hại của tia cực tím và có thể giúp giảm nguy cơ mắc một số bệnh ung thư. \n• Đặc biệt, lượng vitamin C trong bắp cải tím gấp 6-8 lần so với bắp cải xanh, đồng thời chứa nhiều chất dinh dưỡng thực vật hơn bắp cải xanh. \nCách sử dụng: Bắp cải thường được chế biến bằng cách luộc, hoặc xào, làm salad, cuốn thịt hoặc làm gỏi. (Các cách chế biến tham khảo mục món ngon) \nCách bảo quản: Khi mua về mà chưa dùng, bạn không rửa bởi khi dính nước nó sẽ nhanh hỏng, hãy để trong túi nhựa và cất ở ngăn mát của tủ lạnh (được khoảng 1 tuần). Nếu dùng một lần không hết cả cái, bạn có thể giữ phần bắp cải còn lại bằng cách vẩy lên một ít nước rồi cho vào túi nhựa và cất trong tủ lạnh.'),
(38, 'uploads/product/Bắp ngọt.jpg', 'Bắp ngọt hữu cơ', 6, '44.000', 'Nổi bật', '- Xuất Xứ: Việt Nam\n- Màu sắc: Vỏ xanh trong màu vàng\n- Ngô ngọt (hay ngô đường, bắp ngọt, bắp đường) là giống ngô có hàm lượng đường cao, hương vị dân dã, quen thuộc với nhiều người.\n- Ngô ngọt là kết quả xuất hiện tự nhiên của đặc tính lặn của gen điều khiển việc chuyển đường thành tinh bột bên trong nội nhũ của hạt ngô. Trong khi các giống ngô thông thường được thu hoạch khi hạt đã chín thì ngô ngọt thường được thu hoạch khi bắp chưa chín (ở giai đoạn \"sữa\"), và thường dùng như một loại rau hơn là ngũ cốc. Đây là thực phẩm giàu năng lượng, chứa nhiều chất dinh dưỡng và vitamin, giúp tăng cường sức khỏe cho mắt, tăng cường trí nhớ, tăng cường hệ thống miễn dịch...\n+ Giàu calo Nếu trẻ bị suy dinh dưỡng hoặc bạn đang cần tăng cân gấp, hãy đưa ngô ngọt vào chế độ ăn uống thường ngày ngô ngọt cũng cung cấp nguồn năng lượng dồi dào cho sức khỏe\n+ Phòng ngừa bệnh trĩ và ung thư là loại thực phẩm giàu chất xơ, vì vậy nó rất có lợi cho tiêu hóa\n+ Nguồn vitamin dồi dào , giàu khoáng chất\n+ Chất chống oxi hóa ,bảo vệ tim\n+ Cải thiện tình trạng thiếu máu,Giảm mức cholesterol\n+ Giảm đau khớp, xương\n+ Tác dụng tốt cho bệnh nhân Alzheimer'),
(39, 'uploads/product/Bí đỏ.jpg', 'Bí đỏ hữu cơ - 1kg', 6, '85.000', 'Bình thường', 'Xuất xứ: Việt Nam Thành phần: Bí đỏ nguyên trái Hướng dẫn sử dụng: Dùng để nấu canh, soup, hấp, xào,... Hướng dẫn bảo quản: Bảo quản nơi khô ráo, thoáng mát Bí Hạt Đậu Hữu Cơ Danny Green có hình dáng giống hạt đậu, ít hạt, thịt màu vàng cam, vỏ mỏng mịn đặc biệt dẻo ngọt và đặc ruột chứa nhiều vitamin và khoáng chất thiết yếu cho cơ thể con người. Bí Hạt Đậu Hữu Cơ được canh tác theo tiêu chuẩn organic và trồng ở Tây Ninh. Bí hạt đậu ăn vị ngọt dẻo thơm, hấp hoặc nướng, ăn được cả vỏ lúc làm chín. Rất thích hợp cho trẻ em. Bí Hạt Đậu Hữu Cơ  là sản phẩm được canh tác trong nhà màng tại Farm Tây Ninh - đạt chứng nhận hữu cơ Nhật Bản JAS Trên mỗi trái bí có tem truy xuất nguồn gốc. Là nguyên liệu thơm ngon của các món ăn như soup bí đỏ, canh, bí đỏ xào hay nước ép và sữa bí đỏ. Ngoài ra loại quả này còn có thể được chế biến thành món ăn dặm bổ dưỡng cho trẻ nhỏ.'),
(40, 'uploads/product/Cà rốt.jpg', 'Cà rốt hữu cơ - 300g', 6, '40.000', 'Bình thường', 'GIỚI THIỆU SẢN PHẨM • Cà rốt là loại cây có củ, củ to ở phần đầu và nhọn ở phần đuôi, củ cà rốt thường có màu cam hoặc đỏ, phẩn ăn được thường gọi là củ nhưng thực chất đó là phần rễ của cà rốt. \r\nCÁCH SỬ DỤNG • Ai cũng biết, cà rốt là loại rau mà có mặt hầu như trong mọi món ăn vì tính bổ dưỡng, dễ chế biến và nhiều công dụng của nó. • Nếu muốn có một làn da mịn màn, tươi sáng hay một đôi mắt long lanh khỏe mạnh ta chỉ cần ép cà rốt lấy nước và dùng hằng ngày. Cà rốt được sấy nhuyễn dùng làm món ăn dặm rất bổ dưỡng cho trẻ. • Ta có thể nấu vô số món dinh dưỡng từ cà rốt ví dụ như: thịt bò nấu cà rốt, súp kem cà rốt, mì rau củ xào cà rốt, cháo cá cà rốt, hay súp cà rốt làm món khai vị .... cà rốt có mặt trên mọi món ăn như bún bò kho, hủ tíu, dùng làm kim chi hay rất nhiều các món ăn khác góp phần làm cho món ăn thêm đậm dà, thơm ngon và bổ dưỡng...   \r\nCÁCH BẢO QUẢN • Trữ cà rốt trong tủ lạnh sau khi đã cắt hết lá. Để trữ cà rốt được lâu, có thể gói cà rốt trong tấm vải và cất trong ngăn mát. Với cách này, bạn có thể bảo quản được cà rốt đến hơn 2 tuần. Không rửa hay cắt nhỏ cà rốt khi bảo quản. Chỉ nên rửa cà rốt ngay trước khi sử dụng.Không nên để cà rốt trong túi nhựa vì hơi ẩm của cà rốt sẽ thoát ra khiến cà rốt dễ héo. Tránh để cà rốt gần các trái cây khác, nó sẽ làm cà rốt mau chin. Cà rốt sẽ bị mềm khi để ngoài không khí. Nếu bị mềm, có thể làm cứng lại bằng cách ngâm vào một tô nước đá. Khi mua cà rốt về, tốt nhất là sử dụng ngay hoặc sử dụng trong vòng 1 – 2 tuần, cà rốt sẽ giữ nguyên được những chất dinh dưỡng vốn có.'),
(41, 'uploads/product/Khoai tây.jpg', 'Khoai tây hữu cơ - 500g', 6, '57.000', 'Nổi bật', '•Khoai Tây có ruột màu vàng, thân gồ ghề, củ hơi tròn, vị ngọt, dẻo/ bùi. Khoai Tây không những là một loại thực phẩm bổ dưỡng mà nó còn có tác dụng chữa bệnh khiến bạn ngạc nhiên. \r\nCÔNG DỤNG •Khoai Tây giàu Vitamin B6, BI, B2, Phốt pho, Kali, chất xơ, chất chống oxy hóa, hàm lượng Vitamin C khá cao, giàu tinh bột nhưng ít calo. •Tăng cường sức đề kháng, giảm stress, hàm lượng chống oxy hóa cao, chữa đau dạ dày, phòng chống bệnh ung thư. Và Khoai tây có thể làm mỹ phẩm mịn da, trị mụn, khít lổ chân lông..v.v.. \r\nCÁCH SỬ DỤNG • Chiên, hấp, nghiền, xào và sẽ ngon hơn khi dùng chung cà rốt, củ dền... để nấu canh súp.    \r\nLƯỢNG DÙNG • Bạn có thể sử dụng tuỳ thích vì Khoai Tây chứa ít calories và giúp bổ sung các loại vitamins và khoáng chất cần thiết cho cơ thể. \r\nCÁCH BẢO QUẢN •  Để bảo quản được lâu, Khoai Tây nên cho vào rổ để nơi khô thoáng •  Không nên rửa Khoai Tây nếu chưa dùng đến.'),
(42, 'uploads/product/Rau muống.jpg', 'Rau muống hữu cơ - 300g', 6, '28.000', 'Nổi bật', 'Rau muống hữu cơ được trồng và thu hoạch trong môi trường hoàn toàn hữu cơ, không có các chất hóa học, không sử dụng thuốc tăng trưởng, biến đổi gen,… Chắc chắn sẽ là một thực phẩm không thể thiếu trong mỗi bữa ăn hàng ngày của gia đình bạn   CÔNG DỤNG Rau muống hữu cơ chứa nhiều vitamin A, C, '),
(43, 'uploads/product/Bào ngư.jpg', 'Bào ngư tươi nhập khẩu (size 10-12) - 300g', 9, '294.000', 'Nổi bật', 'Thông tin sản phẩm đang được cập nhật'),
(44, 'uploads/product/Cá diêu hồng.jpg', 'Cá diêu hồng tự nhiên - gói 500g', 9, '115.000', 'Nổi bật', 'Cá diêu hồng còn được gọi là cá rô phi đỏ, một loài cá nước ngọt, bên ngoài phủ vảy màu đỏ hồng hoặc vàng đậm, có thịt dày và ngọt.\r\n\r\nCá diêu hồng nhận sự quan tâm, yêu thích của nhiều người bởi cá không quá nhiều xương, độ tươi ngon của phần thịt khi chế biến món ăn và giá trị dinh dưỡng mà nó đem lại.\r\n\r\nCá diêu hồng tại Organicfood.vn được nuôi tự nhiên tại hồ Trị An, Đồng Nai.'),
(45, 'uploads/product/Cá rô phi.jpg', 'Cá rô phi phile 450g', 9, '115.000', 'Bình thường', 'Cá rô phi rừng ngập mặn là loại cá có vị thanh nhẹ nên đây là một lựa chọn tuyệt vời cho những người mới tập ăn hải sản. Là một loại cá trắng đa năng, cá rô phi có thể kết hợp hoàn hảo với hầu hết các loại gia vị và nước sốt, đồng thời có thể thay thế tốt cho thịt gà trong các bữa ăn.\r\nCá rô phi có nguồn protein và chất dinh dưỡng tuyệt vời. Trong khoảng 100 gram cá rô phi chứa 26 gram protein và 128 calo. Bên cạnh đó, loài cá này còn có hàm lượng vitamin, khoáng chất, niacin, vitamin B12, phốt pho, selen và kali cao.'),
(46, 'uploads/product/Hàu nhật.jpg', 'Hàu nhật size 6-8 con/kg', 9, '395.000', 'Bình thường', 'Mô tả sản phẩm\r\nVới sản phẩm tươi sống, trọng lượng thực tế có thể chênh lệch khoảng 10%.\r\n\r\n- Nhập Khẩu Trực Tiếp Từ Nhật Bản\r\n- Được Nuôi Trong Môi Trường Hoàn Toàn Tự Nhiên Ở Những Vùng Biển Cực Sạch Của Nhật Bản\r\n- Hàu Nhật Được Nuôi Bằng Phương Pháp Hiện Đại, Được Treo Lơ Lửng Trên Dây. Chất Lượng Hàu Nhật Phụ Thuộc Rất Nhiều Vào Chất Lượng Nước Biển.\r\n- Thịt Hàu Nhật Rất Ngọt Và Rất Sạch\r\n- Được Cấp Đông Bằng Công Nghệ Proton\r\n- Bảo Quản : Trong Tủ Đông Ở - 18°C\r\n- Chế Biến: Dùng Trực Tiếp Sashimi Với Chanh Hoặc Có Thể Chế Biến Tùy Thích Nướng Phomai Hoặc Nướng Mỡ Hành,….\r\n- So Với Hàu Cùng Loại Tại Các Vùng Biển Việt Nam, Hàu Nhật Có Mùi Nhẹ Nhàng Hơn Nhiều. Vì Thế, Để Tận Hưởng Được Vị Ngọt, Mặn Đặc Trưng, Nên Hạn Chế Dùng Với Wasabi (Mù Tạt) Như Cách Thông Thường. Thay Vào Đó, Hãy Vắt Vài Giọt Chanh Và Dùng Ngay. Vị Chua Của Chanh Sẽ Trung Hoà Với Vị Mặn Của Nước Biển, Đẩy Vị Ngọt Của Thịt Hàu Lên Đúng Với Chất Lượng Của Nó.'),
(47, 'uploads/product/Lõi vai bò úc.jpg', 'Lõi vai bò úc hữu cơ obe - 300g', 9, '232.000', 'Bình thường', 'Nếu cuối tuần muốn đổi gió hoặc bạn là một người sành ăn thì không nên bỏ qua thịt bò hữu cơ OBE nhé  - 100% Bò OBE không sử dụng thuốc kháng sinh, hóc môn tăng trưởng.  - Giống bò chất lượng ngon nhất, không biến đổi gene, không sử dụng các chất kích thích.  - Bò ăn mềm, ngọt, thơm, ngậy béo....ĐẬM ĐÀ một cách tự nhiên.  - Nhập khẩu chính thức, có giấy tờ, chứng nhận ORGANIC MỸ, ÚC.  - 100% Bò được vận chuyển theo đường AIR (Máy bay)'),
(51, 'uploads/product/Bơ.jpg', 'Bơ booth org - 1kg', 58, '95.000', 'Bình thường', 'Bơ booth là loại bơ dẻo ngon mới xuất hiện tại Việt Nam vài năm gần đây. Bơ booth được yêu thích bởi thịt dẻo thơm, cùng giá trị dinh dưỡng cao mà nó mang lại.\r\nNghiên cứu gần đây cũng cho thấy khi dùng thêm bơ trong chế biến các món nước sốt, hay trộn salad sẽ giúp cơ thể thúc đẩy quá trình hấp thụ các chất dinh dưỡng khác như alpha-carotene, beta-carotene, carotenoids.'),
(52, 'uploads/product/Bưởi da xanh.jpg', 'Bưởi da xanh hữu cơ loại 1 - 1kg', 58, '110.000', 'Nổi bật', 'Bưởi da xanh tại Organic đươc chọn lựa kỹ càng từ chính nông trại của Organic, đảm bảo sạch, không hóa chất, không thuốc tăng trưởng, các chất làm biến đổi gen. Có nhiều size theo cân nặng, đáp ứng đủ các nhu cầu của khách hàng, cùi vỏ mỏng, múi to, mọng nước, ngọt thơm thanh dịu,… \r\nBưởi da xanh hữu cơ (USDA, EU) vỏ tươi xanh - bày mâm ngũ quả hoặc dâng hương ngày Tết rất sang trọng. Đặc biệt, bưởi bảo quản được lâu, sau Tết dùng khỏi sợ hư như các loại trái cây khác. Bưởi ruột hồng, tép mọng nước, vị ngọt, ăn siêu thích nhé chị em! '),
(53, 'uploads/product/Cam sành.jpg', 'Cam sành hữu cơ - 1kg', 58, '75.000', 'Bình thường', 'Cam sành hữu cơ là loại cam quen thuộc của vùng nhiệt đới Việt Nam. Quả cam sành rất dễ nhận ra nhờ lớp vỏ dày, sần sùi giống bề mặt mảnh sành, và thường có màu lục nhạt (khi chín có sắc cam), các múi thịt có màu cam. Cam sành tại Organic được chọn lựa kỹ càng từ chính nông trại của Organic được chứng nhận USDA, Organic EU, đảm bảo sạch, không hóa chất, không thuốc tăng trưởng, các chất làm biến đổi gen. Có nhiều size theo cân nặng, đáp ứng đủ các nhu cầu của khách hàng,… Cam trái to, mọng nước, vị ngọt chua thanh mát,…   \r\nCÔNG DỤNG Cam sành giàu vitamin C, vitamin A, canxi, chất xơ… rất bổ dưỡng cho cơ thể phụ nữ mang thai. Vitamin B9 (axit folic) có trong cam sành vô cùng quan trọng, đặc biệt đối với bà bầu hoặc những người đang cố gắng thụ thai. Cam sành giúp ngăn ngừa một số loại khuyết tật bẩm sinh, tăng sức đề kháng và giúp sản xuất các tế bào máu khỏe mạnh. Ngoài ra chất limonoid trong nước cam giúp ngăn ngừa bệnh ung thư và có tác dụng giải độc, lợi tiểu.   \r\nCÁCH BẢO QUẢN Bảo quản lạnh để giữ sản phẩm tươi ngon lâu hơn'),
(54, 'uploads/product/Chuối hữu cơ.jpg', 'Chuối già hữu cơ - 1 pack', 58, '59.000', 'Bình thường', '• Chuối Laba được coi là mặt hàng đặc sản của Đà Lạt – Lâm Đồng trong nhiều năm trở lại đây được nhiều người tiêu dùng trong và ngoài tỉnh ưa chuộng. Chuối có độ dẻo, mùi thơm và có vị ngọt đặc trưng. \r\n\r\nCÔNG DỤNG\r\n\r\n• Các bác sỹ của Mỹ khẳng định, một trong các món ăn bổ dưỡng nhất của loài người là trái chuối. Nhất là đối với các quý ông, chuối có tác dụng tăng hưng phấn và rút ngắn thời gian quay trở lại \"sàn đấu\". chuối không thừa chất béo nên khi ăn không làm tăng mỡ trong máu. Vì thế, chuối là món ăn bỏ túi cho người sợ tăng cân nhưng không tránh được cảm giác đói bụng. Kế đến, chuối chứa rất ít muối nên rất thích hợp cho người bệnh tim mạch.Ngoài ra, nhờ tỷ lệ hợp lý giữa magnê và canxi mà chuối có khả năng điều hoà quy trình dẫn truyền thần kinh của cơ tim. Người hay hồi hộp vì quá nhạy cảm nên thử dùng trái chuối trước khi chọn một loại thuốc mạnh nào đó.Với lượng kali dồi dào, chuối không chỉ là món ăn chống chuột rút cho người lao động nặng, vận động viên, mà còn dành cho thai phụ hay buồn nôn vì ốm nghén.Chuối là món tráng miệng không nên thiếu trên bàn ăn của người bệnh tim mạch, cụ thể là người cao huyết áp nhờ tác dụng vừa lợi tiểu nhẹ, vừa bổ sung kali cho cơ thể dễ bị thiếu hụt vì dùng thuốc lâu ngày.\r\n\r\n• Ngoài ra, nhờ dễ tiêu hoá nên chuối có thêm ưu điểm của món ăn cung cấp năng lượng nhanh khi có nhu cầu cấp bách. Ngay khi mỏi mệt, gặp lúc đường huyết hạ thấp, chỉ cần trái chuối là xong. Hơn thế nữa, chuối giúp ổn định các hằng số sinh học trong cơ thể và qua đó tạo điều kiện thuận lợi để hệ biến dưỡng hoạt động với hiệu quả tối ưu, đặc biệt ở người có pH máu không đúng độ kiềm do tiêu thụ quá nhiều thịt mỡ.\r\n\r\n \r\n\r\nCÁCH SỬ DỤNG\r\n\r\n• Chuối được ăn trực tiếp, làm nước ép hoa quả, làm chè, sinh tố, kem, chuối còn được làm nhân trong bánh tét... • Chuối Laba khá giống các loại chuối già cui, già lùn, già hương…và trong thực tế, nhiều thương lái đã trộn lẫn các loại chuối trên để bán, để nhận biết chuối Laba bạn có thể chú ý vào một số đặc điểm sau: Cây cao từ 3 – 3,2 m, eo lá và vỏ bẹ lá có màu tím, buồng dài nhiều trái, quả chuối thon, dài và hơi cong; vỏ dày và bóng, khi chín có màu vàng tươi. \r\n\r\nLƯỢNG DÙNG • An mỗi ngày một trái chuối để đủ sức kháng bệnh trong những ngày thời tiết thay đổi thất thường, hoặc lúc các cơ bị viêm nhiễm, đau nhức.\r\n\r\nCÁCH BẢO QUẢN • Đừng lột vỏ quá sớm nếu muốn tận dụng thành phần sinh học của chuối và nếu chưa dùng, nên giữ chuối ở nơi thoáng mát tự nhiên. Chuối mất hết tác dụng nếu trữ trong tủ lạnh hay ngăn đá. Nói rõ hơn, kem chuối chỉ để ngon miệng. Mua chuối cũng cần biết cách: Chuối có vỏ vàng với điểm nhỏ li ti màu nâu là chuối nên thuốc. Trái lại, chuối cho dù còn tươi nhưng trên vỏ có nhiều mảng lớn màu đen chỉ tốt cho người bán, vì không còn tác dụng dược lý cũng như dinh dưỡng.'),
(56, 'uploads/product/Dưa hấu.jpg', 'Dưa hấu có hạt hữu cơ ít hạt - 1kg', 58, '79.000', 'Bình thường', 'Dưa hấu hữu cơ trái to tròn, vỏ rất mỏng, ruột đỏ và #CỰC_KỲ_MỌNG_NƯỚC. Ăn vào khách sẽ cảm nhận vị thanh mát, ngọt nhiều nước, rất thư giãn, sảng khoái giữa thời tiết nắng nóng.\r\n\r\n🍉 ĐẶC BIỆT, hạt trong dưa hấu tại Organicfood.vn chỉ nhỏ tí xíu, các mẹ không lo các bé ăn bị nuốt phải đâu ạ\r\n\r\nĐạt chứng nhận hữu cơ EU, USDA'),
(57, 'uploads/product/Dưa lưới.jpg', 'Dưa lưới giống nhật ruột cam 1kg', 58, '135.000', 'Bình thường', 'Dưa lưới Biển Hoàng Gia - SeaRoyal được canh tác theo quy trình định hướng Organic đạt tiêu chuẩn JAS Nhật Bản khắt khe đánh giá, Dưa lưới Biển Hoàng Gia - SeaRoyal của DannyGreen cho độ ngọt thanh mà vẫn giữ được hàm lượng dinh dưỡng cao.\r\n - Xuất xứ giống: Nhật Bản. \r\n- Hình dạng: tròn đều, vỏ xanh nhạt có vân lưới nhẹ. \r\n- Bên trong: ruột cam, mềm, vị ngọt thanh. \r\n- Tiêu chuẩn/ Chứng nhận: JAS \r\n- Thời gian sử dụng: Sẵn sàng thưởng thức, bảo quản tốt hơn trong ngăn mát.  \r\n- Nhà sản xuất: Seagull ADC \r\nTheo các nhà nghiên cứu Pháp, thay đổi thói quen dùng dưa lưới mỗi ngày có thể giúp chúng ta giảm tải căng thẳng và mệt mỏi một cách hiệu quả. Lớp vỏ dày bảo vệ bên ngoài nên phần ruột bên trong luôn mọng nước (88%), hàm lượng potassium (300 mg/100g) đáng kể nên dưa lưới có tính năng thanh lọc, lợi tiểu, chất xơ (1g/100g) giúp nhuận trường, ít calories (48 Kcal), Beta- Carotene và vitamin C. \r\n1. Phòng chống ung thư: Dưa lưới là nguồn chứa chất chống oxy hóa dạng polyphenol, phòng bệnh ung thư và tăng cường hệ miễn dịch, có khả năng ngăn ngừa căn bệnh ưng thu ruột và những khối u ác tính khác. \r\n2. Tốt cho hệ tiêu hóa: Lượng Enzyme tiêu hoá trong dưa lưới nhiều hơn cả đu đủ và xoài. Ngoài ra, hàm lượng chất xơ nên có tác dụng nhuận trường và chống táo bón. \r\n3. Ngăn ngừa các bệnh liên quan đến tim mạch: Dưa lưới chứa chất chống oxy hóa dạng polyphenol có tác dụng điều tiết sự hình thành nitric oxit, một chất quan trọng đối với nội mạc và hệ tim mạch. \r\n4. Hỗ trợ làm đẹp: Dưa lưới tốt cho người giảm cân vì không chứa nhiều calories. Chúng ta có thể chế biến nhiều món ăn từ dưa lưới như các món sinh tố/ nước é, đến các món ăn vặt hoặc các ăn đậm chất Tây Âu. Đây còn là nguồn dinh dưỡng phong phú chứa nhiều beta-carotene, axit folic, kali, vitamin C, A, giúp cải thiện làn da khỏe và cải thiện thị lực. \r\n5. Giảm căng thẳng, mệt mỏi: Theo các nhà nghiêm cứu Pháp, trong dưa lưới có Enzyme Superoxyd Dismutase (SOD) giúp cải thiện tình trạng căng thẳng kéo dài về thể chất lẫn tinh thần. SOD được xem như một Enzyme mạnh hơn các vitamin chống oxy hóa khác.');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `tbl_account`
--
ALTER TABLE `tbl_account`
  ADD PRIMARY KEY (`accID`),
  ADD KEY `cusID` (`cusID`) USING BTREE;

--
-- Chỉ mục cho bảng `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`adminID`);

--
-- Chỉ mục cho bảng `tbl_bill`
--
ALTER TABLE `tbl_bill`
  ADD PRIMARY KEY (`billID`),
  ADD KEY `cusID` (`cusID`) USING BTREE;

--
-- Chỉ mục cho bảng `tbl_blog`
--
ALTER TABLE `tbl_blog`
  ADD PRIMARY KEY (`blogID`),
  ADD KEY `catID` (`catID`) USING BTREE;

--
-- Chỉ mục cho bảng `tbl_cart`
--
ALTER TABLE `tbl_cart`
  ADD PRIMARY KEY (`cartID`),
  ADD KEY `billID` (`billID`) USING BTREE,
  ADD KEY `productID` (`productID`) USING BTREE;

--
-- Chỉ mục cho bảng `tbl_category`
--
ALTER TABLE `tbl_category`
  ADD PRIMARY KEY (`catID`);

--
-- Chỉ mục cho bảng `tbl_contact`
--
ALTER TABLE `tbl_contact`
  ADD PRIMARY KEY (`conID`);

--
-- Chỉ mục cho bảng `tbl_customer`
--
ALTER TABLE `tbl_customer`
  ADD PRIMARY KEY (`cusID`);

--
-- Chỉ mục cho bảng `tbl_product`
--
ALTER TABLE `tbl_product`
  ADD PRIMARY KEY (`productID`),
  ADD KEY `catID` (`catID`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `tbl_account`
--
ALTER TABLE `tbl_account`
  MODIFY `accID` int(12) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `adminID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `tbl_bill`
--
ALTER TABLE `tbl_bill`
  MODIFY `billID` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=112;

--
-- AUTO_INCREMENT cho bảng `tbl_blog`
--
ALTER TABLE `tbl_blog`
  MODIFY `blogID` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT cho bảng `tbl_cart`
--
ALTER TABLE `tbl_cart`
  MODIFY `cartID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;

--
-- AUTO_INCREMENT cho bảng `tbl_category`
--
ALTER TABLE `tbl_category`
  MODIFY `catID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT cho bảng `tbl_contact`
--
ALTER TABLE `tbl_contact`
  MODIFY `conID` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT cho bảng `tbl_customer`
--
ALTER TABLE `tbl_customer`
  MODIFY `cusID` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=94;

--
-- AUTO_INCREMENT cho bảng `tbl_product`
--
ALTER TABLE `tbl_product`
  MODIFY `productID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=154;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `tbl_account`
--
ALTER TABLE `tbl_account`
  ADD CONSTRAINT `tbl_account_ibfk_1` FOREIGN KEY (`cusID`) REFERENCES `tbl_customer` (`cusID`);

--
-- Các ràng buộc cho bảng `tbl_bill`
--
ALTER TABLE `tbl_bill`
  ADD CONSTRAINT `tbl_bill_ibfk_1` FOREIGN KEY (`cusID`) REFERENCES `tbl_customer` (`cusID`);

--
-- Các ràng buộc cho bảng `tbl_blog`
--
ALTER TABLE `tbl_blog`
  ADD CONSTRAINT `tbl_blog_ibfk_1` FOREIGN KEY (`catID`) REFERENCES `tbl_category` (`catID`);

--
-- Các ràng buộc cho bảng `tbl_cart`
--
ALTER TABLE `tbl_cart`
  ADD CONSTRAINT `tbl_cart_ibfk_1` FOREIGN KEY (`productID`) REFERENCES `tbl_product` (`productID`),
  ADD CONSTRAINT `tbl_cart_ibfk_2` FOREIGN KEY (`billID`) REFERENCES `tbl_bill` (`billID`);

--
-- Các ràng buộc cho bảng `tbl_product`
--
ALTER TABLE `tbl_product`
  ADD CONSTRAINT `tbl_product_ibfk_1` FOREIGN KEY (`catID`) REFERENCES `tbl_category` (`catID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
