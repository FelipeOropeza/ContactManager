<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Contato;
use Illuminate\Http\Request;

class ContatoController extends Controller
{
    public function index()
    {
        $contato = Contato::all();

        if ($contato->isEmpty()) {
            return response()->json(['message' => 'Nenhum contato encontrado'], 404);
        }

        return response()->json([
            'message' => 'Lista de contatos',
            'data' => $contato
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'telefone' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'aniversario' => 'required|date',
            'foto' => 'required|string|max:255',
        ]);

        Contato::create($validated);

        return response()->json([
            'message' => 'Contato criado com sucesso!',
            'data' => $validated
        ]);
    }

    public function show(string $id)
    {
        $contato = Contato::find($id);

        if (!$contato) {
            return response()->json(['message' => 'Contato não encontrado'], 404);
        }
        return response()->json([
            'data' => $contato
        ]);
    }

    public function update(Request $request, string $id)
    {
        $contato = Contato::find($id);

        if (!$contato) {
            return response()->json(['message' => 'Contato não encontrado'], 404);
        }

        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'telefone' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'aniversario' => 'required|date',
            'foto' => 'required|string|max:255',
        ]);

        $contato->update($validated);

        return response()->json([
            'message' => 'Contato atualizado com sucesso!',
            'data' => $contato
        ]);
    }

    public function destroy(string $id)
    {
        $contato = Contato::find($id);

        if (!$contato) {
            return response()->json(['message' => 'Contato não encontrado'], 404);
        }

        $contato->delete();

        return response()->json(['message' => 'Contato deletado com sucesso']);
    }
}
