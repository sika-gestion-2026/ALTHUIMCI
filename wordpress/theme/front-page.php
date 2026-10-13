<?php
/**
 * Template Name: Page d'Accueil ALTHIUM
 * Front Page Template — ALTHIUM SARL
 */
if (!defined('ABSPATH')) exit;

get_header();

$is_elementor_page = false;
if (have_posts() && class_exists('\Elementor\Plugin') && get_the_ID()) {
    $elementor_doc = \Elementor\Plugin::$instance->documents->get(get_the_ID());
    if ($elementor_doc && method_exists($elementor_doc, 'is_built_with_elementor') && $elementor_doc->is_built_with_elementor()) {
        // Ne basculer sur the_content() que si Elementor contient de véritables widgets configurés
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
                $is_elementor_page = true;
            }
        }
    }
}

if ($is_elementor_page) {
    while (have_posts()) : the_post();
        the_content();
    endwhile;
} else {
    ?>
    <!-- 1. HERO MULTI-ACTIVITÉS INTERACTIF -->
    <section class="hero">
        <div class="container hero-grid">
            <div class="hero-content">
                <div class="hero-badge">
                    <span>●</span> <?php echo esc_html(althium_get_option('hero_badge', 'GROUPE MULTIDISCIPLINAIRE D\'EXCELLENCE')); ?>
                </div>
                <h1 class="hero-title">
                    <?php echo wp_kses_post(althium_get_option('hero_title', 'La force d\'un professionnel au service de <span>vos ambitions</span>.')); ?>
                </h1>
                <p class="hero-subtitle">
                    <?php echo esc_html(althium_get_option('hero_subtitle', 'BTP, Immobilier, Conseil en Gestion & Intelligence Économique, Marketing Sportif, Formations et Import-Export : ALTHIUM SARL déploie des solutions transversales intégrées à haute valeur ajoutée.')); ?>
                </p>
                <div class="hero-buttons">
                    <a href="#secteurs" class="btn btn-secondary">Découvrir nos 6 pôles</a>
                    <a href="#devis-popup" class="btn btn-outline-white althium-open-modal">Étude &amp; Devis Express</a>
                </div>
            </div>

            <div class="hero-switcher">
                <div style="font-family:var(--font-heading); font-size:12px; font-weight:800; color:#CBD5E1; text-transform:uppercase; margin-bottom:12px; letter-spacing:0.5px;">
                    EXPLORER NOS 6 SECTEURS EN DIRECT :
                </div>
                <div class="switcher-pills">
                    <div class="switch-tab active" data-sector="btp">1. BTP</div>
                    <div class="switch-tab" data-sector="immo">2. Immobilier</div>
                    <div class="switch-tab" data-sector="conseil">3. Conseil &amp; IE</div>
                    <div class="switch-tab" data-sector="sport">4. Sport</div>
                    <div class="switch-tab" data-sector="formation">5. Formations</div>
                    <div class="switch-tab" data-sector="import">6. Import-Export</div>
                </div>

                <div class="switcher-display">
                    <div class="switcher-tag" id="switchTag">Pôle 01 • Génie Civil &amp; Gros Œuvre</div>
                    <h3 class="switcher-title" id="switchTitle">Bâtiment et Travaux Publics (BTP)</h3>
                    <p class="switcher-desc" id="switchDesc">
                        Études de faisabilité, conception architecturale, maîtrise d'œuvre et réalisation d'infrastructures résidentielles, commerciales et industrielles certifiées.
                    </p>
                    <a href="<?php echo esc_url(home_url('/metiers/btp-construction/')); ?>" class="btn btn-secondary" id="switchLink" style="padding:8px 18px; font-size:12px;">
                        Consulter l'offre détaillée →
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- 2. BANDEAU CHIFFRES CLÉS -->
    <section class="counters-strip">
        <div class="container counters-grid">
            <div class="counter-item">
                <div class="counter-number" data-target="15" data-plus="true"><?php echo esc_html(althium_get_option('kpi_1_num', '15+')); ?></div>
                <div class="counter-label"><?php echo esc_html(althium_get_option('kpi_1_label', 'Années d\'expérience')); ?></div>
            </div>
            <div class="counter-item">
                <div class="counter-number accent" data-target="120" data-plus="true"><?php echo esc_html(althium_get_option('kpi_2_num', '120+')); ?></div>
                <div class="counter-label"><?php echo esc_html(althium_get_option('kpi_2_label', 'Chantiers & Projets livrés')); ?></div>
            </div>
            <div class="counter-item">
                <div class="counter-number" data-target="6"><?php echo esc_html(althium_get_option('kpi_3_num', '6')); ?></div>
                <div class="counter-label"><?php echo esc_html(althium_get_option('kpi_3_label', 'Pôles d\'expertise métiers')); ?></div>
            </div>
            <div class="counter-item">
                <div class="counter-number" data-target="99.4" data-percent="true"><?php echo esc_html(althium_get_option('kpi_4_num', '99.4%')); ?></div>
                <div class="counter-label"><?php echo esc_html(althium_get_option('kpi_4_label', 'Taux de satisfaction client')); ?></div>
            </div>
        </div>
    </section>

    <!-- 3. PRÉSENTATION RAPIDE 360° -->
    <section class="section-padding">
        <div class="container">
            <div style="display:grid; grid-template-columns:1fr 1fr; gap:50px; align-items:center;">
                <div>
                    <span class="section-tag">Qui Sommes-Nous ?</span>
                    <h2 class="section-title">Une Vision Multidisciplinaire 360° Unique</h2>
                    <p style="font-size:16px; color:var(--text); margin-bottom:16px; line-height:1.7;">
                        Implantée en Côte d'Ivoire et tournée vers l'ensemble de l'Afrique et l'international, <strong>ALTHIUM SARL</strong> s'impose comme un partenaire stratégique global. Nous brisons les silos traditionnels pour combiner la force opérationnelle du génie civil et de l'immobilier avec l'acuité analytique du conseil en gestion, de l'intelligence économique, du marketing sportif et du négoce international.
                    </p>
                    <a href="<?php echo esc_url(home_url('/a-propos/')); ?>" class="btn btn-dark">En savoir plus sur notre histoire &amp; équipe →</a>
                </div>
                <div style="border-radius:var(--radius-lg); overflow:hidden; box-shadow:var(--shadow-lg);">
                    <img src="https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?auto=format&fit=crop&w=900&q=80" alt="Siège Althium SARL" style="aspect-ratio:4/3; object-fit:cover; width:100%;">
                </div>
            </div>
        </div>
    </section>

    <!-- 4. LES 6 PÔLES D'ACTIVITÉ (PHOTOS HD) -->
    <section class="section-padding section-bg-light" id="secteurs">
        <div class="container">
            <div class="section-header">
                <span class="section-tag">Nos Domaines d'Intervention</span>
                <h2 class="section-title">Les 6 Pôles d'Activité d'ALTHIUM SARL</h2>
                <p class="section-desc">Chaque pôle est piloté par des directeurs sectoriels dédiés garantissant rigueur et conformité.</p>
            </div>

            <div class="metiers-grid">
                <?php
                $metiers_query = new WP_Query([
                    'post_type'      => 'metiers',
                    'posts_per_page' => -1,
                    'post_status'    => 'publish',
                    'orderby'        => 'menu_order date',
                    'order'          => 'ASC',
                ]);

                if ($metiers_query->have_posts()) :
                    $idx = 1;
                    $fallback_photos = [
                        1 => 'https://images.unsplash.com/photo-1541888946425-d0fbb18615f3?auto=format&fit=crop&w=800&q=80',
                        2 => 'https://images.unsplash.com/photo-1560518883-ce09059eeffa?auto=format&fit=crop&w=800&q=80',
                        3 => 'https://images.unsplash.com/photo-1454165804606-c3d57bc86b40?auto=format&fit=crop&w=800&q=80',
                        4 => 'https://images.unsplash.com/photo-1461896836934-ffe607ba8211?auto=format&fit=crop&w=800&q=80',
                        5 => 'https://images.unsplash.com/photo-1524178232363-1fb2b075b655?auto=format&fit=crop&w=800&q=80',
                        6 => 'https://images.unsplash.com/photo-1586528116311-ad8dd3c8310d?auto=format&fit=crop&w=800&q=80',
                    ];
                    while ($metiers_query->have_posts()) : $metiers_query->the_post();
                        $mid   = get_the_ID();
                        $thumb = get_the_post_thumbnail_url($mid, 'large');
                        if (!$thumb) {
                            $thumb = $fallback_photos[$idx] ?? 'https://images.unsplash.com/photo-1541888946425-d0fbb18615f3?auto=format&fit=crop&w=800&q=80';
                        }
                        $color = get_post_meta($mid, 'pole_accent_color', true) ?: '#0C2E63';
                        $badge = 'Pôle ' . str_pad($idx, 2, '0', STR_PAD_LEFT);
                        ?>
                        <div class="metier-card" style="background-image: url('<?php echo esc_url($thumb); ?>');">
                            <div class="card-bg-overlay"></div>
                            <div class="metier-card-content">
                                <span class="metier-badge" style="background:<?php echo esc_attr($color); ?>;"><?php echo esc_html($badge); ?></span>
                                <h3 class="metier-card-title"><?php the_title(); ?></h3>
                                <p class="metier-card-desc"><?php echo wp_trim_words(get_the_excerpt(), 18, '...'); ?></p>
                                <a href="<?php the_permalink(); ?>" class="metier-card-link">Découvrir le pôle <span>→</span></a>
                            </div>
                        </div>
                        <?php
                        $idx++;
                    endwhile;
                    wp_reset_postdata();
                else :
                    // Affichage de démonstration si les données n'ont pas encore été synchronisées
                ?>
                <div class="metier-card" style="background-image: url('https://images.unsplash.com/photo-1541888946425-d0fbb18615f3?auto=format&fit=crop&w=800&q=80');">
                    <div class="card-bg-overlay"></div>
                    <div class="metier-card-content">
                        <span class="metier-badge" style="background:#0C2E63;">Pôle 01</span>
                        <h3 class="metier-card-title">BTP &amp; Travaux Publics</h3>
                        <p class="metier-card-desc">Études, conception, maîtrise d'œuvre, génie civil, réhabilitation et VRD.</p>
                        <a href="<?php echo esc_url(home_url('/metiers/btp-construction/')); ?>" class="metier-card-link">Découvrir le pôle <span>→</span></a>
                    </div>
                </div>

                <div class="metier-card" style="background-image: url('https://images.unsplash.com/photo-1560518883-ce09059eeffa?auto=format&fit=crop&w=800&q=80');">
                    <div class="card-bg-overlay"></div>
                    <div class="metier-card-content">
                        <span class="metier-badge" style="background:#0891B2;">Pôle 02</span>
                        <h3 class="metier-card-title">Immobilier</h3>
                        <p class="metier-card-desc">Transactions (achat/vente/location), promotion immobilière, gestion de biens &amp; conseil patrimonial.</p>
                        <a href="<?php echo esc_url(home_url('/metiers/immobilier/')); ?>" class="metier-card-link">Découvrir le pôle <span>→</span></a>
                    </div>
                </div>

                <div class="metier-card" style="background-image: url('https://images.unsplash.com/photo-1454165804606-c3d57bc86b40?auto=format&fit=crop&w=800&q=80');">
                    <div class="card-bg-overlay"></div>
                    <div class="metier-card-content">
                        <span class="metier-badge" style="background:#0F172A;">Pôle 03</span>
                        <h3 class="metier-card-title">Conseils en Gestion &amp; IE</h3>
                        <p class="metier-card-desc">Veille stratégique, analyse de marché, cartographie des risques et sécurité économique.</p>
                        <a href="<?php echo esc_url(home_url('/metiers/conseil-intelligence-economique/')); ?>" class="metier-card-link">Découvrir le pôle <span>→</span></a>
                    </div>
                </div>

                <div class="metier-card" style="background-image: url('https://images.unsplash.com/photo-1461896836934-ffe607ba8211?auto=format&fit=crop&w=800&q=80');">
                    <div class="card-bg-overlay"></div>
                    <div class="metier-card-content">
                        <span class="metier-badge" style="background:#E11D48;">Pôle 04</span>
                        <h3 class="metier-card-title">Marketing Sportif</h3>
                        <p class="metier-card-desc">Sponsoring, organisation d'événements, gestion d'image d'athlètes et activation de marques.</p>
                        <a href="<?php echo esc_url(home_url('/metiers/marketing-sportif/')); ?>" class="metier-card-link">Découvrir le pôle <span>→</span></a>
                    </div>
                </div>

                <div class="metier-card" style="background-image: url('https://images.unsplash.com/photo-1524178232363-1fb2b075b655?auto=format&fit=crop&w=800&q=80');">
                    <div class="card-bg-overlay"></div>
                    <div class="metier-card-content">
                        <span class="metier-badge" style="background:#2E8B57;">Pôle 05</span>
                        <h3 class="metier-card-title">Formations Professionnelles</h3>
                        <p class="metier-card-desc">Transfert de compétences certifiant en gestion de projet, QHSE, immobilier et management.</p>
                        <a href="<?php echo esc_url(home_url('/metiers/formations/')); ?>" class="metier-card-link">Découvrir le pôle <span>→</span></a>
                    </div>
                </div>

                <div class="metier-card" style="background-image: url('https://images.unsplash.com/photo-1586528116311-ad8dd3c8310d?auto=format&fit=crop&w=800&q=80');">
                    <div class="card-bg-overlay"></div>
                    <div class="metier-card-content">
                        <span class="metier-badge" style="background:#D97706;">Pôle 06</span>
                        <h3 class="metier-card-title">Import-Export &amp; Négoce</h3>
                        <p class="metier-card-desc">Sourcing international, chaîne logistique, conformité douanière et distribution régionale.</p>
                        <a href="<?php echo esc_url(home_url('/metiers/import-export/')); ?>" class="metier-card-link">Découvrir le pôle <span>→</span></a>
                    </div>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <!-- 5. APERÇU RÉALISATIONS & PROJETS PHARES -->
    <section class="section-padding">
        <div class="container">
            <div class="section-header">
                <span class="section-tag">Portefeuille d'Excellence</span>
                <h2 class="section-title">Nos Réalisations Phares</h2>
                <p class="section-desc">Découvrez une sélection de chantiers et missions stratégiques récemment délivrés en Côte d'Ivoire.</p>
            </div>

            <div class="realisations-grid">
                <?php
                $real_query = new WP_Query([
                    'post_type'      => 'realisations',
                    'posts_per_page' => 6,
                    'post_status'    => 'publish',
                ]);

                if ($real_query->have_posts()) :
                    while ($real_query->have_posts()) : $real_query->the_post();
                        $thumb = get_the_post_thumbnail_url(get_the_ID(), 'large');
                        if (!$thumb) {
                            $thumb = 'https://images.unsplash.com/photo-1503387762-592deb58ef4e?auto=format&fit=crop&w=800&q=80';
                        }
                        $terms = get_the_terms(get_the_ID(), 'secteur_metier');
                        $secteur_name = ($terms && !is_wp_error($terms)) ? $terms[0]->name : 'Réalisation ALTHIUM';
                        ?>
                        <div class="real-card">
                            <div class="real-media">
                                <span class="real-tag" style="background:#0C2E63;"><?php echo esc_html($secteur_name); ?></span>
                                <img src="<?php echo esc_url($thumb); ?>" alt="<?php the_title_attribute(); ?>">
                            </div>
                            <div class="real-content">
                                <div class="real-meta"><?php echo get_the_date('Y'); ?> • Côte d'Ivoire</div>
                                <h3 class="real-title"><?php the_title(); ?></h3>
                                <p class="real-desc"><?php echo wp_trim_words(get_the_excerpt(), 18, '...'); ?></p>
                                <div class="real-footer">
                                    <span class="real-kpi">Projet Réalisé</span>
                                    <a href="<?php the_permalink(); ?>" style="font-size:13px; font-weight:700; color:var(--primary);">Détails →</a>
                                </div>
                            </div>
                        </div>
                        <?php
                    endwhile;
                    wp_reset_postdata();
                else :
                ?>
                <!-- Démonstration par défaut tant qu'aucun article n'est créé -->
                <div class="real-card">
                    <div class="real-media">
                        <span class="real-tag" style="background:#0C2E63;">BTP</span>
                        <img src="https://images.unsplash.com/photo-1503387762-592deb58ef4e?auto=format&fit=crop&w=800&q=80" alt="Réhabilitation Façade">
                    </div>
                    <div class="real-content">
                        <div class="real-meta">2025 • Abidjan, Plateau</div>
                        <h3 class="real-title">Réhabilitation Façade Complexe Horizon</h3>
                        <p class="real-desc">Modernisation thermique et réfection intégrale des façades sur 15 000 m² d'espaces de bureaux.</p>
                        <div class="real-footer">
                            <span class="real-kpi">15 000 m² livrés</span>
                            <a href="<?php echo esc_url(home_url('/realisations/')); ?>" style="font-size:13px; font-weight:700; color:var(--primary);">Détails →</a>
                        </div>
                    </div>
                </div>

                <div class="real-card">
                    <div class="real-media">
                        <span class="real-tag" style="background:#0891B2;">Immobilier</span>
                        <img src="https://images.unsplash.com/photo-1600585154340-be6161a56a0c?auto=format&fit=crop&w=800&q=80" alt="Résidence Privée">
                    </div>
                    <div class="real-content">
                        <div class="real-meta">2025 • Cocody Riviera</div>
                        <h3 class="real-title">Résidence de Standing Les Jardins d'Ébène</h3>
                        <p class="real-desc">Promotion de 36 villas et appartements de haut standing avec sécurisation foncière totale.</p>
                        <div class="real-footer">
                            <span class="real-kpi">36 logements livrés</span>
                            <a href="<?php echo esc_url(home_url('/realisations/')); ?>" style="font-size:13px; font-weight:700; color:var(--primary);">Détails →</a>
                        </div>
                    </div>
                </div>

                <div class="real-card">
                    <div class="real-media">
                        <span class="real-tag" style="background:#E11D48;">Marketing Sportif</span>
                        <img src="https://images.unsplash.com/photo-1508098682722-e99c43a406b2?auto=format&fit=crop&w=800&q=80" alt="Tournoi Panafricain">
                    </div>
                    <div class="real-content">
                        <div class="real-meta">2025 • Événementiel Sportif</div>
                        <h3 class="real-title">Sponsoring Tournoi International Jeunesse</h3>
                        <p class="real-desc">Mobilisation de 12 marques sponsors et couverture médiatique régionale pour 50 000 spectateurs.</p>
                        <div class="real-footer">
                            <span class="real-kpi">12 sponsors mobilisés</span>
                            <a href="<?php echo esc_url(home_url('/realisations/')); ?>" style="font-size:13px; font-weight:700; color:var(--primary);">Détails →</a>
                        </div>
                    </div>
                </div>

                <div class="real-card">
                    <div class="real-media">
                        <span class="real-tag" style="background:#0F172A;">Conseil &amp; IE</span>
                        <img src="https://images.unsplash.com/photo-1454165804606-c3d57bc86b40?auto=format&fit=crop&w=800&q=80" alt="Étude de Marché Régionale">
                    </div>
                    <div class="real-content">
                        <div class="real-meta">2025 • Zone UEMOA</div>
                        <h3 class="real-title">Due Diligence &amp; Cartographie d'Implantation</h3>
                        <p class="real-desc">Étude d'impact concurrentiel et sécurisation juridique pour un fonds d'investissement panafricain.</p>
                        <div class="real-footer">
                            <span class="real-kpi">Rapport 360° livré</span>
                            <a href="<?php echo esc_url(home_url('/realisations/')); ?>" style="font-size:13px; font-weight:700; color:var(--primary);">Détails →</a>
                        </div>
                    </div>
                </div>

                <div class="real-card">
                    <div class="real-media">
                        <span class="real-tag" style="background:#2E8B57;">Formations</span>
                        <img src="https://images.unsplash.com/photo-1524178232363-1fb2b075b655?auto=format&fit=crop&w=800&q=80" alt="Session Certifiante">
                    </div>
                    <div class="real-content">
                        <div class="real-meta">2025 • Abidjan &amp; Inter-Entreprises</div>
                        <h3 class="real-title">Cycle Certifiant Maîtrise d'Œuvre &amp; QHSE</h3>
                        <p class="real-desc">Formation intensive de 140 cadres et chefs de chantiers aux normes internationales ISO et QHSE.</p>
                        <div class="real-footer">
                            <span class="real-kpi">140 cadres formés</span>
                            <a href="<?php echo esc_url(home_url('/realisations/')); ?>" style="font-size:13px; font-weight:700; color:var(--primary);">Détails →</a>
                        </div>
                    </div>
                </div>

                <div class="real-card">
                    <div class="real-media">
                        <span class="real-tag" style="background:#D97706;">Import-Export</span>
                        <img src="https://images.unsplash.com/photo-1586528116311-ad8dd3c8310d?auto=format&fit=crop&w=800&q=80" alt="Négoce et Fret">
                    </div>
                    <div class="real-content">
                        <div class="real-meta">2025 • Port Autonome d'Abidjan</div>
                        <h3 class="real-title">Approvisionnement d'Acier &amp; Équipements Lourds</h3>
                        <p class="real-desc">Sécurisation logistique et dédouanement de 3 200 tonnes de matériaux certifiés pour chantiers d'État.</p>
                        <div class="real-footer">
                            <span class="real-kpi">3 200 t acheminées</span>
                            <a href="<?php echo esc_url(home_url('/realisations/')); ?>" style="font-size:13px; font-weight:700; color:var(--primary);">Détails →</a>
                        </div>
                    </div>
                </div>
                <?php endif; ?>
            </div>

            <div style="text-align:center; margin-top:40px;">
                <a href="<?php echo esc_url(home_url('/realisations/')); ?>" class="btn btn-dark">Consulter l'ensemble de nos réalisations &amp; cas d'étude →</a>
            </div>
        </div>
    </section>

    <!-- 6. WIDGET AVANT / APRÈS INTERACTIF (RÉHABILITATION FAÇADE) -->
    <section class="section-padding section-bg-light">
        <div class="container">
            <div class="section-header">
                <span class="section-tag">Démonstration Technique</span>
                <h2 class="section-title">Transformation &amp; Réhabilitation</h2>
                <p class="section-desc">Faites glisser le curseur pour visualiser la métamorphose opérée par notre pôle BTP.</p>
            </div>

            <div class="ba-slider-container">
                <img src="https://images.unsplash.com/photo-1541888946425-d0fbb18615f3?auto=format&fit=crop&w=960&q=80" class="ba-img" alt="Avant travaux">
                <div class="ba-after-wrapper">
                    <img src="https://images.unsplash.com/photo-1503387762-592deb58ef4e?auto=format&fit=crop&w=960&q=80" alt="Après travaux">
                </div>
                <div class="ba-handle">⬌</div>
                <span class="ba-label ba-label-before">AVANT</span>
                <span class="ba-label ba-label-after">APRÈS LIVRAISON</span>
            </div>
        </div>
    </section>

    <!-- 7. POURQUOI CHOISIR ALTHIUM (360°) -->
    <section class="section-padding">
        <div class="container">
            <div class="section-header">
                <span class="section-tag">Notre Valeur Ajoutée</span>
                <h2 class="section-title">Pourquoi Choisir ALTHIUM SARL ?</h2>
                <p class="section-desc">Quatre piliers fondamentaux garantissent la réussite et la sécurité de chacun de vos projets.</p>
            </div>

            <div class="why-grid">
                <div class="why-card">
                    <div class="why-icon">🏗️</div>
                    <h3 class="why-card-title">Transversalité 360°</h3>
                    <p class="why-card-desc">Un interlocuteur unique pour l'ingénierie, l'immobilier, le conseil stratégique et la logistique.</p>
                </div>
                <div class="why-card">
                    <div class="why-icon accent">⚖️</div>
                    <h3 class="why-card-title">Rigueur &amp; Sécurité Juridique</h3>
                    <p class="why-card-desc">Conformité foncière stricte en Côte d'Ivoire, respect des délais contractuels et garanties décennales.</p>
                </div>
                <div class="why-card">
                    <div class="why-icon">📊</div>
                    <h3 class="why-card-title">Intelligence Économique</h3>
                    <p class="why-card-desc">Des décisions éclairées grâce à une veille permanente sur les marchés d'Afrique de l'Ouest.</p>
                </div>
                <div class="why-card">
                    <div class="why-icon accent">🤝</div>
                    <h3 class="why-card-title">Accompagnement Dédié</h3>
                    <p class="why-card-desc">Une équipe d'astreinte 24h/24 et un interlocuteur unique tout au long de votre cycle de projet.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- 8. TÉMOIGNAGES PARTENAIRES -->
    <section class="section-padding section-bg-light">
        <div class="container">
            <div class="section-header">
                <span class="section-tag">Avis Partenaires</span>
                <h2 class="section-title">Ce Que Disent Nos Clients</h2>
            </div>

            <div class="testimonials-grid">
                <div class="testi-card">
                    <div class="stars">★★★★★</div>
                    <p class="testi-quote">« ALTHIUM a assuré la maîtrise d'œuvre de notre nouveau complexe avec une rigueur technique remarquable et le respect absolu du calendrier. »</p>
                    <div class="testi-author">
                        <div class="author-avatar">MK</div>
                        <div>
                            <div class="author-name">Marc KOUASSI</div>
                            <div class="author-role">Directeur Général, Groupe AXIS Côte d'Ivoire</div>
                        </div>
                    </div>
                </div>

                <div class="testi-card">
                    <div class="stars">★★★★★</div>
                    <p class="testi-quote">« La cellule d'Intelligence Économique d'Althium nous a apporté une analyse de marché décisive avant le lancement de nos investissements régionaux. »</p>
                    <div class="testi-author">
                        <div class="author-avatar">AD</div>
                        <div>
                            <div class="author-name">Aïssatou DIABATÉ</div>
                            <div class="author-role">Directrice des Investissements, Fonds Panafricain</div>
                        </div>
                    </div>
                </div>

                <div class="testi-card">
                    <div class="stars">★★★★★</div>
                    <p class="testi-quote">« Grâce à leur pôle Marketing Sportif, notre marque a bénéficié d'une visibilité sans précédent lors du tournoi international à Abidjan. »</p>
                    <div class="testi-author">
                        <div class="author-avatar">EK</div>
                        <div>
                            <div class="author-name">Éric KOFFI</div>
                            <div class="author-role">Directeur Communication &amp; Sponsoring</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 9. GRAND CTA FINAL -->
    <section class="cta-banner">
        <div class="container">
            <h2 class="cta-title">Donnez une dimension supérieure à vos projets</h2>
            <p class="cta-subtitle">BTP, Immobilier, Conseil Stratégique, Marketing Sportif, Formations ou Négoce International : nos directeurs de pôles vous apportent une réponse personnalisée sous 24h.</p>
            <div style="display:flex; gap:16px; justify-content:center; flex-wrap:wrap;">
                <a href="#devis-popup" class="btn btn-primary althium-open-modal" style="font-size:16px; padding:15px 36px;">
                    Demander une étude personnalisée
                </a>
                <?php $cta_wa = althium_get_option('whatsapp_raw', '2250556562524'); ?>
                <a href="https://wa.me/<?php echo esc_attr(preg_replace('/[^0-9]/', '', $cta_wa)); ?>?text=Bonjour%20Althium%20SARL" class="btn btn-outline-white" target="_blank" style="font-size:16px; padding:15px 30px;">
                    Discuter sur WhatsApp (+225)
                </a>
            </div>
        </div>
    </section>
    <?php
}

get_footer();
