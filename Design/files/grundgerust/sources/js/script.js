function toggleSidebar() {
    let sidebar = document.getElementById("sidebar");
    let burgerIcon = document.getElementById("burger-icon");
    sidebar.classList.toggle("sidebar_visible");
    burgerIcon.classList.toggle("change");
}
