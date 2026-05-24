<!DOCTYPE html>
<html>
<head><title>Registration Confirmed</title></head>
<body>
    <h2>You're confirmed!</h2>
    <p>Dear {{ $registration->name }},</p>
    <p>Your registration for the Tea Party Cruise has been <strong>confirmed</strong>. We can't wait to have you aboard!</p>
    <p><strong>Ticket Number:</strong> {{ $registration->ticket_number }}</p>
    <p>Please bring this email (or your ticket number) to check-in.</p>
    <p>See you soon!</p>
</body>
</html>