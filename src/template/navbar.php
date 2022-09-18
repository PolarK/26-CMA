<nav class="navbar navbar-expand-lg navbar-light bg-gradient-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">
            <img src="src\images\CSMS_Logo.png" alt="C-SMS Logo" width="70" height="70">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="/">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/submitPaper">Submit Paper</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/registerEvent">Register Event</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/checkSchedule">Schedule</a>
                </li>
            </ul>
            <ul class="nav navbar-nav ms-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle font-weight-bold" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <?php echo '['. substr($_SESSION['uRole'], 0, 1) .'] ' . $_SESSION['uFName'] . ' ' . substr($_SESSION['uLName'], 0, 1) . '.' ?>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuLink">
                        <li><a class="dropdown-item" href="/profile">Edit Profile</a></li>
                        <li><a class="dropdown-item" href="/logout">Sign Out</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>