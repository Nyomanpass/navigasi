<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Objek Wisata - Pniel</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-gray-50">

        <header class="bg-orange-900 text-white pt-12 pb-20 px-6 rounded-b-[3rem] shadow-xl">
        <div class="max-w-4xl mx-auto text-center">
            <a href="<?= base_url() ?>" class="inline-flex items-center text-orange-200 hover:text-white transition mb-6 text-sm font-bold uppercase tracking-widest">
                <i class="fa-solid fa-arrow-left mr-2"></i> Kembali
            </a>
            <h1 class="text-3xl md:text-5xl font-black uppercase tracking-tighter">Objek Wisata</h1>
            <p class="mt-4 text-orange-100 opacity-80 text-sm md:text-base max-w-xl mx-auto">
               GKPB Jemaat Pniel Blimbingsari
            </p>
        </div>
    </header>

    <main class="container mx-auto px-6 -mt-16 pb-20">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <?php foreach($wisata as $w): ?>
            <div class="bg-white rounded-[2.5rem] shadow-xl overflow-hidden border border-gray-100 flex flex-col">
                <div class="h-56 overflow-hidden">
                    <img src="<?= base_url('assets/img/'.$w->gambar) ?>" class="w-full h-full object-cover">
                </div>
              <div class="p-8">
                <span class="text-[10px] font-black text-orange-700 uppercase tracking-[0.2em]"><?= $w->kategori ?></span>
                <h2 class="text-xl font-black text-gray-800 uppercase mt-1 leading-tight"><?= $w->nama_id ?></h2>
                
                <p class="text-gray-500 mt-3 text-sm line-clamp-2"><?= $w->deskripsi_id ?></p>
                
                <a href="<?= base_url('objekwisata/detail/'.$w->id) ?>" class="mt-6 inline-flex items-center text-orange-900 font-black text-xs uppercase tracking-widest hover:gap-3 transition-all">
                    Lihat Detail <i class="fa-solid fa-arrow-right ml-2"></i>
                </a>
            </div>
            </div>
            <?php endforeach; ?>
        </div>
    </main>
    <footer class="text-center py-10 text-gray-400 text-[10px] uppercase tracking-widest font-bold">
        &copy; 2026 GKPB Jemaat "Pniel" Blimbingsari
    </footer>
</body>
</html>