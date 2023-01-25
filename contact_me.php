<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/contact_me.css">
    <title>Contact me</title>
</head>
<body>
    <?php
        function filter_string_polyfill(string $string): string
        {
            $str = preg_replace('/\x00|<[^>]*>?/', '', $string);
            return str_replace(["'", '"'], ['&#39;', '&#34;'], $str);
        }

            if (isset($_POST["name"]) && isset($_POST["desc"]) && isset($_POST["mail"]))
            {
                $name = filter_string_polyfill($_POST["name"]);
                $mail = filter_string_polyfill($_POST["mail"]);
                $mail = filter_var($mail, FILTER_SANITIZE_EMAIL);
                if (!filter_var($mail,FILTER_VALIDATE_EMAIL))
                {
                    echo "nope1";
                    return;
                }
                if (isset($_POST["phone"]))
                {
                    $phone = filter_string_polyfill($_POST["phone"]);
                    if(!preg_match('/^[0-9]{10}+$/', $phone))
                    {
                        echo "nope2";
                        return;
                    }
                }
                $desc = filter_string_polyfill($_POST["desc"]);


                $string = "INSERT INTO contact (Nom, Mail, Phone, Detail, Date_message) VALUES ('" . $name . "','" . $mail . "','" . $phone . "','" . $desc . "', 1);";
                echo $string;

                try
                {
                    $bdd = new PDO("mysql:host=hugoorickx.be;dbname=u716273791_me", "u716273791_hugoorickx", "8X=HB]mW&px");
                    // set the PDO error mode to exception
                    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    $query = $bdd->query($string);
                    $resultat = $query->fetchAll(PDO::FETCH_ASSOC);
                    echo "Connected successfully"; 
                }
                catch(PDOException $e)
                {
                    echo "Connection failed: " . $e->getMessage();
                }
                echo "ici";
                
                // $to = 'hugoorickx@gmail.com';
                // $subject = 'Objet du mail';
                // $message = 'Contenu du mail';
                // $headers = 'From: '.$mail.'\'' . "\r\n" .
                //     'Reply-To: '.$mail.'\'' . "\r\n" .
                //     'X-Mailer: PHP/' . phpversion();

                // if (!mail($to, $subject, $message, $headers)) {
                //     echo error_get_last()['message'];
                // }
            }
            // else
            // {
            //     {
            //         echo "nope3";
            //         return;
            //     }
            // }
    ?>
    <header>
        <div class="github"></div>
        <div class="tel"></div>
        <div class="mail"></div>
    </header>
    <main>
        <form action="./contact_me.php" method="post">
            <div class="input-container">
                <input type="text" name="name" id="name" class="input" placeholder=" ">
                <label for="firstname" class="placeholder">Name *</label>
            </div>
            <div class="input-container">
                <input type="text" name="mail" id="mail" class="input" placeholder=" ">
                <label for="mail" class="placeholder">Mail *</label>
            </div>
            <div class="input-container">
                <input type="text" name="phone" id="phone" class="input" placeholder=" ">
                <label for="phone" class="placeholder">Phone</label>
            </div>
            <div class="input-container large">
                <textarea name="desc" id="desc" class="input area" placeholder=" "></textarea>
                <label for="desc" class="placeholder">
                    Description *
                </label>
            </div>
            <input type="submit" value="Send to me" class="submit" id="submit">
        </form>
    </main>
</body>
</html>