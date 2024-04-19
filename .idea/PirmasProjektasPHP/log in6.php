<!DOCTYPE html>
<?php
session_start();
if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if ($username === "username" && $password === "password") {
        $_SESSION['user_id'] = 1;
        header("Location: form6.php");
    } else {
        echo "Invalid username or password.";
    }
}
?>
<html>

<head>
    <title>Login Page</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Kurale&display=swap" rel="stylesheet">
    <style>
        body {
            background-image: url('https://images-wixmp-ed30a86b8c4ca887773594c2.wixmp.com/f/735e5caa-855e-4c0d-8d02-9f8946e87f0b/dbr1sxe-b54f1043-ec48-41ec-ab60-f55931c6c3cb.png/v1/fill/w_1096,h_729,q_70,strp/_c__storeroom_by_malthuswolf_dbr1sxe-pre.jpg?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOiJ1cm46YXBwOjdlMGQxODg5ODIyNjQzNzNhNWYwZDQxNWVhMGQyNmUwIiwiaXNzIjoidXJuOmFwcDo3ZTBkMTg4OTgyMjY0MzczYTVmMGQ0MTVlYTBkMjZlMCIsIm9iaiI6W1t7ImhlaWdodCI6Ijw9MTA2NCIsInBhdGgiOiJcL2ZcLzczNWU1Y2FhLTg1NWUtNGMwZC04ZDAyLTlmODk0NmU4N2YwYlwvZGJyMXN4ZS1iNTRmMTA0My1lYzQ4LTQxZWMtYWI2MC1mNTU5MzFjNmMzY2IucG5nIiwid2lkdGgiOiI8PTE2MDAifV1dLCJhdWQiOlsidXJuOnNlcnZpY2U6aW1hZ2Uub3BlcmF0aW9ucyJdfQ.MmRXFhpaljXuXgaoq2OyNMWPtlbLdYfs4GfLUVCym48');
            background-size: cover;
            font-family: 'Kurale', serif;
            color: white;
        }

        .card {
            background-color: rgba(0, 0, 0, 0.7);
        }
    </style>
</head>

<body>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header text-center bg-dark">
                        <h3 class="mb-0 text-gothic">Login</h3>
                    </div>
                    <div class="card-body">
                        <form method="post" action="">
                            <div class="form-group">
                                <label for="username">Username:</label>
                                <input type="text" name="username" id="username" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="password">Password:</label>
                                <input type="password" name="password" id="password" class="form-control" required>
                            </div>
                            <div class="form-group text-center">
                                <input type="submit" value="Login" class="btn btn-primary">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>