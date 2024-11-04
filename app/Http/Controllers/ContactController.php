<?php

namespace App\Http\Controllers;

use App\Models\contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Post;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

     public function store(Request $request)
     {
         $request->validate([
             'Nama' => 'required',
             'Email' => 'required|max:128',
             'Pesan' => 'nullable|max:555',
         ]);
     
         $users = $request->all();
         $users['user_id'] = Auth::id();
     
         $contact = Contact::create($users);
     
         return redirect()->route('contact')->with('success', 'Pesan berhasil dikirim.');
     }


    // public function store(Request $request)
    // {
    //     $request->validate(
    //         [
    //             'Nama' => 'required',
    //             'Email' => 'required|max:128',
    //             'Pesan' => 'nullable|max:555',
    //         ], 
    //     );
    //     $contact = contact::create($request->all());
    //     return redirect()->route('contact');
    // }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}