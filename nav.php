<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <button class="navbar-toggler collapsed" type="button" data-toggle="collapse"
            data-target="#navbarsExample08" aria-controls="navbarsExample08" aria-expanded="false"
            aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="navbar-collapse justify-content-md-center collapse" id="navbarsExample08">
        <ul class="navbar-nav">
            <li class="nav-item active">
                <a class="nav-link" href="first.html">ضماناتي</a>
            </li>
            <li>
                <a class="nav-link active" href="main.php">الصفحة الرئيسية</a>
            </li>
            <li>
                <a class="nav-link" href="contact.php">تواصل معنا</a>
            </li>
            <li>
                <a class="nav-link" href="about.html">من نحن</a>
            </li>
            <?php
            if(isset($_SESSION["U_id"])) {
            ?>
            <li>
                <a class="nav-link active" href="Bill.php">اضافة فاتورة</a>
            </li>
                <li>
                    <a class="nav-link active" href="logout.php">تسجيل الخروج</a>
                </li>
                <?php
            }
            ?>
        </ul>
    </div>
</nav>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>