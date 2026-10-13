<?php
/**
 * Module d'Initialisation & Provisioning Automatique ALTHIUM SARL
 * Crée automatiquement les pages, les CPTs Métiers, les Réalisations,
 * configure les permaliens, la page d'accueil et le menu principal.
 */

if (!defined('ABSPATH')) exit;

/**
 * Fonction principale de provisioning
 */
function althium_provision_all_content() {
    // 1. Activer la structure de permaliens propre /%postname%/ si non définie
    if (get_option('permalink_structure') !== '/%postname%/') {
        update_option('permalink_structure', '/%postname%/');
    }

    // 2. Définition des Pages Officielles
    $pages = [
        'accueil' => [
            'title'    => 'Accueil',
            'template' => 'front-page.php',
            'content'  => 'Page d\'accueil officielle ALTHIUM SARL.',
        ],
        'a-propos' => [
            'title'    => 'À Propos',
            'template' => 'page-a-propos.php',
            'content'  => 'Présentation du groupe ALTHIUM SARL et de ses valeurs d\'excellence en Côte d\'Ivoire.',
        ],
        'metiers' => [
            'title'    => 'Nos 6 Activités',
            'template' => 'page-metiers.php',
            'content'  => 'Présentation détaillée des 6 domaines d\'intervention ALTHIUM SARL.',
        ],
        'realisations' => [
            'title'    => 'Réalisations',
            'template' => 'page-realisations.php',
            'content'  => 'Portefeuille de projets et réalisations livrés par ALTHIUM SARL.',
        ],
        'blog' => [
            'title'    => 'Actualités',
            'template' => 'page-blog.php',
            'content'  => 'Actualités, tribunes et analyses sectorielles des directeurs de pôles ALTHIUM SARL.',
        ],
        'contact' => [
            'title'    => 'Contact',
            'template' => 'page-contact.php',
            'content'  => 'Contactez nos directeurs de pôles et le siège social ALTHIUM SARL à Abidjan.',
        ],
        'mentions-legales' => [
            'title'    => 'Mentions Légales',
            'template' => 'page-mentions-legales.php',
            'content'  => 'Mentions légales et politique de confidentialité ALTHIUM SARL.',
        ],
    ];

    $created_page_ids = [];

    foreach ($pages as $slug => $data) {
        $existing = get_page_by_path($slug);
        if (!$existing) {
            $page_id = wp_insert_post([
                'post_title'   => $data['title'],
                'post_name'    => $slug,
                'post_content' => $data['content'],
                'post_status'  => 'publish',
                'post_type'    => 'page',
                'comment_status' => 'closed',
                'ping_status'    => 'closed',
            ]);
        } else {
            $page_id = $existing->ID;
            // S'assurer que la page est publiée
            if ($existing->post_status !== 'publish') {
                wp_update_post([
                    'ID'          => $page_id,
                    'post_status' => 'publish',
                ]);
            }
        }

        if ($page_id && !is_wp_error($page_id)) {
            $created_page_ids[$slug] = $page_id;
            if (!empty($data['template'])) {
                update_post_meta($page_id, '_wp_page_template', $data['template']);
            }
        }
    }

    // 3. Définir Accueil comme page d'accueil statique et Blog comme page des articles
    if (!empty($created_page_ids['accueil'])) {
        update_option('show_on_front', 'page');
        update_option('page_on_front', $created_page_ids['accueil']);
    }
    if (!empty($created_page_ids['blog'])) {
        update_option('page_for_posts', $created_page_ids['blog']);
    }

    // 4. Provisioning des 6 Pôles Métiers (CPT 'metiers')
    $metiers = [
        'btp-construction' => [
            'title'        => 'BTP & Travaux Publics',
            'color'        => '#0C2E63',
            'subtitle'     => 'Études, conception architecturale, génie civil, réhabilitation lourde et VRD.',
            'kpi_num'      => '15 000 m²',
            'kpi_lbl'      => 'Surfaces BTP livrées',
            'excerpt'      => 'Études de faisabilité, conception architecturale, maîtrise d\'œuvre et réalisation d\'infrastructures certifiées en Côte d\'Ivoire.',
            'services'     => [
                [
                    'service_title' => 'Génie Civil & Gros Œuvre',
                    'service_desc'  => 'Construction de complexes tertiaires, bâtiments industriels et résidentiels conformes aux normes internationales.',
                ],
                [
                    'service_title' => 'Réhabilitation & Rénovation Lourde',
                    'service_desc'  => 'Modernisation thermique, renforcement structural et réaménagement d\'immeubles de bureaux à Abidjan.',
                ],
                [
                    'service_title' => 'Voiries & Réseaux Divers (VRD)',
                    'service_desc'  => 'Aménagement de voiries, assainissement pluvial, canalisations et viabilisation de terrains d\'envergure.',
                ],
            ],
            'content'      => '<p>Le pôle <strong>Bâtiment et Travaux Publics (BTP)</strong> d\'ALTHIUM SARL combine rigueur d\'ingénierie, maîtrise des coûts et respect strict des délais de livraison. Nos ingénieurs et conducteurs de travaux interviennent sur l\'ensemble du territoire ivoirien pour concrétiser vos projets d\'infrastructures.</p><p>De la phase d\'études géotechniques préliminaires jusqu\'à la livraison clé en main, nous appliquons les standards de qualité les plus exigeants.</p>',
        ],
        'immobilier' => [
            'title'        => 'Immobilier',
            'color'        => '#0891B2',
            'subtitle'     => 'Transactions sécurisées, promotion immobilière, gestion locative et conseil patrimonial.',
            'kpi_num'      => '100%',
            'kpi_lbl'      => 'Traçabilité foncière',
            'excerpt'      => 'Transactions sécurisées (achat/vente/location), promotion immobilière, gestion de biens & conseil patrimonial à Abidjan et en région.',
            'services'     => [
                [
                    'service_title' => 'Promotion & Programmes Neufs',
                    'service_desc'  => 'Développement de résidences de grand standing, immeubles tertiaires et villas sécurisées.',
                ],
                [
                    'service_title' => 'Gestion Locative & Syndic',
                    'service_desc'  => 'Administration rigoureuse de patrimoines immobiliers, encaissement sécurisé et maintenance continue.',
                ],
                [
                    'service_title' => 'Conseil Foncier & Sécurisation ACD',
                    'service_desc'  => 'Vérification scrupuleuse des titres fonciers (ACD, CMP) et purge des risques juridiques.',
                ],
            ],
            'content'      => '<p>Le pôle <strong>Immobilier</strong> d\'ALTHIUM SARL offre un accompagnement haut de gamme pour les acquéreurs, propriétaires et investisseurs institutionnels. Nous garantissons une traçabilité foncière absolue pour chaque transaction en Côte d\'Ivoire.</p><p>Nos équipes gèrent vos actifs avec un professionnalisme constant pour maximiser votre rentabilité locative.</p>',
        ],
        'conseil-intelligence-economique' => [
            'title'        => 'Conseils en Gestion & Intelligence Économique',
            'color'        => '#0F172A',
            'subtitle'     => 'Veille stratégique, due diligence, cartographie des risques et sécurité économique.',
            'kpi_num'      => '24/7',
            'kpi_lbl'      => 'Veille stratégique',
            'excerpt'      => 'Veille stratégique concurrentielle, analyse de marché, due diligence et sécurisation économique de vos investissements.',
            'services'     => [
                [
                    'service_title' => 'Veille Stratégique & Concurrentielle',
                    'service_desc'  => 'Surveillance continue des marchés africains, évolutions réglementaires et signaux faibles.',
                ],
                [
                    'service_title' => 'Due Diligence & Audit Partenaires',
                    'service_desc'  => 'Évaluation de fiabilité des partenaires d\'affaires, solvabilité et conformité éthique.',
                ],
                [
                    'service_title' => 'Gestion des Risques & Crise',
                    'service_desc'  => 'Protection des actifs immatériels, sécurisation de l\'information et plans de continuité opérationnelle.',
                ],
            ],
            'content'      => '<p>Le pôle <strong>Conseils en Gestion & Intelligence Économique</strong> éclaire les décisions stratégiques des dirigeants d\'entreprise et des investisseurs en Afrique de l\'Ouest. Nous transformons l\'information brute en avantage concurrentiel décisif.</p><p>Nos analyses approfondies sécurisent vos prises de participation et vos implantations commerciales.</p>',
        ],
        'marketing-sportif' => [
            'title'        => 'Marketing Sportif',
            'color'        => '#E11D48',
            'subtitle'     => 'Sponsoring, organisation d\'événements, gestion d\'image d\'athlètes et activation de marques.',
            'kpi_num'      => '30+',
            'kpi_lbl'      => 'Événements & Partenariats',
            'excerpt'      => 'Recherche de partenaires, organisation de tournois majeurs, gestion d\'image d\'athlètes et activation de marques.',
            'services'     => [
                [
                    'service_title' => 'Sponsoring & Partenariats B2B',
                    'service_desc'  => 'Création de passerelles puissantes entre grandes marques institutionnelles et le monde sportif.',
                ],
                [
                    'service_title' => 'Organisation de Tournois & Galas',
                    'service_desc'  => 'Production intégrale d\'événements sportifs aux standards des compétitions internationales.',
                ],
                [
                    'service_title' => 'Gestion d\'Image & Droits Médias',
                    'service_desc'  => 'Représentation contractuelle d\'athlètes de haut niveau et médiatisation multi-canale.',
                ],
            ],
            'content'      => '<p>Le pôle <strong>Marketing Sportif</strong> d\'ALTHIUM SARL valorise les synergies uniques entre l\'univers sportif et les stratégies de communication des grandes entreprises. Nous créons des expériences mémorables qui engagent le public et démultiplient la visibilité de nos partenaires.</p>',
        ],
        'formations' => [
            'title'        => 'Formations Professionnelles',
            'color'        => '#2E8B57',
            'subtitle'     => 'Programmes certifiants, séminaires exécutifs, montée en compétences managériales et techniques.',
            'kpi_num'      => '500+',
            'kpi_lbl'      => 'Cadres formés',
            'excerpt'      => 'Cycles certifiants en gestion de projet BTP, management QHSE, transactions immobilières et leadership opérationnel.',
            'services'     => [
                [
                    'service_title' => 'Management de Projets BTP & QHSE',
                    'service_desc'  => 'Formation pratique aux normes de sécurité chantiers et pilotage d\'opérations complexes.',
                ],
                [
                    'service_title' => 'Intelligence Économique & Veille',
                    'service_desc'  => 'Méthodes professionnelles de recueil, validation et protection des données sensibles.',
                ],
                [
                    'service_title' => 'Leadership & Stratégie Dirigeants',
                    'service_desc'  => 'Séminaires intensifs pour directeurs généraux, directeurs financiers et cadres supérieurs.',
                ],
            ],
            'content'      => '<p>Le pôle <strong>Formations Professionnelles</strong> d\'ALTHIUM SARL conçoit des parcours de formation certifiants et sur-mesure. Animés par des professionnels en activité, nos séminaires transmettent des compétences immédiatement opérationnelles sur le terrain.</p>',
        ],
        'import-export' => [
            'title'        => 'Import-Export & Négoce International',
            'color'        => '#D97706',
            'subtitle'     => 'Centrale d\'achat, sourcing international, approvisionnement en matériaux certifiés et logistique.',
            'kpi_num'      => '12+',
            'kpi_lbl'      => 'Corridors logistiques',
            'excerpt'      => 'Sourcing international de matériaux certifiés, logistique multimodale, supply chain et conformité douanière.',
            'services'     => [
                [
                    'service_title' => 'Sourcing International BTP',
                    'service_desc'  => 'Approvisionnement direct en aciers, ciments spéciaux, matériels et revêtements haut de gamme.',
                ],
                [
                    'service_title' => 'Fret Multimodal & Logistique Portuaire',
                    'service_desc'  => 'Acheminement sécurisé, gestion des opérations au port d\'Abidjan et transit accéléré.',
                ],
                [
                    'service_title' => 'Conformité & Dédouanement',
                    'service_desc'  => 'Traitement réglementaire complet des formalités douanières et exonérations spécifiques.',
                ],
            ],
            'content'      => '<p>Le pôle <strong>Import-Export & Négoce International</strong> d\'ALTHIUM SARL agit comme une véritable centrale d\'achat mondiale au service des donneurs d\'ordres de la sous-région. Nous garantissons des produits certifiés et une logistique sans faille.</p>',
        ],
    ];

    foreach ($metiers as $slug => $meta) {
        $existing = get_page_by_path($slug, OBJECT, 'metiers');
        if (!$existing) {
            $post_id = wp_insert_post([
                'post_title'   => $meta['title'],
                'post_name'    => $slug,
                'post_content' => $meta['content'],
                'post_excerpt' => $meta['excerpt'],
                'post_status'  => 'publish',
                'post_type'    => 'metiers',
                'comment_status' => 'closed',
            ]);
        } else {
            $post_id = $existing->ID;
            if ($existing->post_status !== 'publish') {
                wp_update_post([
                    'ID'          => $post_id,
                    'post_status' => 'publish',
                ]);
            }
        }

        if ($post_id && !is_wp_error($post_id)) {
            update_post_meta($post_id, 'pole_accent_color', $meta['color']);
            update_post_meta($post_id, 'pole_subtitle', $meta['subtitle']);
            update_post_meta($post_id, 'pole_kpi_number', $meta['kpi_num']);
            update_post_meta($post_id, 'pole_kpi_label', $meta['kpi_lbl']);
            update_post_meta($post_id, 'pole_services_list', $meta['services']);
        }
    }

    // 5. Provisioning de Réalisations Exemples (CPT 'realisations')
    $realisations = [
        'rehabilitation-facade-horizon' => [
            'title'    => 'Réhabilitation Façade Complexe Horizon',
            'sector'   => 'btp',
            'kpi'      => '15 000 m² livrés',
            'excerpt'  => 'Modernisation thermique et réfection intégrale des façades sur 15 000 m² d\'espaces tertiaires au Plateau (Abidjan).',
        ],
        'residence-jardins-ebene' => [
            'title'    => 'Résidence de Standing Les Jardins d\'Ébène',
            'sector'   => 'immo',
            'kpi'      => '24 logements de luxe',
            'excerpt'  => 'Programme résidentiel contemporain clos et sécurisé avec domotique et espaces paysagers à Cocody Riviera.',
        ],
        'audit-intelligence-economique-holding' => [
            'title'    => 'Audit d\'Intelligence Économique & Veille',
            'sector'   => 'conseil',
            'kpi'      => '3 marchés cartographiés',
            'excerpt'  => 'Mission de veille stratégique et analyse des risques concurrentiels pour un groupe industriel ouest-africain.',
        ],
        'tournoi-national-jeunes-talents' => [
            'title'    => 'Campagne Sponsoring & Tournoi National',
            'sector'   => 'sport',
            'kpi'      => '12 marques partenaires',
            'excerpt'  => 'Structuration marketing et activation sponsoring pour une compétition sportive réunissant 16 délégations régionales.',
        ],
        'programme-certification-dirigeants' => [
            'title'    => 'Programme Certifiant Leadership & Management',
            'sector'   => 'formation',
            'kpi'      => '85 cadres certifiés',
            'excerpt'  => 'Cycle de formation de 6 mois axé sur le pilotage de mégaprojets d\'ingénierie et la gestion des risques QHSE.',
        ],
        'centrale-approvisionnement-materiaux' => [
            'title'    => 'Centrale d\'Achat & Importation Matériaux BTP',
            'sector'   => 'import',
            'kpi'      => '5 000 tonnes acheminées',
            'excerpt'  => 'Acheminement multimodal et dédouanement express d\'aciers haute limite élastique pour un grand chantier d\'infrastructures.',
        ],
    ];

    foreach ($realisations as $slug => $data) {
        $existing = get_page_by_path($slug, OBJECT, 'realisations');
        if (!$existing) {
            $rid = wp_insert_post([
                'post_title'   => $data['title'],
                'post_name'    => $slug,
                'post_content' => '<p>' . esc_html($data['excerpt']) . '</p>',
                'post_excerpt' => $data['excerpt'],
                'post_status'  => 'publish',
                'post_type'    => 'realisations',
                'comment_status' => 'closed',
            ]);
            if ($rid && !is_wp_error($rid)) {
                update_post_meta($rid, 'real_kpi', $data['kpi']);
                update_post_meta($rid, 'real_sector', $data['sector']);
            }
        }
    }

    // 6. Configuration du Menu Principal WordPress
    $menu_name = 'Menu Principal ALTHIUM';
    $menu_obj = wp_get_nav_menu_object($menu_name);

    if (!$menu_obj) {
        $menu_id = wp_create_nav_menu($menu_name);
    } else {
        $menu_id = $menu_obj->term_id;
    }

    if ($menu_id && !is_wp_error($menu_id)) {
        // Obtenir les éléments de menu existants pour éviter les doublons
        $existing_items = wp_get_nav_menu_items($menu_id);
        if (empty($existing_items)) {
            $menu_links = [
                ['title' => 'Accueil',        'url' => home_url('/')],
                ['title' => 'À Propos',       'url' => home_url('/a-propos/')],
                ['title' => 'Nos 6 Activités','url' => home_url('/metiers/')],
                ['title' => 'Réalisations',   'url' => home_url('/realisations/')],
                ['title' => 'Actualités',     'url' => home_url('/blog/')],
                ['title' => 'Contact',        'url' => home_url('/contact/')],
            ];

            foreach ($menu_links as $order => $link) {
                wp_update_nav_menu_item($menu_id, 0, [
                    'menu-item-title'  => $link['title'],
                    'menu-item-url'    => $link['url'],
                    'menu-item-status' => 'publish',
                    'menu-item-type'   => 'custom',
                    'menu-item-position' => $order + 1,
                ]);
            }
        }

        // Associer le menu à l'emplacement 'primary'
        $locations = get_theme_mod('nav_menu_locations', []);
        $locations['primary'] = $menu_id;
        $locations['footer']  = $menu_id;
        set_theme_mod('nav_menu_locations', $locations);
    }

    // 7. Rafraîchir les règles de réécriture (Permaliens)
    flush_rewrite_rules(false);

    // 8. Marquer le provisioning comme complété
    update_option('althium_content_provisioned_v3_1', 1);
}

/**
 * Déclenchement automatique lors de l'activation du thème
 */
add_action('after_switch_theme', 'althium_provision_all_content');

/**
 * Déclenchement automatique à l'accès au tableau de bord admin si non encore provisionné
 */
add_action('admin_init', function () {
    if (!get_option('althium_content_provisioned_v3_1')) {
        althium_provision_all_content();
    }
});

/**
 * Action manuelle : Bouton 1-clic depuis « ⚙️ Réglages ALTHIUM »
 */
add_action('admin_post_althium_sync_pages', function () {
    if (!current_user_can('manage_options')) {
        wp_die('Accès refusé.');
    }
    check_admin_referer('althium_sync_pages_nonce');

    althium_provision_all_content();

    wp_safe_redirect(add_query_arg(['page' => 'althium-settings', 'pages_synced' => '1'], admin_url('admin.php')));
    exit;
});

/**
 * ROUTEUR DE SECOURS DE TEMPLATE (Bulletproof Theme Router)
 * Si jamais WordPress ou le serveur signale un 404 sur les URLs du site,
 * ce filtre intercepte l'URL, remet le statut HTTP à 200 et affiche le bon template.
 */
add_filter('template_include', function ($template) {
    $raw_uri = parse_url($_SERVER['REQUEST_URI'] ?? '', PHP_URL_PATH);
    $request_uri = trim($raw_uri ?: '', '/');

    // Détecter si WordPress est installé dans un sous-dossier
    $site_path = trim(parse_url(home_url(), PHP_URL_PATH) ?? '', '/');
    if (!empty($site_path) && strpos($request_uri, $site_path) === 0) {
        $request_uri = trim(substr($request_uri, strlen($site_path)), '/');
    }

    $routes = [
        'a-propos'          => 'page-a-propos.php',
        'contact'           => 'page-contact.php',
        'metiers'           => 'page-metiers.php',
        'realisations'      => 'page-realisations.php',
        'blog'              => 'page-blog.php',
        'mentions-legales'  => 'page-mentions-legales.php',
    ];

    if (isset($routes[$request_uri])) {
        $file = get_stylesheet_directory() . '/' . $routes[$request_uri];
        if (file_exists($file)) {
            global $wp_query;
            if ($wp_query) {
                $wp_query->is_404 = false;
            }
            status_header(200);
            return $file;
        }
    }

    // Gestion des fiches métiers individuelles : /metiers/{slug}/
    if (preg_match('#^metiers/([^/]+)$#', $request_uri, $matches)) {
        $slug = sanitize_title($matches[1]);
        $single_file = get_stylesheet_directory() . '/single-metiers.php';
        if (file_exists($single_file)) {
            global $wp_query, $post;
            $found = get_page_by_path($slug, OBJECT, 'metiers');
            if ($found) {
                $post = $found;
                setup_postdata($post);
                if ($wp_query) {
                    $wp_query->is_404 = false;
                    $wp_query->is_single = true;
                    $wp_query->queried_object = $found;
                    $wp_query->queried_object_id = $found->ID;
                }
            }
            status_header(200);
            return $single_file;
        }
    }

    return $template;
}, 99);
