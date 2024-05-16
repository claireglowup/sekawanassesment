<?php

namespace App\Controllers;

use App\Models\CarModel;
use App\Models\OrderModel;
use App\Models\UsersModel;
use Ramsey\Uuid\Uuid;

class Home extends BaseController
{
    protected $carModel;
    protected $usersModel;
    protected $orderModel;
    public function __construct()
    {
        $this->carModel = new CarModel();
        $this->usersModel = new UsersModel();
        $this->orderModel = new OrderModel();
    }


    public function index(): string
    {
        return view('pages/home', ['title' => "Home"]);
    }




    public function inbox()
    {
        if (session()->get("isLoggedIn")) {

            $id = session()->get("userId");
            $result = $this->orderModel->getOrderForApprover($id);
            $data = [
                "title" => "Kotak Masuk",
                "orders" => $result,
            ];

            return view("pages/kotakmasuk", $data);
        } else {
            return redirect()->to("/");
        }
    }






    public function approveOk()
    {
        $db = \Config\Database::connect();

        try {
            //start transaction
            $db->transStart();

            $orderId = $this->request->getVar("orderid");
            $carId = $this->request->getVar("carid");
            $dataOrder = [
                "approved" => 'Approved',
                "action" => 1
            ];
            $dataCar = [
                "available" => 2
            ];

            $this->orderModel->update($orderId, $dataOrder);

            $this->carModel->update($carId, $dataCar);

            $db->transComplete();
            if ($db->transStatus() === FALSE) {
                return redirect()->to("/inbox")->with('error', 'transaction failed');
            } else {
                return redirect()->to("/inbox")->with('success', 'transaction successed');
            }
        } catch (\Exception $e) {
            $db->transRollback();
            echo "Terjadi kesalahan: " . $e->getMessage();
        }
    }


    public function rejected()
    {
        try {
            $orderId = $this->request->getVar("id");

            $data = [
                "approved" => 'Rejected',
                "action" => 1
            ];

            $this->orderModel->update($orderId, $data);

            return redirect()->to("/inbox");
        } catch (\Exception $e) {
            echo "Terjadi kesalahan: " . $e->getMessage();
        }
    }
}
