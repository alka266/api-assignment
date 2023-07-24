<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Person;

class PersonController extends Controller
{
    public function index()
    {
        $persons = Person::select('name', 'description', 'type')->paginate(10);
        return response()->json($persons);
    }

     // Create person resource.
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string', # add length validation, max 50
            'description' => 'required|string', # add length validation, max 250
            'type' => 'required|integer',
            'file' => 'required|file', # Add file size validation, size 50 MB
        ]);

        $person = new Person();
        $person->name = $request->name;
        $person->type = $request->type;
        $person->description = $request->description;
        $person->file = $request->file;
        
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('private', $filename, 'local');
            $person->file = $filename;
        }

        $person->save();

        return response()->json([
            'name' => $person->name,
            'type' => $person->type,
            'description' => $person->description,
        ], 201);
    }

     // Return single person resource.
    public function show(string $id)
    {
        $person = Person::findOrFail($id);
        return response()->json([
            'name' => $person->name,
            'type' => $person->type,
            'description' => $person->description,
            'image_url' => asset('storage/private/' . $person->file),
        ]);
    }
}
