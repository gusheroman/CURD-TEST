<?php require $_SERVER['DOCUMENT_ROOT'] . "/assignment/vendor/autoload.php"; ?>
<?php

use App\Models\Shipping;

$shippingObj = new shipping;
$shipping = $shippingObj->getShippingById($_REQUEST['id']);
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
                    <div class="card-header bg-secondary text-white d-flex justify-content-between">
                        <h4>ข้อมูลเงื่อนไขขนส่ง</h4>
                        <a href="index.php" class="btn btn-light">ย้อนกลับ</a>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <p class="h3"><?php echo $shipping['name']; ?></p>
                            <p><?php echo $shipping['description']; ?></p>
                        </div>
                        <div class="form-group">
                            <p class="h3">เงื่อนไขเบื้องต้น</p>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>หัวข้อ</th>
                                        <th>รายละเอียด</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    echo "
											<tr>											
												<td>น้ำหนัก</td>
												<td>ไม่เกิน {$shipping['weight']} กิโลกรัม</td>											
											</tr>
                                            <tr>											
												<td>ขนาด</td>
												<td>ขนาด กว้าง*ยาว*สูง ไม่เกิน {$shipping['size']} ซม.</td>											
											</tr>    
										";
                                    if ($shipping['SpecialAreaFee'] == 0) {
                                        echo "<tr>											
												<td>ค่าบริการพื้นที่พิเศษ</td>
                                                <td>ไม่มี</td>														
											</tr>";
                                    } else {
                                        echo "
                                                <tr>
                                                <td>ค่าบริการพื้นที่พิเศษ</td>
                                                <td>สูงสุดไม่เกิน {$shipping['SpecialAreaFee']} บาท</td>
                                                </tr>";
                                    }
                                    if ($shipping['bounceChargeFee'] == 0) {
                                        echo "<tr>											
												<td>ค่าบริการการตีกลับ</td>
                                                <td>ไม่มี</td>														
											</tr>";
                                    } else {
                                        echo "
                                                <tr>
                                                <td>ค่าบริการการตีกลับ</td>
                                                <td>สูงสุดไม่เกิน {$shipping['bounceChargeFee']} บาท</td>
                                                </tr>";
                                    }
                                    if ($shipping['packageInsuranceFee'] == 0) {
                                        echo "<tr>											
												<td>ค่าประกันพัสดุ</td>
                                                <td>ไม่มี</td>														
											</tr>";
                                    } else {
                                        echo "
                                                <tr>
                                                <td>ค่าประกันพัสดุ</td>
                                                <td>สูงสุดไม่เกิน {$shipping['packageInsuranceFee']} บาท</td>
                                                </tr>  ";
                                    }

                                    ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="form-group">
                            <p class="h3">เงื่อนไขการบริการ</p>
                            <p><?php
                                echo preg_replace('/^(.+)(\s*)$/m', '<li>$1</li>', $shipping['termsOfService']);
                                echo "<br/>";
                                ?></p>
                        </div>
                        <?php
                        if (strlen($shipping['returnRefundPolicy']) > 0) {
                            echo "<p class='h3'>เงื่อนไขการตีคืนสินค้า</p>";
                            echo "<br/>";
                            echo preg_replace('/^(.+)(\s*)$/m', '<li>$1</li>', $shipping['returnRefundPolicy']);
                            echo "<br/>";
                        } 
                        if (strlen($shipping['cashOnDeliveyPolicy']) > 0) {
                            echo "<p class='h3'>เงื่อนไขการเก็บเงินปลายทาง</p>";
                            echo "<br/>";
                            echo preg_replace('/^(.+)(\s*)$/m', '<li>$1</li>', $shipping['cashOnDeliveyPolicy']);
                            echo "<br/>";
                        } 
                        ?>
                        <?php
                        echo "
                    <a href='edit_form.php?id={$shipping['id']}&action=edit' class='btn btn-info'>แก้ไข</a>
					<a href='submit_form.php?id={$shipping['id']}&action=delete' class='btn btn-danger'>ลบ</a>
                    ";
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>