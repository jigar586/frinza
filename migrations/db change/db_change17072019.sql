CREATE TABLE `product_sort_dtl` (
  `product_id` int(11) NOT NULL,
  `priority` tinyint(4) NOT NULL,
  `rel_id` int(11) NOT NULL,
  `order_no` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

ALTER TABLE `product_sort_dtl`
  ADD UNIQUE KEY `product_id` (`product_id`,`priority`,`rel_id`);