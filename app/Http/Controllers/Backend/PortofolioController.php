<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Portofolio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class PortofolioController extends Controller
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
        if (is_null($this->user) || !$this->user->can('portofolio.view')) {
            abort(403, 'Sorry !! You are Unauthorized to view any portofolio !');
        }

        $data['page_title'] = 'Portofolio';
        $data['title_btn_create'] = 'Add Portofolio';
        $data['portofolios'] = Portofolio::orderBy('created_at','desc')->get();
        return view('backend.pages.master-data.portofolio.index', $data);
    }

    public function generate()
    {
        // 1. Cek Permission (Opsional, saya samakan dengan hak akses create)
        if (is_null($this->user) || !$this->user->can('portofolio.create')) {
            abort(403, 'Sorry !! You are Unauthorized to generate portofolios !');
        }

        try {
            // 2. Set Path Source (dari gambar) dan Destination (dari fungsi store bawaan)
            $sourcePath = public_path('assets-landing/fe/portofolio');
            $destinationPath = public_path('assets/img/Portofolio/');

            // Pastikan folder source ada, jika tidak batalkan
            if (!File::isDirectory($sourcePath)) {
                return redirect()->back()->with('failed', 'Folder source tidak ditemukan di public/assets-landing/fe/portofolio');
            }

            // Buat folder destination jika belum ada
            if (!File::isDirectory($destinationPath)) {
                File::makeDirectory($destinationPath, 0755, true, true);
            }

            // 3. Ambil semua file di dalam folder source
            $files = File::files($sourcePath);
            $count = 0;

            foreach ($files as $file) {
                // Ambil informasi file
                $title = pathinfo($file, PATHINFO_FILENAME); // Nama file tanpa ekstensi (Contoh: BFI)
                $extension = pathinfo($file, PATHINFO_EXTENSION); // Ekstensi (Contoh: png)

                // Filter hanya file gambar (opsional tapi disarankan)
                if (in_array(strtolower($extension), ['png', 'jpg', 'jpeg', 'webp'])) {

                    // Buat nama baru agar formatnya sama dengan fungsi store()
                    // Tambahkan $count agar waktu (time()) tidak bentrok karena proses loop sangat cepat
                    $newName = time() . '_' . $count . '.' . $extension;

                    // Copy file dari source ke destination
                    File::copy($file, $destinationPath . $newName);

                    // Insert ke Database
                    $data = new Portofolio();
                    $data->title = $title;
                    $data->image = $newName;
                    $data->save();

                    $count++;
                }
            }

            session()->flash('success', "Berhasil meng-generate $count data portofolio dari folder clients!");
            return redirect()->back();

        } catch (\Throwable $th) {
            session()->flash('failed', $th->getMessage());
            return redirect()->back();
        }
    }

    public function store(Request $request)
    {
        if (is_null($this->user) || !$this->user->can('portofolio.create')) {
            abort(403, 'Sorry !! You are Unauthorized to create any portofolios !');
        }

        try {
            $data = new Portofolio();
            $data->title = $request->title;
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $name = time() . '.' . $image->getClientOriginalExtension();
                $destinationPath = public_path('assets/img/Portofolio/');
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
        if (is_null($this->user) || !$this->user->can('portofolio.edit')) {
            abort(403, 'Sorry !! You are Unauthorized to edit any portofolio !');
        }

        try {
            $data = Portofolio::find($id);
            $data->title = $request->title;
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $name = time() . '.' . $image->getClientOriginalExtension();
                $destinationPath = public_path('assets/img/Portofolio/');
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
        if (is_null($this->user) || !$this->user->can('portofolio.delete')) {
            abort(403, 'Sorry !! You are Unauthorized to delete any portofolio !');
        }

        try {
            $data = Portofolio::find($id);
            $data->delete();

            session()->flash('success', 'Data has been deleted !!');
            return redirect()->back();
        } catch (\Throwable $th) {
            session()->flash('failed', 'Data has failed deleted !!');
            return redirect()->back();
        }
    }
}
