<?php
include_once 'header.php';
?>

<div class="container">
    <div class="wrapper">
        <section class="form-floating mb-3">
            <h2>Log In</h2>
            <form action="includes/login.inc.php" method="post">
                <input type="text" name="name" placeholder="Username / Email..." class="form-control mb-3">
                <input type="password" name="pwd" placeholder="Password..." class="form-control mb-3">
                <button type="submit" name="submit" class="btn btn-primary mb-3">Log In</button>
            </form>
        </section>
    </div>
</div>



<?php
include_once 'footer.php';
?>