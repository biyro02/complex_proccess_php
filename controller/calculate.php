<?php
/**
 * Created by PhpStorm.
 * User: bayram
 * Date: 05.10.2018
 * Time: 18:06
 */
include(__DIR__.'/../core/calculate_functions.php');

if(isset($_POST["tumunuHesapla"]))                                 // global bir değişken(yani tüm sayfalarda çağırılabilen ve kullanılabilen) olan $_POST, php'nin özel bir değişkenidir. Formlarla ve sayfalarla veri transferi yapmak istediğimizde bu değişkeni kullanırız. Bir formu submit ettiğimizde php bu formdaki inputların değerlerini $_POST değişkenine kendisi atar. Örneğin <input name="deneme_input"> şeklindeki bir inputun $_POST tarafındaki yakalanışı şöyle olur: $_POST['deneme_input']. Yani evet, $_POST değişkeni formdaki name özelliğine göre yakalar veriyi. Ayrıntılar için: http://php.net/manual/tr/reserved.variables.post.php
{
    $time = microtime(true);                            // tahmin edileceği üzere bu mirotime() fonksiyonu çağırıldığı andan itibaren saniyenin milyonda birine kadar küçük bir değeri yakalayabilme yeteneğine sahiptir. Ayrıntılar için: http://php.net/manual/tr/function.microtime.php
    main($numbers, 3, $itemSize, $digit);                 // Eğer Tümünü Hesapla butonuna basıldıysa bu fonksiyon çağırılmalı.
} elseif(isset($_POST['sayiYarat'])) {
    $time = microtime(true);                            // başlangıç zamanı yakala
    main($numbers, 1, $itemSize, $digit);
} elseif(isset($_POST['yuzdeleriHesapla'])) {                      // eğer sadece yuzdeleriHesapla butonuna basıldıysa aşağıdaki işlemleri yap
    $time = microtime(true);                            // işlemin başlangıç zamanını bul
    $numbers[0] = explode(',', $_POST['numbers']);
    main($numbers,2, $itemSize, $digit);
}

include_once (__DIR__ . "/../view/calculate.php");