@extends('layouts.app')
@section('content')
<h1>Edit Category</h1>
<form method="POST" action="{{ route('categories.update', $category) }}">
    @csrf
    @method('PUT')
    <input name="name" value="{{ $category->name }}" placeholder="Name">
    <button type="submit">Save</button>
</form>
@endsection
