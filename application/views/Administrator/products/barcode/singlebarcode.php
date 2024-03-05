<!DOCTYPE html>
<html>

<head>
    <title>Barcode Generator</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <style type="text/css">
        .article {
            min-height: 90px;
            max-height: 100px;
            width: 18px;
            float: left;
            writing-mode: tb-rl;
        }

        .content {
            width: 120px;
            float: left;
            padding: 2px;
        }

        .name {
            height: auto;
            width: 120px;
            font-size: 11px;
        }

        .img {
            height: 60px;
            width: 120px;
        }

        .pid {
            height: 15px;
            width: 120px;
        }

        .price {
            height: 10px;
            width: 120px;
        }

        .date {
            height: 90px;
            width: 20px;
            float: right;
            writing-mode: tb-rl;
        }

        .mytext {
            height: 25px !important;
            padding: 2px;
        }
        
        @media print{
            .printButton1{
                display: none !important;
            }
        }
    </style>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script type="text/javascript">
        async function printpage(sizeName) {
            $(".printButton1").hide();
            var printContent = document.querySelector('.sizeName-'+sizeName).innerHTML;
            document.body.innerHTML = `<table style="width:100%;"><tr><td></td>${printContent}</tr></table>`;
            await new Promise((resolve) => setTimeout(resolve, 1000));
            window.print();
            location.reload();
        }
    </script>

</head>

<body class="">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <form class="form-horizontal" action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post">
                    <section class="" id="printButton" style="background:#f4f4f4;height:200px;">
                        <div class="">
                            <div class="col-sm-12 text-center">
                                <h3 class="text-info">Barcode Generator</h3>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-sm-2" for="text">Product ID</label>
                            <div class="col-sm-2">
                                <input type="text" name="pID" class="form-control mytext" placeholder="Product ID ..." value="<?php echo $product->Product_Code; ?>" />
                            </div>

                            <label class="control-label col-sm-2" for="text">Product Name</label>
                            <div class="col-sm-2">
                                <input type="text" name="pname" class="form-control mytext" placeholder="Product name ..." value="<?php echo $product->Product_Name; ?>" />
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-sm-2" for="Price">Price </label>
                            <div class="col-sm-2">
                                <input type="text" name="Price" class="form-control mytext" placeholder="Product price ..." value="<?php echo $product->Product_SellingPrice; ?>" />
                            </div>

                            <label class="control-label col-sm-2" for="Price">Article </label>
                            <div class="col-sm-2">
                                <input type="text" name="article" class="form-control mytext" placeholder="Article ..." />
                            </div>
                            <input type="hidden" name="qty" class="form-control mytext" value="<?php echo count($sizes); ?>" placeholder="Product quantity ...">
                        </div>

                        <div class="form-group">
                            <div class="col-sm-8 text-right">
                                <input type="submit" name="submit" style="padding: 5px 30px;" value="Generate" class="btn btn-primary" />
                            </div>
                        </div>
                    </section>
                </form>
            </div>
        </div>

        <div class="row">
            <div class="output col-md-8 col-md-offset-2">
                <section class="output">
                    <?php
                    if (isset($_REQUEST['submit'])) {
                        $PID = $_POST['pID'];
                        $Price = $_POST['Price'];
                        $article = $_POST['article'];
                        $qty = $_POST['qty'];
                        $pname = $_POST['pname'];
                        $Price = $_POST['Price'];
                        foreach ($sizes as $key => $item) {
                    ?>
                            <div class="sizeName-<?php echo $item->name;?>" style="float:left;margin:0px;padding:0;border:1px solid #ccc;box-sizing:border-box;border-bottom:none;width: 1.5in; height: 1.3in">
                                <div style="text-align: center;margin:0;padding:0px 0px 0px 0px;width: 1.5in; height: 1in">
                                    <p class="article" style="font-size: 12px;margin:0;line-height:0;"><?php echo $article; ?></p>
                                    <p style="font-size: 10px; text-align: center;margin:0;line-height:1;margin-bottom:2px;"><?php echo $pname; ?></p>
                                    <img src='<?php echo site_url(); ?>GenerateBarcode/<?php echo $PID; ?>' style="height: 40px; width: 100px;" /><br>
                                    <p style="font-size: 12px;font-weight:900; text-align: center;margin:0;line-height:1;"><?php echo $item->name; ?></p>
                                    <p style="margin-top: 5px;line-height:1;font-size:10px;font-weight:900;text-align: center;"><?php echo $this->session->userdata('Currency_Name') . ' ' . $Price; ?></p>
                                </div>
                                <button class="printButton1 btn btn-success" style="width: 100%;padding:0;" onclick="printpage(<?php echo $item->name;?>)">Print</button>
                            </div>
                    <?php }
                    } ?>

                </section>
            </div>
        </div>

    </div>
</body>

</html>