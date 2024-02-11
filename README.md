## Tahapan Instalasi
- composer dump-autoload atau composer update
- npm install
- npm run dev
- Buat table baru di phpmyadmin dan konfigurasi db tersebut di .env
- php artisan migrate
- php artisan db:seed --class=RoleSeeder
- php artisan db:seed --class=DatabaseSeeder
- php artisan db:seed --class=KategoriSeeder
- selesai

## Testing Feature
### - Admin
- Auth sebagai admin pada di route /login dengan username super@gmail.com password 12341234
- Tambahkan Produk baru pada route /tambah_produk
- Edit database produk pada route /dashboard dengan menekan link Edit data> tiap card item
- Hapus database produk pada route /dashboard dengan menekan link hapus data tiap card item

### - Pembeli
- Auth sebagai admin pada di route /login dengan username pembeli@gmail.com password 12341234
- Tambahkan Produk Ke Cart/keranjang dengan klik icon plush biru keranjang
- Hapus produk dari cart/keranjang dengan klik icon trash merah
- Tambahkan jumlah produk yang akan dibeli dengan klik icon plus dan minus
- Melakukan checkout cart shooping, stok produk akan berkurang sebanyak transaksi per item


## Stack Tech
- Laravel v10
- Livewire v3.4
- Spatie/Laravel-permission v6.3
- Laravel/Breeze v1.28
- PHP v8.1
- Tailwind v3.4.1
- Preline UI v2.0.3
