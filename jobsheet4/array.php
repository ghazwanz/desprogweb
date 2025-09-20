<?php
$nilaiMahasiswa = [85, 92, 78, 64, 90, 55, 88, 79, 70, 96];
$nilaiLulus=[];
foreach ($nilaiMahasiswa as $nilai) {
    if ($nilai >= 70) {
        $nilaiLulus[] = $nilai;
    }
}

echo "Daftar nilai siswa yang lulus: " . implode(", ", $nilaiLulus);

$daftarkaryawan = [
    ['Alice', 7],
    ['Bob', 3],
    ['Charlie', 9],
    ['David', 5],
    ['Eva', 6],
];
$karyawanPengalamanLimaTahun = [];
foreach ($daftarkaryawan as $karyawan) {
    if ($karyawan [1] > 5) {
        $karyawanPengalamanLimaTahun[] = $karyawan [0];
    }
}
echo "<br>";
echo "Daftar karyawan dengan pengalaman kerja lebih dari 5 tahun: " . implode(', ',$karyawanPengalamanLimaTahun);

$daftarNilai = [
    'Matematika' => [
        ['Alice', 85],
        ['Bob', 92],
        ['Charlie', 78],
    ],
    'Fisika' => [
        ['Alice', 90],
        ['Bob', 88],
        ['Charlie', 75],
    ],
    'Kimia' => [
        ['Alice', 92],
        ['Bob', 80],
        ['Charlie', 85],
    ],
];

$mataKuliah = 'Fisika';

echo "<br><br>";
echo "Daftar nilai mahasiswa dalam mata kuliah <b>$mataKuliah</b>: <br>";

foreach ($daftarNilai[$mataKuliah] as $nilai) {
    echo "Nama: {$nilai [0]}, Nilai: {$nilai[1]} <br>";
}
?>