<?php
/**
 * Plugin Name: ALTHIUM Core Engine (Must-Use Plugin)
 * Description: Moteur principal pour ALTHIUM SARL (CPTs, taxonomies, ACF JSON, WhatsApp, Devis Express, auto-activation theme enfant).
 * Version: 3.0.0
 * Author: ALTHIUM Digital Côte d'Ivoire
 */

if (!defined('ABSPATH')) exit;

// 1. Auto-activation sécurisée du thème enfant (seulement si présent)
add_action('after_setup_theme', function () {
    if (wp_get_theme('hello-elementor-child')->exists() && get_stylesheet() !== 'hello-elementor-child') {
        switch_theme('hello-elementor-child');
    }
});

// 2. Enregistrement des CPTs et Taxonomies
add_action('init', function () {
    // CPT Métiers (6 Pôles)
    register_post_type('metiers', [
        'labels' => [
            'name'          => __('Pôles d\'Activité', 'althium'),
            'singular_name' => __('Pôle Métier', 'althium'),
            'menu_name'     => __('Pôles Althium (6)', 'althium'),
            'all_items'     => __('Tous les 6 Pôles', 'althium'),
        ],
        'public'        => true,
        'has_archive'   => true,
        'rewrite'       => ['slug' => 'metiers'],
        'menu_icon'     => 'dashicons-networking',
        'menu_position' => 5,
        'supports'      => ['title', 'editor', 'thumbnail', 'excerpt', 'custom-fields'],
        'show_in_rest'  => true,
    ]);

    // CPT Réalisations
    register_post_type('realisations', [
        'labels' => [
            'name'          => __('Réalisations & Cas d\'étude', 'althium'),
            'singular_name' => __('Réalisation', 'althium'),
            'menu_name'     => __('Réalisations', 'althium'),
        ],
        'public'        => true,
        'has_archive'   => true,
        'rewrite'       => ['slug' => 'realisations'],
        'menu_icon'     => 'dashicons-portfolio',
        'menu_position' => 6,
        'supports'      => ['title', 'editor', 'thumbnail', 'excerpt', 'custom-fields'],
        'show_in_rest'  => true,
    ]);

    // CPT Biens Immobiliers
    register_post_type('biens_immobiliers', [
        'labels' => [
            'name'          => __('Biens Immobiliers', 'althium'),
            'singular_name' => __('Bien Immobilier', 'althium'),
            'menu_name'     => __('Immobilier (Biens)', 'althium'),
        ],
        'public'        => true,
        'has_archive'   => true,
        'rewrite'       => ['slug' => 'immobilier'],
        'menu_icon'     => 'dashicons-building',
        'menu_position' => 7,
        'supports'      => ['title', 'editor', 'thumbnail', 'excerpt', 'custom-fields'],
        'show_in_rest'  => true,
    ]);

    // Taxonomie Secteurs Métiers
    register_taxonomy('secteur_metier', ['realisations', 'biens_immobiliers'], [
        'labels'        => ['name' => __('Secteurs Métiers', 'althium'), 'singular_name' => __('Secteur Métier', 'althium')],
        'hierarchical'  => true,
        'show_ui'       => true,
        'show_in_rest'  => true,
        'rewrite'       => ['slug' => 'secteur-metier'],
    ]);
});

// 3. Traitement du Formulaire de Devis Express vers contact@althium.ci & info@althium.ci
add_action('admin_post_nopriv_althium_submit_quote', 'althium_handle_quote_submission');
add_action('admin_post_althium_submit_quote', 'althium_handle_quote_submission');

function althium_handle_quote_submission() {
    $name    = isset($_POST['quote_name']) ? sanitize_text_field($_POST['quote_name']) : '';
    $phone   = isset($_POST['quote_phone']) ? sanitize_text_field($_POST['quote_phone']) : '';
    $email   = isset($_POST['quote_email']) ? sanitize_email($_POST['quote_email']) : '';
    $sector  = isset($_POST['quote_sector']) ? sanitize_text_field($_POST['quote_sector']) : '';
    $msg     = isset($_POST['quote_message']) ? sanitize_textarea_field($_POST['quote_message']) : '';

    $to      = ['contact@althium.ci', 'info@althium.ci'];
    $subject = '[Nouveau Devis Web ALTHIUM CI] - ' . $sector . ' - ' . $name;
    $body    = "Nouvelle demande reçue depuis le site officiel :\n\n"
             . "Nom / Société : $name\n"
             . "Téléphone : $phone\n"
             . "Email : $email\n"
             . "Secteur d'activité : $sector\n"
             . "Détails du projet :\n$msg\n\n"
             . "---\nALTHIUM SARL (Abidjan, Côte d'Ivoire)\n« La force d'un professionnel »";
    
    $headers = ['Reply-To: ' . $name . ' <' . $email . '>'];
    wp_mail($to, $subject, $body, $headers);

    wp_safe_redirect(add_query_arg('quote_sent', 'success', wp_get_referer()));
    exit;
}
