CREATE TABLE IF NOT EXISTS `usuario` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) NOT NULL,
  `login` varchar(20) NOT NULL,
  `senha` varchar(30) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `login` (`login`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
 
