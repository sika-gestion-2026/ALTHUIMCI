<?php
/**
 * Template Name: Page Contact & Accès
 */
if (!defined('ABSPATH')) exit;

get_header();
?>
<section style="background:linear-gradient(135deg, #092047 0%, #0C2E63 100%); color:#FFFFFF; padding:80px 0 60px;">
    <div class="container" style="text-align:center;">
        <span class="section-tag" style="color:#7DD3FC;">Contactez Nos Directeurs de Pôles</span>
        <h1 style="font-size:44px; color:#FFFFFF; margin-bottom:12px;">Contact &amp; Siège Social</h1>
        <p style="font-size:18px; color:#CBD5E1; max-width:650px; margin:0 auto;">
            Nos équipes vous répondent sous 24h ouvrées pour toute étude technique, transaction immobilière ou partenariat stratégique.
        </p>
    </div>
</section>

<section class="section-padding">
    <div class="container">
        <div style="display:grid; grid-template-columns:1fr 1.3fr; gap:50px; align-items:start;">
            <!-- Coordonnées Officielles -->
            <div>
                <span class="section-tag">Informations Officielles</span>
                <h2 class="section-title">ALTHIUM SARL</h2>
                <p style="color:var(--text-muted); margin-bottom:30px; font-size:15px; line-height:1.7;">
                    Société à Responsabilité Limitée pluridisciplinaire enregistrée en République de Côte d'Ivoire.
                </p>

                <?php 
                $c_phone1 = althium_get_option('phone_1', '+225 05 56 56 25 24');
                $c_phone2 = althium_get_option('phone_2', '+225 07 58 78 32 21');
                $c_email1 = althium_get_option('email_contact', 'contact@althium.ci');
                $c_email2 = althium_get_option('email_info', 'info@althium.ci');
                $c_addr   = althium_get_option('address', 'Abidjan, République de Côte d\'Ivoire');
                $c_wa     = althium_get_option('whatsapp_raw', '2250556562524');
                ?>
                <div style="display:flex; flex-direction:column; gap:20px;">
                    <div style="display:flex; gap:16px; align-items:flex-start;">
                        <div style="width:48px; height:48px; border-radius:10px; background:rgba(12,46,99,0.08); color:var(--primary); display:flex; align-items:center; justify-content:center; font-size:22px; flex-shrink:0;">📍</div>
                        <div>
                            <div style="font-family:var(--font-title); font-size:15px; font-weight:700; color:var(--primary);">Siège Social</div>
                            <div style="color:var(--text-muted); font-size:14px;"><?php echo esc_html($c_addr); ?></div>
                        </div>
                    </div>

                    <div style="display:flex; gap:16px; align-items:flex-start;">
                        <div style="width:48px; height:48px; border-radius:10px; background:rgba(12,46,99,0.08); color:var(--primary); display:flex; align-items:center; justify-content:center; font-size:22px; flex-shrink:0;">📞</div>
                        <div>
                            <div style="font-family:var(--font-title); font-size:15px; font-weight:700; color:var(--primary);">Téléphones Directs</div>
                            <div style="font-size:14px;"><a href="tel:<?php echo esc_attr(preg_replace('/[^0-9+]/', '', $c_phone1)); ?>" style="color:var(--primary); font-weight:600;"><?php echo esc_html($c_phone1); ?></a></div>
                            <?php if (!empty($c_phone2)) : ?>
                                <div style="font-size:14px;"><a href="tel:<?php echo esc_attr(preg_replace('/[^0-9+]/', '', $c_phone2)); ?>" style="color:var(--primary); font-weight:600;"><?php echo esc_html($c_phone2); ?></a></div>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div style="display:flex; gap:16px; align-items:flex-start;">
                        <div style="width:48px; height:48px; border-radius:10px; background:rgba(196,18,48,0.08); color:var(--accent); display:flex; align-items:center; justify-content:center; font-size:22px; flex-shrink:0;">✉️</div>
                        <div>
                            <div style="font-family:var(--font-title); font-size:15px; font-weight:700; color:var(--primary);">Courriels Officiels</div>
                            <div style="font-size:14px;"><a href="mailto:<?php echo esc_attr($c_email1); ?>" style="color:var(--accent); font-weight:600;"><?php echo esc_html($c_email1); ?></a></div>
                            <?php if (!empty($c_email2)) : ?>
                                <div style="font-size:14px;"><a href="mailto:<?php echo esc_attr($c_email2); ?>" style="color:var(--accent); font-weight:600;"><?php echo esc_html($c_email2); ?></a></div>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div style="display:flex; gap:16px; align-items:flex-start;">
                        <div style="width:48px; height:48px; border-radius:10px; background:rgba(37,211,102,0.12); color:#25D366; display:flex; align-items:center; justify-content:center; font-size:22px; flex-shrink:0;">💬</div>
                        <div>
                            <div style="font-family:var(--font-title); font-size:15px; font-weight:700; color:var(--primary);">WhatsApp Entreprise</div>
                            <div style="font-size:14px;"><a href="https://wa.me/<?php echo esc_attr(preg_replace('/[^0-9]/', '', $c_wa)); ?>?text=Bonjour%20Althium%20SARL" target="_blank" style="color:#25D366; font-weight:700;">Démarrer une conversation directe →</a></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Formulaire de contact -->
            <div style="background:#FFFFFF; border:1px solid var(--border); border-radius:var(--radius-lg); padding:36px; box-shadow:var(--shadow-md);">
                <h3 style="font-size:22px; margin-bottom:8px; color:var(--primary);">Transmettre une Demande Écrite</h3>
                <p style="font-size:13px; color:var(--text-muted); margin-bottom:24px;">Remplissez ce formulaire pour être orienté vers le directeur de pôle compétent.</p>

                <form method="post" action="<?php echo esc_url(admin_url('admin-post.php')); ?>">
                    <input type="hidden" name="action" value="althium_submit_quote">
                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Nom complet *</label>
                            <input type="text" name="quote_name" class="form-input" required placeholder="Votre nom">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Entreprise / Organisation</label>
                            <input type="text" name="quote_company" class="form-input" placeholder="Ex: Société AXIS">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Téléphone direct *</label>
                            <input type="tel" name="quote_phone" class="form-input" required placeholder="+225 ...">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Email professionnel *</label>
                            <input type="email" name="quote_email" class="form-input" required placeholder="nom@entreprise.ci">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Pôle d'activité concerné *</label>
                        <select name="quote_sector" class="form-select" required>
                            <option value="">Sélectionnez un secteur...</option>
                            <option value="BTP">1. BTP &amp; Travaux Publics</option>
                            <option value="Immobilier">2. Immobilier (Transactions, Gestion, Promotion)</option>
                            <option value="Conseil-IE">3. Conseils en Gestion &amp; Intelligence Économique</option>
                            <option value="Marketing-Sportif">4. Marketing Sportif (Sponsoring &amp; Événements)</option>
                            <option value="Formations">5. Formations Professionnelles</option>
                            <option value="Import-Export">6. Import-Export &amp; Négoce International</option>
                            <option value="Multidisciplinaire">Projet transverse multidisciplinaire</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Description détaillée de votre projet *</label>
                        <textarea name="quote_message" class="form-textarea" rows="4" required placeholder="Décrivez votre besoin, les délais envisagés et toute spécification utile..."></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary" style="width:100%; padding:14px; font-size:15px;">
                        Transmettre le dossier à contact@althium.ci
                    </button>
                </form>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>
