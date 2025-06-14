<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use RealRashid\SweetAlert\Facades\Alert;

class DashboardController extends Controller
{
   public function index()
   {
      $getbarang = Barang::all();

      $barangs = Barang::where('shift', 1)->get();
      $totalshift1 = 0;
      
      foreach($barangs as $barang) {
         $selisih = abs($barang->chargis_to - $barang->chargis_from + 1);
         $totalshift1 += $selisih;
      }
      
      $barangs = Barang::where('shift', 2)->get();
      $totalshift2 = 0;
      foreach($barangs as $barang) {
         $selisih = abs($barang->chargis_to - $barang->chargis_from + 1);
         $totalshift2 += $selisih;
      }
      
      $barangs = Barang::where('shift', 3)->get();
      $totalshift3 = 0;
      foreach($barangs as $barang) {
         $selisih = abs($barang->chargis_to - $barang->chargis_from + 1);
         $totalshift3 += $selisih;
      }

      $totalAll = $totalshift1 + $totalshift2 + $totalshift3;
      return view('pageadmin.dashboard.index', compact('getbarang', 'totalshift1', 'totalshift2', 'totalshift3', 'totalAll'));
   }
   public function create()
   {
      return view('pageadmin.dashboard.create');
   }
   public function store(Request $request)
   {
      $request->validate([
         'no_barang' => 'required|unique:barangs',
         'line_code' => 'required',
         'chargis_from' => 'required',
         'chargis_to' => 'required',
         'shift' => 'required',
         'info' => 'nullable'
      ]);

      Barang::create($request->all());
      Alert::success('Success', 'Data berhasil disimpan');
      return redirect()->route('admin.dashboard');
   }
   public function edit($id)
   {
      $barang = Barang::findOrFail($id);
      return view('pageadmin.dashboard.edit', compact('barang'));
   }
   public function update(Request $request, $id)
   {
      $request->validate([
         'no_barang' => 'required|unique:barangs,no_barang,' . $id,
         'line_code' => 'required',
         'chargis_from' => 'required|numeric',
         'chargis_to' => 'required|numeric',
         'shift' => 'required',
         'info' => 'nullable'
      ]);

      $barang = Barang::findOrFail($id);
      $barang->update($request->all());
      Alert::success('Success', 'Data berhasil diubah');
      return redirect()->route('admin.dashboard');
   }
   public function destroy($id)
   {
      $barang = Barang::findOrFail($id);
      $barang->delete();
      Alert::success('Success', 'Data berhasil dihapus');
      return redirect()->route('admin.dashboard');
   }


  
}
