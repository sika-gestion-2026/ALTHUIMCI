<?php
/**
 * Single Post Template — ALTHIUM SARL
 * Affichage complet d'un article d'actualité ou d'analyse
 */
if (!defined('ABSPATH')) exit;

get_header();

while (have_posts()) : the_post();
    $thumb = get_the_post_thumbnail_url(get_the_ID(), 'full');
    $cats  = get_the_category();
    $cat   = !empty($cats) ? $cats[0]->name : 'Actualité ALTHIUM';
?>
<!-- HERO ARTICLE -->
<section style="background:linear-gradient(135deg, #092047 0%, #0C2E63 100%); color:#FFFFFF; padding:80px 0 50px;">
    <div class="container" style="max-width:900px; text-align:center;">
        <div style="margin-bottom:15px;">
            <span class="section-tag" style="color:#7DD3FC; background:rgba(255,255,255,0.1); padding:4px 12px; border-radius:4px; font-size:12px;">
                <?php echo esc_html($cat); ?>
            </span>
        </div>
        <h1 style="font-size:38px; font-weight:800; color:#FFFFFF; line-height:1.3; margin-bottom:16px;">
            <?php the_title(); ?>
        </h1>
        <div style="font-size:14px; color:#CBD5E1; display:flex; justify-content:center; gap:20px; flex-wrap:wrap;">
            <span>📅 <?php echo get_the_date('d F Y'); ?></span>
            <span>✍️ <?php echo esc_html(get_the_author()); ?></span>
        </div>
    </div>
</section>

<!-- CONTENU ARTICLE -->
<article class="section-padding" style="padding-top:50px;">
    <div class="container" style="max-width:850px;">
        <?php if ($thumb) : ?>
            <div style="border-radius:var(--radius-lg); overflow:hidden; margin-bottom:40px; box-shadow:var(--shadow-lg);">
                <img src="<?php echo esc_url($thumb); ?>" alt="<?php the_title_attribute(); ?>" style="width:100%; max-height:480px; object-fit:cover;">
            </div>
        <?php endif; ?>

        <div class="article-body" style="font-size:17px; line-height:1.85; color:var(--text);">
            <?php the_content(); ?>
        </div>

        <div style="margin-top:50px; padding-top:30px; border-top:1px solid var(--border); display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap; gap:20px;">
            <a href="<?php echo esc_url(home_url('/blog/')); ?>" class="btn btn-outline-white" style="color:var(--primary); border-color:var(--primary);">
                ← Retour à toutes les actualités
            </a>
            <a href="#devis-popup" class="btn btn-primary althium-open-modal">
                Échanger avec notre direction
            </a>
        </div>
    </div>
</article>

<?php
endwhile;

get_footer();
