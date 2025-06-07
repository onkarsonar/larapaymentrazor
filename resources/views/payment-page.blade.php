<!DOCTYPE html>
<html>
<head>
    <title>Payment Page</title>
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <!-- You include this script in your HTML page (usually inside payment-page.blade.php) so you can show Razorpay's secure payment interface to the user. -->
</head>
<body>

<form action="{{ route('verify.payment') }}" method="POST" id="paymentForm">
    @csrf
    <input type="hidden" name="razorpay_payment_id" id="razorpay_payment_id">
    <input type="hidden" name="razorpay_order_id" id="razorpay_order_id">
    <input type="hidden" name="razorpay_signature" id="razorpay_signature">
</form>

<script>
    var options = {
        "key": "{{ config('services.razorpay.key') }}",
        "amount": "{{ $amount * 100 }}", // amount in paise
        "currency": "INR",
        "name": "Your Company Name",
        "order_id": "{{ $order_id }}",
        "handler": function (response){
            document.getElementById('razorpay_payment_id').value = response.razorpay_payment_id;
            document.getElementById('razorpay_order_id').value = response.razorpay_order_id;
            document.getElementById('razorpay_signature').value = response.razorpay_signature;

            // signature comes from razorpay after successfull payment

            document.getElementById('paymentForm').submit();
        }
    };
    var rzp = new Razorpay(options);
    rzp.open();
</script>

</body>
</html>
