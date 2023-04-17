<!DOCTYPE html>

<head>
    <title>Log In </title>
    <style>
        body {
            background-color: #083042;
        }

        .container {
            position: absolute;
            top: 30%;
            left: 30%;

        }

        form {
            border: 1px solid black;
            height: 150px;
            border-radius: 12px;
            float: right;
            padding-top: 50px;
            background-color: whitesmoke;
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
            border-radius: 12px 12px 12px 12px;
            font-size: 150%;
        }

        #login {
            border: 2px solid black;
            border-radius: 12px 12px 12px 12px;
            font-size: 150%;
            background-color: #BEBEBE;
        }

        #login:hover {
            border: 2px solid #BEBEBE;
            border-radius: 12px 12px 12px 12px;
            font-size: 150%;
            background-color: #BEBEBE;
            color: whitesmoke;
        }
    </style>
</head>

<body>
    <a href="homepage.html"><button id="goback">
            < Go Back</button></a>
    <div class="container">
        <form action="dochome.php" method="post">
            <input type="text" placeholder="Doctor ID" name="ID" required>
            <input type="password" placeholder="password" name="password" required><br>
            <input type="submit" value="Log In" id="login" name="submit">
            <!-- the folowing code to display errors occured in the authentification -->
            <?php if (isset($_GET['alert'])) { ?>
                <p style="color: red; font: size 150%;"><?= $_GET['alert'];  ?></p> <?php } ?>
        </form>
    </div>
</body>

</html>