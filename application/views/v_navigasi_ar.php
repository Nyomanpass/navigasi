<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<title>Navigasi GPS AR</title>

<script src="https://aframe.io/releases/1.3.0/aframe.min.js"></script>
<script src="https://raw.githack.com/AR-js-org/AR.js/master/aframe/build/aframe-ar.js"></script>
<script src="https://unpkg.com/aframe-look-at-component@0.8.0/dist/aframe-look-at-component.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700&display=swap" rel="stylesheet">
<style>
    body { font-family: 'Plus Jakarta Sans', sans-serif; }
    .glass {
        background: rgba(255, 255, 255, 0.85);
        backdrop-filter: blur(12px);
        -webkit-backdrop-filter: blur(12px);
        border: 1px solid rgba(255, 255, 255, 0.3);
    }
    .status-badge {
        background: rgba(0, 0, 0, 0.6);
        backdrop-filter: blur(8px);
    }
</style>
</head>

<body class="m-0 bg-black overflow-hidden font-sans">

<div class="flex flex-col h-screen w-full">

        <div class="relative flex-1 bg-gray-900 overflow-hidden">
            
            <a-scene
                embedded
                vr-mode-ui="enabled:false"
                renderer="precision: mediump; antialias: true"
                arjs="sourceType: webcam; videoTexture: true; debugUIEnabled: false; facingMode: environment;"
                class="absolute inset-0 w-full h-full"
            >
                <a-assets>
                    <img id="pin" src="<?= base_url('assets/lokasi.png') ?>">
                </a-assets>

                <?php foreach($waypoints as $i => $w): ?>
                <a-entity class="marker-ar" gps-projected-entity-place="latitude:<?= $w->lat ?>; longitude:<?= $w->lng ?>;" scale="0 0 0">
                    <a-image 
                    src="#pin" 
                    width="3" 
                    height="3" 
                    material="shader:flat; transparent:true"
                    look-at="[gps-projected-camera]"
                    animation="property: position; to: 0 0.5 0; dir: alternate; dur: 1000; loop: true; easing: easeInOutSine">
                </a-image>
                </a-entity>
                <?php endforeach; ?>

                <a-entity id="ring-guide-container"></a-entity>
                <a-camera gps-projected-camera rotation-reader></a-camera>
                
            </a-scene>

            <div class="absolute top-6 w-full flex justify-center pointer-events-none z-50">
                <div class="bg-black/40 backdrop-blur-md px-4 py-2 rounded-full flex items-center gap-2 text-white border border-white/10 shadow-lg">
                    <div class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></div>
                    <span id="status" class="text-xs font-semibold uppercase tracking-wider">Mencari GPS...</span>
                </div>
            </div>

         <div id="nav-arrow" class="absolute bottom-8 left-1/2 -translate-x-1/2 z-[150] transition-transform duration-300 pointer-events-none">
                <div class="relative flex items-center justify-center">
                    
                    <div class="absolute w-28 h-28 bg-blue-500/25 rounded-full blur-2xl animate-pulse"></div>
                    <div class="absolute w-20 h-20 bg-blue-500/30 rounded-full blur-xl"></div>

                    <svg 
                        class="w-20 h-20 text-blue-500 drop-shadow-[0_10px_15px_rgba(0,0,0,0.4)]" 
                        style="filter: drop-shadow(0px 0px 1px rgba(59,130,246,0.9));"
                        fill="currentColor" 
                        viewBox="0 0 24 24"
                    >
                        <path d="M12 2L4.5 20.29l.71.71L12 18l6.79 3 .71-.71z"/>
                    </svg>

                </div>
            </div>
        </div>

        <div class="relative -mt-10 inset-x-0 bg-white rounded-t-[32px] px-5 pt-8 pb-20 shadow-[0_-15px_35px_rgba(0,0,0,0.3)] z-[100]">
            <div class="max-w-md mx-auto">
                
                <div class="relative overflow-hidden rounded-2xl p-5 border border-gray-100">
                    <div class="absolute top-0 left-0 h-1 bg-blue-600 transition-all duration-500" id="progress-bar" style="width: 0%"></div>
                    
                    <div class="flex items-center justify-between">
                        <div class="flex-1 pr-3">
                            <p class="text-[10px] text-blue-500 font-bold uppercase tracking-widest mb-1">Tujuan Anda</p>
                            <h1 class="text-gray-900 text-2xl font-black italic tracking-tight leading-none">
                                <?= strtoupper($nama_tujuan) ?>
                            </h1>
                        </div>
                        <div class="text-right border-l border-gray-200 pl-4">
                            <div id="dist-info" class="text-3xl font-black text-blue-600 tracking-tighter leading-none">--</div>
                            <div class="text-[9px] text-gray-400 font-bold mt-1 uppercase">Meter</div>
                        </div>
                    </div>

                    <div class="mt-4 pt-4 border-t border-gray-200/60 flex items-center gap-3">
                        <div class="bg-blue-600 p-2 rounded-xl shadow-lg shadow-blue-100">
                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="text-[10px] text-gray-400 font-bold leading-none mb-0.5 uppercase">Petunjuk</p>
                            <p class="text-xs font-black text-gray-700 uppercase tracking-tight">Ikuti Jalur di Layar</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<!-- ================= SCRIPT ================= -->
<script>
    const waypoints = <?= json_encode($waypoints) ?>;

    let currentIndex = 0;
    let isSwitching = false;
    let deviceHeading = 0;
    let insideRadiusCount = 0;

    const ARRIVE_RADIUS = 5;   // lebih ketat
    const REQUIRED_STABLE = 5; // harus stabil 5x


    const arrow = document.getElementById('nav-arrow');

    function syncMarkers(){
        document.querySelectorAll('.marker-ar').forEach((m,i)=>{
            m.setAttribute(
                'scale',
                i === currentIndex ? '0.8 0.8 0.8' : '0 0 0'
            );
        });
    }

    function getDistance(lat1,lon1,lat2,lon2){
        const R = 6371e3;
        const φ1 = lat1 * Math.PI/180;
        const φ2 = lat2 * Math.PI/180;
        const Δφ = (lat2-lat1) * Math.PI/180;
        const Δλ = (lon2-lon1) * Math.PI/180;
        const a = Math.sin(Δφ/2)**2 +
            Math.cos(φ1)*Math.cos(φ2)*Math.sin(Δλ/2)**2;
        return Math.round(R * 2 * Math.atan2(Math.sqrt(a),Math.sqrt(1-a)));
    }

    function getBearing(lat1,lon1,lat2,lon2){
        const toRad=d=>d*Math.PI/180;
        const y=Math.sin(toRad(lon2-lon1))*Math.cos(toRad(lat2));
        const x=Math.cos(toRad(lat1))*Math.sin(toRad(lat2)) -
                Math.sin(toRad(lat1))*Math.cos(toRad(lat2))*Math.cos(toRad(lon2-lon1));
        return (Math.atan2(y,x)*180/Math.PI+360)%360;
    }

    let lastLat = null;
    let lastLng = null;

    function isReallyMoving(lat, lng) {
        if (lastLat === null) {
            lastLat = lat;
            lastLng = lng;
            return true;
        }

        const d = getDistance(lat, lng, lastLat, lastLng);

        // ⛔ jika geser < 2 meter → anggap DIAM
        if (d < 2) return false;

        lastLat = lat;
        lastLng = lng;
        return true;
    }

    // ================= SMOOTH JARAK =================
    let smoothDist = null;

    function smoothDistance(newDist) {
        if (smoothDist === null) return smoothDist = newDist;
        smoothDist = smoothDist * 0.8 + newDist * 0.2;
        return Math.round(smoothDist);
    }


    window.addEventListener('deviceorientationabsolute',e=>{
        if(e.alpha!==null) deviceHeading = 360 - e.alpha;
    },true);

    let lastBearing = 0;


    window.addEventListener('gps-camera-update-position', e => {
        if (currentIndex >= waypoints.length) return;

        const uLat = e.detail.position.latitude;
        const uLng = e.detail.position.longitude;
        const t = waypoints[currentIndex];

        // ================= CEK GERAK =================
        const moving = isReallyMoving(uLat, uLng);

    


        // ================= JARAK =================
        const rawDist = getDistance(uLat, uLng, t.lat, t.lng);
        const dist = smoothDistance(rawDist);
        buildRings(dist);


        document.getElementById('status').innerText =
            'Menuju Titik ' + (currentIndex + 1);
        document.getElementById('dist-info').innerText = dist + ' m';

        // ================= DETEKSI SAMPAI =================
        if (dist <= ARRIVE_RADIUS) insideRadiusCount++;
        else insideRadiusCount = 0;

        if (insideRadiusCount >= REQUIRED_STABLE && !isSwitching) {
            isSwitching = true;
            navigator.vibrate?.(200);

            setTimeout(() => {
                currentIndex++;
                insideRadiusCount = 0;
                smoothDist = null;

                if (currentIndex >= waypoints.length) {
                    arrow.classList.add('hidden');
                    document.getElementById('status').innerText =
                        '🎉 Anda sudah sampai di lokasi';
                    document.getElementById('dist-info').innerText = '';
                    return;
                }

                syncMarkers();
                isSwitching = false;
            }, 600);
        }

        // ================= BEARING =================
        if (moving) {
            const bearing =
                getBearing(uLat, uLng, t.lat, t.lng) - deviceHeading;

            lastBearing = bearing;

        arrow.style.transform = `rotate(${bearing}deg)`;
        } else {
            // DIAM → kunci arah terakhir
            arrow.style.transform = `rotate(${lastBearing}deg)`;
        }

    });

    document.addEventListener('DOMContentLoaded', syncMarkers);
</script>


<script>

function getActiveRingContainer() {
    const markers = document.querySelectorAll('.marker-ar');
    const activeMarker = markers[currentIndex];
    if (!activeMarker) return null;
    return activeMarker.querySelector('.step-rings');
}


const MAX_RINGS = 10;        // jumlah ring
const RING_SPACING = 1.2;   // jarak antar ring (meter)
const MIN_RADIUS = 0.08;
const MAX_RADIUS = 0.35;

function buildRings(distance) {
    const ringContainer = document.getElementById('ring-guide-container');
    const camera = document.querySelector('[gps-projected-camera]');
    if (!ringContainer || !camera) return;

    ringContainer.innerHTML = '';
    const camPos = camera.object3D.position;
    const markers = document.querySelectorAll('.marker-ar');
    const targetMarker = markers[currentIndex];
    if (!targetMarker) return;

    const targetPos = targetMarker.object3D.position;

    // Posisikan container di kaki dan hadapkan ke target
    ringContainer.object3D.position.set(camPos.x, camPos.y - 1.2, camPos.z); 
    ringContainer.object3D.lookAt(targetPos.x, camPos.y - 1.2, targetPos.z);

    // Hitung langkah agar berhenti 2 meter sebelum lokasi (biar tidak bablas)
    const safeDistance = Math.max(0, distance - 2);
    const STEP_COUNT = Math.min(10, Math.floor(safeDistance / 1.0));
    
    for (let i = 1; i <= STEP_COUNT; i++) {
        const spacing = i * 1.0; 
        
        const group = document.createElement('a-entity');
        group.setAttribute('position', `0 0 ${spacing}`);
        group.setAttribute('rotation', '-90 0 0'); // Tidurkan di lantai

        // Ganti segitiga jadi Bulatan (Circle)
        const dot = document.createElement('a-circle');
        dot.setAttribute('radius', '0.3'); // Ukuran bulatan
        dot.setAttribute('color', '#3B82F6');
        dot.setAttribute('material', `shader: flat; opacity: ${1 - (i/(STEP_COUNT+1))}; transparent: true`);
        
        // Animasi "Berdenyut" (Pulses) agar lebih estetik
        dot.setAttribute('animation', `
            property: scale;
            from: 0.8 0.8 0.8;
            to: 1.2 1.2 1.2;
            dur: 1000;
            delay: ${i * 200};
            dir: alternate;
            loop: true;
            easing: easeInOutSine
        `);

        group.appendChild(dot);
        ringContainer.appendChild(group);
    }
}

</script>


</body>
</html>
