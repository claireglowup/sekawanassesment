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
    }


    public function orderAction()
    {
        try {
            $approverId = $this->request->getPost("approver");
            $namaPegawai = $this->request->getPost("namap");
            $jabatanPegawai = $this->request->getPost("jabatan");
            $jarak = $this->request->getPost("kilometer");
            $adminId = session()->get("userId");
            $carId = $this->request->getVar("idcar");
            $uuid = Uuid::uuid4();
            $id = $uuid->toString();

            $data = [
                "id" => $id,
                "nama_pegawai" => $namaPegawai,
                "jabatan_pegawai" => $jabatanPegawai,
                "estimasi_jarak" => $jarak,
                "approver_id" => $approverId,
                "car_id" => $carId,
                "admin_id" => $adminId,
            ];

            $this->orderModel->insert($data);

            return redirect()->to('/');
        } catch (\Exception $e) {
            echo "Terjadi kesalahan: " . $e->getMessage();
        }
    }
}
