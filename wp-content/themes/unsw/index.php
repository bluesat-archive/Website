<?php get_header(); ?>
    <div id="main">
        <?php if (have_posts()) :?>
            <?php if ( is_home() && ! is_front_page() ) : ?>
                <header>
                    <h1 class="page-title screen-reader-text entry-title"><?php single_post_title(); ?></h1>
                </header>
            <?php endif; ?>
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <?php  while (have_posts()) : the_post(); 
                            //load different formats from files with name content_*.php
                            get_template_part( 'content', get_post_type() );
                        endwhile; else: ?>
                        <p><?php _e('Sorry, no posts matched your criteria.'); ?></p><?php endif; ?>
                    </div>
                </div>
            </div>
    </div>
    <div id="delimiter">
    </div>
<?php get_footer(); ?>