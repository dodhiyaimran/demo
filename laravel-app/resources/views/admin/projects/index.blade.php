@extends('layouts.app')
@section('content')
<h1>Projects</h1>
<a href="{{ route('projects.create') }}">New Project</a>
<table>
    <tr><th>Name</th><th>Category</th><th></th></tr>
    @foreach($projects as $project)
    <tr>
        <td>{{ $project->name }}</td>
        <td>{{ $project->category->name ?? '' }}</td>
        <td>
            <a href="{{ route('projects.edit', $project) }}">Edit</a>
            <form method="POST" action="{{ route('projects.destroy', $project) }}">
                @csrf
                @method('DELETE')
                <button type="submit">Delete</button>
            </form>
        </td>
    </tr>
    @endforeach
</table>
@endsection
