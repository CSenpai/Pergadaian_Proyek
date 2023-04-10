<?php

namespace App\Http\Controllers;

use App\Models\Pegadaian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PDF;
use Excel;
use App\Exports\PegadaiansExport;
use App\Models\Response;

class PegadaianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // return view('landing');
        $reports = Pegadaian::orderBy('created_at', 'DESC')->simplePaginate(2);
        return view('landing', compact('reports'));
    }

 
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'age' => 'required|numeric',
            'phone' => 'required',
            'nik' => 'required',
            'item' => 'required',            
            'foto' => 'required|image|mimes:jpg,jpeg,png,svg'
        ]);

        $path = public_path('assets/image/');
        $image = $request->file('foto');
        $imgName = rand() . '.' . $image->extension();
        $image->move($path, $imgName);
        // tambah data ke db
        Pegadaian::create([
            'name' => $request->name,
            'email' => $request->email,
            'age' => $request->age,
            "phone" => $request->phone,
            'nik' => $request->nik,
            'item' => $request->item,
            'foto' => $imgName,
        ]);
        return redirect()->back()->with('success','Berhasil menambahkan data!');
    }

  

    public function auth(Request $request)
    {
        // validasinya
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
        //  ambil data dan simpan di variable
        $user = $request->only('email', 'password');
        // simpen data ke auth dengan Auth::attempt
        // cek proses penyimpanan ke auth berhasil atau tidak lewat if else
        if (Auth::attempt($user)) {
            if (Auth::user()->role == 'admin') {
                return redirect()->route('data');
            }elseif(Auth::user()->role == 'petugas') {
                return redirect()->route('dashboard');
            }
        }else {
            return redirect()->back()->with('gagal', 'Gagal login, coba lagi!');
        }
    }

    public function response()
    {
        return view('Response.response');
    }

    public function dashboard(Request $request)
    {
        $search = $request->search;
        $pegadaian = Pegadaian::with('response')->Where('name', 'LIKE', '%' . $search . '%')->orderBy('created_at', 'DESC')->get();
        return view('Response.dashboard', compact('pegadaian'));
    }

    public function dashboard_status(Request $request)
    {
        $search = $request->search;
        $pegadaian = Pegadaian::with('response')->Where('name', 'LIKE', '%' . $search . '%')->orderBy('created_at', 'DESC')->get();
        return view('Response.dashboard_status', compact('pegadaian'));
    }

    public function data(Request $request)
    {
        // ambil data yang diinput ke input yg name nya search
        $search = $request->search;
        // where akan mengisi data berdasarkan kalumn nama
        // data yang diambil merupan data yang 'LIKE' (terdapat) text yang dimasukin ke input search
        // contoh : ngisi  input search dengan 'arief'
        // bakal nyari ke db yang namanya ada isi 'arief' nya

        // & = untuk mencari
        $pegadaian = Pegadaian::with('response')->Where('name', 'LIKE', '%' . $search . '%')->orderBy('created_at', 'DESC')->get();
        return view('Admin.data', compact('pegadaian'));
    }

    public function dataPetugas(Request $request)
    {
        // ambil data yang diinput ke input yg name nya search
        $search = $request->search;
        // with
        $pegadaians = Pegadaian::with('response')->where('name', 'LIKE', '%' . $search . '%')->orderBy('created_at', 'DESC')->get();
        // & = untuk mencari
        return view('Response.dashboard', compact('pegadaian'));
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }

    public function exportPDF() { 
        // ambil data yg akan ditampilkan pada pdf, bisa juga dengan where atau eloquent lainnya dan jangan gunakan pagination
        // jangan lupa konvert data jadi array dengan toArray(  )
        $data = Pegadaian::with('response')->get()->toArray(); 
        // kirim data yg diambil kepada view yg akan ditampilkan, kirim dengan inisial 
        view()->share('reports',$data); 
        // panggil view blade yg akan dicetak pdf serta data yg akan digunakan
        $pdf = PDF::loadView('Admin.print', $data)->setpaper('a4', 'landscape');
        // download PDF file dengan nama tertentu
        return $pdf->download('data_pegadaian_keseluruhan.pdf'); 
    }

    public function exportExcel() {
        // nama file yang akan terdownload
        // selain .xlxx juga bisa .csv
        $file_name = 'data_keseluruhan.xlsx';
        // memanggil file ReportsExport dan mendownloadnya dengan nama seperti $file_name
        return Excel::download(new PegadaiansExport, $file_name); 
    }


    /**
     * Display the specified resource.
     */
    public function show(Pegadaian $pegadaian)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pegadaian $pegadaian)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pegadaian $pegadaian)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pegadaian $pegadaian)
    {
        //
    }
}
