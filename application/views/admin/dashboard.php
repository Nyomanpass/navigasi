<div class="max-w-7xl mx-auto">
    <div class="mb-8">
        <h1 class="text-2xl font-black text-gray-900 uppercase tracking-tighter">Selamat Datang, <?= $this->session->userdata('username'); ?>!</h1>
        <p class="text-gray-500 text-xs font-bold uppercase tracking-widest mt-1">Panel Kendali Navigasi Wisata Pniel Blimbingsari</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
        <div class="bg-white p-6 rounded-[2rem] shadow-xl shadow-orange-900/5 border border-gray-100">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Objek Wisata</p>
                    <h3 class="text-3xl font-black text-orange-900 mt-1">12</h3>
                </div>
                <div class="w-12 h-12 bg-orange-50 rounded-2xl flex items-center justify-center text-orange-900">
                    <i class="fa-solid fa-map-location-dot text-xl"></i>
                </div>
            </div>
        </div>
        </div>

    <div class="bg-orange-900 rounded-[2.5rem] p-8 text-white shadow-2xl relative overflow-hidden">
        <div class="relative z-10">
            <h2 class="text-xl font-black uppercase">Mulai Kelola Data</h2>
            <p class="text-orange-200 text-xs mt-2 opacity-80 uppercase tracking-widest">Pilih menu di sidebar untuk menambah atau mengubah data navigasi AR.</p>
        </div>
        <i class="fa-solid fa-route absolute -right-10 -bottom-10 text-[15rem] text-white opacity-5"></i>
    </div>
</div>