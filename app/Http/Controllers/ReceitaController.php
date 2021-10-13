<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Receita;

class ReceitaController extends Controller
{
    public function index(Request $request)
    {
	    $q = $request->get('q');

	    $query = (new Receita)->newQuery();

	    if(!empty($q['name'])) $query->where('name', 'LIKE', '%' . $q['name'] . '%');
	    if(!empty($q['tipo_receita_id'])) $query->where('tipo_receita_id', $q['tipo_receita_id']);
	    
	    $query->orderBy('created_at', 'desc');

	    if (isset($q['deleted']))
		    $query->withTrashed();

	    $receitas = $query->paginate(env('MAX_PAGE', 30));


	    return view('receita.index', compact('receitas', 'q'));
    }

    public function create()
    {
	    return view('receita.create');
    }

    public function store(Request $request)
    {
	    $this->validate($request, $this->validatorFields());

	    $request['valor'] = str_replace(',', '.', $request['valor']);

	    $receita = Receita::create($request->all());

	    session()->flash('success', 'Receita adicionada com sucesso.');

	    return redirect()->route('receita.index');
    }

    public function show($id)
    {
	    $receita = Receita::find($id);
	    return view('receita.data', compact('receita'));
    }

    public function edit($id)
    {
	    $receita = Receita::find($id);
	    return view('receita.edit', compact('receita'));
    }

    public function update(Request $request, $id)
    {
	    $this->validate($request, $this->validatorFields($id));

	    $request['valor'] = str_replace(',', '.', $request['valor']);

	    $receita = Receita::find($id);
	    $receita->update($request->all());

	    session()->flash('success', 'Dados da Receita atualizada com sucesso.');

	    return redirect()->route('receita.index');
    }

    public function destroy($id)
    {
	    Receita::find($id)->delete();
	    session()->flash('success', 'Receita excluída com sucesso.');

	    return redirect()->route('receita.index');
    }

    public function restroy($id)
    {
	    $receita = Receita::withTrashed()->whereId($id)->first();
	    $receita->restore();

	    session()->flash('success', 'Receita restaurada com sucesso.');

	    return redirect()->route('receita.index');
    }


    private function validatorFields($id = null)
    {
	    $fields['name'] = 'required';
	    $fields['valor'] = 'required';
	    $fields['tipo_receita_id'] = 'required';
	    
	    return $fields;
    }


}
