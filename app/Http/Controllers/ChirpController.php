<?php

namespace App\Http\Controllers;


use Illuminate\Http\RedirectResponse;
use App\Models\Chirp;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;
use Illuminate\Http\Response as HttpResponse;
use Redirect;
use Symfony\Component\HttpKernel\Event\ResponseEvent;

class ChirpController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        return Inertia::render('Chirps/Index', [
            'chirps' => Chirp::with('user:id,name')->latest()->get(),
        ]);
    }
    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
     //  
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'content' => 'required|string',
            'file' => 'nullable|file|mimes:jpg,jpeg,png,mp4|max:10240',
        ]);

        $filePath = null;
        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('uploads', 'public');
        }
        
        $chirp = $request->user()->chirps()->create([
            'content' => $validated['content'],
            'file_path' => $filePath,
        ]);

         return redirect()->back()->with('success', 'Chirp created successfully!');

      

        if ($request->hasFile('file')) {
            $validated['file_path'] = $request->file('file')->store('uploads', 'public');
        }
        
        
        
        $chirp = $request->user()->chirps()->create([
            'content' => $validated['content'],
            'file_path' => $filePath,
        ]);
 
        return redirect(route('chirps.index'));

    }


    /**
     * Display the specified resource.
     */
    public function show(Chirp $chirp)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Chirp $chirp): View
    {
        Gate::authorize('update', $chirp);
 
        return view( 'chirps.edit', [
            'chirp' => $chirp,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Chirp $chirp): RedirectResponse
    {  
        Gate::authorize('update', $chirp);
 
        $validated = $request->validate([
            'message' => 'required|string|max:255',
        ]);
 
        $chirp->update($validated);
 
        return redirect(route('chirps.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Chirp $chirp): RedirectResponse
    {
        Gate::authorize('delete', $chirp);
 
        $chirp->delete();
 
        return redirect(route('chirps.index'));
    }

    public function parseHashtags()
{
    preg_match_all('/#(\w+)/', $this->content, $matches);
    return $matches[1]; // Array hashtag
}

}
