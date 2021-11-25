<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="/">Home</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="careers">Careers</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="subjects/page/1">Subjects</a>
            </li>
            </li>
            {if $loggedIn}
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="subjects/searcher">Search</a>
                </li>
            {/if}
            {if $admin}
                <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="users">Users</a>
                </li>
            {/if}
        </ul>
        <form class="d-flex">
            {if $loggedIn}
                <a class="nav-link" aria-current="page" href="signout"> Sign out </a>
            {else}
                <a class="nav-link" aria-current="page" href="signin"> Sign in </a>
                <a class="nav-link" aria-current="page" href="signup"> Sign up </a>
            {/if}
        </form>
        </div>
    </div>
</nav>