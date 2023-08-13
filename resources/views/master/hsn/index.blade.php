@extends('layouts.default')

@section('main_content')
<div class="content">
   <div class="row">
      <div class="page-header">
         <div class="page-title">
            <h4>HSN Code List</h4>
            <h6>Manage your Brand</h6>
         </div>
         <div class="page-btn">
            <a href="{{ route('master.hsn.create') }}" class="btn btn-added"><i class="fas fa-plus-square"></i> &nbsp; Add HSN Code</a>
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
               <!-- <div class="wordset">
                  <ul>
                     <li>
                        <a data-bs-toggle="tooltip" data-bs-placement="top" title="pdf"><img src="assets/img/icons/pdf.svg" alt="img"></a>
                     </li>
                     <li>
                        <a data-bs-toggle="tooltip" data-bs-placement="top" title="excel"><img src="assets/img/icons/excel.svg" alt="img"></a>
                     </li>
                     <li>
                        <a data-bs-toggle="tooltip" data-bs-placement="top" title="print"><img src="assets/img/icons/printer.svg" alt="img"></a>
                     </li>
                  </ul>
               </div> -->
            </div>
            
            <div class="table-responsive">
               <table class="table datanew">
                  <thead>
                     <tr>
                        
                        <th>HSN Code</th>
                        <th>GST</th>
                        <th>CGST</th>
                        <th>SGCT</th>
                        <th>Description</th>
                        <th>Action</th>
                     </tr>
                  </thead>
                  <tbody>
                     @foreach($results as $k => $v)
                     <tr>
                        <td>{{ $v->hsn_code }}</td>
                        <td>{{ $v->gst }}</td>
                        <td>{{ $v->cgst }}</td>
                        <td>{{ $v->sgst }}</td>
                        <td>{{ $v->description }}</td>
                        <td>
                           <a class="me-3" href="{{ route('master.hsn.edit', Crypt::encrypt($v->id)) }}">
                           <i class="fas fa-edit"></i>
                           </a>
                           <a class="me-3 confirm-text" onclick="return confirm('Are u sure ?')" href="{{ route('master.hsn.remove', Crypt::encrypt($v->id)) }}">
                              <i class="fas fa-trash-alt"></i>
                           </a>
                        </td>
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