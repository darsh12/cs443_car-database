<?php $title="Add Customer"; require_once "header.php";?>

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
$email = $firstName = $lastName = $streetAddr = $birthDate = $cityAddr = $stateAddr = $zipAddr = $phone = $custType = "";

// error validation
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // clean email
    if (isset($_POST["email"])) {
        $email = clean($_POST["email"]);
        $email = strtolower($email);
    }
    // clean first name
    if (isset($_POST["firstName"])) {
        $firstName = clean($_POST["firstName"]);
        $firstName = ucwords($firstName);
    }
    // clean last name
    if (isset($_POST["lastName"])) {
        $lastName = clean($_POST["lastName"]);
        $lastName = ucwords($lastName);
    }
    // clean birth date
    if (isset($_POST["birthDate"])) {
        $birthDate = clean($_POST["birthDate"]);
    }
    // clean street address
    if (isset($_POST["streetAddr"])) {
        $streetAddr = clean($_POST["streetAddr"]);
        $streetAddr = ucwords($streetAddr);
    }
    // clean city address
    if (isset($_POST["cityAddr"])) {
        $cityAddr = clean($_POST["cityAddr"]);
        $cityAddr = ucwords($cityAddr);
    }
    // clean state address
    if (isset($_POST["stateAddr"])) {
        $stateAddr = clean($_POST["stateAddr"]);
        $stateAddr = strtoupper($stateAddr);
    }
    // clean zip address
    if (isset($_POST["zipAddr"])) {
        $zipAddr = clean($_POST["zipAddr"]);
    }
    // clean phone
    if (isset($_POST["phone"])) {
        $phone = clean($_POST["phone"]);
    }
    // clean customer type
    if (isset($_POST["custType"])) {
        $custType = $_POST["custType"];
        $custType = ucwords($custType);
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
        <h2>Add Customer</h2>
    </div>

    <div class="row">
        <form method="post" class="col s12" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" name="addCust" id="addCust">
            <div class="row">
                <div class="input-field col s12">
                    <input type="email" maxlength="50" name="email" placeholder="johndoe@gmail.com" value="<?php echo $email ?>">
                    <label class="active" for="email" data-success="Eggstravagent!">Email *</label>
                </div>
                <div class="input-field col s12 m6">
                    <input type="text" maxlength="30" name="firstName" placeholder="John" value="<?php echo $firstName ?>">
                    <label class="active" for="firstName" data-success="Perfect!">First name *</label>
                </div>
                <div class="input-field col s12 m6">
                    <input type="text" maxlength="30" name="lastName" placeholder="Doe" value="<?php echo $lastName ?>">
                    <label class="active" for="lastName" data-success="Awesome!">Last name *</label>
                </div>
                <div class="input-field col s12">
                    <input type="date" maxlength="10" name="birthDate" placeholder="MMDDYEAR" value="<?php echo $birthDate ?>">
                    <label class="active" for="birthDate" data-success="Eggstreme!">Birthdate *</label>
                </div>
                <div class="input-field col s12">
                    <input type="text" maxlength="30" name="streetAddr" placeholder="1906 College Heights Blvd" value="<?php echo $streetAddr ?>">
                    <label class="active" for="streetAddr" data-success="Stupendous!">Street address *</label>
                </div>
                <div class="input-field col s12 m6">
                    <input type="text" maxlength="30" name="cityAddr" placeholder="Bowling Green" value="<?php echo $cityAddr ?>">
                    <label class="active" for="cityAddr" data-success="Eggstatic!">City *</label>
                </div>
                <div class="input-field col s12 m6">
                    <input type="text" maxlength="2" name="stateAddr" placeholder="KY" value="<?php echo $stateAddr ?>">
                    <label class="active" for="stateAddr" data-success="Stellar!">State *</label>
                </div>
                <div class="input-field col s12 m6">
                    <input type="number" maxlength="9" name="zipAddr" placeholder="42101" value="<?php echo $zipAddr ?>">
                    <label class="active" for="zipAddr" data-success="Eggceptional!">Zip code/Postal code *</label>
                </div>
                <div class="input-field col s12 m6">
                    <input type="number" maxlength="11" name="phone" placeholder="2701234567" value="<?php echo $phone ?>">
                    <label class="active" for="phone" data-success="Wowza!">Phone *</label>
                </div>
                <div class="col s12 radioSection">
                    <div class="row">
                        <h6>Choose the type of customer</h6>
                    </div>
                    <div class="row">
                        <input type="radio" class="with-gap" name="custType" id="purchase" value="Purchase" <?php if ($_POST["custType"] == "Purchase") {
    echo "checked";
} ?>/>
                        <label for="purchase">Purchase</label>
                    </div>
                    <div class="row">
                        <input type="radio" class="with-gap" name="custType" id="service" value="Service" <?php if ($_POST["custType"] == "Service") {
    echo "checked";
} ?>/>
                        <label for="service">Service</label>
                    </div>
                    <div class="row">
                        <input type="radio" class="with-gap" name="custType" id="visit" value="Visit" <?php if ($_POST["custType"] == "Visit") {
    echo "checked";
} ?>/>
                        <label for="visit">Visit</label>
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

                // insert customer into database
                if (isset($_REQUEST["action"])) {
                    // insert data into customer table
                    $sql = "INSERT INTO customer (firstname, lastname, email, birthdate, street, city, state, zip, phone) VALUES
                    ('$firstName', '$lastName', '$email', '$birthDate', '$streetAddr', '$cityAddr', '$stateAddr', '$zipAddr', '$phone');";

                    if ($conn->query($sql) === true) {
                        $last_id=mysqli_insert_id($conn);
                        echo "Customer " . $firstName . " " . $lastName . " has been added to the customer table successfully" . "<br>";
                    } else {
                        echo "Error: " . $sql . "<br>" . $conn->error . "<br>";
                        die;
                    }

                    // insert data into customer_type data
                    $sql = "INSERT INTO customer_type (customer_id, type) VALUES
                    ((SELECT id FROM customer WHERE firstname = '$firstName' AND lastname = '$lastName' AND email = '$email'), '$custType');";

                    if ($conn->query($sql) === true) {
                        echo "Customer type of " . $firstName . " " . $lastName . " has been added to the customer_type table successfully" . "<br>";
                        $message = "Customer has been added successfully! ID:".$last_id;
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
        $('#addCust').validate( {
            errorElement: "div",
            // specificies error placement for any element
            errorPlacement: function(error, element) {
                var placement = $(element).data('error');
                if (element.is(":radio")) {
                    $("#radioError").text("Please choose customer type");
                } else if (placement) {
                    $(placement).append(error);
                } else {
                    error.insertAfter(element);
                }
            },
            // custom rules
            rules: {
                email: {
                    required: true,
                    email: true
                },
                firstName: {
                    required: true
                },
                lastName: {
                    required: true
                },
                birthDate: {
                    required: true,
                    minlength: 8
                },
                streetAddr: {
                    required: true
                },
                cityAddr: {
                    required: true
                },
                stateAddr: {
                    required: true,
                    minlength: 2
                },
                zipAddr: {
                    required: true,
                    minlength: 5
                },
                phone: {
                    required: true,
                    minlength: 10
                },
                custType: {
                    required: true
                }
            },
            // custom messages
            messages: {
                email: {
                    required: "Please enter email",
                    email: "Follow email format: johndoe@gmail.com"
                },
                firstName: {
                    required: "Please enter first name"
                },
                lastName: {
                    required: "Please enter last name"
                },
                birthDate: {
                    required: "Please enter birth date",
                    minlength: "Must be 8 digits long"
                },
                streetAddr: {
                    required: "Please enter street address"
                },
                cityAddr: {
                    required: "Please enter city"
                },
                stateAddr: {
                    required: "Please enter state",
                    minlength: "Must be 2 characters"
                },
                zipAddr: {
                    required: "Please enter zip code",
                    minlength: "Must be 5 digits long"
                },
                phone: {
                    required: "Please enter phone number",
                    minlength: "Must be 10 digits long"
                }
            }
        });
    });
</script>

<php require_once("footer.php");?>
