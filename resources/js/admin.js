import * as bootstrap from 'bootstrap';

window.bootstrap = bootstrap;

document.addEventListener('DOMContentLoaded', () => {
    const sidebar = document.querySelector('[data-admin-sidebar]');
    const backdrop = document.querySelector('[data-admin-sidebar-backdrop]');
    const toggleSidebar = () => { sidebar?.classList.toggle('is-open'); backdrop?.classList.toggle('is-open'); };
    document.querySelector('[data-admin-sidebar-toggle]')?.addEventListener('click', toggleSidebar);
    backdrop?.addEventListener('click', toggleSidebar);

    document.querySelectorAll('[data-table-search]').forEach((input) => {
        const table = document.querySelector(input.dataset.tableSearch);
        input.addEventListener('input', () => {
            const term = input.value.toLowerCase().trim();
            table?.querySelectorAll('tbody tr').forEach((row) => { row.hidden = !row.textContent.toLowerCase().includes(term); });
        });
    });
});
