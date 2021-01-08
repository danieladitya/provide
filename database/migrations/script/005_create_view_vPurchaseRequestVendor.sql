ALTER VIEW vPurchaseRequestVendor AS 
SELECT 
	pr.*, 
    po.purchase_order_no, 
    po.customer_id, 
    po.order_date ,
	c.customer_name, 
    (SELECT a.standard_code_name FROM standard_codes a where a.id = pr.sc_statuspo) AS statuspo,
   	v.vendor_name
FROM purchase_request_vendors pr 
INNER JOIN purchase_orders po ON po.id = pr.purchase_order_id 
INNER JOIN customers c ON c.id = po.customer_id
INNER JOIN vendors v ON v.id = pr.vendor_id
WHERE pr.deleted_at IS NULL