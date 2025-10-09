<?php
$pattern = '/[a-z]/';
$text = 'This is a Sample Text.';
if (preg_match($pattern, $text)) {
    echo "Huruf kecil ditemukan!<br>";
} else {
    echo "Tidak ada huruf kecil!<br>";
}

$pattern = '/[0-9]+/'; 
$text = 'There are 123 apples.';
if (preg_match($pattern, $text, $matches)) {
    echo "Cocokkan: " . $matches[0] . "<br>";
} else {
    echo "Tidak ada yang cocok!<br>";
}

$pattern = '/apple/';
$replacement = 'banana';
$text = 'I like apple pie.';
$new_text = preg_replace($pattern, $replacement, $text);
echo $new_text . "<br>";

$pattern = '/go*d/';
$text = 'god is good.';
if (preg_match($pattern, $text, $matches)) {
    echo "Cocokkan: " . $matches[0] . "<br>";
} else {
    echo "Tidak ada yang cocok!<br>";
}

$pattern = '/go?d/'; 
$text = 'good is good.';
if (preg_match($pattern, $text, $matches)) {
    echo "Cocokkan 'go?d': " . $matches[0] . "<br>";
} else {
    echo "Tidak ada yang cocok 'go?d'!<br>";
}

$pattern = '/go{2,4}d/'; 
$text = 'goood is goooooood.';
if (preg_match($pattern, $text, $matches)) {
    echo "Cocokkan 'go{2,4}d': " . $matches[0] . "<br>";
} else {
    echo "Tidak ada yang cocok 'go{2,4}d'!<br>";
}

$text2 = 'goid is god.';
if (preg_match($pattern, $text2, $matches)) {
    echo "Cocokkan 'go{2,4}d' di text2: " . $matches[0] . "<br>";
} else {
    echo "Tidak ada yang cocok 'go{2,4}d' di text2!<br>";
}

?>