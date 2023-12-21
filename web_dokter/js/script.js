const sidelinks = document.querySelectorAll('.sidebar .side-menu li a:not(.logout)');

sidelinks.forEach(item => {
    const li = item.parentElement;
    item.addEventListener('click', () =>{
        sidelinks.forEach(i =>{
            i.parentElement.classList.remove('active');
        })
        li.classList.add('active');
    })
});

const menuBar = document.querySelector('.content nav .bx.bx-menu-alt-left');
const sideBar = document.querySelector('.sidebar');

menuBar.addEventListener('click', () =>{
    sideBar.classList.toggle('close');
});

const searchBtn = document.querySelector('.content nav form .form-input button');
const searchBtnIcon = document.querySelector('.content nav form .form-input button .bx');
const searchForm = document.querySelector('.content nav form');

searchBtn.addEventListener('click', function (e) {
    if(window.innerWidth < 576) {
        e.preventDefault;
        searchForm.classList.toggle('show');
        if (searchForm.classList.contains('show')) {
            searchBtnIcon.classList.replace('bx-search', 'bx-x');
        } else {
            searchBtnIcon.classList.replace('bx-x', 'bx-search');
        }
    }
});

window.addEventListener('resize', () =>{
    if (window.innerWidth < 768) {
        sideBar.classList.add('close');
    } else {
        sideBar.classList.remove('close');
    }
    if (window.innerWidth > 576) {
        searchBtnIcon.classList.replace('bx-x', 'bx-search');
        searchForm.classList.remove('show');
    }
});

const toggler = document.getElementById('theme-toggle');

toggler.addEventListener('change', function ()  {
    if (this.checked) {
        document.body.classList.add('dark');
    } else {
        document.body.classList.remove('dark');
    }
});



$(document).ready(function () {
    // Inisialisasi tooltip pada elemen-elemen yang memiliki data-toggle="tooltip"
    $('[data-toggle="tooltip"]').tooltip();
});

// function showPatientDetail(button) {
//     // Mengambil nama pasien dari atribut data-nama tombol
//     var namaPasien = button.getAttribute('data-nama');
    
//     // Menampilkan detail pasien sesuai dengan nama
//     var detailPasien = document.getElementById('detail-pasien-' + namaPasien);
//     if (detailPasien) {
//         detailPasien.style.display = 'block';
//     }
// }

// Fungsi untuk menampilkan QR code dalam popup
function generateQRCode(namaPasien) {
    var encodedNamaPasien = encodeURIComponent(namaPasien);
    var qrcode = new QRCode(document.getElementById("qrcode"), {
        // text: "http://medical-record.rf.gd/web_dokter/func/detail_pasien.php?nama=" + encodedNamaPasien,
        text: "localhost/rekamMedis/web_dokter/func/input_diagnosa.php?nama=" + encodedNamaPasien,
        width: 128,
        height: 128
    });

    // Tampilkan elemen popup QR code
    var qrcodePopup = document.getElementById("qrcode-popup");
    qrcodePopup.style.display = "block";
}

function downloadPDF() {
    // Dapatkan parameter 'nama' dari URL
    var urlParams = new URLSearchParams(window.location.search);
    var namaPasien = urlParams.get('nama');

    // Pastikan namaPasien tidak null atau undefined sebelum men-download PDF
    if (namaPasien) {
        // Gantilah URL berikut dengan URL ke file pdf_generator.php
        // var pdfGeneratorURL = 'http://medical-record.rf.gd/pdf_generator.php?nama=' + encodeURIComponent(namaPasien);
        var pdfGeneratorURL = '../../pdf_generator.php?nama=' + encodeURIComponent(namaPasien);

        // Membuka jendela baru untuk mengeksekusi file pdf_generator.php dan menghasilkan file PDF
        window.open(pdfGeneratorURL, '_blank');
    } else {
        alert('Nama pasien tidak ditemukan dalam parameter URL.');
    }
}

// Fungsi untuk menutup popup QR code
document.getElementById("close-qrcode").addEventListener("click", function() {
    var qrcodePopup = document.getElementById("qrcode-popup");
    qrcodePopup.style.display = "none";

    // Close the Bootstrap modal using jQuery
    $('#myModal').modal('hide');
});

document.addEventListener("DOMContentLoaded", function () {
    var profileDropdown = document.querySelector(".profile-dropdown");

    profileDropdown.addEventListener("click", function (e) {
        var profileOptions = this.querySelector(".profile-options");
        if (profileOptions.style.display === "block") {
            profileOptions.style.display = "none";
        } else {
            profileOptions.style.display = "block";
        }
        e.stopPropagation();
    });

    // Menutup dropdown jika di-klik di luar dropdown
    document.addEventListener("click", function () {
        var profileOptions = profileDropdown.querySelector(".profile-options");
        profileOptions.style.display = "none";
    });
});


// Ambil semua elemen yang memiliki kelas "parent" dalam menu
const parentItems = document.querySelectorAll('.side-menu .parent');

// Loop melalui semua elemen "parent" dan tambahkan event listener
parentItems.forEach((parentItem) => {
    // Tambahkan event listener untuk setiap elemen "parent"
    parentItem.addEventListener('click', (event) => {
        // Jika submenu ada, toggle tampilan submenu
        const subMenu = parentItem.querySelector('.sub-menu');
        if (subMenu) {
            event.preventDefault(); // Hindari navigasi ke tautan utama
            subMenu.classList.toggle('active');
        }
    });
});

