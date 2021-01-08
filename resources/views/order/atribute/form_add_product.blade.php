 
 <tr>
                            <td>
                                <div class="form-group">
                                    <select class="form-control" name="product_id[]">
                                        @foreach ($products as $item )
                                            <option value="{{ $item->id }}">{{ $item->product_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </td>
                             <td>
                                <div class="form-group">
                                <select class="form-control"  name="product_colorid[]">
                                    @foreach ($colors as $item )
                                        <option value="{{ $item->id }}">{{ $item->standard_code_name }}</option>
                                    @endforeach
                                </select>
                                </div>
                            </td>
                            <td>
                                <div class="form-group">
                                <input type="text" class="form-control"  name="product_quantityid[]" />
                                </div>
                            </td>
                             <td>
                                <div class="form-group">
                                <input type="text" class="form-control"  name="product_pricesid[]" />
                                </div>
                            </td>
                        </tr>