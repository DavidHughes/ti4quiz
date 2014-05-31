<form method="POST" action="{{ url('meltdown-london/ti4-quiz/submit') }}" accept-charset="UTF-8">
  {{ Form::label('ti3-victor', 'Who won TI3?') }}
  {{ Form::radio('ti3-victor', 'Alliance') }} Alliance
  {{ Form::radio('ti3-victor', 'Na`Vi') }} Na`Vi

  {{ Form::submit('Done!') }}
</form>
