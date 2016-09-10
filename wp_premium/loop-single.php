<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

<div <?php post_class(array('one-post', 'sm-grid9')); ?> id="post-<?php the_ID(); ?>">
    
    <div id="data" data-test="banane"></div>
    
    <div class="row">
        
        <div class="sm-grid8" id="post-video">
            
            <div class="post-thumbnail" id="slider">
                
                <div id="slider-wrapper">
                    
                    <div id="vimeo-overlay">
                        
                        <?php the_post_thumbnail('full', array('class' => 'ratio-responsive')); ?>
                        
                        <div class="thumbnail-overlay" id="video-trigger">
                            
                            <div class="post-header">
                                
                                <h1 class="post-title">
                                    <?php the_title(); ?>
                                </h1>
                                
                                <div class="post-meta">
                                    <p><span class="ion-calendar"></span> <?php the_time('d M Y'); ?></p>
                                </div>
                                
                            </div>
                            
                            <div class="play-icon">
                                <span class="play-icon icon ion-ios-play"></span>
                                <p id="play-video">Lire la vidéo</p>
                            </div>
                            
                            
                        </div> 
                    </div>
                    
                    <div id="vimeo">
                        <iframe src="https://player.vimeo.com/video/<?php paste_video_id(get_field('lien_video')); ?>?title=0&byline=0&portrait=0" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
                        
                    </div>
                    
                </div>
                
            </div>
            
            <?php
            
            if (null != get_field('prix') && get_field('prix') != 0) { ?>
            
            <button type="button" class="btn btn-block btn-download">
                <span class="icon ion-bag"></span> Acheter cette vidéo
            </button>
            
            <?php } else { ?>
            
            <a href="<?php the_field('lien_dl'); ?>" class="btn btn-block btn-download" title="Télécharger le plugin" target="_blank">
                <span class="icon ion-android-download"></span> Télécharger le plugin
            </a>
            
            <?php } ?>
            
        </div>
        
        <div class="sm-grid4" id="video-meta">
            
            <?php if (have_rows('chapitres')) : ?>
            
            <p class="titre-section">
                Chapitres :
            </p>
            
            <div id="chapitres-container">
                 <?php while (have_rows('chapitres')) : the_row(); ?>
                
                <div class="row" id="chapitres">
                    <div class="xl-grid2 time-chapitre">
                        <p>
                            <?php the_sub_field('debut_chapitre'); ?>
                        </p>
                    </div>
                    <div class="xl-grid9 name-chapitre">
                        <p class="chapitre" data-cue="<?php mmss_to_sec(get_sub_field('debut_chapitre')); ?>">
                            <?php the_sub_field('titre_chapitre'); ?>
                        </p>
                    </div>
                    <div class="xl-grid1 vu-fb">
                        <?php
                        if (get_sub_field('vu_sur_facebook')) { ?>
                        <p><span class="icon ion-social-facebook"></span></p>
                        <?php } ?>
                    </div>
                </div>
                
                <?php endwhile; ?>
            </div>
            <p class="help-text"><span class="icon ion-social-facebook"></span> : ces chapitres ont été diffusés sur Facebook, si vous les avez déjà vus, vous pouvez passer aux chapitres suivants.</p>
            
            <?php endif; ?>
            
        </div>
    
    </div>
    
    <div class="sm-grid12 post-content">
        
        <?php the_content(); ?>
        
    </div>

</div>

<?php endwhile; endif; ?>

<script>
    var vimeoPlayer = new Vimeo.Player('vimeo');            
    vimeoPlayer.setColor('#e5bc13');
</script>