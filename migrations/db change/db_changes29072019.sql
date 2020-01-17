CREATE TABLE `addoncategory_mst` ( `addoncategory_id` INT NOT NULL AUTO_INCREMENT , `addoncategory_name` VARCHAR(255) NULL , PRIMARY KEY (`addoncategory_id`)) ENGINE = InnoDB;
ALTER TABLE `addoncategory_mst` ADD `is_active` TINYINT NOT NULL DEFAULT '1' AFTER `addoncategory_name`;
ALTER TABLE `product_mst` ADD `addoncategory_id` INT NOT NULL DEFAULT '0' AFTER `status`;