<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Item;
use Illuminate\Http\Request;

class GetController extends Controller
{
    public function getCategorias()
    {
        return Categoria::where('activo', true)->get();
    }

    public function getItems(Request $req)
    {

        try {

            if ($req->input('categoria_id') == null) {
                return response()->json([
                    'items' => Item::where('activo', 1)->get(),
                ]);
            } else {
                return response()->json([
                    'status' => Item::where('activo', 1)->where('categoria_id', $req->input('categoria_id'))->get(),
                ]);
            }
        } catch (\Throwable $th) {
            return response()->json([
                'status' => $th,
            ]);
        }
    }
}
