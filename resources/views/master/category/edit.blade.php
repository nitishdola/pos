@extends('layouts.default')

@section('main_content')
<div class="content">
   <div class="row">
      <div class="page-header">
         <div class="page-title">
            <h4>Category Edit</h4>
         </div>
         <div class="page-btn">
            <a href="{{ route('master.category.index') }}" class="btn btn-added"><i class="fas fa-th-list"></i> &nbsp; View categories</a>
         </div>
      </div>
      
      <div class="card">
         <div class="card-body">

             {!! Form::model($category,array('route' => ['master.category.update',Crypt::encrypt($category->id)], 'id' => 'category.save')) !!}

            <div class="row">
               <div class="col-lg-3 col-sm-6 col-12">
                  <div class="form-group">
                     <label>Brand Name</label>
                     {!! Form::text('name', $category->name, ['class' => 'form-control', 'id' => 'name', 'required' => true, 'autocomplete' => 'off']) !!}
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