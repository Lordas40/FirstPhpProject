<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Alcohol Sales</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <style>
        body {
            font-family: "Old English Text MT", serif;
        }
    </style>
</head>

<body>
    <?php
    // http://localhost/6%20uzduotis/form6.php
    session_start();
    if (!isset($_SESSION['user_id'])) {
        header("Location: log in6.php");
    }
    ?>
    <div class="container mt-5">
        <h1 class="text-center mb-5">Alcohol Sales</h1>

        <form method="get" class="mb-5">
            <div class="form-group">
                <label for="buyer-age">Enter Buyer's Age:</label>
                <input type="number" name="buyer_age" id="buyer-age" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="buyer-name">Enter Buyer's Name:</label>
                <input type="text" name="buyer_name" id="buyer-name" class="form-control" required>
            </div>
            <input type="hidden" name="count" value="<?php echo isset($_SESSION['count']) ? $_SESSION['count'] : 0; ?>">
            <input type="hidden" name="table_data"
                value="<?php echo isset($_SESSION['table_data']) ? htmlentities(json_encode($_SESSION['table_data'])) : ''; ?>">
            <button type="submit" name="submit" class="btn btn-primary">Add to Table</button>
            <button type="button" class="btn btn-secondary ml-2" onclick="resetTable()">Reset Table</button>
        </form>

        <?php

        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "parduotuve";

        $conn = mysqli_connect($servername, $username, $password, $dbname);

        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        if (isset($_GET['submit'])) {

            $buyer_age = $_GET['buyer_age'];
            $buyer_name = $_GET['buyer_name'];
            $count = $_SESSION['count'] ?? 0;
            // ar pirkejas gali nusiprikti
            if ($buyer_age >= 21) {
                $count++;
                $_SESSION['count'] = $count;
                // uzdeti nauja eile lenteleje
                $table_data = $_SESSION['table_data'] ?? array(); // gauna dabartines lenteles duomenis is sesijos
                $sql = "SELECT FirstName, LastName FROM sellers ORDER BY RAND() LIMIT 1"; // from database takes random seller
                $result = mysqli_query($conn, $sql);
                $seller = "";
                if (mysqli_num_rows($result) > 0) {
                    $row = mysqli_fetch_assoc($result);
                    $seller = $row["FirstName"] . " " . $row["LastName"];
                }            // dabartinis laikas
                $current_date = strftime("%d-%m-%Y %H:%M:%S"); // lietuvos laikas
                $row_data = array($buyer_name, $buyer_age, $seller, $current_date); // pirkejui sukurti eile
                array_push($table_data, $row_data);
                $_SESSION['table_data'] = $table_data;

                echo '<div class="alert alert-success" role="alert">
                Successfully added buyer to the table!
                </div>';
            } else {

                echo '<div class="alert alert-danger" role="alert">
                Buyer is not eligible to buy alcohol!
                </div>';
            }
        }
        // delete row from table
        if (isset($_GET['delete'])) {
            $index = $_GET['delete'];
            $table_data = $_SESSION['table_data'] ?? array();
            if (isset($table_data[$index])) {
                unset($table_data[$index]);
                $_SESSION['table_data'] = $table_data;
                echo '<div class="alert alert-success" role="alert">
                Successfully deleted the row from the table!
                </div>';
            }
        }
        $table_data = $_SESSION['table_data'] ?? array();
        if (!empty($table_data)) {
            echo '<table class="table table-bordered">
            <thead>
                <tr>
                    <th>Buyer Name</th>
                    <th>Buyer Age</th>
                    <th>Seller Name</th>
                    <th>Date and Time</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>';
            foreach ($table_data as $index => $row_data) {
                echo '<tr>';
                foreach ($row_data as $value) {
                    echo '<td>' . $value . '</td>';
                }
                echo '<td><a href="?delete=' . $index . '" class="btn btn-danger btn-sm">Delete</a></td>';
                echo '</tr>';
            }
            echo '</tbody>
            </table>';
        }
        ?>
        <?php
        $table_data = $_SESSION['table_data'] ?? array();
        // save to text file
        $file = fopen("info.txt", "w");
        foreach ($table_data as $row_data) {
            fwrite($file, implode(",", $row_data) . PHP_EOL);
        }
        fclose($file);
        // save to excel
        $file_path = 'info2.csv';
        $file = fopen($file_path, 'w');
        foreach ($table_data as $row_data) {
            fputcsv($file, $row_data);
        }
        fclose($file);
        ?>
    </div>
    <script>
        function resetTable() {
            if (confirm("Are you sure you want to reset the table?")) {
                // clear table data
                document.querySelector("tbody").innerHTML = "";
                // clear session data for the table
                fetch('reset_table6.php')
                    .then(function (response) {
                        document.getElementById("success-message").style.display = "block";
                    })
                    .catch(function (error) {
                        console.log('Error: ' + error);
                    });
            }
        }
    </script>
</body>

</html>