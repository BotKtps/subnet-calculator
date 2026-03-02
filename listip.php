<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IP List - Dicko Dev</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        :root { --p: #00d2ff; --bg: #0f172a; --card: rgba(30, 41, 59, 0.7); }
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Poppins', sans-serif; }
        body { background: var(--bg); color: #f8fafc; padding: 20px; display: flex; flex-direction: column; align-items: center; }
        
        nav { display: flex; gap: 10px; margin-bottom: 30px; background: rgba(255,255,255,0.05); padding: 8px; border-radius: 50px; }
        nav a { padding: 8px 20px; color: #94a3b8; text-decoration: none; font-size: 14px; font-weight: 600; border-radius: 50px; }
        nav a.active { background: #3a7bd5; color: white; }

        .container { width: 100%; max-width: 900px; background: var(--card); border-radius: 20px; padding: 30px; border: 1px solid rgba(255,255,255,0.1); }
        h1 { margin-bottom: 25px; font-size: 22px; color: var(--p); text-align: center; }

        .item { border-bottom: 1px solid rgba(255,255,255,0.05); padding: 15px 0; display: flex; justify-content: space-between; align-items: center; }
        .badge { padding: 5px 12px; border-radius: 6px; font-size: 11px; font-weight: bold; text-transform: uppercase; }
        .b-a { background: #3b82f6; } .b-b { background: #8b5cf6; } .b-c { background: #10b981; }
        
        .info { text-align: right; }
        .ip-range { font-family: monospace; color: var(--p); display: block; }
        .desc { font-size: 12px; color: #64748b; }
    </style>
</head>
<body>

<nav>
    <a href="/">Kalkulator</a>
    <a href="/listip" class="active">Daftar Kelas IP</a>
</nav>

<div class="container">
    <h1>Daftar Rentang Kelas IP Address</h1>

    <div class="item">
        <div>
            <span class="badge b-a">Kelas A</span>
            <p class="desc">Skala Sangat Besar</p>
        </div>
        <div class="info">
            <span class="ip-range">1.0.0.0 - 126.255.255.255</span>
            <span class="desc">Mask: 255.0.0.0 (/8)</span>
        </div>
    </div>

    <div class="item">
        <div>
            <span class="badge" style="background: #64748b;">Loopback</span>
            <p class="desc">Localhost/Testing</p>
        </div>
        <div class="info">
            <span class="ip-range">127.0.0.0 - 127.255.255.255</span>
        </div>
    </div>

    <div class="item">
        <div>
            <span class="badge b-b">Kelas B</span>
            <p class="desc">Skala Menengah</p>
        </div>
        <div class="info">
            <span class="ip-range">128.0.0.0 - 191.255.255.255</span>
            <span class="desc">Mask: 255.255.0.0 (/16)</span>
        </div>
    </div>

    <div class="item">
        <div>
            <span class="badge b-c">Kelas C</span>
            <p class="desc">Skala Kecil / LAN</p>
        </div>
        <div class="info">
            <span class="ip-range">192.0.0.0 - 223.255.255.255</span>
            <span class="desc">Mask: 255.255.255.0 (/24)</span>
        </div>
    </div>

    <div class="item">
        <div>
            <span class="badge" style="background: #f59e0b;">Kelas D</span>
            <p class="desc">Multicast</p>
        </div>
        <div class="info">
            <span class="ip-range">224.0.0.0 - 239.255.255.255</span>
        </div>
    </div>

    <div class="item" style="border:none;">
        <div>
            <span class="badge" style="background: #ef4444;">Kelas E</span>
            <p class="desc">Experimental</p>
        </div>
        <div class="info">
            <span class="ip-range">240.0.0.0 - 255.255.255.255</span>
        </div>
    </div>
</div>

<footer style="margin-top:20px; color:#475569; font-size:12px;">Dicko Dev &copy; 2024</footer>

</body>
</html>
