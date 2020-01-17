CREATE TABLE `db_frinza`.`home_sort_dtl` ( `product_id` INT NOT NULL , `priority` TINYINT NOT NULL , `rel_id` INT NOT NULL , `order_no` INT NOT NULL ) ENGINE = InnoDB;

ALTER TABLE `home_sort_dtl` ADD UNIQUE( `product_id`, `priority`, `rel_id`);