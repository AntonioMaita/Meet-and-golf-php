



<div class="container">
  <nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
    <div class="container-fluid">
    <?php if(is_logged_in() ):  ?>
      <a class="navbar-brand" href="front_page.php?id=<?=get_session('user_id')?>"><?= WEBSITE_NAME;?> </a>
      <?php else :  ?>
        <a class="navbar-brand" href="index.php"><?= WEBSITE_NAME;?> </a>  <?php endif ?>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="nav navbar-nav">
          <li><a class="nav-link <?= set_active('list_users')?>" href="list_users.php">Liste des utilisateurs</a></li>
        
        </ul>

      
        <ul class="nav navbar-nav me-auto">

          

          <?php if(is_logged_in() ):  ?>

            <div class="dropdown dropdown-group ">
              <a class="dropdown-toggle dropdown" data-bs-toggle="dropdown"  id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                
                <?php 
                global $db;
                $q = $db->query("SELECT avatar from users where id = ".get_session('user_id'));
                $img = $q->fetch();
                
                if(!empty($img['avatar'])) {
                                                                                                                                    
                ?>
                  
                  <img class="avatar img-thumbnail rounded float-end" src="assets/avatars/<?php echo $img['avatar'];?>" alt="avatar" width="40px" height="40px"/> <br> <br>
                                        <?php } else { ?> 
                                                        <img class="rounded-circle img-thumbnail rounded float-start" src="assets/avatars/defaults/default.png" alt="default" width="25%" >
                                                <?php } ?>
              </a>

              <ul class="dropdown-menu dropdown-menu-dark" role="menu" aria-labelledby="navbarDarkDropdownMenuLink">
                  
                <li >
                
                  <a class="dropdown-item <?= set_active('front_page')?>" href="front_page.php?id=<?=get_session('user_id')?>">Fil d'actualité</a>
                </li>

                <a class="dropdown-item <?= set_active('profile')?>" href="profile.php?id=<?=get_session('user_id')?>">Mon Profil</a>
                <a class="dropdown-item <?= set_active('edit_user')?>" href="edit_user.php?id=<?=get_session('user_id')?>">Editer le profil</a>
                <li class="dropdown-divider"></li>
                  <a class="dropdown-item" href="logout.php" tabindex="-1" aria-disabled="true">Déconnexion</a>
                </li>
              </ul>
            </div>

            
          

          <?php else: ?>
            <li class="nav-item active">
            <a class="nav-link <?= set_active('index')?> " aria-current="page" href="index.php">Accueil</a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?= set_active('login')?>" href="login.php">Connexion</a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?= set_active('register')?>" href="register.php" tabindex="-1" aria-disabled="true">Inscription</a>
          </li>
          
          
          <?php endif; ?>
          
        </ul>
        <form class="d-flex">
          
          <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success" type="submit">Search</button>
        </form>
      </div>
    </div>
  </nav>
</div>