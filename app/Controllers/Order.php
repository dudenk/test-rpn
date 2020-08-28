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

        header('Content-Type: application/json');
        echo json_encode( $response );   

     }


    public function print($uuid) {

        //$order = new OrderModel();
        // $hasil = $order->panggil( $uuid.'.json' );
        $file_name  = $uuid.'.json';

        
        if ( !file_exists( FCPATH. '../data/orders/'. $file_name )) {
            
        } else {
            $orders = json_decode(file_get_contents( FCPATH. '../data/orders/'. $file_name   ));

            // dijadikan pdf, composer local mpdf ada masalah di enviroment local saya. 
            print_r($orders);

        }
        

    }

	//--------------------------------------------------------------------

}
