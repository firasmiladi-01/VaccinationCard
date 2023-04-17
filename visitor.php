<!DOCTYPE html>
<html>

<head>
    <title>Visitor's Home</title>
    <style>
        h1 {
            color: #083042;
            font-family: cursive;
            text-align: center;
            border: 2px solid #083042;
            border-radius: 12px;
            background-color: #32dd83;

        }

        .container {
            /* inline-block to make 2 divs in a single line */
            display: inline-block;
            /* position to use top and left */
            position: absolute;
            top: 10%;
            left: 15%;
        }

        .visitor {
            border: 1px solid black;
            height: 150px;
            background-color: #083042;
            /* to make the div go to the left */
            float: left;
            color: whitesmoke;
            border-radius: 12px;
            padding-top: 50px;
        }

        .form {
            border: 1px solid black;
            height: 150px;
            border-radius: 12px;
            /* to make the div go to the right */
            float: right;
            padding-top: 50px;
            background-color: whitesmoke;
        }

        #submit {
            background-color: #32dd83;
            border: 2px solid black;
            border-radius: 12px 12px 12px 12px;
            font-size: 150%;
        }

        /* hover when we mouse over an element */
        /* also we used hover to make the user notice that there is a button that he can click */
        #submit:hover {
            background-color: #32dd83;
            border: 2px solid whitesmoke;
            border-radius: 12px 12px 12px 12px;
            font-size: 150%;
            color: whitesmoke;
        }

        #country {
            border: 2px solid black;
            border-radius: 12px 12px 12px 12px;
            font-size: 150%;
        }


        form input {
            border: 2px solid black;
            border-radius: 12px 12px 12px 12px;
            font-size: 150%;
        }

        /* hover when we mouse over an element */
        /* also we used hover to make the user notice that there is a button that he can click */
        #login {
            border: 2px solid black;
            border-radius: 12px 12px 12px 12px;
            font-size: 150%;
            background-color: #BEBEBE;
        }

        /* hover when we mouse over an element */
        /* also we used hover to make the user notice that there is a button that he can click */
        #login:hover {
            border: 2px solid #BEBEBE;
            border-radius: 12px 12px 12px 12px;
            font-size: 150%;
            background-color: #BEBEBE;
            color: whitesmoke;
        }

        button {
            background-color: #32dd83;
            border: 2px solid black;
            border-radius: 12px 12px 12px 12px;
            font-size: 150%;
            color: black;
        }

        button:hover {
            /* hover when we mouse over an element */
            /* also we used hover to make the user notice that there is a button that he can click */
            background-color: #32dd83;
            border: 2px solid whitesmoke;
            border-radius: 12px 12px 12px 12px;
            font-size: 150%;
            color: whitesmoke;
        }

        button#goback {
            background-color: whitesmoke;
            border: 2px solid black;
            border-radius: 12px 12px 12px 12px;
            color: black;
            font-size: 100%;
        }

        /* hover when we mouse over an element */
        /* also we used hover to make the user notice that there is a button that he can click */

        button#goback:hover {
            background-color: whitesmoke;
            border: 2px solid whitesmoke;
            border-radius: 12px 12px 12px 12px;
            font-size: 100%;
            color: black;
        }
    </style>
</head>

<body>

    <?php
    // to connect to the database
    $conn = mysqli_connect('localhost', 'root', '', "vaccination_card");
    // treatement for the users that are redirected to visitor page from the signup page
    // try to treat all the exceptions (specially the redandant id ) so that no sql errors appear on our site
    try {
        //isset is used to verify if the variable is defined of not    
        if (isset($_POST['submit'])) {
            //the folowing condition is useless but just to make sure the submit is the one in signup page
            if ($_POST['submit'] == 'Sign Up') {
                $fullname = $_POST['fullname'];
                $id = $_POST['ID'];
                $password = $_POST['password'];
                $country = $_POST['country'];
                $birthday = $_POST['birthday'];
                $req = "insert into vc_owner (ID,full_name,Password,Birthday,country) values ('$id','$fullname','$password','$birthday','$country') ";
                $res = mysqli_query($conn, $req);
            }
        }
    }
    //catching an exception is the treatement to do if an exception apeared
    catch (Exception $e) {
        //the header function is used to redirect the user to another page 
        // the ? is used to define an array ($_GET) key so that we can inform the signup page for errors 
        header("location:signup.php?alert_signup=this id already exists!");
        //i dont know what exit is used for we just copy the code from google
        exit;
    }
    ?>

    <a href="homepage.html"><button id="goback">
            < Go Back</button></a>

    <div class="container">
        <h1>Welcome To Vaccination Card</h1>
        <div class="visitor">
            <h3>Enter the name of the country to see the spread of diseases in it :</h3>
            <!-- code to show the deseases in a country  -->
            <form action="visitor.php" method="post">
                <!-- required means that this input must be filled -->
                <!-- placeholder to show a default grey text on the field  -->
                <input type="text" placeholder="Country" id="country" name="country" required>
                <br>
                <input type="submit" value="submit" id="submit" name="submit">
            </form>
        </div>
        <div class="form">
            <!-- loggin form -->
            <form action="vchome.php" method="post">
                <input type="text" placeholder="email or mobile phone" name="ID" required>
                <input type="password" placeholder="password" name="Pwd" required><br><br>
                <input type="submit" value="Log In" id="login" name="submitForm">
            </form>
            <br>
            <a href=" signup.php"><button>Create new account</button></a>
            <!-- the folowing code is for the errors that occure due to wron pwd or id  -->
            <!-- the alert is a key to $_GET (from the url/appear only when the user is redirected from vchome page ) -->
            <?php if (isset($_GET['alert'])) { ?>
                <p style="color: red; font: size 150%;"><?= $_GET['alert'];  ?></p> <?php } ?>
        </div>
        <!-- the folowing code is for showing the result of the deseases in a country -->
        <div class="research">
            <?php
            if (($conn == true) && (isset($_POST["submit"]))) {
                if ($_POST["submit"] == "submit") {
                    //a variable x because we named the tables with countries names
                    $x = $_POST["country"];
                    try {
                        $req = "SELECT * FROM $x";
                        $res = mysqli_query($conn, $req);
                        $diseases = [];
                        if ($res == false)
                            echo "error";
                        else {
            ?> <ul>
                                <?php

                                while ($line = mysqli_fetch_assoc($res)) {
                                ?><li><?php echo $line["Desease"]; ?></li>
                                <?php }
                                ?> </ul>
            <?php
                        }
                    } catch (Exception $ex) {
                        echo 'couldnt find this country on our datebase';
                    }
                }
            }
            ?>
        </div>
    </div>
</body>

</html>