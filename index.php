<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>NexaSecure | Cybersecurity Operations Center</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
<link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark fixed-top glass-nav">
<div class="container">
<a class="navbar-brand fw-bold" href="#"><span class="brand-dot"></span> NexaSecure</a>
<button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#nav"><span class="navbar-toggler-icon"></span></button>
<div class="collapse navbar-collapse" id="nav">
<ul class="navbar-nav ms-auto align-items-lg-center gap-lg-2">
<li class="nav-item"><a class="nav-link active" href="#dashboard">Dashboard</a></li>
<li class="nav-item"><a class="nav-link" href="#threats">Threats</a></li>
<li class="nav-item"><a class="nav-link" href="#analytics">Analytics</a></li>
<li class="nav-item"><a class="nav-link" href="#alerts">Alerts</a></li>
<li class="nav-item"><button id="themeBtn" class="btn btn-sm btn-outline-light"><i class="bi bi-moon-stars"></i></button></li>
</ul>
</div>
</div>
</nav>

<main class="container page-wrap" id="dashboard">
<section class="hero row align-items-center g-4">
<div class="col-lg-7">
<div class="eyebrow"><span class="live-dot"></span> SYSTEMS OPERATIONAL</div>
<h1>Cybersecurity intelligence, <span class="gradient-text">one dashboard.</span></h1>
<p class="lead text-secondary">Monitor threats, investigate incidents, analyze network activity and protect your infrastructure from one modern SOC interface.</p>
<div class="d-flex gap-2 flex-wrap">
<button class="btn btn-primary btn-lg" onclick="runScan()"><i class="bi bi-shield-check me-2"></i>Run Security Scan</button>
<a href="#analytics" class="btn btn-outline-secondary btn-lg">View Analytics</a>
</div>
</div>
<div class="col-lg-5">
<div class="hero-card">
<div class="scan-ring"><i class="bi bi-shield-lock-fill"></i></div>
<h5 class="mt-3">Protection Score</h5>
<div class="display-5 fw-bold">94%</div>
<div class="progress mt-2"><div class="progress-bar" style="width:94%"></div></div>
<small class="text-secondary">Last scan: 4 minutes ago</small>
</div>
</div>
</section>

<section class="row g-3 mb-4">
<?php
$cards = [
["Threats Blocked","12,842","bi-shield-x","danger","↑ 18.4%"],
["Active Devices","248","bi-pc-display","primary","↑ 6.2%"],
["Open Incidents","17","bi-exclamation-triangle","warning","↓ 12.1%"],
["Risk Score","2.8/10","bi-activity","success","↓ 0.7"]
];
foreach($cards as $c): ?>
<div class="col-sm-6 col-xl-3"><div class="stat-card">
<div class="icon-box bg-<?=$c[3]?>-subtle text-<?=$c[3]?>"><i class="bi <?=$c[2]?>"></i></div>
<div class="small text-secondary"><?=$c[0]?></div><div class="stat-value"><?=$c[1]?></div>
<span class="trend text-<?=$c[3]?>"><?=$c[4]?></span>
</div></div>
<?php endforeach; ?>
</section>

<section id="analytics" class="row g-4 mb-4">
<div class="col-lg-8"><div class="panel h-100">
<div class="panel-head"><div><h5>Threat Activity</h5><small class="text-secondary">Last 7 days</small></div>
<select id="rangeSelect" class="form-select form-select-sm w-auto"><option>7 Days</option><option>30 Days</option></select></div>
<div class="chart-wrap"><canvas id="threatChart"></canvas></div>
</div></div>
<div class="col-lg-4"><div class="panel h-100">
<div class="panel-head"><h5>Threat Types</h5><span class="badge text-bg-dark">Live</span></div>
<div class="donut"><div><strong>68%</strong><small>Malware</small></div></div>
<div class="legend"><span><i class="dot malware"></i>Malware <b>68%</b></span><span><i class="dot phishing"></i>Phishing <b>19%</b></span><span><i class="dot ddos"></i>DDoS <b>8%</b></span><span><i class="dot other"></i>Other <b>5%</b></span></div>
</div></div>
</section>

<section id="threats" class="panel mb-4">
<div class="panel-head flex-wrap gap-2"><div><h5>Recent Threats</h5><small class="text-secondary">Real-time security events</small></div>
<div class="d-flex gap-2"><input id="searchThreat" class="form-control form-control-sm" placeholder="Search threat..."><button class="btn btn-sm btn-primary" onclick="refreshThreats()"><i class="bi bi-arrow-clockwise"></i></button></div></div>
<div class="table-responsive"><table class="table align-middle" id="threatTable"><thead><tr><th>Threat</th><th>Source</th><th>Severity</th><th>Status</th><th>Time</th><th></th></tr></thead><tbody>
<tr><td><i class="bi bi-bug text-danger me-2"></i>Credential Harvesting</td><td>185.22.91.14</td><td><span class="badge severity-critical">Critical</span></td><td><span class="status-dot"></span>Blocked</td><td>2 min ago</td><td><button class="btn btn-sm btn-outline-secondary" onclick="showDetails('Credential Harvesting')">Details</button></td></tr>
<tr><td><i class="bi bi-envelope-exclamation text-warning me-2"></i>Phishing Campaign</td><td>mail-node-04</td><td><span class="badge severity-high">High</span></td><td><span class="status-dot"></span>Quarantined</td><td>9 min ago</td><td><button class="btn btn-sm btn-outline-secondary" onclick="showDetails('Phishing Campaign')">Details</button></td></tr>
<tr><td><i class="bi bi-hdd-network text-primary me-2"></i>Port Scan</td><td>10.0.4.91</td><td><span class="badge severity-medium">Medium</span></td><td><span class="status-dot"></span>Investigating</td><td>18 min ago</td><td><button class="btn btn-sm btn-outline-secondary" onclick="showDetails('Port Scan')">Details</button></td></tr>
<tr><td><i class="bi bi-database-x text-danger me-2"></i>SQL Injection Attempt</td><td>91.203.12.77</td><td><span class="badge severity-critical">Critical</span></td><td><span class="status-dot"></span>Blocked</td><td>31 min ago</td><td><button class="btn btn-sm btn-outline-secondary" onclick="showDetails('SQL Injection Attempt')">Details</button></td></tr>
</tbody></table></div>
</section>

<section id="alerts" class="row g-4 mb-5">
<div class="col-lg-7"><div class="panel">
<div class="panel-head"><h5>Security Alerts</h5><span class="badge rounded-pill bg-danger">3 new</span></div>
<div class="alert-item"><div class="alert-icon danger"><i class="bi bi-shield-exclamation"></i></div><div><b>Critical endpoint vulnerability</b><p>Endpoint WS-204 requires immediate patching.</p><small>8 minutes ago</small></div></div>
<div class="alert-item"><div class="alert-icon warning"><i class="bi bi-person-lock"></i></div><div><b>Unusual login pattern</b><p>Multiple failed logins detected for admin account.</p><small>21 minutes ago</small></div></div>
<div class="alert-item"><div class="alert-icon info"><i class="bi bi-cloud-arrow-down"></i></div><div><b>Threat intelligence updated</b><p>1,284 new indicators added to the database.</p><small>42 minutes ago</small></div></div>
</div></div>
<div class="col-lg-5"><div class="panel">
<div class="panel-head"><h5>System Health</h5><span class="text-success"><i class="bi bi-check-circle"></i> Healthy</span></div>
<div class="health-row"><span>Firewall</span><b>99.9%</b><div class="mini-progress"><i style="width:99.9%"></i></div></div>
<div class="health-row"><span>Endpoint Security</span><b>96.4%</b><div class="mini-progress"><i style="width:96.4%"></i></div></div>
<div class="health-row"><span>Database</span><b>98.1%</b><div class="mini-progress"><i style="width:98.1%"></i></div></div>
<div class="health-row"><span>API Gateway</span><b>99.7%</b><div class="mini-progress"><i style="width:99.7%"></i></div></div>
</div></div>
</section>
</main>

<footer class="footer"><div class="container d-flex justify-content-between flex-wrap gap-2"><span>© 2026 NexaSecure</span><span>HTML · CSS · JavaScript · Bootstrap · PHP · MySQL</span></div></footer>

<div class="modal fade" id="detailsModal" tabindex="-1"><div class="modal-dialog modal-dialog-centered"><div class="modal-content dark-modal"><div class="modal-header"><h5 id="modalTitle">Threat Details</h5><button class="btn-close btn-close-white" data-bs-dismiss="modal"></button></div><div class="modal-body" id="modalBody"></div></div></div></div>
<div id="toast" class="toast-container position-fixed bottom-0 end-0 p-3"></div>

<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.4/dist/chart.umd.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="assets/js/app.js"></script>
</body></html>
