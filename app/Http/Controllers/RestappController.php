<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Movie;

class RestappController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return response()->json(
            [
                'users' => $users    
            ],
            200,[],
            JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = User::find(1);
        $movies =$user->movies;
        
        $data = [
            'movies' => $movies,  
        ];
        
        return view('rest.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'url' => 'required|max:11',
            'comment' => 'max:36',
        ]);
        
        User::find(1)->movies()->create([
            'url' => $request->url,
            'comment' => $request->comment,
        ]);
        
        $movies = User::find(1)->movies;
        
        return response()->json(
            [
                'movies' => $movies    
            ],
            200,[],
            JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT
        );
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        $movies = $user->movies;
        return response()->json(
            [
                'user' => $user,    
            ],
            200,[],
            JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT
        );
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
        $movie = Movie::find($id);
        $user = $movie->user;
        
        if ($user->id == 1) {
            $movie->delete();
        }
        
        $movies = $user->movies;
        
        return response()->json(
            [
                'movies' => $movies,    
            ],
            200,[],
            JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT
        );
    }
}
