function showPage(pageId) {

    // اخفاء كل الصفحات
    document.querySelectorAll('.page').forEach(page => {
        page.style.display = 'none';
    });

    // اظهار الصفحة اللي اخترناها
    document.getElementById(pageId).style.display = 'block';

    // حفظ آخر صفحة
    localStorage.setItem("lastPage", pageId);
}
// function sidBarActive(item){
  
//         //مسح active من الكل
//         document.querySelectorAll('.menu-item').forEach(i => i.classList.remove("active"));
        
//         //اضافة active للعنصر اللي اتضغط
//         item.classList.add("active");
    
// }

// تظبيط active + الحفظ
document.querySelectorAll('.menu-item').forEach(item => {

    item.addEventListener('click', () => {
        //مسح active من الكل
        document.querySelectorAll('.menu-item').forEach(i => i.classList.remove("active"));
        
        //اضافة active للعنصر اللي اتضغط
        item.classList.add("active");
});
});

