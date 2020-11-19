<html lang="fr">

<head>
	<meta charset="utf-8">
	<title>All users</title>

	<link href="css/monStyle.css" rel="stylesheet">

	<!-- Bootstrap CSS -->
	<link href="bootstrap/css/bootstrap.css" rel="stylesheet">
	<link href="font-awesome/css/font-awesome.css" rel="stylesheet">
</head>
<script type="application/javascript">

  function isNumberKey(evt)
    {
        var charCode = (evt.which) ? evt.which : event.keyCode
        if (charCode > 31 && (charCode < 48 || charCode > 57))
           return false;
        return true;
    }
}

</script>
<body>
</body>
    <?php
        $randIP1 = mt_rand(1, 255);
        $randIP2 = mt_rand(0, 255);
        $randIP3 = mt_rand(0, 255);
        $randIP4 = mt_rand(0, 255);
        if ($randIP1 > 126) {
            $randMask = mt_rand(16, 32);
        } elseif ($randIP1 > 191) {
            $randMask = mt_rand(24, 32);
        } elseif ($randIP1 > 239) {
            $randMask = 32;
        } else {
            $randMask = mt_rand(8, 32);;
        }
        $randIP = $randIP1 . "." . $randIP2 . "." . $randIP3 . "." . $randIP4 . "/" . $randMask ;
        
    ?>
    <form amethod="POST" action="#">
        <div>Ip à analyser : </div><input type="text" name="IP" value="<?php echo $randIP; ?>" disabled>
        <p>Classe : </p>
        <label for="A">A</label>
        <input type="radio" name="classe" id="A">
        <label for="B">B</label>
        <input type="radio" name="classe" id="B">
        <label for="C">C</label>
        <input type="radio" name="classe" id="C">
        <label for="D">D</label>
        <input type="radio" name="classe" id="D">
        <p>Masque : </p>
        <input type="text" name="masque1" onkeypress="return isNumberKey(event)" maxlength="3"/> .
        <input type="text" name="masque2" onkeypress="return isNumberKey(event)" maxlength="3"/> .
        <input type="text" name="masque3" onkeypress="return isNumberKey(event)" maxlength="3"/> .
        <input type="text" name="masque4" onkeypress="return isNumberKey(event)" maxlength="3"/>
        <p>Res (ne remplir que le nécessaire): </p>
        <input type="text" name="res" onkeypress="return isNumberKey(event)" maxlength="3"/> .
        <input type="text" name="res" onkeypress="return isNumberKey(event)" maxlength="3"/> . 
        <input type="text" name="res" onkeypress="return isNumberKey(event)" maxlength="3"/> .
        <input type="text" name="res" onkeypress="return isNumberKey(event)" maxlength="3"/>
        <p>Int (ne remplir que le nécessaire): </p>
        <input type="text" name="int" onkeypress="return isNumberKey(event)" maxlength="3"/> .
        <input type="text" name="int" onkeypress="return isNumberKey(event)" maxlength="3"/> .
        <input type="text" name="int" onkeypress="return isNumberKey(event)" maxlength="3"/> .
        <input type="text" name="int" onkeypress="return isNumberKey(event)" maxlength="3"/>
        <p>@Broadcast : </p>
        <input type="text" name="broadcast" onkeypress="return isNumberKey(event)" maxlength="3"/> .
        <input type="text" name="broadcast" onkeypress="return isNumberKey(event)" maxlength="3"/> .
        <input type="text" name="broadcast" onkeypress="return isNumberKey(event)" maxlength="3"/> .
        <input type="text" name="broadcast" onkeypress="return isNumberKey(event)" maxlength="3"/>
        <p>@Réseau : </p>
        <input type="text" name="reseau" onkeypress="return isNumberKey(event)" maxlength="3"/> .
        <input type="text" name="reseau" onkeypress="return isNumberKey(event)" maxlength="3"/> .
        <input type="text" name="reseau" onkeypress="return isNumberKey(event)" maxlength="3"/> .
        <input type="text" name="reseau" onkeypress="return isNumberKey(event)" maxlength="3"/>
        <p>Sous réseau ? : </p>
        <label for="oui" checked>oui</label>
        <input type="radio" name="sr" id="oui">
        <label for="non">non</label>
        <input type="radio" name="sr" id="non">
        <p>@Sous-Réseau : </p>
        <input type="text" name="sreseau" onkeypress="return isNumberKey(event)" maxlength="3"/> .
        <input type="text" name="sreseau" onkeypress="return isNumberKey(event)" maxlength="3"/> .
        <input type="text" name="sreseau" onkeypress="return isNumberKey(event)" maxlength="3"/> .
        <input type="text" name="sreseau" onkeypress="return isNumberKey(event)" maxlength="3"/>
        <p>S-Res (ne remplir que le nécessaire) : </p>
        <input type="text" name="sres" onkeypress="return isNumberKey(event)" maxlength="3"/> .
        <input type="text" name="sres" onkeypress="return isNumberKey(event)" maxlength="3"/> . 
        <input type="text" name="sres" onkeypress="return isNumberKey(event)" maxlength="3"/> .
        <input type="text" name="sres" onkeypress="return isNumberKey(event)" maxlength="3"/>
        <p>S-Int (ne remplir que le nécessaire) : </p>
        <input type="text" name="sint" onkeypress="return isNumberKey(event)" maxlength="3"/> .
        <input type="text" name="sint" onkeypress="return isNumberKey(event)" maxlength="3"/> .
        <input type="text" name="sint" onkeypress="return isNumberKey(event)" maxlength="3"/> .
        <input type="text" name="sint" onkeypress="return isNumberKey(event)" maxlength="3"/><br><br>
        <input type="submit" value="Envoyer la réponse">
    </form>
    
</html>