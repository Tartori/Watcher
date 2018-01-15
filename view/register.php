<script>
    RegExp.escape= function(s) {
        return s.replace(/[-\/\\^$*+?.()|[\]{}]/g, '\\$&');
    };
</script>

<h1> Please enter your information </h1>

<form action="index.php?action=doregister" method="post">
    <p>User Name: <input name="username" required/></p>   
    <p>First Name: <input name="firstname" required/></p>
    <p>Last Name: <input name="lastname" required/></p>
    <p>Address Line: <input name="address" pattern="[\w]+ [\d]+" title="Please enter a valid Address Line" required/></p>
    <p>PLZ: <input name="plz" pattern="[\d]{4}" title="Invalid PLZ" required/></p>
    <p>City: <input name="city" required /></p>
    <p>EMail: <input type="email" name="email" required 
        
        onchange="form.cemail.pattern = RegExp.escape(this.value);"/></p>
    <p>Confirm EMail: <input name="cemail" required/></p>
    <p>Password: <input type="password" name="pw" required 
        onchange="form.cpw.pattern = RegExp.escape(this.value);"/></p>
    <p>Confirm Password: <input type="password" name="cpw" required/></p>
    <p><input type="submit" /></p>
</form>
