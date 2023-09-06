<?php
    //SWEETALERT MESAJLARI -
    use Gloudemans\Shoppingcart\Facades\Cart;

    define('SWEETALERT_MESSAGE_CREATE', 'Eklendi');
    define('SWEETALERT_MESSAGE_UPDATE', 'Güncellendi');
    define('SWEETALERT_MESSAGE_DELETE', 'Silindi');
    define('CARGO_LIMIT', 200);
    define('CARGO_PRICE', 17.90);
    define('MAIL_SEND', 'info@westerpark.nl');

    function cartControl($id){
        foreach (Cart::instance('shopping')->content() as $c){
            if($c->id == $id){
                return true;
            }
        }
        return false;
    }

function cartControlqty($id){
    foreach (Cart::instance('shopping')->content() as $c){
        if($c->id == $id){
            return $c->qty;
        }
    }
    return false;
}

    function kiralamaUcretiHesapla($ilkGunFiyati, $gunSayisi) {
        $toplamUcret = 0;
        if ($gunSayisi <= 0) {
            return $toplamUcret;
        } elseif ($gunSayisi == 1) {
            return $ilkGunFiyati;
        } else {
            $toplamUcret = $ilkGunFiyati + ($ilkGunFiyati * ($gunSayisi - 1) / 2);
            return $toplamUcret;
        }
    }

function hesaplaIndirimTutari($fiyat, $oran, $tip) {
    if ($tip === 'percentage') {
        $indirimTutari = $fiyat * ($oran / 100);
    } elseif ($tip === 'minus') {
        $indirimTutari = -$oran;
    } else {
        return 0; // Geçersiz indirim tipi durumunda 0 döndür
    }

    return $indirimTutari;
}

function ozelKarakterFiltrele($metin) {
    $filtreliMetin = htmlspecialchars($metin, ENT_QUOTES | ENT_HTML5, 'UTF-8');
    if ($filtreliMetin != $metin) {
        return true;
    } else {
        return false;
    }
}


function ayniOlanlariCikar($dizi1, $dizi2 = null) {
    $birlesikDizi = array_merge($dizi1, $dizi2 ?: []);
    $tekrarEdenler = [];

    foreach($birlesikDizi as $eleman) {
        if(array_key_exists($eleman, $tekrarEdenler)) {
            $tekrarEdenler[$eleman]++;
        } else {
            $tekrarEdenler[$eleman] = 1;
        }
    }

    $sonuc = [];
    foreach($tekrarEdenler as $eleman => $tekrarSayisi) {
        if($tekrarSayisi === 1) {
            $sonuc[] = $eleman;
        }
    }

    return $sonuc;
}

    function service($value){
        if($value == 1){
            return "servicedetail";
        }else if($value == 2){
            return "solutiondetail";
        }else{
            return "sectordetail";
        }
    }



    //KULLANICI ADI BAŞ HARFLERİNİ GÖSTERME
    function isim($isim){
        $parcala = explode(" ", $isim);
        $ilk = mb_substr(current($parcala), 0,3);
        $son = mb_substr(end($parcala), 0,3);
        return $ilk.'***'.' '.$son.'***';
    }

    function money($deger){
        return number_format((float)$deger, 2, '.', '');
    }

    function cargo($toplam)
    {
        if ($toplam >= 0){
            if ($toplam >= CARGO_LIMIT) {
                return 'Ücretsiz Kargo';
            } else {
                return money(CARGO_PRICE.'₺');
            }
        }
        return;
    }

    function cargoToplam($toplam){

        if($toplam < CARGO_LIMIT){
            return money($toplam + CARGO_PRICE);
        }else{
            return $toplam;
        }
    }
