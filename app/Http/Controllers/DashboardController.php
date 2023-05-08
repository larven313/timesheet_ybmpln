<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Notification;
use App\Models\Activity;
use App\Models\Department;
use App\Models\Position;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Notifications\Action;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $activities2 = null;
        $no2 = null;
        $status_activity = null;

        $batas = 10;
        $profile = Profile::where('id', auth()->user()->profile_id)->first();
        $notif = Notification::with(['activity'])->get();
        $total = Activity::with(['user', 'notification', 'type'])->count();
        $total_user = User::with(['activities', 'department', 'profile'])->count();
        $status = User::with(['activities', 'department', 'profile'])->paginate($batas);
        $no = $batas * ($status->currentPage() - 1);
        $user = User::with(['activities', 'department', 'profile'])
            ->where('username', auth()->user()->username)
            ->first();
        // $query = Activity::with(['user', 'type'])->where('user_id', $user->id);



        if (auth()->user()->role == 'admin') {
            $status_activity = Activity::with(['user', 'notification', 'type'])
                ->select('users.name', 'users.username', 'users.id', DB::raw('SUM(activities.time) as time'))
                ->join('users', 'users.id', '=', 'activities.user_id')
                ->whereDate('activities.date', Carbon::now()->format('Y-m-d'))
                ->groupBy('users.id', 'users.name', 'users.username')
                ->paginate($batas);

            $activities2 = Activity::with(['user', 'type'])
                ->orderBy('date', 'DESC');

            if (request()->tgl_awal && request()->tgl_akhir && request()->filter == null) {
                $activities2->whereBetween('date', [request()->tgl_awal, request()->tgl_akhir]);
            } else if (request()->filter) {
                request()->tgl_awal = null;
                request()->tgl_akhir = null;
                switch (request()->input('filter')) {
                    case 'today':
                        $activities2->whereDate('date', Carbon::today()->toDateString());
                        break;
                    case 'this_week':
                        $batas = 15;
                        $activities2->whereBetween('date', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]);
                        break;
                    case 'this_month':
                        $batas = 20;
                        $activities2->whereMonth('date', Carbon::now()->month);
                        break;
                    default:
                        $activities2->whereDate('date', Carbon::today()->toDateString());
                }
            }
            $activities2 = $activities2->paginate($batas);



            $user = User::with(['activities', 'department', 'profile'])
                ->where('username', auth()->user()->username)->first();

            $query = Activity::with(['user'])
                ->select('users.name', 'users.id',  'activities.date',  DB::raw('SUM(activities.time) as time'))
                ->join('users', 'activities.user_id', '=', 'users.id')
                ->where('activities.user_id', $user->id)
                ->groupBy('users.id', 'users.name',  'activities.date',);


            $data = $query->orderBy('date', 'desc')->simplePaginate($batas);
            $no2 = $batas * ($data->currentPage() - 1);
        } else if (auth()->user()->role == 'validator') {
            $status_activity = Activity::with(['user', 'notification', 'type'])
                ->select('users.name', 'users.username', 'users.id', DB::raw('SUM(activities.time) as time'))
                ->join('users', 'users.id', '=', 'activities.user_id')
                ->join('profiles', 'profiles.id', '=', 'users.profile_id')
                ->where('profiles.department_id', $profile->department_id)
                ->whereDate('activities.date', Carbon::now()->format('Y-m-d'))
                ->groupBy('users.id', 'users.name', 'users.username')
                ->paginate($batas);

            $activities2 = Activity::with(['user', 'type'])
                ->join('users', 'users.id', '=', 'activities.user_id')
                ->join('profiles', 'profiles.id', '=', 'users.profile_id')
                ->where('profiles.department_id', $profile->department_id)
                // ->whereBetween('date', [request()->tgl_awal, request()->tgl_akhir])
                ->orderBy('date', 'DESC');

            if (request()->tgl_awal && request()->tgl_akhir && request()->filter == null) {
                $activities2->whereBetween('date', [request()->tgl_awal, request()->tgl_akhir]);
            } else if (request()->filter) {
                request()->tgl_awal = null;
                request()->tgl_akhir = null;

                switch (request()->input('filter')) {
                    case 'today':
                        $activities2->whereDate('date', Carbon::today()->toDateString());
                        break;
                    case 'this_week':
                        $batas = 15;
                        $activities2->whereBetween('date', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]);
                        break;
                    case 'this_month':
                        $batas = 20;
                        $activities2->whereMonth('date', Carbon::now()->month);
                        break;
                    default:
                        $activities2->whereDate('date', Carbon::today()->toDateString());
                }
            }

            $activities2 = $activities2->paginate($batas);

            // $activities2 = Activity::with(['user', 'type'])
            //     ->join('users', 'users.id', '=', 'activities.user_id')
            //     ->join('profiles', 'profiles.id', '=', 'users.profile_id')
            //     ->where('profiles.department_id', $profile->department_id)
            //     ->orderBy('date', 'DESC')->paginate($batas);
            $no2 = $batas * ($activities2->currentPage() - 1);
        }
        $query = Activity::with(['user'])
            ->select('users.name', 'users.id', 'activities.date', DB::raw('SUM(activities.time) as time'))
            ->join('users', 'activities.user_id', '=', 'users.id')
            ->where('activities.user_id', $user->id)
            ->groupBy('users.id', 'users.name', 'activities.date');



        if (request()->tgl_awal && request()->tgl_akhir && request()->filter == null) {
            $query->whereBetween('date', [request()->tgl_awal, request()->tgl_akhir]);
        } else if (request()->filter) {
            request()->tgl_awal = null;
            request()->tgl_akhir = null;
            switch (request()->input('filter')) {
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
        }
        $data = $query->orderBy('date', 'desc')->simplePaginate($batas);
        $no = $batas * ($data->currentPage() - 1);




        $total_departemen = Department::count();
        $total_jabatan = Position::count();
        if (auth()->user()->role === 'user') {
            $total_aktivitas = Activity::with(['user', 'notification', 'type'])
            ->where('user_id',auth()->user()->id)
            ->whereDate('activities.date', Carbon::today())
            ->count();
        } else {
            $total_aktivitas = Activity::with(['user', 'notification', 'type'])
            ->whereDate('activities.date', Carbon::today())
            ->count();
        }
        

        $total_aktivitas_user = Activity::with(['user', 'notification', 'type'])
            ->where('user_id', auth()->user()->id)
            ->whereDate('activities.date', Carbon::today())
            ->count();



        return view('index', [
            'notifications' => $notif,
            'activities2' => $activities2,
            'no2' => $no2,
            'total' =>  $total,
            'statuss' => $status,
            'no' => $no,
            'status_activity' => $status_activity,
            'total_user' => $total_user,
            'total_departemen' => $total_departemen,
            'total_jabatan' => $total_jabatan,
            'total_aktivitas' => $total_aktivitas,
            'total_aktivitas_user' => $total_aktivitas_user,
            'activities' => $data,
            'user' => $user
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
