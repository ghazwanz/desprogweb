<?php
$nilaiNumerik = 92;

if ($nilaiNumerik >= 90 && $nilaiNumerik <= 100) {
    echo "Nilai huruf: A";
} elseif ($nilaiNumerik >= 80 && $nilaiNumerik < 90) {
    echo "Nilai huruf: B";
} elseif ($nilaiNumerik >= 70 && $nilaiNumerik < 80) {
    echo "Nilai huruf: C";
} elseif ($nilaiNumerik < 70) {
    echo "Nilai huruf: D";
}

$jarakSaatIni = 0;
$jarakTarget = 500;
$peningkatanHarian = 30 ;
$hari = 0;

while ($jarakSaatIni < $jarakTarget) {
    $jarakSaatIni += $peningkatanHarian;
    $hari++;
}
echo "<br>";
echo "Atlet tersebut memerlukan <b>$hari</b> hari untuk mencapai 500 kilometer";

$jumlahLahan = 10;
$tanamanPerLahan = 5;
$buahPerTanaman = 10;
$jumlahBuah = 0;

for ($i=1; $i <= $jumlahLahan ; $i++) { 
    $jumlahBuah += ($tanamanPerLahan * $buahPerTanaman);
}
echo "<br>";
echo "Jumlah buah yang akan dipanen adalah: <b>$jumlahBuah</b> Buah";

$skorUjian = [85, 92, 78, 96, 88];
$totalSkor = 0;

foreach ($skorUjian as $skor) {
    $totalSkor += $skor;
}

echo "<br>";
echo "Total skor ujian adalah: <b>$totalSkor</b>";

$nilaiSiswa = [85, 92, 58, 64, 90, 55, 88, 79, 70, 96];

echo "<br><br>";
echo "<b>List Nilai Mahasiswa</b> <br>";
foreach ($nilaiSiswa as $nilai) {
    if ($nilai < 60) {
        echo "Nilai: $nilai (Tidak lulus) <br>";
        continue;
    }
    echo "Nilai: $nilai (Lulus) <br>";
}

$nilaiSiswa = [85, 92, 78, 64, 90, 75, 88, 79, 70, 96];
sort($nilaiSiswa);

$nilaiFiltered = array_slice($nilaiSiswa, 2);
$nilaiFiltered = array_slice($nilaiFiltered, 0, -2);

$totalSkor = 0;
$count = 0;
echo "<br>";
echo "Nilai yang digunakan: ";

foreach($nilaiFiltered as $nilai) {
    $totalSkor+=$nilai;
    $count++;
    if ($count == (count($nilaiFiltered))) {
        echo "$nilai";
        continue;
    }
    echo "$nilai, ";
}
echo "<br>";
echo "Total nilai yang digunakan adalah: $totalSkor <br>";

$hargaProduk = 120000;
$diskon = 0;

if ($hargaProduk > 100000)
    $diskon = 20;

$hargaBayar = $hargaProduk - ($hargaProduk * ($diskon/100));
echo "<br>";
echo "Harga produk: Rp $hargaProduk <br>";
if ($diskon  > 0)
    echo "Selamat anda mendapat diskon sebesar $diskon% <br>";

echo "Total Pembayaran : Rp $hargaBayar";

?>