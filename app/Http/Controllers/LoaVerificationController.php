<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LoaRequest;
use Illuminate\Support\Facades\View;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class LoaVerificationController extends Controller
{
    public function index()
    {
        return view('loa.verifikasi');
    }

    public function check(Request $request)
    {
        try {
            $no_reg = $request->no_reg;

            $loa = \App\Models\LoaRequest::with('journal')
                ->where('registration_number', $no_reg)
                ->first();

            if ($loa) {
                $html = view('loa.partials._verified', compact('loa'))->render();
                return response()->json(['data' => $html]);
            } else {
                $html = view('loa.partials._not_found')->render();
                return response()->json(['data' => $html]);
            }
        } catch (\Exception $e) {
            // DEBUG: tampilkan error detail di response
            return response()->json([
                'error' => true,
                'message' => 'Terjadi kesalahan saat memverifikasi.',
                'details' => $e->getMessage(), // <- ini penting!
                'trace' => $e->getTraceAsString(), // untuk dev
            ], 500);
        }
    }


    public function form()
    {
        return view('loa.verifikasi');
    }

    public function scan($no_reg)
    {
        $loa = LoaRequest::with('journal')->where('registration_number', $no_reg)->first();

        if (!$loa) {
            return view('loa.scan', ['status' => 'not_found']);
        }

        return view('loa.scan', [
            'status' => 'found',
            'loa' => $loa,
        ]);
    }
}
