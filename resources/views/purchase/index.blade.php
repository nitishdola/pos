@extends('layouts.default')

@section('main_content')
<div class="content">
   <div class="row">
      <div class="page-header">
         <div class="page-title">
            <h4>PURCHASE LIST</h4>
            <h6>Manage your purchases</h6>
         </div>
         <div class="page-btn">
            <a href="{{ route('po.create') }}" class="btn btn-added"><i class="fas fa-plus-square"></i> &nbsp; Add New Purchase</a>
         </div>
      </div>
      <div class="card">
         <div class="card-body">
            <div class="table-top">
               <div class="search-set">

                  <div class="search-input">
                     <a class="btn btn-searchset"><i class="fas fa-search"></i></a>
                  </div>
               </div>
            </div>
            
            <div class="table-responsive">
               <table class="table datanew">
                  <thead>
                     <tr>
                        <th>Vendor Name</th>
                        <th>Purchase Date</th>
                        <th>Invoice Number</th>
                        <th>Discount</th>
                        <th>Details</th>
                     </tr>
                  </thead>
                  <tbody>
                     @foreach($results as $k => $v)
                     <tr>
                        <td>{{ $v->vendor->name }}</td>
                        <td>{{ date('d-m-Y', strtotime($v->purchase_date)) }}</td>
                        <td>{{ $v->invoice_number }} , {{ date('d-m-Y', strtotime($v->invoice_date)) }}</td>
                        <td>{{ $v->discount }}</td>
                        <td><a href="{{ route('po.details', Crypt::encrypt($v->id)) }}"> View <i class="fas fa-chevron-right"></i> </a></td>
                        
                     </tr>
                     @endforeach
                  </tbody>
               </table>
            </div>
         </div>
      </div>
   </div>
</div>
@stop