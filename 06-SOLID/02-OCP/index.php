<?php
    /** Open/Closed Principle */
    // The open/closed principle states that software entities (classes, modules, functions, etc.)
    // should be open for extension but closed for modification.
    interface PaymentMethod
    {
        public function pay(float $amount);

    }
    class CreditCard implements PaymentMethod
    {
        private $info =[];
        public function information(array $info){
            $this->info = $info;
        }
        public function pay(float $amount)
        {
            echo "Pay with Credit Card";
        }
    }

    class WalletPayment implements PaymentMethod
    {
        private $number;
        public function pay(float $amount){
            echo "Pay with Wallet";
        }
        public function walletNumber($number){
            $this->number = $number;
            echo "Wallet number: $number "; 
        }
    }

    class Payment{
        public function method($method){
            if ($method == 'Wallet'){
                return (new WalletPayment);
            }elseif($method == 'CreditCard'){
                return(new(new CreditCard));
            }else{
                return null;
            }
        }
    }
    $pay = new Payment;
    $method = $pay->method('Wallet');
    $method ->walletNumber('123456789');
    echo "<br>";
    $method->pay(100);
    echo "<hr>";


$method = $pay->method('CreditCard');
$method->information([
    'name' => 'Zeinab',
    'number' => '123456789',
    'cvv' =>'100',
    'expirationDate' => '2025-01-01',
    'address'=> "Address"
]);
$method->pay(100.00);
