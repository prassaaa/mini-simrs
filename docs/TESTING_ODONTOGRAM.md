# Testing Flow - Fitur Odontogram

## Prasyarat
1. Pastikan server Laravel berjalan: `php artisan serve`
2. Pastikan Vite dev server berjalan: `npm run dev`
3. Pastikan database sudah di-migrate: `php artisan migrate`

---

## Flow Testing

### 1. Login ke Aplikasi
- Buka browser ke `http://localhost:8000`
- Login dengan akun yang sudah ada

---

### 2. Buat Kunjungan Baru (jika belum ada)
1. Pergi ke menu **Kunjungan** → **Tambah Kunjungan**
2. Isi form:
   - Pilih Pasien
   - Pilih Dokter (pilih dokter gigi jika ada)
   - Pilih Poli (pilih Poli Gigi jika ada)
   - Pilih Instalasi: Rawat Jalan
   - Pilih Penjamin
3. Klik **Simpan**

---

### 3. Buat Odontogram dari Halaman Kunjungan
1. Dari halaman detail kunjungan, scroll ke bawah
2. Lihat section **Odontogram** dengan pesan "Belum ada pemeriksaan odontogram"
3. Klik tombol **Buat Odontogram**

---

### 4. Test Form Create Odontogram

#### A. Test Pemeriksaan Ekstra Oral
- Isi textarea "Pemeriksaan Ekstra Oral" dengan contoh:
  ```
  Wajah simetris, tidak ada pembengkakan
  ```

#### B. Test Interactive Odontogram Chart
1. Klik pada gigi **18** (molar kanan atas dewasa)
2. Di panel kanan "Edit Gigi", ubah:
   - Kondisi: **Karies (CAR)**
   - Centang **Dinding Atas** dan **Dinding Tengah**
   - Isi keterangan: "Karies pada oklusal"
3. Klik gigi **11** (incisivus tengah kanan atas)
4. Ubah kondisi ke: **Amalgam Filling (AMF)**
5. Klik gigi **36** (molar kiri bawah dewasa)
6. Ubah kondisi ke: **Missing (MIS)**

#### C. Test Pemeriksaan Lainnya
1. Occlusi: Pilih **Normal Bite**
2. Torus Palatinus: Pilih **Tidak Ada**
3. Torus Mandibularis: Pilih **Tidak Ada**
4. Palatum: Pilih **Sedang**
5. Diastema: Centang jika ada
6. Gigi Anomali: Centang jika ada

#### D. Test Hitung DMF Otomatis
1. Klik tombol **Hitung Otomatis**
2. Verifikasi:
   - Status D (Decay) = 1 (gigi 18 dengan karies)
   - Status M (Missing) = 1 (gigi 36 missing)
   - Status F (Filled) = 1 (gigi 11 dengan amalgam)

#### E. Isi Diagnosa & Planning
- Diagnosa: `Karies gigi 18, Post filling gigi 11, Edentulous gigi 36`
- Planning: `Tumpatan gigi 18, Kontrol berkala`
- Edukasi: `Sikat gigi 2x sehari, kurangi makanan manis`

#### F. Simpan
1. Klik tombol **Simpan Odontogram**
2. Verifikasi redirect ke halaman show

---

### 5. Test Halaman Show Odontogram
1. Verifikasi informasi kunjungan ditampilkan dengan benar
2. Verifikasi chart odontogram menampilkan kondisi gigi yang sudah diisi:
   - Gigi 18 harus menampilkan gambar karies
   - Gigi 11 harus menampilkan gambar amalgam
   - Gigi 36 harus menampilkan gambar missing
3. Verifikasi tabel "Ringkasan Kondisi Gigi" menampilkan 3 gigi dengan masalah
4. Verifikasi DMF status ditampilkan: D=1, M=1, F=1
5. Test tombol **Print** - harus membuka dialog print browser

---

### 6. Test Edit Odontogram
1. Klik tombol **Edit**
2. Verifikasi data ter-load dengan benar:
   - Kondisi gigi 18 = Karies
   - Kondisi gigi 11 = Amalgam
   - Kondisi gigi 36 = Missing
3. Ubah kondisi gigi 18:
   - Dari **Karies** ke **Composite Filling (COF)**
4. Klik **Hitung Otomatis** lagi
   - D sekarang harus = 0
   - F sekarang harus = 2
5. Update diagnosa: `Post filling gigi 18 dan 11, Edentulous gigi 36`
6. Klik **Update Odontogram**
7. Verifikasi perubahan tersimpan

---

### 7. Test dari Halaman Kunjungan
1. Kembali ke halaman detail kunjungan (`/kunjungan/{id}`)
2. Verifikasi section Odontogram sekarang menampilkan:
   - Status D, M, F
   - DMF Total
   - Diagnosa
   - Tombol "Lihat Detail" dan "Edit"

---

### 8. Test History Odontogram (Opsional)
Jika pasien sudah memiliki beberapa kunjungan dengan odontogram:
1. Akses `/pasien/{noRm}/odontogram-history`
2. Verifikasi daftar semua pemeriksaan odontogram
3. Verifikasi grafik tren DMF ditampilkan

---

### 9. Test Hapus Odontogram
1. Dari halaman show odontogram, klik **Hapus**
2. Konfirmasi dialog
3. Verifikasi odontogram terhapus
4. Verifikasi redirect ke halaman kunjungan

---

## Checklist Testing

| No | Test Case | Status |
|----|-----------|--------|
| 1 | Halaman create odontogram dapat diakses | ⬜ |
| 2 | Interactive chart dapat di-klik | ⬜ |
| 3 | Perubahan kondisi gigi menampilkan gambar yang sesuai | ⬜ |
| 4 | Checkbox dinding gigi berfungsi | ⬜ |
| 5 | Dropdown pemeriksaan lainnya berfungsi | ⬜ |
| 6 | Tombol hitung DMF otomatis berfungsi | ⬜ |
| 7 | Form dapat di-submit dan data tersimpan | ⬜ |
| 8 | Halaman show menampilkan data dengan benar | ⬜ |
| 9 | Gambar kondisi gigi ditampilkan di chart | ⬜ |
| 10 | Halaman edit ter-load dengan data existing | ⬜ |
| 11 | Update data berfungsi | ⬜ |
| 12 | Section odontogram di halaman kunjungan tampil | ⬜ |
| 13 | Hapus odontogram berfungsi | ⬜ |
| 14 | Print berfungsi | ⬜ |

---

## Troubleshooting

### Gambar gigi tidak muncul
- Pastikan folder `/public/assets/odontogram/png/` berisi file gambar
- Periksa nama file sesuai dengan kondisi (sou.png, car.png, dll)

### Error saat submit form
- Buka browser developer tools (F12) → Console
- Periksa error message
- Cek Laravel log di `storage/logs/laravel.log`

### Chart tidak responsive
- Pastikan Vite dev server berjalan
- Coba hard refresh (Ctrl+Shift+R)

---

## Screenshot Referensi

### Tampilan Chart Odontogram
```
        Rahang Atas (Dewasa)
    18 17 16 15 14 13 12 11 | 21 22 23 24 25 26 27 28
    ─────────────────────────────────────────────────
        55 54 53 52 51 | 61 62 63 64 65
              Rahang Atas (Susu)

              Rahang Bawah (Susu)
        85 84 83 82 81 | 71 72 73 74 75
    ─────────────────────────────────────────────────
    48 47 46 45 44 43 42 41 | 31 32 33 34 35 36 37 38
        Rahang Bawah (Dewasa)
```

### Kode Kondisi Gigi yang Sering Dipakai
| Kode | Kondisi | Keterangan |
|------|---------|------------|
| SOU | Sound | Gigi sehat |
| CAR | Caries | Karies/lubang |
| MIS | Missing | Gigi tidak ada |
| AMF | Amalgam Filling | Tambalan amalgam |
| COF | Composite Filling | Tambalan komposit |
| RCT | Root Canal Treatment | Perawatan saluran akar |
| CFR | Crown (Full) | Mahkota penuh |
| POC | Pocket | Ada poket periodontal |
| ABR | Abrasion | Abrasi |
