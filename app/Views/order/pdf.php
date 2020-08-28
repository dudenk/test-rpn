<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title><?= $uuid;?> </title>
	<meta name="description" content="The small framework with powerful features">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="shortcut icon" type="image/png" href="/favicon.ico"/>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <style>
       
    </style>
   </head>
<body>


<section  id="app" class="one-page">

        <table class="table" width="100%">
            <tr>
                <td>Product</td><td> <?= $order->data->productSelected->name ?> </td>
            </tr>
            <tr>
                <td>Biaya Produk</td><td> {{ formatPrice(dataOrder.totalNilaiProduct) }} </td>
            </tr>
            <tr>
                <td>Total Discount</td><td> {{ formatPrice(dataOrder.potongan) }} </td>
            </tr>
            <tr>
                <td>Pajak</td><td> {{ formatPrice(dataOrder.pajak) }} </td>
            </tr>
            <tr>
                <td>Total</td><td> {{ formatPrice(dataOrder.total) }} </td>
            </tr>
        </table>
</section>

</body>
</html>
