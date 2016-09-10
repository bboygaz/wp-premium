<?php 

$category = get_the_category()[0]->name;
$cat_slug = get_the_category()[0]->slug;

$args = array(
    'category_name' => $category,
    'post__not_in' => array($post->ID)
);
$loop = new WP_Query($args);

?>

<aside class="sm-grid3" id="same-category">
    <p class="titre-section" id="titre-section" data-cat="<?php echo $cat_slug; ?>">
        Autres vidéos concernant <?php echo $category; ?>
    </p>
    
    <?php
    
    if ($loop->have_posts()) : while ($loop->have_posts()) : $loop->the_post(); ?>
    
    <div <?php post_class(array('home-post', 'category-post', 'xl-grid12')); ?> id="post-<?php the_ID(); ?>">
        
        <div class="post-thumbnail">
            
            <?php the_post_thumbnail('full', array('class' => 'img-responsive')); ?>
            
            <div class="thumbnail-overlay">
                
                <div class="post-header">
                    
                    <h2 class="post-title">
                        <a href="<?php the_permalink(); ?>" title="Voir la vidéo">
                            <?php the_title(); ?>
                        </a>
                    </h2>
                    
                    <div class="post-meta">
                        <p><span class="ion-calendar"></span> <?php the_time('d M Y'); ?></p>
                    </div>
                    
                </div>
                
                <a class="play-icon" href="<?php the_permalink(); ?>" title="Voir cette vidéo">
                    <span class="icon ion-play"></span>
                </a>
                
            </div>
            
        </div>
        
    </div>
    
    <?php endwhile; endif; wp_reset_postdata(); ?>
    
</aside>