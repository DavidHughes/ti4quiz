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
	return View::make('meltdown/ti4quiz');
});

Route::post('meltdown-london/ti4-quiz/submit', function()
{
	$input = Input::all();

	if ($input['ti3-victor'] === 'Alliance') {
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
