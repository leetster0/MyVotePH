<?php

    // configuration
    require("../includes/config.php"); 

    // if user reached page via GET (as by clicking a link or via redirect)
    if ($_SERVER["REQUEST_METHOD"] == "GET")
    {
        $candidate = 'marroxas';
        // else render form
        render("header.php", ['candidate' => 'msantiago', 'title' => 'Miriam Santiago', 'style' => "background-color: #b22222"]);
        
    }
?>