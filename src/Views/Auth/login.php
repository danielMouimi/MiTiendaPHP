<h3>Logearse</h3>
<form action="<?=BASE_URL?>login" method='POST'>
    <label for="email">Email</label>
    <input type="email" id="email" name="data[email]"><br>
    <label for="password">Contraseña</label>
    <input type="password" name="data[password]" id="password"> <br>
    <input type="submit" value="login">
</form>