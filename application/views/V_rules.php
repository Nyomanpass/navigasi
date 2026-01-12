<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rules - Pniel Blimbingsari</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-gray-50 font-sans antialiased text-gray-900">

    <header class="bg-orange-900 text-white pt-12 pb-20 px-6 rounded-b-[3rem] shadow-xl">
        <div class="max-w-4xl mx-auto text-center">
            <a href="<?= base_url() ?>" class="inline-flex items-center text-orange-200 hover:text-white transition mb-6 text-sm font-bold uppercase tracking-widest">
                <i class="fa-solid fa-arrow-left mr-2"></i> Kembali
            </a>
            <h1 class="text-3xl md:text-5xl font-black uppercase tracking-tighter">Visitor Rules</h1>
            <p class="mt-4 text-orange-100 opacity-80 text-sm md:text-base max-w-xl mx-auto">
                Mari menjaga kesucian dan kenyamanan bersama dengan mengikuti panduan kunjungan di GKPB Jemaat Pniel Blimbingsari.
            </p>
        </div>
    </header>

    <main class="container mx-auto px-6 mt-10 pb-20">
        <div class="max-w-5xl mx-auto grid md:grid-cols-2 gap-8">
            
            <div class="space-y-6">
                <div class="flex items-center space-x-3 p-2 ml-4">
                    <div class="bg-green-500 text-white w-10 h-10 rounded-full flex items-center justify-center shadow-lg">
                        <i class="fa-solid fa-check text-xl"></i>
                    </div>
                    <h2 class="text-2xl font-black uppercase tracking-tight text-green-700">Things To Do</h2>
                </div>

                <?php foreach($rules as $r): if($r->type == 'do'): ?>
                <div class="bg-white p-6 rounded-[2rem] shadow-md border-l-8 border-green-500 hover:shadow-xl transition-shadow">
                    <h3 class="font-black text-lg text-gray-800 uppercase tracking-tight"><?= $r->judul ?></h3>
                    <p class="text-gray-600 mt-2 text-sm leading-relaxed"><?= $r->deskripsi ?></p>
                </div>
                <?php endif; endforeach; ?>
            </div>

            <div class="space-y-6">
                <div class="flex items-center space-x-3 p-2 ml-4">
                    <div class="bg-red-500 text-white w-10 h-10 rounded-full flex items-center justify-center shadow-lg">
                        <i class="fa-solid fa-xmark text-xl"></i>
                    </div>
                    <h2 class="text-2xl font-black uppercase tracking-tight text-red-700">Things Not To Do</h2>
                </div>

                <?php foreach($rules as $r): if($r->type == 'dont'): ?>
                <div class="bg-white p-6 rounded-[2rem] shadow-md border-l-8 border-red-500 hover:shadow-xl transition-shadow">
                    <h3 class="font-black text-lg text-gray-800 uppercase tracking-tight"><?= $r->judul ?></h3>
                    <p class="text-gray-600 mt-2 text-sm leading-relaxed"><?= $r->deskripsi ?></p>
                </div>
                <?php endif; endforeach; ?>
            </div>

        </div>
    </main>

    <footer class="text-center py-10 text-gray-400 text-[10px] uppercase tracking-widest font-bold">
        &copy; 2026 GKPB Jemaat "Pniel" Blimbingsari
    </footer>

</body>
</html>