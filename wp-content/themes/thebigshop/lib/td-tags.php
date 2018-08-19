<?php
/**
 * Custom TheBigshop template tags
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package ThemesDeveloper
 * @subpackage thebigshop
 * @since 1.0
 * @TheBigshop 1.0
 */
if (!function_exists('thebigshop_post_thumbnail')) :

    /**
     * Displays an optional post thumbnail.
     *
     * Wraps the post thumbnail in an anchor element on index views, or a div
     * element when on single views.
     *
     * Create your own thebigshop_post_thumbnail() function to override in a child theme.
     *
     * @since TheBigshop 1.0
     */
    function thebigshop_post_thumbnail() {
        if (post_password_required() || is_attachment() || !has_post_thumbnail()) {
            return;
        }

        if (is_singular()) :
            ?>

            <div class="post-thumbnail">
                <?php the_post_thumbnail(); ?>
            </div><!-- .post-thumbnail -->

        <?php else : ?>

            <a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true">
                <?php the_post_thumbnail('post-thumbnail', array('alt' => the_title_attribute('echo=0'))); ?>
            </a>

        <?php
        endif; // End is_singular()
    }

endif;

if (!function_exists('thebigshop_excerpt')) :

    /**
     * Displays the optional excerpt.
     *
     * Wraps the excerpt in a div element.
     *
     * Create your own thebigshop_excerpt() function to override in a child theme.
     *
     * @since TheBigshop 1.0
     *
     * @param string $class Optional. Class string of the div element. Defaults to 'entry-summary'.
     */
    function thebigshop_excerpt($class = 'entry-summary') {
        $class = esc_attr($class);

        if (has_excerpt() || is_search()) :
            ?>
            <div class="<?php echo esc_attr($class); ?>">
                <?php the_excerpt(); ?>
            </div>
            <?php
        endif;
    }

endif;

if (!function_exists('thebigshop_excerpt_more') && !is_admin()) :

    /**
     * Replaces "[...]" (appended to automatically generated excerpts) with ... and
     * a 'Continue reading' link.
     *
     * Create your own thebigshop_excerpt_more() function to override in a child theme.
     *
     * @since TheBigshop 1.0
     *
     * @return string 'Continue reading' link prepended with an ellipsis.
     */
    function thebigshop_excerpt_more() {
        $link = sprintf('<a href="%1$s" class="more-link">%2$s</a>', esc_url(get_permalink(get_the_ID())),
                /* translators: %s: Name of current post */ esc_html__('Continue reading', 'thebigshop')
        );
        return ' &hellip; ' . $link;
    }

    add_filter('excerpt_more', 'thebigshop_excerpt_more');
endif;

/**
 * Determines whether blog/site has more than one category.
 *
 * Create your own thebigshop_categorized_blog() function to override in a child theme.
 *
 * @since TheBigshop 1.0
 *
 * @return bool True if there is more than one category, false otherwise.
 */
function thebigshop_categorized_blog() {
    if (false === ( $all_the_cool_cats = get_transient('thebigshop_categories') )) {
        // Create an array of all the categories that are attached to posts.
        $all_the_cool_cats = get_categories(array(
            'fields' => 'ids',
            // We only need to know if there is more than one category.
            'number' => 2,
        ));

        // Count the number of categories that are attached to the posts.
        $all_the_cool_cats = count($all_the_cool_cats);

        set_transient('thebigshop_categories', $all_the_cool_cats);
    }

    if ($all_the_cool_cats > 1) {
        // This blog has more than 1 category so thebigshop_categorized_blog should return true.
        return true;
    } else {
        // This blog has only 1 category so thebigshop_categorized_blog should return false.
        return false;
    }
}

/**
 * Flushes out the transients used in thebigshop_categorized_blog().
 *
 * @since TheBigshop 1.0
 */
function thebigshop_category_transient_flusher() {
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    // Like, beat it. Dig?
    delete_transient('thebigshop_categories');
}

add_action('edit_category', 'thebigshop_category_transient_flusher');
add_action('save_post', 'thebigshop_category_transient_flusher');




if (!function_exists('thebigshop_entry_date')) :

    /**
     * Prints HTML with date information for current post.
     *
     * Create your own thebigshop_entry_date() function to override in a child theme.
     *
     * @since TheBigshop 1.0
     */
    function thebigshop_entry_date() {
        $time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';

        $time_string = sprintf($time_string, esc_attr(get_the_date('c')), get_the_date(), esc_attr(get_the_modified_date('c')), get_the_modified_date()
        );

        printf('<span class="posted-on"><span class="screen-reader-text">%1$s</span>%2$s</span>', _x('Posted on', 'Used before publish date.', 'thebigshop'), $time_string
        );
    }

endif;

if (!function_exists('thebigshop_entry_byline')) :

    function thebigshop_entry_byline() {
        if(get_the_author_meta('ID')){
        printf('<span class="byline"><span class="screen-reader-text">%2$s </span> <a class="url fn n" href="%3$s">%4$s</a></span></span>', '', _x('&nbsp; by', 'Used before post author name.', 'thebigshop'), esc_url(get_author_posts_url(get_the_author_meta('ID'))), get_the_author()
        );
        }
    }

endif;


if (!function_exists('thebigshop_entry_meta')) :

    /**
     * Prints HTML with meta information for the categories, tags.
     *
     * Create your own thebigshop_entry_meta() function to override in a child theme.
     *
     * @since TheBigshop 1.0
     */
    function thebigshop_entry_meta() {

        if ('post' === get_post_type()) {
            thebigshop_entry_taxonomies();
        }

        if (!is_singular() && !post_password_required() && ( comments_open() || get_comments_number() )) {
            echo '<span class="comments-link">';
            comments_popup_link(esc_html__('Leave a comment', 'thebigshop'));
            echo '</span>';
        }
    }

endif;

if (!function_exists('thebigshop_entry_taxonomies')) :

    /**
     * Prints HTML with category and tags for current post.
     *
     * Create your own thebigshop_entry_taxonomies() function to override in a child theme.
     *
     * @since TheBigshop 1.0
     */
    function thebigshop_entry_taxonomies() {
        $categories_list = get_the_category_list(_x(', ', 'Used between list items, there is a space after the comma.', 'thebigshop'));
        if ($categories_list && thebigshop_categorized_blog()) {
            printf('<span class="cat-links"><span class="screen-reader-text">%1$s </span>%2$s</span>', _x('Categories', 'Used before category names.', 'thebigshop'), $categories_list
            );
        }

        $tags_list = get_the_tag_list('', _x(', ', 'Used between list items, there is a space after the comma.', 'thebigshop'));
        if ($tags_list) {
            printf('<span class="tags-links"><span class="screen-reader-text">%1$s </span>%2$s</span>', _x('Tags', 'Used before tag names.', 'thebigshop'), $tags_list
            );
        }
    }

endif;

if (!function_exists('thebigshop_post_edit_link')) :

    function thebigshop_post_edit_link() {
        echo edit_post_link( sprintf( wp_kses(__('Edit<span class="screen-reader-text"> "%s"</span>', 'thebigshop'), array('span' => array('class' => array()))), get_the_title()), '<span class="edit-link">', '</span>');
    }
endif;
 
 