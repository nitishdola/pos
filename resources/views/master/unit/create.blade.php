@extends('layouts.default')

@section('main_content')
<div class="content">
   <div class="row">
      <div class="page-header">
         <div class="page-title">
            <h4>Unit Add</h4>
         </div>
         <div class="page-btn">
            <a href="{{ route('master.unit.index') }}" class="btn btn-added"><i class="fas fa-th-list"></i> &nbsp; View Units</a>
         </div>
      </div>
      
      <div class="card">
         <div class="card-body">

            {!! Form::open(['route' => ['master.unit.save']]) !!}

            <div class="row">
               <div class="col-lg-3 col-sm-6 col-12">
                  <div class="form-group">
                     <label>Unit Name</label>
                     {!! Form::text('name', null, ['class' => 'form-control', 'id' => 'name', 'required' => true, 'autocomplete' => 'off']) !!}
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