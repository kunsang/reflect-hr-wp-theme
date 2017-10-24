<?php
/**
 * displaying menu section
 *
 * @package H-Code
 */
?>
<?php
if( class_exists( 'WooCommerce' ) && (is_product() || is_product_category() || is_product_tag()) || is_404() || is_home() ){
    $enable_header = '2';
}else{
    $old_page_header_meta = '';
    $old_page_header_meta = get_post_meta( $post->ID, 'hcode_enable_header_single', true);
    if( $old_page_header_meta != '' && strlen($old_page_header_meta) > 0 ){
        $enable_header = hcode_option('hcode_enable_header');
    }else{
        $enable_header = '2';
    }
}
if($enable_header == '1' || $enable_header == '2'){
    $hcode_options = get_option( 'hcode_theme_setting' );
    $hcode_header_text_color = '';
    if($enable_header == '2'){
        $hcode_enable_header = (isset($hcode_options['hcode_enable_header'])) ? $hcode_options['hcode_enable_header'] : '';
        if($hcode_enable_header == 0)
            return;
    }

    $hcode_header_layout = hcode_option('hcode_header_layout');
    $hcode_header_logo = hcode_option('hcode_header_logo');
    if(is_array($hcode_header_logo))
        $hcode_header_logo =  $hcode_header_logo['url'];

    $hcode_header_light_logo = hcode_option('hcode_header_light_logo');
    if(is_array($hcode_header_light_logo))
        $hcode_header_light_logo =  $hcode_header_light_logo['url'];

    $retina = hcode_option('hcode_retina_logo');
    if(is_array($retina))
        $retina =  $retina['url'];

    $retina_light = hcode_option('hcode_retina_logo_light');
    if(is_array($retina_light))
        $retina_light =  $retina_light['url'];

    $header_menu = hcode_option('hcode_header_menu');
    if(empty($header_menu)) {
        $header_menu = (isset($hcode_options['hcode_header_menu'])) ? $hcode_options['hcode_header_menu'] : '';
    }

    $header_secondary_menu = hcode_option('hcode_header_secondary_menu');
    if(empty($header_secondary_menu)) {
        $header_secondary_menu = (isset($hcode_options['hcode_header_secondary_menu'])) ? $hcode_options['hcode_header_secondary_menu'] : '';
    }

    $hcode_header_text_color = ' '.hcode_option('hcode_header_text_color');
    $hcode_header_search = hcode_option('hcode_header_search');
    $hcode_header_cart = hcode_option('hcode_header_cart');
    if(isset($hcode_options['hcode_header_mini_cart'])):
        $hcode_header_mini_cart = (isset($hcode_options['hcode_header_mini_cart']) && !empty($hcode_options['hcode_header_mini_cart'])) ? $hcode_options['hcode_header_mini_cart'] : '';
    else:
        $hcode_header_mini_cart = 'hcode-mini-cart';
    endif;

    $hcode_search_placeholder_text = (isset($hcode_options['hcode_search_placeholder_text']) && !empty($hcode_options['hcode_search_placeholder_text'])) ? $hcode_options['hcode_search_placeholder_text'] : '';


    $output = $classes = $enable_sticky = $hcode_menu_hover_delay = '';

    /* H-Code V1.8 */
    $hcode_menu_hover_delay = (isset($hcode_options['hcode_menu_hover_delay']) && !empty($hcode_options['hcode_menu_hover_delay'])) ? $hcode_options['hcode_menu_hover_delay'] : '100';

    $hcode_enable_mini_header       = hcode_option( 'hcode_enable_mini_header' );
    $hcode_enable_sticky_mini_header= hcode_option( 'hcode_enable_sticky_mini_header' );

    switch ($hcode_header_layout) {
        case 'headertype1':
                    $classes .= 'transparent-header nav-border-bottom ';
                    break;
        case 'headertype2':
                    $classes .= 'nav-dark ';
                    break;
        case 'headertype3':
                    $classes .= 'nav-dark-transparent ';
                    break;
        case 'headertype4':
                    $classes .= 'nav-border-bottom nav-light-transparent ';
                    break;
        case 'headertype5':
                    $classes .= 'nav-border-bottom static-sticky ';
                    break;
        case 'headertype6':
                    $classes .= 'white-header nav-border-bottom ';
                    break;
        case 'headertype7':
                    $classes .= 'static-sticky-gray';
                    break;
        case 'headertype8':
                    $classes .= 'non-sticky ';
                    break;
        case 'headertype10':
                    if( $hcode_enable_mini_header == 1 && $hcode_enable_sticky_mini_header == 1 ) {
                        $classes .= 'no-shrink-nav ';
                    }
                    break;
    }

    $menu_style = hcode_option('hcode_header_layout');
    if(empty($menu_style)) {
        $menu_style = (isset($hcode_options['hcode_header_layout'])) ? $hcode_options['hcode_header_layout'] : '';
    }

    $menu_image = hcode_option('hcode_menu_image');
    if(is_array($menu_image))
        $menu_image =  $menu_image['url'];

    $menu_logo = hcode_option('hcode_menu_logo');
    if(is_array($menu_logo))
        $menu_logo =  $menu_logo['url'];

    $enable_menu_social_icons = hcode_option('hcode_enable_menu_social_icons');
    if( $enable_menu_social_icons == '' ) {
        $enable_menu_social_icons = (isset($hcode_options['hcode_enable_menu_social_icons'])) ? $hcode_options['hcode_enable_menu_social_icons'] : '';
    }
    $menu_social_sidebar = hcode_option('hcode_menu_social_sidebar');
    if( $menu_social_sidebar == '' ) {
        $menu_social_sidebar = (isset($hcode_options['hcode_menu_social_sidebar'])) ? $hcode_options['hcode_menu_social_sidebar'] : '';
    }
    $enable_menu_separator = hcode_option('hcode_enable_menu_separator');
    if( $enable_menu_separator == '' ) {
        $enable_menu_separator = (isset($hcode_options['hcode_enable_menu_separator'])) ? $hcode_options['hcode_enable_menu_separator'] : '';
    }

    $header_logo_position = hcode_option( 'hcode_header_logo_position' );
    if( !( $menu_style == 'headertype9' || $menu_style == 'headertype10' || $menu_style == 'headertype11' ) ) {

        if( $header_logo_position == 'center' ) {
            $classes .= ' header-center-logo ';

            $header_logo_wrap_class = 'center-logo';
            $header_main_menu_class = 'navbar-left';

            if( ( $hcode_header_search == 1 ) || ( $hcode_header_cart == 1 ) ) {
                $header_menu_col_class  = 'col-md-10';
            } else {
                $header_menu_col_class  = 'col-md-10 center-logo-full-width';
            }

        } elseif( $header_logo_position == 'top' ) {
            $classes .= ' header-top-logo ';

            $header_logo_wrap_class = 'col-md-2 header-top-logo-center';
            $header_main_menu_class = 'navbar-left';
            $header_menu_col_class  = 'col-md-8';

        } else {

            $header_logo_wrap_class = 'col-md-4';
            $header_main_menu_class = 'navbar-right';
            $header_menu_col_class  = 'col-md-7';
        }
    }

?>

    <?php
        if( hcode_check_enable_mini_header() ) {
            $hcode_enable_mini_header_sidebar   = hcode_option( 'hcode_enable_mini_header_sidebar' );
            $hcode_enable_sticky_mini_header    = hcode_option( 'hcode_enable_sticky_mini_header' );
            $hcode_enable_mini_header_mobile    = hcode_option( 'hcode_enable_mini_header_mobile' );

            $sticky_header_class        = empty( $hcode_enable_sticky_mini_header ) ? 'no-sticky-mini-header ' : 'sticky-mini-header ';
            $mini_header_mobile_class   = $hcode_enable_mini_header_mobile == 1 ? 'mini-header-mobile ' : '';
    ?>
        <header class="<?php echo $sticky_header_class . $mini_header_mobile_class . $hcode_header_layout ?>">
            <div class="top-header-area">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <?php dynamic_sidebar( $hcode_enable_mini_header_sidebar ); ?>
                        </div>
                    </div>
                </div>
            </div>
    <?php } ?>

        <?php
                // Logo html start
                ob_start();
            ?>
                    <?php
                        $retina_width = (isset($hcode_options['hcode_retina_logo_width'])) ? 'width:'.$hcode_options['hcode_retina_logo_width'].'; ' : '';
                        $retina_height = (isset($hcode_options['hcode_retina_logo_height'])) ? 'max-height:'.$hcode_options['hcode_retina_logo_height'].'' : '';
                        $r_style  = '';
                    ?>
                    <?php if(!empty($hcode_header_logo) || $retina){?>
                        <a class="logo-light" href="<?php echo home_url(); ?>">
                            <?php
                            if($hcode_header_logo):
                            ?>
                                <img alt="<?php echo get_bloginfo('name') ?>" src="<?php echo $hcode_header_light_logo; ?>" class="logo" />
                            <?php
                            endif;
                            if($retina):
                                if($retina_width || $retina_height):
                                    $r_style = 'style="'.$retina_width.$retina_height.'"';
                                endif;
                                ?>
                                <img alt="<?php echo get_bloginfo('name') ?>" src="<?php echo $retina_light; ?>" class="retina-logo" <?php echo $r_style;?> />
                                <?php
                            endif;
                            ?>
                        </a>
                    <?php }else{
                        ?>
                        <span class="hcode-site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="logo-light" rel="home"><span class="logo"><?php bloginfo( 'name' ); ?></span><span class="retina-logo"><?php bloginfo( 'name' ); ?></span></a></span>
                        <?php
                    } ?>
                    <?php
                    if( ( !empty($hcode_header_light_logo) || $retina_light ) && ( $menu_style != 'headertype9' ) ){
                        $header_type= array('headertype5','headertype7');
                        if(!in_array($hcode_header_layout, $header_type) ){
                            ?>
                            <a class="logo-dark" href="<?php echo home_url(); ?>">
                                <?php
                                if($hcode_header_light_logo):
                                ?>
                                    <img alt="<?php echo get_bloginfo('name') ?>" src="<?php echo $hcode_header_logo; ?>" class="logo" />
                                <?php
                                endif;
                                if($retina_light):
                                    if($retina_width || $retina_height):
                                        $r_style = 'style="'.$retina_width.$retina_height.'"';
                                    endif;
                                ?>
                                    <img alt="<?php echo get_bloginfo('name') ?>" src="<?php echo $retina; ?>" class="retina-logo-light" <?php echo $r_style; ?>/>
                                <?php
                                endif;
                                ?>
                            </a>
                        <?php
                        }
                    } else { ?>
                        <span class="hcode-site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="logo-dark" rel="home"><span class="logo"><?php bloginfo( 'name' ); ?></span><span class="retina-logo"><?php bloginfo( 'name' ); ?></span></a></span>
                        <?php
                    } ?>
            <?php
                $logo_html = ob_get_clean();
                // Logo html end
        ?>

        <!-- navigation -->
        <?php
            if( $menu_style == 'headertype9' ) { // Hamburger Menu Style 1

                if( is_home() ) {
                    $enable_title = hcode_option('hcode_enable_blog_title_wrapper');
                    if($enable_title == '1'){
                        $hcode_options = get_option( 'hcode_theme_setting' );
                        $enable_title = (isset($hcode_options['hcode_enable_blog_title_wrapper'])) ? $hcode_options['hcode_enable_blog_title_wrapper'] : '';
                    }
                } else {
                    $enable_title = hcode_option('hcode_enable_title_wrapper');
                    if($enable_title == '1'){
                        $hcode_options = get_option( 'hcode_theme_setting' );
                        $enable_title = (isset($hcode_options['hcode_enable_title_wrapper'])) ? $hcode_options['hcode_enable_title_wrapper'] : '';
                    }
                }
                $menu_button_class = $enable_title == '1' ? ' menu-on-title' : '';
                $menu_wrap_class = $enable_title == '1' ? ' menu-wrap-on-title' : '';
        ?>

            <div class="menu-wrap pull-menu hamburger-menu1 <?php echo $menu_wrap_class.$hcode_header_text_color ?>">
                <nav class="menu navigation-menu no-transition no-shrink-nav">
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <!-- logo -->
                    <div class="col-md-12 navbar-header no-padding clearfix text-center xs-text-left">
                        <?php echo $logo_html; ?>
                    </div>
                    <!-- end logo -->
                    <div class="col-md-12 no-padding clearfix">
                        <div class="no-padding" id="bs-example-navbar-collapse-1">
                            <?php
                                $defaults = '';
                                if (!empty($header_menu)):
                                    $defaults = array(
                                        'menu'            => $header_menu,
                                        'container'       => false,
                                        'menu_class'      => 'nav navbar-default navbar-nav',
                                        'menu_id'         => 'accordion',
                                        'echo'            => true,
                                        'fallback_cb'     => false,
                                        'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                                        'walker'          => new Hcode_Hamburger_Menu_Walker
                                    );
                                else:
                                    $defaults = array(
                                        'container'       => false,
                                        'menu_class'      => 'nav navbar-default navbar-nav',
                                        'menu_id'         => 'accordion',
                                        'echo'            => true,
                                        'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                                    );
                                endif;

                                wp_nav_menu( $defaults );
                            ?>
                        </div>
                    </div>
                    <?php if( $enable_menu_social_icons == 1 && is_active_sidebar($menu_social_sidebar) ) { ?>
                        <div class="col-md-12 no-padding clearfix">
                            <div class="footer-social no-margin-bottom no-margin-lr text-center">
                                <!-- social media link -->
                                <?php dynamic_sidebar($menu_social_sidebar); ?>
                                <!-- end social media link -->
                            </div>
                        </div>
                    <?php } ?>
                </nav>
                <button class="close-button" id="close-button"><?php esc_html_e( 'Close Menu', 'H-Code' ) ?></button>
            </div>
            <button class="menu-button <?php echo $menu_button_class ?>" id="open-button">
                <span class="sr-only"><?php esc_html_e( 'Open Menu', 'H-Code' ) ?></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
            </button>

        <?php } elseif( $menu_style == 'headertype10' ) { // Hamburger Menu Style 2 ?>

            <nav class="navbar navbar-default navbar-fixed-top nav-transparent overlay-nav sticky-nav nav-white full-width-pull-menu hamburger-menu2">
                <!-- navigation panel -->
                    <div class="nav-container flex-center">
                        <div class="top-burger nav-item" id="btnContainer">
                            <div id="menu-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                                <div id="hamburger"><span></span><span></span><span></span></div>
                                <div id="cross"><span></span><span></span></div>
                            </div>
                        </div>

                        <!-- logo -->

                            <div class="top-logo nav-item">
                                <a class="logo-container" href="http://dev-hr.reflect-media.de" title="Historische Rebsorten">
                                    <svg id="wortmarkeWhite" class="svg-logo" viewBox="0 0 350 100">
                                        <path class="shrink_fill-dark" d="M205.36 51.697h-4.8V35.69h5.732c10.873 0 12.144 16.007-.932 16.007zM188.817 34.75c4.152 0 6.284.164 6.284 5.607v22.41c0 5.225-1.75 5.74-6.283 5.74 0 1.06-.14 1.47.41 1.47h17.206c.55 0 .403-.41.403-1.463-4.858 0-6.27-.635-6.27-6.142V53.97h2.803c.705 0 12.814 16.013 13.61 16.013h10.408c.51 0 .403-.304.403-1.06 0-.267-5.407-2.258-5.873-2.54-1.645-1.025-3.354-2.33-4.71-3.693-2.026-2.062-6.658-6.567-8.098-8.713 1.058-.494 4.553-.34 7.885-2.916 1.87-1.453 3.72-3.94 3.72-7.222 0-8.26-8.005-10.54-16.54-10.54H188.81v1.468l.007-.015zM94.75 67.57H92.48c-4.52 0-5.733-1.214-5.733-5.733V51.697h8.67c9.976 0 10.823 15.886-.664 15.886v-.015zM92.48 49.296h-5.733V35.69h5.733c4.328 0 7.342 2.542 7.342 6.8 0 4.27-3.014 6.806-7.342 6.806zM75.003 34.75c5.034 0 6.284.58 6.284 6.405v20.942c0 5.648-1.2 6.403-6.284 6.403 0 1.06-.14 1.47.402 1.47h18.682c7.202 0 14.947-2.966 14.947-9.73v-1.074c0-4.095-4.822-8.783-8.274-9.072 1.85-2.52 4.942-1.977 4.942-8.14 0-6.85-7.738-8.67-14.947-8.67H75.01v1.467h-.007zm91.666 33.623h-1.604c-8.65 0-14.947-7.484-14.947-16.14v-1.2c0-9.13 6.495-16.282 15.744-16.282 9.496 0 15.745 7.387 15.745 16.805 0 9.08-5.975 16.818-14.94 16.818zM143.72 51.167v.932c0 10.28 10.605 18.8 20.942 18.8h2.4c10.38 0 20.948-8.613 20.948-18.942v-.664c0-10.308-10.562-18.95-20.948-18.95h-2.4c-10.337 0-20.95 8.53-20.95 18.816l.008.007zm-127.963.53h-4.004c-.31 0-.403-.092-.403-.403V35.69h5.338c4.76 0 7.485 3.284 7.485 8.134-.014 5.225-3.142 7.873-8.416 7.873zM.677 33.692v.664c0 1.596 5.74-2.26 5.74 6.143v22.267c0 8.402-5.74 4.52-5.74 6.143 0 .755-.1 1.06.402 1.06h15.618c.544 0 .402-.41.402-1.463-5.507 0-5.747-1.553-5.747-7.604V53.97h2.542c.79 0 11.55 16.006 12.405 16.006h9.34c.6 0 .396-.82.396-1.462-5.436-.12-14.438-10.802-16.945-14.544.482-.226 2.967-.586 3.955-.988 3.41-1.39 6.588-4.554 6.588-8.614v-1.47c0-7.06-7.414-9.6-14.94-9.6H1.066c-.303 0-.395.09-.395.394H.68zm305.025 1.06c4.59 0 6.27.45 6.27 6v21.62c0 5.465-1.47 6.142-6.27 6.142v1.462h14.813c.543 0 .395-.41.395-1.462-7.504 0-6.403-3.283-6.403-11.204V40.506c.946.685 5.564 6.227 6.708 7.554 2.584 2.987 19.967 22.855 20.376 22.855h1.463V40.09c0-7.668 6.403-4.272 6.403-5.74 0-.756.106-1.06-.395-1.06h-14.544c-.508 0-.402.304-.402 1.06 0 1.044 4.498-.636 5.84 2.576.726 1.744.437 5.67.437 8.098V61.97c-2.33-1.554-24.337-28.687-25.756-28.687h-8.938v1.468h.007zM38.31 33.677v1.073c3.954 0 6.27.093 6.27 5.34v22.946c0 7.978-6.27 4.306-6.27 5.874 0 .755-.106 1.06.395 1.06h31.892c.685 0 .805-7.132.805-8.262h-1.46c-1.06 4.568-1.957 5.86-7.612 5.86h-6.538c-4.52 0-5.74-1.242-5.74-5.733V51.697c2.4 0 7.32-.092 9.01.734 2.583 1.272 1.27 5.14 2.187 5.14h1.2V43.564h-1.2c-.94 0 .437 3.728-2.12 5.083-1.792.932-6.494.777-9.08.777V35.698h10.14c4.71 0 7.11 1.412 7.47 5.733h1.61c0-1.023-.318-8.14-.932-8.14H38.705c-.303 0-.395.092-.395.402v-.014zm230.707 1.073c4.8 0 6.262.482 6.262 6.144V62.5c0 5.4-1.54 6-6.27 6 0 1.06-.156 1.483.388 1.483h31.758c.805 0 .932-7.075.932-8.282h-1.2c-1.51 0 1.228 5.86-7.873 5.86h-6.8c-4.46 0-5.47-1.44-5.47-5.86V51.698c5.31 0 10.802-.82 10.802 4.405v1.47c1.143 0 1.602.154 1.602-.404V43.563h-1.603c0 5.422-1.314 5.86-8.275 5.86h-2.528V35.698h9.87c4.837 0 7.372 1.306 7.74 5.733h1.602l-.65-8.14h-30.29v1.47-.01zm-141.986-2.4h-1.594c-4.943 0-10.273 3.7-10.273 8.403v1.2c0 11.184 21.21 12.165 21.21 19.346v1.2c0 3.26-4.11 5.873-7.605 5.873H127.3c-6.213 0-11.226-4.836-11.226-10.943h-1.455v13.485l1.256-.14 2.076-2.67c2.86.67 5.366 2.803 9.206 2.803h2.133c5.593 0 11.608-4.66 11.608-10.14v-1.602c0-9.56-19.035-11.1-21.06-17.368-1.2-3.672 2.152-6.92 5.45-6.92h1.602c8.727 0 8.932 10.683 9.475 10.683.848 0 1.2.114 1.2-.4V32.35c0-.6-.826-.402-1.468-.402-.226.99-.62 1.61-1.23 2.26-1.39 1.504-1.905-1.857-7.836-1.857zm99.68 9.342c.354-4.145 2.648-5.874 7.202-5.874h9.207v27.747c0 4.604-2.472 4.942-6.27 4.942 0 1.06-.142 1.47.402 1.47h17.354c.495 0 .396-.305.396-1.06 0-1.716-6.404 2.492-6.404-6.538V35.83h9.073c8.798 0 6.27 5.86 7.74 5.86h1.2c0-2.012-.297-3.827-.39-5.74-.176-3.44.184-2.655-3.48-2.655h-36.954l-.664 8.402 1.59-.008z"/>
                                        <path class="red-line" fill="#FA3232" d="M.407 82H349.4v-2H.4v2" />
                                        <path class="shrink_fill-dark" d="M256.873 5v14.946c0 2.67-1.27 3.064-3.883 3.064v.798c1.115.254 10.237.254 11.346 0v-.79c-3.107 0-4.004-.608-4.004-3.743v-6.672h13.88v5.874c0 3.545-.4 4.533-4.002 4.533 0 .635-.1.918.388.918h10.542c.494.014.402-.283.402-.918-2.5 0-3.87-.395-3.87-2.944V4.73c0-2.47 1.4-2.668 3.87-2.668V1.13h-11.325v.536c0 1.554 3.996-2.02 3.996 4.8V11h-13.88V5.535c0-5.613 3.996-1.948 4.01-4.377L252.99 1.13v.55c0 1.187 3.883-1.094 3.883 3.32zm-207.76.133V19.82c0 2.682-1.222 3.19-3.87 3.19 0 .635-.084.918.403.918h10.407c.494.014.402-.283.402-.918-2.683 0-3.87-.494-3.87-3.205v-7.202h13.74v7.202c0 2.704-1.2 3.198-3.868 3.198 0 .635-.085.918.402.918h10.547c.495.015.403-.282.403-.917-2.768 0-3.996-.537-3.996-3.34V5.535c0-5.26 4.003-2.54 4.003-3.87V1.13h-11.34v.932c4.717 0 3.87 1.412 3.87 8.945h-13.74c0-7.646-.847-8.952 3.87-8.952V1.13H45.263v.932c2.712 0 3.848.31 3.848 3.07zm124.362 7.336V2.597h2.93c3.354 0 5.74 1.51 5.74 4.8 0 3.15-1.95 5.07-5.07 5.07h-3.6zM170 5.266v14.15c0 2.915-.952 3.6-3.868 3.6 0 .635-.092.918.403.918 1.976.014 9.432.198 10.802-.12v-.798c-4.73 0-3.862-1.765-3.862-9.08h1.596c.565 0 7.908 10.005 8.685 10.005h6.128c.862.014.6-.868-.663-1.2-.706-.17-1.426-.48-1.998-.798-1.158-.65-2.19-1.412-3.178-2.302-.656-.586-5.118-5.24-5.238-5.69 3.177-.07 7.074-2.627 7.074-5.86v-.813c0-7.626-11.897-6.143-19.748-6.143v.932c2.803-.008 3.87.38 3.87 3.197zm-20.15 17.61c-5.153 0-9.333-4.47-9.333-9.462V11.79c0-12.665 19.487-13.485 19.487.665 0 5.648-3.742 10.407-9.348 10.407l-.805.014zm1.074 1.602C157.3 24.48 164 19.196 164 13.004v-1.2c0-6.143-6.92-11.34-13.344-11.34h-.664c-7.202 0-13.062 5-13.577 11.65-.516 6.638 6.53 12.356 12.9 12.356l1.61.01zm137.43-17.744v11.48c0 3.657-.26 4.8-4.01 4.8 0 .636-.09.92.403.92 2.825.013 18.555.21 20.003-.12l.247-5.085h-1.045c-.19 2.345-1.313 3.616-3.87 3.616-9.41 0-8.4 1.102-8.4-9.743 7.038 0 5.93-.14 6.798 3.6h.94v-8.79h-.94c-.918 3.99-.297 3.742-6.8 3.742V2.59h5.466c3.36 0 5.21.495 5.47 3.602h1.075l-.423-5.07h-18.922v.537c.007 1.63 4.01-2.182 4.01 5.076zm-61.51 6.27c0 6 5.932 11.473 12.004 11.473h1.34c4.082 0 5.663-2.684 7.06-3.073l1.816 2.38c.26-.198.466-.27.466-.918v-7.464c0-.452-.24-.403-.67-.403-.636 0-1.68 7.873-8.94 7.873h-.804c-4.957 0-8.275-4.787-8.275-9.87v-1.2c0-5.367 3.432-9.744 9.074-9.744 7.293 0 8.246 7.872 8.93 7.872.425 0 .672.057.672-.395V1.934c0-.565-.523-.396-1.073-.396l-1.13 2.174C244.53 1.857 243.74.466 239.236.466c-6.383 0-12.405 5.338-12.405 11.614l.015.925zm-19.606-6.54c0 7.083 13.203 7.535 13.203 12.145 0 2.522-2.237 4.266-4.673 4.266h-.932c-6.693 0-6.85-6.8-7.343-6.8h-.664v8.403l.918-.093 1.045-1.667c3.002.72 2.5 1.766 7.11 1.766 3.764 0 7.344-2.81 7.344-6.545v-.656c0-6.65-13.203-6.87-13.203-11.742 0-5.224 10.133-4.87 10.133 3.2 1.708 0 1.06-1.992 1.06-3.87 0-.99.408-4.307-.354-4.625-1.272-.544-.538 2.542-2.642 1.236-1.024-.636-2.372-1.017-3.933-1.017-3.975 0-7.067 1.906-7.067 6zM91.418 6.2c0 7.554 13.204 7.624 13.204 12.41v.8c0 2.01-2.648 3.46-5.338 3.46-4.025 0-7.202-2.896-7.202-6.8h-.94v8.4h.94l1.024-1.764c3.036.742 2.358 1.765 7.11 1.765 3.742 0 7.343-2.893 7.343-6.805 0-7.166-13.204-7.364-13.204-11.86v-.947c0-1.462 2.118-2.81 3.728-2.81 6.686 0 5.846 6.672 6.672 6.672h.663V4.187c0-1.024.38-4.18-.6-3.968-1.236.267-.163 2.45-2.472 1.17-.988-.564-2.217-.945-3.742-.945-3.84.02-7.187 2.04-7.187 5.754zm18.14.133c1.107 0-.517-3.6 4.673-3.6h5.734v17.6c0 2.31-1.596 2.684-3.883 2.684 0 .635-.07.918.41.918h10.54c.496 0 .41-.283.41-.918-2.287 0-3.868-.353-3.868-2.683V2.74h5.733c5.196 0 3.565 3.6 4.674 3.6h.663l-.353-5.203h-25.136l-.303 5.203.707-.007zm-32.96-4.27c2.945 0 3.884.316 3.884 3.338v14.143c0 2.923-.99 3.46-3.883 3.46 0 .657-.086.946.4.946H87.41c.494 0 .403-.283.403-.94-2.633 0-3.868-.544-3.868-3.205V5.12c0-2.755 1.13-3.065 3.87-3.065V1.13H76.598v.932zm119.696 16.81c0 3.34-.663 4.137-4.01 4.137 0 .635-.092.918.402.918 1.977 0 9.56.198 10.93-.12v-.79c-4.236 0-4.003-1.597-4.003-5.74 0-2-.19-12.61.41-14.016.81-1.906 3.6-.65 3.6-1.596V1.13c-3.34 0-6.686.042-10.026-.022-.86-.014-2.16.325-1.01.87 1.144.543 3.7-1.046 3.7 3.953l.007 12.943zM93 94.95V94h-3.523v.95H93zm91.08 0V94h-3.53v.95h3.53z"/>
                                        <path class="shrink_both-dark" stroke-width=".6" transform="translate(34.398 89.385)" d="M158.23117 9.0189346L158.561316 9.0189346 161.025621 1.43736603 163.501717 9.0189346 163.831863 9.0189346 166.685268.706328313 166.272585.706328313 163.678581 8.39401526 161.190694.682746451 160.88413.682746451 158.408034 8.38222433 155.81403.706328313 155.377765.706328313 158.23117 9.0189346zM169.718796 8.95997994L170.119688 8.95997994 170.119688.706328313 169.718796.706328313 169.718796 8.95997994zM173.686759 8.95997994L179.558642 8.95997994 179.558642 8.59446109 174.08765 8.59446109 174.08765 4.98643623 178.980887 4.98643623 178.980887 4.62091737 174.08765 4.62091737 174.08765 1.07184717 179.499688 1.07184717 179.499688.706328313 173.686759.706328313 173.686759 8.95997994zM182.215757 8.95997994L182.215757.706328313 184.90409.706328313C187.498095.706328313 189.290316 2.49854981 189.290316 4.8213632L189.290316 4.84494506C189.290316 7.16775845 187.498095 8.95997994 184.90409 8.95997994L182.215757 8.95997994zM182.618208 8.59446109L184.917439 8.59446109C187.287416 8.59446109 188.879192 6.94373076 188.879192 4.85673599L188.879192 4.83315413C188.879192 2.74615936 187.287416 1.07184717 184.905648 1.07184717L182.618208 1.07184717 182.618208 8.59446109zM192.347489 8.95997994L198.219373 8.95997994 198.219373 8.59446109 192.748381 8.59446109 192.748381 4.98643623 197.641617 4.98643623 197.641617 4.62091737 192.748381 4.62091737 192.748381 1.07184717 198.160418 1.07184717 198.160418.706328313 192.347489.706328313 192.347489 8.95997994zM200.940051 8.95997994L200.940051.706328313 204.34763.706328313C205.397023.706328313 206.198806 1.00110159 206.705816 1.49632068 207.083126 1.8854214 207.307154 2.41601329 207.307154 3.0291417L207.307154 3.05272356C207.307154 4.44405341 206.234179 5.25762764 204.713149 5.38732788L207.460436 8.95997994 206.953426 8.95997994 204.265094 5.4344916 201.340943 5.4344916 201.340943 8.95997994 200.940051 8.95997994zM201.293073 5.06897275L204.193642 5.06897275C205.891536 5.06897275 206.858392 4.24360758 206.858392 3.07630542L206.858392 3.05272356C206.858392 1.81467582 205.903327 1.07184717 204.276178 1.07184717L201.293073 1.07184717 201.293073 5.06897275zM210.372785 8.95997994L216.244669 8.95997994 216.244669 8.59446109 210.773677 8.59446109 210.773677 4.98643623 215.666913 4.98643623 215.666913 4.62091737 210.773677 4.62091737 210.773677 1.07184717 216.185714 1.07184717 216.185714.706328313 210.372785.706328313 210.372785 8.95997994zM218.970209 8.95997994L219.35931 8.95997994 219.35931 1.33124765 225.44343 8.95997994 225.761785 8.95997994 225.761785.706328313 225.372684.706328313 225.372684 8.27610595 219.335728.706328313 218.970209.706328313 218.970209 8.95997994zM231.34109 8.95997994L231.741982 8.95997994 231.741982 1.07184717 234.689714 1.07184717 234.689714.706328313 228.405148.706328313 228.405148 1.07184717 231.34109 1.07184717 231.34109 8.95997994zM237.386004 8.95997994L237.386004.706328313 240.074336.706328313C242.668341.706328313 244.460562 2.49854981 244.460562 4.8213632L244.460562 4.84494506C244.460562 7.16775845 242.668341 8.95997994 240.074336 8.95997994L237.386004 8.95997994zM237.788454 8.59446109L240.087685 8.59446109C242.457662 8.59446109 244.049438 6.94373076 244.049438 4.85673599L244.049438 4.83315413C244.049438 2.74615936 242.457662 1.07184717 240.075894 1.07184717L237.788454 1.07184717 237.788454 8.59446109zM247.588344 8.95997994L253.460228 8.95997994 253.460228 8.59446109 247.989236 8.59446109 247.989236 4.98643623 252.882472 4.98643623 252.882472 4.62091737 247.989236 4.62091737 247.989236 1.07184717 253.401273 1.07184717 253.401273.706328313 247.588344.706328313 247.588344 8.95997994zM259.735701 9.10147112C261.197777 9.10147112 262.200006 8.47655178 262.978207 7.68655941L262.695225 7.415368C261.964187 8.16998757 261.044495 8.73595226 259.759283 8.73595226 257.672288 8.73595226 256.092304 6.97910355 256.092304 4.84494506L256.092304 4.8213632C256.092304 2.6872047 257.648706.930356 259.747492.930356 261.127031.930356 261.964187 1.50811161 262.648061 2.16840374L262.931043 1.87363047C262.12926 1.13080183 261.292104.564837142 259.759283.564837142 257.401097.564837142 255.679621 2.51034074 255.679621 4.83315413L255.679621 4.85673599C255.679621 7.20313124 257.401097 9.10147112 259.735701 9.10147112zM265.698383 8.95997994L266.099275 8.95997994 266.099275 6.70791214 268.304179 4.52658993 271.806085 8.95997994 272.324886 8.95997994 268.587161 4.25539851 272.183395.706328313 271.629222.706328313 266.099275 6.22448398 266.099275.706328313 265.698383.706328313 265.698383 8.95997994zM277.466939 8.95997994L277.867831 8.95997994 277.867831 1.07184717 280.815563 1.07184717 280.815563.706328313 274.530997.706328313 274.530997 1.07184717 277.466939 1.07184717 277.466939 8.95997994zM68.2447865 9.02133466L68.57874 9.02133466 71.0714647 1.43976609 73.5761163 9.02133466 73.9100699 9.02133466 76.7963827.708728378 76.3789408.708728378 73.75502 8.39641533 71.2384415.685146516 70.9283418.685146516 68.4236902 8.3846244 65.7997694.708728378 65.3584737.708728378 68.2447865 9.02133466zM79.7546942 8.95997994L85.6265778 8.95997994 85.6265778 8.59446109 80.1555859 8.59446109 80.1555859 4.98643623 85.0488222 4.98643623 85.0488222 4.62091737 80.1555859 4.62091737 80.1555859 1.07184717 85.5676231 1.07184717 85.5676231.706328313 79.7546942.706328313 79.7546942 8.95997994zM88.4206777 8.95997994L88.4206777.706328313 91.8282568.706328313C92.8776496.706328313 93.6794329 1.00110159 94.186443 1.49632068 94.5637527 1.8854214 94.7877804 2.41601329 94.7877804 3.0291417L94.7877804 3.05272356C94.7877804 4.44405341 93.7148057 5.25762764 92.1937756 5.38732788L94.9410625 8.95997994 94.4340525 8.95997994 91.7457203 5.4344916 88.8215694 5.4344916 88.8215694 8.95997994 88.4206777 8.95997994zM88.8215694 5.06897275L91.7221384 5.06897275C93.4200324 5.06897275 94.3868888 4.24360758 94.3868888 3.07630542L94.3868888 3.05272356C94.3868888 1.81467582 93.4318234 1.07184717 91.8046749 1.07184717L88.8215694 1.07184717 88.8215694 5.06897275zM99.7557225 8.9599786L100.156614 8.9599786 100.156614 1.07184582 103.104347 1.07184582 103.104347.706326966 96.8197807.706326966 96.8197807 1.07184582 99.7557225 1.07184582 99.7557225 8.9599786zM109.171169 9.0189346L109.501315 9.0189346 113.203667.706328313 112.790985.706328313 109.348033 8.51192457 105.905081.706328313 105.468816.706328313 109.171169 9.0189346zM119.150735 9.10147112C116.651058 9.10147112 115.0357 7.09701286 115.0357 4.84494506L115.0357 4.8213632C115.0357 2.5692954 116.662849.564837142 119.162526.564837142 121.662204.564837142 123.277561 2.5692954 123.277561 4.8213632 123.289352 4.8213632 123.289352 4.83315413 123.277561 4.84494506 123.277561 7.09701286 121.650413 9.10147112 119.150735 9.10147112zM119.171152 8.73595226C121.364265 8.73595226 122.861713 6.94373076 122.861713 4.85673599L122.861713 4.83315413C122.861713 2.74615936 121.340683.930356 119.14757.930356 116.942666.930356 115.445218 2.7225775 115.445218 4.80957227L115.445218 4.83315413C115.445218 6.9201489 116.966248 8.73595226 119.171152 8.73595226zM126.32965 8.95997994L131.706315 8.95997994 131.706315 8.59446109 126.730542 8.59446109 126.730542.706328313 126.32965.706328313 126.32965 8.95997994zM134.418511 8.95997994L139.795176 8.95997994 139.795176 8.59446109 134.819403 8.59446109 134.819403.706328313 134.418511.706328313 134.418511 8.95997994zM3.36008715 8.98087851C5.04609224 8.98087851 6.14258507 8.0457628 6.14258507 6.7833566L6.14258507 6.7599787C6.14258507 5.61446196 5.39979961 4.95988097 3.34829691 4.55076785 1.34395519 4.14165472.789813653 3.61565214.789813653 2.66884748L.789813653 2.64546959C.789813653 1.73373178 1.6858723.927194479 3.04175053.927194479 4.00855065.927194479 4.86923856 1.24279603 5.62381427 1.83893229L5.87140942 1.52333074C5.09325323.915505532 4.19719458.564837142 3.06533102.564837142 1.50901862.564837142.388945309 1.5116418.388945309 2.68053643L.388945309 2.70391432C.388945309 3.8844979 1.17889175 4.51570101 3.19502372 4.91312518 5.18757519 5.3222383 5.74171672 5.83655194 5.74171672 6.79504554L5.74171672 6.81842344C5.74171672 7.84705071 4.81028734 8.61852117 3.38366764 8.61852117 2.18106261 8.61852117 1.21426249 8.1977191.341784327 7.37949286L.0706086828 7.67171652C1.00203807 8.5250096 2.0749504 8.98087851 3.36008715 8.98087851zM9.17687904 8.93639808L14.9452564 8.93639808 14.9452564 8.57087923 9.57070401 8.57087923 9.57070401 4.96285437 14.3776851 4.96285437 14.3776851 4.59733551 9.57070401 4.59733551 9.57070401 1.04826531 14.887341 1.04826531 14.887341.682746451 9.17687904.682746451 9.17687904 8.93639808zM17.721702 8.93639808L23.0983665 8.93639808 23.0983665 8.57087923 18.1225937 8.57087923 18.1225937.682746451 17.721702.682746451 17.721702 8.93639808zM26.8637635 8.93639808L27.2646552 8.93639808 27.2646552 1.04826531 30.2123879 1.04826531 30.2123879.682746451 23.9278217.682746451 23.9278217 1.04826531 26.8637635 1.04826531 26.8637635 8.93639808zM32.9100456 8.93639808L38.7819292 8.93639808 38.7819292 8.57087923 33.3109372 8.57087923 33.3109372 4.96285437 38.2041736 4.96285437 38.2041736 4.59733551 33.3109372 4.59733551 33.3109372 1.04826531 38.7229745 1.04826531 38.7229745.682746451 32.9100456.682746451 32.9100456 8.93639808zM41.4377085 8.93852569L41.8308866 8.93852569 41.8308866 1.3097934 47.9787626 8.93852569 48.3004538 8.93852569 48.3004538.684874058 47.9072757.684874058 47.9072757 8.2546517 41.8070576.684874058 41.4377085.684874058 41.4377085 8.93852569z"/>
                                    </svg>
                                    <div class="logo-after">
                                        <svg id="logoAfter" width="152" height="158" viewBox="0 0 152 158">
                                            <path class="shrink_both-light" id="logoBgFill" stroke-opacity=".5" d="M151 1c0 60-8.24 82.13-10.53 88.67-11.24 32.24-38.45 56.42-64.47 67.16-26.02-10.74-53.06-34.92-64.3-67.16C9.45 83.13 1 61 1 1h150z"/>
                                            <path class="shrink_fill-dark" d="M97.5 37.18c-.4.23-1.35.14-2.02.14-3.5 0-13.86.16-15.8-.04-.23-1.06-.07-11.88-.07-14.67 0-.86-.04-1.6.2-2.05 0-6.33 2.24-8.6 7.95-9.16 9.63-.95 19.42 5.77 17.52 16.4-.7 3.9-4.26 8.5-7.76 9.38zm-76.13-26.7c0 1.55 9.07-1.67 9.07 11.12v35.07c0 13.4-9.07 9.43-9.07 11.55 0 .33.1.43.43.43h22.88c.55 0 .58-1.17.58-1.73-3.95-.92-5.33-5.02-5.33-9.96V39.93H70.3v6.2c5.03-.32 4.36-.36 9.35-.07v-6.13h6.18c8.14 0 12.26 6.66 15.57 11.66 1.05 1.56 10.07 17.06 10.33 17.06h18.14V67.5c-7.17 0-11.34-9.17-14.45-13.8-2.37-3.54-5.8-10.2-8.78-12.4-.76-.56-4.55-2.2-4.7-2.38 3.54 0 9.3-2.4 11.46-3.96 3.02-2.18 5.53-5.14 5.53-10.2 0-10.3-11.4-14.35-21.6-14.7-11.74-.4-24.1-.16-36.1-.16v1c7.56.18 9.06 4.56 9.06 12.28v14H39.92V21.75c0-7.3 2.17-10.26 8.92-10.82V9.9H21.37v.58z"/>
                                            <path class="shrink_fill-dark" d="M144.38 9.82h-2.02c0 43.73-6.25 80.13-37.1 105.05-4.38 3.54-8.82 6.85-13.86 9.7-1.3.75-6.44 3.35-15.4 7.8-8.25-4.16-13.45-6.85-15.6-8.1-4.84-2.77-9.66-6.3-13.8-9.76-9.26-7.68-15.14-15.04-21.5-25.66-11.58-19.4-15.24-48.03-15.24-79H7.98c-.72-.02-.17 21.4.05 23.64.78 7.86.92 15.18 2.03 22.7 2.2 14.92 5.62 26.72 11.32 38.13 10.7 21.38 26.8 36.28 48.9 46.22.94.43 2.85 1.18 5.72 2.23 1.18-.3 2.95-1.04 5.3-2.23 8.3-4.14 15.66-8.3 22.92-14.12 9.35-7.5 16.98-15.67 23.25-26.2 12.7-21.35 16.9-47.92 16.9-81.85V9.82z"/>
                                            <path class="shrink_fill-dark" d="M47.35 71.65c0 14.8 9.7 20.36 21.8 23.2v7.34H56.7c-7.95 0-7-4.97-8.04-6.5v12.7H70.3V93.54c-8.1-.68-14.63-11.22-14.63-20.75v-2.3c0-28.5 39.9-28.28 39.9-.3 0 6.9-.54 11.17-4.3 16.44-1.23 1.73-2.64 3.13-4.4 4.36-.54.36-5.94 2.92-5.94 2.98v14.4h21.67V95.43c-.9 1.4-.13 3.12-2.26 5.1-1.3 1.2-3.34 1.67-5.78 1.67H82.22v-7.07c0-.6 21.67-2.63 21.67-23.62 0-14.75-12.47-23.47-27.28-23.47h-2.15c-14.77 0-27.12 8.84-27.12 23.62z"/>
                                            <path class="shrink_fill-dark" d="M70.16 51.65c0 9.57-.1 15.84-9.06 15.84v1.16h27.5v-.73c0-.34-4.34-1.24-4.76-1.45-4.87-2.4-4.3-8.92-4.3-14.9-4.8-.77-4.27-.56-9.38.07z"/>
                                        </svg>
                                    </div>
                                </a>
                            </div>
                            <?php // echo $logo_html; ?>

                        <!-- end logo -->
                        <!-- search -->
                            <div class="top-search nav-item">
                                <div id="top-search">
                                    <!-- nav search -->
                                    <a href="#search-header" class="header-search-form"><i class="fa fa-search search-button"></i></a>
                                    <!-- end nav search -->
                                </div>
                            </div>
                            <!-- search input-->
                            <form id="search-header" method="get" action="<?php echo esc_url( home_url( '/' ) ) ?>" name="search-header" class="mfp-hide search-form-result">
                                <div class="search-form position-relative">
                                    <button type="submit" class="fa fa-search close-search search-button black-text"></button>
                                    <input type="text" name="s" class="search-input" value="<?php echo get_search_query() ?>" placeholder="<?php echo $hcode_search_placeholder_text ?>" autocomplete="off">
                                </div>
                            </form>
                            <!-- end search input -->
                        <!-- end search -->
                        <!-- main menu -->
                        <div class="menu-wrap pull-menu full-screen ">
                            <div class="pull-menu-open">
                                <div class="pull-menu-open-sub">
                                    <div class="col-md-12">
                                        <?php
                                            $defaults = '';
                                            if (!empty($header_menu)):
                                                $defaults = array(
                                                    'menu'            => $header_menu,
                                                    'container'       => false,
                                                    'menu_class'      => 'nav navbar-nav panel-group',
                                                    'menu_id'         => 'accordion',
                                                    'echo'            => true,
                                                    'fallback_cb'     => false,
                                                    'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                                                    'walker'          => new Hcode_Hamburger_Menu_Walker
                                                );
                                            else:
                                                $defaults = array(
                                                    'container'       => false,
                                                    'menu_class'      => 'nav navbar-nav panel-group',
                                                    'menu_id'         => 'accordion',
                                                    'echo'            => true,
                                                    'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                                                );
                                            endif;

                                            wp_nav_menu( $defaults );
                                        ?>
                                    </div>
                                </div>
                            </div>
                            <button class="close-button" id="close-button"><?php esc_html_e( 'Close Menu', 'H-Code' ) ?></button>
                        </div>
                        <!-- end main menu -->
                        <!-- </div> -->
                    </div>
                    <!-- end navigation panel -->
                <!-- </div> -->
            </nav>
            <svg style="position: absolute;">
                <defs>
                    <clipPath id="logoPath">
                        <path d="M1 1h155v29.9c0 29.9-8.52 59.7-10.88 66.83C133.5 132.9 105.4 159.28 78.5 171c-26.9-11.72-54.83-38.1-66.43-73.27C9.72 90.6 1 60.8 1 30.9V1z"/>
                    </clipPath>
                </defs>
            </svg>

        <?php } elseif( $menu_style == 'headertype11' ) { // Hamburger Menu Style 3 ?>

            <nav class="navbar navbar-default nav-dark navbar-fixed-top nav-transparent overlay-nav sticky-nav full-width-pull-menu full-width-pull-menu-dark  hamburger-menu3 <?php echo $classes.$hcode_header_text_color ?>">
                <!-- navigation panel -->
                <div class="container">
                    <div class="row">
                        <!-- logo -->
                        <div class="col-md-2 col-sm-2 pull-left">
                            <?php echo $logo_html; ?>
                        </div>
                        <!-- end logo -->
                        <!-- main menu -->
                        <div class="col-md-10 col-sm-10 no-padding-right no-transition">
                            <div class="menu-wrap full-screen no-padding">
                                <div class="col-md-6 col-sm-6 full-screen no-padding cover-background xs-display-none" style="background-image:url('<?php echo esc_url( $menu_image ) ?>');"></div>
                                <div class="col-md-6 col-sm-6 full-screen bg-white bg-hamburger-menu3">
                                    <div class="pull-menu full-screen ">
                                        <div class="pull-menu-open">
                                            <div class="pull-menu-open-sub">
                                                <?php
                                                    $defaults = '';
                                                    if (!empty($header_menu)):
                                                        $defaults = array(
                                                            'menu'            => $header_menu,
                                                            'container'       => false,
                                                            'menu_class'      => 'nav navbar-nav panel-group no-padding',
                                                            'menu_id'         => 'accordion',
                                                            'echo'            => true,
                                                            'fallback_cb'     => false,
                                                            'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                                                            'walker'          => new Hcode_Hamburger_Menu_Walker
                                                        );
                                                    else:
                                                        $defaults = array(
                                                            'container'       => false,
                                                            'menu_class'      => 'nav navbar-nav panel-group no-padding',
                                                            'menu_id'         => 'accordion',
                                                            'echo'            => true,
                                                            'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                                                        );
                                                    endif;

                                                    wp_nav_menu( $defaults );
                                                ?>

                                                <?php if( $enable_menu_separator == 1 ) { ?>
                                                    <div class="separator-line-thick bg-black margin-three pull-left margin-five"></div>
                                                <?php } ?>

                                                <?php if( $enable_menu_social_icons == 1 && is_active_sidebar($menu_social_sidebar) ) { ?>
                                                    <div class="col-md-12 col-sm-12 col-xs-12 no-padding">
                                                        <!-- social media link -->
                                                        <?php dynamic_sidebar($menu_social_sidebar); ?>
                                                        <!-- end social media link -->
                                                    </div>
                                                <?php } ?>
                                            </div>
                                        </div>
                                        <button class="close-button" id="close-button"><?php esc_html_e( 'Close Menu', 'H-Code' ) ?></button>
                                    </div>
                                </div>
                            </div>
                            <!-- end main menu -->
                            <button type="button" class="menu-button-orange position-absolute position-right navbar-toggle" id="open-button" data-toggle="collapse" data-target=".navbar-collapse">
                                <span class="sr-only"><?php esc_html_e( 'Open Menu', 'H-Code' ) ?></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                        </div>
                    </div>
                    <!-- end navigation panel -->
                </div>
            </nav>
        <?php } else { // Default Menu Style ?>

            <nav class="navbar navbar-default navbar-fixed-top nav-transparent overlay-nav sticky-nav <?php echo $classes.$hcode_header_text_color." ".$enable_sticky;?>" data-menu-hover-delay="<?php echo $hcode_menu_hover_delay; ?>">
                <div class="container">
                    <div class="row">
                        <!-- logo -->
                        <div class="<?php echo $header_logo_wrap_class ?> pull-left">
                            <?php echo $logo_html; ?>
                        </div>
                        <!-- end logo -->

                        <!-- search and cart  -->
                        <?php
                        ob_start();
                            if($hcode_header_search == 1 || $hcode_header_cart == 1):
                                $width_auto_class = $header_logo_position == 'top' ? ' width-auto' : ' no-padding-left';
                        ?>
                                    <div class="col-md-1 search-cart-header pull-right<?php echo $width_auto_class ?>">
                                    <?php if($hcode_header_search == 1): ?>
                                    <div id="top-search">
                                        <!-- nav search -->
                                        <a href="#search-header" class="header-search-form"><i class="fa fa-search search-button"></i></a>
                                        <!-- end nav search -->
                                    </div>
                                    <!-- search input-->
                                    <form id="search-header" method="get" action="<?php echo esc_url( home_url( '/' ) ) ?>" name="search-header" class="mfp-hide search-form-result">
                                        <div class="search-form position-relative">
                                            <button type="submit" class="fa fa-search close-search search-button black-text"></button>
                                            <input type="text" name="s" class="search-input" value="<?php echo get_search_query() ?>" placeholder="<?php echo $hcode_search_placeholder_text ?>" autocomplete="off">
                                        </div>
                                    </form>
                                    <!-- end search input -->

                                    <?php endif; ?>

                                    <?php if( $hcode_header_cart == 1 && is_active_sidebar( $hcode_header_mini_cart ) ):?>
                                        <div class="top-cart">
                                            <?php dynamic_sidebar($hcode_header_mini_cart);?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            <?php endif; ?>
                        <?php
                            $search_cart_section = ob_get_clean();
                        ?>
                        <!-- end search and cart  -->

                        <?php
                            if( $header_logo_position != 'top' ) :
                                echo $search_cart_section;
                            endif;
                        ?>

                        <!-- toggle navigation -->
                        <div class="navbar-header col-sm-8 sm-width-auto col-xs-2 pull-right">
                            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                                <span class="sr-only"><?php esc_html_e( 'Toggle navigation', 'H-Code' ) ?></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                        </div>
                        <!-- toggle navigation end -->
                        <!-- main menu -->
                        <?php
                            $no_padding_right_class = $header_logo_position == 'center' ? '' : ' no-padding-right';
                            if($hcode_header_search == 1 || $hcode_header_cart == 1):
                        ?>
                            <?php if( class_exists( 'WooCommerce' ) ){ ?>
                                <div class="<?php echo $header_menu_col_class . $no_padding_right_class ?> accordion-menu text-right">
                            <?php }else { ?>
                                <div class="<?php echo $header_menu_col_class . $no_padding_right_class ?> accordion-menu text-right pull-right">
                            <?php } ?>
                        <?php else: ?>
                            <div class="<?php echo $header_menu_col_class . $no_padding_right_class ?> accordion-menu text-right pull-right menu-position-right">
                        <?php
                        endif;
                        $defaults = '';
                            if (!empty($header_menu)):
                                $defaults = array(
                                    'menu'            => $header_menu,
                                    'container'       => 'div',
                                    'container_class' => 'navbar-collapse collapse '.$header_main_menu_class,
                                    'container_id'    => 'mega-menu',
                                    'menu_class'      => 'mega-menu-ul nav navbar-nav '.$header_main_menu_class.' panel-group',
                                    'menu_id'         => '',
                                    'echo'            => true,
                                    'fallback_cb'     => false,
                                    'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                                    'walker'          => new Hcode_Mega_Menu_Walker
                                );
                            elseif( has_nav_menu('hcodemegamenu') ):
                                $defaults = array(
                                    'theme_location'  => 'hcodemegamenu',
                                    'container'       => 'div',
                                    'container_class' => 'navbar-collapse collapse '.$header_main_menu_class,
                                    'container_id'    => 'mega-menu',
                                    'menu_class'      => 'mega-menu-ul nav navbar-nav '.$header_main_menu_class.' panel-group',
                                    'menu_id'         => '',
                                    'echo'            => true,
                                    'fallback_cb'     => false,
                                    'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                                    'walker'          => new Hcode_Mega_Menu_Walker
                                );
                            else:
                                $defaults = array(
                                    'container'       => 'div',
                                    'container_class' => 'navbar-collapse collapse '.$header_main_menu_class,
                                    'container_id'    => 'mega-menu',
                                    'menu_class'      => 'mega-menu-ul nav navbar-nav '.$header_main_menu_class.' panel-group',
                                    'menu_id'         => '',
                                    'echo'            => true,
                                    'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                                );
                            endif;

                            wp_nav_menu( $defaults );

                            if ( $header_logo_position == 'center' && !empty($header_secondary_menu)):

                                $secondary_defaults = array(
                                    'menu'            => $header_secondary_menu,
                                    'container'       => 'div',
                                    'container_class' => 'navbar-collapse collapse navbar-right',
                                    'container_id'    => 'mega-menu',
                                    'menu_class'      => 'mega-menu-ul nav navbar-nav navbar-right panel-group',
                                    'menu_id'         => '',
                                    'echo'            => true,
                                    'fallback_cb'     => false,
                                    'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                                    'walker'          => new Hcode_Mega_Menu_Walker
                                );

                                wp_nav_menu( $secondary_defaults );

                            endif;
                            ?>
                        </div>
                        <!-- end main menu -->

                        <?php
                            if( $header_logo_position == 'top' ) :
                                echo $search_cart_section;
                            endif;
                        ?>

                    </div>
                </div>
            </nav>
        <?php } ?>
        <!-- end navigation -->

    <?php if( hcode_check_enable_mini_header() ) { ?>
        </header>
    <?php } ?>
<?php } ?>