<?php
function encrypt($originalWord, $key) {
    $encryptionMethod = "AES-256-CBC";
    $ivLength = openssl_cipher_iv_length($encryptionMethod);
    $iv = openssl_random_pseudo_bytes($ivLength);
    $encryptedWord = openssl_encrypt($originalWord, $encryptionMethod, $key, OPENSSL_RAW_DATA, $iv);
    $encryptedWord = base64_encode($iv . $encryptedWord);
    return $encryptedWord;
}

function decrypt($encryptedWord, $key) {
    $encryptionMethod = "AES-256-CBC";
    $encryptedWord = base64_decode($encryptedWord);
    $ivLength = openssl_cipher_iv_length($encryptionMethod);
    $iv = substr($encryptedWord, 0, $ivLength);
    $encryptedWord = substr($encryptedWord, $ivLength);
    $decryptedWord = openssl_decrypt($encryptedWord, $encryptionMethod, $key, OPENSSL_RAW_DATA, $iv);
    return $decryptedWord;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Info-Assurance</title>

    <link rel="stylesheet" href="assets/css/index.css">
    <link rel="stylesheet" href="assets/css/encrypt-decrypt.css">
</head>
<body>
    <div class="container">
        <div class="subContainer">
            <div class="textContainer">
                <div class="title">
                    <p>WORDSLOCK</p>
                </div>

                <div class="descriptionContainer">
                    <p class="text">Securely encrypt and decrypt words with simplicity and ease.</p>
                </div>

                <div class="subTextContainer1">
                    <div class="buttonContainer">
                        <button id="tryNowButton" class="button" onclick="openModal()">Try now</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="subContainer">
            <div class="textContainer">
                <img class="index-img" src="assets/img/index-img.png" alt="">
            </div>
        </div>
    </div>

    <!--  Modal -->
    <div id="Modal" class="modal" style="display: none;">

        <div class="backContainer">
            <div class="subBackContainer">
                <img class="back" id="closeEncryptModalBtn" src="assets/img/cancel.png" alt="" onclick="closeModal()">
            </div>
        </div>

        <!-- Encrypt Form -->
        <form class="encryptContainer" method="post">
            <div class="copyMessage" id="encryptCopyMessage"></div>

            <div class="textContainer">
                <p>ENCRYPTION</p>
            </div>

            <div class="imageContainer">
                <img class="image" src="assets/img/encypt.png" alt="">
            </div>

            <div class="inputContainer">
                <input class="input" type="text" name="encryptInput" placeholder="Enter word to encrypt..">
            </div>

            <div class="inputContainer">
                <input class="input" type="text" name="encryptKey" placeholder="Enter key">
            </div>

            <div class="inputContainer">
                <button type="submit" class="encryptButton" name="encrypt">Encrypt</button>
            </div>

            <div class="imageContainer">
                <div class="outputContainer" id="encryptOutputContainer">
                    <div class="copyContainer">
                        <div class="subCopyContainer">
                            <img class="copy" src="assets/img/copy.png" alt=""  onclick="copyText('encryptOutput', 'encryptCopyMessage')">
                        </div>
                    </div>
                    
                    <div class="encypt-output">
                        <?php
                        if (isset($_POST['encrypt'])) {
                            $originalWord = $_POST['encryptInput'];
                            $key = $_POST['encryptKey'];
                            $encryptedWord = encrypt($originalWord, $key);
                            echo '<div class="output" id="encryptOutput">' . $encryptedWord . '</div>';
                        }
                        ?>
                    </div>
                </div>
            </div>
        </form>

        <!-- Decrypt Form -->
        <form class="decryptContainer" method="post">
                    
            <div class="copyMessage" id="decryptCopyMessage"></div>

            <div class="textContainer">
                <p>DECRYPTION</p>
            </div>

            <div class="imageContainer">
                <img class="image" src="assets/img/decrypt.png" alt="">
            </div>

            <div class="inputContainer">
                <input class="input" type="text" name="decryptInput" placeholder="Enter word to decrypt..">
            </div>

            <div class="inputContainer">
                <input class="input" type="text" name="decryptKey" placeholder="Enter key">
            </div>

            <div class="inputContainer">
                <button type="submit" class="encryptButton" name="decrypt">Decrypt</button>
            </div>

            <div class="imageContainer">
                <div class="outputContainer" >
                <div class="copyContainer">
                    <div class="subCopyContainer">
                        <img class="copy" src="assets/img/copy.png" alt="" onclick="copyText('decryptOutput', 'decryptCopyMessage')">
                    </div>
                </div> 
                <?php
                    if (isset($_POST['decrypt'])) {
                        $encryptedWord = $_POST['decryptInput'];
                        $key = $_POST['decryptKey'];
                        $decryptedWord = decrypt($encryptedWord, $key);
                        echo '<div class="output" id="decryptOutput">' . $decryptedWord . '</div>';
                    }
                ?>
                </div>
            </div>
        </form>
    </div>
    </div>

    <script src="assets/js/modal.js"></script>

</body>
</html>
