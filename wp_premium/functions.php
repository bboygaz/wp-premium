<?php 

// Theme support :
add_theme_support( 'post-thumbnails' );
add_theme_support( 'title-tag' );
add_theme_support( 'automatic-feed-links' );
//add_theme_support( 'post-formats', array( 'aside', 'gallery', 'image', 'quote', 'status', 'video', 'audio' ) );

//Thumnail sizing 
add_image_size('sticky', 670, 377, array('center', 'center'));

// Widgets customization
add_action( 'widgets_init', 'sgstarter_widgets_init' );
function sgstarter_widgets_init() {
    register_sidebar( array(
        'name' => __( 'Barre latérale', 'sgstarter' ),
        'id' => 'sidebar-1',
        'description' => __( 'Ces widgets apparaîtront dans la barre latérale des pages du blog', 'sgstarter' ),
        'before_widget' => '<div id="%1$s" class="widget custom-color-1 %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<p class="h3 widgettitle">',
        'after_title'   => '</p>',
    ) );
}

function register_my_menu() {
    register_nav_menu('Menu-principal',__( 'Menu-principal', 'sgstarter' ));
}
add_action( 'init', 'register_my_menu' );

// Ajoute le CSS et le JavaScript
function sgstarter_enqueue_script() {
    //css
    wp_enqueue_style('responsive-grid', get_stylesheet_directory_uri() . '/css/gggrid.css' );
    wp_enqueue_style('ionicons', get_stylesheet_directory_uri() . '/css/ionicons.css' );
    wp_enqueue_style('fonts', "https://fonts.googleapis.com/css?family=Play:700|Ubuntu:300" );
    wp_enqueue_style('theme', get_stylesheet_directory_uri() . '/css/theme.css' );
    
    // JS
    $js_directory = get_template_directory_uri() . '/js/';    
    wp_enqueue_script('jquery');
    wp_enqueue_script('velocity', get_stylesheet_directory_uri() . '/js/velocity.min.js' );
    wp_enqueue_script('front-js', get_stylesheet_directory_uri() . '/js/front.js', 'jquery' );
    
    if ( is_singular() ) {
        wp_enqueue_script( "comment-reply" );
    }
    
    wp_enqueue_script('vimeo', "https://player.vimeo.com/api/player.js" ); }
add_action( 'wp_enqueue_scripts', 'sgstarter_enqueue_script' );

//Fil d'ariane
function sg_fil_d_ariane(){
    
    $sep = ' > ';
    $intro = 'Vous êtes ici : ';
    
    if (is_front_page()) {
        
        $ariane = $intro . 'Accueil';
        
    } else {
        
        $home = '<a href="' . site_url() . '">Accueil</a>';
        
        if (is_home()) {
            
            $post_name = single_post_title('', false);
            
            $ariane = $intro . $home . $sep . $post_name;
            
        } elseif (is_post_type_archive()) {
            
            $cat = post_type_archive_title('', false);
            $ariane = $intro . $home . $sep . $cat;
    
        } elseif (is_archive()) {
            
            $cat = single_cat_title('', false);
            $ariane = $intro . $home . $sep . $cat;
            
        } elseif (is_single()) {
            
            $post_type = get_post_type($post->ID);
            $post_name = single_post_title('', false);
            
            if ($post_type == 'post') {
                
                $cat_name = get_the_category()[0]->name;
                $cat_slug = get_the_category()[0]->slug;
                $cat = '<a href="' .site_url(). '/category/' . $cat_slug . '">' . $cat_name . '</a>';
                $ariane = $intro . $home . $sep . $cat . $sep . $post_name;
                
            } else {
                
                $post_type = '<a href="' . site_url() . '/outiltheque/">Outilthèque</a>';
                $ariane = $intro . $home . $sep . $post_type . $sep . $post_name;
                
            }            
            
        } elseif (is_page()) {
            
            $parents = get_post_ancestors($post->ID, 'page');
            $post_name = single_post_title('', false);
            
            if (empty($parents)) {
                
                $ariane = $intro . $home . $sep . $post_name;
                
            } else {
                
                $parents = array_reverse($parents);
                foreach ($parents as $parent) {
                    $parent_slug = get_post($parent)->post_name;
                    $parents_name .= '<a href="' . site_url() . '/' . $parent_slug . '">' . get_the_title($parent) . '</a>' . $sep;
                }
                
                $ariane = $intro . $home . $sep . $parents_name . $post_name;
                
            }
            
        }
        
    } 
    
    echo '<p id="breadcrumb">' . $ariane . '</p>';
    
}

//Afficher le titre de la page
function abc_display_page_title() {
    
    if (is_front_page()) { ?>

<h1 id="hentry-title">Toutes les vidéos</h1>

<?php } elseif (is_home()) { ?>

<h1 id="hentry-title">Blog</h1>

<?php } elseif (is_post_type_archive()) { ?>

<h1 id="hentry-title"><?php post_type_archive_title(); ?></h1>

<?php } elseif (is_archive()) { ?>

<h1 id="hentry-title">Articles dans la catégorie <?php single_cat_title(); ?></h1>

<?php } elseif (is_single() || is_page()) { ?>

<h1 id="hentry-title"><?php echo get_the_title($post->ID); ?></h1>

<?php }
}

//Isole et copie l'ID d'une vidéo Vimeo dans l'iframe
function paste_video_id($url) {
    
    $vimeo_id = explode('/', $url)[3];    
    echo $vimeo_id;
    
}

//converti le format mm:ss en secondes
function mmss_to_sec($time) {
    
    sscanf($time, "%d:%d:%d", $hours, $minutes, $seconds);
    $time_seconds = isset($seconds) ? $hours * 3600 + $minutes * 60 + $seconds : $hours * 60 + $minutes;
    echo $time_seconds;
    
}

// Appelle le template adapté à une navigation ajax
add_filter( 'template_include', 'baw_template_include' );
function baw_template_include( $template ) {
	if( isset( $_SERVER['HTTP_X_REQUESTED_WITH'] ) && $_SERVER['HTTP_X_REQUESTED_WITH']== 'BAWXMLHttpRequest' ):
		$pre = dirname( $template );
		$suf = basename( $template );
		$_template = $pre . '/ajax-' . $suf;
		if( !file_exists( $_template ) )
			$_template = $template;
		$template = $_template;
	endif;
	return $template;
}