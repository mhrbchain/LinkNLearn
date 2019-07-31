

<html>




<head>
	<title>Admin Panel</title>
	<style>
		body{
			margin: 0px;
			border: 0px;
		}

		#header{
			width: 100%;
			height: 120px;
			background: #95a5a6;
			color: black;
			font-family: Helvetica;
			font-size: 20px;
		}

		#sidebar{
			width: 300px;
			height: 400px;
			background: #2c3e50;
			color: white;
			float: left;
			font-family: Helvetica;
			font-size: 20px;
		}

		#middle{
			height: 700px;
			background: #34495e;
			color: white;
			font-family: Helvetica;
			font-size: 30px;
		}

		#adminLogo{
			width: 90px;
			height: 90px;
			background: #95a5a6;
			border-radius: 50px;
		}
		ul li{
			padding: 20px;
			border-bottom: 2px solid grey;
		}

		ul li:hover{
			background: #bdc3c7;
		}
	</style>
</head>
<body>
	<div id="header">
		<center><img src="1.png" alt="adminLogo" id="adminLogo"><br>This is the Admin Panel
		</center>

	</div>

	<div id="sidebar">
		<ul>
			<li><a href="add.php" style="color:white" target="_blank">Update Data</a></li>
			<!--<li><a href="delete.php" style="color:white" target="_blank">Delete Data</a></li>-->
			<!--<li><a href="update.php" style="color:white" target="_blank">Update Data</a></li>-->
		</ul>

	</div>

	<div id="middle"><br>
		<center><h1>Hello</h1>
		<p>Welcome to the Admin Panel</p>
		</center>
	</div>
</body>
</html>
