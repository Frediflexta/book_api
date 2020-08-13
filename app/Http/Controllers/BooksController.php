<?php

namespace App\Http\Controllers;

use App\Models\Book;

use Illuminate\Http\Request;
use App\Http\Requests\CreateBookRequest;
use App\Http\Requests\UpdateBookRequest;
use App\Repositories\BooksInterface;

class BooksController extends Controller
{
    protected $booksServices;

    public function __construct(BooksInterface $booksServices)
    {
        $this->booksServices = $booksServices;
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json([
            'status_code' => 200,
            'status' => 'success',
            'data' => $this->booksServices->displayAllBooks()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateBookRequest $request)
    {
        $newlyCreatedBook = $this->booksServices->createBooks($request);
        
        return response()->json([
            'status_code' => 201,
            'status' => 'success',
            'data' => $newlyCreatedBook
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
    {
        return response()->json([
            'status_code' => 200,
            'status' => 'success',
            'data' => $this->booksServices->getOneBook($book)
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBookRequest $request, Book $book)
    {
        return response()->json([
            'status_code' => 200,
            'status' => 'success',
            'message' => 'Book updated successfully',
            'data' => $this->booksServices->updateABook($request, $book)
        ],200);
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
        return response()->json([
            'status_code' => 204,
            'status' => 'success',
            'message' => 'Book was deleted successfully',
            'data' => $this->booksServices->destroyABook($book)
        ],200);
    }

     /**
     * Display a book based on the queryString
     * of the user
     *
     * @return \Illuminate\Http\Response
     */
    public function showFireAndIceBooksByParam(Request $request)
    {
        $book = $this->booksServices->getQueryParamBook($request);
        return response()->json([
            'status_code' => 200,
            'status' => 'success',
            'data' => $book
        ],200);
    }
}
