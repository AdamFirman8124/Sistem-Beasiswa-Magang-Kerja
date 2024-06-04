<?php

namespace App\Http\Controllers;

use App\Models\Beasiswa;

use App\Models\BeasiswaUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Storage;

class BeasiswaUserController extends Controller
{
    public function index()
    {
        $pageTitle = 'List Beasiswa';
        $beasiswas = Beasiswa::orderBy('created_at', 'desc')->get();
        return view('user.beasiswa.index', compact('pageTitle', 'beasiswas'));
    }

    public function create()
    {
        $pageTitle = 'Create Beasiswa';
        return view('user.beasiswa.create', compact('pageTitle'));
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
    
        $beasiswa = new Beasiswa();
        $beasiswa->name = $request->nama;
        $beasiswa->requirement = $request->persyaratan;
        $beasiswa->description = $request->deskripsi;
    
        if ($request->hasFile('foto')) {
            $imageName = time() . '.' . $request->foto->extension();
            $request->foto->move(public_path('poster_beasiswa'), $imageName);
            $beasiswa->image = 'poster_beasiswa/' . $imageName;
        }
        
        $beasiswa->save();
    
        Alert::success('Added Successfully', 'Beasiswa Data Added Successfully.');
        return redirect()->route('user.beasiswa');
    }
    public function nambahbeasiswauser(Request $request)
    {
        $messages = [
            'required' => ':Attribute harus diisi.',
            'mimes' => ':Attribute harus berupa file dengan tipe: :values.',
            'max' => ':Attribute harus tidak lebih dari :max kilobytes.',
        ];
    
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'beasiswa_id' => 'required',
            'serial' => 'required',
            'bukti' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048' // Adjust file types and size as needed
        ], $messages);
    
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->first()], 422);
        }
    
        $beasiswaUser = new BeasiswaUser();
        $beasiswaUser->nama = $request->nama;
        $beasiswaUser->beasiswa_id = $request->beasiswa_id;
        $beasiswaUser->serial = $request->serial;
    
        // Handle file upload
        if ($request->hasFile('bukti')) {
            $file = $request->file('bukti');
            $fileName = time() . '.' . $file->extension();
            $file->move(public_path('bukti_beasiswa'), $fileName);
            $beasiswaUser->bukti = 'bukti_beasiswa/' . $fileName;
        }
    
        $beasiswaUser->save();
    
        return response()->json(['success' => 'Beasiswa User Added Successfully.'], 200);
    }
    

    public function show(string $id)
    {
        $pageTitle = 'Beasiswa Detail';
        $beasiswa = Beasiswa::find($id);
        return view('user.beasiswa.show', compact('pageTitle', 'beasiswa'));
    }

    public function edit(string $id)
    {
        $pageTitle = 'Beasiswa Edit';
        $beasiswa = Beasiswa::find($id);
        return view('user.beasiswa.edit', compact('pageTitle', 'beasiswa'));
    }

    public function update(Request $request, string $id)
    {
        $messages = [
            'required' => ':Attribute harus diisi.'
        ];
    
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'persyaratan' => 'required',
            'deskripsi' => 'required',
            'foto' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ], $messages);
    
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    
        $beasiswa = Beasiswa::find($id);
        $beasiswa->name = $request->nama;
        $beasiswa->requirement = $request->persyaratan;
        $beasiswa->description = $request->deskripsi;
    
        $file = $request->file('foto');
        if ($file != null) {
            $imageName = time() . '.' . $file->extension();
            $file->move(public_path('poster_beasiswa'), $imageName);
            $beasiswa->image = 'poster_beasiswa/' . $imageName;
        }
    
        $beasiswa->save();
    
        Alert::success('Changed Successfully', 'Beasiswa Data Changed Successfully.');
        return redirect()->route('user.beasiswa');
    }
    

    public function destroy(string $id)
    {
        $beasiswa = Beasiswa::find($id);
        if ($beasiswa->image) {
            Storage::delete('public/files/' . $beasiswa->image);
        }
        $beasiswa->delete();
        Alert::success('Deleted Successfully', 'Beasiswa Data Deleted Successfully.');
        return redirect()->route('user.beasiswa');
    }
}
