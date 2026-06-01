# Noctura Web Admin

Noctura Web Admin adalah aplikasi berbasis web yang digunakan oleh admin untuk mengelola sistem Noctura, yaitu sistem prediksi gangguan tidur berbasis aplikasi mobile dan web dashboard.

Repository ini dikhususkan untuk bagian web admin dan backend Laravel. Aplikasi web ini digunakan untuk mengelola akun, data edukasi, serta memantau hasil prediksi gangguan tidur yang dikirimkan dari aplikasi mobile ke database MongoDB.

## Deskripsi Project

Noctura Web Admin merupakan sistem dashboard berbasis web yang dikembangkan untuk membantu admin dalam mengelola data pada aplikasi Noctura.

Melalui web admin ini, admin dapat melakukan login, mengelola data akun pengguna, mengelola konten edukasi mengenai gangguan tidur, serta melihat data hasil prediksi yang dikirimkan oleh pengguna dari aplikasi mobile.

Sistem ini menggunakan Laravel sebagai backend web dan MongoDB sebagai database utama. Web admin ini menjadi pusat pengelolaan data untuk mendukung sistem prediksi gangguan tidur Noctura.

## Tim Pengembang

Nama Tim: Sleep Well

| Nama                          | NIM/Kelas     | Role                                         | GitHub             |
| ----------------------------- | ------------- | -------------------------------------------- | ------------------ |
| Rizky Wahyu Wangsa Syaelendra | E31240058 / A | Ketua, Frontend Mobile, Backend Web & Mobile | [@Rizkywhyws](https://github.com/Rizkywhyws)      |
| Doan Sri Washin Sianipar      | E31240180 / A | Frontend Web, Backend Web & Mobile           | [@Doansnpr](https://github.com/Doansnpr)       |
| Mahmudatul Elisah             | E31240350 / A | Frontend Web & Mobile, Backend Web & Mobile  | [@elisacis](https://github.com/elisacis)          |
| Julianda Marselyna            | E31240410 / A | Frontend Web & Mobile, Backend Web & Mobile  | [@juliandaMarselyna](https://github.com/juliandaMarselyna) |

## Fitur Utama

### 1. Login Admin

Admin dapat masuk ke sistem melalui halaman login khusus web admin.

Sistem login menggunakan email atau nama pengguna dan kata sandi. Akun dengan role admin hanya dapat digunakan melalui web admin.

### 2. Dashboard Admin

Dashboard menampilkan tampilan utama setelah admin berhasil login. Halaman ini digunakan sebagai pusat navigasi untuk mengakses fitur-fitur pengelolaan data.

### 3. Manajemen Akun

Admin dapat melihat data akun pengguna yang tersimpan di database MongoDB.

Fitur ini digunakan untuk memantau data akun yang terdaftar pada sistem Noctura.

### 4. Manajemen Edukasi

Admin dapat mengelola konten edukasi mengenai gangguan tidur.

Data edukasi yang dikelola meliputi:

- Judul artikel
- Kategori gangguan tidur
- Jenis edukasi
- Ringkasan
- Isi artikel
- Gambar artikel
- Tips penanganan
- Saran atau kapan harus konsultasi
- Author
- Estimasi waktu baca
- Status publish

### 5. Monitoring Prediksi

Admin dapat memantau hasil prediksi gangguan tidur yang dikirimkan dari aplikasi mobile.

Fitur ini digunakan untuk melihat data hasil prediksi pengguna yang tersimpan di MongoDB.

### 6. Forgot Password

Web admin dilengkapi fitur lupa kata sandi yang terdiri dari beberapa tahapan:

- Input email terdaftar
- Verifikasi kode OTP
- Reset kata sandi baru

### 7. Upload Gambar Edukasi

Admin dapat mengunggah gambar artikel edukasi. Gambar disimpan melalui storage Laravel dan ditampilkan pada halaman edukasi.

## Tech Stack

| Bagian         | Teknologi                             |
| -------------- | ------------------------------------- |
| Web Framework  | Laravel                               |
| Bahasa Backend | PHP                                   |
| Database       | MongoDB                               |
| Frontend Web   | Blade Template, HTML, CSS, JavaScript |
| Styling        | Custom CSS                            |
| Authentication | Laravel Auth / Custom Auth            |
| Storage        | Laravel Storage                       |

## Prasyarat Sistem

Sebelum menjalankan project ini, pastikan perangkat sudah memiliki beberapa software berikut:

- Git
- PHP 8.2+
- Composer
- MongoDB
- MongoDB Compass
- Web browser
- Visual Studio Code atau text editor lainnya

## Cara Instalasi dan Menjalankan Project

### 1. Clone Repository

````bash
git clone https://github.com/Doansnpr/Noctura-Web.git
cd Noctura-Web

### 2. Install Dependency Laravel

Setelah masuk ke folder project, install seluruh dependency Laravel menggunakan Composer.

```bash
composer install
````

### 3. Copy File Environment

Copy file `.env.example` menjadi `.env`.

Untuk Git Bash atau Mac/Linux:

```bash
cp .env.example .env
```

Untuk Windows PowerShell:

```bash
copy .env.example .env
```

### 4. Konfigurasi File `.env`

Atur konfigurasi aplikasi dan database pada file `.env`.

Contoh konfigurasi:

```env
APP_NAME=Noctura
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_URL=http://localhost:8000

DB_CONNECTION=mongodb
DB_HOST=127.0.0.1
DB_PORT=27017
DB_DATABASE=noctura
```

Sesuaikan nama database dengan database MongoDB yang digunakan pada project.

### 5. Generate Application Key

```bash
php artisan key:generate
```

### 6. Jalankan MongoDB

Pastikan service MongoDB sudah berjalan.

Jika menggunakan MongoDB Compass, buat database dengan nama:

```bash
noctura
```

Nama database dapat disesuaikan dengan konfigurasi pada file `.env`.

### 7. Buat Storage Link

Jika project menggunakan fitur upload gambar edukasi, jalankan perintah berikut:

```bash
php artisan storage:link
```

### 8. Bersihkan Cache Laravel

```bash
php artisan optimize:clear
```

### 9. Jalankan Server Laravel

```bash
php artisan serve
```

Aplikasi web akan berjalan di:

```bash
http://localhost:8000
```

## Struktur Project

Struktur umum project Noctura Web Admin:

```bash
Noctura-Web/
├── app/
│   ├── Http/
│   │   └── Controllers/
│   └── Models/
├── config/
├── database/
├── public/
│   ├── assets/
│   └── css/
├── resources/
│   └── views/
├── routes/
│   └── web.php
├── storage/
├── .env.example
├── composer.json
├── README.md
└── LICENSE
```

## Halaman Web

Beberapa halaman utama pada web admin:

- Login Admin
- Forgot Password
- Verifikasi OTP
- Reset Password
- Dashboard Admin
- Manajemen Akun
- Manajemen Edukasi
- Monitoring Prediksi

## Environment Variable

Beberapa konfigurasi penting pada file `.env`:

```env
APP_NAME=Noctura
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost:8000

DB_CONNECTION=mongodb
DB_HOST=127.0.0.1
DB_PORT=27017
DB_DATABASE=noctura
```

Jika project menggunakan fitur OTP melalui email atau mail service, tambahkan konfigurasi berikut sesuai kebutuhan:

```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=email_anda
MAIL_PASSWORD=password_aplikasi
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=email_anda
MAIL_FROM_NAME=Noctura
```

Jangan upload file `.env` ke GitHub karena file tersebut dapat berisi konfigurasi lokal dan data sensitif.

## Catatan Penggunaan

- Pastikan MongoDB sudah berjalan sebelum menjalankan Laravel.
- Pastikan file `.env` sudah dikonfigurasi dengan benar.
- Jalankan `php artisan storage:link` jika gambar edukasi tidak tampil.
- Jalankan `php artisan optimize:clear` jika terjadi perubahan route, config, atau view tetapi belum terbaca.
- Gunakan akun dengan role admin untuk masuk ke web admin.
- Jangan mengunggah file `.env`, folder `vendor`, dan file konfigurasi sensitif ke GitHub.

## License

This project is distributed under the MIT License.

## Copyright

Copyright (c) 2026 Sleep Well Team
