<?php

namespace App\Http\Controllers\Book;

use App\Http\Controllers\Controller;
use App\Models\Book\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index(){
        return view('backend.book.index');
    }

    public function add(){
        return view('backend.book.add');
    }

    public function store(Request $request){
        $book = new Book();
        $book = $request->name;
        $book = $request->barcode;
        $book->save();

        return redirect()->route('admin.book');
    }
}
