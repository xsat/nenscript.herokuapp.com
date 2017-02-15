<?php

$content = $result = '';

if (isset($_POST['content'])) {
    $result  = $content = $_POST['content'];

    $number = 26;
    foreach (range('Z', 'A') as $letter) {
        $result = preg_replace("#'0" . ($number--). '([^0-9]*)#isU', strtoupper($letter) . '$1', $result);
    };

    $number = 26;
    foreach (range('z', 'a') as $letter) {
        $result = preg_replace("#'" . ($number--). '([^0-9]*)#isU', strtolower($letter) . '$1', $result);
    };

    $result = preg_replace("#'_#isu", ' ', $result);
    $result = preg_replace('#"([^"])#isu', '$1', $result);
}

?>

<form method="post">
    <label for="content">Nen:</label>
    <textarea style="width: 100%; height: 100px" id="content" name="content"><?= isset($content) ? $content : null; ?></textarea>
    <label for="result">English:</label>
    <textarea disabled style="width: 100%; height: 100px" id="result" name="result"><?= isset($result) ? $result : null; ?></textarea>
    <button type="submit">Submit</button>
    <br>
    <a href="/encode.php">Restart</a>
    <br>
    <a href="/decode.php">English => Nen</a>
</form>