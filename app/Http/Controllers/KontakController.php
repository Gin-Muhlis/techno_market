<?php

namespace App\Http\Controllers;

use App\Models\Kontak;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\KontakStoreRequest;
use App\Http\Requests\KontakUpdateRequest;

class KontakController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', Kontak::class);

        $kontaks = Kontak::latest()->get();

        return view('app.kontaks.index', compact('kontaks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', Kontak::class);

        return view('app.kontaks.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(KontakStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', Kontak::class);

        $validated = $request->validated();

        $kontak = Kontak::create($validated);

        return redirect()
            ->route('kontaks.edit', $kontak)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Kontak $kontak): View
    {
        $this->authorize('view', $kontak);

        return view('app.kontaks.show', compact('kontak'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Kontak $kontak): View
    {
        $this->authorize('update', $kontak);

        return view('app.kontaks.edit', compact('kontak'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        KontakUpdateRequest $request,
        Kontak $kontak
    ): RedirectResponse {
        $this->authorize('update', $kontak);

        $validated = $request->validated();

        $kontak->update($validated);

        return redirect()
            ->route('kontaks.edit', $kontak)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Kontak $kontak): RedirectResponse
    {
        $this->authorize('delete', $kontak);

        $kontak->delete();

        return redirect()
            ->route('kontaks.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
