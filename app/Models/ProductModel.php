<?php namespace App\Models;

use CodeIgniter\Model;

class ProductModel extends Model
{
    protected $path         = FCPATH. '../data/';
    protected $file_name    = 'products.json';


    public function get() {
        if ( !file_exists( $this->path. $this->file_name )) {
            return false;
        } else {
            $products = json_decode(file_get_contents($this->path. $this->file_name ));
            return $products;
        }
    }
    public function simpan($data) {
        // function save default dari codeigniter
        $json_data = array (
            "data" => $data,
            "created" => time()
        );
        $json_data = json_encode($json_data);

        if ( ! write_file( $this->path. $this->file_name , $json_data))
        {
            return true;
        }
        else
        {
            return false;
        }
    }
}
