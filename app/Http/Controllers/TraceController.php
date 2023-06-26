<?php

namespace App\Http\Controllers;

use App\Models\Package;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use function PHPUnit\Framework\isNull;

class TraceController extends Controller
{
    public function search(Request $request)
    {
        $searchTerm = $request->input('search');
        $result = Package::where('pairing_code', $searchTerm)->first();

        if ($result) {
            $status = $result->status;
            if (Auth::check()) {
                $user = Auth::user();
                if ($result->email == $user->email) {
                    $result->user_id = $user->id;
                    $result->save();
                }
            }
        } else {
            $status = null;
        }

        return view('trace', compact('status'));
    }
}
