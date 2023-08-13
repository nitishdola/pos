@extends('layouts.default')

@section('main_content')
<div class="content">
   <div class="row">
      <div class="page-header">
         <div class="page-title">
            <h4>HSN Update</h4>
         </div>
         <div class="page-btn">
            <a href="{{ route('master.hsn.index') }}" class="btn btn-added"><i class="fas fa-th-list"></i> &nbsp; View HSN Codes</a>
         </div>
      </div>
      
      <div class="card">
         <div class="card-body">

            @if($errors->any())
                {!! implode('', $errors->all('<div class="alert alert-danger">:message</div>')) !!}
            @endif

            {!! Form::model($hsn,array('route' => ['master.hsn.update',Crypt::encrypt($hsn->id)], 'id' => 'hsn.save')) !!}

            <div class="row">
               <div class="col-lg-3 col-sm-6 col-12">
                  <div class="form-group">
                     <label>HSN Code</label>
                     {!! Form::text('hsn_code', $hsn->hsn_code, ['class' => 'form-control', 'id' => 'hsn_code', 'required' => true, 'autocomplete' => 'off']) !!}
                  </div>
               </div>

               <div class="col-lg-3 col-sm-6 col-12">
                  <div class="form-group">
                     <label>GST %</label>
                     {!! Form::number('gst', $hsn->gst, ['class' => 'form-control', 'id' => 'gst', 'required' => true, 'autocomplete' => 'off']) !!}
                  </div>
               </div>

               <div class="col-lg-3 col-sm-6 col-12">
                  <div class="form-group">
                     <label>CGST %</label>
                     {!! Form::number('cgst', $hsn->cgst, ['class' => 'form-control', 'id' => 'cgst', 'required' => true, 'autocomplete' => 'off']) !!}
                  </div>
               </div>

               <div class="col-lg-3 col-sm-6 col-12">
                  <div class="form-group">
                     <label>SGST %</label>
                     {!! Form::number('sgst', $hsn->sgst, ['class' => 'form-control', 'id' => 'sgst', 'required' => true, 'autocomplete' => 'off']) !!}
                  </div>
               </div>

               <div class="col-lg-12 col-sm-6 col-12">
                  <div class="form-group">
                     <label>Description (Optional)</label>
                     {!! Form::textarea('description', $hsn->description, ['class' => 'form-control', 'id' => 'description', 'autocomplete' => 'off']) !!}
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