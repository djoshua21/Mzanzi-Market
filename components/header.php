<header class="header">
    <div style="width:33.33%; text-align: left;">
        <img class="ico" onclick="toggleDropdown();" src="resources/burger-menu.svg" alt="menu">
        <div class="dropdown-menu" id="dropdownMenu">

            <div onclick="openDashboard()">Dashboard</div>
            <?php
            if (!isset($_SESSION['userID'])):
            ?>
                <div onclick="openCard('signup_overlay'); toggleDropdown()">Sign Up</div>
                <div onclick="openCard('login_overlay'); toggleDropdown()">Login</div>
            <?php
            else:
            ?>
                <div onclick="location.href='components/logout.php'">Logout</div>
            <?php
            endif;
            ?>
        </div>

    </div>


    <div style="width:33.33%; text-align: center;">
        <h1 id=title onclick="home()">Mzansi Market</h1>
    </div>

    <div style=" width:33.33%;text-align: right;">
        <div style="display: inline-flex;">
            <img class="ico" onclick="openCard('search_overlay')" src="resources/search.svg" alt="search">
            <img class="ico" onclick="openCart()" src="resources/cart.svg" alt="cart">

        </div>

    </div>

</header>


<script>
    function toggleDropdown() {
        const menu = document.getElementById("dropdownMenu");
        menu.style.display = (menu.style.display === "block") ? "none" : "block";
    }

    
    function openCard(element) {



        document.getElementById('body').style.overflow = 'hidden';
        document.getElementById('bg').style.filter = 'blur(5px)';
        document.getElementById(element).style.display = 'flex';


        document.getElementById(element).onclick = function() {
            closeCard(element)

        };
    }

    function closeCard(element) {
        document.getElementById('body').style.overflow = 'auto';
        document.getElementById('bg').style.filter = 'none';
        document.getElementById(element).style.display = 'none';
    }

    function openDashboard() {
        window.location.href = "dashboard.php";
    }

    function openCart() {
        window.location.href = "cart.php";
    }

    function home() {

        window.location.href = "/";

    }


    function resize_window() {
        if (window.innerWidth < 700) {
            document.getElementById('title').innerHTML = 'M M';
        } else {
            document.getElementById('title').innerHTML = 'Mzansi Market';
        }
    }

    window.addEventListener('resize', function(event) {

        resize_window();


    });
</script>