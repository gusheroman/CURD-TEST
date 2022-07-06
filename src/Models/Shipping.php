<?php

namespace App\Models;

use App\Database\Db;

class Shipping extends Db
{
    public function getAllShipping($filters = [])
    {
        $where = "";
        if (isset($filters['id'])) {
            if ($filters['id']) {
                $where .= " AND shippingcompany.id = :id ";
            } else {
                unset($filters['id']);
            }
        }




        $sql = "SELECT 
        shippingcompany.id, 
        shippingcompany.name,
        shippingcompany.description,
        shippingcompany.termsOfService,
        shippingcompany.returnRefundPolicy,
        shippingcompany.cashOnDeliveyPolicy,
        shippingcompany.weight,
        shippingcompany.size,
        shippingcompany.packageInsuranceFee,
        shippingcompany.SpecialAreaFee,
        shippingcompany.bounceChargeFee,
        shippingcompany.createAt
        FROM 
        shippingcompany
        WHERE
        shippingcompany.id > 0
        {$where}     
        ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($filters);
        $data = $stmt->fetchAll();
        return $data;
    }
    public function getAllShippingFilter()
    {
        $sql = "SELECT 
        shippingcompany.id, 
        shippingcompany.name
        FROM 
        shippingcompany
       ";
        $stmt = $this->pdo->query($sql);
        $data = $stmt->fetchAll();
        return $data;
    }

    public function addShipping($shipping)
    {
        $sql = "INSERT INTO shippingcompany (
        name,
        description,
        termsOfService,
        returnRefundPolicy,
        cashOnDeliveyPolicy,
        weight,
        size,
        packageInsuranceFee,
        SpecialAreaFee,
        bounceChargeFee) VALUES(
        :name,
        :description,
        :termsOfService,
        :returnRefundPolicy,
        :cashOnDeliveyPolicy,
        :weight,
        :size,
        :packageInsuranceFee,
        :SpecialAreaFee,
        :bounceChargeFee
        )";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($shipping);
        return $this->pdo->lastInsertId();
    }
    public function deleteShipping($id)
    {
        $sql = "DELETE FROM shippingcompany WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id]);
        return true;
    }

    public function getShippingById($id)
    {
        $sql = "SELECT 
        shippingcompany.id, 
        shippingcompany.name,
        shippingcompany.description,
        shippingcompany.termsOfService,
        shippingcompany.returnRefundPolicy,
        shippingcompany.cashOnDeliveyPolicy,
        shippingcompany.weight,
        shippingcompany.size,
        shippingcompany.packageInsuranceFee,
        shippingcompany.SpecialAreaFee,
        shippingcompany.bounceChargeFee,
        shippingcompany.createAt
        FROM shippingcompany WHERE 
        shippingcompany.id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id]);
        $data = $stmt->fetchAll();
        return $data[0];
    }

    public function updateShipping($shipping)
    {
        $sql = "
        UPDATE shippingcompany SET 
        name = :name,
        description = :description,
        termsOfService = :termsOfService,
        returnRefundPolicy = :returnRefundPolicy,
        cashOnDeliveyPolicy = :cashOnDeliveyPolicy,
        weight = :weight,
        size = :size,
        packageInsuranceFee = :packageInsuranceFee,
        SpecialAreaFee = :SpecialAreaFee,
        bounceChargeFee = :bounceChargeFee 
        WHERE id = :id
        ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($shipping);
        return true;
    }
}
