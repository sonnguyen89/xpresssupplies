<?php

class td_widget_latest_works extends  WP_Widget{

    function td_widget_latest_works() {
        $widget_ops = array('classname' => 'widget-latest-portfolios widget_recent_entries', 'description' => esc_html__('A widget that displays the Latest portfolios.', 'thebigshop'));
        $control_ops = array('id_base' => 'td_widget_latest_works-widget');
        WP_Widget::__construct('td_widget_latest_works-widget', esc_html__('Latest Portfolios', 'thebigshop'), $widget_ops, $control_ops);
    }

    function widget($args, $instance) {
        extract($args);

        $title = apply_filters('widget_title', $instance['title']);

        //$display = isset($instance['display']) ? $instance['display'] : 'style1';
        $numberofitem = isset($instance['number']) ? $instance['number'] : 5;

        
        echo $before_widget;

        // Display the widget title 
        if ($title)
            echo $before_title . $title . $after_title;

        global $post;
        $portfolio = new WP_Query(array('post_type' => 'td_portfolio', 'posts_per_page' => $numberofitem));
?>
        <ul>
        <?php 
        while ($portfolio->have_posts()) : $portfolio->the_post();
            ?>
        <li>
        <a href="<?php the_permalink() ?>">
            <?php the_title(); ?>
	</a>
        </li>
            <?php
        endwhile;
        echo '</ul>';

        echo $after_widget;
    }

    function update($new_instance, $old_instance) {
        $instance = $old_instance;

        //Strip tags from title and name to remove HTML
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['number'] = $new_instance['number'];
        //$instance['display'] = $new_instance['display'];

        return $instance;
    }

    function form($instance) {
        //Set up some default widget settings.
        $defaults = array(
            'title' => esc_html__('Latest Work', 'thebigshop'),
            'number' => 5,
            //'display' => 'style1'
        );
        $instance = wp_parse_args((array) $instance, $defaults);
        ?>

        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php esc_html_e('Title:', 'thebigshop'); ?></label>
            <input type="text" class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo esc_attr($instance['title']); ?>" >
        </p>


        <p>
            <label for="<?php echo $this->get_field_id('number'); ?>"><?php esc_html_e('Number Of Post Show:', 'thebigshop'); ?></label>
            <input type="text" class="widefat" id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" value="<?php echo esc_attr($instance['number']); ?>" >
        </p>

        <?php
    }

}


class td_widget_portfolio_tags extends  WP_Widget{

    function td_widget_portfolio_tags() {
        $widget_ops = array('classname' => 'widget-portfolios-tags widget_tag_cloud', 'description' => esc_html__('A widget that displays the portfolios Tags.', 'thebigshop'));
        $control_ops = array('id_base' => 'td_widget_portfolio_tags-widget');
        WP_Widget::__construct('td_widget_portfolio_tags-widget', esc_html__('Portfolios Tags', 'thebigshop'), $widget_ops, $control_ops);
    }

    function widget($args, $instance) {
        extract($args);

        $title = apply_filters('widget_title', $instance['title']);

        //$display = isset($instance['display']) ? $instance['display'] : 'style1';
        //$numberofitem = isset($instance['number']) ? $instance['number'] : 5;

        
        echo $before_widget;

        // Display the widget title 
        if ($title)
            echo $before_title . $title . $after_title;


        global $post;
        $args = array( 'hide_empty=0' );
        $terms = get_terms("td_portfolio_tag",$args);
        $count = count($terms);
?>
        <div class="tagcloud">
        <?php 
            if ($count > 0) {
                foreach ($terms as $term) {
                    echo '<a href="' . esc_url( get_term_link($term )) . '" title="' . $term->name . '" rel="' . $term->name . '">' . $term->name . '</a>';
                }
            }
          
        echo '</div>';

        echo $after_widget;
    }

    function update($new_instance, $old_instance) {
        $instance = $old_instance;

        //Strip tags from title and name to remove HTML
        $instance['title'] = strip_tags($new_instance['title']);
        //$instance['number'] = $new_instance['number'];
        //$instance['display'] = $new_instance['display'];

        return $instance;
    }

    function form($instance) {
        //Set up some default widget settings.
        $defaults = array(
            'title' => esc_html__('Portfolio Tags', 'thebigshop'),
            'number' => 5,
            //'display' => 'style1'
        );
        $instance = wp_parse_args((array) $instance, $defaults);
        ?>

        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php esc_html_e('Title:', 'thebigshop'); ?></label>
            <input type="text" class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo esc_attr($instance['title']); ?>" >
        </p>

        <?php
    }

}

add_action('widgets_init', 'register_td_widgets'); // function to load my widget

function register_td_widgets() {
    register_widget('td_widget_latest_works');
    register_widget('td_widget_portfolio_tags');
}

?>
