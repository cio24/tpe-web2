{include file="head-html.tpl"}
<body>
    {include file="header.tpl"}
    <h1 class="text-center">Logup</h1>
    <form class="container" action="/users/add" method="post">
        <label for="email">Email</label>
        <input type="email" name="email" id="email" class="form-control">
        <label for="userPassword">Contraseña</label>
        <input type="password" name="password" id="password" class="form-control">
        <input type="submit" value="Submit">
    </form>  
    {include file="footer.tpl"}
</body>