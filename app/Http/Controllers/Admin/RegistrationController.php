<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Registration;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use Symfony\Component\HttpFoundation\StreamedResponse;

class RegistrationController extends Controller
{
    public function index(Request $request): Response
    {
        $query = Registration::query()->latest();

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('full_name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('institution', 'like', "%{$search}%")
                  ->orWhere('paper_id', 'like', "%{$search}%");
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->input('status'));
        }

        if ($request->filled('category')) {
            $query->where('category', $request->input('category'));
        }

        $registrations = $query->paginate(15)->withQueryString();

        $stats = [
            'total' => Registration::count(),
            'pending' => Registration::where('status', 'pending')->count(),
            'confirmed' => Registration::where('status', 'confirmed')->count(),
            'rejected' => Registration::where('status', 'rejected')->count(),
        ];

        return Inertia::render('Admin/Registrations/Index', [
            'registrations' => $registrations,
            'filters' => $request->only(['search', 'status', 'category']),
            'stats' => $stats,
        ]);
    }

    public function update(Request $request, Registration $registration): RedirectResponse
    {
        $data = $request->validate([
            'status' => ['required', 'in:pending,confirmed,rejected,cancelled'],
        ]);

        $registration->update($data);

        return back()->with('success', "Registration status for {$registration->full_name} updated to {$registration->status}.");
    }

    public function destroy(Registration $registration): RedirectResponse
    {
        $name = $registration->full_name;
        $registration->delete();

        return back()->with('success', "Registration entry for '{$name}' has been deleted.");
    }

    public function exportCsv(): StreamedResponse
    {
        $registrations = Registration::latest()->get();

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="iscme_registrations_' . date('Y-m-d_H-i') . '.csv"',
        ];

        $callback = function () use ($registrations) {
            $file = fopen('php://output', 'w');
            fputcsv($file, ['ID', 'Full Name', 'Email', 'Institution', 'Category', 'Paper ID', 'Status', 'IP Address', 'Registered At']);

            foreach ($registrations as $row) {
                fputcsv($file, [
                    $row->id,
                    $row->full_name,
                    $row->email,
                    $row->institution,
                    $row->category,
                    $row->paper_id ?? 'N/A',
                    strtoupper($row->status),
                    $row->ip_address ?? 'N/A',
                    $row->created_at->format('Y-m-d H:i:s'),
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
