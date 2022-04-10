<?php

class QuizApi
{
    public static function get_quiz_details($request) {
        $quiz_id   = $request['quiz_id'];

        $quiz      = get_post($quiz_id);

        if (!$quiz) return new WP_Error( 'Not Found!', 'Quiz not found', array( 'status' => 403 ) );

        if ($quiz->post_type != 'quiz') return new WP_Error( 'Not Found!', 'Quiz not found', array( 'status' => 403 ) );


        $results = new stdClass();
        $results->quiz_title = $quiz->post_title;
//        $results->quiz_desc = $quiz->post_content;
        $results->quiz_id = $quiz_id;
        $args      = array(
            'post_type'      => 'questions',
            'post_status'    => 'publish',
            'posts_per_page' => -1,
            'orderby'        => 'date',
            'order'          => 'DESC',
            'meta_query'     => array(
                array(
                    'key'     => '_quiz_id',
                    'value'   => $quiz->ID,
                    'compare' => '=',
                ),
            ),
        );

        $questions = get_posts($args);


        $allQuestions = [];
        foreach ($questions as $question) {
            $args    = array(
                'post_type'      => 'answers',
                'post_status'    => 'publish',
                'posts_per_page' => -1,
                'orderby'        => 'date',
                'order'          => 'DESC',
                'meta_query'     => array(
                    array(
                        'key'     => '_question_id',
                        'value'   => $question->ID,
                        'compare' => '=',
                    ),
                ),
            );

            $answers = get_posts($args);
            $allAnswers = [];
            foreach ($answers as $answer) {
                $allAnswers[] = $answer->post_title;
            }
            $allQuestions[] = array(
                'question_id' => $question->ID,
                'question'    => $question->post_title,
                'answers' => $allAnswers,
            );
        }
        $results->questions = $allQuestions;

        $response = new WP_REST_Response( $results );
        $response->set_status( 200 );
        $response->set_headers( array( 'Cache-Controls' => 'no-cache' ) );

        return $response;

    }

    public static function submit($request)
    {
        $body           = $request->get_body();
        $json_from_body     = json_decode( $body, true );
        $marked_answers = $json_from_body['marked_answers'][0];

        $score = 0;
        foreach ($marked_answers as $quesiton=>$marked_answer) {
            if (get_post_meta($marked_answer, '_is_correct', true)) {
                $score++;
            }
        }

        $results = new stdClass();
        $results->message = 'Your score is ' . $score;

        $response = new WP_REST_Response( $results );
        $response->set_status( 200 );
        $response->set_headers( array( 'Cache-Controls' => 'no-cache' ) );
        return $response;
    }

}