# Ingkung Echo Mbah Oerip
Proyek ini adalah website pemesanan ayam Ingkung khas Mbah Oerip. Dibuat menggunakan PHP dan MySQL.

## Cara Menjalankan
1. Clone repository ini
2. Import `database/mbaheoerip.sql` ke phpMyAdmin
3. Jalankan `index.php` di localhost (XAMPP/Laragon)

## Note
1. Ubah window.location.href="http://main.ingkungecombahoerip.web.id/index.php"; Menjadi -> 
window.location.href="http://localhost/mbah.oerip/main/index.php"; -> Untuk Eksekusi di Local
2. untuk reset Password informasi domain, sesuaikan dengan domain server,
    untuk local -> $domain = "http://localhost/mbah.oerip/main/reset_password.php?";

## Struktur
- `main/` : Halaman dan fitur utama User
- `admin/` : Halaman dan fitur admin
- `assets/` : Gambar dan file frontend
- `koneksi.php` : File koneksi database

## Login Sebagai Admin di Localhost
- Username: zakinanda@localhost
- Password: 123

atau dapat disesuaikan sendiri untuk anda sebagai aktor apa pada database, terletak pada tabel 'users' atribut 'level'
'a' = admin
'u' = user
'o' = owner

## Developer
Zakinanda Faishal - 2025


