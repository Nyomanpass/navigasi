<div class="max-w mx-auto">
    <div class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-2xl font-black text-gray-900 uppercase tracking-tighter">Rute Navigasi AR</h1>
            <p class="text-gray-500 text-xs font-bold uppercase tracking-widest mt-1">Atur urutan titik jalan dan koordinat lokasi</p>
        </div>
        <button onclick="document.getElementById('modalTambahNav').classList.remove('hidden')" class="bg-orange-900 text-white px-6 py-3 rounded-2xl font-black text-xs uppercase tracking-widest hover:bg-orange-800 shadow-xl transition-all">
            <i class="fa-solid fa-route mr-2"></i> Tambah Rute
        </button>
    </div>

    <div class="bg-white rounded-[2.5rem] shadow-xl overflow-hidden border border-gray-100">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-50 border-b border-gray-100">
                    <th class="px-6 py-4 text-[10px] font-black uppercase text-gray-400 text-center">Urutan</th>
                    <th class="px-6 py-4 text-[10px] font-black uppercase text-gray-400">Rute (Asal ➜ Tujuan)</th>
                    <th class="px-6 py-4 text-[10px] font-black uppercase text-gray-400 text-center">AR (Y / Rotasi)</th>
                    <th class="px-6 py-4 text-[10px] font-black uppercase text-gray-400">Koordinat (Lat / Lng)</th>
                    <th class="px-6 py-4 text-[10px] font-black uppercase text-gray-400 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                <?php foreach($navigasi as $n): ?>
                <tr class="hover:bg-orange-50/30 transition-all">
                    <td class="px-6 py-4 text-center">
                        <span class="inline-block w-7 h-7 bg-gray-900 text-white text-[10px] font-black rounded-lg leading-7 italic"><?= $n->urutan ?></span>
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex items-center space-x-2">
                            <span class="text-sm font-bold text-gray-800"><?= $n->nama_asal ?></span>
                            <i class="fa-solid fa-chevron-right text-[9px] text-orange-500"></i>
                            <span class="text-sm font-bold text-orange-900"><?= $n->nama_tujuan ?></span>
                        </div>
                        <p class="text-[10px] text-gray-400 italic mt-0.5"><?= $n->keterangan ?: 'Tanpa keterangan' ?></p>
                    </td>
                    <td class="px-6 py-4 text-center">
                        <div class="text-[10px] font-bold space-x-2 text-gray-500">
                            <span class="bg-blue-50 text-blue-700 px-2 py-1 rounded">Y: <?= $n->pos_y ?></span>
                            <span class="bg-purple-50 text-purple-700 px-2 py-1 rounded">Rot: <?= $n->rotasi_y ?>°</span>
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        <div class="text-[10px] font-mono text-gray-500 bg-gray-50 p-2 rounded-xl inline-block border border-gray-100 italic">
                            <?= $n->lat ?>, <?= $n->lng ?>
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex justify-center space-x-2">
                            <button onclick="editNav(<?= htmlspecialchars(json_encode($n)) ?>)" class="w-9 h-9 bg-blue-50 text-blue-600 rounded-xl flex items-center justify-center hover:bg-blue-600 hover:text-white transition-all">
                                <i class="fa-solid fa-pen-to-square text-xs"></i>
                            </button>
                            <a href="<?= base_url('admin/navigasi/hapus/'.$n->id) ?>" onclick="return confirm('Hapus rute ini?')" class="w-9 h-9 bg-red-50 text-red-600 rounded-xl flex items-center justify-center hover:bg-red-600 hover:text-white transition-all">
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

<div id="modalTambahNav" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black/50 backdrop-blur-sm p-4 overflow-y-auto">
    <div class="bg-white w-full max-w-2xl rounded-[2.5rem] p-8 shadow-2xl my-auto">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-xl font-black uppercase tracking-tighter text-orange-900">Tambah Rute Baru</h2>
            <button onclick="document.getElementById('modalTambahNav').classList.add('hidden')" class="text-gray-400 hover:text-red-500"><i class="fa-solid fa-xmark text-xl"></i></button>
        </div>
        <form action="<?= base_url('admin/rute/simpan') ?>" method="POST" class="space-y-4">
            
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest ml-1">Titik Awal</label>
                    <select name="titik_awal" class="w-full bg-gray-50 border-2 border-gray-100 p-3 rounded-xl outline-none focus:border-orange-900 font-bold">
                        <option value="">-- Pilih Lokasi --</option>
                        <?php foreach($wisata as $w): ?>
                            <option value="<?= $w->id ?>"><?= $w->nama_id ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div>
                    <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest ml-1">Tujuan Akhir</label>
                    <select name="tujuan" class="w-full bg-gray-50 border-2 border-gray-100 p-3 rounded-xl outline-none focus:border-orange-900 font-bold">
                        <option value="">-- Pilih Lokasi --</option>
                        <?php foreach($wisata as $w): ?>
                            <option value="<?= $w->id ?>"><?= $w->nama_id ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

            <div class="grid grid-cols-3 gap-4">
                <div>
                    <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest ml-1">Urutan</label>
                    <input type="number" name="urutan" required placeholder="1" class="w-full bg-gray-50 border-2 border-gray-100 p-3 rounded-xl outline-none focus:border-orange-900 font-bold">
                </div>
                <div>
                    <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest ml-1">Posisi Y (AR)</label>
                    <input type="text" name="pos_y" value="-1.5" class="w-full bg-gray-50 border-2 border-gray-100 p-3 rounded-xl outline-none focus:border-orange-900 font-bold">
                </div>
                <div>
                    <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest ml-1">Rotasi Y</label>
                    <input type="number" name="rotasi_y" value="0" class="w-full bg-gray-50 border-2 border-gray-100 p-3 rounded-xl outline-none focus:border-orange-900 font-bold">
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest ml-1">Latitude</label>
                    <input type="text" name="lat" required placeholder="-8.xxx" class="w-full bg-gray-50 border-2 border-gray-100 p-3 rounded-xl outline-none focus:border-orange-900 font-bold text-blue-600">
                </div>
                <div>
                    <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest ml-1">Longitude</label>
                    <input type="text" name="lng" required placeholder="115.xxx" class="w-full bg-gray-50 border-2 border-gray-100 p-3 rounded-xl outline-none focus:border-orange-900 font-bold text-blue-600">
                </div>
            </div>

            <div>
                <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest ml-1">Keterangan Rute</label>
                <textarea name="keterangan" rows="2" placeholder="Contoh: Belok kanan setelah gerbang..." class="w-full bg-gray-50 border-2 border-gray-100 p-3 rounded-xl outline-none focus:border-orange-900"></textarea>
            </div>

            <button type="submit" class="w-full bg-orange-900 text-white font-black py-4 rounded-2xl shadow-lg uppercase tracking-widest text-xs">Simpan Rute</button>
        </form>
    </div>
</div>

<div id="modalEditNav" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black/50 backdrop-blur-sm p-4 overflow-y-auto">
    <div class="bg-white w-full max-w-2xl rounded-[2.5rem] p-8 shadow-2xl my-auto">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-xl font-black uppercase tracking-tighter text-blue-600">Update Rute Navigasi</h2>
            <button onclick="document.getElementById('modalEditNav').classList.add('hidden')" class="text-gray-400 hover:text-red-500"><i class="fa-solid fa-xmark text-xl"></i></button>
        </div>
        <form action="<?= base_url('admin/rute/update') ?>" method="POST" class="space-y-4">
            <input type="hidden" name="id" id="edit_id">
            
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest ml-1">Titik Awal</label>
                    <select name="titik_awal" id="edit_titik_awal" class="w-full bg-gray-50 border-2 border-gray-100 p-3 rounded-xl outline-none focus:border-blue-600 font-bold">
                        <?php foreach($wisata as $w): ?>
                            <option value="<?= $w->id ?>"><?= $w->nama_id ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div>
                    <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest ml-1">Tujuan Akhir</label>
                    <select name="tujuan" id="edit_tujuan" class="w-full bg-gray-50 border-2 border-gray-100 p-3 rounded-xl outline-none focus:border-blue-600 font-bold">
                        <?php foreach($wisata as $w): ?>
                            <option value="<?= $w->id ?>"><?= $w->nama_id ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

            <div class="grid grid-cols-3 gap-4">
                <div>
                    <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest ml-1">Urutan</label>
                    <input type="number" name="urutan" id="edit_urutan" required class="w-full bg-gray-50 border-2 border-gray-100 p-3 rounded-xl outline-none focus:border-blue-600 font-bold">
                </div>
                <div>
                    <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest ml-1">Posisi Y (AR)</label>
                    <input type="text" name="pos_y" id="edit_pos_y" class="w-full bg-gray-50 border-2 border-gray-100 p-3 rounded-xl outline-none focus:border-blue-600 font-bold">
                </div>
                <div>
                    <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest ml-1">Rotasi Y</label>
                    <input type="number" name="rotasi_y" id="edit_rotasi_y" class="w-full bg-gray-50 border-2 border-gray-100 p-3 rounded-xl outline-none focus:border-blue-600 font-bold">
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest ml-1">Latitude</label>
                    <input type="text" name="lat" id="edit_lat" required class="w-full bg-gray-50 border-2 border-gray-100 p-3 rounded-xl outline-none focus:border-blue-600 font-bold text-blue-600">
                </div>
                <div>
                    <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest ml-1">Longitude</label>
                    <input type="text" name="lng" id="edit_lng" required class="w-full bg-gray-50 border-2 border-gray-100 p-3 rounded-xl outline-none focus:border-blue-600 font-bold text-blue-600">
                </div>
            </div>

            <div>
                <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest ml-1">Keterangan Rute</label>
                <textarea name="keterangan" id="edit_keterangan" rows="2" class="w-full bg-gray-50 border-2 border-gray-100 p-3 rounded-xl outline-none focus:border-blue-600"></textarea>
            </div>

            <button type="submit" class="w-full bg-blue-600 text-white font-black py-4 rounded-2xl shadow-lg uppercase tracking-widest text-xs">Simpan Perubahan</button>
        </form>
    </div>
</div>

<script>
function editNav(data) {
    document.getElementById('edit_id').value = data.id;
    document.getElementById('edit_titik_awal').value = data.titik_awal;
    document.getElementById('edit_tujuan').value = data.tujuan;
    document.getElementById('edit_urutan').value = data.urutan;
    document.getElementById('edit_pos_y').value = data.pos_y;
    document.getElementById('edit_rotasi_y').value = data.rotasi_y;
    document.getElementById('edit_lat').value = data.lat;
    document.getElementById('edit_lng').value = data.lng;
    document.getElementById('edit_keterangan').value = data.keterangan;

    document.getElementById('modalEditNav').classList.remove('hidden');
}
</script>