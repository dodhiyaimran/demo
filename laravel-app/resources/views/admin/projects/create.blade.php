@extends('layouts.app')
@section('content')
<h1>Create Project</h1>
<form method="POST" action="{{ route('projects.store') }}">
    @csrf
    <input name="name" placeholder="Name">
    <input name="project_date" type="date" placeholder="Date">
    <input name="energy_generation" placeholder="Energy Generation">
    <input name="client" placeholder="Client">
    <input name="location" placeholder="Location">
    <select name="category_id">
        @foreach($categories as $category)
        <option value="{{ $category->id }}">{{ $category->name }}</option>
        @endforeach
    </select>
    <textarea name="info" placeholder="Info"></textarea>
    <textarea name="scope" placeholder="Scope"></textarea>
    <input name="youtube_url" placeholder="YouTube URL">
    <button type="submit">Save</button>
</form>
@endsection
