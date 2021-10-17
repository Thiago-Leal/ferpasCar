<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TipoPagamento;

class TipoPagamentoController extends Controller
{
    public function index(Request $request)
    {
	    $q = $request->get('q');

	    $query = (new TipoPagamento)->newQuery();

	    if(!empty($q['name'])) $query->where('name', 'LIKE', '%' . $q['name'] . '%');
	    
	    $query->orderBy('created_at', 'desc');

	    if (isset($q['deleted']))
		    $query->withTrashed();

	    $tipo_pagamentos = $query->paginate(env('MAX_PAGE', 30));


	    return view('tipo_pagamento.index', compact('tipo_pagamentos', 'q'));
    }

    public function create()
    {
	    return view('tipo_pagamento.create');
    }

    public function store(Request $request)
    {
	    $this->validate($request, $this->validatorFields());

	    $tipo_pagamento = TipoPagamento::create($request->all());

	    session()->flash('success', 'Tipo de pagamento adicionado com sucesso.');

	    return redirect()->route('tipo_pagamento.index');
    }

    public function show($id)
    {
	    $tipo_pagamento = TipoPagamento::find($id);
	    return view('tipo_pagamento.data', compact('tipo_pagamento'));
    }

    public function edit($id)
    {
	    $tipo_pagamento = TipoPagamento::find($id);
	    return view('tipo_pagamento.edit', compact('tipo_pagamento'));
    }

    public function update(Request $request, $id)
    {
	    $this->validate($request, $this->validatorFields($id));

	    $tipo_pagamento = TipoPagamento::find($id);
	    $tipo_pagamento->update($request->all());

	    session()->flash('success', 'Dados do Tipo de pagamento atualizado com sucesso.');

	    return redirect()->route('tipo_pagamento.index');
    }

    public function destroy($id)
    {
	    TipoPagamento::find($id)->delete();
	    session()->flash('success', 'Tipo de pagamento excluído com sucesso.');

	    return redirect()->route('tipo_pagamento.index');
    }

    public function restroy($id)
    {
	    $tipo_pagamento = TipoPagamento::withTrashed()->whereId($id)->first();
	    $tipo_pagamento->restore();

	    session()->flash('success', 'Tipo de pagamento restaurado com sucesso.');

	    return redirect()->route('tipo_pagamento.index');
    }


    private function validatorFields($id = null)
    {
	    $fields['name'] = 'required';
	    
	    return $fields;
    }


}
