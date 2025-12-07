<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Tentang Aplikasi</title>
    @include('layouts.css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        .module-card {
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .module-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 15px 25px -5px rgba(0, 0, 0, 0.2);
        }

        .decorative-icon {
            opacity: 0.1;
            font-size: 5rem;
            position: absolute;
            top: 10px;
            right: 10px;
        }

        .fab-whatsapp {
            position: fixed;
            width: 60px;
            height: 60px;
            bottom: 30px;
            right: 30px;
            background-color: #25d366;
            color: #FFF;
            border-radius: 50%;
            text-align: center;
            box-shadow: 2px 2px 3px #999;
            z-index: 1000;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
        }

        .fab-whatsapp:hover {
            background-color: #128c7e;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
        }

        .fab-whatsapp i {
            font-size: 28px;
        }
    </style>
</head>

<body class="m-0 font-sans text-base antialiased font-normal leading-default bg-gray-50 text-slate-500">

    @include('layouts.header')

    <main class="relative h-full max-h-screen transition-all duration-200 ease-in-out xl:ml-68 rounded-xl">

        <nav class="relative flex flex-wrap items-center justify-between px-0 py-2 mx-6 transition-all ease-in shadow-none duration-250 rounded-2xl lg:flex-nowrap lg:justify-start bg-transparent"
            navbar-main navbar-scroll="false">
            <div class="flex items-center justify-between w-full px-4 py-1 mx-auto flex-wrap-inherit">
                <nav>
                    <ol class="flex flex-wrap pt-1 mr-12 bg-transparent rounded-lg sm:mr-16">
                        <li class="text-sm leading-normal">
                            <a class="text-slate-500" href="javascript:;">Pages</a>
                        </li>
                        <li class="text-sm pl-2 capitalize leading-normal text-slate-700 before:float-left before:pr-2 before:text-slate-500 before:content-['/']"
                            aria-current="page">Tentang Aplikasi</li>
                    </ol>
                    <h6 class="mb-0 font-bold text-slate-700 capitalize">Tentang Aplikasi Posyandu</h6>
                </nav>
            </div>
        </nav>

        <div class="w-full px-6 py-6 mx-auto">
            <div class="flex flex-wrap -mx-3">
                <div class="w-full max-w-full px-3">
                    <div
                        class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-xl rounded-2xl bg-clip-border p-8">

                        <div class="text-center mb-10">
                            <i class="fas fa-tools text-5xl text-pink-500 mb-3"></i>
                            <h1 class="text-2xl font-extrabold mb-2 text-slate-800">Sistem Informasi Posyandu</h1>
                            <p class="text-sm leading-relaxed text-slate-600 max-w-3xl mx-auto">
                                Aplikasi ini dirancang untuk mempermudah pengelolaan data Posyandu, termasuk pendataan
                                warga dan layanan kesehatan. Data tersimpan dengan rapi, aman, dan mudah diakses.
                            </p>
                        </div>

                        <h2 class="text-xl font-bold mb-6 text-slate-800 border-b pb-2 border-slate-100">Modul Utama &
                            Tujuan</h2>
                        <div class="flex flex-wrap -mx-3 mb-8">

                            <div class="w-full lg:w-1/3 max-w-full px-3 mb-6">
                                <div
                                    class="module-card bg-white p-6 rounded-xl text-slate-700 border-t-4 border-pink-500 shadow-md">
                                    <i class="fas fa-tags text-2xl mb-3 text-pink-500"></i>
                                    <h3 class="font-bold text-lg mb-2">1. Manajemen Data Warga</h3>
                                    <p class="text-sm leading-relaxed text-slate-600">
                                        Modul ini mencatat data pokok warga termasuk NIK, nama, alamat, dan kontak.
                                        Memudahkan administrasi internal Posyandu.
                                    </p>
                                    <i class="fas fa-layer-group decorative-icon text-pink-200"></i>
                                </div>
                            </div>

                            <div class="w-full lg:w-1/3 max-w-full px-3 mb-6">
                                <div
                                    class="module-card bg-white p-6 rounded-xl text-slate-700 border-t-4 border-pink-500 shadow-md">
                                    <i class="fas fa-boxes text-2xl mb-3 text-pink-500"></i>
                                    <h3 class="font-bold text-lg mb-2">2. Layanan Posyandu</h3>
                                    <p class="text-sm leading-relaxed text-slate-600">
                                        Modul inti untuk mencatat layanan kesehatan, pengukuran berat & tinggi, vitamin,
                                        dan konseling untuk setiap warga.
                                    </p>
                                    <i class="fas fa-clipboard-list decorative-icon text-pink-200"></i>
                                </div>
                            </div>

                            <div class="w-full lg:w-1/3 max-w-full px-3 mb-6">
                                <div
                                    class="module-card bg-white p-6 rounded-xl text-slate-700 border-t-4 border-pink-500 shadow-md">
                                    <i class="fas fa-heart text-2xl mb-3 text-pink-500"></i>
                                    <h3 class="font-bold text-lg mb-2">3. Laporan & Monitoring</h3>
                                    <p class="text-sm leading-relaxed text-slate-600">
                                        Modul untuk melihat riwayat layanan, laporan bulanan, dan monitoring kesehatan
                                        warga secara menyeluruh.
                                    </p>
                                    <i class="fas fa-chart-line decorative-icon text-pink-200"></i>
                                </div>
                            </div>
                        </div>

                        <h2 class="text-xl font-bold mb-4 text-slate-800 border-b pb-2 border-slate-100">Alur Kerja
                            Sistem</h2>
                        <div class="relative mb-8 p-6 bg-gray-50 rounded-xl shadow-inner">
                            <div class="flex items-start mb-4">
                                <span
                                    class="bg-pink-500 text-white rounded-full h-8 w-8 flex items-center justify-center text-sm font-bold mr-3 flex-shrink-0">1</span>
                                <div>
                                    <p class="font-semibold text-slate-700">Input Data Warga</p>
                                    <p class="text-sm text-slate-600">Pengguna memasukkan data dasar warga.</p>
                                </div>
                            </div>
                            <div class="flex items-start mb-4">
                                <span
                                    class="bg-pink-500 text-white rounded-full h-8 w-8 flex items-center justify-center text-sm font-bold mr-3 flex-shrink-0">2</span>
                                <div>
                                    <p class="font-semibold text-slate-700">Layanan Posyandu</p>
                                    <p class="text-sm text-slate-600">Setiap warga mendapatkan layanan kesehatan sesuai
                                        jadwal.</p>
                                </div>
                            </div>
                            <div class="flex items-start">
                                <span
                                    class="bg-pink-500 text-white rounded-full h-8 w-8 flex items-center justify-center text-sm font-bold mr-3 flex-shrink-0">3</span>
                                <div>
                                    <p class="font-semibold text-slate-700">Monitoring & Laporan</p>
                                    <p class="text-sm text-slate-600">Riwayat layanan dan kesehatan warga dapat
                                        dimonitor dan dievaluasi.</p>
                                </div>
                            </div>
                        </div>

                        <div class="mt-4 border-t border-slate-100 pt-4 text-center">
                            <p class="text-xs text-slate-400">
                                Dibangun dengan Laravel Framework | Hak Cipta &copy; 2025
                            </p>
                        </div>

                    </div>
                </div>
            </div>

            @include('layouts.footer')
        </div>
    </main>

    @include('layouts.js')
</body>

</html>
