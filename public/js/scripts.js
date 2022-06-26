/*!
* Start Bootstrap - Creative v7.0.6 (https://startbootstrap.com/theme/creative)
* Copyright 2013-2022 Start Bootstrap
* Licensed under MIT (https://github.com/StartBootstrap/startbootstrap-creative/blob/master/LICENSE)
*/
//
// Scripts
// 

window.addEventListener('DOMContentLoaded', event => {

    // Navbar shrink function
    var navbarShrink = function () {
        const navbarCollapsible = document.body.querySelector('#mainNav');
        if (!navbarCollapsible) {
            return;
        }
        if (window.scrollY === 0) {
            navbarCollapsible.classList.remove('navbar-shrink')
        } else {
            navbarCollapsible.classList.add('navbar-shrink')
        }

    };

    // Shrink the navbar 
    navbarShrink();

    // Shrink the navbar when page is scrolled
    document.addEventListener('scroll', navbarShrink);

    // Activate Bootstrap scrollspy on the main nav element
    const mainNav = document.body.querySelector('#mainNav');
    if (mainNav) {
        new bootstrap.ScrollSpy(document.body, {
            target: '#mainNav',
            offset: 74,
        });
    }
    ;

    // Collapse responsive navbar when toggler is visible
    const navbarToggler = document.body.querySelector('.navbar-toggler');
    const responsiveNavItems = [].slice.call(
        document.querySelectorAll('#navbarResponsive .nav-link')
    );
    responsiveNavItems.map(function (responsiveNavItem) {
        responsiveNavItem.addEventListener('click', () => {
            if (window.getComputedStyle(navbarToggler).display !== 'none') {
                navbarToggler.click();
            }
        });
    });

// --------------------MAP------------------------
    let map = L.map('map').setView([47.57523910794382, -0.45878060699907663], 17);
//47.57523910794382, -0.45878060699907663
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '© OpenStreetMap'
    }).addTo(map);

    var marker = L.marker([47.57523910794382, -0.45878060699907663]).addTo(map);
    marker.bindPopup("<b>Rock & Foulk'</b>", {autoClose: false}).openPopup();

    //parking
    //47.576240557477995, -0.4545702321025706

    var markerParking = L.marker([47.576240557477995, -0.4545702321025706]).addTo(map);
    markerParking.bindPopup("<b>Parking'</b>", {autoClose: false}).openPopup();


    L.Routing.control({
        waypoints: [
            L.latLng(47.576240557477995, -0.4545702321025706),
            L.latLng(47.57523910794382, -0.45878060699907663)
        ]
    }).addTo(map);
});
