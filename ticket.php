<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticket</title>
    <style>
         * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background: #f0f2f5;
            padding: 30px 20px;
        }

        .container {
            max-width: 500px;
            margin: 0 auto;
        }

        .form-box {
            background: white;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            margin-bottom: 25px;
        }

        h2 {
            margin-bottom: 20px;
            color: #333;
            font-size: 24px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
            color: #555;
        }

        input, select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 6px;
            font-size: 16px;
        }

        button {
            background: #e67e22;
            color: white;
            border: none;
            padding: 12px;
            width: 100%;
            border-radius: 6px;
            font-size: 16px;
            cursor: pointer;
            font-weight: bold;
            margin-top: 10px;
        }

        button:hover {
            background: #d35400;
        }

        .error {
            color: #e74c3c;
            font-size: 13px;
            margin-top: 5px;
        }

        .struk {
            background: #fdf6e3;
            border: 1px solid #e0cba0;
            padding: 20px;
            border-radius: 8px;
            font-family: 'Courier New', monospace;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }

        .struk-header {
            text-align: center;
            border-bottom: 1px dashed #c9b27c;
            padding-bottom: 12px;
            margin-bottom: 12px;
        }

        .struk-header h3 {
            font-size: 18px;
            color: #5a3e1b;
        }

        .baris {
            display: flex;
            justify-content: space-between;
            margin-bottom: 8px;
            font-size: 14px;
        }

        .label {
            font-weight: bold;
        }

        .garis {
            border-top: 1px dashed #c9b27c;
            margin: 10px 0;
        }

        .total {
            font-weight: bold;
            font-size: 16px;
        }

        .diskon {
            color: #27ae60;
        }

        .footer {
            text-align: center;
            margin-top: 15px;
            font-size: 11px;
            border-top: 1px dashed #c9b27c;
            padding-top: 8px;
            color: #7a6a42;
        }

        .kosong {
            text-align: center;
            padding: 30px;
            color: #999;
            font-family: 'Courier New', monospace;
        }
    </style>
</head>
<body>
    <div class="container">
    <div class="form-box">
        <h2>Form Pemesanan Tiket Dies Natalis 2026!</h2>
        <form method="POST" id="formPesan">
            <div class="form-group">
                <label>Nama Pemesan</label>
                <input type="text" name="nama" id="nama">
                <div id="errorNama" class="error"></div>
            </div>

            <div class="form-group">
                <label>Kelas Tiket</label>
                <select name="kelas" id="kelas">
                    <option value="VIP">VIP - Rp 1.000.000</option>
                    <option value="Regular">Regular - Rp 500.000</option>
                </select>
            </div>

            <div class="form-group">
                <label>Jumlah Tiket</label>
                <input type="number" name="jumlah" id="jumlah" min="1">
                <div id="errorJumlah" class="error"></div>
            </div>

            <button type="submit">Pesan Tiket</button>
        </form>
    </div>

    <div class="struk">
        <?php
        // Proses form jika ada data POST
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nama = isset($_POST['nama']) ? trim($_POST['nama']) : '';
            $kelas = isset($_POST['kelas']) ? $_POST['kelas'] : '';
            $jumlah = isset($_POST['jumlah']) ? (int)$_POST['jumlah'] : 0;
            
            // Validasi
            if (strlen($nama) >= 3 && $jumlah >= 1) {
                // Tentukan harga
                if ($kelas == 'VIP') {
                    $harga = 1000000;
                    $kelasTxt = 'VIP (Rp 1.000.000)';
                } else {
                    $harga = 500000;
                    $kelasTxt = 'Regular (Rp 500.000)';
                }
                
                // Hitung total
                $subtotal = $jumlah * $harga;
                $diskon = 0;
                
                if ($subtotal > 2000000) {
                    $diskon = $subtotal * 0.1;
                }
                
                $total = $subtotal - $diskon;
                ?>
                <div class="struk-header">
                    <h3>NOTA PEMBAYARAN</h3>
                    <div>DIES NATALIS UNIVERSITAS MULIA 2026</div>
                </div>
                
                <div class="baris">
                    <span class="label">Nama Pemesan</span>
                    <span><?php echo htmlspecialchars($nama); ?></span>
                </div>
                <div class="baris">
                    <span class="label">Kelas Tiket</span>
                    <span><?php echo $kelasTxt; ?></span>
                </div>
                <div class="baris">
                    <span class="label">Jumlah Tiket</span>
                    <span><?php echo $jumlah; ?> tiket</span>
                </div>
                
                <div class="garis"></div>
                
                <div class="baris">
                    <span>Subtotal</span>
                    <span>Rp <?php echo number_format($subtotal, 0, ',', '.'); ?></span>
                </div>
                
                <?php if ($diskon > 0): ?>
                <div class="baris diskon">
                    <span>Diskon (10%)</span>
                    <span>- Rp <?php echo number_format($diskon, 0, ',', '.'); ?></span>
                </div>
                <?php else: ?>
                <div class="baris">
                    <span>Diskon</span>
                    <span>Rp 0</span>
                </div>
                <?php endif; ?>
                
                <div class="garis"></div>
                
                <div class="baris total">
                    <span>TOTAL BAYAR</span>
                    <span>Rp <?php echo number_format($total, 0, ',', '.'); ?></span>
                </div>
                
                <div class="footer">
                    Terima kasih, <?php echo htmlspecialchars($nama); ?>!<br>
                    Selamat menikmati event!<br>
                    Code by Patrick Ramadhani, 2412037 Universitas Mulia.
                </div>
                <?php
            } else {
                // Data tidak valid
                ?>
                <div class="kosong">
                    ⚡ Data tidak valid<br>
                    Pastikan nama minimal 3 karakter dan jumlah tiket minimal 1
                </div>
                <?php
            }
        } else {
            // Belum ada submit
            ?>
            <div class="kosong">
                ⚡ Silakan isi form di atas<br>
                untuk melihat struk pembayaran
            </div>
            <?php
        }
        ?>
    </div>
</div>
<script>
    document.getElementById('formPesan').addEventListener('submit', function(e) {
    let valid = true;
    
    // Validasi nama
    const nama = document.getElementById('nama').value.trim();
    const errorNama = document.getElementById('errorNama');
    
    if (nama === '') {
        errorNama.innerHTML = 'Nama tidak boleh kosong';
        valid = false;
    } else if (nama.length < 3) {
        errorNama.innerHTML = 'Nama minimal 3 karakter';
        valid = false;
    } else {
        errorNama.innerHTML = '';
    }
    
    // Validasi jumlah
    const jumlah = parseInt(document.getElementById('jumlah').value);
    const errorJumlah = document.getElementById('errorJumlah');
    
    if (isNaN(jumlah) || jumlah < 1) {
        errorJumlah.innerHTML = 'Jumlah tiket minimal 1';
        valid = false;
    } else {
        errorJumlah.innerHTML = '';
    }
    
    if (!valid) {
        e.preventDefault();
        alert('Mohon periksa kembali form anda');
    }
});

// Hapus error saat typing
document.getElementById('nama').addEventListener('input', function() {
    if (this.value.trim().length >= 3) {
        document.getElementById('errorNama').innerHTML = '';
    }
});

document.getElementById('jumlah').addEventListener('input', function() {
    if (parseInt(this.value) >= 1) {
        document.getElementById('errorJumlah').innerHTML = '';
    }
});
</script>
</body>
</html>
