function setPage(pageId, sidebarId) {

    document.querySelectorAll('.page').forEach(page => page.classList.add('display-none'));

    const activePage = document.getElementById(pageId);
    if (activePage) activePage.classList.remove('display-none');

    document.querySelectorAll('.menu-item').forEach(item => item.classList.remove('active'));

    const activeMenu = document.getElementById(sidebarId);
    if (activeMenu) activeMenu.classList.add('active');


    fetch("../PHP/savePage.php", {
        method: "POST",
        headers: { "Content-Type": "application/x-www-form-urlencoded" },
        body: "pageId=" + encodeURIComponent(pageId) + "&sidebar=" + encodeURIComponent(sidebarId)
    });
}
