<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use Illuminate\Http\Request;
use App\Models\Operacion;
use Inertia\Inertia;
use Illuminate\Support\Facades\Session;

class OperacionController extends Controller
{
    public function index($loanId = 1)
    {
        $loan = Loan::find($loanId);
        $client_id = $loan->client_id;
        $operations = Operacion::where('loan_number', $loanId)->paginate(10);
        return Inertia::render('Operaciones', [
            'operations' => $operations,
            'loan_number' => intval($loanId),
            'client_id' => $client_id,
            "esadm" => Session::get('esadm')
        ]);
        return response()->json(['operations' => $operations]);
    }

    public function store(Request $request)
    {

        $operacion = new Operacion();
        $operacion->loan_number = $request->input('loan_number');
        $operacion->client_id = $request->input('client_id');
        $operacion->ingress_paid = $request->input('ingress_paid');
        $operacion->ingress_bank = $request->input('ingress_bank');
        $operacion->ingress_comment = $request->input('ingress_comment');
        $operacion->ingress_type = $request->input('ingress_type');
        $operacion->save();

        return response()->json(['message' => "Almacenado correctamente"]);
    }
}
