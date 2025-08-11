<?php
function handleThemeSupports()
{
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('menus');
    add_theme_support('custom-logo', array(
        'height'      => 100,
        'width'       => 300,
        'flex-height' => true,
        'flex-width'  => true,
    ));
    register_nav_menu('header', 'En tête du menu');
    register_nav_menu('footer', 'Pied de page');

    add_image_size('card-header', 286, 300, true);
    // remove_image_size('medium');
    // add_image_size('medium', 286, 300);
}

function registerThemeAssets()
{
    wp_register_style('bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css');
    // wp_register_script('bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css', ['popper', 'jquery'], false, true);
    wp_register_script('bootstrap_js', 'https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js');
    wp_register_script('popper', 'https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js', [], false, true);
    wp_deregister_script('jquery');
    wp_register_script('jquery', 'https://code.jquery.com/jquery-3.2.1.slim.min.js', [], false, true);
}

function useThemeAssets()
{
    wp_enqueue_style('bootstrap');
    //wp_enqueue_script('bootstrap');
    wp_enqueue_script('bootstrap_js');
}

function handleThemeAssets()
{
    registerThemeAssets();
    useThemeAssets();
}

function getThemeTitle($title)
{
    return '|';
}

function themeMenuClass(array $classes)
{
    $classes[] = 'nav-item';
    return $classes;
}

function themeMenuLinkClass($attrs)
{
    $attrs['class'] = 'nav-link';
    return $attrs;
}

function themePagination()
{
    echo '<nav aria-label="Pagination">';
    echo '<ul class="pagination">';
    $pages = paginate_links(['type' => 'array']);
    if ($pages) {
        foreach ($pages as $page) {
            $active = strpos($page, 'current') !== false;
            $class = 'page-item';
            if ($active) {
                $class .= ' active';
            }
            echo '<li class="' . $class . '">';
            echo str_replace('page-numbers', 'page-link', $page);
            echo '</li>';
        }
    }
    echo '</ul>';
    echo '</nav>';
}

function themeInit()
{
    register_post_type('film', [
        'label' => 'Films',
        'public' => true,
        'publicly_queryable' => true,
        'menu_position' => 4,
        'supports' => ['title', 'editor', 'thumbnail'],
        'has_archive' => true,
    ]);
    register_taxonomy('categories', 'film', [
        'label' => 'Catégories',
        'rewrite' => ['slug' => 'categories'],
        'hierarchical' => true,
    ]);
}

function loadStyle() {
    wp_enqueue_style('style', get_stylesheet_uri());
}

function loadScript() {
    wp_enqueue_script('app.js', get_template_directory_uri() . '/app.js');
}

function removePagedVarFromUrl($url) {
    if (strpos($url, 'paged=') && is_search()) {
        $url = remove_query_arg('paged', $url);
    }
    return $url;
}

function add_filmography_button() {
    if (is_search() || is_singular('film')) {
        echo '<a href="' . home_url() . '/film/" class="btn btn-primary">Retour vers la Filmographie</a>';
    }
}

function getMovieGenres() {
    $args = array(
        'taxonomy' => 'categories',
        'hide_empty' => true,
    );

    $genres = get_terms( $args );

    return $genres;
}

function generate_filename_variants($title) {
    // Supprimer les accents
    $title = remove_accents($title);

    // Supprimer les caractères problématiques : ’ ' ` " : . , ! ? etc.
    $title = preg_replace('/[\'"`:.,!?–—]/u', '', $title);

    // Remplacer les espaces multiples par un seul espace
    $title = preg_replace('/\s+/', ' ', $title);

    // Supprimer tout sauf lettres, chiffres et espaces
    $title = preg_replace('/[^A-Za-z0-9 ]/', '', $title);

    // Mise en minuscule
    $title = strtolower(trim($title));

    // Générer trois variantes du nom de fichier
    return [
        str_replace(' ', '_', $title) . '.jpg',
        str_replace(' ', '-', $title) . '.jpg',
        str_replace(' ', '', $title) . '.jpg',
    ];
}

function try_attach_thumbnail($post_id) {
    if (has_post_thumbnail($post_id)) {
        echo "✅ Déjà présente : " . get_the_title($post_id) . "<br>";
        return;
    }

    $title = get_the_title($post_id);
    $variants = generate_filename_variants($title);

    $upload_dir = wp_upload_dir();
    $upload_path = $upload_dir['basedir'];     // ex: /home/.../uploads
    $upload_url  = $upload_dir['baseurl'];     // ex: https://.../uploads

    foreach ($variants as $filename) {
        $filepath = $upload_path . '/' . $filename;
        $fileurl  = $upload_url  . '/' . $filename;

        if (file_exists($filepath)) {
            $attachment = array(
                'post_mime_type' => 'image/jpeg',
                'post_title'     => sanitize_file_name($filename),
                'post_content'   => '',
                'post_status'    => 'inherit'
            );

            $attach_id = wp_insert_attachment($attachment, $filepath, $post_id);
            require_once(ABSPATH . 'wp-admin/includes/image.php');
            $attach_data = wp_generate_attachment_metadata($attach_id, $filepath);
            wp_update_attachment_metadata($attach_id, $attach_data);
            set_post_thumbnail($post_id, $attach_id);

            echo "🎬 Miniature attachée à « $title » via $filename<br>";
            return;
        }
    }

    echo "❌ Échec pour : « $title »<br>";
}

function try_attach_all_thumbnails() {
    $args = array(
        'post_type' => 'film',
        'posts_per_page' => -1
    );

    $films = get_posts($args);

    foreach ($films as $film) {
        try_attach_thumbnail($film->ID);
    }

    echo "✅ Traitement terminé";
}

// Permet de déclencher manuellement la fonction depuis l'URL
add_action('admin_init', function () {
    if (isset($_GET['auto_set_thumbnails']) && current_user_can('manage_options')) {
        try_attach_all_thumbnails();
        exit;
    }
});

add_action('init', 'themeInit');
add_action('after_setup_theme', 'handleThemeSupports');
add_action('wp_enqueue_scripts', 'handleThemeAssets');
add_action('wp_enqueue_scripts', 'loadStyle', 10);
add_action('wp_enqueue_scripts', 'loadScript', 0 );

add_filter('document_title_separator', 'getThemeTitle');
add_filter('nav_menu_css_class', 'themeMenuClass');
add_filter('nav_menu_link_attributes', 'themeMenuLinkClass');
add_filter('show_admin_bar', '__return_false');
add_filter('paginate_links', 'removePagedVarFromUrl', 10, 2);