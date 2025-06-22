#  Real Estate – Mulk sotish va ijaraga berish platformasi(Yaratilish jarayonida)

Laravel asosida yaratilgan veb-ilova bo‘lib, foydalanuvchilarga turar-joy, ofis yoki boshqa mulklarni ijaraga berish yoki sotish uchun e’lonlar joylashtirish imkonini beradi. Admin panel, autentifikatsiya, CRUD tizimi va foydalanuvchi interfeysi mavjud.

---

##  Asosiy imkoniyatlar

- 🔐 Ro‘yxatdan o‘tish / Login(User/Agent) / Logout (Autentifikatsiya)
- 🏘️ Mulk qo‘shish, tahrirlash, o‘chirish (CRUD)
- 📂 Mulk kategoriyalari (ijara/sotuv)
- 🖼️ Rasm yuklash va ko‘rsatish(Hozircha faqat Agentlar uchun)
- 🔍 Foydalanuvchi interfeysi orqali e’lonlarni ko‘rish va qidirish

---

## 🛠 Texnologiyalar

- **Laravel** – PHP framework (backend)
- **Blade** – Laravel'ning view templating engine
- **Tailwind CSS / Bootstrap** – Frontend uchun (variantga qarab)
- **MySQL** – Ma’lumotlar bazasi
- **Laravel UI yoki Breeze** – Auth tizimi uchun (variantga qarab)

---

## ⚙️ O‘rnatish bo‘yicha yo‘riqnoma

1. Loyihani yuklab oling:

```bash
git clone https://github.com/ruswer/real-estate.git
cd real-estate
```

2. Kutubxonalarni o‘rnating:

```bash
composer install
```

3. `.env` faylini sozlang:

```bash
cp .env.example .env
php artisan key:generate
```

Ma’lumotlar bazasi sozlamalarini `.env` faylida kiriting:

```
DB_DATABASE=real_estate
DB_USERNAME=root
DB_PASSWORD=your_password
```

4. Migratsiya:

```bash
php artisan migrate
```

5. Agar frontend ishlatilgan bo‘lsa:

```bash
npm install
npm run dev
```

6. Laravel serverni ishga tushiring:

```bash
php artisan serve
```

---

## 👥 Foydalanuvchi ro‘yxatidan o‘tishi

- Foydalanuvchilar sayt orqali ro‘yxatdan o‘tib, o‘z e’lonlarini joylashtirishi mumkin(Faqat agent qo'shishi mumkin).

---

## 📝 Eslatmalar

- Mulk e’lonlari `title`, `description`, `image`, `price`, `location` va `type` (ijara/sotuv) bo‘yicha tuzilgan.
- Laravel validation va policylar yordamida xavfsizlik ta’minlangan.

---

## 👨‍💻 Muallif

**Doniyor Rustamov**  
📧 doniyor.ruswer@gmail.com  
🔗 GitHub: [@ruswer](https://github.com/ruswer)
