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

$a = true;
$b = false;

$hasilAnd = $a && $b;
$hasilOr = $a || $b;
$hasilNotA = !$a;
$hasilNotB = !$b;

echo "<br>";
echo "Operator Logika dari && (AND) $a && $b adalah <b>" . checkBoolean($hasilAnd) . "</b><br>";
echo "Operator Logika dari || (OR) $a || $b adalah <b>" . checkBoolean($hasilOr) . "</b><br>";
echo "Operator Logika dari !a (NOT) !$a adalah <b>" . checkBoolean($hasilNotA) . "</b><br>";
echo "Operator Logika dari !b (NOT) !$b adalah <b>" . checkBoolean($hasilNotB) . "</b><br>";

$a=10;
$b=5;
echo "<br>";
echo "Nilai Awal a: $a dan Nilai Awal b: $b <br>";

echo "Nilai variabel a saat ini: $a, Hasil operator penugasan += pada $a += $b adalah <b>";
$a += $b;
echo "$a</b><br>";

echo "Nilai variabel a saat ini: $a, Hasil operator penugasan -= pada $a -= $b adalah <b>";
$a -= $b;
echo "$a</b><br>";

echo "Nilai variabel a saat ini: $a, Hasil operator penugasan *= pada $a *= $b adalah <b>";
$a *= $b;
echo "$a</b><br>";

echo "Nilai variabel a saat ini: $a, Hasil operator penugasan /= pada $a /= $b adalah <b>";
$a /= $b;
echo "$a</b><br>";

echo "Nilai variabel a saat ini: $a, Hasil operator penugasan /= pada $a /= $b adalah <b>";
$a %= $b;
echo "$a</b><br>";
?>