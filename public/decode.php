<?php

$content = $result = '';

if (isset($_POST['content'])) {
    $content = $_POST['content'];
    $from = $to = [];

    foreach (range('a', 'z') as $letter) {
        $from[] = strtolower($letter);
    };

    foreach (range(1, 26) as $number) {
        $to[] = '\'' . $number;
    };

    foreach (range('A', 'Z') as $letter) {
        $from[] = strtoupper($letter);
    };

    foreach (range(1, 26) as $number) {
        $to[] = '\'0' . $number;
    };

    $from[] = ' ';
    $to[] = '\'_';

    $result = str_replace($from, $to, preg_replace('#([^a-z \n\r]+)#isu', '"$1', $content));
}

?>

<form method="post">
    <label for="content">English:</label>
    <textarea style="width: 100%; height: 100px" id="content" name="content"><?= isset($content) ? $content : null; ?></textarea>
    <label for="result">Nen:</label>
    <textarea disabled style="width: 100%; height: 100px" id="result" name="result"><?= isset($result) ? $result : null; ?></textarea>
    <button type="submit">Submit</button>
    <br>
    <a href="/decode.php">Restart</a>
    <br>
    <a href="/encode.php">Nen => English</a>
</form>