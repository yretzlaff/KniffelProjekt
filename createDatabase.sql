Drop Table Spielkarte;
Drop Table User;
Drop Table Spiele;


CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `spielerscore` int(6) DEFAULT "1500",
  PRIMARY KEY (`id`)
);


CREATE TABLE IF NOT EXISTS `spiele` (
  `s_id` int(11) NOT NULL AUTO_INCREMENT,
  `beendet` BOOLEAN,
  `Startdatum` DATE,
  `Derzeitiger_Spieler` int(11),
  PRIMARY KEY (`s_id`)
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


Insert into User (id, username, spielerscore)
Values (12, 'Robin', 1246),
	   (666, 'Kevin', 1594),
	   (34, 'Hendrik', 4587),
	   (2, 'Yannick', 5),
	   (71, 'Dennis', 456),
	   (72, 'Claudia', 756),
	   (73, 'Leon', 712),
	   (74, 'Jan', 789),
	   (75, 'Manfred', 333),
	   (76, 'Giesela', 222),
	   (77, 'Tanja', 1111),
	   (78, 'Maria', 1234),
	   (79, 'Sven', 0),
	   (80, 'Mark', 444);



Insert into Spiele (s_id, beendet, Derzeitiger_Spieler)
Values (1, 1, null),
	   (2, 1, 2),
	   (4, 1, null),
	   (5, null, 34),
	   (6, null, 79);



Insert into spielkarte (sk_id, u_id, s_id, summe_oben, summe_unten)
Values (1, 12, 1,       112           , 260),
	   (4, 666, 1,       40            , 260),
	   (5, 77, 1,       102           , 250),
	   (3, 77, 1,       102           , 250),

	   (6, 12, 2,       222          ,  444),
	   (7, 666, 2,       112          ,  9400),

	   (8, 2, 4,        0            ,  000),
	   (9, 12, 4,       15           ,  400),

	   (10, 666, 5,      5112          , 5400),
	   (11, 12, 5,      112           , 200),

	   (12, 12, 6,      112        ,    456),
	   (13, 666, 6,      112        ,  700);