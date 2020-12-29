

<div class="container">
  <nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
    <div class="container-fluid">
      <a class="navbar-brand" href="index.php"><?= WEBSITE_NAME;?> </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav me-auto mb-2 mb-md-0">
          <li class="nav-item active">
            <a class="nav-link <?= set_active('index')?> " aria-current="page" href="index.php">Accueil</a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?= set_active('login')?>" href="login.php">Connexion</a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?= set_active('register')?>" href="register.php" tabindex="-1" aria-disabled="true">Inscription</a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?= set_active('logout')?>" href="logout.php" tabindex="-1" aria-disabled="true">Déconnexion</a>
          </li>
          
        </ul>
        <form class="d-flex">
          
          <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success" type="submit">Search</button>
        </form>
      </div>
    </div>
  </nav>
</div>