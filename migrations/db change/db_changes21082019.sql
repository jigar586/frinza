ALTER TABLE `banner_mst` ADD `banner_type` ENUM('full','icon') NOT NULL DEFAULT 'full' AFTER `category_id`, ADD `child_id` INT NOT NULL DEFAULT '0' AFTER `banner_type`;

ALTER TABLE `banner_mst` ADD `banner_name` VARCHAR(255) NULL AFTER `child_id`;