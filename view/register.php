<script>
    RegExp.escape= function(s) {
        return s.replace(/[-\/\\^$*+?.()|[\]{}]/g, '\\$&');
    };
</script>

<h1> Please enter your information </h1>

<form action="index.php?action=doregister" method="post">
    <p>First Name: <input name="firstname" pattern="^[a-zA-Z ]+$" required/></p>
    <p>Last Name: <input name="lastname" pattern="^[a-zA-Z ]+$" required/></p>
    <p>Address Line: <input name="address" pattern="^[a-zA-Z ]+ [\w]+$" title="Please enter a valid Address Line" required/></p>
    <p>PLZ: <input name="plz" pattern="[\d]{4}" title="Invalid PLZ" required/></p>
    <p>City: <input name="city" required /></p>
    <p>EMail: <input type="email" name="email" required         
        onchange="form.cemail.pattern = RegExp.escape(this.value);"/></p>
    <p>Confirm EMail: <input name="cemail" required/></p>
    <p>Password: <input type="password" name="pw" required 
        pattern="^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d$@$!%*#?&]{8,}$"
        onchange="form.cpw.pattern = RegExp.escape(this.value);"/></p>
    <p>Confirm Password: <input type="password" name="cpw" required/></p>
    <p><input type="submit" /></p>
</form>
