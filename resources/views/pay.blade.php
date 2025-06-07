<!DOCTYPE html>
<html>
<head>
    <title>Make Payment</title>
</head>
<body>
    <h2>Pay ₹100 using Razorpay</h2>
    <form method="POST" action="{{ route('payment') }}">
        @csrf
        <button type="submit">Pay Now</button>
    </form>
</body>
</html>
