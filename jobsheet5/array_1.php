<!DOCTYPE html>
<html>

<head>
</head>

<body>
    <h2>Array Terindeks</h2>
    <?php
        $Listdosen = ["Elok Nur Hamdana", "Unggul Pamenang", "Bagas Nugraha"];
        echo $Listdosen[2] . "<br>";
        echo $Listdosen[0] . "<br>";
        echo $Listdosen[1] . "<br>";

        // Menggunakan Foreach Loop
        echo "<br>";
        echo "Menggunakan Foreach Loop";
        echo "<br>";
        foreach ($Listdosen as $dosen) {
            echo $dosen . "<br>";
        }
        
        // Menggunakan For Loop
        echo "<br>";
        echo "Menggunakan For Loop";
        echo "<br>";
        for ($i=0; $i < count($Listdosen); $i++) { 
            echo $Listdosen[$i] . "<br>";
        }
    ?>
</body>

</html>