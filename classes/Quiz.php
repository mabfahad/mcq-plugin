<?php

class Quiz
{
    public function display()
    {
        $args    = array(
            'post_type'      => 'quiz',
            'post_status'    => 'publish',
            'posts_per_page' => -1,
            'orderby'        => 'date',
            'order'          => 'DESC',
        );
        $quizzes = get_posts($args);
        if ($quizzes) {
            foreach ($quizzes as $quiz) {
                ?>
                <div class="quiz-item">
                    <div class="quiz-title"><?php
                        echo $quiz->post_title; ?></div>
                    <div class="quiz-content"><?php
                        //echo $quiz->post_content; ?></div>
                    <div class="quiz-questions">
                        <?php
                        $args = array(
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
                        ?>
                        <ul>
                            <?php
                                foreach ($questions as $question) {
                                    ?>
                                    <li>
                                        <div class="question-title"><?php
                                            echo $question->post_title; ?></div>
                                        <div class="question-content"><?php
                                            echo $question->post_content; ?></div>
                                        <div class="question-answers">
                                            <?php
                                            $args = array(
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
                                            ?>
                                            <ul>
                                                <?php
                                                    foreach ($answers as $answer) {
                                                        ?>
                                                        <li>
                                                            <div class="answer-title"><?php
                                                                echo $answer->post_title; ?></div>
                                                        </li>
                                                        <?php
                                                    }
                                                ?>
                                            </ul>
                                        </div>
                                    </li>
                                    <?php
                                }
                            ?>
                            <li></li>
                        </ul>

                    </div>
                </div>
                <?php
            }
        }
    }
}