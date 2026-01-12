<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $item->nama_id ?> - Detail</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-white">

    <div class="relative h-[50vh] md:h-[60vh] w-full">
        <img src="<?= base_url('assets/img/'.$item->gambar) ?>" class="w-full h-full object-cover">
        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent"></div>
        <a href="<?= base_url('objekwisata') ?>" class="absolute top-8 left-6 bg-white/20 backdrop-blur-md text-white p-3 rounded-full hover:bg-white hover:text-orange-900 transition">
            <i class="fa-solid fa-arrow-left text-xl"></i>
        </a>
    </div>

    <main class="max-w-4xl mx-auto px-6 -mt-20 relative z-10">
        <div class="bg-white rounded-[3rem] p-8 md:p-12 shadow-2xl">
            <div class="text-center mb-10">
                <span class="bg-orange-100 text-orange-900 px-4 py-1 rounded-full text-[10px] font-black uppercase tracking-[0.2em]">
                    <?= $item->kategori ?>
                </span>
                <h1 class="text-3xl md:text-5xl font-black text-gray-800 uppercase mt-4 tracking-tighter"><?= $item->nama_id ?></h1>
                <p class="text-gray-400 italic mt-1 uppercase text-sm font-bold tracking-widest"><?= $item->nama_eng ?></p>
            </div>

            <div class="bg-orange-50 p-6 rounded-[2rem] border-l-8 border-orange-900 mb-10">
                <h3 class="text-orange-900 font-black text-xs uppercase tracking-widest mb-2 flex items-center">
                    <i class="fa-solid fa-lightbulb mr-2"></i> Makna Filosofis
                </h3>
                <p class="text-gray-800 text-sm md:text-base leading-relaxed"><?= $item->filosofi_id ?></p>
                <p class="text-gray-500 text-xs italic mt-2"><?= $item->filosofi_eng ?></p>
            </div>

           <div class="space-y-8">
    <div>
        <h3 class="font-black text-gray-800 uppercase tracking-widest text-sm mb-4 border-b pb-2">Deskripsi Lengkap</h3>
        <p class="text-gray-600 leading-loose text-justify"><?= $item->deskripsi_id ?></p>
    </div>

    <div class="opacity-60 border-t pt-8">
        <h3 class="font-bold text-gray-500 uppercase tracking-widest text-xs mb-4">English Description</h3>
        <p class="text-gray-500 leading-relaxed italic text-sm"><?= $item->deskripsi_eng ?></p>
    </div>
</div>
        </div>
    </main>

    <footer class="py-12 text-center text-gray-400 text-[10px] uppercase tracking-widest font-bold">
        &copy; 2026 GKPB Jemaat Pniel Blimbingsari
    </footer>

</body>
</html>