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
		            <table class="table" id="purchase_table">
		               <thead>
		                  <tr>
		                     <th width="18%">Product Name</th>
		                     <th width="9%">HSN</th>
		                     
		                     <th width="12%">Mfg <br>Date</th>
		                     <th width="12%">Exp Date</th>
		                     <th width="8%">GST</th>
		                     <th width="11%">Unit Cost<br>(&#x20B9;)</th>
		                     <th width="11%">MRP<br>(&#x20B9;)</th>
		                     <th width="12%">QTY</th>
		                     <th class="text-end">Total Cost <br>(&#x20B9;) </th>
		                     <th></th>
		                  </tr>
		               </thead>
		               <tbody>
		                  @php for($i = 0; $i < 1; $i++){ @endphp
		                  <tr>
		                     <td>
		                        {!! Form::select(	
		                        						'item_id[]', 
		                        						$items, 
		                        						null, 
		                        						[
		                        							'class' 			=> 'select2 item_name', 
		                        							'placeholder' 	=> 'Select', 
		                        							'autocomplete' => 'off'
	                        							]
		                        					)
		                        !!}
		                     </td>
		                     <td width="18%">
		                     	{!! Form::select('hsn_master_id[]', $hsn_codes, null, ['class' => 'select2 hsn_master_id',  'placeholder' => 'Select', 'autocomplete' => 'off']) !!}
		                     </td>
		                     

		                     <td>
		                     	{!! Form::text('manufacturing_date[]', null, ['class' => 'z_datetimepickerym form-control manufacturing_date', 'width' => '180px',  'autocomplete' => 'off']) !!}
		                     </td>

		                     <td>
		                     	{!! Form::text('expiry_date[]', null, ['class' => 'expiry_date z_datetimepickerym form-control', 'autocomplete' => 'off']) !!}
		                     </td>
		                     
		                     <td>
		                     	{!! Form::text('gst[]', null, ['class' => 'form-control gst', 'id' => 'gst', 'autocomplete' => 'off']) !!}
		                     </td>
		                     <td>
		                     	{!! Form::text('unit_cost[]', null, ['class' => 'unit_cost form-control', 'id' => 'unit_cost', 'autocomplete' => 'off']) !!}</td>

		                     <td>
		                     	{!! Form::text('mrp[]', null, ['class' => 'mrp form-control', 'id' => 'unit_cost', 'autocomplete' => 'off']) !!}</td>

		                     <td>
		                     	{!! Form::text('quantity[]', null, ['class' => 'quantity form-control', 'id' => 'quantity', 'autocomplete' => 'off']) !!}
		                     </td>

		                     <td class="text-end total_cost"></td>
		                  </tr>
		                  @php  } @endphp

		                  	
		                  
		               </tbody>
		            </table>

		            <div class="col-lg-12 mb-3 mt-4">
		            	<a href="javascript:void(0)" class="add_more_item btn btn-sm btn-info"><i class="fas fa-plus-square"></i> Add More</a> 
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

@section('pageJs')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Zebra_datepicker/1.9.19/zebra_datepicker.min.js" integrity="sha512-KtN0FO60US4/jwC1DajXPg9ZANJxs2DDC4utQFTfFdf7Ckpmt4gLKzTJhfEK0yEeCq2BvcMKWdMGRmiGiPnztQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://dreamspos.dreamguystech.com/html/template/assets/plugins/select2/js/select2.min.js"></script>



<script type="text/javascript">
	$('select.select2').select2();
	$('.z_datetimepicker').Zebra_DatePicker();
	$('.z_datetimepickerym').Zebra_DatePicker({
		format: 'm-Y'
	});

	
 
 
 	$(document).on('change', '.hsn_master_id', function() {
 		console.log('kjjj');
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
 	
 	$(document).on('keyup', '.quantity', function() {
	    var $this 		= $(this);
	    var quantity 	= $this.val();
	    $latest_tr  	= $this.closest('tr');
	    var unit_cost = parseFloat($latest_tr.find('.unit_cost').val());

	    let gst = $latest_tr.find('.gst').val(); 
	    let tcost = unit_cost + ((gst/100)*unit_cost); //console.log(tcost);
	    let final_cost = quantity*tcost;
	    final_cost = final_cost.toFixed(2);
	    $latest_tr.find('.total_cost').text(final_cost);

	});

	$('.add_more_item').click(function(e) {
    	let $latest_tr  = $('#purchase_table tr:last');
	  	$('select.select2').select2('destroy');
		let $clone          = $latest_tr.clone();

		$clone.find('.Zebra_DatePicker_Icon').remove();
		$clone.find('*').removeAttr('style'); /* Added this */
		
		let datepicker = $clone.find('input.z_datetimepickerym');
		datepicker.Zebra_DatePicker({
			format: 'm-Y'
		});



		$clone.find('.quantity').val('');
		$clone.find('.manufacturing_date').val('');
		$clone.find('.expiry_date').val('');
		$clone.find('.mrp').val('');
		$clone.find('.unit_cost').val('');
		$clone.find('.total_cost').text('');
		$clone.find('.gst').val('');




	   $latest_tr.after($clone);console.log($latest_tr);
	   $('select.select2').select2();
	    
	    
	});
 </script>
@stop

@section('pageCss')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Zebra_datepicker/1.9.19/css/default/zebra_datepicker.min.css" integrity="sha512-CJyaLLygRDTA/3etUQWuiCKOrk0YGmYaJe+SWMtDv6QQT/rnRWkXcGWYn101NQQpVGwP2H6iHJucYFSi3tWXKw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<link href="https://dreamspos.dreamguystech.com/html/template/assets/plugins/select2/css/select2.min.css" rel="stylesheet" />

<style>
	button.Zebra_DatePicker_Icon : {
		display: none !important;
	}
	.add_more_item { color: #FFFFFF; }
</style>

@stop

