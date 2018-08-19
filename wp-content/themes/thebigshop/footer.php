<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after
 *
 * @package ThemesDeveloper
 * @subpackage thebigshop
 * @since 1.0
 * @TheBigshop 1.0
 */
global $thebigshop_options;
?>
</div>
</div>
<?php
$footer_custom_feature = '';
if (isset($thebigshop_options['td-footer-custom-feature']))
    $footer_custom_feature = $thebigshop_options['td-footer-custom-feature'];

if (isset($footer_custom_feature) && ($footer_custom_feature == 1) && isset($thebigshop_options['td-footer-custom-feature-box'])) {
    ?>
    <div class="container">
        <div class="custom-feature-box row">
            <?php echo wp_kses_post($thebigshop_options['td-footer-custom-feature-box']); ?>
        </div>
    </div>
    <?php
}
?>
<footer id="footer">
    <div class="fpart-first">
        <div class="container">
            <div class="row">
                <?php if (is_active_sidebar('footer')) : ?>
                    <?php dynamic_sidebar('footer'); ?>
                <?php endif; ?>
                <?php if (isset($thebigshop_options['td-footer-contactinfo-show']) && ($thebigshop_options['td-footer-contactinfo-show'] == 1)) { ?> <?php echo wp_kses_post($thebigshop_options['td-footer-contactinfo']); ?><?php } ?>
            </div>
        </div>
    </div>
    <div class="fpart-second">
        <div class="container">
            <div id="powered" class="clearfix">
                <div class="row">
                    <div class="col-md-4">
                        <div class="payments_types">
                            <a href="<?php if (isset($thebigshop_options['td-footer-paymentlinks'])) {
                    echo esc_url($thebigshop_options['td-footer-paymentlinks']);
                } ?>" target="_blank"> <img data-toggle="tooltip" src="<?php
                                if (isset($thebigshop_options['td-footer-paymentlogo']['url'])) {
                                    echo esc_url($thebigshop_options['td-footer-paymentlogo']['url']);
                                }
                                ?>" alt="" title="">
                            </a>
                        </div>
                    </div>
                        <?php if (isset($thebigshop_options['td-footer-poweredby'])) { ?>
                        <div class="powered_text pull-left flip col-md-4">
                        <?php echo wp_kses_post($thebigshop_options['td-footer-poweredby']); ?>
                        </div>
                            <?php } ?>
                    <div class="col-md-4">
                        <div class="social pull-right flip">
<?php thebigshop_socaial_button(); ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php
            $footer_custom_textblock = '';
            if (isset($thebigshop_options['td-footer-textblock-feature']))
                $footer_custom_textblock = $thebigshop_options['td-footer-textblock-feature'];

            if (isset($footer_custom_textblock) && ($footer_custom_textblock == 1) && isset($thebigshop_options['td-footer-textblock'])) {
                ?>

                <div class="bottom-row">
                    <div class="custom-text">
                <?php echo wp_kses_post($thebigshop_options['td-footer-textblock']); ?>
                    </div>
                </div>
    <?php } ?>
        </div>
    </div>
            <?php if (isset($thebigshop_options['td-backtoptopbutton']) && ($thebigshop_options['td-backtoptopbutton'] == 1)) { ?>
        <div id="back-top"><a data-toggle="tooltip" title="<?php esc_html_e('Back to Top', 'thebigshop'); ?>" href="javascript:void(0)" class="backtotop"><i class="fa fa-chevron-up"></i></a></div>
<?php } ?>
</footer>
<?php do_action('thebigshop_sidebar_social'); ?>
</div>
<?php wp_footer(); ?>
</body>
</html>