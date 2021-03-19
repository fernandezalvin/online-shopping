<!doctype html>
<html>

<head>
	<meta charset="UTF-8"/>
	<title>Cheapest -> | Dormir</title>
	<link rel="stylesheet" type="text/css" href="shopstyle.css" />
	<link rel="shortcut icon" type="image/x-icon" href="../ITF_Assets/Dormir/DormirLogo.png"/>
</head>

<body>
	<h1 class = "title">Product</h1>
	<header>
		<div class = "row">
			<div class = "logo">
			<a href = "Homepage.php"><img src = "../ITF_Assets/Dormir/DormirLogo2.png"></a>
		</div>
		
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

	<?php 
		include('functions.php');
		// connect to the database using our function (and enable errors, etc)
		$dbh = connectToDatabase();
		
		// select all the products.
		$statement = $dbh->prepare("SELECT * FROM Products INNER JOIN Brands USING (BrandID) ORDER BY Price ASC LIMIT 10;");
		//execute the SQL.
		$statement->execute();


		
		// get the results
		while($row = $statement->fetch(PDO::FETCH_ASSOC))
		{
				// display the details here.
				$Description = htmlspecialchars($row['Description'], ENT_QUOTES, 'UTF-8');
				$Price = htmlspecialchars($row['Price'], ENT_QUOTES, 'UTF-8');
				$BrandName = htmlspecialchars($row['BrandName'], ENT_QUOTES, 'UTF-8');

				$ProductID = htmlspecialchars($row['ProductID'], ENT_QUOTES, 'UTF-8');
				$BrandID = htmlspecialchars($row['BrandID'], ENT_QUOTES, 'UTF-8');

				echo "<div class='product-card'>";
				echo "<a href = 'ViewProduct.php?ProductID=$ProductID'>";
				echo "	<div class='product-image'>";
				echo "		<img src = '../ITF_Assets/ProductPictures/$ProductID.jpg' alt = 'Product Picture'>";
				echo "	</div>";
				echo "	<div class='product-info'>";
				echo "		<h3>$Description</h3>";
				echo "		<h4>&#36 $Price</h4>";
				echo " $BrandName";
				echo "	</div>";
				echo "</div>";
		}

	?>
	</header>
</body>

</html>