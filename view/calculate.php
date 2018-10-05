<?php
/**
 * Created by PhpStorm.
 * User: bayram
 * Date: 05.10.2018
 * Time: 14:15
 */

?>
<!--Yarattığımız bir form ile veri alışverişi yapmak için iki attribute muhakkak ekleriz, action ve method. Buradaki method'umuz post, action'ımız ise boş olarak seçilmiştir. Ayrıntılar için: http://php.net/manual/tr/tutorial.forms.php-->
<form action="" method="post">
    <!-- Aşağıdaki input'un post edilen değeri varsa onu tutmak için kullanırız.-->
    <label for="digit">Basamak sayısı</label>
    <input type="number" value="<?=$digit; ?>" name="digit" title="Basamak sayısı"><br>
    <label for="itemSize">Basamak sayısı</label>
    <input type="number" value="<?=$itemSize; ?>" name="itemSize" title="Basamak sayısı"><br>
    <?php if(isset($_POST['sayiYarat'])) { ?>
        <input type="hidden" name="numbers" value="<?=implode(',',$numbers[0])?>">
    <?php }?>
    <input type="submit" value="Sayı yarat" name="sayiYarat">
    <input type="submit" value="Yaratılan sayı kadar yüzde hesapla" name="yuzdeleriHesapla">
    <input type="submit" value="Tümünü Hesapla" name="tumunuHesapla">
</form>
<div><?php
    if(isset($_POST["tumunuHesapla"]) || isset($_POST["yuzdeleriHesapla"]) || isset($_POST["sayiYarat"])) {
        pushScreen($numbers);
        echo "\n" . number_format(microtime(true) - $time, 7) . " saniye sürdü";
    }?></div>
