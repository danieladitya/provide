@extends('layout.print')
@section('content')
 
<body class="letter" onload="window.print()">

    <!-- Each sheet element should have the class "sheet" -->
    <!-- "padding-**mm" is optional: you can set 10, 15, 20 or 25 -->
    <section class="sheet padding-10mm">
  
      <!-- Write HTML just like a web page -->
      <article>
          <div class="row">
          <div class="col-sm-12">
          <table class="table table-borderless" style="widht:100%">
              <tr>
                  <td>
                      <table>
                        <tr>
                            <td>Sold to</td>
                            <td>:</td>
                            <td>{{ $po->customer_name }}</td>
                        </tr>
                        <tr>
                            <td>Address</td>
                            <td>:</td>
                            <td>{{ $po->customer_address }}</td>
                        </tr>
                      </table>
                  </td>
                  <td>
                    <table>
                        <tr>
                            <td>Invoice No</td>
                            <td>:</td>
                            <td>{{ $invoice->inv_no }}</td>
                        </tr>
                        <tr>
                            <td>Date</td>
                            <td>:</td>
                            <td>{{date("Y-m-d")}}</td>
                        </tr>
                        <tr>
                            <td>Currency</td>
                            <td>:</td>
                            <td>Rupiah</td>
                        </tr>
                    </table>
                  </td>
              </tr>
          </table>

          <table class="table table-bordered">
           
            <tr>
                  <th>No</th>
                  <th>Item Description</th>
                  <th><div class="text-right">Quantity</div></th>
                  <th><div class="text-right">Unit Price</div></th>
                  <th><div class="text-right">Total Amount (Rupiah)</div></th>
            </tr>
            <?php 
                $no =0; 
                $total = 0;
                $qty_total=0;
            ?>
            @foreach ( $podt as $row)
            <?php   
                $total += $row->perunit_amount * $row->quantity_request; 
                $qty_total +=$row->quantity_request ;
            ?>
            <tr>
                <td><?php  echo $no +=1;  ?></td>
                <td>{{ $row->product_name }}</td>
                <td><div class="text-right">{{ $row->quantity_request }}</div></td>
                <td><div class="text-right"> @currency($row->perunit_amount)</div> </td>
                <td><div class="text-right"> @currency( $row->perunit_amount * $row->quantity_request ) </div></td>
            </tr>
            @endforeach
            <tr>
                <td colspan="2"><small>PO : {{  $po->purchase_order_no  }} </small></td>
                <td> <div class="text-right">{{  $qty_total  }} </div> </td>
                <td colspan="1"><div class="text-right"><b>GRAND TOTAL</b></div></td>
                <td class="text-right"> @currency( $total)  </td>
            </tr>
          </table>
          </div>
          </div>
      </article>
  
    </section>
  
  </body>
@endsection