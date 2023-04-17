<!-- A session is a way to store information (in variables) and we used it to maintain the connection of the user even if he close the page -->
<?php session_start(); ?>
<!DOCTYPE html>
<html>

<head>
    <title>VC owner's Home</title>
    <style>
        body {
            background-color: #083042;
        }

        .container {
            position: absolute;
            left: 25%;
            right: 25%;
            top: 0%;
            padding-left: 10%;
            padding-right: 10%;
            background-color: whitesmoke;

        }

        .map {
            color: black;
        }

        li#level4 {
            border: 2px solid #AD363A;
            background-color: #AD363A;
        }

        li#level3 {
            border: 2px solid #E34E27;
            background-color: #E34E27;
        }

        li#level2 {
            border: 2px solid #EF852B;
            background-color: #EF852B;
        }

        li#level1 {
            border: 2px solid #FFD885;
            background-color: #FFD885;
        }

        li#levelun {
            border: 2px solid #C2C2C2;
            background-color: #C2C2C2;
        }

        .info {
            border: 1px solid #083042;
            background-color: #083042;
            border-radius: 12px;
            color: whitesmoke;
        }

        table {
            background-color: #BEBEBE;
            color: black;
            border-collapse: collapse;
        }

        table tr td {
            border: 2px solid #083042;

        }

        button {
            background-color: #32dd83;
            border: 2px solid black;
            border-radius: 12px 12px 12px 12px;
            font-size: 150%;
        }

        button:hover {
            background-color: #32dd83;
            border: 2px solid whitesmoke;
            border-radius: 12px 12px 12px 12px;
            font-size: 150%;
            color: whitesmoke;
        }

        #code {
            border: 2px solid #083042;
            border-radius: 12px;
        }
    </style>

</head>

<body>
    <?php
    //connect to database
    $conn = mysqli_connect('localhost', 'root', '', "vaccination_card");
    //the folowing code to verify if id and pwd are correct 
    //the first if is to test if the users is coming from the page visitor and if its the case he should be authentificated
    if (isset($_POST["submitForm"])) {
        if ($conn == true) {
            $req = "SELECT * FROM vc_owner  WHERE ID=" . $_POST['ID'];
            $res = mysqli_query($conn, $req);
            $line = mysqli_fetch_assoc($res);
            //if there is an error on the id :
            if ($line == false) {
                header("location:visitor.php?alert=wrong email or phone number");
                exit;
            } else {
                // if there is an error on the pwd
                if ($line['Password'] != $_POST['Pwd']) {
                    header("location:visitor.php?alert=wrong password");
                    exit;
                } else {
                    //connected to skip this code if he is already connected before
                    $_SESSION['connected'] = true;
                    //vaccination code to save it to show it to the users if he asks for it
                    $_SESSION['vaccination_code'] = $line['Vaccination_code'];
                    //the folowing code is used to extract the country visited using the vc-code and store them in a session

                    $req2 = "select country from country_visited where Vaccination_code=" . $line['Vaccination_code'];
                    $res2 = mysqli_query($conn, $req2);
                    while ($line2 = mysqli_fetch_row($res2)) {
                        //the folowing code is equivalent to: isset(line3)?line3[0]:array('-')
                        $_SESSION['country_visited'][] = $line2[0] ?? '-';
                    }
                    //the folowing code is used to  extract the vaccine using vc-code and store them in a session 
                    $req3 = "select vaccine_name from vaccine where Vaccination_code=" . $line['Vaccination_code'];
                    $res3 = mysqli_query($conn, $req3);
                    $_SESSION['vaccines'] = [];
                    while ($line3 = mysqli_fetch_row($res3)) {
                        //the folowing code is equivalent to: isset(line3)?line3[0]:array('-')
                        $_SESSION['vaccines'][] =  $line3[0] ?? '-';
                    }
                }
            }
        }
    }
    //if he is already authentificated
    if (isset($_SESSION['connected'])) {
    ?>
        <div class="container">
            <div class="map">
                <iframe width="400" height="300" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" title="COVID-19 Travel Recommendations by Destination - Global" src="https://ourworldindata.org/grapher/dalys-rate-from-all-causes"></iframe>
                <h3> Risk Assessment Level </h3>
                <ul>
                    <li id="level4">Level 4: Very High Risk</li>
                    <li id="level3">Level 3: High Risk</li>
                    <li id="level2">level 2: Moderate</li>
                    <li id="level1">level 1: Low</li>
                    <li id="levelun">level unknown: Unknown</li>
                </ul>
            </div>
            <div class="info">
                <h3>The vaccines you took:</h3>
                <table>
                    <tr>
                        <td>vaccine</td>
                    </tr>


                    <!-- display vaccines : -->
                    <?php foreach (array_unique($_SESSION['vaccines']) as  $value) {
                    ?>
                        <tr>
                            <td> <?= $value; ?> </td>
                        </tr>
                    <?php } ?>
                </table>
                <h3>Country visited: </h3>
                <table>
                    <tr>
                        <td>Country name</td>
                    </tr>
                    <!-- display country_visited: -->
                    <?php foreach (array_unique($_SESSION['country_visited']) as  $value) {
                    ?>
                        <tr>
                            <td> <?= $value; ?> </td>
                        </tr>
                    <?php } ?>
                </table>
                <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
                    <button type="submit" name="submit" value="submit">Get your VC Code</button>
                    <!-- where vc is shown -->
                    <input type="text" placeholder=<?php if (isset($_POST['submit'])) {
                                                        echo $_SESSION['vaccination_code'];
                                                    } else {
                                                        echo "*******";
                                                    }
                                                    ?> id="code" readonly>
                </form>
            </div>
        </div>

    <?php }  ?>
</body>

</html>