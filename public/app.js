/**
 * Script Interactif V3 Pro — ALTHIUM SARL Prototype Officiel
 * Coordonnées : contact@althium.ci / info@althium.ci | +225 05 56 56 25 24 / +225 07 58 78 32 21
 * Gère le Hero Switcher Multi-Activités, les compteurs dynamiques,
 * les filtres temps réel, le popup de devis, le convertisseur de devises et l'automatisation WhatsApp.
 */

document.addEventListener('DOMContentLoaded', () => {

  // 0. MENU MOBILE RESPONSIVE (AFFICHER / MASQUER PAR BOUTON BURGER)
  const burgerBtn = document.getElementById('burgerBtn');
  const mainNav = document.getElementById('mainNav');

  if (burgerBtn && mainNav) {
    burgerBtn.addEventListener('click', (e) => {
      e.stopPropagation();
      const isOpen = mainNav.classList.toggle('open');
      burgerBtn.classList.toggle('active', isOpen);
      burgerBtn.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
    });

    // Fermer le menu au clic sur un lien
    mainNav.querySelectorAll('a').forEach(link => {
      link.addEventListener('click', () => {
        mainNav.classList.remove('open');
        burgerBtn.classList.remove('active');
        burgerBtn.setAttribute('aria-expanded', 'false');
      });
    });

    // Fermer le menu si on clique en dehors
    document.addEventListener('click', (e) => {
      if (!mainNav.contains(e.target) && !burgerBtn.contains(e.target)) {
        mainNav.classList.remove('open');
        burgerBtn.classList.remove('active');
        burgerBtn.setAttribute('aria-expanded', 'false');
      }
    });

    // Fermer avec la touche Echap
    document.addEventListener('keydown', (e) => {
      if (e.key === 'Escape' && mainNav.classList.contains('open')) {
        mainNav.classList.remove('open');
        burgerBtn.classList.remove('active');
        burgerBtn.setAttribute('aria-expanded', 'false');
      }
    });
  }

  // 1. HERO MULTI-ACTIVITÉS INTERACTIF
  const heroTabs = document.querySelectorAll('.switch-tab');
  const heroDisplayTag = document.getElementById('switchTag');
  const heroDisplayTitle = document.getElementById('switchTitle');
  const heroDisplayDesc = document.getElementById('switchDesc');
  const heroDisplayLink = document.getElementById('switchLink');

  const sectorData = {
    btp: {
      tag: "Pôle 01 • Génie Civil & Gros Œuvre",
      title: "Bâtiment et Travaux Publics (BTP)",
      desc: "Études de faisabilité, conception architecturale, maîtrise d'œuvre et réalisation d'infrastructures résidentielles, commerciales et industrielles certifiées.",
      link: "metier-single.html?metier=btp"
    },
    immo: {
      tag: "Pôle 02 • Marché & Investissement",
      title: "Immobilier & Promotion",
      desc: "Transactions (achat/vente/location), gestion locative, promotion immobilière et conseil en investissement patrimonial sécurisé en Côte d'Ivoire.",
      link: "metier-single.html?metier=immo"
    },
    conseil: {
      tag: "Pôle 03 • Stratégie & Décision",
      title: "Conseil en Gestion & Intelligence Éco.",
      desc: "Veille stratégique (concurrentielle, réglementaire), analyse de marché, sécurité économique du patrimoine immatériel et optimisation des processus.",
      link: "metier-single.html?metier=conseil"
    },
    sport: {
      tag: "Pôle 04 • Valorisation & Événementiel",
      title: "Marketing Sportif",
      desc: "Recherche et gestion de sponsoring, organisation d'événements sportifs d'envergure, gestion d'image d'athlètes et développement de partenariats de marques.",
      link: "metier-single.html?metier=sport"
    },
    formation: {
      tag: "Pôle 05 • Transfert de Compétences",
      title: "Formations Professionnelles",
      desc: "Catalogue certifiant sur mesure et inter-entreprises : gestion de projets BTP, stratégies immobilières, méthodologie de l'IE et management opérationnel.",
      link: "metier-single.html?metier=formation"
    },
    import: {
      tag: "Pôle 06 • Commerce International",
      title: "Import-Export & Négoce",
      desc: "Sourcing international de matières premières et équipements, logistique multimodale, gestion de supply chain et conseil en réglementation douanière.",
      link: "metier-single.html?metier=import"
    }
  };

  if (heroTabs.length > 0) {
    heroTabs.forEach(tab => {
      tab.addEventListener('click', () => {
        heroTabs.forEach(t => t.classList.remove('active'));
        tab.classList.add('active');
        const key = tab.getAttribute('data-sector');
        const data = sectorData[key];
        if (data) {
          if (heroDisplayTag) heroDisplayTag.textContent = data.tag;
          if (heroDisplayTitle) heroDisplayTitle.textContent = data.title;
          if (heroDisplayDesc) heroDisplayDesc.textContent = data.desc;
          if (heroDisplayLink) heroDisplayLink.setAttribute('href', data.link);
        }
      });
    });
  }

  // 2. ANIMATION DES COMPTEURS AU SCROLL
  const counters = document.querySelectorAll('.counter-number');
  let animated = false;

  const animateCounters = () => {
    counters.forEach(counter => {
      const target = parseFloat(counter.getAttribute('data-target'));
      const isPercent = counter.getAttribute('data-percent') === 'true';
      const isPlus = counter.getAttribute('data-plus') === 'true';
      const duration = 1800;
      const stepTime = 20;
      const totalSteps = duration / stepTime;
      const increment = target / totalSteps;
      let current = 0;

      const timer = setInterval(() => {
        current += increment;
        if (current >= target) {
          current = target;
          clearInterval(timer);
        }
        
        let displayVal = isPercent ? current.toFixed(1) : Math.floor(current);
        if (isPlus) displayVal += '+';
        if (isPercent) displayVal += '%';
        
        counter.textContent = displayVal;
      }, stepTime);
    });
  };

  const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting && !animated) {
        animated = true;
        animateCounters();
      }
    });
  }, { threshold: 0.3 });

  const counterSection = document.querySelector('.counters-strip');
  if (counterSection) observer.observe(counterSection);

  // 3. GESTION DU POPUP DE DEVIS EXPRESS & EXIT-INTENT
  const modalOverlay = document.getElementById('devisModal');
  const modalClose = document.getElementById('modalClose');
  const openModalBtns = document.querySelectorAll('[data-open-modal]');
  let exitIntentTriggered = false;

  const openModal = () => {
    if (modalOverlay) {
      modalOverlay.classList.add('active');
      document.body.style.overflow = 'hidden';
    }
  };

  const closeModal = () => {
    if (modalOverlay) {
      modalOverlay.classList.remove('active');
      document.body.style.overflow = '';
    }
  };

  openModalBtns.forEach(btn => {
    btn.addEventListener('click', (e) => {
      e.preventDefault();
      openModal();
    });
  });

  if (modalClose) modalClose.addEventListener('click', closeModal);

  if (modalOverlay) {
    modalOverlay.addEventListener('click', (e) => {
      if (e.target === modalOverlay) closeModal();
    });
  }

  document.addEventListener('mouseleave', (e) => {
    if (e.clientY <= 0 && !exitIntentTriggered) {
      exitIntentTriggered = true;
      openModal();
    }
  });

  // 4. FILTRAGE EN TEMPS RÉEL DES RÉALISATIONS
  const filterPills = document.querySelectorAll('.pill-btn');
  const projectCards = document.querySelectorAll('.real-card');
  const searchInput = document.getElementById('projectSearch');

  let activeCategory = 'all';
  let searchTerm = '';

  const applyFilters = () => {
    projectCards.forEach(card => {
      const category = card.getAttribute('data-category');
      const title = card.querySelector('.real-title') ? card.querySelector('.real-title').textContent.toLowerCase() : '';
      const desc = card.querySelector('.real-desc') ? card.querySelector('.real-desc').textContent.toLowerCase() : '';

      const matchCategory = (activeCategory === 'all' || category === activeCategory);
      const matchSearch = (title.includes(searchTerm) || desc.includes(searchTerm));

      if (matchCategory && matchSearch) {
        card.style.display = 'flex';
      } else {
        card.style.display = 'none';
      }
    });
  };

  filterPills.forEach(pill => {
    pill.addEventListener('click', () => {
      filterPills.forEach(p => p.classList.remove('active'));
      pill.classList.add('active');
      activeCategory = pill.getAttribute('data-filter');
      applyFilters();
    });
  });

  if (searchInput) {
    searchInput.addEventListener('input', (e) => {
      searchTerm = e.target.value.toLowerCase().trim();
      applyFilters();
    });
  }

  // 5. AUTOMATISATION DU DEVIS WHATSAPP INTELLIGENT
  const btnWaQuote = document.getElementById('btnSubmitWa');
  if (btnWaQuote) {
    btnWaQuote.addEventListener('click', () => {
      const name = document.getElementById('quoteName') ? document.getElementById('quoteName').value.trim() : '';
      const sector = document.getElementById('quoteSector') ? document.getElementById('quoteSector').value : 'Général';
      const msgText = document.getElementById('quoteMessage') ? document.getElementById('quoteMessage').value.trim() : '';
      
      let text = "Bonjour ALTHIUM SARL, je vous contacte depuis le site officiel.\n";
      if (name) text += "• Nom / Société : " + name + "\n";
      text += "• Pôle concerné : " + sector + "\n";
      if (msgText) text += "• Projet : " + msgText + "\n";
      text += "Merci de me recontacter pour un devis.";

      const url = "https://wa.me/2250556562524?text=" + encodeURIComponent(text);
      window.open(url, '_blank');
    });
  }

  // 6. SOUMISSION DU FORMULAIRE DE DEVIS
  const quoteForm = document.getElementById('quoteForm');
  const formSuccess = document.getElementById('formSuccess');

  if (quoteForm) {
    quoteForm.addEventListener('submit', (e) => {
      e.preventDefault();
      quoteForm.style.display = 'none';
      if (formSuccess) formSuccess.style.display = 'block';

      setTimeout(() => {
        closeModal();
        setTimeout(() => {
          quoteForm.reset();
          quoteForm.style.display = 'block';
          if (formSuccess) formSuccess.style.display = 'none';
        }, 500);
      }, 2500);
    });
  }

  // 7. SÉLECTEUR DE DEVISE (FCFA XOF / EUR €)
  const currencyBtns = document.querySelectorAll('[data-currency]');
  if (currencyBtns.length > 0) {
    currencyBtns.forEach(btn => {
      btn.addEventListener('click', () => {
        const cur = btn.getAttribute('data-currency');
        currencyBtns.forEach(b => b.classList.remove('active'));
        btn.classList.add('active');
        document.querySelectorAll('.price-xof').forEach(el => el.style.display = (cur === 'xof' ? 'inline' : 'none'));
        document.querySelectorAll('.price-eur').forEach(el => el.style.display = (cur === 'eur' ? 'inline' : 'none'));
      });
    });
  }

});
