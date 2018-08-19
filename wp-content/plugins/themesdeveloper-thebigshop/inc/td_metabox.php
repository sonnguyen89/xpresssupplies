<?php

/* for add Taxonomies -Start */
 add_action('init', 'td_create_slider_taxonomy');

  function td_create_slider_taxonomy() {

  $labels = array(
  'name' => _x('Category', 'taxonomy general name', 'thebigshop'),
  'singular_name' => _x('category', 'taxonomy singular name', 'thebigshop'),
  'search_items' => esc_html__('Search Category', 'thebigshop'),
  'all_items' => esc_html__('All Category', 'thebigshop'),
  'parent_item' => esc_html__('Parent Category', 'thebigshop'),
  'parent_item_colon' => esc_html__('Parent Category:', 'thebigshop'),
  'edit_item' => esc_html__('Edit Category', 'thebigshop'),
  'update_item' => esc_html__('Update Category', 'thebigshop'),
  'add_new_item' => esc_html__('Add New Category', 'thebigshop'),
  'new_item_name' => esc_html__('New Category Name', 'thebigshop'),
  'menu_name' => esc_html__('Categories', 'thebigshop'),
  );

  register_taxonomy('td_slider_cat', 'td_slider',$args = array(
  'hierarchical' => true,
  'labels' => $labels,
  'show_ui' => true,
  'show_admin_column' => true,
  'query_var' => true,
  'rewrite' => array('slug' => 'categories'),
  ));
  } 

add_action('init', 'td_create_portfolio_taxonomy');

function td_create_portfolio_taxonomy() {

    $taglabels = array(
        'name' => _x('Tag', 'taxonomy general name', 'thebigshop'),
        'singular_name' => _x('tag', 'taxonomy singular name', 'thebigshop'),
        'search_items' => esc_html__('Search tag', 'thebigshop'),
        'all_items' => esc_html__('All tag', 'thebigshop'),
        'parent_item' => esc_html__('Parent tag', 'thebigshop'),
        'parent_item_colon' => esc_html__('Parent tag:', 'thebigshop'),
        'edit_item' => esc_html__('Edit tag', 'thebigshop'),
        'update_item' => esc_html__('Update tag', 'thebigshop'),
        'add_new_item' => esc_html__('Add Portfolio tag', 'thebigshop'),
        'new_item_name' => esc_html__('New tag Name', 'thebigshop'),
        'menu_name' => esc_html__('Tag', 'thebigshop'),
    );
     register_taxonomy('td_portfolio_tag', 'td_portfolio',array(
        'hierarchical' => true,
        'labels' => $taglabels,
        'show_ui' => true,
        'show_admin_column' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'tag'),
    ));
}

/* for add Taxonomies -END */

/* for add Taxonomies Custom Field -Start */
if (isset($_REQUEST['sliderlinks'])) {
    add_action('save_post', 'td_save_td_slider_meta');
}
add_action("add_meta_boxes", "td_td_slider_metabox");

function td_save_td_slider_meta() {
    global $post;
    update_post_meta($post->ID, "sliderlinks", sanitize_text_field($_REQUEST["sliderlinks"]));
}

function td_td_slider_metabox() {
    add_meta_box("td_td_slider_meta", "Slider Options", "td_td_slider_meta", "td_slider", "normal", "high");
}

function td_td_slider_meta() {
    global $post;
    $slidermeta = get_post_custom($post->ID);
    //print_r($slidermeta);
    $sliderlinks=isset( $slidermeta['sliderlinks'][0]) ? $slidermeta['sliderlinks'][0] : '';
 ?>
   <p>
        <label for="slider_links"><?php esc_html_e('Slider Link Here', 'thebigshop'); ?></label>
        <input type="text" name="sliderlinks" id="sliderlinks" style="width:100%" value="<?php echo esc_url($sliderlinks); ?>" />
    </p>
<?php } ?>
<?php
if (isset($_REQUEST['portfolio_links'])) {
     add_action('save_post', 'td_save_td_portfolio_meta');
}
add_action("admin_init", "td_td_portfolio_metabox");

function td_save_td_portfolio_meta() {
    global $post;
    update_post_meta($post->ID, "portfolio_links", sanitize_text_field($_REQUEST["portfolio_links"]));
}

function td_td_portfolio_metabox() {
    add_meta_box("td_td_portfolio_meta", "Portfolio Options", "td_td_portfolio_meta", "td_portfolio", "normal", "high");
   
}

function td_td_portfolio_meta() {
    global $post;
    $portfoliometa = get_post_custom($post->ID);
    //print_r($slidermeta);
     $portfoliolinks=isset( $portfoliometa['portfolio_links'][0]) ? $portfoliometa['portfolio_links'][0] : '';
     ?>
   <p>
        <label for="portfolio_links"><?php esc_html_e('Add Portfolio Link Here', 'thebigshop'); ?></label>
        <input type="text" name="portfolio_links" id="portfolio_links" style="background-color: #fff; font-size: 1.7em; height: 1.7em; line-height: 100%; margin: 0 0 3px; outline: medium none; padding: 3px 8px; width: 100%;" value="<?php echo esc_url($portfoliolinks); ?>" />
    </p>

<?php }

add_action("add_meta_boxes", "td_page_metabox");
function td_page_metabox(){
add_meta_box('td_page_meta', 'Page Options', 'td_page_meta', 'page', 'side', 'high');
}
function td_page_meta(){
     // $post is already set, and contains an object: the WordPress post
    global $post;
    $values = get_post_custom( $post->ID );
  
    //print_r($values);

    //$text = isset( $values['my_meta_box_text']) ? $values['my_meta_box_text'][0]: '';
    $selected = isset( $values['tdtheme_page_sidebar_position'] ) ? esc_attr( $values['tdtheme_page_sidebar_position'][0] ) : 'full';
    $headertitle = isset( $values['hide_page_title'] ) ? esc_attr( $values['hide_page_title'][0] ) : '';
    $breadcrumb = isset( $values['hide_page_breadcrumb'] ) ? esc_attr( $values['hide_page_breadcrumb'][0] ) : '';
    $pagemargin=isset( $values['hide_page_margin'] ) ? esc_attr( $values['hide_page_margin'][0] ) : '';
    // We'll use this nonce field later on when saving.
    wp_nonce_field( 'meta_box_nonce', 'page_meta_box_nonce' );
    ?>

    <p>
        <label for="tdtheme_page_sidebar_position"><?php esc_html_e('Page Layout', 'thebigshop'); ?> :</label>
        <select name="tdtheme_page_sidebar_position" id="tdtheme_page_sidebar_position">
            <option value="full" <?php selected( $selected, 'full' ); ?>><?php esc_html_e('No Sidebar', 'thebigshop'); ?></option>
            <option value="left" <?php selected( $selected, 'left' ); ?>><?php esc_html_e('Left Sidebar', 'thebigshop'); ?></option>
            <option value="right" <?php selected( $selected, 'right' ); ?>><?php esc_html_e('Right Sidebar', 'thebigshop'); ?></option>
        </select>
    </p>
     
    <p>
        <input type="checkbox" id="hide_page_title" name="hide_page_title" <?php checked( $headertitle, 'on' ); ?> />
        <label for="hide_page_title"><?php esc_html_e('Hide Page Title', 'thebigshop'); ?></label>
    </p>
    <p>
        <input type="checkbox" id="hide_page_breadcrumb" name="hide_page_breadcrumb" <?php checked( $breadcrumb, 'on' ); ?> />
        <label for="hide_page_breadcrumb"><?php esc_html_e('Hide Page Breadcrumb', 'thebigshop'); ?></label>
    </p>
   <p>
        <input type="checkbox" id="hide_page_margin" name="hide_page_margin" <?php checked( $pagemargin, 'on' ); ?> />
        <label for="hide_page_margin"><?php esc_html_e('Hide Page Top and Bottom Margin', 'thebigshop'); ?></label>
    </p>
<?php
}
add_action( 'save_post', 'tdtheme_td_meta_box_save' );
function tdtheme_td_meta_box_save( $post_id )
{

    // Bail if we're doing an auto save
    if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
     
    // if our nonce isn't there, or we can't verify it, bail
     if( !isset( $_POST['page_meta_box_nonce'] ) || !wp_verify_nonce( $_POST['page_meta_box_nonce'], 'meta_box_nonce' ) ) return;
     
   // if our current user can't edit this post, bail
   if( !current_user_can( 'edit_post' ) ) return;
     
    // now we can actually save the data
  /* $allowed = array( 
        'a' => array( // on allow a tags
            'href' => array() // and those anchors can only have href attribute
        )
    );*/
 
    // Make sure your data is set before trying to save it
    if( isset( $_POST['tdtheme_page_sidebar_position'] ) )
        update_post_meta( $post_id, 'tdtheme_page_sidebar_position', esc_attr( $_POST['tdtheme_page_sidebar_position'] ) );
         
    // This is purely my personal preference for saving check-boxes
    $chk = isset( $_POST['hide_page_title'] ) && $_POST['hide_page_title'] ? 'on' : 'off';
    update_post_meta( $post_id, 'hide_page_title', $chk );
    
    $hide_page_breadcrumb = isset( $_POST['hide_page_breadcrumb'] ) && $_POST['hide_page_breadcrumb'] ? 'on' : 'off';
    update_post_meta( $post_id, 'hide_page_breadcrumb', $hide_page_breadcrumb );
    
    $hide_page_margin = isset( $_POST['hide_page_margin'] ) && $_POST['hide_page_margin'] ? 'on' : 'off';
    update_post_meta( $post_id, 'hide_page_margin', $hide_page_margin );
}