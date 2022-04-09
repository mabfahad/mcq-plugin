<?php

class Semeta
{
    function __construct()
    {
        add_action('admin_init', [$this, 'quiz_id_for_questions_meta_box']);
        add_action('save_post', [$this,'save_quiz_id_for_questions_meta_box_data']);

        add_action('admin_init', [$this, 'question_id_for_answers_meta_box']);
        add_action('save_post', [$this,'save_question_id_for_answers_meta_box_data']);

        add_action('admin_init', [$this, 'is_correct_answer_meta_box']);
        add_action('save_post', [$this,'save_is_correct_answer_meta_box_data']);

    }

    public static function quiz_id_for_questions_meta_box()
    {
        add_meta_box(
            'quiz-id',
            __('Quiz ID', 'se-mcq'),
            [Semeta::class, 'quiz_id_for_questions_meta_box_callback'],
            'questions',
            'side',
            'low'
        );
    }

    public static function question_id_for_answers_meta_box()
    {
        add_meta_box(
            'question-id',
            __('Question ID', 'se-mcq'),
            [Semeta::class, 'question_id_for_answers_meta_box_callback'],
            'answers',
            'side',
            'low'
        );
    }

    public static function question_id_for_answers_meta_box_callback($emp)
    {
        wp_nonce_field('question_id_nonce', 'question_id_nonce');
        $value = get_post_meta($emp->ID, '_question_id', true);
        ?>
        <select name="question_id" id="question_id">
            <option value="">Select Question</option>
            <?php
            $questions = get_posts([
                'post_type' => 'questions',
                'post_status' => 'publish',
                'posts_per_page' => -1
            ]);
            foreach ($questions as $question) {
                ?>
                <option value="<?php echo $question->ID; ?>" <?php echo $value == $question->ID ? 'selected' : ''; ?>><?php echo $question->post_title; ?></option>
                <?php
            }
            ?>
        </select>
        <?php

    }

    public static function quiz_id_for_questions_meta_box_callback($emp)
    {
        wp_nonce_field('quiz_id_nonce', 'quiz_id_nonce');
        $value = get_post_meta($emp->ID, '_quiz_id', true);
        ?>
        <select name="quiz_id" id="quiz_id">
            <option value="">Select Quiz</option>
            <?php
            $quizzes = get_posts([
                'post_type' => 'quiz',
                'post_status' => 'publish',
                'posts_per_page' => -1
            ]);
            foreach ($quizzes as $quiz) {
                ?>
                <option value="<?php echo $quiz->ID; ?>" <?php echo $value == $quiz->ID ? 'selected' : ''; ?>><?php echo $quiz->post_title; ?></option>
                <?php
            }
            ?>
        </select>
        <?php
    }


    public static function save_quiz_id_for_questions_meta_box_data($post_id)
    {
        if ( ! isset($_POST['quiz_id_nonce'])) {
            return;
        }
        if ( ! wp_verify_nonce($_POST['quiz_id_nonce'], 'quiz_id_nonce')) {
            return;
        }
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
            return;
        }

        if (isset($_POST['post_type']) && 'quiz' == $_POST['post_type']) {
            if ( ! current_user_can('edit_page', $post_id)) {
                return;
            }
        } else {
            if ( ! current_user_can('edit_post', $post_id)) {
                return;
            }
        }
        if ( ! isset($_POST['quiz_id'])) {
            return;
        }


        $id_data = sanitize_text_field($_POST['quiz_id']);
        update_post_meta($post_id, '_quiz_id', $id_data);
    }

    public static function save_question_id_for_answers_meta_box_data($post_id)
    {
        if ( ! isset($_POST['question_id_nonce'])) {
            return;
        }
        if ( ! wp_verify_nonce($_POST['question_id_nonce'], 'question_id_nonce')) {
            return;
        }
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
            return;
        }

        if (isset($_POST['post_type']) && 'answers' == $_POST['post_type']) {
            if ( ! current_user_can('edit_page', $post_id)) {
                return;
            }
        } else {
            if ( ! current_user_can('edit_post', $post_id)) {
                return;
            }
        }
        if ( ! isset($_POST['question_id'])) {
            return;
        }


        $id_data = sanitize_text_field($_POST['question_id']);
        update_post_meta($post_id, '_question_id', $id_data);
    }


    public static function is_correct_answer_meta_box()
    {

        add_meta_box(
            'is_correct_meta_box',
            'Is Correct?',
            [Semeta::class, 'display_is_correct_meta_box'],
            'answers',
            'side',
            'low'
        );
    }

    public static function display_is_correct_meta_box($emp)
    {
        wp_nonce_field('is_correct_nonce', 'is_correct_nonce');
        $value = get_post_meta($emp->ID, '_is_correct', true);
        ?>
        <input type="checkbox" name="is_correct" id="is_correct" value="1" <?php echo $value == 1 ? 'checked' : ''; ?>>
        <?php
    }


    public static function save_is_correct_answer_meta_box_data($post_id) {
//        echo "<pre>";print_r($_POST);echo "</pre>";exit();
        if ( ! isset($_POST['is_correct_nonce'])) {
            return;
        }
        if ( ! wp_verify_nonce($_POST['is_correct_nonce'], 'is_correct_nonce')) {
            return;
        }
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
            return;
        }

        if (isset($_POST['post_type']) && 'answers' == $_POST['post_type']) {
            if ( ! current_user_can('edit_page', $post_id)) {
                return;
            }
        } else {
            if ( ! current_user_can('edit_post', $post_id)) {
                return;
            }
        }
        if ( ! isset($_POST['is_correct'])) {
            delete_post_meta($post_id, '_is_correct');
        }
        $id_data = sanitize_text_field($_POST['is_correct']);
        update_post_meta($post_id, '_is_correct', $id_data);
    }
}

new Semeta();