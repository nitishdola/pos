@extends('layouts.default')

@section('main_content')
<div class="content">
   <div class="row">
      <div class="page-header">
         <div class="page-title">
            <h4>Product List</h4>
            <h6>Manage your Products</h6>
         </div>
         <div class="page-btn">
            <a href="{{ route('master.item.create') }}" class="btn btn-added"><i class="fas fa-plus-square"></i> &nbsp; Add Product</a>
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
                        
                        <th>Item Name</th>
                        <th>Volume</th>
                        <th>Unit</th>
                        <th>Brand</th>
                        <th>Category</th>
                        <th>Action</th>
                     </tr>
                  </thead>
                  <tbody>
                     @foreach($results as $k => $v)
                     <tr>
                        <td>{{ $v->item_name }}</td>
                        <td>{{ $v->volume }}</td>
                        <td>{{ $v->unit->name }}</td>
                        <td>{{ $v->brand->name }}</td>
                        <td>{{ $v->category->name }}</td>
                        <td>
                           <a class="me-3" href="{{ route('master.item.edit', Crypt::encrypt($v->id)) }}">
                           <i class="fas fa-edit"></i>
                           </a>
                           <a class="me-3 confirm-text" onclick="return confirm('Are u sure ?')" href="{{ route('master.item.remove', Crypt::encrypt($v->id)) }}">
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