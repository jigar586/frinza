ALTER TABLE `category_mst` ADD `category_heading` VARCHAR(255) NULL DEFAULT NULL AFTER `category_name`;
ALTER TABLE `category_mst` ADD `category_heading_desc` TINYTEXT NULL DEFAULT NULL AFTER `category_desc`;

ALTER TABLE `subcategory_mst` CHANGE `subcategory_title` `subcategory_heading` VARCHAR(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL;
ALTER TABLE `subcategory_mst` ADD `meta_title` VARCHAR(255) NULL DEFAULT NULL AFTER `subcategory_heading`;

ALTER TABLE `childcategory_mst` ADD `child_heading` VARCHAR(255) NULL DEFAULT NULL AFTER `child_title`, ADD `heading_description` TEXT NULL DEFAULT NULL AFTER `child_heading`;

ALTER TABLE `product_mst` ADD `meta_title` VARCHAR(255) NULL DEFAULT NULL AFTER `product_desc`, ADD `meta_description` TEXT NULL DEFAULT NULL AFTER `meta_title`;