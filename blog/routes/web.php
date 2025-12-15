<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('ana-sayfa');
});

Route::get('/kayit-olma-sayfa.html', function () {
    return view('kayit-olma-sayfa');
});

Route::get('/bilgilendirme-sayfa.html', function () {
    return view('bilgilendirme-sayfa');
});

Route::get('/giris-sayfa.html', function () {
    return view('giris-sayfa');
});
Route::get('/sifre-degistirme-sayfa.html', function () {
    return view('sifre-degistirme-sayfa');
});

Route::get('/hikaye-detay', function () {
    return view('hikaye-detay');
});
Route::get('/iletisim', function () {
    return view('iletisim');
});