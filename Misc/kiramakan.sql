-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 17, 2023 at 11:58 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kiramakan`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `accountID` varchar(5) NOT NULL,
  `email` varchar(256) NOT NULL,
  `password` varchar(256) NOT NULL,
  `token` varchar(6) DEFAULT NULL,
  `accountType` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`accountID`, `email`, `password`, `token`, `accountType`) VALUES
('A0001', 'guest@gmail.com', '$2y$10$5M4sMHISEPYD46Oc732kVu/II/iudTm60bvM6eR6IIdNA1anUw2qi', NULL, 'Customer'),
('A0002', 'shaorencheah@gmail.com', '$2y$10$z8aOm.7TDzUfsljzzoQtFuK9Kdr4sRDdIu7aPrWh0n2t9Pwpb/FFC', NULL, 'Customer'),
('A0003', 'sushihaven@gmail.com', '$2y$10$z8aOm.7TDzUfsljzzoQtFuK9Kdr4sRDdIu7aPrWh0n2t9Pwpb/FFC', NULL, 'Restaurant'),
('A0004', 'goldenwok@gmail.com', '$2y$10$z8aOm.7TDzUfsljzzoQtFuK9Kdr4sRDdIu7aPrWh0n2t9Pwpb/FFC', NULL, 'Restaurant'),
('A0005', 'minjikitchen@gmail.com', '$2y$10$z8aOm.7TDzUfsljzzoQtFuK9Kdr4sRDdIu7aPrWh0n2t9Pwpb/FFC', NULL, 'Restaurant'),
('A0006', 'bellaitalia@gmail.com', '$2y$10$z8aOm.7TDzUfsljzzoQtFuK9Kdr4sRDdIu7aPrWh0n2t9Pwpb/FFC', NULL, 'Restaurant'),
('A0007', 'restoranpersekutuan@gmail.com', '$2y$10$z8aOm.7TDzUfsljzzoQtFuK9Kdr4sRDdIu7aPrWh0n2t9Pwpb/FFC', NULL, 'Restaurant'),
('A0008', 'phogarden@gmail.com', '$2y$10$z8aOm.7TDzUfsljzzoQtFuK9Kdr4sRDdIu7aPrWh0n2t9Pwpb/FFC', NULL, 'Restaurant'),
('A0009', 'lebistro@gmail.com', '$2y$10$z8aOm.7TDzUfsljzzoQtFuK9Kdr4sRDdIu7aPrWh0n2t9Pwpb/FFC', NULL, 'Restaurant'),
('A0010', 'therosecrown@gmail.com', '$2y$10$z8aOm.7TDzUfsljzzoQtFuK9Kdr4sRDdIu7aPrWh0n2t9Pwpb/FFC', NULL, 'Restaurant'),
('A0011', 'casadelosamigos@gmail.com', '$2y$10$z8aOm.7TDzUfsljzzoQtFuK9Kdr4sRDdIu7aPrWh0n2t9Pwpb/FFC', NULL, 'Restaurant'),
('A0012', 'moscownights@gmail.com', '$2y$10$z8aOm.7TDzUfsljzzoQtFuK9Kdr4sRDdIu7aPrWh0n2t9Pwpb/FFC', NULL, 'Restaurant');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `customerID` varchar(5) NOT NULL,
  `customerName` varchar(256) NOT NULL,
  `phoneNo` varchar(255) DEFAULT NULL,
  `accountID` varchar(5) NOT NULL,
  `balance` double(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`customerID`, `customerName`, `phoneNo`, `accountID`, `balance`) VALUES
('C0001', 'Guest', '012-3456789', 'A0001', 0.00),
('C0002', 'Cheah Shaoren', '016-3381806', 'A0002', 886.30);

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `itemID` varchar(5) NOT NULL,
  `restaurantID` varchar(5) NOT NULL,
  `itemName` varchar(100) NOT NULL,
  `category` varchar(255) NOT NULL,
  `itemDescription` longtext NOT NULL,
  `itemPrice` decimal(10,2) NOT NULL,
  `itemURL` longtext NOT NULL,
  `availability` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`itemID`, `restaurantID`, `itemName`, `category`, `itemDescription`, `itemPrice`, `itemURL`, `availability`) VALUES
('I0001', 'R0001', 'Spicy Tuna Roll', 'Meals', 'Fresh tuna mixed with spicy mayo, wrapped in seaweed and sushi rice.', '12.50', 'spicytunaroll.png', 'Available'),
	('I0002', 'R0001', 'Dragon Roll', 'Meals', 'Eel, cucumber, and avocado, topped with tobiko and eel sauce.', '16.00', 'dragonroll.png', 'Available'),
	('I0003', 'R0001', 'Salmon Nigiri', 'Meals', 'Fresh salmon on top of a small bed of sushi rice.', '5.00', 'salmonnigiri.png', 'Available'),
	('I0004', 'R0001', 'Unagi Don', 'Meals', 'Grilled eel served over rice with eel sauce, pickles, and miso soup.', '18.00', 'unagidon.png', 'Available'),
	('I0005', 'R0001', 'Sashimi Platter', 'Meals', 'Assortment of fresh fish slices served with wasabi and soy sauce.', '24.00', 'sashimiplatter.png', 'Available'),
	('I0006', 'R0001', 'Green Tea', 'Drinks', 'Traditional Japanese green tea.', '2.50', 'greentea.png', 'Available'),
	('I0007', 'R0001', 'Sake', 'Drinks', 'Japanese rice wine served hot or cold.', '8.00', 'sake.png', 'Available'),
	('I0008', 'R0001', 'Mochi Ice Cream', 'Desserts', 'A small, round ball of sweet rice cake wrapped around a ball of ice cream with various flavours.', '7.50', 'mochiicecream.png', 'Available'),
	('I0009', 'R0001', 'Dorayaki', 'Desserts', 'Two small, pancake-like patties filled with sweet red bean paste in a slightly chewy texture.', '5.00', 'dorayaki.png', 'Available'),
	('I0010', 'R0001', 'Takoyaki', 'Add-Ons', 'Five small balls of batter filled with diced octopus, tempura scraps and green onion, topped with savory sauce and mayonnaise.', '7.50', 'takoyaki.png', 'Available'),
	('I0011', 'R0002', 'Beijing Duck', 'Meals', 'Crispy roasted duck tossed with a sweet and savory sauce, served over a bed of steamed rice.', '15.00', 'beijingduck.png', 'Available'),
	('I0012', 'R0002', 'Kung Pao Chicken', 'Meals', 'Stir-fried diced chicken with peanuts, chili peppers, and vegetables in a spicy sauce, served with steamed rice.', '13.00', 'kungpaochicken.png', 'Available'),
	('I0013', 'R0002', 'Shrimp Fried Rice', 'Meals', 'Wok-fried rice with succulent shrimp, scrambled eggs, peas, and carrots.', '11.00', 'shrimpfriedrice.png', 'Available'),
	('I0014', 'R0002', 'Tomato Egg Noodle', 'Meals', 'Savory scrambled eggs and juicy tomatoes tossed with freshly made noodles.', '9.00', 'tomatoeggnoodle.png', 'Available'),
	('I0015', 'R0002', 'Hot and Sour Soup', 'Meals', 'A traditional Chinese soup with a spicy and sour flavor.', '6.00', 'hotandsoursoup.png', 'Available'),
	('I0016', 'R0002', 'Bubble Tea', 'Drinks', 'A Taiwanese tea-based drink with chewy tapioca pearls coated with brown sugar.', '8.50', 'bubbletea.png', 'Available'),
	('I0017', 'R0002', 'Jasmine Tea', 'Drinks', 'A hot pot of fragrant and delicate jasmine tea, perfect for after meal.', '7.00', 'jasminetea.png', 'Available'),
	('I0018', 'R0002', 'Rice', 'Add-Ons', 'Light and fluffy steamed white rice ready to be served freshly.', '2.00', 'rice.png', 'Available'),
	('I0019', 'R0003', 'Bibimbap', 'Meals', 'A classic Korean rice bowl topped with beef, mixed vegetables, and a fried egg.', '12.50', 'bibimbap.png', 'Available'),
	('I0020', 'R0003', 'Galbi', 'Meals', 'Marinated beef short ribs grilled to perfection and served with steamed rice and Korean side dishes.', '18.00', 'galbi.png', 'Available'),
	('I0021', 'R0003', 'Jjajangmyeon', 'Meals', 'Noodles in black bean sauce, served with chopped meat and vegetables.', '11.00', 'jjajangmyeon.png', 'Available'),
	('I0022', 'R0003', 'Kimchi Jjigae', 'Meals', 'Spicy and sour stew made with kimchi and pork belly, served with steamed rice.', '15.00', 'kimchijjigae.png', 'Available'),
	('I0023', 'R0003', 'Japchae', 'Meals', 'Stir-fried glass noodles with mixed vegetables, beef, and sesame oil.', '13.00', 'japchae.png', 'Available'),
	('I0024', 'R0003', 'Soju', 'Drinks', 'A popular Korean distilled beverage with a smooth, slightly sweet taste.', '8.00', 'soju.png', 'Available'),
	('I0025', 'R0003', 'Makgeolli', 'Drinks', 'A traditional Korean rice wine with a slightly sweet and tangy taste.', '7.00', 'makgeolli.png', 'Available'),
	('I0026', 'R0003', 'Bingsu', 'Desserts', 'A popular shaved ice dessert with sweet toppings such as red bean, fruit, or condensed milk.', '6.00', 'bingsu.png', 'Available'),
	('I0027', 'R0003', 'Hotteok', 'Desserts', 'A warm and chewy Korean pancake filled with brown sugar, cinnamon, and chopped nuts.', '6.50', 'hotteok.png', 'Available'),
	('I0028', 'R0003', 'Yakgwa', 'Desserts', 'A traditional deep-fried pastry made with honey, sesame oil, and wheat flour, often served as a snack or dessert.', '8.00', 'yakgwa.png', 'Available'),
	('I0029', 'R0003', 'Kimchi ', 'Add-Ons', 'A side dish made with fermented cabbage and radish mixed with a blend of seasonings.', '4.00', 'kimchi.png', 'Available'),
	('I0030', 'R0004', 'Margherita Pizza', 'Meals', 'A classic pizza topped with tomato sauce, mozzarella cheese, and fresh basil.', '12.50', 'margheritapizza.png', 'Available'),
	('I0031', 'R0004', 'Spaghetti Carbonara', 'Meals', 'A pasta dish made with spaghetti, pancetta, eggs, and cheese in a creamy sauce.', '13.00', 'spaghetticarbonara.png', 'Available'),
	('I0032', 'R0004', 'Spaghetti Bolognaise', 'Meals', 'A pasta dish made with spaghetti coated with tomato-based sauce with ground beef.', '13.00', 'spaghettibolognaise.png', 'Available'),
	('I0033', 'R0004', 'Veal Scallopini', 'Meals', 'Thinly sliced veal sautéed with mushrooms, capers, and white wine in a butter sauce.', '22.00', 'vealscallopini.png', 'Available'),
	('I0034', 'R0004', 'Linguine alle Vongole', 'Meals', 'Linguine pasta with fresh clams, garlic, white wine, and olive oil.', '18.00', 'linguineallevongole.png', 'Available'),
	('I0035', 'R0004', 'Negroni Cocktail', 'Drinks', 'A classic Italian cocktail made with gin, vermouth, and Campari.', '10.00', 'negronicocktail.png', 'Available'),
	('I0036', 'R0004', 'Pinot Grigio', 'Drinks', 'A light-bodied Italian white wine with crisp citrus and tropical fruit flavors.', '9.00', 'pinotgrigio.png', 'Available'),
	('I0037', 'R0004', 'Tiramisu', 'Desserts', 'Layers of mascarpone cheese, espresso-soaked ladyfingers, and cocoa powder come together in this classic Italian dessert.', '9.00', 'tiramisu.png', 'Available'),
	('I0038', 'R0004', 'Cannoli', 'Desserts', 'Crispy, fried pastry shells filled with sweet ricotta cheese and chocolate chips make for a delightful treat.', '9.00', 'cannoli.png', 'Available'),
	('I0039', 'R0004', 'Panna Cotta', 'Desserts', 'A dessert made with sweetened with thickened with gelatin and served with chocolate sauce.', '11.00', 'pannacotta.png', 'Available'),
	('I0040', 'R0004', 'Bruschetta', 'Add-Ons', 'Toasted bread rubbed with garlic and topped with diced tomatoes, basil, and olive oil.', '7.00', 'bruschetta.png', 'Available'),
	('I0041', 'R0004', 'Caprese salad', 'Add-Ons', 'Sliced tomatoes, fresh mozzarella cheese, and basil leaves drizzled with balsamic glaze.', '8.50', 'capresesalad.png', 'Available'),
	('I0042', 'R0004', 'Grilled vegetables', 'Add-Ons', 'Grilled eggplant, zucchini, bell peppers, and onions seasoned with Italian herbs and olive oil.', '8.00', 'grilledvegetables.png', 'Available'),
	('I0043', 'R0005', 'Nasi Lemak', 'Meals', 'Fragrant coconut rice served with crispy anchovies, roasted peanuts, cucumber, and spicy sambal.', '8.00', 'nasilemak.png', 'Available'),
	('I0044', 'R0005', 'Beef Rendang', 'Meals', 'Tender beef chunks slow-cooked in coconut milk and aromatic spices, served with steamed rice.', '11.00', 'beefrendang.png', 'Available'),
	('I0045', 'R0005', 'Nasi Goreng', 'Meals', 'Stir-fried rice with shrimp, chicken, egg, and a blend of fragrant spices.', '7.00', 'nasigoreng.png', 'Available'),
	('I0046', 'R0005', 'Curry Laksa', 'Meals', 'Creamy coconut curry noodle soup with shrimp, chicken, tofu, and bean sprouts.', '9.00', 'currylaksa.png', 'Available'),
	('I0047', 'R0005', 'Char Kway Teow', 'Meals', 'Stir-fried flat rice noodles with shrimp, Chinese sausage, egg, and bean sprouts.', '8.00', 'charkueyteow.png', 'Available'),
	('I0048', 'R0005', 'Teh Tarik', 'Drinks', 'Hot tea with condensed milk, frothed to perfection.', '3.50', 'tehtarik.png', 'Available'),
	('I0049', 'R0005', 'Sirap Bandung', 'Drinks', 'A refreshing pink drink made with rose syrup and evaporated milk.', '3.00', 'sirapbandung.png', 'Available'),
	('I0050', 'R0005', 'Cendol', 'Desserts', 'A sweet, icy dessert made with green pandan jelly, coconut milk, palm sugar, and shaved ice.', '5.00', 'cendol.png', 'Available'),
	('I0051', 'R0005', 'Kuih Lapis', 'Desserts', 'A layered steamed cake made with rice flour, coconut milk, and pandan leaves, often served with a sweet syrup drizzled on top.', '3.00', 'kuihlapis.png', 'Available'),
	('I0052', 'R0005', 'Ayam Goreng Berempah', 'Add-Ons', 'Deep fried chicken seasoned with various aromatic spices.', '3.00', 'ayamgorengberempah.png', 'Available'),
	('I0053', 'R0006', 'Pho Beef Noodle Soup', 'Meals', 'A flavorful Vietnamese noodle soup made with tender beef or chicken, rice noodles, and aromatic herbs and spices.', '9.00', 'phobeefnoodlesoup.png', 'Available'),
	('I0054', 'R0006', 'Bun Cha Vermicelli', 'Meals', 'A dish consisting of grilled pork meatballs served with rice noodles, fresh herbs, and a sweet and savory dipping sauce.', '11.00', 'bunchavermicelli.png', 'Available'),
	('I0055', 'R0006', 'Com Tam', 'Meals', 'A rice dish featuring grilled pork chops, shredded pork, and a fried egg served on top of a bed of broken rice.', '10.00', 'comtam.png', 'Available'),
	('I0056', 'R0006', 'Banh Mi', 'Meals', 'A popular Vietnamese sandwich filled with a variety of meats, vegetables, and condiments, served on a crusty baguette.', '7.00', 'banhmi.png', 'Available'),
	('I0057', 'R0006', 'Ca Kho To', 'Meals', 'A traditional dish of caramelized fish braised in a clay pot with a sweet and savory sauce, served with steamed rice.', '12.00', 'cakhoto.png', 'Available'),
	('I0058', 'R0006', 'Vietnamese Iced Coffee', 'Drinks', 'A strong and sweet coffee drink made with dark roasted coffee beans and sweetened condensed milk, served over ice.', '4.00', 'vietnameseicedcoffee.png', 'Available'),
	('I0059', 'R0006', 'Tra Da', 'Drinks', 'A refreshing iced tea made from loose leaf tea leaves, typically served with a wedge of lime and sugar to taste.', '4.00', 'trada.png', 'Available'),
	('I0060', 'R0007', 'Beef Bourguignon', 'Meals', 'Classic French dish made with beef stewed in red wine, onions, and mushrooms, served with mashed potatoes.', '28.00', 'beefbourguignon.png', 'Available'),
	('I0061', 'R0007', 'Coq au Vin', 'Meals', 'Chicken cooked in red wine with mushrooms, onions, and bacon, served with roasted potatoes.', '24.00', 'coqauvin.png', 'Available'),
	('I0062', 'R0007', 'Ratatouille', 'Meals', 'A traditional vegetable stew made with eggplant, bell peppers, zucchini, onions, and tomatoes, served with rice.', '22.00', 'ratatouille.png', 'Available'),
	('I0063', 'R0007', 'Boeuf à la Provençale', 'Meals', 'Slow-cooked beef in a tomato-based sauce with garlic, olives, and herbs, served with roasted vegetables.', '26.00', 'boeufàlaprovençale.png', 'Available'),
	('I0064', 'R0007', 'Escargots à la Bourguignonne', 'Meals', 'Classic French dish of snails baked with garlic butter and parsley. Served with crusty bread.', '16.00', 'escargotsàlabourguignonne.png', 'Available'),
	('I0065', 'R0007', 'Kir Royale', 'Drinks', 'A French cocktail made with crème de cassis and champagne.', '12.00', 'kirroyale.png', 'Available'),
	('I0066', 'R0007', 'French 69', 'Drinks', 'A cocktail made with gin, lemon juice, sugar and champagnwe.', '14.00', 'french69.png', 'Available'),
	('I0067', 'R0008', 'Roast beef and Yorkshire pudding', 'Meals', 'A classic British dish consisting of tender roasted beef served with a light and fluffy Yorkshire pudding.', '19.00', 'roastbeefandyorkshirepudding.png', 'Available'),
	('I0068', 'R0008', 'Fish and Chips', 'Meals', 'A quintessential British meal of crispy battered fish served with thick-cut fries and tartar sauce.', '17.00', 'fishandchips.png', 'Available'),
	('I0069', 'R0008', 'Bangers and Mash', 'Meals', 'A hearty dish of sausages and creamy mashed potatoes, served with caramelized onion gravy.', '15.00', 'bangersandmash.png', 'Available'),
	('I0070', 'R0008', "Shepherd's Pie", 'Meals', 'A dish of seasoned ground lamb or beef and vegetables, topped with mashed potatoes and baked until golden brown.', '18.00', 'shepherdspie.png', 'Available'),
	('I0071', 'R0008', 'Toad in the Hole', 'Meals', 'A traditional British dish of sausages baked in a Yorkshire pudding batter. Served with mashed potatoes and gravy.', '16.00', 'toadinthehole.png', 'Available'),
	('I0072', 'R0008', "Pimm's Cup", 'Drinks', "A refreshing British cocktail made with Pimm's No. 1, lemonade, and a variety of fruits and herbs.", '10.00', 'pimmscup.png', 'Available'),
	('I0073', 'R0008', 'Cider', 'Drinks', 'A crisp and refreshing alcoholic beverage made from fermented apples. Available in a variety of flavors.', '7.00', 'cider.png', 'Available'),
	('I0074', 'R0009', 'Carne Asada', 'Meals', 'Grilled steak served with beans and rice.', '16.00', 'carneasada.png', 'Available'),
	('I0075', 'R0009', 'Tacos al Pastor', 'Meals', 'Marinated pork tacos with pineapple and onion.', '13.00', 'tacosalpastor.png', 'Available'),
	('I0076', 'R0009', 'Enchiladas Suizas', 'Meals', 'Chicken enchiladas in a creamy tomatillo sauce.', '15.00', 'enchiladassuizas.png', 'Available'),
	('I0077', 'R0009', 'Chiles Rellenos', 'Meals', 'Stuffed poblano peppers with cheese and beef.', '14.00', 'chilesrellenos.png', 'Available'),
	('I0078', 'R0009', 'Pozole Rojo', 'Meals', 'Traditional hominy stew with pork and spices.', '11.00', 'pozolerojo.png', 'Available'),
	('I0079', 'R0009', 'Margarita', 'Drinks', 'Classic tequila, lime, and triple sec cocktail', '9.00', 'margarita.png', 'Available'),
	('I0080', 'R0009', 'Horchata', 'Drinks', 'Sweet and creamy rice milk with cinnamon.', '5.00', 'horchata.png', 'Available'),
	('I0081', 'R0010', 'Borscht', 'Meals', 'A hearty soup made with beets, potatoes, and cabbage, garnished with sour cream and dill.', '11.00', 'borscht.png', 'Available'),
	('I0082', 'R0010', 'Pelmeni', 'Meals', 'Russian-style dumplings filled with a savory mixture of ground meat and spices, served with sour cream and butter.', '15.00', 'pelmeni.png', 'Available'),
	('I0083', 'R0010', 'Beef Stroganoff', 'Meals', 'A dish of tender beef strips sautéed with mushrooms and onions, in a creamy sour cream sauce, served over egg noodles.', '18.00', 'beefstroganoff.png', 'Available'),
	('I0084', 'R0010', 'Blini', 'Meals', 'Thin and delicate crepes filled with either sweet or savory ingredients, such as smoked salmon or jam.', '13.00', 'blini.png', 'Available'),
	('I0085', 'R0010', 'Shashlik', 'Meals', 'Juicy and flavorful skewered meat, marinated in a mixture of spices and grilled to perfection.', '16.00', 'shashlik.png', 'Available'),
	('I0086', 'R0010', 'Kvass', 'Drinks', 'A non-alcoholic, fermented beverage made from rye bread, with a slightly sour and tangy taste.', '10.00', 'kvass.png', 'Available'),
	('I0087', 'R0010', 'Vodka Martini', 'Drinks', 'A classic cocktail made with vodka, dry vermouth, and garnished with olives or a lemon twist', '15.00', 'vodkamartini.png', 'Available'),
	('I0088', 'R0010', 'Mushroom and Onion Kasha', 'Add-Ons', 'A side dish made with buckwheat, sautéed mushrooms, and onions, seasoned with herbs and spices.', '9.00', 'mushroomandonionkasha.png', 'Available');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `orderID` varchar(7) NOT NULL,
  `restaurantID` varchar(5) NOT NULL,
  `customerID` varchar(5) DEFAULT NULL,
  `orderDate` datetime NOT NULL,
  `subTotal` double(10,2) NOT NULL,
  `serviceTotal` double(10,2) NOT NULL,
  `salesTotal` double(10,2) NOT NULL,
  `totalPrice` decimal(10,2) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `order_person`
--

CREATE TABLE `order_person` (
  `opID` varchar(6) NOT NULL,
  `orderID` varchar(7) NOT NULL,
  `personName` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `person_item`
--

CREATE TABLE `person_item` (
  `opID` varchar(7) NOT NULL,
  `itemID` varchar(5) NOT NULL,
  `quantity` int(2) DEFAULT NULL,
  `price` double(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `restaurants`
--

CREATE TABLE `restaurants` (
  `restaurantID` varchar(5) NOT NULL,
  `restaurantName` varchar(256) NOT NULL,
  `accountID` varchar(5) NOT NULL,
  `restaurantDescription` longtext NOT NULL,
  `cuisine` varchar(255) NOT NULL,
  `restaurantURL` longtext NOT NULL,
  `status` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `restaurants`
--

INSERT INTO `restaurants` (`restaurantID`, `restaurantName`, `accountID`, `restaurantDescription`, `cuisine`, `restaurantURL`, `status`) VALUES
('R0001', 'Sushi Haven', 'A0003', 'Enjoy our fresh and flavorful sushi rolls, nigiri, and sashimi with a modern twist.', 'Japanese', 'sushihavenlogo.png', 'Open'),
('R0002', 'Golden Wok', 'A0004', 'Savor our authentic Chinese dishes with a burst of bold flavors and aromatic spices.', 'Chinese', 'goldenwoklogo.png', 'Open'),
('R0003', 'Minji Kitchen', 'A0005', 'Delight in our mouth-watering Korean dishes made with the freshest ingredients.', 'Korean', 'minjikitchenlogo.png', 'Open'),
('R0004', 'Bella Italia', 'A0006', 'Indulge in our classic Italian dishes with a modern flair, made from the finest imported ingredients.', 'Italian', 'bellaitalialogo.png', 'Open'),
('R0005', 'Restoran Persekutuan', 'A0007', 'Experience the exotic flavors of Malaysia with our authentic dishes.', 'Malaysian', 'restoranpersekutuanlogo.png', 'Open'),
('R0006', 'Pho Garden', 'A0008', 'Savor the bold flavors and aromatic spices of Vietnam in every bite at our restaurant.', 'Vietnamese', 'phogardenlogo.png', 'Open'),
('R0007', 'Le Bistro', 'A0009', 'Indulge in a gastronomic journey to France, where every dish is crafted with meticulous attention to detail.', 'French', 'lebistrologo.png', 'Open'),
('R0008', 'The Rose Crown', 'A0010', 'Experience the hearty and comforting flavors of traditional British cuisine served with a modern twist.', 'British', 'therosecrownlogo.png', 'Open'),
('R0009', 'Casa de los Amigos', 'A0011', 'Spice up your taste buds with the vibrant and zesty flavors of Mexico.', 'Mexican', 'casadelosamigoslogo.png', 'Open'),
('R0010', 'Moscow Nights', 'A0012', 'Embark on a culinary adventure to Russia, where the flavors of traditional cuisine meet modern innovation.', 'Russian', 'moscownightslogo.png', 'Open');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`accountID`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`customerID`),
  ADD KEY `accountID` (`accountID`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`itemID`),
  ADD KEY `restaurantID` (`restaurantID`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`orderID`),
  ADD KEY `restaurantID` (`restaurantID`),
  ADD KEY `customerID` (`customerID`);

--
-- Indexes for table `order_person`
--
ALTER TABLE `order_person`
  ADD PRIMARY KEY (`opID`),
  ADD KEY `orderID` (`orderID`);

--
-- Indexes for table `person_item`
--
ALTER TABLE `person_item`
  ADD PRIMARY KEY (`opID`,`itemID`),
  ADD KEY `menuID` (`itemID`);

--
-- Indexes for table `restaurants`
--
ALTER TABLE `restaurants`
  ADD PRIMARY KEY (`restaurantID`),
  ADD KEY `accountID` (`accountID`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `customers`
--
ALTER TABLE `customers`
  ADD CONSTRAINT `customers_ibfk_1` FOREIGN KEY (`accountID`) REFERENCES `accounts` (`accountID`);

--
-- Constraints for table `items`
--
ALTER TABLE `items`
  ADD CONSTRAINT `items_ibfk_1` FOREIGN KEY (`restaurantID`) REFERENCES `restaurants` (`restaurantID`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`restaurantID`) REFERENCES `restaurants` (`restaurantID`),
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`customerID`) REFERENCES `customers` (`customerID`);

--
-- Constraints for table `order_person`
--
ALTER TABLE `order_person`
  ADD CONSTRAINT `order_person_ibfk_1` FOREIGN KEY (`orderID`) REFERENCES `orders` (`orderID`);

--
-- Constraints for table `person_item`
--
ALTER TABLE `person_item`
  ADD CONSTRAINT `person_item_ibfk_1` FOREIGN KEY (`opID`) REFERENCES `order_person` (`opID`),
  ADD CONSTRAINT `person_item_ibfk_2` FOREIGN KEY (`itemID`) REFERENCES `items` (`itemID`);

--
-- Constraints for table `restaurants`
--
ALTER TABLE `restaurants`
  ADD CONSTRAINT `restaurants_ibfk_1` FOREIGN KEY (`accountID`) REFERENCES `accounts` (`accountID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
