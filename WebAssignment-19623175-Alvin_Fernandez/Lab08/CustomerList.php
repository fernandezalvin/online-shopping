<!doctype html>
<html>
<head>
	<meta charset="UTF-8"/>
	<title>Customer | Dormir</title>
	<link rel="stylesheet" type="text/css" href="shopstyle.css" />
	<link rel="shortcut icon" type="image/x-icon" href="../ITF_Assets/Dormir/DormirLogo.png"/>
</head>

<body>
	<header>
	<h1 class = "title">Product List</h1>
		<a href = "Homepage.php"><img src = "../ITF_Assets/Dormir/DormirLogo2.png"></a>	
		<div id = "navbar">
			<ul>
				<li><a href = "Homepage.php">HOME</a></li>
				<li><a href = "ProductList.php">PRODUCT</a></li>
				<li><a href = "ViewCart.php">CART</a></li>
				<li><a href = "CustomerList.php">CUSTOMER</a></li>
				<li><a href = "OrderList.php">ORDER</a></li>
				<li><a href = "SignUp.php">SIGN UP</a></li>
			</ul>

			<form action = "ProductList.php" method = "GET">
				<label for = "search"/>
				<input type = "text" name = "search" id = "search" placeholder = "Search for anything"/>
				<input type = "submit" name = "homepageSubmit" id = "homepageSubmit" value = "Search"/>
			</form>
		</div>
	</header>	
	<?php
	
		$valid_passwords = array ("lukasprep" => "a93eb7ec5ce9e2f12b13b08507a87c5d");
		$valid_users = array_keys($valid_passwords);
		
		$user = $_SERVER['PHP_AUTH_USER'];
		$pass = $_SERVER['PHP_AUTH_PW'];
		
		$validated = (in_array($user, $valid_users)) && (md5($pass) == $valid_passwords[$user]);
		
		if (!$validated){
			header('WWW-Authenticate: Basic realm="My Realm"');
			header('HTTP/1.0 401 Unauthorized');
			die ("Not authorized");
		}
		
		 // If it is a valid user, it shows these messages
		 echo "<p class = 'authenMessage'>Welcome $user.</p>";
		 echo "<p class = 'authenMessage'>Congratulation, you are into the system.</p>";
		 
		include('functions.php');
		
		if(isset($_GET['page']))
		{
			$currentPage = $_GET['page'];
		}
		else
		{
			$currentPage = 0;
		}
		
		$previousPage = $currentPage - 1;
		echo "<a href = '?page=$previousPage'><img src = '../ITF_Assets/Dormir/LeftArrow.png' class = 'LeftArrow'><a/>";
		$nextPage = $currentPage + 1;
		echo "<a href = '?page=$nextPage'><img src = '../ITF_Assets/Dormir/RightArrow.png' class = 'RightArrow'><a/>";

		$dbh = connectToDatabase();

		$statement = $dbh->prepare("SELECT * FROM Customers LIMIT 10 OFFSET $currentPage * 10;");
		$statement->execute();
		
		echo "<table>";
		echo "<tr><th>CustomerID</th><th>UserName</th><th>FirstName</th><th>LastName</th><th>Address</th><th>City</th></tr>";
		
		while($row = $statement->fetch(PDO::FETCH_ASSOC))
		{
			$CustomerID = htmlspecialchars($row['CustomerID'], ENT_QUOTES, 'UTF-8');
			$UserName = htmlspecialchars($row['UserName'], ENT_QUOTES, 'UTF-8');
			$FirstName = htmlspecialchars($row['FirstName'], ENT_QUOTES, 'UTF-8');
			$LastName = htmlspecialchars($row['LastName'], ENT_QUOTES, 'UTF-8');
			$Address = htmlspecialchars($row['Address'], ENT_QUOTES, 'UTF-8');
			$City = htmlspecialchars($row['City'], ENT_QUOTES, 'UTF-8');
			
			echo "<tr><td>$CustomerID</td><td>$UserName</td><td>$FirstName</td><td>$LastName</td><td>$Address</td><td>$City</td></tr>";
				  
		}
		echo "</table>";
	?>
</body>

</html>