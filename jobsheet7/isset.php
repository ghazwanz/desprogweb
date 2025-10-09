<?php
$umur = null;
if (isset($umur)) {
    echo "Variabel 'umur' telah didefinisikan.<br>";
} else {
    echo "Variabel 'umur' tidak ditemukan atau bernilai null.<br>";
}

$data = array("nama" => "Jane", "usia" => 25);
if (isset($data["nama"])) {
    echo "Nama: " . $data["nama"] . "<br>";
} else {
    echo "Variabel 'nama' tidak ditemukan dalam array.<br>";
}

?>