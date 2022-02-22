<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function index(){
        $cliente = new \GuzzleHttp\Client();
        $response = $cliente->request('GET','https://www.googleapis.com/books/v1/volumes?q=sinsajo');
        $datos = json_decode($response->getBody()->getContents(), true);
       
        //recorrer elementos
        $libros=[];
        foreach($datos['items'] as $libro){
            $libros[]=[
                'titulo'=>$libro['volumeInfo']['title'],
                'autor'=>$libro['volumeInfo']['authors'],
                'hojas'=>$libro['volumeInfo']['pageCount'],
                'fecha'=>$libro['volumeInfo']['publishedDate'],
                'descripcion'=>$libro['volumeInfo']['description'],
                'lenguaje'=>$libro['volumeInfo']['language'],
                'portada'=>$libro['volumeInfo']['imageLinks']['thumbnail']
            ];
        }
        return view('index',['libros' => $libros]);
    }
}
