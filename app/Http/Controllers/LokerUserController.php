<?php

namespace App\Http\Controllers;

use App\Models\Loker;
use App\Models\MagangUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Storage;

class LokerUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pageTitle = 'List Lowongan Kerja';

        $lokers = Loker::orderBy('created_at', 'desc')->get();

        return view('user.loker.index', compact('pageTitle', 'lokers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pageTitle = 'Create Loker';

        return view('user.loker.create', compact('pageTitle'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function nambahlokeruser(Request $request)
    {
        $messages = [
            'required' => ':Attribute harus diisi.',
            'mimes' => ':Attribute harus berupa file dengan tipe: :values.',
            'max' => ':Attribute harus tidak lebih dari :max kilobytes.',
        ];
    
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'durasi' => 'required',
            'magang_id' => 'required',
            'serial' => 'required',
            'bukti' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048' // Adjust file types and size as needed
        ], $messages);
    
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->first()], 422);
        }
    
        $lokerUser = new MagangUser();
        $lokerUser->nama = $request->nama;
        $lokerUser->durasi = $request->durasi;
        $lokerUser->magang_id = $request->magang_id;
        $lokerUser->serial = $request->serial;
    
        // Handle file upload
        if ($request->hasFile('bukti')) {
            $file = $request->file('bukti');
            $fileName = time() . '.' . $file->extension();
            $file->move(public_path('bukti_loker'), $fileName);
            $lokerUser->bukti = 'bukti_loker/' . $fileName;
        }
    
        $lokerUser->save();
    
        return response()->json(['success' => 'Magang User Added Successfully.'], 200);
    }
    
    public function store(Request $request)
    {
        $messages = [
            'required' => ':Attribute harus diisi.'
        ];
    
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'persyaratan' => 'required',
            'deskripsi' => 'required',
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ], $messages);
    
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    
        $loker = new Loker();
        $loker->name = $request->nama;
        $loker->requirement = $request->persyaratan;
        $loker->description = $request->deskripsi;
    
        $file = $request->file('foto');
        if ($file != null) {
            $imageName = time() . '.' . $file->extension();
            $file->move(public_path('poster_loker'), $imageName);
            $loker->image = 'poster_loker/' . $imageName;
        }
    
        $loker->save();
    
        Alert::success('Added Successfully', 'Lowongan Kerja Added Successfully.');
    
        return redirect()->route('user.loker');
    }
    

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $pageTitle = 'Loker Detail';

        $loker = Loker::find($id);

        return view('user.loker.show', compact('pageTitle', 'loker'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $pageTitle = 'Loker Edit';

        $loker = Loker::find($id);

        return view('user.loker.edit', compact('pageTitle', 'loker'));
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
    
        $loker = Loker::find($id);
        $loker->name = $request->nama;
        $loker->requirement = $request->persyaratan;
        $loker->description = $request->deskripsi;
    
        $file = $request->file('foto');
        if ($file != null) {
            $imageName = time() . '.' . $file->extension();
            $file->move(public_path('poster_loker'), $imageName);
            $loker->image = 'poster_loker/' . $imageName;
        }
    
        $loker->save();
    
        Alert::success('Changed Successfully', 'Lowongan Kerja Data Changed Successfully.');
    
        return redirect()->route('user.loker');
    }
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $loker = Loker::find($id);

        if ($loker->image) {
            Storage::delete('public/files/' . $loker->image);
        }

        $loker->delete();

        Alert::success('Deleted Successfully', 'Loker Data Deleted Successfully.');

        return redirect()->route('user.loker');
    }
}
