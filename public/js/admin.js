/**
 * LUXE SHOP — Admin Panel JavaScript
 */

document.addEventListener('DOMContentLoaded', () => {
  /* ---- Active Nav Link ---- */
  const current = window.location.pathname.split('/').pop();
  document.querySelectorAll('.admin-nav-link').forEach((link) => {
    if (
      link.getAttribute('href') &&
      link.getAttribute('href').includes(current)
    ) {
      link.classList.add('active');
    }
  });

  /* ---- Confirm Delete ---- */
  document.addEventListener('click', (e) => {
    const btn = e.target.closest('[data-confirm]');
    if (!btn) return;
    if (!confirm(btn.dataset.confirm || 'Are you sure?')) e.preventDefault();
  });

  /* ---- Image Preview on Upload ---- */
  document
    .querySelectorAll('input[type="file"][data-preview]')
    .forEach((input) => {
      input.addEventListener('change', () => {
        const preview = document.getElementById(input.dataset.preview);
        if (!preview || !input.files[0]) return;
        const reader = new FileReader();
        reader.onload = (e) => {
          preview.src = e.target.result;
          preview.style.display = 'block';
        };
        reader.readAsDataURL(input.files[0]);
      });
    });

  /* ---- Sortable Table Columns ---- */
  document.querySelectorAll('th[data-sort]').forEach((th) => {
    th.style.cursor = 'pointer';
    th.addEventListener('click', () => {
      const url = new URL(window.location);
      const current = url.searchParams.get('sort');
      const col = th.dataset.sort;
      url.searchParams.set('sort', col);
      url.searchParams.set(
        'dir',
        current === col
          ? url.searchParams.get('dir') === 'asc'
            ? 'desc'
            : 'asc'
          : 'asc'
      );
      window.location = url.toString();
    });
  });

  /* ---- Auto-close Alerts ---- */
  document.querySelectorAll('.alert-auto').forEach((alert) => {
    setTimeout(() => {
      alert.style.transition = 'opacity 0.5s ease';
      alert.style.opacity = '0';
      setTimeout(() => alert.remove(), 500);
    }, 4000);
  });

  /* ---- Bulk Select Checkboxes ---- */
  const selectAll = document.getElementById('select-all');
  if (selectAll) {
    selectAll.addEventListener('change', () => {
      document.querySelectorAll('.row-check').forEach((cb) => {
        cb.checked = selectAll.checked;
      });
    });
  }

  /* ---- Character Counter ---- */
  document.querySelectorAll('[data-maxlength]').forEach((input) => {
    const max = parseInt(input.dataset.maxlength);
    const counter = document.createElement('small');
    counter.className = 'char-counter';
    counter.style.cssText =
      'display:block;text-align:right;font-size:0.7rem;color:var(--text-muted);margin-top:4px;';
    input.after(counter);
    const update = () => {
      counter.textContent = `${input.value.length}/${max}`;
    };
    input.addEventListener('input', update);
    update();
  });
});
