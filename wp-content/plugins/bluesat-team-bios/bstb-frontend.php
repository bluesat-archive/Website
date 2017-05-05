<?php
/*****************************************************
* CPT Bootstrap Carousel
* http://www.tallphil.co.uk/bootstrap-carousel/
* ----------------------------------------------------
* bstb-frontend.php
* Code to handle front-end rendering of the carousel
******************************************************/

///////////////////
// FRONT END
///////////////////

// Shortcode
function bstb_shortcode($atts, $content = null) {
        // Set default shortcode attributes
    $options = get_option( 'bstb_settings' );
    if(!$options){
        bstb_set_options ();
        $options = get_option( 'bstb_settings' );
    }
    $options['id'] = '';

    // Parse incomming $atts into an array and merge it with $defaults
    $atts = shortcode_atts($options, $atts);

    return bstb_frontend($atts);
}
add_shortcode('team-bios', 'bstb_shortcode');

//Display photo code
function bstb_print_photo($bio) {
?>
<div class="col-xs-12 col-sm-3 hidden-xs">
    <img class="alignnone size-medium img-responsive photo" src="<?php echo $bio['img_src'];?>" alt="<?php echo $bio['title'];?>" itemprop="image" />
</div>
<?php
    
}

// Display team bio
function bstb_frontend($atts){

    // Build the attributes
    $id = rand(0, 999); // use a random ID so that the CSS IDs work with multiple on one page
    $args = array(
        'post_type' => 'bstb',
        'posts_per_page' => '-1',
        'orderby' => $atts['orderby'],
        'order' => $atts['order']
    );
    if($atts['category'] != ''){
        $args['teambio_category'] = $atts['category'];
    }
    if(!isset($atts['before_title'])) $atts['before_title'] = '<h4>';
    if(!isset($atts['after_title'])) $atts['after_title'] = '</h4>';
    if(!isset($atts['before_caption'])) $atts['before_caption'] = '<p>';
    if(!isset($atts['after_caption'])) $atts['after_caption'] = '</p>';
    if(!isset($atts['image_size'])) $atts['image_size'] = 'full';
    if(!isset($atts['use_background_images'])) $atts['use_background_images'] = '0';
    if(!isset($atts['use_javascript_animation'])) $atts['use_javascript_animation'] = '1';
    if(!isset($atts['select_background_images_style_size'])) $atts['select_background_images_style_size'] = 'cover';
    if($atts['id'] != ''){
        $args['p'] = $atts['id'];
    }

    // Collect the carousel content. Needs printing in two loops later (bullets and content)
    $loop = new WP_Query( $args );
    $teamMembers = array();
    $output = '';
    while ( $loop->have_posts() ) {
        $loop->the_post();
        if ( '' != get_the_post_thumbnail(get_the_ID(), $atts['image_size']) ) {
            $post_id = get_the_ID();
            $title = get_the_title();
            $content = get_the_excerpt();
            $image = get_the_post_thumbnail( get_the_ID(), $atts['image_size'] );
            $image_src = wp_get_attachment_image_src(get_post_thumbnail_id(), $atts['image_size']);
            $image_src = $image_src[0];
            $roleArray = get_the_terms(get_the_ID(), 'teambio_role');
            $roleText= "";
            if ($roleArray) {
                if(count($roleArray) > 0) {
                    $roleText = $roleArray[0]->name;
                    
                }
            }
            $url = get_post_meta(get_the_ID(), 'bstb_image_url', true);
            $url_openblank = get_post_meta(get_the_ID(), 'bstb_image_url_openblank', true);
            $link_text = get_post_meta(get_the_ID(), 'bstb_image_link_text', true);
            $teamMembers[] = array('post_id' => $post_id, 'team_role' => $roleText, 'title' => $title, 'content' => $content, 'image' => $image, 'img_src' => $image_src, 'url' => esc_url($url), 'url_openblank' => $url_openblank == "1" ? true : false, 'link_text' => $link_text);
        }
    }

    // Check we actually have something to show
    if(count($teamMembers) > 0){
        $even = false;
        ob_start();
        ?>
        <div id="bstb_<?php echo $id; ?>" class="team-bios container-fluid">
            <?php
            // Carousel Content
            foreach ($teamMembers as $key => $bio) {
            ?>
                <div class="row h-card" itemprop="member" itemscope itemtype="http://schema.org/Person">
                    <?php if(!$even) { 
                        bstb_print_photo($bio);
                    } ?>
                    <div class="col-xs-12 col-sm-8 <?php if($even) { ?> even <?php } else {?> odd <?php } ?>">
                        <h3 itemprop="name" class="p-name"><?php echo $bio['title'];?></h3>
                        <h4 itemprop="jobTitle" class="p-job-title"><?php echo $bio['team_role'];?></h4>
                        <p itemprop="description" class="p-note"><?php echo $bio['content'];?></p>
                        <!--<link itemprop="memberOf" itemtype="http://schema.org/Organization" href="http://bluesat.com.au/#organization" />-->
                        </span>
                    </div>
                    <?php if($even) { 
                        bstb_print_photo($bio);
                    }
                    $even = !$even;
                    ?>
                </div>
            <?php } ?>

        </div>
<?php
        // Collect the output
        $output = ob_get_contents();
        ob_end_clean();
    }
    
    
    // Restore original Post Data
    wp_reset_postdata();  
    
    return $output;
}

