
@if ($question && count($question->options))
{!! Form::open(['action' => ['user\QuizController@submit', $quiz_result->id], 'role' => 'form', 'onsubmit'=>"return submitFrm(this)"]) !!}
<ul>
    <li>
        <span>Ques. All Question is Multipal choice </span>
    </li>
    <li>
        <span>Ques. All Question are compulsory</span>
    </li>
</ul>
<br>
<h4 class="card-title mt-2">{{$question->question}}</h4>
{!! Form::hidden('quiz_id', $quiz_result->quiz_id) !!}
{!! Form::hidden('question', $question->id) !!}
@foreach ($question->options as $key => $item)
    <div class="mx-3">
            <label for="{{$key}}_key" class="btn btn-info mb-2">
                <input type="checkbox" name="ans[]" id="{{$key}}_key" value="{{++$key}}">&nbsp;&nbsp;{{$item}}
            </label>
    </div>
@endforeach
<div class="text-center">
    {!! Form::submit('Submit', ['class'=>'mt-4 btn btn-info']) !!}
</div>
{!! Form::close() !!}
@endif
