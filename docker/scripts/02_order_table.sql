CREATE TABLE `order` (
  `type` VARCHAR(150) NOT NULL,
  `price` DECIMAL(3,2) NOT NULL,
  `sugar` TINYINT(1) NOT NULL DEFAULT 0,
  `extrahot` TINYINT(1) NOT NULL DEFAULT 0,
  KEY `ix_type` (`type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;