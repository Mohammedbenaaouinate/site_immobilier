<?php

        // Function to Go Back to Previous Page
        function GoBack($time=5){
            echo "<div class='container alert alert-info text-center w-80'>You Will be redirect in The Last Page After".$time."</div>";
            header("Refresh:".$time.";"."url=".$_SERVER['HTTP_REFERER']);

        }
?>