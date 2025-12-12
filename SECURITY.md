# Güvenlik Dokümantasyonu

## Uygulanan Güvenlik Önlemleri

### 1. Shell Upload Koruması
- Zararlı dosya uzantıları engellendi (.php, .phtml, .sh, .exe, vb.)
- Tehlikeli PHP fonksiyonları tespit ediliyor (eval, base64_decode, shell_exec, vb.)
- .htaccess ile dosya yükleme engellendi

### 2. DDoS Koruması
- Rate limiting: IP başına dakikada 30 istek (API için)
- Otomatik IP engelleme: Şüpheli aktivite tespit edildiğinde IP 5-30 dakika engellenir
- mod_evasive desteği (sunucuda yüklüyse)
- mod_ratelimit desteği (sunucuda yüklüyse)

### 3. SQL Injection Koruması
- Tüm kullanıcı girdileri sanitize ediliyor
- SQL injection pattern'leri tespit ediliyor
- Parametreli sorgular kullanılmalı (veritabanı varsa)

### 4. XSS (Cross-Site Scripting) Koruması
- Tüm çıktılar htmlspecialchars ile temizleniyor
- XSS pattern'leri tespit ediliyor
- Content Security Policy (CSP) başlıkları aktif

### 5. Path Traversal Koruması
- Kullanıcı girdilerinde ../ ve benzeri pattern'ler engelleniyor
- basename() ve regex ile dosya adları temizleniyor
- .htaccess ile config ve cache klasörleri korunuyor

### 6. API Güvenliği
- Rate limiting: 30 istek/dakika
- IP bazlı engelleme
- Request tarama ve tehdit tespiti
- Güvenli hata mesajları (bilgi sızıntısı yok)

### 7. Güvenlik Başlıkları
- X-Content-Type-Options: nosniff
- X-Frame-Options: SAMEORIGIN
- X-XSS-Protection: 1; mode=block
- Referrer-Policy: strict-origin-when-cross-origin
- Content-Security-Policy: Aktif
- Strict-Transport-Security (HTTPS için)

### 8. Bot Koruması
- Şüpheli User-Agent'lar engelleniyor
- Boş User-Agent engelleniyor
- Bilinen bot pattern'leri engelleniyor

### 9. Güvenlik Loglama
- Tüm şüpheli aktiviteler loglanıyor
- IP, User-Agent, URI ve zaman damgası kaydediliyor
- Log dosyası otomatik olarak 10MB'da sınırlanıyor
- Log dosyası: `cache/security/security.log`

### 10. CSRF Koruması
- CSRF token oluşturma ve doğrulama fonksiyonları mevcut
- Session güvenlik ayarları aktif

## Güvenlik Dosyaları

- `config/security.php` - Ana güvenlik sınıfı
- `cache/security/security.log` - Güvenlik logları
- `cache/security/rate_limit.json` - Rate limit verileri
- `cache/security/blocked_ips.json` - Engellenen IP'ler

## Klasör Korumaları

- `config/` - Dış erişim engellendi
- `cache/security/` - Dış erişim engellendi
- `cache/` - Sadece earthquake_data.json erişilebilir
- `api/` - Sadece belirli dosyalar erişilebilir

## Rate Limit Ayarları

### API Endpoint
- Maksimum: 30 istek/dakika
- Aşım durumunda: 5 dakika engelleme

### Ana Site
- Rate limiting aktif
- Şüpheli aktivite tespit edildiğinde otomatik engelleme

## IP Engelleme

IP'ler şu durumlarda engellenir:
- Rate limit aşımı (5 dakika)
- SQL Injection tespiti (30 dakika)
- XSS tespiti (30 dakika)
- Path Traversal tespiti (30 dakika)
- Shell upload denemesi (1 saat)

## Güvenlik İzleme

Güvenlik loglarını kontrol etmek için:
```bash
tail -f cache/security/security.log
```

Engellenen IP'leri görmek için:
```bash
cat cache/security/blocked_ips.json
```

## Öneriler

1. **HTTPS Kullanın**: SSL sertifikası kurun ve HTTPS'i zorunlu kılın
2. **Düzenli Güncelleme**: PHP ve sunucu yazılımlarını güncel tutun
3. **Log İzleme**: Güvenlik loglarını düzenli kontrol edin
4. **Yedekleme**: Güvenlik loglarını düzenli yedekleyin
5. **Firewall**: Sunucu seviyesinde firewall kullanın
6. **WAF**: Web Application Firewall kullanmayı düşünün

## Acil Durum

Eğer bir güvenlik açığı tespit edilirse:

1. Etkilenen IP'leri engelleyin
2. Güvenlik loglarını inceleyin
3. İlgili dosyaları güncelleyin
4. Cache'i temizleyin
5. Rate limit dosyalarını sıfırlayın (gerekirse)

## İletişim

Güvenlik açığı bildirimi için: [E-posta adresiniz]

