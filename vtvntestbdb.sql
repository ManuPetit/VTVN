-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Serveur: localhost
-- Généré le : Jeu 10 Juin 2010 à 15:28
-- Version du serveur: 5.1.41
-- Version de PHP: 5.3.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `vtvntest`
--

-- --------------------------------------------------------

--
-- Structure de la table `vsyscomdetails`
--

CREATE TABLE IF NOT EXISTS `vsyscomdetails` (
  `v_DetailsID` smallint(4) unsigned NOT NULL AUTO_INCREMENT,
  `v_EtabID` smallint(4) unsigned NOT NULL,
  `v_DetailType` smallint(4) unsigned NOT NULL,
  `v_Details` text NOT NULL,
  PRIMARY KEY (`v_DetailsID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=249 ;

--
-- Contenu de la table `vsyscomdetails`
--

INSERT INTO `vsyscomdetails` (`v_DetailsID`, `v_EtabID`, `v_DetailType`, `v_Details`) VALUES
(1, 1, 3, 'Restauration de livres et de revues anciennes, mais aussi cr&eacute;ation de reliures originales et personnalis&eacute;es pour des &eacute;v&eacute;nements d''exception (naissance, mariage...).'),
(2, 1, 4, 'Objets dor&eacute;s &agrave; l''ancienne &agrave; la feuille d''or : tr&egrave;s pr&eacute;cieux, ils rayonnent avec un charme incomparable. Exposition de peintures &agrave; l''atelier.'),
(3, 1, 5, 'Encadrements sur mesure, grand choix de baguettes.\r\nVous pouvez apporter des objets pour les faire dorer.'),
(4, 1, 6, 'Books and old magazines restoration, as well as creation of original and personalised binding for any special events (birth, wedding...).'),
(5, 1, 7, 'Gold gilding with gold leaf in the traditional way : very precious, the objects shine with a wonderful charm. Painting exhibits in the workshop.'),
(6, 1, 8, 'Picture frames made to measure, great choice of beadings.\r\nYou may bring your own object to be gilded.'),
(7, 1, 1, '6d4HIMob0VIs.jpeg'),
(8, 1, 2, 'joX2n6diX3j.jpeg'),
(9, 2, 3, 'Fruits et l&eacute;gumes, viande Halal.'),
(10, 2, 4, 'L&eacute;gumes secs, merguez maison.'),
(11, 2, 5, 'Alimentation g&eacute;n&eacute;rale.'),
(12, 2, 6, 'Fruit and vegetables, Halal meats.'),
(13, 2, 7, 'Dry vegetables and pulses, homemade merguez.'),
(14, 2, 8, 'General grocery store.'),
(15, 2, 1, 'N0PiDUxUTUbi.jpeg'),
(16, 2, 2, 'vem7nan1RojA.jpeg'),
(17, 3, 3, 'La farigoule vous propose une cuisine proven&ccedil;ale mettant en avant les produits du terroir, une cuisine simple et savoureuse.'),
(18, 3, 4, 'Depuis trois ans, nous avons sign&eacute; une charte avec le Monde de l''Olivier afin de promouvoir l''olive et l''huile d''olive AOC Nyons.'),
(19, 3, 5, 'Le restaurant peut acceuillir 20 personnes en salle et une douzaine en terrasse. R&eacute;servation recommand&eacute;e.\r\n\r\nVous pouvez retrouver nos sp&eacute;cialit&eacute;s et prix sur notre site internet.'),
(20, 3, 6, 'La farigoule offers you Provencal food bringing to the fore the local products, with a simple and delicious cuisine.'),
(21, 3, 7, 'Two years ago, we signed the chart of the Monde de l\\''Olivier to promote the olive and the olive oil of Nyons.'),
(22, 3, 8, 'The restaurant can accomodate up to 20 covers inside and a dozen on the terrace. Bookings are advised.\r\n\r\nYou will find our specialities and prices on our web site.'),
(23, 3, 1, 'ys7S1Xig2riw.jpeg'),
(24, 3, 2, 'p9G1piRIT6X.jpeg'),
(25, 4, 3, 'Toilettage toute races. Ongles, &eacute;pilation oreilles, glandes anales, tontes, coupes ciseaux, d&eacute;m&eacute;lage sans douleur.'),
(26, 4, 4, '18 ans d''exp&eacute;rience. Cr&eacute;ation de l''entreprise en 1996. Dipl&ocirc;m&eacute;e du Brevet de Compagnon en 1990.'),
(27, 4, 5, 'Prix : se renseigner au 04 75 26 43 22.'),
(28, 4, 6, 'Grooming of all breeds. Nails, depilation, ears, anal glands, clipping, cuts.'),
(29, 4, 7, '18 years of expertise. Company created in 1996. Diploma of the &quot;Brevet de Compagnon&quot; in 1990.'),
(30, 4, 8, 'Prices : please enquire on 04 75 26 43 22.'),
(31, 4, 1, '8Wer8qAT6Lup.jpeg'),
(32, 4, 2, '8Wer8qAT6Lu.jpeg'),
(33, 5, 3, 'Vente au d&eacute;tail de produits en vrac: &eacute;picerie bio, cosm&eacute;tique, papier &agrave; lettre recycl&eacute;, livres, produits d''entretien.\r\nMarchandises produites ou fabriqu&eacute;es dans le Nyonsais : pain au levain, l&eacute;gumes et fruits, oeufs, olive et huile, miel, jus de fruits, vins, petit &eacute;peautre de Provence, bl&eacute;, seigle, lentilles, pois chiches...'),
(34, 5, 4, 'Produits pour les r&eacute;gimes sans gluten, sans cholesterol dont produits secs et frais &agrave; base de soja.\r\nToutes sortes de farines : ma&iuml;s, chata&icirc;gnes, bl&eacute;, &eacute;peautre, seigle, sarazin, riz, pois chiche.'),
(35, 5, 5, 'Nombreux produits de commerce &eacute;quitable ; chocolats, th&eacute;, caf&eacute;, quinoa, fruits secs, huile de s&eacute;same.'),
(36, 5, 6, 'Retail of loose products : organic groceries, make-up, recycled paper, books, cleansing produces.\r\nWe sell products produced or made in the Nyons area : country loaves (leaven bread), fruit and vegetables, eggs, olives and oil, honey, fruit juices, wines, local provencal wheat, corn, rye, lentils, chick peas...'),
(37, 5, 7, 'Gluten free products, cholesterol free items including dry and fresh products made with soya.\r\nAll type of flours : corn, chestnuts, wheat, rye, rice, chick peas.'),
(38, 5, 8, 'Many fair-trade products : chocolates, tea, coffee, dry fruits, sesame oil.'),
(39, 5, 1, 'Ap4v4D9r8v6Q.jpeg'),
(40, 5, 2, 'wiT4w0REx0S.jpeg'),
(41, 6, 3, 'Articles de d&eacute;coration.'),
(42, 6, 4, 'Souvenirs de Provence.'),
(43, 6, 5, 'Poterie, savons etc...'),
(44, 6, 6, 'Decorative items.'),
(45, 6, 7, 'Souvenirs of Provence.'),
(46, 6, 8, 'Pottery, soaps, gifts etc...'),
(47, 6, 1, 'eqAByxuMIm2t.jpeg'),
(48, 6, 2, 'eqAByxuMIm2.jpeg'),
(49, 7, 3, 'Boutique ambiance vintage et chaleureuse pour un voyage r&eacute;tro-temporel garanti !'),
(50, 7, 4, 'Vente et achat Brocante Ann&eacute;es 50'' &agrave; 70''s pop &amp; design...Disques Vinyls...livres anciens et d''occasions...Bandes-dessin&eacute;es...mat&eacute;riel photo et Cin&eacute;ma...Vieux jouets...Consoles et jeux vid&eacute;os R&eacute;tro et occasions...'),
(51, 7, 5, 'au plaisir de vous accueillir tr&egrave;s bient&ocirc;t !'),
(52, 7, 6, 'We buy and sell antiques and second-hand items. 180 square metres of shopping area, near the Romanesque Bridge..\r\nYou will find furniture, works of art, decorative items, clocks, pictures, old books and magazines.'),
(53, 7, 7, 'Some special items for the collecters of comic books, of old (and second hand) cameras and old vinyl records.'),
(54, 7, 8, 'We always welcome you with pleasure, as we enjoy what we do and we want to share it with you.\r\nSee you soon.'),
(55, 7, 1, '7wubugeW6puR.jpeg'),
(56, 7, 2, 'Viv3j8q3X6rA.jpeg'),
(57, 8, 3, 'Sur rendez-vous. Toilettage toutes races. Salon climatis&eacute;.'),
(58, 8, 4, 'D&eacute;m&eacute;lage, &eacute;pilations, bains, tontes, coupes ciseaux.'),
(59, 8, 5, 'Ventes produits et accessoires.\r\n14 ann&eacute;es d''exp&eacute;rience.'),
(60, 8, 6, 'Grooming of all breeds. Air conditioned.'),
(61, 8, 7, 'Depilations, bathing, clipping, cuts.'),
(62, 8, 8, 'Sale of products and accessoiries.\r\n14 years of expertise.'),
(63, 8, 1, 'WUl4ZEH2W7V0.jpeg'),
(64, 8, 2, 'WUl4ZEH2W7V.jpeg'),
(65, 9, 3, 'R&eacute;parations chaussures et maroquinerie.'),
(66, 9, 4, 'Reproductions cl&eacute;s (s&eacute;curit&eacute; et voitures).'),
(67, 9, 5, 'Plaques grav&eacute;es et m&eacute;dailles.'),
(68, 9, 6, 'Repairer of shoes and leather goods.'),
(69, 9, 7, 'Key cutting (house, safety and car).'),
(70, 9, 8, 'Engraving of plaques and medals.'),
(71, 9, 1, 'QaJiG4WAwUQo.jpeg'),
(72, 9, 2, 'QaJiG4WAwUQ.jpeg'),
(81, 11, 3, 'Coiffeur, conseil, nature, bien-&ecirc;tre, esth&eacute;ticien capillaire. Cosm&eacute;ologie climatique avec la ligne Geomer - cheveux - visage - corps. Programme de soins personnalis&eacute;s avec des produits actifs 100% naturels (algues, argiles, huiles essentielles, vitamines, oligo &eacute;l&eacute;ments...) non test&eacute;s sur les animaux - garantis sans pegs ni parabens.'),
(82, 11, 4, 'Certains produits de la ligne Geomer sont certifi&eacute;s &quot;Ecocert&quot;. Pour la partie technique coiffure, des produits tr&egrave;s doux non agressifs vous sont propos&eacute;s : couleurs &agrave; base de plantes, d''huile d''olive et prot&eacute;ines de soie. Sans ammoniac. D&eacute;colorations aux argiles et algues.'),
(83, 11, 5, 'D&eacute;tente et bien-&ecirc;tre dans ce salon jaune-soleil plein de clart&eacute;, calme et reposant - salon climatis&eacute;.'),
(84, 11, 6, 'Hairdresser, advice, relaxation, hair beautician. Climatic cosmeology with Geomer products - Hair - face - body. Personnalised care program with active products 100% natural (seaweed, clay, essentiel oils, vitamins, oligo elements...) not tested on animals.'),
(85, 11, 7, 'Some of the Geomer products have the &quot;Ecocert&quot; certification. For you hair, on the technical side, some soft products are offered : colouring based on plants, olive oil and silk proteins. Ammonia free. Hair bleaching with clay and seaweeds.'),
(86, 11, 8, 'Stress free and relaxing environment in this sun yellow hair lounge, very light, and calm - air conditioned.'),
(87, 11, 1, 'is0huT0v0jis.jpeg'),
(88, 11, 2, 'is0huT0v0ji.jpeg'),
(89, 12, 3, 'Banque pour les particuliers.'),
(90, 12, 4, 'Compte-ch&egrave;que et cr&eacute;dit.'),
(91, 12, 5, 'Toutes assurances.'),
(92, 12, 6, 'Banking for individuals.'),
(93, 12, 7, 'Loans and bank accounts'),
(94, 12, 8, 'All types of insurance.'),
(95, 12, 1, 'Sun4m1SuhoL0.jpeg'),
(96, 12, 2, 'Sun4m1SuhoL.jpeg'),
(97, 13, 3, 'Bar - snack - pizz&eacute;ria.\r\nRestauration midi et soir.'),
(98, 13, 4, 'Salle int&eacute;rieure de 45 couverts.'),
(99, 13, 5, 'Terrasse ext&eacute;rieure attenante au Pont Roman, avec vue sur la rivi&egrave;re et sur la montagne. Capacit&eacute; de 80 couverts.'),
(100, 13, 6, 'Bar - snack - pizzeria.\r\nCatering for lunches and evening meals.'),
(101, 13, 7, 'Indoor space for 45 covers.'),
(102, 13, 8, 'Outside terrace next to the Romanesque Bridge, with view over the river and the mountain. Capacity of 80 covers.'),
(103, 13, 1, 'AGyJod7H1GUG.jpeg'),
(104, 13, 2, 'AGyJod7H1GU.jpeg'),
(113, 15, 3, 'Salon existant depuis 1967. Sp&eacute;cialit&eacute;s : permanentes et m&egrave;ches.'),
(114, 15, 4, 'Coupe hommes et femmes. Coloration. Brushing, mise en plis.'),
(115, 15, 5, 'Prix tout &agrave; fait raisonnables. Par exemple :\r\n- Shampoing coupe brushing 32,00 €\r\n- Shampoing coloration brushing 47,00 €'),
(116, 15, 6, 'Opened in 1967. Specialities : fringe, wash and set.'),
(117, 15, 7, 'Men and women hairdresser. Colouring. Blow drying, perming.'),
(118, 15, 8, 'Very reasonable prices :\r\n- Shampoo, cut and blow dry 32,00 €\r\n- Shampoo, colouring and blow dry 47,00 €'),
(119, 15, 1, 'G9v6x7M7z9Z7.jpeg'),
(120, 15, 2, 'G9v6x7M7z9Z.jpeg'),
(121, 16, 3, 'Vente de v&ecirc;tements de marque &agrave; prix d&eacute;griff&eacute;, pour hommes, femmes et enfants.'),
(122, 16, 4, 'Toutes les marques de jeans : Levi''s, Diesiel, Energie &agrave; prix discount. Arrivage permanent, tous nos prix sont en 30 et 70% moins cher.'),
(123, 16, 5, 'Ouvert le dimanche toute l''ann&eacute;e, aux horaires suivants de 10h00 &agrave; 13h00 et de 15h00 &agrave; 18h00.\r\nLes plus grandes marques &agrave; prix cass&eacute;s'),
(124, 16, 6, 'Sale of brand named clothes at discount prices, for men, women and children.'),
(125, 16, 7, 'All jean brands : Levi''s, Diesiel, Energie at discount prices. New stock permanently arriving, all of our prices are about 30 to 70% cheaper.'),
(126, 16, 8, 'Open Sundays all year round.\r\nThe biggest brands at low cost prices...'),
(127, 16, 1, 'Q0jagYb1x2ja.jpeg'),
(128, 16, 2, 'Q0jagYb1x2j.jpeg'),
(129, 17, 3, 'Cuisine cr&eacute;ative &agrave; consonnance Proven&ccedil;ale.'),
(130, 17, 4, 'Nous travaillons avec des produits frais et de saison, et des produits du terroir.'),
(131, 17, 5, 'Pour plus de renseignements, consultez notre site internet.'),
(132, 17, 6, 'Creative cuisine with Provencal flavours.'),
(133, 17, 7, 'We cook with fresh and seasonal ingredients, and with local products.'),
(134, 17, 8, 'For more details, please consult our web site.'),
(135, 17, 1, 'd2J0liwehygY.jpeg'),
(136, 17, 2, 'd2J0liwehyg.jpeg'),
(137, 18, 3, 'Pizzas, lasagnes.'),
(138, 18, 4, 'Grandes salades.'),
(139, 18, 5, 'Grillades.'),
(140, 18, 6, 'Pizzas, lasagnes.'),
(141, 18, 7, 'Big salads.'),
(142, 18, 8, 'Grilled meats.'),
(143, 18, 1, 'aw4v9QoGaw3Z.jpeg'),
(144, 18, 2, 'aw4v9QoGaw3.jpeg'),
(169, 22, 3, 'Restauration traditionnelle et raffin&eacute;e. Utilisation de produits frais.'),
(170, 22, 4, 'Premier menu &agrave; 24,90€.\r\nDeuxi&egrave;me menu &agrave; 34,90€.\r\nPlat du jour &agrave; 11,50€ du lundi au vendredi.\r\nFormule 16€ avec Plat du jour et dessert.'),
(171, 22, 5, 'Suggestion samedi et dimanche (de 19 &agrave; 25€).\r\nPain &quot;maison&quot;, produits frais.\r\n70 place assises, 2 salles &agrave; l''&eacute;tage.'),
(172, 22, 6, 'Traditionnal restaurant and fine food using fresh produce.'),
(173, 22, 7, 'First menu at 24,90€.\r\nSecond menu at 34,90€.\r\nDaily special at 11,50€ from Monday to Friday.\r\n16€ special with the daily special and dessert.'),
(174, 22, 8, 'Chef specials Saturday and Sunday (from 19 to 25€).\r\nHomemade bread, fresh produce.\r\nSeating for seventy. Two dining rooms to the first floor.'),
(175, 22, 1, '45Nklp1.jpeg'),
(176, 22, 2, '45Nklp14h5.jpeg'),
(177, 23, 3, 'Sp&eacute;cialit&eacute;s Vietnamiennes et Chinoises.'),
(178, 23, 4, 'Assiette du midi &agrave; 8 €.'),
(179, 23, 5, 'Terrasse en &eacute;t&eacute;.'),
(180, 23, 6, 'Vietnamese and Chinese dishes.'),
(181, 23, 7, 'Lunch platter from 8 €.'),
(182, 23, 8, 'During the summer, why not sit on our terrace.'),
(183, 23, 1, 'hoJ4VEMiNIQI.jpeg'),
(184, 23, 2, 'hoJ4VEMiNIQ.jpeg'),
(185, 24, 3, 'Dans un cadre chaud et d&eacute;paysant, le Tex vous accueille toujours avec plaisir.'),
(186, 24, 4, 'Sp&eacute;cialit&eacute;es Texanes et Mexicaines. Pas de menu, mais des prix raisonnables : Pizza de 7,50 € &agrave; 9,00 €, Menu enfant 9,50 €, Carte : prix allant de 10,50 € pour un plat &agrave; 19,00 €, entr&eacute;e de 5,90 € &agrave; 11,90 €. Tous les desserts sont maison.'),
(187, 24, 5, 'Le Tex poss&egrave;de 3 salles, ainsi qu''une terrasse l''&eacute;t&eacute;. Les chiens sont les bienvenus.'),
(188, 24, 6, 'In a pleasant, distinctive and warm atmosphere, you are always welcome at the Tex.'),
(189, 24, 7, 'Tex-mex specialities. No menu, but some very reasonable prices : Pizza from 7,50 € to 9,00 €, Child''s menu 9,50 €, A la carte : prices from 10,50 € to 19,00 € for a main course, starters from 5,90 € to 11,90 €.Homemade desserts.'),
(190, 24, 8, 'The Tex has 3 dining rooms, as well as a terrace in the summer. Dogs are welcome.'),
(191, 24, 1, 'B5toWERuX2dY.jpeg'),
(192, 24, 2, 'B5toWERuX2d.jpeg'),
(193, 25, 3, 'Cr&eacute;ation de v&ecirc;tements f&eacute;minin, originaux et abordables...'),
(194, 25, 4, 'Maillots de bains, chapeaux, sandales....'),
(195, 25, 5, 'Venez d&eacute;couvrir le style Gekko.'),
(196, 25, 6, 'Creation of ready to wear lady''s clothes, original and good value for money....'),
(197, 25, 7, 'Swim costumes, hats and shoes....'),
(198, 25, 8, 'Come and discover the Gekko style.'),
(199, 25, 1, '3g5vejEH0n6X.jpeg'),
(200, 25, 2, '3g5vejEH0n6.jpeg'),
(201, 26, 3, 'L&eacute;gumes et fruits frais livr&eacute;s tous les jours par Olivier qui travaille au M.I.N. de cavaillon chez un grossiste exercant ce m&eacute;tier depuis 20 ans.'),
(202, 26, 4, 'Fruits exotiques, jus de fruits, oeufs fermiers, herbes fra&icirc;ches.'),
(203, 26, 5, 'Epicerie fine.'),
(204, 26, 6, 'Vegetables and fruits delivered fresh every days by Olivier who works for a supplier(who has been in the trade for 20 years) in Cavaillon''s Market.'),
(205, 26, 7, 'Exotic fruits, fruits juices, farmed eggs, fresh herbes.'),
(206, 26, 8, 'Delicatessen.'),
(207, 26, 1, 'IZ5DIJUlUnAS.jpeg'),
(208, 26, 2, 'IZ5DIJUlUnA.jpeg'),
(209, 27, 3, 'Pains traditionnels, pains sp&eacute;ciaux. Viennoiseries.'),
(210, 27, 4, 'Sp&eacute;cialit&eacute;s de pognes et brassados.'),
(211, 27, 5, 'Grand choix de p&acirc;tisseries.'),
(212, 27, 6, 'Traditional breads, special breads. Croissants and danish pastries.'),
(213, 27, 7, 'Pognes and brassados specialites.'),
(214, 27, 8, 'large choice of pastries and cakes.'),
(215, 27, 1, 'p8HIZED8D9mo.jpeg'),
(216, 27, 2, 'p8HIZED8D9m.jpeg'),
(217, 28, 3, 'Huiles essentielles pures. Alo&egrave; V&eacute;ra. Gemmoth&eacute;rapie. Compl&eacute;ments alimentaires. Huile de massage.'),
(218, 28, 4, 'Aromath&eacute;rapie. Huile Argan. Appareil de massage.'),
(219, 28, 5, 'Diffusion par une &eacute;ponge v&eacute;g&eacute;tale d''huiles essentielles. Appareils de massage en bois. Conseils personnalis&eacute;s.'),
(220, 28, 6, 'Essntials oils. Alo&egrave; V&eacute;ra. Gemmoth&eacute;rapie. Food complements. Massaging oils.'),
(221, 28, 7, 'Aromatherapy. Argan oils. Massaging devices.'),
(222, 28, 8, 'Natural vegetal sponge to diffuse essential oils. Wooden massaging devices. Personnalised help.'),
(223, 28, 1, 'W0Z7w0R2WYN6.jpeg'),
(224, 28, 2, 'W0Z7w0R2WYN.jpeg'),
(225, 29, 3, 'Vente de v&ecirc;tements'),
(226, 29, 4, 'Street wear'),
(227, 29, 5, 'Hommes et femmes'),
(228, 29, 6, 'Clothing shop'),
(229, 29, 7, 'Street wear'),
(230, 29, 8, 'Men and women'),
(231, 29, 1, '4R6j4Z0P1Waj.jpeg'),
(232, 29, 2, '4R6j4Z0P1Wa.jpeg'),
(241, 31, 3, 'L''&eacute;quipe du centre de formation &agrave; la conduite du pont Roman, vous formera &agrave; la conduite de la moto, de l''automobile, au brevet de s&eacute;curit&eacute; routi&egrave;re (BSR), &agrave; la navigation en mer et eaux int&eacute;rieur (permis c&ocirc;tier, fluvial, hauturier, CRR) ainsi qu''&agrave; la conduite &eacute;conomique.'),
(242, 31, 4, 'L''&eacute;quipe du centre de formation &agrave; la conduite du pont Roman, vous formera &agrave; la conduite de la moto, de l''automobile, au brevet de s&eacute;curit&eacute; routi&egrave;re (BSR), &agrave; la navigation en mer et eaux int&eacute;rieur (permis c&ocirc;tier, fluvial, hauturier, CRR) ainsi qu''&agrave; la conduite &eacute;conomique.'),
(243, 31, 5, 'L''&eacute;quipe du centre de formation &agrave; la conduite du pont Roman, vous formera &agrave; la conduite de la moto, de l''automobile, au brevet de s&eacute;curit&eacute; routi&egrave;re (BSR), &agrave; la navigation en mer et eaux int&eacute;rieur (permis c&ocirc;tier, fluvial, hauturier, CRR) ainsi qu''&agrave; la conduite &eacute;conomique.'),
(244, 31, 6, 'L''&eacute;quipe du centre de formation &agrave; la conduite du pont Roman, vous formera &agrave; la conduite de la moto, de l''automobile, au brevet de s&eacute;curit&eacute; routi&egrave;re (BSR), &agrave; la navigation en mer et eaux int&eacute;rieur (permis c&ocirc;tier, fluvial, hauturier, CRR) ainsi qu''&agrave; la conduite &eacute;conomique.'),
(245, 31, 7, 'L''&eacute;quipe du centre de formation &agrave; la conduite du pont Roman, vous formera &agrave; la conduite de la moto, de l''automobile, au brevet de s&eacute;curit&eacute; routi&egrave;re (BSR), &agrave; la navigation en mer et eaux int&eacute;rieur (permis c&ocirc;tier, fluvial, hauturier, CRR) ainsi qu''&agrave; la conduite &eacute;conomique.'),
(246, 31, 8, 'L''&eacute;quipe du centre de formation &agrave; la conduite du pont Roman, vous formera &agrave; la conduite de la moto, de l''automobile, au brevet de s&eacute;curit&eacute; routi&egrave;re (BSR), &agrave; la navigation en mer et eaux int&eacute;rieur (permis c&ocirc;tier, fluvial, hauturier, CRR) ainsi qu''&agrave; la conduite &eacute;conomique.'),
(247, 31, 1, 'G6guV0J5BuR.jpeg'),
(248, 31, 2, 'D1T3peb0NaW.jpeg');

-- --------------------------------------------------------

--
-- Structure de la table `vsyscommerces`
--

CREATE TABLE IF NOT EXISTS `vsyscommerces` (
  `v_EtabID` smallint(4) unsigned NOT NULL AUTO_INCREMENT,
  `v_MembreID` smallint(4) unsigned NOT NULL,
  `v_EtabNom` varchar(50) NOT NULL,
  `v_EtabNumero` smallint(4) NOT NULL,
  `v_RueID` smallint(4) unsigned NOT NULL,
  `v_EtabPhone` varchar(14) DEFAULT NULL,
  `v_EtabFax` varchar(14) DEFAULT NULL,
  `v_EtabMobile` varchar(14) DEFAULT NULL,
  `v_HoraireOnMatin` varchar(5) NOT NULL,
  `v_HoraireOffMatin` varchar(5) NOT NULL,
  `v_HoraireOnSoir` varchar(5) DEFAULT NULL,
  `v_HoraireOffSoir` varchar(5) DEFAULT NULL,
  `v_EtabFerme` varchar(7) NOT NULL,
  `v_EtabResponsable1` varchar(60) NOT NULL,
  `v_EtabResponsable2` varchar(60) DEFAULT NULL,
  `v_EtabActivite` varchar(120) NOT NULL,
  `v_EtabURL` varchar(120) DEFAULT NULL,
  `v_EtabEmail` varchar(120) DEFAULT NULL,
  `v_ComTypeID` smallint(4) unsigned NOT NULL DEFAULT '0',
  `v_EtabActive` tinyint(4) unsigned NOT NULL DEFAULT '1',
  `v_EtabFileNom` varchar(8) NOT NULL DEFAULT 'file',
  `v_EtabActiviteUK` varchar(120) NOT NULL DEFAULT '',
  PRIMARY KEY (`v_EtabID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=32 ;

--
-- Contenu de la table `vsyscommerces`
--

INSERT INTO `vsyscommerces` (`v_EtabID`, `v_MembreID`, `v_EtabNom`, `v_EtabNumero`, `v_RueID`, `v_EtabPhone`, `v_EtabFax`, `v_EtabMobile`, `v_HoraireOnMatin`, `v_HoraireOffMatin`, `v_HoraireOnSoir`, `v_HoraireOffSoir`, `v_EtabFerme`, `v_EtabResponsable1`, `v_EtabResponsable2`, `v_EtabActivite`, `v_EtabURL`, `v_EtabEmail`, `v_ComTypeID`, `v_EtabActive`, `v_EtabFileNom`, `v_EtabActiviteUK`) VALUES
(1, 5, 'Atelier Chouette', 1, 3, '04 75 26 16 67', '04 75 26 16 67', NULL, '09h00', '12h00', '15h00', '18h00', 'adaaaaa', 'Klara Sourlier', 'Pedro Finazzi', 'Reliure d''art encadrements dorure artisanale exposition de tableaux', 'mypage.bluewin.ch/pedro-finazzi', NULL, 2, 1, 'atelierc', 'Book binding picture framing gilding painting exhibits'),
(2, 3, 'Epicerie Ghazel', 48, 3, '04 75 26 01 46', NULL, '06 77 88 33 42', '07h30', '13h00', '14h30', '20h00', 'aadaaaa', 'Mohamed Ghazel', NULL, 'Epicerie générale', NULL, NULL, 1, 1, 'epighaze', 'Grocery'),
(3, 2, 'La Farigoule', 23, 3, '04 75 26 07 01', NULL, NULL, '12h00', '13h45', '19h00', '20h30', 'caddaaa', 'Odile Ruel', 'Cyril Ogé', 'Restaurant Provencal', 'www.lafarigoule-nyons.com', NULL, 6, 1, 'farigo01', 'Provencal Restaurant'),
(4, 10, 'Bon Chic Bon Chien', 11, 2, '04 75 26 43 22', NULL, NULL, '09h00', '12h15', '13h30', '17h30', 'daadaaa', 'Laetitia Fiol', NULL, 'Toilettage canin', NULL, NULL, 3, 1, 'bonchi1', 'Dog parlour'),
(5, 4, 'L''Eclat de Riz', 40, 3, '04 75 26 03 41', '04 75 26 03 41', NULL, '09h00', '12h30', '15h15', '19h15', 'caaaaaa', 'Marie Françoise Jourjon', 'Marie Christine Debecq', 'Vente de produits biologiques', NULL, NULL, 1, 1, 'eclariz1', 'Organic products grocery'),
(6, 6, 'Envie de Provence', 5, 3, '04 75 26 03 64', NULL, NULL, '09h30', '19h00', NULL, NULL, 'aaaaaaa', 'Jean Claude Bertrand', NULL, 'Souvenirs', NULL, NULL, 2, 1, 'envipro2', 'Souvenirs'),
(7, 8, 'S'' PASSE-TEMPS', 11, 3, '04 75 26 01 54', NULL, NULL, '10h00', '12h00', '16h00', '19h00', 'cdddaaa', 'BUSOLINI Céline', NULL, 'Brocante années 50'' à 70''s', NULL, 'spassetemps26@free.fr', 2, 1, 'nyontic1', 'antiques and second hand items'),
(8, 11, 'Le Chien qui Mousse', 46, 3, '04 75 26 13 21', NULL, NULL, '10h00', '12h00', NULL, NULL, 'ddaaaaa', 'Nathalie Giunta', NULL, 'Toilettage canin', NULL, NULL, 3, 1, 'chiemous', 'Dog parlour'),
(9, 12, 'Le Petit Rouet', 1, 1, '04 75 26 04 22', NULL, NULL, '09h00', '12h30', '14h00', '18h30', 'adaaaac', 'Claudie Jarnias', NULL, 'Cordonnerie', NULL, NULL, 3, 0, 'ptitroue', 'Cobbler'),
(11, 15, 'Danièle Coiffure', 26, 2, '04 75 26 02 48', NULL, NULL, '09h00', '12h00', '14h00', '19h00', 'ddadaaa', 'Danièle Silvestre', NULL, 'Coiffure soin du cheveux', NULL, NULL, 4, 1, 'dancoiff', 'Hair care and hairdresser'),
(12, 18, 'Cabinet Laurençon', 41, 3, '04 75 26 32 05', '06 81 27 93 86', NULL, '09h00', '12h00', '', '', 'daaaaad', 'Jean Pierre Laurençon', NULL, 'Assurances', NULL, 'agence.laurencon-sol@axa.fr', 5, 0, 'axasura', 'Insurances'),
(13, 19, 'Bar snack du Pont', 10, 4, '04 75 26 15 24', NULL, NULL, '06h30', '24h00', NULL, NULL, 'aaadaaa', 'Michel Burger', NULL, 'Bar snack pizzéria', NULL, NULL, 6, 1, 'barpont1', 'Bar snack pizzeria'),
(15, 16, 'Elle coiffure', 13, 2, '04 75 26 08 28', NULL, NULL, '08h30', '12h00', '14h30', '18h00', 'ddadaaa', 'Marie Jeanne Cury', NULL, 'Salon de coifurre mixte', NULL, NULL, 4, 1, 'ellecoif', 'Women and men hairdresser'),
(16, 17, 'JD Marque', 11, 3, '04 75 26 24 06', NULL, NULL, '09h30', '12h30', '14h30', '19h00', 'adaaaaa', 'Joelle Coutand', 'Didier Paquet', 'Vente de vêtements chaussures accessoires', NULL, NULL, 4, 0, 'jdmarqu1', 'Retail of clothes shoes accessories'),
(17, 20, 'D''un Goût à l''Autre', 21, 3, '04 75 26 62 27', NULL, '06 08 16 59 45', '12h00', '14h00', '19h00', '21h00', 'aadaaaa', 'Dominique et', 'Michaël Jeaubert', 'Restaurant', 'dungoutalautre.ifrance.com', 'dungoutalautre@ifrance.com', 6, 1, 'goutautr', 'Restaurant'),
(18, 21, 'L''Alicoque', 10, 3, '04 75 26 60 61', '04 75 26 32 64', NULL, '12h15', '14h00', '19h15', '21h00', 'adaaaaa', 'Sandrine Facila', 'Jean Pierre Carrascosa', 'Restaurant pizzéria', NULL, 'alicoque@club-internet.fr', 6, 1, 'alicoqu1', 'Restaurant pizzeria'),
(22, 32, 'Le Resto des Arts', 13, 3, '04 75 26 31 49', NULL, NULL, '12h00', '14h30', '19h00', '22h30', 'aaadaab', 'Marie Clémence Rousset', 'Pierre Laurent Bernard', 'Restaurant', NULL, NULL, 6, 1, 'restoar1', 'Restaurant'),
(23, 26, 'Le Saigon', 14, 3, '04 75 26 14 81', NULL, NULL, '11h00', '14h00', '19h00', '21h00', 'aaadaaa', 'Thi Dang', NULL, 'Restaurant', NULL, NULL, 6, 1, 'saigon01', 'Restaurant'),
(24, 27, 'Le Tex', 20, 3, '04 75 26 27 30', NULL, NULL, '19h00', '23h00', NULL, NULL, 'aadaaaa', 'Dominique Pouliquen', 'Yan Pouliquen', 'Restaurant', NULL, NULL, 6, 1, 'letexme1', 'Restaurant'),
(25, 14, 'Gekko', 12, 3, NULL, NULL, '06 72 92 08 71', '10h00', '19h00', '', '', 'adaaaaa', 'Karine Fernandez', NULL, 'Prêt à porter féminin, création', NULL, 'parvinbabi@hotmail.com', 4, 0, 'gekko002', 'ready to wear ladies clothing'),
(26, 29, 'La Source', 2, 3, '04 75 26 25 68', NULL, NULL, '08h15', '12h15', '15h30', '19h30', 'cdaaaaa', 'Corinne et', 'Olivier Laurent', 'Primeurs, fruits et légumes', NULL, 'loucoliv@wanadoo.fr', 1, 1, 'source01', 'Fruits and vegetables shop'),
(27, 30, 'La Ronde des Pains', 4, 3, '04 75 26 44 93', NULL, NULL, '06h30', '13h00', '15h30', '19h30', 'adaaaaa', 'Yvan Modena', NULL, 'Boulangerie, pâtisserie', NULL, 'boulangerieyvanmodena@wanadoo.fr', 1, 1, 'mopain01', 'bakery pastry shop'),
(28, 31, 'Harmonie', 41, 3, '04 75 27 69 68', '04 75 27 69 68', NULL, '10h00', '12h30', '15h00', '20h00', 'adddaaa', 'Bernadette Zanella', NULL, 'Produits naturels pour le bien être', 'www.harmonie.kingeshop.com', 'harmonieplus@laposte.net', 4, 1, 'harmon01', 'Natural produce for the well being'),
(29, 9, 'Chago and Co', 19, 3, '04 42 26 66 50', NULL, NULL, '10h00', '12h00', '15h00', '19h00', 'adaaaaa', 'Rénald Boyadjian', NULL, 'Vente de vêtements', NULL, 'boyagosa@hotmail.fr', 4, 0, 'chagoc01', 'Clothing shop'),
(31, 36, 'CFCPR', 19, 3, '04 75 26 41 22', '04 13 33 17 26', '06 31 96 12 25', '09h00', '12h00', '15h00', '19h00', 'ddaaaac', 'Ravier Eric', NULL, 'Auto Ecole', 'www.cfcpr.com', 'cfcpr@orange.fr', 3, 1, 'CFCPR', 'Auto Ecole');

-- --------------------------------------------------------

--
-- Structure de la table `vsyscommercetype`
--

CREATE TABLE IF NOT EXISTS `vsyscommercetype` (
  `v_ComTypeID` smallint(4) unsigned NOT NULL AUTO_INCREMENT,
  `v_ComNom` varchar(20) NOT NULL,
  `v_ComActive` tinyint(4) unsigned NOT NULL DEFAULT '1',
  `v_ComNomUK` varchar(20) NOT NULL DEFAULT '',
  PRIMARY KEY (`v_ComTypeID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Contenu de la table `vsyscommercetype`
--

INSERT INTO `vsyscommercetype` (`v_ComTypeID`, `v_ComNom`, `v_ComActive`, `v_ComNomUK`) VALUES
(1, 'Alimentation', 1, 'Food Outlets'),
(2, 'Art décoration', 1, 'Art and Decor'),
(3, 'Divers', 1, 'Others'),
(4, 'Mode et beauté', 1, 'Fashion and Beauty'),
(5, 'Services', 0, 'Services'),
(6, 'Sortir', 1, 'Going Out');

-- --------------------------------------------------------

--
-- Structure de la table `vsyscompict`
--

CREATE TABLE IF NOT EXISTS `vsyscompict` (
  `v_PictID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `v_etabID` smallint(4) unsigned NOT NULL,
  `v_PictNom` varchar(20) NOT NULL DEFAULT '',
  `v_PictNomShow` varchar(20) NOT NULL DEFAULT '',
  PRIMARY KEY (`v_PictID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=75 ;

--
-- Contenu de la table `vsyscompict`
--

INSERT INTO `vsyscompict` (`v_PictID`, `v_etabID`, `v_PictNom`, `v_PictNomShow`) VALUES
(1, 1, '6d4HIMob0VIs.jpeg', 'Atelier01'),
(2, 1, 'joX2n6diX3j.jpeg', 'Atelier02'),
(3, 2, 'N0PiDUxUTUbi.jpeg', 'Ghazel01'),
(5, 2, 'vem7nan1RojA.jpeg', 'Ghazel02'),
(6, 3, 'ys7S1Xig2riw.jpeg', 'Farig01'),
(7, 3, 'p9G1piRIT6X.jpeg', 'Farig02'),
(8, 4, '8Wer8qAT6Lup.jpeg', 'Bonchic01'),
(9, 4, '8Wer8qAT6Lu.jpeg', 'Bonchic02'),
(10, 5, 'Ap4v4D9r8v6Q.jpeg', 'Eclat01'),
(11, 5, 'wiT4w0REx0S.jpeg', 'Eclat02'),
(12, 6, 'eqAByxuMIm2t.jpeg', 'Envie01'),
(13, 6, 'eqAByxuMIm2.jpeg', 'Envie02'),
(14, 7, 'AXEM4tUz6Tyb.jpeg', 'NyonsA01'),
(15, 7, 'AXEM4tUz6Ty.jpeg', 'NyonsA02'),
(16, 8, 'WUl4ZEH2W7V0.jpeg', 'Chienqui01'),
(17, 8, 'WUl4ZEH2W7V.jpeg', 'Chienqui02'),
(18, 9, 'QaJiG4WAwUQo.jpeg', 'Petitrouet01'),
(19, 9, 'QaJiG4WAwUQ.jpeg', 'Petitrouet02'),
(22, 11, 'is0huT0v0jis.jpeg', 'Daniele01'),
(23, 11, 'is0huT0v0ji.jpeg', 'Daniele02'),
(24, 12, 'Sun4m1SuhoL0.jpeg', 'Axa01'),
(25, 12, 'Sun4m1SuhoL.jpeg', 'Axa02'),
(26, 13, 'AGyJod7H1GUG.jpeg', 'Lepont01'),
(27, 13, 'AGyJod7H1GU.jpeg', 'Lepont02'),
(30, 15, 'G9v6x7M7z9Z7.jpeg', 'Elle01'),
(31, 15, 'G9v6x7M7z9Z.jpeg', 'Elle02'),
(32, 16, 'Q0jagYb1x2ja.jpeg', 'jd01'),
(33, 16, 'Q0jagYb1x2j.jpeg', 'jd02'),
(34, 17, 'd2J0liwehygY.jpeg', 'Gouta01'),
(35, 17, 'd2J0liwehyg.jpeg', 'Gouta02'),
(36, 18, 'aw4v9QoGaw3Z.jpeg', 'Alicoque1'),
(37, 18, 'aw4v9QoGaw3.jpeg', 'Alicoque2'),
(44, 22, '45Nklp1.jpeg', 'Resto01'),
(45, 22, '45Nklp14h5.jpeg', 'Resto02'),
(46, 23, 'hoJ4VEMiNIQI.jpeg', 'Saigon01'),
(47, 23, 'hoJ4VEMiNIQ.jpeg', 'Saigon02'),
(48, 24, 'B5toWERuX2dY.jpeg', 'Letex01'),
(49, 24, 'B5toWERuX2d.jpeg', 'Letex02'),
(50, 3, 'jqSD23asaz.jpg', 'Farig03'),
(53, 25, '3g5vejEH0n6X.jpeg', 'Gekko01'),
(54, 25, '3g5vejEH0n6.jpeg', 'Gekko02'),
(55, 26, 'IZ5DIJUlUnAS.jpeg', 'laSource01'),
(56, 26, 'IZ5DIJUlUnA.jpeg', 'laSource02'),
(57, 27, 'p8HIZED8D9mo.jpeg', 'modena1'),
(58, 27, 'p8HIZED8D9m.jpeg', 'modena2'),
(59, 28, 'W0Z7w0R2WYN6.jpeg', 'harmonie01'),
(60, 28, 'W0Z7w0R2WYN.jpeg', 'harmonie02'),
(61, 29, '4R6j4Z0P1Waj.jpeg', 'chago01'),
(62, 29, '4R6j4Z0P1Wa.jpeg', 'chago02'),
(63, 7, '7wubugeW6puR.jpeg', 'nyonsantic1'),
(64, 7, 'Viv3j8q3X6rA.jpeg', 'nyonsantic2'),
(68, 31, 'G6guV0J5BuR.jpeg', 'cfcpr'),
(69, 31, 'D1T3peb0NaW.jpeg', 'cfcpr'),
(70, 31, '9dyjYRAQ4hY.jpeg', 'cfcpr'),
(71, 31, 'UN8HYBeHoDE.jpeg', 'cfcpr'),
(72, 31, '3XaT2HAguq6.jpeg', 'cfcpr'),
(73, 31, 'uN7Hup3b4BIg.jpeg', 'cfcpr'),
(74, 31, 'uN7Hup3b4BI.jpeg', 'cfcpr');

-- --------------------------------------------------------

--
-- Structure de la table `vsysdetailtype`
--

CREATE TABLE IF NOT EXISTS `vsysdetailtype` (
  `v_DetailType` smallint(4) unsigned NOT NULL AUTO_INCREMENT,
  `v_DetailNom` varchar(25) NOT NULL,
  PRIMARY KEY (`v_DetailType`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Contenu de la table `vsysdetailtype`
--

INSERT INTO `vsysdetailtype` (`v_DetailType`, `v_DetailNom`) VALUES
(1, 'Image 1'),
(2, 'Image 2'),
(3, 'Description 1 FR'),
(4, 'Description 2 FR'),
(5, 'Description 3 FR'),
(6, 'Description 1 GB'),
(7, 'Description 2 GB'),
(8, 'Description 3 GB');

-- --------------------------------------------------------

--
-- Structure de la table `vsysdocgroupes`
--

CREATE TABLE IF NOT EXISTS `vsysdocgroupes` (
  `v_GroupeID` smallint(4) unsigned NOT NULL AUTO_INCREMENT,
  `v_GroupeNomFR` varchar(20) NOT NULL,
  PRIMARY KEY (`v_GroupeID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Contenu de la table `vsysdocgroupes`
--

INSERT INTO `vsysdocgroupes` (`v_GroupeID`, `v_GroupeNomFR`) VALUES
(1, 'Ann&eacute;e 2006'),
(2, 'Ann&eacute;e 2007'),
(3, 'Ann&eacute;e 2008');

-- --------------------------------------------------------

--
-- Structure de la table `vsysdocs`
--

CREATE TABLE IF NOT EXISTS `vsysdocs` (
  `v_DocID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `v_GroupeID` smallint(4) unsigned NOT NULL,
  `v_DocNom` varchar(25) NOT NULL,
  `v_NomPDF` varchar(35) NOT NULL,
  `v_NomDOC` varchar(35) NOT NULL,
  `v_DocActif` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`v_DocID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Contenu de la table `vsysdocs`
--

INSERT INTO `vsysdocs` (`v_DocID`, `v_GroupeID`, `v_DocNom`, `v_NomPDF`, `v_NomDOC`, `v_DocActif`) VALUES
(1, 1, 'Minutes du 25/01/2006', 'Reunion2006-01-25', 'Meeting20060125', 1),
(2, 2, 'Minutes du 23/03/2007', 'Reunion2007-03-23', 'Meeting20070323', 1),
(3, 1, 'Minutes du 13/02/2006', 'Meeting20060213', 'Meeting20060213', 1),
(4, 1, 'Minutes du 03/04/2006', 'Meeting20060403', 'Meeting20060403', 1),
(5, 1, 'Minutes du 23/10/2006', 'Meeting20061023', 'Meeting20061023', 1),
(6, 2, 'Minutes du 21/05/2007', 'Meeting20070521', 'Meeting20070521', 1),
(7, 2, 'Minutes du 12/11/2007', 'meeting20071112', 'meeting20071112', 1),
(8, 3, 'Minutes du 10/03/2008', 'meeting20080310', 'meeting20080310', 1);

-- --------------------------------------------------------

--
-- Structure de la table `vsysevents`
--

CREATE TABLE IF NOT EXISTS `vsysevents` (
  `v_EventID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `v_EtabID` smallint(4) unsigned NOT NULL,
  `v_EventActif` tinyint(4) NOT NULL DEFAULT '1',
  `v_EventDate` datetime NOT NULL,
  `v_EventTime` varchar(5) NOT NULL,
  `v_EventNom` varchar(50) NOT NULL,
  `v_EventDesc` text,
  `v_EventNomUK` varchar(50) DEFAULT NULL,
  `v_EventDescUK` text,
  PRIMARY KEY (`v_EventID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=37 ;

--
-- Contenu de la table `vsysevents`
--

INSERT INTO `vsysevents` (`v_EventID`, `v_EtabID`, `v_EventActif`, `v_EventDate`, `v_EventTime`, `v_EventNom`, `v_EventDesc`, `v_EventNomUK`, `v_EventDescUK`) VALUES
(5, 0, 1, '2008-02-05 23:59:59', '15h00', 'Mardi-gras des enfants', 'Comme chaque ann&eacute;e, nous donnons rendez-vous aux enfants des maternelles de Nyons pour un gouter organis&eacute; sur la place Barillon.', 'Mardi-gras des enfants', 'Comme chaque ann&eacute;e, nous donnons rendez-vous aux enfants des maternelles de Nyons pour un gouter organis&eacute; sur la place Barillon.'),
(6, 0, 1, '2008-05-01 23:59:59', '07h30', 'March&eacute; aux Fleurs', 'Le traditionnel march&eacute; aux fleurs du Vieux Nyons de la place Barillon &agrave; la rue de la Maladrerie', 'Flowers market', 'Le traditionnel march&eacute; aux fleurs du Vieux Nyons de la place Barillon &agrave; la rue de la Maladrerie'),
(7, 0, 1, '2008-05-11 23:59:59', '09h00', 'March&eacute; Proven&ccedil;al', 'Les beaux jours arrivent, et avec eux, le retour du march&eacute; proven&ccedil;al de Nyons. Retrouvez ce march&eacute; tous les dimanches jusqu''au 14 septembre inclus...\r\nDans la vieille ville, de la place des Arcades au pont Roman...', 'Provencal Market', 'Les beaux jours arrivent, et avec eux, le retour du march&eacute; proven&ccedil;al de Nyons. Retrouvez ce march&eacute; tous les dimanches jusqu''au 14 septembre inclus...\r\nDans la vieille ville, de la place des Arcades au pont Roman...'),
(8, 0, 1, '2008-05-18 23:59:59', '09h00', 'March&eacute; Proven&ccedil;al', 'Retrouvez le march&eacute; proven&ccedil;al de Nyons, tous les dimanches durant la belle saison...\r\nDans la vieille ville, de la place des Arcades au pont Roman...', 'Provencal Market', 'Retrouvez le march&eacute; proven&ccedil;al de Nyons, tous les dimanches durant la belle saison...\r\nDans la vieille ville, de la place des Arcades au pont Roman...'),
(9, 0, 1, '2008-05-25 23:59:59', '08h00', 'March&eacute; Proven&ccedil;al', 'Venez d&eacute;couvrir les produits des producteurs et artisans de notre r&eacute;gion.', 'Provencal Market', 'Venez d&eacute;couvrir les produits des producteurs et artisans de notre r&eacute;gion.'),
(10, 0, 1, '2008-06-01 23:59:59', '08h00', 'March&eacute; Proven&ccedil;al', 'Venez d&eacute;couvrir les produits des producteurs et artisans de notre r&eacute;gion.', 'Provencal Market', 'Venez d&eacute;couvrir les produits des producteurs et artisans de notre r&eacute;gion.'),
(11, 0, 1, '2008-06-08 23:59:59', '08h00', 'March&eacute; Proven&ccedil;al', 'Venez d&eacute;couvrir les produits des producteurs et artisans de notre r&eacute;gion.', 'Provencal Market', 'Venez d&eacute;couvrir les produits des producteurs et artisans de notre r&eacute;gion.'),
(12, 0, 1, '2008-06-16 23:59:59', '08h00', 'March&eacute; Proven&ccedil;al', 'Retrouvez le march&eacute; proven&ccedil;al de Nyons, tous les dimanches durant la belle saison... Dans la vieille ville, de la place des Arcades au pont Roman...', 'Provencal Market', 'Retrouvez le march&eacute; proven&ccedil;al de Nyons, tous les dimanches durant la belle saison... Dans la vieille ville, de la place des Arcades au pont Roman...'),
(13, 0, 1, '2008-06-22 23:59:59', '08h00', 'March&eacute; Proven&ccedil;al', 'Retrouvez le march&eacute; proven&ccedil;al de Nyons, tous les dimanches durant la belle saison... Dans la vieille ville, de la place des Arcades au pont Roman...', 'Provencal Market', 'Retrouvez le march&eacute; proven&ccedil;al de Nyons, tous les dimanches durant la belle saison... Dans la vieille ville, de la place des Arcades au pont Roman...'),
(14, 0, 1, '2008-06-29 23:59:59', '08h00', 'March&eacute; Proven&ccedil;al', 'Retrouvez le march&eacute; proven&ccedil;al de Nyons, tous les dimanches durant la belle saison... Dans la vieille ville, de la place des Arcades au pont Roman...', 'Provencal Market', 'Retrouvez le march&eacute; proven&ccedil;al de Nyons, tous les dimanches durant la belle saison... Dans la vieille ville, de la place des Arcades au pont Roman...'),
(15, 0, 1, '2008-07-06 23:59:59', '08h00', 'March&eacute; Proven&ccedil;al', 'Retrouvez le march&eacute; proven&ccedil;al de Nyons, tous les dimanches durant la belle saison... Dans la vieille ville, de la place des Arcades au pont Roman...', 'Provencal Market', 'Retrouvez le march&eacute; proven&ccedil;al de Nyons, tous les dimanches durant la belle saison... Dans la vieille ville, de la place des Arcades au pont Roman...'),
(16, 0, 1, '2008-07-13 23:59:59', '08h00', 'March&eacute; Proven&ccedil;al', 'Retrouvez le march&eacute; proven&ccedil;al de Nyons, tous les dimanches durant la belle saison... Dans la vieille ville, de la place des Arcades au pont Roman...', 'March&eacute; Proven&ccedil;al', 'Retrouvez le march&eacute; proven&ccedil;al de Nyons, tous les dimanches durant la belle saison... Dans la vieille ville, de la place des Arcades au pont Roman...'),
(17, 0, 1, '2008-07-20 23:59:59', '08h00', 'March&eacute; Proven&ccedil;al', 'Venez d&eacute;couvrir les produits des producteurs et artisans de notre r&eacute;gion.', 'March&eacute; Proven&ccedil;al', 'Retrouvez le march&eacute; proven&ccedil;al de Nyons, tous les dimanches durant la belle saison... Dans la vieille ville, de la place des Arcades au pont Roman...'),
(18, 0, 1, '2008-07-15 23:59:59', '21h30', 'Sudden Jazz', 'Dans la rue des D&eacute;port&eacute;s, cot&eacute; place du Colonel Barillon, un trio carr&eacute; pour standard jazz r&eacute;investis...', 'Sudden Jazz', 'Dans la rue des D&eacute;port&eacute;s, cot&eacute; place du Colonel Barillon, un trio carr&eacute; pour standard jazz r&eacute;investis...'),
(19, 0, 1, '2008-07-27 23:59:59', '08h00', 'March&eacute; Proven&ccedil;al', 'Retrouvez le march&eacute; proven&ccedil;al de Nyons, tous les dimanches durant la belle saison... Dans la vieille ville, de la place des Arcades au pont Roman...', 'March&eacute; Proven&ccedil;al', 'Retrouvez le march&eacute; proven&ccedil;al de Nyons, tous les dimanches durant la belle saison... Dans la vieille ville, de la place des Arcades au pont Roman...'),
(20, 0, 1, '2008-07-31 23:59:59', '19h30', 'Les Gaspards', 'D&eacute;ambulation musicale au d&eacute;part de la place Buffaven et au coeur du Vieux Nyons. Un concert musette m&eacute;lant swing balkanique, rythme cara&iuml;be et rap rural.', 'Les Gaspards', 'D&eacute;ambulation musicale au d&eacute;part de la place Buffaven et au coeur du Vieux Nyons. Un concert musette m&eacute;lant swing balkanique, rythme cara&iuml;be et rap rural.'),
(21, 0, 1, '2008-08-16 23:59:59', '21h30', 'Nito Quintana', 'Place du Pont Roman. Une musique bouillonnante, color&eacute;e et &eacute;pic&eacute;e aux saveurs latinos.', 'Nito Quintana', 'Place du Pont Roman. Une musique bouillonnante, color&eacute;e et &eacute;pic&eacute;e aux saveurs latinos.'),
(22, 0, 1, '2008-08-30 23:59:59', '06h00', 'Vide Grenier', 'Venez chiner et trouvez la bonne affaire dans les rues du Vieux Nyons pour notre vide grenier annuel...', 'Vide Grenier', 'Venez chiner et trouvez la bonne affaire dans les rues du Vieux Nyons pour notre vide grenier annuel...'),
(23, 0, 1, '2008-08-03 23:59:59', '08h00', 'March&eacute; Proven&ccedil;al', 'Venez d&eacute;couvrir les produits des producteurs et artisans de notre r&eacute;gion.', 'March&eacute; Proven&ccedil;al', 'Venez d&eacute;couvrir les produits des producteurs et artisans de notre r&eacute;gion.'),
(24, 0, 1, '2008-08-17 23:59:59', '08h00', 'March&eacute; Proven&ccedil;al', 'Venez d&eacute;couvrir les produits des producteurs et artisans de notre r&eacute;gion.', 'March&eacute; Proven&ccedil;al', 'Venez d&eacute;couvrir les produits des producteurs et artisans de notre r&eacute;gion.'),
(25, 0, 1, '2008-08-10 23:59:59', '08h00', 'March&eacute; Proven&ccedil;al', 'Retrouvez le march&eacute; proven&ccedil;al de Nyons, tous les dimanches durant la belle saison... Dans la vieille ville, de la place des Arcades au pont Roman...', 'March&eacute; Proven&ccedil;al', 'Retrouvez le march&eacute; proven&ccedil;al de Nyons, tous les dimanches durant la belle saison... Dans la vieille ville, de la place des Arcades au pont Roman...'),
(26, 0, 1, '2008-08-24 23:59:59', '08h00', 'March&eacute; Proven&ccedil;al', 'Retrouvez le march&eacute; proven&ccedil;al de Nyons, tous les dimanches durant la belle saison... Dans la vieille ville, de la place des Arcades au pont Roman...', 'March&eacute; Proven&ccedil;al', 'Retrouvez le march&eacute; proven&ccedil;al de Nyons, tous les dimanches durant la belle saison... Dans la vieille ville, de la place des Arcades au pont Roman...'),
(27, 0, 1, '2008-08-31 23:59:59', '08h00', 'March&eacute; Proven&ccedil;al', 'Retrouvez le march&eacute; proven&ccedil;al de Nyons, tous les dimanches durant la belle saison... Dans la vieille ville, de la place des Arcades au pont Roman...', 'March&eacute; Proven&ccedil;al', 'Retrouvez le march&eacute; proven&ccedil;al de Nyons, tous les dimanches durant la belle saison... Dans la vieille ville, de la place des Arcades au pont Roman...'),
(28, 0, 1, '2008-09-07 23:59:59', '08h00', 'March&eacute; Proven&ccedil;al', 'Venez d&eacute;couvrir les produits des producteurs et artisans de notre r&eacute;gion.', 'March&eacute; Proven&ccedil;al', 'Venez d&eacute;couvrir les produits des producteurs et artisans de notre r&eacute;gion.'),
(29, 0, 1, '2008-09-14 23:59:59', '08h00', 'March&eacute; Proven&ccedil;al', 'Pour la derni&egrave;re fois de la saison estivale 2008, venez d&eacute;couvrir les produits des producteurs et artisans de notre r&eacute;gion.', 'March&eacute; Proven&ccedil;al', 'Venez d&eacute;couvrir les produits des producteurs et artisans de notre r&eacute;gion.'),
(30, 0, 1, '2009-02-24 23:59:59', '15h00', 'Mardi-gras', 'Comme chaque ann&eacute;e, les commer&ccedil;ants du Vieux Nyons organisent place Barillon, le mardi-gras des enfants des &eacute;coles maternelles de Nyons.', 'Mardi-gras', 'Comme chaque ann&eacute;e, les commer&ccedil;ants du Vieux Nyons organisent place Barillon, le mardi-gras des enfants des &eacute;coles maternelles de Nyons.'),
(31, 0, 1, '2009-05-01 23:59:59', '07h00', 'March&eacute; aux Fleurs', 'Les beaux jours arrivant, le march&eacute; aux fleurs revient comme chaque ann&eacute;e dans le vieux Nyons. Profitez en pour venir choisir et cr&eacute;er vos compositions de jardin...', 'March&eacute; aux Fleurs', 'Les beaux jours arrivant, le march&eacute; aux fleurs revient comme chaque ann&eacute;e dans le vieux Nyons. Profitez en pour venir choisir et cr&eacute;er vos compositions de jardin...'),
(32, 0, 1, '2009-09-19 23:59:59', '10h00', 'Les m&eacute;di&eacute;vales du Pontias', 'La 1 &egrave;re &eacute;dition des M&eacute;di&eacute;vales du Pontias de Nyons se d&eacute;roulera le samedi 19 et le dimanche 20 septembre 2009, lors des des journ&eacute;es du patrimoine. Le th&egrave;me de cette ann&eacute;es est l''anniversaire des 600 ans du pont Roman. Des animations permanentes se d&eacute;rouleront dans les diff&eacute;rentes ruelles de notre vieille ville. le samedi soir se bouclera par une retraite au flambeau sur le th&egrave;me de la l&eacute;gende du Pontias. Le dimanche matin, reprise de la f&ecirc;te par la reconstitution de l''inauguration du pont Roman.\r\nDe nombreux exposants seront &agrave; votre disposition pour vous proposer une multitude d''objet m&eacute;di&eacute;vaux.', 'Les m&eacute;di&eacute;vales du Pontias', 'La 1 &egrave;re &eacute;dition des M&eacute;di&eacute;vales du Pontias de Nyons se d&eacute;roulera le samedi 19 et le dimanche 20 septembre 2009, lors des des journ&eacute;es du patrimoine. Le th&egrave;me de cette ann&eacute;es est l''anniversaire des 600 ans du pont Roman. Des animations permanentes se d&eacute;rouleront dans les diff&eacute;rentes ruelles de notre vieille ville. le samedi soir se bouclera par une retraite au flambeau sur le th&egrave;me de la l&eacute;gende du Pontias. Le dimanche matin, reprise de la f&ecirc;te par la reconstitution de l''inauguration du pont Roman.\r\nDe nombreux exposants seront &agrave; votre disposition pour vous proposer une multitude d''objet m&eacute;di&eacute;vaux.'),
(33, 0, 1, '2009-09-20 23:59:59', '09h30', 'M&eacute;di&eacute;vales du Pontias suite', 'Animations diverses toute la journ&eacute;e. March&eacute; m&eacute;di&eacute;val.', 'M&eacute;di&eacute;vales du Pontias suite', 'Animations diverses toute la journ&eacute;e. March&eacute; m&eacute;di&eacute;val.'),
(35, 0, 1, '2009-08-29 23:59:59', '07h00', 'Vide-Greniers', 'Comme tout les ans notre association de quartier vous propose de venir chiner de la place du Colonel Barillon jusqu''&agrave; la rue de la Maladrerie en passant bien s&ucirc;r par la rue des D&eacute;port&eacute;s. Environ une soixantaine d''exposants exclusivement particuliers et de Nyons d&eacute;balleront leurs &quot;merveilles&quot; Venez Nombreux ! Pour tous renseignements et r&eacute;servations veuillez vous adresser &agrave; partir du 08 ao&ucirc;t 2009, au 11 rue des d&eacute;port&eacute;s, pendant les horaires magasin S''PASSE-TEMPS. t&eacute;l: 04 75 26 01 54 prix du m&egrave;tre lin&eacute;aire:1,50€/m Merci de vous munir d''une pi&egrave;ce d''identit&eacute; et d''un justificatif de domicile sur Nyons (obligatoire ! ) sans cela aucune r&eacute;servation ne sera prise en compte !', 'Vide-Greniers', 'Comme tout les ans notre association de quartier vous propose de venir chiner de la place du Colonel Barillon jusqu''&agrave; la rue de la Maladrerie en passant bien s&ucirc;r par la rue des D&eacute;port&eacute;s. Environ une soixantaine d''exposants exclusivement particuliers et de Nyons d&eacute;balleront leurs &quot;merveilles&quot; Venez Nombreux ! Pour tous renseignements et r&eacute;servations veuillez vous adresser &agrave; partir du 08 ao&ucirc;t 2009, au 11 rue des d&eacute;port&eacute;s, pendant les horaires magasin S''PASSE-TEMPS. t&eacute;l: 04 75 26 01 54 prix du m&egrave;tre lin&eacute;aire:1,50€/m Merci de vous munir d''une pi&egrave;ce d''identit&eacute; et d''un justificatif de domicile sur Nyons (obligatoire ! ) sans cela aucune r&eacute;servation ne sera prise en compte !'),
(36, 0, 1, '2010-02-09 23:59:59', '15h00', 'Mardi Gras des Enfants', 'Comme chaque ann&eacute;e, nous invitons les enfants des &eacute;coles maternelles de Nyons, &agrave; un go&ucirc;ter qui aura lieu place du Colonnel Barillon.', 'Mardi Gras des Enfants', 'Comme chaque ann&eacute;e, nous invitons les enfants des &eacute;coles maternelles de Nyons, &agrave; un go&ucirc;ter qui aura lieu place du Colonnel Barillon.');

-- --------------------------------------------------------

--
-- Structure de la table `vsysgroupe`
--

CREATE TABLE IF NOT EXISTS `vsysgroupe` (
  `v_GroupeID` smallint(4) unsigned NOT NULL AUTO_INCREMENT,
  `v_GroupeNom` varchar(12) NOT NULL DEFAULT '',
  PRIMARY KEY (`v_GroupeID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `vsysgroupe`
--

INSERT INTO `vsysgroupe` (`v_GroupeID`, `v_GroupeNom`) VALUES
(1, 'Admin'),
(2, 'Membres');

-- --------------------------------------------------------

--
-- Structure de la table `vsysimages`
--

CREATE TABLE IF NOT EXISTS `vsysimages` (
  `v_ImageID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `v_ImageFile` varchar(40) NOT NULL,
  `v_ImageNom` varchar(40) DEFAULT NULL,
  `v_ImageMembreID` int(11) DEFAULT '0',
  PRIMARY KEY (`v_ImageID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

--
-- Contenu de la table `vsysimages`
--

INSERT INTO `vsysimages` (`v_ImageID`, `v_ImageFile`, `v_ImageNom`, `v_ImageMembreID`) VALUES
(1, 'av_000.jpg', 'Goutte', 0),
(2, 'av_001.jpg', 'Chat', 0),
(3, 'av_002.jpg', 'Jonquille', 0),
(4, 'av_003.jpg', 'Nemo', 0),
(5, 'av_004.jpg', 'Ile', 0),
(6, 'av_005.jpg', 'Fen&ecirc;tre', 0),
(7, 'av_006.jpg', 'Bec', 0),
(8, 'av_007.jpg', 'Moulin', 0),
(9, 'av_008.jpg', 'Mer', 0),
(10, 'av_009.jpg', 'Chien', 0),
(11, 'av_010.jpg', 'Aigle', 0),
(12, 'av_011.jpg', 'Feuille', 0),
(13, 'av_012.jpg', 'Poisson', 0),
(14, 'av_013.jpg', 'Ch&egrave;vre', 0),
(15, 'av_014.jpg', 'L&eacute;gumes', 0),
(16, 'av_015.jpg', 'Montagne', 0),
(17, 'av_016.jpg', 'Tigre', 0),
(18, 'av_017.jpg', 'Chaton', 0),
(19, 'av_018.jpg', 'Violon', 0),
(20, 'av_019.jpg', 'Phare', 0);

-- --------------------------------------------------------

--
-- Structure de la table `vsysmembres`
--

CREATE TABLE IF NOT EXISTS `vsysmembres` (
  `v_MembreID` smallint(4) unsigned NOT NULL AUTO_INCREMENT,
  `v_MembreIdentite` varchar(15) NOT NULL,
  `v_MembreMotPasse` char(40) NOT NULL,
  `v_MembreLive` tinyint(4) NOT NULL DEFAULT '1',
  `v_MembreActive` tinyint(4) NOT NULL DEFAULT '0',
  `v_MembrePrenom` varchar(20) NOT NULL,
  `v_MembreNom` varchar(25) NOT NULL,
  `v_GroupeID` smallint(4) unsigned NOT NULL DEFAULT '2',
  `v_MembreImage` varchar(25) DEFAULT NULL,
  `v_MembreEmail` varchar(60) DEFAULT NULL,
  `v_MembreCreation` datetime NOT NULL,
  `v_MembreDernierLogin` datetime DEFAULT NULL,
  `v_MembreTS` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`v_MembreID`),
  KEY `v_MembreIdentite` (`v_MembreIdentite`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=37 ;

--
-- Contenu de la table `vsysmembres`
--

INSERT INTO `vsysmembres` (`v_MembreID`, `v_MembreIdentite`, `v_MembreMotPasse`, `v_MembreLive`, `v_MembreActive`, `v_MembrePrenom`, `v_MembreNom`, `v_GroupeID`, `v_MembreImage`, `v_MembreEmail`, `v_MembreCreation`, `v_MembreDernierLogin`, `v_MembreTS`) VALUES
(1, 'webmaster', '427474ab3eb2abdde78cf961c071aaa2d44da356', 1, 2, 'Webmaster', 'VieuxNyons', 1, 'av_016.jpg', 'emmanuel.petit15@laposte.net', '2007-03-17 15:48:03', '2010-01-25 12:33:49', '2010-01-25 12:33:49'),
(2, 'cyroge', 'f54334aefa01d94a5f49d3d1b6b5085f747c9530', 1, 2, 'Cyril', 'Ogé', 2, 'av_000.jpg', 'contact@lafarigoule-nyons.com', '2007-05-09 22:36:49', '2008-11-26 11:10:24', '2008-11-26 11:10:24'),
(3, 'mozel', '8bb3031e07941be7a9de1c7927af62ac5f90be9c', 1, 0, 'Mohamed', 'Ghazel', 2, 'av_000.jpg', NULL, '2007-05-09 22:38:32', NULL, '2007-05-09 22:38:32'),
(4, 'macmaf', '0d0fb3e61fbe6cb50fb35b16bfcca91f6d09cc06', 1, 0, 'Marie Christine', 'Debecq', 2, 'av_000.jpg', NULL, '2007-05-09 22:40:12', NULL, '2007-05-09 22:45:11'),
(5, 'kladro', 'feb86e2c8df73e2036bbc31a74d69a7bdcda702e', 1, 0, 'Pedro', 'Finazzi', 2, 'av_000.jpg', NULL, '2007-05-09 22:41:49', NULL, '2007-05-09 22:41:49'),
(6, 'jeande', '026085fcbdfa4537acbf075eccb4e64e93d81ba2', 1, 0, 'Jean Claude', 'Bertrand', 2, 'av_000.jpg', NULL, '2007-05-09 22:46:27', NULL, '2007-05-09 22:46:27'),
(7, 'lauchel', 'e3f8bfba3c79c826c64b40843cecd61287333ce0', 1, 0, 'Laurence', 'Michel', 2, 'av_000.jpg', NULL, '2007-05-09 22:47:42', NULL, '2007-05-09 22:47:42'),
(8, 'bruret', '393fb5ad5783151c6c0d8237a7a0dc665376564c', 1, 2, 'Céline', 'BUSOLINI', 2, 'av_003.jpg', 'spassetemps26@free.fr', '2007-05-12 15:12:54', '2009-07-09 17:38:18', '2009-07-09 17:38:18'),
(9, 'renian', 'b767b46f98f5d382102aac2eb8d294c99ae117ba', 1, 0, 'Rènald', 'Boyadjian', 2, 'av_000.jpg', NULL, '2007-05-12 15:14:01', NULL, '2007-05-12 15:14:01'),
(10, 'laetiol', 'cdd4c76e9569403359914a5f77963228819ada0f', 1, 0, 'Laetitia', 'Fiol', 2, 'av_000.jpg', NULL, '2007-05-12 15:16:43', NULL, '2007-05-12 15:16:43'),
(11, 'giunlie', '1936ba9120fad3c6419f733c3d4d57879b26a627', 1, 0, 'Nathalie', 'Giunta', 2, 'av_000.jpg', NULL, '2007-05-12 15:17:37', NULL, '2007-05-12 15:17:37'),
(12, 'claunias', '48f946a21bd2d7078ff2944662a690d834a2cd2a', 0, 0, 'Claudie', 'Jarnias', 2, 'av_000.jpg', NULL, '2007-05-12 15:18:46', NULL, '2007-07-09 18:47:15'),
(13, 'ludgri', '8ed948ed296bd553f21ad687824a8afb463ca283', 0, 0, 'Ludmilla', 'Olivigri', 2, 'av_000.jpg', NULL, '2007-05-12 15:19:37', NULL, '2007-06-28 15:56:48'),
(14, 'kardez', '7a47fd09c1ca5d99c7f405cedf83b1740a6c4948', 0, 0, 'karine', 'Fernandez', 2, 'av_000.jpg', NULL, '2007-05-12 15:20:30', NULL, '2007-11-15 15:29:24'),
(15, 'dantre', 'e1d3f7b7f4aaf84599595174530136492dd6207a', 1, 0, 'Danièle', 'Silvestre', 2, 'av_000.jpg', NULL, '2007-05-12 15:21:22', NULL, '2007-05-12 15:21:22'),
(16, 'majery', '8005a508d5a38b65928bc3ae136b186c0dbd493d', 1, 0, 'Marie Jeanne', 'Cury', 2, 'av_000.jpg', NULL, '2007-05-12 15:22:13', NULL, '2007-05-12 15:22:13'),
(17, 'joquet', '0c21a889eb5fd84a1028b45df13c198e4b499513', 1, 0, 'Joelle', 'Coutand', 2, 'av_000.jpg', NULL, '2007-05-12 15:24:31', NULL, '2007-05-12 15:24:31'),
(18, 'laujepi', '43f32c405414299c1c7765a8b0cf526f56ea8155', 1, 0, 'Jean Pierre', 'Laurençon', 2, 'av_000.jpg', NULL, '2007-05-12 15:28:50', NULL, '2007-05-12 15:28:50'),
(19, 'miger', '8654666ded25c8d340513949d0dafcf81ded0126', 1, 2, 'Michel', 'Burger', 2, 'av_000.jpg', 'michelle.koch@free.fr', '2007-05-12 15:29:41', '2007-07-10 18:29:21', '2007-07-10 18:29:21'),
(20, 'domibert', '830754442303f43bce4bcb827ba237328a91948e', 1, 0, 'Dominique', 'Jeaubert', 2, 'av_000.jpg', NULL, '2007-05-12 15:30:44', NULL, '2007-05-12 15:30:44'),
(21, 'sancosa', 'f006c940b571b48584cf1480aba4e230a218b9ac', 1, 0, 'Sandrine', 'Facila', 2, 'av_000.jpg', NULL, '2007-05-12 15:31:37', NULL, '2007-06-12 18:23:23'),
(24, 'mohuri', '4ca0bf083b3bb816079c125fa03d1f4b52fcf483', 0, 0, 'Mohamed', 'Elmansouri', 2, 'av_000.jpg', NULL, '2007-05-12 15:35:05', NULL, '2007-07-09 18:46:15'),
(25, 'girza', '742b0323fe61e0baafaa839bace21be78d01831d', 0, 0, 'Faïza', 'Girard', 2, 'av_000.jpg', NULL, '2007-05-12 15:38:45', NULL, '2007-07-09 18:48:03'),
(26, 'thiang', 'fe704d2ba983f2c16d903f256b805bd7fa1950d4', 1, 0, 'Thi', 'Dang', 2, 'av_000.jpg', NULL, '2007-05-12 15:39:32', NULL, '2007-05-12 15:39:32'),
(27, 'doquen', '790dcb0c23c22fbcc7b3aca23a5be27ed39f7e9c', 1, 0, 'Dominique', 'Pouliquen', 2, 'av_000.jpg', NULL, '2007-05-12 15:40:15', NULL, '2007-05-12 15:40:15'),
(28, 'thetit', '5c19e3b992a161444f91953163adee377f12f09e', 1, 2, 'Emmanuel', 'Petit', 2, 'av_001.jpg', 'letiroirachats@free.fr', '2007-05-12 15:40:56', '2010-01-11 12:11:06', '2010-01-11 12:11:06'),
(29, 'lacorol', 'fa94356c2b0254c31f28fd678202f8b9773f322d', 1, 0, 'Olivier', 'Laurent', 2, 'av_000.jpg', NULL, '2007-06-12 23:48:29', NULL, '2007-06-12 23:48:29'),
(30, 'vanemo', 'aa7f9b8cf43e3bc493aac37d9869e871b3d4fe59', 1, 0, 'Yvan', 'Modena', 2, 'av_000.jpg', NULL, '2007-06-20 17:24:19', NULL, '2007-06-20 17:24:19'),
(31, 'zanadet', 'e94b43aa7e9813899f33232e950afc6c6a90ed50', 1, 0, 'Bernadette', 'Zanella', 2, 'av_000.jpg', NULL, '2007-06-21 16:40:45', NULL, '2007-06-21 16:40:45'),
(32, 'berset', '2ebd91f26c5658ed9fa3d8c3542864eb6162d01f', 1, 0, 'Pierre Laurent', 'Bernard', 2, 'av_000.jpg', NULL, '2008-04-04 10:23:00', NULL, '2008-04-04 10:23:00'),
(33, 'webadmin', '4e0679270b875d092ba2bef0d87ea87531392e57', 1, 2, 'Eric', 'Ravier', 1, 'av_004.jpg', 'cfcpr@orange.fr', '2009-05-07 00:54:30', '2009-08-06 17:02:25', '2009-08-06 17:02:25'),
(36, 'CFCPR', '4e0679270b875d092ba2bef0d87ea87531392e57', 1, 2, 'Eric', 'Ravier', 2, 'av_019.jpg', 'cfcpr@orange.fr', '2009-05-29 16:25:32', '2009-06-09 08:47:27', '2009-06-09 08:47:27');

-- --------------------------------------------------------

--
-- Structure de la table `vsysphotogroupes`
--

CREATE TABLE IF NOT EXISTS `vsysphotogroupes` (
  `v_GroupeID` smallint(4) unsigned NOT NULL AUTO_INCREMENT,
  `v_GroupeNom` varchar(35) NOT NULL,
  `v_GroupePublic` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `v_GroupeActif` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `v_GroupeNomUK` varchar(35) NOT NULL,
  PRIMARY KEY (`v_GroupeID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Contenu de la table `vsysphotogroupes`
--

INSERT INTO `vsysphotogroupes` (`v_GroupeID`, `v_GroupeNom`, `v_GroupePublic`, `v_GroupeActif`, `v_GroupeNomUK`) VALUES
(1, 'Mardi Gras 2006', 1, 1, 'Carnival 2006'),
(2, 'March&eacute; Floral 2006', 1, 1, 'Flower Market 2006'),
(3, 'Cirque Lido 2006', 1, 1, 'Lido Circus 2006'),
(4, 'Repas Noel 2006', 0, 1, 'Xmas meal 2006'),
(5, 'Mardi Gras 2007', 1, 1, 'Carnival 2007'),
(6, 'March&eacute; Floral 2007', 1, 1, 'Flower Market 2007'),
(7, 'Cr&ecirc;che 2007', 1, 1, 'Nativity scene 2007'),
(8, 'La cr&ecirc;che 2007', 0, 1, 'La cr&ecirc;che 2007'),
(9, 'Mardi Gras 2009', 1, 0, 'Mardi Gras 2009'),
(10, 'M&eacute;di&eacute;vales 2009', 1, 1, 'Medieval Festival'),
(11, 'Mardi Gras 2008', 1, 1, 'Mardi-gras 2008'),
(12, 'Mardi Gras 2009', 1, 1, 'Mardi Gras 2009');

-- --------------------------------------------------------

--
-- Structure de la table `vsysphotos`
--

CREATE TABLE IF NOT EXISTS `vsysphotos` (
  `v_PhotoID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `v_GroupeID` smallint(4) unsigned NOT NULL,
  `v_FileNom` varchar(20) NOT NULL,
  `v_PhotoNom` varchar(40) NOT NULL DEFAULT '',
  `v_PhotoActif` tinyint(4) NOT NULL DEFAULT '1',
  `v_PublicDomaine` tinyint(3) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`v_PhotoID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=337 ;

--
-- Contenu de la table `vsysphotos`
--

INSERT INTO `vsysphotos` (`v_PhotoID`, `v_GroupeID`, `v_FileNom`, `v_PhotoNom`, `v_PhotoActif`, `v_PublicDomaine`) VALUES
(1, 3, 'lido2006_01.jpg', 'Equilibristes', 1, 1),
(2, 3, 'lido2006_02.jpg', 'La poutre', 1, 1),
(3, 3, 'lido2006_03.jpg', 'Equilibre', 1, 1),
(4, 3, 'lido2006_04.jpg', 'Gymnases', 1, 1),
(5, 3, 'lido2006_05.jpg', 'Gymnases', 1, 1),
(6, 3, 'lido2006_06.jpg', 'Jongleur', 1, 1),
(7, 3, 'lido2006_07.jpg', 'Monocycle', 1, 1),
(8, 3, 'lido2006_08.jpg', 'Gymnases', 1, 1),
(9, 3, 'lido2006_09.jpg', 'Gymnases', 1, 1),
(10, 3, 'lido2006_10.jpg', 'Gymnases', 1, 1),
(11, 3, 'lido2006_11.jpg', 'Ballon', 1, 1),
(12, 3, 'lido2006_12.jpg', 'Jongleurs', 1, 1),
(13, 3, 'lido2006_13.jpg', 'Echelle', 1, 1),
(14, 3, 'lido2006_14.jpg', 'Echelle', 1, 1),
(15, 3, 'lido2006_15.jpg', 'Trempoline', 1, 1),
(16, 3, 'lido2006_16.jpg', 'Trempoline', 1, 1),
(17, 3, 'lido2006_17.jpg', 'Les artistes', 1, 1),
(18, 3, 'lido2006_18.jpg', 'La corde', 1, 1),
(19, 3, 'lido2006_19.jpg', 'Acrobates', 1, 1),
(20, 3, 'lido2006_20.jpg', 'Acrobates', 1, 1),
(21, 3, 'lido2006_21.jpg', 'Acrobates', 1, 1),
(22, 3, 'lido2006_22.jpg', 'Tous en sc&egrave;ne', 1, 1),
(23, 3, 'lido2006_23.jpg', 'Le feu', 1, 1),
(24, 3, 'lido2006_24.jpg', 'Le feu', 1, 1),
(25, 3, 'lido2006_25.jpg', 'Le feu', 1, 1),
(26, 3, 'lido2006_26.jpg', 'Le feu', 1, 1),
(27, 3, 'lido2006_27.jpg', 'Le feu', 1, 1),
(28, 3, 'lido2006_28.jpg', 'Le feu', 1, 1),
(29, 3, 'lido2006_29.jpg', 'Le feu', 1, 1),
(30, 3, 'lido2006_30.jpg', 'Le feu', 1, 1),
(31, 2, 'mf2006_01.jpg', 'Place Barillon', 1, 1),
(32, 2, 'mf2006_02.jpg', 'Place Barillon', 1, 1),
(33, 2, 'mf2006_03.jpg', 'Rue des D&eacute;port&eacute;s', 1, 1),
(34, 2, 'mf2006_04.jpg', 'Rue des D&eacute;port&eacute;s', 1, 1),
(35, 2, 'mf2006_05.jpg', 'Rue des D&eacute;port&eacute;s', 1, 1),
(36, 2, 'mf2006_06.jpg', 'Place Jules Laurent', 1, 1),
(37, 2, 'mf2006_07.jpg', 'Place Jules Laurent', 1, 1),
(38, 2, 'mf2006_08.jpg', 'Place Jules Laurent', 1, 1),
(39, 2, 'mf2006_09.jpg', 'Place Barillon', 1, 1),
(40, 2, 'mf2006_10.jpg', 'Place Barillon', 1, 1),
(41, 2, 'mf2006_11.jpg', 'Place Barillon', 1, 1),
(42, 2, 'mf2006_12.jpg', 'Place Barillon', 1, 1),
(43, 2, 'mf2006_13.jpg', 'Place Barillon', 1, 1),
(44, 2, 'mf2006_14.jpg', 'Place Jules Laurent', 1, 1),
(45, 2, 'mf2006_15.jpg', 'Place Jules Laurent', 1, 1),
(46, 2, 'mf2006_16.jpg', 'Rue des D&eacute;port&eacute;s', 1, 1),
(47, 2, 'mf2006_17.jpg', 'Rue des D&eacute;port&eacute;s', 1, 1),
(48, 2, 'mf2006_18.jpg', 'Place Barillon', 1, 1),
(49, 2, 'mf2006_19.jpg', 'Place Barillon', 1, 1),
(50, 2, 'mf2006_20.jpg', 'Place Barillon', 1, 1),
(51, 2, 'mf2006_21.jpg', 'Place Barillon', 1, 1),
(52, 2, 'mf2006_22.jpg', 'Rue des D&eacute;port&eacute;s', 1, 1),
(53, 2, 'mf2006_23.jpg', 'Rue des D&eacute;port&eacute;s', 1, 1),
(54, 2, 'mf2006_24.jpg', 'Rue des D&eacute;port&eacute;s', 1, 1),
(55, 2, 'mf2006_25.jpg', 'Rue des D&eacute;port&eacute;s', 1, 1),
(56, 2, 'mf2006_26.jpg', 'Rue des D&eacute;port&eacute;s', 1, 1),
(57, 2, 'mf2006_27.jpg', 'Rue des D&eacute;port&eacute;s', 1, 1),
(58, 2, 'mf2006_28.jpg', 'Rue des D&eacute;port&eacute;s', 1, 1),
(59, 2, 'mf2006_29.jpg', 'Rue des D&eacute;port&eacute;s', 1, 1),
(60, 2, 'mf2006_30.jpg', 'Rue des D&eacute;port&eacute;s', 1, 1),
(61, 2, 'mf2006_31.jpg', 'Place Jules Laurent', 1, 1),
(62, 2, 'mf2006_32.jpg', 'Place Jules Laurent', 1, 1),
(63, 2, 'mf2006_33.jpg', 'Rue des D&eacute;port&eacute;s', 1, 1),
(64, 2, 'mf2006_34.jpg', 'Rue des D&eacute;port&eacute;s', 1, 1),
(65, 2, 'mf2006_35.jpg', 'Rue des D&eacute;port&eacute;s', 1, 1),
(66, 2, 'mf2006_36.jpg', 'Rue des D&eacute;port&eacute;s', 1, 1),
(67, 2, 'mf2006_37.jpg', 'Place Jules Laurent', 1, 1),
(68, 6, 'mf2007_01.jpg', 'Rue des D&eacute;port&eacute;s', 1, 1),
(69, 6, 'mf2007_02.jpg', 'Place Barillon', 1, 1),
(70, 6, 'mf2007_03.jpg', 'Rue des D&eacute;port&eacute;s', 1, 1),
(71, 6, 'mf2007_04.jpg', 'Place Barillon', 1, 1),
(72, 6, 'mf2007_05.jpg', 'Place Barillon', 1, 1),
(73, 6, 'mf2007_06.jpg', 'Place Barillon', 1, 1),
(74, 6, 'mf2007_07.jpg', 'Rue des D&eacute;port&eacute;s', 1, 1),
(76, 6, 'mf2007_09.jpg', 'Rue des D&eacute;port&eacute;s', 1, 1),
(77, 6, 'mf2007_10.jpg', 'Rue des D&eacute;port&eacute;s', 1, 1),
(78, 6, 'mf2007_11.jpg', 'Rue des D&eacute;port&eacute;s', 1, 1),
(79, 6, 'mf2007_12.jpg', 'Place Jules Laurent', 1, 1),
(80, 6, 'mf2007_13.jpg', 'Place Jules Laurent', 1, 1),
(81, 6, 'mf2007_14.jpg', 'Place Jules Laurent', 1, 1),
(82, 6, 'mf2007_15.jpg', 'Place Jules Laurent', 1, 1),
(83, 6, 'mf2007_16.jpg', 'Place Jules Laurent', 1, 1),
(84, 6, 'mf2007_17.jpg', 'Place Jules Laurent', 1, 1),
(85, 6, 'mf2007_18.jpg', 'Place Jules Laurent', 1, 1),
(86, 6, 'mf2007_19.jpg', 'Place Jules Laurent', 1, 1),
(87, 6, 'mf2007_20.jpg', 'Place Jules Laurent', 1, 1),
(88, 1, 'mg2006_01.jpg', 'Mardi-gras 2006', 1, 1),
(89, 1, 'mg2006_02.jpg', 'Mardi-gras 2006', 1, 1),
(90, 1, 'mg2006_03.jpg', 'Uhmmm c&acute;est bon...', 1, 1),
(91, 1, 'mg2006_04.jpg', 'Mardi-gras 2006', 1, 1),
(92, 1, 'mg2006_05.jpg', 'Mardi-gras 2006', 1, 1),
(93, 1, 'mg2006_06.jpg', 'Mardi-gras 2006', 1, 1),
(94, 1, 'mg2006_07.jpg', 'La f&eacute;e', 1, 1),
(95, 1, 'mg2006_08.jpg', 'Un d&eacute;guisement?', 1, 1),
(96, 1, 'mg2006_09.jpg', 'Mardi-gras 2006', 1, 1),
(97, 1, 'mg2006_10.jpg', 'Mardi-gras 2006', 1, 1),
(98, 1, 'mg2006_11.jpg', 'Guerre des &eacute;toiles', 1, 1),
(99, 1, 'mg2006_12.jpg', 'Les guignols de VTVN', 1, 1),
(100, 1, 'mg2006_13.jpg', 'Mardi-gras 2006', 1, 1),
(101, 1, 'mg2006_14.jpg', 'Mardi-gras 2006', 1, 1),
(102, 1, 'mg2006_15.jpg', 'Mardi-gras 2006', 1, 1),
(103, 1, 'mg2006_16.jpg', 'Le go&ucirc;ter', 1, 1),
(104, 1, 'mg2006_17.jpg', 'Le go&ucirc;ter', 1, 1),
(105, 1, 'mg2006_18.jpg', 'Le go&ucirc;ter', 1, 1),
(106, 1, 'mg2006_19.jpg', 'Mardi-gras 2006', 1, 1),
(107, 1, 'mg2006_22.jpg', 'Le go&ucirc;ter', 1, 1),
(108, 1, 'mg2006_23.jpg', 'Le go&ucirc;ter', 1, 1),
(109, 5, 'mg2007_01.jpg', 'La procession', 1, 1),
(110, 5, 'mg2007_02.jpg', 'La procession', 1, 1),
(111, 5, 'mg2007_03.jpg', 'Le go&ucirc;ter', 1, 1),
(112, 5, 'mg2007_04.jpg', 'Ils arrivent...', 1, 1),
(113, 5, 'mg2007_05.jpg', 'Ils arrivent...', 1, 1),
(114, 5, 'mg2007_06.jpg', 'Ils arrivent...', 1, 1),
(115, 5, 'mg2007_07.jpg', 'Ils arrivent...', 1, 1),
(116, 5, 'mg2007_08.jpg', 'Ils arrivent...', 1, 1),
(117, 5, 'mg2007_09.jpg', 'La danse', 1, 1),
(118, 5, 'mg2007_10.jpg', 'Mardi-gras 2007', 1, 1),
(119, 5, 'mg2007_11.jpg', 'En route vers le pont', 1, 1),
(120, 5, 'mg2007_12.jpg', 'De retour du pont', 1, 1),
(121, 5, 'mg2007_13.jpg', 'De retour du pont', 1, 1),
(122, 5, 'mg2007_14.jpg', 'De retour du pont', 1, 1),
(123, 5, 'mg2007_15.jpg', 'De retour du pont', 1, 1),
(124, 5, 'mg2007_16.jpg', 'De retour du pont', 1, 1),
(125, 5, 'mg2007_17.jpg', 'Chansons', 1, 1),
(126, 5, 'mg2007_18.jpg', 'Chansons', 1, 1),
(127, 5, 'mg2007_19.jpg', 'Chansons', 1, 1),
(128, 5, 'mg2007_20.jpg', 'Chansons', 1, 1),
(129, 5, 'mg2007_21.jpg', 'Chansons', 1, 1),
(130, 5, 'mg2007_22.jpg', 'Chansons', 1, 1),
(131, 5, 'mg2007_23.jpg', 'Danse', 1, 1),
(132, 5, 'mg2007_24.jpg', 'Danse', 1, 1),
(133, 5, 'mg2007_25.jpg', 'Danse', 1, 1),
(134, 5, 'mg2007_26.jpg', 'Danse', 1, 1),
(135, 5, 'mg2007_27.jpg', 'Danse', 1, 1),
(136, 5, 'mg2007_28.jpg', 'Danse', 1, 1),
(137, 5, 'mg2007_29.jpg', 'Danse', 1, 1),
(138, 5, 'mg2007_30.jpg', 'Danse', 1, 1),
(139, 5, 'mg2007_31.jpg', 'Danse', 1, 1),
(140, 5, 'mg2007_32.jpg', 'Le go&ucirc;ter', 1, 1),
(141, 5, 'mg2007_33.jpg', 'Danse', 1, 1),
(142, 5, 'mg2007_34.jpg', 'Danse', 1, 1),
(143, 5, 'mg2007_35.jpg', 'Mardi-gras 2007', 1, 1),
(144, 5, 'mg2007_36.jpg', 'Mardi-gras 2007', 1, 1),
(145, 5, 'mg2007_37.jpg', 'Danse', 1, 1),
(146, 5, 'mg2007_38.jpg', 'Danse', 1, 1),
(147, 5, 'mg2007_39.jpg', 'Danse', 1, 1),
(148, 5, 'mg2007_44.jpg', 'Mardi-gras 2007', 1, 1),
(149, 5, 'mg2007_41.jpg', 'Le go&ucirc;ter', 1, 1),
(150, 5, 'mg2007_42.jpg', 'Le go&ucirc;ter', 1, 1),
(151, 5, 'mg2007_43.jpg', 'Mardi-gras 2007', 1, 1),
(152, 5, 'mg2007_44.jpg', 'Mardi-gras 2007', 1, 1),
(153, 4, 'rd2006_01.jpg', 'Décembre 2006', 1, 1),
(154, 4, 'rd2006_02.jpg', 'Décembre 2006', 1, 1),
(155, 4, 'rd2006_03.jpg', 'Décembre 2006', 1, 1),
(156, 4, 'rd2006_04.jpg', 'Décembre 2006', 1, 1),
(157, 4, 'rd2006_05.jpg', 'Décembre 2006', 1, 1),
(158, 4, 'rd2006_06.jpg', 'Décembre 2006', 1, 1),
(159, 4, 'rd2006_07.jpg', 'Décembre 2006', 1, 1),
(160, 4, 'rd2006_08.jpg', 'Décembre 2006', 1, 1),
(161, 4, 'rd2006_09.jpg', 'Décembre 2006', 1, 1),
(162, 4, 'rd2006_10.jpg', 'Décembre 2006', 1, 1),
(163, 4, 'rd2006_11.jpg', 'Décembre 2006', 1, 1),
(164, 4, 'rd2006_12.jpg', 'Décembre 2006', 1, 1),
(165, 4, 'rd2006_13.jpg', 'Décembre 2006', 1, 1),
(166, 4, 'rd2006_14.jpg', 'Décembre 2006', 1, 1),
(167, 4, 'rd2006_15.jpg', 'Décembre 2006', 1, 1),
(168, 4, 'rd2006_16.jpg', 'Décembre 2006', 1, 1),
(169, 4, 'rd2006_17.jpg', 'Décembre 2006', 1, 1),
(170, 4, 'rd2006_18.jpg', 'Décembre 2006', 1, 1),
(171, 4, 'rd2006_19.jpg', 'Décembre 2006', 1, 1),
(172, 4, 'rd2006_20.jpg', 'Décembre 2006', 1, 1),
(173, 4, 'rd2006_21.jpg', 'Décembre 2006', 1, 1),
(174, 4, 'rd2006_22.jpg', 'Décembre 2006', 1, 1),
(175, 4, 'rd2006_23.jpg', 'Décembre 2006', 1, 1),
(176, 4, 'rd2006_24.jpg', 'Décembre 2006', 1, 1),
(177, 4, 'rd2006_25.jpg', 'Décembre 2006', 1, 1),
(178, 7, 'cre2007_01.jpg', 'La cr&ecirc;che 2007', 1, 1),
(179, 7, 'cre2007_02.jpg', 'Le berger et Marie', 1, 1),
(180, 7, 'cre2007_03.jpg', 'Les 3 rois mages', 1, 1),
(181, 7, 'cre2007_04.jpg', 'Les 3 rois mages', 1, 1),
(182, 7, 'cre2007_05.jpg', 'En attendant le petit J&eacute;sus', 1, 1),
(183, 7, 'cre2007_06.jpg', 'La cr&ecirc;che 2007', 1, 1),
(184, 7, 'cre2007_07.jpg', 'Les 3 rois mages', 1, 1),
(185, 7, 'cre2007_08.jpg', 'La cr&ecirc;che', 1, 1),
(186, 7, 'cre2007_09.jpg', 'Les animaux', 1, 1),
(187, 7, 'cre2007_10.jpg', 'La cr&ecirc;che', 1, 1),
(188, 7, 'cre2007_11.jpg', 'La cr&ecirc;che', 1, 1),
(189, 7, 'cre2007_12.jpg', 'La cr&ecirc;che', 1, 1),
(190, 7, 'cre2007_13.jpg', 'Les 3 rois mages et Joseph', 1, 1),
(191, 7, 'cre2007_14.jpg', 'Marie et le berger', 1, 1),
(192, 7, 'cre2007_15.jpg', 'La cr&ecirc;che', 1, 1),
(193, 7, 'cre2007_16.jpg', 'L&acute;&acirc;ne', 1, 1),
(194, 7, 'cre2007_17.jpg', 'La vache', 1, 1),
(195, 7, 'cre2007_18.jpg', 'La cr&ecirc;che', 1, 1),
(196, 7, 'cre2007_19.jpg', 'Le mouton', 1, 1),
(197, 7, 'cre2007_20.jpg', 'Rois mages', 1, 1),
(198, 7, 'cre2007_21.jpg', 'La cr&ecirc;che', 1, 1),
(199, 7, 'cre2007_22.jpg', 'La cr&ecirc;che', 1, 1),
(200, 7, 'cre2007_23.jpg', 'Un roi mage et le Pont Roman', 1, 1),
(201, 7, 'cre2007_24.jpg', 'Marie', 1, 1),
(202, 7, 'cre2007_25.jpg', 'Vue de la cr&ecirc;che', 1, 1),
(203, 7, 'cre2007_26.jpg', 'Les rois mages', 1, 1),
(204, 7, 'cre2007_27.jpg', 'La cr&ecirc;che', 1, 1),
(205, 7, 'cre2007_28.jpg', 'Le mouton', 1, 1),
(206, 7, 'cre2007_29.jpg', 'L&acute;&acirc;ne', 1, 1),
(207, 7, 'cre2007_30.jpg', 'La vache', 1, 1),
(208, 7, 'cre2007_31.jpg', 'La cr&ecirc;che, la nuit', 1, 1),
(209, 7, 'cre2007_32.jpg', 'La cr&ecirc;che, la nuit', 1, 1),
(210, 7, 'cre2007_33.jpg', 'La cr&ecirc;che, le Pont Roman', 1, 1),
(211, 7, 'cre2007_34.jpg', 'La cr&ecirc;che, la nuit', 1, 1),
(212, 7, 'cre2007_35.jpg', 'La cr&ecirc;che, la nuit', 1, 1),
(213, 7, 'cre2007_36.jpg', 'La cr&ecirc;che, la nuit', 1, 1),
(214, 7, 'cre2007_37.jpg', 'La cr&ecirc;che, la nuit', 1, 1),
(215, 8, 'insCre001.jpg', 'Installation', 1, 1),
(216, 8, 'insCre002.jpg', 'Installation', 1, 1),
(217, 8, 'insCre003.jpg', 'Installation', 1, 1),
(218, 8, 'insCre004.jpg', 'Installation', 1, 1),
(219, 8, 'insCre005.jpg', 'Installation', 1, 1),
(220, 8, 'insCre006.jpg', 'Installation', 1, 1),
(221, 8, 'insCre007.jpg', 'Installation', 1, 1),
(222, 8, 'insCre008.jpg', 'Installation', 1, 1),
(223, 8, 'insCre009.jpg', 'Installation', 1, 1),
(224, 8, 'insCre010.jpg', 'Installation', 1, 1),
(225, 8, 'insCre011.jpg', 'Installation', 1, 1),
(226, 8, 'insCre012.jpg', 'Installation', 1, 1),
(227, 8, 'insCre013.jpg', 'Installation', 1, 1),
(228, 8, 'insCre014.jpg', 'Installation', 1, 1),
(229, 8, 'insCre015.jpg', 'Installation', 1, 1),
(230, 8, 'insCre016.jpg', 'Installation', 1, 1),
(231, 8, 'insCre017.jpg', 'Installation', 1, 1),
(232, 8, 'insCre018.jpg', 'Installation', 1, 1),
(233, 8, 'insCre019.jpg', 'Installation', 1, 1),
(234, 8, 'insCre020.jpg', 'Installation', 1, 1),
(235, 8, 'insCre021.jpg', 'Installation', 1, 1),
(236, 8, 'insCre022.jpg', 'Installation', 1, 1),
(237, 8, 'insCre023.jpg', 'Installation', 1, 1),
(238, 8, 'insCre024.jpg', 'Installation', 1, 1),
(239, 8, 'insCre025.jpg', 'Installation', 1, 1),
(240, 8, 'insCre026.jpg', 'Installation', 1, 1),
(241, 8, 'insCre027.jpg', 'Installation', 1, 1),
(242, 8, 'insCre028.jpg', 'Installation', 1, 1),
(243, 8, 'insCre029.jpg', 'Installation', 1, 1),
(244, 8, 'insCre030.jpg', 'Installation', 1, 1),
(245, 8, 'insCre031.jpg', 'Installation', 1, 1),
(246, 8, 'insCre032.jpg', 'Installation', 1, 1),
(247, 8, 'insCre033.jpg', 'Installation', 1, 1),
(248, 8, 'insCre034.jpg', 'Installation', 1, 1),
(249, 8, 'insCre035.jpg', 'Installation', 1, 1),
(250, 8, 'insCre036.jpg', 'Installation', 1, 1),
(251, 8, 'insCre037.jpg', 'Installation', 1, 1),
(252, 8, 'insCre038.jpg', 'Installation', 1, 1),
(253, 8, 'insCre039.jpg', 'Installation', 1, 1),
(254, 8, 'insCre040.jpg', 'Installation', 1, 1),
(255, 8, 'insCre041.jpg', 'Installation', 1, 1),
(256, 8, 'insCre042.jpg', 'Installation', 1, 1),
(257, 8, 'insCre043.jpg', 'Installation', 1, 1),
(258, 8, 'insCre044.jpg', 'Installation', 1, 1),
(259, 8, 'insCre045.jpg', 'Installation', 1, 1),
(260, 8, 'insCre046.jpg', 'Installation', 1, 1),
(261, 8, 'insCre047.jpg', 'Installation', 1, 1),
(262, 8, 'insCre048.jpg', 'Installation', 1, 1),
(263, 8, 'insCre049.jpg', 'Installation', 1, 1),
(264, 8, 'insCre050.jpg', 'Installation', 1, 1),
(265, 10, 'med2009_01.jpg', 'Les troubadours', 1, 1),
(266, 10, 'med2009_02.jpg', 'La procession', 1, 1),
(267, 10, 'med2009_03.jpg', 'La garnison', 1, 1),
(268, 10, 'med2009_04.jpg', 'Les musiciens', 1, 1),
(269, 10, 'med2009_05.jpg', 'Gentes Dames', 1, 1),
(270, 10, 'med2009_06.jpg', 'Les l&eacute;preux', 1, 1),
(271, 10, 'med2009_07.jpg', 'Les derniers r&icirc;tes', 1, 1),
(272, 10, 'med2009_08.jpg', 'Tente et armes', 1, 1),
(273, 10, 'med2009_09.jpg', 'La sorci&egrave;re', 1, 1),
(274, 10, 'med2009_10.jpg', 'La parade', 1, 1),
(275, 10, 'med2009_11.jpg', 'Les musiciens', 1, 1),
(276, 10, 'med2009_12.jpg', 'La parade', 1, 1),
(277, 10, 'med2009_13.jpg', 'La parade', 1, 1),
(278, 10, 'med2009_14.jpg', 'Encore des l&eacute;preux', 1, 1),
(279, 10, 'med2009_15.jpg', 'Jeunes sieurs', 1, 1),
(280, 10, 'med2009_16.jpg', 'Un combat', 1, 1),
(281, 10, 'med2009_17.jpg', 'Oyez oyez', 1, 1),
(282, 10, 'med2009_18.jpg', 'Le seigneur Combes', 1, 1),
(283, 10, 'med2009_19.jpg', 'Le chevalier Mariton', 1, 1),
(284, 10, 'med2009_20.jpg', 'Les aubergistes', 1, 1),
(285, 10, 'med2009_21.jpg', 'Les aubergistes', 1, 1),
(286, 10, 'med2009_22.jpg', 'Le ferronier', 1, 1),
(287, 10, 'med2009_23.jpg', 'Les marchands', 1, 1),
(288, 10, 'med2009_24.jpg', 'Les marchands', 1, 1),
(289, 10, 'med2009_25.jpg', 'Les marchands', 1, 1),
(290, 10, 'med2009_26.jpg', 'Gentes Dames', 1, 1),
(291, 10, 'med2009_27.jpg', 'Les marchands', 1, 1),
(292, 10, 'med2009_28.jpg', 'Tiens, toujours des l&eacute;preux', 1, 1),
(293, 10, 'med2009_29.jpg', 'Dame et Chevalier', 1, 1),
(294, 10, 'med2009_30.jpg', 'Les marchands', 1, 1),
(295, 10, 'med2009_31.jpg', 'Les marchands', 1, 1),
(296, 10, 'med2009_32.jpg', 'Les armuriers', 1, 1),
(297, 10, 'med2009_33.jpg', 'Les tapissiers', 1, 1),
(298, 10, 'med2009_34.jpg', 'Les marchands', 1, 1),
(299, 10, 'med2009_35.jpg', 'Les marchands', 1, 1),
(300, 10, 'med2009_36.jpg', 'Mise &agrave; mort', 1, 1),
(301, 10, 'med2009_37.jpg', 'Les danseurs', 1, 1),
(302, 10, 'med2009_38.jpg', 'La catapulte', 1, 1),
(303, 10, 'med2009_39.jpg', 'Les &eacute;crivains', 1, 1),
(304, 10, 'med2009_40.jpg', 'Les dignitaires', 1, 1),
(305, 10, 'med2009_41.jpg', 'Les dignitaires', 1, 1),
(306, 10, 'med2009_42.jpg', 'Les dignitaires', 1, 1),
(307, 11, 'mg2008_01.jpg', 'Venant du Pont Roman', 1, 1),
(308, 11, 'mg2008_02.jpg', 'La parade venant du Pont Roman', 1, 1),
(309, 11, 'mg2008_03.jpg', 'Venant du Pont Roman', 1, 1),
(310, 11, 'mg2008_04.jpg', 'Venant du Pont Roman', 1, 1),
(311, 11, 'mg2008_05.jpg', 'Oh, la vache...', 1, 1),
(312, 11, 'mg2008_06.jpg', 'Le clan des Spiderman', 1, 1),
(313, 11, 'mg2008_07.jpg', 'De quoi manger...', 1, 1),
(314, 11, 'mg2008_08.jpg', 'Le go&ucirc;ter', 1, 1),
(315, 11, 'mg2008_09.jpg', 'Les enfants', 1, 1),
(316, 11, 'mg2008_10.jpg', 'Chansons des enfants', 1, 1),
(317, 11, 'mg2008_11.jpg', 'Les enfants ont faim', 1, 1),
(318, 11, 'mg2008_12.jpg', 'Les enfants', 1, 1),
(319, 11, 'mg2008_13.jpg', 'La chanson', 1, 1),
(320, 11, 'mg2008_14.jpg', 'Les indiens', 1, 1),
(321, 12, 'mg2009_01.jpg', 'La parade', 1, 1),
(322, 12, 'mg2009_02.jpg', 'La parade', 1, 1),
(323, 12, 'mg2009_03.jpg', 'La parade', 1, 1),
(324, 12, 'mg2009_04.jpg', 'La parade', 1, 1),
(325, 12, 'mg2009_05.jpg', 'En grande discussion', 1, 1),
(326, 12, 'mg2009_06.jpg', 'La parade arrive', 1, 1),
(327, 12, 'mg2009_07.jpg', 'La parade', 1, 1),
(328, 12, 'mg2009_08.jpg', 'La parade arrive', 1, 1),
(329, 12, 'mg2009_09.jpg', 'Le go&ucirc;ter', 1, 1),
(330, 12, 'mg2009_10.jpg', 'On a soif...', 1, 1),
(331, 12, 'mg2009_11.jpg', 'Nous aussi, on a faim...', 1, 1),
(332, 12, 'mg2009_12.jpg', 'Petits animaux', 1, 1),
(333, 12, 'mg2009_13.jpg', 'Le chat', 1, 1),
(334, 12, 'mg2009_14.jpg', 'Le cochon', 1, 1),
(335, 12, 'mg2009_15.jpg', 'Un roi', 1, 1),
(336, 12, 'mg2009_16.jpg', 'Un autre roi', 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `vsysrues`
--

CREATE TABLE IF NOT EXISTS `vsysrues` (
  `v_RueID` smallint(4) unsigned NOT NULL AUTO_INCREMENT,
  `v_RueNom` varchar(60) DEFAULT NULL,
  PRIMARY KEY (`v_RueID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Contenu de la table `vsysrues`
--

INSERT INTO `vsysrues` (`v_RueID`, `v_RueNom`) VALUES
(1, 'Rue du Pontias'),
(2, 'Place du Colonel Barillon'),
(3, 'Rue des D&eacute;port&eacute;s'),
(4, 'Place Jules Laurent'),
(5, 'Rue de la Maladrerie');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
