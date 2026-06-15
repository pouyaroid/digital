<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

   
  
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.rtl.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/all.css') }}">
    <style>
        @font-face {
            font-family: 'Vazir';
            src: url("{{ asset('assets/fonts/vazir/Vazir.woff2') }}") format('woff2'),
                 url("{{ asset('assets/fonts/vazir/Vazir.woff') }}") format('woff');
            font-weight: normal;
            font-style: normal;
        }
        :root {
        --primary-color: #27ae60; /* رنگ سبز اصلی */
        --primary-hover: #219150;
        --bg-color: #f3f4f6;
        --card-bg: #ffffff;
        --text-main: #1f2937;
        --text-muted: #6b7280;
        --border-color: #e5e7eb;
        --shadow-sm: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
        --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        font-family: 'Vazir';
    }

    .orders-wrapper {
        font-family: 'Vazir', sans-serif;
        padding: 24px;
        background-color: var(--bg-color);
        min-height: 100vh;
        direction: rtl;
    }

    /* Header Styles */
    .orders-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 24px;
    }

    .orders-header h2 {
        font-size: 24px;
        font-weight: 800;
        color: var(--text-main);
        margin: 0;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    /* Table Container (Card Style) */
    .table-container {
        background-color: var(--card-bg);
        border-radius: 12px;
        box-shadow: var(--shadow-sm);
        overflow: hidden; /* برای گرد کردن گوشه‌ها */
        border: 1px solid var(--border-color);
    }

    /* Table Styles */
    .orders-table {
        width: 100%;
        border-collapse: collapse;
        text-align: right;
    }

    .orders-table thead {
        background-color: var(--primary-color);
        color: #fff;
    }

    .orders-table th {
        padding: 16px;
        font-size: 14px;
        font-weight: 600;
        white-space: nowrap;
    }

    .orders-table td {
        padding: 16px;
        border-bottom: 1px solid var(--border-color);
        color: var(--text-main);
        font-size: 14px;
        vertical-align: top;
    }

    .orders-table tbody tr:last-child td {
        border-bottom: none;
    }

    .orders-table tbody tr:hover {
        background-color: #f9fafb;
        transition: background-color 0.2s;
    }

    /* Order Items List Styling */
    .order-items {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .order-items li {
        background-color: #f9fafb;
        padding: 8px 12px;
        border-radius: 6px;
        margin-bottom: 6px;
        font-size: 13px;
        display: flex;
        justify-content: space-between;
        border: 1px solid #eee;
    }
    
    .order-items li:last-child {
        margin-bottom: 0;
    }

    .item-name {
        font-weight: 600;
        color: var(--text-main);
    }

    .item-detail {
        color: var(--text-muted);
        font-size: 12px;
    }

    /* Empty State */
    .empty-state {
        text-align: center;
        padding: 60px 20px;
        color: var(--text-muted);
    }
    .empty-icon {
        font-size: 48px;
        margin-bottom: 16px;
        display: block;
        opacity: 0.5;
    }

    /* Pagination Styling (Override Bootstrap/Laravel Default) */
    .orders-pagination {
        margin-top: 24px;
        display: flex;
        justify-content: center;
        gap: 5px;
    }
    
    .orders-pagination a, 
    .orders-pagination span {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 36px;
        height: 36px;
        padding: 0 10px;
        border-radius: 8px;
        font-size: 14px;
        text-decoration: none;
        transition: all 0.2s;
        border: 1px solid var(--border-color);
        background-color: var(--card-bg);
        color: var(--text-main);
    }

    .orders-pagination a:hover {
        background-color: var(--bg-color);
        border-color: var(--text-muted);
    }

    .orders-pagination .active span {
        background-color: var(--primary-color);
        color: white;
        border-color: var(--primary-color);
    }

    /* ================= RESPONSIVE (MOBILE) ================= */
    @media (max-width: 768px) {
        .orders-wrapper {
            padding: 16px;
        }

        .orders-table,
        .orders-table thead,
        .orders-table tbody,
        .orders-table th,
        .orders-table td,
        .orders-table tr {
            display: block;
            width: 100%;
        }

        /* مخفی کردن هدر جدول در موبایل */
        .orders-table thead {
            display: none;
        }

        .orders-table tr {
            margin-bottom: 20px;
            border-radius: 12px;
            box-shadow: var(--shadow-md);
            background-color: var(--card-bg);
            border: 1px solid var(--border-color);
            overflow: hidden; /* برای اینکه سایز کارت از بیرون نزند */
        }

        .orders-table td {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            text-align: right;
            padding: 12px 16px;
            border-bottom: 1px solid #f3f4f6;
            position: relative;
            white-space: normal;
        }

        .orders-table td::before {
            content: attr(data-label);
            font-weight: 700;
            color: var(--text-muted);
            font-size: 13px;
            margin-left: 12px;
            min-width: 80px;
        }

        /* بهبود نمایش ستون آیتم‌ها در موبایل */
        .orders-table td[data-label="آیتم‌ها"] {
            display: block;
            flex-direction: column;
        }
        
        .orders-table td[data-label="آیتم‌ها"]::before {
            margin-bottom: 8px;
            display: block;
        }
        
        /* استایل خاص برای اخرین کارت */
        .orders-table tr:last-child {
            margin-bottom: 0;
        }
    }
</style>