ALTER TABLE `purchase_orders` CHANGE `total_amount` `total_amount` INT(10) UNSIGNED NULL DEFAULT NULL, CHANGE `total_cost_amount` `total_cost_amount` INT(10) UNSIGNED NULL DEFAULT NULL;
ALTER TABLE `standard_codes` CHANGE `parent_id` `parent_id` BIGINT(20) NULL DEFAULT NULL;
