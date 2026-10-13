<?php
/**
 * Template Name: Page Réalisations & Portefeuille
 */
if (!defined('ABSPATH')) exit;

get_header();
?>
<section style="background:linear-gradient(135deg, #092047 0%, #0C2E63 100%); color:#FFFFFF; padding:80px 0 60px;">
    <div class="container" style="text-align:center;">
        <span class="section-tag" style="color:#7DD3FC;">Portefeuille de Travaux &amp; Missions</span>
        <h1 style="font-size:44px; color:#FFFFFF; margin-bottom:12px;">Nos Réalisations &amp; Cas d'Étude</h1>
        <p style="font-size:18px; color:#CBD5E1; max-width:650px; margin:0 auto;">
            Explorez les projets livrés par ALTHIUM SARL à travers ses 6 domaines d'excellence en Côte d'Ivoire.
        </p>
    </div>
</section>

<section class="section-padding">
    <div class="container">
        <!-- Contrôles de filtrage -->
        <div class="filter-controls">
            <div class="filter-pills">
                <button class="pill-btn active" data-filter="all">Tous les Projets</button>
                <button class="pill-btn" data-filter="btp">BTP &amp; Travaux</button>
                <button class="pill-btn" data-filter="immo">Immobilier</button>
                <button class="pill-btn" data-filter="conseil">Conseil &amp; IE</button>
                <button class="pill-btn" data-filter="sport">Marketing Sportif</button>
                <button class="pill-btn" data-filter="formation">Formations</button>
                <button class="pill-btn" data-filter="import">Import-Export</button>
            </div>
        </div>

        <div class="realisations-grid">
            <?php
            $real_query = new WP_Query([
                'post_type'      => 'realisations',
                'posts_per_page' => -1,
                'post_status'    => 'publish',
            ]);

            if ($real_query->have_posts()) :
                $sector_configs = [
                    'btp'       => ['BTP', '#0C2E63'],
                    'immo'      => ['Immobilier', '#0891B2'],
                    'conseil'   => ['Conseil & IE', '#0F172A'],
                    'sport'     => ['Marketing Sportif', '#E11D48'],
                    'formation' => ['Formations', '#2E8B57'],
                    'import'    => ['Import-Export', '#D97706'],
                ];
                while ($real_query->have_posts()) : $real_query->the_post();
                    $rid    = get_the_ID();
                    $thumb  = get_the_post_thumbnail_url($rid, 'large');
                    $sector = get_post_meta($rid, 'real_sector', true) ?: 'btp';
                    $kpi    = get_post_meta($rid, 'real_kpi', true) ?: 'Projet Réalisé';
                    $cfg    = $sector_configs[$sector] ?? ['Réalisation', '#0C2E63'];
                    if (!$thumb) {
                        $fallback_rphotos = [
                            'btp'       => 'https://images.unsplash.com/photo-1503387762-592deb58ef4e?auto=format&fit=crop&w=800&q=80',
                            'immo'      => 'https://images.unsplash.com/photo-1600585154340-be6161a56a0c?auto=format&fit=crop&w=800&q=80',
                            'conseil'   => 'https://images.unsplash.com/photo-1454165804606-c3d57bc86b40?auto=format&fit=crop&w=800&q=80',
                            'sport'     => 'https://images.unsplash.com/photo-1508098682722-e99c43a406b2?auto=format&fit=crop&w=800&q=80',
                            'formation' => 'https://images.unsplash.com/photo-1524178232363-1fb2b075b655?auto=format&fit=crop&w=800&q=80',
                            'import'    => 'https://images.unsplash.com/photo-1586528116311-ad8dd3c8310d?auto=format&fit=crop&w=800&q=80',
                        ];
                        $thumb = $fallback_rphotos[$sector] ?? 'https://images.unsplash.com/photo-1503387762-592deb58ef4e?auto=format&fit=crop&w=800&q=80';
                    }
                    ?>
                    <div class="real-card" data-category="<?php echo esc_attr($sector); ?>">
                        <div class="real-media">
                            <span class="real-tag" style="background:<?php echo esc_attr($cfg[1]); ?>;"><?php echo esc_html($cfg[0]); ?></span>
                            <img src="<?php echo esc_url($thumb); ?>" alt="<?php the_title_attribute(); ?>">
                        </div>
                        <div class="real-content">
                            <div class="real-meta"><?php echo get_the_date('Y'); ?> • Côte d'Ivoire</div>
                            <h3 class="real-title"><?php the_title(); ?></h3>
                            <p class="real-desc"><?php echo wp_trim_words(get_the_excerpt(), 20, '...'); ?></p>
                            <div class="real-footer">
                                <span class="real-kpi"><?php echo esc_html($kpi); ?></span>
                                <a href="#devis-popup" class="althium-open-modal" style="font-size:13px; font-weight:700; color:var(--primary);">Devis similaire →</a>
                            </div>
                        </div>
                    </div>
                    <?php
                endwhile;
                wp_reset_postdata();
            else :
            ?>
            <!-- 1. BTP -->
            <div class="real-card" data-category="btp">
                <div class="real-media">
                    <span class="real-tag" style="background:#0C2E63;">BTP</span>
                    <img src="https://images.unsplash.com/photo-1503387762-592deb58ef4e?auto=format&fit=crop&w=800&q=80" alt="Réhabilitation Façade">
                </div>
                <div class="real-content">
                    <div class="real-meta">2025 • Abidjan, Plateau</div>
                    <h3 class="real-title">Réhabilitation Façade Complexe Horizon</h3>
                    <p class="real-desc">Modernisation thermique et réfection intégrale des façades sur 15 000 m² d'espaces tertiaires.</p>
                    <div class="real-footer">
                        <span class="real-kpi">15 000 m² livrés</span>
                        <a href="#devis-popup" class="althium-open-modal" style="font-size:13px; font-weight:700; color:var(--primary);">Devis similaire →</a>
                    </div>
                </div>
            </div>

            <!-- 2. Immobilier -->
            <div class="real-card" data-category="immo">
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
                        <a href="#devis-popup" class="althium-open-modal" style="font-size:13px; font-weight:700; color:var(--primary);">Devis similaire →</a>
                    </div>
                </div>
            </div>

            <!-- 3. Conseil -->
            <div class="real-card" data-category="conseil">
                <div class="real-media">
                    <span class="real-tag" style="background:#0F172A;">Conseil &amp; IE</span>
                    <img src="https://images.unsplash.com/photo-1454165804606-c3d57bc86b40?auto=format&fit=crop&w=800&q=80" alt="Due Diligence">
                </div>
                <div class="real-content">
                    <div class="real-meta">2025 • Zone UEMOA</div>
                    <h3 class="real-title">Due Diligence &amp; Cartographie d'Implantation</h3>
                    <p class="real-desc">Étude d'impact concurrentiel et sécurisation juridique pour un fonds d'investissement panafricain.</p>
                    <div class="real-footer">
                        <span class="real-kpi">Rapport 360° livré</span>
                        <a href="#devis-popup" class="althium-open-modal" style="font-size:13px; font-weight:700; color:var(--primary);">Devis similaire →</a>
                    </div>
                </div>
            </div>

            <!-- 4. Sport -->
            <div class="real-card" data-category="sport">
                <div class="real-media">
                    <span class="real-tag" style="background:#E11D48;">Marketing Sportif</span>
                    <img src="https://images.unsplash.com/photo-1508098682722-e99c43a406b2?auto=format&fit=crop&w=800&q=80" alt="Tournoi">
                </div>
                <div class="real-content">
                    <div class="real-meta">2025 • Événementiel Sportif</div>
                    <h3 class="real-title">Sponsoring Tournoi International Jeunesse</h3>
                    <p class="real-desc">Mobilisation de 12 marques sponsors et couverture médiatique régionale pour 50 000 spectateurs.</p>
                    <div class="real-footer">
                        <span class="real-kpi">12 sponsors mobilisés</span>
                        <a href="#devis-popup" class="althium-open-modal" style="font-size:13px; font-weight:700; color:var(--primary);">Devis similaire →</a>
                    </div>
                </div>
            </div>

            <!-- 5. Formations -->
            <div class="real-card" data-category="formation">
                <div class="real-media">
                    <span class="real-tag" style="background:#2E8B57;">Formations</span>
                    <img src="https://images.unsplash.com/photo-1524178232363-1fb2b075b655?auto=format&fit=crop&w=800&q=80" alt="Formation">
                </div>
                <div class="real-content">
                    <div class="real-meta">2025 • Abidjan &amp; Inter-Entreprises</div>
                    <h3 class="real-title">Cycle Certifiant Maîtrise d'Œuvre &amp; QHSE</h3>
                    <p class="real-desc">Formation intensive de 140 cadres et chefs de chantiers aux normes internationales ISO et QHSE.</p>
                    <div class="real-footer">
                        <span class="real-kpi">140 cadres formés</span>
                        <a href="#devis-popup" class="althium-open-modal" style="font-size:13px; font-weight:700; color:var(--primary);">Devis similaire →</a>
                    </div>
                </div>
            </div>

            <!-- 6. Import-Export -->
            <div class="real-card" data-category="import">
                <div class="real-media">
                    <span class="real-tag" style="background:#D97706;">Import-Export</span>
                    <img src="https://images.unsplash.com/photo-1586528116311-ad8dd3c8310d?auto=format&fit=crop&w=800&q=80" alt="Logistique">
                </div>
                <div class="real-content">
                    <div class="real-meta">2025 • Port Autonome d'Abidjan</div>
                    <h3 class="real-title">Approvisionnement d'Acier &amp; Matériel Lourd</h3>
                    <p class="real-desc">Sécurisation logistique et dédouanement de 3 200 tonnes de matériaux certifiés pour chantiers d'État.</p>
                    <div class="real-footer">
                        <span class="real-kpi">3 200 t acheminées</span>
                        <a href="#devis-popup" class="althium-open-modal" style="font-size:13px; font-weight:700; color:var(--primary);">Devis similaire →</a>
                    </div>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<?php get_footer(); ?>
