@extends('livewire.layout.layout')

@section('content')
@livewire('counter',['count' => 4,'aUser' => Auth::user()])
@endsection
