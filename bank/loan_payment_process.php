<?php

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  
  // Get the form inputs
  $loanId = $_POST["loanId"];
  $paymentAmount = $_POST["paymentAmount"];
  $paymentDate = $_POST["paymentDate"];
  
  // Connect to the database
  $servername = "localhost";
  $username = "your_username";
  $password = "your_password";
  $dbname = "your_database_name";
  
  $conn = new mysqli($servername, $username, $password, $dbname);
  
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }
  
  // Insert the payment data into the database
  $sql = "INSERT INTO loan_payments (loan_id, payment_amount, payment_date)
          VALUES ('$loanId', '$paymentAmount', '$paymentDate')";
  
  if ($conn->query($sql) === TRUE) {
    echo "Payment added successfully";
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }
  
  // Update the loan balance in the loans table
  $sql = "UPDATE loans SET balance = balance - '$paymentAmount' WHERE id = '$loanId'";
  
  if ($conn->query($sql) === TRUE) {
    echo "Loan balance updated successfully";
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }
  
  $conn->close();
  
}

?>

<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
  Loan ID: <input type="text" name="loanId"><br>
  Payment Amount: <input type="text" name="paymentAmount"><br>
  Payment Date: <input type="date" name="paymentDate"><br>
  <input type="submit" value="Submit">
</form>
