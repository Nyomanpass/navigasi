<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Navigasi Wisata AR</title>
    <style>
        body { font-family: 'Arial', sans-serif; background: #f4f4f4; display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0; }
        .card { background: white; padding: 2rem; border-radius: 15px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); width: 90%; max-width: 400px; }
        select, button { width: 100%; padding: 12px; margin: 10px 0; border-radius: 8px; border: 1px solid #ddd; }
        button { background: #28a745; color: white; border: none; font-weight: bold; cursor: pointer; }
        button:hover { background: #218838; }
    </style>
</head>
<body>
    <div class="card">
        <h2>📍 Navigasi Wisata</h2>
        <form action="<?= base_url('navigasi/mulai') ?>" method="post">
    <label>Anda berada di:</label>
    <select name="asal">
        <?php foreach($lokasi_asal as $a): ?>
            <option value="<?= $a->titik_awal ?>"><?= ucwords(str_replace('_', ' ', $a->titik_awal)) ?></option>
        <?php endforeach; ?>
    </select>

    <label>Mau pergi ke:</label>
    <select name="tujuan">
        <?php foreach($lokasi_tujuan as $t): ?>
            <option value="<?= $t->tujuan ?>"><?= ucwords(str_replace('_', ' ', $t->tujuan)) ?></option>
        <?php endforeach; ?>
    </select>

    <button type="submit">MULAI NAVIGASI AR</button>
</form>
    </div>
</body>
</html>