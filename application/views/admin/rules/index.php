<div class="max-w mx-auto">
    <div class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-2xl font-black text-gray-900 uppercase tracking-tighter">Aturan Wisata (Rules)</h1>
            <p class="text-gray-500 text-xs font-bold uppercase tracking-widest mt-1">Kelola Do & Don'ts dalam dua bahasa</p>
        </div>
        <button onclick="document.getElementById('modalTambah').classList.remove('hidden')" class="bg-orange-900 text-white px-6 py-3 rounded-2xl font-black text-xs uppercase tracking-widest hover:bg-orange-800 shadow-xl transition-all">
            <i class="fa-solid fa-plus mr-2"></i> Tambah Aturan
        </button>
    </div>

    <div class="bg-white rounded-[2.5rem] shadow-xl overflow-hidden border border-gray-100">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-50 border-b border-gray-100">
                    <th class="px-6 py-4 text-[10px] font-black uppercase text-gray-400">Tipe</th>
                    <th class="px-6 py-4 text-[10px] font-black uppercase text-gray-400">Judul (ID / ENG)</th>
                    <th class="px-6 py-4 text-[10px] font-black uppercase text-gray-400">Deskripsi (ID / ENG)</th>
                    <th class="px-6 py-4 text-[10px] font-black uppercase text-gray-400 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                <?php foreach($rules as $r): ?>
                <tr class="hover:bg-orange-50/30 transition-all">
                    <td class="px-6 py-4 align-top">
                        <?php if($r->tipe == 'do'): ?>
                            <span class="bg-green-100 text-green-700 text-[9px] font-black px-3 py-1 rounded-full uppercase italic">Do</span>
                        <?php else: ?>
                            <span class="bg-red-100 text-red-700 text-[9px] font-black px-3 py-1 rounded-full uppercase italic">Don't</span>
                        <?php endif; ?>
                    </td>
                    <td class="px-6 py-4 align-top">
                        <div class="space-y-1">
                            <p class="font-bold text-gray-800 text-sm leading-tight"><?= $r->judul_id ?></p>
                            <p class="text-[10px] text-orange-700 font-bold italic uppercase tracking-tighter"><?= $r->judul_eng ?></p>
                        </div>
                    </td>
                    <td class="px-6 py-4 align-top">
                        <div class="max-w-md space-y-2">
                            <div class="text-xs text-gray-600 leading-relaxed italic">
                                <span class="text-[9px] font-black text-gray-300 mr-1">ID:</span>
                                <?= $r->deskripsi_id ?>
                            </div>
                            <div class="text-[11px] text-gray-400 leading-relaxed italic border-t border-gray-50 pt-1">
                                <span class="text-[9px] font-black text-gray-300 mr-1">EN:</span>
                                <?= $r->deskripsi_eng ?>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 align-top">
                        <div class="flex justify-center space-x-2">
                            <button onclick="editRules(<?= htmlspecialchars(json_encode($r)) ?>)" class="w-9 h-9 bg-blue-50 text-blue-600 rounded-xl flex items-center justify-center hover:bg-blue-600 hover:text-white transition-all">
                                <i class="fa-solid fa-pen-to-square text-xs"></i>
                            </button>
                            <a href="<?= base_url('admin/rules_wisata/hapus/'.$r->id) ?>" onclick="return confirm('Hapus aturan ini?')" class="w-9 h-9 bg-red-50 text-red-600 rounded-xl flex items-center justify-center hover:bg-red-600 hover:text-white transition-all">
                                <i class="fa-solid fa-trash text-xs"></i>
                            </a>
                        </div>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<div id="modalTambah" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black/50 backdrop-blur-sm p-4">
    <div class="bg-white w-full max-w-2xl rounded-[2.5rem] p-8 shadow-2xl">
        <div class="flex justify-between mb-6">
            <h2 class="text-xl font-black uppercase tracking-tighter">Tambah Rules Baru</h2>
            <button onclick="document.getElementById('modalTambah').classList.add('hidden')" class="text-gray-400 hover:text-red-500"><i class="fa-solid fa-xmark text-xl"></i></button>
        </div>
        <form action="<?= base_url('admin/rules_wisata/simpan') ?>" method="POST" class="space-y-4">
            <div class="grid grid-cols-2 gap-4">
                <input type="text" name="judul_id" placeholder="Judul (Indonesia)" required class="w-full bg-gray-50 border-2 border-gray-100 py-3 px-4 rounded-xl outline-none focus:border-orange-900 font-bold">
                <input type="text" name="judul_eng" placeholder="Title (English)" required class="w-full bg-gray-50 border-2 border-gray-100 py-3 px-4 rounded-xl outline-none focus:border-orange-900 font-bold italic">
            </div>
            <select name="tipe" class="w-full bg-gray-50 border-2 border-gray-100 py-3 px-4 rounded-xl outline-none focus:border-orange-900 font-bold uppercase text-xs">
                <option value="do">DO (Saran)</option>
                <option value="dont">DONT (Larangan)</option>
            </select>
            <textarea name="deskripsi_id" placeholder="Deskripsi (Indonesia)" rows="3" class="w-full bg-gray-50 border-2 border-gray-100 py-3 px-4 rounded-xl outline-none focus:border-orange-900"></textarea>
            <textarea name="deskripsi_eng" placeholder="Description (English)" rows="3" class="w-full bg-gray-50 border-2 border-gray-100 py-3 px-4 rounded-xl outline-none focus:border-orange-900 italic"></textarea>
            <button type="submit" class="w-full bg-orange-900 text-white font-black py-4 rounded-2xl shadow-lg uppercase tracking-widest text-xs">Simpan Rules</button>
        </form>
    </div>
</div>


<div id="modalEdit" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black/50 backdrop-blur-sm p-4">
    <div class="bg-white w-full max-w-2xl rounded-[2.5rem] p-8 shadow-2xl">
        <div class="flex justify-between mb-6">
            <h2 class="text-xl font-black uppercase tracking-tighter text-blue-600">Edit Rules</h2>
            <button onclick="document.getElementById('modalEdit').classList.add('hidden')" class="text-gray-400 hover:text-red-500"><i class="fa-solid fa-xmark text-xl"></i></button>
        </div>
        <form action="<?= base_url('admin/rules_wisata/update') ?>" method="POST" class="space-y-4">
            <input type="hidden" name="id" id="edit_id">
            
            <div class="grid grid-cols-2 gap-4">
                <input type="text" name="judul_id" id="edit_judul_id" required class="w-full bg-gray-50 border-2 border-gray-100 py-3 px-4 rounded-xl outline-none focus:border-blue-600 font-bold">
                <input type="text" name="judul_eng" id="edit_judul_eng" required class="w-full bg-gray-50 border-2 border-gray-100 py-3 px-4 rounded-xl outline-none focus:border-blue-600 font-bold italic">
            </div>
            
            <select name="tipe" id="edit_tipe" class="w-full bg-gray-50 border-2 border-gray-100 py-3 px-4 rounded-xl outline-none focus:border-blue-600 font-bold uppercase text-xs">
                <option value="do">DO (Saran)</option>
                <option value="dont">DONT (Larangan)</option>
            </select>
            
            <textarea name="deskripsi_id" id="edit_deskripsi_id" rows="3" class="w-full bg-gray-50 border-2 border-gray-100 py-3 px-4 rounded-xl outline-none focus:border-blue-600"></textarea>
            <textarea name="deskripsi_eng" id="edit_deskripsi_eng" rows="3" class="w-full bg-gray-50 border-2 border-gray-100 py-3 px-4 rounded-xl outline-none focus:border-blue-600 italic"></textarea>
            
            <button type="submit" class="w-full bg-orange-900 text-white font-black py-4 rounded-2xl shadow-lg uppercase tracking-widest text-xs">Simpan Perubahan</button>
        </form>
    </div>
</div>


<script>
function editRules(data) {
    // Isi data ke dalam modal
    document.getElementById('edit_id').value = data.id;
    document.getElementById('edit_judul_id').value = data.judul_id;
    document.getElementById('edit_judul_eng').value = data.judul_eng;
    document.getElementById('edit_tipe').value = data.tipe;
    document.getElementById('edit_deskripsi_id').value = data.deskripsi_id;
    document.getElementById('edit_deskripsi_eng').value = data.deskripsi_eng;

    // Tampilkan modal edit
    document.getElementById('modalEdit').classList.remove('hidden');
}
</script>