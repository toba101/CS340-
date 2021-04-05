<!DOCTYPE html>
<html lang="en-us">

<?php require $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/head.php'; ?>

<body>


<?php require $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/header.php'; ?>

<nav><?php echo $navList; ?></nav>
<main>

            <div class="page-content">
                <h1>Welcome to PHP Motors!</h1>
            </div>
                
            <section class= "mini-content">
                <h2>DMC Delorean</h2>
                <p>3 Cup holders<br>
                   Superman doors<br>
                   Fuzzy dice!</p>
             
                <button type="submit">OWN TODAY</button>
            </section>

           
            
            

            <div class="content-pic">
            <img src="/phpmotors/images/vehicles/escalade.jpg" alt="car">
            </div>

               <h4>Delorean Upgrade</h4>
        <div class = "wrap-up">
            <div class="container">
                <div class="box-a">
                    <img src="/phpmotors/images/upgrades/flux-cap.png" alt="flux cap">
                    <p>flux Cap</p>
                </div>

                <div class="box-b">
                    <img src="/phpmotors/images/upgrades/flame.png" alt="flame">
                    <p>flame</p>
                </div>   
                
                <div class="box-c">
                    <img src="/phpmotors/images/upgrades/bumper-sticker.png" alt="bumper sticker">
                    <p>Bumper Sricker</p>
                </div>   
                
                <div class="box-d">
                    <img src="/phpmotors/images/upgrades/hub-cap.png" alt="hub cap">
                    <p>Hub-Cap</p>
                </div>    
            </div> 

            <div>
                <h2>DMC Delorean Review</h2>    
                <ul class= "dolerean-list">
                    <li> So fast its just like traveling in time.(4/5)</li>
                    <li> Coolest ride on the road.(4/5)</li>
                    <li> I am feeling Marty McFly.(5/5)</li>
                    <li> So fast its just like traveling in time.(4/5)</li>
                    <li> The most futuristic ride of our days.(4.5/5) </li>
                    <li> So fast its just like traveling in time.(4/5) </li>
                </ul> 
            </div>    
        </div>   

    </main>

    <hr class="line">
    
    
    <?php require $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?>
    
    
</body>
</html>