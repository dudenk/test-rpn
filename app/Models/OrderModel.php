<?php namespace App\Models;

use CodeIgniter\Model;

class OrderModel extends Model
{
    protected $path         = FCPATH. '../data/orders/';
    // protected $file_name    = 'orders.json';


    public function panggil( $file_name ) {
        if ( !file_exists( $this->path. $this->file_name )) {
            return false;
        } else {
            $orders = json_decode(file_get_contents($this->path. $this->file_name ));
            return $orders;
        }
    }
    public function tambah($data) {
        // function insert default dari codeigniter 4 untuk database.
        
        $uuid = time();
        $data->uuid = $uuid;

        if ( !file_exists( $this->path. $uuid .'.json' )) {
            $json_data = array (
                "data" => $data,
                "created" => time()
            );

            $json_data = json_encode($json_data);
        
            if ( file_put_contents( $this->path. $uuid .'.json', $json_data))
            {
                return $uuid;
            }
            else
            {
                return false;
            }

        } else {
           return false;
        }
        
    }
}
