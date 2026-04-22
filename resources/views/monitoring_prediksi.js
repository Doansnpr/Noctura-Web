const avColors = ['av-blue','av-teal','av-green','av-purple','av-amber','av-red'];
function getAvColor(name){ let h=0; for(let c of name) h+=c.charCodeAt(0); return avColors[h%avColors.length]; }
function getInitials(name){ return name.split(' ').map(w=>w[0]).slice(0,2).join('').toUpperCase(); }
function fmtDate(d){
  const months=['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agt','Sep','Okt','Nov','Des'];
  return d.getDate()+' '+months[d.getMonth()]+' '+d.getFullYear();
}

const predictions = [
  {
    id:1, name:'Budi Santoso', date: new Date('2026-04-01'),
    result:'Insomnia',
    features:{
      Gender:'Male', Age:34, Occupation:'Engineer',
      'Sleep Duration':5.2, 'Quality of Sleep':4, 'Physical Activity Level':30,
      'Stress Level':8, 'BMI Category':'Normal Weight', Steps:4200
    }
  },
  {
    id:2, name:'Siti Rahma', date: new Date('2026-04-03'),
    result:'Normal',
    features:{
      Gender:'Female', Age:28, Occupation:'Teacher',
      'Sleep Duration':7.5, 'Quality of Sleep':8, 'Physical Activity Level':60,
      'Stress Level':3, 'BMI Category':'Normal Weight', Steps:8700
    }
  },
  {
    id:3, name:'Agus Prasetyo', date: new Date('2026-04-05'),
    result:'Sleep Apnea',
    features:{
      Gender:'Male', Age:47, Occupation:'Manager',
      'Sleep Duration':6.0, 'Quality of Sleep':5, 'Physical Activity Level':20,
      'Stress Level':7, 'BMI Category':'Obese', Steps:3100
    }
  },
  {
    id:4, name:'Dewi Lestari', date: new Date('2026-04-07'),
    result:'Insomnia',
    features:{
      Gender:'Female', Age:31, Occupation:'Nurse',
      'Sleep Duration':4.8, 'Quality of Sleep':3, 'Physical Activity Level':45,
      'Stress Level':9, 'BMI Category':'Overweight', Steps:5600
    }
  },
  {
    id:5, name:'Hendra Kurniawan', date: new Date('2026-04-09'),
    result:'Normal',
    features:{
      Gender:'Male', Age:25, Occupation:'Software Engineer',
      'Sleep Duration':7.8, 'Quality of Sleep':9, 'Physical Activity Level':75,
      'Stress Level':2, 'BMI Category':'Normal Weight', Steps:11200
    }
  },
  {
    id:6, name:'Nurul Fadhilah', date: new Date('2026-04-11'),
    result:'Sleep Apnea',
    features:{
      Gender:'Female', Age:52, Occupation:'Accountant',
      'Sleep Duration':5.5, 'Quality of Sleep':4, 'Physical Activity Level':15,
      'Stress Level':6, 'BMI Category':'Obese', Steps:2800
    }
  },
  {
    id:7, name:'Rizky Firmansyah', date: new Date('2026-04-13'),
    result:'Insomnia',
    features:{
      Gender:'Male', Age:29, Occupation:'Lawyer',
      'Sleep Duration':4.5, 'Quality of Sleep':3, 'Physical Activity Level':25,
      'Stress Level':9, 'BMI Category':'Underweight', Steps:3900
    }
  },
  {
    id:8, name:'Annisa Putri', date: new Date('2026-04-15'),
    result:'Normal',
    features:{
      Gender:'Female', Age:22, Occupation:'Scientist',
      'Sleep Duration':8.0, 'Quality of Sleep':9, 'Physical Activity Level':90,
      'Stress Level':2, 'BMI Category':'Normal Weight', Steps:12500
    }
  },
];

let activeDetail = null;

function getBadge(result){
  if(result==='Insomnia')   return `<span class="pred-badge badge-insomnia"><span class="dot"></span>Insomnia</span>`;
  if(result==='Sleep Apnea')return `<span class="pred-badge badge-apnea"><span class="dot"></span>Sleep Apnea</span>`;
  return `<span class="pred-badge badge-normal"><span class="dot"></span>Normal</span>`;
}

function renderTable(){
  const search = document.getElementById('searchInput').value.toLowerCase();
  const filter = document.getElementById('filterResult').value;

  const filtered = predictions.filter(p =>
    p.name.toLowerCase().includes(search) &&
    (filter ? p.result === filter : true)
  );

  // stats
  document.getElementById('sTotal').textContent    = predictions.length;
  document.getElementById('sInsomnia').textContent = predictions.filter(p=>p.result==='Insomnia').length;
  document.getElementById('sApnea').textContent    = predictions.filter(p=>p.result==='Sleep Apnea').length;
  document.getElementById('sNormal').textContent   = predictions.filter(p=>p.result==='Normal').length;
  document.getElementById('countBadge').textContent = filtered.length + ' data';

  const tbody = document.getElementById('tableBody');
  if(!filtered.length){
    tbody.innerHTML = `<tr><td colspan="5" class="empty-state">Tidak ada data prediksi yang ditemukan.</td></tr>`;
    return;
  }

  tbody.innerHTML = filtered.map((p, i) => `
    <tr>
      <td><span class="row-no">${String(i+1).padStart(2,'0')}</span></td>
      <td>
        <div class="name-cell">
          <div class="avatar ${getAvColor(p.name)}">${getInitials(p.name)}</div>
          <span class="acc-name">${p.name}</span>
        </div>
      </td>
      <td><span class="date-text">${fmtDate(p.date)}</span></td>
      <td>${getBadge(p.result)}</td>
      <td>
        <div class="act-btns">
          <button class="act-btn" onclick="openDetail(${p.id})">
            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
            Detail
          </button>
        </div>
      </td>
    </tr>
  `).join('');
}

function openDetail(id){
  const p = predictions.find(x => x.id === id);
  if(!p) return;
  activeDetail = p;

  // hero
  const heroClass  = p.result==='Insomnia' ? 'hero-insomnia' : p.result==='Sleep Apnea' ? 'hero-apnea' : 'hero-normal';
  const iconClass  = p.result==='Insomnia' ? 'icon-insomnia' : p.result==='Sleep Apnea' ? 'icon-apnea'  : 'icon-normal';
  const colorClass = p.result==='Insomnia' ? 'color-insomnia': p.result==='Sleep Apnea' ? 'color-apnea' : 'color-normal';

  const heroIcon = p.result==='Insomnia'
    ? `<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#be123c" stroke-width="2"><path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"/></svg>`
    : p.result==='Sleep Apnea'
    ? `<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#c2410c" stroke-width="2"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/></svg>`
    : `<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#15803d" stroke-width="2"><polyline points="20 6 9 17 4 12"/></svg>`;

  document.getElementById('modalUserName').textContent = p.name;
  document.getElementById('modalDate').textContent     = fmtDate(p.date);

  document.getElementById('resultHero').className = `modal-result-hero ${heroClass}`;
  document.getElementById('heroIconWrap').className = `hero-icon ${iconClass}`;
  document.getElementById('heroIconWrap').innerHTML  = heroIcon;
  document.getElementById('heroResult').className    = `hero-result ${colorClass}`;
  document.getElementById('heroResult').textContent  = p.result;

  // feature units mapping
  const units = {
    Age: 'tahun', 'Sleep Duration': 'jam', 'Quality of Sleep': '/ 10',
    'Physical Activity Level': 'menit/hari', 'Stress Level': '/ 10', Steps: 'langkah'
  };
  const icons = {
    Gender: `<svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 2a5 5 0 1 0 0 10A5 5 0 0 0 12 2zm0 12c-5.33 0-8 2.67-8 4v2h16v-2c0-1.33-2.67-4-8-4z"/></svg>`,
    Age:    `<svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2"/><path d="M16 2v4M8 2v4M3 10h18"/></svg>`,
    Occupation: `<svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="7" width="20" height="14" rx="2"/><path d="M16 7V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v2"/></svg>`,
    'Sleep Duration': `<svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/></svg>`,
    'Quality of Sleep': `<svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"/></svg>`,
    'Physical Activity Level': `<svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M13 2L3 14h9l-1 8 10-12h-9l1-8z"/></svg>`,
    'Stress Level': `<svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"/><circle cx="12" cy="12" r="10"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg>`,
    'BMI Category': `<svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/></svg>`,
    Steps: `<svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 18V5l12-2v13"/><circle cx="6" cy="18" r="3"/><circle cx="18" cy="16" r="3"/></svg>`,
  };

  const featHtml = Object.entries(p.features).map(([key, val]) => `
    <div class="feat-item">
      <div class="feat-key">${icons[key] || ''} ${key}</div>
      <div class="feat-val">${val}<span class="feat-unit">${units[key]||''}</span></div>
    </div>
  `).join('');

  document.getElementById('featGrid').innerHTML = featHtml;
  document.getElementById('detailModal').classList.add('open');
}

function closeDetail(){
  document.getElementById('detailModal').classList.remove('open');
  activeDetail = null;
}

// sidebar toggle
(function(){
  const body         = document.body;
  const toggleBtn    = document.getElementById('sidebarToggleBtn');
  const mobileToggle = document.getElementById('mobileMenuToggle');
  const overlay      = document.querySelector('.sidebar-overlay');
  const icon         = document.getElementById('toggleIcon');

  function updIcon(){
    icon.innerHTML = body.classList.contains('sidebar-collapsed')
      ? '<polyline points="9 18 15 12 9 6"/>'
      : '<polyline points="15 18 9 12 15 6"/>';
  }

  if(localStorage.getItem('sidebarCollapsed') === 'true') body.classList.add('sidebar-collapsed');
  updIcon();

  toggleBtn.addEventListener('click', e => {
    e.stopPropagation();
    body.classList.toggle('sidebar-collapsed');
    localStorage.setItem('sidebarCollapsed', body.classList.contains('sidebar-collapsed'));
    updIcon();
  });

  mobileToggle.addEventListener('click', () => body.classList.toggle('sidebar-open'));
  overlay.addEventListener('click', () => body.classList.remove('sidebar-open'));
  window.addEventListener('resize', () => { if(window.innerWidth > 768) body.classList.remove('sidebar-open'); });

  document.querySelector('.master-data-trigger').addEventListener('click', e => {
    e.preventDefault(); e.stopPropagation();
    document.getElementById('masterDataGroup').classList.toggle('open');
  });

  document.getElementById('detailModal').addEventListener('click', e => {
    if(e.target === e.currentTarget) closeDetail();
  });
})();

renderTable();