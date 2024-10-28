@extends('layouts.front');
@section('content');

<div class="container" style="margin-top: 50px; margin-bottom:100px">
    <div class="row">
        @include('frontend.user.user_sidebar')
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-6">
                            <h3 class="text-start">Dashboard</h3>
                        </div>
                    </div>

                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3 border d-flex justify-content-center align-items-center" style="height: 100px;">
                            <span class="fs-6">Total Order: {{$total_order}}</span>
                        </div>
                        <div class="col-md-3 border d-flex justify-content-center align-items-center" style="height: 100px;">
                            <span>Complete Order: {{$order_done}}</span>
                        </div>
                        <div class="col-md-3 border d-flex justify-content-center align-items-center" style="height: 100px;">
                            <span>Received Order: {{$received_order}}</span>
                        </div>
                        <div class="col-md-3 border d-flex justify-content-center align-items-center" style="height: 100px;">
                            <span>Pending Order: {{$order_pending}}</span>
                        </div>
                    </div>
                    <div style="margin-top: 20px;">
                        <h5>Recent Order</h5>
                    </div>
                    <div>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Order Id</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Total</th>
                                    <th scope="col">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($recent_order as $row)
                                <tr>
                                    <td>{{$row->order_id}}</td>
                                    <td>{{$row->date}}</td>
                                    <td>{{$row->total}}</td>
                                    <td>
                                        @if($row->status==0)
                                        <span class="badge badge-danger">Order pending</span>
                                        @elseif($row->status==1)
                                        <span class="badge badge-info">Order received</span>
                                        @elseif($row->status==2)
                                        <span class="badge badge-info">Order shiped</span>
                                        @elseif($row->status==3)
                                        <span class="badge badge-info">Order done</span>
                                        @elseif($row->status==4)
                                        <span class="badge badge-info">Order return</span>
                                        @else
                                        <span class="badge badge-info">Order cancled</span>
                                        @endif
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
</div>
@endsection