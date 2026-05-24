<!DOCTYPE html>
<html>
<head><title>{{ $subject }}</title></head>
<body>
    <h2>{{ $subject }}</h2>
    <p>Dear {{ $attendee->name }},</p>
    <p>{!! nl2br(e($messageBody)) !!}</p>
    <p>Your ticket number: <strong>{{ $attendee->ticket_number }}</strong></p>
    <p>– The Tea Party Cruise Team</p>
</body>
</html>