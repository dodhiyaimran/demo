@extends('layouts.app')
@section('content')
<h1>Contact</h1>
<form method="POST" action="{{ route('contact.store') }}">
    @csrf
    <input name="name" placeholder="Name">
    <input name="email" placeholder="Email">
    <textarea name="message" placeholder="Message"></textarea>
    <button type="submit">Send</button>
</form>
@endsection
