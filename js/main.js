document.addEventListener('DOMContentLoaded', () => {
    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('overlay');
    const menuToggle = document.getElementById('menuToggle');
    const cidrSelect = document.getElementById('cidrSelect');

    // Populate CIDR Options
    for (let i = 32; i >= 1; i--) {
        const opt = document.createElement('option');
        opt.value = i;
        opt.textContent = `/${i} - ${cidrToMask(i)}`;
        if (i === 24) opt.selected = true;
        cidrSelect.appendChild(opt);
    }

    // Toggle Sidebar
    const toggleSidebar = () => {
        sidebar.classList.toggle('active');
        overlay.classList.toggle('active');
    };

    menuToggle.addEventListener('click', toggleSidebar);
    overlay.addEventListener('click', toggleSidebar);

    // Navigation Logic
    const navLinks = document.querySelectorAll('.nav-link');
    const sections = document.querySelectorAll('.tab-content');

    navLinks.forEach(link => {
        link.addEventListener('click', (e) => {
            e.preventDefault();
            const target = link.getAttribute('data-target');

            navLinks.forEach(l => l.classList.remove('active'));
            link.classList.add('active');

            sections.forEach(s => s.classList.remove('active'));
            document.getElementById(target).classList.add('active');

            if (window.innerWidth < 1024) toggleSidebar();
        });
    });

    // Calculate Action
    document.getElementById('btnCalculate').addEventListener('click', () => {
        const ip = document.getElementById('ipAddress').value;
        const cidr = parseInt(cidrSelect.value);

        // Simple Validation
        const ipRegex = /^(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)$/;
        
        if (!ipRegex.test(ip)) {
            alert("Alamat IP tidak valid!");
            return;
        }

        const info = getSubnetInfo(ip, cidr);
        const resultCard = document.getElementById('resultCard');
        const resultDetails = document.getElementById('resultDetails');

        resultCard.style.display = 'block';
        resultDetails.innerHTML = `
            <div class="res-item"><small>IP CLASS</small><span>${info.class}</span></div>
            <div class="res-item"><small>NETWORK ID</small><span>${info.network}</span></div>
            <div class="res-item"><small>BROADCAST ID</small><span>${info.broadcast}</span></div>
            <div class="res-item"><small>SUBNET MASK</small><span>${info.mask}</span></div>
            <div class="res-item"><small>WILDCARD</small><span>${info.wildcard}</span></div>
            <div class="res-item"><small>USABLE HOSTS</small><span>${info.usableHosts}</span></div>
        `;
        
        resultCard.scrollIntoView({ behavior: 'smooth' });
    });
});
