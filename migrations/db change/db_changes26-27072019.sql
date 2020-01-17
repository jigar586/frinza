ALTER TABLE `product_mst` ADD `search_terms` TEXT NULL DEFAULT NULL AFTER `meta_keyword`;

ALTER TABLE `banner_mst` ADD `url` VARCHAR(512) NULL DEFAULT NULL AFTER `category_id`;