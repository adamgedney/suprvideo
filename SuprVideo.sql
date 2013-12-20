# ************************************************************
# Sequel Pro SQL dump
# Version 4096
#
# http://www.sequelpro.com/
# http://code.google.com/p/sequel-pro/
#
# Host: 127.0.0.1 (MySQL 5.5.25)
# Database: SuprVideo
# Generation Time: 2013-12-20 02:50:21 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table videos
# ------------------------------------------------------------

CREATE TABLE `videos` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `webm` varchar(100) DEFAULT NULL,
  `mp4` varchar(100) DEFAULT NULL,
  `mov` varchar(100) DEFAULT NULL,
  `ogv` varchar(100) DEFAULT NULL,
  `flv` varchar(100) DEFAULT NULL,
  `mp3` varchar(100) DEFAULT NULL,
  `shot_1` varchar(100) DEFAULT NULL,
  `shot_2` varchar(100) DEFAULT NULL,
  `shot_3` varchar(100) DEFAULT NULL,
  `poster` varchar(100) DEFAULT NULL,
  `title` varchar(100) DEFAULT NULL,
  `desc` varchar(284) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `videos` WRITE;
/*!40000 ALTER TABLE `videos` DISABLE KEYS */;

INSERT INTO `videos` (`id`, `webm`, `mp4`, `mov`, `ogv`, `flv`, `mp3`, `shot_1`, `shot_2`, `shot_3`, `poster`, `title`, `desc`)
VALUES
	(111,'uploads/cowscowscows.WebM','uploads/cowscowscows.mp4','uploads/cowscowscows.mov','uploads/cowscowscows.ogv','uploads/cowscowscows.flv','uploads/cowscowscows.mp3','uploads/shots/cowscowscows1.jpg','uploads/shots/cowscowscows2.jpg','uploads/shots/cowscowscows3.jpg','uploads/poster/cowscowscows.jpg','cowscowscows','The rain set early in tonight, The sullen wind was soon awake, It tore\nthe elm-tops down for spite, And did its worst to vex the lake: I\nlistened with heart fit to break. When glided in Porphyria; straight\nShe shut the cold out and the storm, And kneeled and made the\ncheerless grate '),
	(112,'uploads/WhiteTiger5.WebM','uploads/WhiteTiger5.mp4','uploads/WhiteTiger5.mov','uploads/WhiteTiger5.ogv','uploads/WhiteTiger5.flv','uploads/WhiteTiger5.mp3','uploads/shots/WhiteTiger51.jpg','uploads/shots/WhiteTiger52.jpg','uploads/shots/WhiteTiger53.jpg','uploads/poster/WhiteTiger5.jpg','WhiteTiger5','The rain set early in tonight, The sullen wind was soon awake, It tore\nthe elm-tops down for spite, And did its worst to vex the lake: I\nlistened with heart fit to break. When glided in Porphyria; straight\nShe shut the cold out and the storm, And kneeled and made the\ncheerless grate '),
	(113,'uploads/BananasExplodingonFace.WebM','uploads/BananasExplodingonFace.mp4','uploads/BananasExplodingonFace.mov','uploads/BananasExplodingonFace.ogv','uploads/BananasExplodingonFace.flv','uploads/BananasExplodingonFace.mp3','uploads/shots/BananasExplodingonFace1.jpg','uploads/shots/BananasExplodingonFace2.jpg','uploads/shots/BananasExplodingonFace3.jpg','uploads/poster/BananasExplodingonFace.jpg','BananasExplodingonFace','The rain set early in tonight, The sullen wind was soon awake, It tore\nthe elm-tops down for spite, And did its worst to vex the lake: I\nlistened with heart fit to break. When glided in Porphyria; straight\nShe shut the cold out and the storm, And kneeled and made the\ncheerless grate '),
	(114,'uploads/Dancingmanshrooms.WebM','uploads/Dancingmanshrooms.mp4','uploads/Dancingmanshrooms.mov','uploads/Dancingmanshrooms.ogv','uploads/Dancingmanshrooms.flv','uploads/Dancingmanshrooms.mp3','uploads/shots/Dancingmanshrooms1.jpg','uploads/shots/Dancingmanshrooms2.jpg','uploads/shots/Dancingmanshrooms3.jpg','uploads/poster/Dancingmanshrooms.jpg','Dancingmanshrooms','The rain set early in tonight, The sullen wind was soon awake, It tore\nthe elm-tops down for spite, And did its worst to vex the lake: I\nlistened with heart fit to break. When glided in Porphyria; straight\nShe shut the cold out and the storm, And kneeled and made the\ncheerless grate '),
	(120,'uploads/KerrysAliceMask.WebM','uploads/KerrysAliceMask.mp4','uploads/KerrysAliceMask.mov','uploads/KerrysAliceMask.ogv','uploads/KerrysAliceMask.flv','uploads/KerrysAliceMask.mp3','uploads/shots/KerrysAliceMask1.jpg','uploads/shots/KerrysAliceMask2.jpg','uploads/shots/KerrysAliceMask3.jpg','uploads/poster/KerrysAliceMask.jpg','KerrysAliceMask','The rain set early in tonight, The sullen wind was soon awake, It tore\nthe elm-tops down for spite, And did its worst to vex the lake: I\nlistened with heart fit to break. When glided in Porphyria; straight\nShe shut the cold out and the storm, And kneeled and made the\ncheerless grate '),
	(121,'uploads/IceCreamCom.WebM','uploads/IceCreamCom.mp4','uploads/IceCreamCom.mov','uploads/IceCreamCom.ogv','uploads/IceCreamCom.flv','uploads/IceCreamCom.mp3','uploads/shots/IceCreamCom1.jpg','uploads/shots/IceCreamCom2.jpg','uploads/shots/IceCreamCom3.jpg','uploads/poster/IceCreamCom.jpg','IceCreamCom','The rain set early in tonight, The sullen wind was soon awake, It tore\nthe elm-tops down for spite, And did its worst to vex the lake: I\nlistened with heart fit to break. When glided in Porphyria; straight\nShe shut the cold out and the storm, And kneeled and made the\ncheerless grate '),
	(122,'uploads/BritCom.WebM','uploads/BritCom.mp4','uploads/BritCom.mov','uploads/BritCom.ogv','uploads/BritCom.flv','uploads/BritCom.mp3','uploads/shots/BritCom1.jpg','uploads/shots/BritCom2.jpg','uploads/shots/BritCom3.jpg','uploads/poster/BritCom.jpg','BritCom','The rain set early in tonight, The sullen wind was soon awake, It tore\nthe elm-tops down for spite, And did its worst to vex the lake: I\nlistened with heart fit to break. When glided in Porphyria; straight\nShe shut the cold out and the storm, And kneeled and made the\ncheerless grate '),
	(123,'uploads/FunnyJapCom.WebM','uploads/FunnyJapCom.mp4','uploads/FunnyJapCom.mov','uploads/FunnyJapCom.ogv','uploads/FunnyJapCom.flv','uploads/FunnyJapCom.mp3','uploads/shots/FunnyJapCom1.jpg','uploads/shots/FunnyJapCom2.jpg','uploads/shots/FunnyJapCom3.jpg','uploads/poster/FunnyJapCom.jpg','FunnyJapCom','The rain set early in tonight, The sullen wind was soon awake, It tore\nthe elm-tops down for spite, And did its worst to vex the lake: I\nlistened with heart fit to break. When glided in Porphyria; straight\nShe shut the cold out and the storm, And kneeled and made the\ncheerless grate '),
	(124,'uploads/OldSpice.WebM','uploads/OldSpice.mp4','uploads/OldSpice.mov','uploads/OldSpice.ogv','uploads/OldSpice.flv','uploads/OldSpice.mp3','uploads/shots/OldSpice1.jpg','uploads/shots/OldSpice2.jpg','uploads/shots/OldSpice3.jpg','uploads/poster/OldSpice.jpg','OldSpice','The rain set early in tonight, The sullen wind was soon awake, It tore\nthe elm-tops down for spite, And did its worst to vex the lake: I\nlistened with heart fit to break. When glided in Porphyria; straight\nShe shut the cold out and the storm, And kneeled and made the\ncheerless grate '),
	(125,'uploads/ThaiTV.WebM','uploads/ThaiTV.mp4','uploads/ThaiTV.mov','uploads/ThaiTV.ogv','uploads/ThaiTV.flv','uploads/ThaiTV.mp3','uploads/shots/ThaiTV1.jpg','uploads/shots/ThaiTV2.jpg','uploads/shots/ThaiTV3.jpg','uploads/poster/ThaiTV.jpg','ThaiTV','The rain set early in tonight, The sullen wind was soon awake, It tore\nthe elm-tops down for spite, And did its worst to vex the lake: I\nlistened with heart fit to break. When glided in Porphyria; straight\nShe shut the cold out and the storm, And kneeled and made the\ncheerless grate '),
	(126,'uploads/JapanCom.WebM','uploads/JapanCom.mp4','uploads/JapanCom.mov','uploads/JapanCom.ogv','uploads/JapanCom.flv','uploads/JapanCom.mp3','uploads/shots/JapanCom1.jpg','uploads/shots/JapanCom2.jpg','uploads/shots/JapanCom3.jpg','uploads/poster/JapanCom.jpg','JapanCom','The rain set early in tonight, The sullen wind was soon awake, It tore\nthe elm-tops down for spite, And did its worst to vex the lake: I\nlistened with heart fit to break. When glided in Porphyria; straight\nShe shut the cold out and the storm, And kneeled and made the\ncheerless grate ');

/*!40000 ALTER TABLE `videos` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
