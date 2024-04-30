<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::all();
        return view('books.index', compact('books'));
    }

    public function create()
    {
        return view('books.create');
    }

    public function store(Request $request)
    {
        // Validate form inputs
        $request->validate([
            'title' => 'required|string|max:255',
            'writer' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Max 2MB
            'price' => 'required|numeric',
            'tags' => 'required|string|max:255',
            'quantity' => 'required|numeric',
            'description' => 'required|string|max:255',
        ]);

        // Handle file upload
        $imagePath = $request->file('image')->store('book_images', 'public');

        // Create a new book instance
        $book = new Book();
        $book->title = $request->input('title');
        $book->writer = $request->input('writer');
        $book->image = $imagePath; // Store image path in the database
        $book->price = $request->input('price');
        $book->tags = $request->input('tags');
        $book->description = $request->input('description');
        $book->quantity = $request->input('quantity');
        $book->save();

        return redirect()->route('book.index')->with('success', 'Book registered successfully!');
    }

    public function edit($id)
    {
        $book = Book::find($id);
        return view('books.edit', compact('book'));
    }

    public function update(Request $request, $id)
    {
        // Find the book you want to update
        $book = Book::findOrFail($id);

        // Validate form inputs
        $request->validate([
            'title' => 'required|string|max:255',
            'writer' => 'required|string|max:255',
            'price' => 'required|numeric',
            'tags' => 'required|string|max:255',
            'quantity' => 'required|numeric',
            'description' => 'required|string|max:255',
        ]);

        // Update the book instance with new data
        $book->title = $request->input('title');
        $book->writer = $request->input('writer');
        $book->price = $request->input('price');
        $book->description = $request->input('description');
        $book->quantity = $request->input('quantity');
        $book->tags = $request->input('tags');

        // Handle file upload if an image is being updated
        if ($request->hasFile('image')) {
            // Validate and store the new image
            $request->validate([
                'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Max 2MB
            ]);
            $imagePath = $request->file('image')->store('book_images', 'public');
            // Delete the old image if it exists
            if ($book->image) {
                Storage::disk('public')->delete($book->image);
            }
            $book->image = $imagePath;
        }

        // Save the changes to the database
        $book->save();

        return redirect()->route('book.index')->with('success', 'Book Updated successfully!');
    }

    public function destroy($id)
    {
        $book = Book::find($id);
        $book->delete();
        return redirect()->route('book.index')->with('success', 'Book Deleted successfully!');
    }

}
