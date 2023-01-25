<?php
$msg      = "";
$msgClass = "";

if (filter_has_var(INPUT_POST, "submit")) {
 $name    = htmlspecialchars($_POST["name"]);
 $email   = htmlspecialchars($_POST["email"]);
 $message = htmlspecialchars($_POST["message"]);

 if (!empty($email) && !empty($name) && !empty($message)) {
  if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
   $msg      = "Please input a <strong>valid</strong> email";
   $msgClass = "alert-danger";
  } else {
   $toEmail = "support@braincore.id";
   $subject = "Contact Request From" . $name;
   $body    = "<h2>Contact Request</h2>
    <h4>Name</h4><p>" . $name . "</p>
    <h4>Email</h4><p>" . $email . "</p>
    <h4>Password</h4><p>" . $message . "</p>
    ";
   $headers = "MIME-Version: 1.0" . "\r\n";
   $headers .= "Content-Type:text/html;charset=UTF-8" . "\r\n";

   $headers .= "From: " . $name . "<" . $email . ">" . "\r\n";

   if (mail($toEmail, $subject, $body, $headers)) {
    $msg      = "Your message has been sent!";
    $msgClass = "alert-success";
   } else {
    $msg      = "Your message wasn't sent! ";
    $msgClass = "alert-danger";
   }
  }
 } else {
  $msg      = "Please fill all field";
  $msgClass = "alert-danger";
 }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
    integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65"
    crossorigin="anonymous"
    >
    <title>Contact Form</title>
</head>
<body>
    <nav class="navbar bg-dark">
        <div class="container">
            <div class="navbar-header">
                <a href="/" class="navbar-brand text-white">My Website</a>
            </div>
        </div>
    </nav>

    <div class="container mt-3">
        <?php if ($msg != ""): ?>
            <div class="alert <?php echo $msgClass; ?>"><?php echo $msg; ?></div>
        <?php endif ?>
        <form action="<?php echo $_SERVER["PHP_SELF"] ?>" method="POST">
            <div class="form-group">
                <label>Name</label>
                <input type="text" name="name" class="form-control"
                value="<?php echo isset($_POST["name"]) ? $name : "" ?>">
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="text" name="email" class="form-control"
                value="<?php echo isset($_POST["email"]) ? $email : "" ?>">
            </div>
            <div class="form-group">
                <label>Message</label>
                <input type="text" name="message" class="form-control"
                value="<?php echo isset($_POST["message"]) ? $message : "" ?>">
            </div>
            <br>
            <button type="submit" name="submit" class="btn btn-primary">
                Submit
            </button>
        </form>
    </div>

</body>
</html>
