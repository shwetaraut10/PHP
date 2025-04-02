<!DOCTYPE html>
<html>
<body>

<?php
$nerror = $merror = $perror = $werror = $cerror = "";
$name = $email = $phone = $website = $comment = "";
$pattern = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/"; // Fixed the regex pattern for email

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate Name
    if (empty($_POST["name"])) {
        $nerror = "Name cannot be empty!";
    } else {
        $name = test_input($_POST["name"]);
        if (!preg_match("/^[a-zA-Z-' ]*$/", $name)) {
            $nerror = "Only letters, white spaces, and hyphens are allowed";
        }
    }

    // Validate Email
    if (empty($_POST["email"])) {
        $merror = "Email cannot be empty!";
    } else {
        $email = test_input($_POST["email"]);
        if (!preg_match($pattern, $email)) {
            $merror = "Email is not valid";
        }
    }

    // Validate Phone Number
    if (empty($_POST["phone"])) {
        $perror = "Phone number cannot be empty!";
    } else {
        $phone = test_input($_POST["phone"]);
        if (!preg_match("/^[0-9]{10}$/", $phone)) {
            $perror = "Phone number is not valid";
        }
    }

    // Validate Website
    if (empty($_POST["website"])) {
        $werror = "Website cannot be empty!";
    } else {
        $website = test_input($_POST["website"]);
        if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i", $website)) {
            $werror = "URL is not valid";
        }
    }

    // Validate Comment
    if (!empty($_POST["comment"])) {
        $comment = test_input($_POST["comment"]);
    } else {
        $comment = "No comment provided."; // Default message when no comment is provided
    }
  
}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>

<p><span class="error">* required field</span></p>

<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    Name: <input type="text" name="name">
    <span class="error">* <?php echo $nerror; ?></span><br><br>

    E-mail: <input type="text" name="email">
    <span class="error">* <?php echo $merror; ?></span><br><br>

    Phone no: <input type="text" name="phone">
    <span class="error">* <?php echo $perror; ?></span><br><br>

    Website: <input type="text" name="website">
    <span class="error">* <?php echo $werror; ?></span><br><br>

    Comment: <textarea name="comment" rows="5" cols="40"></textarea><br><br>

    <input type="submit" name="submit" value="Submit">
</form>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && !$nerror && !$merror && !$perror && !$werror ) {
    echo "<h2>Your Input:</h2>";
    echo "Name: " . $name . "<br>";
    echo "Email: " . $email . "<br>";
    echo "Phone: " . $phone . "<br>";
    echo "Website: " . $website . "<br>";
    echo "Comment: " . $comment . "<br>";
}
?>

</body>
</html>