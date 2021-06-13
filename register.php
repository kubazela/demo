<?php
require 'config/config.php';
require 'includes/form_handlers/register_handler.php';
require 'includes/form_handlers/login_handler.php';

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html lang="cs">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <title>Vítejte na KnirBooku</title>
    <link rel="stylesheet" type="text/css" href="assets/css/register_style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="assets/js/register.js"></script>
</head>

<body>
    <?php
    if(isset($_POST['register_button'])){
        echo "
        <script>
            $(document).ready(function(){
               $('#first').hide();
               $('#second').show();
            });
        </script>
        ";
    }
    ?>

    <div class="wrapper">
        <div class="login_box">
            <div class="login_header">
                <h1>KnirBook</h1>
                Přihlaš se nebo se zaregistruj
                <br>
            </div>
            <div id="first">
                <form action="register.php" method="POST">
                    <input type="email" name="log_email" placeholder="Email" value="<?php
                    if(isset($_SESSION['log_email'])){
                        echo $_SESSION['log_email'];
                    } ?>" required>
                    <br>
                    <input type="password" name="log_password" placeholder="Heslo">
                    <br>
                    <?php if(in_array("Email nebo heslo není správné", $error_array)) echo "Email nebo heslo není správné<br>"  ?>
                    <input type="submit" name="login_button" value="Přihlásit">
                    <br>
                    <a href="#" id="signup" class="signup">Potřebuješ účet? Zaregistruj se zde!</a>
                </form>
            </div>

            <div id="second">
                <form action="register.php" method="POST">
                    <input type="text" name="reg_fname" placeholder="Křestní jméno" value="<?php if(isset($_SESSION['reg_fname'])){
                        echo $_SESSION['reg_fname'];
                    } ?>" required>
                    <br>
                    <?php if(in_array("Křestní jmnéno musí mít více než 2 a méně než 25 zaků<br>", $error_array)) { echo "Křestní jmnéno musí mít více než 2 a méně než 25 zaků<br>"; }?>

                    <input type="text" name="reg_lname" placeholder="Příjmení" value="<?php if(isset($_SESSION['reg_lname'])){
                        echo $_SESSION['reg_lname'];
                    } ?>" required>
                    <br>
                    <?php if(in_array("Příjmení musí mít více než 2 a méně než 25 zaků<br>", $error_array)) { echo "Příjmení musí mít více než 2 a méně než 25 zaků<br>"; }?>

                    <input type="email" name="reg_email" placeholder="Email" value="<?php if(isset($_SESSION['reg_email'])){
                        echo $_SESSION['reg_email'];
                    } ?>" required>
                    <br>
                    <?php if(in_array("Email je již zaregistrován<br>", $error_array)) { echo "Email je již zaregistrován<br>"; }
                    else if(in_array("Nesprávný formát emailu<br>", $error_array)) { echo "Nesprávný formát emailu<br>"; }?>

                    <input type="email" name="reg_email2" placeholder="Ověření emailu"value="<?php if(isset($_SESSION['reg_email2'])){
                        echo $_SESSION['reg_email2'];
                    } ?>" required>
                    <br>
                    <?php if(in_array("Emaily nejsou stejné<br>", $error_array)) { echo "Emaily nejsou stejné<br>"; }?>

                    <input type="password" name="reg_password" placeholder="Heslo" required>
                    <br>
                    <input type="password" name="reg_password2" placeholder="Ověření hesla" required>
                    <br>
                    <?php if(in_array("Hesla se neshodují<br>", $error_array)) { echo "Hesla se neshodují<br>"; }
                    else if(in_array("Vaše heslo může obsahovat pouze znaky bez háčků a čárek a číslice<br>", $error_array)) { echo "Vaše heslo může obsahovat pouze znaky bez háčků a čárek a číslice<br>"; }
                    else if(in_array("Heslo musí mít mezi 5 a 30 znaky<br>", $error_array)) { echo "Heslo musí mít mezi 5 a 30 znaky<br>"; }
                    ?>
                    <input type="submit" name="register_button" value="Zaregistrovat">
                    <br>
                    <?php if(in_array("<span style='color:#14C800;'>Jsi zaregistrován! Můžeš se přihlásit.</span><br>", $error_array)) { echo "<span style='color:#14C800;'>Jsi zaregistrován! Můžeš se přihlásit.</span><br>"; }?>
                    <a href="#" id="login" class="login">Už máš účet? Přihlaš se zde!</a>
                </form>
            </div>

        </div>
    </div>
</body>
</html>