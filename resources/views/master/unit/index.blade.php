@extends('layouts.default')

@section('main_content')
<div class="content">
   <div class="row">
      <div class="page-header">
         <div class="page-title">
            <h4>Unit List</h4>
            <h6>Manage your Units</h6>
         </div>
         <div class="page-btn">
            <a href="{{ route('master.unit.create') }}" class="btn btn-added"><i class="fas fa-plus-square"></i> &nbsp; Add Unit</a>
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
                        
                        <th>Unit Name</th>
                        <th>Action</th>
                     </tr>
                  </thead>
                  <tbody>
                     @foreach($results as $k => $v)
                     <tr>
                        <td>{{ $v->name }}</td>
                        <td>
                           <a class="me-3" href="{{ route('master.unit.edit', Crypt::encrypt($v->id)) }}">
                           <i class="fas fa-edit"></i>
                           </a>
                           <a class="me-3 confirm-text" onclick="return confirm('Are u sure ?')" href="{{ route('master.unit.remove', Crypt::encrypt($v->id)) }}">
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