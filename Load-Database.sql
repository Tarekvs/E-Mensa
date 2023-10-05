-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server Version:               10.9.4-MariaDB - mariadb.org binary distribution
-- Server Betriebssystem:        Win64
-- HeidiSQL Version:             11.3.0.6295
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Exportiere Datenbank Struktur für emensawerbeseite
CREATE DATABASE IF NOT EXISTS `emensawerbeseite` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci */;
USE `emensawerbeseite`;

-- Exportiere Struktur von Tabelle emensawerbeseite.allergen
CREATE TABLE IF NOT EXISTS `allergen` (
  `code` char(4) NOT NULL COMMENT 'Offizieller Abkürzungsbuchstabe für das Allergen.',
  `name` varchar(300) NOT NULL COMMENT 'Name des Allergens, wie "Glutenhaltiges Getreide".',
  `typ` varchar(20) DEFAULT 'allergen' COMMENT 'Gibt den Typ an. Standard: "allergen"',
  PRIMARY KEY (`code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Exportiere Daten aus Tabelle emensawerbeseite.allergen: ~21 rows (ungefähr)
/*!40000 ALTER TABLE `allergen` DISABLE KEYS */;
INSERT INTO `allergen` (`code`, `name`, `typ`) VALUES
	('a', 'Getreideprodukte', 'Getreide (Gluten)'),
	('a1', 'Weizen', 'Allergen'),
	('a2', 'Roggen', 'Allergen'),
	('a3', 'Gerste', 'Allergen'),
	('a4', 'Dinkel', 'Allergen'),
	('a5', 'Hafer', 'Allergen'),
	('a6', 'Kamut', 'Allergen'),
	('b', 'Fisch', 'Allergen'),
	('c', 'Krebstiere', 'Allergen'),
	('d', 'Schwefeldioxid/Sulfit', 'Allergen'),
	('e', 'Sellerie', 'Allergen'),
	('f', 'Milch und Laktose', 'Allergen'),
	('f1', 'Butter', 'Allergen'),
	('f2', 'Käse', 'Allergen'),
	('f3', 'Margarine', 'Allergen'),
	('g', 'Sesam', 'Allergen'),
	('h', 'Nüsse', 'Allergen'),
	('h1', 'Mandeln', 'Allergen'),
	('h2', 'Haselnüsse', 'Allergen'),
	('h3', 'Walnüsse', 'Allergen'),
	('i', 'Erdnüsse', 'Allergen');
/*!40000 ALTER TABLE `allergen` ENABLE KEYS */;

-- Exportiere Struktur von Tabelle emensawerbeseite.benutzer
CREATE TABLE IF NOT EXISTS `benutzer` (
  `id` int(5) NOT NULL AUTO_INCREMENT COMMENT 'Eindeutige ID, auto-inkrement',
  `name` varchar(200) NOT NULL COMMENT 'Name, der auch auf der Oberfläche dargestellt wird.',
  `email` varchar(100) NOT NULL COMMENT 'Eindeutige E-Mail der Benutzer:in. Teil der Anmeldung.',
  `passwort` varchar(200) NOT NULL COMMENT 'Speicherung des Passwort-Hashs mit SHA-1.',
  `admin` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'Markierung, ob es sich um einen Administrator handelt oder nicht. Standard: false.',
  `anzahlfehler` int(5) NOT NULL DEFAULT 0 COMMENT 'Zähler, wie oft hintereinander eine Anmeldung erfolglos durchgeführt wurde. Standard: 0.',
  `anzahlanmeldungen` int(5) NOT NULL COMMENT 'Zähler, wie oft eine Anmeldung insgesamt erfolgreich durchgeführt wurde.',
  `letzteanmeldung` datetime DEFAULT NULL COMMENT 'Zeitpunkt, an dem sich der/die Benutzer:in zuletzt erfolgreich angemeldet hat.',
  `letzterfehler` datetime DEFAULT NULL COMMENT 'Zeitpunkt, an dem sich der/die Benutzer:in zuletzt erfolglos angemeldet hat.',
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Exportiere Daten aus Tabelle emensawerbeseite.benutzer: ~3 rows (ungefähr)
/*!40000 ALTER TABLE `benutzer` DISABLE KEYS */;
INSERT INTO `benutzer` (`id`, `name`, `email`, `passwort`, `admin`, `anzahlfehler`, `anzahlanmeldungen`, `letzteanmeldung`, `letzterfehler`) VALUES
	(3, 'Jonas', 'test@mail.com', '476289ea5c262aaa47474d090c7daa22f69ff5e9', 1, 1, 35, '2023-01-04 05:01:41', '2023-01-04 09:01:55'),
	(4, 'Peter', 'peter@mail.com', '476289ea5c262aaa47474d090c7daa22f69ff5e9', 0, 0, 19, '2022-12-27 12:12:33', NULL),
	(5, 'noadmin', 'noadmin@mail.com', '476289ea5c262aaa47474d090c7daa22f69ff5e9', 0, 0, 2, '2023-01-04 05:01:07', NULL);
/*!40000 ALTER TABLE `benutzer` ENABLE KEYS */;

-- Exportiere Struktur von Tabelle emensawerbeseite.bewertungen
CREATE TABLE IF NOT EXISTS `bewertungen` (
  `bewertungs_id` int(11) NOT NULL AUTO_INCREMENT,
  `benutzer` varchar(50) DEFAULT NULL,
  `datum` date DEFAULT NULL,
  `bemerkung` text DEFAULT NULL,
  `bewertung` int(11) DEFAULT NULL,
  `gericht_id` int(11) DEFAULT NULL,
  `markiert` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`bewertungs_id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Bewertungen der Nutzer';

-- Exportiere Daten aus Tabelle emensawerbeseite.bewertungen: ~9 rows (ungefähr)
/*!40000 ALTER TABLE `bewertungen` DISABLE KEYS */;
INSERT INTO `bewertungen` (`bewertungs_id`, `benutzer`, `datum`, `bemerkung`, `bewertung`, `gericht_id`, `markiert`) VALUES
	(15, 'Jonas', '2023-01-04', 'Code Übungen', 3, 13, 0),
	(18, 'User', '2023-01-03', 'Code Übungen', 1, 1, 0),
	(19, 'User', '2023-01-06', 'Code Übungen', 2, 1, 1),
	(23, 'Jonas', '2023-01-04', 'Auch gut', 1, 21, 1),
	(24, 'Jonas', '2023-01-04', 'Käsebrot ist ein gutes Brot', 2, 16, 1),
	(25, 'Jonas', '2023-01-04', 'Tofu mit Soya', 1, 4, 0),
	(26, 'Jonas', '2023-01-04', 'Schmeckt!', 1, 12, 0),
	(27, 'Jonas', '2023-01-04', 'Nicht so lecker', 4, 17, 1),
	(28, 'Jonas', '2023-01-04', 'Test123', 2, 3, 0);
/*!40000 ALTER TABLE `bewertungen` ENABLE KEYS */;

-- Exportiere Struktur von Tabelle emensawerbeseite.ersteller
CREATE TABLE IF NOT EXISTS `ersteller` (
  `Name` varchar(50) NOT NULL DEFAULT 'anonym',
  `E-Mail` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Exportiere Daten aus Tabelle emensawerbeseite.ersteller: ~0 rows (ungefähr)
/*!40000 ALTER TABLE `ersteller` DISABLE KEYS */;
/*!40000 ALTER TABLE `ersteller` ENABLE KEYS */;

-- Exportiere Struktur von Tabelle emensawerbeseite.gericht
CREATE TABLE IF NOT EXISTS `gericht` (
  `id` int(8) NOT NULL COMMENT 'Primärschlüssel',
  `name` varchar(80) NOT NULL COMMENT 'Name des Gerichts. Name ist eindeutig',
  `beschreibung` varchar(800) NOT NULL COMMENT 'Beschreibung des Gerichts',
  `erfasst_am` date NOT NULL COMMENT 'Zeitpunkt der ersten Erfassung des Gerichts',
  `vegetarisch` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'Markierung, ob das Gericht vegetarisch ist. Standard: Nein',
  `vegan` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'Markierung, ob das Gericht vegan ist. Standard: Nein',
  `preis_intern` double NOT NULL COMMENT 'Preis für interne Personen (wie Studierende). Es gilt immer preis_intern > 0',
  `preis_extern` double NOT NULL COMMENT 'Preis für externe Personen (wie Gastdozent:innen)',
  `bildname` varchar(200) DEFAULT NULL COMMENT 'Name der Bilddatei, die das Gericht darstellt. Standard: null.',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`),
  CONSTRAINT `preis_intern_biggerzero` CHECK (0 < `preis_intern`),
  CONSTRAINT `preis_intern_smallerextern` CHECK (`preis_intern` <= `preis_extern`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Exportiere Daten aus Tabelle emensawerbeseite.gericht: ~20 rows (ungefähr)
/*!40000 ALTER TABLE `gericht` DISABLE KEYS */;
INSERT INTO `gericht` (`id`, `name`, `beschreibung`, `erfasst_am`, `vegetarisch`, `vegan`, `preis_intern`, `preis_extern`, `bildname`) VALUES
	(1, 'Bratkartoffeln mit Speck und Zwiebeln', 'Kartoffeln mit Zwiebeln und gut Speck', '2020-08-25', 0, 0, 2.3, 4, '01_bratkartoffel.jpg'),
	(3, 'Bratkartoffeln mit Zwiebeln', 'Kartoffeln mit Zwiebeln und ohne Speck', '2020-08-25', 1, 1, 2.3, 4, '03_bratkartoffel.jpg'),
	(4, 'Grilltofu', 'Fein gewürzt und mariniert', '2020-08-25', 1, 1, 2.5, 4.5, '04_tofu.jpg'),
	(5, 'Lasagne', 'Klassisch mit Bolognesesoße und Creme Fraiche', '2020-08-24', 0, 0, 2.5, 4.5, NULL),
	(6, 'Lasagne vegetarisch', 'Klassisch mit Sojagranulatsoße und Creme Fraiche', '2020-08-24', 1, 0, 2.5, 4.5, '06_lasagne.jpg'),
	(7, 'Hackbraten', 'Nicht nur für Hacker', '2020-08-25', 0, 0, 2.5, 4, NULL),
	(8, 'Gemüsepfanne', 'Gesundes aus der Region, deftig angebraten', '2020-08-25', 1, 1, 2.3, 4, NULL),
	(9, 'Hühnersuppe', 'Suppenhuhn trifft Petersilie', '2020-08-25', 0, 0, 2, 3.5, '09_suppe.jpg'),
	(10, 'Forellenfilet', 'mit Kartoffeln und Dilldip', '2020-08-22', 0, 0, 3.8, 5, '10_forelle.jpg'),
	(11, 'Kartoffel-Lauch-Suppe', 'der klassische Bauchwärmer mit frischen Kräutern', '2020-08-22', 1, 0, 2, 3, '11_soup.jpg'),
	(12, 'Kassler mit Rosmarinkartoffeln', 'dazu Salat und Senf', '2020-08-23', 0, 0, 3.8, 5.2, '12_kassler.jpg'),
	(13, 'Drei Reibekuchen mit Apfelmus', 'grob geriebene Kartoffeln aus der Region', '2020-08-23', 1, 0, 2.5, 4.5, '13_reibekuchen.jpg'),
	(14, 'Pilzpfanne', 'die legendäre Pfanne aus Pilzen der Saison', '2020-08-23', 1, 0, 3, 5, NULL),
	(15, 'Pilzpfanne vegan', 'die legendäre Pfanne aus Pilzen der Saison ohne Käse', '2020-08-24', 1, 1, 3, 5, '15_pilze.jpg'),
	(16, 'Käsebrötchen', 'schmeckt vor und nach dem Essen', '2020-08-24', 1, 0, 1, 1.5, '17_broetchen.jpg'),
	(17, 'Schinkenbrötchen', 'schmeckt auch ohne Hunger', '2020-08-25', 0, 0, 1.25, 1.75, NULL),
	(18, 'Tomatenbrötchen', 'mit Schnittlauch und Zwiebeln', '2020-08-25', 1, 1, 1, 1.5, NULL),
	(19, 'Mousse au Chocolat', 'sahnige schweizer Schokolade rundet jedes Essen ab', '2020-08-26', 1, 0, 1.25, 1.75, '19_mousse.jpg'),
	(20, 'Suppenkreation á la Chef', 'was verschafft werden muss, gut und günstig', '2020-08-26', 0, 0, 0.5, 0.9, '20_suppe.jpg'),
	(21, 'Currywurst mit Pommes', 'Bratwurst in Currysoße mit Kartoffelstangen', '2022-11-15', 0, 0, 2.9, 4, NULL);
/*!40000 ALTER TABLE `gericht` ENABLE KEYS */;

-- Exportiere Struktur von Tabelle emensawerbeseite.gericht_hat_allergen
CREATE TABLE IF NOT EXISTS `gericht_hat_allergen` (
  `code` char(4) DEFAULT NULL COMMENT 'Referenz auf Allergen.',
  `gericht_id` int(8) NOT NULL COMMENT 'Referenz auf das Gericht.',
  KEY `gericht_id` (`gericht_id`),
  KEY `gericht_hat_allergen_allergen_null_fk` (`code`),
  CONSTRAINT `gericht_hat_allergen_allergen_null_fk` FOREIGN KEY (`code`) REFERENCES `allergen` (`code`),
  CONSTRAINT `gericht_hat_allergen_ibfk_1` FOREIGN KEY (`gericht_id`) REFERENCES `gericht` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Exportiere Daten aus Tabelle emensawerbeseite.gericht_hat_allergen: ~31 rows (ungefähr)
/*!40000 ALTER TABLE `gericht_hat_allergen` DISABLE KEYS */;
INSERT INTO `gericht_hat_allergen` (`code`, `gericht_id`) VALUES
	('h', 1),
	('a3', 1),
	('a4', 1),
	('f1', 3),
	('a6', 3),
	('i', 3),
	('a3', 4),
	('f1', 4),
	('a4', 4),
	('h3', 4),
	('d', 6),
	('h1', 7),
	('a2', 7),
	('h3', 7),
	('c', 7),
	('a3', 8),
	('h3', 10),
	('d', 10),
	('f', 10),
	('f2', 12),
	('h1', 12),
	('a5', 12),
	('c', 1),
	('a2', 9),
	('i', 14),
	('f1', 1),
	('a1', 15),
	('a4', 15),
	('i', 15),
	('f3', 15),
	('h3', 15);
/*!40000 ALTER TABLE `gericht_hat_allergen` ENABLE KEYS */;

-- Exportiere Struktur von Tabelle emensawerbeseite.gericht_hat_kategorie
CREATE TABLE IF NOT EXISTS `gericht_hat_kategorie` (
  `gericht_id` int(8) NOT NULL COMMENT 'Referenz auf das Gericht',
  `kategorie_id` bigint(20) NOT NULL COMMENT 'Referenz auf Kategorie',
  KEY `gericht_hat_kategorie_gericht_null_fk` (`gericht_id`),
  KEY `gericht_hat_kategorie_kategorie_id_fk` (`kategorie_id`),
  CONSTRAINT `gericht_hat_kategorie_gericht_null_fk` FOREIGN KEY (`gericht_id`) REFERENCES `gericht` (`id`),
  CONSTRAINT `gericht_hat_kategorie_kategorie_id_fk` FOREIGN KEY (`kategorie_id`) REFERENCES `kategorie` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Exportiere Daten aus Tabelle emensawerbeseite.gericht_hat_kategorie: ~14 rows (ungefähr)
/*!40000 ALTER TABLE `gericht_hat_kategorie` DISABLE KEYS */;
INSERT INTO `gericht_hat_kategorie` (`gericht_id`, `kategorie_id`) VALUES
	(1, 3),
	(3, 3),
	(4, 3),
	(5, 3),
	(6, 3),
	(7, 3),
	(9, 3),
	(16, 4),
	(17, 4),
	(18, 4),
	(16, 5),
	(17, 5),
	(18, 5),
	(21, 3);
/*!40000 ALTER TABLE `gericht_hat_kategorie` ENABLE KEYS */;

-- Exportiere Struktur von Prozedur emensawerbeseite.inkrAnzahlAnmeldungen
DELIMITER //
CREATE PROCEDURE `inkrAnzahlAnmeldungen`(IN email varchar(100))
BEGIN
    UPDATE emensawerbeseite.benutzer
    SET anzahlanmeldungen = anzahlanmeldungen + 1
    WHERE email = email;
end//
DELIMITER ;

-- Exportiere Struktur von Tabelle emensawerbeseite.kategorie
CREATE TABLE IF NOT EXISTS `kategorie` (
  `id` bigint(20) NOT NULL COMMENT 'Primärschlüssel',
  `name` varchar(80) NOT NULL COMMENT 'Name der Kategorie, z.B. "Hauptgericht", "Vorspeise", "Salat", "Sauce" oder "Käsegericht".',
  `eltern_id` bigint(20) DEFAULT NULL COMMENT 'Referenz auf eine (Eltern-)Kategorie. Es soll eine Baumstruktur innerhalb der Kategorien abgebildet werden. Zum Beispiel enthält die Kategorie "Hauptgericht" alle Kategorien, denen Gerichte zugeordnet sind, die als Hauptgang vorgesehen sind.',
  `bildname` varchar(200) DEFAULT NULL COMMENT 'Name der Bilddatei, die eine Darstellung der Kategorie enthält',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Exportiere Daten aus Tabelle emensawerbeseite.kategorie: ~7 rows (ungefähr)
/*!40000 ALTER TABLE `kategorie` DISABLE KEYS */;
INSERT INTO `kategorie` (`id`, `name`, `eltern_id`, `bildname`) VALUES
	(1, 'Aktionen', NULL, 'kat_aktionen.png'),
	(2, 'Menus', NULL, 'kat_menu.gif'),
	(3, 'Hauptspeisen', 2, 'kat_menu_haupt.bmp'),
	(4, 'Vorspeisen', 2, 'kat_menu_vor.svg'),
	(5, 'Desserts', 2, 'kat_menu_dessert.pic'),
	(6, 'Mensastars', 1, 'kat_stars.tif'),
	(7, 'Erstiewoche', 1, 'kat_erties.jpg');
/*!40000 ALTER TABLE `kategorie` ENABLE KEYS */;

-- Exportiere Struktur von Tabelle emensawerbeseite.newsletter
CREATE TABLE IF NOT EXISTS `newsletter` (
  `Name` varchar(50) NOT NULL COMMENT 'Name',
  `E-Mail` varchar(100) NOT NULL COMMENT 'E-Mail'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Speichert die Anmeldungen vom Newsletter';

-- Exportiere Daten aus Tabelle emensawerbeseite.newsletter: ~2 rows (ungefähr)
/*!40000 ALTER TABLE `newsletter` DISABLE KEYS */;
INSERT INTO `newsletter` (`Name`, `E-Mail`) VALUES
	('Jonas', 'test@gmail.com'),
	('Max Mustermann', 'mustermann@mustermail.com');
/*!40000 ALTER TABLE `newsletter` ENABLE KEYS */;

-- Exportiere Struktur von Tabelle emensawerbeseite.wunschgericht
CREATE TABLE IF NOT EXISTS `wunschgericht` (
  `Name` varchar(50) NOT NULL COMMENT 'Name',
  `Beschreibung` varchar(800) NOT NULL COMMENT 'Beschreibung des Gerichts',
  `Erstellungsdatum` date NOT NULL COMMENT 'Zeitpunkt der Erfassung des WUnschgerichts',
  `Nummer` int(5) NOT NULL AUTO_INCREMENT COMMENT 'Nummer',
  `Ersteller` varchar(50) NOT NULL DEFAULT 'anonym' COMMENT 'Ersteller',
  `E-Mail` varchar(50) NOT NULL COMMENT 'Email',
  PRIMARY KEY (`Nummer`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Exportiere Daten aus Tabelle emensawerbeseite.wunschgericht: ~0 rows (ungefähr)
/*!40000 ALTER TABLE `wunschgericht` DISABLE KEYS */;
/*!40000 ALTER TABLE `wunschgericht` ENABLE KEYS */;

-- Exportiere Struktur von Tabelle emensawerbeseite.zahlen
CREATE TABLE IF NOT EXISTS `zahlen` (
  `counter` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Exportiere Daten aus Tabelle emensawerbeseite.zahlen: ~0 rows (ungefähr)
/*!40000 ALTER TABLE `zahlen` DISABLE KEYS */;
INSERT INTO `zahlen` (`counter`) VALUES
	(22);
/*!40000 ALTER TABLE `zahlen` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
