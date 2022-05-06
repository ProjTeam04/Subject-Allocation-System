    <h1>
        <center>
            <?php
            session_start();

            if (isset($_SESSION['username']) && isset($_SESSION['password'])) {

            ?>

            <?php

            } else {

                echo 'Logged out Successfully!';
                exit();
            }

            ?>
        </center>

    </h1>