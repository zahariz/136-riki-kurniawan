function printBin(data){


    const mywindow = window.open("", "PRINT");
    mywindow.document.write(`
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Label Palet ID</title>
    <style>
        /* Gaya label */
        .label {
            width: 103mm;
            height: 80mm;
            border: 1px solid #000;
            padding: 12px;
            margin: 0px;
            display: inline-block;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        /* Gaya teks dalam label */
        .label-text {
            font-size: 42px;
            font-weight: bold;
            text-align: center;
        }

        /* Gaya sub-teks dalam label */
        .label-subtext {
            font-size: 30px;
            text-align: center;
            margin-top: 10px;
        }

        /* Gaya kode palet */
        .palette-code {
            font-size: 48px;
            text-align: center;
            margin-top: 20px;
            background-color: #F5A623;
            padding: 5px 10px;
            color: black;
        }
    </style>
</head>
<center>
<body>
    <!-- Label Palet ID -->
    `);
    data.forEach(function(item, index) {
        var namaPelanggan = item.product.product_name;
        var invoice_number = item.transaction.transaction_code;
        var bin = item.sbin.kode_bin;
        var sloc = item.sloc.nama_sloc;
        var QTY = item.qty;
    mywindow.document.write(`
    <div class="label">

        <div class="label-text">#${invoice_number}</div>
        <div class="label-subtext">${namaPelanggan}</div>
        <div class="label-text">${QTY} Kg</div>
        <div class="label-subtext">Sloc: ${sloc}</div>
        <div class="palette-code">${bin}</div>
        </div>
        `);
    });
    mywindow.document.write(`

    <!-- Anda bisa menambahkan lebih banyak label sesuai kebutuhan -->
</body>
</center>
</html>
    `);
    mywindow.print();
    mywindow.close();
    return true;
}
