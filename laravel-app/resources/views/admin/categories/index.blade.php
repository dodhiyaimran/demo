@extends('layouts.app')
@section('content')
<h1>Categories</h1>
<a href="{{ route('categories.create') }}">New Category</a>
<table>
    <tr><th>Name</th><th></th></tr>
    @foreach($categories as $category)
    <tr>
        <td>{{ $category->name }}</td>
        <td>
            <a href="{{ route('categories.edit', $category) }}">Edit</a>
            <form method="POST" action="{{ route('categories.destroy', $category) }}">
                @csrf
                @method('DELETE')
                <button type="submit">Delete</button>
            </form>
        </td>
    </tr>
    @endforeach
</table>
@endsection
