<?php

namespace App\Http\Controllers;

use App\Models\Chirp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ChirpController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(){
        $chirps = Chirp::with('user')
        ->latest()
        ->take(50)
        ->get();
        return view('home', ['chirps'=>$chirps]);
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
        $validate = $request->validate([
          'message' => 'required|string|max:255',
        ],[
            'message.required' => 'Please write something in the chirp!',
            'message.max' => 'Chirp cannot exceed 255 characters or less!',
        ]);

        $chirp = Chirp::create([
            'message' => $validate['message'],
            'user_id' => null
        ]);
        Log::info('New Chirp created:',[
            'chirp_id' => $chirp->id,
            'message' => $chirp->message
        ]);
        return redirect('/')->with('success', 'Chirp created successfully !');
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
    public function edit(Chirp $chirp)
    {
        //
        return view('chirps.edit',compact('chirp'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Chirp $chirp)
    {
        //
        $validate = $request->validate([
            'message' => 'required|string|max:255',
        ],[
            'message.required' => 'Please write something in the chirp!',
            'message.max'=> 'Chirp cannot exceed 255 characters or less!',
        ]);
        $chirp = Chirp::update([
            'message' => $validate['message'],
            'user_id'=>null
        ]);
        Log::info('updated chirp',[
            'chirp_id' => $chirp->id,
            'message' => $chirp->message
        ]);
        return redirect('/'->with('success','Chirp updated successfully!'));
    }
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
