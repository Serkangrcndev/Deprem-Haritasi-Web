# Deprem Haritası

Türkiye genelinde gerçek zamanlı deprem verilerini görüntüleyen web uygulaması.

## Özellikler

- 🌍 Gerçek zamanlı deprem verileri
- 🗺️ İnteraktif harita görünümü
- 📊 Deprem istatistikleri
- 🔍 Şehir, büyüklük ve zaman filtreleme
- 📱 Responsive tasarım
- 🌙 Karanlık/Aydınlık tema desteği
- 🎯 Senaryo simülasyonları

## Teknolojiler

- PHP
- JavaScript (Vanilla)
- Leaflet.js (Harita)
- Font Awesome (İkonlar)
- HTML5 / CSS3

## Kurulum

1. Projeyi web sunucunuza yükleyin (XAMPP, WAMP, vb.)
2. `config/config.php` dosyasını kontrol edin
3. `cache` klasörünün yazılabilir olduğundan emin olun
4. Tarayıcınızda projeyi açın

## API

Deprem verileri Kandilli Rasathanesi API'sinden alınmaktadır.

## Cache

Veriler 60 saniye süreyle cache'lenir. Cache'i manuel olarak yenilemek için:
```
/api/kandilli.php?force_refresh=1
```

## Cron Job

Otomatik cache güncellemesi için:
```
php api/cron_update_cache.php
```

Windows için:
```
api\run_cron.bat
```

## Sayfalar

- `/` - Ana sayfa (Harita)
- `/bilgi` - Deprem bilgileri
- `/guvenlik` - Güvenlik önerileri
- `/istatistikler` - İstatistikler
- `/senaryolar` - Senaryo simülasyonları

## Geliştirici

**Serkan Gürcan**  

## Lisans

Bu proje eğitim amaçlı geliştirilmiştir.

## Veri Kaynağı

- Kandilli Rasathanesi
- USGS (United States Geological Survey)


