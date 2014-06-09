<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function()
{
	return View::make('hello');
});

Route::get('meltdown-london/ti4-quiz', function()
{
	$quiz = getQuiz();
	return View::make('meltdown/ti4quiz', $quiz);
});

Route::post('meltdown-london/ti4-quiz/submit', function()
{
	$input = Input::all();

	if (areAnswersCorrect($input)) {
		return Redirect::to('meltdown-london/ti4-quiz/submitted/victory');
	} else {
		return Redirect::to('meltdown-london/ti4-quiz/submitted/defeat');
	}
});

Route::get('meltdown-london/ti4-quiz/submitted/{result}', function($result)
{
	switch($result) {
		case 'victory':
			return 'You win!';
		case 'defeat':
			return 'You lose! (Good day, sir!)';
		default:
			return 'You aren\'t meant to be here!';
	}
});

function getQuiz() {
	return array(
		'quiz' => array(
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

function areAnswersCorrect($input) {
	$quiz = getQuiz()['quiz'];
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
