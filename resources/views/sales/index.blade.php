@extends('layouts.default')
@section('main_content')
<div class="content">
    <div class="page-header">
    <div class="page-title">
        <h4>Invoice Report</h4>
        <h6>View your Invoice Report</h6>
    </div>
    </div>
    <div class="card">
    <div class="card-body">
    <div class="table-top">
        <div class="search-set">
            <div class="search-input"></div>
        </div>
    </div>
    
    <div class="table-responsive">
        <table class="table datanew">
            <thead>
                <tr>
                <th>
                    <label class="checkboxs">
                    <input type="checkbox" id="select-all">
                    <span class="checkmarks"></span>
                    </label>
                </th>
                <th>Invoice Number </th>
                <th>Invoice Date</th>
                <th>Customer Details </th>
                <th>Total Invoice Amount</th>
                <th>View Details</th>
                </tr>
            </thead>
            <tbody>
                @foreach($results as $k => $v)
                <tr>
                    <td>
                        {{ $k+1 }}
                    </td>
                    <td>{{ $v->invoice_number }}</td>
                    <td>{{ date('d-m-Y', strtotime($v->invoice_date)) }}</td>
                    <td>{{ $v->consignee_name }} <br> {{ $v->consignee_address }}, {{ $v->district->district_name }}</td>
                    <td class="text-end">
                        @php 
                            $total_amount = 0;

                            foreach($v->sale_items as $k1 => $v1) {
                                $total_amount += $v1->sell_price*$v1->quantity;
                            }

                        @endphp

                        {{ number_format((float)$total_amount, 2, '.', ''); }}
                    </td>
                    <td>
                        <a href="{{ route('sales.details', Crypt::encrypt($v->id)) }}" target="_blank">
                        <span class="badges bg-lightgreen">Details</span>
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@stop