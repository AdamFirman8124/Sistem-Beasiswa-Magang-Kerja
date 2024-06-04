<?php

namespace App\Http\Controllers;

use App\Models\Lomba;
use App\Models\LombaUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Storage;

class LombaUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // public function index()
    // {
    //     $pageTitle = 'List Lomba';

    //     $lombas = Lomba::orderBy('created_at', 'desc')->get();

    //     return view('user.lomba.index', compact('pageTitle', 'lombas'));
    // }
    public function index()
    {
        $pageTitle = 'List Lomba';
    
        $lombas = Lomba::select('lombas.*')
        ->leftJoin('data_lombauser', 'lombas.id', '=', 'data_lombauser.lomba_id')
        ->orderBy('lombas.created_at', 'desc')
        ->distinct()
        ->get();
    
    
        return view('user.lomba.index', compact('pageTitle', 'lombas'));
    }
    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pageTitle = 'Create Lomba';

        return view('user.lomba.create', compact('pageTitle'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $messages = [
            'required' => ':Attribute harus diisi.'
        ];
    
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'persyaratan' => 'required',
            'deskripsi' => 'required',
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Memvalidasi foto
        ], $messages);
    
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    
        $lomba = new Lomba();
        $lomba->name = $request->nama;
        $lomba->requirement = $request->persyaratan;
        $lomba->description = $request->deskripsi;
    
        $file = $request->file('foto');
        if ($file != null) {
            $imageName = time() . '.' . $file->extension();
            $file->move(public_path('poster_lomba'), $imageName);
            $lomba->image = 'poster_lomba/' . $imageName;
        }
    
        $lomba->save();
    
        Alert::success('Added Successfully', 'Lomba Added Successfully.');
    
        return redirect()->route('user.lomba');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $pageTitle = 'Lomba Detail';

        $lomba = Lomba::find($id);

        return view('user.lomba.show', compact('pageTitle', 'lomba'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $pageTitle = 'Lomba Edit';

        $lomba = Lomba::find($id);

        return view('user.lomba.edit', compact('pageTitle', 'lomba'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $messages = [
            'required' => ':Attribute harus diisi.'
        ];
    
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'persyaratan' => 'required',
            'deskripsi' => 'required',
        ], $messages);
    
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    
        $lomba = Lomba::find($id);
        $lomba->name = $request->nama;
        $lomba->requirement = $request->persyaratan;
        $lomba->description = $request->deskripsi;
    
        $file = $request->file('foto');
        if ($file != null) {
            $imageName = time() . '.' . $file->extension();
            $file->move(public_path('poster_lomba'), $imageName);
            $lomba->image = 'poster_lomba/' . $imageName;
        }
    
        $lomba->save();
    
        Alert::success('Changed Successfully', 'Lomba Changed Successfully.');
    
        return redirect()->route('user.lomba');
    }
    

    public function nambahlombauser(Request $request)
    {
        $messages = [
            'required' => ':Attribute harus diisi.',
            'mimes' => ':Attribute harus berupa file dengan tipe: :values.',
            'max' => ':Attribute harus tidak lebih dari :max kilobytes.',
        ];
    
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'juara' => 'required',
            'lomba_id' => 'required',
            'serial' => 'required',
            'bukti' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048' // Adjust file types and size as needed
        ], $messages);
    
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->first()], 422);
        }
    
        $lombaUser = new LombaUser();
        $lombaUser->nama = $request->nama;
        $lombaUser->juara = $request->juara;
        $lombaUser->serial = $request->serial;
        $lombaUser->lomba_id = $request->lomba_id;
    
        // Handle file upload
        if ($request->hasFile('bukti')) {
            $file = $request->file('bukti');
            $fileName = time() . '.' . $file->extension();
            $file->move(public_path('bukti_lomba'), $fileName);
            $lombaUser->bukti = 'bukti_lomba/' . $fileName;
        }
    
        $lombaUser->save();
    
        return response()->json(['success' => 'Lomba User Added Successfully.'], 200);
    }
    


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $lomba = Lomba::find($id);

        if ($lomba->image) {
            Storage::delete('public/files/' . $lomba->image);
        }

        $lomba->delete();

        Alert::success('Deleted Successfully', 'Lomba Data Deleted Successfully.');

        return redirect()->route('user.lomba');
    }
}
