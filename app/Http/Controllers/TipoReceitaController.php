<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TipoReceita;

class TipoReceitaController extends Controller
{
    public function index(Request $request)
    {
	    $q = $request->get('q');

	    $query = (new TipoReceita)->newQuery();

	    if(!empty($q['name'])) $query->where('name', 'LIKE', '%' . $q['name'] . '%');
	    
	    $query->orderBy('created_at', 'desc');

	    if (isset($q['deleted']))
		    $query->withTrashed();

	    $tipo_receitas = $query->paginate(env('MAX_PAGE', 30));


	    return view('tipo_receita.index', compact('tipo_receitas', 'q'));
    }

    public function create()
    {
	    return view('tipo_receita.create');
    }

    public function store(Request $request)
    {
	    $this->validate($request, $this->validatorFields());

	    $request['valor'] = str_replace(',', '.', $request['valor']);

	    $tipo_receita = TipoReceita::create($request->all());

	    session()->flash('success', 'Tipo de Receita adicionada com sucesso.');

	    return redirect()->route('tipo_receita.index');
    }

    public function show($id)
    {
	    $tipo_receita = TipoReceita::find($id);
	    return view('tipo_receita.data', compact('tipo_receita'));
    }

    public function edit($id)
    {
	    $tipo_receita = TipoReceita::find($id);
	    return view('tipo_receita.edit', compact('tipo_receita'));
    }

    public function update(Request $request, $id)
    {
	    $this->validate($request, $this->validatorFields($id));

	    $request['valor'] = str_replace(',', '.', $request['valor']);

	    $tipo_receita = TipoReceita::find($id);
	    $tipo_receita->update($request->all());

	    session()->flash('success', 'Dados do Tipo de Receita atualizada com sucesso.');

	    return redirect()->route('tipo_receita.index');
    }

    public function destroy($id)
    {
	    TipoReceita::find($id)->delete();
	    session()->flash('success', 'Tipo de Receita excluída com sucesso.');

	    return redirect()->route('tipo_receita.index');
    }

    public function restroy($id)
    {
	    $tipo_receita = TipoReceita::withTrashed()->whereId($id)->first();
	    $tipo_receita->restore();

	    session()->flash('success', 'Tipo de Receita restaurada com sucesso.');

	    return redirect()->route('tipo_receita.index');
    }


    private function validatorFields($id = null)
    {
	    $fields['name'] = 'required';
	    $fields['valor'] = 'required';
	    
	    return $fields;
    }


}
