<script>
    RegExp.escape= function(s) {
        return s.replace(/[-\/\\^$*+?.()|[\]{}]/g, '\\$&');
    };
</script>
<h1> <?php echo t("enterInformation"); ?> </h1>

<form action="index.php?action=doEdit" method="post">
    <p><label for="fn"><?php echo t("firstname"); ?>: </label><input id="fn" name="firstname" 
        pattern="^[a-zA-Z ]+$" required value="<?php echo $data->getFirstname(); ?>"/></p>
    <p><label for="ln"><?php echo t("lastname"); ?>: </label><input id="ln" name="lastname" 
        pattern="^[a-zA-Z ]+$" required value="<?php echo $data->getLastName(); ?>"/></p>
    <p><label for="al"><?php echo t("addressLine"); ?>: </label><input id="al" name="address" pattern="^[a-zA-Z ]+ [\w]+$" 
        title="Please enter a valid Address Line" required value="<?php echo $data->getAddressLine(); ?>"/></p>
    <p><label for="plz"><?php echo t("plz"); ?>: </label><input id="plz" name="plz" pattern="[\d]{4}" 
        title="<?php echo t("invalidPlz"); ?>" required value="<?php echo $data->getPLZ(); ?>"/></p>
    <p><label for="c"><?php echo t("city"); ?>: </label><input id="c" name="city" required 
        value="<?php echo $data->getCity(); ?>"/></p>
    <p><label for="em"><?php echo t("email"); ?>: </label><input id="em" type="email" name="email" required         
        onchange="form.cemail.pattern = RegExp.escape(this.value);" value="<?php echo $data->getEmail(); ?>"/></p>
    <p><label for="ce"><?php echo t("cemail"); ?>: </label><input id="ce" name="cemail" 
        required value="<?php echo $data->getEmail(); ?>"/></p>
    <p><label for="pw"><?php echo t("pw"); ?>: </label><input id="pw" type="password" name="pw" 
        pattern="^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d$@$!%*#?&]{8,}$"
        onchange="form.cpw.pattern = RegExp.escape(this.value);"/></p>
    <p><label for="cp"><?php echo t("cpw"); ?>: </label><input id="cp" type="password" name="cpw"/></p>
    <p><input type="submit" /></p>
</form>