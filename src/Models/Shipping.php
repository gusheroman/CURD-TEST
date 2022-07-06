<?php

namespace App\Models;

use App\Database\Db;

class Shipping extends Db
{
    public function getAllShipping($filters = [])
    {
        $where = "";
        if (isset($filters['companyID'])) {
            if ($filters['companyID']) {
                $where .= " AND shippingcompany.companyID = :companyID ";
            } else {
                unset($filters['companyID']);
            }
        }
        $sql = "SELECT 
        shippingcompany.companyID, 
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
        shippingcompany.companyID > 0
        {$where}     
        ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($filters);
        $data = $stmt->fetchAll();
        return $data;
    }

    public function getSpecialArea($id)
    {
        $sql = "
        SELECT
        shippingcompany.name, 
        province.PROVINCE_NAME,
        amphur.AMPHUR_NAME,
        amphur.POSTCODE,
        district.DISTRICT_NAME,
        geography.GEO_NAME
        FROM special_area 
        LEFT JOIN shippingcompany ON shippingcompany.id = special_area.company_id 
        LEFT JOIN province ON province.PROVINCE_ID = special_area.province_id 
        LEFT JOIN amphur ON amphur.AMPHUR_ID = special_area.amphur_id 
        LEFT JOIN district ON district.DISTRICT_ID = special_area.district_id 
        LEFT JOIN geography ON geography.GEO_ID = special_area.geography_id 
        WHERE 
        shippingcompany.id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($id);
        $data = $stmt->fetchAll();
        return $data;
    }

    public function getAllShippingFilter()
    {
        $sql = "SELECT 
        shippingcompany.companyID, 
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
        $sql = "DELETE FROM shippingcompany WHERE companyID = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id]);
        return true;
    }

    public function getShippingById($id)
    {
        $sql = "SELECT 
        shippingcompany.companyID, 
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
        shippingcompany.companyID = ?";
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
        WHERE companyID = :id
        ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($shipping);
        return true;
    }
}
