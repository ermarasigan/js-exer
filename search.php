<?php

    

  if(isset($_GET['search'])) {
  
    $host='localhost';
    $username='root';
    $password='';
    $database='capstone';
    $conn = mysqli_connect($host,$username,$password,$database);
      

    if($conn) {
      // echo 'Connected successfully!';
    } else {
      echo 'Connected unsuccessfully!';
    }

    $searchparm = $_GET['search'];

    // Prepared statements
    $stmt=mysqli_stmt_init($conn);

    $sql = "SELECT * FROM songs 
        WHERE match(`title`,`artist`) against (?)
        -- WHERE match(`title`,`artist`) against (+? in boolean mode)
        ";

    if(mysqli_stmt_prepare($stmt,$sql)){
          // echo $searchparm;
      mysqli_stmt_bind_param($stmt,'s',$searchparm);
      mysqli_stmt_execute($stmt);

      mysqli_stmt_store_result($stmt);
      
      if(mysqli_stmt_num_rows($stmt) > 0) {
        mysqli_stmt_bind_result($stmt,$id,$title,$artist,$year);
        while(mysqli_stmt_fetch($stmt)) {
          
          echo $title . " " . $artist . "<br>";
        }
      } else {
        echo "not found";
      }
       mysqli_stmt_close($stmt);
      
    }
  }

  // if(isset($_GET['search']))
  // echo "yey " . $_GET['search']
  // ; 

?>

<!DOCTYPE html>
<html>
<head>
	<title>Search</title>

	<link rel="stylesheet" type="text/css" href="css/font_declarations.css">
	<style type="text/css">
		@import url(https://fonts.googleapis.com/css?family=Lato:100,300,400,700);
/*@import url(https://raw.github.com/FortAwesome/Font-Awesome/master/docs/assets/css/font-awesome.min.css);*/

body {
	background: grey;
	font-size: 15px;
}

#wrap {
  margin: 50px 100px;
  display: inline-block;
  position: relative;
  height: 60px;
  float: right;
  padding: 0;
  position: relative;
}

input[type="text"] {
  height: 60px;
  font-size: 55px;
  display: inline-block;
  font-family: "Lato";
  font-weight: 100;
  border: none;
  outline: none;
  color: #555;
  padding: 3px;
  padding-right: 60px;
  width: 0px;
  position: absolute;
  top: 0;
  right: 0;
  background: none;
  z-index: 3;
  transition: width .4s cubic-bezier(0.000, 0.795, 0.000, 1.000);
  cursor: pointer;
}

input[type="text"]:focus:hover {
  border-bottom: 1px solid #BBB;
}

input[type="text"]:focus {
  width: 700px;
  z-index: 1;
  border-bottom: 1px solid #BBB;
  cursor: text;
}
input[type="submit"] {
  height: 67px;
  width: 63px;
  display: inline-block;
  color:red;
  float: right;
  background: url('img/searchicon.png') center center no-repeat;
  text-indent: -10000px;
  border: none;
  position: absolute;
  top: 0;
  right: 0;
  z-index: 2;
  cursor: pointer;
  opacity: 0.4;
  cursor: pointer;
  transition: opacity .4s ease;
}

input[type="submit"]:hover {
  opacity: 0.8;
}

	</style>
</head>
<body>

	<div id="wrap">
	  <form action="" method="get" autocomplete="on">
	  <input id="search" name="search" type="text" placeholder="Type song title or artist"><input id="search_submit" value="Rechercher" type="submit">
	  </form>
	</div>


</body>
</html>