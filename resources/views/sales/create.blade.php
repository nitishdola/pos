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
            {!! implode('', $errors->all('
            <div class="alert alert-danger">:message</div>
            ')) !!}
            @endif
            {!! Form::open(['route' => ['sales.save']]) !!}


            <div class="row">

		      	<div class="col-lg-4 col-sm-6 col-12">
		            <div class="form-group">
		               <label>Consignee Name </label>
		               <div class="input-groupicon">

		                  {!! Form::text('consignee_name', null, ['class' => 'form-control', 'id' => 'consignee_name', 'placeholder' => '', 'autocomplete' => 'off']) !!}

		               </div>
		            </div>
		         </div>

		         <div class="col-lg-4 col-sm-6 col-12">
		            <div class="form-group">
		               <label>Address </label>
		               <div class="input-groupicon">
		                  {!! Form::text('consignee_address', null, ['class' => 'form-control', 'id' => 'consignee_address', 'autocomplete' => 'off']) !!}
		               </div>
		            </div>
		         </div>
		         
		         <div class="col-lg-4 col-sm-6 col-12">
		            <div class="form-group">
		               <label>District</label>
		               {!! Form::select('consignee_district_id', $districts, null, ['class' => 'select2', 'placeholder' => 'Select District', 'id' => 'consignee_district',  'autocomplete' => 'off']) !!}
		            </div>
		         </div>

		      </div>

            <div class="row">

		      	<div class="col-lg-4 col-sm-6 col-12">
		            <div class="form-group">
		               <label>Invoice Date </label>
		               <div class="input-groupicon">

		                  {!! Form::text('invoice_date', null, ['class' => 'datepicker form-control', 'id' => 'invoice_date', 'placeholder' => '', 'autocomplete' => 'off']) !!}

		               </div>
		            </div>
		         </div>
            </div>

            <div class="row">
               <div class="table-responsive">
                  <table class="table" id="sales_table">
                     <thead>
                        <tr>
                           <th width="14%">Product Name</th>
                           <th width="14%">Purchase Info</th>
                           <th width="14%">GST</th>
                           <th width="14%">MRP <br>Pur. Cost<br>(inc. GST)</th>
                           <th width="14%">Sell Cost <br> (inc. GST)</th>
                           <th width="10%">QTY</th>
                           <th class="text-end">Total Cost <br>(&#x20B9;) </th>
                           <th></th>
                        </tr>
                     </thead>
                     <tbody>
                        <tr>
                           <td>
                              {!! Form::select('item_id[]', $items, null, ['class' => 'form-control select2 product_id', 'placeholder' => 'Select', 'autocomplete' => 'off']) !!}
                           </td>
                           <td>
                            <select name="purchase_item_id[]" class="select2 purchase_id"></select>
                           </td>
                           <td class="gst"></td>
                           <td class="unit_cost"></td>
                           <td>
                              {!! Form::text('sell_price[]', null, ['class' => 'sell_price form-control',  'autocomplete' => 'off']) !!}
                           </td>
                           <td>
                              {!! Form::text('quantity[]', null, ['class' => 'quantity form-control', 'autocomplete' => 'off']) !!}
                           </td>
                           <td class="text-end total_cost"></td>
                        </tr>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js" integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Zebra_datepicker/1.9.19/zebra_datepicker.min.js" integrity="sha512-KtN0FO60US4/jwC1DajXPg9ZANJxs2DDC4utQFTfFdf7Ckpmt4gLKzTJhfEK0yEeCq2BvcMKWdMGRmiGiPnztQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script type="text/javascript">
   $('select.select2').select2();
   $('input.datepicker').Zebra_DatePicker();
</script>
<script>
   $('.add_more_item').click(function(e) {
       	let $latest_tr  = $('#sales_table tr:last');
   	  	$('select.select2').select2('destroy');
   		let $clone          = $latest_tr.clone();


         $clone.find('.unit_cost').text('');
		   $clone.find('.total_cost').text('');
		   $clone.find('.gst').text('');
		   $clone.find('.sell_price').val('');
		   $clone.find('.quantity').val('');
   
   	   $latest_tr.after($clone);//console.log($latest_tr);
   	   $('select.select2').select2();
   	});


	//product change function 
   $(document).on('change', '.product_id', function() {
		var url     = '';
		var data    = '';

		var $this = $(this);

		$latest_tr  = $this.closest('tr');

		var item_id = $this.val();

      let elem = this;

		if(item_id != '' || item_id != 0) {

			url     += "{{ route('get_all_purchase_details') }}";
			data    += '&item_id='+item_id;
			console.log(url+'?'+data);
			$.ajax({
				data : data,
				url  : url,
				type : 'get',

				error : function(resp) {
					alert('Oops ! Something went wrong ');
				},
				success : function(resp) {
               let option = '<option value="">Select Invoice</option>';
               $.each(resp, function (key, val) {
                  option += '<option value="'+val.purchase_item_id+'">'+val.invoice_number+' P Date '+val.purchase_date+'</option>';
               });

					$latest_tr.find('.purchase_id').html(option);
				}
			});
		}else{
         let nhtml = '';
         $latest_tr.find('.purchase_id').html(nhtml);

         //alert('j')
         $latest_tr.find('.sell_price').val(0);
         $latest_tr.find('.unit_cost').html(0);
         $latest_tr.find('.gst').text('');
         $latest_tr.find('.quantity').val(0);
         $latest_tr.find('.total_cost').text('');
      }
	});

   $(document).on('change', '.purchase_id', function() {
      var url_2     = '';
		var data_2    = '';

      var $this = $(this);
      var purchase_item_id = $this.val();
      let elem = this;

      if(purchase_item_id != '' || purchase_item_id != 0) {

			url_2     += "{{ route('get_purchase_item_details') }}";
			data_2    += '&purchase_item_id='+purchase_item_id;
			$.ajax({
				data : data_2,
				url  : url_2,
				type : 'get',

				error : function(resp) {
					alert('Oops ! Something went wrong ');
				},
				success : function(resp) {
					
               if(resp.current_stock > 0) {
                  $latest_tr.find('.gst').text(resp.gst+' %');

                  let ucost = 0;
                  ucost = resp.unit_cost; //console.log(ucost);
                  let display_u_cost = 0;
                  display_u_cost = ucost + ((ucost/100)*10);

                  //add GST
                  let display_u_cost_with_gst = 0;
                  display_u_cost_with_gst = display_u_cost + ((display_u_cost/100)*resp.gst);


                  $latest_tr.find('.unit_cost').html(resp.mrp+'<br />' +display_u_cost_with_gst.toFixed(2));

                  //SELL COST
                  let sell_cost = 0;
                  sell_cost = ucost + ((ucost/100)*20);

                  //add GST
                  let sell_cost_with_gst = 0;
                  sell_cost_with_gst = sell_cost + ((sell_cost/100)*resp.gst);


                  $latest_tr.find('.sell_price').val(sell_cost_with_gst.toFixed(2));
               }else{
                  alert('Stok nil. Choose other invoice.');
               }
					
				}
			});
      }else{
         //alert('j')
         $latest_tr.find('.sell_price').val(0);
         $latest_tr.find('.unit_cost').html(0);
         $latest_tr.find('.gst').text('');
      }
   });


   $(document).on('keyup', '.quantity', function() {
	    var $this 		= $(this);
	    var quantity 	= $this.val();
	    $latest_tr  	= $this.closest('tr');
	    var sell_cost = parseFloat($latest_tr.find('.sell_price').val());
       sell_cost = sell_cost*quantity;
	    $latest_tr.find('.total_cost').text(sell_cost.toFixed(2));
	});

</script>
@stop
@section('pageCss')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Zebra_datepicker/1.9.19/css/metallic/zebra_datepicker.min.css" integrity="sha512-VeBd1mVDXcj9onaSbaf8Z/fJVd7qR08qMtdSDttUN8ds+75TZ+fb6vkjltv26K7FjedTDl1wteDyS99UnHhzDw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" integrity="sha512-nMNlpuaDPrqlEls3IX/Q56H36qvBASwb3ipuo3MxeWbsQB1881ox0cRv7UPTgBlriqoynt35KjEwgGUeUXIPnw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@stop