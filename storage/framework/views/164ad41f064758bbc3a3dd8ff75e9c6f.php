<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Pemesanan - <?php echo e($pemesanan->kode_pemesanan); ?></title>
    <!-- Favicon untuk halaman cetak -->
    <link rel="icon" href="<?php echo e(asset('image/tikett.png')); ?>" type="image/png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            font-size: 12px;
            margin: 20px;
        }

        .container-print {
            width: 100%;
            max-width: 800px;
            /* Batasi lebar untuk cetak */
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1,
        h2,
        h3 {
            text-align: center;
            color: #333;
        }

        .section-title {
            margin-top: 20px;
            margin-bottom: 10px;
            padding-bottom: 5px;
            border-bottom: 1px dashed #ccc;
            font-weight: bold;
        }

        .info-row {
            display: flex;
            margin-bottom: 5px;
        }

        .info-label {
            flex: 0 0 150px;
            /* Lebar tetap untuk label */
            font-weight: bold;
        }

        .info-value {
            flex: 1;
        }

        .text-center {
            text-align: center;
        }

        .text-end {
            text-align: right;
        }

        .mt-3 {
            margin-top: 1rem;
        }

        .mb-3 {
            margin-bottom: 1rem;
        }

        .fw-bold {
            font-weight: bold;
        }

        /* Gaya khusus untuk cetak */
        @media print {
            body {
                margin: 0;
                padding: 0;
                -webkit-print-color-adjust: exact;
                /* Untuk mencetak warna background dan gambar */
                print-color-adjust: exact;
            }

            .container-print {
                border: none;
                box-shadow: none;
                padding: 0;
            }

            .no-print {
                display: none !important;
            }
        }
    </style>
</head>

<body onload="window.print()"> 
    <div class="container-print">
        <h1 class="mb-3">Detail Pemesanan Tiket Konser</h1>
        <p class="text-center"><strong>Kode Pemesanan: <?php echo e($pemesanan->kode_pemesanan); ?></strong></p>

        <div class="section-title">Informasi Pemesanan</div>
        <div class="info-row">
            <div class="info-label">Tanggal Pemesanan:</div>
            <div class="info-value"><?php echo e(\Carbon\Carbon::parse($pemesanan->tanggal_pemesanan)->format('d M Y H:i')); ?>

            </div>
        </div>
        <div class="info-row">
            <div class="info-label">Status Pembayaran:</div>
            <div class="info-value">
                <span class="fw-bold text-uppercase"><?php echo e($pemesanan->status_pembayaran); ?></span>
            </div>
        </div>
        <div class="info-row">
            <div class="info-label">Status Pemesanan:</div>
            <div class="info-value">
                <span class="fw-bold text-uppercase"><?php echo e($pemesanan->status_pemesanan); ?></span>
            </div>
        </div>

        <div class="section-title mt-3">Informasi User Pemesan</div>
        <div class="info-row">
            <div class="info-label">Nama User:</div>
            <div class="info-value"><?php echo e($pemesanan->user->nama ?? 'N/A'); ?></div>
        </div>
        <div class="info-row">
            <div class="info-label">Email User:</div>
            <div class="info-value"><?php echo e($pemesanan->user->email ?? 'N/A'); ?></div>
        </div>
        <div class="info-row">
            <div class="info-label">No. HP User:</div>
            <div class="info-value"><?php echo e($pemesanan->user->hp ?? 'N/A'); ?></div>
        </div>

        <div class="section-title mt-3">Detail Konser</div>
        <div class="info-row">
            <div class="info-label">Nama Konser:</div>
            <div class="info-value"><?php echo e($pemesanan->konser->nama_konser ?? 'N/A'); ?></div>
        </div>
        <div class="info-row">
            <div class="info-label">Artis:</div>
            <div class="info-value"><?php echo e($pemesanan->konser->artis ?? 'N/A'); ?></div>
        </div>
        
        
        
        
        
        
        
        <div class="info-row">
            <div class="info-label">Waktu Konser:</div>
            <div class="info-value"><?php echo e(\Carbon\Carbon::parse($pemesanan->konser->waktu ?? '')->format('d M Y H:i')); ?>

            </div>
        </div>
        <div class="info-row">
            <div class="info-label">Lokasi Konser:</div>
            <div class="info-value"><?php echo e($pemesanan->konser->lokasi ?? 'N/A'); ?></div>
        </div>
        <div class="info-row">
            <div class="info-label">Harga Tiket Satuan:</div>
            <div class="info-value">Rp <?php echo e(number_format($pemesanan->konser->harga ?? 0, 2, ',', '.')); ?></div>
        </div>

        <div class="section-title mt-3">Ringkasan Pembayaran</div>
        <div class="info-row">
            <div class="info-label">Jumlah Tiket:</div>
            <div class="info-value fw-bold"><?php echo e($pemesanan->jumlah_tiket); ?></div>
        </div>
        <div class="info-row">
            <div class="info-label">Total Harga:</div>
            <div class="info-value fw-bold">Rp <?php echo e(number_format($pemesanan->total_harga, 2, ',', '.')); ?></div>
        </div>

        <p class="text-center mt-4 no-print">
            Terima kasih atas pemesanan Anda. Silakan tunjukkan detail ini saat masuk ke lokasi konser.
        </p>

        <div class="text-center mt-4 no-print">
            <button onclick="window.print()" class="btn btn-primary">Cetak Ulang</button>
            
            
        </div>
    </div>
</body>

</html>
<?php /**PATH C:\laravel10\TiketOnline - Copy - Copy\resources\views/backend/v_pemesanan/print.blade.php ENDPATH**/ ?>