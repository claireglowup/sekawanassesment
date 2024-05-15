<?php

namespace App\Controllers;

use App\Models\CarModel;

class Home extends BaseController
{


    protected $carModel;
    public function __construct()
    {
        $this->carModel = new CarModel();
    }


    public function index(): string
    {
        return view('pages/home', ['title' => "Home"]);
    }

    public function car(): string
    {
        $type = $this->request->getVar('type');
        $result =  $this->carModel->where('type', $type)->findAll();

        $data = [
            "title" => "Car",
            "type" => $type,
            "cars" => $result

        ];


        return view('pages/car', $data);
    }

    public function order(): string
    {

        $id = $this->request->getVar('id');
        $result =  $this->carModel->where('id', $id)->first();

        $data = [
            "title" => "Order",
            "car" => $result
        ];

        return view("pages/order", $data);
    }
}
