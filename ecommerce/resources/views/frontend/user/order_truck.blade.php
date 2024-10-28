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
                            <h3 class="text-start">My Order</h3>
                        </div>
                    </div>

                </div>
                <div class="card-body">
                    <div style="margin-top: 20px;">

                        <label for="">Order Id</label>
                        <input type="text" name="order_id" id="searchQuery" class="form-control" placeholder="search.........">

                    </div>
                    <div>
                        <table class="table ytable">
                            <thead>
                                <tr>
                                    <th scope="col">Order Id</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Total</th>
                                    <th scope="col">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($results as $row)
                                <tr>
                                    <td>{{$row->order_id}}</td>
                                    <td>Mark</td>
                                    <td>Otto</td>
                                    <td>@mdo</td>
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

<!-- ajax cdn link  -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script type="text/javascript">
    $(document).ready(function() {
    $('#searchQuery').on('input', function() {
        var query = $(this).val();

        if (query.length > 2) { 
            $.ajax({
                url: '/order/search', 
                method: 'GET',
                data: { searchQuery: query },
                success: function(response) {
                    $('#searchResults').html(response);
                },
                error: function(xhr) {
                    $('#searchResults').html('<p>An error occurred</p>');
                }
            });
        } else {
            $('#searchResults').empty();
        }
    });
});
</script>
@endsection