<?php
namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Category;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::with('category')->get();
        return view('admin.projects.index', compact('projects'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.projects.create', compact('categories'));
    }

    public function store(Request $request)
    {
        Project::create($request->validate([
            'name' => 'required',
            'project_date' => 'required|date',
            'energy_generation' => 'nullable',
            'client' => 'nullable',
            'location' => 'nullable',
            'category_id' => 'required|exists:categories,id',
            'info' => 'nullable',
            'scope' => 'nullable',
            'youtube_url' => 'nullable|url',
        ]));
        return redirect()->route('projects.index');
    }

    public function edit(Project $project)
    {
        $categories = Category::all();
        return view('admin.projects.edit', compact('project', 'categories'));
    }

    public function update(Request $request, Project $project)
    {
        $project->update($request->validate([
            'name' => 'required',
            'project_date' => 'required|date',
            'energy_generation' => 'nullable',
            'client' => 'nullable',
            'location' => 'nullable',
            'category_id' => 'required|exists:categories,id',
            'info' => 'nullable',
            'scope' => 'nullable',
            'youtube_url' => 'nullable|url',
        ]));
        return redirect()->route('projects.index');
    }

    public function destroy(Project $project)
    {
        $project->delete();
        return redirect()->route('projects.index');
    }
}
