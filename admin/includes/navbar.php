<header class="main-header">
    
    <a href="employee.php" class="logo">
      <span class="logo-mini">SAM I&C</span>
      <span class="logo-lg">SAM I&C S.A.C</span>
    </a>
    <nav class="navbar navbar-static-top">
      

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <span class="hidden-xs"><?php echo $user['firstname'].' '.$user['lastname']; ?></span>
            </a>
            <ul class="dropdown-menu">
              
              <li class="user-footer">
                <div class="pull-right">
                  <a href="logout.php" class="btn btn-default btn-flat">Cerrar Sesión</a>
                </div>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>
  </header>