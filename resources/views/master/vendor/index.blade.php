@extends('layouts.default')

@section('main_content')
<div class="content">
   <div class="row">
      <div class="page-header">
         <div class="page-title">
            <h4>Vendor List</h4>
            <h6>Manage your vendors</h6>
         </div>
         <div class="page-btn">
            <a href="{{ route('master.vendor.create') }}" class="btn btn-added"><i class="fas fa-plus-square"></i> &nbsp; Add Vendor</a>
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
                        <th>Address</th>
                        <th>Contact number</th>
                        <th>Email</th>
                        <th>Action</th>
                     </tr>
                  </thead>
                  <tbody>
                     @foreach($results as $k => $v)
                     <tr>
                        <td>{{ $v->name }}</td>
                        <td>{{ $v->address }}</td>
                        <td>{{ $v->contact_number }}</td>
                        <td>{{ $v->email }}</td>
                        <td>
                           <a class="me-3" href="{{ route('master.vendor.edit', Crypt::encrypt($v->id)) }}">
                           <i class="fas fa-edit"></i>
                           </a>
                           <a class="me-3 confirm-text" onclick="return confirm('Are u sure ?')" href="{{ route('master.vendor.remove', Crypt::encrypt($v->id)) }}">
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