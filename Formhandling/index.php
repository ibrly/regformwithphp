<?php
require "incs/head.php";
?>
<div class="container">
    <form action="incs/signin.php" method="post">
        <div class="row my-3">
            <div class="col">
                <input type="text" class="form-control" name="em" placeholder="email">
            </div>
            <div class="col">
                <input type="password" class="form-control" name="pw" placeholder="email">
            </div>
        </div>

        <div class="row my-3">
            <div class="col">
                <input type="submit" value="login" class="form-control bg-primary" name="signin">
            </div>

        </div>
    </form>

    <form action="incs/signup.php" method="post">
    <div class="row my-3">
        <div class="col">
            <input type="text" class="form-control" name="uname" placeholder="User name">
        </div>
        <div class="col">
            <input type="text" class="form-control" name="uemail" placeholder="email">
        </div>
    </div>
    <div class="row my-3">
        <div class="col">
            <input type="password" class="form-control" name="upassword" placeholder="password">
        </div>
        <div class="col">
            <input type="password" class="form-control" name="urepassword" placeholder="repeat password">
        </div>
    </div>
    <div class="row my-3">
        <div class="col">
            <input type="submit" name="regin" class="form-control bg-primary">
        </div>

    </div>
</form>
</div>

<?php
require "incs/foot.php";
?>
