(function ($) {
    "use strict";

    // Spinner
    
    var spinner = function () {
        setTimeout(function () {
            if ($('#spinner').length > 0) {
                $('#spinner').removeClass('show');
            }
        }, 1);
    };
    spinner();
    
    
    // Initiate the wowjs
    new WOW().init();


    // Sticky Navbar
    $(window).scroll(function () {
        if ($(this).scrollTop() > 45) {
            $('.nav-bar').addClass('sticky-top');
        } else {
            $('.nav-bar').removeClass('sticky-top');
        }
    });
    
    
    // Back to top button
    $(window).scroll(function () {
        if ($(this).scrollTop() > 300) {
            $('.back-to-top').fadeIn('slow');
        } else {
            $('.back-to-top').fadeOut('slow');
        }
    });
    $('.back-to-top').click(function () {
        $('html, body').animate({scrollTop: 0}, 1500, 'easeInOutExpo');
        return false;
    });


    // Header carousel
    $(".header-carousel").owlCarousel({
        autoplay: true,
        smartSpeed: 1500,
        items: 1,
        dots: true,
        loop: true,
        nav : true,
        navText : [
            '<i class="bi bi-chevron-left"></i>',
            '<i class="bi bi-chevron-right"></i>'
        ]
    });


    // Testimonials carousel
    $(".testimonial-carousel").owlCarousel({
        autoplay: true,
        smartSpeed: 1000,
        margin: 24,
        dots: false,
        loop: true,
        nav : true,
        navText : [
            '<i class="bi bi-arrow-left"></i>',
            '<i class="bi bi-arrow-right"></i>'
        ],
        responsive: {
            0:{
                items:1
            },
            992:{
                items:2
            }
        }
    });
    // Modal ochilganda navbarni tezda yashirish
    $('#propertyModal').on('shown.bs.modal', function () {
        var navbar = document.querySelector('.navbar');
        navbar.style.transition = 'none';  // Animatsiya effektini vaqtincha o'chirish
        navbar.style.opacity = '0';  // Navbarni yashirish
    });

    // Modal yopilganda navbarni tezda ko'rsatish
    $('#propertyModal').on('hidden.bs.modal', function () {
        var navbar = document.querySelector('.navbar');
        navbar.style.transition = 'none';  // Animatsiya effektini vaqtincha o'chirish
        navbar.style.opacity = '1';  // Navbarni ko'rsatish

        // Tezda ko'rsatishni amalga oshirish uchun 10ms kutib turing
        setTimeout(function() {
            navbar.style.transition = 'opacity 0.3s ease-in-out';  // Animatsiya qaytadan faollashadi
        }, 10);  // Tezda qayta boshlanishi uchun qisqa vaqt
    });

    //Agent profileda property images qo'shish 
    $(document).ready(function() {
        $('#image-upload').on('change', function(event) {
            let files = event.target.files;
            
            // Har bir yangi yuklangan fayl uchun
            for (let i = 0; i < files.length; i++) {
                let file = files[i];
                let reader = new FileReader();

                reader.onload = function(e) {
                    let imgCard = `
                        <div class="card border-0 shadow-sm" style="width: 120px; position: relative;">
                            <img src="${e.target.result}" class="card-img-top rounded" style="height: 120px; object-fit: cover;">
                            <button type="button" class="btn btn-danger btn-sm position-absolute top-0 end-0 m-1 remove-image">×</button>
                        </div>`;
                    $('#image-preview-container').append(imgCard);
                };

                reader.readAsDataURL(file);
            }
        });

        // Rasmni o‘chirish tugmachasi
        $(document).on('click', '.remove-image', function() {
            $(this).closest('.card').remove();
        });

    });

    //Property tahrirlash image UI dan uchirish
    $(document).ready(function () {
        $(".remove-image-one").click(function () {
            if (confirm("Rostdan ham ushbu rasmni o‘chirmoqchimisiz?")) {
                $(this).closest(".image-box").fadeOut(300, function () {
                    $(this).remove(); // UI dan rasmni olib tashlash
                });
            }
        });
    });

    
})(jQuery);

//Search keyboard clear
function clearInput() {
    document.getElementById('searchInput').value = '';
}

//Agent profileda property delete funksiyasi
document.addEventListener("DOMContentLoaded", function() {
    let deleteButtons = document.querySelectorAll(".delete-btn");
    let deleteForm = document.getElementById("deleteForm");

    deleteButtons.forEach(button => {
        button.addEventListener("click", function() {
            let propertyId = this.getAttribute("data-id");
            deleteForm.action = `/properties/${propertyId}`;
        });
    });
});