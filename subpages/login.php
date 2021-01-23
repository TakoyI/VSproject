<?php session_start(); ?>
<!doctype html>
<html lang="ru">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="../style/dist/styles.css">

    <title>Hello, world!</title>
  </head>
  <body>
<header class="container-fluid row">
  <nav class="navbar navbar-expand-xl navbar-dark bg-dark fixed-top">
    <a class="navbar-brand"><img src="/images/logo_transparent.png" alt="" width="300px"></a>
    <button class="navbar-toggler" data-target="#my-nav" data-toggle="collapse" aria-controls="my-nav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div id="my-nav" class="collapse navbar-collapse">
      <ul class="col navbar-nav">
        <li class="col nav-item">
          <a class="nav-link" href="#">Темы<span class="sr-only">(current)</span></a>
        </li>
        <li class="col nav-item">
          <a class="nav-link" href="#" tabindex="-1" aria-disabled="true">Поиск</a>
        </li>
        <li class="col nav-item">
          <a class="nav-link" href="#" tabindex="-1" aria-disabled="true">Мои интересы</a>
        </li>
        <li class="col nav-item">
          <a class="nav-link" href="registration.html" tabindex="-1" aria-disabled="true">Личный кабинет</a>
        </li>
      </ul>
    </div>
  </nav>
</header>
<main class="content container">
   <div class="col">
    <form class="form" method="POST"  action="logform.php">
      <div class="form-group mb-2">
        <input type="text" name="emailin" class="form-control" placeholder="email@example.com" required>
      </div>
      <div class="form-group">
        <input type="password" name="passin" class="form-control mb-2" id="inputPassword2" placeholder="Password">
      </div>
      <button type="submit" class="btn btn-primary mb-2">Autorize</button>
      </button>
      <?php ini_set("display_errors", 0);
      if ($_SESSION['hello']){
        echo "<p>" . $_SESSION['hello'] . "</p>";
        unset($_SESSION['hello']);
      } elseif($_SESSION['error']) {
        echo "<p>" . $_SESSION['error'] . "</p>";
        unset($_SESSION['error']);
      } else {
        echo "<p>Попробуйте снова</p>";
      }
      ?>
    </form>
  </div>
</main>



    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
  </body>
</html>