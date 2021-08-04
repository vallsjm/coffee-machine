CREATE TABLE `domain_event` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `type` VARCHAR(250) NOT NULL,
  `eventBody` TEXT NOT NULL,
  `occurredOn` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `ix_occurredOn` (`occurredOn`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;