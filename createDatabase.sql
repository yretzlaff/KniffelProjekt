CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
);

CREATE TABLE IF NOT EXISTS `spiele` (
  `s_id` int(11) NOT NULL AUTO_INCREMENT,
  `u_id` int(11) NOT NULL,
  `Einer` int(3),
  `Zweier` int(3),
  `Dreier` int(3),
  `Vierer` int(3),
  `Fuenfer` int(3),
  `Sechser` int(3),
  `Dreierpasch` int(5),
  `Viererpasch` int(5),
  `Full_House` int(5),
  `kleine_Straße` int(5),
  `große_Straße` int(5),
  `Kniffel` int(5),
  `Chance` int(5),
  PRIMARY KEY (`id`),
  FOREIGN KEY (u_Id) REFERENCES user(id)
);