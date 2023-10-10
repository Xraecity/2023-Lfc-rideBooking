<?php
session_start();

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Database connection information
            if (isset($_POST['fname']) &&
                isset($_POST['lname']) &&
                isset($_POST['phone']) &&
                isset($_POST['email']) &&
                isset($_POST['address']) &&
                isset($_POST['city']) &&
                isset($_POST['gender']) &&
                isset($_POST['fTime']) &&
                isset($_POST['psw'])) {
            
                    $fname = $_POST["fname"];
                    $lname = $_POST["lname"];
                    $phone = $_POST["phone"];
                    $email = $_POST["email"];
                    $address = $_POST["address"];
                    $city = $_POST["city"];
                    $gender = $_POST["gender"];
                    $fTime = $_POST["fTime"];
                    // Hash the password
                    $password = password_hash($_POST['psw'], PASSWORD_DEFAULT);


                     // Insert the user data into the database
                try {
                    require_once '../connection/connect.php'; // Include your database connection script
                    $stmt = $db->prepare("INSERT INTO users_registration (fname, lname, phone, email, address, city, gender, fTime, psw) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
                                $stmt->execute([$fname, $lname, $phone, $email, $address,  $city,   $gender,  $fTime, $password]);
                                // Redirect to the dashboard upon successful registration
                                header("Location: ../usersdashboard");
                                exit;
                            } catch (PDOException $e) {
                                echo "Error: " . $e->getMessage();
                            }
                        }
                    } else {
                        // Handle invalid request
                        header("Location: index.php");
                        exit;
                    }


        //     // Create a database connection
        //     $conn = new mysqli($servername, $username, $password, $dbname);

        //     // Check connection
        //     if ($conn->connect_error) {
        //         die("Connection failed: " . $conn->connect_error);
        //     }


        //     // Insert user data into the database
        //     $sql = "INSERT INTO users_registration (fname, lname, phone, email, address, city, gender, fTime, psw)
        //             VALUES ('$fname', '$lname', '$phone', '$email', '$address',  '$city',   '$gender',  '$fTime', '$hashedPassword')";

        //     echo "successful";
        //     if ($conn->query($sql) === TRUE) {
        //         header("Location: ../usersdashboard");
        //         exit();
        //     } else {
        //         echo "Error: " . $sql . "<br>" . $conn->error;
        //     }

        //     // Close the database connection
        //     $conn->close();
        // }
        ?>