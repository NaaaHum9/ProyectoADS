
// Guardar la pestaña activa antes de enviar el formulario
const tabs = document.querySelectorAll('[data-bs-toggle="tab"]');
tabs.forEach(tab => {
    tab.addEventListener('shown.bs.tab', function (event) {
        alert("holi");
        localStorage.setItem('activeTab', event.target.id);
    });
});

// Restaurar la pestaña activa al recargar la página
document.addEventListener('DOMContentLoaded', () => {
    const activeTabId = localStorage.getItem('activeTab');
    if (activeTabId) {
        const activeTab = document.getElementById(activeTabId);
        const tab = new bootstrap.Tab(activeTab);
        tab.show();
    }
});