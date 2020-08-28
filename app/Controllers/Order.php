<?php namespace App\Controllers;

use App\Models\ProductModel;
use App\Models\OrderModel;

class Order extends BaseController
{
    protected $ppn = 0.1; // Alias 10%

	public function index()
	{
        $products = new ProductModel();

        $data = [
            "ppn" => $this->ppn,
            "products" => $products->get()->data,
        ];

		return view('order/test', $data);
    }
    

    public function save() {
        $request_body = file_get_contents('php://input');
        $data = json_decode($request_body);
        $order = new OrderModel();
        $hasil = $order->tambah( $data );

        if ( $hasil ) {
            $response = array (
                'status' => true,
                'data' => $hasil,

            );
        } else {
            $response = array (
                'status' => false,
                'data' => [],
            );
        }

        header("Content-Type: application/json");
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: POST,GET, OPTIONS");
        header("Access-Control-Allow-Headers: *");
        echo json_encode( $response );   

     }


    public function print($uuid) {

        //$order = new OrderModel();
        // $hasil = $order->panggil( $uuid.'.json' );
        $file_name  = $uuid.'.json';

        
        if ( !file_exists( FCPATH. '../data/orders/'. $file_name )) {
            
        } else {
            $orders = json_decode(file_get_contents( FCPATH. '../data/orders/'. $file_name   ));

            $data['order'] = $orders;
            $data['uuid'] = $uuid;

            // $parser = new \CodeIgniter\View\Parser();

            // $html = view('order/pdf', $data); 
            // $html = $parser->setData($data)->render('blog_template');

            $product_name = $orders->data->productSelected->name ;
            $biaya = "Rp " . number_format($orders->data->totalNilaiProduct,2,',','.');
            $potongan = "Rp " . number_format($orders->data->potongan,2,',','.') ;
            $pajak = "Rp " . number_format($orders->data->pajak,2,',','.');
            $total = "Rp " . number_format($orders->data->total,2,',','.');

            $html = <<<EOF
                <table class="table" width="100%">
                    <tr>
                        <td>Product</td><td> $product_name  </td>
                    </tr>
                    <tr>
                        <td>Biaya Produk</td><td> $biaya </td>
                    </tr>
                    <tr>
                        <td>Total Discount</td><td> $potongan </td>
                    </tr>
                    <tr>
                        <td>Pajak</td><td> $pajak </td>
                    </tr>
                    <tr>
                        <td>Total</td><td> $total </td>
                    </tr>
                </table>
            EOF;
            
            $mpdf = new \Mpdf\Mpdf(['tempDir' => FCPATH . '../writable/tmp']);

            $mpdf->WriteHTML($html);
            header("Content-Type: application/pdf");
            $mpdf->Output();
            // dijadikan pdf, composer local mpdf ada masalah di enviroment local saya. 
            // print_r($orders);
            exit();

        }
        

    }

	//--------------------------------------------------------------------

}
