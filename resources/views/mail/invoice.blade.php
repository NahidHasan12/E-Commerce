<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>I</title>
</head>
<body>
    <h1 style="color:red">Successfully Order Placed</h1> <br>
    <strong>Order Id: {{ $data['order_id'] }} </strong> <br>
    <strong>Order Date: {{ $data['date'] }} </strong> <br>
    <strong>Total Amount: {{ $data['total'] }} </strong> <br>
    <hr>
    <strong>Name: {{ $data['c_name'] }} </strong> <br>
    <strong>Phone: {{ $data['c_phone'] }} </strong> <br>
    <strong>Address: {{ $data['c_address'] }} </strong>
</body>
</html>

