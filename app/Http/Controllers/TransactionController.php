<?php

namespace App\Http\Controllers;

use App\Http\Requests\Transaction\StoreTransactionRequest;
use App\Http\Requests\Transaction\UpdateTransactionRequest;
use App\Models\Transaction;
use App\Models\Category;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Services\AI\FinancialAnalysisService;


class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $transactions = Auth::user()->transactions()
            ->with('category')
            ->orderBy('date', 'desc')
            ->get();

        return view('transactions.index', compact('transactions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $categories = Category::where(function ($query){
            $query->whereNull('user_id')
                ->orWhere('user_id', Auth::id());

        })
        ->orderBy('type')
        ->orderBy('name')
        ->get();

        return view('transactions.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTransactionRequest $request): RedirectResponse
    {
        $data = $request->validated();

        if(empty($data['category_id']))
        {
            $data['category_id'] = app(FinancialAnalysisService::class)->categorize($data['description']);

        }
        Auth::user()->transactions()->create($data);

        return redirect()
            ->route('transactions.index')
            ->with('success', 'Transação criada com sucesso.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Transaction $transaction): View
    {
        Gate::authorize('update', $transaction);

        $categories = Category::where(function ($query){
            $query->whereNull('user_id')
                  ->orWhere('user_id', Auth::id());
        })
        ->orderBy('type')
            ->orderBy('name')
            ->get();
        
        return view('transactions.edit', compact('transaction', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTransactionRequest $request, Transaction $transaction): RedirectResponse
    {
        Gate::authorize('update', $transaction);

        $transaction->update($request->validated());

        return redirect()
            ->route('transactions.index')
            ->with('success', 'Transação atualizada com sucesso.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transaction $transaction): RedirectResponse
    {
        Gate::authorize('delete', $transaction);

        $transaction->delete();

        return redirect()
            ->route('transactions.index')
            ->with('success', 'Transação excluída com sucesso.');
    }
}
