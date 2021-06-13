<?php
//Deklarace proměnných pro předcházení chyb
$fname=""; //Křestní jméno
$lname=""; //Příjmení
$em=""; //Email
$em2=""; //Email 2
$password=""; //Heslo
$password2=""; //Heslo 2
$date=""; //Datum registrace
$error_array= array(); //Zde se ukládají chybové hlášky

if(isset($_POST['register_button'])){

//Registrace z hodnot

//Křestní jméno
$fname = strip_tags($_POST['reg_fname']);   //Odstraní HTML tagy
$fname = str_replace(' ', '', $fname);  //Odstraní mezery
$fname = ucfirst(strtolower($fname));   //První znak předělá na lowercase
$_SESSION['reg_fname'] = $fname;    //Uložení proměnné do session proměnné

//Příjmení
$lname = strip_tags($_POST['reg_lname']);   //Odstraní HTML tagy
$lname = str_replace(' ', '', $lname);  //Odstraní mezery
$lname = ucfirst(strtolower($lname));   //První znak předělá na lowercase
$_SESSION['reg_lname'] = $lname;    //Uložení proměnné do session proměnné

//Email
$em = strip_tags($_POST['reg_email']);   //Odstraní HTML tagy
$em = str_replace(' ', '', $em);  //Odstraní mezery
$em = ucfirst(strtolower($em));   //První znak předělá na lowercase
$_SESSION['reg_email'] = $em;    //Uložení proměnné do session proměnné

//Email 2
$em2 = strip_tags($_POST['reg_email2']);   //Odstraní HTML tagy
$em2 = str_replace(' ', '', $em2);  //Odstraní mezery
$em2 = ucfirst(strtolower($em2));   //První znak předělá na lowercase
$_SESSION['reg_email2'] = $em2;    //Uložení proměnné do session proměnné

//Heslo
$password = strip_tags($_POST['reg_password']);   //Odstraní HTML tagy
$password2 = strip_tags($_POST['reg_password2']);   //Odstraní HTML tagy

//Datum registrace
$date = date("Y-m-d");  //Aktuální čas

if($em == $em2){
//Kontrola zda je email ve správném formátu
if(filter_var($em, FILTER_VALIDATE_EMAIL)){
$em = filter_var($em, FILTER_VALIDATE_EMAIL);

//Kontrola, jestli email už existuje
$e_check = mysqli_query($con, "SELECT email FROM users WHERE email='$em'");

//Počet vracených záznamů
$num_rows = mysqli_num_rows($e_check);
if($num_rows > 0){
array_push($error_array, "Email je již zaregistrován<br>");
}
}else{
array_push($error_array, "Nesprávný formát emailu<br>");
}
}else{
array_push($error_array, "Emaily nejsou stejné<br>");
}

if(strlen($fname) > 25 || strlen($fname) < 2){
array_push($error_array, "Křestní jmnéno musí mít více než 2 a méně než 25 zaků<br>");
}

if(strlen($lname) > 25 || strlen($lname) < 2){
array_push($error_array, "Příjmení musí mít více než 2 a méně než 25 zaků<br>");
}

if($password != $password2){
array_push($error_array, "Hesla se neshodují<br>");
}else{
if(preg_match('/[^A-Za-z0-9]/', $password)){
array_push($error_array, "Vaše heslo může obsahovat pouze znaky bez háčků a čárek a číslice<br>");
}
}

if(strlen($password) > 30 || strlen($password) < 5){
array_push($error_array, "Heslo musí mít mezi 5 a 30 znaky<br>");
}

if(empty($error_array)){
$password = md5($password); //Zašifruje heslo před odesláním do databáze

//Vygeneruje username spojením křestního jména a příjmeni
$username = strtolower($fname . "_" . $lname);
$check_username_query = mysqli_query($con, "SELECT username FROM users WHERE username='$username'");    //Hledání username v databázi

$i = 0;
//Pokud username existuje, přidej číslo i k username
while(mysqli_num_rows($check_username_query) != 0){
$i++;
$username = $username . "_" . $i;
$check_username_query = mysqli_query($con, "SELECT username FROM users WHERE username='$username'");
}

//Přiřazení profilové fotky
$rand = rand(1, 2);     //Náhodná čísla mezi 1 a 2
if($rand == 1){
$profile_pic = "assets/images/profile_pics/default/head_deep_blue.png";
}elseif($rand == 2){
$profile_pic = "assets/images/profile_pics/default/head_emerald.png";
}

$query = mysqli_query($con, "INSERT INTO users VALUES('','$fname', '$lname', '$username','$em','$password','$date','$profile_pic','0','0','no',',')");
array_push($error_array,"<span style='color:#14C800;'>Jsi zaregistrován! Můžeš se přihlásit.</span><br>");

//Vymaže proměnné
$_SESSION['reg_fname'] = "";
$_SESSION['reg_lname'] = "";
$_SESSION['reg_email'] = "";
$_SESSION['reg_email2'] = "";
}
}

?>