<div id="scroll-wrapper">
    <p class="titre-section">
        Vidéos à la une :
    </p>
    
    <?php
    
    $args = array(
        'post__in' => get_option('sticky_posts')
    );
    $loop = new WP_Query($args); ?>
    
    <div class="row">
        
        <?php if ($loop->have_posts()) : while ($loop->have_posts()) : $loop->the_post(); ?> 
        
        <div <?php post_class(array('sticky-post', 'sm-grid6')); ?> id="post-<?php the_ID(); ?>">
            
            <div class="post-thumbnail">
                
                <?php the_post_thumbnail('sticky', array('class' => 'img-responsive')); ?>
                
                <div class="thumbnail-overlay">
                    
                    <div class="post-header">
                        
                        <h2 class="post-title">
                            <a href="<?php the_permalink(); ?>" title="Voir cette vidéo">
                                <?php the_title(); ?>
                            </a>
                        </h2>
                        
                        <div class="post-meta">
                            <p><span class="ion-calendar"></span> <?php the_time('d M Y'); ?></p>
                        </div>
                        
                    </div>
                    
                    <a class="play-icon" href="<?php the_permalink(); ?>" title="Voir cette vidéo">
                        <span class="icon ion-ios-play"></span>
                    </a>
                    
                </div>
                
            </div>
            
            <div class="sm-grid12 post-content">
                
                <?php the_excerpt(); ?>
                
            </div>
            
        </div>
        
        <?php endwhile; endif; wp_reset_postdata(); ?>
        
    </div>
    
    <p class="titre-section">
        Vidéos récentes :
    </p>
    
    <?php
    
    $args = array(
        'post__not_in' => get_option('sticky_posts')
    );
    $loop = new WP_Query($args); ?>
    
    <div class="row">
        
        <?php if ($loop->have_posts()) : while ($loop->have_posts()) : $loop->the_post(); ?>
        
        <div <?php post_class(array('home-post', 'sm-grid6', 'xl-grid3')); ?> id="post-<?php the_ID(); ?>">
            
            <div class="post-thumbnail">
                
                <?php the_post_thumbnail('full', array('class' => 'img-responsive')); ?>
                
                <div class="thumbnail-overlay">
                    
                    <div class="post-header">
                        
                        <h2 class="post-title">
                            <a href="<?php the_permalink(); ?>" title="Voir cette vidéo">
                                <?php the_title(); ?>
                            </a>
                        </h2>
                        
                        <div class="post-meta">
                            <p><span class="ion-calendar"></span> <?php the_time('d M Y'); ?></p>
                        </div>
                        
                    </div>
                    
                    <a class="play-icon" href="<?php the_permalink(); ?>" title="Voir cette vidéo">
                        <span class="icon ion-ios-play"></span>
                    </a>
                    
                </div>
                
            </div>
            
            <div class="sm-grid12 post-content">
                
                <?php the_excerpt(); ?>
                
            </div>
            
        </div>
        
        <?php endwhile; endif; wp_reset_postdata(); ?>
        
    </div>
    
</div>