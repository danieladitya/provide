ALTER VIEW vPurchaseOrderDt AS
SELECT 
	podt.id,
    podt.purchase_order_id,
    podt.sc_colorid,
    podt.quantity_request,
    podt.perunit_amount,
	po.purchase_order_no, 
    p.product_name, 
    (SELECT  sc.standard_code_name FROM standard_codes sc where sc.id = podt.sc_colorid) as color,
    IFNULL( (SELECT 
        SUM(prvdt.receive_quantiy) as total_receive_quantiy
        FROM purchase_request_vendordt prvdt
        INNER JOIN purchase_request_vendors prv ON prv.id = prvdt.purchase_request_id
        WHERE prvdt.purchase_orderdt_id=podt.id AND prv.sc_statuspo = 9 /*close*/
    ), 0) as  total_receive_quantity,
    IFNULL( (SELECT 
        SUM(prvdt.request_quantity) as total_quantity_inprogress
        FROM purchase_request_vendordt prvdt
        INNER JOIN purchase_request_vendors prv ON prv.id = prvdt.purchase_request_id
        WHERE prvdt.purchase_orderdt_id=podt.id AND prv.sc_statuspo = 7 /*inporgress*/
    ), 0) as  total_quantity_inprogress,
    IFNULL( (SELECT 
        SUM(sodt.quantity_item) as total_receive_quantiy
        FROM send_order_po_dt sodt
        INNER JOIN send_order_po so ON so.id = sodt.send_order_po_id
        WHERE sodt.purchase_order_dt_id=podt.id  
    ), 0) as  total_send_quantity,
    
    podt.deleted_at,
    podt.created_at,
    podt.updated_at
FROM purchase_order_dt podt
INNER JOIN purchase_orders po ON po.id = podt.purchase_order_id
INNER JOIN products p ON p.id = podt.product_id
WHERE podt.deleted_at IS NULL