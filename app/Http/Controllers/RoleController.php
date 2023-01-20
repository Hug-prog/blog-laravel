<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Redirect;

class RoleController extends Controller
{
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function editPage(int $id){
        return Inertia::render('Role/edit',['user'=>User::find($id)]);
    }
    
    public function edit(Request $request,$id){
        
        
        $request->validate([
            'role' => ['required','string'],
        ]);

        $user = User::find($id);

        $user->role = $request['role'];

        $user->save();

        return Redirect::route('adminDashboard');

    }
}
