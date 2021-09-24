@extends('user.layout.layout')

@section('content')
    <div class="container-fluid py-4 my-4 ">
        <div class="card border-primary mb-3 w-50 mx-auto">
            <div class="card-header h3 text-center">Quiz {{$quiz_result->quiz->name}} </div>
            <div class="card-body py-4" id="questions">
                <div class="modal-loader" style="display:none">
                    <i class="fa fa-spinner fa-pulse fa-3x fa-fw text-size50 text-white"></i>
                </div>
                <span>
                    {{-- if quiz is not complited --}}
                    @if ($quiz_result->status)
                    @include('user.__start-quiz-question')
                    @else
                    @include('user.quiz-result')
                    @endif
                </span>
            </div>
        </div>
    </div>
@endsection


