@extends('layouts.app')
@section('content')
<h1>Create User</h1>
<form method="POST" action="{{ route('users.store') }}">
    @csrf
    <input name="name" placeholder="Name">
    <input name="email" placeholder="Email">
    <input name="password" type="password" placeholder="Password">
    <button type="submit">Save</button>
</form>
@endsection
