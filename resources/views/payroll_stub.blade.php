@extends('layouts.app')

@section('css')
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header"><i class="fa fa-money fa-lg"></i> Stub</div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-1">
                                <label><b>Name:</b></label>
                            </div>
                            <div class="col-md-3">
                                <input class="custom-input" value="{{ $employee->name }}" type="text" readonly>
                            </div>
                            <div class="col-md-1">
                                <label><b>Status:</b></label>
                            </div>
                            <div class="col-md-3">
                                <input class="custom-input"  value="{{ $employee->status }}" type="text" readonly>
                            </div>
                            <div class="col-md-1">
                                <label><b>Rate:</b></label>
                            </div>
                            <div class="col-md-3">
                                <input class="custom-input"  value="{{ $employee->rate }} php/hr" type="text" readonly>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">
                                <label><b>Total Payout:</b></label>
                            </div>
                            <div class="col-md-3">
                                <input class="custom-input" name="payout" type="text" value="{{$pay_detail->payout}}" readonly>
                            </div>
                            <div class="col-md-2">
                                <label><b>Total Hrs Worked:</b></label>
                            </div>
                            <div class="col-md-3">
                                <input class="custom-input" name="total_hrs" type="text" value="{{$pay_detail->total_hrs}}" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
			<table class="table table-striped" id="stubs_by_date" style="width:100%; text-align: center;">
			  <thead>
			    <tr>
			      <th scope="col">Punch-in</th>
			      <th scope="col">Punch-out</th>
			      <th scope="col">Hours Worked</th>
			    </tr>
			  </thead>
			  <tbody>
                            @foreach($logs as $log) 
                                <tr id="{{'log_'.$log->id}}">
                                  <td>{{Carbon::parse($log->time_in)->format('F j Y, g:i a')}}</td>
                                  <td>{{$log->time_out ? Carbon::parse($log->time_out)->format('F j Y, g:i a'):'' }}</td>
                                  <td>{{Carbon::parse($log->time_out ? Carbon::parse($log->time_out) : Carbon::now())->diff(Carbon::parse($log->time_in))->format('%H hr %I min')}}</td>
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
