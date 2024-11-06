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
        $contact = Contact::orderBy('created_at', 'desc')->get();
        return view('admin.contact.index', compact('contact'));
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
         $validateData = $request->validate([
             'Nama' => 'required|string|max:255',
             'Email' => 'required|email|max:128',
             'Pesan' => 'nullable|string|max:555',
         ]);
     
         $contact = new contact;
         $contact->Nama = $validateData['Nama'];
         $contact->Email = $validateData['Email'];
         $contact->Pesan = $validateData['Pesan'];
     
         if (Auth::check()) {
             $contact->user_id = Auth::id();
         }
     
         if ($contact->save()) {
             return redirect()->route('hotel')->with('success', 'Pesan berhasil dikirim.');
         } else {
             return back()->with('error', 'Pesan gagal dikirim.');
         }
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