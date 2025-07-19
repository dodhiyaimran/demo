@extends('layouts.app')
@section('content')
<h1>Create Category</h1>
<form method="POST" action="{{ route('categories.store') }}">
    @csrf
    <input name="name" placeholder="Name">
    <button type="submit">Save</button>
</form>
@endsection
