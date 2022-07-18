<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Item;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\FuncCall;
use Illuminate\Support\Facades\Storage;

class AMBController extends Controller
{

    public function altaCategoria(Request $req)
    {
        try {

            $nombre = $req->input('nombre');
            $orden = Categoria::where('activo', true)->count() + 1;

            $cat = new Categoria();
            $cat->nombre = $nombre;
            $cat->orden = $orden;
            $cat->save();

            return response()->json([
                'status' => 'ok',
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => $th,
            ]);
        }

        return $orden;
    }


    public function bajaCategoria(Request $req)
    {

        try {
            $id = $req->input('id');
            Categoria::where('id', $id)->delete();
            return response()->json([
                'status' => 'ok',
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => $th,
            ]);
        }
    }


    public function modificarCategorias(Request $req)
    {

        try {
            $categorias = json_decode($req->input('categorias'));

            foreach ($categorias as $key => $c) {

                $categoria = Categoria::where('id', $c->id)->first();
                $categoria->nombre = $c->nombre;
                $categoria->orden = $c->orden;
                $categoria->save();
            }
            return response()->json([
                'status' => 'ok',
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' =>  $th
            ]);
        }
    }

    public function altaItem(Request $req)
    {

        $orden = Item::where('categoria_id', $req->input('categoria_id'))->count() + 1;

        try {
            $item = new Item();
            $item->nombre = $req->input('nombre');
            $item->descripcion = $req->input('descripcion');

            if ($req->input('es_veggie') == true) {
                $item->es_veggie = 1;
            } else {
                $item->es_veggie = 0;
            }
            if ($req->input('es_vegan') == true) {
                $item->es_vegan = 1;
            } else {
                $item->es_vegan = 0;
            }
            $item->precio = $req->input('precio');
            $item->imagen = 'TODO'; // TODO
            $item->orden = $orden;
            $item->categoria_id = $req->input('categoria_id');

            $item->save();

            $file = $req->file('imagen')->storeAs('', 'imagenID' . $item->id . '.jpg', 'images');

            return response()->json([
                'status' => 'ok',
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' =>  $th,
            ]);
        }
    }


    public function modificarItem(Request $req)
    {

        try {

            $item = Item::where('id', $req->input('id'))->first();

            $item->nombre = $req->input('nombre');
            $item->descripcion = $req->input('descripcion');
            $item->es_veggie = $req->input('es_veggie');
            $item->es_vegan = $req->input('es_vegan');
            $item->precio = $req->input('precio');
            $item->imagen = 'TODO'; // TODO
            $item->categoria_id = $req->input('categoria_id');

            $item->save();

            return response()->json([
                'status' => 'ok',
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => $th,
            ]);
        }
    }


    public function bajaItem(Request $req)
    {
        try {
            $id = $req->input('id');
            Item::where('id', $id)->delete();
            return response()->json([
                'status' => 'ok',
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => $th,
            ]);
        }
    }
}
