<?php session_start();  ?>
<!DOCTYPE html>
<html>

<head>
    <title>Doctor's home</title>
    <style>
        body {
            background-color: #083042;
        }

        .container {
            display: inline-block;
            position: absolute;
            top: 25%;
            left: 10%;
        }

        .left {
            float: left;
        }

        img {
            border-radius: 12px;
        }

        .right {
            border: 1px solid black;
            height: 350px;
            border-radius: 12px;
            float: right;
            padding-top: 50px;
            padding-left: 50px;
            background-color: whitesmoke;
            width: 350px;
        }

        #submit {
            background-color: #BEBEBE;
            border: 2px solid black;
            border-radius: 12px 12px 12px 12px;
            font-size: 150%;
        }

        #submit:hover {
            background-color: #BEBEBE;
            border: 2px solid #BEBEBE;
            border-radius: 12px 12px 12px 12px;
            font-size: 150%;
            color: whitesmoke;
        }

        button#goback {
            background-color: #32dd83;
            border: 2px solid black;
            border-radius: 12px 12px 12px 12px;
            color: black;
            font-size: 100%;
        }

        button#goback:hover {
            background-color: #32dd83;
            border: 2px solid whitesmoke;
            border-radius: 12px 12px 12px 12px;
            font-size: 100%;
            color: whitesmoke;
        }

        input {
            border: 2px solid black;
            border-radius: 12px;
        }
    </style>
</head>

<body>
    <?php
    $conn = mysqli_connect('localhost', 'root', '', "vaccination_card");
    if (isset($_POST["submit"])) {
        if ($conn == true) {
            $req = "SELECT * FROM doctor  WHERE ID=" . $_POST['ID'];
            $res = mysqli_query($conn, $req);
            $line = mysqli_fetch_assoc($res);
            //if the id is wrong
            if ($line == false) {
                header("location:doctorlogin.php?alert=wrong ID");
                exit;
            } else {
                //if the pwd is wrong
                if ($line['Password'] != $_POST['password']) {
                    echo "wrong password ";
                    header("location:doctorlogin.php?alert=wrong password");
                    exit;
                } else {
                    //define connected so that we can skip authentification part the next time 
                    $_SESSION['connected'] = true;
                }
            }
        }
    }

    if (isset($_SESSION['connected'])) {
    ?>
        <a href="doctorlogin.php"><button id="goback">
                < Go Back</button></a>
        <div class="container">
            <div class="left">
                <img src="https://pngimg.com/d/doctor_PNG16015.png" alt="vaccin" height="400px" width="600px">
            </div>
            <div class="right">
                <h3>Add vaccination to a VC owner</h3>
                <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="get">
                    <table>
                        <tr>
                            <td> Vaccination Code </td>
                            <td><input type="text" placeholder="VC" required name="vaccination_code"></td>
                        </tr>
                        <tr>
                            <td> Vaccin name</td>
                            <td><input type="text" placeholder="Add vaccine" required name="vaccine"></td>
                        </tr>
                        <tr>
                            <td>Date</td>
                            <td> <input type="date" name="date"></td>
                        </tr>
                        <tr>
                            <td> <input type="submit" value="submit" id="submit" name="submited"></td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
        <?php
        // the folowing code is used for adding the vaccination operation to the table vaccine and setting is_vaccinated true in vc_owner  
        if (isset($_GET['submited'])) {
            $code = $_GET['vaccination_code'];
            $vaccine = $_GET['vaccine'];
            $date = $_GET['date'];
            //test if the v-code is corret
            $req3 = "select $code from vc_owner where Vaccination_code=$code";
            $res3 = mysqli_query($conn, $req3);
            //if the v-code is wrong : 
            if (($line = mysqli_fetch_assoc($res3)) == false) {
        ?><script>
                    alert("the code is wrong")
                </script>
                <?php
            }  //else execute all req  1 and  2
            else {
                try {
                    $req1 = "insert into vaccine (Vaccination_code,vaccine_name,date) values ('$code','$vaccine','$date')";
                    $res1 = mysqli_query($conn, $req1);
                    $req2 = "update vc_owner set is_vaccinated=true where Vaccination_code='$code'";
                    $res2 = mysqli_query($conn, $req2);
                    //if $req 1 successfully executed : 
                    if ($res1) { ?>
                        <script>
                            alert("vaccine added to owner successfully")
                        </script>
                    <?php }
                } catch (Exception $e) { ?> <script>
                        alert("you have already entered this data before")
                    </script> <?php }
                        }
                    }
                }
                                ?>
</body>

</html>