@extends('layouts.app')
@section('content')
<h1>Users</h1>
<a href="{{ route('users.create') }}">New User</a>
<table>
    <tr><th>Name</th><th>Email</th><th></th></tr>
    @foreach($users as $user)
    <tr>
        <td>{{ $user->name }}</td>
        <td>{{ $user->email }}</td>
        <td>
            <a href="{{ route('users.edit', $user) }}">Edit</a>
            <form method="POST" action="{{ route('users.destroy', $user) }}">
                @csrf
                @method('DELETE')
                <button type="submit">Delete</button>
            </form>
        </td>
    </tr>
    @endforeach
</table>
@endsection
