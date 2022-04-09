<?php

/*
 * Get Quiz Details By Quiz ID
 * @route       /oe/v1/quiz?quiz_id=100
 * @params      quiz_id
 * @returns     Get Quiz Details By Quiz ID
 */
add_action( 'rest_api_init', function () {
  register_rest_route( 'mcq', '/quiz/(?P<quiz_id>\d+)', array(
    'methods' => 'GET',
    'callback' => ['QuizApi','get_quiz_details'],
    'permission_callback' => '__return_true'
  ) );
} );


/*
 * Submit Exam
 * @route       /mcq/submit/quiz_id=100
 * @params      quiz_id
 * @method      POST
 * @returns     Quiz Results
 */
add_action( 'rest_api_init', function () {
  register_rest_route( 'mcq', '/submit/(?P<quiz_id>\d+)', array(
    'methods' => 'POST',
    'callback' => ['QuizApi','submit'],
    'permission_callback' => '__return_true'
  ) );
} );