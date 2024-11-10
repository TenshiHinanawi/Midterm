<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ApiController extends Controller
{
    private $apiUrl = 'https://api.restful-api.dev/objects';

    //index
    public function index()
    {
        $response = Http::get($this->apiUrl);

        if ($response->successful()) {
            return response()->json($response->json(), 200);
        }

        return response()->json([
            'error' => 'Failed to fetch data'
        ], 500);
    }

    //putObject
    public function putObject(Request $request, $id)
    {
        $data = $request->all();
        $response = Http::put("{$this->apiUrl}/{$id}", $data);

        if ($response->successful()) {
            return response()->json($response->json(), 200);
        }

        return response()->json([
            'error' => 'Failed to update object'
        ], 400);
    }

    //patchObject
    public function patchObject(Request $request, $id)
    {
        $data = $request->all();
        $response = Http::patch("{$this->apiUrl}/{$id}", $data);

        if ($response->successful()) {
            return response()->json($response->json(), 200);
        }

        return response()->json([
            'message' => 'Failed to partially update object'
        ], 400);
    }

  ///deleteObject
    public function deleteObject($id)
    {
        $response = Http::delete("{$this->apiUrl}/{$id}");

        if ($response->successful()) {
            return response()->json([
                'message' => 'Object deleted successfully'
            ], 200);
        }

        return response()->json([
            'error' => 'Failed to delete object'
        ], 404);
    }

    //showAllItems
    public function showAllItems()
    {

        $response = Http::get($this->apiUrl);

        if ($response->successful()) {
            return view('index', ['items' => $response->json()]);
        }


        return view('index', ['error' => 'Failed to fetch items']);
    }


//Add
 public function create()
 {
     return view('create');
 }

 public function store(Request $request)
 {

     $request->validate([
         'name' => 'required|string|max:255',
         'data.color' => 'nullable|string|max:255',
         'data.capacity' => 'nullable|string|max:255',
         'data.price' => 'nullable|string|max:255',
     ]);


     $data = [
         'name' => $request->input('name'),
         'data' => $request->input('data', []),
     ];


     $response = Http::post($this->apiUrl, $data);


     if ($response->successful()) {

         $createdObject = $response->json();
         $objectId = $createdObject['id'];


         return redirect()->route('create')->with('success', "Item created successfully! Object ID: $objectId");
     }


     return redirect()->route('create')->with('error', 'Failed to create item.');
 }

//After adding, this function will check if the added stuff is really added, also to show the Obj. considering
//the limitations cuz API dont allow ID like 1 or 10, I should be done like yesterday then I found it out sunday
//😔😔😔😔😔
 public function getObject($id)
 {
     $response = Http::get("{$this->apiUrl}/{$id}");

     if ($response->successful()) {

         return response()->json($response->json(), 200);
     }

     return response()->json(['error' => 'Object not found'], 404);
 }





//Search & Delete
public function searchItem(Request $request)
{

    $id = $request->input('id');

    $response = Http::get("{$this->apiUrl}/{$id}");

    if ($response->successful()) {
        return view('search', ['item' => $response->json()]);
    }

    return view('search', ['error' => 'Item not found']);
}

public function deleteItem($id)
{
    $response = Http::delete("{$this->apiUrl}/{$id}");

    if ($response->successful()) {

        return redirect()->route('search')->with('success', 'Item deleted successfully!');
    }


    return redirect()->route('search')->with('error', 'Failed to delete the item.');
}

}







