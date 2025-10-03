<?php

namespace App\Http\Controllers;

use App\Models\Staffs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
class StaffsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $staffs = Staffs::paginate(10);
        return view('staffs.index', [
            'staffs' => $staffs
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('staffs.create');
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'firstname' => 'required|string|max:255',
            'lastname'  => 'required|string|max:255',
            'role'      => 'required|string|max:255',
            'contact' => 'required|digits:11',
            'email'     => 'required|string|email|max:255|unique:staffs,staff_email',
            'password'  => 'required|string|max:255',
            'status'    => 'required|string|max:255',
        ]);
    
        DB::transaction(function () use ($request) {
            Staffs::create([
                'staff_firstname' => $request->firstname,
                'staff_lastname'  => $request->lastname,
                'staff_role'      => $request->role,
                'staff_email'     => $request->email,
                'staff_contact'   => $request->contact,
                'staff_password'  => bcrypt($request->password),
                'staff_status'    => $request->status,
            ]);
        });
    
        return redirect('/staffs')->with('success', 'Account Created Successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Staffs $staffs)
    {
        return view('staffs.show');
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Staffs $staff)
    {
        return view('staffs.edit', compact('staff'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Staffs $staff)
    {
        $request->validate([
            'firstname' => 'required|string|max:255',
            'lastname'  => 'required|string|max:255',
            'role'      => 'required|string|max:255',
            'contact' => 'required|digits:11',
            'email'     => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('staffs', 'staff_email')->ignore($staff->staff_id, 'staff_id'),
            ],
            'password'  => 'nullable|string|min:8|confirmed',
            'status'    => 'required|string|max:255',
        ]);

        DB::transaction(function () use ($request, $staff) {
            $data = [
                'staff_firstname' => $request->firstname,
                'staff_lastname'  => $request->lastname,
                'staff_role'      => $request->role,
                'staff_email'     => $request->email,
                'staff_contact'   => $request->contact,
                'staff_status'    => $request->status,
            ];

            if ($request->filled('password')) {
                $data['staff_password'] = bcrypt($request->password);
            }

            $staff->update($data);
        });

        return redirect('/staffs')->with('success', 'Account Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Staffs $staffs)
    {
        return view('staffs.destroy');
        
    }
}
