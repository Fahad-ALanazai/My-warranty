<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <button class="navbar-toggler collapsed" type="button" data-toggle="collapse"
            data-target="#navbarsExample08" aria-controls="navbarsExample08" aria-expanded="false"
            aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="navbar-collapse justify-content-md-center collapse" id="navbarsExample08">
        <ul class="navbar-nav">
            <li class="nav-item active">
                <a class="nav-link" href="index.html">ضماناتي</a>
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