<?php

namespace App\Http\Controllers;

use App\Mail\AdminRegistrationMail;
use App\Mail\UserRegistrationMail;
use App\Models\Registration;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Mail;

class RegistrationController extends Controller
{
    // Step 1: store basic info, return registration_id and ticket_number
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string',
            'tickets' => 'required|integer|min:1|max:10',
            'notes' => 'nullable|string',
        ]);

        $registrationId = 'REG-' . strtoupper(Str::random(8));
        $ticketNumber = 'TCKT-' . str_pad(random_int(1, 999999), 6, '0', STR_PAD_LEFT);

        $registration = Registration::create([
            'registration_id' => $registrationId,
            'ticket_number' => $ticketNumber,
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'tickets_count' => $validated['tickets'],
            'notes' => $validated['notes'],
            'status' => 'pending',
        ]);

        // Send email to user
        Mail::to($registration->email)->send(new UserRegistrationMail($registration));
        // Send email to admin (use your admin email from config, e.g., env('ADMIN_EMAIL'))
        Mail::to(config('mail.admin_address', 'admin@delightfulnight.site'))->send(new AdminRegistrationMail($registration));

        return response()->json([
            'success' => true,
            'registration_id' => $registration->registration_id,
            'id' => $registration->id,
        ]);
    }

    // Step 2: finalize with screenshot + reference
    public function finalize(Request $request, $id)
    {
        $registration = Registration::findOrFail($id);

        $validated = $request->validate([
            'payment_reference' => 'nullable|string|max:255',
            'payment_screenshot' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('payment_screenshot')) {
            $path = $request->file('payment_screenshot')->store('payments', 'public');
            $registration->payment_screenshot = $path;
        }

        if (!empty($validated['payment_reference'])) {
            $registration->payment_reference = $validated['payment_reference'];
        }

        $registration->save();

        return response()->json([
            'success' => true,
            'message' => 'Registration submitted for verification',
            'registration_id' => $registration->registration_id,
            'ticket_number' => $registration->ticket_number,
        ]);
    }
}
