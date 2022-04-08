<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $books = Book::with('authors')->get();
        return response()->json($books);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $authors_ids = json_decode($request->authors);
        $data = [
            'title' => $request->title,
            'description' => $request->description,
            'video_id' => $request->video_id,
        ];
        $book = Book::create($data);
        $book->authors()->attach($authors_ids);

        return response()->json($book->load('authors'), 201);
    }

    /**
     * Display the specified resource.
     *
     * @param Book $book
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Book $book)
    {
        return response()->json($book->load('authors'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, Book $book)
    {
        $authors_ids = json_decode($request->authors);
        $data = [
            'title' => $request->title,
            'description' => $request->description,
            'video_id' => $request->video_id,
        ];
        $book->update($data);
        $book->authors()->sync($authors_ids);

        return response()->json($book->load('authors'), 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Book $book)
    {
        $book->delete();

        return response()->json(null, 204);
    }
}
