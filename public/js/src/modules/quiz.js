/* globals MDN */
var quiz = (function($, undefined) {
  'use strict';

  return {
    config: {
      questionsAskedSelector: '.quiz .form-group',
      answersChosenSelector: '.quiz input:checked'
    },
    areAllQuestionsAnswered: function() {
      var questionsAsked = $(this.config.questionsAskedSelector).length;
      var answersChosen = $(quiz.config.answersChosenSelector).length;

      return questionsAsked === answersChosen;
    },
    lockAnswers: function() {
      var $questionsAsked = $(quiz.config.questionsAskedSelector),
          $questionsAnswered = $(quiz.config.answersChosenSelector).closest('.form-group'),
          $unanswered = $questionsAsked.not($questionsAnswered);

      // Clear any alerts
      $('.quiz .alert-danger').removeClass('alert alert-danger');

      if ($unanswered.length === 0) {
        $('.quiz .radio').hide();
        $(quiz.config.answersChosenSelector).hide()
          .parent().parent().addClass('chosen-answer').show().css('margin-top', '10px');
      } else {
        $unanswered.addClass('alert alert-danger');
        $('html, body').animate({
          scrollTop: $unanswered.eq(0).scrollTop()
        }, 'slow');

        // Debug
        console.log('Questions asked: ', $questionsAsked);
        console.log('Questions answered: ', $questionsAnswered);
        console.log('Unanswered: ', $unanswered);
      }
    },
    markAsAnswered: function() {
      $(this).closest('.form-group').removeClass('alert alert-danger');
    },
    init: function(config) {
      $.extend(quiz.config, config);
      $('#lock-answers').click(quiz.lockAnswers);
      $('.quiz [type=radio]').click(quiz.markAsAnswered);
    }
  };
})(jQuery);

MDN.quiz = quiz;
