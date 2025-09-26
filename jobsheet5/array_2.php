<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title></title>
    <style>
        table{
            border-collapse: collapse;
            text-align: left;
            width: 500px;
        }
        th{
            padding: 8px 16px;
        }
        td{
            padding: 16px;
        }
        .heading{
            border-radius: 10px;
            background: #0077ffff;
            color: white;
        }
        .heading th:first-child{
            border-radius: 10px 0 0 0;
        }
        .heading th:last-child{
            border-radius: 0 10px 0 0;
        }
        .row{
            background: #f7f7f7;
            transition: all 0.3s ease;
        }

        .row td:first-child{
            border-radius: 0 0 0 10px;
        }
        .row td:last-child{
            border-radius: 0 0 10px 0;
        }

        .row:hover{
            background: #e0e0e0;
        }
    </style>
</head>

<body>
    <table>
        <?php
        $Dosen = [
            'nama' => 'Elok Nur Hamdana',
            'domisili' => 'Malang',
            'jenis_kelamin' => 'Perempuan'
        ];
        echo "<tr class='heading'><th>Nama</th><th>Domisili</th><th>Jenis Kelamin</th></tr>";
        echo "<tr class='row'>";
        echo "<td>{$Dosen['nama']}</td>";
        echo "<td>{$Dosen['domisili']} </td>";
        echo "<td>{$Dosen['jenis_kelamin']}</td>";
        echo "</tr>";
        ?>
    </table>
</body>

</html>