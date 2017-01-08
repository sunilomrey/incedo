<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

/* 
@author : Suneel kumar

Product Code | Price
--------------------
A            | $2.00 each or 4 for $7.00
B            | $12.00
C            | $1.25 or $6 for a six pack
D            | $0.15

*/

if(!$_POST && !isset($_POST['product_txt'])) {
    echo "Not allowed";
    break;
}
    
$product_txt = $_POST['product_txt'];
$terminal = new Terminal($product_txt);
$terminal->scan("A");
$terminal->scan("B");
$terminal->scan("C");
$terminal->scan("D");
$result = $terminal->total;
echo "Price : ". $result;

class Terminal {
    public $total = 0;
    public $product_txt = "";
    
    function __construct($product_txt) {
        $this->product_txt = $product_txt;
        echo "Entered Text : ". $this->product_txt . "<br>";
    }
    
    public function scan($product) {
        $a_count = substr_count($this->product_txt, $product);
        
        switch ($product) {
            case "A":               
                
                $volume = intval($a_count/4);
                $volume_price = $volume*7;
                $this->total += $volume_price;
                $unit = $a_count%4;
                $unit_price = $unit*2;
                $this->total += $unit_price;
                break;
            case "B":
                $unit_price = $a_count*12;
                $this->total += $unit_price;
                break;
            case "C":
                $volume = intval($a_count/6);
                $volume_price = $volume*6;
                $this->total += $volume_price;
                $unit = $a_count%6;
                $unit_price = $unit*1.25;
                $this->total += $unit_price;
                break;
            case "D":
                $unit_price = $a_count*0.15;
                $this->total += $unit_price;
                break;

            default:
                $this->total = $this->total;
        }
    }
    
    public function total() {
        return $this->total;
    }
}

?>
