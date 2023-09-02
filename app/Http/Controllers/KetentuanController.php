<?php

namespace App\Http\Controllers;

use App\Models\Ketentuan;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\KetentuanStoreRequest;
use App\Http\Requests\KetentuanUpdateRequest;

class KetentuanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', Ketentuan::class);

        $ketentuans = Ketentuan::latest()->get();

        return view('app.ketentuans.index', compact('ketentuans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', Ketentuan::class);

        return view('app.ketentuans.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(KetentuanStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', Ketentuan::class);

        $validated = $request->validated();

        $ketentuan = Ketentuan::create($validated);

        return redirect()
            ->back()
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Ketentuan $ketentuan): View
    {
        $this->authorize('view', $ketentuan);

        return view('app.ketentuans.show', compact('ketentuan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Ketentuan $ketentuan): View
    {
        $this->authorize('update', $ketentuan);

        return view('app.ketentuans.edit', compact('ketentuan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        KetentuanUpdateRequest $request,
        Ketentuan $ketentuan
    ): RedirectResponse {
        $this->authorize('update', $ketentuan);

        $validated = $request->validated();

        $ketentuan->update($validated);

        return redirect()
            ->back()
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        Ketentuan $ketentuan
    ): RedirectResponse {
        $this->authorize('delete', $ketentuan);

        $ketentuan->delete();

        return redirect()
            ->back()
            ->withSuccess(__('crud.common.removed'));
    }
}
