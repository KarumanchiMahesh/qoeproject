-- phpMyAdmin SQL Dump
-- version 4.1.7
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 10, 2014 at 09:38 AM
-- Server version: 5.5.35-0+wheezy1
-- PHP Version: 5.3.3-7+squeeze19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

CREATE DATABASE users_quality;
USE users_quality;

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `users_quality`
--

-- --------------------------------------------------------

--
-- Table structure for table `users_count`
--
create table if not exists `users_count`(`s.no` int(11) not null AUTO_INCREMENT,`subject_id` varchar(255) not null,primary key(`s.no`)); 

--
-- Table structure for table `questions` 
--


create table if not exists `questions` (`taskid` int(11) not null, `formid` int(11) not null, `question` varchar(255) not null, `option1` varchar(255) not null, `option2` varchar(255) not null, `option3` varchar(255) not null, `correct` varchar(255) not null);

--
-- Dumping data into table `questions`
--
--
-- table structure for table new
--

INSERT INTO `questions` (`taskid`, `formid`,  `question`, `option1`, `option2`, `option3`, `correct`) VALUES
(1, 1,  'What color clothing did the mechanic wear?', 'Blue', 'Red', 'Yellow', 1),
(1, 3,  'What color clothing did the mechanic wear?', 'Red', 'Yellow', 'Blue', 3),
(1, 5,  'What color clothing did the mechanic wear?', 'Red', 'Blue', 'Yellow', 2),
(2, 1,  'What was present in both videos?', 'Vehicles', 'Animals', 'Figurines', 1),
(2, 3, 'What was present in both videos?', 'Animals', 'Figurines', 'Vehicles', 3),
(2, 5,  'What was present in both videos?', 'Figurines', 'Vehicles', 'Animals', 2),
(3, 1,  'What kind of vehicle did the person drive?', 'Motorbike', 'Car', 'Truck', 1),
(3, 3,  'What kind of vehicle did the person drive?', 'Car', 'Truck', 'Motorbike', 3),
(3, 5,  'What kind of vehicle did the person drive?', 'Truck', 'Motorbike', 'Car', 2),
(4, 1, 'What kind of vehicle did the person drive?', 'Truck', 'Motorbike', 'Car', 2),
(4, 3, 'What kind of vehicle did the person drive?', 'Motorbike', 'Truck', 'Car', 1),
(4, 5, 'What kind of vehicle did the person drive?', 'Car', 'Truck', 'Motorbike', 3),
(5, 1, 'What color was the blouse in the middle of the clip?', 'Black', 'Red', 'Blue', 2),
(5, 3, 'What color was the blouse in the middle of the clip?', 'Red', 'Black', 'Blue', 1),
(5, 5, 'What color was the blouse in the middle of the clip?', 'Blue', 'Black', 'Red', 3),
(6, 1, 'What kind of vehicle did the person drive?', 'Motorbike', 'Truck', 'Car', 1),
(6, 3, 'What kind of vehicle did the person drive?', 'Car', 'Motorbike', 'Truck', 2),
(6, 5, 'What kind of vehicle did the person drive?', 'Truck', 'Car', 'Motorbike', 3),
(7, 1, 'How many videos contained stopping?', '2', '0', '1', 2),
(7, 3, 'How many videos contained stopping?', '0', '1', '2', 1),
(7, 5, 'How many videos contained stopping?', '2', '1', '0', 3),
(8, 1, 'What was visible in both videos?', 'People', 'Telephones', 'Dogs', 1),
(8, 3, 'What was visible in both videos?', 'Telephones', 'People', 'Dogs', 2),
(8, 5, 'What was visible in both videos?', 'Dogs', 'Telephones', 'People', 3),
(9, 1, 'What was shown in the end of one video?', 'Text', 'Woods', 'Airplanes', 1),
(9, 3, 'What was shown in the end of one video?', 'Woods', 'Text', 'Airplanes', 2),
(9, 5, 'What was shown in the end of one video?', 'Airplanes', 'Woods', 'Text', 3),
(10, 1, 'What kind of content was shown in the videos?', 'Sports', 'News', 'Movie', 2),
(10, 3, 'What kind of content was shown in the videos?', 'Movie', 'Sports', 'News', 3),
(10, 5, 'What kind of content was shown in the videos?', 'News', 'Sports', 'Movie', 1),
(11, 1, 'What was shown below the red telephone?', 'Numbers', 'Barcodes', 'Signatures', 1),
(11, 3, 'What was shown below the red telephone?', 'Signatures', 'Barcodes', 'Numbers', 3),
(11, 5, 'What was shown below the red telephone?', 'Barcodes', 'Numbers', 'Signatures', 2),
(12, 1, 'How many of the videos contained stoppings?', '2', '1', '0', 3),
(12, 3, 'How many of the videos contained stoppings?', '0', '1', '2', 1),
(12, 5, 'How many of the videos contained stoppings?', '2', '0', '1', 2),
(13, 1, 'What activity was shown the videos?', 'Swimming', 'Dancing', 'Running', 2),
(13, 3, 'What activity was shown the videos?', 'Dancing', 'Swimming', 'Running', 1),
(13, 5, 'What activity was shown the videos?', 'Running', 'Swimming', 'Dancing', 3),
(14, 1, 'What activity was shown in the videos?', 'Running', 'Fighting', 'Dancing', 3),
(14, 3, 'What activity was shown in the videos?', 'Dancing', 'Fighting', 'Running', 1),
(14, 5, 'What activity was shown in the videos?', 'Running', 'Dancing', 'Fighting', 2);
/*(43, 'test1', 'test2', 'Which activity was shown in both videos?', 'Racing', 'Fighting', 'Dancing', 3),
(44, 'test1', 'test2', 'Which activity was shown in both videos?', 'Racing', 'Dancing', 'Fighting', 2),
(45, 'test1', 'test2', 'Which activity was shown in both videos?', 'Dancing', 'Fighting', 'Racing', 1),
(46, 'test1', 'test2', 'What color clothing did the oldest man wear?', 'Black', 'Red', 'Blue', 1),
(47, 'test1', 'test2', 'What color clothing did the oldest man wear?', 'Red', 'Black', 'Blue', 2),
(48, 'test1', 'test2', 'What color clothing did the oldest man wear?', 'Blue', 'Red', 'Black', 3),
(49, 'test1', 'test2', 'What activity was shown in the videos?', 'Dancing', 'Fighting', 'Swimming', 1),
(50, 'test1', 'test2', 'What activity was shown in the videos?', 'Fighting', 'Dancing', 'Swimming', 2),
(51, 'test1', 'test2', 'What activity was shown in the videos?', 'Swimming', 'Fighting', 'Dancing', 3),
(52, 'test1', 'test2', 'What activity was shown in the videos?', 'Dancing', 'Fighting', 'Racing', 1),
(53, 'test1', 'test2', 'What activity was shown the videos?', 'Fighting', 'Dancing', 'Racing', 2),
(54, 'test1', 'test2', 'What activity was shown the videos?', 'Racing', 'Fighting', 'Dancing', 3),
(55, 'test1', 'test2', 'What was visible in both clips?', 'Car(s)', 'Bike(s)', 'Airplane(s)', 1),
(56, 'test1', 'test2', 'What was visible in both clips?', 'Bike(s)', 'Car(s)', 'Airplane(s)', 2),
(57, 'test1', 'test2', 'What was visible in both clips?', 'Airplane(s)', 'Bike(s)', 'Car(s)', 3),
(58, 'test1', 'test2', 'What kind of car were in the videos?', 'Police Car', 'Ambulance', 'Fire Truck', 1),
(59, 'test1', 'test2', 'What kind of car were in the videos?', 'Ambulance', 'Police Car', 'Fire Truck', 2),
(60, 'test1', 'test2', 'What kind of car were in the videos?', 'Fire Truck', 'Ambulance', 'Police Car', 3),
(61, 'test1', 'test2', 'What kind of vehicle were in the videos?', 'Police Car', 'Ambulance', 'Fire Truck', 1),
(62, 'test1', 'test2', 'What kind of vehicle were in the videos?', 'Ambulance', 'Police Car', 'Fire Truck', 2),
(63, 'test1', 'test2', 'What kind of vehicle were in the videos?', 'Fire Truck', 'Ambulance', 'Police Car', 3),
(64, 'test1', 'test2', 'What kind of vehicle were in the videos?', 'Police Car', 'Ambulance', 'Fire Truck', 1),
(65, 'test1', 'test2', 'What kind of vehicle were in the videos?', 'Ambulance', 'Police Car', 'Fire Truck', 2),
(66, 'test1', 'test2', 'What kind of vehicle were in the videos?', 'Fire Truck', 'Ambulance', 'Police Car', 3),
(67, 'test1', 'test2', 'What kind of vehicle were in the videos?', 'Police Car', 'Ambulance', 'Fire Truck', 1),
(68, 'test1', 'test2', 'What kind of vehicle were in the videos?', 'Ambulance', 'Police Car', 'Fire Truck', 2),
(69, 'test1', 'test2', 'What kind of vehicle were in the videos?', 'Fire Truck', 'Ambulance', 'Police Car', 3),
(70, 'test1', 'test2', 'What was present in both videos?', 'Car(s)', 'Bike(s)', 'Airplane(s)', 1),
(71, 'test1', 'test2', 'What was present in both videos?', 'Bike(s)', 'Car(s)', 'Airplane(s)', 2),
(72, 'test1', 'test2', 'What was present in both videos?', 'Airplane(s)', 'Bike(s)', 'Car(s)', 3),
(73, 'test1', 'test2', 'What kind of content was shown in the videos?', 'Sports', 'News', 'Movie', 1),
(74, 'test1', 'test2', 'What kind of content was shown in the videos?', 'News', 'Sports', 'Movie', 2),
(75, 'test1', 'test2', 'What kind of content was shown in the videos?', 'Movie', 'News', 'Sports', 3),
(76, 'test1', 'test2', 'What kind of content was shown in the videos?', 'Sports', 'News', 'Movie', 1),
(77, 'test1', 'test2', 'What kind of content was shown in the videos?', 'News', 'Sports', 'Movie', 2),
(78, 'test1', 'test2', 'What kind of content was shown in the videos?', 'Movie', 'News', 'Sports', 3),
(79, 'test1', 'test2', 'What kind of content was shown in the videos?', 'Sports', 'News', 'Movie', 1),
(80, 'test1', 'test2', 'What kind of content was shown in the videos?', 'News', 'Sports', 'Movie', 2),
(81, 'test1', 'test2', 'What kind of content was shown in the videos?', 'Movie', 'News', 'Sports', 3),
(82, 'test1', 'test2', 'What kind of content was shown in the videos?', 'Sports', 'News', 'Movie', 1),
(83, 'test1', 'test2', 'What kind of content was shown in the videos?', 'News', 'Sports', 'Movie', 2),
(84, 'test1', 'test2', 'What kind of content was shown in the videos?', 'Movie', 'News', 'Sports', 3),
(85, 'test1', 'test2', 'What kind of content was shown in the videos?', 'Sports', 'News', 'Movie', 1),
(86, 'test1', 'test2', 'What kind of content was shown in the videos?', 'News', 'Sports', 'Movie', 2),
(87, 'test1', 'test2', 'What kind of content was shown in the videos?', 'Movie', 'News', 'Sports', 3),
(88, 'test1', 'test2', 'What kind of content was shown in the videos?', 'Sports', 'News', 'Movie', 1),
(89, 'test1', 'test2', 'What kind of content was shown in the videos?', 'News', 'Sports', 'Movie', 2),
(90, 'test1', 'test2', 'What kind of content was shown in the videos?', 'Movie', 'News', 'Sports', 3),
(91, 'test1', 'test2', 'What was present in both videos?', 'Pirates', 'Ninjas', 'Robots', 1),
(92, 'test1', 'test2', 'What was present in both videos?', 'Ninjas', 'Pirates', 'Robots', 2),
(93, 'test1', 'test2', 'What was present in both videos?', 'Robots', 'Ninjas', 'Pirates', 3),
(94, 'test1', 'test2', 'What was present in both videos?', 'Pirates', 'Ninjas', 'Robots', 1),
(95, 'test1', 'test2', 'What was present in both videos?', 'Ninjas', 'Pirates', 'Robots', 2),
(96, 'test1', 'test2', 'What was present in both videos?', 'Robots', 'Ninjas', 'Pirates', 3),
(97, 'test1', 'test2', 'What was present in both videos?', 'Pirates', 'Ninjas', 'Robots', 1),
(98, 'test1', 'test2', 'What was present in both videos?', 'Ninjas', 'Pirates', 'Robots', 2),
(99, 'test1', 'test2', 'What was present in both videos?', 'Robots', 'Ninjas', 'Pirates', 3),
(100, 'test1', 'test2', 'What was present in both videos?', 'Pirates', 'Ninjas', 'Robots', 1),
(102, 'test1', 'test2', 'What was present in both videos?', 'Robots', 'Ninjas', 'Pirates', 3),
(101, 'test1', 'test2', 'What was present in both videos?', 'Ninjas', 'Pirates', 'Robots', 2),
(103, 'test1', 'test2', 'What was present in both videos?', 'Pirates', 'Ninjas', 'Robots', 1),
(105, 'test1', 'test2', 'What was present in both videos?', 'Robots', 'Ninjas', 'Pirates', 3),
(104, 'test1', 'test2', 'What was present in both videos?', 'Ninjas', 'Pirates', 'Robots', 2),
(106, 'test1', 'test2', 'What was present in both videos?', 'Pirates', 'Ninjas', 'Robots', 1),(`task_id`, `Video_id1`, `Video_id2`, `Question`, `Answer1`, `Answer2`, `Answer3`, `Correct`)
(107, 'test1', 'test2', 'What was present in both videos?', 'Ninjas', 'Pirates', 'Robots', 2),
(108, 'test1', 'test2', 'What was present in both videos?', 'Robots', 'Ninjas', 'Pirates', 3),
(109, 'test1', 'test2', 'What type of event were shown in the videos?', 'Concert', 'Wedding', 'Demonstration', 1),
(111, 'test1', 'test2', 'What type of event were shown in the videos?', 'Demonstration', 'Wedding', 'Concert', 3),
(110, 'test1', 'test2', 'What type of event were shown in the videos?', 'Wedding', 'Concert', 'Demonstration', 2),
(112, 'test1', 'test2', 'What type of event were shown in the videos?', 'Concert', 'Wedding', 'Demonstration', 1),
(113, 'test1', 'test2', 'What type of event were shown in the videos?', 'Wedding', 'Concert', 'Demonstration', 2),
(114, 'test1', 'test2', 'What type of event were shown in the videos?', 'Demonstration', 'Wedding', 'Concert', 3),
(115, 'test1', 'test2', 'What type of event were shown in the videos?', 'Concert', 'Wedding', 'Demonstration', 1),
(116, 'test1', 'test2', 'What type of event were shown in the videos?', 'Wedding', 'Concert', 'Demonstration', 2),
(117, 'test1', 'test2', 'What type of event were shown in the videos?', 'Demonstration', 'Wedding', 'Concert', 3),
(118, 'test1', 'test2', 'What type of event were shown in the videos?', 'Concert', 'Wedding', 'Demonstration', 1),
(119, 'test1', 'test2', 'What type of event were shown in the videos?', 'Wedding', 'Concert', 'Demonstration', 2),
(122, 'test1', 'test2', 'What type of event were shown in the videos?', 'Wedding', 'Concert', 'Demonstration', 2),
(123, 'test1', 'test2', 'What type of event were shown in the videos?', 'Demonstration', 'Wedding', 'Concert', 3),
(121, 'test1', 'test2', 'What type of event were shown in the videos?', 'Concert', 'Wedding', 'Demonstration', 1),
(120, 'test1', 'test2', 'What type of event were shown in the videos?', 'Demonstration', 'Wedding', 'Concert', 3),
(124, 'test1', 'test2', 'What type of event were shown in the videos?', 'Concert', 'Wedding', 'Demonstration', 1),
(125, 'test1', 'test2', 'What type of event were shown in the videos?', 'Wedding', 'Concert', 'Demonstration', 2),
(126, 'test1', 'test2', 'What type of event were shown in the videos?', 'Demonstration', 'Wedding', 'Concert', 3);*/

-- -------------------------------------------------------

--
-- Table structure for table `screentest`
--

CREATE TABLE IF NOT EXISTS `screentest` (
  `Name` varchar(30) COLLATE latin1_general_ci NOT NULL,
  `Lowest` int(1) NOT NULL,
  `Highest` int(1) NOT NULL,
  `Star8` tinyint(1) NOT NULL,
  `Star1` tinyint(1) NOT NULL,
  `Star2` tinyint(1) NOT NULL,
  `Star3` tinyint(1) NOT NULL,
  `Star4` tinyint(1) NOT NULL,
  `Star5` tinyint(1) NOT NULL,
  `Star6` tinyint(1) NOT NULL,
  `Star7` tinyint(1) NOT NULL,
  `Time` int(11) NOT NULL,
  `ClickNum` int(11) NOT NULL,
  `Score` int(4) NOT NULL,
  PRIMARY KEY (`Name`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `results`
--
create table if not exists `results` (
`subject_no` int(11) not null,
`subject_id` varchar(255) not null,
`age` varchar(255) not null,
`gender` varchar(10) not null,
`hours` varchar(100) not null,
`environment` varchar(100) not null,
`trailvid1` varchar(100) not null,
`trailvid1rating` int(1) not null,
`trailvid2` varchar(100) not null,
`trailvid2rating` int(1) not null,
`vid1` varchar(100) not null,
`vid1rating` int(1) not null,
`question1` varchar(255) not null,
`ansrec1` int(1) not null,
`correct1` int(1) not null,
`vid2` varchar(100) not null,
`vid2rating` int(1) not null,
`vid3` varchar(100) not null,
`question3` varchar(255) not null,
`ansrec3` int(1) not null,
`correct3` int(1) not null,
`vid4` varchar(100) not null,
`vid4rating` int(1) not null,
`vid5` varchar(100) not null,
`question5` varchar(255) not null,
`ansrec5` int(1) not null,
`correct5` int(1) not null,

`vid6` varchar(100) not null,
`vid6rating` int(1) not null,primary key (`subject_no`));



-- --------------------------------------------------------

--
-- Table structure for table `video_storage`
--
create table if not exists `video_storage` (
`id` int(11) not null AUTO_INCREMENT,
`video_name` varchar(255) not null,
primary key (`id`))ENGINE = InnoDB;


--
-- Dumping data for table `video_storage`
--

insert into `video_storage` (`video_name`) values ('test1'),('test2');


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

--
-- Table structure for table `tasks_completed`
--
create table if not exists `tasks_completed` (`subject_id` varchar(255) not null,`token_no` int(11) not null,`numcompleted` int(5) not null,`viewcompleted` int(2) not null, primary key (`subject_id`)); 

--
-- Table structure for table `temporary_data`
--



create table if not exists `temporary_data` (
`subject_no` int(11) not null,
`subject_id` varchar(255) not null,
`age` varchar(255) not null,
`gender` varchar(10) not null,
`hours` varchar(100) not null,
`environment` varchar(100) not null,
`trailvid1` varchar(100) not null,
`trailvid1rating` int(1) not null,
`trailvid2` varchar(100) not null,
`trailvid2rating` int(1) not null,
`vid1` varchar(100) not null,
`vid1rating` int(1) not null,
`question1` varchar(255) not null,
`ansrec1` int(1) not null,
`correct1` int(1) not null,
`vid2` varchar(100) not null,
`vid2rating` int(1) not null,
`vid3` varchar(100) not null,
`question3` varchar(255) not null,
`ansrec3` int(1) not null,
`correct3` int(1) not null,
`vid4` varchar(100) not null,
`vid4rating` int(1) not null,
`vid5` varchar(100) not null,
`question5` varchar(255) not null,
`ansrec5` int(1) not null,
`correct5` int(1) not null,

`vid6` varchar(100) not null,
`vid6rating` int(1) not null,primary key (`subject_no`));

