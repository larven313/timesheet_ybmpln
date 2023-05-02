<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        view()->composer('partials.header', function ($view) {
            $data = [
                'title' => 'Judul Halaman',
                'subtitle' => 'Sub Judul Halaman'
            ];

            $view->with('partials.header', $data);
        });
        $notif = Notification::orderBy('isRead', 'ASC')->get();
        $not_read = Notification::where('isRead', 0)->get();

        return view('partials.header', [
            'notifications' => $notif,
            'not_read' => $not_read
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
    public function show(Notification $notification)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Notification $notification)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $notification = Notification::find($id);
        $notification->update([
            'isRead' => '1'
        ]);

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $notif = Notification::findOrFail($id);
        $notif->delete($id);

        return redirect()->back();
    }
}
