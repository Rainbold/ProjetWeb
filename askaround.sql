-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Sam 26 Avril 2014 à 09:06
-- Version du serveur: 5.6.12-log
-- Version de PHP: 5.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `askaround`
--
CREATE DATABASE IF NOT EXISTS `askaround` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `askaround`;

-- --------------------------------------------------------

--
-- Structure de la table `aa_ask`
--

CREATE TABLE IF NOT EXISTS `aa_ask` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_quest` int(11) NOT NULL,
  `title` text NOT NULL,
  `text` text NOT NULL,
  `date` int(11) NOT NULL,
  `author_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Contenu de la table `aa_ask`
--

INSERT INTO `aa_ask` (`id`, `id_quest`, `title`, `text`, `date`, `author_id`) VALUES
(1, -1, 'Why would the same identical SQL queries return a different result?', 'I have two ActiveRecord queries. One returns 4 which is the right number, and the other returns 11, which is the wrong count. I would have expected both queries to return 4. Even the SQL rendered in Rails console are identical for both AR queries.', 1398181774, 7),
(2, -1, 'QProcess: how to read output from pactl', 'I am trying to run this bash command\r\n\r\n$pactl list sinks short | grep 10_B7_F6_02_1B_4A\r\nin my c++ project using QProcess and to get the output using readAllStandardOutput() as shown in this post. When I put echo at the beginning of the command and put 10_B7_F6_02_1B_4A before the pipe, I get the correct output into my QByteArray. However, the output format of pactl seems to be different than that of echo. In the terminal it looks like this:', 1398181874, 7),
(3, 1, 'CodeIgniter User Guide Version 2.1.4', 'CodeIgniter comes with a full-featured and very fast abstracted database class that supports both traditional structures and Active Record patterns. The database functions offer clear, simple syntax.', 1398185971, 7),
(4, 1, 'Why build strings with helper functions in javascript?', 'Saw this on https://developers.google.com/speed/articles/optimizing-javascript\r\n\r\nCan someone please explain how this is more efficient, i.e., why this avoids temporary string results?\r\n\r\nBuild up long strings by passing string builders (either an array or a helper class) into functions, to avoid temporary result strings.\r\n\r\nFor example, assuming buildMenuItemHtml_ needs to build up a string from literals and variables and would use a string builder internally, instead of using:\r\n\r\nvar strBuilder = [];\r\nfor (var i = 0, length = menuItems.length; i < length; i++) {\r\n  strBuilder.push(this.buildMenuItemHtml_(menuItems[i]));\r\n}\r\nvar menuHtml = strBuilder.join();\r\n', 1398185971, 7),
(5, -1, 'Add a View to the EditorArea in an Eclipse RAP application', 'I''m having the same problem the user has identified in this post: http://www.eclipse.org/forums/index.php/t/87617/\r\n\r\nSumming up, I need to add a View to the Editor Area in an eclipse RAP application. Something like this: http://www.fotos-hochladen.net/stackingaviewwithane9e1fdbvp.png\r\n\r\nAn answer was already given to the author of this post, saying:\r\n\r\nI guess Wrapping it to a EditorPart is the most easy and logical thing.\r\n\r\nBut I have no idea how to accomplish this! Can anyone help me?', 1397672769, 7),
(6, -1, 'Java - Behavior of Class Members of Generic Classes', 'If you declare an instance of a generic class as a raw type in Java, does the compiler assume a parametrized type of Object for all class member methods? Does this extend even to those methods which return some form (e.g. a Collection) of a concrete parametrized type?\r\n\r\nI erroneously declared an instance of a generic class without a parametrized type, which led to very interesting downstream effects. I''ve provided a simplified example of a scenario which produced an ''incompatible types'' compilation error. My basic question: Why does javac produce an ''incompatible types'' error, complaining about the indicated line below?', 1396895169, 7),
(7, -1, 'Blablabla', 'BlablablaBlablablaBlablablaBlablablaBlablablaBlablabla\r\nBlablablaBlablabla\r\nBlablablaBlablablaBlablabla\r\n\r\n\r\nBlablablaBlablablaBlablablaBlablablaBlablabla\r\nBlablabla\r\nBlablablaBlablablaBlablablaBlablabla', 1398264859, 7);

-- --------------------------------------------------------

--
-- Structure de la table `aa_users`
--

CREATE TABLE IF NOT EXISTS `aa_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pseudo` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(32) NOT NULL,
  `color` varchar(6) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Contenu de la table `aa_users`
--

INSERT INTO `aa_users` (`id`, `pseudo`, `email`, `password`, `color`) VALUES
(1, 'pseudo', 'test@test.fr', 'aa36dc6e81e2ac7ad03e12fedcb6a2c0', '82c2cf'),
(2, 'RainbowLyte', 'test@aei.fr', '1fb0e331c05a52d5eb847d6fc018320d', '82c2cf'),
(3, 'Maxime', 'max@lyte.fr', '05a671c66aefea124cc08b76ea6d30bb', '65be04'),
(4, 'RainbowLyte42', 'rootazdaz@azdazd.fr', 'fb907665e5a25cd116c79c122ebc1e4f', 'ae57d4'),
(5, 'zefzef', 'root@root.fr', 'c9cfe3fc782e26917a95e00eb4c27509', '3f3e71'),
(6, 'admin', 'admin@ad.fr', '97213fdaa876115be22ab7662e4cedde', '02bf02'),
(7, 'Lyte', 'admin@lyte.fr', '05a671c66aefea124cc08b76ea6d30bb', '7e0a47');

-- --------------------------------------------------------

--
-- Structure de la table `aa_views`
--

CREATE TABLE IF NOT EXISTS `aa_views` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_ask` int(11) NOT NULL,
  `ip` varchar(15) NOT NULL,
  `time` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Contenu de la table `aa_views`
--

INSERT INTO `aa_views` (`id`, `id_ask`, `ip`, `time`) VALUES
(1, 5, '152.0.3.9', 1398184985),
(2, 5, '152.0.3.10', 1398184985),
(3, 5, '152.0.3.11', 1398185022),
(4, 1, '152.0.3.12', 1398185022),
(5, 2, '156.3.1.0', 1398185072),
(6, 2, '172.0.0.1', 1398185072),
(7, 1, '192.168.0.1', 1397931969);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
