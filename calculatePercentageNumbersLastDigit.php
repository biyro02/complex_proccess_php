<?php
/**
 * Created by PhpStorm.
 * User: bayramu
 * Date: 03.10.2018
 * Time: 09:44
 */
include_once "functions.php";
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
    <input type="number" value="<?=$digit; ?>" name="digit">
    <input type="submit" value="Sayı yarat" name="sayiYarat">
    <?php if(!empty($numbers) || $numbers!=10) {                        // Eğer $numbers isimli değişken boşsa veya 10'a eşit değilse sayiYarat butonuna hiç basılmamış demektir. B ?>
            <input type="submit" value="Yaratılan sayı kadar yüzde hesapla" name="yuzdeleriHesapla">
        <?php } else { ?>
            <input type="submit" value="Tümünü Hesapla" name="tumunuHesapla">
        <?php } ?>
</form>
<?php
if($_POST["tumunuHesapla"]) {                                           // global bir değişken(yani tüm sayfalarda çağırılabilen ve kullanılabilen) olan $_POST, php'nin özel bir değişkenidir. Formlarla ve sayfalarla veri transferi yapmak istediğimizde bu değişkeni kullanırız. Bir formu submit ettiğimizde php bu formdaki inputların değerlerini $_POST değişkenine kendisi atar. Örneğin <input name="deneme_input"> şeklindeki bir inputun $_POST tarafındaki yakalanışı şöyle olur: $_POST['deneme_input']. Yani evet, $_POST değişkeni formdaki name özelliğine göre yakalar veriyi. Ayrıntılar için: http://php.net/manual/tr/reserved.variables.post.php
    $time = microtime(true);                                 // tahmin edileceği üzere bu mirotime() fonksiyonu çağırıldığı andan itibaren saniyenin milyonda birine kadar küçük bir değeri yakalayabilme yeteneğine sahiptir. Ayrıntılar için: http://php.net/manual/tr/function.microtime.php
    main($itemSize, $digit, $numbers);                                  // Eğer Tümünü Hesapla butonuna basıldıysa bu fonksiyon çağırılmalı.
    } elseif($_POST['yuzdeleriHesapla']){                               // eğer sadece yuzdeleriHesapla butonuna basıldıysa aşağıdaki işlemleri yap
        $time = microtime(true);                             // işlemin başlangıç zamanını bul
        $calculateNumber = calculatePercentageWithLastDigit($numbers);  // Sadece yüzdeyi hesaplayan fonksiyonu çağır
    } else {
        $time = microtime(true);                             // başlangıç zamanı yakala
        $createNumber = randValue($digit);                              // basamak sayısı girerek rastgele sayı üret
    }
?>
<div><?php pushScreen($numbers);
    echo "\n".number_format(microtime(true)-$time,6)." saniye sürdü"?></div>
</body>
</html>
