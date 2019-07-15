-- phpMyAdmin SQL Dump
-- version 4.8.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 28, 2018 at 05:44 AM
-- Server version: 10.1.32-MariaDB
-- PHP Version: 7.2.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dps`
--

-- --------------------------------------------------------

--
-- Table structure for table `ms_menu`
--

CREATE TABLE `ms_menu` (
  `idMenu` char(10) NOT NULL,
  `ekstensi` varchar(4) NOT NULL,
  `jenis` varchar(20) NOT NULL,
  `namaMenu` varchar(50) NOT NULL,
  `keterangan` text NOT NULL,
  `hargaMenu` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ms_menu`
--

INSERT INTO `ms_menu` (`idMenu`, `ekstensi`, `jenis`, `namaMenu`, `keterangan`, `hargaMenu`) VALUES
('0000000001', 'jpg', 'cakes', 'Chesse Cake With Caramel Topping', 'A sweet, soft, delicious cake with our special caramel topping. It will melts in your mouth as long as you chew it.', 30),
('0000000002', 'jpg', 'cakes', 'Black Forest Cake', 'A chocolate sponge cake coated with fresh cream, chocolate and the cherry on its top. You can taste a delightful dark chocolate through this cake.', 30),
('0000000003', 'jpg', 'cakes', 'Chesse Cake With Berry Topping', 'A very-much-like our special Cheese Cake menu but with our special addition Berry Topping that will make your tongue sway with the pleasure of this cake.', 35),
('0000000004', 'jpg', 'cakes', 'Unicorn Cupcake', 'A cute cake made from selected ingredients and processed by our professional Chef. In each bite of this cake there are seeds of taste that will make you addicted.', 45),
('0000000005', 'jpg', 'cakes', 'Lamington Sponge Cake', 'A cake made from squares of sponge cake coated in a brown outer layer. You can feel an unbearable sensation when eating this cake.', 30),
('0000000006', 'jpg', 'cakes', 'Piggy Cake', 'This delicious piggy character cake is favorite for children because of its unparalleled delights. It\'s made with ingredients that guarantee health.', 30),
('0000000007', 'jpg', 'cakes', 'Tiramisu Cup', 'This cake is one of our customers\' favorite dessert because of its small and cute shape and taste so captivating that many in the likes of many people', 45),
('0000000008', 'jpg', 'icecream', 'Vanila Ice Cream', 'An ice cream made of cream, sugar, and vanilla from our best choice. In tastes perfectly so as to create a smooth consistency of ice cream is very delicious.', 20),
('0000000009', 'jpg', 'icecream', 'Tiramisu Gelato', 'A gelato made of milk, sugar, egg yolks, and water. Surely you can request with the reduction or addition of toppings that certainly make you more addicted.', 40),
('0000000010', 'jpg', 'icecream', 'Strawberry Ice Cream', 'Who does not like the strawberry ice cream? :> It\'s an ice cream flavoured with strawberry jam made from organic fruit without preservatives.', 20),
('0000000011', 'jpg', 'icecream', 'Dorayaki Ice Cream', 'This meal becomes one of our favorite desserts in this Restaurant. This delicious flavor of cake added with fresh ice cream makes you more relaxed.', 50),
('0000000012', 'jpg', 'icecream', 'Chocolate Ice Cream', 'An ice cream consist of dark chocolate that melts deliciously in your mouth. No one doesn\'t like chocolate, does it?', 20),
('0000000013', 'jpg', 'icecream', '3 Flavors Ice Cream', 'You should feel the sensation when eating three flavors of ice cream into one. Taste of vanilla, chocolate, and strawberry mix into one that makes your day more shine.', 25),
('0000000014', 'jpg', 'salad', 'Fruit Salad', 'For those of you who are on a diet program, this menu are perfect for you. This restaurant provides a fresh fruit salad from organic fruits without preservatives.', 30),
('0000000015', 'jpg', 'salad', 'Mango Pudding', 'This mango pudding becomes one of the favorite menu in this restaurant. The mixture of mangoes in the manufacture of puddings and a unique presentation makes you could enjoy the delicious taste of this salad.', 30),
('0000000016', 'jpg', 'salad', 'Macaroni Salad', 'The macaroni salad was made from a selection of macaroons and a delicous sauce on its topping. For you who are dieting this menu is perfect for you', 30),
('0000000017', 'jpg', 'beverages', 'Cold Matcha', 'Made from the best quality matcha. It has the right taste for matcha lovers, With the addition of ice in thid matcha makes your day more fun.', 10),
('0000000018', 'jpg', 'beverages', 'Orange Juice', 'This fresh drink is the favorite beverages in this restaurant. With the unbearable freshness and best quality orange makes you will be freshed.', 20),
('0000000019', 'jpg', 'beverages', 'Thai Tea', 'This typical Thai drink becomes the current trend beverages. We make thai tea with the best choice from Thailand that will make your tongue float when drinking it.', 15),
('0000000020', 'jpg', 'beverages', 'Strawberry Juice', 'For those of you who love strawberry, this beverages are perfectly for you. With a best and high quality organic strawberry, we provide strawberry juice that could make you more healthy.', 20),
('0000000021', 'jpg', 'beverages', 'Hot Matcha', 'Made from the best quality matcha. It has the right taste for matcha lovers. It really taste good when you drinking it in the cold weather', 10),
('0000000022', 'jpeg', 'beverages', 'Lemon Tea', 'A tea-based drink, not like tea in general. The combination of tea and lemon make this drink a favourite choice of many people. It tastes sweetly flavorful typical of tea and a bit sour.', 20),
('0000000023', 'jpeg', 'beverages', 'Milkshake Chocolate/Vanila/Strawberry', 'A cold drink of a mixture of milk, ice cream, and whipped flavored syrup. It tastes perfectly in your mouth, also could change your mood :D', 25),
('0000000024', 'jpeg', 'beverages', 'Black Coffee', 'This drink is the result of the steeped coffee beans that have been roasted and mashed into powder. Very enjoyable if in drinking with your relatives.', 15),
('0000000025', 'jpeg', 'beverages', 'White Coffee', 'White coffee is made in a way that is completely different from black coffee, that is by baking at a temperature that is not too high heat. This drink is highly recommended for those of you who have stomach acid.', 20),
('0000000026', 'jpeg', 'beverages', 'Mochacino', 'Drinks made from selected coffee with a delicious mix of chocolate and vanilla the more you can enjoy your day.', 30);

-- --------------------------------------------------------

--
-- Table structure for table `ms_pegawai`
--

CREATE TABLE `ms_pegawai` (
  `id` char(5) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `pw` varchar(50) NOT NULL,
  `jbt` char(1) NOT NULL,
  `status` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ms_pegawai`
--

INSERT INTO `ms_pegawai` (`id`, `nama`, `pw`, `jbt`, `status`) VALUES
('12345', 'Bejo', 'lorem', '1', '1'),
('25104', 'Jessica', '123', '2', '1'),
('78572', 'Richard', 'ff', '3', '1');

-- --------------------------------------------------------

--
-- Table structure for table `ms_pesanan`
--

CREATE TABLE `ms_pesanan` (
  `idPesanan` char(12) NOT NULL,
  `noMeja` varchar(3) NOT NULL,
  `status` char(1) NOT NULL,
  `tglPesan` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ms_pesanan`
--

INSERT INTO `ms_pesanan` (`idPesanan`, `noMeja`, `status`, `tglPesan`) VALUES
('201805201240', '12', '0', '2018-05-20 17:38:19'),
('20180527120', '12', '0', '2018-05-27 15:23:46'),
('201805272375', '23', '0', '2018-05-27 14:54:12'),
('201805272381', '23', '0', '2018-05-27 15:24:14'),
('2018052728', '2', '0', '2018-05-27 08:14:34'),
('20180527285', '2', '0', '2018-05-27 07:28:31'),
('20180527340', '34', '0', '2018-05-27 08:38:49'),
('201805273468', '34', '0', '2018-05-27 08:36:22'),
('20180528342', '3', '0', '2018-05-28 03:05:34'),
('20180528389', '3', '0', '2018-05-28 03:01:38');

-- --------------------------------------------------------

--
-- Table structure for table `ms_tolong`
--

CREATE TABLE `ms_tolong` (
  `idTolong` char(14) NOT NULL,
  `noMeja` varchar(2) NOT NULL,
  `status` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tr_pesanan`
--

CREATE TABLE `tr_pesanan` (
  `idPesanan` char(12) NOT NULL,
  `idMenu` char(10) NOT NULL,
  `qty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tr_pesanan`
--

INSERT INTO `tr_pesanan` (`idPesanan`, `idMenu`, `qty`) VALUES
('201805201240', '0000000001', 4),
('201805201240', '0000000002', 1),
('20180527285', '0000000001', 1),
('2018052728', '0000000001', 1),
('2018052728', '0000000002', 1),
('201805273468', '0000000001', 1),
('201805273468', '0000000003', 1),
('20180527340', '0000000001', 1),
('201805272375', '0000000001', 1),
('20180527120', '0000000001', 2),
('201805272381', '0000000002', 2),
('20180528389', '0000000002', 1),
('20180528389', '0000000009', 1),
('20180528342', '0000000002', 1),
('20180528342', '0000000009', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ms_menu`
--
ALTER TABLE `ms_menu`
  ADD PRIMARY KEY (`idMenu`);

--
-- Indexes for table `ms_pegawai`
--
ALTER TABLE `ms_pegawai`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ms_pesanan`
--
ALTER TABLE `ms_pesanan`
  ADD PRIMARY KEY (`idPesanan`);

--
-- Indexes for table `ms_tolong`
--
ALTER TABLE `ms_tolong`
  ADD PRIMARY KEY (`idTolong`);

--
-- Indexes for table `tr_pesanan`
--
ALTER TABLE `tr_pesanan`
  ADD KEY `idPesanan` (`idPesanan`),
  ADD KEY `idMenu` (`idMenu`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tr_pesanan`
--
ALTER TABLE `tr_pesanan`
  ADD CONSTRAINT `tr_pesanan_ibfk_1` FOREIGN KEY (`idMenu`) REFERENCES `ms_menu` (`idMenu`),
  ADD CONSTRAINT `tr_pesanan_ibfk_2` FOREIGN KEY (`idPesanan`) REFERENCES `ms_pesanan` (`idPesanan`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
