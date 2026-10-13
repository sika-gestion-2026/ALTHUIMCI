<?php
/**
 * Footer Template — ALTHIUM SARL
 * Avec Grand Logo valorisé en bas et Coordonnées Côte d'Ivoire
 */
if (!defined('ABSPATH')) exit;
?>

<!-- ==================== GRAND LOGO & FOOTER EN BAS ==================== -->
<footer class="site-footer">
    <div class="container">
        
        <!-- ENCART DU GRAND LOGO ALTHIUM EN BAS -->
        <div class="footer-brand-banner">
            <div class="footer-logo-container">
                <img src="<?php echo get_stylesheet_directory_uri() . '/assets/logo/logo-althium.png'; ?>" alt="ALTHIUM SARL — Grand Logo" style="height:64px; max-height:64px; width:auto; object-fit:contain; margin:0 auto; display:block;">
            </div>
            <div class="footer-tagline-highlight">
                <?php echo esc_html(althium_get_option('slogan', '« LA FORCE D\'UN PROFESSIONNEL »')); ?>
            </div>
            <p style="color:#CBD5E1; font-size:14px; max-width:650px; margin:10px auto 0; line-height:1.6;">
                <?php echo esc_html(althium_get_option('footer_desc', 'Entreprise multidisciplinaire d\'excellence : BTP, Immobilier, Conseil en Gestion & Intelligence Économique, Marketing Sportif, Formations et Import-Export.')); ?>
            </p>
        </div>

        <div class="footer-grid">
            <!-- Col 1 : Siège & Coordonnées -->
            <div>
                <?php 
                $f_phone1 = althium_get_option('phone_1', '+225 05 56 56 25 24');
                $f_phone2 = althium_get_option('phone_2', '+225 07 58 78 32 21');
                $f_email1 = althium_get_option('email_contact', 'contact@althium.ci');
                $f_email2 = althium_get_option('email_info', 'info@althium.ci');
                $f_addr   = althium_get_option('address', 'Abidjan, République de Côte d\'Ivoire');
                $f_hours  = althium_get_option('hours', "Bureaux ouverts du Lundi au Vendredi de 8h00 à 18h00.\nAstreinte chantiers & urgences 24h/24 et 7j/7.");
                ?>
                <div class="footer-col-title">Siège &amp; Coordonnées</div>
                <div class="footer-contact-item">
                    <span>📍</span>
                    <span><?php echo esc_html($f_addr); ?></span>
                </div>
                <div class="footer-contact-item">
                    <span>📞</span>
                    <a href="tel:<?php echo esc_attr(preg_replace('/[^0-9+]/', '', $f_phone1)); ?>"><?php echo esc_html($f_phone1); ?></a>
                </div>
                <?php if (!empty($f_phone2)) : ?>
                <div class="footer-contact-item">
                    <span>📞</span>
                    <a href="tel:<?php echo esc_attr(preg_replace('/[^0-9+]/', '', $f_phone2)); ?>"><?php echo esc_html($f_phone2); ?></a>
                </div>
                <?php endif; ?>
                <div class="footer-contact-item">
                    <span>✉️</span>
                    <a href="mailto:<?php echo esc_attr($f_email1); ?>"><?php echo esc_html($f_email1); ?></a>
                </div>
                <?php if (!empty($f_email2)) : ?>
                <div class="footer-contact-item">
                    <span>✉️</span>
                    <a href="mailto:<?php echo esc_attr($f_email2); ?>"><?php echo esc_html($f_email2); ?></a>
                </div>
                <?php endif; ?>
            </div>

            <!-- Col 2 : Les 6 Pôles d'Activité -->
            <div>
                <div class="footer-col-title">Nos 6 Métiers</div>
                <ul class="footer-links">
                    <li><a href="<?php echo esc_url(home_url('/metiers/btp-construction/')); ?>">1. BTP &amp; Travaux Publics</a></li>
                    <li><a href="<?php echo esc_url(home_url('/metiers/immobilier/')); ?>">2. Immobilier</a></li>
                    <li><a href="<?php echo esc_url(home_url('/metiers/conseil-intelligence-economique/')); ?>">3. Conseil &amp; Intelligence Éco.</a></li>
                    <li><a href="<?php echo esc_url(home_url('/metiers/marketing-sportif/')); ?>">4. Marketing Sportif</a></li>
                    <li><a href="<?php echo esc_url(home_url('/metiers/formations/')); ?>">5. Formations Professionnelles</a></li>
                    <li><a href="<?php echo esc_url(home_url('/metiers/import-export/')); ?>">6. Import-Export &amp; Négoce</a></li>
                </ul>
            </div>

            <!-- Col 3 : Navigation -->
            <div>
                <div class="footer-col-title">Société &amp; Légal</div>
                <ul class="footer-links">
                    <li><a href="<?php echo esc_url(home_url('/')); ?>">Accueil</a></li>
                    <li><a href="<?php echo esc_url(home_url('/a-propos/')); ?>">À Propos d'Althium</a></li>
                    <li><a href="<?php echo esc_url(home_url('/realisations/')); ?>">Réalisations &amp; Cas d'étude</a></li>
                    <li><a href="<?php echo esc_url(home_url('/blog/')); ?>">Actualités &amp; Blog</a></li>
                    <li><a href="<?php echo esc_url(home_url('/contact/')); ?>">Contact &amp; Accès</a></li>
                    <li><a href="<?php echo esc_url(home_url('/mentions-legales/')); ?>">Mentions Légales &amp; RGPD</a></li>
                </ul>
            </div>

            <!-- Col 4 : Astreinte & Devis -->
            <div>
                <div class="footer-col-title">Disponibilité Opérationnelle</div>
                <p style="font-size:14px; line-height:1.6; margin-bottom:16px; color:#CBD5E1;">
                    <?php echo nl2br(esc_html($f_hours)); ?>
                </p>
                <a href="#devis-popup" class="btn btn-secondary althium-open-modal" style="width:100%; padding:10px 14px; font-size:13px;">
                    Demande de devis prioritaire
                </a>
            </div>
        </div>

        <div class="footer-bottom">
            <div>© <?php echo date('Y'); ?> ALTHIUM SARL. Tous droits réservés. RCCM Côte d'Ivoire.</div>
            <?php althium_render_creator_credit(); ?>
        </div>
    </div>
</footer>

<!-- MODAL POPUP DE DEVIS EXPRESS (EXIT-INTENT) -->
<div class="modal-overlay" id="devisModal">
    <div class="modal-card">
        <button type="button" class="modal-close" id="modalClose" aria-label="Fermer">✕</button>
        <div style="font-size:12px; font-weight:800; color:var(--accent); text-transform:uppercase; margin-bottom:6px; letter-spacing:0.5px;">
            ÉTUDE TECHNIQUE PRIORITAIRE — RÉPONSE SOUS 24H
        </div>
        <h3 style="font-size:24px; margin-bottom:18px; color:var(--primary);">Demandez votre devis ALTHIUM SARL</h3>

        <form id="quoteForm" method="post" action="<?php echo esc_url(admin_url('admin-post.php')); ?>">
            <input type="hidden" name="action" value="althium_submit_quote">
            <div class="form-group">
                <label class="form-label">Nom complet / Entreprise *</label>
                <input type="text" name="quote_name" class="form-input" required placeholder="Ex: Marc KOUASSI / Société AXIS">
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Téléphone direct *</label>
                    <input type="tel" name="quote_phone" class="form-input" required placeholder="+225 05 56 56 25 24">
                </div>
                <div class="form-group">
                    <label class="form-label">Email professionnel *</label>
                    <input type="email" name="quote_email" class="form-input" required placeholder="contact@entreprise.ci">
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">Pôle d'activité concerné *</label>
                <select name="quote_sector" class="form-select" required>
                    <option value="">Sélectionnez un secteur...</option>
                    <option value="BTP">1. Bâtiment et Travaux Publics (BTP)</option>
                    <option value="Immobilier">2. Immobilier (Transactions, Gestion, Promotion)</option>
                    <option value="Conseil-IE">3. Conseils en Gestion &amp; Intelligence Économique</option>
                    <option value="Marketing-Sportif">4. Marketing Sportif (Sponsoring &amp; Événements)</option>
                    <option value="Formations">5. Formations Professionnelles Certifiantes</option>
                    <option value="Import-Export">6. Import-Export &amp; Négoce International</option>
                    <option value="Multidisciplinaire">Projet transverse multidisciplinaire</option>
                </select>
            </div>

            <div class="form-group">
                <label class="form-label">Détails de votre besoin ou projet</label>
                <textarea name="quote_message" class="form-textarea" rows="3" placeholder="Précisez la nature de l'opération, les délais et la localisation..."></textarea>
            </div>

            <button type="submit" class="btn btn-primary" style="width:100%; padding:14px;">
                Transmettre à contact@althium.ci
            </button>
        </form>
    </div>
</div>

<!-- BOUTON WHATSAPP FLOTTANT CÔTE D'IVOIRE -->
<a href="https://wa.me/<?php echo esc_attr(althium_get_option('whatsapp_raw', '2250556562524')); ?>?text=Bonjour%20Althium%20SARL" class="althium-whatsapp-float" target="_blank" rel="noopener noreferrer" aria-label="Contacter ALTHIUM sur WhatsApp">
    <svg width="30" height="30" viewBox="0 0 24 24" fill="currentColor"><path d="M12.031 6.172c-3.181 0-5.767 2.586-5.768 5.766-.001 1.298.38 2.27 1.019 3.287l-.582 2.128 2.182-.573c.978.58 1.911.928 3.145.929 3.178 0 5.767-2.587 5.768-5.766.001-3.187-2.575-5.77-5.764-5.771zm3.392 8.244c-.144.405-.837.774-1.17.824-.299.045-.677.063-1.092-.069-.252-.08-.575-.187-.988-.365-1.739-.751-2.874-2.502-2.961-2.617-.087-.116-.708-.94-.708-1.793s.448-1.273.607-1.446c.159-.173.346-.217.462-.217l.332.006c.106.005.249-.04.39.298.144.347.491 1.2.534 1.287.043.087.072.188.014.304-.058.116-.087.188-.173.289l-.26.304c-.087.086-.177.18-.076.354.101.174.449.741.964 1.201.662.591 1.221.774 1.394.86s.275.072.376-.043c.101-.116.433-.506.549-.68.116-.173.231-.145.39-.087s1.011.477 1.184.564.289.13.332.202c.045.072.045.419-.099.824z"/></svg>
</a>

<?php wp_footer(); ?>
</body>
</html>
