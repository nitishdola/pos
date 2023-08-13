@extends('layouts.default')

@section('main_content')
<div class="content">
   <div class="row">
      <div class="page-header">
         <div class="page-title">
            <h4>Sales</h4>
         </div>
      </div>
      
      <div class="card">
		   <div class="card-body">

		   	@if($errors->any())
                {!! implode('', $errors->all('<div class="alert alert-danger">:message</div>')) !!}
            @endif

            {!! Form::open(['route' => ['sales.save']]) !!}

		     
		      <div class="row">
		         <div class="table-responsive">
		            <table class="table">
		               <thead>
		                  <tr>
		                     <th>Product Name</th>
		                     <th width="14%">MRP<br>(&#x20B9;)</th>
		                     <th width="10%">QTY</th>
		                     <th class="text-end">Total Cost <br>(&#x20B9;) </th>
		                     <th></th>
		                  </tr>
		               </thead>
		               <tbody>
		                  
		                  
		                  <tr>
		                     <td>
		                        {!! Form::select('item_id[]', $items, null, ['class' => 'form-control select2', 'id' => 'item_id', 'placeholder' => 'Select', 'autocomplete' => 'off']) !!}
		                     </td>
		                    
		                     <td>
		                     	{!! Form::text('mrp[]', null, ['class' => 'form-control', 'id' => 'unit_cost', 'autocomplete' => 'off']) !!}</td>

		                     <td>
		                     	{!! Form::text('quantity[]', null, ['class' => 'quantity form-control', 'id' => 'quantity', 'autocomplete' => 'off']) !!}
		                     </td>

		                     <td class="text-end total_cost"></td>
		                  </tr>

		                  
		                  
		               </tbody>
		            </table>
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

@section('pageJs')
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js" integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script type="text/javascript">
	$('.select2').select2();
</script>
@stop

@section('pageCss')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" integrity="sha512-nMNlpuaDPrqlEls3IX/Q56H36qvBASwb3ipuo3MxeWbsQB1881ox0cRv7UPTgBlriqoynt35KjEwgGUeUXIPnw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@stop

