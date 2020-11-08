CREATE TABLE `drink` (
  `type` VARCHAR(150) NOT NULL,
  `price` DECIMAL(3,2) NOT NULL,
  PRIMARY KEY (`type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

INSERT INTO `drink` (`type`, `price`) VALUES ('tea', 0.4);
INSERT INTO `drink` (`type`, `price`) VALUES ('coffee', 0.5);
INSERT INTO `drink` (`type`, `price`) VALUES ('chocolate', 0.6);