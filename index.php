<?php 
    if(isset($_POST['length'])) {
        $length = intval($_POST['length']);
        $lowercase = isset($_POST['lowercase']);
        $uppercase = isset($_POST['uppercase']);
        $symbols = isset($_POST['symbols']);
        $numbers = isset($_POST['numbers']);

        if(!$lowercase && !$uppercase && !$symbols && !$numbers) echo "Failed to generate password. Choose at least 1 type";

        $lowercase_chars = "abcdefghijklmnopqrstuvwxyz";
        $uppercase_chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $symbols_chars = "!@#$%&'()*+,-./=:;<>?_";
        $numbers_chars = "0123456789";

        $password = "";
        $valid_options = "";

        if($lowercase) $valid_options .= $lowercase_chars;

        if($uppercase) $valid_options .= $uppercase_chars;

        if($symbols) $valid_options .= $symbols_chars;

        if($numbers) $valid_options .= $numbers_chars;

        for($k = 0; $k < $length; $k++) {
            $random_number = rand(0, strlen($valid_options)-1);
            $password .= $valid_options[$random_number];
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Generator</title>

    <link rel="stylesheet" href="styles.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- <script src="./script.js" defer></script> -->
</head>
<body>
    <div class="container">
        <h4>Generate a password</h4>
        <form method="post" action="">
            <p>
                <label for="">Password Length</label>
                <input type="number" name="length" min="6" value="16" required>
            </p>
            <p>
                <label for="">Include Lowercase</label>
                <input type="checkbox" name="lowercase" checked value="1">
            </p>
            <p>
                <label for="">Include Uppercase</label>
                <input type="checkbox" name="uppercase" checked value="1">
            </p>
            <p>
                <label for="">Include Symbols</label>
                <input type="checkbox" name="symbols" checked value="1">
            </p>
            <p>
                <label for="">Includes Numbers</label>
                <input type="checkbox" name="numbers" checked value="1">
            </p>
            <p><button type="submit">Generater</button></p>
        </form>
        <?php if(isset($password)) { ?>
            <h5>Generated Password</h5>
            <input type="text" value="<?php echo $password ?>" readonly id="passwordInput">
            <button id="copyButton" onclick="copyToClipboard()">Copiar</button>
        <?php } ?>
    </div>
    <script>
        const copyToClipboard = () => {
            var inputElement = document.getElementById("passwordInput")

            if (window.isSecureContext && navigator.clipboard) {
                navigator.clipboard.writeText(inputElement.value);
            } else {
                unsecuredCopyToClipboard(inputElement.value);
            }
            alert("Valor copiado: " + inputElement.value)
        }

        const unsecuredCopyToClipboard = () => {
            var copyButton = document.getElementById("copyButton")
            var inputElement = document.getElementById("passwordInput")
        
            copyButton.addEventListener("click", function() {
                inputElement.select()
                try {
                    document.execCommand("copy")
                } catch (error) {
                    console.log("Unable to copy to clipboard", error)
                }
                alert("Valor copiado: " + inputElement.value)
            })
        }
    </script>
</body>
</html>  