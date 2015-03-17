CREATE TABLE `tournaments` (
  `id` smallint(5) NOT NULL AUTO_INCREMENT,
  `tournament` text NOT NULL,
  `team` text CHARACTER SET cp1251 NOT NULL,
  `teamlink` text,
  `i` varchar(20) DEFAULT NULL,
  `v` varchar(20) DEFAULT NULL,
  `n` varchar(20) DEFAULT NULL,
  `p` varchar(20) DEFAULT NULL,
  `m` varchar(20) DEFAULT NULL,
  `o` int(5) DEFAULT '0',
  `prcnt` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='Турнирные таблицы' AUTO_INCREMENT=148 ;