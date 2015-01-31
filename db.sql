CREATE TABLE IF NOT EXISTS `cal` (
  `id` int(9) NOT NULL AUTO_INCREMENT,
  `eventdate` date NOT NULL DEFAULT '0000-00-00',
  `title` varchar(255) NOT NULL DEFAULT '',
  `event` text NOT NULL,
  `fixed` tinyint(1) NOT NULL DEFAULT '0',
  UNIQUE KEY `date` (`eventdate`),
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=778 DEFAULT CHARSET=utf8;

INSERT INTO `cal` (`title`,`event`,`eventdate`, `fixed`) VALUES
  ('New year!', 'Happy new year, folks!', '2015-01-01', 1),
  ('Old new year! Russian unique holiday.', 'One more happy new year, folks!', '2015-01-13', 1),
  ('Winter is coming. Nothing to say.', '', '2015-01-20', 0);