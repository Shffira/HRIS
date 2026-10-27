# Employee Directory

Aplikasi web direktori karyawan berbasis Laravel untuk menampilkan, mencari, dan menyaring data karyawan berdasarkan nama, email, dan departemen.

## 1. Fitur Utama

- **Factory dan Seeder:** menghasilkan 800 data karyawan secara otomatis.
- **Search:** mencari karyawan berdasarkan nama atau email.
- **Filter:** menyaring karyawan berdasarkan departemen.
- **Pagination:** menampilkan 15 data karyawan per halaman.
- **Query String:** mempertahankan parameter pencarian dan filter saat berpindah halaman.

## 2. Teknologi yang Digunakan

- Laravel
- PHP
- MySQL
- Blade Template
- Bootstrap 5
- Eloquent ORM

## 3. Factory dan Seeder

### A. Factory

Factory adalah fitur Laravel yang digunakan untuk membuat data palsu (*dummy data*) secara otomatis dengan format yang menyerupai data asli.

Pada proyek ini, `EmployeeFactory` menghasilkan data karyawan berupa nama, email, jabatan, dan departemen.

File: `database/factories/EmployeeFactory.php`

Contoh kode:

```php
return [
    'name' => fake()->name(),
    'email' => fake()->unique()->safeEmail(),
    'position' => fake()->randomElement($positions),
    'department' => fake()->randomElement($departments),
];
```

Penjelasan:
- `fake()->name()` menghasilkan nama secara acak.
- `fake()->unique()->safeEmail()` menghasilkan email unik.
- `fake()->randomElement($positions)` memilih jabatan secara acak.
- `fake()->randomElement($departments)` memilih departemen secara acak.

### B. Seeder

Seeder adalah fitur Laravel yang digunakan untuk memasukkan data awal ke database secara otomatis.

Pada proyek ini, `EmployeeSeeder` memanggil Factory untuk membuat dan menyimpan 800 data karyawan ke tabel `employees`.

File: `database/seeders/EmployeeSeeder.php`

Contoh kode:

```php
public function run(): void
{
    Employee::factory()->count(800)->create();
}
```

Penjelasan:
- `Employee::factory()` memanggil Factory pada model Employee.
- `count(800)` menentukan jumlah data yang dibuat.
- `create()` membuat dan menyimpan data ke database.

Perintah untuk menjalankan Seeder:

```bash
php artisan db:seed --class=EmployeeSeeder
```

### C. Perbedaan Factory dan Seeder

| Factory | Seeder |
|---|---|
| Menentukan struktur dan nilai data palsu. | Mengatur proses pengisian data ke database. |
| Menghasilkan nama, email, jabatan, dan departemen. | Memanggil Factory untuk membuat 800 data karyawan. |
| Berada di `database/factories`. | Berada di `database/seeders`. |

**Kesimpulan:** Factory menentukan data yang akan dibuat, sedangkan Seeder menjalankan proses pengisian data ke database. Keduanya membantu menyediakan data pengujian tanpa memasukkan setiap karyawan secara manual.

## 4. Struktur Database

Tabel `employees` memiliki kolom berikut:

| Kolom | Keterangan |
|---|---|
| `id` | ID unik karyawan |
| `name` | Nama karyawan |
| `email` | Email karyawan yang unik |
| `position` | Jabatan karyawan |
| `department` | Departemen karyawan |
| `created_at` | Waktu data dibuat |
| `updated_at` | Waktu data diperbarui |

## 5. Instalasi dan Menjalankan Proyek

### Persyaratan

- PHP
- Composer
- MySQL
- Laragon atau lingkungan server lokal lainnya

### Langkah instalasi

1. Masuk ke folder proyek:

   ```bash
   cd employee-directory
   ```

2. Instal dependensi:

   ```bash
   composer install
   ```

3. Salin `.env.example` menjadi `.env`, kemudian sesuaikan konfigurasi database.

4. Buat database MySQL bernama `employee_directory`.

5. Buat application key:

   ```bash
   php artisan key:generate
   ```

6. Jalankan migration:

   ```bash
   php artisan migrate
   ```

7. Isi database dengan 800 data karyawan:

   ```bash
   php artisan db:seed --class=EmployeeSeeder
   ```

8. Jalankan server Laravel:

   ```bash
   php artisan serve
   ```

9. Buka alamat berikut di browser:

   `http://127.0.0.1:8000`

**Catatan:** perintah Seeder akan menambahkan 800 data setiap kali dijalankan. Jangan menjalankannya berulang kali jika tidak ingin menambah data lagi.

## 6. Struktur File Utama

```text
employee-directory/
├── app/
│   ├── Http/Controllers/
│   │   └── EmployeeController.php
│   └── Models/
│       └── Employee.php
├── database/
│   ├── factories/
│   │   └── EmployeeFactory.php
│   ├── migrations/
│   │   └── create_employees_table.php
│   └── seeders/
│       └── EmployeeSeeder.php
├── resources/
│   └── views/
│       └── employees/
│           └── index.blade.php
└── routes/
    └── web.php
```

## 7. Pengujian Fitur

Pengujian dilakukan untuk memastikan seluruh fitur berjalan dengan baik:

1. Memastikan 800 data karyawan tersimpan di database.
2. Mencari karyawan berdasarkan nama.
3. Mencari karyawan berdasarkan email.
4. Menyaring karyawan berdasarkan departemen.
5. Menggabungkan pencarian dan filter.
6. Memastikan pagination menampilkan maksimal 15 data per halaman.
7. Memastikan parameter pencarian dan filter tetap ada saat berpindah halaman.
8. Memastikan pesan yang sesuai muncul ketika data tidak ditemukan.

## 8. Tujuan Proyek

Proyek Employee Directory dibuat untuk mempelajari penggunaan Laravel dalam pengelolaan data, penggunaan Eloquent ORM, pembuatan data otomatis melalui Factory dan Seeder, serta penerapan Search, Filter, dan Pagination pada aplikasi web.

---

**Nama Proyek:** Employee Directory  
**Framework:** Laravel  
**Database:** MySQL  
**Tujuan:** Pembelajaran pengembangan aplikasi web menggunakan Laravel.
