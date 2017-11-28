<?php $title="Add Vehicle"; require_once "header.php";?>


<style type="text/css">
    .input-field {
        margin-top: 30px;
    }
    div.error {
        color: red;
        margin-top: -15px;
        padding: 0;
        font-size: 0.9em;
        text-align: right;
    }
    .radioSection {
        margin-top: 20px;
    }
    #radioError {
        color: red;
        margin-top: -15px;
        padding: 0;
        font-size: 0.9em;
    }
</style>


<?php
// variables
$vin = $make = $model = $year = $location = $arrDate = $depDate = $vicType = "";

// error validation
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // clean vin
    if (isset($_POST["vin"])) {
        $vin = clean($_POST["vin"]);
        $vin = strtoupper($vin);
    }
    // clean make
    if (isset($_POST["make"])) {
        $make = clean($_POST["make"]);
        $make = ucwords($make);
    }
    // clean model
    if (isset($_POST["model"])) {
        $model = clean($_POST["model"]);
        $model = ucwords($model);
    }
    // clean year
    if (isset($_POST["year"])) {
        $year = clean($_POST["year"]);
    }
    // clean location
    if (isset($_POST["location"])) {
        $location = clean($_POST["location"]);
        $location = ucwords($location);
    }
    // clean arrival date
    if (isset($_POST["arrDate"])) {
        $arrDate = clean($_POST["arrDate"]);
    }
    // clean departure date
    if (isset($_POST["depDate"])) {
        $depDate = clean($_POST["depDate"]);
    }
    // clean vehicle type
    if (isset($_POST["vicType"])) {
        $vicType = $_POST["vicType"];
        $vicType = ucwords($vicType);
    }
}

function clean($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>

<div class="container">
    <div class="row">
        <h2>Add Vehicle</h2>
    </div>

    <div class="row">
        <form method="post" class="col s12" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" name="addVic" id="addVic">
            <div class="row">
                <h5>Model</h5>
            </div>
            <div class="row">
                <div class="input-field col s12 m12 l12">
                    <input type="text" maxlength="17" name="vin" placeholder="WBAET37434NJ96304" value="<?php echo $vin ?>">
                    <label class="active" for="vin" data-success="Eggstravagent!">VIN (Vehicle Identification Number) *</label>
                </div>
                <div class="input-field col s12 m6 l5">
                    <input type="text" maxlength="30" name="make" placeholder="Toyota" value="<?php echo $make ?>">
                    <label class="active" for="make" data-success="Perfect!">Make *</label>
                </div>
                <div class="input-field col s12 m6 l5">
                    <input type="text" maxlength="30" name="model" placeholder="Camry" value="<?php echo $model ?>">
                    <label class="active" for="model" data-success="Awesome!">Model *</label>
                </div>
                <div class="input-field col s12 m12 l2">
                    <input type="number" maxlength="4" name="year" placeholder="2001" value="<?php echo $year ?>">
                    <label class="active" for="year" data-success="Eggstreme!">Year *</label>
                </div>
            </div>
            <div class="divider"></div>
            <div class="row"></div>
            <div class="row">
                <h5>Inventory</h5>
            </div>
            <div class="row">
                <div class="input-field col s12">
                    <input type="text" maxlength="100" name="location" placeholder="Bowling Green" value="<?php echo $location ?>">
                    <label class="active" for="location" data-success="Stupendous!">Location *</label>
                </div>
                <div class="input-field col s12 m6">
                    <input type="datetime-local" name="arrDate" placeholder="YYYY-MM-DD HH:MM:SS" value="<?php echo $arrDate ?>">
                    <label class="active" for="arrDate" data-success="Eggstatic!">Arrival Date *</label>
                </div>
                <div class="input-field col s12 m6">
                    <input type="datetime-local" name="depDate" placeholder="YYYY-MM-DD HH:MM:SS" value="<?php echo $depDate ?>">
                    <label class="active" for="depDate" data-success="Stellar!">Depature Date *</label>
                </div>
                <div class="col s12 radioSection">
                    <div class="row">
                        <h6>Choose vehicle type</h6>
                    </div>
                    <div class="row">
                        <input type="radio" class="with-gap" name="vicType" id="service" value="Service" <?php if ($_POST["vicType"] == "Service") {
    echo "checked";
} ?>/>
                        <label for="service">Service</label>
                    </div>
                    <div class="row">
                        <input type="radio" class="with-gap" name="vicType" id="new" value="New" <?php if ($_POST["vicType"] == "New") {
    echo "checked";
} ?>/>
                        <label for="new">New</label>
                    </div>
                    <div class="row">
                        <input type="radio" class="with-gap" name="vicType" id="used" value="Used" <?php if ($_POST["vicType"] == "Used") {
    echo "checked";
} ?>/>
                        <label for="used">Used</label>
                    </div>
                    <div class="row">
                        <label id="radioError"></label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col s12 right-align">
                    <button class="btn waves-effect waves-light" type="submit" name="action">Submit
                        <i class="material-icons right">send</i>
                    </button>
                </div>
            </div>
        </form>
    </div><!-- ./row -->

    <div class="row">
        <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                // obtain connection to database
                require_once("connection.php");

                // insert vehicle into database
                if (isset($_REQUEST["action"])) {
                    // insert data into vehicle_model table
                    $sql = "INSERT INTO vehicle_model (vin, make, model, year) VALUES
                    ('$vin', '$make', '$model', '$year');";

                    if ($conn->query($sql) === true) {
                        echo "Vehicle " . $vin . " " . $make . " " . $model . " has been added to the vehicle_model table successfully" . "<br>";
                    } else {
                        echo "Error: " . $sql . "<br>" . $conn->error . "<br>";
                        die;
                    }

                    // insert vehicle data into inventory
                    $sql = "INSERT INTO inventory (vin, location, arrival_date, departure_date, vehicle_type) VALUES
                    ('$vin', '$location', '$arrDate', '$depDate', '$vicType');";

                    if ($conn->query($sql) === true) {
                        echo "Vehicle " . $vin . " " . $make . " " . $model . " has been added to the inventory table successfully" . "<br>";
                        $message = "Vehicle has been added successfully!";
                        echo "<script type='text/javascript'>alert('$message');</script>";
                        // must use script to not interfere with earlier php header call
                        echo("<script>location.href = '" . $_SERVER["PHP_SELF"] . "';</script>");
                        die;
                    } else {
                        echo "Error: " . $sql . "<br>" . $conn->error . "<br>";
                        die;
                    }
                }
            }
        ?>
    </div>
</div><!-- ./container -->


<script>
    $(document).ready(function() {
        // performs custom validation on form elements
        $("#addVic").validate( {
            errorElement: "div",
            // specificies error placement for any element
            errorPlacement: function(error, element) {
                var placement = $(element).data("error");
                if (element.is(":radio")) {
                    $("#radioError").text("Please choose vehicle type");
                } else if (placement) {
                    $(placement).append(error);
                } else {
                    error.insertAfter(element);
                }
            },
            // custom rules
            rules: {
                vin: {
                    required: true,
                    minlength: 17
                },
                make: {
                    required: true
                },
                model: {
                    required: true
                },
                year: {
                    required: true,
                    minlength: 4
                },
                location: {
                    required: true
                },
                arrDate: {
                    required: true
                },
                depDate: {
                    required: true
                },
                vicType: {
                    required: true
                }
            },
            // custom messages
            messages: {
                vin: {
                    required: "Please enter VIN",
                    minlength: "Must be 17 digits long"
                },
                make: {
                    required: "Please enter make"
                },
                model: {
                    required: "Please enter model"
                },
                year: {
                    required: "Please enter year",
                    minlength: "Must be 4 digits long"
                },
                location: {
                    required: "Please enter location"
                },
                arrDate: {
                    required: "Please enter arrival date"
                },
                depDate: {
                    required: "Please enter depature date"
                }
            }
        });
    });
</script>

<php require_once("footer.php");?>
