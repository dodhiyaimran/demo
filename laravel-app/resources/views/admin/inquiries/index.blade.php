@extends('layouts.app')
@section('content')
<h1>Inquiries</h1>
<table>
    <tr><th>Name</th><th>Email</th><th>Message</th></tr>
    @foreach($inquiries as $inquiry)
    <tr>
        <td>{{ $inquiry->name }}</td>
        <td>{{ $inquiry->email }}</td>
        <td>{{ $inquiry->message }}</td>
    </tr>
    @endforeach
</table>
@endsection
