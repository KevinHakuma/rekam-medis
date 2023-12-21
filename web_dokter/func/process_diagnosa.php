<?php
session_start();
require_once "../auth/connect.php";

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get data from the form
    $patientId = $_POST['patient_id'];
    $diagnosa = $_POST['diagnosa'];

    // Sanitize data to prevent SQL injection
    $patientId = mysqli_real_escape_string($conn, $patientId);
    $diagnosa = mysqli_real_escape_string($conn, $diagnosa);

    // Update the database with the diagnosis
    $updateQuery = "UPDATE rekam_medis SET diagnosa = '$diagnosa' WHERE id = '$patientId'";
    $updateResult = mysqli_query($conn, $updateQuery);

    // Check if the update was successful
    if ($updateResult) {
        ?>

        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
            <link rel="stylesheet" href="../css/style.css">
            <style>
                body {
                    font-family: 'Poppins', sans-serif;
                }
            </style>
            <title>Sweet Alert</title>
        </head>
        <body>
            <script>
                // SweetAlert for success
                Swal.fire({
                    title: 'Success',
                    text: 'Diagnosis has been successfully added.',
                    icon: 'success',
                    confirmButtonText: 'OK'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = "../rekam_medis.php"; // Redirect to the appropriate page
                    }
                });
            </script>
        </body>
        </html>

        <?php
        exit();
    } else {
        // If there's an error with the update
        $errorMessage = mysqli_error($conn);
        ?>

        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
            <link rel="stylesheet" href="../css/style.css">
            <style>
                body {
                    font-family: 'Poppins', sans-serif;
                }
            </style>
            <title>Sweet Alert</title>
        </head>
        <body>
            <script>
                // SweetAlert for error
                Swal.fire({
                    title: 'Error',
                    text: 'Error updating diagnosis: <?= $errorMessage ?>',
                    icon: 'error',
                    confirmButtonText: 'OK'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = "../rekam_medis.php"; // Redirect to the appropriate page
                    }
                });
            </script>
        </body>
        </html>

        <?php
    }
} else {
    // If the form is not submitted, redirect to the previous page
    header("Location: ../rekam_medis.php");
    exit;
}
?>
