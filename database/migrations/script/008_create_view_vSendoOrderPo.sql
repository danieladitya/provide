CREATE VIEW vsendorderpo AS
SELECT 
	sop.id,
    sop.sj_no,
    sop.purchase_order_id,
    po.purchase_order_no,
    po.customer_id,
    po.order_date,
    cs.customer_name,
    cs.customer_address,
    cs.customer_phone,
    sop.deleted_at,
    sop.created_at,
    sop.updated_at
FROM send_order_po sop
INNER JOIN purchase_orders po ON po.id = sop.purchase_order_id
INNER JOIN customers cs ON cs.id = po.customer_id
WHERE sop.deleted_at IS NULL