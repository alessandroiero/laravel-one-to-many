<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use Illuminate\Support\Str;

use App\Models\Project;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $projects = Project::all();

        // prendiamo il file index dentro la cartella admin->projects usando la dot notation
        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.projects.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProjectRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProjectRequest $request)
    {
        $data = $request->validated();
        $project = new Project();
        $project->slug =  Str::slug($data['title']);
        $project->fill($data);

        // immagine
        $project->slug =  Str::slug($data['title']);
        if (isset($data['image'])) {
            $project->image = Storage::put('uploads', $data['image']);
        }
        // immagine
        $project->save();

        return redirect()->route('admin.projects.index')->with('message', 'Nuovo Progetto Creato');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        return view('admin.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        return view('admin.projects.edit', compact('project'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProjectRequest  $request
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProjectRequest $request, Project $project)
    {
        $data = $request->validated();
        $project->slug =  Str::slug($data['title']);

        // immagine
        if (isset($data['image'])) {
            $project->image = Storage::put('uploads', $data['image']);
        }
        // immagine
        $project->update($data);

        return redirect()->route('admin.projects.index')->with('message', "Il $project->id progetto è aggiornato");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        $old_id = $project->id;
        
        if($project->image){
            Storage::delete($project->image);
        }
        $project->delete();

        return redirect()->route('admin.projects.index')->with('message', "Il $old_id Progetto è stato Cancellato");
    }
}
