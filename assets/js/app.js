let chart;
const ctx=document.getElementById("threatChart");
chart=new Chart(ctx,{type:"line",data:{labels:["Mon","Tue","Wed","Thu","Fri","Sat","Sun"],datasets:[{label:"Threats",data:[120,185,145,230,190,280,215],borderWidth:3,tension:.4,fill:true,backgroundColor:"rgba(91,140,255,.10)",borderColor:"#5b8cff",pointRadius:4,pointBackgroundColor:"#65e8ad"}]},options:{responsive:true,maintainAspectRatio:false,plugins:{legend:{display:false}},scales:{x:{grid:{display:false},ticks:{color:"#71809a"}},y:{grid:{color:"rgba(120,140,170,.10)"},ticks:{color:"#71809a"}}}}});

document.getElementById("themeBtn").addEventListener("click",()=>{
 document.body.classList.toggle("light");
 const icon=document.querySelector("#themeBtn i");
 icon.className=document.body.classList.contains("light")?"bi bi-sun":"bi bi-moon-stars";
});

document.getElementById("searchThreat").addEventListener("input",e=>{
 const q=e.target.value.toLowerCase();
 document.querySelectorAll("#threatTable tbody tr").forEach(row=>row.style.display=row.innerText.toLowerCase().includes(q)?"":"none");
});

function showDetails(name){
 document.getElementById("modalTitle").innerText=name;
 document.getElementById("modalBody").innerHTML=`
 <div class="row g-3">
 <div class="col-6"><small class="text-secondary">Detection</small><div class="fw-bold">Automated SOC engine</div></div>
 <div class="col-6"><small class="text-secondary">Confidence</small><div class="fw-bold text-success">98.2%</div></div>
 <div class="col-12"><small class="text-secondary">Analysis</small><p class="mt-1 mb-0">Suspicious activity was detected and correlated with current threat intelligence indicators. The event has been isolated for investigation.</p></div>
 </div>`;
 new bootstrap.Modal("#detailsModal").show();
}
function toast(message){
 const el=document.createElement("div");el.className="toast text-bg-dark border border-secondary";el.innerHTML=`<div class="d-flex"><div class="toast-body"><i class="bi bi-check-circle text-success me-2"></i>${message}</div><button class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button></div>`;
 document.getElementById("toast").appendChild(el);const t=new bootstrap.Toast(el,{delay:2800});t.show();el.addEventListener("hidden.bs.toast",()=>el.remove());
}
function runScan(){
 toast("Security scan started. 248 endpoints are being analyzed.");
 setTimeout(()=>toast("Scan complete — no new critical vulnerabilities found."),2200);
}
function refreshThreats(){toast("Threat feed refreshed successfully.");}
document.getElementById("rangeSelect").addEventListener("change",e=>{
 const long=e.target.value==="30 Days";
 chart.data.labels=long?["1","5","10","15","20","25","30"]:["Mon","Tue","Wed","Thu","Fri","Sat","Sun"];
 chart.data.datasets[0].data=long?[310,420,350,510,460,580,490]:[120,185,145,230,190,280,215];
 chart.update();
});
