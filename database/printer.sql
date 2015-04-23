-- MySQL dump 10.13  Distrib 5.5.40, for debian-linux-gnu (armv7l)
--
-- Host: localhost    Database: printer
-- ------------------------------------------------------
-- Server version	5.5.40-0ubuntu1
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO,POSTGRESQL' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table "migrations"
--

DROP TABLE IF EXISTS "migrations";
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE "migrations" (
  "migration" varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  "batch" int(11) NOT NULL
);
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table "migrations"
--

LOCK TABLES "migrations" WRITE;
/*!40000 ALTER TABLE "migrations" DISABLE KEYS */;
INSERT INTO "migrations" VALUES ('2015_03_14_195345_create_users_table',1),('2015_03_15_125008_create_orders_table',2),('2015_03_15_125052_create_posters_table',2),('2015_03_15_125108_create_papers_table',2),('2015_03_16_191656_add_deleted_at_to_table_user',3),('2015_03_17_214348_add_colors_to_posters',4);
/*!40000 ALTER TABLE "migrations" ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table "orders"
--

DROP TABLE IF EXISTS "orders";
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE "orders" (
  "id" int(10) unsigned NOT NULL,
  "user_id" int(10) unsigned NOT NULL,
  "order_status" tinyint(3) unsigned NOT NULL,
  "order_price" double(8,2) NOT NULL,
  "delivery_adress" text COLLATE utf8_unicode_ci NOT NULL,
  "created_at" timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  "updated_at" timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  "deleted_at" timestamp NULL DEFAULT NULL,
  PRIMARY KEY ("id"),
  KEY "orders_user_id_index" ("user_id"),
  CONSTRAINT "orders_user_id_foreign" FOREIGN KEY ("user_id") REFERENCES "users" ("id")
);
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table "orders"
--

LOCK TABLES "orders" WRITE;
/*!40000 ALTER TABLE "orders" DISABLE KEYS */;
INSERT INTO "orders" VALUES (1,1,2,2500.00,'??????, ?.????, ??. ?????????, ??? 1','2015-03-17 17:58:53','2015-03-22 17:12:30',NULL),(2,1,3,2500.00,'??????, ?.????, ??. ?????????, ??? 1','2015-03-21 11:32:21','2015-03-22 15:37:40',NULL),(3,1,1,2500.00,'??????, ?.????, ??. ?????????, ??? 1','2015-03-22 17:00:27','2015-03-25 17:38:26',NULL),(4,1,0,2500.00,'??????, ?.????, ??. ?????????, ??? 1','2015-03-22 19:24:58','2015-03-22 19:24:58',NULL),(5,2,0,2500.00,'??????, ?.????, ??. ?????????, ??? 1','2015-04-05 15:38:03','2015-04-05 15:38:03',NULL);
/*!40000 ALTER TABLE "orders" ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table "papers"
--

DROP TABLE IF EXISTS "papers";
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE "papers" (
  "id" int(10) unsigned NOT NULL,
  "name" varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  "description" text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY ("id")
);
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table "papers"
--

LOCK TABLES "papers" WRITE;
/*!40000 ALTER TABLE "papers" DISABLE KEYS */;
/*!40000 ALTER TABLE "papers" ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table "posters"
--

DROP TABLE IF EXISTS "posters";
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE "posters" (
  "id" int(10) unsigned NOT NULL,
  "order_id" int(10) unsigned NOT NULL,
  "maket_url" mediumtext COLLATE utf8_unicode_ci NOT NULL,
  "maket_status" tinyint(3) unsigned NOT NULL,
  "paper_id" int(10) unsigned NOT NULL,
  "colors" tinyint(3) unsigned NOT NULL,
  "w" double(8,2) NOT NULL,
  "h" double(8,2) NOT NULL,
  "quantity" int(10) unsigned NOT NULL,
  "poster_price" double(8,2) NOT NULL,
  "created_at" timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  "updated_at" timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  "deleted_at" timestamp NULL DEFAULT NULL,
  PRIMARY KEY ("id"),
  KEY "posters_order_id_index" ("order_id"),
  KEY "posters_paper_id_index" ("paper_id"),
  CONSTRAINT "posters_order_id_foreign" FOREIGN KEY ("order_id") REFERENCES "orders" ("id")
);
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table "posters"
--

LOCK TABLES "posters" WRITE;
/*!40000 ALTER TABLE "posters" DISABLE KEYS */;
INSERT INTO "posters" VALUES (20,1,'http://w.ru/link',1,1,1,444.00,444.00,1,1500.00,'2015-03-17 19:20:15','2015-03-21 11:24:59','2015-03-21 11:24:59'),(21,1,'http://ag.ru',1,3,8,300.00,400.00,2,1500.00,'2015-03-20 21:09:30','2015-03-21 11:06:15','2015-03-21 11:06:15'),(22,1,'www.mail.ru',1,4,4,44.00,33.00,1,1500.00,'2015-03-20 21:10:02','2015-03-21 11:27:11',NULL),(23,1,'www.mail.ru',1,2,4,21.00,344.00,1,1500.00,'2015-03-20 21:19:51','2015-03-21 11:27:14',NULL),(24,1,'http://www.hd.com',1,1,4,500.00,500.00,1,1500.00,'2015-03-21 06:11:55','2015-03-21 11:25:52',NULL),(25,2,'http://sdfsf.ru',0,3,1,400.00,400.00,3,1500.00,'2015-03-21 11:32:21','2015-03-21 11:32:21',NULL),(26,2,'http://google.com',0,5,4,456.00,456.00,2,1500.00,'2015-03-21 11:43:52','2015-03-21 12:24:07','2015-03-21 12:24:07'),(27,2,'http://www.yandex.ru',0,4,4,256.00,256.00,1,1500.00,'2015-03-21 12:24:34','2015-03-22 13:34:26','2015-03-22 13:34:26'),(28,2,'http://goo.com',0,1,4,499.00,499.00,1,1500.00,'2015-03-22 13:02:10','2015-03-22 13:02:10',NULL),(29,3,'http://jfjfjfjfj.com',0,1,4,450.00,30.00,1,1500.00,'2015-03-22 17:00:27','2015-03-22 17:10:45',NULL),(30,3,'http://www.rgg.com',1,2,8,66.00,444.00,1,1500.00,'2015-03-22 17:09:31','2015-03-22 17:09:31',NULL),(31,4,'http://ag.ru/asdasd/dddd',0,1,4,333.00,333.00,1,1500.00,'2015-03-22 19:25:51','2015-04-05 06:49:43','2015-04-05 06:49:43'),(32,4,'http://www.render.ru/asdfsdfsf',0,1,4,400.00,300.00,1,1500.00,'2015-04-05 06:45:24','2015-04-05 06:49:05','2015-04-05 06:49:05'),(33,4,'http://www.render.ru/asdfsdfsf',0,1,4,400.00,300.00,1,1500.00,'2015-04-05 06:45:41','2015-04-05 06:46:02','2015-04-05 06:46:02'),(34,4,'http://google.com/12234',0,3,4,40.00,40.00,3,1500.00,'2015-04-05 06:49:31','2015-04-05 06:49:31',NULL),(35,4,'http://help.com',2,4,4,33.00,44.00,1,1500.00,'2015-04-05 07:08:46','2015-04-05 07:08:46',NULL),(36,5,'http:\\\\apple.com',1,5,8,45.00,45.00,2,1500.00,'2015-04-05 15:38:04','2015-04-05 15:38:04',NULL),(37,5,'http://apple.com/kjhkhkh',0,2,1,50.00,50.00,1,1500.00,'2015-04-05 15:39:57','2015-04-05 16:34:13',NULL);
/*!40000 ALTER TABLE "posters" ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table "users"
--

DROP TABLE IF EXISTS "users";
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE "users" (
  "id" int(10) unsigned NOT NULL,
  "name" varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  "email" varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  "password" varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  "photo" varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  "active" tinyint(1) NOT NULL,
  "remember_token" varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  "created_at" timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  "updated_at" timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  "deleted_at" timestamp NULL DEFAULT NULL,
  PRIMARY KEY ("id"),
  UNIQUE KEY "users_email_unique" ("email")
);
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table "users"
--

LOCK TABLES "users" WRITE;
/*!40000 ALTER TABLE "users" DISABLE KEYS */;
INSERT INTO "users" VALUES (1,'?????? ?????????','dronowar@gmail.com','','https://lh4.googleusercontent.com/-3MPuWWmUOCQ/AAAAAAAAAAI/AAAAAAAAFDo/4MdENt36cvc/photo.jpg?sz=50',1,'F4MrOUH4IZnmvRBxTDpQ9yc4iCbkFS130siD00SB8YcHnVfJXh6WNSUBYHUP','2015-03-16 16:29:17','2015-04-05 06:56:35',NULL),(2,'?????? ?????????','ratengoods@gmail.com','','https://lh3.googleusercontent.com/-XdUIqdMkCWA/AAAAAAAAAAI/AAAAAAAAAAA/4252rscbv5M/photo.jpg?sz=50',1,'VIIrDN6UWNUkjleaXAuJKtIjgFgf5FVnUMwQuI3olEpSfGD3FtBHZ7UCSNVe','2015-04-05 15:17:23','2015-04-05 15:17:23',NULL);
/*!40000 ALTER TABLE "users" ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2015-04-09 12:04:01
