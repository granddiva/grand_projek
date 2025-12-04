<script type="module">
    import {
        initializeApp
    } from "https://www.gstatic.com/firebasejs/11.6.1/firebase-app.js";
    import {
        getAuth,
        signInAnonymously,
        signInWithCustomToken
    } from "https://www.gstatic.com/firebasejs/11.6.1/firebase-auth.js";
    import {
        getFirestore,
        collection,
        query,
        onSnapshot,
        addDoc, // Ditambahkan: untuk fungsi Create
        setLogLevel
    } from "https://www.gstatic.com/firebasejs/11.6.1/firebase-firestore.js";

    // --- Variabel Global Wajib ---
    const appId = typeof __app_id !== 'undefined' ? __app_id : 'default-app-id';
    const firebaseConfig = typeof __firebase_config !== 'undefined' ? JSON.parse(__firebase_config) : {};
    const initialAuthToken = typeof __initial_auth_token !== 'undefined' ? __initial_auth_token : null;

    let db, auth;
    let userId = 'unknown';

    // --- FUNGSI UTILITY UI ---

    // Fungsi Simulasi Alert/Confirm (Wajib, karena alert() dilarang)
    window.showAlert = function(message, title = 'Pemberitahuan') {
        document.getElementById('modal-title').textContent = title;
        document.getElementById('modal-message').textContent = message;
        document.getElementById('custom-modal').classList.remove('hidden');
    }

    window.closeModal = function() {
        document.getElementById('custom-modal').classList.add('hidden');
    }

    // Fungsi untuk mengontrol tampilan (Dashboard atau Form)
    window.switchView = function(viewName) {
        const dashboardView = document.getElementById('dashboard-view');
        const formView = document.getElementById('form-view');

        if (viewName === 'form') {
            dashboardView.classList.add('hidden');
            formView.classList.remove('hidden');
            // Set ID Warga default yang unik untuk mempermudah testing
            document.getElementById('warga_id').value = `BAYI-${Math.floor(Math.random() * 1000)}`;
            // Bersihkan form setiap beralih ke form view
            document.getElementById('layanan-form').reset();
        } else {
            dashboardView.classList.remove('hidden');
            formView.classList.add('hidden');
        }
    }

    window.cancelForm = function() {
        document.getElementById('layanan-form').reset();
        switchView('dashboard');
    }

    // --- FIREBASE INITIALIZATION & AUTHENTICATION ---
    async function setupFirebase() {
        try {
            if (Object.keys(firebaseConfig).length === 0) {
                throw new Error("Firebase config not available. Cannot connect to Firestore.");
            }

            const app = initializeApp(firebaseConfig);
            db = getFirestore(app);
            auth = getAuth(app);
            setLogLevel('Debug'); // Untuk melihat log di konsol

            let userCredential;
            if (initialAuthToken) {
                userCredential = await signInWithCustomToken(auth, initialAuthToken);
            } else {
                userCredential = await signInAnonymously(auth);
            }

            userId = userCredential.user.uid;
            document.getElementById('user-id-display').textContent = userId;

            // Setelah autentikasi berhasil, mulai mendengarkan data dan tampilkan dashboard
            fetchLayananRealtime();
            switchView('dashboard'); // Pastikan tampilan awal adalah dashboard

        } catch (error) {
            console.error("Kesalahan Setup Firebase atau Otentikasi:", error);
            document.getElementById('user-id-display').textContent = 'AUTH FAILED';
            showAlert(`Gagal terhubung ke database. Cek konsol untuk detail kesalahan. (${error.message})`);
            // Render tampilan kosong atau data dummy jika gagal total
            renderWidgets({
                totalLayanan: 0,
                avgBerat: '0.0',
                avgTinggi: '0',
                uniqueWarga: 0
            });
            renderLayananList([]);
        }
    }

    // --- FIRESTORE CREATE (C) FUNCTION ---

    window.saveLayanan = async function() {
        const form = document.getElementById('layanan-form');
        const saveButton = document.getElementById('save-button');

        // Pengambilan data dari form
        const warga_id = form.warga_id.value.trim();
        const berat = parseFloat(form.berat.value);
        const tinggi = parseInt(form.tinggi.value);
        const vitamin = form.vitamin.value;
        const konseling = form.konseling.value.trim() || 'Tidak ada catatan konseling.';

        // Validasi dasar
        if (!warga_id || isNaN(berat) || berat <= 0 || isNaN(tinggi) || tinggi <= 0) {
            showAlert('Mohon isi ID Warga, Berat Badan, dan Tinggi Badan dengan benar.');
            return;
        }

        const dataLayanan = {
            warga_id: warga_id,
            berat: berat,
            tinggi: tinggi,
            vitamin: vitamin,
            konseling: konseling,
            timestamp: Date.now(), // Tambahkan timestamp untuk pengurutan
            jadwal_id: 'JDL-' + new Date().toISOString().slice(0, 10).replace(/-/g,
                '') // ID Jadwal simulasi
        };

        // Nonaktifkan tombol saat menyimpan
        saveButton.disabled = true;
        saveButton.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i> Menyimpan...';

        try {
            // Path koleksi pribadi wajib: /artifacts/{appId}/users/{userId}/layanans
            const layananColRef = collection(db, `artifacts/${appId}/users/${userId}/layanans`);

            await addDoc(layananColRef, dataLayanan);

            showAlert('Data layanan Posyandu berhasil dicatat!', 'Sukses');
            form.reset(); // Kosongkan form setelah sukses
            switchView('dashboard'); // Kembali ke dashboard

        } catch (error) {
            console.error("Kesalahan saat menyimpan data:", error);
            showAlert(`Gagal menyimpan data: ${error.message}`, 'Kesalahan Simpan');
        } finally {
            // Aktifkan kembali tombol
            saveButton.disabled = false;
            saveButton.innerHTML = '<i class="fas fa-save mr-2"></i> Simpan Data Layanan';
        }
    }


    // --- FIRESTORE READ (R) REAL-TIME DATA FETCHER (onSnapshot) ---
    function fetchLayananRealtime() {
        // Path koleksi pribadi wajib: /artifacts/{appId}/users/{userId}/layanans
        const layananColRef = collection(db, `artifacts/${appId}/users/${userId}/layanans`);

        // onSnapshot akan dipanggil setiap kali ada perubahan data
        onSnapshot(layananColRef, (snapshot) => {
            const layanans = [];
            snapshot.forEach(doc => {
                // Ambil data dan tambahkan ID dokumen
                layanans.push({
                    id: doc.id,
                    ...doc.data()
                });
            });

            // Urutkan berdasarkan timestamp terbaru (DESC)
            layanans.sort((a, b) => (b.timestamp || 0) - (a.timestamp || 0));

            console.log(`Data Layanan Diterima: ${layanans.length} dokumen.`);

            // Update UI
            const stats = calculateStatistics(layanans);
            renderWidgets(stats);
            renderLayananList(layanans);
        }, (error) => {
            console.error("Kesalahan Mendengarkan Data Firestore:", error);
            showAlert(`Gagal mengambil data real-time: ${error.message}`, 'Kesalahan Data');
        });
    }

    // --- LOGIC PERHITUNGAN DAN RENDERING ---

    // Fungsi untuk menghitung statistik
    function calculateStatistics(data) {
        const totalLayanan = data.length;
        const totalBerat = data.reduce((sum, item) => sum + (item.berat || 0), 0);
        const totalTinggi = data.reduce((sum, item) => sum + (item.tinggi || 0), 0);

        const avgBerat = totalLayanan > 0 ? (totalBerat / totalLayanan).toFixed(1) : '0.0';
        const avgTinggi = totalLayanan > 0 ? Math.round(totalTinggi / totalLayanan) : '0';

        // Menghitung jumlah warga unik
        const uniqueWarga = new Set(data.map(l => l.warga_id)).size;

        return {
            totalLayanan,
            avgBerat,
            avgTinggi,
            uniqueWarga
        };
    }

    // Data konfigurasi widget
    function getWidgetData(stats) {
        return [{
                title: 'Total Layanan',
                value: stats.totalLayanan,
                unit: 'Data',
                icon: 'fas fa-clipboard-list',
                color: 'pink-500'
            },
            {
                title: 'Rata-rata Berat',
                value: stats.avgBerat,
                unit: 'Kg',
                icon: 'fas fa-weight-hanging',
                color: 'green-500'
            },
            {
                title: 'Rata-rata Tinggi',
                value: stats.avgTinggi,
                unit: 'Cm',
                icon: 'fas fa-ruler-vertical',
                color: 'blue-500'
            },
            {
                title: 'Warga Unik',
                value: stats.uniqueWarga,
                unit: 'Orang',
                icon: 'fas fa-users',
                color: 'amber-500'
            },
        ];
    }

    // Fungsi untuk merender Widget
    function renderWidgets(stats) {
        const container = document.getElementById('widget-container');
        const widgets = getWidgetData(stats);

        container.innerHTML = widgets.map(widget => {
            const borderColor = `border-${widget.color}`;
            const iconBg = `bg-${widget.color}`;
            const textColor = `text-${widget.color}`;

            // Penanganan warna kustom (Pink)
            const customColor = widget.color === 'pink-500' ? 'border-[--color-pink-500]' : borderColor;
            const customBg = widget.color === 'pink-500' ? 'bg-[--color-pink-600]' : iconBg;
            const customText = widget.color === 'pink-500' ? 'text-[--color-pink-600]' : textColor;

            return `
                    <div class="widget-card bg-white p-6 rounded-xl shadow-lg ${customColor}">
                        <div class="flex items-center">
                            <div class="flex-grow">
                                <div class="text-sm font-semibold uppercase mb-1 ${customText}">
                                    ${widget.title}
                                </div>
                                <div class="text-4xl font-extrabold text-gray-800">
                                    ${widget.value}
                                    <span class="text-base font-normal text-gray-500">${widget.unit}</span>
                                </div>
                            </div>
                            <div class="icon-circle ${customBg}">
                                <i class="${widget.icon}"></i>
                            </div>
                        </div>
                    </div>
                `;
        }).join('');
    }

    // Fungsi untuk merender Daftar Layanan
    function renderLayananList(layanans) {
        const container = document.getElementById('layanan-list');
        const emptyState = document.getElementById('empty-state');
        const listTitle = document.getElementById('list-title');

        listTitle.innerHTML =
            `<i class="fas fa-notes-medical mr-2 text-pink-500"></i> Catatan Layanan Terbaru (${layanans.length} Data)`;

        if (layanans.length === 0) {
            container.innerHTML = '';
            emptyState.classList.remove('hidden');
            return;
        }

        emptyState.classList.add('hidden');

        container.innerHTML = layanans.map(layanan => {
            // Pastikan data numerik diubah ke string yang sesuai jika perlu, dan berikan fallback default
            const berat = (layanan.berat || 0).toFixed(1);
            const tinggi = layanan.tinggi || 'N/A';
            const vitamin = layanan.vitamin || 'Belum Dicatat';
            const konseling = layanan.konseling || 'Tidak ada catatan konseling yang diberikan.';

            const vitaminBadgeClass = (vitamin === 'Vitamin A' || vitamin === 'Vitamin D') ?
                'bg-emerald-100 text-emerald-700' :
                'bg-amber-100 text-amber-700';

            return `
                    <div class="list-card bg-white p-6 shadow-xl rounded-xl h-full flex flex-col justify-between">
                        <div>
                            <div class="flex justify-between items-center pb-3 border-b border-gray-100 mb-4">
                                <h4 class="text-lg font-bold text-gray-800">Balita: ${layanan.warga_id || 'N/A'}</h4>
                                <span class="text-xs font-medium text-gray-400">ID: #${layanan.id}</span>
                            </div>

                            <div class="measurement-box p-4 rounded-lg text-white mb-4">
                                <div class="flex justify-around text-center">
                                    <div>
                                        <h3 class="font-extrabold mb-0">${berat}</h3>
                                        <small class="font-semibold block">Berat (kg)</small>
                                    </div>
                                    <div class="w-px bg-white/50 mx-4"></div>
                                    <div>
                                        <h3 class="font-extrabold mb-0">${tinggi}</h3>
                                        <small class="font-semibold block">Tinggi (cm)</small>
                                    </div>
                                </div>
                            </div>

                            <div class="space-y-3 mb-5">
                                <p class="text-sm text-gray-600"><i class="fas fa-calendar-alt text-pink-500 mr-2"></i>
                                    <span class="font-medium">Jadwal ID:</span> ${layanan.jadwal_id || 'N/A'}
                                </p>
                                <p class="text-sm text-gray-600"><i class="fas fa-pills text-pink-500 mr-2"></i>
                                    <span class="font-medium">Vitamin:</span>
                                    <span class="px-2 py-1 text-xs font-bold rounded-full ${vitaminBadgeClass}">
                                        ${vitamin}
                                    </span>
                                </p>
                            </div>

                            <div class="mb-4">
                                <p class="text-xs font-semibold text-gray-700 uppercase mb-1">Catatan Konseling:</p>
                                <p class="text-sm text-gray-600 italic line-clamp-2">${konseling}</p>
                            </div>

                        </div>
                        </div>
                `;
        }).join('');
    }

    // --- EXECUTION ---
    document.addEventListener('DOMContentLoaded', setupFirebase);
</script>
