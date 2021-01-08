CREATE VIEW vInvoice AS
SELECT 
    inv.id,
    inv.inv_no,
    inv.inv_date,
    inv.purchase_order_id,
    inv.date_payment,
    inv.bank_id,
    inv.ref_no,
    inv.total_payment,
    (SELECT SUM( pod.quantity_request * pod.perunit_amount)
    	FROM purchase_order_dt pod WHERE pod.purchase_order_id = po.id and deleted_at is null) AS total_inv,
    inv.notes,
    inv.sc_statuspayment,
    (SELECT sc.standard_code_name FROM standard_codes sc WHERE id = inv.sc_statuspayment) AS statuspayment, 
    cs.customer_name,
    cs.customer_phone,
    cs.customer_address,
    inv.deleted_at,
    inv.created_at,
    inv.updated_at
FROM invoices inv 
INNER JOIN purchase_orders po ON inv.purchase_order_id = po.id
INNER JOIN customers cs ON cs.id = po.customer_id
LEFT JOIN bank b on b.id = inv.bank_id
WHERE inv.deleted_at IS NULL