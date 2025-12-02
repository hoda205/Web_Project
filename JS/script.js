
function showPage(pageId) {
    // اخفاء كل الصفحات
    let pages = document.querySelectorAll('.page');
    pages.forEach(p => p.style.display = 'none');

    // اظهار الصفحة اللي ضغط عليها
    document.getElementById(pageId).style.display = 'block';
}

const menuItems = document.querySelectorAll('.menu-item');

menuItems.forEach(item => {
  item.addEventListener('click', () => {
    // إزالة الكلاس active من كل العناصر
    menuItems.forEach(i => i.classList.remove('active'));
    // إضافة الكلاس active للعنصر اللي اتضغط
    item.classList.add('active');
  });
});
