<script>
    RegExp.escape= function(s) {
        return s.replace(/[-\/\\^$*+?.()|[\]{}]/g, '\\$&');
    };
</script>
<h1> Please enter your information </h1>

<form action="index.php?action=doEdit" method="post">
    <p><label for="fn">First Name: </label><input id="fn" name="firstname" 
        pattern="^[a-zA-Z ]+$" required value="<?php echo $data->getFirstname(); ?>"/></p>
    <p><label for="ln">Last Name: </label><input id="ln" name="lastname" 
        pattern="^[a-zA-Z ]+$" required value="<?php echo $data->getLastName(); ?>"/></p>
    <p><label for="al">Address Line: </label><input id="al" name="address" pattern="^[a-zA-Z ]+ [\w]+$" 
        title="Please enter a valid Address Line" required value="<?php echo $data->getAddressLine(); ?>"/></p>
    <p><label for="plz">PLZ: </label><input id="plz" name="plz" pattern="[\d]{4}" 
        title="Invalid PLZ" required value="<?php echo $data->getPLZ(); ?>"/></p>
    <p><label for="c">City: </label><input id="c" name="city" required 
        value="<?php echo $data->getCity(); ?>"/></p>
    <p><label for="em">EMail: </label><input id="em" type="email" name="email" required         
        onchange="form.cemail.pattern = RegExp.escape(this.value);" value="<?php echo $data->getEmail(); ?>"/></p>
    <p><label for="ce">Confirm EMail: </label><input id="ce" name="cemail" 
        required value="<?php echo $data->getEmail(); ?>"/></p>
    <p><label for="pw">Password: </label><input id="pw" type="password" name="pw" 
        pattern="^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d$@$!%*#?&]{8,}$"
        onchange="form.cpw.pattern = RegExp.escape(this.value);"/></p>
    <p><label for="cp">Confirm Password: </label><input id="cp" type="password" name="cpw"/></p>
    <p><input type="submit" /></p>
</form>