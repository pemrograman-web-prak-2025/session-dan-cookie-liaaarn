document.addEventListener("DOMContentLoaded", () => {
    const body = document.body;
    const themeToggle = document.getElementById("theme-toggle"); // tombol untuk mengubah tema
    const themeLabel = document.getElementById("theme-label"); // label teks untuk menampilkan tema saat ini

    // mengecek cookie "theme", jika tidak ada maka default "light"
    const currentTheme = getCookie("theme") || "light";
    applyTheme(currentTheme); // terapkan tema yang tersimpan

    // event ssaat tombol toggle di klik
    themeToggle.addEventListener("click", () => {
        // jika bode memiliki class "dark", ubah ke "light", daan sebaliknya
        const newTheme = body.classList.contains("dark") ? "light" : "dark";
        applyTheme(newTheme); // terapkan tema baru

        // simpan tema ke cookie agar tetap tersimpan selama 30 hari
        document.cookie = `theme=${newTheme};path=/;max-age=${
            60 * 60 * 24 * 30
        }`;
    });

    // fungsi untuk menerapkan tema
    function applyTheme(theme) {
        if (theme === "dark") {
            body.classList.add("dark"); // tambahkan class "dark" pada body
            themeLabel.textContent = "Dark"; // ganti label teks menjadi "dark"
        } else {
            body.classList.remove("dark"); // haspu class "dark" agar menjadi "light"
            themeLabel.textContent = "Light"; // ganti label menjadi "light"
        }
    }

    // fungsi untuk mengambil nilai cookie berdasarkan nama
    function getCookie(name) {
        const value = `; ${document.cookie}`; // ambil semua cookie
        const parts = value.split(`; ${name}=`); // pisahkan berdasarkan nama cookie
        if (parts.length === 2) return parts.pop().split(";").shift(); // kembalikan nilai cookie jika ditemukan
    }
});
