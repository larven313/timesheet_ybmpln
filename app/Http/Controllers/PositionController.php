<?php

namespace App\Http\Controllers;

use App\Models\Position;
use App\Models\Notification;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use PhpParser\Node\Expr\PostInc;

class PositionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $batas = 5;
        $positions = Position::simplePaginate($batas);
        $no = $batas * ($positions->currentPage() - 1);
        $total = Position::count();
        $notif = Notification::all();

        return view('position.index', [
            'positions' => $positions,
            'no' => $no,
            'total' => $total,
            'notifications' => $notif
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('position.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|min:4|max:120'
        ];
        $messages = [
            'required' => ':attribute tidak boleh kosong',
            'min' => 'karakter :attribute terlalu pendek',
            'max' => 'karakter :attribute terlalu panjang'
        ];
        $this->validate($request, $rules, $messages);


        Position::create([
            'name' => $request->name
        ]);

        return redirect('/jabatan')->with('success', 'Jabatan berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Position $position)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $position = Position::where('id', $id)->first();
        return view('position.edit', compact('position'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $rules = [
            'name' => 'required|min:4|max:120'
        ];

        $messages = [
            'required' => ':attribute tidak boleh kosong',
            'min' => 'karakter :attribute terlalu pendek',
            'max' => 'karakter :attribute terlalu panjang'
        ];
        $this->validate($request, $rules, $messages);
        $data = Position::where('id', $id);
        $data->update([
            'name' => $request->name
        ]);
        return redirect('/jabatan')->with('success', 'Data berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $jabatan = Position::find($id);
        $jabatan->delete();

        return redirect('/jabatan')->with('success', 'Data berhasil dihapus!');
    }

    public function deleteAll()
    {
        $jabatan = Position::all();
        $jabatan->delete();

        return redirect('/jabatan')->with('success', 'Data berhasil dihapus!');
    }
}
