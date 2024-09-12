<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Pembelian Bahan Bakar</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-color: #f0f0f0;
            text-align: center;
            background-size: cover;

            font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;
        }

        .container {
            width: 70%;
            margin: auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            background-size: cover;
            color: black;
        }


        }

        h1 {
            margin-bottom: 50px;
            color: orange;
        }

        h2 {
            margin-bottom: 20px;
        }

        h4 {
            margin-bottom: 10px;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        select,
        input[type="number"],
        button {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 3px;
            box-sizing: border-box;
        }

        button {
            width: 70px;
            border: none;
            cursor: pointer;
        }

        .btn-2{
            margin: 1em;
        }

        @media print{
            .hilang{
                display: none;
            }
        }

        .detail-pembelian {
            margin-top: 20px;
            border-top: 1px solid #ccc;
            padding-top: 10px;
        }

        .form-group {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10px;
            <img src="http://www.dsf.my/wp-content/uploads/2016/07/shell-v-power1.jpg" alt="">
        }

        .form-group label {
            width: 30%;
            text-align: right;
        }

        .form-group select,
        .form-group input[type="number"] {
            width: 65%;
        }

        a:link,
        a:visited {
            background-color: #00CCDD;
            color: white;
            padding: 14px 25px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
        }

        a:hover,
        a:active {
            background-color: #4F75FF;
        }
    </style>
</head>

<body>
    <div class="container">
        <?php
        class Shell
        {
            public $harga_super;
            public $harga_vpower;
            public $harga_diesel;
            public $harga_nitro;
            public $ppn;

            public function __construct($harga_super, $harga_vpower, $harga_diesel, $harga_nitro, $ppn)
            {
                $this->harga_super = $harga_super;
                $this->harga_vpower = $harga_vpower;
                $this->harga_diesel = $harga_diesel;
                $this->harga_nitro = $harga_nitro;
                $this->ppn = $ppn;
            }
        }

        class Beli extends Shell
        {
            public function hitungTotalBayar($jenis, $jumlah)
            {
                switch ($jenis) {
                    case "Super":
                        $harga_per_liter = $this->harga_super;
                        break;
                    case "V-Power":
                        $harga_per_liter = $this->harga_vpower;
                        break;
                    case "V-Power Diesel":
                        $harga_per_liter = $this->harga_diesel;
                        break;
                    case "V-Power Nitro":
                        $harga_per_liter = $this->harga_nitro;
                        break;
                    default:
                        return "Jenis bahan bakar tidak valid";
                }

                $total_sebelum_ppn = $harga_per_liter * $jumlah;
                $ppn_value = $total_sebelum_ppn * $this->ppn;
                $total_setelah_ppn = $total_sebelum_ppn + $ppn_value;

                $harga_per_liter_formatted = number_format($harga_per_liter, 2, ",", ".");
                $total_sebelum_ppn_formatted = number_format($total_sebelum_ppn, 2, ",", ".");
                $ppn_value_formatted = number_format($ppn_value, 2, ",", ".");
                $total_setelah_ppn_formatted = number_format($total_setelah_ppn, 2, ",", ".");

                return [
                    'harga_per_liter' => $harga_per_liter_formatted,
                    'total_sebelum_ppn' => $total_sebelum_ppn_formatted,
                    'ppn_value' => $ppn_value_formatted,
                    'total_setelah_ppn' => $total_setelah_ppn_formatted
                ];
            }
        }

        $harga = [
            "Super" => 15420,
            "V-Power" => 16130,
            "V-Power Diesel" => 18310,
            "V-Power Nitro" => 16510
        ];
        $ppn = 0.1;

        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["jenis"]) && isset($_POST["jumlah"])) {
            $jenis = $_POST["jenis"];
            $jumlah = $_POST["jumlah"];

            $shell = new Beli(harga_super: $harga["Super"], harga_vpower: $harga["V-Power"], harga_diesel: $harga["V-Power Diesel"], harga_nitro: $harga["V-Power Nitro"], ppn: $ppn);

            if (array_key_exists($jenis, $harga)) {
                $total_bayar = $shell->hitungTotalBayar($jenis, $jumlah);
                echo "<h2>Detail Pembelian</h2>";
                echo "-----------------------------------------------------------------------------------";
                echo "<h4>Anda membeli bahan bakar minyak tipe: $jenis</h4>";
                echo "<h4>Harga per liter: {$total_bayar['harga_per_liter']}</h4>";
                echo "<h4>Harga dasar (tanpa PPN): {$total_bayar['total_sebelum_ppn']}</h4>";
                echo "<h4>PPN (10%): {$total_bayar['ppn_value']}</h4>";
                echo "<h4>Dengan jumlah liter: $jumlah</h4>";
                echo "<h4>Total yang harus Anda bayar: {$total_bayar['total_setelah_ppn']}</h4>";
                echo "----------------------------------------------------------------------------------";
            } else {
                echo "<h4>Jenis bahan bakar tidak valid.</h4>";
            }
        }
        ?>
        <br>
        <div class="hilang">
        <a href="bahan bakar.html" >kembali</a>
        <button type="button" class="btn-2" onclick="window.print()">Cetak</button>
        </div>
    </div>
</body>

</html>