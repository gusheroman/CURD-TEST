<?php require $_SERVER['DOCUMENT_ROOT'] . "/assignment/vendor/autoload.php"; ?>
<?php

use App\Models\Shipping;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PDO Basic</title>
    <link rel="stylesheet" href="/assignment/theme/css/bootstrap-theme.css">
</head>

<body class="font-mali">
    <div class="container">
        <div class="row mt-5">
            <div class="col">
                <div class="card mb-3">
                    <div class="card-header bg-secondary text-white d-flex justify-content-between">
                        <h4>ข้อมูลขนส่ง</h4>
                        <a href="create_form.php" class="btn btn-success">เพิ่มข้อมูลขนส่ง</a>
                    </div>
                    <div class="card-body">
                        <form action="" class="form-inline" method="POST">
                            <div class="input-group mr-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">ขนส่ง</div>
                                </div>
                                <select name="companyID" class="form-control">
                                    <option value="">เลือก</option>
                                    <?php
                                    $shippingObjs = new Shipping();
                                    $shippingOption = $shippingObjs->getAllShippingFilter();
                                    foreach ($shippingOption as $shippingOptions) {
                                        $selected = ($shippingOptions['companyID'] == $_REQUEST['companyID']) ? "selected" : "";
                                        echo "
                                        <option value='{$shippingOptions['companyID']}' {$selected}>
                                        {$shippingOptions['name']}</option>
                                        ";
                                    }
                                    ?>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">ค้นหา</button>
                        </form>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Detail</th>
                                    <th>MoreDetail</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $filters = array_intersect_key($_REQUEST, array_flip(
                                    ['companyID']
                                ));
                                $shippingObj = new Shipping();
                                $shippings = $shippingObj->getAllShipping($filters);
                                $n = 0;
                                foreach ($shippings as $shipping) {
                                    $n++;
                                    echo "
											<tr>											
                                            <td>{$n}</td>
												<td>{$shipping['name']}</td>
												<td>{$shipping['description']}</td>
												<td><a href='detail_form.php?id={$shipping['companyID']}&action=read'class='btn btn-info'>ข้อมูลเพิ่มเติม</a></td>
											</tr>
										";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>