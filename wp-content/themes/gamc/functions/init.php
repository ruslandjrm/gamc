<?php 

add_action('wp_dashboard_setup', function() {
    global $wp_meta_boxes;
    $wp_meta_boxes['dashboard'] = []; // Limpia todo

    // Agregar un widget propio
    wp_add_dashboard_widget('custom_welcome', 'Bienvenido', function() {
        echo '<p>👋 Bienvenido a tu panel. Usa el menú lateral para navegar.</p>';
    });
});

add_action('admin_menu', function() {
    //remove_menu_page('index.php');
    remove_menu_page('edit.php'); 
    //remove_menu_page('edit.php?post_type=page');    // Páginas
    //remove_menu_page('edit-comments.php');          // Comentarios
});


// Quitar versión en el <head> y en feeds
remove_action('wp_head', 'wp_generator');

// Quitar versión en scripts y estilos
add_filter('style_loader_src', function($src) {
    return remove_query_arg('ver', $src);
}, 999);
add_filter('script_loader_src', function($src) {
    return remove_query_arg('ver', $src);
}, 999);

// Quitar versión en el footer del admin
add_filter('update_footer', '__return_empty_string', 11);


add_action('admin_menu', function() {
    remove_submenu_page('index.php', 'about.php');        // Acerca de WordPress
    remove_submenu_page('index.php', 'credits.php');      // Créditos
    remove_submenu_page('index.php', 'freedoms.php');     // Libertades
    remove_submenu_page('options-general.php', 'privacy.php'); // Privacidad
});

add_action('admin_head', function() {
    $screen = get_current_screen();
    $screen->remove_help_tabs();
});

add_action('admin_bar_menu', function($wp_admin_bar) {
    $wp_admin_bar->remove_node('wp-logo'); // Logo WP
    $wp_admin_bar->remove_node('about');   // Acerca de WordPress
    $wp_admin_bar->remove_node('wporg');   // WordPress.org
    $wp_admin_bar->remove_node('documentation'); // Documentación
    $wp_admin_bar->remove_node('support-forums'); // Foros
    $wp_admin_bar->remove_node('feedback'); // Feedback
}, 999);

add_filter('admin_footer_text', function() {
    echo '© ' . date('Y') . ' - GAMC System by devs';
});




/**
 * Quitar todas las notificaciones de actualización
 */

/* 🔹 1. Desactivar actualizaciones del núcleo */
//add_filter('pre_site_transient_update_core', '__return_null');

/* 🔹 2. Desactivar actualizaciones de plugins */
//add_filter('pre_site_transient_update_plugins', '__return_null');

/* 🔹 3. Desactivar actualizaciones de temas */
//add_filter('pre_site_transient_update_themes', '__return_null');

/* 🔹 4. Ocultar avisos de actualización en el admin */
//add_action('admin_menu', function() {
//    remove_action('admin_notices', 'update_nag', 3);
//});

/* 🔹 5. Opcional: quitar contador rojo de actualizaciones en el menú */
/*add_action('admin_menu', function() {
    global $menu;
    foreach ($menu as $key => $item) {
        if ($item[2] === 'update-core.php') {
            unset($menu[$key]);
        }
    }
});*/


// Cargar AdminLTE en wp-admin
/*add_action('admin_enqueue_scripts', function() {
    wp_enqueue_style('adminlte-css', 'https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css');
    wp_enqueue_script('adminlte-js', 'https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js', ['jquery'], null, true);

    // Tu CSS custom para adaptar WordPress al estilo AdminLTE
    wp_enqueue_style('custom-adminlte', get_stylesheet_directory_uri() . '/adminlte-custom.css');
});*/

