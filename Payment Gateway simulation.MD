Saya sudah memiliki Payment Simulator UI seperti popup payment gateway:

- QRIS (OVO, GoPay, Dana)
- Virtual Account BCA
- Virtual Account Mandiri

Saat ini masalahnya:
Ketika user klik salah satu metode pembayaran, order langsung berubah menjadi sukses.

Saya ingin refactor menjadi simulasi payment gateway yang lebih realistis.

Kondisi:
- Jangan buat UI baru.
- Pertahankan modal payment yang sudah ada.
- Fokus ubah logic backend.

Flow yang diinginkan:

1. Saat checkout:
- Buat order baru.
- payment_status = pending.
- Jangan langsung paid.

2. Saat user membuka payment simulator:
Tampilkan:
- nomor order
- total pembayaran
- pilihan metode pembayaran

3. Saat user memilih metode:
Jangan langsung sukses.

Buat proses:

pending
   ↓
processing
   ↓
paid

Contoh:
User klik QRIS:
- tampilkan loading "Memproses pembayaran..."
- delay beberapa detik
- jalankan proses payment
- update status menjadi paid


4. Buat PaymentService:

app/Services/PaymentService.php

Logic pembayaran harus ada di sini, bukan controller.

Buat fungsi:
- createPayment()
- processPayment()
- updateStatus()


5. Tambahkan payment_status:
pending
processing
paid
failed


6. Buat endpoint simulasi:

POST /payment/{order}/process

Controller hanya memanggil PaymentService.


7. Buat struktur agar nanti mudah diganti Midtrans:

PaymentService
      |
      |
SimulatorGateway (sekarang)
      |
      |
MidtransGateway (nanti)


Jelaskan file yang dibuat dan file yang diubah.
Jangan menghapus UI payment simulator yang sudah ada.
