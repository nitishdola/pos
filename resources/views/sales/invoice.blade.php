@extends('layouts.default')
@section('main_content')
<div class="content">
    <div class="row">
        <div class="page-header">
            <div class="page-title">
                <h4>Invoice {{ $sale->invoice_number}}</h4>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="row" id="printableArea">
                    <div class="col-md-12">
                    <table class="table table-bordered border-primary">
                        
                        <tr>
                            <td>Invoice Number</td>
                            <td>{{ $sale->invoice_number}}</td>

                            <td>Date</td>
                            <td>{{ $sale->invoice_date}}</td>
                        </tr>

                        <tr>
                            <td>Consignee Name</td>
                            <td>{{ $sale->consignee_name}}</td>

                            <td>Consignee Address</td>
                            <td>{{ $sale->consignee_address}}, <br>Dist. {{ $sale->district->name }}</td>
                        </tr>
                    </table>

                    <table class="table table-bordered border-primary mt-4">
                        <tr>
                            <th>Sl</th>
                            <th>Description of Goods</th>
                            <th>HSN</th>
                            <th>Quantity</th>
                            <th>Rate <br> (Inc. of Tax)</th>
                            <th>Rate</th>
                            <th>GST</th>
                            <th>Total Amount</th>
                        </tr>

                        @php 

                            $total_qty = 0;
                            $total_rate_inc_tax = 0;
                            $total_rate = 0;
                            $total_invoice_amount = 0;
                        @endphp

                        @foreach($sale->sale_items as $k => $v)
                        <tr>
                            <td>{{ $k+1 }}</td>
                            <td>{{ $v->item->item_name }}</td>
                            <td>{{ $v->purchase_item->hsn_master->hsn_code }}</td>
                            <td>{{ $v->quantity }}</td>
                            <td>{{ $v->sell_price }}</td>
                            @php
                                $price_inc_gst = $v->sell_price;
                                $gst = $v->gst;
                                $org = ($price_inc_gst*100)/(100+$gst);
                            @endphp
                            <td>{{ $org }}</td>
                            <td>{{ $v->gst }} %</td>
                            <td>{{ $v->sell_price * $v->quantity }}</td>

                            @php 
                                $total_qty += $v->quantity;
                                $total_rate_inc_tax += $v->sell_price;
                                $total_rate += $org;
                                $total_invoice_amount += $v->sell_price * $v->quantity;
                            @endphp
                        </tr>

                        @endforeach

                        <tr>
                            <th colspan="3">Total</th>
                            <th> {{ $total_qty }}</th>
                            <th> {{ $total_rate_inc_tax }}</th>
                            <th> {{ $total_rate }}</th>
                            <th> </th>
                            <th> {{ $total_invoice_amount }}</th>
                        </tr>
                    </table>
                    </div>

                    <div class="row mt-5">
                <span class="text-center">This is a computer generated invoice</span>
                </div>
                    
                </div>

                
            </div>

            <input type="button" onclick="printDiv('printableArea')" value="PRINT" />
        </div>
    </div>
</div>
@stop

@section('pageJs')
<script>
function printDiv(divName) {
     var printContents = document.getElementById(divName).innerHTML;
     var originalContents = document.body.innerHTML;

     document.body.innerHTML = printContents;

     window.print();

     document.body.innerHTML = originalContents;
}
</script>
@stop

@section('pageCss')
<style>
@page { size: auto;  margin: 0mm; }
</style>
@stop
