@extends('layouts.default')

@section('main_content')
<div class="content">
   <div class="row">
      <div class="page-header">
         <div class="page-title">
            <h4>Item Add</h4>
         </div>
         <div class="page-btn">
            <a href="{{ route('master.item.index') }}" class="btn btn-added"><i class="fas fa-th-list"></i> &nbsp; View Items</a>
         </div>
      </div>
      
      <div class="card">
         <div class="card-body">

            {!! Form::open(['route' => ['master.item.save']]) !!}

            <div class="row">
               <div class="col-lg-3 col-sm-6 col-12">
                  <div class="form-group">
                     <label>Item Name</label>
                     {!! Form::text('item_name', null, ['class' => 'form-control', 'id' => 'name', 'required' => true, 'autocomplete' => 'off']) !!}
                  </div>
               </div>

               <div class="col-lg-3 col-sm-6 col-12">
                  <div class="form-group">
                     <label>Volume/Size</label>
                     {!! Form::number('volume', null, ['class' => 'form-control', 'id' => 'volume', 'required' => true, 'autocomplete' => 'off']) !!}
                  </div>
               </div>

               <div class="col-lg-3 col-sm-6 col-12">
                  <div class="form-group">
                     <label>Brand</label>
                     {!! Form::select('brand_id', $brands, null, ['class' => 'form-control', 'id' => 'brand_id', 'required' => true, 'placeholder' => 'Select Brand', 'autocomplete' => 'off']) !!}
                  </div>
               </div>

               <div class="col-lg-3 col-sm-6 col-12">
                  <div class="form-group">
                     <label>Unit</label>
                     {!! Form::select('unit_id', $units, null, ['class' => 'form-control', 'id' => 'unit_id', 'required' => true, 'placeholder' => 'Select Unit', 'autocomplete' => 'off']) !!}
                  </div>
               </div>

               <div class="col-lg-3 col-sm-6 col-12">
                  <div class="form-group">
                     <label>Category</label>
                     {!! Form::select('category_id', $categories, null, ['class' => 'form-control', 'id' => 'category_id', 'placeholder' => 'Select Category', 'required' => true, 'autocomplete' => 'off']) !!}
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