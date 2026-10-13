<?php
/**
 * Template Name: Page À Propos ALTHIUM
 */
if (!defined('ABSPATH')) exit;

get_header();
?>
<section style="background:linear-gradient(135deg, #092047 0%, #0C2E63 100%); color:#FFF; padding:80px 0 60px;">
    <div class="container text-center" style="text-align:center;">
        <span class="section-tag" style="color:#7DD3FC;">QUI SOMMES-NOUS ?</span>
        <h1 style="font-size:44px; font-weight:800; color:#FFFFFF; margin-bottom:14px;">À Propos d'ALTHIUM SARL</h1>
        <p style="font-size:18px; color:#CBD5E1; max-width:700px; margin:0 auto;">
            Notre genèse, notre vision multidisciplinaire intégrée et les équipes qui incarnent l'excellence au quotidien en Côte d'Ivoire.
        </p>
    </div>
</section>

<section class="section-padding">
    <div class="container">
        <div style="display:grid; grid-template-columns:1.1fr 0.9fr; gap:50px; align-items:center;">
            <div>
                <span class="section-tag">Notre Histoire &amp; Vision</span>
                <h2 class="section-title">Une Genèse Guidée par la Rigueur et la Synergie</h2>
                <p style="font-size:16px; color:var(--text); line-height:1.7; margin-bottom:16px;">
                    Fondée avec la volonté de répondre aux défis complexes des entreprises et investisseurs en Afrique de l'Ouest, <strong>ALTHIUM SARL</strong> est née d'un constat fort : la performance d'un projet d'envergure repose sur la synchronisation parfaite entre la technique sur le terrain et la stratégie décisionnelle.
                </p>
                <p style="font-size:15px; color:var(--text-muted); line-height:1.7; margin-bottom:20px;">
                    En réunissant sous un même pavillon le <strong>BTP</strong>, <strong>l'Immobilier</strong>, le <strong>Conseil en Gestion &amp; Intelligence Économique</strong>, le <strong>Marketing Sportif</strong>, la <strong>Formation</strong> et <strong>l'Import-Export</strong>, Althium propose une vision transversale complète.
                </p>
                <div style="display:flex; gap:16px;">
                    <a href="#devis-popup" class="btn btn-primary althium-open-modal">Rencontrer notre direction</a>
                </div>
            </div>
            <div style="border-radius:var(--radius-lg); overflow:hidden; box-shadow:var(--shadow-lg);">
                <img src="https://images.unsplash.com/photo-1522071820081-009f0129c71c?auto=format&fit=crop&w=800&q=80" alt="Équipe Althium" style="width:100%; aspect-ratio:4/3; object-fit:cover;">
            </div>
        </div>
    </div>
</section>

<!-- VALEURS -->
<section class="section-padding section-bg-light">
    <div class="container">
        <div class="section-header">
            <span class="section-tag">Nos Principes Directeurs</span>
            <h2 class="section-title">Les 4 Piliers Fondamentaux d'Althium</h2>
        </div>

        <div class="why-grid">
            <div class="why-card">
                <div class="why-icon">🛡️</div>
                <h3 class="why-card-title">Intégrité &amp; Éthique</h3>
                <p class="why-card-desc">Transparence contractuelle intégrale, traçabilité foncière certifiée et respect rigoureux de nos engagements.</p>
            </div>
            <div class="why-card">
                <div class="why-icon accent">⚡</div>
                <h3 class="why-card-title">Agilité Opérationnelle</h3>
                <p class="why-card-desc">Capacité de déploiement d'équipes d'experts pluridisciplinaires en 48h partout en Côte d'Ivoire.</p>
            </div>
            <div class="why-card">
                <div class="why-icon">🎯</div>
                <h3 class="why-card-title">Orientation Résultats</h3>
                <p class="why-card-desc">Chaque mission est adossée à des indicateurs de performance clairs et un suivi d'astreinte 24h/24.</p>
            </div>
            <div class="why-card">
                <div class="why-icon accent">🌍</div>
                <h3 class="why-card-title">Portée Régionale</h3>
                <p class="why-card-desc">Une maîtrise parfaite des écosystèmes économiques et douaniers de l'espace UEMOA et international.</p>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>
