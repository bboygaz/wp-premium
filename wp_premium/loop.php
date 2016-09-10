<div id="scroll-wrapper">
    <p class="titre-section">
        Vidéos dans la catégorie : <?php single_cat_title(); ?>
    </p>
    
    <?php
    
    if (have_posts()) : while (have_posts()) : the_post(); ?>
    
    <div <?php post_class(array('home-post', 'category-post', 'sm-grid6', 'xl-grid4')); ?> id="post-<?php the_ID(); ?>">
        
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
        
        <div class="sm-grid12 post-content">
            
            <?php the_excerpt(); ?>
            
        </div>
        
    </div>
    
    <?php endwhile; endif; ?>
    
</div>