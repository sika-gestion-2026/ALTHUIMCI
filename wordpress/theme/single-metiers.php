<?php
/**
 * Single Template — Métiers ALTHIUM SARL
 */
if (!defined('ABSPATH')) exit;

get_header();

$is_elementor_metier = false;
if (have_posts() && class_exists('\Elementor\Plugin') && get_the_ID()) {
    $elementor_doc = \Elementor\Plugin::$instance->documents->get(get_the_ID());
    if ($elementor_doc && method_exists($elementor_doc, 'is_built_with_elementor') && $elementor_doc->is_built_with_elementor()) {
        $elements_data = method_exists($elementor_doc, 'get_elements_data') ? $elementor_doc->get_elements_data() : [];
        if (!empty($elements_data) && is_array($elements_data)) {
            $has_widgets = false;
            foreach ($elements_data as $sec) {
                if (!empty($sec['elements'])) {
                    foreach ($sec['elements'] as $col) {
                        if (!empty($col['elements'])) {
                            $has_widgets = true;
                            break 2;
                        }
                    }
                }
            }
            if ($has_widgets) {
                $is_elementor_metier = true;
            }
        }
    }
}

if ($is_elementor_metier) {
    while (have_posts()) : the_post();
        the_content();
    endwhile;
} else {
    while (have_posts()) : the_post();
        $post_id = get_the_ID();
        $slug = get_post_field('post_name', $post_id);

        $accent_color = function_exists('get_field') ? get_field('pole_accent_color') : get_post_meta($post_id, 'pole_accent_color', true);
        if (!$accent_color) $accent_color = '#0C2E63';

        $subtitle = function_exists('get_field') ? get_field('pole_subtitle') : get_post_meta($post_id, 'pole_subtitle', true);
        $services = function_exists('get_field') ? get_field('pole_services_list') : get_post_meta($post_id, 'pole_services_list', true);
        $kpi_num  = function_exists('get_field') ? get_field('pole_kpi_number') : get_post_meta($post_id, 'pole_kpi_number', true);
        $kpi_lbl  = function_exists('get_field') ? get_field('pole_kpi_label') : get_post_meta($post_id, 'pole_kpi_label', true);

        if (empty($services) || !is_array($services)) {
            $default_services = [
                'btp-construction' => [
                    ['service_title' => 'Génie Civil & Gros Œuvre', 'service_desc' => 'Construction de complexes tertiaires, bâtiments industriels et résidentiels de prestige.'],
                    ['service_title' => 'Réhabilitation & Rénovation Lourde', 'service_desc' => 'Modernisation thermique, renforcement structural et réaménagement d\'immeubles de bureaux.'],
                    ['service_title' => 'Voiries & Réseaux Divers (VRD)', 'service_desc' => 'Aménagement de voiries, assainissement pluvial et viabilisation de terrains fonciers.'],
                ],
                'immobilier' => [
                    ['service_title' => 'Promotion & Programmes Neufs', 'service_desc' => 'Développement de résidences haut de gamme et villas sécurisées à Abidjan.'],
                    ['service_title' => 'Gestion Locative & Syndic', 'service_desc' => 'Administration rigoureuse de patrimoines, encaissement sécurisé et maintenance continue.'],
                    ['service_title' => 'Conseil Foncier & Sécurisation ACD', 'service_desc' => 'Vérification scrupuleuse des titres fonciers et purge des risques juridiques.'],
                ],
                'conseil-intelligence-economique' => [
                    ['service_title' => 'Veille Stratégique & Concurrentielle', 'service_desc' => 'Surveillance continue des marchés africains, évolutions réglementaires et signaux faibles.'],
                    ['service_title' => 'Due Diligence & Audit Partenaires', 'service_desc' => 'Évaluation de fiabilité des partenaires d\'affaires et conformité éthique.'],
                    ['service_title' => 'Gestion des Risques & Crise', 'service_desc' => 'Protection des actifs immatériels, sécurisation de l\'information et continuité opérationnelle.'],
                ],
                'marketing-sportif' => [
                    ['service_title' => 'Sponsoring & Partenariats B2B', 'service_desc' => 'Création de passerelles puissantes entre grandes marques institutionnelles et le sport.'],
                    ['service_title' => 'Organisation d\'Événements Sportifs', 'service_desc' => 'Production intégrale d\'événements sportifs aux standards internationaux.'],
                    ['service_title' => 'Gestion d\'Image & Droits Médias', 'service_desc' => 'Représentation contractuelle d\'athlètes de haut niveau et médiatisation multi-canale.'],
                ],
                'formations' => [
                    ['service_title' => 'Management de Projets BTP & QHSE', 'service_desc' => 'Formation pratique aux normes de sécurité chantiers et pilotage d\'opérations complexes.'],
                    ['service_title' => 'Intelligence Économique & Veille', 'service_desc' => 'Méthodes professionnelles de recueil, validation et protection des données sensibles.'],
                    ['service_title' => 'Leadership & Stratégie Dirigeants', 'service_desc' => 'Séminaires intensifs pour directeurs généraux et cadres supérieurs.'],
                ],
                'import-export' => [
                    ['service_title' => 'Sourcing International BTP', 'service_desc' => 'Approvisionnement direct en aciers, ciments spéciaux et finitions haut de gamme.'],
                    ['service_title' => 'Fret Multimodal & Logistique Portuaire', 'service_desc' => 'Acheminement sécurisé et gestion des opérations au port d\'Abidjan.'],
                    ['service_title' => 'Conformité & Dédouanement', 'service_desc' => 'Traitement réglementaire complet des formalités douanières et exonérations.'],
                ],
            ];
            $services = $default_services[$slug] ?? [
                ['service_title' => 'Étude & Diagnostic Approfondi', 'service_desc' => 'Analyse des besoins spécifiques et cadrage opérationnel du projet.'],
                ['service_title' => 'Déploiement Opérationnel', 'service_desc' => 'Mise en œuvre des solutions par des experts métiers dédiés.'],
                ['service_title' => 'Suivi & Contrôle Qualité', 'service_desc' => 'Accompagnement continu et reporting régulier des performances.'],
            ];
        }
        ?>
        <!-- HERO MÉTIER -->
        <section style="background:linear-gradient(135deg, #092047 0%, <?php echo esc_attr($accent_color); ?> 100%); color:#FFFFFF; padding:100px 0 80px;">
            <div class="container">
                <div style="font-family:var(--font-heading); font-size:13px; font-weight:800; color:#38BDF8; letter-spacing:1px; text-transform:uppercase; margin-bottom:12px;">
                    PÔLE D'EXPERTISE ALTHIUM
                </div>
                <h1 style="font-size:48px; font-weight:800; color:#FFFFFF; margin-bottom:16px;">
                    <?php the_title(); ?>
                </h1>
                <?php if ($subtitle) : ?>
                    <p style="font-size:20px; color:#E2E8F0; max-width:750px; line-height:1.5; margin-bottom:25px;">
                        <?php echo esc_html($subtitle); ?>
                    </p>
                <?php endif; ?>
                <div style="display:flex; gap:16px; flex-wrap:wrap;">
                    <a href="#devis-popup" class="btn btn-primary althium-open-modal">Demander une étude personnalisée</a>
                    <a href="#prestations" class="btn btn-outline-white">Consulter nos services</a>
                </div>
            </div>
        </section>

        <!-- CONTENU & SERVICES -->
        <section class="section-padding" id="prestations">
            <div class="container">
                <div class="section-header">
                    <span class="section-tag">Domaines d'Intervention</span>
                    <h2 class="section-title">Prestations &amp; Solutions</h2>
                </div>

                <div style="font-size:16px; line-height:1.8; margin-bottom:40px; color:var(--text);">
                    <?php the_content(); ?>
                </div>

                <?php if (!empty($services) && is_array($services)) : ?>
                    <div style="display:grid; grid-template-columns:repeat(auto-fit, minmax(320px, 1fr)); gap:24px;">
                        <?php foreach ($services as $idx => $serv) : ?>
                            <div style="background:#FFFFFF; border:1px solid var(--border); border-radius:var(--radius-md); padding:28px; box-shadow:var(--shadow-sm);">
                                <div style="font-family:var(--font-heading); font-size:24px; font-weight:800; color:<?php echo esc_attr($accent_color); ?>; margin-bottom:10px;">
                                    0<?php echo $idx + 1; ?>
                                </div>
                                <h3 style="font-size:18px; font-weight:700; color:var(--primary); margin-bottom:8px;">
                                    <?php echo esc_html($serv['service_title']); ?>
                                </h3>
                                <p style="font-size:14px; color:var(--text-muted); line-height:1.6;">
                                    <?php echo esc_html($serv['service_desc']); ?>
                                </p>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>

                <div style="text-align:center; margin-top:50px;">
                    <a href="#devis-popup" class="btn btn-primary althium-open-modal" style="font-size:16px; padding:15px 36px;">
                        Lancer un projet avec notre pôle <?php the_title(); ?>
                    </a>
                </div>
            </div>
        </section>
        <?php
    endwhile;
}

get_footer();
