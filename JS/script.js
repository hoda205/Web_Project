
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


const form = document.getElementById("contactForm");

  form.addEventListener("submit", function (e) {
    e.preventDefault();

    let hasError = false;

    const name = document.getElementById("name");
    const email = document.getElementById("email");
    const subject = document.getElementById("subject");
    const message = document.getElementById("message");

    const nameError = document.getElementById("nameError");
    const emailError = document.getElementById("emailError");
    const subjectError = document.getElementById("subjectError");
    const formError = document.getElementById("formError");

   
    [nameError, emailError, subjectError, formError].forEach(el => el.textContent = "");
    [name, email, subject].forEach(el => el.classList.remove("is-invalid"));
    form.classList.remove("form-has-error");
    formError.classList.remove("text-secondary", "text-success");

    
    if (name.value.trim() === "") {
      nameError.textContent = "The field is required.";
      name.classList.add("is-invalid");
      hasError = true;
    }

    if (email.value.trim() === "") {
      emailError.textContent = "The field is required.";
      email.classList.add("is-invalid");
      hasError = true;
    }

    if (subject.value.trim() === "") {
      subjectError.textContent = "The field is required.";
      subject.classList.add("is-invalid");
      hasError = true;
    }

   
    if (hasError) {
      form.classList.add("form-has-error");
      formError.textContent = "One or more fields have an error. Please check and try again.";
      formError.classList.add("text-secondary");
      
    } else {
      formError.textContent = "✔️ Message sent successfully!";
      formError.classList.add("text-success");
      form.reset();
    }
  });

document.addEventListener("DOMContentLoaded", function () {
  const btn = document.getElementById("scrollTopBtn");

  
  window.addEventListener("scroll", function () {
    if (document.body.scrollTop > 100 || document.documentElement.scrollTop > 100) {
      btn.style.display = "flex"; 
    } else {
      btn.style.display = "none";
    }
  });


  btn.addEventListener("click", function () {
    window.scrollTo({
      top: 0,
      behavior: 'smooth'
    });
  });
});


