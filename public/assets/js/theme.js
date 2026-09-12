/* VitrineWeb — interações em JS puro (sem jQuery) */
(function () {
    "use strict";

    // Sombra na navbar ao rolar a página
    var navbar = document.querySelector(".site-navbar, .admin-navbar");
    if (navbar) {
        var onScroll = function () {
            navbar.classList.toggle("is-scrolled", window.scrollY > 10);
        };
        onScroll();
        window.addEventListener("scroll", onScroll, { passive: true });
    }

    // Botão "voltar ao topo"
    var backToTop = document.querySelector(".back-to-top");
    if (backToTop) {
        window.addEventListener("scroll", function () {
            backToTop.classList.toggle("is-visible", window.scrollY > 400);
        }, { passive: true });

        backToTop.addEventListener("click", function (event) {
            event.preventDefault();
            window.scrollTo({ top: 0, behavior: "smooth" });
        });
    }

    // Filtro de busca simples para tabelas (data-table-filter="#idDaTabela")
    document.querySelectorAll("[data-table-filter]").forEach(function (input) {
        var table = document.querySelector(input.getAttribute("data-table-filter"));
        if (!table) return;

        var rows = table.querySelectorAll("tbody tr");

        input.addEventListener("input", function () {
            var termo = input.value.trim().toLowerCase();

            rows.forEach(function (row) {
                var texto = row.textContent.toLowerCase();
                row.style.display = texto.indexOf(termo) === -1 ? "none" : "";
            });
        });
    });
})();
