-- MySQL dump 10.13  Distrib 5.5.41, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: chat
-- ------------------------------------------------------
-- Server version	5.5.41-0ubuntu0.14.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `channel`
--

DROP TABLE IF EXISTS `channel`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `channel` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sender_id` int(11) NOT NULL,
  `receiver_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `channel`
--

LOCK TABLES `channel` WRITE;
/*!40000 ALTER TABLE `channel` DISABLE KEYS */;
INSERT INTO `channel` VALUES (3,10,11),(4,12,10),(5,12,11);
/*!40000 ALTER TABLE `channel` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `message`
--

DROP TABLE IF EXISTS `message`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `message` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `channel_id` int(11) NOT NULL,
  `message` text NOT NULL,
  `username` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=79 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `message`
--

LOCK TABLES `message` WRITE;
/*!40000 ALTER TABLE `message` DISABLE KEYS */;
INSERT INTO `message` VALUES (13,3,'Hello','user'),(24,3,'  Lorem Ipsum е елементарен примерен текст, използван в печатарската и типографската индустрия. Lorem Ipsum е индустриален стандарт от около 1500 година, когато неизвестен печатар взема няколко печатарски букви и ги разбърква, за да напечата с тях книга с примерни шрифтове. Този начин не само е оцелял повече от 5 века, но е навлязъл и в публикуването на електронни издания като е запазен почти без промяна. Популяризиран е през 60те години на 20ти век със издаването на Letraset листи, съдържащи Lorem Ipsum пасажи, популярен е и в наши дни във софтуер за печатни издания като Aldus PageMaker, който включва различни версии на Lorem Ipsum.  Известен факт е, че читателя обръща внимание на съдържанието, което чете, а не на оформлението му. Свойството на Lorem Ipsum е, че до голяма степен има нормално разпределение на буквите и се чете по-лесно, за разлика от нормален текст на английски език като &#34;Това е съдържание, това е съдържание&#34;. Много системи за публикуване и редактори на Уеб страници използват Lorem Ipsum като примерен текстов модел &#34;по подразбиране&#34;, поради което при търсене на фразата &#34;lorem ipsum&#34; в Интернет ще бъдат открити много сайтове в процес на разработка. Някой от тези сайтове биват променяни с времето, а други по случайност или нарочно(за забавление и пр.) биват оставяни в този си незавършен вид.    Противно на всеобщото вярване, Lorem Ipsum не е просто случаен текст. Неговите корени са в класическата Латинска литература от 45г.пр.Хр., което прави преди повече от 2000 години. Richard McClintock, професор по Латински от колежа Hampden-Sydney College във Вирджиния, изучавайки една от най-неясните латински думи &#34;consectetur&#34; в един от пасажите на Lorem Ipsum, и търсейки цитати на думата в класическата литература, открива точния източник. Lorem Ipsum е намерен в секции 1.10.32 и 1.10.33 от &#34;de Finibus Bonorum et Malorum&#34;(Крайностите на Доброто и Злото) от Цицерон, написан през 45г.пр.Хр. Тази книга е трактат по теория на етиката, много популярна през Ренесанса. Първият ред на Lorem Ipsum идва от ред, намерен в секция 1.10.32.  Стандартният отрязък от Lorem Ipsum, използван от 1500 г. насам, е поместен по-долу за тези, които се интересуват. Секции 1.10.32 и 1.10.33 от &#34;de Finibus Bonorum et Malorum&#34; на Цицерон също са поместени в оригиналния им формат, заедно с превода им на английски език, направен от H. Rackham през 1914г.  Съществуват много вариации на пасажа Lorem Ipsum, но повечето от тях са променени по един или друг начин чрез добавяне на смешни думи или разбъркване на думите, което не изглежда много достоверно. Ако искате да използвате пасаж от Lorem Ipsum, трябва да сте сигурни, че в него няма смущаващи или нецензурни думи. Всички Lorem Ipsum генератори в Интернет използват предефинирани пасажи, който се повтарят, което прави този този генератор първия истински такъв. Той използва речник от над 200 латински думи, комбинирани по подходящ начин като изречения, за да генерират истински Lorem Ipsum пасажи. Оттук следва, че генерираният Lorem Ipsum пасаж не съдържа повторения, смущаващи, нецензурни и всякакви неподходящи думи.','user'),(25,4,'asdasad','anotherUSer'),(26,4,'asdasdadasdas','anotherUSer'),(27,5,'qqqq','anotherUSer'),(28,5,'dsfsdfsdfs','user'),(29,5,'Hello','user'),(30,3,'Hello nice to meet you','karborator'),(31,4,'waazaaa','karborator'),(32,5,'aaaa','user'),(33,3,'lalalala','karborator'),(34,3,' ala]','karborator'),(35,4,' qqqqq','karborator'),(36,4,'sho staaa','anotherUSer'),(37,5,'sho staa ?','anotherUSer'),(38,3,'NEW ','user'),(39,3,'NEW2','user'),(40,3,'NEW3','user'),(41,4,'nqkoj ?                         ','anotherUSer'),(42,4,'EXOO','anotherUSer'),(43,4,'exxoooooo','anotherUSer'),(44,4,'babababab','anotherUser'),(45,4,'kvo ?','anotherUSer'),(46,4,'aaaaaaa?????','anotherUSer'),(52,4,'aaa?','karborator'),(53,4,'nishto, si4ko 6','anotherUSer'),(54,4,'zamalko da zaraboti basi    ','anotherUser'),(55,4,'E kvo stava sq ?','anotherUSer'),(56,4,'Ebi mu mamata','anotherUSer'),(57,4,'Hui','anotherUSer'),(58,4,'rrrrr','anotherUSer'),(59,4,'raboti :))) ','anotherUSer'),(60,4,'REND','anotherUSer'),(61,4,'TEST 4','anotherUSer'),(62,4,'LQGAI DA SPISH','anotherUSer'),(63,4,'aaaaa','anotherUSer'),(64,4,'qqq','anotherUSer'),(65,4,'mashala','anotherUSer'),(66,4,'heheeee','anotherUSer'),(67,4,'adasds','karborator'),(68,4,' asdasdasdasd','karborator'),(69,4,' asdaasd','karborator'),(70,4,'qweqeqwe','karborator'),(71,4,' asdasdas','karborator'),(72,4,' qqqq','karborator'),(73,4,'kaji be dupe','anotherUSer'),(74,4,' ma sho staa bre brat','karborator'),(75,4,'biem patoka','anotherUSer'),(76,4,'asdasd','karborator'),(77,4,'asdasdasd','karborator'),(78,4,'qqq','anotherUSer');
/*!40000 ALTER TABLE `message` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `session`
--

DROP TABLE IF EXISTS `session`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `session` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `session` varchar(500) NOT NULL,
  `active` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `session`
--

LOCK TABLES `session` WRITE;
/*!40000 ALTER TABLE `session` DISABLE KEYS */;
INSERT INTO `session` VALUES (15,10,'$2a$12$8F.rj19hdRhHjihYKd5YluwCTFA6Yi3XPbpyYDx6VZf4YJji8s.Fu',1),(17,11,'$2a$12$m.W9dgCcMHL1kLiOiNQY/enO2qWFAvODOU61Hp/3UxL6njOU/zmWO',1),(18,12,'$2a$12$brDHG43bBRoM3bYUMgPp..YSgcuIGUJmlvOxtVnJES/oyuCAvJi66',1);
/*!40000 ALTER TABLE `session` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(64) NOT NULL,
  `email` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (10,'karborator','$2a$08$L.8mxWlG15cmSOS0puGxE.6uICADiNLcx.DqRyIUWkbH3uMZGfUE2','karboratorr@gmail.com'),(11,'user','$2a$12$AnBDJ03C4eIvN6BrvQ2TauQaVWMApHZYvX7dA67kXSZU4LFd39tJS','user@gmail.com'),(12,'anotherUSer','$2a$12$QWu6jdJzjHKP32aDlyCJIefG7ED/ho8XxAzexpWmfR8bK8hGGs91e','another@mail.bg');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2015-03-30 17:29:34
