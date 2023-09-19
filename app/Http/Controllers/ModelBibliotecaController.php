<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ModelBiblioteca;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Response;
use App\Http\Controllers;


class ModelBibliotecaController extends Controller
{
    
    public function index()
    {
        $dadosLivros = Livros::All();
        $contador = $dadosLivros->count();

        return 'Livros: '. $contador. $dadosLivros .Response()->json([], Response::HTTP_NO_CONTENT);
    }

    public function store(Request $request)
    {
        $dadosLivros = $request->All();

        $valida = Validador::make($dadosLivros, [
            'nomeLivro'=> 'required',
            'Autor'=> 'required',
            'Genero'=> 'required',
        ]);

        if($valida->fails()){
            return 'Dados inválidos'.$valida->errors(true). 500;
        }

        $db_Biblioteca = Livros::create($dadosLivros);

        if($db_Biblioteca){
            return 'Livros cadastrados'.Response()->json([], Response::HTTP_NO_CONTENT);
        }
        else{
            return 'Livros não cadastrados'.Response()->json([], Reponse::HTTP_NO_CONTENT);
        }
    }

    public function show(string $id)
    {
        $db_Biblioteca = Livros::find($id);
        $contador = $db_Biblioteca->count();

        if($db_Biblioteca){
            return 'Livros encontrados: '.$contador.'-'.$db_Biblioteca.response()->json([], Response::HTTP_NO_CONTENT);
        }
        else{
            return 'Livros não encontrados.'.response()->json([], Response::HTTP_NO_CONTENT);
        }
    }

    public function update(Request $request, string $id)
    {
        $db_Biblioteca = $request->All();
        $valida = Validator::make($db_Biblioteca, [
            'nomeLivro' => 'required',
            'Autor' => 'required',
            'Genero' => 'required'
        ]);

        if($valida->fails()){
            return 'Dados imcompletos '.$valida->errors(true). 500;
        }

        $db_Biblioteca = Livros::find($id);
        $db_Biblioteca->nomeLivro = $db_Biblioteca['nomeLivro'];
        $db_Biblioteca->Autor = $db_Biblioteca['Autor'];
        $db_Biblioteca->Genero = $db_Biblioteca['Genero'];

        $registroLivros = Livros::save($db_Biblioteca);
        if($registroLivros) {
            return 'Dados cadastrados com sucesso.'.response()->json([], Response::HTTP_NO_CONTENT);
        }
        else{
            return 'Dados não cadastrados no banco de dados.'.response()->json([], Response::HTTP_NO_CONTENT);
        }
    }

  
    public function destroy(string $id)
    {
        $db_Biblioteca = Livros::find($id);
        if($db_Biblioteca){
            $db_Biblioteca->delete();
            return 'O livro foi deletado com sucesso.'.Response()->json([], Response::HTTP_NO_CONTENT);
        }
        else {
            return 'O livro não foi deletado com sucesso.'.Response()->json([], Response::HTTP_NO_CONTENT);
        }
    }
}
