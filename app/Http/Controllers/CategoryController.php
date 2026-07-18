<?php

namespace App\Http\Controllers;

use App\Http\Requests\Category\UpdateCategoryRequest;
use App\Http\Requests\Category\StoreCategoryRequest;
use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class CategoryController extends Controller
{
   
    public function index(): View
    {
        $categories = Category::where(function ($query){
            $query->whereNull('user_id')
                ->orWhere('user_id', Auth::id());
        })
        ->orderBy('name')
        ->orderBy('type')
        ->get();

        return view('categories.index', compact('categories'));
    }

   
    public function create()
    {
        return view('categories.create');
    }

  
    public function store(StoreCategoryRequest $request): RedirectResponse
    {
        Gate::authorize('create', Category::class);

        Auth::user()->categories()->create($request->validated());

        return redirect()
            ->route('categories.index')
            ->with('success', 'categoria criada com sucesso');
    }

  
    public function edit(Category $category): View
    {
        Gate::authorize('view', $category);
       
        return view('categories.edit', compact('category'));
    }
    
   
    public function update(UpdateCategoryRequest $request, Category $category): RedirectResponse
    {
        Gate::authorize('update', $category);
        
        $category->update($request->validated());

        return redirect()
            ->route('categories.index')
            ->with('success', 'categoria atualizada com sucesso');
    }
    

    public function destroy(Category $category): RedirectResponse
    {
        Gate::authorize('delete', $category);

        $category->delete();

        return redirect()
            ->route('categories.index')
            ->with('success', 'categoria deletada com sucesso');
    }
}
