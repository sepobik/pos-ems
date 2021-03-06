@extends('layouts.app')

@section('css')
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6" style="padding-top: 30px;">
                <div class="card">
                    <div class="card-header"><i class="fa fa-calendar-o fa-lg"></i> Report Timeline</div>
                    <div class="card-body">
                        <div class="row" style="text-align: center;">
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-3">
                                        <label><b>Start:</b></label>
                                    </div>
                                    <div class="col-md-9">
                                        {{Carbon::parse($report->report_start)->format('F j Y, g:i a')}}
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-3">
                                        <label><b>End:</b></label>
                                    </div>
                                    <div class="col-md-9">
                                        {{Carbon::parse($report->report_end)->format('F j Y, g:i a')}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6" style="padding-top: 30px;">
                <div class="card">
                    <div class="card-header"><i class="fa fa-money fa-lg"></i> Profit Details</div>
                    <div class="card-body">
                        <div class="row" style="text-align: center;">
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-3">
                                        <label><b>Sales:</b></label>
                                    </div>
                                    <div class="col-md-9">
                                        {{$report->total_amount}} php
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-3">
                                        <label><b>Profit:</b></label>
                                    </div>
                                    <div class="col-md-9">
                                        {{$report->total_earned}} php
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12" style="padding-top: 30px;">
                <div class="card">
                    <div class="card-header"><i class="fa fa-table fa-lg"></i> Invoices List</div>
                    <div class="card-body">
                        <table id="invoices_by_report" style="width: 100%;" class="display nowrap table table-striped">
                            <thead>
                                <tr>
                                    <th>Invoice #</th>
                                    <th>Sold to</th>
                                    <th>Created at</th>
                                    <th>Sales</th>
                                    <th>Profit</th>
                                    <th>Cash Recieved</th>
                                    <th>Options</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($invoices as $invoice)
                                    <tr>
                                        <td>{{ $invoice->invoice_number }}</td>
                                        <td>{{ $invoice->customer }}</td>
                                        <td>{{ Carbon::parse($invoice->created_at)->format('F j Y, g:i a') }}</td>
                                        <td>{{ $invoice->amount_due}}</td>
                                        <td>{{ $invoice->profit}}</td>
                                        <td>{{ $invoice->amount_given}}</td>
                                        <td>
                                            <a type="button" href="{{ '/invoices/' . $invoice->id }}" class="btn btn-primary"><i class="fa fa-info-circle fa-lg"></i> More</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
@endsection
