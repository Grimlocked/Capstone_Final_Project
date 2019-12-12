<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
  	<title>Game Room Schedule</title>

  	<!-- CSS  -->
  	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  	<link href="css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  	<link href="css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>

  	<script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
  	<script src="js/materialize.js"></script>
  	<script src="js/init.js"></script>
</head>
<body>
<header>
  <div class="navbar-fixed">
   <nav class="brown darken-4">
     <div class="container">
        <div class="nav-wrapper">
           <a href="index.php" class="brand-logo">Home</a>
          <form action="index.php" method="post">
            <ul class="right" id="mobile-nav">
                   
              <?php if(isset($_SESSION['loggedin'])): ?>
                <li><button class="btn waves-effect waves-light logsubmit blue" type="submit" name="action" value="createRequestForm">Create Reservation</button></li>
                <li><button class="btn waves-effect waves-light logsubmit blue" type="submit" name="action" value="logout">Logout</button></li>
              <?php else: ?>
                <li><button class="btn waves-effect waves-light logsubmit blue" type="submit" name="action" value="login">LogIn</button></li>
              <?php endif; ?>
            </ul>
            
          </form>
        </div>
     </div>
   </nav>
     
  </div>
</header>
<div class="container">