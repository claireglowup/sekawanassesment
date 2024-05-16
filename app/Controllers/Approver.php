<?php

namespace App\Controllers;

use App\Models\CarModel;
use App\Models\OrderModel;

class Approver extends BaseController
{
    protected $carModel;
    protected $orderModel;
    public function __construct()
    {
        $this->carModel = new CarModel();
        $this->orderModel = new OrderModel();
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
        if (session()->get("isLoggedIn")) {

            $db = \Config\Database::connect();

            try {

                $orderId = $this->request->getVar("orderid");
                $carId = $this->request->getVar("carid");
                $dataOrder = [
                    "approved" => 'Approved',
                    "action" => 1,
                    "car_status" => 1
                ];
                $dataCar = [
                    "available" => 2
                ];

                //start transaction
                $db->transStart();

                $this->orderModel->update($orderId, $dataOrder);
                $this->carModel->update($carId, $dataCar);

                $db->transComplete();
                if ($db->transStatus() === FALSE) {
                    $db->transRollback();
                    return redirect()->to("/inbox")->with('error', 'transaction failed');
                } else {
                    return redirect()->to("/inbox")->with('success', 'transaction successed');
                }
            } catch (\Exception $e) {
                $db->transRollback();
                echo "Terjadi kesalahan: " . $e->getMessage();
            }
        } else {
            return redirect()->to("/");
        }
    }


    public function rejected()
    {
        if (session()->get("isLoggedIn")) {
            $db = \Config\Database::connect();

            try {
                $orderId = $this->request->getVar("orderid");
                $carId = $this->request->getVar("carid");


                $data = [
                    "approved" => 'Rejected',
                    "action" => 1
                ];

                $dataCar = [
                    "available" => 1
                ];
                $db->transStart();

                $this->orderModel->update($orderId, $data);
                $this->carModel->update($carId, $dataCar);

                $db->transComplete();
                if ($db->transStatus() === FALSE) {
                    $db->transRollback();
                    return redirect()->to("/inbox")->with('error', 'transaction failed');
                } else {
                    return redirect()->to("/inbox")->with('success', 'transaction successed');
                }
            } catch (\Exception $e) {
                $db->transRollback();
                echo "Terjadi kesalahan: " . $e->getMessage();
            }
        } else {
            return redirect()->to("/");
        }
    }
}
