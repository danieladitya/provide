
 @foreach ($purchaseorderdt as $row )

 <tr>
    <td><input type="checkbox" name="chkOk[]" onclick="change({{ $row->id }})" id="chk{{ $row->id }}" value="1" />
    </td>
    <td>
        {{ $row->product_name }} - {{ $row->color }}
        <input type="hidden" name="purchase_orderdt_id[]" value="{{ $row->id }}" />
       {{-- <select class="form-control select" name="purchase_orderdt_id[]">
           <option value="{{ $row->id }}">    {{ $row->product_name }} - {{ $row->color }}</option>
        </select>  --}}
    </td>
    <td>
        {{ $row->quantity_request }}
    </td>
    <td>
        {{ $row->total_quantity_inprogress }}
    </td>
    <td>
        {{ $row->total_receive_quantity }}
    </td>
    <td><input type="text" class="form-control" name="request_quantity[]" readonly="true"   placeholder="Qty" value="{{ $row->quantity_request }}" id="qty{{ $row->id }}"/></td>
    <td><input type="text" class="form-control" name="perunit_amount[]"   readonly="true" placeholder="Harga Perproduk"  id="price{{ $row->id }}"/></td>
</tr>
 @endforeach
