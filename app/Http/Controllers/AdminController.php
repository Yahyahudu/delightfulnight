<?php

namespace App\Http\Controllers;

use App\Mail\AnnouncementMail;
use App\Mail\ConfirmationMail;
use App\Models\Registration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ReminderMail;

class AdminController extends Controller
{
    public function dashboard()
    {
        $stats = [
            'total_tickets_sold' => Registration::sum('tickets_count'),
            'total_revenue' => Registration::sum('tickets_count') * 200,
            'confirmed_attendees' => Registration::where('status', 'confirmed')->sum('tickets_count'),
            'remaining_capacity' => 200 - Registration::where('status', 'confirmed')->sum('tickets_count'),
        ];

        $registrations = Registration::orderBy('created_at', 'desc')->get();

        // Build the attendees array (for the full list)
        $attendees = $registrations->map(function ($r) {
            
            $initials = '';
            foreach (explode(' ', $r->name) as $part) {
                $initials .= strtoupper(substr($part, 0, 1));
            }
            return [
                'id' => $r->id,
                'name' => $r->name,
                'email' => $r->email,
                'phone' => (function() use ($r) {
                    $raw = $r->phone ?? '';
                    $digits = preg_replace('/\D+/', '', $raw);
                    if ($digits === '') return 'N/A';
                    if (strlen($digits) === 10) {
                        return '('.substr($digits,0,3).') '.substr($digits,3,3).'-'.substr($digits,6);
                    }
                    if (strlen($digits) === 11 && $digits[0] === '1') {
                        return '+1 ('.substr($digits,1,3).') '.substr($digits,4,3).'-'.substr($digits,7);
                    }
                    return $raw;
                })(),
                'tickets' => $r->tickets_count ?? 1,
                'status' => $r->status === 'confirmed' ? 'confirmed' : 'pending',
                'date' => $r->created_at->format('Y-m-d'),
                'initials' => $initials ?: '??',
            ];
        });

        // Recent registrations (last 5)
        $recentRegistrations = $registrations->take(50)->map(function ($r) {
            $name = $r->full_name ?? $r->first_name . ' ' . $r->last_name ?? $r->name ?? 'Attendee';
            $initials = '';
            foreach (explode(' ', $name) as $part) {
                $initials .= strtoupper(substr($part, 0, 1));
            }
            return [
                'id' => $r->id,
                'name' => $name,
                'phone' => (function() use ($r) {
                    $raw = $r->phone ?? '';
                    $digits = preg_replace('/\D+/', '', $raw);
                    if ($digits === '') return 'N/A';
                    if (strlen($digits) === 10) {
                        return '('.substr($digits,0,3).') '.substr($digits,3,3).'-'.substr($digits,6);
                    }
                    if (strlen($digits) === 11 && $digits[0] === '1') {
                        return '+1 ('.substr($digits,1,3).') '.substr($digits,4,3).'-'.substr($digits,7);
                    }
                    return $raw;
                })(),
                'email' => $r->email,
                'time' => $r->created_at->diffForHumans(),
                'initials' => $initials ?: '??',
                'status' => $r->status,
            ];
        });

        return view('admin-dashboard', compact('stats', 'attendees', 'recentRegistrations'));
    }

    public function confirm(Request $request, $id)
    {
        $registration = Registration::findOrFail($id);
        $registration->status = 'confirmed';
        $registration->save();

        Mail::to($registration->email)->send(new ConfirmationMail($registration));


        return redirect()->route('admin.dashboard')->with('success', 'Registration confirmed.');
    }

    public function sendReminder(Request $request)
    {
        $request->validate([
            'heading' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        $attendees = Registration::where('status', 'confirmed')->get(); // or all registrations

        foreach ($attendees as $attendee) {
            Mail::to($attendee->email)->send(new AnnouncementMail($request->heading, $request->message, $attendee));
        }

        return redirect()->route('admin.dashboard')->with('announcement_sent', true);
    }
}