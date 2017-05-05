

   
        
<div itemprop="image" itemscope itemtype="https://schema.org/ImageObject">
<?php 
    $image_data = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' );
?>
    <meta itemprop="url" content="<?php print($image_data[0]); ?>"/>
    <meta itemprop="width" content="<?php print($image_data[1]); ?>"/>
    <meta itemprop="height" content="<?php print($image_data[1]); ?>"/>
</div>
<article id="post-<?php the_ID(); ?>" itemscope itemtype="http://schema.org/BlogPosting" itemid="<?php printf(get_permalink()); ?>" <?php post_class(); ?>>
        <?php 
        the_title( sprintf( '<h2 class="entry-title" itemprop="headline"><a href="%s" rel="bookmark" itemprop="url">', esc_url( get_permalink() ) ), '</a></h2>' ); 
        ?>
        <div itemprop="publisher" itemref="bluesat-org" itemscope  itemid="http://bluesat.com.au/#organization"  itemtype="https://schema.org/Organization"></div>
        <div itemprop="image" itemscope itemtype="https://schema.org/ImageObject">
        <?php 
            $image_data = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' );
        ?>
            <meta itemprop="url" content="<?php print($image_data[0]); ?>"/>
            <meta itemprop="width" content="<?php print($image_data[1]); ?>"/>
            <meta itemprop="height" content="<?php print($image_data[1]); ?>"/>
        </div>
        <h5>
            Posted on <span class="updated published" itemprop="datePublished" content="<?php the_time('Y-m-d'); ?>"><?php the_time('F jS, Y') ?></span> by <span class="vcard"> 
            <span  itemprop="author" itemscope itemtype="http://schema.org/Person" itemid="<?php echo get_author_posts_url( get_the_author_ID() ); ?>">
                <span class="fn" itemprop="name"><?php the_author() ?></span>
                <link itemprop="url" href="<?php echo get_author_posts_url( get_the_author_ID() ); ?>"/>
                <?php if(get_the_author_url()) { ?>
                
                <link itemprop="sameAs" href="<?php  the_author_url(); ?>"/>
                <?php } ?>
            </span>
        </h5>
        <div itemprop="articleBody"><?php the_content(__('(more...)')); ?></div>
</article>
<?php if(is_archive()) { echo '<hr/>'; } ?>
