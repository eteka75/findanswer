-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Mar 07 Mars 2017 à 15:59
-- Version du serveur :  5.6.17
-- Version de PHP :  5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `qr`
--

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=45 ;

--
-- Contenu de la table `categories`
--

INSERT INTO `categories` (`id`, `nom`) VALUES
(1, 'Agence de voyage'),
(2, 'Cabinet de conseil'),
(3, 'Cabinet juridique'),
(4, 'Cause'),
(5, 'Collège'),
(6, 'Commerce de détail'),
(7, 'Compagnie d’assurance'),
(8, 'Compagnie de Tabac'),
(9, 'Constructeur automobile'),
(10, 'École'),
(11, 'École maternelle'),
(12, 'École primaire'),
(13, 'Enseignement supérieur'),
(14, 'Entreprise'),
(15, 'Entreprise agricole'),
(16, 'Entreprise agroalimentaire'),
(17, 'Entreprise de biotechnologie'),
(18, 'Entreprise de cargo et de fret'),
(19, 'Entreprise de production et de distribution d’énergie'),
(20, 'Entreprise de produits chimiques'),
(21, 'Entreprise de télécommunications'),
(22, 'Entreprise du secteur aérospatial'),
(23, 'Entreprise du secteur médical'),
(24, 'Entreprise informatique'),
(25, 'Établissement financier'),
(26, 'Formation'),
(27, 'Fournisseur d’accès à Internet'),
(28, 'Lycée'),
(29, 'Organisation'),
(30, 'Organisation à but non lucratif'),
(31, 'Organisation gouvernementale'),
(32, 'Organisation Non Gouvernementale (ONG)'),
(33, 'Organisation politique'),
(34, 'Organisation religieuse'),
(35, 'Organisme communautaire'),
(36, 'Parti politique'),
(37, 'Santé/beauté'),
(38, 'Science et ingénierie'),
(39, 'Service communautaire'),
(40, 'Société de médias/d’actualités'),
(41, 'Société industrielle'),
(42, 'Société minière'),
(43, 'Syndicat'),
(44, 'Autres');

-- --------------------------------------------------------

--
-- Structure de la table `entreprises`
--

CREATE TABLE IF NOT EXISTS `entreprises` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `logo` varchar(255) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(255) NOT NULL,
  `detail` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `categorie_id` int(11) NOT NULL,
  `etat_compte` enum('0','1') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Contenu de la table `entreprises`
--

INSERT INTO `entreprises` (`id`, `nom`, `logo`, `email`, `password`, `detail`, `created_at`, `categorie_id`, `etat_compte`) VALUES
(1, 'Glo Bénin', 'uploads/mini_1488471256.jpg', 'dzzddzzddz@zddz.fr', 'c2ba7e785c49050f48da9aacc45c2b85', 'Mtn Général Service', '2017-03-02 16:14:16', 1, '1'),
(2, 'Université d''Abomey Calavi', 'uploads/mini_1488471346.png', 'uac@uac.bj', '52b199448e26ab25de775bcded676a2a', 'La plus grande Université du Bénin', '2017-03-02 16:15:46', 10, '1'),
(3, 'Collège Catholique de Porto-Novo', '', 'cat@gmail.com', 'ce24335c5d3a7ff0a2ef3137951b547f', 'Collège génial', '2017-03-02 16:21:09', 5, '1'),
(4, 'MAMOU Voyage', 'uploads/mini_1488473754.png', 'mamou@mamou.com', '5d575525989cdd9c4e095520c7866ac9', 'Voyage en direct', '2017-03-02 16:55:55', 1, '1'),
(5, 'KNAR Bénin', '', 'ent1@ent.com', 'e20dbffc407b689a2f5c5a601e60a6ed', '', '2017-03-03 17:00:24', 1, '1'),
(6, 'BADOU SERVICE', 'uploads/mini_1488473754.png', 'mamou@mamou.com', '5d575525989cdd9c4e095520c7866ac9', 'Voyage en direct', '2017-03-02 16:55:55', 1, '1'),
(7, 'IMSP Bénin\r\n', 'uploads/mini_1488471346.png', 'uac@uac.bj', '52b199448e26ab25de775bcded676a2a', 'La plus grande Université du Bénin', '2017-03-02 16:15:46', 10, '1'),
(8, 'BÃ©nin tÃ©lÃ©com', 'uploads_2854/mini_1488893302.jpg', 'btelecom@btelecom.com', '468b7f3a7aa007fd1387aa088952ec38', 'SociÃ©tÃ© de l''Etat bÃ©ninois', '2017-03-07 13:28:23', 2, '1');

-- --------------------------------------------------------

--
-- Structure de la table `entreprise_question`
--

CREATE TABLE IF NOT EXISTS `entreprise_question` (
  `id_entreprise` int(11) NOT NULL,
  `id_question` int(11) NOT NULL,
  `reponse` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_entreprise`,`id_question`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `entreprise_question`
--

INSERT INTO `entreprise_question` (`id_entreprise`, `id_question`, `reponse`, `created_at`, `updated_at`) VALUES
(1, 2, 'Design Beautiful Websites Quicker\r\nSemantic is a development framework that helps create beautiful, responsive layouts using human-friendly HTML.', '2017-03-06 22:23:11', '2017-03-06 22:23:11'),
(1, 3, 'The good news is that there are a handful of alternatives that are much leaner than Bootstrap or Foundation. Most of these frameworks ship with just the right amount of styles and components to help you get started, while allowing you to be able to extend them in the direction you want for your project.\r\n\r\nHere are 10 lightweight alternatives to Bootstrap and Foundation that you should use for building smaller-scale websites.\r\n\r\nMore on Hongkiat.com:', '2017-03-06 22:23:11', '2017-03-06 22:23:11'),
(2, 4, 'Concise HTML\r\n\r\nSemantic UI treats words and classes as exchangeable concepts.\r\n\r\nClasses use syntax from natural languages like noun/modifier relationships, word order, and plurality to link concepts intuitively.\r\n\r\nGet the same benefits as BEM or SMACSS, but without the tedium.\r\n\r\n<div class="ui three buttons">\r\n  <button class="ui active button">One</button>\r\n  <button class="ui button">Two</button>\r\n  <button class="ui button">Three</button>\r\n</div>\r\nOne\r\nTwo\r\nThree\r\nIntuitive Javascript\r\n\r\nSemantic uses simple phrases called behaviors that trigger functionality.\r\n\r\nAny arbitrary decision in a component is included as a setting that developers can modify.\r\n\r\nRun Code\r\n$(''select.dropdown'')\r\n  .dropdown(''set selected'', [''meteor'', ''ember''])\r\n;\r\n<select name="skills" multiple="" class="ui fluid dropdown">\r\n  <option value="">Skills</option>\r\n  <option value="angular">Angular</option>\r\n  <option value="css">CSS</option>\r\n  <option value="ember">Ember</option>\r\n  <option value="html">HTML</option>\r\n  <option value="javascript">Javascript</option>\r\n  <option value="meteor">Meteor</option>\r\n  <option value="node">NodeJS</option>\r\n</select>\r\nSkillsAngularCSSEmberHTMLJavascriptMeteorNodeJS\r\nSimplified Debugging\r\n\r\nPerformance logging lets you track down bottlenecks without digging through stack traces.\r\n\r\nDon''t have access to development tools right now? Check out this short clip.\r\nRun Code\r\n$(''.sequenced.images .image'')\r\n  .transition({\r\n    debug     : true,\r\n    animation : ''jiggle'',\r\n    duration  : 500,\r\n    interval  : 200\r\n  })\r\n;\r\n    \r\nSemantic is growing fast. Want to see just how much? Sign up and we''ll let you know\r\n\r\n\r\nE-mail\r\n  Sign-up\r\n', '2017-03-06 22:23:11', '2017-03-06 22:23:11'),
(3, 3, 'The .box element is simply a container with a shadow, a border, a radius, and some padding. \r\nFor example, you can include a media object:\r\nImage\r\nJohn Smith @johnsmith 31m \r\nLorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean efficitur sit amet massa fringilla egestas. Nullam condimentum luctus turpis.\r\n', '2017-03-06 22:23:11', '2017-03-06 22:23:11'),
(4, 3, 'Add Pure to Your Page\r\n\r\nYou can add Pure to your page via the free unpkg CDN. Just add the following <link> element into your page''s <head>, before your project''s stylesheets.\r\n\r\n<link rel="stylesheet" href="https://unpkg.com/purecss@0.6.2/build/pure-min.css" integrity="sha384-UQiGfs9ICog+LwheBSRCt1o5cbyKIHbwjWscjemyBMT9YCUMZffs6UqUTd0hObXD" crossorigin="anonymous">\r\nAlternatively, you can download Pure, or check out other CDNs that host Pure.\r\n\r\nAdd the Viewport Meta Element\r\n\r\nThe viewport meta element lets you control the the width and scale of the viewport on mobile browsers. Since you''re building a responsive website, you want the width to be equal to the device''s native width. Add this into your page''s <head>.\r\n\r\n<meta name="viewport" content="width=device-width, initial-scale=1">\r\nUnderstand Pure Grids\r\n\r\nPure''s grid system is very simple. You create a row by using the .pure-g class, and create columns within that row by using the pure-u-* classes.\r\n\r\nHere''s a grid with three columns:\r\n\r\n<div class="pure-g">\r\n    <div class="pure-u-1-3"><p>Thirds</p></div>\r\n    <div class="pure-u-1-3"><p>Thirds</p></div>\r\n    <div class="pure-u-1-3"><p>Thirds</p></div>\r\n</div>\r\nThirds\r\n\r\nThirds\r\n\r\nThirds\r\n\r\nResponsive Grids\r\n\r\nPure''s grid system is also mobile-first and responsive, and you''re able to customize the grid by specifying CSS Media Query breakpoints and grid classnames. If needed, you can customize Pure Grids below, but let''s start off with an example.\r\n\r\nYou''ll need to also include Pure''s grids-responsive.css onto your page:\r\n\r\n<!--[if lte IE 8]>\r\n    <link rel="stylesheet" href="https://unpkg.com/purecss@0.6.2/build/grids-responsive-old-ie-min.css">\r\n<![endif]-->\r\n<!--[if gt IE 8]><!-->\r\n    <link rel="stylesheet" href="https://unpkg.com/purecss@0.6.2/build/grids-r\r\n', '2017-03-06 22:23:11', '2017-03-06 22:23:11'),
(5, 3, 'Columns\r\n\r\nA simple way to build responsive columns\r\n\r\nTo build a grid, just:\r\n\r\nAdd a columns container\r\nAdd as many column elements as you want\r\nEach column will have an equal width, no matter the number of columns.\r\nFirst column\r\nSecond column\r\nThird column\r\nFourth column\r\n<div class="columns">\r\n  <div class="column">\r\n    First column\r\n  </div>\r\n  <div class="column">\r\n    Second column\r\n  </div>\r\n  <div class="column">\r\n    Third column\r\n  </div>\r\n  <div class="column">\r\n    Fourth column\r\n  </div>\r\n</div>\r\nCopy\r\nSizes\r\n\r\nIf you want to change the size of a single column, you can use one the following classes:\r\n\r\nis-three-quarters\r\nis-two-thirds\r\nis-half\r\nis-one-third\r\nis-one-quarter\r\nThe other columns will fill up the remaining space automatically.\r\nis-three-quarters\r\nAuto\r\nAuto\r\nis-two-thirds\r\nAuto\r\nAuto\r\nis-half\r\nAuto\r\nAuto\r\nis-one-third\r\nAuto\r\nAuto\r\nis-one-quarter\r\nAuto\r\n<div class="columns">\r\n  <div class="column is-three-quarters">\r\n    <p class="notification is-info">\r\n      <code class="html">is-three-quarters</code>\r\n    </p>\r\n  </div>\r\n  <div class="column">\r\n    <p class="notification is-warning">Auto</p>\r\n  </div>\r\n  <div class="column">\r\n    <p class="notification is-danger">Auto</p>\r\n  </div>\r\n</div>\r\n\r\n<div class="columns">\r\n  <div class="column is-two-thirds">\r\n    <p class="notification is-info">\r\n      <code class="html">is-two-thirds</code>\r\n    </p>\r\n  </div>\r\n  <div class="column">\r\n    <p class="notification is-warning">Auto</p>\r\n  </div>', '2017-03-06 22:23:11', '2017-03-06 22:23:11'),
(6, 3, 'Grids Media Queries\r\n\r\nYou can use Pure''s default CSS Media Queries which will add grids-responsive.css to your Pure Starter Kit, or we can generate a mobile-first, responsive grid if you provide us with the breakpoints.\r\n\r\nPure''s generated Responsive Grids is simple to use. It provides you with a specific CSS classname for each Media Query. For example, pure-u-md-* for devices with width >= 768px, and pure-u-lg-* for devices with width >= 1024px.\r\n\r\nWhat Media Queries should your grid system respond to?\r\n\r\nUse Default Media Queries   Add Media Query\r\nGrid Options\r\n\r\nPure has a 5ths and 24ths-column grid system by default. You define an element''s width using fractional classnames, e.g; .pure-u-2-5 for width: 40%, or .pure-u-12-24 for width: 50%. You can view all the grid units that are available in the default grid.\r\n\r\nYou can customize the number of columns; the default grid is 24 columns. You can also change the Grids classname prefix; the default is .pure-u-.\r\n\r\nNumber of Columns   \r\n24\r\nGrid Prefix   \r\n.pure-u-\r\nYour Pure Starter Kit will be generated below in real-time as you mak', '2017-03-06 22:23:11', '2017-03-06 22:23:11');

-- --------------------------------------------------------

--
-- Structure de la table `questions`
--

CREATE TABLE IF NOT EXISTS `questions` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `libelle` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Contenu de la table `questions`
--

INSERT INTO `questions` (`id`, `libelle`, `created_at`) VALUES
(1, 'Comment s''appelle le directeur ?', '2017-03-04 07:22:48'),
(2, 'Quels sont les produits que vous vendez ?', '2017-03-04 07:22:48'),
(3, 'Comment trouvez vous vos fornisseurs', '2017-03-04 07:34:12'),
(5, 'question_categoriequestion_categoriequestion_categoriequestion_categoriequestion_categorie', '2017-03-04 07:36:50'),
(7, 'Quel sont vos adresses', '2017-03-04 07:45:25');

-- --------------------------------------------------------

--
-- Structure de la table `question_categorie`
--

CREATE TABLE IF NOT EXISTS `question_categorie` (
  `id_question` int(11) NOT NULL,
  `id_categorie` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `recherches`
--

CREATE TABLE IF NOT EXISTS `recherches` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date_recherche` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `question` varchar(255) NOT NULL,
  `reponses` varchar(5) NOT NULL,
  `satisfait` enum('non','oui','') DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `suggestion_questions`
--

CREATE TABLE IF NOT EXISTS `suggestion_questions` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `libelle` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `entreprise_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) NOT NULL,
  `prenom` int(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `photo` varchar(255) NOT NULL,
  `date_inscription` timestamp NOT NULL,
  `password` varchar(255) NOT NULL,
  `etat_compte` enum('0','1') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
