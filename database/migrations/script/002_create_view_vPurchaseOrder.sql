CREATE VIEW vPurchaseOrder AS
SELECT 
	po.*, c.customer_name, c.customer_address,
	(SELECT sc.standard_code_name FROM standard_codes sc WHERE sc.id = po.sc_status_orderid) as status_order 
FROM `purchase_orders` po
INNER JOIN customers c ON c.id = po.customer_id
WHERE po.deleted_at IS NULL