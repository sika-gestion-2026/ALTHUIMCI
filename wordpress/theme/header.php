<?php
/**
 * Header Template — ALTHIUM SARL
 */
if (!defined('ABSPATH')) exit;
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/svg+xml" href="<?php echo get_stylesheet_directory_uri() . '/assets/logo/favicon.svg'; ?>">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<!-- TOP BAR OFFICIELLE CÔTE D'IVOIRE -->
<div class="top-bar">
    <div class="container top-bar-inner">
        <div class="top-bar-links">
            <?php 
            $phone1 = althium_get_option('phone_1', '+225 05 56 56 25 24');
            $phone2 = althium_get_option('phone_2', '+225 07 58 78 32 21');
            $email1 = althium_get_option('email_contact', 'contact@althium.ci');
            $email2 = althium_get_option('email_info', 'info@althium.ci');
            $loc    = althium_get_option('topbar_location', '📍 Abidjan, Côte d\'Ivoire • Astreinte 24/7');
            ?>
            <a href="tel:<?php echo esc_attr(preg_replace('/[^0-9+]/', '', $phone1)); ?>">📞 <?php echo esc_html($phone1); ?></a>
            <?php if (!empty($phone2)) : ?>
                <a href="tel:<?php echo esc_attr(preg_replace('/[^0-9+]/', '', $phone2)); ?>">📞 <?php echo esc_html($phone2); ?></a>
            <?php endif; ?>
            <a href="mailto:<?php echo esc_attr($email1); ?>">✉️ <?php echo esc_html($email1); ?></a>
            <?php if (!empty($email2)) : ?>
                <a href="mailto:<?php echo esc_attr($email2); ?>">✉️ <?php echo esc_html($email2); ?></a>
            <?php endif; ?>
        </div>
        <div style="font-size:12px; font-weight:700; color:#38BDF8;">
            <?php echo esc_html($loc); ?>
        </div>
    </div>
</div>

<!-- HEADER PRINCIPAL -->
<header class="site-header">
    <div class="container header-inner">
        <a href="<?php echo esc_url(home_url('/')); ?>" class="brand-logo" rel="home">
            <img src="<?php echo get_stylesheet_directory_uri() . '/assets/logo/logo-althium.png'; ?>" alt="<?php bloginfo('name'); ?> — La force d'un professionnel" style="height:48px; max-height:48px; width:auto; object-fit:contain;">
        </a>

        <nav class="main-nav" aria-label="Navigation principale">
            <?php
            if (has_nav_menu('primary')) {
                wp_nav_menu([
                    'theme_location' => 'primary',
                    'container'      => false,
                    'items_wrap'     => '%3$s',
                    'depth'          => 2,
                ]);
            } else {
                ?>
                <a href="<?php echo esc_url(home_url('/')); ?>" class="nav-link">Accueil</a>
                <a href="<?php echo esc_url(home_url('/a-propos/')); ?>" class="nav-link">À Propos</a>
                <a href="<?php echo esc_url(home_url('/metiers/')); ?>" class="nav-link">Nos 6 Activités</a>
                <a href="<?php echo esc_url(home_url('/realisations/')); ?>" class="nav-link">Réalisations</a>
                <a href="<?php echo esc_url(home_url('/blog/')); ?>" class="nav-link">Actualités</a>
                <a href="<?php echo esc_url(home_url('/contact/')); ?>" class="nav-link">Contact</a>
                <?php
            }
            ?>
        </nav>

        <div class="header-actions">
            <a href="#devis-popup" class="btn btn-primary althium-open-modal">Demander un devis</a>
            <!-- BOUTON BURGER MOBILE -->
            <button type="button" class="mobile-menu-toggle" id="mobileMenuToggle" aria-label="Menu principal" aria-expanded="false">
                <span class="hamburger-bar"></span>
                <span class="hamburger-bar"></span>
                <span class="hamburger-bar"></span>
            </button>
        </div>
    </div>
</header>

<!-- TIROIR MENU MOBILE RESPONSIVE (OFF-CANVAS) -->
<div class="mobile-drawer-overlay" id="mobileDrawerOverlay"></div>
<div class="mobile-drawer" id="mobileDrawer" aria-hidden="true">
    <div class="mobile-drawer-header">
        <div class="mobile-drawer-logo">
            <img src="<?php echo get_stylesheet_directory_uri() . '/assets/logo/logo-althium.png'; ?>" alt="<?php bloginfo('name'); ?>" style="height:38px; width:auto; object-fit:contain;">
        </div>
        <button type="button" class="mobile-drawer-close" id="mobileDrawerClose" aria-label="Fermer le menu">✕</button>
    </div>

    <div class="mobile-drawer-body">
        <div class="mobile-nav-label">Navigation Principale</div>
        <nav class="mobile-nav">
            <a href="<?php echo esc_url(home_url('/')); ?>" class="mobile-nav-link"><span>🏠</span> Accueil</a>
            <a href="<?php echo esc_url(home_url('/a-propos/')); ?>" class="mobile-nav-link"><span>🏢</span> À Propos</a>
            <a href="<?php echo esc_url(home_url('/metiers/')); ?>" class="mobile-nav-link"><span>⚙️</span> Nos 6 Activités</a>
            <a href="<?php echo esc_url(home_url('/realisations/')); ?>" class="mobile-nav-link"><span>🏆</span> Réalisations</a>
            <a href="<?php echo esc_url(home_url('/blog/')); ?>" class="mobile-nav-link"><span>📰</span> Actualités &amp; Analyses</a>
            <a href="<?php echo esc_url(home_url('/contact/')); ?>" class="mobile-nav-link"><span>✉️</span> Contact &amp; Siège</a>
        </nav>

        <div class="mobile-nav-divider"></div>

        <div class="mobile-nav-label">Les 6 Pôles Métiers</div>
        <div class="mobile-sub-metiers">
            <a href="<?php echo esc_url(home_url('/metiers/btp-construction/')); ?>" class="mobile-metier-tag"><span style="color:#38BDF8; font-weight:800;">●</span> 1. BTP &amp; Travaux Publics</a>
            <a href="<?php echo esc_url(home_url('/metiers/immobilier/')); ?>" class="mobile-metier-tag"><span style="color:#0891B2; font-weight:800;">●</span> 2. Immobilier &amp; Foncier</a>
            <a href="<?php echo esc_url(home_url('/metiers/conseil-intelligence-economique/')); ?>" class="mobile-metier-tag"><span style="color:#94A3B8; font-weight:800;">●</span> 3. Conseil &amp; Intelligence Éco.</a>
            <a href="<?php echo esc_url(home_url('/metiers/marketing-sportif/')); ?>" class="mobile-metier-tag"><span style="color:#E11D48; font-weight:800;">●</span> 4. Marketing Sportif</a>
            <a href="<?php echo esc_url(home_url('/metiers/formations/')); ?>" class="mobile-metier-tag"><span style="color:#2E8B57; font-weight:800;">●</span> 5. Formations Professionnelles</a>
            <a href="<?php echo esc_url(home_url('/metiers/import-export/')); ?>" class="mobile-metier-tag"><span style="color:#D97706; font-weight:800;">●</span> 6. Import-Export &amp; Négoce</a>
        </div>

        <div class="mobile-nav-divider"></div>

        <div class="mobile-drawer-cta">
            <?php 
            $m_phone = althium_get_option('phone_1', '+225 05 56 56 25 24');
            $m_wa    = althium_get_option('whatsapp_raw', '2250556562524');
            ?>
            <a href="#devis-popup" class="btn btn-primary althium-open-modal" style="width:100%; text-align:center; padding:12px; font-size:14px; margin-bottom:10px;">
                🚀 Demander une étude / devis
            </a>
            <a href="tel:<?php echo esc_attr(preg_replace('/[^0-9+]/', '', $m_phone)); ?>" class="btn btn-secondary" style="width:100%; text-align:center; padding:11px; font-size:13px; margin-bottom:10px;">
                📞 Appeler : <?php echo esc_html($m_phone); ?>
            </a>
            <a href="https://wa.me/<?php echo esc_attr(preg_replace('/[^0-9]/', '', $m_wa)); ?>?text=Bonjour%20Althium%20SARL" target="_blank" class="btn" style="width:100%; text-align:center; padding:11px; font-size:13px; background:#25D366; color:#FFFFFF;">
                💬 Discuter sur WhatsApp
            </a>
        </div>
    </div>
</div>
