<?php

namespace App\Models;

use CodeIgniter\Model;

class OrderModel extends Model
{
    protected $table = "order";
    protected $allowedFields = ["id", "nama_pegawai", "jabatan_pegawai", "car_id", "admin_id", "estimasi_jarak", "approver_id", "action", "approved", "car_status"];

    public function getOrderById($id)
    {
        try {
            $query = "SELECT order.id,order.car_status, car.name, users.username, order.nama_pegawai, order.jabatan_pegawai, order.estimasi_jarak, order.approved, order.time, order.action, order.car_id
                      FROM `order`
                      JOIN car on car.id = order.car_id
                      JOIN users on users.id = order.approver_id
                      WHERE order.admin_id = ?";

            return $this->db->query($query, [$id])->getResult();
        } catch (\Exception $e) {
            log_message('error', $e->getMessage());
        }
    }

    public function getOrderForApprover($id)
    {
        try {
            $query = "SELECT order.id, car.name, users.username, order.nama_pegawai, order.jabatan_pegawai, order.estimasi_jarak, order.approved, order.time, order.action, order.car_id
                      FROM `order`
                      JOIN car on car.id = order.car_id
                      JOIN users on users.id = order.admin_id
                      WHERE order.approver_id = ?";

            return $this->db->query($query, [$id])->getResult();
        } catch (\Exception $e) {
            log_message('error', $e->getMessage());
        }
    }
}
