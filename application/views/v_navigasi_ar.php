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
</head>

<body class="m-0 bg-black overflow-hidden">

<div class="fixed inset-0 flex flex-col">

    <!-- ================= CAMERA AREA ================= -->
    <div class="relative flex-1 bg-black overflow-hidden">

        <a-scene
            embedded
            vr-mode-ui="enabled:false"
            renderer="precision: mediump"
            arjs="sourceType: webcam; 
                videoTexture: true; 
                debugUIEnabled: false;
                facingMode: environment;"
            class="absolute inset-0"
        >

            <a-assets>
                <img id="pin" src="<?= base_url('assets/lokasi.png') ?>">
            </a-assets>

            <?php foreach($waypoints as $i => $w): ?>
            <a-entity
                class="marker-ar"
                gps-projected-entity-place="latitude:<?= $w->lat ?>; longitude:<?= $w->lng ?>;"
                scale="0 0 0"
                look-at="[gps-camera]">

                <a-image src="#pin" width="3" height="3"
                         material="shader:flat; transparent:true"></a-image>

                <a-ring radius-inner="0.6" radius-outer="0.8"
                        color="#00FF00" rotation="-90 0 0"></a-ring>
            </a-entity>
            <?php endforeach; ?>

            <a-camera gps-projected-camera rotation-reader></a-camera>
        </a-scene>

        <!-- PANAH NAVIGASI -->
        <img
            id="nav-arrow"
            src="<?= base_url('assets/arrow.png') ?>"
            class="fixed bottom-36 left-1/2  w-16 z-50 pointer-events-none transition-transform duration-100"
        />

    </div>

    <!-- ================= UI AREA ================= -->
    <div class="bg-black/80 text-white px-4 py-4">

        <div class="mx-auto max-w-md bg-black/70 rounded-2xl p-4 text-center">
            <b class="block text-lg">NAVIGASI <?= strtoupper($tujuan) ?></b>
            <hr class="border-white/20 my-2">
            <small id="status">Mencari GPS...</small>
            <div id="dist-info" class="text-2xl text-green-400 mt-1">-- m</div>
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

        arrow.style.transform =
            `translateX(-50%) rotate(${bearing}deg)`;
    } else {
        // DIAM → kunci arah terakhir
        arrow.style.transform =
            `translateX(-50%) rotate(${lastBearing}deg)`;
    }

});

document.addEventListener('DOMContentLoaded', syncMarkers);
</script>

</body>
</html>
