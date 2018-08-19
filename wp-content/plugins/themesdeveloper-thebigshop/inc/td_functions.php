<?php

$product_social=get_option('thebigshop_options');
if (isset($product_social['td_single_product_social']) && $product_social['td_single_product_social'] == 1) {
     add_action('woocommerce_share', 'thebigshop_social_share');
} 
if (isset($product_social['td_portfolio_social']) && ($product_social['td_portfolio_social'] == 1)) { 
     add_action('thebigshop_portfolio_social_share', 'thebigshop_social_share');                                  
} 
if (isset($product_social['td_blog_social']) && ($product_social['td_blog_social'] == 1)) { 
     add_action('thebigshop_blog_social_share', 'thebigshop_social_share');
 } 

function thebigshop_social_share() {
        ?>
        <div class="social-share">
            <?php $thumbnail_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full'); ?>
            <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode(the_permalink()); ?>" target="_blank" data-toggle="tooltip" data-original-title="<?php esc_html_e('Facebook', 'thebigshop'); ?>" ><span class="fa fa-facebook"></span></a>
            <a href="https://twitter.com/intent/tweet?text=<?php echo urlencode(the_title()); ?>  <?php echo urlencode(the_permalink()); ?>" target="_blank" data-toggle="tooltip" data-original-title="<?php esc_html_e('Twitter', 'thebigshop'); ?>" ><span class="fa fa-twitter"></span></a>
            <a href="https://plus.google.com/share?url=<?php echo urlencode(the_permalink()); ?>" target="_blank" data-toggle="tooltip" data-original-title="<?php esc_html_e('Google +', 'thebigshop'); ?>" ><span class="fa fa-google-plus"></span></a>
            <a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo urlencode(the_permalink()); ?>&title=<?php the_title(); ?>" target="_blank" data-toggle="tooltip" data-original-title="<?php esc_html_e('Linkedit', 'thebigshop'); ?>" ><span class="fa fa-linkedin"></span></a>
            <a href="https://pinterest.com/pin/create/button/?url=<?php echo urlencode(the_permalink()); ?>&media=<?php echo urlencode($thumbnail_image[0]); ?>&description=<?php echo the_title(); ?>" target="_blank" data-toggle="tooltip" data-original-title="<?php esc_html_e('Pinterest', 'thebigshop'); ?>" ><span class="fa fa-pinterest"></span></a>
            <a href="https://www.tumblr.com/widgets/share/tool?canonicalUrl=<?php echo urlencode(the_permalink()); ?>&posttype=link&title=<?php echo urlencode(the_title()); ?>" target="_blank" data-toggle="tooltip" data-original-title="<?php esc_html_e('Tumblr', 'thebigshop'); ?>" ><span class="fa fa-tumblr"></span></a>
            <a href="http://reddit.com/submit?url=<?php echo urlencode(the_permalink()); ?>&title=<?php the_title(); ?>" target="_blank" data-toggle="tooltip" data-original-title="<?php esc_html_e('Reddit', 'thebigshop'); ?>" ><span class="fa fa-reddit"></span></a>
            <a href="http://digg.com/submit?url=<?php echo urlencode(the_permalink()); ?>&title=<?php the_title(); ?>" target="_blank" data-toggle="tooltip" data-original-title="<?php esc_html_e('Digg', 'thebigshop'); ?>" ><span class="fa fa-digg"></span></a>
            <a href="http://www.stumbleupon.com/submit?url=<?php echo urlencode(the_permalink()); ?>&title=<?php the_title() ?>" target="_blank" data-toggle="tooltip" data-original-title="<?php esc_html_e('StumbleUpon', 'thebigshop'); ?>" ><span class="fa fa-stumbleupon"></span></a>
            <a href="mailto:?subject=<?php the_title(); ?>&amp;body=<?php the_permalink(); ?>" target="_blank" data-toggle="tooltip" data-original-title="<?php esc_html_e('Email', 'thebigshop'); ?>"><span class="fa fa-envelope"></span></a>
        </div>
        <?php
   
}

add_action('thebigshop_sidebar_social', 'thebigshop_sidebar_social_button');

function thebigshop_sidebar_social_button(){
    $product_social=get_option('thebigshop_options');
 if (isset($product_social['td-sidebox-facebook-show']) && ($product_social['td-sidebox-facebook-show'] == 1)) { ?>
    <div id="facebook" class="<?php if (isset($product_social['td_facebook_box_align']) && ($product_social['td_facebook_box_align'] == 1)) { ?>fb-left<?php } else { ?>fb-right<?php } ?>" style="top:210px; z-index:10000;">
      <div id="facebook_icon"><i class="fa fa-facebook"></i></div>
      <div class="fb-page" data-href="<?php echo esc_url($product_social['td_facebook_id_box']); ?>"  data-width="235"   data-height="284" data-hide-cover="false"  data-show-facepile="true"></div>
    </div>
<?php } ?>
<?php if (isset($product_social['td-sidebox-twitter-show']) && ($product_social['td-sidebox-twitter-show'] == 1)) { ?>
    <div id="twitter_footer" class="<?php if (isset($product_social['td_twitter_box_align']) && ($product_social['td_twitter_box_align'] == 1)) { ?>twit-left<?php } else { ?>twit-right<?php } ?>" style="top:255px; z-index:9999;">
        <div class="twitter_icon"><i class="fa fa-twitter"></i></div>
        <a class="twitter-timeline" href="https://twitter.com/<?php echo esc_attr($product_social['td_sidebox_twitter_username']); ?>" data-chrome="nofooter noscrollbar transparent" data-theme="light" data-tweet-limit="2" data-related="twitterapi,twitter" data-aria-polite="assertive" data-widget-id="<?php echo esc_attr($product_social['td_sidebox_twitter_widget_id']); ?>"><?php esc_html_e('Tweets by', 'thebigshop'); ?> @<?php echo esc_attr($product_social['td_sidebox_twitter_username']); ?></a>
    </div>
<?php } ?>
<?php if (isset($product_social['td-sidebox-video-show']) && ($product_social['td-sidebox-video-show'] == 1)) { ?>
    <div id="video_box" class="<?php if (isset($product_social['td_video_box_align']) && ($product_social['td_video_box_align'] == 1)) { ?>vb-left<?php } else { ?>vb-right<?php } ?>" style="top:300px; z-index:9998;">
        <div id="video_box_icon"><i class="fa fa-play"></i></div>
        <p><?php thebigshop_video($product_social['td-sidebox-video']); ?></p>
    </div>
<?php } ?>
<?php if (isset($product_social['td-sidebox-customhtml-show']) && ($product_social['td-sidebox-customhtml-show'] == 1)) { ?>
    <div id="custom_side_block" class="<?php if (isset($product_social['td_customhtml_box_align']) && ($product_social['td_customhtml_box_align'] == 1)) { ?>custom_side_block_left<?php } else { ?>custom_side_block_right<?php } ?>" style="top:345px; z-index:9997;">
        <div class="custom_side_block_icon"><div class="fa fa-chevron-right">&nbsp;</div></div>
        <?php echo wp_kses_post($product_social['td-sidebox-customhtml']); ?>
    </div>
<?php } ?>
<script>
    (function ($) {
    "use strict";   
<?php if (isset($product_social['td_customhtml_box_align']) && ($product_social['td_customhtml_box_align'] == 1)) { ?>
  
            jQuery(function ($) {
                $('#custom_side_block.custom_side_block_left').hover(function () {
                    $('#custom_side_block.custom_side_block_left').stop(true, false).animate({left: '0'}, 800, 'easeOutQuint');
                },
                        function () {
                            $('#custom_side_block.custom_side_block_left').stop(true, false).animate({left: '-215px'}, 800, 'easeInQuint');
                        }, 1000);
            });
       
    <?php } else { ?>
    
            jQuery(function ($) {
                $("#custom_side_block.custom_side_block_right").hover(function () {
                    $("#custom_side_block.custom_side_block_right").stop(true, false).animate({right: "0"}, 800, 'easeOutQuint');
                },
                        function () {
                            $("#custom_side_block.custom_side_block_right").stop(true, false).animate({right: "-215px"}, 800, 'easeInQuint');
                        }, 1000);
            });
       
    <?php } ?>

    <?php if (isset($product_social['td_video_box_align']) && ($product_social['td_video_box_align'] == 1)) { ?>
 
            jQuery(function ($) {
                $("#video_box.vb-left").hover(function () {
                    $("#video_box.vb-left").stop(true, false).animate({left: "0"}, 800, 'easeOutQuint');
                },
                        function () {
                            $("#video_box.vb-left").stop(true, false).animate({left: "-560px"}, 800, 'easeInQuint');
                        }, 1000);
            });
   
    <?php } else { ?>
  
            jQuery(function ($) {
                $("#video_box.vb-right").hover(function () {
                    $("#video_box.vb-right").stop(true, false).animate({right: "0"}, 800, 'easeOutQuint');
                },
                        function () {
                            $("#video_box.vb-right").stop(true, false).animate({right: "-560px"}, 800, 'easeInQuint');
                        }, 1000);
            });
  
    <?php } ?>  
           !function (d, s, id) {
                var js, fjs = d.getElementsByTagName(s)[0], p = /^http:/.test(d.location) ? 'http' : 'https';
                if (!d.getElementById(id)) {
                    js = d.createElement(s);
                    js.id = id;
                    js.src = p + "://platform.twitter.com/widgets.js";
                    fjs.parentNode.insertBefore(js, fjs);
           
            }
            }(document, "script", "twitter-wjs");
           
    <?php if (isset($product_social['td_twitter_box_align']) && ($product_social['td_twitter_box_align'] == 1)) { ?>
       
            jQuery(function ($) {
                $("#twitter_footer.twit-left").hover(function () {
                    $("#twitter_footer.twit-left").stop(true, false).animate({left: "0"}, 800, 'easeOutQuint');
                },
                        function () {
                            $("#twitter_footer.twit-left").stop(true, false).animate({left: "-215px"}, 800, 'easeInQuint');
                        }, 1000);
            });
       
    <?php } else { ?>
     
            jQuery(function ($) {
                $("#twitter_footer.twit-right").hover(function () {
                    $("#twitter_footer.twit-right").stop(true, false).animate({right: "0"}, 800, 'easeOutQuint');
                },
                        function () {
                            $("#twitter_footer.twit-right").stop(true, false).animate({right: "-215px"}, 800, 'easeInQuint');
                        }, 1000);
            });
      
    <?php } ?>
    <?php if (isset($product_social['td_facebook_box_align']) && ($product_social['td_facebook_box_align'] == 1)) { ?>
     
            jQuery(function ($) {
                $("#facebook.fb-left").hover(function () {
                    $("#facebook.fb-left").stop(true, false).animate({left: "0"}, 800, 'easeOutQuint');
                },
                        function () {
                            $("#facebook.fb-left").stop(true, false).animate({left: "-241px"}, 800, 'easeInQuint');
                        }, 1000);
            });
     
    <?php } else { ?>
      
            jQuery(function ($) {
                $("#facebook.fb-right").hover(function () {
                    $("#facebook.fb-right").stop(true, false).animate({right: "0"}, 800, 'easeOutQuint');
                },
                        function () {
                            $("#facebook.fb-right").stop(true, false).animate({right: "-241px"}, 800, 'easeInQuint');
                        }, 1000);
            });
  
    <?php } ?>   
        })(jQuery);
</script>
<?php } ?>