@extends('layouts.admin')

@section('admin_content')
<!-- dropify cdn link -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.css" integrity="sha512-In/+MILhf6UMDJU4ZhDL0R0fEpsp4D3Le23m6+ujDWXwl3whwpucJG1PEmI3B07nyJx+875ccs+yX2CqQJUxUw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Order</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <!-- /.card -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Order List</h3>
                            <a href="{{route('order.report.print')}}" class="float-end btn btn-success print">Print Order Report</a>
                        </div>
                        <div class="row">
                            <div class="col-md-3 ml-2">
                                <label for="date" class="col-form-label">Date</label>
                                <input type="date" class="form-control submitable date" name="date" id="date">
                            </div>
                            <div class="col-md-3 ml-2">
                                <label for="status" class="col-form-label">Status</label>
                                <select name="status" class="form-select submitable status">
                                    <option value="all" selected>All</option>
                                    <option value="0">Pending</option>
                                    <option value="1">Received</option>
                                    <option value="2">Shipped</option>
                                    <option value="3">Completed</option>
                                    <option value="4">Return</option>
                                    <option value="5">Cancled</option>
                                </select>
                            </div>
                            <div class="col-md-3 ml-2">
                                <label for="status" class="col-form-label">Payment Type</label>
                                <select name="payment_type" class="form-select submitable payment_type" id="payment_type">
                                    <option value="cash on delivery">Cash On Delivery</option>
                                    <option value="mobile banking">Mobile Bank</option>
                                </select>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-bordered table-striped ytable">
                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Name</th>
                                        <th>Phone</th>
                                        <th>Total</th>
                                        <th>Payment Type</th>
                                        <th>Date</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->


    <!-- order edit modal  -->
    <div class="modal fade" id="ordereditModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Order</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div id="modal_body">

                </div>
            </div>
        </div>
    </div>


    <!-- order edit modal  -->
    <div class="modal fade" id="orderviewModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">View Order Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div id="view_modal_body">

                </div>
            </div>
        </div>
    </div>

    <!-- ajax cdn link  -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- dropify js link  -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js" integrity="sha512-8QFTrG0oeOiyWo/VM9Y8kgxdlCryqhIxVeRpWSezdRRAvarxVtwLnGroJgnVW9/XBRduxO/z1GblzPrMQoeuew==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>



    <script type="text/javascript">
        $(function order() {
            let table = $('.ytable').DataTable({
                processing: true,
                serverSide: true,
                searching: true,
                ajax: ({
                    url: "{{route('order.report.index')}}",
                    data: function(e) {
                        e.status = $('.status').val();
                        e.date = $('.date').val();
                        e.payment_type = $('.payment_type').val();
                    }

                }),
                columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                }, {
                    data: 'f_name',
                    name: 'f_name'
                }, {
                    data: 'phone',
                    name: 'phone'
                }, {
                    data: 'total',
                    name: 'total'
                }, {
                    data: 'payment_type',
                    name: 'payment_type'
                }, {
                    data: 'date',
                    name: 'date'
                }, {
                    data: 'status',
                    name: 'status'
                }]
            });
        });
    </script>

    <script type="text/javascript">
        // on change yazra datatable reload 
        $(document).on('change', '.submitable', function() {
            $('.ytable').DataTable().ajax.reload();
        });


        $('.print').on('click', function(e) {
            e.preventDefault();
            $.ajax({
                url: "{{route('order.report.print')}}",
                type: 'get',
                data: {
                    status: $('.status').val(),
                    date: $('.date').val(),
                    payment_type: $('.payment_type').val()
                },

                success: function(data) {
                    $(data).printThis({
                        debug: false,
                        importCSS: true,
                        importStyle: true,
                        removeInline: false,
                        printDelay: 500,
                    });
                },
                error: function(xhr, status, error) {
                    console.error('AJAX request failed:', status, error);
                }
            });
        });
    </script>

    @endsection