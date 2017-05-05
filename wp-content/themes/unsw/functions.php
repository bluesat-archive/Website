<?php
/* Theme setup */
add_action( 'after_setup_theme', 'wpt_setup' );
    if ( ! function_exists( 'wpt_setup' ) ):
        function wpt_setup() {  
        } endif;
        
add_action('get_header', 'remove_admin_login_header');
function remove_admin_login_header() {
    remove_action('wp_head', '_admin_bar_bump_cb');
}

if ( ! function_exists( 'setup_unsw_theme' ) ):
    function setup_unsw_theme() {

        add_theme_support( 'post-thumbnails', array('post') ); 
        register_nav_menu( 'primary', __( 'Primary navigation', 'wptuts' ) );
        
        add_theme_support( 'title-tag' );
        add_theme_support( 'html5', array(
                'comment-form',
                'comment-list',
                'gallery',
                'caption',
        ) );
        add_editor_style( array( 'editor-style.css')  );
    }
endif;

add_action( 'after_setup_theme', 'setup_unsw_theme' );
function print_sponsors($category) {

    $images = cptbc_get_images(array(
        
        'interval' => '5000',
        'showcaption' => 'true',
        'showcontrols' => 'true',
        'orderby' => 'menu_order',
        'order' => 'ASC',
        'category' => $category,
        'image_size' => 'full',
        'id' => '',
        'twbs' => '3',
    ));
    foreach ($images as $key => $image) {
    ?>
        <span itemprop="sponsor" itemscope itemtype="http://schema.org/Organization">
            <a itemprop="url" href="<?php echo $image["url"];?>">
                <img itemprop="image" src="<?php echo $image["img_src"];?>" alt="<?php echo $image["title"]?>" />
            </a>
            <meta itemprop="name" content="<?php echo $image["title"]?>"/>
        </span>
        <?php
    }
}

add_filter( 'amp_post_template_data', 'bluesat_amp_set_site_icon_url' );

function bluesat_amp_set_site_icon_url( $data ) {
    // Ideally a 32x32 image
    $data[ 'site_icon_url' ] = get_stylesheet_directory_uri() . '/images/bluesatLogo.png';
    return $data;
}

add_action( 'amp_post_template_css', 'bluesat_amp_my_additional_css_styles' );

function bluesat_amp_my_additional_css_styles( $amp_template ) {
    // only CSS here please...
    ?>
    font-face {
        font-family: 'SommetBold';
        src: url('fonts/SommetBold.eot?#iefix') format('embedded-opentype'), /* IE6-IE8 */
            url('fonts/SommetBold.woff') format('woff'), /* Modern Browsers */
            url('fonts/SommetBold.ttf')  format('truetype'), /* Safari, Android, iOS */
    }

    h1, h2, h3, h4 {
        font-family: "SommetBold", Arial;
    }
    
    body {
        font-family: arial;
        background-color: #F6F6F6;
    }
    
    .amp-wp-header {
         border-bottom: 10px solid #FC0;
    }
    
    .amp-wp-header .amp-wp-site-icon {
        display: none;
    }
    header.amp-wp-header {
        padding: 12px 0;
        background: #FFF;
    }
    header.amp-wp-header a {
        background-image: url( <?php echo get_stylesheet_directory_uri() . '/images/bluesatLogo.png';?> );
        background-repeat: no-repeat;
        background-size: contain;
        display: block;
        width: 167px;
        margin: 0 auto;
        text-indent: -9999px;
    }
    <?php
}

add_filter( 'amp_post_template_analytics', 'bluesat_amp_add_custom_analytics' );
function bluesat_amp_add_custom_analytics( $analytics ) {
    if ( ! is_array( $analytics ) ) {
        $analytics = array();
    }

    // https://developers.google.com/analytics/devguides/collection/amp-analytics/
    $analytics['bluesat-googleanalytics'] = array(
        'type' => 'googleanalytics',
        'attributes' => array(
            // 'data-credentials' => 'include',
        ),
        'config_data' => array(
            'vars' => array(
                'account' => "UA-70823030-2"
            ),
            'triggers' => array(
                'trackPageview' => array(
                    'on' => 'visible',
                    'request' => 'pageview',
                ),
            ),
        ),
    );


    return $analytics;
}
?>
<?php // Register custom navigation walker
    require_once('wp_bootstrap_navwalker.php');
    
?>