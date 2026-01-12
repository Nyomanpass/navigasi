<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Navigasi Wisata - Pniel Blimbingsari</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-gray-50 font-sans antialiased text-gray-900">

    <header class="bg-orange-900 text-white pt-12 pb-24 px-6 rounded-b-[3rem] shadow-xl text-center">
        <div class="max-w-4xl mx-auto">
            <a href="<?= base_url() ?>" class="inline-flex items-center text-orange-200 hover:text-white transition mb-6 text-sm font-bold uppercase tracking-widest">
                <i class="fa-solid fa-arrow-left mr-2"></i> Kembali
            </a>
            <h1 class="text-3xl md:text-5xl font-black uppercase tracking-tighter">Navigasi Wisata</h1>
            <p class="mt-4 text-orange-100 opacity-80 text-sm md:text-base max-w-xl mx-auto uppercase tracking-widest">
                GKPB Jemaat "Pniel" Blimbingsari
            </p>
        </div>
    </header>

    <main class="container mx-auto px-6 -mt-12 pb-20">
        <div class="max-w-md mx-auto">
            
            <div class="bg-white p-8 md:p-10 rounded-[2.5rem] shadow-2xl border-t-8 border-orange-900">
                <form action="<?= base_url('navigasi/mulai') ?>" method="post" class="space-y-8">
                    
                    <div class="space-y-3">
                        <label class="flex items-center text-xs font-black text-gray-400 uppercase tracking-[0.2em] ml-1">
                            <i class="fa-solid fa-circle-dot mr-2 text-orange-700"></i>
                            Titik Keberangkatan
                        </label>
                        <div class="relative group">
                            <select name="asal" class="w-full appearance-none bg-gray-50 border-2 border-gray-100 text-gray-700 py-4 px-5 rounded-2xl focus:outline-none focus:border-orange-900 focus:bg-white transition-all font-bold">
                                <?php foreach($lokasi_asal as $a): ?>
                                    <option value="<?= $a->titik_awal ?>"><?= $a->nama_id ?></option>
                                <?php endforeach; ?>
                            </select>
                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-5 text-gray-400">
                                <i class="fa-solid fa-chevron-down"></i>
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-center -my-4 relative z-10">
                        <div class="bg-orange-50 w-10 h-10 rounded-full flex items-center justify-center border-4 border-white shadow-sm">
                            <i class="fa-solid fa-ellipsis-vertical text-orange-900"></i>
                        </div>
                    </div>

                    <div class="space-y-3">
                        <label class="flex items-center text-xs font-black text-gray-400 uppercase tracking-[0.2em] ml-1">
                            <i class="fa-solid fa-location-dot mr-2 text-green-700"></i>
                            Tujuan Destinasi
                        </label>
                        <div class="relative group">
                            <select name="tujuan" class="w-full appearance-none bg-gray-50 border-2 border-gray-100 text-gray-700 py-4 px-5 rounded-2xl focus:outline-none focus:border-orange-900 focus:bg-white transition-all font-bold">
                                <?php foreach($lokasi_tujuan as $t): ?>
                                    <option value="<?= $t->tujuan ?>"><?= $t->nama_id ?></option>
                                 <?php endforeach; ?>
                            </select>
                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-5 text-gray-400">
                                <i class="fa-solid fa-chevron-down"></i>
                            </div>
                        </div>
                    </div>

                    <div class="pt-6">
                        <button type="submit" class="w-full bg-orange-900 hover:bg-orange-800 text-white font-black py-5 rounded-2xl shadow-xl shadow-orange-900/20 transition-all active:scale-95 flex items-center justify-center space-x-3 uppercase tracking-widest text-sm">
                            <span>Mulai Navigasi AR</span>
                            <i class="fa-solid fa-camera-rotate text-lg"></i>
                        </button>
                    </div>
                </form>
            </div>

            <p class="mt-8 text-center text-gray-400 text-[10px] uppercase tracking-widest leading-relaxed px-10">
                Gunakan kamera smartphone Anda untuk melihat panduan arah secara langsung (Augmented Reality).
            </p>

        </div>
    </main>

    <footer class="text-center py-10 text-gray-400 text-[10px] uppercase tracking-widest font-bold">
        &copy; 2026 GKPB Jemaat "Pniel" Blimbingsari
    </footer>

</body>
</html>