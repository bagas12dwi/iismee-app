<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function indexUser()
    {
        $mhs = Student::where('email', '=', auth()->user()->email)->firstOrFail();

        return view('mahasiswa.profil', [
            'title' => 'Profil',
            'data' => $mhs
        ]);
    }

    public function gantiFoto(Request $request)
    {
        $mhs = Student::where('email', '=', auth()->user()->email)->firstOrFail();

        $validatedData = $request->validate([
            'img_path' => 'image'
        ]);

        if ($request->file('img_path')) {
            if ($request->oldimg != null) {
                Storage::delete($request->oldimg);
            }
            $validatedData['img_path'] = $request->file('img_path')->store('foto-profil');
        }

        Student::where('id', '=', $mhs->id)->update($validatedData);
        return redirect()->intended('/profile-user')->with('success', 'Data Berhasil Diubah !');
    }
}
