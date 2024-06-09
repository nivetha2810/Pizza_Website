<header class="header">
    <a href="home.html" class="logo"><i class="fas fa-pizza-slice"></i> Pizza</a>
    
    <nav class="navbar">
        <a href="home.html">Home</a>
        <a href="about.html">About</a>
        <a href="menu.html">Menu</a>
        <a href="gallery.html">Gallery</a>
        <a href="contact.html">Contact</a>
    </nav>

    <div class="icons">
        <?php
            if(isset($_COOKIE['user'])) {
                echo '<a href="profile.html" title="'.$_COOKIE['user'].'" class="hover-email">'.$_COOKIE['user'].'</a>';
                echo '<a href="cart.html" title="Cart"><i class="fas fa-shopping-cart"></i></a>';
                echo '<a href="logout.php" title="Logout"><i class="fas fa-sign-out-alt"></i></a>';
            } else {
                echo '<a href="login/index.php" title="Login"><i class="fas fa-user"></i></a>';
            }
        ?>
        <div id="menu" class="fas fa-bars"></div>
    </div>

    <div class="shopping-cart">
        <!-- Shopping cart items here -->
    </div>

    <form action="" class="login-form">
        <!-- Login form here -->
    </form>
</header>
