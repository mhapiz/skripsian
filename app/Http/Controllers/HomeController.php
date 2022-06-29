<?php

namespace App\Http\Controllers;

use App\Models\Inventaris;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function inventarisDetail($id)
    {
        $data = Inventaris::where(DB::raw('md5(id_inventaris)'), $id)->with('ruangan')->first();

        return view('pages.frontend.invetaris-detail', [
            'data' => $data
        ]);
    }
}
