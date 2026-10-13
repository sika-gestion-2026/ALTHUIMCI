<?php
/**
 * Thème Enfant Hello Elementor — ALTHIUM SARL V3 Pro
 * Édition Complète Autonome (Templates Négatifs & Elementor Ready)
 * 
 * Coordonnées Officielles (Abidjan, Côte d'Ivoire) :
 * - Téléphones : +225 05 56 56 25 24 / +225 07 58 78 32 21
 * - Emails : contact@althium.ci / info@althium.ci
 * - Siège social : Abidjan, République de Côte d'Ivoire
 */

if (!defined('ABSPATH')) {
    exit;
}

define('ALTHIUM_VERSION', '3.0.0');
define('ALTHIUM_PHONE_PRIMARY', '+225 05 56 56 25 24');
define('ALTHIUM_PHONE_SECONDARY', '+225 07 58 78 32 21');
define('ALTHIUM_WHATSAPP_RAW', '2250556562524');
define('ALTHIUM_EMAIL_CONTACT', 'contact@althium.ci');
define('ALTHIUM_EMAIL_INFO', 'info@althium.ci');

// Inclusion du panneau de réglages ALTHIUM & Provisioning automatique
require_once get_stylesheet_directory() . '/inc/theme-options.php';
require_once get_stylesheet_directory() . '/inc/setup-content.php';

// 1. Enqueue des styles, polices et scripts
add_action('wp_enqueue_scripts', function () {
    wp_enqueue_style(
        'althium-google-fonts',
        'https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Sora:wght@600;700;800;900&display=swap',
        [],
        null
    );

    wp_enqueue_style(
        'hello-elementor-parent-style',
        get_template_directory_uri() . '/style.css',
        [],
        ALTHIUM_VERSION
    );

    wp_enqueue_style(
        'althium-child-style',
        get_stylesheet_directory_uri() . '/style.css',
        ['hello-elementor-parent-style'],
        ALTHIUM_VERSION
    );

    wp_enqueue_script(
        'althium-app-js',
        get_stylesheet_directory_uri() . '/assets/js/app.js',
        [],
        ALTHIUM_VERSION,
        true
    );
}, 20);

// 2. Configuration automatique du thème & Menus
add_action('after_setup_theme', function () {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    register_nav_menus([
        'primary' => __('Menu Principal Althium', 'althium'),
        'footer'  => __('Menu Pied de Page', 'althium'),
    ]);
});

// Assurer la classe nav-link sur les liens du menu principal WordPress
add_filter('nav_menu_link_attributes', function ($atts, $item, $args) {
    if (isset($args->theme_location) && $args->theme_location === 'primary') {
        $atts['class'] = isset($atts['class']) ? $atts['class'] . ' nav-link' : 'nav-link';
    }
    return $atts;
}, 10, 3);

// 3. Enregistrement des Custom Post Types (Pôles Métiers, Réalisations, Biens, Formations)
add_action('init', function () {
    if (!post_type_exists('metiers')) {
        register_post_type('metiers', [
            'labels' => [
                'name'          => __('Pôles d\'Activité', 'althium'),
                'singular_name' => __('Pôle Métier', 'althium'),
                'menu_name'     => __('Pôles Métiers (6)', 'althium'),
                'add_new'       => __('Ajouter un Pôle', 'althium'),
                'all_items'     => __('Tous les 6 Pôles', 'althium'),
            ],
            'public'        => true,
            'has_archive'   => true,
            'rewrite'       => ['slug' => 'metiers'],
            'menu_icon'     => 'dashicons-networking',
            'menu_position' => 5,
            'supports'      => ['title', 'editor', 'thumbnail', 'excerpt', 'custom-fields', 'revisions'],
            'show_in_rest'  => true,
        ]);
    }

    if (!post_type_exists('realisations')) {
        register_post_type('realisations', [
            'labels' => [
                'name'          => __('Réalisations & Projets', 'althium'),
                'singular_name' => __('Réalisation', 'althium'),
                'menu_name'     => __('Réalisations', 'althium'),
                'add_new'       => __('Ajouter une Réalisation', 'althium'),
                'all_items'     => __('Toutes les Réalisations', 'althium'),
            ],
            'public'        => true,
            'has_archive'   => true,
            'rewrite'       => ['slug' => 'realisations'],
            'menu_icon'     => 'dashicons-portfolio',
            'menu_position' => 6,
            'supports'      => ['title', 'editor', 'thumbnail', 'excerpt', 'custom-fields', 'revisions'],
            'show_in_rest'  => true,
        ]);
    }

    if (!post_type_exists('biens_immobiliers')) {
        register_post_type('biens_immobiliers', [
            'labels' => [
                'name'          => __('Biens Immobiliers', 'althium'),
                'singular_name' => __('Bien Immobilier', 'althium'),
                'menu_name'     => __('Immobilier (Biens)', 'althium'),
                'add_new'       => __('Ajouter un Bien', 'althium'),
                'all_items'     => __('Tous les Biens', 'althium'),
            ],
            'public'        => true,
            'has_archive'   => true,
            'rewrite'       => ['slug' => 'immobilier'],
            'menu_icon'     => 'dashicons-building',
            'menu_position' => 7,
            'supports'      => ['title', 'editor', 'thumbnail', 'excerpt', 'custom-fields'],
            'show_in_rest'  => true,
        ]);
    }

    if (!post_type_exists('formations')) {
        register_post_type('formations', [
            'labels' => [
                'name'          => __('Formations & Séminaires', 'althium'),
                'singular_name' => __('Formation', 'althium'),
                'menu_name'     => __('Formations', 'althium'),
                'add_new'       => __('Ajouter une Formation', 'althium'),
                'all_items'     => __('Toutes les Formations', 'althium'),
            ],
            'public'        => true,
            'has_archive'   => true,
            'rewrite'       => ['slug' => 'formations'],
            'menu_icon'     => 'dashicons-welcome-learn-more',
            'menu_position' => 8,
            'supports'      => ['title', 'editor', 'thumbnail', 'excerpt', 'custom-fields'],
            'show_in_rest'  => true,
        ]);
    }

    if (!taxonomy_exists('secteur_metier')) {
        register_taxonomy('secteur_metier', ['realisations', 'biens_immobiliers', 'formations'], [
            'labels'        => [
                'name'          => __('Secteurs Métiers', 'althium'),
                'singular_name' => __('Secteur Métier', 'althium'),
                'all_items'     => __('Tous les Secteurs', 'althium'),
            ],
            'hierarchical'  => true,
            'show_ui'       => true,
            'show_in_rest'  => true,
            'rewrite'       => ['slug' => 'secteur-metier'],
        ]);
    }
});

// 4. Shortcodes ALTHIUM
add_shortcode('althium_contacts', function () {
    return '<div class="top-bar-links">'
         . '<a href="tel:+2250556562524">📞 +225 05 56 56 25 24</a>'
         . '<a href="tel:+2250758783221">📞 +225 07 58 78 32 21</a>'
         . '<a href="mailto:contact@althium.ci">✉️ contact@althium.ci</a>'
         . '</div>';
});

add_shortcode('althium_count_projects', function () {
    $count = wp_count_posts('realisations');
    return $count && isset($count->publish) && $count->publish > 0 ? (int) $count->publish : '120+';
});

// 5. Traitement du formulaire Devis Express
add_action('admin_post_nopriv_althium_submit_quote', 'althium_theme_handle_quote_submission');
add_action('admin_post_althium_submit_quote', 'althium_theme_handle_quote_submission');

function althium_theme_handle_quote_submission() {
    $name    = isset($_POST['quote_name']) ? sanitize_text_field($_POST['quote_name']) : '';
    $phone   = isset($_POST['quote_phone']) ? sanitize_text_field($_POST['quote_phone']) : '';
    $email   = isset($_POST['quote_email']) ? sanitize_email($_POST['quote_email']) : '';
    $sector  = isset($_POST['quote_sector']) ? sanitize_text_field($_POST['quote_sector']) : '';
    $msg     = isset($_POST['quote_message']) ? sanitize_textarea_field($_POST['quote_message']) : '';

    $to      = [ALTHIUM_EMAIL_CONTACT, ALTHIUM_EMAIL_INFO];
    $subject = '[NOUVEAU DEVIS ALTHIUM CI] - ' . $sector . ' - ' . $name;
    
    $body    = "Nouvelle demande de devis reçue depuis le site officiel ALTHIUM SARL :\n\n"
             . "Nom / Entreprise : " . $name . "\n"
             . "Téléphone        : " . $phone . "\n"
             . "Email            : " . $email . "\n"
             . "Pôle Concerné    : " . $sector . "\n\n"
             . "Détails du projet :\n" . $msg . "\n\n"
             . "--------------------------------------------------------\n"
             . "ALTHIUM SARL (Abidjan, République de Côte d'Ivoire)\n"
             . "« La force d'un professionnel »\n"
             . "Téléphones : " . ALTHIUM_PHONE_PRIMARY . " / " . ALTHIUM_PHONE_SECONDARY;
    
    $headers = ['Reply-To: ' . $name . ' <' . $email . '>'];
    wp_mail($to, $subject, $body, $headers);

    wp_safe_redirect(add_query_arg('devis_envoye', '1', wp_get_referer() ?: home_url('/contact/')));
    exit;
}

// 6. Synchronisation automatique ACF JSON
add_filter('acf/settings/save_json', function ($path) {
    return get_stylesheet_directory() . '/acf-json';
});

add_filter('acf/settings/load_json', function ($paths) {
    unset($paths[0]);
    $paths[] = get_stylesheet_directory() . '/acf-json';
    return $paths;
});

// 7. Support sécurisé des logos SVG
add_filter('upload_mimes', function ($mimes) {
    $mimes['svg']  = 'image/svg+xml';
    $mimes['svgz'] = 'image/svg+xml';
    return $mimes;
});
