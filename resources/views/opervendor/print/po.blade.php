@extends('layout.print')
@section('content')
 
<body class="A4" onload="window.print()">

    <!-- Each sheet element should have the class "sheet" -->
    <!-- "padding-**mm" is optional: you can set 10, 15, 20 or 25 -->
    <section class="sheet padding-10mm">
  
      <!-- Write HTML just like a web page -->
      <article>
          <table class="table table-borderless">
              <tr>
                  <td>
                      <table>
                        <tr>
                            <td>No. PO Vendor</td>
                            <td>:</td>
                            <td>{{ $podata->purchase_request_no }}</td>
                        </tr>
                        <tr>
                            <td>Vendor</td>
                            <td>:</td>
                            <td>{{ $podata->customer_name }}</td>
                        </tr>
                      </table>
                  </td>
                  <td>
                    <table>
                        <tr>
                            <td>Tanggal</td>
                            <td>:</td>
                            <td>{{ $podata->date_send }}</td>
                        </tr>
                    </table>
                  </td>
              </tr>
          </table>

          <table class="table tab-border">
            <tr>
                  <td colspan="5"><b>Detail Order</b></td>
            </tr>
            <tr>
                  <th>No</th>
                  <th>Nama Produk</th>
                  <th><div class="text-right">Jumlah</div></th>
                  <th><div class="text-right">Harga</div></th>
                  <th><div class="text-right">Total</div></th>
            </tr>
            <?php 
                $no =0; 
                $total = 0;
                
            ?>
            @foreach ( $podt as $row)
            <?php   $total += $row->perunit_amount * $row->request_quantity; ?>
            <tr>
                <td><?php  echo $no +=1;  ?></td>
                <td>{{ $row->product_name }}</td>
                <td><div class="text-right">{{ $row->request_quantity }}</div></td>
                <td><div class="text-right">@currency($row->perunit_amount)</div> </td>
               
                <td><div class="text-right">@currency( $row->perunit_amount * $row->request_quantity ) </div></td>
            </tr>
            @endforeach
          

            <tr>
                <td colspan="4"><div class="text-right"><b>TOTAL</b></div></td>
                <td><div class="text-right">  @currency( $total)  </div></td>
            </tr>
          </table>
      </article>
  
    </section>
  
  </body>
@endsection