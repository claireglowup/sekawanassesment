<?php

namespace App\Controllers;

use App\Models\CarModel;
use App\Models\OrderModel;
use App\Models\UsersModel;
use Ramsey\Uuid\Uuid;

class Admin extends BaseController
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


    public function car()
    {
        if (session()->get("isLoggedIn")) {
            $type = $this->request->getVar('type');
            $result =  $this->carModel->where('type', $type)->findAll();

            $data = [
                "title" => "Car",
                "type" => $type,
                "cars" => $result
            ];

            return view('pages/car', $data);
        } else {
            return redirect()->to("/");
        }
    }

    public function order(): string
    {
        if (session()->get("isLoggedIn")) {

            try {
                $id = $this->request->getVar('id');
                $result =  $this->carModel->where('id', $id)->first();
                $approver = $this->usersModel->where("role", "approver")->findAll();

                $data = [
                    "title" => "Order",
                    "car" => $result,
                    "approvers" => $approver
                ];

                return view("pages/order", $data);
            } catch (\Exception $e) {
                echo "Terjadi kesalahan: " . $e->getMessage();
            }
        } else {
            return redirect()->to("/");
        }
    }

    public function orderAction()
    {
        if (session()->get("isLoggedIn")) {

            $db = \Config\Database::connect();


            try {
                $approverId = $this->request->getPost("approver");
                $namaPegawai = $this->request->getPost("namap");
                $jabatanPegawai = $this->request->getPost("jabatan");
                $jarak = $this->request->getPost("kilometer");
                $adminId = session()->get("userId");
                $carId = $this->request->getVar("idcar");
                $uuid = Uuid::uuid4();
                $id = $uuid->toString();

                $dataOrder = [
                    "id" => $id,
                    "nama_pegawai" => $namaPegawai,
                    "jabatan_pegawai" => $jabatanPegawai,
                    "estimasi_jarak" => $jarak,
                    "approver_id" => $approverId,
                    "car_id" => $carId,
                    "admin_id" => $adminId,
                ];

                $carData = [
                    "available" => 3

                ];

                //start transaction
                $db->transStart();

                $this->orderModel->insert($dataOrder);
                $this->carModel->update($carId, $carData);

                $db->transComplete();
                if ($db->transStatus() === FALSE) {
                    $db->transRollback();
                    return redirect()->to("/activity")->with('error', 'transaction failed');
                } else {
                    return redirect()->to("/activity")->with('success', 'transaction successed');
                }
            } catch (\Exception $e) {
                $db->transRollback();
                echo "Terjadi kesalahan: " . $e->getMessage();
            }
        } else {
            return redirect()->to("/");
        }
    }

    public function activity()
    {
        if (session()->get("isLoggedIn")) {

            $id = session()->get("userId");
            $result = $this->orderModel->getOrderById($id);

            $data = [
                "title" => "Order",
                "orders" => $result,
            ];

            return view("pages/aktivitas", $data);
        } else {
            return redirect()->to("/");
        }
    }

    public function carReturn()
    {
        if (session()->get("isLoggedIn")) {
            $db = \Config\Database::connect();


            try {
                $carId = $this->request->getVar("carid");
                $orderId = $this->request->getVar("orderid");

                $result =  $this->orderModel->where('id', $orderId)->first();
                $kilometer = $result['estimasi_jarak'];

                $dataCar = [
                    "available" => 1,
                    "kilometer" => +$kilometer
                ];

                $dataOrder = [
                    "car_status" => 2
                ];

                $db->transStart();
                $this->carModel->update($carId, $dataCar);
                $this->orderModel->update($orderId, $dataOrder);
                $db->transComplete();
                if ($db->transStatus() === FALSE) {
                    $db->transRollback();
                    return redirect()->to("/activity")->with('error', 'transaction failed');
                } else {
                    return redirect()->to("/activity")->with('success', 'transaction successed');
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
