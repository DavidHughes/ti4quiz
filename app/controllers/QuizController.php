<?php

class QuizController extends BaseController {
  private $quiz;

  public function __construct() {
    $this->quiz = self::getQuiz();
  }

  public static function getQuiz() {
    return array(
      'questions' => array(
        array(
          'html-name' => 'long-name',
          'question' => 'Who is the longest named player in the Swedish team Alliance?',
          'answers' => array('Akke', 'Loda', 'Admiral Bulldog'),
        ),
        array(
          'html-name' => 'easy-question',
          'question' => 'Which is the correct answer',
          'answers' => array('Not this one', 'The correct one'),
        )
      )
    );
  }

  /*
   * Get the current round's questions and render a view for it.
   */
  public function index() {
    error_log('Quiz = ' . serialize($this->quiz));
    return View::make('meltdown/ti4quiz', $this->quiz);
  }

  /*
   * Form is submitted after user supplies contact details,
   * store in database & verify answers.
   */
  public function handleSubmission()
  {
    error_log('Quiz = ' . serialize($this->quiz));
    $answers = Input::all();

    if ($this->areAnswersCorrect($this->quiz['questions'], $answers)) {
      return Redirect::to('meltdown-london/ti4-quiz/submitted/victory');
    } else {
      return Redirect::to('meltdown-london/ti4-quiz/submitted/defeat');
    }
  }

  public function showOutcome($result) {
    switch($result) {
      case 'victory':
        return 'You win!';
      case 'defeat':
        return 'You lose! (Good day, sir!)';
      default:
        return 'You aren\'t meant to be here!';
    }
  }

  public function areAnswersCorrect($quiz, $input) {
    $answers = array(
      2, 1
    );
    $passed = true;

    foreach ($answers as $key=>$answer) {
      if ($quiz[$key]['answers'][$answer] !== $input[($quiz[$key]['html-name'])]) {
        $passed = false;
      }
    }

    return $passed;
  }
}
