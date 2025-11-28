@extends('layouts.modern')

@section('title', 'Edit Pemeriksaan Dokter')
@section('header-title', 'Edit Pemeriksaan Pasien')
@section('breadcrumb', 'Edit Pemeriksaan')

@section('content')
    <div class="row">
        <div class="col-md-4">
            <!-- Data Pasien & Vital Signs -->
            <div class="card-custom mb-4">
                <div class="card-header-custom">
                    <i class="fas fa-user-injured me-2"></i>Data Pasien
                </div>
                <div class="card-body p-4">
                    <div class="mb-3">
                        <label class="text-muted small text-uppercase fw-bold">Nama Pasien</label>
                        <div class="fs-5 fw-bold">{{ $pemeriksaan->pendaftaran->pasien->nama_lengkap ?? $pemeriksaan->pendaftaran->pasien->nama }}</div>
                    </div>
                    <div class="mb-3">
                        <label class="text-muted small text-uppercase fw-bold">No. Rekam Medis</label>
                        <div class="fs-6">{{ $pemeriksaan->pendaftaran->pasien->no_rekam_medis ?? $pemeriksaan->pendaftaran->pasien->no_rm }}</div>
                    </div>
                    <div class="mb-3">
                        <label class="text-muted small text-uppercase fw-bold">Usia</label>
                        <div class="fs-6">{{ \Carbon\Carbon::parse($pemeriksaan->pendaftaran->pasien->tanggal_lahir)->age }} Tahun</div>
                    </div>
                    <div class="mb-0">
                        <label class="text-muted small text-uppercase fw-bold">Keluhan Utama</label>
                        <div class="p-2 bg-light rounded border">{{ $pemeriksaan->pendaftaran->keluhan }}</div>
                    </div>
                </div>
            </div>

            @if($pemeriksaan->pendaftaran->vitalSign)
            <div class="card-custom">
                <div class="card-header-custom bg-info text-white">
                    <i class="fas fa-heartbeat me-2"></i>Tanda Vital
                </div>
                <div class="card-body p-0">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between align-items-center px-4 py-3">
                            <span>Tekanan Darah</span>
                            <span class="fw-bold">{{ $pemeriksaan->pendaftaran->vitalSign->tekanan_darah }} mmHg</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center px-4 py-3">
                            <span>Suhu Tubuh</span>
                            <span class="fw-bold">{{ $pemeriksaan->pendaftaran->vitalSign->suhu }} °C</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center px-4 py-3">
                            <span>Denyut Nadi</span>
                            <span class="fw-bold">{{ $pemeriksaan->pendaftaran->vitalSign->nadi }} x/menit</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center px-4 py-3">
                            <span>Pernapasan</span>
                            <span class="fw-bold">{{ $pemeriksaan->pendaftaran->vitalSign->pernapasan }} x/menit</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center px-4 py-3">
                            <span>Berat Badan</span>
                            <span class="fw-bold">{{ $pemeriksaan->pendaftaran->vitalSign->berat_badan }} kg</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center px-4 py-3">
                            <span>Tinggi Badan</span>
                            <span class="fw-bold">{{ $pemeriksaan->pendaftaran->vitalSign->tinggi_badan }} cm</span>
                        </li>
                    </ul>
                </div>
            </div>
            @endif
        </div>

        <div class="col-md-8">
            <!-- Form Pemeriksaan -->
            <div class="card-custom">
                <div class="card-header-custom">
                    <i class="fas fa-stethoscope me-2"></i>Formulir Edit Pemeriksaan
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('dokter.pemeriksaan.update', $pemeriksaan->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="pendaftaran_id" value="{{ $pemeriksaan->pendaftaran_id }}">

                        <h5 class="text-primary mb-3 border-bottom pb-2">1. Anamnesa & Pemeriksaan Fisik</h5>
                        
                        <div class="mb-3">
                            <label class="form-label fw-bold">Anamnesa (S)</label>
                            <textarea name="anamnesa" class="form-control" rows="3" required>{{ old('anamnesa', $pemeriksaan->anamnesis) }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Pemeriksaan Fisik (O)</label>
                            <textarea name="pemeriksaan_fisik" class="form-control" rows="3" required>{{ old('pemeriksaan_fisik', $pemeriksaan->pemeriksaan_fisik) }}</textarea>
                        </div>

                        <h5 class="text-primary mb-3 border-bottom pb-2 mt-4">2. Diagnosa & Tindakan</h5>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Diagnosa Utama (A)</label>
                                <input type="text" name="diagnosis_utama" class="form-control" required value="{{ old('diagnosis_utama', $pemeriksaan->diagnosis_utama) }}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Diagnosa Sekunder (Opsional)</label>
                                <input type="text" name="diagnosis_sekunder" class="form-control" value="{{ old('diagnosis_sekunder', $pemeriksaan->diagnosis_tambahan) }}">
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label fw-bold">Tindakan / Terapi (P)</label>
                            <textarea name="tindakan" class="form-control" rows="3" required>{{ old('tindakan', $pemeriksaan->tindakan) }}</textarea>
                        </div>

                        <div class="row bg-light p-3 rounded mb-3 border">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Rencana Tindak Lanjut</label>
                                <select name="rencana_tindak_lanjut" class="form-select">
                                    <option value="">-- Pilih --</option>
                                    <option value="Kontrol" {{ $pemeriksaan->rencana_tindak_lanjut == 'Kontrol' ? 'selected' : '' }}>Kontrol Kembali</option>
                                    <option value="Rujuk" {{ $pemeriksaan->rencana_tindak_lanjut == 'Rujuk' ? 'selected' : '' }}>Rujuk ke RS Lain</option>
                                    <option value="Pulang" {{ $pemeriksaan->rencana_tindak_lanjut == 'Pulang' ? 'selected' : '' }}>Boleh Pulang</option>
                                    <option value="Rawat Inap" {{ $pemeriksaan->rencana_tindak_lanjut == 'Rawat Inap' ? 'selected' : '' }}>Rawat Inap</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Tanggal Kontrol (Jika ada)</label>
                                <input type="date" name="tanggal_kontrol" class="form-control" value="{{ old('tanggal_kontrol', $pemeriksaan->tanggal_kontrol ? \Carbon\Carbon::parse($pemeriksaan->tanggal_kontrol)->format('Y-m-d') : '') }}">
                            </div>
                        </div>

                        <h5 class="text-primary mb-3 border-bottom pb-2 mt-4">3. Resep Obat</h5>
                        
                        <div id="resep-container">
                            @if(isset($resep) && $resep->details->count() > 0)
                                @foreach($resep->details as $detail)
                                <div class="row g-2 mb-2 resep-row">
                                    <div class="col-md-5">
                                        <select name="obat_id[]" class="form-select select2-obat">
                                            <option value="">-- Pilih Obat --</option>
                                            @foreach($obatList as $obat)
                                                <option value="{{ $obat->id }}" {{ $detail->obat_id == $obat->id ? 'selected' : '' }}>
                                                    {{ $obat->nama_obat }} (Stok: {{ $obat->stok }})
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <input type="number" name="jumlah[]" class="form-control" placeholder="Jml" min="1" value="{{ $detail->jumlah }}">
                                    </div>
                                    <div class="col-md-4">
                                        <input type="text" name="aturan_pakai[]" class="form-control" placeholder="Aturan Pakai (3x1)" value="{{ $detail->aturan_pakai }}">
                                    </div>
                                    <div class="col-md-1">
                                        <button type="button" class="btn btn-outline-danger btn-sm remove-resep w-100"><i class="fas fa-times"></i></button>
                                    </div>
                                </div>
                                @endforeach
                            @else
                                <div class="row g-2 mb-2 resep-row">
                                    <div class="col-md-5">
                                        <select name="obat_id[]" class="form-select select2-obat">
                                            <option value="">-- Pilih Obat --</option>
                                            @foreach($obatList as $obat)
                                                <option value="{{ $obat->id }}">
                                                    {{ $obat->nama_obat }} (Stok: {{ $obat->stok }})
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <input type="number" name="jumlah[]" class="form-control" placeholder="Jml" min="1">
                                    </div>
                                    <div class="col-md-4">
                                        <input type="text" name="aturan_pakai[]" class="form-control" placeholder="Aturan Pakai (3x1)">
                                    </div>
                                    <div class="col-md-1">
                                        <button type="button" class="btn btn-outline-danger btn-sm remove-resep w-100"><i class="fas fa-times"></i></button>
                                    </div>
                                </div>
                            @endif
                        </div>
                        
                        <button type="button" class="btn btn-success btn-sm mt-2" id="add-resep">
                            <i class="fas fa-plus me-1"></i> Tambah Obat
                        </button>

                        <div class="d-flex justify-content-between pt-4 mt-4 border-top">
                            <a href="{{ route('dokter.pemeriksaan.index') }}" class="btn btn-light">Batal</a>
                            <button type="submit" class="btn btn-primary px-5">
                                <i class="fas fa-save me-1"></i> Update Pemeriksaan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $('.select2-obat').select2({
                theme: 'bootstrap-5',
                width: '100%',
                placeholder: '-- Pilih Obat --'
            });

            $('#add-resep').click(function() {
                var row = `
                    <div class="row g-2 mb-2 resep-row">
                        <div class="col-md-5">
                            <select name="obat_id[]" class="form-select select2-obat-new">
                                <option value="">-- Pilih Obat --</option>
                                @foreach($obatList as $obat)
                                    <option value="{{ $obat->id }}">{{ $obat->nama_obat }} (Stok: {{ $obat->stok }})</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2">
                            <input type="number" name="jumlah[]" class="form-control" placeholder="Jml" min="1">
                        </div>
                        <div class="col-md-4">
                            <input type="text" name="aturan_pakai[]" class="form-control" placeholder="Aturan Pakai">
                        </div>
                        <div class="col-md-1">
                            <button type="button" class="btn btn-outline-danger btn-sm remove-resep w-100"><i class="fas fa-times"></i></button>
                        </div>
                    </div>
                `;
                $('#resep-container').append(row);
                $('.select2-obat-new').select2({ 
                    theme: 'bootstrap-5', 
                    width: '100%',
                    placeholder: '-- Pilih Obat --'
                }).removeClass('select2-obat-new').addClass('select2-obat');
            });

            $(document).on('click', '.remove-resep', function() {
                if($('.resep-row').length > 1) {
                    $(this).closest('.resep-row').remove();
                } else {
                    // Clear inputs if it's the last row
                    $(this).closest('.resep-row').find('input').val('');
                    $(this).closest('.resep-row').find('select').val('').trigger('change');
                }
            });
        });
    </script>
@endsection
