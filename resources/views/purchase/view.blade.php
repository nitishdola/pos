@extends('layouts.default')

@section('main_content')
<div class="content">
   <div class="row">
      <div class="page-header">
         <div class="page-title">
            <h4>Purchase Details</h4>
         </div>

         <div class="page-btn">
            <a href="{{ route('po.create') }}" class="btn btn-added"><i class="fas fa-plus-square"></i> &nbsp; Add New Purchase</a>
         </div>
      </div>
      <div class="card">
		   <div class="card-body">
            <div class="row">
               <div class="col-lg-12 col-sm-6 col-12">
                  <table class="table table-bordered">
                     <tr>
                        <th>Vendor</th>
                        <th>{{ $result->vendor->name }}</th>

                        <th>Purchase Date</th>
                        <th>{{ date('d-m-Y', strtotime($result->purchase_date)) }}</th>

                        <th>Invoice Number</th>
                        <th>{{ $result->invoice_number }}</th>

                        <th>Invoice Date</th>
                        <th>{{ date('d-m-Y', strtotime($result->invoice_date)) }}</th>

                     </tr>
                  </table>
                  <hr>
                  <table class="table table-bordered">
                     <thead>
                        <tr>
                           <th>Product</th>
                           <th>HSN</th>
                           <th>Qty</th>
                           <th>Expiry Date</th>
                           <th>Manufacturing Date</th>
                           <th>GST</th>
                           <th>Unit Cost</th>
                           <th>MRP</th>
                           <th>Total</th>
                        </tr>
                     </thead>
                     @php $totalcost = 0; @endphp
                     <tbody>
                     @foreach($result->purchase_items as $k => $v)
                        <tr>
                           <th>{{ $v->item->item_name }}</th>
                           <th>{{ $v->hsn_master->hsn_code }}</th>
                           <th>{{ $v->quantity }}</th>
                           <th>@if($v->expiry_date) {{ date('M-Y', strtotime($v->expiry_date)) }} @endif</th>
                           <th>@if($v->manufacturing_date) {{ date('M-Y', strtotime($v->manufacturing_date)) }} @endif</th>
                           <th>{{ $v->gst }}</th>
                           <th class="text-end">{{ $v->unit_cost }}</th>
                           <th class="text-end">{{ $v->mrp }}</th>
                           @php
                              $itemcost = 0;

                              $itemcost = $v->unit_cost + ($v->gst/$v->unit_cost)*100;
                              $itemcost = $itemcost*$v->quantity;

                              $totalcost += $itemcost;
                           @endphp
                           <th class="text-end">{{ $itemcost }}</th>
                        </tr>
                     @endforeach
                     </tbody>

                     <tfoot>
                        <th colspan="8"> Total </th>
                        <th class="text-end"> {{ $totalcost }}</th>
                     </tfoot>
                  </table>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
@stop