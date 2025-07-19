@extends('layouts.app')
@section('content')
<h1>Edit Project</h1>
<form method="POST" action="{{ route('projects.update', $project) }}">
    @csrf
    @method('PUT')
    <input name="name" value="{{ $project->name }}" placeholder="Name">
    <input name="project_date" type="date" value="{{ $project->project_date }}" placeholder="Date">
    <input name="energy_generation" value="{{ $project->energy_generation }}" placeholder="Energy Generation">
    <input name="client" value="{{ $project->client }}" placeholder="Client">
    <input name="location" value="{{ $project->location }}" placeholder="Location">
    <select name="category_id">
        @foreach($categories as $category)
        <option value="{{ $category->id }}" @if($category->id == $project->category_id) selected @endif>{{ $category->name }}</option>
        @endforeach
    </select>
    <textarea name="info" placeholder="Info">{{ $project->info }}</textarea>
    <textarea name="scope" placeholder="Scope">{{ $project->scope }}</textarea>
    <input name="youtube_url" value="{{ $project->youtube_url }}" placeholder="YouTube URL">
    <button type="submit">Save</button>
</form>
@endsection
