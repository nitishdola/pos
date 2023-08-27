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
         <div class="card-body invoice">
            <div id="printableArea">
               <div class="row">
                  <div class="col-md-12">
                     <table class="table table-bordered">
                        <tr class="center-text">
                           <td colspan="5"><ul>TAX INVOICE</ul></td>
                        </tr>
                        <tr class="center-text">
                           <td colspan="5" class="title">
                              <span class="logo">
                                 <img src="{{ asset('logo.png') }}" width="60" height="60" />
</span> <br>
                              <strong>Ayush Interior and Electrical</strong>,
                              <br/>35, Sepon Road, Nazira, Sivasagar - 785685, 
                              <br> <i class="fas fa-phone-alt"></i> 9395496772/8638032287
                              <br> <i class="fas fa-envelope"></i> aayushinterior.electrical2020@gmail.com
                              <br/>GST - 18CFLPP4166E1Z5
                           </td>
                        </tr>

                        <tr>
                           <td colspan="3">
                              <i>Consignee Details</i> <br>
                              <strong>{{ $sale->consignee_name}}</strong>
                              <br>
                              {{ $sale->consignee_address}}, <br>Dist. {{ $sale->district->name }}
                           </td>

                           <td colspan="2">
                              Invoice Number :  {{ $sale->invoice_number}}
                              <br>
                              Date : {{ date('d-m-Y', strtotime($sale->invoice_date)) }}
                           </td>
                        </tr>
                     </table>
                     <table class="table mt-4">
                        <tr>
                           <th class="title">Sl</th>
                           <th class="title">Description of Goods</th>
                           <th class="title">HSN</th>
                           <th class="title">Quantity</th>
                           <th class="title">Rate <br> (Inc. of Tax)</th>
                           <th class="title">Rate</th>
                           <th class="title">GST</th>
                           <th class="title text-end">Total Amount</th>
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
                           <td class="text-end">{{ $v->sell_price * $v->quantity }}</td>
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
                           <th> {{ number_format((float)$total_rate_inc_tax, 2, '.', '') }}</th>
                           <th> {{ number_format((float)$total_rate, 2, '.', '') }}</th>
                           <th> {{ number_format((float)($total_rate_inc_tax - $total_rate), 2, '.', '') }}</th>
                           <th class="text-end"> {{ number_format((float)$total_invoice_amount, 2, '.', '') }}</th>
                        </tr>
                        <tr>
                           <td colspan="8">
                              <strong>Amount in words : INR {{ getIndianCurrency($total_invoice_amount) }}</strong>
                           </td>
                        </tr>

                        <tr>
                           <td colspan="4">
                              <strong>Company's Bank Details</strong>
                              <br>
                              <p>A/c Holder's Name : Aayush Interior & Electrical<br>
                              Bank Name : HDFC Bank-2880 <br>
                              A/c No. : 50200074112880<br>
                              Branch & IFS Code : Nazira & HDFC0009230<br></p>
                           </td>

                           <td colspan="4">
                              for Aayush Interior & Electrical<br>
                              <br>
                              <br>
                              <br>
                              <br>
                              <span class="text-end">Authorised Signatory</span>
</td>

                           
                        </tr>

                        
                     </table>
                  </div>
                  <div class="row mt-5">
                     <p>
                           We declare that this invoice shows the actual price of the goods 
                           described and that all particulars are true and correct. 
</p>
                     <span class="text-center">This is a computer generated invoice </span>
                  </div>
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
   .center-text { text-align : center; }
   .title { font-weight : bold; }
   table, th, tr, td {
   border: 1px solid black;
   border-collapse: collapse;
   }
   .table-bordered {
   th,
   td {
   border: 1px solid $gray-300 !important;
   }
   }
   @media print {
      .invoice {
         margin-top : 90px !important;
         border : 1px solid #000000;
      }
      #printableArea {
         margin-top:100px;
         margin:40px;
      }

      @page { margin: 0; }   body { margin: 1.6cm; }
   }
   @print {
    @page :footer {
        display: none
    }
  
    @page :header {
        display: none
    }
}
</style>
@stop