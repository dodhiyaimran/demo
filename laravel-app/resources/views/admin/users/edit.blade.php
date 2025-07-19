@extends('layouts.app')
@section('content')
<h1>Edit User</h1>
<form method="POST" action="{{ route('users.update', $user) }}">
    @csrf
    @method('PUT')
    <input name="name" value="{{ $user->name }}" placeholder="Name">
    <input name="email" value="{{ $user->email }}" placeholder="Email">
    <button type="submit">Save</button>
</form>
@endsection
