
<!DOCTYPE html>
<html lang="ko">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>인쇄</title>
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>" />
<style>
    body {
        background: #fff;
    }
    @media print {
        .no-print {
            display: none;
        }
    }
</style>
</head>
<body>
    <div class="container">
        <?php echo $yield; ?>
    </div>
</body>
</html>