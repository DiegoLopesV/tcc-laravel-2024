<?php
namespace App\Http\Controllers;

use App\Models\Professor;
use Illuminate\Http\Request;
use App\Models\Lotacao;
use App\Models\Disciplina;

class ProfessoresController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $professors = Professor::orderBy("id", "DESC")->paginate(10);
        return view('professores.index', compact('professors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('professores.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $dadosParaSalvar = $request->validate([
            'nome' => 'required|max:255',
            'cpf' => 'required|max:255',
            'data_nascimento' => 'required|date',
            'email' => 'required|max:255'
        ]);

        $dados = array_merge($dadosParaSalvar, [
            "role" => "ROLE_PROFESSOR"
        ]);

        $lotacao = new Lotacao();
        $lotacao->nome_campus = $request["nome_campus"];
        $lotacao->departamento = $request["departamento"];
        $lotacao->area_atuacao = $request["area_atuacao"];

        $professor = Professor::create($dados);

        $professor->lotacao()->save($lotacao);

        return redirect()->route('professores.index')->withSuccess(__('Professor criado com sucesso.'));
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $professors = Professor::findOrFail($id);
        return view('professores.show', compact("professors"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $professors = Professor::findOrFail($id);
        return view('professores.edit', ['professor' => $professors]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $storeData = $request->validate([
            'nome' => 'required|max:255',
            'cpf' => 'required|max:255',
            'data_nascimento' => 'required|date',
            'email' => 'required|max:255'
        ]);

        $lotacao = Professor::find($id)->lotacao;
        $lotacao->nome_campus = $request["nome_campus"];
        $lotacao->departamento = $request["departamento"];
        $lotacao->area_atuacao = $request["area_atuacao"];

        Professor::whereId($id)->update($storeData);

        $lotacao->update();
        
        return redirect('/professores')->with('completed', 'Professor atualizado com sucesso');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $professor = Professor::findOrFail($id);
        $professor->delete();
        return redirect('/professores')->with('completed', 'Professor removido com sucesso');
    }
}
