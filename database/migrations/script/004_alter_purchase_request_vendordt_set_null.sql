ALTER TABLE `purchase_request_vendordt` CHANGE `purchase_request_id` `purchase_request_id` BIGINT(20) NULL DEFAULT NULL, CHANGE `product_id` `product_id` BIGINT(20) NULL DEFAULT NULL, CHANGE `sc_colorid` `sc_colorid` INT(11) NULL DEFAULT NULL, CHANGE `request_quantity` `request_quantity` INT(11) NULL DEFAULT NULL, CHANGE `receive_quantiy` `receive_quantiy` INT(11) NULL DEFAULT NULL, CHANGE `perunit_amount` `perunit_amount` INT(11) NULL DEFAULT NULL; 

ALTER TABLE `purchase_request_vendors` CHANGE `dp_amount` `dp_amount` INT(10) UNSIGNED NULL DEFAULT NULL, CHANGE `total_cost_amount` `total_cost_amount` INT(10) UNSIGNED NULL DEFAULT NULL, CHANGE `sc_statuspo` `sc_statuspo` INT(10) UNSIGNED NULL DEFAULT NULL; 