<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\Videogame;
use \App\Models\Category;
use Illuminate\Support\Facades\Mail;
use Symfony\Contracts\Service\Attribute\Required;
use \App\Http\Requests\StoreVideogame;
use App\Mail\VideogameMail;

class GamesController extends Controller
{
    //
    public function index()
    {
        //$videogames = array('Fifa 22', 'NBA 22', 'Mario Kart', 'Super Mario');
        $videogames = Videogame::orderBy('id', 'desc')->get();
        return view('index', ['games' => $videogames]);
    }
    public function create()
    {
        $categorias = Category::all();
        return view('create', ['categorias' => $categorias]);

    }
    public function help($name_game, $categoria = null)
    {
        $date = Now();
        return view('show', ['nameVideogame' => $name_game, 'categoryGame' => $categoria, 'fecha' => $date]);
    }
    public function storeVideogame(StoreVideogame $request)
    {
        //return $request->all();
        /*$request->validate([
            'name_game'=>'required'
        ]);*/

        /*$game = new Videogame;
        $game->name = $request->name;
        $game->category_id = $request->category_id;
        $game->active = 1;
        $game->save();*/

        Videogame::create($request->all());

        foreach (['joma.ostgo@gmail.com'] as $recipient){
            Mail::to($recipient)->send(new VideogameMail());
        }

        return redirect()->route('games');

    }

    public function view($game_id)
    {
        $game = Videogame::find($game_id);
        $categorias = Category::all();
        return view('update', ['categorias' => $categorias, 'game' => $game]);
    }

    public function updateVideogame(Request $request)
    {
        $request->validate([
            'name_game'=>'required'
        ]);

        $game = Videogame::find($request->game_id);
        $game->name = $request->name_game;
        $game->category_id = $request->categoria_id;
        $game->active = 1;
        $game->save();

        return redirect()->route('games');

    }

    public function delete($game_id)
    {

        $game = Videogame::find($game_id);
        $game->delete();
        return redirect()->route('games');

    }
}