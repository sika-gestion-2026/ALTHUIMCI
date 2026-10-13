/**
 * Script Principal ALTHIUM SARL — Version 3.0.0
 * Gère le Hero Switcher, les compteurs, le Before/After Slider, le filtrage et le modal
 */
document.addEventListener('DOMContentLoaded', function() {

  // 1. HERO SWITCHER (COMMUTATION DES 6 PÔLES)
  const heroTabs = document.querySelectorAll('.switch-tab');
  const heroDisplayTag = document.getElementById('switchTag');
  const heroDisplayTitle = document.getElementById('switchTitle');
  const heroDisplayDesc = document.getElementById('switchDesc');
  const heroDisplayLink = document.getElementById('switchLink');

  const sectorData = {
    btp: {
      tag: "Pôle 01 • Génie Civil & Gros Œuvre",
      title: "Bâtiment et Travaux Publics (BTP)",
      desc: "Études de faisabilité, conception architecturale, maîtrise d'œuvre et réalisation d'infrastructures certifiées en Côte d'Ivoire.",
      link: "/metiers/btp-construction/"
    },
    immo: {
      tag: "Pôle 02 • Marché & Investissement",
      title: "Immobilier & Promotion",
      desc: "Transactions sécurisées, gestion locative premium, promotion immobilière et conseil patrimonial à Abidjan et en région.",
      link: "/metiers/immobilier/"
    },
    conseil: {
      tag: "Pôle 03 • Stratégie & Décision",
      title: "Conseil en Gestion & Intelligence Économique",
      desc: "Veille stratégique concurrentielle, analyse de marché, due diligence et sécurisation économique de vos investissements.",
      link: "/metiers/conseil-intelligence-economique/"
    },
    sport: {
      tag: "Pôle 04 • Valorisation & Événementiel",
      title: "Marketing Sportif & Sponsoring",
      desc: "Recherche de partenaires, organisation de tournois majeurs, gestion d'image d'athlètes et activation de marques.",
      link: "/metiers/marketing-sportif/"
    },
    formation: {
      tag: "Pôle 05 • Transfert de Compétences",
      title: "Formations Professionnelles Certifiantes",
      desc: "Cycles certifiants en gestion de projet BTP, management QHSE, transactions immobilières et leadership opérationnel.",
      link: "/metiers/formations/"
    },
    import: {
      tag: "Pôle 06 • Commerce International",
      title: "Import-Export & Négoce International",
      desc: "Sourcing international de matériaux certifiés, logistique multimodale, supply chain et conformité douanière.",
      link: "/metiers/import-export/"
    }
  };

  if (heroTabs.length > 0) {
    heroTabs.forEach(tab => {
      tab.addEventListener('click', function() {
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

  // 2. COMPTEURS ANIMÉS AU SCROLL
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

  const counterSection = document.querySelector('.counters-strip');
  if (counterSection && 'IntersectionObserver' in window) {
    const observer = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        if (entry.isIntersecting && !animated) {
          animated = true;
          animateCounters();
        }
      });
    }, { threshold: 0.3 });
    observer.observe(counterSection);
  } else if (counters.length > 0) {
    animateCounters();
  }

  // 3. BEFORE / AFTER INTERACTIVE SLIDER
  const baContainers = document.querySelectorAll('.ba-slider-container');
  baContainers.forEach(container => {
    const afterWrapper = container.querySelector('.ba-after-wrapper');
    const handle = container.querySelector('.ba-handle');
    let isDown = false;

    const setPosition = (x) => {
      const rect = container.getBoundingClientRect();
      let pos = (x - rect.left) / rect.width;
      if (pos < 0.05) pos = 0.05;
      if (pos > 0.95) pos = 0.95;
      const pct = (pos * 100) + '%';
      if (afterWrapper) afterWrapper.style.width = pct;
      if (handle) handle.style.left = pct;
    };

    container.addEventListener('mousedown', (e) => { isDown = true; setPosition(e.clientX); });
    window.addEventListener('mouseup', () => { isDown = false; });
    container.addEventListener('mousemove', (e) => { if (isDown) setPosition(e.clientX); });

    container.addEventListener('touchstart', (e) => { isDown = true; setPosition(e.touches[0].clientX); });
    window.addEventListener('touchend', () => { isDown = false; });
    container.addEventListener('touchmove', (e) => { if (isDown) setPosition(e.touches[0].clientX); });
  });

  // 4. FILTRAGE EN TEMPS RÉEL DU PORTEFEUILLE
  const filterPills = document.querySelectorAll('.pill-btn');
  const projectCards = document.querySelectorAll('.real-card[data-category]');

  filterPills.forEach(pill => {
    pill.addEventListener('click', () => {
      filterPills.forEach(p => p.classList.remove('active'));
      pill.classList.add('active');
      const cat = pill.getAttribute('data-filter');

      projectCards.forEach(card => {
        const cardCat = card.getAttribute('data-category');
        if (cat === 'all' || cardCat === cat) {
          card.style.display = 'flex';
        } else {
          card.style.display = 'none';
        }
      });
    });
  });

  // 5. MODAL DE DEVIS EXPRESS & EXIT-INTENT
  const modal = document.getElementById('devisModal');
  const closeBtn = document.getElementById('modalClose');
  const openBtns = document.querySelectorAll('.althium-open-modal, [data-open-modal], a[href="#devis-popup"]');

  openBtns.forEach(btn => {
    btn.addEventListener('click', (e) => {
      e.preventDefault();
      if (modal) {
        modal.classList.add('active');
        document.body.style.overflow = 'hidden';
      }
    });
  });

  if (closeBtn && modal) {
    closeBtn.addEventListener('click', () => {
      modal.classList.remove('active');
      document.body.style.overflow = '';
    });
  }

  if (modal) {
    modal.addEventListener('click', (e) => {
      if (e.target === modal) {
        modal.classList.remove('active');
        document.body.style.overflow = '';
      }
    });
  }

  // 6. GESTION DU MENU MOBILE DRAWER (OFF-CANVAS)
  const menuToggle = document.getElementById('mobileMenuToggle');
  const mobileDrawer = document.getElementById('mobileDrawer');
  const drawerOverlay = document.getElementById('mobileDrawerOverlay');
  const drawerClose = document.getElementById('mobileDrawerClose');

  function openMobileDrawer() {
    if (mobileDrawer && drawerOverlay) {
      mobileDrawer.classList.add('active');
      drawerOverlay.classList.add('active');
      if (menuToggle) menuToggle.classList.add('active');
      document.body.style.overflow = 'hidden';
    }
  }

  function closeMobileDrawer() {
    if (mobileDrawer && drawerOverlay) {
      mobileDrawer.classList.remove('active');
      drawerOverlay.classList.remove('active');
      if (menuToggle) menuToggle.classList.remove('active');
      document.body.style.overflow = '';
    }
  }

  if (menuToggle) menuToggle.addEventListener('click', openMobileDrawer);
  if (drawerClose) drawerClose.addEventListener('click', closeMobileDrawer);
  if (drawerOverlay) drawerOverlay.addEventListener('click', closeMobileDrawer);

  document.querySelectorAll('.mobile-nav-link, .mobile-metier-tag, .mobile-drawer .althium-open-modal').forEach(link => {
    link.addEventListener('click', () => {
      closeMobileDrawer();
    });
  });

  document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape') {
      closeMobileDrawer();
      if (modal) {
        modal.classList.remove('active');
        document.body.style.overflow = '';
      }
    }
  });
});
