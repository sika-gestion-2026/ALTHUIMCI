<?php
/**
 * Template Name: Page Actualités & Analyses
 */
if (!defined('ABSPATH')) exit;

get_header();
?>
<section style="background:linear-gradient(135deg, #092047 0%, #0C2E63 100%); color:#FFF; padding:80px 0 60px;">
    <div class="container text-center" style="text-align:center;">
        <span class="section-tag" style="color:#7DD3FC;">BLOG &amp; INSIGHTS</span>
        <h1 style="font-size:44px; font-weight:800; color:#FFFFFF; margin-bottom:14px;">Actualités &amp; Analyses Sectorielles</h1>
        <p style="font-size:18px; color:#CBD5E1; max-width:700px; margin:0 auto;">
            Retrouvez les tribunes, décryptages et retours d'expérience de nos directeurs de pôles.
        </p>
    </div>
</section>

<section class="section-padding">
    <div class="container">
        <div style="display:grid; grid-template-columns:repeat(auto-fit, minmax(320px, 1fr)); gap:28px;">
            <?php
            $posts_query = new WP_Query([
                'post_type'      => 'post',
                'posts_per_page' => 12,
                'post_status'    => 'publish',
            ]);

            if ($posts_query->have_posts()) :
                while ($posts_query->have_posts()) : $posts_query->the_post();
                    $thumb = get_the_post_thumbnail_url(get_the_ID(), 'large');
                    if (!$thumb) {
                        $thumb = 'https://images.unsplash.com/photo-1541888946425-d0fbb18615f3?auto=format&fit=crop&w=800&q=80';
                    }
                    $cats = get_the_category();
                    $cat_name = !empty($cats) ? $cats[0]->name : 'Actualité';
                    ?>
                    <div class="real-card">
                        <div class="real-media">
                            <span class="real-tag" style="background:#0C2E63;"><?php echo esc_html($cat_name); ?></span>
                            <img src="<?php echo esc_url($thumb); ?>" alt="<?php the_title_attribute(); ?>">
                        </div>
                        <div class="real-content">
                            <div class="real-meta"><?php echo get_the_date('d F Y'); ?> • <?php echo esc_html(get_the_author()); ?></div>
                            <h3 class="real-title"><?php the_title(); ?></h3>
                            <p class="real-desc"><?php echo wp_trim_words(get_the_excerpt(), 20, '...'); ?></p>
                            <a href="<?php the_permalink(); ?>" style="font-size:13px; font-weight:700; color:var(--primary); margin-top:auto;">Consulter l'article complet →</a>
                        </div>
                    </div>
                    <?php
                endwhile;
                wp_reset_postdata();
            else :
            ?>
            <div class="real-card">
                <div class="real-media">
                    <span class="real-tag" style="background:#0C2E63;">BTP</span>
                    <img src="https://images.unsplash.com/photo-1541888946425-d0fbb18615f3?auto=format&fit=crop&w=800&q=80" alt="BTP Durable">
                </div>
                <div class="real-content">
                    <div class="real-meta">02 Septembre 2026 • 5 min de lecture</div>
                    <h3 class="real-title">Les Grandes Tendances du BTP Durable en Afrique de l'Ouest</h3>
                    <p class="real-desc">Focus sur les nouveaux matériaux décarbonés et les exigences d'efficacité thermique à Abidjan.</p>
                    <a href="#devis-popup" class="althium-open-modal" style="font-size:13px; font-weight:700; color:var(--primary); margin-top:auto;">Consulter la note d'analyse →</a>
                </div>
            </div>

            <div class="real-card">
                <div class="real-media">
                    <span class="real-tag" style="background:#0891B2;">Immobilier</span>
                    <img src="https://images.unsplash.com/photo-1560518883-ce09059eeffa?auto=format&fit=crop&w=800&q=80" alt="Immobilier Abidjan">
                </div>
                <div class="real-content">
                    <div class="real-meta">28 Août 2026 • 4 min de lecture</div>
                    <h3 class="real-title">Investissement Locatif : Comment Sécuriser Son Rendement ?</h3>
                    <p class="real-desc">Nos conseils d'experts pour optimiser la gestion locative et vérifier la traçabilité des titres fonciers.</p>
                    <a href="#devis-popup" class="althium-open-modal" style="font-size:13px; font-weight:700; color:var(--primary); margin-top:auto;">Consulter la note d'analyse →</a>
                </div>
            </div>

            <div class="real-card">
                <div class="real-media">
                    <span class="real-tag" style="background:#0F172A;">Conseil &amp; IE</span>
                    <img src="https://images.unsplash.com/photo-1454165804606-c3d57bc86b40?auto=format&fit=crop&w=800&q=80" alt="Intelligence Economique">
                </div>
                <div class="real-content">
                    <div class="real-meta">15 Août 2026 • 6 min de lecture</div>
                    <h3 class="real-title">L'Intelligence Économique au Cœur de la Décision Panafricaine</h3>
                    <p class="real-desc">Comment la veille stratégique permet d'anticiper les risques réglementaires et concurrentiels.</p>
                    <a href="#devis-popup" class="althium-open-modal" style="font-size:13px; font-weight:700; color:var(--primary); margin-top:auto;">Consulter la note d'analyse →</a>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<?php get_footer(); ?>
