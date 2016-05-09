CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
);

CREATE TABLE IF NOT EXISTS `spielkarte` (
  `sk_id` int(11) NOT NULL AUTO_INCREMENT,
  `u_id` int(11) NOT NULL,
  `s_id` int(11) NOT NULL,
  `Einer` int(5),
  `Zweier` int(5),
  `Dreier` int(5),
  `Vierer` int(5),
  `Fuenfer` int(5),
  `Sechser` int(5),
  `summe_oben` int(5),
  `Dreierpasch` int(5),
  `Viererpasch` int(5),
  `Full_House` int(5),
  `kleine_Straße` int(5),
  `große_Straße` int(5),
  `Kniffel` int(5),
  `Chance` int(5),
  `summe_unten` int(5),
  PRIMARY KEY (`sk_id`),
  FOREIGN KEY (u_Id) REFERENCES user(id),
  FOREIGN KEY (s_Id) REFERENCES spiele(s_id)
);

CREATE TABLE IF NOT EXISTS `spiele` (
  `s_id` int(11) NOT NULL AUTO_INCREMENT,
  `beendet` BOOLEAN,
  `Startdatum` DATE,
  `Derzeitiger_Spieler` int(11),
  PRIMARY KEY (`s_id`)
);