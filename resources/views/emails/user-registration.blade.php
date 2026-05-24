<!DOCTYPE html>
<html>
<head><title>Registration – Complete Payment</title></head>
<body style="font-family: sans-serif;">
    <h2>Thanks for registering!</h2>
    <p>Dear {{ $registration->name }},</p>
    <p>You are almost ready for the Tea Party Cruise. Please complete your payment using <strong>CashApp</strong> by scanning the QR code below:</p>

    <img src="{{ $message->embed($qrImagePath) }}" alt="CashApp QR Code" width="200">

    <p><strong>Ticket Number:</strong> {{ $registration->ticket_number }}</p>
    <p>We'll notify you once your payment is verified and your spot is confirmed.</p>
    <p>Questions? Reply to this email.</p>
</body>
</html>