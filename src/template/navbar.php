<nav class="navbar navbar-expand-lg navbar-light bg-gradient-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">
            <img src="src\images\CSMS_Logo.png" alt="C-SMS Logo" width="70" height="70">
        </a>
        <button class="navbar-toggler ms-auto" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="nav navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="/">Home</a>
                </li>

                <?php if ($_SESSION['uRole'] == 'SUBMITTER') { ?>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Submissions
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <li><a class="dropdown-item" href="/checkSubmission">My Submissions</a></li>
                            <li><a class="dropdown-item" href="/events">Submit New Finding</a></li>
                        </ul>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Events
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <li><a class="dropdown-item" href="/manageMyEvents">Manage My Events</a></li>
                            <li><a class="dropdown-item" href="/myUpcomingEvents">My Upcoming Events</a></li>
                            <li><a class="dropdown-item" href="/registerNewEvent">Register for An Event</a></li>
                        </ul>
                    </li>

                <?php }
                if ($_SESSION['uRole'] == 'REVIEWER') { ?>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Submission
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <li><a class="dropdown-item" href="/reviewSubmission">Review submission</a></li>
                        </ul>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Events
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <li><a class="dropdown-item" href="/createNewEvent">Create New Event</a></li>
                            <li><a class="dropdown-item" href="/manageUpcomingEvents">Manage Upcoming Events</a></li>
                            <li><a class="dropdown-item" href="/checkUpcomingEvents">Upcoming Events</a></li>
                        </ul>
                    </li>

                <?php }
                if ($_SESSION['uRole'] == 'ADMIN') { ?>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Manage
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <li><a class="dropdown-item" href="/manageUsers">Users</a></li>
                            <li><a class="dropdown-item" href="/manageSubmissions">Submissions</a></li>
                            <li><a class="dropdown-item" href="/manageEvents">Events</a></li>
                        </ul>
                    </li>

                <?php } ?>

            </ul>
            <ul class="nav navbar-nav ms-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle font-weight-bold" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <?php echo '[' . substr($_SESSION['uRole'], 0, 1) . '] ' . $_SESSION['uFName'] . ' ' . substr($_SESSION['uLName'], 0, 1) . '.' ?>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuLink">
                        <li><a class="dropdown-item" href="/profile">Edit Profile</a></li>
                        <li><a class="dropdown-item" href="/logout">Sign Out</a></li>
                    </ul>
                </li>
            </ul>
        </div>
        <br><br>
    </div>
</nav>