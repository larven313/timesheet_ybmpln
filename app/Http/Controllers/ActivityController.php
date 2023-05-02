<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Notification;
use App\Models\User;
use App\Models\ActivityType;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Notifications\ActivityAddedNotification;

class ActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $batas = 10;
        $id = Auth::user()->id;
        if (request()->tgl_awal && request()->tgl_akhir) {
            $data = Activity::where('user_id', $id)
                ->whereBetween('date', [request()->tgl_awal, request()->tgl_akhir])
                ->orderBy('date', 'desc')
                ->simplePaginate($batas);
        } else {
            $data = Activity::where('user_id', $id)
                ->orderBy('date', 'desc')
                ->simplePaginate($batas);
        }

        $no = $batas * ($data->currentPage() - 1);
        $total = Activity::where('user_id', $id)->count();
        $notif = Notification::all();
        return view('activity.index', [
            'activities' => $data,
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
        $types = ActivityType::all();
        $notif = Notification::all();

        return view('activity.create', [
            'types' => $types,
            'notifications' => $notif

        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules = [
            'activity' => 'required|min:4|max:200',
            'type_id' => 'required',
            'time' => 'required|digits_between:1,9|numeric|min:0',
            'date' => 'required|min:3|max:30',
            'user_id' => 'required'
        ];
        $messages = [
            'required' => ':attribute tidak boleh kosong',
            'min' => 'karakter :attribute terlalu pendek',
            'max' => 'karakter :attribute terlalu panjang',
            'numeric' => ':attribute harus angka'
        ];
        $this->validate($request, $rules, $messages);



        Activity::create([
            'activity' => $request->activity,
            'type_id' => $request->type_id == '' ? 2 : $request->type_id,
            'time' => $request->time,
            'date' => $request->date,
            'user_id' => $request->user_id
        ]);


        // $user = User::find($request->user_id); // Ambil data user yang melakukan tambah activity
        // $admin = User::where('email', 'hidayatullahsukma@gmail.com')->first(); // Ambil data admin (asumsi username admin adalah admin1)

        // // Buat notifikasi
        // if ($user) {
        //     $user->notify(new ActivityAddedNotification($admin));
        // }

        return redirect('/aktivitas')->with('success', 'Aktivitas berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $username)
    {
        $batas = 10;
        $id = Auth::user()->id;
        if (request()->tgl_awal && request()->tgl_akhir) {
            $data = Activity::join('users', 'users.id', '=', 'activities.user_id')
                ->where('users.username', $username)
                ->whereBetween('date', [request()->tgl_awal, request()->tgl_akhir])
                ->orderBy('date', 'desc')
                ->simplePaginate($batas);
        } else {
            $data = Activity::join('users', 'users.id', '=', 'activities.user_id')
                ->where('users.username', $username)
                ->orderBy('date', 'desc')
                ->simplePaginate($batas);
        }

        $no = $batas * ($data->currentPage() - 1);
        $total = Activity::join('users', 'users.id', '=', 'activities.user_id')
            ->where('users.username', $username)->count();
        $notif = Notification::all();

        // dd($username);

        return view('activity.index', [
            'activities' => $data,
            'total' => $total,
            'no' => $no,
            'notifications' => $notif
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $activity = Activity::find($id);
        $types = ActivityType::all();

        return view('activity.edit', [
            'aktivitas' => $activity,
            'types' => $types
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $rules = [
            'activity' => 'required|min:4|max:30',
            'type_id' => 'required',
            'time' => 'required|digits_between:1,9|numeric|min:0',
            'date' => 'required|min:3|max:30',
            'user_id' => 'required'
        ];

        $messages = [
            'required' => ':attribute tidak boleh kosong',
            'min' => 'karakter :attribute terlalu pendek',
            'max' => 'karakter :attribute terlalu panjang',
            'email' => 'format email tidak benar'
        ];
        $this->validate($request, $rules, $messages);

        $oldData = Activity::find($id);

        $oldData->update([
            'activity' => $request->activity,
            'type_id' => $request->type_id,
            'time' => $request->time,
            'date' => $request->date,
            'user_id' => $oldData->user_id
        ]);
        return redirect('/aktivitas')->with('success', 'Data berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $activity = Activity::findOrFail($id);
        $activity->delete();

        return redirect('/aktivitas')->with('success', 'Data berhasil dihapus!');
    }
}
