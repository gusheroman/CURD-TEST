<?php require $_SERVER['DOCUMENT_ROOT'] . "/assignment/vendor/autoload.php"; ?>
<?php

use App\Models\Shipping;

if ($_REQUEST['action'] == 'edit') {
    $shippingObj = new shipping;
    $shipping = $shippingObj->getShippingById($_REQUEST['id']);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PDO Basic</title>
    <link rel="stylesheet" href="/assignment/theme/css/bootstrap-theme.css">
</head>

<body class="font-kanit">
    <div class="container">
        <div class="row mt-5">
            <div class="col">
                <div class="card mb-3">
                    <div class="card-header bg-primary text-white d-flex justify-content-between">
                        <h4>แก้ไขเงื่อนไขขนส่ง</h4>
                        <a href="index.php" class="btn btn-light">ย้อนกลับ</a>
                    </div>
                    <div class="card-body">
                        <form action="submit_form.php" method="post">
                            <input type="hidden" name="action" value="<?php echo ($_REQUEST['action'] == 'edit') ? "edit" : "add"; ?>">
                            <input type="hidden" name="id" value="<?php echo $shipping['companyID']; ?>">

                            <div class="form-group">
                                <label for="name">ชื่อขนส่ง</label>
                                <input type="text" name="name" id="name" class="form-control" value="<?php echo $shipping['name']; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="description">คำอธิบาย</label>
                                <TEXTAREA name="description" id="description" rows="5" class="form-control" required><?php echo $shipping['description']; ?></TEXTAREA>
                            </div>
                            <div class="form-group">
                                <label for="weight">น้ำหนักสูงสุด (กิโลกรัม)</label>
                                <input type="number" name="weight" id="weight" class="form-control" value="<?php echo $shipping['weight']; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="size">ขนาดสูงสุด (เซนติเมตร)</label>
                                <input type="number" name="size" id="size" class="form-control" value="<?php echo $shipping['size']; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="packageInsuranceFee">ค่าประกันพัสดุ (บาท)</label>
                                <input type="number" name="packageInsuranceFee" id="packageInsuranceFee" class="form-control" value="<?php echo $shipping['packageInsuranceFee']; ?>">
                            </div>
                            <div class="form-group">
                                <label for="SpecialAreaFee">ค่าบริการพื้นที่พิเศษ (บาท)</label>
                                <input type="number" name="SpecialAreaFee" id="SpecialAreaFee" class="form-control" value="<?php echo $shipping['SpecialAreaFee']; ?>">
                            </div>
                            <div class="form-group">
                                <label for="bounceChargeFee">ค่าบริการการตีกลับ (บาท)</label>
                                <input type="number" name="bounceChargeFee" id="bounceChargeFee" class="form-control" value="<?php echo $shipping['bounceChargeFee']; ?>">
                            </div>
                            <div class="form-group">
                                <label for="termsOfService">เงื่อนไขการบริการ</label>
                                <TEXTAREA name="termsOfService" id="termsOfService" rows="10" class="form-control" required><?php echo $shipping['termsOfService']; ?></TEXTAREA>
                            </div>
                            <div class="form-group">
                                <label for="returnRefundPolicy">เงื่อนไขการตีคืนสินค้า</label>
                                <TEXTAREA name="returnRefundPolicy" id="returnRefundPolicy" rows="5" class="form-control"><?php echo $shipping['returnRefundPolicy']; ?></TEXTAREA>
                            </div>
                            <div class="form-group">
                                <label for="cashOnDeliveyPolicy">เงื่อนไขการเก็บเงินปลายทาง</label>
                                <TEXTAREA name="cashOnDeliveyPolicy" id="cashOnDeliveyPolicy" rows="5" class="form-control"><?php echo $shipping['cashOnDeliveyPolicy']; ?></TEXTAREA>
                            </div>
                            <button class="btn btn-success" type="submit">บันทึกข้อมูล</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
</body>

</html>