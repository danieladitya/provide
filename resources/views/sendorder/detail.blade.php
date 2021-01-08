<div class="row">
    <div class="col-sm-12">
        <table>
            <tr>
                <td>
                    <table class="table" style="width: 400px">
                        <tr>
                            <th>No Surat Jalan</th>
                            <td>:</td>
                            <td>{{ $dataHd->sj_no }}</td>
                        </tr>
                        <tr>
                            <th>Customer</th>
                            <td>:</td>
                            <td>{{ $dataHd->customer_name }}</td>
                        </tr>
                        
                    </table>
                </td>
                <td>
                    <table class="table" style="width: 400px">
                        
                        <tr>
                            <th>Tanggal</th>
                            <td>:</td>
                            <td>{{ $dataHd->created_at }}</td>
                        </tr>
                        <tr>
                            <th>Alamat</th>
                            <td>:</td>
                            <td>{{ $dataHd->customer_address }}</td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
        
    </div>
</div>
<div class="row">
    <div class="col-sm-12">
        <table class="table table-condensed" style="width: 80%">
            <thead>
                <th>Nama Produk</th>
                <th>Jumlah</th>
            </thead>
            <tbody>
                @foreach ($sendorderdt as $row )
                <tr>
                    <td>{{ $row->name_product }}</td>
                    <td>{{ $row->quantity_item }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
