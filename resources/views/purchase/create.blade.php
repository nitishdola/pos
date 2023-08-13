@extends('layouts.default')

@section('main_content')
<div class="content">
   <div class="row">
      <div class="page-header">
         <div class="page-title">
            <h4>Purchase Stock</h4>
         </div>
      </div>
      
      <div class="card">
		   <div class="card-body">

		   	@if($errors->any())
                {!! implode('', $errors->all('<div class="alert alert-danger">:message</div>')) !!}
            @endif

            {!! Form::open(['route' => ['po.save']]) !!}

		      <div class="row">

		      	<div class="col-lg-2 col-sm-6 col-12">
		            <div class="form-group">
		               <label>Select Vendor </label>
		               <div class="input-groupicon">

		                  {!! Form::select('vendor_id', $vendors, null, ['class' => 'form-control', 'id' => 'vendor_id', 'required' => true, 'placeholder' => 'Select Vendor', 'autocomplete' => 'off']) !!}

		               </div>
		            </div>
		         </div>

		         <div class="col-lg-2 col-sm-6 col-12">
		            <div class="form-group">
		               <label>Purchase Date </label>
		               <div class="input-groupicon">

		                  {!! Form::text('purchase_date', null, ['class' => 'z_datetimepicker', 'id' => 'purchase_date', 'required' => true, 'placeholder' => 'DD-MM-YYYY', 'autocomplete' => 'off']) !!}

		               </div>
		            </div>
		         </div>
		         
		         <div class="col-lg-2 col-sm-6 col-12">
		            <div class="form-group">
		               <label>Invoice No.</label>
		               {!! Form::text('invoice_number', null, ['class' => '', 'id' => 'invoice_number', 'required' => true, 'placeholder' => '', 'autocomplete' => 'off']) !!}
		            </div>
		         </div>

		         <div class="col-lg-2 col-sm-6 col-12">
		            <div class="form-group">
		               <label>Invoice Date</label>
		               {!! Form::text('invoice_date', null, ['class' => 'z_datetimepicker', 'id' => 'invoice_date', 'required' => true, 'placeholder' => 'DD-MM-YYYY', 'autocomplete' => 'off']) !!}
		            </div>
		         </div>

		         <div class="col-lg-2 col-sm-6 col-12">
		            <div class="form-group">
		               <label>Discount</label>
		               {!! Form::number('discount', null, ['class' => 'form-control', 'id' => 'discount', 'placeholder' => '', 'autocomplete' => 'off']) !!}
		            </div>
		         </div>

		      </div>
		      <div class="row">
		         <div class="table-responsive">
		            <table class="table">
		               <thead>
		                  <tr>
		                     <th>Product Name</th>
		                     <th width="14%">HSN</th>
		                     
		                     <th width="14%">Manufacturing <br>Date</th>
		                     <th width="14%">Expiry Date</th>
		                     <th width="10%">GST %</th>
		                     <th>Unit Cost<br>(&#x20B9;)</th>
		                     <th width="14%">MRP<br>(&#x20B9;)</th>
		                     <th width="10%">QTY</th>
		                     <th class="text-end">Total Cost <br>(&#x20B9;) </th>
		                     <th></th>
		                  </tr>
		               </thead>
		               <tbody>
		                  
		                  @php for($i = 0; $i < 5; $i++){ @endphp
		                  <tr>
		                     <td>
		                        {!! Form::select('item_id[]', $items, null, ['class' => 'form-control', 'id' => 'item_id', 'placeholder' => 'Select', 'autocomplete' => 'off']) !!}
		                     </td>
		                     <td>
		                     	{!! Form::select('hsn_master_id[]', $hsn_codes, null, ['class' => 'form-control hsn_master_id', 'id' => 'hsn',  'placeholder' => 'Select', 'autocomplete' => 'off']) !!}
		                     </td>
		                     

		                     <td>
		                     	{!! Form::text('manufacturing_date[]', null, ['class' => 'datepicker form-control', 'id' => 'z_datetimepicker1',  'autocomplete' => 'off']) !!}
		                     </td>

		                     <td>
		                     	{!! Form::text('expiry_date[]', null, ['class' => 'datepicker form-control', 'id' => 'z_datetimepicker1',  'autocomplete' => 'off']) !!}
		                     </td>
		                     
		                     <td>
		                     	{!! Form::text('gst[]', null, ['class' => 'form-control gst', 'id' => 'gst', 'autocomplete' => 'off']) !!}
		                     </td>
		                     <td>
		                     	{!! Form::text('unit_cost[]', null, ['class' => 'unit_cost form-control', 'id' => 'unit_cost', 'autocomplete' => 'off']) !!}</td>

		                     <td>
		                     	{!! Form::text('mrp[]', null, ['class' => 'form-control', 'id' => 'unit_cost', 'autocomplete' => 'off']) !!}</td>

		                     <td>
		                     	{!! Form::text('quantity[]', null, ['class' => 'quantity form-control', 'id' => 'quantity', 'autocomplete' => 'off']) !!}
		                     </td>

		                     <td class="text-end total_cost"></td>
		                  </tr>
		                  @php  } @endphp
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/Zebra_datepicker/1.9.19/zebra_datepicker.min.js" integrity="sha512-KtN0FO60US4/jwC1DajXPg9ZANJxs2DDC4utQFTfFdf7Ckpmt4gLKzTJhfEK0yEeCq2BvcMKWdMGRmiGiPnztQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script src="{{ asset('assets/js/picker.js') }}"></script>
<script src="{{ asset('assets/js/picker.date.js') }}"></script>


<script type="text/javascript">
	$('.z_datetimepicker').Zebra_DatePicker();
	$('.z_exp_datetimepicker').Zebra_DatePicker({
    format: 'm Y',
});
</script>
<script>
     $(function() {
		  var from_$input = $('.datepicker').pickadate({
		  	format: 'mm-yyyy',
		  }),
		    from_picker = from_$input.pickadate('picker')
		});
 </script>

 <script>
 	$('.hsn_master_id').change(function() {
 		let hsn_master_id = $(this).val();

 		data = url = '';

 		url 	+= "{{ route('get_hsn_details') }}";
 		data 	+= '&id='+hsn_master_id;

 		$latest_tr  = $(this).closest('tr');

 		$.ajax({
 			data : data,
 			type : 'GET',
 			url  : url,

 			error : function(resp) {
 				console.log(resp);
 			},

 			success : function(resp) {
 				$latest_tr.find('.gst').val(resp.gst);
 				
 			}
 		});
 	});
 </script>

 <script>
 	$(".quantity").on("keyup", function() { 
    var $this 		= $(this);
    var quantity 	= $this.val();
    $latest_tr  	= $this.closest('tr');
    var unit_cost = parseFloat($latest_tr.find('.unit_cost').val());
    gst = $latest_tr.find('.gst').val();
    tcost = unit_cost + (gst/unit_cost)*100;
    $latest_tr.find('.total_cost').text(quantity*tcost);

});
 </script>
@stop

@section('pageCss')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Zebra_datepicker/1.9.19/css/default/zebra_datepicker.min.css" integrity="sha512-CJyaLLygRDTA/3etUQWuiCKOrk0YGmYaJe+SWMtDv6QQT/rnRWkXcGWYn101NQQpVGwP2H6iHJucYFSi3tWXKw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<link href="{{ asset('assets/css/classic.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/css/classic.date.css') }}" rel="stylesheet" type="text/css" />
@stop

