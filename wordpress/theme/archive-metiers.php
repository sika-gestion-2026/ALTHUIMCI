<?php
/**
 * Template Name: Page Les 6 Pôles d'Activité
 */
if (!defined('ABSPATH')) exit;

get_header();
?>
<section style="background:linear-gradient(135deg, #092047 0%, #0C2E63 100%); color:#FFFFFF; padding:80px 0 60px;">
    <div class="container" style="text-align:center;">
        <span class="section-tag" style="color:#7DD3FC;">Excellence Pluridisciplinaire</span>
        <h1 style="font-size:44px; color:#FFFFFF; margin-bottom:12px;">Nos 6 Domaines d'Activité</h1>
        <p style="font-size:18px; color:#CBD5E1; max-width:650px; margin:0 auto;">
            De l'ingénierie civile au commerce international : une synergie unique pour accompagner les acteurs publics et privés.
        </p>
    </div>
</section>

<section class="section-padding">
    <div class="container">
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

<?php get_footer(); ?>
