<form method="POST" action="{{ url('meltdown-london/ti4-quiz/submit') }}" accept-charset="UTF-8">

  <?php
  foreach ($quiz as $question) {
    echo Form::label($question['html-name'], $question['question']);

    foreach ($question['answers'] as $index=>$answer) {
      echo Form::radio($question['html-name'], $answer) . $answer;
    }
  }
  ?>

  {{ Form::submit('Done!') }}
</form>
