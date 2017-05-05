<!DOCTYPE html>
<html lang="en">
    <head <?php do_action( 'add_head_attributes' ); ?>>
        <meta charset="<?php bloginfo( 'charset' ); ?>" />
<!--         <title><?php wp_title(); ?></title> -->
        <!-- Bootstrap -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" integrity="sha512-dTfge/zgoMYpP7QbHy4gWMEGsbsdZeCXz7irItjcC3sPUFtf0kuFbDz/ixG7ArTxmDjLXDmezHubeNikyKGVyQ==" crossorigin="anonymous">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css" integrity="sha384-aUGj/X2zp5rLCbBxumKTCw2Z50WgIr1vs/PFN4praOTvYXWlVyh2UtNUU0KAUhAX" crossorigin="anonymous">
        
        <link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        
        <?php wp_head(); ?>
    </head>
    
    <body>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js" integrity="sha512-K1qjQ+NcF2TYO/eI3M6v8EiNYZfA95pQumfvcVrTHtwQVDG+aHRqLi/ETn2uB+1JqwYqVG3LIvdm9lj6imS/pQ==" crossorigin="anonymous"></script>
    <main>
    <div id="header" class="page-header">
        <div class="banner">
            <div class="container">
                <div class="col-xs-12 col-md-8">
                    <span itemscope itemtype="http://schema.org/Organisation" itemprop=""
                    <a id="logo" rel="home" class="UNSWLogo" href="http://www.unsw.edu.au/">
                        <img src="<?php bloginfo('template_directory'); ?>/images/UNSW.png" alt="UNSW Australia Logo" />
                    </a>
                    <img class="bluesatLogo"  src="<?php bloginfo('template_directory'); ?>/images/bluesatLogo.png" alt="BLUEsat Logo"/>
                </div>
                <div class="hidden-xs hidden-sm col-md-4 ">
                    <div style="" class="sponsors">
                        <h3>BLUEsat's Platinum Sponsors:</h3>
                        <p class="sponsors">
                            <?php print_sponsors("plat_sponsors");?>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <nav class="navbar navbar-default">
            <div class="container">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse-1" aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
<!--                     <a class="navbar-brand" href="<?php bloginfo('url')?>"><img src="<?php bloginfo('template_directory'); ?>/images/home.png" alt="home"/></a> -->
                    
                </div>
                <?php
            wp_nav_menu( array(
                'menu'              => 'primary',
                'theme_location'    => 'primary',
                'depth'             => 2,
                'container'         => 'div',
                'container_class'   => 'collapse navbar-collapse',
                'container_id'      => 'navbar-collapse-1',
                'menu_class'        => 'nav navbar-nav',
                'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
                'walker'            => new wp_bootstrap_navwalker())
            );
        ?>
                
                </div><!-- /.navbar-collapse -->
            </div><!-- /.container-fluid -->
        </nav>
    </div>
