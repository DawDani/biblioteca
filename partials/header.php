<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="{{ route('home') }}">
        <img src="/img/logo.jpg" alt="logo" class="img-fluid" style="max-height: 40px;">
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr auto">
            <li class="nav-item ">
                <a class="nav-link" href="/index.php">Library</a>
            </li>
        </ul>
        <ul class="navbar-nav ml-auto mr-3">

            <?php
            if ($user == '') { //Si no esta loggeado, le permite hacer log in o registrarse
                echo <<<CODE
            <li class="nav-item">
                <a class="nav-link" href="/logIn.php">Log in</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/register.php">Register</a>
            </li>
CODE;
            } elseif ($admin == 1) { //Si es admin lvl 1 (bibliotecario/a) solo puede gestionar libros
                echo <<<CODE
               <li class="nav-item">
                     <a class="nav-link" href="/logOut.php">Log Out</a>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link" href="/manageBooks.php">Manage Books</a>
                </li>
        
CODE;

            } elseif ($admin == 2) { //si es admin lvl 2 (admin) puede gestionar también a los usuarios
                echo <<<CODE
                
               <li class="nav-item">
                     <a class="nav-link" href="/logOut.php">Log Out</a>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link" href="/manageBooks.php">Manage Books</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/manageUsers.php">Manage Users</a>
                </li>
                
CODE;

            } else {
                echo <<<CODE
            <li class="nav-item">
                <a class="nav-link active" href="logOut.php">Log Out</a>
            </li>
CODE;
            }

            ?>

        </ul>
        <form class="form-inline my-2 my-lg-0">
            <input class="form-control mr-sm-2" type="search" placeholder="Find books" aria-label="Search">
            <button class="btn btn-outline-info my-2 my-sm-0" type="submit">Search</button>

        </form>
    </div>
</nav>