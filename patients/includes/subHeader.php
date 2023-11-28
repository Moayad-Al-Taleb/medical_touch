<header>
  <div class="header-logo" style="display: flex; align-items: center; gap: 16px;">
    <span>
      <img src="../../assets/imgs/logo.png" width="60" height="60" alt="">
    </span>
  </div>
  <nav>
    <a href="home-page.php">home page</a>
    <a href="specialities.php">medical specialities</a>
    <a href="doctors.php">doctors</a>
  </nav>
  <div class="header-list-wrapper header-list-wrapper-NO">
    <ul class="header-list">

      <li class="person-item">
        <div class="sign-in-wrapper">
          <svg class="icon" id="SvgjsSvg1159" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs">
            <defs id="SvgjsDefs1160"></defs>
            <g id="SvgjsG1161"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                <path fill="none" d="M0 0h24v24H0V0z"></path>
                <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v1c0 .55.45 1 1 1h14c.55 0 1-.45 1-1v-1c0-2.66-5.33-4-8-4z" fill="#50b3ba" class="color000 svgShape"></path>
              </svg></g>
          </svg>
          <?php
          if (isset($_SESSION['id'])) {
          ?>
            <a><?php echo $_SESSION['user_name'] ?></a>
          <?php
          } else {
          ?>
            <a href="login.php">sign in</a>
          <?php
          }
          ?>
        </div>
        <?php
        if (isset($_SESSION['id'])) {
        ?>
          <ul class="personal-list">
            <li><a href="previewChats.php">chats</a></li>
            <li><a href="complaints.php">complaints</a></li>
            <li><a href="profile.php">profile</a></li>
            <li><a href="logout.php">sign out</a></li>
          </ul>
        <?php
        } else {
        ?>
        <?php
        }
        ?>
      </li>
    </ul>
  </div>


  <div class="responsive-header-els">
    <div style="display: flex; align-items: center; gap: 16px;">
      <div class="menu-icon">
        <svg class="icon" id="SvgjsSvg1011" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs">
          <defs id="SvgjsDefs1012"></defs>
          <g id="SvgjsG1013"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
              <path fill="#50b3ba" d="M3 6a1 1 0 0 1 1-1h16a1 1 0 1 1 0 2H4a1 1 0 0 1-1-1zm0 6a1 1 0 0 1 1-1h16a1 1 0 1 1 0 2H4a1 1 0 0 1-1-1zm1 5a1 1 0 1 0 0 2h16a1 1 0 1 0 0-2H4z" class="color000 svgShape"></path>
            </svg></g>
        </svg>
      </div>
      <span>
        <img src="../../assets/imgs/logo.png" width="60" height="60" alt="">
      </span>
    </div>
    <div class="header-list-wrapper">
      <ul class="header-list">
        <li class="person-item">
          <div class="sign-in-wrapper">
            <svg class="icon" id="SvgjsSvg1159" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs">
              <defs id="SvgjsDefs1160"></defs>
              <g id="SvgjsG1161"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                  <path fill="none" d="M0 0h24v24H0V0z"></path>
                  <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v1c0 .55.45 1 1 1h14c.55 0 1-.45 1-1v-1c0-2.66-5.33-4-8-4z" fill="#50b3ba" class="color000 svgShape"></path>
                </svg></g>
            </svg>
            <?php
            if (isset($_SESSION['id'])) {
            ?>
              <a><?php echo $_SESSION['user_name'] ?></a>
            <?php
            } else {
            ?>
              <a href="login.php">sign in</a>

            <?php
            }
            ?>
          </div>
          <?php
          if (isset($_SESSION['id'])) {
          ?>
            <ul class="personal-list">
              <li><a href="previewChats.php">chats</a></li>
              <li><a href="complaints.php">complaints</a></li>
              <li><a href="profile.php">profile</a></li>
              <li><a href="logout.php">sign out</a></li>
            </ul>
          <?php
          } else {
          ?>

          <?php
          }
          ?>
        </li>
      </ul>
    </div>
  </div>
  <div class="responsive-links">
    <a href="home-page.php">home page</a>
    <a href="specialities.php">medical specialities</a>
    <a href="doctors.php">doctors</a>
  </div>
</header>