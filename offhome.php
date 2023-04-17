<?php session_start();  ?>
<!DOCTYPE html>
<html>

<head>
    <title>Officer's home</title>
    <style>
        body {
            background-color: #083042;
        }

        .container {
            display: inline-block;
            position: absolute;
            top: 25%;
            left: 30%;
        }

        img {
            border-radius: 12px;
        }

        .down {
            border: 1px solid black;
            height: 200px;
            border-radius: 12px;
            padding-left: 10px;
            background-color: whitesmoke;
            width: 420px;
        }

        #verify {
            background-color: #BEBEBE;
            border: 2px solid black;
            border-radius: 12px 12px 12px 12px;
            font-size: 150%;
        }

        #verify:hover {
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

        h1 {
            color: whitesmoke;
            font-family: cursive;
        }

        input {
            border: 2px solid black;
            border-radius: 12px;
            font-size: 150%;
        }

        div.result {
            border: 1px solid black;
            color: #083042;
            border-radius: 12px;
            font-size: 80%;
            background-color: #32dd83;
        }

        div.result input {
            border: 1px solid black;
            font-size: 100%;
        }
    </style>
</head>

<body>
    <?php
    $conn = mysqli_connect('localhost', 'root', '', "vaccination_card");
    if (isset($_POST["submit"])) {
        if ($conn == true) {
            $req = "SELECT * FROM officer  WHERE ID=" . $_POST['ID'];
            $res = mysqli_query($conn, $req);
            $line = mysqli_fetch_assoc($res);
            if ($line == false) {
                echo "wrong ID";
                header("location:officerlogin.php?alert=wrong ID");
                exit;
            } else {
                if ($line['Password'] != $_POST['password']) {
                    echo "wrong password ";
                    header("location:officerlogin.php?alert=wrong password");
                    exit;
                } else {
                    $_SESSION['connected'] = true;
                }
            }
        }
    }
    if (isset($_SESSION['connected'])) {
    ?>
        <a href="officerlogin.php"><button id="goback">
                < Go Back</button></a>

        <div class="container">
            <h1>Welcome to VC System</h1>
            <div class="top">
                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSAd-ql6yKoXHXHHugei_dGhpJLWWdRdj-6GA&usqp=CAU" alt="vaccin">
            </div>
            <div class="down">
                <h3>Code Verification</h3>
                <p>Please enter the code you want to verify</p>
                <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="get">
                    <input type="text" placeholder="VC" name="vaccination_code">
                    <input type="text" placeholder="country" name="country">
                    <input type="submit" value="verify" id="verify" name="verify">
                </form>
                <?php if (isset($_GET['verify'])) {
                    $code = $_GET['vaccination_code'];
                    $country = $_GET['country'];
                    if ($code != null) {
                        $req1 = "select * from vc_owner where Vaccination_code=$code";
                        $res1 = mysqli_query($conn, $req1);
                        //test if the v-code is wrong
                        if (($line2 = mysqli_fetch_assoc($res1)) == false) {
                            echo "there is no vaccination code equal to $code";
                        }
                        //if it is correct : display the information of the vc owner
                        else {
                            if ($line2['is_vaccinated'] != 0) {
                ?>
                                <div class="result">
                                    <table>
                                        <tr>
                                            <td> vaccination_code </td>
                                            <td><input type="text" placeholder=<?= $line2['Vaccination_code']; ?> readonly> </td>
                                        </tr>
                                        <tr>
                                            <td>full name </td>
                                            <td> <input type="text" placeholder=<?= $line2['full_name']; ?> readonly> </td>
                                        </tr>
                                    </table>
                                </div>
                                <?php
                                //inserting country in the table country_visited for the code owner
                                $req2 = "insert into country_visited (Vaccination_code,country)values ('$code','$country')";
                                $res2 = mysqli_query($conn, $req2);
                                ?><script>
                                    alert("the country is added to the code owner visited countries")
                                </script> <?php
                                        } else {
                                            echo "this person is not vaccinated";
                                        }
                                    }
                                }

                                            ?>


                <?php } ?>
            </div>
        </div>
    <?php } ?>

</body>

</html>