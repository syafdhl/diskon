<?php
$barang = [
    ['nama' => 'sleeping beauty', 'harga' => 100000],
    ['nama' => 'The secret garden', 'harga' => 120000],
    ['nama' => 'The paris apartmen', 'harga' => 110000],
    ['nama' => 'A little princess', 'harga' => 130000]
];

$hasil = null;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $i = $_POST['index'];
    $jumlah = (int)$_POST['jumlah'];
    $diskon = (int)$_POST['diskon'];

    $nama = $barang[$i]['nama'];
    $harga = $barang[$i]['harga'];
    $total = $harga * $jumlah * ((100 - $diskon) / 100);

    $hasil = [
        'nama' => $nama,
        'harga' => $harga,
        'jumlah' => $jumlah,
        'diskon' => $diskon,
        'total' => $total
    ];
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Katalog Buku</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <h2>Katalog Buku</h2>
    <div class="grid">
        <?php foreach ($barang as $i => $b) : ?>
            <div class="item">
                <h4><?= $b['nama']; ?></h4>
                <p>Rp <?= number_format($b['harga'], 0, ',', '.'); ?></p>
                <form method="post">
                    <input type="hidden" name="index" value="<?= $i; ?>">
                    <label>Jumlah:
                        <input type="number" name="jumlah" value="1" min="1">
                    </label>
                    <label>Diskon (%):
                        <input type="number" name="diskon" value="0" min="0" max="100">
                    </label>
                    <button type="submit">Pilih & Hitung</button>
                </form>
            </div>
        <?php endforeach; ?>
    </div>

    <?php if ($hasil) : ?>
        <div class="result-container">
            <h3> Hasil Perhitungan</h3>
            <div class="result">
                <p><strong>Barang:</strong> <?= $hasil['nama']; ?></p>
                <p><strong>Harga Satuan:</strong> Rp <?= number_format($hasil['harga'], 0, ',', '.'); ?></p>
                <p><strong>Jumlah:</strong> <?= $hasil['jumlah']; ?></p>
                <p><strong>Diskon:</strong> <?= $hasil['diskon']; ?>%</p>
                <p><strong>Total Bayar:</strong> Rp <?= number_format($hasil['total'], 0, ',', '.'); ?></p>
            </div>
        </div>
    <?php endif; ?>
</div>
</body>
</html>
