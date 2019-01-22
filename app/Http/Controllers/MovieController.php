<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;
use App\Http\Resources\Movies;
use App\Http\Requests\MovieRequest;
use App\Http\Resources\Movies\MovieResource;
use App\Http\Resources\Movies\MovieCollection;
use Symfony\Component\HttpFoundation\Response;
use App\Exceptions\MovieRightsException;
use Auth;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth:api')->except('index','show');
    }


    public function index()
    {
        return MovieCollection::collection(Movie::paginate(15));
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
    public function store(MovieRequest $request)
    {
        $movie = new Movie;
        $movie->name = $request->name;
        $movie->lead_actor = $request->star_actor;
        $movie->description = $request->description;
        $movie->genre = $request->genre;

        $movie->save();

        return response([
            'data' => new MovieResource($movie),
            Response::HTTP_CREATED
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function show(Movie $movie)
    {
        return new MovieResource($movie);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function edit(Movie $movie)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Movie $movie)
    {
        $this->movieUserCheck($movie);

        $request['lead_actor'] = $request['star_actor'];
        unset($request['star_actor']);

        $movie->update($request->all());

        return response([
            'data' => new MovieResource($movie),
            Response::HTTP_CREATED
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function destroy(Movie $movie)
    {
        $this->movieUserCheck($movie);

        $movie->delete();

        return response(null,
            Response::HTTP_NO_CONTENT
        );
    }

    //to carry out check to ensure user is the one who posted the movie
    public function movieUserCheck($movie){

        if(Auth::id() !== $movie->user_id){

            throw new MovieRightsException;
        }
    }
}
