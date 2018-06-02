<!DOCTYPE HTML>    
  <head>
  <meta charset = "utf-8">
  <title>Movie</title>
   <link type="text/css" rel="stylesheet" href="style.css">
   <script type="text/javascript" src="javascript.js"></script>
  </head>
  <body>
  <div class="container">
  <header id="mainheader">
    <img src="mg.png" id="logo">
    <div id="search">
    <form method="POST" action="search.php">
      <select name="searchoption" id="searchoption">
        <option Value="All">All</option>
        <option value="Artist">Artist</option>
        <option value="Movie">Movie</option>
      </select>
      <input type="search" name="usersearch" id="usersearch" list="list" placeholder="Find Artist, Movies, more..." />
        <datalist id="list">
         <option Value="statam"><option Value="action"><option Value="triller"><option Value="mexico">
          <option Value="american pie"><option Value="troy"><option Value="disappearing act"><option Value="blood diamond">
          <option Value="transporter"> <option Value="kate and leopold"> <option Value="the reader"> <option Value="hangover">
           <option Value="iron man"> <option Value="the fifth estate"> <option Value="blacklist"> <option Value="SHIELD">
      </datalist>
      <input type="submit" name="submit" value=" " id="Go" />
    </form>
    </div>
    
    <nav>
          <a href="index.php">Home</a>
          <a href="artist_detail.php">Artists</a>
          <a href="contact.php">Contact Us</a>
          <a href="admin_login.php">Log In</a>
      </nav>
      
      <div id="clockDisplay" class="clockStyle">
      <script type="text/javascript" src="javascript.js"></script>
      </div>    
  </header>
  
  <div id="tablecontainer">
<div id="tablerow">
  <div id="main">
    <div id="latestMovies">

