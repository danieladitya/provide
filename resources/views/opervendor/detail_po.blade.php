<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">PO Customer Detail</div>
            <div class="card-body">
                <table class="table table-striped" id="tableProduct">
                    <thead>
                        <tr>
                            <td>Produk</td>
                            <td>Warna</td>
                            <td>Qty</td>
                            <td>Harga Perproduk</td>
                            <td>Total</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $total = 0;?>
                        @foreach ($orders as $order)
                        <?php $total += $order->quantity_request * $order->perunit_amount  ?>
                            <tr>
                                <td>{{ $order->product_name }}</td>
                                <td>{{ $order->color }}</td>
                                <td><div class="float-right">{{ $order->quantity_request }}</div></td>
                                <td><div class="float-right">{{ $order->perunit_amount }}</div></td>
                                <td><div class="float-right">@currency($order->perunit_amount * $order->quantity_request) </div></td>
                            </tr>
                        @endforeach
                        <tr>
                            <td colspan="3">Total</td>
                            <td colspan="3"><div class="float-right">@currency($total) </div></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>