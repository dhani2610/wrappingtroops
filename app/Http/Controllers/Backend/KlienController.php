<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Klien;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class KlienController extends Controller
{
    public $user;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user = Auth::guard('admin')->user();
            return $next($request);
        });
    }

    public function index()
    {
        if (is_null($this->user) || !$this->user->can('klien.view')) {
            abort(403, 'Sorry !! You are Unauthorized to view any klien !');
        }

        $data['page_title'] = 'Klien';
        $data['title_btn_create'] = 'Add Klien';
        $data['kliens'] = Klien::orderBy('created_at','desc')->get();
        return view('backend.pages.master-data.klien.index', $data);
    }

    public function generate()
    {
        // Cek Permission
        if (is_null($this->user) || !$this->user->can('klien.create')) {
            abort(403, 'Sorry !! You are Unauthorized to generate kliens !');
        }

        try {
            // Set Path Source (dari gambar) dan Destination (dari fungsi store bawaan)
            $sourcePath = public_path('assets-landing/fe/clients');
            $destinationPath = public_path('assets/img/klien/');

            // Pastikan folder source ada, jika tidak batalkan
            if (!File::isDirectory($sourcePath)) {
                return redirect()->back()->with('failed', 'Folder source tidak ditemukan di public/assets-landing/fe/clients');
            }

            // Buat folder destination jika belum ada
            if (!File::isDirectory($destinationPath)) {
                File::makeDirectory($destinationPath, 0755, true, true);
            }

            // Ambil semua file di dalam folder source
            $files = File::files($sourcePath);
            $count = 0;

            foreach ($files as $file) {
                // Ambil informasi file
                $title = pathinfo($file, PATHINFO_FILENAME); // Nama file tanpa ekstensi
                $extension = pathinfo($file, PATHINFO_EXTENSION); // Ekstensi

                // Filter hanya file gambar
                if (in_array(strtolower($extension), ['png', 'jpg', 'jpeg', 'webp'])) {

                    // Buat nama baru agar formatnya sama dengan fungsi store()
                    $newName = time() . '_' . $count . '.' . $extension;

                    // Copy file dari source ke destination
                    File::copy($file, $destinationPath . $newName);

                    // Insert ke Database Klien
                    $data = new Klien();
                    $data->title = $title;
                    $data->image = $newName;
                    $data->save();

                    $count++;
                }
            }

            session()->flash('success', "Berhasil meng-generate $count data klien dari folder clients!");
            return redirect()->back();

        } catch (\Throwable $th) {
            session()->flash('failed', $th->getMessage());
            return redirect()->back();
        }
    }

    public function store(Request $request)
    {
        if (is_null($this->user) || !$this->user->can('klien.create')) {
            abort(403, 'Sorry !! You are Unauthorized to create any kliens !');
        }

        try {
            $data = new Klien();
            $data->title = $request->title;
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $name = time() . '.' . $image->getClientOriginalExtension();
                $destinationPath = public_path('assets/img/klien/');
                $image->move($destinationPath, $name);
                $data->image = $name;
            }
            $data->save();

            session()->flash('success', 'Data has been created !!');
            return redirect()->back();

        } catch (\Throwable $th) {
            session()->flash('failed', $th->getMessage());
            return redirect()->back();
        }
    }


    public function update(Request $request, $id)
    {
        if (is_null($this->user) || !$this->user->can('klien.edit')) {
            abort(403, 'Sorry !! You are Unauthorized to edit any klien !');
        }

        try {
            $data = Klien::find($id);
            $data->title = $request->title;
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $name = time() . '.' . $image->getClientOriginalExtension();
                $destinationPath = public_path('assets/img/klien/');
                $image->move($destinationPath, $name);
                $data->image = $name;
            }

            $data->save();

            session()->flash('success', 'Data has been edited !!');
            return redirect()->back();
        } catch (\Throwable $th) {
            session()->flash('failed', $th->getMessage());
            return redirect()->back();
        }
    }

    public function destroy($id)
    {
        if (is_null($this->user) || !$this->user->can('klien.delete')) {
            abort(403, 'Sorry !! You are Unauthorized to delete any klien !');
        }

        try {
            $data = Klien::find($id);
            $data->delete();

            session()->flash('success', 'Data has been deleted !!');
            return redirect()->back();
        } catch (\Throwable $th) {
            session()->flash('failed', 'Data has failed deleted !!');
            return redirect()->back();
        }
    }
}
