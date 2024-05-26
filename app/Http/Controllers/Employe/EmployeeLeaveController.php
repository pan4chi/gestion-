<?php

namespace App\Http\Controllers\Employe;

use App\Models\Leave;
use App\Models\Employee;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class EmployeeLeaveController extends Controller
{
    public function __construct()
    {
        $this->middleware("employee");
    }
    public function index(Request $request)
    {
        $title = "Employee - Demandes de congees";
        $types = Leave::$type;
        $user = Auth::user();
        $leaves = Leave::where("employee_id", $user->employee->getId())->get() ?? [];
        return view('employe.leave.index', compact('title', 'types', 'leaves'));
    }

    public function store(Request $request)
    {
        Leave::Validate($request);
        Leave::create(
            [
                "employee_id" => Employee::where('user_id', Auth::id())->first()->getId(),
                "status" => "pending",
                "type" => $request->input('type'),
                'start_at' => $request->input('start_at'),
                'end_at' => $request->input('end_at')
            ]
        );

        return back()->with("success_msg", "le demand du congée est envoyer avec success attender jusque a l'administrateur repondre");
    }
}
