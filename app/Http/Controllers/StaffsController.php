<?php

namespace App\Http\Controllers;

use App\Models\Staffs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
class StaffsController extends Controller
{
    /**
     * Display a listing of the resource.
     */

     public function showLogin()
    {
        return view('staffs.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'staff_email' => 'required|email',
            'staff_password' => 'required',
        ]);
    
        $staff = Staffs::where('staff_email', $request->staff_email)->first();
    
        // Check if staff exists
        if (!$staff) {
            return back()->with('error', 'Invalid email or password.');
        }
    
        // Check if staff is inactive
        if ($staff->staff_status !== 'Active') {
            return back()->with('error', 'Your account is inactive. Please contact admin.');
        }
    
        // Check password
        if (Hash::check($request->staff_password, $staff->staff_password)) {
            // Store session info
            $request->session()->put('staff_id', $staff->staff_id);
            $request->session()->put('staff_name', $staff->staff_firstname . ' ' . $staff->staff_lastname);
            $request->session()->put('staff_role', $staff->staff_role);
    
            return redirect()->route('staffs.dashboard');
        }
    
        return back()->with('error', 'Invalid email or password.');
    }
    
    public function logout(Request $request)
    {
        $request->session()->flush();
        return redirect()->route('staffs.login')->with('success', 'Logged out successfully.');
    }
    
    public function dashboard()
    {
        if (!session()->has('staff_id')) {
            return redirect()->route('staffs.login')->with('error', 'Please login first.');
        }
    
        return view('staffs.dashboard');
    }

    public function index(Request $request)
    {
        // Check if staff is logged in
        if (!session()->has('staff_id')) {
            return redirect()->route('staffs.login')->with('error', 'Please login first.');
        }

        if (session('staff_role') !== 'Account Manager') {
            return redirect()->route('staffs.dashboard')->with('error', 'Access denied.');
        }
    
        // Get search keyword
        $search = $request->input('search');
    
        // Query staff list with optional search
        $staffs = Staffs::when($search, function ($query, $search) {
            $query->where('staff_firstname', 'like', "%{$search}%")
                  ->orWhere('staff_lastname', 'like', "%{$search}%")
                  ->orWhere('staff_email', 'like', "%{$search}%")
                  ->orWhere('staff_role', 'like', "%{$search}%");
        })->paginate(5);
    
        // Keep search query in pagination links
        $staffs->appends($request->only('search'));
    
        return view('staffs.index', ['staffs' => $staffs]);
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
            'contact'   => ['required', 'digits:11'],
            'email'     => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('staffs', 'staff_email'),
            ],
            'password'  => 'required|string|min:8|confirmed',
        ]);
    
        DB::transaction(function () use ($request) {
            Staffs::create([
                'staff_firstname' => $request->firstname,
                'staff_lastname'  => $request->lastname,
                'staff_role'      => $request->role,
                'staff_contact'   => $request->contact,
                'staff_email'     => $request->email,
                'staff_status'    => 'Active',
                'staff_password'  => bcrypt($request->password),
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
            'update_firstname' => 'required|string|max:255',
            'update_lastname'  => 'required|string|max:255',
            'update_role'      => 'required|string|max:255',
            'update_contact'   => 'required|digits:11',
            'update_email'     => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('staffs', 'staff_email')->ignore($staff->staff_id, 'staff_id'),
            ],
            'update_password'  => 'nullable|string|min:8|confirmed',
        ]);

        DB::transaction(function () use ($request, $staff) {
            $data = [
                'staff_firstname' => $request->update_firstname,
                'staff_lastname'  => $request->update_lastname,
                'staff_role'      => $request->update_role,
                'staff_email'     => $request->update_email,
                'staff_contact'   => $request->update_contact,
            ];

            if ($request->filled('update_password')) {
                $data['staff_password'] = bcrypt($request->update_password);
            }

            $staff->update($data);
        });

        return redirect('/staffs')->with('success', 'Account Updated Successfully!');
    }

    public function updateStatus(Request $request, $id)
    {
        $staff = Staffs::findOrFail($id);
        $staff->staff_status = $request->status;
        $staff->save();

        return redirect()->back()->with('success', 'Account status updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Staffs $staffs)
    {
        return view('staffs.destroy');
        
    }
}
