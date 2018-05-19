<!DOCTYPE html>
<html>
    <head>
        <title>LEAGUE OF LEGENDS LOGIN</title>
        <meta charset=utf-8 />
        <meta name="description" content="description">
        <title>LoL</title>
        <link rel="stylesheet" media="screen" href="css/style.css" />
        <link href="https://fonts.googleapis.com/css?family=Dancing+Script" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Lekton" rel="stylesheet">
    </head>
    <body>
        <div id='login'>
        <h1>Login</h1>
        <h2>Credentials required before viewing Info.</h2>
        <p>You can log in using <strong>admin</strong> as username and <strong>admin</strong> as a password.</p>
        
        <!--Form to enter credentials-->
        <form method="post" action="verifyUser.php">
            <input type="text" name="username" placeholder="Username"/><br/>
            <input type="password" name="password" placeholder="Password"/><br/><br/>
            <input type="submit" name="submit" value="Login"/>
        </form>
        </div>
    </body>
</html>