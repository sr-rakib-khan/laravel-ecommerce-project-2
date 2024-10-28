<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Report</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        @media print {
            .no-print {
                display: none;
            }
        }

        body {
            margin: 20px;
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="row mb-4">
            <div class="col text-center">
                <h1>Order Report</h1>
            </div>
        </div>
        <!-- Report Table -->
        <div class="row">
            <div class="col">
                <table class="table table-bordered">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">Sl</th>
                            <th scope="col">Order ID</th>
                            <th scope="col">Customer Name</th>
                            <th scope="col">Phone</th>
                            <th scope="col">Tk (Total)</th>
                            <th scope="col">Payment Type</th>
                            <th scope="col">Date</th>
                            <th scope="col">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Sample data, replace with dynamic data -->
                        @foreach($orders as $key=>$row)
                        <tr>
                            <td>{{++$key}}</td>
                            <td>{{$row->order_id}}</td>
                            <td>{{$row->f_name}}</td>
                            <td>{{$row->phone}}</td>
                            <td>{{$row->total}}</td>
                            <td>{{$row->payment_type}}</td>
                            <td>{{$row->date}}</td>
                            <td>
                                @if($row->status == 0)
                                Pending
                                @elseif($row->status == 1)
                                Received
                                @elseif($row->status == 2)
                                Shipped
                                @elseif($row->status == 3)
                                Completed
                                @elseif($row->status == 4)
                                Returned
                                @else
                                Cancled
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>