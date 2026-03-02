function cidrToMask(cidr) {
    let mask = [];
    for (let i = 0; i < 4; i++) {
        let n = Math.min(cidr, 8);
        mask.push(256 - Math.pow(2, 8 - n));
        cidr -= n;
    }
    return mask.join('.');
}

function getSubnetInfo(ip, cidr) {
    const ipParts = ip.split('.').map(Number);
    const maskStr = cidrToMask(cidr);
    const maskParts = maskStr.split('.').map(Number);
    
    // Network Address
    const netParts = ipParts.map((p, i) => p & maskParts[i]);
    
    // Broadcast Address
    const wildParts = maskParts.map(p => 255 - p);
    const broadParts = netParts.map((p, i) => p | wildParts[i]);
    
    // IP Class
    let ipClass = "C";
    if (ipParts[0] <= 126) ipClass = "A";
    else if (ipParts[0] <= 191) ipClass = "B";
    else if (ipParts[0] <= 223) ipClass = "C";
    else if (ipParts[0] <= 239) ipClass = "D (Multicast)";
    else ipClass = "E";

    // Host Ranges
    let totalHosts = Math.pow(2, 32 - cidr);
    let usableHosts = totalHosts > 2 ? totalHosts - 2 : 0;
    
    return {
        class: ipClass,
        network: netParts.join('.'),
        broadcast: broadParts.join('.'),
        mask: maskStr,
        wildcard: wildParts.join('.'),
        totalHosts: totalHosts.toLocaleString(),
        usableHosts: usableHosts.toLocaleString()
    };
}
