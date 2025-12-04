<script src="https://cdn.tailwindcss.com"></script>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<style>
    /* Konfigurasi Warna Tailwind Custom untuk AppVilla/Posyandu */
    :root {
        --color-pink-500: #EC4899;
        /* Pink Utama (Main) */
        --color-pink-600: #DB2777;
        /* Pink Gelap (Dark) */
        --color-pink-400: #F472B6;
        /* Pink Lebih Terang */
        --color-bg: #FDF2F8;
        /* Latar Belakang Sangat Terang */
    }

    body {
        font-family: 'Inter', sans-serif;
        background-color: var(--color-bg);
    }

    /* --- 1. HERO SECTION STYLE --- */
    .appvilla-hero {
        background: linear-gradient(135deg, var(--color-pink-600) 0%, var(--color-pink-400) 100%);
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.2);
        min-height: 250px;
        /* Dikecilkan sedikit untuk menghemat ruang */
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
        overflow: hidden;
    }

    .hero-bg-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-image: radial-gradient(circle at 100% 100%, rgba(255, 255, 255, 0.1) 0%, transparent 70%);
    }

    .text-shadow-hero {
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
    }

    /* Animasi Jantung/Bayi */
    .animate-pulse-slow {
        animation: pulse-slow 4s infinite cubic-bezier(0.4, 0, 0.6, 1);
    }

    @keyframes pulse-slow {

        0%,
        100% {
            opacity: 1;
        }

        50% {
            opacity: .7;
        }
    }

    /* --- 2. BUTTON STYLE --- */
    .appvilla-btn {
        background-color: white !important;
        color: var(--color-pink-600) !important;
        font-weight: 600 !important;
        padding: 0.75rem 2rem !important;
        box-shadow: 0 8px 15px rgba(255, 255, 255, 0.3);
        transition: all 0.3s;
    }

    .appvilla-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 20px rgba(255, 255, 255, 0.4);
    }

    /* --- 3. WIDGET STYLE --- */
    .widget-card {
        transition: transform 0.3s, box-shadow 0.3s;
        border-bottom-width: 5px;
        border-bottom-style: solid;
    }

    .widget-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
    }

    .icon-circle {
        width: 50px;
        height: 50px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        color: white;
        font-size: 1.5rem;
    }

    /* --- 4. LIST CARD STYLE --- */
    .list-card {
        transition: transform 0.3s, box-shadow 0.3s;
        border-left: 5px solid var(--color-pink-500);
    }

    .list-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.08);
    }

    .measurement-box {
        background: linear-gradient(90deg, #F472B6 0%, #EC4899 100%);
        box-shadow: 0 5px 15px rgba(236, 72, 153, 0.4);
    }

    .measurement-box h3 {
        font-size: 2rem;
    }

    /* SOLUSI FAB WHATSAPP (Tombol yang Hilang) */
    .fab-whatsapp {
        position: fixed;
        bottom: 20px;
        /* Jarak dari bawah */
        right: 20px;
        /* Jarak dari kanan */
        width: 50px;
        /* Ukuran tombol */
        height: 50px;
        background-color: #25D366;
        /* Warna hijau WhatsApp */
        color: white;
        border-radius: 50%;
        /* Bentuk lingkaran */
        text-align: center;
        box-shadow: 2px 2px 3px rgba(0, 0, 0, 0.4);
        display: flex;
        /* Untuk memusatkan ikon */
        align-items: center;
        justify-content: center;
        font-size: 24px;
        /* Ukuran ikon */
        z-index: 1000;
        /* Pastikan tombol di atas elemen lain */
        transition: transform 0.3s ease;
    }

    .fab-whatsapp:hover {
        transform: scale(1.1);
        /* Efek saat disentuh kursor */
    }
</style>
