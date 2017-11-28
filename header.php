<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Compiled and minified CSS-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/css/materialize.min.css">
    <!--Favicon-->
    <link rel="shortcut icon" href="http://sstatic.net/so/favicon.ico">
    <!--Favicon browser tab icon-->
    <link rel="icon" href="autocatz.ico">

    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

    <title><?php echo $title;?></title>

    <style>
        .brand-logo {
            margin-left: 20px;
        }
    </style>
</head>

<body>
    <!--Import jQuery before materialize.js-->
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <!--Import jQuery validation-->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/jquery.validate.js"></script>
    <!--Compiled and minified JavaScript-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/js/materialize.min.js"></script>

    <!--navbar-->
    <nav>
        <div class="nav-wrapper">
            <a href="index.php" class="brand-logo">AutoCatz</a>
            <a href="#" data-activates="mobile-demo" class="button-collapse right"><i class="material-icons">menu</i></a>
            <ul class="right hide-on-med-and-down">
                <li><a href="service.php"><i class="material-icons left">build</i>Service</a></li>
                <li><a href="vehicle_add.php"><i class="material-icons left">directions_car</i>Vehicle</a></li>
                <li><a href="customer_add.php"><i class="material-icons left">tag_faces</i>Customer</a></li>
                <li><a href="employee_add.php"><i class="material-icons left">work</i>Employee</a></li>
                <li><a href="vehicle_sell.php"><i class="material-icons left">money</i>Sell</a></li>
            </ul>
            <ul class="side-nav" id="mobile-demo">
                <li><a href="service.php"><i class="material-icons left">build</i>Service</a></li>
                <li><a href="vehicle_add.php"><i class="material-icons left">directions_car</i>Vehicle</a></li>
                <li><a href="customer_add.php"><i class="material-icons left">tag_faces</i>Customer</a></li>
                <li><a href="employee_add.php"><i class="material-icons left">work</i>Employee</a></li>
                <li><a href="vehicle_sell.php"><i class="material-icons left">money</i>Sell</a></li>

            </ul>
        </div>
    </nav>

    <script>
        $(document).ready(function() {
            $(".button-collapse").sideNav();
        });
    </script>
