<?php
$a = 10;
$b = 5;
$hasilTambah = $a + $b;
$hasilKurang = $a - $b;
$hasilKali = $a * $b;
$hasilBagi = $a / $b;
$sisaBagi = $a % $b;
$pangkat = $a ** $b;

echo "Hasil dari Penjumlahan $a + $b adalah $hasilTambah <br>";
echo "Hasil dari Pengurangan $a - $b adalah $hasilKurang <br>";
echo "Hasil dari Perkalian $a * $b adalah $hasilKali <br>";
echo "Hasil dari Pembagian $a / $b adalah $hasilBagi <br>";
echo "Hasil dari modulus (sisa bagi) $a % $b adalah $sisaBagi <br>";
echo "Hasil Perpangkatan dari $a<sup>$b</sup> adalah $pangkat <br>";

$hasilSama = $a == $b;
$hasilTidakSama = $a != $b;
$hasilLebihKecil = $a < $b;
$hasilLebihBesar = $a > $b;
$hasilLebihKecilSama = $a <= $b;
$hasilLebihBesarSama = $a >= $b;

function checkBoolean ($args){
    return $args ? "benar" : "salah";
};

echo "<br>";
echo "Perbandingan dari sama dengan $a == $b adalah <b>" . checkBoolean($hasilSama) . "</b><br>";
echo "Perbandingan dari tidak sama dengan $a != $b adalah <b>" . checkBoolean($hasilTidakSama) . "</b><br>";
echo "Perbandingan dari lebih kecil $a < $b adalah <b>" . checkBoolean($hasilLebihKecil) . "</b><br>";
echo "Perbandingan dari lebih besar $a > $b adalah <b>" . checkBoolean($hasilLebihBesar) . "</b><br>";
echo "Perbandingan dari lebih kecil sama dengan $a <= $b adalah <b>" . checkBoolean($hasilLebihKecilSama) . "</b><br>";
echo "Perbandingan dari lebih besar sama dengan $a >= $b adalah <b>" . checkBoolean($hasilLebihBesarSama) . "</b><br>";
?>