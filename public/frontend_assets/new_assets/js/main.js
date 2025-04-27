document.addEventListener('DOMContentLoaded', function() {
    // تفعيل التمرير السلس عند النقر على روابط القائمة
    const navLinks = document.querySelectorAll('.navbar-nav a');

    navLinks.forEach(function(link) {
        link.addEventListener('click', function(e) {
            const targetId = this.getAttribute('href');

            if (targetId.startsWith('#') && targetId !== '#') {
                e.preventDefault();
                const targetElement = document.querySelector(targetId);

                if (targetElement) {
                    // إغلاق القائمة المنسدلة في الجوال عند النقر
                    const navbarCollapse = document.querySelector('.navbar-collapse');
                    if (navbarCollapse.classList.contains('show')) {
                        document.querySelector('.navbar-toggler').click();
                    }

                    // تمرير سلس إلى العنصر المستهدف
                    window.scrollTo({
                        top: targetElement.offsetTop - 80,
                        behavior: 'smooth'
                    });
                }
            }
        });
    });

    // تغيير لون الشريط العلوي عند التمرير
    window.addEventListener('scroll', function() {
        const navbar = document.querySelector('.navbar');

        if (window.scrollY > 100) {
            navbar.style.backgroundColor = 'rgba(255, 255, 255, 0.95)';
            navbar.style.boxShadow = '0 2px 10px rgba(0, 0, 0, 0.1)';
        } else {
            navbar.style.backgroundColor = '#ffffff';
            navbar.style.boxShadow = '0 2px 10px rgba(0, 0, 0, 0.1)';
        }
    });

    // نموذج التتبع
    const trackForm = document.querySelector('.track-form');

    if (trackForm) {
        trackForm.addEventListener('submit', function(e) {
            e.preventDefault();
            const trackingNumber = this.querySelector('input').value;

            if (trackingNumber.trim() === '') {
                alert('يرجى إدخال رقم التتبع');
                return;
            }

            // يمكن تنفيذ عملية التتبع هنا
            alert('جاري التحقق من رقم التتبع: ' + trackingNumber);

            // إعادة تعيين النموذج
            this.reset();
        });
    }

    // تأثيرات التمرير للعناصر
    const animateOnScroll = function() {
        const elements = document.querySelectorAll('.service-card, .testimonial-card, .blog-card');

        elements.forEach(function(element) {
            const elementPosition = element.getBoundingClientRect().top;
            const windowHeight = window.innerHeight;

            if (elementPosition < windowHeight - 100) {
                element.classList.add('fade-in');
            }
        });
    };

    // تشغيل تأثيرات التمرير عند تحميل الصفحة وعند التمرير
    window.addEventListener('scroll', animateOnScroll);
    animateOnScroll(); // تشغيل مرة واحدة عند التحميل

    // التحقق من نموذج الاتصال
    const contactForm = document.getElementById('contactForm');

    if (contactForm) {
        contactForm.addEventListener('submit', function(e) {
            e.preventDefault();

            // التحقق من صحة البيانات
            const name = document.getElementById('name').value;
            const email = document.getElementById('email').value;
            const message = document.getElementById('message').value;

            if (name.trim() === '' || email.trim() === '' || message.trim() === '') {
                alert('يرجى ملء جميع الحقول المطلوبة');
                return;
            }

            // يمكن إرسال النموذج هنا
            alert('تم إرسال رسالتك بنجاح! سنتواصل معك قريبًا.');

            // إعادة تعيين النموذج
            this.reset();
        });
    }
});
