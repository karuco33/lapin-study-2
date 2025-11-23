document.addEventListener('DOMContentLoaded', function() {
    const hamburger = document.getElementById('hamburger');
    const navMenu = document.getElementById('nav-menu');

    if (hamburger && navMenu) {
        hamburger.addEventListener('click', function() {
            // ボタンとメニューに 'active' クラスをトグル（付け外し）する
            hamburger.classList.toggle('active');
            navMenu.classList.toggle('active');
        });

        // メニュー内のリンクをクリックしたら閉じる（UX向上）
        const navLinks = navMenu.querySelectorAll('a');
        navLinks.forEach(link => {
            link.addEventListener('click', function() {
                hamburger.classList.remove('active');
                navMenu.classList.remove('active');
            });
        });
    }
});