<!DOCTYPE html>
<html <?php language_attributes(); ?>>
    <head>  
        <meta charset="<?php bloginfo('charset'); ?>">  
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
        <title><?php wp_title(); ?></title>   
        <link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css"> 
        <?php wp_head(); ?> 
    </head>
    
    <body <?php body_class(); ?>>
        
        <header id="site-header">
            
            <div class="sm-grid3 xl-grid2" id="logo-box">
                <a href="<?php echo site_url() . '/'; ?>" title="Retour à l'accueil">
                    <img class="img-responsive" src="<?php echo get_template_directory_uri(); ?>/img/logo-wordpress-premium.png" alt="Logo du blog wordpress premium">
                </a>
            </div>
            
            <div class="sm-grid9 xl-grid10" id="description-box">
                <?php if(is_home()) { ?>
                <h1 id="site-description"><?php bloginfo('description'); ?></h1>
                <?php } else { ?>
                <p id="site-description"><?php bloginfo('description'); ?></p>
                <?php } ?>
            </div>
            
        </header>
        
        <div class="row" id="progress-container">
            <div id="progress-bar"></div>
        </div>
        
        <div id="burger">
            <span class="icon ion-navicon-round"></span>
        </div>