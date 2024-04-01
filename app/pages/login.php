
<!DOCTYPE html>
<html lang="en">
<head>
	<title><?=ucfirst($URL[0])?> - Music Website</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="<?=ROOT?>/assets/css/style.css?67er">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
<?php
if($_SERVER['REQUEST_METHOD'] == "POST")
{
    $values = [];
    $values['username'] = trim($_POST['username']);
    $password = trim($_POST['password']);
    
    if(empty($password)) {
        message("Password is required");
    } else {
        $query = "select * from users where username = :username limit 1";
        $row = db_query_one($query,$values);

        if(!empty($row) && $password == $row['password'])
        {
            authenticate($row);
            message("Login successful");
            redirect('admin');  				
        }
        else
        {
            message("Wrong username or password"); 
        }
    }
}
?>
	<section class="content">
 
		<div class="login-holder">

		<?php if(message()):?>
			<div class="alert"><?=message('',true)?></div>
		<?php endif;?>

			<form method="post">
				<center><img src="assets/images/logo.jpg" style="width: 100%;border-radius: 50%;border: solid thin #f7f7f7;"></center>
				<h2>Login</h2>
				<input value="<?=set_value('username')?>" class="my-1 form-control" type="text" name="username" placeholder="Username">
				<input value="<?=set_value('password')?>" class="my-1 form-control" type="password" name="password" placeholder="Password" >
				<button class="my-1 btn " style="background-color:blue;  border-radius: 5rem">Login</button>
			</form>
		</div>
	</section>
