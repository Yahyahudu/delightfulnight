<!DOCTYPE html>
<html>
<head><title>New Registration</title></head>
<body>
    <h2>New Registration Received</h2>
    <p><strong>Name:</strong> {{ $registration->name }}</p>
    <p><strong>Email:</strong> {{ $registration->email }}</p>
    <p><strong>Phone:</strong> {{ $registration->phone }}</p>
    <p><strong>Tickets:</strong> {{ $registration->tickets_count }}</p>
    <p><strong>Notes:</strong> {{ $registration->notes ?? '—' }}</p>
    <p><strong>Registration ID:</strong> {{ $registration->registration_id }}</p>
    <p><strong>Ticket Number:</strong> {{ $registration->ticket_number }}</p>
    <p><a href="{{ route('admin.dashboard') }}">Go to Admin Dashboard</a> to verify payment and confirm.</p>
</body>
</html>