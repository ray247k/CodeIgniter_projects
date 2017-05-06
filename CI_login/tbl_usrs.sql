/*
DB Name: Employee
Table Name: tbl_usrs
*/

CREATE TABLE IF NOT EXISTS `tbl_usrs` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `username` varchar(30) NOT NULL,
  `password` varchar(40) NOT NULL,
  `email` varchar(60) NOT NULL,
  `status` varchar(8) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

INSERT INTO `tbl_usrs` (`username`, `password`, `email`, `status`) VALUES
('admin', '21232f297a57a5a743894a0e4a801fc3', 'admin@mydomain.com', 'active');