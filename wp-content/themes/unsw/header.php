<!DOCTYPE html>
<html lang="en">
    <head <?php do_action( 'add_head_attributes' ); ?>>
        <meta charset="<?php bloginfo( 'charset' ); ?>" />
        <!-- Bootstrap -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
        
        <link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
       <meta name="msvalidate.01" content="E9FEB828A91ABB23E338A456DFBFDA04" />
        
        <?php wp_head(); ?>
    </head>
    
    <body id="bluesat-org"  itemid="http://bluesat.com.au/#organization" itemscope itemtype="https://schema.org/LocalBusiness https://schema.org/Organization">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

    <main >
    <div id="header" class="page-header">
        <div class="banner" >
            <meta itemprop="name" content="<?php print(get_bloginfo( 'name' ));?>"/>
            <link itemprop="url" href="<?php print(site_url()); ?>"/>
            <link itemprop="sameAs" href="http://www.bluesat.unsw.edu.au"/>
            <div class="container">
                <div class="col-xs-12 col-md-8">
                    <span itemprop="parentOrganization" itemscope itemtype="https://schema.org/Organization">
                        <a id="logo" rel="home" itemprop="url" class="UNSWLogo" href="http://www.unsw.edu.au/">
                            <img itemprop="logo" src="<?php bloginfo('template_directory'); ?>/images/UNSW.png" alt="UNSW Sydney Logo" />
                            <meta itemprop="name" content="UNSW Sydney"/>
                        </a>
                    </span>
                    <span itemprop="logo" itemscope itemtype="https://schema.org/ImageObject">
                        <img itemprop="image" class="bluesatLogo"  src="<?php bloginfo('template_directory'); ?>/images/bluesatLogo.png" alt="BLUEsat Logo"/>
                        <link itemprop="url" href="<?php bloginfo('template_directory'); ?>/images/bluesatLogo.png"/>
                    </span>
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
                
            </div><!-- /.container-fluid -->
        </nav>
    </div>
