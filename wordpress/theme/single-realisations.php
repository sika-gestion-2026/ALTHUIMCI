<?php
/**
 * Single Réalisations Template — ALTHIUM SARL
 * Affichage complet d'un projet ou cas d'étude
 */
if (!defined('ABSPATH')) exit;

get_header();

while (have_posts()) : the_post();
    $rid    = get_the_ID();
    $thumb  = get_the_post_thumbnail_url($rid, 'full');
    $sector = get_post_meta($rid, 'real_sector', true) ?: 'btp';
    $kpi    = get_post_meta($rid, 'real_kpi', true) ?: 'Projet Réalisé';

    $sector_configs = [
        'btp'       => ['BTP & Travaux Publics', '#0C2E63'],
        'immo'      => ['Immobilier & Foncier', '#0891B2'],
        'conseil'   => ['Conseil & Intelligence Économique', '#0F172A'],
        'sport'     => ['Marketing Sportif & Sponsoring', '#E11D48'],
        'formation' => ['Formations Professionnelles', '#2E8B57'],
        'import'    => ['Import-Export & Négoce International', '#D97706'],
    ];
    $cfg = $sector_configs[$sector] ?? ['Réalisation ALTHIUM', '#0C2E63'];
?>
<!-- HERO PROJET -->
<section style="background:linear-gradient(135deg, #092047 0%, <?php echo esc_attr($cfg[1]); ?> 100%); color:#FFFFFF; padding:80px 0 50px;">
    <div class="container" style="max-width:900px; text-align:center;">
        <div style="margin-bottom:14px;">
            <span class="section-tag" style="color:#7DD3FC; background:rgba(255,255,255,0.12); padding:5px 14px; border-radius:4px; font-size:12px;">
                <?php echo esc_html($cfg[0]); ?>
            </span>
        </div>
        <h1 style="font-size:40px; font-weight:800; color:#FFFFFF; line-height:1.3; margin-bottom:16px;">
            <?php the_title(); ?>
        </h1>
        <div style="display:inline-flex; align-items:center; gap:10px; background:rgba(255,255,255,0.15); padding:8px 18px; border-radius:20px; font-size:14px; font-weight:700; color:#38BDF8;">
            <span>⚡ Chiffre Clé :</span>
            <span><?php echo esc_html($kpi); ?></span>
        </div>
    </div>
</section>

<!-- CONTENU DU PROJET -->
<article class="section-padding" style="padding-top:50px;">
    <div class="container" style="max-width:900px;">
        <?php if ($thumb) : ?>
            <div style="border-radius:var(--radius-lg); overflow:hidden; margin-bottom:40px; box-shadow:var(--shadow-lg);">
                <img src="<?php echo esc_url($thumb); ?>" alt="<?php the_title_attribute(); ?>" style="width:100%; max-height:500px; object-fit:cover;">
            </div>
        <?php endif; ?>

        <div class="article-body" style="font-size:17px; line-height:1.85; color:var(--text);">
            <?php the_content(); ?>
        </div>

        <div style="margin-top:50px; padding:30px; background:var(--bg-light); border-radius:var(--radius-md); display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap; gap:20px;">
            <div>
                <div style="font-size:16px; font-weight:800; color:var(--primary);">Vous avez un projet similaire ?</div>
                <div style="font-size:14px; color:var(--text-muted);">Nos directeurs de pôles réalisent une étude technique sous 24h.</div>
            </div>
            <div style="display:flex; gap:12px; flex-wrap:wrap;">
                <a href="<?php echo esc_url(home_url('/realisations/')); ?>" class="btn btn-outline-white" style="color:var(--primary); border-color:var(--primary);">
                    ← Toutes les réalisations
                </a>
                <a href="#devis-popup" class="btn btn-primary althium-open-modal">
                    Demander une étude
                </a>
            </div>
        </div>
    </div>
</article>

<?php
endwhile;

get_footer();
