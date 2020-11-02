<?php if (isset($username)) : ?>
    <li class="nav-item submenu dropdown">
        <a class="nav-link">My Account</a>
        <ul class='dropdown-menu'>
            <li class='nav-item'><a href='profile.php' class='nav-link'><span style="color:red">Profile</span></a>
            <li class='nav-item'><a href='myorder.php' class='nav-link'><span style="color:red">My Order</span></a>
            <li class='nav-item'><a href='logout.php' class='nav-link'><span style="color:red">Logout</span></a>
        </ul>
    </li>
<?php else : ?>
    <li class="nav-item"><a href="login.php" class="nav-link">Login / Register</a></li>
<?php endif; ?>

</ul>
</div>
</div>
</nav>
<!-- END nav -->