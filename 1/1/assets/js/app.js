document.addEventListener("DOMContentLoaded", () => {

    const toggle = document.querySelector(".menu-toggle");
    const sidebar = document.querySelector(".sidebar");

    if (!toggle || !sidebar) return;

    toggle.onclick = function (e) {
        e.stopPropagation();
        sidebar.classList.toggle("active");
    };

    document.onclick = function (e) {

        if (
            !sidebar.contains(e.target) &&
            !toggle.contains(e.target)
        ) {
            sidebar.classList.remove("active");
        }

    };

});