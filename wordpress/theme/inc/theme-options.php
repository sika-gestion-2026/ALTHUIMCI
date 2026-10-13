<?php
/**
 * Panneau d'administration et Réglages ALTHIUM SARL
 * Permet de modifier facilement tous les textes, téléphones, emails, slogans et chiffres clés
 */

if (!defined('ABSPATH')) exit;

// Fonction utilitaire pour récupérer une option avec valeur par défaut
function althium_get_option($key, $default = '') {
    return get_option('althium_' . $key, $default);
}

// Enregistrement de la page de menu dans WP-Admin
add_action('admin_menu', function () {
    add_menu_page(
        'Réglages ALTHIUM SARL',
        '⚙️ Réglages ALTHIUM',
        'manage_options',
        'althium-settings',
        'althium_render_settings_page',
        'dashicons-building',
        3
    );
});

// Enregistrement des réglages
add_action('admin_init', function () {
    $settings = [
        'phone_1', 'phone_2', 'email_contact', 'email_info', 'whatsapp_raw',
        'address', 'slogan', 'footer_desc', 'hours', 'topbar_location',
        'hero_badge', 'hero_title', 'hero_subtitle',
        'kpi_1_num', 'kpi_1_label', 'kpi_2_num', 'kpi_2_label',
        'kpi_3_num', 'kpi_3_label', 'kpi_4_num', 'kpi_4_label',
        'creator_name', 'creator_phone'
    ];

    foreach ($settings as $setting) {
        register_setting('althium_options_group', 'althium_' . $setting);
    }
});

// Rendu de la page de réglages dans WP Admin
function althium_render_settings_page() {
    if (!current_user_can('manage_options')) {
        return;
    }
    ?>
    <div class="wrap" style="max-width: 1000px; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;">
        <div style="background: linear-gradient(135deg, #0C2E63 0%, #071D40 100%); color: #fff; padding: 25px 30px; border-radius: 12px; margin-bottom: 25px; box-shadow: 0 4px 15px rgba(0,0,0,0.15);">
            <div style="display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 15px;">
                <div>
                    <h1 style="color: #fff; margin: 0 0 8px; font-size: 26px; font-weight: 700;">Panneau de Personnalisation ALTHIUM SARL</h1>
                    <p style="margin: 0; color: #94A3B8; font-size: 14px;">Modifiez ici directement les téléphones, emails, adresses, slogans, compteurs et informations du site.</p>
                </div>
                <div style="background: rgba(255,255,255,0.1); padding: 8px 16px; border-radius: 8px; font-weight: 600; font-size: 13px; color: #38BDF8;">
                    Édition Côte d'Ivoire (+225)
                </div>
            </div>
        </div>

        <?php if (isset($_GET['settings-updated'])) : ?>
            <div class="notice notice-success is-dismissible" style="border-left-color: #10B981;">
                <p><strong>✅ Vos modifications ont été enregistrées avec succès et sont visibles en direct sur le site !</strong></p>
            </div>
        <?php endif; ?>

        <?php if (isset($_GET['pages_synced'])) : ?>
            <div class="notice notice-success is-dismissible" style="border-left-color: #0284C7; padding: 12px 18px;">
                <p style="font-size: 14px; margin: 0;"><strong>✅ Succès : Toutes les pages officielles, les 6 fiches métiers et les menus ont été créés et synchronisés ! Les permaliens ont été régénérés sans erreur 404.</strong></p>
            </div>
        <?php endif; ?>

        <!-- CARTE D'INITIALISATION ET SYNCHRONISATION RAPIDE -->
        <div style="background: #FFFFFF; border: 2px solid #0284C7; border-radius: 12px; padding: 22px 26px; margin-bottom: 25px; display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 15px; box-shadow: 0 4px 12px rgba(2,132,199,0.08);">
            <div>
                <h3 style="margin: 0 0 6px; color: #0C2E63; font-size: 17px; display: flex; align-items: center; gap: 8px;">
                    <span>🚀</span> Génération &amp; Réparation des Pages &amp; Menus du Site
                </h3>
                <p style="margin: 0; color: #64748B; font-size: 13.5px; max-width: 620px; line-height: 1.5;">
                    Cliquez sur ce bouton pour créer ou réparer automatiquement en base de données les pages officielles (<em>À Propos, Activités, Réalisations, Actualités, Contact, Mentions Légales</em>), les 6 fiches métiers complètes et régénérer les permaliens sans 404.
                </p>
            </div>
            <form method="post" action="<?php echo esc_url(admin_url('admin-post.php')); ?>">
                <input type="hidden" name="action" value="althium_sync_pages">
                <?php wp_nonce_field('althium_sync_pages_nonce'); ?>
                <button type="submit" class="button button-primary button-large" style="background: #0284C7; border-color: #0284C7; font-weight: 700; padding: 8px 20px; font-size: 14px; border-radius: 8px; cursor: pointer; display: inline-flex; align-items: center; gap: 8px;">
                    <span>⚡</span> Synchroniser / Créer les Pages
                </button>
            </form>
        </div>

        <form method="post" action="options.php" style="background: #fff; padding: 30px; border-radius: 12px; border: 1px solid #E2E8F0; box-shadow: 0 2px 8px rgba(0,0,0,0.05);">
            <?php settings_fields('althium_options_group'); ?>

            <!-- ONGLET 1 : COORDONNÉES OFFICIELLES -->
            <h2 style="font-size: 18px; color: #0C2E63; border-bottom: 2px solid #E2E8F0; padding-bottom: 10px; margin-top: 0; display: flex; align-items: center; gap: 8px;">
                <span>📞</span> Coordonnées Officielles (Top Bar, Header & Footer)
            </h2>
            <table class="form-table" style="margin-bottom: 30px;">
                <tr>
                    <th scope="row"><label for="althium_phone_1">Téléphone Principal (Appels & WhatsApp)</label></th>
                    <td>
                        <input type="text" id="althium_phone_1" name="althium_phone_1" value="<?php echo esc_attr(althium_get_option('phone_1', '+225 05 56 56 25 24')); ?>" class="regular-text">
                        <p class="description">Affiché dans la barre supérieure et le pied de page.</p>
                    </td>
                </tr>
                <tr>
                    <th scope="row"><label for="althium_phone_2">Téléphone Secondaire</label></th>
                    <td>
                        <input type="text" id="althium_phone_2" name="althium_phone_2" value="<?php echo esc_attr(althium_get_option('phone_2', '+225 07 58 78 32 21')); ?>" class="regular-text">
                    </td>
                </tr>
                <tr>
                    <th scope="row"><label for="althium_whatsapp_raw">Numéro WhatsApp (Format international sans espace)</label></th>
                    <td>
                        <input type="text" id="althium_whatsapp_raw" name="althium_whatsapp_raw" value="<?php echo esc_attr(althium_get_option('whatsapp_raw', '2250556562524')); ?>" class="regular-text">
                        <p class="description">Exemple : <code>2250556562524</code> (utilisé pour le bouton WhatsApp flottant).</p>
                    </td>
                </tr>
                <tr>
                    <th scope="row"><label for="althium_email_contact">Email Contact Général</label></th>
                    <td>
                        <input type="email" id="althium_email_contact" name="althium_email_contact" value="<?php echo esc_attr(althium_get_option('email_contact', 'contact@althium.ci')); ?>" class="regular-text">
                    </td>
                </tr>
                <tr>
                    <th scope="row"><label for="althium_email_info">Email Devis & Direction</label></th>
                    <td>
                        <input type="email" id="althium_email_info" name="althium_email_info" value="<?php echo esc_attr(althium_get_option('email_info', 'info@althium.ci')); ?>" class="regular-text">
                        <p class="description">Les formulaires de devis sont envoyés à ces adresses.</p>
                    </td>
                </tr>
                <tr>
                    <th scope="row"><label for="althium_address">Adresse du Siège</label></th>
                    <td>
                        <input type="text" id="althium_address" name="althium_address" value="<?php echo esc_attr(althium_get_option('address', 'Abidjan, République de Côte d\'Ivoire')); ?>" class="large-text">
                    </td>
                </tr>
                <tr>
                    <th scope="row"><label for="althium_topbar_location">Texte d'Astreinte (Barre du haut)</label></th>
                    <td>
                        <input type="text" id="althium_topbar_location" name="althium_topbar_location" value="<?php echo esc_attr(althium_get_option('topbar_location', '📍 Abidjan, Côte d\'Ivoire • Astreinte 24/7')); ?>" class="large-text">
                    </td>
                </tr>
            </table>

            <!-- ONGLET 2 : SLOGANS & TEXTES DU FOOTER -->
            <h2 style="font-size: 18px; color: #0C2E63; border-bottom: 2px solid #E2E8F0; padding-bottom: 10px; margin-top: 30px; display: flex; align-items: center; gap: 8px;">
                <span>🏢</span> Slogan et Textes du Pied de Page (Footer)
            </h2>
            <table class="form-table" style="margin-bottom: 30px;">
                <tr>
                    <th scope="row"><label for="althium_slogan">Slogan Officiel (Grand Logo en bas)</label></th>
                    <td>
                        <input type="text" id="althium_slogan" name="althium_slogan" value="<?php echo esc_attr(althium_get_option('slogan', '« LA FORCE D\'UN PROFESSIONNEL »')); ?>" class="large-text">
                    </td>
                </tr>
                <tr>
                    <th scope="row"><label for="althium_footer_desc">Description du Groupe (Sous le logo)</label></th>
                    <td>
                        <textarea id="althium_footer_desc" name="althium_footer_desc" rows="3" class="large-text"><?php echo esc_textarea(althium_get_option('footer_desc', 'Entreprise multidisciplinaire d\'excellence : BTP, Immobilier, Conseil en Gestion & Intelligence Économique, Marketing Sportif, Formations et Import-Export.')); ?></textarea>
                    </td>
                </tr>
                <tr>
                    <th scope="row"><label for="althium_hours">Horaires & Disponibilité</label></th>
                    <td>
                        <textarea id="althium_hours" name="althium_hours" rows="2" class="large-text"><?php echo esc_textarea(althium_get_option('hours', "Bureaux ouverts du Lundi au Vendredi de 8h00 à 18h00.\nAstreinte chantiers & urgences 24h/24 et 7j/7.")); ?></textarea>
                    </td>
                </tr>
            </table>

            <!-- ONGLET 3 : CHIFFRES CLÉS DE LA PAGE D'ACCUEIL -->
            <h2 style="font-size: 18px; color: #0C2E63; border-bottom: 2px solid #E2E8F0; padding-bottom: 10px; margin-top: 30px; display: flex; align-items: center; gap: 8px;">
                <span>📊</span> Bandeau Chiffres Clés (Page d'Accueil)
            </h2>
            <table class="form-table" style="margin-bottom: 30px;">
                <tr>
                    <th scope="row">Compteur 1</th>
                    <td>
                        Chiffre : <input type="text" name="althium_kpi_1_num" value="<?php echo esc_attr(althium_get_option('kpi_1_num', '15+')); ?>" style="width: 80px;">
                        Libellé : <input type="text" name="althium_kpi_1_label" value="<?php echo esc_attr(althium_get_option('kpi_1_label', 'Années d\'expérience')); ?>" style="width: 250px;">
                    </td>
                </tr>
                <tr>
                    <th scope="row">Compteur 2</th>
                    <td>
                        Chiffre : <input type="text" name="althium_kpi_2_num" value="<?php echo esc_attr(althium_get_option('kpi_2_num', '120+')); ?>" style="width: 80px;">
                        Libellé : <input type="text" name="althium_kpi_2_label" value="<?php echo esc_attr(althium_get_option('kpi_2_label', 'Chantiers & Projets livrés')); ?>" style="width: 250px;">
                    </td>
                </tr>
                <tr>
                    <th scope="row">Compteur 3</th>
                    <td>
                        Chiffre : <input type="text" name="althium_kpi_3_num" value="<?php echo esc_attr(althium_get_option('kpi_3_num', '6')); ?>" style="width: 80px;">
                        Libellé : <input type="text" name="althium_kpi_3_label" value="<?php echo esc_attr(althium_get_option('kpi_3_label', 'Pôles d\'expertise métiers')); ?>" style="width: 250px;">
                    </td>
                </tr>
                <tr>
                    <th scope="row">Compteur 4</th>
                    <td>
                        Chiffre : <input type="text" name="althium_kpi_4_num" value="<?php echo esc_attr(althium_get_option('kpi_4_num', '99.4%')); ?>" style="width: 80px;">
                        Libellé : <input type="text" name="althium_kpi_4_label" value="<?php echo esc_attr(althium_get_option('kpi_4_label', 'Taux de satisfaction client')); ?>" style="width: 250px;">
                    </td>
                </tr>
            </table>

            <!-- ONGLET 4 : SIGNATURE DU CONCEPTEUR -->
            <h2 style="font-size: 18px; color: #0C2E63; border-bottom: 2px solid #E2E8F0; padding-bottom: 10px; margin-top: 30px; display: flex; align-items: center; gap: 8px;">
                <span>✨</span> Signature et Crédit du Concepteur (Bas de page)
            </h2>
            <table class="form-table" style="margin-bottom: 30px;">
                <tr>
                    <th scope="row"><label for="althium_creator_name">Nom du Concepteur</label></th>
                    <td>
                        <input type="text" id="althium_creator_name" name="althium_creator_name" value="<?php echo esc_attr(althium_get_option('creator_name', 'Christian Anisonok')); ?>" class="regular-text">
                    </td>
                </tr>
                <tr>
                    <th scope="row"><label for="althium_creator_phone">Numéro du Concepteur</label></th>
                    <td>
                        <input type="text" id="althium_creator_phone" name="althium_creator_phone" value="<?php echo esc_attr(althium_get_option('creator_phone', '07 77 91 64 07')); ?>" class="regular-text">
                        <p class="description">Affiché subtilement en bas à droite du site à la place du texte générique.</p>
                    </td>
                </tr>
            </table>

            <?php submit_button('💾 Enregistrer toutes les modifications', 'primary large', 'submit', true, ['style' => 'background: #0C2E63; border-color: #0C2E63; padding: 10px 24px; font-size: 15px; font-weight: 700; border-radius: 8px;']); ?>
        </form>
    </div>
    <?php
}

// Fonction pour afficher le crédit du concepteur subtilement
function althium_render_creator_credit() {
    $name  = althium_get_option('creator_name', 'Christian Anisonok');
    $phone = althium_get_option('creator_phone', '07 77 91 64 07');
    $phone_clean = preg_replace('/[^0-9+]/', '', $phone);

    echo '<div class="footer-creator-credit">';
    echo 'Confectionné avec excellence par ';
    if (!empty($phone_clean)) {
        echo '<a href="tel:' . esc_attr($phone_clean) . '"><strong>' . esc_html($name) . '</strong></a>';
        echo ' • <a href="tel:' . esc_attr($phone_clean) . '">' . esc_html($phone) . '</a>';
    } else {
        echo '<strong>' . esc_html($name) . '</strong>';
    }
    echo '</div>';
}
