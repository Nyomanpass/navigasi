<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Navigasi GPS AR - Wisata</title>
    
    <script src="https://aframe.io/releases/1.3.0/aframe.min.js"></script>
    <script src="https://raw.githack.com/AR-js-org/AR.js/master/aframe/build/aframe-ar-nft.js"></script>
    <script src="https://unpkg.com/aframe-look-at-component@0.8.0/dist/aframe-look-at-component.min.js"></script>

    <style>
        #nav-arrow {
            position: fixed;
            bottom: 140px;
            left: 50%;
            transform: translateX(-50%) rotate(0deg);
            width: 80px;
            z-index: 1001;
            transition: transform 0.3s ease;
            pointer-events: none;
        }
        /* Fix tampilan kamera agar tidak gepeng */
        #arjs-video {
            width: 100vw !important;
            height: 100vh !important;
            object-fit: cover !important;
        }
    </style>
</head>

<body style="margin: 0; overflow: hidden;">

<a-scene 
    vr-mode-ui="enabled: false"
    embedded 
    arjs="sourceType: webcam; debugUIEnabled: false; videoTexture: true;">
    
    <a-assets>
        <img id="pin-lokasi" src="<?= base_url('assets/lokasi.png') ?>">
    </a-assets>
    
    <?php foreach($waypoints as $idx => $w): ?>
    <a-entity 
        class="marker-ar"
        id="marker-<?= $idx ?>"
        gps-projected-entity-place="latitude: <?= $w->lat ?>; longitude: <?= $w->lng ?>;"
        visible="false" 
        look-at="[gps-camera]"
        scale="10 10 10"> 
        
        <a-image 
            src="#pin-lokasi" 
            position="0 2 0" 
            width="1.2" 
            height="1.5"
            material="transparent: true; alphaTest: 0.5; shader: flat">
        </a-image>

        <a-ring color="#00FF00" radius-inner="0.3" radius-outer="0.5" rotation="-90 0 0"></a-ring>
        
        <a-entity position="0 1 0">
             <a-plane width="1.5" height="0.4" color="white" opacity="0.9"></a-plane>
             <a-text value="TITIK <?= $idx + 1 ?>" color="black" align="center" width="4" position="0 0 0.01"></a-text>
        </a-entity>
    </a-entity>
    <?php endforeach; ?>

    <a-camera gps-projected-camera="far: 10000;" rotation-reader></a-camera>
</a-scene>

<img src="<?= base_url('assets/arrow.png') ?>" id="nav-arrow">

<div id="ui-panel" style="position: fixed; bottom: 30px; width: 100%; text-align: center; z-index: 1000; font-family: sans-serif;">
    <div style="background: rgba(0,0,0,0.85); color: white; display: inline-block; padding: 20px; border-radius: 20px; border: 2px solid #00FF00; width: 85%; max-width: 400px;">
        <span>NAVIGASI: <b><?= strtoupper($tujuan) ?></b></span>
        <hr>
        <small id="status">📍 Mencari GPS...</small>
        <div id="dist-info" style="font-size: 1.5em; color:#00FF00;">-- m</div>
    </div>
</div>

<script>
    const waypoints = <?= json_encode($waypoints) ?>;
    let currentIndex = 0;
    const arrow = document.getElementById("nav-arrow");

    // FUNGSI BARU: Mengatur gambar mana yang boleh muncul
    function syncMarkers() {
        const allMarkers = document.querySelectorAll('.marker-ar');
        allMarkers.forEach((m, i) => {
            // Tampilkan hanya marker yang indexnya sesuai currentIndex
            if (i === currentIndex) {
                m.setAttribute('visible', 'true');
            } else {
                m.setAttribute('visible', 'false');
            }
        });
    }

    /* LOGIKA JARAK & BEARING (ASLI MILIKMU) */
    function getDistance(lat1, lon1, lat2, lon2) {
        const R = 6371e3;
        const φ1 = lat1 * Math.PI/180;
        const φ2 = lat2 * Math.PI/180;
        const Δφ = (lat2-lat1) * Math.PI/180;
        const Δλ = (lon2-lon1) * Math.PI/180;
        const a = Math.sin(Δφ/2)**2 + Math.cos(φ1)*Math.cos(φ2)*Math.sin(Δλ/2)**2;
        return Math.round(R * 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1-a)));
    }

    function calculateBearing(lat1, lon1, lat2, lon2) {
        const toRad = d => d * Math.PI / 180;
        const toDeg = r => r * 180 / Math.PI;
        let dLon = toRad(lon2 - lon1);
        let y = Math.sin(dLon) * Math.cos(toRad(lat2));
        let x = Math.cos(toRad(lat1))*Math.sin(toRad(lat2)) - Math.sin(toRad(lat1))*Math.cos(toRad(lat2))*Math.cos(dLon);
        return (toDeg(Math.atan2(y, x)) + 360) % 360;
    }

    let deviceHeading = 0;
    window.addEventListener("deviceorientationabsolute", e => {
        if (e.alpha !== null) deviceHeading = 360 - e.alpha;
    }, true);

    window.addEventListener('gps-camera-update-position', e => {
        if (currentIndex >= waypoints.length) return;

        // SETIAP UPDATE POSISI, JALANKAN SYNC MARKER
        syncMarkers();

        const uLat = e.detail.position.latitude;
        const uLng = e.detail.position.longitude;
        const target = waypoints[currentIndex];

        const dist = getDistance(uLat, uLng, target.lat, target.lng);
        
        document.getElementById("status").innerText = "Menuju Titik " + (currentIndex + 1);
        document.getElementById("dist-info").innerText = dist + " Meter";

        if (dist <= 6) {
            if (window.navigator.vibrate) window.navigator.vibrate(200);

            if (currentIndex === waypoints.length - 1) {
                arrow.style.display = "none";
                currentIndex++;
                syncMarkers(); 
                document.getElementById("ui-panel").innerHTML = "<div style='background:#00FF00; color:black; padding:20px; border-radius:15px;'>🎉 TIBA DI LOKASI!</div>";
                return;
            } else {
                currentIndex++;
                syncMarkers(); // Langsung hilangkan gambar lama, munculkan gambar baru
            }
        }

        const bearing = calculateBearing(uLat, uLng, target.lat, target.lng);
        const rot = bearing - deviceHeading;
        arrow.style.transform = `translateX(-50%) rotate(${rot}deg)`;
    });
</script>

</body>
</html>