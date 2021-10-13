<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TipoCusto;

class TipoCustoController extends Controller
{
    public function index(Request $request)
    {
	    $q = $request->get('q');

	    $query = (new TipoCusto)->newQuery();

	    if(!empty($q['name'])) $query->where('name', 'LIKE', '%' . $q['name'] . '%');
	    
	    $query->orderBy('created_at', 'desc');

	    if (isset($q['deleted']))
		    $query->withTrashed();

	    $tipo_custos = $query->paginate(env('MAX_PAGE', 30));


	    return view('tipo_custo.index', compact('tipo_custos', 'q'));
    }

    public function create()
    {
	    return view('tipo_custo.create');
    }

    public function store(Request $request)
    {
	    $this->validate($request, $this->validatorFields());

	    $tipo_custo = TipoCusto::create($request->all());

	    session()->flash('success', 'Tipo de Custo adicionado com sucesso.');

	    return redirect()->route('tipo_custo.index');
    }

    public function show($id)
    {
	    $tipo_custo = TipoCusto::find($id);
	    return view('tipo_custo.data', compact('tipo_custo'));
    }

    public function edit($id)
    {
	    $tipo_custo = TipoCusto::find($id);
	    return view('tipo_custo.edit', compact('tipo_custo'));
    }

    public function update(Request $request, $id)
    {
	    $this->validate($request, $this->validatorFields($id));

	    $tipo_custo = TipoCusto::find($id);
	    $tipo_custo->update($request->all());

	    session()->flash('success', 'Dados do Tipo de Custo atualizado com sucesso.');

	    return redirect()->route('tipo_custo.index');
    }

    public function destroy($id)
    {
	    TipoCusto::find($id)->delete();
	    session()->flash('success', 'Tipo de Custo excluído com sucesso.');

	    return redirect()->route('tipo_custo.index');
    }

    public function restroy($id)
    {
	    $tipo_custo = TipoCusto::withTrashed()->whereId($id)->first();
	    $tipo_custo->restore();

	    session()->flash('success', 'Tipo de Custo restaurado com sucesso.');

	    return redirect()->route('tipo_custo.index');
    }


    private function validatorFields($id = null)
    {
	    $fields['name'] = 'required';
	    
	    return $fields;
    }


}
