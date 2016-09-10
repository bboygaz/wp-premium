<?php get_header(); ?>

<div id="main-wrapper">
    
    <aside class="xs-grid6 sm-grid3 xl-grid2" id="sidebar">
        <nav id="header-nav">
            <?php wp_nav_menu(array('theme_location' => 'Menu-principal')); ?>        
        </nav>
    </aside>
    
    <div class="xs-grid12 sm-grid9 xl-grid10" id="app-body">
        
        <div id="loader">
            <div id="loader-items">
                <div class="loader-item" id="loader-item1"></div>
                <div class="loader-item" id="loader-item2"></div>
                <div class="loader-item" id="loader-item3"></div>
            </div>
        </div>
        
        <div class="xs-grid12" id="ajax-wrapper">
            <?php get_template_part('loop', 'page'); ?>
        </div>
    </div>
    
</div>


<?php get_footer(); ?>