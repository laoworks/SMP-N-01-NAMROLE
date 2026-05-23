@extends('layouts.app')

@section('content')
<!-- Page Title Section -->
<section class="relative overflow-hidden bg-white">
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <div class="absolute top-0 right-0 w-[500px] h-[500px] rounded-full blur-3xl" style="background-color: var(--primary-50)"></div>
        <div class="absolute bottom-0 left-0 w-[400px] h-[400px] rounded-full blur-3xl opacity-30" style="background-color: var(--primary-50)"></div>
    </div>

    <div class="relative container mx-auto px-4 sm:px-6 lg:px-8 py-16 lg:py-20 text-center">
        <h1 class="text-4xl sm:text-5xl lg:text-6xl font-bold tracking-tight" style="color: var(--gray-900)">
            PPDB <span style="color: var(--primary)">Online</span>
        </h1>
        <div class="w-20 h-1 mx-auto mt-4 rounded-full" style="background-color: var(--primary)"></div>
        <p class="mt-4 text-lg max-w-2xl mx-auto" style="color: var(--gray-600)">
            Pendaftaran Peserta Didik Baru Tahun Ajaran {{ date('Y') }}/{{ date('Y')+1 }}
        </p>
    </div>
</section>

<!-- Info Pendaftaran -->
<section class="py-12 bg-white">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        @if($gelombangAktif)
            <div class="bg-green-50 border border-green-200 rounded-2xl p-6 mb-8 text-center">
                <div class="inline-flex items-center gap-2 bg-green-100 text-green-700 px-4 py-2 rounded-full mb-3">
                    <span class="w-2 h-2 rounded-full bg-green-500 animate-pulse"></span>
                    <span class="text-sm font-semibold">Pendaftaran Dibuka!</span>
                </div>
                <h3 class="text-xl font-bold text-green-800">{{ $gelombangAktif->nama_gelombang }}</h3>
                <p class="text-green-600 mt-1">
                    Periode: {{ \Carbon\Carbon::parse($gelombangAktif->periode_mulai)->format('d F Y') }} -
                    {{ \Carbon\Carbon::parse($gelombangAktif->periode_selesai)->format('d F Y') }}
                </p>
                @if($gelombangAktif->kuota)
                    <p class="text-green-600 mt-1">Kuota: {{ $gelombangAktif->kuota }} siswa</p>
                @endif
            </div>
        @else
            <div class="bg-yellow-50 border border-yellow-200 rounded-2xl p-6 mb-8 text-center">
                <div class="inline-flex items-center gap-2 bg-yellow-100 text-yellow-700 px-4 py-2 rounded-full mb-3">
                    <span class="w-2 h-2 rounded-full bg-yellow-500"></span>
                    <span class="text-sm font-semibold">Belum Dibuka</span>
                </div>
                <h3 class="text-xl font-bold text-yellow-800">Pendaftaran Belum Dibuka</h3>
                <p class="text-yellow-600 mt-1">Silakan cek informasi jadwal pendaftaran berikutnya</p>
            </div>
        @endif
    </div>
</section>

<!-- Form Pendaftaran -->
@if($gelombangAktif)
<section class="py-16 lg:py-20 bg-white">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-4xl mx-auto">
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden" style="border: 1px solid var(--primary-100)">
                <div class="p-6 bg-gradient-to-r" style="background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%)">
                    <h2 class="text-2xl font-bold text-white text-center">Formulir Pendaftaran Online</h2>
                    <p class="text-white/80 text-center mt-1">Isi data dengan lengkap dan benar</p>
                </div>

                <form action="{{ route('ppdb.store') }}" method="POST" enctype="multipart/form-data" class="p-6">
                    @csrf

                    <!-- Progress Steps -->
                    <div class="flex justify-between mb-8">
                        <div class="step-item active" id="step1-indicator">
                            <div class="step-circle">1</div>
                            <span class="step-label">Data Pribadi</span>
                        </div>
                        <div class="step-item" id="step2-indicator">
                            <div class="step-circle">2</div>
                            <span class="step-label">Kontak & Alamat</span>
                        </div>
                        <div class="step-item" id="step3-indicator">
                            <div class="step-circle">3</div>
                            <span class="step-label">Pendidikan</span>
                        </div>
                        <div class="step-item" id="step4-indicator">
                            <div class="step-circle">4</div>
                            <span class="step-label">Orang Tua</span>
                        </div>
                        <div class="step-item" id="step5-indicator">
                            <div class="step-circle">5</div>
                            <span class="step-label">Jurusan & Dokumen</span>
                        </div>
                    </div>

                    <!-- STEP 1: Data Pribadi -->
                    <div id="step1" class="step-content">
                        <h3 class="text-xl font-bold mb-4" style="color: var(--gray-800)">A. Data Pribadi</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium mb-1" style="color: var(--gray-700)">Nama Lengkap *</label>
                                <input type="text" name="nama_lengkap" required class="w-full px-4 py-2 rounded-lg border focus:outline-none focus:border-primary" style="border-color: var(--gray-200)" value="{{ old('nama_lengkap') }}">
                                @error('nama_lengkap') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>
                            <div>
                                <label class="block text-sm font-medium mb-1" style="color: var(--gray-700)">NIK</label>
                                <input type="text" name="nik" class="w-full px-4 py-2 rounded-lg border" style="border-color: var(--gray-200)" value="{{ old('nik') }}">
                            </div>
                            <div>
                                <label class="block text-sm font-medium mb-1" style="color: var(--gray-700)">Jenis Kelamin *</label>
                                <select name="jenis_kelamin" required class="w-full px-4 py-2 rounded-lg border" style="border-color: var(--gray-200)">
                                    <option value="">Pilih Jenis Kelamin</option>
                                    <option value="L" {{ old('jenis_kelamin') == 'L' ? 'selected' : '' }}>Laki-laki</option>
                                    <option value="P" {{ old('jenis_kelamin') == 'P' ? 'selected' : '' }}>Perempuan</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-medium mb-1" style="color: var(--gray-700)">Tempat Lahir</label>
                                <input type="text" name="tempat_lahir" class="w-full px-4 py-2 rounded-lg border" style="border-color: var(--gray-200)" value="{{ old('tempat_lahir') }}">
                            </div>
                            <div>
                                <label class="block text-sm font-medium mb-1" style="color: var(--gray-700)">Tanggal Lahir</label>
                                <input type="date" name="tanggal_lahir" class="w-full px-4 py-2 rounded-lg border" style="border-color: var(--gray-200)" value="{{ old('tanggal_lahir') }}">
                            </div>
                            <div>
                                <label class="block text-sm font-medium mb-1" style="color: var(--gray-700)">Agama</label>
                                <select name="agama" class="w-full px-4 py-2 rounded-lg border" style="border-color: var(--gray-200)">
                                    <option value="">Pilih Agama</option>
                                    <option value="Islam" {{ old('agama') == 'Islam' ? 'selected' : '' }}>Islam</option>
                                    <option value="Kristen" {{ old('agama') == 'Kristen' ? 'selected' : '' }}>Kristen</option>
                                    <option value="Katolik" {{ old('agama') == 'Katolik' ? 'selected' : '' }}>Katolik</option>
                                    <option value="Hindu" {{ old('agama') == 'Hindu' ? 'selected' : '' }}>Hindu</option>
                                    <option value="Buddha" {{ old('agama') == 'Buddha' ? 'selected' : '' }}>Buddha</option>
                                    <option value="Konghucu" {{ old('agama') == 'Konghucu' ? 'selected' : '' }}>Konghucu</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-medium mb-1" style="color: var(--gray-700)">Anak ke-</label>
                                <input type="number" name="anak_ke" class="w-full px-4 py-2 rounded-lg border" style="border-color: var(--gray-200)" value="{{ old('anak_ke') }}">
                            </div>
                            <div>
                                <label class="block text-sm font-medium mb-1" style="color: var(--gray-700)">Jumlah Saudara</label>
                                <input type="number" name="jumlah_saudara" class="w-full px-4 py-2 rounded-lg border" style="border-color: var(--gray-200)" value="{{ old('jumlah_saudara') }}">
                            </div>
                        </div>
                        <div class="mt-6 flex justify-end">
                            <button type="button" onclick="nextStep(2)" class="px-6 py-2 rounded-lg text-white transition" style="background: linear-gradient(135deg, var(--primary), var(--primary-dark))">Selanjutnya →</button>
                        </div>
                    </div>

                    <!-- STEP 2: Kontak & Alamat -->
                    <div id="step2" class="step-content" style="display: none;">
                        <h3 class="text-xl font-bold mb-4" style="color: var(--gray-800)">B. Kontak & Alamat</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium mb-1" style="color: var(--gray-700)">Email</label>
                                <input type="email" name="email" class="w-full px-4 py-2 rounded-lg border" style="border-color: var(--gray-200)" value="{{ old('email') }}">
                            </div>
                            <div>
                                <label class="block text-sm font-medium mb-1" style="color: var(--gray-700)">No. HP *</label>
                                <input type="tel" name="no_hp" required class="w-full px-4 py-2 rounded-lg border" style="border-color: var(--gray-200)" value="{{ old('no_hp') }}">
                            </div>
                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium mb-1" style="color: var(--gray-700)">Alamat</label>
                                <textarea name="alamat" rows="2" class="w-full px-4 py-2 rounded-lg border" style="border-color: var(--gray-200)">{{ old('alamat') }}</textarea>
                            </div>
                            <div>
                                <label class="block text-sm font-medium mb-1" style="color: var(--gray-700)">RT/RW</label>
                                <input type="text" name="rt_rw" class="w-full px-4 py-2 rounded-lg border" style="border-color: var(--gray-200)" value="{{ old('rt_rw') }}">
                            </div>
                            <div>
                                <label class="block text-sm font-medium mb-1" style="color: var(--gray-700)">Kelurahan</label>
                                <input type="text" name="kelurahan" class="w-full px-4 py-2 rounded-lg border" style="border-color: var(--gray-200)" value="{{ old('kelurahan') }}">
                            </div>
                            <div>
                                <label class="block text-sm font-medium mb-1" style="color: var(--gray-700)">Kecamatan</label>
                                <input type="text" name="kecamatan" class="w-full px-4 py-2 rounded-lg border" style="border-color: var(--gray-200)" value="{{ old('kecamatan') }}">
                            </div>
                            <div>
                                <label class="block text-sm font-medium mb-1" style="color: var(--gray-700)">Kota</label>
                                <input type="text" name="kota" class="w-full px-4 py-2 rounded-lg border" style="border-color: var(--gray-200)" value="{{ old('kota') }}">
                            </div>
                            <div>
                                <label class="block text-sm font-medium mb-1" style="color: var(--gray-700)">Provinsi</label>
                                <input type="text" name="provinsi" class="w-full px-4 py-2 rounded-lg border" style="border-color: var(--gray-200)" value="{{ old('provinsi') }}">
                            </div>
                        </div>
                        <div class="mt-6 flex justify-between">
                            <button type="button" onclick="prevStep(1)" class="px-6 py-2 rounded-lg border transition" style="border-color: var(--gray-300); color: var(--gray-600)">← Sebelumnya</button>
                            <button type="button" onclick="nextStep(3)" class="px-6 py-2 rounded-lg text-white transition" style="background: linear-gradient(135deg, var(--primary), var(--primary-dark))">Selanjutnya →</button>
                        </div>
                    </div>

                    <!-- STEP 3: Pendidikan Asal -->
                    <div id="step3" class="step-content" style="display: none;">
                        <h3 class="text-xl font-bold mb-4" style="color: var(--gray-800)">C. Pendidikan Asal</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium mb-1" style="color: var(--gray-700)">Asal Sekolah</label>
                                <input type="text" name="asal_sekolah" class="w-full px-4 py-2 rounded-lg border" style="border-color: var(--gray-200)" value="{{ old('asal_sekolah') }}">
                            </div>
                            <div>
                                <label class="block text-sm font-medium mb-1" style="color: var(--gray-700)">NISN</label>
                                <input type="text" name="nisn" class="w-full px-4 py-2 rounded-lg border" style="border-color: var(--gray-200)" value="{{ old('nisn') }}">
                            </div>
                            <div>
                                <label class="block text-sm font-medium mb-1" style="color: var(--gray-700)">Tahun Lulus</label>
                                <input type="number" name="tahun_lulus" class="w-full px-4 py-2 rounded-lg border" style="border-color: var(--gray-200)" value="{{ old('tahun_lulus') }}">
                            </div>
                            <div>
                                <label class="block text-sm font-medium mb-1" style="color: var(--gray-700)">Nomor Ijazah</label>
                                <input type="text" name="ijazah_number" class="w-full px-4 py-2 rounded-lg border" style="border-color: var(--gray-200)" value="{{ old('ijazah_number') }}">
                            </div>
                        </div>
                        <div class="mt-6 flex justify-between">
                            <button type="button" onclick="prevStep(2)" class="px-6 py-2 rounded-lg border transition" style="border-color: var(--gray-300); color: var(--gray-600)">← Sebelumnya</button>
                            <button type="button" onclick="nextStep(4)" class="px-6 py-2 rounded-lg text-white transition" style="background: linear-gradient(135deg, var(--primary), var(--primary-dark))">Selanjutnya →</button>
                        </div>
                    </div>

                    <!-- STEP 4: Data Orang Tua -->
                    <div id="step4" class="step-content" style="display: none;">
                        <h3 class="text-xl font-bold mb-4" style="color: var(--gray-800)">D. Data Orang Tua</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium mb-1" style="color: var(--gray-700)">Nama Ayah</label>
                                <input type="text" name="ayah_nama" class="w-full px-4 py-2 rounded-lg border" style="border-color: var(--gray-200)" value="{{ old('ayah_nama') }}">
                            </div>
                            <div>
                                <label class="block text-sm font-medium mb-1" style="color: var(--gray-700)">Pekerjaan Ayah</label>
                                <input type="text" name="ayah_pekerjaan" class="w-full px-4 py-2 rounded-lg border" style="border-color: var(--gray-200)" value="{{ old('ayah_pekerjaan') }}">
                            </div>
                            <div>
                                <label class="block text-sm font-medium mb-1" style="color: var(--gray-700)">Pendidikan Ayah</label>
                                <select name="ayah_pendidikan" class="w-full px-4 py-2 rounded-lg border" style="border-color: var(--gray-200)">
                                    <option value="">Pilih Pendidikan</option>
                                    <option value="SD" {{ old('ayah_pendidikan') == 'SD' ? 'selected' : '' }}>SD</option>
                                    <option value="SMP" {{ old('ayah_pendidikan') == 'SMP' ? 'selected' : '' }}>SMP</option>
                                    <option value="SMA" {{ old('ayah_pendidikan') == 'SMA' ? 'selected' : '' }}>SMA</option>
                                    <option value="D3" {{ old('ayah_pendidikan') == 'D3' ? 'selected' : '' }}>D3</option>
                                    <option value="S1" {{ old('ayah_pendidikan') == 'S1' ? 'selected' : '' }}>S1</option>
                                    <option value="S2" {{ old('ayah_pendidikan') == 'S2' ? 'selected' : '' }}>S2</option>
                                    <option value="S3" {{ old('ayah_pendidikan') == 'S3' ? 'selected' : '' }}>S3</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-medium mb-1" style="color: var(--gray-700)">No. HP Ayah</label>
                                <input type="text" name="ayah_no_hp" class="w-full px-4 py-2 rounded-lg border" style="border-color: var(--gray-200)" value="{{ old('ayah_no_hp') }}">
                            </div>
                            <div>
                                <label class="block text-sm font-medium mb-1" style="color: var(--gray-700)">Nama Ibu</label>
                                <input type="text" name="ibu_nama" class="w-full px-4 py-2 rounded-lg border" style="border-color: var(--gray-200)" value="{{ old('ibu_nama') }}">
                            </div>
                            <div>
                                <label class="block text-sm font-medium mb-1" style="color: var(--gray-700)">Pekerjaan Ibu</label>
                                <input type="text" name="ibu_pekerjaan" class="w-full px-4 py-2 rounded-lg border" style="border-color: var(--gray-200)" value="{{ old('ibu_pekerjaan') }}">
                            </div>
                            <div>
                                <label class="block text-sm font-medium mb-1" style="color: var(--gray-700)">Pendidikan Ibu</label>
                                <select name="ibu_pendidikan" class="w-full px-4 py-2 rounded-lg border" style="border-color: var(--gray-200)">
                                    <option value="">Pilih Pendidikan</option>
                                    <option value="SD" {{ old('ibu_pendidikan') == 'SD' ? 'selected' : '' }}>SD</option>
                                    <option value="SMP" {{ old('ibu_pendidikan') == 'SMP' ? 'selected' : '' }}>SMP</option>
                                    <option value="SMA" {{ old('ibu_pendidikan') == 'SMA' ? 'selected' : '' }}>SMA</option>
                                    <option value="D3" {{ old('ibu_pendidikan') == 'D3' ? 'selected' : '' }}>D3</option>
                                    <option value="S1" {{ old('ibu_pendidikan') == 'S1' ? 'selected' : '' }}>S1</option>
                                    <option value="S2" {{ old('ibu_pendidikan') == 'S2' ? 'selected' : '' }}>S2</option>
                                    <option value="S3" {{ old('ibu_pendidikan') == 'S3' ? 'selected' : '' }}>S3</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-medium mb-1" style="color: var(--gray-700)">No. HP Ibu</label>
                                <input type="text" name="ibu_no_hp" class="w-full px-4 py-2 rounded-lg border" style="border-color: var(--gray-200)" value="{{ old('ibu_no_hp') }}">
                            </div>
                            <div>
                                <label class="block text-sm font-medium mb-1" style="color: var(--gray-700)">Nama Wali (Opsional)</label>
                                <input type="text" name="wali_nama" class="w-full px-4 py-2 rounded-lg border" style="border-color: var(--gray-200)" value="{{ old('wali_nama') }}">
                            </div>
                            <div>
                                <label class="block text-sm font-medium mb-1" style="color: var(--gray-700)">Pekerjaan Wali</label>
                                <input type="text" name="wali_pekerjaan" class="w-full px-4 py-2 rounded-lg border" style="border-color: var(--gray-200)" value="{{ old('wali_pekerjaan') }}">
                            </div>
                            <div>
                                <label class="block text-sm font-medium mb-1" style="color: var(--gray-700)">Hubungan Wali</label>
                                <input type="text" name="wali_hubungan" class="w-full px-4 py-2 rounded-lg border" style="border-color: var(--gray-200)" value="{{ old('wali_hubungan') }}">
                            </div>
                        </div>
                        <div class="mt-6 flex justify-between">
                            <button type="button" onclick="prevStep(3)" class="px-6 py-2 rounded-lg border transition" style="border-color: var(--gray-300); color: var(--gray-600)">← Sebelumnya</button>
                            <button type="button" onclick="nextStep(5)" class="px-6 py-2 rounded-lg text-white transition" style="background: linear-gradient(135deg, var(--primary), var(--primary-dark))">Selanjutnya →</button>
                        </div>
                    </div>

                    <!-- STEP 5: Jurusan & Dokumen -->
                    <div id="step5" class="step-content" style="display: none;">
                        <h3 class="text-xl font-bold mb-4" style="color: var(--gray-800)">E. Pilihan Jurusan & Dokumen</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium mb-1" style="color: var(--gray-700)">Jurusan Pilihan 1 *</label>
                                <select name="jurusan_pilihan_1" required class="w-full px-4 py-2 rounded-lg border" style="border-color: var(--gray-200)">
                                    <option value="">Pilih Jurusan</option>
                                    @foreach($jurusan as $j)
                                    <option value="{{ $j->id }}" {{ old('jurusan_pilihan_1') == $j->id ? 'selected' : '' }}>{{ $j->nama_jurusan }} ({{ $j->singkatan }})</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-medium mb-1" style="color: var(--gray-700)">Jurusan Pilihan 2</label>
                                <select name="jurusan_pilihan_2" class="w-full px-4 py-2 rounded-lg border" style="border-color: var(--gray-200)">
                                    <option value="">Pilih Jurusan</option>
                                    @foreach($jurusan as $j)
                                    <option value="{{ $j->id }}" {{ old('jurusan_pilihan_2') == $j->id ? 'selected' : '' }}>{{ $j->nama_jurusan }} ({{ $j->singkatan }})</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-medium mb-1" style="color: var(--gray-700)">Foto Kartu Keluarga</label>
                                <input type="file" name="foto_kk" accept="image/*" class="w-full px-4 py-2 rounded-lg border" style="border-color: var(--gray-200)">
                                <p class="text-xs text-gray-500 mt-1">Max 2MB (JPG, PNG)</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium mb-1" style="color: var(--gray-700)">Foto Akte Kelahiran</label>
                                <input type="file" name="foto_akte" accept="image/*" class="w-full px-4 py-2 rounded-lg border" style="border-color: var(--gray-200)">
                            </div>
                            <div>
                                <label class="block text-sm font-medium mb-1" style="color: var(--gray-700)">Foto Ijazah / SKL</label>
                                <input type="file" name="foto_ijazah" accept="image/*" class="w-full px-4 py-2 rounded-lg border" style="border-color: var(--gray-200)">
                            </div>
                            <div>
                                <label class="block text-sm font-medium mb-1" style="color: var(--gray-700)">Foto Nilai Rapor</label>
                                <input type="file" name="foto_nilai" accept="image/*" class="w-full px-4 py-2 rounded-lg border" style="border-color: var(--gray-200)">
                            </div>
                            <div>
                                <label class="block text-sm font-medium mb-1" style="color: var(--gray-700)">Foto Sertifikat (Opsional)</label>
                                <input type="file" name="foto_sertifikat" accept="image/*" class="w-full px-4 py-2 rounded-lg border" style="border-color: var(--gray-200)">
                            </div>
                        </div>
                        <div class="mt-6 flex justify-between">
                            <button type="button" onclick="prevStep(4)" class="px-6 py-2 rounded-lg border transition" style="border-color: var(--gray-300); color: var(--gray-600)">← Sebelumnya</button>
                            <button type="submit" class="px-6 py-2 rounded-lg text-white font-semibold transition hover:shadow-lg" style="background: linear-gradient(135deg, var(--primary), var(--primary-dark))">Kirim Pendaftaran</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endif

<style>
.step-item { flex: 1; display: flex; flex-direction: column; align-items: center; position: relative; }
.step-circle { width: 40px; height: 40px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 14px; font-weight: bold; background-color: var(--gray-200); color: var(--gray-500); transition: all 0.3s; }
.step-item.active .step-circle { background: linear-gradient(135deg, var(--primary), var(--primary-dark)); color: white; }
.step-item.completed .step-circle { background: linear-gradient(135deg, var(--primary), var(--primary-dark)); color: white; }
.step-label { font-size: 12px; margin-top: 8px; color: var(--gray-500); }
.step-item.active .step-label { color: var(--primary); font-weight: 600; }
</style>

<script>
let currentStep = 1;
const totalSteps = 5;

function showStep(step) {
    for (let i = 1; i <= totalSteps; i++) {
        const content = document.getElementById('step' + i);
        if (content) content.style.display = 'none';
        const indicator = document.getElementById('step' + i + '-indicator');
        if (indicator) {
            if (i < step) {
                indicator.classList.add('completed');
                indicator.classList.remove('active');
            } else if (i === step) {
                indicator.classList.add('active');
                indicator.classList.remove('completed');
            } else {
                indicator.classList.remove('active', 'completed');
            }
        }
    }
    const currentContent = document.getElementById('step' + step);
    if (currentContent) currentContent.style.display = 'block';
}

function nextStep(step) {
    currentStep = step;
    showStep(currentStep);
    window.scrollTo({ top: 0, behavior: 'smooth' });
}

function prevStep(step) {
    currentStep = step;
    showStep(currentStep);
    window.scrollTo({ top: 0, behavior: 'smooth' });
}

showStep(1);
</script>
@endsection
