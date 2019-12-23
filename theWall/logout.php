<?php
/*
 * LOGOUT PROCESSING FILE.
 *
 */
if ( isset( $_COOKIE[ 'user' ] ) ) {
    setcookie( "user", "", time() - ( 86400 * 30 ) );
    ?>
    <script type="text/javascript">
        window.location.href = document.referrer;
    </script>
    <?php
} //isset( $_COOKIE[ 'user' ] )
if ( isset( $_COOKIE[ 'admin' ] ) ) {
    setcookie( "admin", "", time() - ( 86400 * 30 ) );
    ?>
    <script type="text/javascript">
        window.location.href = document.referrer;
    </script>
    <?php
} //isset( $_COOKIE[ 'admin' ] )