<!DOCTYPE html>

<html>

    <head>

        <!-- http://getbootstrap.com/ -->
        <link href="css/bootstrap.min.css" rel="stylesheet"/>

        <link href="css/styles.css" rel="stylesheet"/>

        <?php if (isset($title)): ?>
            <title>myVotePH: <?= htmlspecialchars($title) ?></title>
        <?php else: ?>
            <title>myVotePH</title>
        <?php endif ?>

        <!-- https://jquery.com/ -->
        <script src="js/jquery-1.11.3.min.js"></script>

        <!-- http://getbootstrap.com/ -->
        <script src="js/bootstrap.min.js"></script>

        <script src="js/scripts.js"></script>
        
        <script src="js/Chart.js-master/Chart.js"></script> 
        
        

    </head>

    <body>

        <div class="container" width="700">
            
            <img src="img/<?= $candidate ?>3.png" width="700" height="367"/>
        
            <div  id="heading" style="<?=$style?>" name="<?=$candidate?>" width="700">
                <?= $title ?>
            </div>
            
            
            
            
        </div>
        