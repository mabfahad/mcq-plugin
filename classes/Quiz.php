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
                        echo $quiz->post_content; ?></div>
                    <div class="quiz-questions">

                    </div>
                </div>
                <?php
            }
        }
    }
}