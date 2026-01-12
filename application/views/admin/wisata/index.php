<div class="max-w mx-auto">
    <div class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-2xl font-black text-gray-900 uppercase tracking-tighter">Data Objek Wisata</h1>
            <p class="text-gray-500 text-xs font-bold uppercase tracking-widest mt-1">Kelola konten multibahasa dan aset AR</p>
        </div>
        <button onclick="document.getElementById('modalTambahWisata').classList.remove('hidden')" class="bg-orange-900 text-white px-6 py-3 rounded-2xl font-black text-xs uppercase tracking-widest hover:bg-orange-800 shadow-xl transition-all">
            <i class="fa-solid fa-plus mr-2"></i> Tambah Data
        </button>
    </div>

    <div class="bg-white rounded-[2.5rem] shadow-xl overflow-hidden border border-gray-100">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-50 border-b border-gray-100">
                    <th class="px-6 py-4 text-[10px] font-black uppercase text-gray-400">Media & Nama</th>
                    <th class="px-6 py-4 text-[10px] font-black uppercase text-gray-400">Detail Deskripsi (ID/EN)</th>
                    <th class="px-6 py-4 text-[10px] font-black uppercase text-gray-400">Makna Filosofis</th>
                    <th class="px-6 py-4 text-[10px] font-black uppercase text-gray-400 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                <?php foreach($wisata as $w): ?>
                <tr class="hover:bg-orange-50/20 transition-all">
                    <td class="px-6 py-6 align-top min-w-[200px]">
                        <div class="space-y-3">
                            <img src="<?= base_url('assets/uploads/'.$w->gambar) ?>" class="w-full h-64 object-cover rounded-2xl shadow-md border-2 border-white">
                            <div>
                                <p class="font-black text-gray-800 text-sm leading-tight"><?= $w->nama_id ?></p>
                                <p class="text-[10px] text-orange-700 font-bold italic uppercase tracking-tighter"><?= $w->nama_eng ?></p>
                                <span class="inline-block mt-2 bg-gray-100 text-gray-500 text-[8px] font-black px-2 py-0.5 rounded uppercase"><?= $w->kategori ?></span>
                            </div>
                        </div>
                    </td>

                    <td class="px-6 py-6 align-top">
                        <div class="max-w-xs space-y-3">
                            <div class="text-[11px] text-gray-600 leading-relaxed line-clamp-3">
                                <span class="text-[9px] font-black text-gray-300 mr-1 uppercase">ID:</span>
                                <?= $w->deskripsi_id ?>
                            </div>
                            <div class="text-[11px] text-gray-400 leading-relaxed italic border-t border-gray-50 pt-2 line-clamp-3">
                                <span class="text-[9px] font-black text-gray-300 mr-1 uppercase">EN:</span>
                                <?= $w->deskripsi_eng ?>
                            </div>
                        </div>
                    </td>

                    <td class="px-6 py-6 align-top">
                        <div class="max-w-xs space-y-3 bg-gray-50/50 p-3 rounded-xl border border-gray-100">
                            <div class="text-[11px] text-gray-600 leading-relaxed">
                                <p class="text-[8px] font-black text-orange-900/30 uppercase mb-1 tracking-widest">Filosofi ID</p>
                                <?= $w->filosofi_id ?: '<span class="text-gray-300 italic">Tidak ada data</span>' ?>
                            </div>
                            <div class="text-[11px] text-gray-400 leading-relaxed italic border-t border-gray-100 pt-2">
                                <p class="text-[8px] font-black text-orange-900/30 uppercase mb-1 tracking-widest">Philosophy EN</p>
                                <?= $w->filosofi_eng ?: '<span class="text-gray-300 italic">No data</span>' ?>
                            </div>
                        </div>
                    </td>

                    <td class="px-6 py-6 align-top">
                        <div class="flex flex-col space-y-2 items-center">
                            <button onclick="editWisata(<?= htmlspecialchars(json_encode($w)) ?>)" class="w-10 h-10 bg-blue-50 text-blue-600 rounded-xl flex items-center justify-center hover:bg-blue-600 hover:text-white transition-all shadow-sm">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </button>
                            <a href="<?= base_url('admin/objek_wisata/hapus/'.$w->id) ?>" onclick="return confirm('Hapus destinasi ini?')" class="w-10 h-10 bg-red-50 text-red-600 rounded-xl flex items-center justify-center hover:bg-red-600 hover:text-white transition-all shadow-sm">
                                <i class="fa-solid fa-trash-can"></i>
                            </a>
                        </div>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<div id="modalTambahWisata" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black/50 backdrop-blur-sm p-4 overflow-y-auto">
    <div class="bg-white w-full max-w-4xl rounded-[2.5rem] p-8 md:p-10 shadow-2xl my-8">
        <div class="flex justify-between items-center mb-8">
            <h2 class="text-xl font-black uppercase tracking-tighter text-gray-900">Tambah Destinasi Baru</h2>
            <button onclick="document.getElementById('modalTambahWisata').classList.add('hidden')" class="text-gray-400 hover:text-red-500 transition-colors">
                <i class="fa-solid fa-xmark text-2xl"></i>
            </button>
        </div>

        <form action="<?= base_url('admin/objek_wisata/simpan') ?>" method="POST" enctype="multipart/form-data" class="space-y-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest ml-1">Nama (ID)</label>
                    <input type="text" name="nama_id" required class="w-full bg-gray-50 border-2 border-gray-100 p-3 rounded-xl focus:border-orange-900 outline-none font-bold">
                </div>
                <div>
                    <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest ml-1">Nama (ENG)</label>
                    <input type="text" name="nama_eng" required class="w-full bg-gray-50 border-2 border-gray-100 p-3 rounded-xl focus:border-orange-900 outline-none font-bold italic">
                </div>
                
                <div>
                    <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest ml-1">Kategori</label>
                    <select name="kategori" class="w-full bg-gray-50 border-2 border-gray-100 p-3 rounded-xl focus:border-orange-900 outline-none font-bold">
                        <option value="Sejarah">Sejarah</option>
                        <option value="Budaya">Budaya</option>
                        <option value="Religi">Religi</option>
                        <option value="Alam">Alam</option>
                    </select>
                </div>
                <div>
                    <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest ml-1">Foto Objek</label>
                    <input type="file" name="gambar" class="w-full bg-gray-50 border-2 border-dashed border-gray-100 p-2 rounded-xl text-xs">
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest ml-1">Deskripsi (ID)</label>
                    <textarea name="deskripsi_id" rows="3" class="w-full bg-gray-50 border-2 border-gray-100 p-3 rounded-xl outline-none focus:border-orange-900 text-sm"></textarea>
                </div>
                <div>
                    <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest ml-1">Deskripsi (ENG)</label>
                    <textarea name="deskripsi_eng" rows="3" class="w-full bg-gray-50 border-2 border-gray-100 p-3 rounded-xl outline-none focus:border-orange-900 text-sm italic"></textarea>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest ml-1">Filosofi (ID)</label>
                    <textarea name="filosofi_id" rows="2" class="w-full bg-gray-50 border-2 border-gray-100 p-3 rounded-xl outline-none focus:border-orange-900 text-sm"></textarea>
                </div>
                <div>
                    <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest ml-1">Filosofi (ENG)</label>
                    <textarea name="filosofi_eng" rows="2" class="w-full bg-gray-50 border-2 border-gray-100 p-3 rounded-xl outline-none focus:border-orange-900 text-sm italic"></textarea>
                </div>
            </div>

            <button type="submit" class="w-full bg-orange-900 text-white font-black py-4 rounded-2xl shadow-lg hover:bg-orange-800 transition-all uppercase tracking-widest text-xs">
                Simpan Destinasi
            </button>
        </form>
    </div>
</div>


<div id="modalEditWisata" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black/50 backdrop-blur-sm p-4 overflow-y-auto">
    <div class="bg-white w-full max-w-4xl rounded-[2.5rem] p-8 md:p-10 shadow-2xl my-8">
        <div class="flex justify-between items-center mb-8">
            <h2 class="text-xl font-black uppercase tracking-tighter text-gray-900">Edit Destinasi</h2>
            <button onclick="document.getElementById('modalEditWisata').classList.add('hidden')" class="text-gray-400 hover:text-red-500">
                <i class="fa-solid fa-xmark text-2xl"></i>
            </button>
        </div>

        <form action="<?= base_url('admin/objek_wisata/update') ?>" method="POST" enctype="multipart/form-data" class="space-y-6">
            <input type="hidden" name="id" id="edit_id">
            <input type="hidden" name="old_gambar" id="edit_old_gambar">

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest ml-1">Nama (ID)</label>
                    <input type="text" name="nama_id" id="edit_nama_id" required class="w-full bg-gray-50 border-2 border-gray-100 p-3 rounded-xl focus:border-orange-900 outline-none font-bold">
                </div>
                <div>
                    <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest ml-1">Nama (ENG)</label>
                    <input type="text" name="nama_eng" id="edit_nama_eng" required class="w-full bg-gray-50 border-2 border-gray-100 p-3 rounded-xl focus:border-orange-900 outline-none font-bold italic">
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest ml-1">Kategori</label>
                    <select name="kategori" id="edit_kategori" class="w-full bg-gray-50 border-2 border-gray-100 p-3 rounded-xl focus:border-orange-900 outline-none font-bold">
                        <option value="Sejarah">Sejarah</option>
                        <option value="Budaya">Budaya</option>
                        <option value="Religi">Religi</option>
                        <option value="Alam">Alam</option>
                    </select>
                </div>
                <div>
                    <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest ml-1">Ganti Foto (Kosongkan jika tidak)</label>
                    <input type="file" name="gambar" class="w-full bg-gray-50 border-2 border-dashed border-gray-100 p-2 rounded-xl text-xs">
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest ml-1">Deskripsi (ID)</label>
                    <textarea name="deskripsi_id" id="edit_deskripsi_id" rows="4" class="w-full bg-gray-50 border-2 border-gray-100 p-3 rounded-xl outline-none focus:border-orange-900 text-sm font-medium"></textarea>
                </div>
                <div>
                    <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest ml-1">Description (ENG)</label>
                    <textarea name="deskripsi_eng" id="edit_deskripsi_eng" rows="4" class="w-full bg-gray-50 border-2 border-gray-100 p-3 rounded-xl outline-none focus:border-orange-900 text-sm font-medium italic"></textarea>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest ml-1">Filosofi (ID)</label>
                    <textarea name="filosofi_id" id="edit_filosofi_id" rows="2" class="w-full bg-gray-50 border-2 border-gray-100 p-3 rounded-xl outline-none focus:border-orange-900 text-sm"></textarea>
                </div>
                <div>
                    <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest ml-1">Filosofi (ENG)</label>
                    <textarea name="filosofi_eng" id="edit_filosofi_eng" rows="2" class="w-full bg-gray-50 border-2 border-gray-100 p-3 rounded-xl outline-none focus:border-orange-900 text-sm italic"></textarea>
                </div>
            </div>

            <button type="submit" class="w-full bg-orange-900 text-white font-black py-4 rounded-2xl shadow-lg hover:bg-orange-800 transition-all uppercase tracking-widest text-xs">
                Simpan Perubahan
            </button>
        </form>
    </div>
</div>




<script>
function editWisata(data) {
    // Input Hidden
    document.getElementById('edit_id').value = data.id;
    document.getElementById('edit_old_gambar').value = data.gambar;
    
    // Nama & Kategori
    document.getElementById('edit_nama_id').value = data.nama_id;
    document.getElementById('edit_nama_eng').value = data.nama_eng;
    document.getElementById('edit_kategori').value = data.kategori;
    
    // DESKRIPSI (Baru ditambahkan)
    document.getElementById('edit_deskripsi_id').value = data.deskripsi_id;
    document.getElementById('edit_deskripsi_eng').value = data.deskripsi_eng;
    
    // FILOSOFI
    document.getElementById('edit_filosofi_id').value = data.filosofi_id;
    document.getElementById('edit_filosofi_eng').value = data.filosofi_eng;

    // Tampilkan Modal
    document.getElementById('modalEditWisata').classList.remove('hidden');
}
</script>