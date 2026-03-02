<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IP Calculator - Dicko Dev</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        :root { --p: #00d2ff; --s: #3a7bd5; --bg: #0f172a; --card: rgba(30, 41, 59, 0.7); }
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Poppins', sans-serif; }
        body { background: var(--bg); color: #f8fafc; min-height: 100vh; display: flex; flex-direction: column; align-items: center; padding: 20px; }
        
        .logo-box { display: flex; align-items: center; gap: 10px; margin-bottom: 20px; }
        .logo-icon { width: 45px; height: 45px; background: linear-gradient(45deg, var(--p), var(--s)); border-radius: 12px; display: flex; align-items: center; justify-content: center; font-weight: 800; font-size: 22px; color: white; box-shadow: 0 0 20px rgba(0, 210, 255, 0.3); }
        .logo-text { font-size: 26px; font-weight: 700; background: linear-gradient(to right, #fff, var(--p)); -webkit-background-clip: text; -webkit-text-fill-color: transparent; }

        nav { display: flex; gap: 10px; margin-bottom: 30px; background: rgba(255,255,255,0.05); padding: 8px; border-radius: 50px; border: 1px solid rgba(255,255,255,0.1); }
        nav a { padding: 8px 20px; color: #94a3b8; text-decoration: none; font-size: 14px; font-weight: 600; border-radius: 50px; transition: 0.3s; }
        nav a.active { background: var(--s); color: white; }

        .container { width: 100%; max-width: 800px; background: var(--card); backdrop-filter: blur(10px); border: 1px solid rgba(255,255,255,0.1); border-radius: 20px; padding: 30px; }
        .input-group { display: grid; grid-template-columns: 2fr 1fr auto; gap: 10px; margin-bottom: 30px; }
        input, select { padding: 12px; background: #0f172a; border: 1px solid #334155; border-radius: 10px; color: white; outline: none; }
        .btn-calc { background: linear-gradient(45deg, var(--p), var(--s)); border: none; padding: 12px 25px; border-radius: 10px; color: white; font-weight: 600; cursor: pointer; }
        
        .results-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 15px; }
        .res-card { background: rgba(15, 23, 42, 0.5); padding: 15px; border-radius: 12px; border-left: 3px solid var(--p); }
        .res-card h3 { font-size: 10px; color: #94a3b8; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 5px; }
        .res-card p { font-size: 16px; font-weight: 600; }

        @media (max-width: 600px) { .input-group { grid-template-columns: 1fr; } }
    </style>
</head>
<body>

<div class="logo-box">
    <div class="logo-icon">D</div>
    <div class="logo-text">Dicko Dev</div>
</div>

<nav>
    <a href="/" class="active">Kalkulator</a>
    <a href="/listip">Daftar Kelas IP</a>
</nav>

<div class="container">
    <div class="input-group">
        <input type="text" id="ipInput" placeholder="Contoh: 192.168.1.1" value="192.168.1.1">
        <select id="cidrInput"></select>
        <button class="btn-calc" onclick="calculate()">Hitung</button>
    </div>
    <div id="results" class="results-grid"></div>
</div>

<script>
    const select = document.getElementById('cidrInput');
    for(let i=1; i<=32; i++){
        const opt = document.createElement('option');
        opt.value = i; opt.innerHTML = `/${i}`;
        if(i===24) opt.selected = true;
        select.appendChild(opt);
    }

    function longToIp(long) {
        return [(long >>> 24) & 0xFF, (long >>> 16) & 0xFF, (long >>> 8) & 0xFF, long & 0xFF].join('.');
    }

    function calculate() {
        const ipStr = document.getElementById('ipInput').value;
        const cidr = parseInt(document.getElementById('cidrInput').value);
        if(!/^(\d{1,3}\.){3}\d{1,3}$/.test(ipStr)) return alert("IP Tidak Valid");

        const ipParts = ipStr.split('.').map(Number);
        const ipLong = (ipParts[0] << 24 | ipParts[1] << 16 | ipParts[2] << 8 | ipParts[3]) >>> 0;
        const mask = (0xFFFFFFFF << (32 - cidr)) >>> 0;
        const netLong = (ipLong & mask) >>> 0;
        const broadLong = (netLong | ~mask) >>> 0;

        let cls = 'C';
        if(ipParts[0] < 128) cls = 'A';
        else if(ipParts[0] < 192) cls = 'B';
        else if(ipParts[0] < 224) cls = 'C';
        else if(ipParts[0] < 240) cls = 'D (Multicast)';
        else cls = 'E (Experimental)';

        const data = [
            {t: "IP Class", v: cls},
            {t: "Network Address", v: longToIp(netLong)},
            {t: "Broadcast Address", v: longToIp(broadLong)},
            {t: "Subnet Mask", v: longToIp(mask)},
            {t: "Total Hosts", v: Math.pow(2, 32-cidr).toLocaleString()},
            {t: "Usable Range", v: cidr < 31 ? longToIp(netLong+1) + " - " + longToIp(broadLong-1) : "N/A"}
        ];

        document.getElementById('results').innerHTML = data.map(d => `
            <div class="res-card">
                <h3>${d.t}</h3>
                <p>${d.v}</p>
            </div>
        `).join('');
    }
    calculate();
</script>
</body>
</html>
