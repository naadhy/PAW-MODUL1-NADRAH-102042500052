<?php
//data produk 
$products = [
    [
        "Nama" => "MacBook Pro",
        "Kategori" => "Laptop",
        "Harga" => 8500000,
        "Stok" => 3,
    ],
    [
        "Nama" => "Monitor 26 Inch",
        "Kategori" => "Monitor",
        "Harga" => 1800000,
        "Stok" => 4,
    ],
    [
        "Nama" => "Headphone Wireless",
        "Kategori" => "Audio",
        "Harga" => 1200000,
        "Stok" => 7,
    ],
    [
        "Nama" => "Mechanical Keyboard Black",
        "Kategori" => "Accessories",
        "Harga" => 650000,
        "Stok" => 12,
    ],
    [
        "Nama" => "Wireless & USB Mouse",
        "Kategori" => "Accessories",
        "Harga" => 250000,
        "Stok" => 15,
    ],
    [
        "Nama" => "Webcam Full HD",
        "Kategori" => "Accessories",
        "Harga" => 450000,
        "Stok" => 0,
    ],
];

//pengaturan diskonnya
$batasDiskon = 1000000; //harga minimal buat dapetin diskon
$diskonPersen = 10; //besar diskon dalam persen nya

//format rupiah (fungsi)
function formatRupiah($angka)
{
    return "Rp" . number_format($angka, 0, ", ", ".");
}

//jumlah produk otomatis
$totalProduk = count($products);
?>

<!-- HTML -->
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cia Store</title>
    <link rel="stylesheet" href="hiasanweek3PAWmodul.css">
</head>

<body>
    <header class="header">
        <nav class="navbar container">
            <a href="#home" class="logo">Cia Store</a>
            <div class="nav-links">
                <a href="#home">Home</a>
                <a href="#products">Products</a>
                <a href="#about">About</a>
            </div>
        </nav>
    </header>

    <main class="container">
        <!-- HERO -->
        <section id="home" class="hero">
            <span class="hero-label">Cia Store</span>
            <h1>Welcome to your tech corner.</h1>
            <p>Discover tech essentials made for your everyday needs.</p>
            <a href="#products" class="hero-button">Lihat Produk</a>
        </section>

        <!-- info jumlah produk -->
        <section id="products" class="catalog">
            <div class="catalog-header">
                <div>
                    <p class="catalog-label">Produk Kami</p>
                    <h2>Katalog Produk</h2>
                </div>
                <div>
                    <span class="total-badge">Total Produk:
                        <strong>
                            <?= $totalProduk; ?>
                        </strong>
                    </span>
                </div>
            </div>

            <!-- Katalog Produk -->
            <div class="product-grid">

                <?php foreach ($products as $product): ?>
                    <?php
                    $harga = $product["Harga"];

                    //percabangan buat diskon: harga >= Rp.1.000.000 dapat diskon 10%
                    $dapatDiskon = $harga >= $batasDiskon;
                    $hargaAkhir = $harga;
                    if ($dapatDiskon) {
                        $hargaAkhir = $harga - ($harga * $diskonPersen / 100);
                    }

                    //percabangan status stok
                    $tersedia = $product["Stok"] > 0;
                    ?>
                    <article class="product-card">
                        <div class="card-top">
                            <span class="category"><?= $product["Kategori"]; ?>
                            </span>
                            <?php if ($dapatDiskon): ?>
                                <span class="discount-badge">Diskon <?= $diskonPersen; ?>%</span>
                            <?php endif; ?>
                        </div>

                        <h3 class="product-name"><?= $product["Nama"]; ?></h3>
                        <div class="price-box">
                            <?php if ($dapatDiskon): ?>
                                <span class="price-old"><?= formatRupiah($harga); ?></span>
                            <?php endif; ?>
                            <span class="price-now"><?= formatRupiah($hargaAkhir); ?></span>
                        </div>
                        <div class="card-bottom">
                            <div class="stock-row">
                                <span class="stock">Stok: <?= $product["Stok"]; ?></span>
                                <?php if ($tersedia): ?>
                                    <span class="status status-available">Tersedia</span>
                                <?php else: ?>
                                    <span class="status status-soldout">Stok Habis</span>
                                <?php endif; ?>
                            </div>
                            <?php if ($tersedia): ?>
                                <button class="buy-button">Beli Sekarang</button>
                            <?php else: ?>
                                <button class="buy-button" disabled>Beli Sekarang</button>
                            <?php endif; ?>
                        </div>
                    </article>

                <?php endforeach; ?>
            </div>
        </section>
    </main>

    <!-- FOOTER -->
    <footer id="about" class="footer">
        <div class="footer-inner container">
            <strong>Cia Store</strong>
            <span>Toko perangkat dan aksesoris teknologi sederhana.</span>
            <span>&copy; <?= date("Y"); ?> Cia Store</span>
        </div>
    </footer>
</body>

</html>