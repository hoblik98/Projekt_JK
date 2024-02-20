-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Počítač: 127.0.0.1
-- Vytvořeno: Úte 20. úno 2024, 15:39
-- Verze serveru: 10.4.32-MariaDB
-- Verze PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Databáze: `projekt_db`
--
CREATE DATABASE IF NOT EXISTS `projekt_db` DEFAULT CHARACTER SET utf8 COLLATE utf8_czech_ci;
USE `projekt_db`;

-- --------------------------------------------------------

--
-- Struktura tabulky `clanky`
--

DROP TABLE IF EXISTS `clanky`;
CREATE TABLE IF NOT EXISTS `clanky` (
  `clanky_id` int(11) NOT NULL AUTO_INCREMENT,
  `titulek` varchar(255) NOT NULL,
  `obsah` text NOT NULL,
  `url` varchar(255) NOT NULL,
  `popisek` varchar(500) NOT NULL,
  `klicova_slova` varchar(255) NOT NULL,
  PRIMARY KEY (`clanky_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

--
-- Vypisuji data pro tabulku `clanky`
--

INSERT INTO `clanky` (`clanky_id`, `titulek`, `obsah`, `url`, `popisek`, `klicova_slova`) VALUES
(1, 'Různé Druhy Bolestí Nohou', '<p class=\"kurziva\">Autor: Dr. Robert Chase<br/>\r\nDatum: 25.6. 2006<br/>\r\nZdravotnické zařízení: Princeton-Plainsboro Teaching Hospital<p/>\r\n\r\n<h3>Úvod</h3>\r\n<p>Bolí noha - ta zdánlivě jednoduchá proklamace může skrývat mnoho různých podmínek, které mohou mít závažné následky pro pacienta. V tomto článku představíme tři případy pacientů trpících různými problémy nohy a diskutujeme o různých léčebných strategiích, které byly použity k jejich řešení.</p>\r\n\r\n<h3>Příběh pacienta č. 1: Martin - Nekrotizující Fasciitida</h3>\r\n\r\n<p>Martin, 55letý muž, se představil na pohotovosti s akutní bolestí a otokem nohy. Diagnostikována mu byla nekrotizující fasciitida, vážná bakteriální infekce měkkých tkání nohy. Léčba zahrnovala okamžité podání antibiotik a chirurgické ošetření postižené oblasti.<p>\r\n\r\n<h3>Příběh pacienta č. 2: Petra - Rakovinný Adenom</h3>\r\n<p>Petra, 42letá žena, se potýkala s bolestí a otokem nohy, což vedlo k diagnóze rakovinného adenomu, vzácného benigního nádoru v tkáních nohy. Léčba zahrnovala chirurgické odstranění nádoru a následnou radioterapii.</p>\r\n\r\n<h3>Příběh pacienta č. 3: Lukáš - Nekróza v Důsledku Svalové Smrti v Důsledku Infarktu v Důsledku Sraženiny v Důsledku Aneuryzmatu</h3>\r\n<p>Lukáš, 60letý muž, trpěl akutní bolestí a necitlivostí nohy. Byla mu diagnostikována nekróza v důsledku svalové smrti v důsledku infarktu v důsledku sraženiny v důsledku aneuryzmatu femorální tepny. Nakonec byla provedena amputace nohy.<p>\r\n\r\n<h3>Závěr</h3>\r\nTyto případy ilustrují rozmanité příčiny bolesti nohy a různé léčebné přístupy, které mohou být použity k jejich řešení. Zdůrazňují důležitost přesné diagnostiky a individuálního přístupu k léčbě, který zohledňuje povahu a závažnost onemocnění. Multidisciplinární spolupráce je klíčová pro dosažení optimálních výsledků a zlepšení kvality života pacientů trpících komplexními stavbami nohy.\r\n', 'ruzne-druhy-bolesti-nohou:-pripady-a-lecebne-strategie', 'Bolí noha - ta zdánlivě jednoduchá proklamace může skrývat mnoho různých podmínek, které mohou mít závažné následky pro pacienta. V tomto článku představíme tři případy pacientů trpících různými problémy nohy a diskutujeme o různých léčebných strategiích, které byly použity k jejich řešení.', 'adenom, nekroza, svalova smrt, fasciitida, bolest nohou'),
(2, 'Neobvyklý Případ Onemocnění z Pěstování Marihuany', '<p class=\"kurziva\">&nbsp;</p>\r\n<p class=\"kurziva\">&nbsp;</p>\r\n<p class=\"kurziva\">&nbsp;</p>\r\n<p class=\"kurziva\">Autor: Dr. Allison Cameron<br>Datum: 5.10. 2007<br>Zdravotnické zařízení: Princeton-Plainsboro Teaching Hospital</p>\r\n<p>&nbsp;</p>\r\n<h3>Úvod</h3>\r\n<p>Předkládáme neobvyklý případ pacienta, který vyvolal své vlastní zdravotní problémy pěstováním marihuany a používáním holubího trusu jako hnojiva. Tento případ zdůrazňuje důležitost uvědomění si rizik spojených s nekonvenčními zemědělskými postupy a jejich dopadem na lidské zdraví.</p>\r\n<p>&nbsp;</p>\r\n<h3>Klinická Prezentace</h3>\r\n<p>Pacient, mladý muž ve věku 28 let, konzultoval na pohotovostním oddělení s neobvyklými gastrointestinálními příznaky, včetně silné nevolnosti, průjmů a bolestí břicha. Při anamnéze pacient uvedl, že nedávno začal pěstovat marihuanu v domácím prostředí.</p>\r\n<p>&nbsp;</p>\r\n<h3>Diagnostické Postupy</h3>\r\n<p>Po důkladném zkoumání příčin příznaků a analýze životního stylu pacienta bylo zjištěno, že jako hnojivo pro rostliny používal holubí trus, který máčel ve vodě. Tento netradiční postup byl identifikován jako možná příčina jeho zdravotních obtíží.</p>\r\n<h3>Stav Pacienta</h3>\r\n<p>Pacient trpěl silnou intoxikací z vystavení se výfukovým plynům a dalším škodlivým látkám uvolňovaným při spalování holubího trusu. Jeho stav se rychle zhoršoval kvůli dehydrataci a elektrolytovým nerovnováhám způsobeným průjmy.</p>\r\n<h3>Léčebný Přístup</h3>\r\n<p>Okamžitě byla zahájena intravenózní rehydratace a podávání léků proti zvracení a bolesti. Pacient byl hospitalizován pro sledování a další léčbu, včetně detoxikace a podpůrné terapie k obnově jeho zdraví.</p>\r\n<h3>Výsledek a Závěr</h3>\r\n<p>Díky rychlé léčbě a podpoře se pacientův stav postupně zlepšil. Tento případ zdůrazňuje nebezpečí spojená s neodborným pěstováním rostlin a používáním nekonvenčních hnojiv, a varuje před potenciálními zdravotními riziky spojenými s těmito praktikami. Je důležité, aby veřejnost byla informována o bezpečných a zdravotně šetrných metodách pro domácí pěstování rostlin.</p>', 'onemocneni-z-marihuany', 'Předkládáme neobvyklý případ pacienta, který vyvolal své vlastní zdravotní problémy pěstováním marihuany a používáním holubího trusu jako hnojiva. Tento případ zdůrazňuje důležitost uvědomění si rizik spojených s nekonvenčními zemědělskými postupy a jejich dopadem na lidské zdraví.', 'marihuana, holuby, bolest břicha'),
(3, 'Boj o Život pacienta s leprou', '<p class=\"kurziva\">Autor: Dr. Eric Foreman<br/>\r\nDatum: 26.2. 2009<br/>\r\nZdravotnické zařízení: Princeton-Plainsboro Teaching Hospital<p/>\r\n\r\n<h3>Úvod</h3>\r\n<p>Představuji příběh pacienta, který čelil nebezpečnému onemocnění - leprou. Tento případ byl ztělesněním boje o život, který vyžadoval nejen lékařskou péči, ale také sílu a vytrvalost pacienta.</p>\r\n\r\n<h3>Klinická Prezentace</h3>\r\n<p>Pacient, muž ve středním věku, se představil na našem oddělení s rozsáhlými kožními lézemi, destruktivními změnami na končetinách a necitlivostí v postižených oblastech. Diagnóza lepry byla potvrzena klinickým vyšetřením a pozitivními laboratorními testy.</>\r\n\r\n<h3>Léčebný Přístup</h3>\r\n<p>Pacientův stav byl kritický a vyžadoval okamžitou léčbu. Byl zahájen agresivní režim léčby, zahrnující multidrugovou terapii s kombinací antibiotik a léčbu protizánětlivými léky. Nutriční podpora byla také klíčová pro podporu pacientova oslabeného imunitního systému.</p>\r\n\r\n<h3>Boj o Život</h3>\r\n<p>Během léčby pacient čelil řadě komplikací, včetně sepse a následného selhání orgánů. Jeho stav se zhoršoval a bylo nutné ho přenést na jednotku intenzivní péče, kde byla poskytnuta intenzivní monitorace a podpora vitálních funkcí.</p>\r\n\r\n<h3>Cesta k Hojení</h3>\r\n<p>I přes dramatický průběh a chvíle nejistoty se pacientovi podařilo překonat krizi a postupně se začal zotavovat. Díky trvalé léčbě a pečlivé péči se jeho kožní léze zahojily a necitlivost v postižených oblastech postupně ustoupila.</p>\r\n\r\n<h3>Výsledek</h3>\r\n<p>Díky vytrvalosti lékařského týmu a pacientovy odhodlanosti se podařilo překonat těžkosti a dosáhnout úspěšného zotavení. Pacient nyní žije s leprou pod kontrolou a má naději na plnohodnotný život.</p>\r\n\r\n<h3>Závěr</h3>\r\n<p>Příběh tohoto pacienta s leprou je připomínkou síly lidského ducha a důležitosti pečlivé léčby a podpory. Je také výzvou k většímu povědomí o této nemoci a k poskytování přístupné péče všem postiženým jedincům.<p>\r\n', 'pacient-s-leprou', 'Představuji příběh pacienta, který čelil nebezpečnému onemocnění - leprou. Tento případ byl ztělesněním boje o život, který vyžadoval nejen lékařskou péči, ale také sílu a vytrvalost pacienta.', 'lepra'),
(4, 'Akutní Abdominální Kolika vyvolaná Pohlcením Cizího Tělesa', '<p class=\"kurziva\">&nbsp;</p>\r\n<p class=\"kurziva\">&nbsp;</p>\r\n<p class=\"kurziva\">&nbsp;</p>\r\n<p class=\"kurziva\">&nbsp;</p>\r\n<p class=\"kurziva\">&nbsp;</p>\r\n<p class=\"kurziva\">Autor: Dr. Chris Taub<br>Datum: 17.1. 2010<br>Zdravotnické zařízení: Princeton-Plainsboro Teaching Hospital</p>\r\n<p>&nbsp;</p>\r\n<h3>Úvod</h3>\r\n<p>Akutní bolest břicha je symptom, který vyžaduje rychlou a pečlivou diferenciální diagnostiku. Tento článek předkládá případ pacienta prezentujícího se s akutní abdominální kolikou, která byla výsledkem spolknutí cizího tělesa, konkrétně párátku. Diskutuje o diagnostických postupech a léčebných strategiích použitých k řešení této situace.</p>\r\n<h3>Klinická Prezentace</h3>\r\n<p>Pacient, 45letý muž, konzultoval na pohotovostním oddělení s náhlou intenzivní bolestí v epigastrické a periumbilikální oblasti, doprovázenou nauzeou a opakovanými záchvaty zvracení. Bolest byla vyvolána po požití jídla.</p>\r\n<p>&nbsp;</p>\r\n<h3>Diagnostické Postupy</h3>\r\n<p>Po pečlivé anamnéze a fyzikálním vyšetření byla provedena abdominální radiografie a CT břicha s intravenózním kontrastem pro detekci možného cizího tělesa. Tyto obrazové metody odhalily anomálie v oblasti žaludku, což sugerovalo přítomnost pohlceného objektu v trávicím traktu.</p>\r\n<h3>Léčebný Přístup</h3>\r\n<p>S ohledem na podezření na cizí těleso v trávicím traktu byla provedena urgentní endoskopie s cílem lokalizovat a odstranit párátko. Endoskopická intervence byla úspěšná a cizí těleso bylo bez komplikací extrahováno.</p>\r\n<h3>Sledování a Péče</h3>\r\n<p>Po odstranění cizího tělesa byl pacient přemístěn na jednotku intenzivní péče pro monitorování vitálních funkcí a sledování možného návratu příznaků. Během hospitalizace byla poskytnuta symptomatická léčba pro kontrolu bolesti a nauzey.</p>\r\n<h3>Výsledek a Diskuze</h3>\r\n<p>Léčebný přístup vedl k úspěšnému odstranění cizího tělesa a zlepšení klinického stavu pacienta. Diskuze se zaměřila na preventivní opatření ke snížení rizika pohlcení cizích těles, včasnou diagnostiku a léčbu akutních komplikací spojených s tímto fenoménem.</p>\r\n<h3>Závěr</h3>\r\n<p>Případ pacienta s akutní abdominální kolikou vyvolanou pohlcením cizího tělesa ilustruje význam rychlé a přesné diagnostiky v managmentu akutních stavů břicha. Multidisciplinární přístup a efektivní komunikace mezi členy léčebného týmu jsou klíčové pro dosažení pozitivních výsledků a minimalizaci rizika komplikací.</p>', 'akut-abdominalni-kolika-vyvolana-pohlcenim-ciziho-telesa', 'Akutní bolest břicha je symptom, který vyžaduje rychlou a pečlivou diferenciální diagnostiku. Tento článek předkládá případ pacienta prezentujícího se s akutní abdominální kolikou, která byla výsledkem spolknutí cizího tělesa, konkrétně párátku. Diskutuje o diagnostických postupech a léčebných strategiích použitých k řešení této situace.', 'paratko, kolika, bizární'),
(5, 'Multimodální Management Syndromu VHL', '<p class=\"kurziva\">&nbsp;</p>\r\n<p class=\"kurziva\">&nbsp;</p>\r\n<p class=\"kurziva\">Autor: Dr. Remy \"Thirteen\" Hadley<br>Datum: 9.4. 2012<br>Zdravotnické zařízení: Princeton-Plainsboro Teaching Hospital</p>\r\n<p>&nbsp;</p>\r\n<h3>Úvod</h3>\r\n<p>Syndrom von Hippel-Lindau (VHL) je vzácné genetické onemocnění, charakterizované tvorbou nádorů v různých orgánech těla, včetně cév mozku, očí, ledvin a dalších. Tento článek prezentuje případ pacienta s diagnostikovaným VHL syndromem a diskutuje o léčebných strategiích a terapeutických výzvách spojených s tímto onemocněním.</p>\r\n<h3>Klinická Prezentace</h3>\r\n<p>Pacient, 34letý muž, se představil s bolestí hlavy a zhoršeným zrakem. Důkladné fyzikální vyšetření odhalilo vaskulární léze v mozku, hemangioblastomy na sítnici a nádory v ledvinách, což naznačilo možnou diagnózu VHL syndromu.</p>\r\n<h3>Diagnostické Postupy</h3>\r\n<p>Diagnostika VHL syndromu zahrnovala genetické testování pro identifikaci mutace v genu VHL. Obrazové vyšetření mozku a břicha pomocí MRI bylo provedeno k detekci nádorů a jejich hodnocení.</p>\r\n<h3>Farmakoterapie a Chirurgická Intervence</h3>\r\n<p>Farmakoterapie byla zvažována v závislosti na lokalizaci a velikosti nádorů. Pacient byl indikován pro chirurgické odstranění renálních nádorů a laserovou koagulaci hemangioblastomů v očích.</p>\r\n<h3>Sledování a Péče</h3>\r\n<p>Po chirurgických a farmakologických intervencích byl pacient pravidelně sledován pomocí MRI a oftalmologických vyšetření k monitorování možné recidivy nádorů. Podpora psychologa byla poskytnuta pro zvládání emocionálních aspektů spojených s diagnózou VHL syndromu.</p>\r\n<h3>Výsledky a Diskuze</h3>\r\n<p>Integrovaný management VHL syndromu vedl k úspěšnému ovládnutí projevů onemocnění u tohoto pacienta. Diskuse zahrnovala možnosti genetické konzultace pro rodinu a výhody sledování screeningových programů pro členy rodiny pacienta.</p>\r\n<h3>Závěr</h3>\r\n<p>Syndrom von Hippel-Lindau je komplexní genetické onemocnění, které vyžaduje multidisciplinární přístup k léčbě. Tato případová studie zdůrazňuje důležitost včasné diagnostiky, individuálního plánování léčby a pravidelného sledování pro optimalizaci výsledků a zlepšení kvality života pacientů s VHL syndromem.</p>', 'syndrom-vhl', 'Syndrom von Hippel-Lindau (VHL) je vzácné genetické onemocnění, charakterizované tvorbou nádorů v různých orgánech těla, včetně cév mozku, očí, ledvin a dalších. Tento článek prezentuje případ pacienta s diagnostikovaným VHL syndromem a diskutuje o léčebných strategiích a terapeutických výzvách spojených s tímto onemocněním.', 'vhl syndrom, hemangioblastom, feochromocytom');

-- --------------------------------------------------------

--
-- Struktura tabulky `pacienti`
--

DROP TABLE IF EXISTS `pacienti`;
CREATE TABLE IF NOT EXISTS `pacienti` (
  `pacienti_id` int(11) NOT NULL AUTO_INCREMENT,
  `jmeno` varchar(50) NOT NULL,
  `prijmeni` varchar(50) NOT NULL,
  `datum_narozeni` varchar(50) NOT NULL,
  `telefon` varchar(50) NOT NULL,
  `vek` varchar(50) NOT NULL,
  `rodne_cislo` varchar(11) NOT NULL,
  PRIMARY KEY (`pacienti_id`),
  UNIQUE KEY `rodne_cislo` (`rodne_cislo`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

-- --------------------------------------------------------

--
-- Struktura tabulky `uzivatele`
--

DROP TABLE IF EXISTS `uzivatele`;
CREATE TABLE IF NOT EXISTS `uzivatele` (
  `uzivatele_id` int(11) NOT NULL AUTO_INCREMENT,
  `jmeno` varchar(255) NOT NULL,
  `prijmeni` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `telefon` varchar(250) NOT NULL,
  `heslo` varchar(255) NOT NULL,
  `admin` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`uzivatele_id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
