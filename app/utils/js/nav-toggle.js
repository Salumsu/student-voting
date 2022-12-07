const main_navs = document.querySelectorAll(".main-nav");

main_navs.forEach((main_nav) => {
  main_nav.addEventListener("click", () => {
    main_nav.classList.toggle("active");
  });
});

const uls = document.querySelectorAll(".main-nav ul");
uls.forEach((ul) => {
  ul.addEventListener("click", (e) => {
    e.stopPropagation();
  });
});
