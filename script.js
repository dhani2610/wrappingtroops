// Ambil elemen tombol
let mybutton = document.getElementById("btnBackToTop");

// Saat pengguna scroll ke bawah 20px dari puncak dokumen, munculkan tombol
window.onscroll = function() {scrollFunction()};

function scrollFunction() {
  if (document.body.scrollTop > 200 || document.documentElement.scrollTop > 200) {
    mybutton.style.display = "block";
  } else {
    mybutton.style.display = "none";
  }
}

// Saat tombol diklik, scroll kembali ke atas
mybutton.addEventListener("click", function() {
    // Scroll halus untuk browser modern
    window.scrollTo({top: 0, behavior: 'smooth'});
});
document.addEventListener("DOMContentLoaded", function() {
    
    // 1. DAFTAR SEMUA FILE GAMBAR DARI PATH ANDA
    // Path dasar sesuai struktur folder Anda
    const basePath = "assets/fe/portofolio/";

    // Array berisi nama file persis seperti di screenshot Anda.
    // NOTE: File .mp4 dan .HEIC dikomentari karena tidak support di tag <img> standar.
    const portfolioImagesList = [
        "2023_06_01_17_13_IMG_8545.JPG",
        "2023_06_01_17_20_IMG_8563.JPG",
        "20180406_203149.jpg",
        "20180406_203603.jpg",
        "20180413_153623.jpg",
        "20180705_190910.jpg",
        "20180803_201524.jpg",
        "20180812_162214.jpg",
        "20180812_162228.jpg",
        "20180829_173550.jpg",
        "20190205_150756.jpg",
        "20190210_113653.jpg",
        "20190226_111854.jpg",
        "20190811_174115.jpg",
        "20190816_002924.jpg",
        "20190816_014956.jpg",
        "20200809_175112.jpg",
        "20200815_125307.jpg",
        "20200822_165214.jpg",
        "20200923_172525.jpg",
        "20201205_151617.jpg",
        "20210103_132017.jpg",
        "20210323_173203.jpg",
        "20220210_172331.jpg",
        "20220215_182551.jpg",
        "20220215_182556.jpg",
        // "20220325_000408.jpg", // File tidak terlihat jelas ekstensinya di gambar, asumsikan jpg
        // "20220325_000428.mp4", // VIDEO - Tidak akan muncul di tag img
        "C360_2014-03-16-17-33-53-456.jpg",
        "combi lime 1.jpg",
        "DSC03963.JPG",
        "DSC03966.JPG",
        "DSC04136.JPG",
        "DSC04140.JPG",
        "DSC04145.JPG",
        "DSC04148.JPG",
        "DSC04150.JPG",
        "DSC04168.JPG",
        "DSC06725.JPG",
        "DSC06766.JPG",
        "DSC07361.JPG",
        "DSC07475.JPG",
        "DSC07854.JPG",
        // "IMG_0116.HEIC", // HEIC Format iPhone - Tidak support browser standar
        // "IMG_0116.JPG", // Jika ada versi JPG nya, uncomment ini
        // "IMG_0151.HEIC", // HEIC Format iPhone
        "IMG_0151.jpg",
        "IMG_5496.JPG",
        "IMG_20161101_113331.jpg",
        "IMG_20161101_165131.jpg",
        "IMG_20161123_141500.jpg",
        "IMG_20171126_023326.jpg",
        "IMG_20171207_173720.jpg",
        "IMG_20170204-WA0018.jpg",
        "IMG-20170204-WA0046.jpg",
        "IMG-20210912-WA0037.jpg",
        "IMG-20210912-WA0041.jpg",
        "IMG-20211215-WA0001.jpg",
        "IMG-20211215-WA0003.jpg",
        "IMG-20220119-WA0007.jpg",
        "IMG-20220126-WA0009.jpg",
        "IMG-20220530-WA0041.jpg",
        "IMG-20220530-WA0056.jpg",
        "IMG-20220530-WA0072.jpg",
        "IMG-20220602-WA0098.jpg",
        "IMG-20220603-WA0001.jpg",
        "IMG-20220604-WA0000.jpg",
        "Klien UMKM.jpg",
        "Screenshot_20180921-135205_1.png",
        "Team.jpg"
    ];

    // Seleksi semua elemen gambar di grid
    const gridImages = document.querySelectorAll('.portfolio-grid-img');

    // Fungsi untuk mendapatkan URL gambar acak dari list
    function getRandomImageUrl() {
        const randomIndex = Math.floor(Math.random() * portfolioImagesList.length);
        return basePath + portfolioImagesList[randomIndex];
    }

    // Fungsi untuk mengganti gambar pada elemen tertentu dengan efek fade
    function swapImage(imgElement) {
        // 1. Fade Out: Hapus class active agar opacity jadi 0
        imgElement.classList.remove('fade-in-active');

        // Tunggu sebentar (500ms sesuai durasi transisi CSS) sampai fade out selesai
        setTimeout(() => {
            // 2. Ganti Source Gambar
            imgElement.src = getRandomImageUrl();
            
            // 3. Fade In: Tambahkan kembali class active agar opacity jadi 1
            // Menggunakan setTimeout kecil untuk memastikan browser mendeteksi perubahan DOM
            setTimeout(() => {
                 imgElement.classList.add('fade-in-active');
            }, 50);
        }, 500); 
    }


    // --- INISIALISASI & PENGATURAN INTERVAL ---

    // Loop melalui setiap sel gambar di grid (total 9)
    gridImages.forEach((img, index) => {
        // A. Pengisian Awal: Isi semua kotak dengan gambar acak saat loading
        img.src = getRandomImageUrl();
        // Beri sedikit delay pada pengisian awal agar efek munculnya berurutan cantik
        setTimeout(() => {
             img.classList.add('fade-in-active');
        }, index * 100);


        // B. Pengaturan Interval Swapping
        const minDelay = 3000;
        const maxDelay = 7000;
        const randomDelay = Math.floor(Math.random() * (maxDelay - minDelay + 1) + minDelay);
        
        // Set interval unik untuk setiap gambar
        setInterval(() => {
            swapImage(img);
        }, randomDelay);
    });

    // Navbar Scroll Effect
    window.addEventListener('scroll', function() {
        const navbar = document.querySelector('.wt-navbar-redesign');
        if (window.scrollY > 50) {
            navbar.classList.add('wt-navbar-scrolled');
        } else {
            navbar.classList.remove('wt-navbar-scrolled');
        }
    });
});
document.addEventListener("DOMContentLoaded", function() {
    
    const videoContainer = document.querySelector('.intro-video-container');
    const introLogo = document.querySelector('.intro-logo');
    const scrollTrigger = document.querySelector('.intro-scroll-trigger');
    const navbar = document.querySelector('.wt-navbar-redesign');
    const contentWrapper = document.getElementById('main-content-wrapper'); 

    // HITUNG SKALA MAKSIMAL SECARA DINAMIS
    // Agar tidak berat, kita hitung berapa scale yg pas untuk menutupi layar
    // Rumus: Lebar Layar dibagi Lebar Video (ditambah sedikit margin biar aman)
    const baseWidth = videoContainer.offsetWidth;
    const maxScaleNeeded = (window.innerWidth / baseWidth) * 1.5; 
    
    // Batasi minimal 15x dan maksimal 25x untuk keamanan performa
    const finalMaxScale = Math.min(Math.max(maxScaleNeeded, 15), 25);

    window.addEventListener('scroll', function() {
        let scrollY = window.scrollY;
        let windowHeight = window.innerHeight;
        let scrollRatio = scrollY / windowHeight;

        // --- 1. LOGIKA ZOOM (Smooth & Ringan) ---
        if (scrollRatio <= 1.5) {
            // Hitung scale berdasarkan scroll
            // Kita pakai finalMaxScale agar pas menutup layar
            let scaleValue = 1 + (scrollRatio * (finalMaxScale - 1));
            
            // KUNCI PENTING:
            // Jika scrollRatio masih 0 (baru buka), biarkan CSS Animation yang bekerja (translateX)
            // Jika user mulai scroll, baru JS ambil alih transformnya.
            if (scrollY > 5) {
                videoContainer.style.transform = `scale(${scaleValue})`;
            } else {
                // Reset transform agar animasi CSS 'slideInFromLeft' tidak bentrok saat di posisi paling atas
                videoContainer.style.transform = ''; 
            }

            // Fade out elemen lain (Logo, dll)
            let opacityValue = 1 - (scrollRatio * 2.5);
            if(opacityValue < 0) opacityValue = 0;
            introLogo.style.opacity = opacityValue;
            scrollTrigger.style.opacity = opacityValue;
        }

        // --- 2. LOGIKA TRANSISI KONTEN (SNAPPY) ---
        // Saat scroll mencapai 60% layar, konten langsung muncul menutupi video
        if (scrollY > (windowHeight * 0.6)) {
            
            // Tambahkan class agar muncul
            contentWrapper.classList.add('content-visible');
            
            // Navbar Muncul
            navbar.classList.remove('hidden-nav');
            navbar.classList.add('visible-nav');

        } else {
            // Sembunyikan lagi jika scroll ke atas
            contentWrapper.classList.remove('content-visible');
            
            // Navbar Sembunyi
            navbar.classList.add('hidden-nav');
            navbar.classList.remove('visible-nav');
        }
    });

    // ... (SISA KODE IMAGE SWAP & LAINNYA DI BAWAH SINI) ...
});