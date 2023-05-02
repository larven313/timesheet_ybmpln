<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\User;
use App\Models\Notification;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $batas = 5;
        $data = Department::simplePaginate($batas);
        $no = $batas * ($data->currentPage() - 1);
        $total = Department::count();
        $notif = Notification::all();


        return view('department.index', [
            'departments' => $data,
            'total' => $total,
            'no' => $no,
            'notifications' => $notif
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::all();
        return view('department.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|min:4|max:120',
            'user_id' => 'required'
        ];
        $messages = [
            'required' => ':attribute tidak boleh kosong',
            'min' => 'karakter :attribute terlalu pendek',
            'max' => 'karakter :attribute terlalu panjang'
        ];
        $this->validate($request, $rules, $messages);


        Department::create([
            'name' => $request->name,
            'user_id' => $request->user_id
        ]);

        return redirect('/departemen')->with('success', 'Departemen berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Department $department)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $users = User::all();
        $departemen = Department::where('id', $id)->first();

        return view('department.edit', [
            'departments' => $departemen,
            'users' => $users
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $rules = [
            'name' => 'required|min:4|max:120',
            'user_id' => 'required'
        ];

        $messages = [
            'required' => ':attribute tidak boleh kosong',
            'min' => 'karakter :attribute terlalu pendek',
            'max' => 'karakter :attribute terlalu panjang'
        ];

        $this->validate($request, $rules, $messages);
        $departemen = Department::where('id', $id)->first();
        $oldData = User::where('id', $departemen->user_id)->first();
        $newData = User::where('id', $request->user_id)->first();

        if ($oldData->role == 'validator') {
            $departemen->update([
                'name' => $request->name,
                'user_id' => $request->user_id
            ]);

            $oldData->update([
                'role' => 'user'
            ]);

            // $newData->update([
            //     'role' => 'validator'
            // ]);
            $newData->update([
                'role' => $newData->role == 'admin' ? 'admin' : 'validator'
            ]);
        } elseif ($oldData->role == 'admin') {
            $departemen->update([
                'name' => $request->name,
                'user_id' => $request->user_id
            ]);

            $oldData->update([
                'role' => $oldData->role == 'admin' ? 'admin' : 'user'
            ]);

            $newData->update([
                'role' => 'validator'
            ]);
        } elseif ($newData->role == 'admin') {
            $departemen->update([
                'name' => $request->name,
                'user_id' => $request->user_id
            ]);

            $oldData->update([
                'role' => $oldData->role == 'admin' ? 'admin' : 'user'
            ]);
        }




        return redirect('/departemen')->with('success', 'Data berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $departemen = Department::find($id);
        $departemen->delete();

        return redirect('/departemen')->with('success', 'Data berhasil dihapus!');
    }
}
