# 🍵 کافه آریا - منوی آنلاین

**Cafe Arya - Online Menu System**

یک وب‌اپلیکیشن مدرن و ریسپانسیو برای نمایش منوی کافه با قابلیت سفارش آنلاین

A modern and responsive web application for displaying cafe menu with online ordering capabilities

## ✨ ویژگی‌ها / Features

### 🎨 طراحی و رابط کاربری / Design & UI
- **طراحی مدرن و زیبا** - Modern and beautiful design
- **رنگ‌بندی مناسب کافه** - Cafe-appropriate color scheme (cream brown)
- **انیمیشن‌های نرم** - Smooth animations and transitions
- **ریسپانسیو کامل** - Fully responsive design
- **فونت‌های فارسی** - Persian fonts (Tajawal, Cairo)

### 🛒 قابلیت‌های سفارش / Ordering Features
- **سبد خرید شناور** - Floating shopping cart
- **مدال جزئیات سفارش** - Order details modal
- **مدال تأیید سفارش** - Order confirmation modal
- **محاسبه خودکار قیمت** - Automatic price calculation
- **مالیات و کارمزد** - Tax and service charge calculation

### 📱 تجربه کاربری / User Experience
- **جستجوی محصولات** - Product search functionality
- **فیلتر بر اساس دسته‌بندی** - Category-based filtering
- **نمایش وضعیت موجودی** - Stock status display
- **دکمه‌های تعاملی** - Interactive buttons
- **بارگذاری نرم** - Smooth loading states

## 🚀 نصب و راه‌اندازی / Installation

### پیش‌نیازها / Prerequisites
- مرورگر مدرن / Modern web browser
- سرور محلی (اختیاری) / Local server (optional)

### مراحل نصب / Installation Steps



1. **باز کردن فایل** / Open the file
```bash
# روش 1: باز کردن مستقیم در مرورگر
# Method 1: Open directly in browser
open index.html

# روش 2: استفاده از سرور محلی
# Method 2: Using local server
python -m http.server 8000
# سپس باز کردن http://localhost:8000
# Then open http://localhost:8000
```

## 📁 ساختار پروژه / Project Structure

```
cafe-menu/
├── index.html          # فایل اصلی HTML / Main HTML file
├── style.css           # استایل‌های CSS / CSS styles
├── script.js           # منطق JavaScript / JavaScript logic
├── images/             # تصاویر محصولات / Product images
│   ├── espresso.jpg
│   ├── cappuccino.jpg
│   ├── latte.jpg
│   └── ...
└── README.md           # مستندات پروژه / Project documentation
```

## 🎯 نحوه استفاده / How to Use

### برای مشتریان / For Customers
1. **انتخاب دسته‌بندی** - Choose a category
2. **مشاهده محصولات** - Browse products
3. **افزودن به سبد** - Add to cart
4. **مشاهده جزئیات** - View order details
5. **ثبت سفارش** - Place order

### برای مدیران / For Administrators
1. **ویرایش محصولات** - Edit products in `script.js`
2. **تغییر قیمت‌ها** - Modify prices
3. **اضافه کردن محصولات جدید** - Add new products
4. **تنظیم مالیات** - Configure tax rates

## 🛠️ فناوری‌های استفاده شده / Technologies Used

- **HTML5** - ساختار صفحه / Page structure
- **CSS3** - استایل و انیمیشن / Styling and animations
- **JavaScript (ES6+)** - منطق برنامه / Application logic
- **Google Fonts** - فونت‌های فارسی / Persian fonts
- **SVG Icons** - آیکون‌های برداری / Vector icons

## 🎨 ویژگی‌های طراحی / Design Features

### رنگ‌بندی / Color Scheme
- **رنگ اصلی**: قهوه‌ای کرم / Primary: Cream brown
- **رنگ ثانویه**: قهوه‌ای تیره / Secondary: Dark brown
- **رنگ پس‌زمینه**: سفید / Background: White
- **رنگ متن**: خاکستری تیره / Text: Dark gray

### انیمیشن‌ها / Animations
- **slideUp** - ورود سبد خرید / Cart entrance
- **modalSlideIn** - ورود مدال‌ها / Modal entrance
- **bounce** - انیمیشن موفقیت / Success animation
- **glow** - درخشش عنوان / Title glow effect

## 📱 ریسپانسیو / Responsive Design

### نقاط شکست / Breakpoints
- **Desktop**: > 768px
- **Tablet**: 768px - 480px
- **Mobile**: < 480px

### ویژگی‌های موبایل / Mobile Features
- **منوی عمودی** - Vertical navigation
- **مدال‌های تمام عرض** - Full-width modals
- **دکمه‌های بزرگ‌تر** - Larger touch targets
- **اسکرول نرم** - Smooth scrolling

## 🔧 تنظیمات / Configuration

### تغییر محصولات / Modifying Products
```javascript
// در فایل script.js
const menuItems = [
    {
        id: 1,
        name: "اسپرسو کلاسیک",
        price: 35000,
        category: "coffee",
        description: "قهوه خالص و قوی",
        image: "images/espresso.jpg",
        available: true
    }
    // اضافه کردن محصولات بیشتر
    // Add more products
];
```

### تنظیم مالیات / Tax Configuration
```javascript
const TAX_RATE = 0.09; // 9% مالیات / 9% tax
const SERVICE_CHARGE = 0.05; // 5% کارمزد / 5% service charge
```

## 🐛 عیب‌یابی / Troubleshooting

### مشکلات رایج / Common Issues

1. **تصاویر نمایش داده نمی‌شوند** / Images not loading
   - بررسی مسیر فایل‌ها / Check file paths
   - اطمینان از وجود پوشه images / Ensure images folder exists

2. **فونت‌ها بارگذاری نمی‌شوند** / Fonts not loading
   - بررسی اتصال اینترنت / Check internet connection
   - بررسی لینک Google Fonts / Check Google Fonts link

3. **مدال‌ها باز نمی‌شوند** / Modals not opening
   - بررسی JavaScript console / Check JavaScript console
   - اطمینان از بارگذاری کامل صفحه / Ensure page fully loaded



