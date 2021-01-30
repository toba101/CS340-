<!DOCTYPE html>
<html lang="en-us">

<head>
  <meta charset="utf-8">
  <title>PHP Motors HomePage | Toba A. Obiwale|CSE 340</title>
  <meta name="viewport" content="width=device-width,initial-scale=1.0">
  <!-- <link rel="preconnect" href="https://fonts.gstatic.com"> -->
  <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@200&display=swap" rel="stylesheet">
  <link href="/phpmotors/styles/small.css" type="text/css" rel="stylesheet" media="screen">
  <link href="/phpmotors/styles/large.css" type="text/css" rel="stylesheet" media="screen">
<body>

    <header>
      <div class="homepage">
            <img src="/phpmotors/images/site/logo.png" alt="page">
      
            <a href="home.php">My Account</a>
      </div>
    </header>

  <nav>
     <?php require $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/navigation.php'; 
    ?> 
  </nav>

    <main>
      

            <h2> Server Error</h2>
             <p>Sorry our connection seems to be experiencing some technical difficulties</p>

    <hr>

  <footer>
     <?php require $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?> 
  </footer> 