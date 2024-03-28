<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LeaveMaster;
use App\Models\EmployeeLeaveMaster;
use App\Models\LeaveBalance;
use App\Models\EmployeeMaster;

class LeaveController extends Controller
{
    public function showLeaveForm()
    {
        $leaveTypes = LeaveMaster::get();
        return view('leave.form', compact('leaveTypes'));
    }

    public function showLeaveList()
    {
        $leaveRecords = EmployeeLeaveMaster::where('employee_code', auth()->user()->employee_code)->get();
        return view('leave.list', compact('leaveRecords'));
    }

    public function submitLeave(Request $request)
    {

        $request->validate([
            'employee_code' => 'required',
            'from_date' => 'required|date',
            'to_date' => 'required|date|after_or_equal:from_date',
            'leave_type' => 'required',
            'comments' => 'required|max:300',
        ]);

        $employee_id=EmployeeMaster::where('employee_code',$request->employee_code)->first();
        $leaveBalance = LeaveBalance::where('emp_id', $employee_id)->first();

    if (!$leaveBalance) {
        return back()->withInput()->with('error', 'Leave balance not found for the employee.');
    }

    if ($leaveBalance->leave_balance < $request->number_of_days) {
        return back()->withInput()->with('error', 'Insufficient leave balance.');
    }
    
        EmployeeLeaveMaster::create([
            'employee_code' => $request->employee_code,
            'leaveType' => $request->leave_type,
            'fromdate' => $request->from_date,
            'todate' => $request->to_date,
            'numberofDays' => $this->calculateNumberOfDays($request->from_date, $request->to_date),
            'comment' => $request->comments,
        ]);

        // Deduct leave balance
        $employee_id=EmployeeMaster::where('employee_code',$request->employee_code)->first();
        $numberOfDays = $this->calculateNumberOfDays($request->from_date, $request->to_date);
        $leaveBalance = LeaveBalance::where('leavetype', $request->leave_type)->where('employeecode', $request->employee_code)
        ->first();

        $leaveBalance->leavebalance -= $numberOfDays;
        $leaveBalance->save();
    
        return redirect()->route('leave.list')->with('success', 'Leave application submitted successfully.');
    }
    
    private function calculateNumberOfDays($fromDate, $toDate) {
        $startDate = \Carbon\Carbon::parse($fromDate);
        $endDate = \Carbon\Carbon::parse($toDate);
        return $endDate->diffInDays($startDate) + 1; 
    }


}
