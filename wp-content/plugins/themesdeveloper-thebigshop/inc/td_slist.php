<?php

add_action('vc_before_init', 'td_shortcodes_list');
//[td_slider type="flaxslider/nivoslider" per_page="" cat="" order="" orderby=""]
function td_shortcodes_list($atts = null, $content = null) {
    vc_map(array(
        'name' => esc_html__('Slider', 'thebigshop'),
        'base' => 'td_slider',
        'class' => 'td_slider',
        'icon' => get_template_directory_uri() . '/assets/images/icon.jpg',
        'category' => esc_html__('ThemesDeveloper', 'thebigshop'),
        "params" => array(
            array(
                "type" => "dropdown",
                "class" => "",
                "heading" => esc_html__("Type", 'thebigshop'),
                "param_name" => "type",
                "value" => array(esc_html__('Nivoslider', 'marketshop') => 'nivoslider', esc_html__('Flexslider', 'marketshop') => 'flaxslider',esc_html__('OWL Slider', 'marketshop') => 'owlslider'),
                "admin_label" => true,
                "description" => esc_html__("Select Type of slider!", 'thebigshop')
            ),
            array(
                "type" => "textfield",
                "class" => "",
                "heading" => esc_html__("Number Of Slider", 'thebigshop'),
                "param_name" => "per_page",
                "value" => '',
                "description" => esc_html__("Display Number Of Slider!", 'thebigshop')
            ),
            array(
                "type" => "textfield",
                "class" => "",
                "heading" => esc_html__("Category Slug", 'thebigshop'),
                "param_name" => "cat",
                "value" => '',
                "description" => esc_html__("Display Slider by Slug.", 'thebigshop')
            ),
              array(
                "type" => "dropdown",
                "class" => "",
                "heading" => esc_html__("Order by", 'thebigshop'),
                "param_name" => "orderby",
                "value" => array('date','rand', 'name', 'title'),
            ),
             array(
                "type" => "dropdown",
                "class" => "",
                "heading" => esc_html__("Order", 'thebigshop'),
                "param_name" => "order",
                "value" => array('DESC', 'ASC'),
            ),
        )
    )
    );
    vc_map(array(
        'name' => esc_html__('Product Categories Carousel', 'thebigshop'),
        'base' => 'td_product_categories',
        'class' => 'td_product_categories',
        'icon' => get_template_directory_uri() . '/assets/images/icon.jpg',
        'category' => esc_html__('ThemesDeveloper', 'thebigshop'),
        "params" => array(
             array(
                "type" => "textfield",
                "class" => "",
                "heading" => esc_html__("Title", 'thebigshop'),
                "param_name" => "title",
                "value" => esc_html__("Top Categories", 'thebigshop'),
                "description" => esc_html__("Display Block Title.", 'thebigshop')
            ),
           array(
                "type" => "textfield",
                "class" => "",
                "heading" => esc_html__("Number of Category", 'thebigshop'),
                "param_name" => "number",
                "value" => '',
                "description" => esc_html__("Number of Category Show in block.", 'thebigshop')
            ),
            array(
                "type" => "textfield",
                "class" => "",
                "heading" => esc_html__("Number of Column", 'thebigshop'),
                "param_name" => "columns",
                "value" => '',
                "description" => esc_html__("Number of category show in Column", 'thebigshop')
            ),
             array(
                "type" => "textfield",
                "class" => "",
                "heading" => esc_html__("Category Parent ID", 'thebigshop'),
                "param_name" => "parent",
                "value" => '',
                "description" => esc_html__("Display Category List By Parent.", 'thebigshop')
            ),
            array(
                "type" => "dropdown",
                "class" => "",
                "heading" => esc_html__("Order by", 'thebigshop'),
                "param_name" => "orderby",
                "value" => array('name','date','rand', 'title'),
            ),
             array(
                "type" => "dropdown",
                "class" => "",
                "heading" => esc_html__("Order", 'thebigshop'),
                "param_name" => "order",
                "value" => array('DESC', 'ASC'),
            ),
        )
            )
    );
     vc_map(array(
        'name' => esc_html__('Products By Category Carousel', 'thebigshop'),
        'base' => 'td_products_by_category',
        'class' => 'td_products_by_category',
        'icon' => get_template_directory_uri() . '/assets/images/icon.jpg',
        'category' => esc_html__('ThemesDeveloper', 'thebigshop'),
        "params" => array(
           array(
                "type" => "textfield",
                "class" => "",
                "heading" => esc_html__("Number Of Products", 'thebigshop'),
                "param_name" => "per_page",
                "value" => '',
                "description" => esc_html__("Number of Products Show by Category.", 'thebigshop')
            ),
            array(
                "type" => "textfield",
                "class" => "",
                "heading" => esc_html__("Number of Column", 'thebigshop'),
                "param_name" => "columns",
                "value" => '',
                "description" => esc_html__("Number of Products show in Column", 'thebigshop')
            ),
             array(
                "type" => "textfield",
                "class" => "",
                "heading" => esc_html__("Category Slug", 'thebigshop'),
                "param_name" => "slug",
                "value" => '',
                "description" => esc_html__("Add to Category Slug, which category products want to show.", 'thebigshop')
            ),
           array(
                "type" => "dropdown",
                "class" => "",
                "heading" => esc_html__("Order by", 'thebigshop'),
                "param_name" => "orderby",
                "value" => array('date','rand', 'name', 'title'),
            ),
             array(
                "type" => "dropdown",
                "class" => "",
                "heading" => esc_html__("Order", 'thebigshop'),
                "param_name" => "order",
                "value" => array('DESC', 'ASC'),
            ),
           
        )
            )
    );
    vc_map(array(
        'name' => esc_html__('Best Selling Products Carousel', 'thebigshop'),
        'base' => 'td_best_selling_products',
        'class' => 'td_best_selling_products',
        'icon' => get_template_directory_uri() . '/assets/images/icon.jpg',
        'category' => esc_html__('ThemesDeveloper', 'thebigshop'),
        "params" => array(
             array(
                "type" => "textfield",
                "class" => "",
                "heading" => esc_html__("Title", 'thebigshop'),
                "param_name" => "title",
                "value" => esc_html__("Best Selling", 'thebigshop'),
                "description" => esc_html__("Display Block Title.", 'thebigshop')
            ),
            array(
                "type" => "textfield",
                "class" => "",
                "heading" => esc_html__("Number Of Products", 'thebigshop'),
                "param_name" => "per_page",
                "value" => '',
                "description" => esc_html__("Number of Products Show.", 'thebigshop')
            ),
            array(
                "type" => "textfield",
                "class" => "",
                "heading" => esc_html__("Number of Column", 'thebigshop'),
                "param_name" => "columns",
                "value" => '',
                "description" => esc_html__("Number of Products show in Column", 'thebigshop')
            ),
            )
         )
    );
    vc_map(array(
        'name' => esc_html__('Recent Products Carousel', 'thebigshop'),
        'base' => 'td_recent_products',
        'class' => 'td_recent_products',
        'icon' => get_template_directory_uri() . '/assets/images/icon.jpg',
        'category' => esc_html__('ThemesDeveloper', 'thebigshop'),
        "params" => array(
             array(
                "type" => "textfield",
                "class" => "",
                "heading" => esc_html__("Title", 'thebigshop'),
                "param_name" => "title",
                "value" => esc_html__("Recent Products", 'thebigshop'),
                "description" => esc_html__("Display Block Title.", 'thebigshop')
            ),
            array(
                "type" => "textfield",
                "class" => "",
                "heading" => esc_html__("Number Of Products", 'thebigshop'),
                "param_name" => "per_page",
                "value" => '',
                "description" => esc_html__("Number of Products Show.", 'thebigshop')
            ),
            array(
                "type" => "textfield",
                "class" => "",
                "heading" => esc_html__("Number of Column", 'thebigshop'),
                "param_name" => "columns",
                "value" => '',
                "description" => esc_html__("Number of Products show in Column", 'thebigshop')
            ),
            )
         )
    );
    vc_map(array(
        'name' => esc_html__('Featured Products Carousel', 'thebigshop'),
        'base' => 'td_featured_products',
        'class' => 'td_featured_products',
        'icon' => get_template_directory_uri() . '/assets/images/icon.jpg',
        'category' => esc_html__('ThemesDeveloper', 'thebigshop'),
        "params" => array(
             array(
                "type" => "textfield",
                "class" => "",
                "heading" => esc_html__("Title", 'thebigshop'),
                "param_name" => "title",
                "value" => esc_html__("Featured Products", 'thebigshop'),
                "description" => esc_html__("Display Block Title.", 'thebigshop')
            ),
            array(
                "type" => "textfield",
                "class" => "",
                "heading" => esc_html__("Number Of Products", 'thebigshop'),
                "param_name" => "per_page",
                "value" => '',
                "description" => esc_html__("Number of Products Show.", 'thebigshop')
            ),
            array(
                "type" => "textfield",
                "class" => "",
                "heading" => esc_html__("Number of Column", 'thebigshop'),
                "param_name" => "columns",
                "value" => '',
                "description" => esc_html__("Number of Products show in Column", 'thebigshop')
            ),
          array(
                "type" => "dropdown",
                "class" => "",
                "heading" => esc_html__("Order by", 'thebigshop'),
                "param_name" => "orderby",
                "value" => array('date','rand', 'name', 'title'),
            ),
             array(
                "type" => "dropdown",
                "class" => "",
                "heading" => esc_html__("Order", 'thebigshop'),
                "param_name" => "order",
                "value" => array('DESC', 'ASC'),
            ),
            )
         )
    );
    vc_map(array(
        'name' => esc_html__('Top Rated Products Carousel', 'thebigshop'),
        'base' => 'td_top_rated_products',
        'class' => 'td_top_rated_products',
        'icon' => get_template_directory_uri() . '/assets/images/icon.jpg',
        'category' => esc_html__('ThemesDeveloper', 'thebigshop'),
        "params" => array(
             array(
                "type" => "textfield",
                "class" => "",
                "heading" => esc_html__("Title", 'thebigshop'),
                "param_name" => "title",
                "value" => esc_html__("Top Rated Products", 'thebigshop'),
                "description" => esc_html__("Display Block Title.", 'thebigshop')
            ),
            array(
                "type" => "textfield",
                "class" => "",
                "heading" => esc_html__("Number Of Products", 'thebigshop'),
                "param_name" => "per_page",
                "value" => '',
                "description" => esc_html__("Number of Products Show.", 'thebigshop')
            ),
            array(
                "type" => "textfield",
                "class" => "",
                "heading" => esc_html__("Number of Column", 'thebigshop'),
                "param_name" => "columns",
                "value" => '',
                "description" => esc_html__("Number of Products show in Column", 'thebigshop')
            ),
           array(
                "type" => "dropdown",
                "class" => "",
                "heading" => esc_html__("Order by", 'thebigshop'),
                "param_name" => "orderby",
                "value" => array('date','rand', 'name', 'title'),
            ),
             array(
                "type" => "dropdown",
                "class" => "",
                "heading" => esc_html__("Order", 'thebigshop'),
                "param_name" => "order",
                "value" => array('DESC', 'ASC'),
            ),
            )
         )
    );
    vc_map(array(
        'name' => esc_html__('Posts Carousel', 'thebigshop'),
        'base' => 'td_posts',
        'class' => 'td_posts',
        'icon' => get_template_directory_uri() . '/assets/images/icon.jpg',
        'category' => esc_html__('ThemesDeveloper', 'thebigshop'),
        "params" => array(
             array(
                "type" => "textfield",
                "class" => "",
                "heading" => esc_html__("Title", 'thebigshop'),
                "param_name" => "title",
                "value" => esc_html__("Latest News", 'thebigshop'),
                "description" => esc_html__("Display Block Title.", 'thebigshop')
            ),
            array(
                "type" => "textfield",
                "class" => "",
                "heading" => esc_html__("Number Of Posts", 'thebigshop'),
                "param_name" => "per_page",
                "value" => '',
                "description" => esc_html__("Number of Posts Show.", 'thebigshop')
            ),
            array(
                "type" => "textfield",
                "class" => "",
                "heading" => esc_html__("Number of Column", 'thebigshop'),
                "param_name" => "columns",
                "value" => '',
                "description" => esc_html__("Number of Posts show in Column", 'thebigshop')
            ),
           array(
                "type" => "dropdown",
                "class" => "",
                "heading" => esc_html__("Order by", 'thebigshop'),
                "param_name" => "orderby",
                "value" => array('date','rand', 'name', 'title'),
            ),
             array(
                "type" => "dropdown",
                "class" => "",
                "heading" => esc_html__("Order", 'thebigshop'),
                "param_name" => "order",
                "value" => array('DESC', 'ASC'),
            ),
            )
         )       
        );
      vc_map(array(
        'name' => esc_html__('Portfolio Carousel', 'thebigshop'),
        'base' => 'td_portfolio_grid_slider',
        'class' => 'td_portfolio_grid_slider',
        'icon' => get_template_directory_uri() . '/assets/images/icon.jpg',
        'category' => esc_html__('ThemesDeveloper', 'thebigshop'),
        "params" => array(
             array(
                "type" => "textfield",
                "class" => "",
                "heading" => esc_html__("Title", 'thebigshop'),
                "param_name" => "title",
                "value" => esc_html__("Latest Works", 'thebigshop'),
                "description" => esc_html__("Display Block Title.", 'thebigshop')
            ),
            array(
                "type" => "textfield",
                "class" => "",
                "heading" => esc_html__("Number Of Posts", 'thebigshop'),
                "param_name" => "per_page",
                "value" => '',
                "description" => esc_html__("Number of Posts Show.", 'thebigshop')
            ),
            array(
                "type" => "textfield",
                "class" => "",
                "heading" => esc_html__("Number of Column", 'thebigshop'),
                "param_name" => "columns",
                "value" => '',
                "description" => esc_html__("Number of Posts show in Column. Example: 1, 2, 3, 4", 'thebigshop')
            ),
             array(
                "type" => "textfield",
                "class" => "",
                "heading" => esc_html__("Portfolio Categories", 'thebigshop'),
                "param_name" => "cat",
                "value" => '',
                "description" => esc_html__("Add Portfolio Categories, if you want to show your portfolios by categories.", 'thebigshop')
            ),
           array(
                "type" => "dropdown",
                "class" => "",
                "heading" => esc_html__("Order by", 'thebigshop'),
                "param_name" => "orderby",
                "value" => array('date','rand', 'name', 'title'),
            ),
             array(
                "type" => "dropdown",
                "class" => "",
                "heading" => esc_html__("Order", 'thebigshop'),
                "param_name" => "order",
                "value" => array('DESC', 'ASC'),
            ),
         
            )
         )       
        );
      vc_map(array(
        'name' => esc_html__('Portfolio Grid', 'thebigshop'),
        'base' => 'td_portfolio_grid',
        'class' => 'td_portfolio_grid',
        'icon' => get_template_directory_uri() . '/assets/images/icon.jpg',
        'category' => esc_html__('ThemesDeveloper', 'thebigshop'),
        "params" => array(
             array(
                "type" => "textfield",
                "class" => "",
                "heading" => esc_html__("Title", 'thebigshop'),
                "param_name" => "title",
                "value" => esc_html__("Latest Works", 'thebigshop'),
                "description" => esc_html__("Display Block Title.", 'thebigshop')
            ),
            array(
                "type" => "textfield",
                "class" => "",
                "heading" => esc_html__("Number Of Posts", 'thebigshop'),
                "param_name" => "per_page",
                "value" => '',
                "description" => esc_html__("Number of Posts Show.", 'thebigshop')
            ),
            array(
                "type" => "textfield",
                "class" => "",
                "heading" => esc_html__("Number of Column", 'thebigshop'),
                "param_name" => "col",
                "value" => '',
                "description" => esc_html__("Number of Posts show in Column. Example: 1, 2, 3, 4", 'thebigshop')
            ),
             array(
                "type" => "textfield",
                "class" => "",
                "heading" => esc_html__("Portfolio Categories", 'thebigshop'),
                "param_name" => "cat",
                "value" => '',
                "description" => esc_html__("Add Portfolio Categories, if you want to show your portfolios by categories.", 'thebigshop')
            ),
         array(
                "type" => "dropdown",
                "class" => "",
                "heading" => esc_html__("Filter", 'thebigshop'),
                "param_name" => "filter",
                "value" => array('1'=>esc_html__("Enable", 'thebigshop'),'0'=>esc_html__("Disable", 'thebigshop') ),
                "admin_label" => true,
                "description" => esc_html__("Filter Options in Portfolio Grid. ", 'thebigshop')
            ),
            array(
                "type" => "dropdown",
                "class" => "",
                "heading" => esc_html__("Filter Position", 'thebigshop'),
                "param_name" => "filter_align",
                "value" => array('center'=>esc_html__("Center", 'thebigshop'),'left'=>esc_html__("Left", 'thebigshop'),'left'=>esc_html__("Right", 'thebigshop') ),
                "admin_label" => true,
                "description" => esc_html__("Grid Portfolio Filter Position", 'thebigshop')
            ),
         array(
                "type" => "dropdown",
                "class" => "",
                "heading" => esc_html__("Order by", 'thebigshop'),
                "param_name" => "orderby",
                "value" => array('date','rand', 'name', 'title'),
            ),
             array(
                "type" => "dropdown",
                "class" => "",
                "heading" => esc_html__("Order", 'thebigshop'),
                "param_name" => "order",
                "value" => array('DESC', 'ASC'),
            ),
            )
         )       
        );
       vc_map(array(
        'name' => esc_html__('Banner Grid', 'thebigshop'),
        'base' => 'td_banner',
        'class' => 'td_banner',
        'icon' => get_template_directory_uri() . '/assets/images/icon.jpg',
        'category' => esc_html__('ThemesDeveloper', 'thebigshop'),
        "params" => array(
            array(
                "type" => "attach_image",
                "class" => "",
                "heading" => esc_html__("Banner Image URL", 'thebigshop'),
                "param_name" => "img_url",
                "icon" => '',
                "description" => esc_html__("To Select banner image.", 'thebigshop')
            ),
             array(
                "type" => "textfield",
                "class" => "",
                "heading" => esc_html__("Title", 'thebigshop'),
                "param_name" => "title",
                "value" => '',
                "description" => esc_html__("Display Banner Title.", 'thebigshop')
            ),
            array(
                "type" => "textfield",
                "class" => "",
                "heading" => esc_html__("Link", 'thebigshop'),
                "param_name" => "link",
                "value" => '',
                "description" => esc_html__("Banner Links here.", 'thebigshop')
            ),
            array(
                "type" => "textfield",
                "class" => "",
                "heading" => esc_html__("Column Class", 'thebigshop'),
                "param_name" => "col",
                "value" => 'col-md-4',
                "description" => esc_html__("Number of Column Class", 'thebigshop')
            ),
             array(
                "type" => "textfield",
                "class" => "",
                "heading" => esc_html__("Banner Style", 'thebigshop'),
                "param_name" => "style",
                "value" => 'style-01',
                "description" => esc_html__("Banner Style Examples: style-01, style-02", 'thebigshop')
            ),
            array(
                "type" => "textfield",
                "class" => "",
                "heading" => esc_html__("Button Text", 'thebigshop'),
                "param_name" => "text_button",
                "value" => '',
                "description" => esc_html__("Text of button", 'thebigshop')
            ),
            )
         )       
        );
      vc_map(array(
        'name' => esc_html__('Team Members', 'thebigshop'),
        'base' => 'td_team',
        'class' => 'td_team',
        'icon' => get_template_directory_uri() . '/assets/images/icon.jpg',
        'category' => esc_html__('ThemesDeveloper', 'thebigshop'),
        "params" => array(
            array(
                "type" => "attach_image",
                "class" => "",
                "heading" => esc_html__("Avater", 'thebigshop'),
                "param_name" => "avater",
                "icon" => '',
                "description" => esc_html__("To Select Team avater.", 'thebigshop')
            ),
            array(
                "type" => "textfield",
                "class" => "",
                "heading" => esc_html__("Name", 'thebigshop'),
                "param_name" => "name",
                "value" => '',
                "description" => esc_html__("Member Name", 'thebigshop')
            ),
            array(
                "type" => "textfield",
                "class" => "",
                "heading" => esc_html__("Role", 'thebigshop'),
                "param_name" => "role",
                "value" => '',
                "description" => esc_html__("Member Role", 'thebigshop')
            ),
             array(
                "type" => "textfield",
                "class" => "",
                "heading" => esc_html__("Link", 'thebigshop'),
                "param_name" => "link",
                "value" => '',
                "description" => esc_html__("Member Links.", 'thebigshop')
            ),
         array(
                "type" => "textfield",
                "class" => "",
                "heading" => esc_html__("Biography", 'thebigshop'),
                "param_name" => "biography",
                "value" => '',
                "description" => esc_html__("Short Description of team member", 'thebigshop')
            ),
            array(
                "type" => "textfield",
                "class" => "",
                "heading" => esc_html__("Column Class", 'thebigshop'),
                "param_name" => "class",
                "value" => 'col-md-4 col-sm-6',
                "description" => esc_html__("Column Class", 'thebigshop')
            ),
             array(
                "type" => "textfield",
                "class" => "",
                "heading" => esc_html__("Column ID", 'thebigshop'),
                "param_name" => "id",
                "value" => '',
                "description" => esc_html__("Column ID", 'thebigshop')
            ),

            )
         )       
        );
      
     /* vc_map(array(
        'name' => esc_html__('Container', 'thebigshop'),
        'base' => 'td_container',
        'class' => 'td_container',
        'icon' => get_template_directory_uri() . '/assets/images/icon.jpg',
        'category' => esc_html__('ThemesDeveloper', 'thebigshop'),
         )       
        );
       vc_map(array(
        'name' => esc_html__('Row', 'thebigshop'),
        'base' => 'td_row',
        'class' => 'td_row',
        'icon' => get_template_directory_uri() . '/assets/images/icon.jpg',
        'category' => esc_html__('ThemesDeveloper', 'thebigshop'),
         ) 
        //Column 
      *  //pricing info
      *      
        );*/
       vc_map(array(
        'name' => esc_html__('Testimonial', 'thebigshop'),
        'base' => 'td_testimonial',
        'class' => 'td_testimonial',
        'icon' => get_template_directory_uri() . '/assets/images/icon.jpg',
        'category' => esc_html__('ThemesDeveloper', 'thebigshop'),
        "params" => array(
             array(
                "type" => "attach_image",
                "class" => "",
                "heading" => esc_html__("Avater", 'thebigshop'),
                "param_name" => "avater",
                "icon" => '',
                "description" => esc_html__("To Select Testimonials avater.", 'thebigshop')
            ),
            array(
                "type" => "textfield",
                "class" => "",
                "heading" => esc_html__("Name", 'thebigshop'),
                "param_name" => "name",
                "value" => '',
                "description" => esc_html__("Member Name", 'thebigshop')
            ),
            array(
                "type" => "textfield",
                "class" => "",
                "heading" => esc_html__("Role", 'thebigshop'),
                "param_name" => "role",
                "value" => '',
                "description" => esc_html__("Member Role", 'thebigshop')
            ),
             array(
                "type" => "textfield",
                "class" => "",
                "heading" => esc_html__("Link", 'thebigshop'),
                "param_name" => "link",
                "value" => '',
                "description" => esc_html__("Member Links.", 'thebigshop')
            ),
         array(
                "type" => "textfield",
                "class" => "",
                "heading" => esc_html__("Biography", 'thebigshop'),
                "param_name" => "biography",
                "value" => '',
                "description" => esc_html__("Short Description of team member", 'thebigshop')
            ),
            array(
                "type" => "textfield",
                "class" => "",
                "heading" => esc_html__("Column Class", 'thebigshop'),
                "param_name" => "class",
                "value" => 'col-md-4 col-sm-6',
                "description" => esc_html__("Column Class", 'thebigshop')
            ),
             array(
                "type" => "textfield",
                "class" => "",
                "heading" => esc_html__("Column ID", 'thebigshop'),
                "param_name" => "id",
                "value" => '',
                "description" => esc_html__("Column ID", 'thebigshop')
            ),

            )
         )       
        );
        vc_map(array(
        'name' => esc_html__('Social Icon', 'thebigshop'),
        'base' => 'td_social_icon',
        'class' => 'td_social_icon',
        'icon' => get_template_directory_uri() . '/assets/images/icon.jpg',
        'category' => esc_html__('ThemesDeveloper', 'thebigshop'),
        "params" => array(
            array(
                "type" => "textfield",
                "class" => "",
                "heading" => esc_html__("Socail icon Class", 'thebigshop'),
                "param_name" => "icon",
                "value" => '',
                "description" => esc_html__("Socail icon Class", 'thebigshop')
            ),
             array(
                "type" => "textfield",
                "class" => "",
                "heading" => esc_html__("Link", 'thebigshop'),
                "param_name" => "link",
                "value" => '',
                "description" => esc_html__("Social Link.", 'thebigshop')
            ),
            )
         )       
        );
        
         vc_map(array(
        'name' => esc_html__('Button', 'thebigshop'),
        'base' => 'td_button',
        'class' => 'td_button',
        'icon' => get_template_directory_uri() . '/assets/images/icon.jpg',
        'category' => esc_html__('ThemesDeveloper', 'thebigshop'),
        "params" => array(
            array(
                "type" => "textfield",
                "class" => "",
                "heading" => esc_html__("Style", 'thebigshop'),
                "param_name" => "icon",
                "value" => '',
                "description" => esc_html__("Button Style", 'thebigshop')
            ),
             array(
                "type" => "textfield",
                "class" => "",
                "heading" => esc_html__("Class", 'thebigshop'),
                "param_name" => "class",
                "value" => 'button-primary',
                "description" => esc_html__("Button class.", 'thebigshop')
            ),
              array(
                "type" => "textfield",
                "class" => "",
                "heading" => esc_html__("Link", 'thebigshop'),
                "param_name" => "link",
                "value" => '',
                "description" => esc_html__("Button Link.", 'thebigshop')
            ),
            )
         )       
        );
        vc_map(array(
        'name' => esc_html__('Heading', 'thebigshop'),
        'base' => 'td_heading',
        'class' => 'td_heading',
        'icon' => get_template_directory_uri() . '/assets/images/icon.jpg',
        'category' => esc_html__('ThemesDeveloper', 'thebigshop'),
        "params" => array(
            array(
                "type" => "textfield",
                "class" => "",
                "heading" => esc_html__("Class", 'thebigshop'),
                "param_name" => "class",
                "value" => 'small-title',
                "description" => esc_html__("Heading Class", 'thebigshop')
            ),

            )
         )       
        );
       vc_map(array(
        'name' => esc_html__('Service', 'thebigshop'),
        'base' => 'td_service',
        'class' => 'td_service',
        'icon' => get_template_directory_uri() . '/assets/images/icon.jpg',
        'category' => esc_html__('ThemesDeveloper', 'thebigshop'),
        "params" => array(
              array(
                "type" => "textfield",
                "class" => "",
                "heading" => esc_html__("Title", 'thebigshop'),
                "param_name" => "title",
                "value" => '',
                "description" => esc_html__("Display Service Title.", 'thebigshop')
            ),
            array(
                "type" => "textfield",
                "class" => "",
                "heading" => esc_html__("Column Class", 'thebigshop'),
                "param_name" => "col",
                "value" => 'col-sm-4',
                "description" => esc_html__("Column Class here", 'thebigshop')
            ),
             array(
                "type" => "textfield",
                "class" => "",
                "heading" => esc_html__("Column Class", 'thebigshop'),
                "param_name" => "class",
                "value" => 'col-md-4 col-sm-6',
                "description" => esc_html__("Column Class", 'thebigshop')
            ),
             array(
                "type" => "textfield",
                "class" => "",
                "heading" => esc_html__("Banner Style", 'thebigshop'),
                "param_name" => "style",
                "value" => 'style-01',
                "description" => esc_html__("Banner Style Examples: style-01", 'thebigshop')
            ),
            array(
                "type" => "textfield",
                "class" => "",
                "heading" => esc_html__("Icon", 'thebigshop'),
                "param_name" => "icon",
                "value" => '',
                "description" => esc_html__("Icon", 'thebigshop')
            ),
              array(
                "type" => "colorpicker",
                "class" => "",
                "heading" => esc_html__("Icon Color", 'thebigshop'),
                "param_name" => "icon_color",
                "value" => '#FF0000', 
                "description" => esc_html__("Service Icon colors", 'thebigshop')
            ),
            array(
                "type" => "textfield",
                "class" => "",
                "heading" => esc_html__("Button Text", 'thebigshop'),
                "param_name" => "button_text",
                "value" => '',
                "description" => esc_html__("Text of button", 'thebigshop')
            ),
         array(
                "type" => "textfield",
                "class" => "",
                "heading" => esc_html__("Banner Class", 'thebigshop'),
                "param_name" => "button_class",
                "value" => 'btn-primary',
                "description" => esc_html__("Text of button Class", 'thebigshop')
            ),
             array(
                "type" => "textfield",
                "class" => "",
                "heading" => esc_html__("Link", 'thebigshop'),
                "param_name" => "link",
                "value" => '',
                "description" => esc_html__("Service Button Links", 'thebigshop')
            ),

            )
         )       
        );
       vc_map(array(
        'name' => esc_html__('Brand Logo', 'thebigshop'),
        'base' => 'td_brand',
        'class' => 'td_brand',
        'icon' => get_template_directory_uri() . '/assets/images/icon.jpg',
        'category' => esc_html__('ThemesDeveloper', 'thebigshop'),
        "params" => array(
               array(
                "type" => "attach_image",
                "class" => "",
                "heading" => esc_html__("Brand Logo Images", 'thebigshop'),
                "param_name" => "img",
                "icon" => '',
                "description" => esc_html__("To Select Brand logo image.", 'thebigshop')
            ),
            array(
                "type" => "textfield",
                "class" => "",
                "heading" => esc_html__("Name", 'thebigshop'),
                "param_name" => "name",
                "value" => '',
                "description" => esc_html__("Brand Logo Name", 'thebigshop')
            ),
            array(
                "type" => "textfield",
                "class" => "",
                "heading" => esc_html__("link", 'thebigshop'),
                "param_name" => "link",
                "value" => '',
                "description" => esc_html__("Brand Logo link", 'thebigshop')
            ),
            )
         )       
        );
       
}
