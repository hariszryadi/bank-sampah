<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Waste;
use App\Models\Transaction;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $waste = Waste::with('category')->orderBy('id')->get();
        return view('welcome', compact('waste'));
    }

    public function chart()
    {
        $chart = Transaction::selectRaw('wastes.name, SUM(transactions.qty) as total_qty')
                ->leftJoin('wastes', 'transactions.waste_id', 'wastes.id')
                ->groupBy('wastes.name')
                ->get();
        return view('chart', compact('chart'));
    }

    public function count(Request $request)
    {
        $waste = Waste::find($request->waste);
        $total = $waste->price*$request->qty;

        return response()->json($total);
    }

    public function store(Request $request)
    {
        $waste = Waste::find($request->waste);

        $transaction = new Transaction;
        $transaction->name = $request->name;
        $transaction->waste_id = $request->waste;
        $transaction->qty = $request->qty;
        $transaction->total = $waste->price*$request->qty;
        $transaction->save();

        return redirect()->route('home')->with('success', 'Sampah berhasil disetor');
    }
}
