CREATE VIEW vPurchaseRequestVendorDt AS
SELECT 
prvhd.purchase_request_no,
prvhd.sc_statuspo,
(SELECT sc.standard_code_name FROM standard_codes sc WHERE sc.id = prvhd.sc_statuspo) as statuspo,
p.product_name,
(SELECT sc.standard_code_name FROM standard_codes sc WHERE sc.id = podt.sc_colorid) as color,
prvdt.id,
prvdt.purchase_request_id,
prvdt.purchase_orderdt_id,
prvdt.request_quantity,
prvdt.receive_quantiy,
prvdt.perunit_amount,
prvdt.deleted_at,
prvdt.created_at,
prvdt.updated_at
FROM purchase_request_vendordt prvdt
INNER JOIN purchase_request_vendors prvhd ON prvhd.id = prvdt.purchase_request_id
INNER JOIN purchase_order_dt podt ON podt.id = prvdt.purchase_orderdt_id
INNER JOIN products p ON p.id = podt.product_id
WHERE prvdt.deleted_at IS NULL