<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;
use Illuminte\View\View;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $totalIncome = $user->transactions()
            ->where('type', 'income')
            ->whereMonth('date', now()->month)
            ->whereYear('date', now()->year)
            ->sum('amount');

        $totalExpense = $user->transactions()
            ->where('type', 'expense')
            ->whereMonth('date', now()->month)
            ->whereYear('date', now()->year)
            ->sum('amount');

        $balance = $totalIncome - $totalExpense;

        $recentTransactions = $user->transactions()
            ->with('category')
            ->orderBy('date', 'desc')
            ->limit(5)
            ->get();
      
        $expensesByCategory = $user->transactions()
            ->with('category')
            ->where('type', 'expense')
            ->whereMonth('date', now()->month)
            ->whereYear('date', now()->year)
            ->get()
            ->groupBy('category.name')
            ->map(fn($transactions) => $transactions->sum('amount'));

        return view('dashboard', compact(
            'totalIncome',
            'totalExpense',
            'balance',
            'recentTransactions',
            'expensesByCategory'
        ));
    }
}
