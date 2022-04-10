-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 25, 2019 at 05:21 AM
-- Server version: 10.1.32-MariaDB
-- PHP Version: 7.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `user_record`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` text NOT NULL,
  `username` text NOT NULL,
  `email` text NOT NULL,
  `password` text NOT NULL,
  `pic_status` int(11) NOT NULL DEFAULT '0',
  `pic_dir` text NOT NULL,
  `name_change` int(11) NOT NULL DEFAULT '0',
  `acc_status` int(11) NOT NULL DEFAULT '0',
  `vkey` text NOT NULL,
  `pass_pin` int(11) NOT NULL,
  `pin_time` int(11) NOT NULL,
  `mail_sent_no` int(11) NOT NULL DEFAULT '0',
  `mail_sent_time` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`id`, `name`, `username`, `email`, `password`, `pic_status`, `pic_dir`, `name_change`, `acc_status`, `vkey`, `pass_pin`, `pin_time`, `mail_sent_no`, `mail_sent_time`) VALUES
(0, 'GUEST', 'N/A', 'N/A', 'N/A', 0, 'N/A', 0, 0, '', 0, 0, 0, 0),
(6, 'Prayab Maharjan', 'maharjan_prayab', 'prayabmaharjan9@gmail.com', 'iwantquiz', 0, '', 0, 0, '', 6594025, 1572695378, 0, 0),
(7, 'Bimarsh Bhusal', 'anup8eguy', 'anup8eguy@gmail.com', 'Bhusal12', 1, 'uploads/profile_pic/5df99cca333012.74936910.JPG', 0, 0, '', 4182337, 1572838704, 1, 1572838704),
(8, 'Player 1', 'anupp34', 'anup8euy@gmail.com', 'Bhusal12', 0, '', 0, 0, '', 0, 0, 0, 0),
(9, 'Anup Bhusal', 'jkjkfnkef', 'd@klg', 'Bhusal12', 0, '', 0, 0, '', 0, 0, 0, 0),
(10, 'Bee Player', 'kjsfnkkkk', 'b.anup@gmail.com', 'Bhusal12', 1, 'uploads/profile_pic/5dc4373d8db4e1.25047951.jpeg', 0, 0, '', 0, 0, 0, 0),
(11, 'Yubraj bhandari', 'yubrajbhandari', 'barsha@yahoo.com', 'ubbrajjj', 0, '', 0, 0, '', 0, 0, 0, 0),
(12, 'FAKE ID', 'userfake', 'fakeid@gmail.com', 'userfake', 0, '', 0, 0, '', 0, 0, 0, 0),
(13, 'Anup Bhusal', 'malefake', 'malefake@gmail.com', 'Bhusal12', 0, '', 0, 0, '', 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `all_question_admin`
--

CREATE TABLE `all_question_admin` (
  `sn` int(11) NOT NULL,
  `question` text NOT NULL,
  `answer` text NOT NULL,
  `opt1` text NOT NULL,
  `opt2` text NOT NULL,
  `opt3` text NOT NULL,
  `field` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `all_question_admin`
--

INSERT INTO `all_question_admin` (`sn`, `question`, `answer`, `opt1`, `opt2`, `opt3`, `field`) VALUES
(1, 'Which among the following waves is used for communication by artificial satellites?', 'Microwaves', 'The frequency of 101 series  ', 'A. M.', 'Radio waves', 'Science'),
(2, 'When the speed of a car is doubled then what should be the braking force of the car to stop it at the same distance?', 'Four Times', 'Half', 'One Fourth', 'Two times', 'Science'),
(3, 'The mass of a star is two times the mass of the Sun. How will it come to an end?', 'Neutron Star', 'Red Giant', 'Blackhole', 'White Dwarf', 'Science'),
(4, 'Q1: Cement is made hard by:', 'hydration and dissociation of water', 'Polymerisation', 'Dissociation of water', 'dehydration', 'Science'),
(5, 'Which one of the following metals pollutes the air of a city having a large number of automobiles?', 'Lead', 'Copper', 'Chromium', 'Cadmium', 'Science'),
(6, 'The disease that is caused by the virus is?', 'Common Cold', 'Cholera', 'Tetanus', 'Typhoid', 'Science'),
(7, 'An instrument for measuring blood pressure is called?', 'Sphygmomanometer', 'Haemocytometer', 'Spirometer', 'Barometer', 'Science'),
(8, 'Milk of Magnesia is a suspension of:', 'magnesium hydroxide  ', 'magnesium chloride', 'magnesium carbonate', 'magnesium sulphate', 'Science'),
(9, 'Who is the father of Computer?', 'Charles Babbage', 'Alexander Grahm Bell', 'William Osborne', 'Sir Michael Newton', 'Geography'),
(10, 'Who is the father of Biology?', 'Aristotle', 'William Osborne', 'Wright Brothers', 'Sir Issac Newton', 'Science'),
(11, 'Brass gets discoloured in air because of the presence of which of the following gases in air?', 'Hydrogen sulphide', 'Oxygen', 'Carbon Dioxide', 'Nitrogen', 'Science'),
(12, 'Which of the following is a non metal that remains liquid at room temperature?', 'Bromine', 'Phosporous', 'Chlorine', 'Helium', 'Science'),
(13, 'Chlorophyll is a naturally occurring chelate compound in which central metal is', 'Magnesium', 'Chlorine', 'Sodium', 'Phosporous', 'Science'),
(14, 'Which of the following is used in pencils?', 'Graphite', 'Silicon', 'Charcoal', 'Phosporous', 'Science'),
(15, 'Which of the following metals forms an amalgam with other metals?', 'Mercury', 'Tin', 'Lead', 'Zinc', 'Science'),
(16, 'Potassium Nitrate is used in..?', 'Fertilizer', 'Medicine', 'Grass', 'Salt', 'Science'),
(17, 'Soda water contains?', 'Carbon Dioxide', 'Carbolic Acid', 'Nitrous Acid ', 'Sulphuric Acid', 'Science'),
(18, 'The most important ore of aluminium is:', 'Bauxite', 'Galena', 'Calcite', 'Calamine', 'Science'),
(19, 'Most soluble in water is:', 'sugar', 'camphor', 'sulphur', 'common salt', 'Science'),
(20, 'Permanent hardness of water may be removed by the addition of :', 'sodium carbonate ', 'alum', 'potassium permanganate', 'lime', 'Science'),
(21, 'When an iron nail gets rusted, iron oxide is formed:', 'with increase in the weight of the nail', 'without any change in the weight of the nail', 'with decrease in the weight of the nail ', 'without any change in colour or weight of the nail', 'Science'),
(22, 'Galvanised iron sheets have a coating of:', 'zinc', 'lead', 'chromium', 'tin', 'Science'),
(23, 'Among the various allotropes of carbon:', 'diamond is the hardest, graphite is the softest ', 'coke is the hardest, graphite is the softest ', 'diamond is the hardest, coke is the softest', 'diamond is the hardest, lamp black is the softest', 'Science'),
(24, 'The group of metals Fe, Co, Ni may best called as:', 'transition metals', 'main group metals', 'alkali metals', 'rare metals', 'Science'),
(25, 'Heavy water is:', 'deuterium oxide', 'PH7', 'rain water', 'tritium oxide', 'Science'),
(26, 'The inert gas which is substituted for nitrogen in the air used by deep sea divers for breathing, is :', 'Helium', 'Argon', 'Krypton', 'Xenon', 'Science'),
(27, 'The gases used in different types of welding would include:', 'oxygen and acetylene', 'oxygen and hydrogen ', 'oxygen, hydrogen, acetylene and nitrogen', 'oxygen, acetylene and argon', 'Science'),
(28, 'The property of a substance to absorb moisture from the air on exposure is called:', 'deliquescence', 'osmosis', 'efflorescence', 'desiccation', 'Science'),
(29, 'In which of the following activities silicon carbide is used?', 'cutting very hard substances', 'Making cement and glass', 'Disinfecting water of ponds', 'Making casts for statues', 'Science'),
(30, 'The average salinity of sea water is:', '3.5%', '3%', '2.5%', '2%', 'Science'),
(31, 'In fireworks, the green flame is produced because of:', 'barium', 'sodium', 'mercury', 'potassium', 'Science'),
(32, 'Permanent hardness of water can be removed by adding:', 'washing soda', 'chlorine', 'potassium permanganate', 'bleaching powder', 'Science'),
(33, 'Marsh gas is:', 'methane', 'nitrogen', 'ethane', 'hydrogen', 'Science'),
(34, 'LPG consists of mainly:', 'methane, butane and propane', 'methane, ethane and hexane', 'ethane, hexane and nonane', 'methane, hexane and nonane', 'Science'),
(35, 'Air is a/an:', 'mixture', 'compound', 'element', 'electrolyte', 'Science'),
(36, 'Production of chlorofluorocarbons (CFC) gas which is proposed to be banned in India, is used in which of the following domestic products?', 'Refrigerator', 'Television', 'Tube light', 'Cooking gas', 'Science'),
(37, 'Balloons are filled with:', 'helium', 'nitrogen', 'oxygen', 'argon', 'Science'),
(38, 'Which of the following does not contain a coinage metal?', 'Zinc and Gold', 'Silver and Gold', 'Copper and Silver', 'Copper and Gold', 'Science'),
(39, '	 Which metal pollute the air of a big city?', 'Lead', 'Copper', 'Chromium', 'Cadmium', 'Science'),
(40, 'Bell metal is an alloy of:', 'tin and copper', 'nickel and copper', 'zinc and copper', 'brass and nickel', 'Science'),
(41, 'Water is a good solvent of ionic salts because:', 'it has a high dipole moment', 'it has no colour C', 'it has a high specific heat', 'it has a high boiling point', 'Science'),
(42, 'Which of the following is not an isotope of hydrogen?', 'Yttrium', 'Tritium', 'Deuterium', 'Protium', 'Science'),
(43, 'The main constituents of pearls are:', 'calcium carbonate and magnesium carbonate', 'ammonium sulphate and sodium carbonate', 'calcium oxide and ammonium chloride', 'aragonite and conchiolin', 'Science'),
(44, 'Amalgams are:', 'alloys which contain mercury as one of the contents', 'highly coloured alloys', 'alloys which have great resistance to abrasion', 'alloys which contain carbon', 'Science'),
(45, 'Which of the following is the lightest metal?', 'Lithium', 'Mercury', 'Lead', 'Silver', 'Science'),
(46, 'Which of the following metals remain in liquid for under normal conditions?', 'Mercury', 'Radium', 'Zinc', 'Uranium', 'Science'),
(47, 'Total Area Of Nepal is:', '147181 Sq Km', '2345345sq km', '345222342 Sq m', 'none', 'Geography');

-- --------------------------------------------------------

--
-- Table structure for table `battle_active`
--

CREATE TABLE `battle_active` (
  `id` int(11) NOT NULL,
  `code` int(11) NOT NULL,
  `resId` int(11) NOT NULL,
  `score` int(11) NOT NULL DEFAULT '0',
  `adm_stat` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `jointable`
--

CREATE TABLE `jointable` (
  `id` int(11) NOT NULL,
  `code` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `ready` int(11) NOT NULL,
  `playing` int(11) NOT NULL DEFAULT '0',
  `tempcode` int(11) NOT NULL,
  `resId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jointable`
--

INSERT INTO `jointable` (`id`, `code`, `status`, `ready`, `playing`, `tempcode`, `resId`) VALUES
(7, 1128364, 0, 1, 1, 1128364, 50),
(11, 1128364, 0, 1, 1, 1128364, 293),
(13, 1128364, 0, 1, 1, 1128364, 548);

-- --------------------------------------------------------

--
-- Table structure for table `multiplay`
--

CREATE TABLE `multiplay` (
  `id` int(11) NOT NULL,
  `code` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `adm_stat` int(11) NOT NULL DEFAULT '0',
  `ready` int(11) NOT NULL DEFAULT '0',
  `playReady` int(11) NOT NULL DEFAULT '0',
  `field` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `quiz`
--

CREATE TABLE `quiz` (
  `id` int(11) DEFAULT NULL,
  `id_of_quiz` int(10) UNSIGNED NOT NULL,
  `question` text NOT NULL,
  `answer` text NOT NULL,
  `opt1` text NOT NULL,
  `opt2` text NOT NULL,
  `opt3` text NOT NULL,
  `field` text NOT NULL,
  `setname` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `quiz`
--

INSERT INTO `quiz` (`id`, `id_of_quiz`, `question`, `answer`, `opt1`, `opt2`, `opt3`, `field`, `setname`) VALUES
(4, 10, 'Who is the father of Biology?', 'Aristotle', 'William Osborne', 'Wright Brothers', 'Sir Issac Newton', 'Science', 'sceet'),
(4, 11, 'Brass gets discoloured in air because of the presence of which of the following gases in air?', 'Hydrogen sulphide', 'Oxygen', 'Carbon Dioxide', 'Nitrogen', 'Science', 'sceet'),
(4, 12, 'Which of the following is a non metal that remains liquid at room temperature?', 'Bromine', 'Phosporous', 'Chlorine', 'Helium', 'Science', 'sceet'),
(4, 13, 'Chlorophyll is a naturally occurring chelate compound in which central metal is', 'Magnesium', 'Chlorine', 'Sodium', 'Phosporous', 'Science', 'sceet'),
(4, 14, 'Which of the following is used in pencils?', 'Graphite', 'Silicon', 'Charcoal', 'Phosporous', 'Science', 'sceet'),
(4, 15, 'Which of the following metals forms an amalgam with other metals?', 'Mercury', 'Tin', 'Lead', 'Zinc', 'Science', 'sceet'),
(4, 16, 'Potassium Nitrate is used in..?', 'Fertilizer', 'Medicine', 'Grass', 'Salt', 'Science', 'sceet'),
(4, 17, 'Soda water contains?', 'Carbon Dioxide', 'Carbolic Acid', 'Nitrous Acid ', 'Sulphuric Acid', 'Science', 'sceet'),
(4, 18, 'The most important ore of aluminium is:', 'Bauxite', 'Galena', 'Calcite', 'Calamine', 'Science', 'sceet'),
(4, 19, 'Most soluble in water is:', 'sugar', 'camphor', 'sulphur', 'common salt', 'Science', 'sceet'),
(4, 20, 'Permanent hardness of water may be removed by the addition of :', 'sodium carbonate ', 'alum', 'potassium permanganate', 'lime', 'Science', 'sceet'),
(4, 21, 'When an iron nail gets rusted, iron oxide is formed:', 'with increase in the weight of the nail', 'without any change in the weight of the nail', 'with decrease in the weight of the nail ', 'without any change in colour or weight of the nail', 'Science', 'sceet'),
(4, 22, 'Galvanised iron sheets have a coating of:', 'zinc', 'lead', 'chromium', 'tin', 'Science', 'sceet'),
(4, 23, 'Among the various allotropes of carbon:', 'diamond is the hardest, graphite is the softest ', 'coke is the hardest, graphite is the softest ', 'diamond is the hardest, coke is the softest', 'diamond is the hardest, lamp black is the softest', 'Science', 'sceet'),
(4, 24, 'The group of metals Fe, Co, Ni may best called as:', 'transition metals', 'main group metals', 'alkali metals', 'rare metals', 'Science', 'sceet'),
(4, 25, 'Heavy water is:', 'deuterium oxide', 'PH7', 'rain water', 'tritium oxide', 'Science', 'sceet'),
(4, 26, 'The inert gas which is substituted for nitrogen in the air used by deep sea divers for breathing, is :', 'Helium', 'Argon', 'Krypton', 'Xenon', 'Science', 'sceet'),
(4, 27, 'The gases used in different types of welding would include:', 'oxygen and acetylene', 'oxygen and hydrogen ', 'oxygen, hydrogen, acetylene and nitrogen', 'oxygen, acetylene and argon', 'Science', 'sceet'),
(4, 28, 'The property of a substance to absorb moisture from the air on exposure is called:', 'deliquescence', 'osmosis', 'efflorescence', 'desiccation', 'Science', 'sceet'),
(4, 29, 'In which of the following activities silicon carbide is used?', 'cutting very hard substances', 'Making cement and glass', 'Disinfecting water of ponds', 'Making casts for statues', 'Science', 'sceet'),
(4, 30, 'The average salinity of sea water is:', '3.5%', '3%', '2.5%', '2%', 'Science', 'sceet'),
(4, 31, 'In fireworks, the green flame is produced because of:', 'barium', 'sodium', 'mercury', 'potassium', 'Science', 'sceet'),
(4, 32, 'Permanent hardness of water can be removed by adding:', 'washing soda', 'chlorine', 'potassium permanganate', 'bleaching powder', 'Science', 'sceet'),
(4, 33, 'Marsh gas is:', 'methane', 'nitrogen', 'ethane', 'hydrogen', 'Science', 'sceet'),
(4, 34, 'LPG consists of mainly:', 'methane, butane and propane', 'methane, ethane and hexane', 'ethane, hexane and nonane', 'methane, hexane and nonane', 'Science', 'sceet'),
(4, 35, 'Air is a/an:', 'mixture', 'compound', 'element', 'electrolyte', 'Science', 'sceet'),
(4, 36, 'Production of chlorofluorocarbons (CFC) gas which is proposed to be banned in India, is used in which of the following domestic products?', 'Refrigerator', 'Television', 'Tube light', 'Cooking gas', 'Science', 'sceet'),
(4, 37, 'Balloons are filled with:', 'helium', 'nitrogen', 'oxygen', 'argon', 'Science', 'sceet'),
(4, 38, 'Which of the following does not contain a coinage metal?', 'Zinc and Gold', 'Silver and Gold', 'Copper and Silver', 'Copper and Gold', 'Science', 'sceet'),
(4, 40, 'Bell metal is an alloy of:', 'tin and copper', 'nickel and copper', 'zinc and copper', 'brass and nickel', 'Science', 'sceet'),
(4, 41, 'Water is a good solvent of ionic salts because:', 'it has a high dipole moment', 'it has no colour C', 'it has a high specific heat', 'it has a high boiling point', 'Science', 'sceet'),
(4, 42, 'Which of the following is not an isotope of hydrogen?', 'Yttrium', 'Tritium', 'Deuterium', 'Protium', 'Science', 'sceet'),
(4, 43, 'The main constituents of pearls are:', 'calcium carbonate and magnesium carbonate', 'ammonium sulphate and sodium carbonate', 'calcium oxide and ammonium chloride', 'aragonite and conchiolin', 'Science', 'sceet'),
(4, 44, 'Amalgams are:', 'alloys which contain mercury as one of the contents', 'highly coloured alloys', 'alloys which have great resistance to abrasion', 'alloys which contain carbon', 'Science', 'sceet'),
(4, 45, 'Which of the following is the lightest metal?', 'Lithium', 'Mercury', 'Lead', 'Silver', 'Science', 'sceet'),
(4, 46, 'Which of the following metals remain in liquid for under normal conditions?', 'Mercury', 'Radium', 'Zinc', 'Uranium', 'Science', 'sceet'),
(7, 47, 'Total Area Of Nepal is:', '147181 Sq Km', '2345345sq km', '345222342 Sq m', 'none', 'Geography', 'This set');

-- --------------------------------------------------------

--
-- Table structure for table `ratchet`
--

CREATE TABLE `ratchet` (
  `id` int(11) NOT NULL,
  `resId` int(11) NOT NULL,
  `code` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sets`
--

CREATE TABLE `sets` (
  `id` int(11) DEFAULT NULL,
  `setname` text NOT NULL,
  `field` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sets`
--

INSERT INTO `sets` (`id`, `setname`, `field`) VALUES
(3, 'set', 'Geography'),
(4, 'sceet', 'Science'),
(11, 'New', 'Geography'),
(7, 'This set', 'Geography');

-- --------------------------------------------------------

--
-- Table structure for table `user_activity`
--

CREATE TABLE `user_activity` (
  `id` int(11) NOT NULL,
  `time` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user_rank`
--

CREATE TABLE `user_rank` (
  `id` int(11) NOT NULL,
  `rank` int(11) NOT NULL DEFAULT '0',
  `points` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_rank`
--

INSERT INTO `user_rank` (`id`, `rank`, `points`) VALUES
(1, 0, 0),
(2, 0, 0),
(3, 0, 0),
(4, 0, 0),
(6, 0, 0),
(7, 0, 0),
(8, 0, 0),
(9, 0, 0),
(10, 0, 0),
(11, 0, 0),
(12, 0, 0),
(13, 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `all_question_admin`
--
ALTER TABLE `all_question_admin`
  ADD PRIMARY KEY (`sn`);

--
-- Indexes for table `battle_active`
--
ALTER TABLE `battle_active`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jointable`
--
ALTER TABLE `jointable`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `multiplay`
--
ALTER TABLE `multiplay`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `quiz`
--
ALTER TABLE `quiz`
  ADD PRIMARY KEY (`id_of_quiz`);

--
-- Indexes for table `user_activity`
--
ALTER TABLE `user_activity`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_rank`
--
ALTER TABLE `user_rank`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account`
--
ALTER TABLE `account`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `all_question_admin`
--
ALTER TABLE `all_question_admin`
  MODIFY `sn` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `quiz`
--
ALTER TABLE `quiz`
  MODIFY `id_of_quiz` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
