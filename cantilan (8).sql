-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 18, 2019 at 03:51 AM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `cantilan`
--

-- --------------------------------------------------------

--
-- Table structure for table `articles`
--

CREATE TABLE IF NOT EXISTS `articles` (
`id` int(11) NOT NULL,
  `article_category` int(11) NOT NULL,
  `article_title` varchar(255) NOT NULL,
  `article_content` text NOT NULL,
  `article_image` varchar(255) NOT NULL,
  `date_published` varchar(255) NOT NULL,
  `views` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `articles`
--

INSERT INTO `articles` (`id`, `article_category`, `article_title`, `article_content`, `article_image`, `date_published`, `views`) VALUES
(3, 2, 'Intramurals 2020', '<p><strong>Intramurals</strong>&nbsp;are fun, recreational, social and competitive on-campus sports activities for Bryant University students and staff. These are designed with the everyday athlete, just like you, in mind. This is a great opportunity for you to have some fun and to try that new sport you&#39;ve always wanted to learn!</p>\r\n', '1573535076.jpg', 'November 12, 2019, 5:04 am', 6),
(4, 3, 'ROTC Tactical', '<p>Sample Content</p>\r\n', '1573539500.jpg', 'November 12, 2019, 7:18 am', 4),
(5, 3, 'Upcoming Graduation', '<p>graduation</p>\r\n', '1573539664.jpg', 'November 12, 2019, 7:21 am', 2),
(6, 3, 'CHED  - Caraga RQAT Conducts Program Monitoring and Evaluation', '<p>contents</p>\r\n', '1573539757.jpg', 'November 12, 2019, 7:22 am', 3),
(7, 3, '84th National Book Week Celebration of SDSSU Library Management System ', '<p>dsfasdf</p>\r\n', '1573540011.png', 'November 12, 2019, 7:23 am', 4),
(8, 3, 'SDSSU Tandag Technical Librarian Attends the National Congress', '<p>dfadsf</p>\r\n', '1573540069.jpg', 'November 12, 2019, 7:27 am', 1);

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE IF NOT EXISTS `attendance` (
`id` int(11) NOT NULL,
  `studentID` varchar(255) NOT NULL,
  `class_info` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `course` varchar(255) NOT NULL,
  `yearLevel` varchar(255) NOT NULL,
  `attendanceDate` varchar(255) NOT NULL,
  `time_in` varchar(255) NOT NULL,
  `time_out` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`id`, `studentID`, `class_info`, `name`, `course`, `yearLevel`, `attendanceDate`, `time_in`, `time_out`) VALUES
(21, '00111', 5, 'Fallado, Orlan Ramirez', 'BS Info Tech', '4th Year', '11/07/2019', '04:13 pm', '04:32 pm'),
(22, '00112', 5, 'Parker, Floramie Duero', 'BS Info Tech', '4th Year', '11/07/2019', '04:53 pm', '04:53 pm'),
(23, '00114', 6, 'Ortiza, Joy Salang', 'BS Info Tech', '4th Year', '08/11/2019', '03:09 am', '03:10 am'),
(27, '00112', 7, 'Parker, Floramie Duero', 'BS Info Tech', '4th Year', '11/08/2019', '05:11 am', '05:11 am'),
(28, '00114', 7, 'Ortiza, Joy Salang', 'BS Info Tech', '4th Year', '11/08/2019', '05:11 am', ''),
(29, '00111', 7, 'Fallado, Orlan Ramirez', 'BS Info Tech', '4th Year', '11/08/2019', '05:11 am', '05:11 am'),
(30, '123456', 8, 'Fallado, Orlan Ramirez', 'BS Info Tech', '4th Year', '11/11/2019', '05:49 am', ''),
(31, '123457', 8, 'Ortiza, Joy Salang', 'BS Info Tech', '4th Year', '11/11/2019', '05:50 am', '05:50 am');

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE IF NOT EXISTS `books` (
`id` int(11) NOT NULL,
  `isbn` varchar(255) NOT NULL,
  `bookTitle` varchar(255) NOT NULL,
  `author` varchar(255) NOT NULL,
  `datePublished` varchar(255) NOT NULL,
  `qrcode` varchar(255) NOT NULL,
  `is_borrowed` tinyint(1) NOT NULL,
  `borrowerID` varchar(255) NOT NULL,
  `borrower` varchar(255) NOT NULL,
  `borrowerContact` varchar(255) NOT NULL,
  `dateBorrowed` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`id`, `isbn`, `bookTitle`, `author`, `datePublished`, `qrcode`, `is_borrowed`, `borrowerID`, `borrower`, `borrowerContact`, `dateBorrowed`) VALUES
(5, '978-3-16-148410-0', 'Ibong Adarna', 'Filipino Author', '11/24/2004', '1573106911.png', 0, '', '', '', ''),
(8, '978-3-16-148410-1', 'College Algebra', 'Filipino Author', '11/24/2004', '1573653365.png', 0, '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `booktransactions`
--

CREATE TABLE IF NOT EXISTS `booktransactions` (
`id` int(11) NOT NULL,
  `transactionType` varchar(255) NOT NULL,
  `transactionDate` varchar(255) NOT NULL,
  `transactionTime` varchar(255) NOT NULL,
  `isbn` varchar(255) NOT NULL,
  `bookTitle` varchar(255) NOT NULL,
  `borrowerID` varchar(255) NOT NULL,
  `borrower` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `booktransactions`
--

INSERT INTO `booktransactions` (`id`, `transactionType`, `transactionDate`, `transactionTime`, `isbn`, `bookTitle`, `borrowerID`, `borrower`) VALUES
(11, 'borrow', '11/07/2019', '14:05:37', '978-3-16-148410-0', 'Ibong Adarna', '01111', 'Orlan Fallado'),
(12, 'return', '11/07/2019', '14:06:36', '978-3-16-148410-0', 'Ibong Adarna', '01111', 'Orlan Fallado'),
(13, 'borrow', '11/08/2019', '03:13:18', '978-3-16-148410-0', 'Ibong Adarna', '01111', 'Jillmer Donila'),
(14, 'return', '11/08/2019', '03:14:08', '978-3-16-148410-0', 'Ibong Adarna', '01111', 'Jillmer Donila'),
(15, 'borrow', '11/08/2019', '03:54:32', '978-3-16-148410-1', 'College Algebra', '165164', 'floramie parker'),
(16, 'return', '11/08/2019', '03:55:35', '978-3-16-148410-1', 'College Algebra', '165164', 'floramie parker');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE IF NOT EXISTS `category` (
`id` int(11) NOT NULL,
  `category` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `category`) VALUES
(2, 'Sports'),
(3, 'News');

-- --------------------------------------------------------

--
-- Table structure for table `chat`
--

CREATE TABLE IF NOT EXISTS `chat` (
`chatid` int(11) NOT NULL,
  `sender_userid` int(11) NOT NULL,
  `receiver_userid` int(11) NOT NULL,
  `message` text NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `chat`
--

INSERT INTO `chat` (`chatid`, `sender_userid`, `receiver_userid`, `message`, `timestamp`, `status`) VALUES
(3, 10, 14, 'hello', '2019-11-04 14:55:04', 0),
(4, 10, 7, 'hi', '2019-11-04 14:55:12', 0),
(5, 7, 10, 'hello', '2019-11-04 15:19:13', 0),
(6, 14, 10, 'hi', '2019-11-04 16:03:07', 0),
(7, 15, 10, 'hello', '2019-11-08 01:59:48', 0);

-- --------------------------------------------------------

--
-- Table structure for table `chat_login_details`
--

CREATE TABLE IF NOT EXISTS `chat_login_details` (
`id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `last_activity` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `is_typing` enum('no','yes','','') NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=77 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `chat_login_details`
--

INSERT INTO `chat_login_details` (`id`, `userid`, `last_activity`, `is_typing`) VALUES
(1, 10, '2019-11-04 14:54:48', 'no'),
(2, 7, '2019-11-04 15:01:24', 'no'),
(3, 10, '2019-11-04 15:15:43', 'no'),
(4, 10, '2019-11-04 16:01:47', 'no'),
(5, 14, '2019-11-04 16:02:10', 'no'),
(6, 10, '2019-11-05 07:02:03', 'no'),
(7, 10, '2019-11-05 07:10:33', 'no'),
(8, 10, '2019-11-05 07:10:57', 'no'),
(9, 11, '2019-11-05 07:22:48', 'no'),
(10, 2, '2019-11-05 07:23:33', 'no'),
(11, 2, '2019-11-06 00:56:03', 'no'),
(12, 2, '2019-11-06 23:30:38', 'no'),
(13, 2, '2019-11-07 11:56:33', 'no'),
(14, 9, '2019-11-07 12:54:02', 'no'),
(15, 2, '2019-11-07 13:05:14', 'no'),
(16, 9, '2019-11-07 13:07:07', 'no'),
(17, 2, '2019-11-07 15:12:48', 'no'),
(18, 2, '2019-11-07 16:02:24', 'no'),
(19, 9, '2019-11-07 16:15:49', 'no'),
(20, 9, '2019-11-08 00:40:02', 'no'),
(21, 2, '2019-11-08 01:54:20', 'no'),
(22, 15, '2019-11-08 01:58:40', 'no'),
(23, 10, '2019-11-08 02:00:09', 'no'),
(24, 2, '2019-11-08 02:01:05', 'no'),
(25, 16, '2019-11-08 02:06:24', 'no'),
(26, 2, '2019-11-08 02:12:09', 'no'),
(27, 9, '2019-11-08 02:28:26', 'no'),
(28, 2, '2019-11-08 02:51:26', 'no'),
(29, 11, '2019-11-08 02:51:51', 'no'),
(30, 2, '2019-11-08 02:57:53', 'no'),
(31, 16, '2019-11-08 02:59:24', 'no'),
(32, 9, '2019-11-08 03:26:43', 'no'),
(33, 2, '2019-11-09 00:08:28', 'no'),
(34, 9, '2019-11-09 00:27:31', 'no'),
(35, 2, '2019-11-09 02:22:54', 'no'),
(36, 2, '2019-11-10 03:37:32', 'no'),
(37, 2, '2019-11-10 08:29:40', 'no'),
(38, 4, '2019-11-10 08:37:53', 'no'),
(39, 7, '2019-11-11 04:37:42', 'no'),
(40, 12, '2019-11-11 04:39:11', 'no'),
(41, 4, '2019-11-11 04:41:05', 'no'),
(42, 2, '2019-11-11 04:43:04', 'no'),
(43, 2, '2019-11-11 04:44:19', 'no'),
(44, 18, '2019-11-11 04:45:18', 'no'),
(45, 7, '2019-11-11 04:57:40', 'no'),
(46, 4, '2019-11-11 04:58:51', 'no'),
(47, 2, '2019-11-11 05:00:51', 'no'),
(48, 11, '2019-11-11 05:21:28', 'no'),
(49, 2, '2019-11-12 02:59:18', 'no'),
(50, 2, '2019-11-12 03:59:25', 'no'),
(51, 4, '2019-11-13 00:31:59', 'no'),
(52, 2, '2019-11-13 01:35:52', 'no'),
(53, 2, '2019-11-13 12:15:20', 'no'),
(54, 7, '2019-11-14 01:35:10', 'no'),
(55, 2, '2019-11-14 03:06:17', 'no'),
(56, 4, '2019-11-14 06:21:13', 'no'),
(57, 8, '2019-11-14 06:34:52', 'no'),
(58, 10, '2019-11-14 06:43:22', 'no'),
(59, 9, '2019-11-14 06:55:42', 'no'),
(60, 11, '2019-11-14 07:10:29', 'no'),
(61, 12, '2019-11-14 07:19:29', 'no'),
(62, 13, '2019-11-14 07:23:03', 'no'),
(63, 9, '2019-11-14 07:41:16', 'no'),
(64, 2, '2019-11-14 07:48:18', 'no'),
(65, 9, '2019-11-14 07:53:21', 'no'),
(66, 10, '2019-11-14 07:58:18', 'no'),
(67, 4, '2019-11-14 08:10:04', 'no'),
(68, 2, '2019-11-14 08:13:02', 'no'),
(69, 2, '2019-11-15 07:26:59', 'no'),
(70, 2, '2019-11-15 10:48:31', 'no'),
(71, 2, '2019-11-16 17:08:07', 'no'),
(72, 2, '2019-11-17 06:05:23', 'no'),
(73, 2, '2019-11-17 12:00:55', 'no'),
(74, 2, '2019-11-18 00:45:49', 'no'),
(75, 19, '2019-11-18 02:04:30', 'no'),
(76, 2, '2019-11-18 02:30:50', 'no');

-- --------------------------------------------------------

--
-- Table structure for table `class_info`
--

CREATE TABLE IF NOT EXISTS `class_info` (
`id` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `course` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `schedule` varchar(255) NOT NULL,
  `has_ended` tinyint(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `class_info`
--

INSERT INTO `class_info` (`id`, `teacher_id`, `course`, `subject`, `schedule`, `has_ended`) VALUES
(5, 9, 'BS Info Tech', 'Thesis Writing IV', '8:00 - 9:00 AM', 1),
(6, 16, 'BS Info Tech', 'MATH II', '8:00 - 9:00 AM', 1),
(7, 9, 'BS Info Tech', 'Thesis Writing IV', '10:00 - 11:00 AM TTH', 1),
(8, 18, 'BS Info Tech', 'English IV', '8:00 - 9:00 AM', 1),
(9, 9, 'BS Info Tech', 'MATH II', '8:00 - 9:00 AM', 0);

-- --------------------------------------------------------

--
-- Table structure for table `extension`
--

CREATE TABLE IF NOT EXISTS `extension` (
`id` int(11) NOT NULL,
  `ext_activity` varchar(255) NOT NULL,
  `ext_content` text NOT NULL,
  `attachedFile` varchar(255) NOT NULL,
  `extension_image` varchar(255) NOT NULL,
  `dateAdded` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `extension`
--

INSERT INTO `extension` (`id`, `ext_activity`, `ext_content`, `attachedFile`, `extension_image`, `dateAdded`) VALUES
(5, 'Coastal CleanUp by All SDSSU Students', '<p>CANTILAN, Surigao del Sur, May 24 -&nbsp; The Department of Environment and Natural Resources (DENR) - Community of Environment and Natural Resources Office (CENRO)-Cantilan, together with the Philippine National Police (PNP), Bureau of Fire of Protection (BFP), other government agencies, Cantilangnons and stakeholders, has showed unity in celebration of this year&rsquo;s Earth Day.</p>\r\n\r\n<p>The celebration was highlighted with the conduct of Mangrove Tree Planting and Coastal Clean-up activity at Barangay Magosilom, Cantilan, Surigao del Sur.</p>\r\n\r\n<p>A total of 1,000 mangrove propagules were planted of mixed bakauan babae and bakauan lalaki and 25 sacks of garbage was collected by the participants.</p>\r\n\r\n<p>Earth Day is celebrated annually, every 22nd day of April. Its core purpose is to raise awareness on the present status of the environment and to educate the people on ways to mitigate the causes of climate change.</p>\r\n\r\n<p>&ldquo;Earth Day celebration is just one avenue for us to show our care for the environment, but if we want to make a lasting legacy and change, we must practice discipline in our everyday life. How? Through proper disposal of our waste and teaching our children to do the same,&rdquo; CENR Officer Ruel Efren stated.</p>\r\n\r\n<p>This year&rsquo;s Earth Day celebration is anchored on the theme &ldquo;Protect our Species.&quot; (Shekinah L. Rojo/DENR-CENRO Cantilan/PIA-Caraga)</p>\r\n', '1573363990.pdf', '1573363990.jpg', '11/10/2019');

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE IF NOT EXISTS `groups` (
`id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `permission` varchar(255) NOT NULL,
  `is_admin` tinyint(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `name`, `permission`, `is_admin`) VALUES
(1, 'Super Administrator', 'is_admin', 1),
(2, 'Quality Assurance Admin', 'is_qa_admin', 1),
(3, 'E-Learning Admin', 'is_el_admin', 1),
(4, 'Teacher (For Classroom Attendance)', 'is_teacher', 1),
(5, 'OJT Coordinator', 'is_ojt_admin', 1),
(6, 'Librarian(For Library Management System)', 'is_library_admin', 1),
(7, 'Research Office Admin', 'is_research_admin', 1),
(8, 'Extension Office Admin', 'is_ex_admin', 1),
(9, 'OJT Student', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `ojt_requirements`
--

CREATE TABLE IF NOT EXISTS `ojt_requirements` (
`id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `attachedFile` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ojt_requirements`
--

INSERT INTO `ojt_requirements` (`id`, `name`, `attachedFile`) VALUES
(4, 'OJT Application Form', '1572311099.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `programs`
--

CREATE TABLE IF NOT EXISTS `programs` (
`id` int(11) NOT NULL,
  `programs` varchar(255) NOT NULL,
  `programType` int(11) NOT NULL,
  `accLevel` varchar(255) NOT NULL,
  `accPhase` varchar(255) NOT NULL,
  `pppFile` varchar(255) NOT NULL,
  `attachedFile` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `programs`
--

INSERT INTO `programs` (`id`, `programs`, `programType`, `accLevel`, `accPhase`, `pppFile`, `attachedFile`) VALUES
(3, 'Bachelor of Secondary Education major in Sciences', 4, 'Level III', 'Phase II', 'sample file', '1573610103.pdf'),
(4, 'Bachelor of Secondary Education major in Technology & Livelihood Education', 4, 'Level III', 'Phase II', 'sample file', '1573610126.pdf'),
(5, 'Master in Teaching Technology Education', 1, 'Level III', 'Phase II', 'sample file', '1573610094.pdf'),
(8, 'Bachelor of Science in Computer Science', 4, '', '', 'sample file', '1573609661.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `programtype`
--

CREATE TABLE IF NOT EXISTS `programtype` (
`id` int(11) NOT NULL,
  `type` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `programtype`
--

INSERT INTO `programtype` (`id`, `type`) VALUES
(1, 'Graduate Studies'),
(4, 'Under Graduate Studies');

-- --------------------------------------------------------

--
-- Table structure for table `research`
--

CREATE TABLE IF NOT EXISTS `research` (
`id` int(11) NOT NULL,
  `research` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `researchfile` varchar(255) NOT NULL,
  `dateAdded` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `research`
--

INSERT INTO `research` (`id`, `research`, `content`, `researchfile`, `dateAdded`) VALUES
(9, 'Research', '<p>The melamine controversy that erupted during the last quarter of year 2008 brought people&rsquo;s attention back to the debates between breastfeeding and the use of breast milk substitutes like commercial infant formula. This wasn&rsquo;t the first time that infant formula had caused illnesses and even deaths to infants worldwide - hence the continuous campaign of World Health Organization (WHO) and UNICEF along with other breastfeeding advocates, for mothers to breastfeed their children at least until 6 months of age.</p>\r\n\r\n<p>Infant feeding practices refer generally to meet the nutritional and immunological needs of the baby. A study of infant feeding practices was carried out on a sample of 100 mother and infant pairs. The results revealed that only 20% of mothers in the study currently exclusively breastfeed their babies. It also shows that socio-economic factors like mother&rsquo;s work status, marital status and educational attainment had direct bearing on these practices. Employed mothers tend to cease from breastfeeding their babies and eventually stop and just resort to formula feeding as they go back to work. The study also showed that mothers who are married and living with their partners are more likely to breastfeed their infants than single mothers. Those with higher educational attainment resort more to formula feeding and mixed feeding than those with lower educational attainment. Health care professionals influence mothers the most when it comes to infant feeding decisions.</p>\r\n', '1572425819.pdf', '11/15/2019'),
(10, 'Introducing Smartphone Applications to Education: Analysis of Pros and Cons', '<p>Education is not an exception from this rule. In fact, technology has been integrated into the education processes throughout the years due to the fact it provides amazing tools that facilitate learning. Thanks to the internet, teachers, and professors have more resources to help children and students learn the lectures. On the other hand, students find it easier to keep up with school with many tools they can use to research, learn, and organize. With the rise of smartphones, we have the option to use applications (apps) for every aspect of our lives. Apps go beyond social media, it is possible to download a suitable application for everything. What about education? Would the introduction of apps into education have a positive or negative impact? Despite the fact all of us believe the impact would be positive or negative, the question is not easy to answer.</p>\r\n\r\n<p>We use our phones for everything today; to check emails, shop, book flights and hotels, pay bills, get food, and so much more. It is simple, anything one can do on the computer, he or she can also do on their smartphone. In this day and age, it is difficult to succeed at work and school without a smartphone primarily due to their convenience. Carrying laptops around can be a nuisance for people who are on the go, but smartphones fit perfectly into the pocket and offer same possibilities. Professors and teachers can benefit greatly from the introduction of mobile apps into education. For example, a number of scientists and experts in education explain that mobile technologies can create new opportunities for independent investigations, practical fieldwork, professional updating, and on the spot access to knowledge. At the same time, they provide the mechanism for enhanced individual guidance and learner support and more efficient course administration and management.</p>\r\n', '1573924566.pdf', '11/16/2019'),
(11, 'sample research', '<p>asdfasdf</p>\r\n', '1574009035.pdf', '11/17/2019');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE IF NOT EXISTS `students` (
`id` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `studentID` varchar(10) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `mname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `course` varchar(255) NOT NULL,
  `yearLevel` varchar(255) NOT NULL,
  `pcontact` varchar(11) NOT NULL,
  `qrcode` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `teacher_id`, `studentID`, `fname`, `mname`, `lname`, `course`, `yearLevel`, `pcontact`, `qrcode`) VALUES
(4, 9, '00111', 'Orlan', 'Ramirez', 'Fallado', 'BS Info Tech', '4th Year', '09468163654', '1573133329.png'),
(5, 9, '00112', 'Floramie', 'Duero', 'Parker', 'BS Info Tech', '4th Year', '09484006292', '1573141983.png'),
(6, 16, '00114', 'Joy', 'Salang', 'Ortiza', 'BS Info Tech', '4th Year', '09468163654', '1573178864.png'),
(7, 9, '00114', 'Joy', 'Salang', 'Ortiza', 'BS Info Tech', '4th Year', '09468163654', '1573185696.png'),
(8, 18, '123456', 'Orlan', 'Ramirez', 'Fallado', 'BS Info Tech', '4th Year', '09484006290', '1573447626.png'),
(9, 18, '123457', 'Joy', 'Salang', 'Ortiza', 'BS Info Tech', '4th Year', '09484006290', '1573447675.png'),
(10, 19, '201200763', 'Donita', 'Julve', 'Roz', 'IT', '4th Year', '09461323654', '1574043770.png');

-- --------------------------------------------------------

--
-- Table structure for table `topics`
--

CREATE TABLE IF NOT EXISTS `topics` (
`id` int(11) NOT NULL,
  `topicTitle` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `topics`
--

INSERT INTO `topics` (`id`, `topicTitle`) VALUES
(1, 'HTML: Basic Programming'),
(2, 'PHP Programming Language'),
(4, 'VB Programming'),
(5, 'C++ Progamming');

-- --------------------------------------------------------

--
-- Table structure for table `topic_contents`
--

CREATE TABLE IF NOT EXISTS `topic_contents` (
`id` int(11) NOT NULL,
  `topic` int(11) NOT NULL,
  `chapterTitle` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `attached_file` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `topic_contents`
--

INSERT INTO `topic_contents` (`id`, `topic`, `chapterTitle`, `content`, `attached_file`) VALUES
(11, 2, 'PHP: Introduction', '<h2>What is PHP?</h2>\r\n\r\n<ul>\r\n	<li>PHP is an acronym for &quot;PHP: Hypertext Preprocessor&quot;</li>\r\n	<li>PHP is a widely-used, open source scripting language</li>\r\n	<li>PHP scripts are executed on the server</li>\r\n	<li>PHP is free to download and use</li>\r\n</ul>\r\n\r\n<p>PHP is an amazing and popular language!</p>\r\n\r\n<p>It is powerful enough to be at the core of the biggest blogging system on the web (WordPress)!<br />\r\nIt is deep enough to run the largest social network (Facebook)!<br />\r\nIt is also easy enough to be a beginner&#39;s first server side language!</p>\r\n\r\n<hr />\r\n<h2>What is a PHP File?</h2>\r\n\r\n<ul>\r\n	<li>PHP files can contain text, HTML, CSS, JavaScript, and PHP code</li>\r\n	<li>PHP code is executed on the server, and the result is returned to the browser as plain HTML</li>\r\n	<li>PHP files have extension &quot;<code>.php</code>&quot;</li>\r\n</ul>\r\n\r\n<hr />\r\n<h2>What Can PHP Do?</h2>\r\n\r\n<ul>\r\n	<li>PHP can generate dynamic page content</li>\r\n	<li>PHP can create, open, read, write, delete, and close files on the server</li>\r\n	<li>PHP can collect form data</li>\r\n	<li>PHP can send and receive cookies</li>\r\n	<li>PHP can add, delete, modify data in your database</li>\r\n	<li>PHP can be used to control user-access</li>\r\n	<li>PHP can encrypt data</li>\r\n</ul>\r\n\r\n<p>With PHP you are not limited to output HTML. You can output images, PDF files, and even Flash movies. You can also output any text, such as XHTML and XML.</p>\r\n', '1571811826.pdf'),
(12, 1, 'Chapter 1: HTML: Introduction', '<p>something about the topic</p>\r\n', '1572310948.pdf'),
(13, 1, 'Chapter 2: HTML Links', '<p>all about links</p>\r\n', '1574045240.pdf'),
(14, 1, 'Chapter 3: HTML DIV', '<p>all about Div</p>\r\n', '1573371420.pdf'),
(15, 1, 'Chapter 4: HTML IMAGE', '<p>ALL ABOUT IMAGE</p>\r\n', '1573371439.pdf'),
(16, 1, 'Chapter 5: HTML Paragraph', '<p>all about paragraph</p>\r\n', '1573371467.pdf'),
(17, 1, 'Chapter 6: HTML TAGS', '<p>all about tags</p>\r\n', '1573371490.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `trainees`
--

CREATE TABLE IF NOT EXISTS `trainees` (
`id` int(11) NOT NULL,
  `studentID` varchar(255) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `mname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `civilstatus` varchar(255) NOT NULL,
  `sex` varchar(255) NOT NULL,
  `paddress` varchar(255) NOT NULL,
  `nationality` varchar(255) NOT NULL,
  `bdate` varchar(255) NOT NULL,
  `bplace` varchar(255) NOT NULL,
  `age` varchar(255) NOT NULL,
  `height` varchar(255) NOT NULL,
  `weight` varchar(255) NOT NULL,
  `fathername` varchar(255) NOT NULL,
  `foccupation` varchar(255) NOT NULL,
  `fcontact` varchar(255) NOT NULL,
  `mothername` varchar(255) NOT NULL,
  `moccupation` varchar(255) NOT NULL,
  `mcontact` varchar(255) NOT NULL,
  `elem` varchar(255) NOT NULL,
  `esy` varchar(255) NOT NULL,
  `secondary` varchar(255) NOT NULL,
  `hsy` varchar(255) NOT NULL,
  `tertiary` varchar(255) NOT NULL,
  `major` varchar(255) NOT NULL,
  `course` varchar(255) NOT NULL,
  `yearLevel` varchar(255) NOT NULL,
  `company_applied` varchar(255) NOT NULL,
  `registered` tinyint(1) NOT NULL,
  `login_id` varchar(36) NOT NULL,
  `studentpic` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `trainees`
--

INSERT INTO `trainees` (`id`, `studentID`, `fname`, `mname`, `lname`, `civilstatus`, `sex`, `paddress`, `nationality`, `bdate`, `bplace`, `age`, `height`, `weight`, `fathername`, `foccupation`, `fcontact`, `mothername`, `moccupation`, `mcontact`, `elem`, `esy`, `secondary`, `hsy`, `tertiary`, `major`, `course`, `yearLevel`, `company_applied`, `registered`, `login_id`, `studentpic`) VALUES
(3, '00111', 'Orlan', 'Ramirez', 'Fallado', 'Single', 'Male', 'Zone I, Lanuza, Surigao del Sur', 'Filipino', '07/29/1990', 'Lanuza, Surigao del Sur', '20', '5', '60KG', 'Father Fallado', 'Driver', '09116546541', 'Zeny Fallado', 'Housekeeper', '09481656546', 'Lanuza Central Elementary School', '2002-2003', 'Florita Herrera Irizari National High School', '2006-2007', 'Surigao del Sur State University', 'Computer', 'IT', '4th Year', 'apple company', 1, '5db872aab0828', '1574003916.jpg'),
(4, '00112', 'Floramie', 'Duero', 'Parker', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'IT', '4th Year', 'apple company', 1, '5dc036bd8d38f', ''),
(5, '00113', 'Jillmer', 'Intano', 'Donila', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'BS Info Tech', '4th Year', 'apple company', 1, '5dc4cbb154e89', ''),
(6, '00114', 'Joy', 'Salang', 'Ortiza', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'BS Info Tech', '4th Year', 'ABS-CBN', 0, '', ''),
(7, '00115', 'Jaria', 'Anggay', 'Batocapala', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'BS Info Tech', '4th Year', 'GMA Network', 0, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `userlogin`
--

CREATE TABLE IF NOT EXISTS `userlogin` (
`id` int(11) NOT NULL,
  `permission` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `joined` varchar(255) NOT NULL,
  `login_id` varchar(36) NOT NULL,
  `avatar` varchar(255) NOT NULL,
  `current_session` int(11) NOT NULL,
  `online` tinyint(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `userlogin`
--

INSERT INTO `userlogin` (`id`, `permission`, `username`, `password`, `fname`, `lname`, `joined`, `login_id`, `avatar`, `current_session`, `online`) VALUES
(2, 1, 'admin', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', 'dariel', 'bongabong', '2019-10-21 15:24:32', '', '1572797180.jpg', 0, 1),
(4, 2, 'qaadmin', '15e2b0d3c33891ebb0f1ef609ec419420c20e320ce94c65fbc8c3312448eb225', '', '', '2019-10-27 14:47:02', '', '', 0, 0),
(7, 9, 'orlanfallado', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', '', '', '2019-10-29 18:11:06', '5db872aab0828', '1572797180.jpg', 0, 0),
(8, 3, 'eladmin', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', '', '', '2019-11-03 13:54:34', '', '', 0, 0),
(9, 4, 'tadmin', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', '', '', '2019-11-03 13:55:38', '', '', 0, 0),
(10, 5, 'ojtadmin', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', '', '', '2019-11-03 13:57:22', '', '1572873391.jpg', 0, 0),
(11, 6, 'libraryadmin', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', '', '', '2019-11-03 13:58:45', '', '', 0, 0),
(12, 7, 'researchadmin', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', '', '', '2019-11-03 13:59:43', '', '', 0, 0),
(13, 8, 'exadmin', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', '', '', '2019-11-03 14:00:55', '', '', 0, 0),
(14, 9, 'fparker', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', '', '', '2019-11-04 15:33:33', '5dc036bd8d38f', '', 10, 1),
(15, 9, 'jillmer', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', '', '', '2019-11-08 02:58:09', '5dc4cbb154e89', '', 0, 0),
(16, 4, 'jaria123', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', '', '', '2019-11-08 03:06:04', '', '', 0, 0),
(18, 4, 'floramie', '15e2b0d3c33891ebb0f1ef609ec419420c20e320ce94c65fbc8c3312448eb225', 'Floramie', 'Parker', '2019-11-11 05:44:54', '', '1573448152.jpg', 0, 0),
(19, 4, 'obatay', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', '', '', '2019-11-18 03:04:20', '', '', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users_session`
--

CREATE TABLE IF NOT EXISTS `users_session` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `hash` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `articles`
--
ALTER TABLE `articles`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `books`
--
ALTER TABLE `books`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `booktransactions`
--
ALTER TABLE `booktransactions`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chat`
--
ALTER TABLE `chat`
 ADD PRIMARY KEY (`chatid`);

--
-- Indexes for table `chat_login_details`
--
ALTER TABLE `chat_login_details`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `class_info`
--
ALTER TABLE `class_info`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `extension`
--
ALTER TABLE `extension`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ojt_requirements`
--
ALTER TABLE `ojt_requirements`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `programs`
--
ALTER TABLE `programs`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `programtype`
--
ALTER TABLE `programtype`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `research`
--
ALTER TABLE `research`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `topics`
--
ALTER TABLE `topics`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `topic_contents`
--
ALTER TABLE `topic_contents`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `trainees`
--
ALTER TABLE `trainees`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `userlogin`
--
ALTER TABLE `userlogin`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `articles`
--
ALTER TABLE `articles`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=44;
--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `booktransactions`
--
ALTER TABLE `booktransactions`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `chat`
--
ALTER TABLE `chat`
MODIFY `chatid` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `chat_login_details`
--
ALTER TABLE `chat_login_details`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=77;
--
-- AUTO_INCREMENT for table `class_info`
--
ALTER TABLE `class_info`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `extension`
--
ALTER TABLE `extension`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `ojt_requirements`
--
ALTER TABLE `ojt_requirements`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `programs`
--
ALTER TABLE `programs`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `programtype`
--
ALTER TABLE `programtype`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `research`
--
ALTER TABLE `research`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `topics`
--
ALTER TABLE `topics`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `topic_contents`
--
ALTER TABLE `topic_contents`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `trainees`
--
ALTER TABLE `trainees`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `userlogin`
--
ALTER TABLE `userlogin`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=20;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
