/* header */
const header = document.querySelector("header");
window.addEventListener("scroll", function () {
    header.classList.toggle("sticky", window.scrollY > 0);
});

let menu = document.querySelector('#menu-icon');
let navigationmenu = document.querySelector('.navigationmenu');
menu.onclick = () => {
    menu.classList.toggle('bx-x');
    navigationmenu.classList.toggle('open');
};

/* search filter */
const categoryTitle = document.querySelectorAll('.category-title');
const allCategoryPosts = document.querySelectorAll('.all');

for (let i = 0; i < categoryTitle.length; i++) {
    categoryTitle[i].addEventListener('click',
        filterPosts.bind(this, categoryTitle[i]));
}

function filterPosts(item) {
    changeActivePosition(item);
    for (let i = 0; i < allCategoryPosts.length; i++) {
        if (allCategoryPosts[i].classList.contains
            (item.attributes.id.value)) {
            allCategoryPosts[i].style.display =
                "block";
        } else {
            allCategoryPosts[i].style.display =
                "none";
        }
    }
}

function changeActivePosition(activeItem) {
    for (let i = 0; i < categoryTitle.length; i++) {
        categoryTitle[i].classList.remove('active');
    }
}

// Function to show the alert
function showAlert() {
    const alertBox = document.getElementById('cart-alert');
    alertBox.classList.remove('hidden');
    setTimeout(() => {
        alertBox.classList.add('hidden');
    }, 3000); // Hide after 3 seconds
}

// Mock functions for buttons
function viewCart() {
    alert('Redirecting to your cart...');
    // Add redirection logic here
}

function continueShopping() {
    alert('Continuing shopping...');
    // Add logic to continue shopping
}

function showHidePassword() {
    const show_pass = document.getElementById('password');
    if(show_pass.type === "password"){
        show_pass.type = "text";
    }else{
        show_pass.type = "password";    
    }
}