@extends('user.layout.layout')
@php
    $aUser = Auth::user();
@endphp
@section('content')

    <div class="flex-center position-ref full-height">
        <div class="top-right links d-flex">
            <a href="{{ url('/') }}"><button type='submit' class="btn btn-default text-white font-weight-bold btn-flat">Home</button></a>
            @if (Auth::user())
                <form id="logout-form" action="{{ route('logout') }}" method="POST">
                    @csrf
                    <div class="pull-right">
                        <button type='submit' class="btn btn-default text-white font-weight-bold btn-flat">Sign out</button>
                    </div>
                </form>
            @endif
        </div>

        <div class="content">
            <div class="title m-b-md text-dark">
                Welcome {{ $aUser->name ?? 'User'}}
            </div>
            @if ($quiz->isEmpty())
                <h4 class="text-danger text-center">Sorry No Quiz Activated</h4>
            @else
            <div class="w-50 mx-auto">
                <div>
                    <h5>Select Quiz</h5>
                </div>
                <ul class="list-group">
                    @foreach ($quiz as $item)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                        {{$item->name}}
                        <div>
                            <span class="badge bg-primary mr-4 rounded-pill">{{count($item->questions)}}</span>
                            <a href="{{route('start.quiz',$item->id)}}">
                                <button class="btn btn-primary ">Start Quiz</button>
                            </a>
                        </div>
                        </li>
                    @endforeach
                  </ul>
            </div>
            @endif

        </div>
    </div>
@endsection
