<?php

namespace App\Models;

use CodeIgniter\Model;

class OrderModel extends Model
{
    protected $table = "order";
    protected $allowedFields = ["id", "nama_pegawai", "jabatan_pegawai", "car_id", "admin_id", "estimasi_jarak", "approver_id",];

    public function getOrderById($id)
    {
        try {
            $query = "SELECT car.name, order.nama_pegawai, order.jabatan_pegawai, order.estimasi_jarak,order.approved,order.time
                      FROM `order`
                      JOIN car on car.id = order.car_id
                      WHERE order.admin_id = ?";

            return $this->db->query($query, [$id])->getResult();
        } catch (\Exception $e) {
            log_message('error', $e->getMessage());
        }
    }
}
