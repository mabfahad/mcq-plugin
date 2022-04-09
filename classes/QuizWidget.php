<?php

class QuizWidget extends WP_Widget
{
    public function __construct() {
		parent::__construct(
			'quizqidget',
			__( 'Quiz Widget', 'se-mcq' ),
			array( 'description' => __( 'Quiz Widget Description', 'se-mcq' ) )
		);
	}

	public function form($instance) {
        $title = ! empty( $instance['title'] ) ? $instance['title'] : __( 'New title', 'se-mcq' );
        ?>
        <p>
            <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
        </p>

        <?php
    }

    public function widget( $args, $instance ) {
		//print_r($args);

		echo $args['before_widget'];
		if ( isset( $instance['title'] ) && $instance['title'] != '' ) {
			echo $args['before_title'];
			echo apply_filters( 'widget_title', $instance['title'] );
			echo $args['after_title'];
			?>
            <div class="quizwidget <?php echo esc_attr( $args['id'] ); ?>">
                <?php
                $args = array(
                    'post_type' => 'quiz',
                    'post_status' => 'publish',
                    'posts_per_page' => -1,
                    'orderby' => 'date',
                    'order' => 'DESC',
                );
                $quizzes = get_posts( $args );
                print_r($quizzes);
                ?>
            </div>
			<?php
		}
		echo $args['after_widget'];

	}

	public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';

        return $instance;
    }
}