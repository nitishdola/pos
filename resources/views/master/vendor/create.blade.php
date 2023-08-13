@extends('layouts.default')

@section('main_content')
<div class="content">
   <div class="row">
      <div class="page-header">
         <div class="page-title">
            <h4>Vendor Add</h4>
         </div>
         <div class="page-btn">
            <a href="{{ route('master.vendor.index') }}" class="btn btn-added"><i class="fas fa-th-list"></i> &nbsp; View Vendors</a>
         </div>
      </div>
      
      <div class="card">
         <div class="card-body">

            @if($errors->any())
                {!! implode('', $errors->all('<div class="alert alert-danger">:message</div>')) !!}
            @endif

            {!! Form::open(['route' => ['master.vendor.save']]) !!}

            <div class="row">
               <div class="col-lg-3 col-sm-6 col-12">
                  <div class="form-group">
                     <label>Vendor Name</label>
                     {!! Form::text('name', null, ['class' => 'form-control', 'id' => 'name', 'required' => true, 'autocomplete' => 'off']) !!}
                  </div>
               </div>

               <div class="col-lg-3 col-sm-6 col-12">
                  <div class="form-group">
                     <label>Address</label>
                     {!! Form::text('address', null, ['class' => 'form-control', 'id' => 'address', 'required' => true, 'autocomplete' => 'off']) !!}
                  </div>
               </div>

               <div class="col-lg-3 col-sm-6 col-12">
                  <div class="form-group">
                     <label>Contact Number</label>
                     {!! Form::text('contact_number', null, ['class' => 'form-control', 'id' => 'contact_number', 'autocomplete' => 'off']) !!}
                  </div>
               </div>

               <div class="col-lg-3 col-sm-6 col-12">
                  <div class="form-group">
                     <label>Email</label>
                     {!! Form::text('email', null, ['class' => 'form-control', 'id' => 'email', 'autocomplete' => 'off']) !!}
                  </div>
               </div>
               <div class="col-lg-12">
                  <button class="btn btn-submit me-2" type="submit">Submit</button>
               </div>
            </div>

            {!! Form::close() !!}

         </div>
      </div>
   </div>
</div>
@stop