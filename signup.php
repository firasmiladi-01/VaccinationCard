<!DOCTYPE html>
<html>

<head>
    <title>Sign Up</title>
    <style>
        .container {
            position: absolute;
            top: 0%;
            left: 30%;
            bottom: 0%;
            right: 30%;
            background-color: #083042;
            color: whitesmoke;
            width: 500px;
        }

        h1 {
            color: whitesmoke;
        }

        p {
            border: 1px solid #083042;
            background-color: whitesmoke;
            color: #083042;
            margin-left: 10px;
            margin-right: 10px;
            border-radius: 12px;
        }

        form {
            margin-top: 10%;
            border: 1px solid #083042;
            background-color: whitesmoke;
            color: #083042;
            margin-left: 10px;
            margin-right: 10px;
            border-radius: 12px;
        }

        span {
            color: red;
        }

        button {
            background-color: #32dd83;
            border: 2px solid black;
            border-radius: 12px 12px 12px 12px;

        }

        button:hover {
            background-color: #32dd83;
            border: 2px solid whitesmoke;
            border-radius: 12px 12px 12px 12px;

            color: whitesmoke;
        }

        #signup {
            border: 2px solid black;
            border-radius: 12px 12px 12px 12px;
            background-color: #BEBEBE;


        }

        #signup:hover {
            border: 2px solid #BEBEBE;
            border-radius: 12px 12px 12px 12px;
            background-color: #BEBEBE;
            color: whitesmoke;
        }
    </style>
</head>

<body>
    <div class="container">
        <a href="visitor.php"><button>
                < Go back</button></a>
        <h1>What is the VC System ?</h1>
        <p>The VC system is a system for the general health of citizens.<br>
            It will improve the quality of health in the country.<br>
            This system will provide information about:<br>
            -What did you get as vaccination<br>
            -What is optional and what is highly required to vaccinate<br>
            -Spread diseases in other countries.<br>
            so that you can decide, with relevance to your doctor, whether:<br>
            + you will get the vaccination or not<br>
            +you will travel or not<br>
            and your doctor can diagnose effectively and efficiently your<br>
            disease due to reliable data provided by the system<br>
        </p>
        <h1>Sign Up</h1>
        <form action="visitor.php" method="POST">

            What is your full name <span>*</span>
            <input type="text" placeholder="Your full name" name="fullname" required>
            <br>
            Enter you email or your mobile number <span>*</span>
            <input type="text" placeholder="mobile number or email" name="ID" required>
            <br> Password <span>*</span><input type="password" placeholder="password" name="password" required><br>
            <label for="birthday">Birthday <span>*</span></label>
            <!-- <select id="birthday" name="birthday" required>
                <option value="Jan">Jan</option>
                <option value="Feb">Feb</option>
                <option value="Mar">Mar</option>
                <option value="Apr">Apr</option>
                <option value="May">May</option>
                <option value="Jun">Jun</option>
                <option value="Jul">Jul</option>
                <option value="Aug">Aug</option>
                <option value="Sep">Sep</option>
                <option value="Oct">Oct</option>
                <option value="Nov">Nov</option>
                <option value="Dec">Dec</option>
            </select>
            <input type="number" placeholder="day" required>
            <input type="number" placeholder="year" required><br> -->
            <input type="date" name="birthday" id="birthday">
            Your country <span>*</span>
            <input type="text" placeholder="Country" name="country" required><br>
            <input type="submit" value="Sign Up" id="signup" name="submit">
        </form>
        <!-- to display the error: id already exists  -->
        <?php if (isset($_GET['alert_signup'])) { ?>
            <p style="color: red; font: size 150%;"><?= $_GET['alert_signup'];  ?></p> <?php } ?>
    </div>
</body>

</html>