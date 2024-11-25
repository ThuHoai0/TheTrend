<?php
class Giohang
{
    public $conn;
    public function __construct() {
        $this->conn = connectDB();
    }


}