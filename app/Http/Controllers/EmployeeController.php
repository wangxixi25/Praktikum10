<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Models\Employee;
use App\Models\Position;


class EmployeeController extends Controller
{

    public function home()
    {
        $pageTitle = 'Home Page';
        return view('home', compact('pageTitle'));
    }

    // index Eloquent
    public function index()
    {
        $pageTitle = 'Employee List';

        // ELOQUENT
        $employees = Employee::all();

        return view('employee.index', [
            'pageTitle' => $pageTitle,
            'employees' => $employees
        ]);
    }

    // Create Eloquent
    public function create()
    {
        $pageTitle = 'Create Employee';

        // ELOQUENT
        $positions = Position::all();

        return view('employee.create', compact('pageTitle', 'positions'));
    }

    // Store Eloquent
    public function store(Request $request)
    {
        $messages = [
            'prCode.required' => 'Kode Barang harus diisi.',
            'prName.required' => 'Nama Barang harus diisi.',
            'prPay.required' => 'Harga Barang harus diisi.',
            'prPay.numeric' => 'Isi Harga Barang dengan angka.',
            'prDesc.required' => 'Deskripsi Barang harus diisi.',
            'prUnit.required' => 'Unit Barang harus diisi.',
        ];

        $validator = Validator::make($request->all(), [
            'firstName' => 'required',
            'lastName' => 'required',
            'email' => 'required|email',
            'age' => 'required|numeric',
        ], $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // ELOQUENT
        $employee = New Employee;
        $employee->firstname = $request->firstName;
        $employee->lastname = $request->lastName;
        $employee->email = $request->email;
        $employee->age = $request->age;
        $employee->position_id = $request->position;
        $employee->save();

        return redirect()->route('employees.index');
    }

    // Show Eloquent
    public function show(string $id)
    {
        $pageTitle = 'Employee Detail';

        // ELOQUENT
        $employee = Employee::find($id);

        return view('employee.show', compact('pageTitle', 'employee'));
    }

    // Edit
    public function edit(string $id)
    {
        $pageTitle = 'Edit Employee';

        // ELOQUENT
        $positions = Position::all();
        $employee = Employee::find($id);

        return view('employee.edit', compact('pageTitle', 'positions', 'employee'));
    }

    // Update

    public function update(Request $request, string $id)
    {
        $messages = [
            'required' => ':Attribute harus diisi.',
            'email' => 'Isi :attribute dengan format yang benar',
            'numeric' => 'Isi :attribute dengan angka'
        ];

        $validator = Validator::make($request->all(), [
            'firstName' => 'required',
            'lastName' => 'required',
            'email' => 'required|email',
            'age' => 'required|numeric',
        ], $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // ELOQUENT
        $employee = Employee::find($id);
        $employee->firstname = $request->firstName;
        $employee->lastname = $request->lastName;
        $employee->email = $request->email;
        $employee->age = $request->age;
        $employee->position_id = $request->position;
        $employee->save();

        return redirect()->route('employees.index');
    }

    // DELET
    public function destroy(string $id)
    {
        // ELOQUENT
        Employee::find($id)->delete();

        return redirect()->route('employees.index');
    }


    // RAW SQL

    // public function index()
    // {
    //     $pageTitle = 'Employee List';

    //     // RAW SQL QUERY
    //     $employees = DB::select('
    //         select *, employees.id as employee_id, positions.name as position_name
    //         from employees
    //         left join positions on employees.position_id = positions.id
    //     ');

    //     return view('employee.index', [
    //         'pageTitle' => $pageTitle,
    //         'employees' => $employees
    //     ]);
    // }

    // Query
    // public function index()
    // {
    //     $pageTitle = 'Employee List';

    //     $employees = DB::table('employees')
    //         ->select('employees.*', 'positions.name as position_name')
    //         ->leftJoin('positions', 'employees.position_id', '=', 'positions.id')
    //         ->get();

    //     return view('employee.index', compact('pageTitle', 'employees'));
    // }

    // RAW
    // public function create()
    // {
    //     $pageTitle = 'Create Employee';
    //     // RAW SQL Query
    //     $positions = DB::select('select * from positions');

    //     return view('employee.create', compact('pageTitle', 'positions'));
    // }

    // // Query
    // public function create()
    // {
    //     $pageTitle = 'Create Employee';

    //     $positions = DB::table('positions')->get();

    //     return view('employee.create', compact('pageTitle', 'positions'));
    // }


    //  public function store(Request $request)
    //  {
    //      $messages = [
    //          'required' => ':Attribute harus diisi.',
    //          'email' => 'Isi :attribute dengan format yang benar',
    //          'numeric' => 'Isi :attribute dengan angka'
    //      ];

    //      $validator = Validator::make($request->all(), [
    //          'firstName' => 'required',
    //          'lastName' => 'required',
    //          'email' => 'required|email',
    //          'age' => 'required|numeric',
    //      ], $messages);

    //      if ($validator->fails()) {
    //          return redirect()->back()->withErrors($validator)->withInput();
    //      }

    //      // INSERT QUERY
    //      DB::table('employees')->insert([
    //          'firstname' => $request->firstName,
    //          'lastname' => $request->lastName,
    //          'email' => $request->email,
    //          'age' => $request->age,
    //          'position_id' => $request->position,
    //      ]);

    //      return redirect()->route('employees.index');
    //  }


    // RAW
    // public function show(string $id)
    // {
    //     $pageTitle = 'Employee Detail';

    //     // RAW SQL QUERY
    //     $employee = collect(DB::select('
    //     select employees.*, positions.name as position_name, employees.first_name as firstName, employees.last_name as lastName, employees.email
    //     from employees
    //     left join positions on employees.position_id = positions.id
    //     where employees.id = ?
    // ', [$id]))->first();

    //     return view('employee.show', compact('pageTitle', 'employee'));
    // }


    // // Query
    // public function show(string $id)
    // {
    //     $pageTitle = 'Employee Detail';

    //     $employee = DB::table('employees')
    //         ->select('employees.*', 'positions.name as position_name', 'employees.first_name as firstName', 'employees.last_name as lastName', 'employees.email')
    //         ->leftJoin('positions', 'employees.position_id', '=', 'positions.id')
    //         ->where('employees.id', '=', $id)
    //         ->first();

    //     return view('employee.show', compact('pageTitle', 'employee'));
    // }


    // RAW
    // public function edit(string $id)
    // {
    //     $pageTitle = 'Edit Employee';

    //     // RAW SQL QUERY
    //     $employee = collect(DB::select("
    //     SELECT employees.*,
    //         positions.name AS position_name,
    //         employees.firstname AS firstName,
    //         employees.lastname AS lastName,
    //         employees.email,
    //         employees.id AS employee_id
    //         FROM employees
    //         LEFT JOIN positions ON employees.position_id = positions.id
    //         WHERE employees.id = ?
    //     ", [$id]))->first();

    //         // RAW SQL QUERY
    //         $positions = DB::select('select * from positions');

    //         return view('employee.edit', compact('pageTitle', 'employee', 'positions'));
    // }

    //Query
    // public function edit(string $id)
    // {
    //     $pageTitle = 'Edit Employee';

    //     $employee = DB::table('employees')
    //         ->select('employees.*', 'positions.name as position_name', 'employees.firstname as firstName', 'employees.lastname as lastName', 'employees.email', 'employees.id as employee_id')
    //         ->leftJoin('positions', 'employees.position_id', '=', 'positions.id')
    //         ->where('employees.id', '=', $id)
    //         ->first();

    //     $positions = DB::table('positions')
    //         ->select('*')
    //         ->get();

    //     return view('employee.edit', compact('pageTitle', 'employee', 'positions'));
    // }


    // /**
    //  * Update the specified resource in storage.
    //  */
    // public function update(Request $request, string $id)
    // {
    //     $messages = [
    //         'required' => ':Attribute harus diisi.',
    //         'email' => 'Isi :attribute dengan format yang benar',
    //         'numeric' => 'Isi :attribute dengan angka'
    //     ];

    //     $validator = Validator::make($request->all(), [
    //         'firstName' => 'required',
    //         'lastName' => 'required',
    //         'email' => 'required|email',
    //         'age' => 'required|numeric',
    //     ], $messages);

    //     if ($validator->fails()) {
    //         return redirect()->back()->withErrors($validator)->withInput();
    //     }

    //     // Update data
    //     DB::table('employees')
    //         ->where('id', $id)
    //         ->update([
    //             'firstname' => $request->firstName,
    //             'lastname' => $request->lastName,
    //             'email' => $request->email,
    //             'age' => $request->age,
    //         ]);

    //     return redirect()->route('employees.index');
    // }

    /**
     * Remove the specified resource from storage.
     */

    // public function destroy(string $id)
    // {
    //     // QUERY BUILDER
    //     DB::table('employees')
    //         ->where('id', $id)
    //         ->delete();

    //     return redirect()->route('employees.index');
    // }


}
