<?php
include_once 'header.php';
?>

<div class="container">
    <div class="wrapper">
        <section class="form-floating mb-3">
            <h2>Sign Up</h2>
            <form action="includes/signup.inc.php" method="post">
                <input type="text" name="name" placeholder="Full name..." class="form-control mb-3">
                <input type="text" name="email" placeholder="Email..." class="form-control mb-3">
                <input type="text" name="uid" placeholder="Username..." class="form-control mb-3">
                <input type="password" name="pwd" placeholder="Password..." class="form-control mb-3">
                <input type="password" name="pwdrepeat" placeholder="Repeat password..." class="form-control mb-3">
                <button type="submit" name="submit" class="btn btn-primary mb-3">Sign Up</button>
            </form>
        </section>
    </div>
</div>



<?php
include_once 'footer.php';
?>