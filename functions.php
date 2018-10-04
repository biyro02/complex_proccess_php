<?php
/**
 * Created by PhpStorm.
 * User: bayramu
 * Date: 03.10.2018
 * Time: 09:44
 */

# $digit isimli değişken, şayet formdaki digit isimli inputa değer girilmişse onu alır, girilmemişse 3 verir.
$digit = isset($_POST['digit']) ? $_POST['digit'] : 3;
$itemSize = isset($_POST['itemSize']) ? $_POST['itemSize'] : 10;
$numbers = [];

/**
 * Girilen sayıda basamak için alt-üst değerleri yaratır ve geri döner
 *
 * @param $digit
 * @return array
 */
function calculateDigits($digit=1)
{
    # aşağıdaki for döngüsü içinde çarpma işlemi yapılacak ve bu yüzden yarattığımız ilk değer, çarpma işleminin etkisiz elemanı olan 1 olmalıdır. İlk değeri 0 verirsek ne kadar çarparsak çarpalım hep 0 buluruz.
    $value = 1;
    # döngü, istediğimiz basamak kadar dönecek, 3 basamaklı istiyorsak aşağıdaki döngü üç defa dönecek
    for($i=1;$i<=$digit;$i++)  
    {
        $value *=10;                                                    // matematikte her basamak birer onluktur. İki basamaklı bir sayıda 10^0 ve 10^1 şeklinde iki adet basamak vardır. Yani bu da minimun iki basamaklı sayıyı 10 olarak yapar. Her iki basamaklı xy sayısını (10^0)*x + (10^1)*y şeklinde gösteririz. Bu durumda 10^0 = 1 ve x=0 olarak alırsak 1*x=0 yapar, 10^1=10 ise ve y'yi de en küçük 1 olarak alırsak 10*1=10 yapar, son olarak 10+0=0 olarak en küçük iki basamaklı sayıyı bulmuş oluruz. Yani iki basamaklı say istiyorsak en büyük rakam için 10*10*10 - 1 şeklinde yazmalıyız.
    }
  
  return ['max' => $value-1,                                            // max değer yukarıda hesaplananın bir eksiğidir. Çünkü örneğin ben $digit=3 olarak çalıştırırsam 10*10*10 = 1000 yapar ve bu da 4 basamaklı bir sayıdır. Bu yüzden 1 çıkartırsam en büyük 3 basamaklı sayıya ulaşmış olurum.
          'min' => (($digit==1) ? 0: $value/10)];                       // min değer ise o basamaktaki en küçük sayıyı bulur. $digir=3 aldığımızda yukarıdaki döngüde 10*10*10 = 1000 dönecek. Şayet bunu 10'a bölersem 1000/10 = 100 yapar ve en küçük 3 basamaklı sayıdır kendisi.
}

/**
 * calculateDigits() fonksiyonunu kullanarak girilen aralık değerinde 1 adet sayı üretir
 *
 * @param int $digit
 * @return int
 */
function randValue($digit=1)
{
    # basamak aralığını yaratır
  $range = calculateDigits($digit);                 
  return rand($range['min'], $range['max']);                            // yaratmış olduğumuz max-min değerleriyle rand fonksiyonundan rastgele sayı üretiriz.
}

/**
 * Son basamak rakamını ve ona denk düşen yüzdeyi hesaplar ve geri döner
 *
 * @param int $number
 * @return float|int
 */
function calculatePercentageWithLastDigit($number=1)
{
    # girilen parametre rakam mı diye kontrol ederiz
    if(!is_int($number))                                                // is_int() php'nin kendi fonksiyonudur ve içine aldığı parametrenin int türünden bir değer olup olmadığını sorgular. Sadece true veya false döner. Parametre olarak bildirilen değer integersa true, değilse false döner. Bu fonksiyonu sonucu garantilemek için kullandık burada. Her halükarda buraya int bir değer girilmeli. Ayrıntılar için: http://php.net/manual/tr/function.is-int.php
        return 0;                                                       // girilen parametre int değilse 0 döner.
    else                                                                // parametre int ise aşağıdaki işlemi yapar
        return $number*(($number%10)/100);                              // herhangi bir değişkene gerek duymadan gelen parametreyi hesaplayıp return ediyoruz.
}

/**
 * Bizim özel hesabımızı girilen rakama uygular ve geri döner.
 *
 * @param int $number
 * @return float|int
 */
function calculateSpecial($number=1)
{
    # yukarıda yarattığımız fonksiyonu çağırırız ve yaratılan değeri de toplayarak import ederiz.
    $number += calculatePercentageWithLastDigit($number);               // Yukarıda yarattığımız ve içine girilen parametreyi son basamağına göre yüzde hesaplayarak dönen fonksiyonu çağırıyoruz, üretilen değeri de elimizdeki sayıyla topluyoruz.
    return $number;                                                     // return ediyoruz
}

/**
 * Yukarıdaki işlemleri bir araya alarak tümünü birden yapar
 *
 * @param int $item
 * @param int $digit
 * @param $numbers
 * @return mixed
 */
function main($item=1, $digit=1, &$numbers)                             // burada main() fonksiyonunu tanımlarken son parametreyi &$number diye tanımlamışım. Fark edilirse parametreyi tanımlarken başına & işareti koyuldu. Bu durum fonksiyon içindeki yapılan işlemlerden sonra ortaya çıkan ve döndürmek istediğim bir verinin dışarıya dönülmesi demektir. Yani eskiden biz function calculate($deger){ return $deger*2;} şeklinde tanımladığımız bir fonksiyonu çağırırken $hesapla = calculate(2); şeklinde kullanıyorduk. O kullanım çoğunlukla geçerli olmakla beraber bu kullanımda ise calculate(&$hesapla); şeklinde çağırabilir ve $hesapla değikenine calculate() fonksiyonunun sonucunu atayabilriz. Bu karmaşık gelebilir. Ayrıntılar için: http://php.net/manual/en/language.references.php
{
    # istenen basamaklı ve istenen kadar sayıdaki sayıyı yaratıp hesaplayıp dönüyoruz. Bunu da iki fonksiyonu peşpeşe yazarak ve aynı array içine atarak for döngüsüyle yapıyoruz.
    for($i=0;$i<$item;$i++)
    {
        $numbers[0][$i] = randValue($digit);
        $numbers[1][$i] = calculateSpecial($numbers[0][$i]);
    }
    return $numbers;                                                    // yukarıda yaratılan numaraları $numbers isimli array içerisine atıp onu return ediyoruz.
}

/**
 * Kendisine parametre olarak girilen bir değeri düzenli bir şekilde göstermeye yarar
 * Hem array hem de değer alabilir. Foreach ya da while gibi döngülere ihtiyaç duymaz.
 *
 * @param array $numbers
 */
function pushScreen($numbers = [])
{
    # Eğer fonksiyonun aldığı parametre sayılabilirse(diziyse ve birden fazla elemanı varsa), bu işlemi yap
    if (is_iterable($numbers)) {                                        // is_iterable fonksiyonu php'nin kendi fonksiyonudur ve aldığı parametreyi sayılabilir mi diye kontrol eder. Sadece iki cevabı vardır: true ya da false. Sayılabilirse true döner, sayılamazsa false döner. Ayrıntılar için: http://php.net/manual/tr/function.is-iterable.php
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
