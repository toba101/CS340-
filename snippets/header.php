<header>
      <div class = head-up>
            <div class="homepage">
                  <img src="/phpmotors/images/site/logo.png" alt="page">
            </div>

            <div class="account">
            <?php 
            if(isset($cookieFirstname)){
                  echo "<span>Welcome $cookieFirstname</span>";
            } 
            ?>
            <?php
            if (isset($_SESSION['loggedin'])){
            echo '<a href="/phpmotors/accounts?action=logout" title="myAccount" target="_self">Log Out</a>';
            }else {
            echo '<a href="/phpmotors/accounts/?action=login" title="myAccount" target="_self">My Account</a>';
            }
            ?>
           
            </div>
      </div>
</header>