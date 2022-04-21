<?php $title = 'Login - Playful Plants Project';
$username_feedback_class = 'hidden';
$password_feedback_class = 'hidden';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="stylesheet" type="text/css" href="/public/styles/site.css" />
  <title><?php echo $title ?></title>
</head>

<body>
  <?php include('includes/header.php'); ?>
  <h2 id="login-header">Administrator Login</h2>
  <section class="login">
    <form id="login-form" method="post" action="/admin-catalog" novalidate>
      <div id="feedback-username" class="login-feedback <?php echo $username_feedback_class; ?>">Please enter a valid username.</div>
      <div class="form-label">
        <label for="username">Username:</label>
        <input type="text" name="username" id="username" value="<?php echo htmlspecialchars($sticky_username); ?>" />
      </div>

      <div id="feedback-password" class="login-feedback <?php echo $password_feedback_class; ?>">Please enter a valid password.</div>
      <div class="form-label">
        <label for="password">Password:</label>
        <input type="text" name="password" id="password" value="<?php echo htmlspecialchars($sticky_username); ?>" />
      </div>

      <div class="align-right">
        <input id="login-submit" name="login-submit" type="submit" value="Log In" />
      </div>
    </form>
  </section>

</body>

</html>
