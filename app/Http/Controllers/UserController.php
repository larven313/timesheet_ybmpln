<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Department;
use App\Models\Notification;
use App\Models\Position;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Date;
use Carbon\Carbon;
use Illuminate\Support\Facades\File;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $batas = 8;
        $searchTerm = request('search');
        $notif = Notification::with('activity')->get();
        if (auth()->user()->role == 'admin') {
            $users = User::when($searchTerm, function ($query, $searchTerm) {
                return $query->where('name', 'like', "%{$searchTerm}%")
                    ->orWhere('username', 'like', "%{$searchTerm}%")
                    ->orWhere('email', 'like', "%{$searchTerm}%");
            })->with(['activities', 'department', 'profile'])
                ->paginate($batas);
        } elseif (auth()->user()->role == 'validator') {
            $users = User::join('profiles', 'profiles.id', '=', 'users.profile_id')
                ->when($searchTerm, function ($query, $searchTerm) {
                    return $query->where('name', 'like', "%{$searchTerm}%")
                        ->orWhere('username', 'like', "%{$searchTerm}%")
                        ->orWhere('email', 'like', "%{$searchTerm}%");
                })->with(['activities', 'department', 'profile'])
                ->where('profiles.department_id', auth()->user()->profile->department_id)
                ->paginate($batas);
        }



        return view('employee.index', [
            'users' => $users,
            'batas' => $batas,
            'item_awal' => $users->firstItem(),
            'item_akhir' => $users->lastItem(),
            'total' => $users->total(),
            'notifications' => $notif
        ]);
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $supervisors = User::with(['activities', 'department', 'profile'])->get();
        $supervisor_default = User::with(['activities', 'department', 'profile'])->where('id', '1')->first();

        $departments = Department::with(['user', 'profile'])->get();
        $department_default = Department::where('id', '1')->first();

        return view('employee.create', [
            'supervisors' => $supervisors,
            'supervisor_default' => $supervisor_default,
            'departments' => $departments,
            'department_default' => $department_default
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $rules = [
            'name' => 'required|min:4|max:30',
            'username' => 'required|min:3|max:20',
            'email' => 'required|min:5|max:45|email',
            'password' => 'required|min:3|max:30',
            'role' => 'required',
        ];
        $messages = [
            'required' => ':attribute tidak boleh kosong',
            'min' => 'karakter :attribute terlalu pendek',
            'max' => 'karakter :attribute terlalu panjang',
            'email' => 'format email tidak benar',
            'image' => 'file harus gambar !'
        ];
        $this->validate($request, $rules, $messages);

        Profile::create([
            'address' => 'Pancoran Mas, Depok',
            'nip' => fake()->unique()->numerify('############'),
            'image' => null,
            'department_id' =>  $request->department_id == null ? 1 : $request->department_id
        ]);

        $latest_id = Profile::latest('id')->first();

        $notifications = session('notifications');

        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'profile_id' => $latest_id->id,
            'role' => $request->role == null ? 'user' : $request->role
        ]);

        return redirect('/pegawai')->with('success', 'Pegawai berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $username, Request $request)
    {
        $user = User::with(['activities', 'department', 'profile'])->where('username', $username)->first();

        if (auth()->user()->role != 'admin' && auth()->user()->username != $username) {
            if (auth()->user()->role == 'validator' && auth()->user()->profile->department_id == $user->profile->department_id) {
                # code...
            } else {
                return abort(403);
            }
        }
        $batas = 10;
        $department_id = $user->profile->department_id;
        $total_staff = User::whereHas('profile', function ($query) use ($department_id) {
            $query->where('department_id', $department_id);
        })->count();

        $query = Activity::with(['user', 'type'])->where('user_id', $user->id);

        switch ($request->input('filter')) {
            case 'today':
                $query->whereDate('date', Carbon::today()->toDateString());
                break;
            case 'this_week':
                $batas = 15;
                $query->whereBetween('date', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]);
                break;
            case 'this_month':
                $batas = 20;
                $query->whereMonth('date', Carbon::now()->month);
                break;
            default:
                $query->whereDate('date', Carbon::today()->toDateString());
        }

        $data = $query->orderBy('date', 'desc')->simplePaginate($batas);
        $no = $batas * ($data->currentPage() - 1);
        $jmlh_waktu = $query->sum('time');

        return view('employee.show', [
            'user' => $user,
            'total' => $total_staff,
            'activities' => $data,
            'no' => $no,
            'time' => $jmlh_waktu,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $username)
    {
        $user = User::where('username', $username)->first();
        $profile = Profile::where('id', $user->profile_id)->first();
        $departments = Department::all();
        $positions = Position::all();

        return view('employee.edit', [
            'user' =>  $user,
            'profile' => $profile,
            'positions' => $positions,
            'departments' => $departments
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $username)
    {
        $rules = [
            'name' => 'required|min:4|max:30',
            'username' => 'required|min:3|max:20',
            'email' => 'required|min:5|max:45|email',
            'password' => $request->password == null ? 'max:30' : 'required|min:3|max:30',
            'role' => 'required',
            'image' => 'image|file|max:1024'

        ];

        $messages = [
            'required' => ':attribute tidak boleh kosong',
            'min' => 'karakter :attribute terlalu pendek',
            'max' => 'karakter :attribute terlalu panjang',
            'email' => 'format email tidak benar',
            'image' => 'file harus gambar !'
        ];
        $this->validate($request, $rules, $messages);
        if ($request->password) {
            $request->merge(['password' => Hash::make($request->password)]);
        }

        $oldData = User::where('username', $username)->first();
        $profile = Profile::where('id', $oldData->profile_id)->first();




        $profile->update([
            'address' => $request->alamat,
            'nip' => $request->nip,
            'department_id' => $request->departemen == null ? $profile->department_id : $request->departemen,
            'position_id' => $request->jabatan == null ? $profile->position_id : $request->jabatan
        ]);

        $gambarLama = $profile->image;
        if (!$request->image) {
            $profile->image = $gambarLama;
        } else {
            if ($request->image != $gambarLama) {

                $image_path = "img/" . $gambarLama;
                File::delete($image_path);

                $nm = $request->image;
                $namaFile = time() . rand(100, 999) . "." . $nm->getClientOriginalExtension();
                $profile->image = $namaFile;
                $nm->move(public_path() . '/img', $namaFile);
            } else {
                $request->image->move(public_path() . '/img', $gambarLama);
            }
        }

        $profile->save();
        $oldData->update([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => $request->password == null ? $oldData->password : $request->password,
            'role' => $request->role == null ? 'user' : $request->role
        ]);
        return redirect(auth()->user()->role == 'admin' ? '/pegawai' : '/')->with('success', 'Data berhasil diubah!');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $username)
    {

        $id_user = User::where('username', $username)->first();
        $image_path = "img/" . $id_user->image;
        if (File::exists($image_path)) {
            File::delete($image_path);
        }

        User::destroy($id_user->id);
        Profile::destroy($id_user->id);

        return redirect('/pegawai')->with('success', 'Berhasil menghapus pegawai');
    }
}
