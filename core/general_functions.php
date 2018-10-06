<?php
/**
 * Created by PhpStorm.
 * User: bayram
 * Date: 05.10.2018
 * Time: 10:46
 */


/**
 * Kendisine parametre olarak girilen bir değeri düzenli bir şekilde göstermeye yarar
 * Hem array hem de değer alabilir. Foreach ya da while gibi döngülere ihtiyaç duymaz.
 *
 * @param array $numbers
 */
function pushScreen($numbers = [])
{
    # Eğer fonksiyonun aldığı parametre sayılabilirse(diziyse ve birden fazla elemanı varsa), bu işlemi yap
    if (is_array($numbers)) {                                        // is_iterable fonksiyonu php'nin kendi fonksiyonudur ve aldığı parametreyi sayılabilir mi diye kontrol eder. Sadece iki cevabı vardır: true ya da false. Sayılabilirse true döner, sayılamazsa false döner. Ayrıntılar için: http://php.net/manual/tr/function.is-iterable.php
        echo '<pre style="font-size: 12px; font-family: monospace;">'   // <pre> etiketi kodların ya da debug modundayken istediğimiz sonuçların madde madde ve altalta düzgün bir şekilde görüntülenmesini sağlar. Ayrıntılar için: https://www.w3schools.com/tags/tag_pre.asp
            ."\n"
            .trim(                                                      //bu fonksiyon, değerin başında veya sonunda boşluk varsa temizler. Ayrıntılar için http://php.net/manual/tr/function.trim.php
                print_r(                                            // print_r ise aldığı parametreyi ekrana basar. Ayrıntılar için http://php.net/manual/tr/function.print-r.php
                    $numbers, 1
                )
            );
    }
    # sayılabilir bir parametre değilse(string, int, float gibi tek boyutlu bir değer ya da null ise), burayı çalıştır.
    else {
        echo "\n<div style='font-size: 12px; font-family: monospace;'>";
        var_dump($numbers);
    }
}
