<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - Pniel Blimbingsari</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-gray-50 font-sans antialiased" x-data="{ sidebarOpen: false }">

    <div class="flex h-screen overflow-hidden">
        
    <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'" 
        class="fixed inset-y-0 left-0 z-30 w-64 transition duration-300 transform bg-orange-900 lg:translate-x-0 lg:static lg:inset-0 shadow-xl flex-shrink-0">
        
        <div class="flex items-center justify-center h-20 shadow-md">
            <span class="text-white text-xl font-black uppercase tracking-tighter">Admin Pniel</span>
        </div>

        <nav class="mt-6 px-4 space-y-2">
            <?php 
                // Ambil segment ke-2 dari URL (dashboard, objek_wisata, dll)
                $segment = $this->uri->segment(2); 
            ?>

            <a href="<?= base_url('admin/dashboard') ?>" 
            class="flex items-center px-4 py-3 text-orange-100 hover:bg-orange-800 rounded-2xl transition-all font-bold text-sm tracking-wide <?= ($segment == 'dashboard') ? 'bg-orange-800/80 shadow-inner' : '' ?>">
                <i class="fa-solid fa-house mr-3 w-5 text-center"></i> Dashboard
            </a>

            <a href="<?= base_url('admin/objek_wisata') ?>" 
            class="flex items-center px-4 py-3 text-orange-100 hover:bg-orange-800 rounded-2xl transition-all font-bold text-sm tracking-wide <?= ($segment == 'objek_wisata') ? 'bg-orange-800/80 shadow-inner' : '' ?>">
                <i class="fa-solid fa-map-location-dot mr-3 w-5 text-center"></i> Objek Wisata
            </a>

            <a href="<?= base_url('admin/rules_wisata') ?>" 
            class="flex items-center px-4 py-3 text-orange-100 hover:bg-orange-800 rounded-2xl transition-all font-bold text-sm tracking-wide <?= ($segment == 'rules_wisata') ? 'bg-orange-800/80 shadow-inner' : '' ?>">
                <i class="fa-solid fa-clipboard-list mr-3 w-5 text-center"></i> Rules Wisata
            </a>

            <a href="<?= base_url('admin/rute') ?>" 
            class="flex items-center px-4 py-3 text-orange-100 hover:bg-orange-800 rounded-2xl transition-all font-bold text-sm tracking-wide <?= ($segment == 'rute') ? 'bg-orange-800/80 shadow-inner' : '' ?>">
                <i class="fa-solid fa-route mr-3 w-5 text-center"></i> Rute Navigasi
            </a>
            
            <div class="pt-10">
                <a href="<?= base_url('auth/logout') ?>" class="flex items-center px-4 py-3 text-orange-300 hover:text-white hover:bg-red-900 rounded-2xl transition-all font-bold text-sm tracking-wide border border-orange-800/50">
                    <i class="fa-solid fa-right-from-bracket mr-3 w-5 text-center"></i> Logout
                </a>
            </div>
        </nav>
    </aside>

        <div class="flex-1 flex flex-col overflow-hidden">
            
            <header class="flex items-center justify-between px-8 py-4 bg-white border-b border-gray-100 shadow-sm">
                <div class="flex items-center">
                    <button @click="sidebarOpen = true" class="text-gray-500 focus:outline-none lg:hidden">
                        <i class="fa-solid fa-bars text-xl"></i>
                    </button>
                    <h2 class="text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] hidden md:block">Sistem Navigasi Wisata AR</h2>
                </div>

                <div class="flex items-center space-x-4">
                    <div class="text-right mr-2 hidden sm:block">
                        <p class="text-[10px] font-black text-orange-900 uppercase">Admin Active</p>
                    </div>
                    <div class="w-10 h-10 rounded-2xl bg-orange-900 flex items-center justify-center text-white shadow-lg shadow-orange-900/20">
                        <i class="fa-solid fa-user-shield"></i>
                    </div>
                </div>
            </header>

            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-50 p-6 md:p-10">