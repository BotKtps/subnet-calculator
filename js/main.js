// ... kode sebelumnya ...

navLinks.forEach(link => {
    link.addEventListener('click', (e) => {
        e.preventDefault();
        const target = link.getAttribute('data-target');

        // Jalankan fetch IP jika menu checkip dipilih
        if (target === 'checkip') {
            fetchMyIp();
        }

        navLinks.forEach(l => l.classList.remove('active'));
        link.classList.add('active');

        sections.forEach(s => s.classList.remove('active'));
        document.getElementById(target).classList.add('active');

        if (window.innerWidth < 1024) toggleSidebar();
    });
});
