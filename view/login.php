<h1> <?php echo t("enterInformation"); ?> </h1>

<form action="index.php?action=dologin" method="post" accept-charset="UTF-8">
    <p><label for="em"><?php echo t("email"); ?>: </label><input id="pw" name="email" /></p>
    <p><label for="pw"><?php echo t("pw"); ?>: </label><input id="pw" name="pw" /></p>
    <p><input type="submit" /></p>
</form>
