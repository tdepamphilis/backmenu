<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
                $items = Item::where('activo', 1)->get();     
            } else {           
                $items = Item::where('activo', 1)->where('categoria_id', $req->input('categoria_id'))->get();      
            }
            return response()->json([
                'status' => $items,
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => $th,
            ]);
        }
    }

    public function getImage($r,$id){

        //  unused variable r para randomizar las calls y bypasear la cache de navegador
        try {
            
            $headers = [
                'Content-Type' => 'application/image'
            ];

            $file = storage_path('app\images') . '\imagenID' . $id . '.jpg';

            return response()->file($file);

        } catch (\Throwable $th) {
            // TODO STOCK IMAGE
            return $th;
        }
    }
}
