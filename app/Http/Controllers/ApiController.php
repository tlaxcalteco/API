<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function inicio()
    {

        // -- consumir api Rick and Morty
        $cliente = new \GuzzleHttp\Client();
        $response = $cliente->request('GET', 'https://rickandmortyapi.com/api/character/');
        $datos = json_decode($response->getBody()->getContents(), true);

        // -- Recorrer elementos
        $personajes = [];

        foreach ($datos['results'] as $personaje) {
            $personajes[] = [
                'id' => $personaje['id'],
                'nombre' => $personaje['name'],
                'especie' => $personaje['species'],
                'origen' => $personaje['origin']['name'],
                'imagen' => $personaje['image'],
                'estatus' => $personaje['status'],
                'genero' => $personaje['gender']
            ];
        }

        return view('inicio',['personajes' => $personajes]);
    }

    public function detallePersonaje($id){

        // -- consumir api Rick and Morty
        $cliente = new \GuzzleHttp\Client();
        $response = $cliente->request('GET', 'https://rickandmortyapi.com/api/character/'.$id);
        $personajeIndividual = json_decode($response->getBody()->getContents(), true);

        // -- Generar número aleatorio entre 0 y 42
        $numero = rand(0, 42);

         // -- consumir api Rick and Morty
         $cliente = new \GuzzleHttp\Client();
         $response = $cliente->request('GET', 'https://rickandmortyapi.com/api/character/?page='.$numero);
         $datos = json_decode($response->getBody()->getContents(), true);

         // -- Recorrer elementos
         $personajes = [];

         foreach ($datos['results'] as $personaje) {
             $personajes[] = [
                 'id' => $personaje['id'],
                 'nombre' => $personaje['name'],
                 'especie' => $personaje['species'],
                 'origen' => $personaje['origin']['name'],
                 'imagen' => $personaje['image'],
                 'estatus' => $personaje['status'],
                 'genero' => $personaje['gender']
             ];
         }

        return view('personaje',['personaje' => $personajeIndividual, 'personajes' => $personajes]);

    }



}
