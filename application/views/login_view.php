<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login Admin - Pniel Blimbingsari</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-gray-50 font-sans">

    <header class="bg-orange-900 text-white pt-12 pb-24 px-6 rounded-b-[3rem] shadow-xl text-center">
        <h1 class="text-3xl font-black uppercase">Admin Panel</h1>
        <p class="mt-2 text-orange-100 text-sm opacity-80 uppercase tracking-widest">GKPB Jemaat "Pniel" Blimbingsari</p>
    </header>

    <main class="container mx-auto px-6 -mt-12">
        <div class="max-w-md mx-auto bg-white p-8 rounded-[2.5rem] shadow-2xl border-t-8 border-orange-900">
            
            <?php if($this->session->flashdata('error')): ?>
                <div class="mb-6 p-4 bg-red-50 text-red-600 rounded-2xl text-[10px] font-bold uppercase border border-red-100">
                    <i class="fa-solid fa-circle-exclamation mr-2"></i> <?= $this->session->flashdata('error'); ?>
                </div>
            <?php endif; ?>

            <form action="<?= base_url('auth/login_process') ?>" method="post" class="space-y-6">
                <div class="space-y-3">
                    <label class="text-xs font-black text-gray-400 uppercase tracking-widest ml-1">Username</label>
                    <input type="text" name="username" required class="w-full bg-gray-50 border-2 border-gray-100 py-4 px-5 rounded-2xl focus:border-orange-900 outline-none font-bold">
                </div>

                <div class="space-y-3">
                    <label class="text-xs font-black text-gray-400 uppercase tracking-widest ml-1">Password</label>
                    <input type="password" name="password" required class="w-full bg-gray-50 border-2 border-gray-100 py-4 px-5 rounded-2xl focus:border-orange-900 outline-none font-bold">
                </div>

                <button type="submit" class="w-full bg-orange-900 hover:bg-orange-800 text-white font-black py-5 rounded-2xl shadow-xl transition-all active:scale-95 uppercase tracking-widest text-sm">
                    Masuk Sekarang <i class="fa-solid fa-right-to-bracket ml-2"></i>
                </button>
            </form>
        </div>
    </main>

</body>
</html>