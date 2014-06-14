@extends('layouts.base')

@section('title')
Meltdown London TI4 Quiz
@stop

@section('content')
<form role="form" method="POST" action="{{ url('meltdown-london/ti4-quiz/submit') }}" accept-charset="UTF-8">
  <fieldset class="quiz">
    <h1>Quiz</h1>
    @foreach ($questions as $question)
      <div class="form-group">
        {{ Form::label($question['html-name'], $question['question']) }}

        @foreach ($question['answers'] as $index=>$answer)
        <div class="radio">
          <label>
          {{ Form::radio($question['html-name'], $answer, false) . $answer }}
          </label>
        </div>
        @endforeach
      </div>
    @endforeach
    <button type="button" id="lock-answers" class="btn btn-primary">Lock my answers</button>
  </fieldset>

  <fieldset class="contact-details">
    <h1>Contact Details</h1>
    <div class="form-group">
      {{ Form::label('email', 'Email') }}
      {{ Form::email('email') }}
    </div>
  </fieldset>

  {{ Form::submit('Done!') }}
</form>
@stop
