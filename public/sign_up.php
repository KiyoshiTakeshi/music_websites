<?php
include "../app/core/functions.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['username'])) 
{

    $username = filter_var(trim($_POST['username']), FILTER_SANITIZE_STRING);
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Check username existence
    $query = "SELECT * FROM users WHERE username = :username";
    $result = db_query_one($query, ['username' => $username]);
    $row_count = db_num_rows($result);

    if ($row_count > 0) {
        message('Tên đăng nhập đã tồn tại.');
        goto skip_signup;
    }

    // Check email existence
    $query = "SELECT * FROM users WHERE email = :email";
    $result = db_query_one($query, ['email' => $email]);
    $row_count = db_num_rows($result);

    if ($row_count > 0) {
        message('Email đã được sử dụng.');
        goto skip_signup;
    }

    // Insert new user if no conflicts
    $values = [
        'username' => $username,
        'email' => $email,
        'password' => $password,
    ];

    $query = "INSERT INTO users (" . implode(',', array_keys($values)) . ") VALUES (:" . implode(', :', array_keys($values)) . ")";
    $row = db_query_one($query, $values);

    if ($row !== false) {
        authenticate($row);
        message('Sign up successful!');
        redirect('admin');
    } else {
        message('Sign up failed. Please try again.');
    }

    skip_signup: // Label for optional jump
}

?>

<section class="content">
  <div class="signup-holder">
    <?php if (message()): ?>
      <div class="alert"><?= message('', true) ?></div>
    <?php endif; ?>

    <form method="post">
      <link rel="stylesheet" href="../public/assets/css/style.css">
      <center><img src="assets/images/logo.jpg" style="width: 150px;border-radius: 50%;border: solid thin #ccc;"></center>
      <h2>Sign Up</h2>
      <input value="<?= isset($_POST['username']) ? htmlspecialchars($_POST['username']) : '' ?>" class="my-1 form-control" type="text" name="username" placeholder="Username">
      <input class="my-1 form-control" type="password" name="password" placeholder="Password">
      <input value="<?= isset($_POST['email']) ? htmlspecialchars($_POST['email']) : '' ?>" class="my-1 form-control" type="email" name="email" placeholder="Email">
      <button class="my-1 btn" style="background-color: #8b2917; color: aliceblue">Sign Up</button>
    </form>
  </div>
</section>

<?php require page('includes/footer'); ?>
