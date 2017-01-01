<nav class="navbar navbar-default" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.php">Project <font color="#000000">Infinity</font></a>
        </div>
        <!--/.navbar-header-->
        <div class="navbar-collapse collapse" id="bs-example-navbar-collapse-1" style="height: 1px;">
            <ul class="nav navbar-nav">
                <li class="dropdown">
                    <a href="#"><i class="fa fa-calendar"></i><span>Events</span></a>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown"><i class="fa fa-comments"></i><span>Comments</span></a>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-shield"></i><span>Competitions</span></a>
                    <ul class="dropdown-menu">
                        <li><a href="courses.html">Courses Categories</a></li>
                        <li><a href="courses.html">Courses list</a></li>
                        <li><a href="courses.html">Courses detail</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-list"></i><span>Projects</span></a>
                    <ul class="dropdown-menu">
                        <li><a href="new_project.php">Create New Project</a></li>
                        <li><a href="courses.html">Courses list</a></li>
                        <li><a href="courses.html">Courses detail</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-user"></i>
                        <span><?php echo ucwords($userDetails['firstname']); ?></span>
                    </a>
                            <ul class="dropdown-menu">
                                <li><a href="dashboard.php">Dashboard</a></li>
                                <li><a href="account.php">Account</a></li>
                                <li><a href="logout.php">Logout</a></li>
                            </ul>
                </li>

            </ul>
        </div>
        <div class="clearfix"> </div>
    </div>
    <!--/.navbar-collapse-->
</nav>