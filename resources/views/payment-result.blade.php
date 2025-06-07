<!DOCTYPE html>
<html>
<head>
    <title>Payment Result</title>
</head>
<body>

@if ($success)
    <h2>✅ Payment Successful</h2>
    <p><strong>Transaction ID:</strong> {{ $payment_id }}</p>
    <p><strong>Amount:</strong> ₹{{ $amount }} {{ $currency }}</p>
    <p><strong>Paid By:</strong> {{ $name }} ({{ $email }})</p>
    <p><strong>Contact:</strong> {{ $contact }}</p>
    <p><strong>Date:</strong> {{ $created_at }}</p>
    <p><strong>Paid To:</strong> {{ $receiver }}</p>
    <a href="/">Back to Home</a>
@else
    <h2>❌ Payment Failed</h2>
    <p>{{ $error }}</p>
    <a href="/pay">Try Again</a>
@endif


</body>
</html>
