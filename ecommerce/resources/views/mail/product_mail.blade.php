<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
</head>

<body>
    <h3>New product for you</h3>
    <strong>Product Name:{{$Product['name']}}</strong><br><br>
    <strong>Price:{{$Product['selling_price']}}</strong><br><br>
    <img src="{{url('public/files/product/'.$Product['thumbnail'])}}" alt="procut"> <br>
    <a href="{{route('product.details',$Product['id'])}}">Product link</a>
</body>

</html>