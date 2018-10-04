<?php
/**
 * Created by PhpStorm.
 * User: bayramu
 * Date: 03.10.2018
 * Time: 09:44
 */
    include_once "functions.php";

    if(isset($_POST["tumunuHesapla"]))                                 // global bir değişken(yani tüm sayfalarda çağırılabilen ve kullanılabilen) olan $_POST, php'nin özel bir değişkenidir. Formlarla ve sayfalarla veri transferi yapmak istediğimizde bu değişkeni kullanırız. Bir formu submit ettiğimizde php bu formdaki inputların değerlerini $_POST değişkenine kendisi atar. Örneğin <input name="deneme_input"> şeklindeki bir inputun $_POST tarafındaki yakalanışı şöyle olur: $_POST['deneme_input']. Yani evet, $_POST değişkeni formdaki name özelliğine göre yakalar veriyi. Ayrıntılar için: http://php.net/manual/tr/reserved.variables.post.php
    {
        $time = microtime(true);                            // tahmin edileceği üzere bu mirotime() fonksiyonu çağırıldığı andan itibaren saniyenin milyonda birine kadar küçük bir değeri yakalayabilme yeteneğine sahiptir. Ayrıntılar için: http://php.net/manual/tr/function.microtime.php
        main($numbers, $itemSize, $digit);                         // Eğer Tümünü Hesapla butonuna basıldıysa bu fonksiyon çağırılmalı.
    } elseif(isset($_POST['sayiYarat'])) {
        $time = microtime(true);                            // başlangıç zamanı yakala
        for($i=0;$i<$itemSize;$i++)
        {
            $numbers[0][$i] = randValue($digit);                             // basamak sayısı girerek rastgele sayı üret
        }
    } elseif(isset($_POST['yuzdeleriHesapla'])) {                       // eğer sadece yuzdeleriHesapla butonuna basıldıysa aşağıdaki işlemleri yap
        $time = microtime(true);                            // işlemin başlangıç zamanını bul
        $numbers[0] = explode(',', $_POST['numbers']);
        var_dump($_POST['numbers']);
        for($i=0;$i<$itemSize;$i++)
        {
            $numbers[1][$i]= calculatePercentageWithLastDigit($numbers[0][$i]); // Sadece yüzdeyi hesaplayan fonksiyonu çağır
        }
    }
?>
<!--Html dosyası yaratırız -->
<!doctype html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Rastgele sayı üret - Yüzde hesapla</title>
</head>
<body>
<!--Yarattığımız bir form ile veri alışverişi yapmak için iki attribute muhakkak ekleriz, action ve method. Buradaki method'umuz post, action'ımız ise boş olarak seçilmiştir. Ayrıntılar için: http://php.net/manual/tr/tutorial.forms.php-->
<form action="" method="post">
    <!-- Aşağıdaki input'un post edilen değeri varsa onu tutmak için kullanırız.-->
    <label for="digit">Basamak sayısı</label>
    <input type="number" value="<?=$digit; ?>" name="digit" title="Basamak sayısı"><br>
    <label for="itemSize">Basamak sayısı</label>
    <input type="number" value="<?=$itemSize; ?>" name="itemSize" title="Basamak sayısı"><br>
    <?php if(isset($_POST['sayiYarat'])) { ?>
        <input type="hidden" name="numbers" value="<?=implode(',',$numbers)?>">
    <?php }?>
    <input type="submit" value="Sayı yarat" name="sayiYarat">
    <input type="submit" value="Yaratılan sayı kadar yüzde hesapla" name="yuzdeleriHesapla">
    <input type="submit" value="Tümünü Hesapla" name="tumunuHesapla">
</form>
<div><?php
    if(isset($_POST["tumunuHesapla"]) || isset($_POST["yuzdeleriHesapla"]) || isset($_POST["sayiYarat"])) {
        pushScreen($numbers);
        echo "\n" . number_format(microtime(true) - $time, 6) . " saniye sürdü";
    }?></div>
</body>
</html>
