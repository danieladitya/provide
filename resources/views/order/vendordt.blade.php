<div class="row">
    <div class="col-sm-12">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th><div class="float-right">Qty dipesan</div></th>
                    <th><div class="float-right">Qty diterima</div></th>
                    <th><div class="float-right">Biaya /QTY</div></th>
                    <th><div class="float-right">Total</div></th>
                </tr>
            <tbody>
                <?php $total = 0;?>
                @foreach ($vendordt as $row )
                <?php $total += $row->receive_quantiy * $row->perunit_amount  ?>
                <tr>
                    <td><div class="float-right">{{ $row->request_quantity }}</div></td>
                    <td><div class="float-right">{{ $row->receive_quantiy }}</div></td>
                    <td><div class="float-right">@currency($row->perunit_amount)</div></td>
                    <td><div class="float-right">@currency($row->perunit_amount *  $row->receive_quantiy)</div></td>
                </tr>    
                @endforeach
                <tr>
                    <td colspan="3"><div class="float-right">Total Biaya</div></td>
                    <td colspan="3"><div class="float-right">@currency($total) </div></td>
                </tr>
            </tbody>
            </thead>
            </table>
    </div>
</div>
