document.querySelector('[data-collapse-toggle="navbar-hamburger"]').addEventListener('click', function() {
    const burgerMenu = document.getElementById('navbar-hamburger');
    burgerMenu.classList.toggle('hidden');
});

document.querySelectorAll('.group ul a').forEach(function(link) {
    link.addEventListener('click', function(event) {
        event.preventDefault();

        fetch('/save-exhibition-id', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                exhibitionId: event.currentTarget.getAttribute('data-exhibition-id')
            })
        });

        const existingGalleryLink = document.querySelector('.navbar-galerie');
        if (existingGalleryLink) existingGalleryLink.remove();

        const galleryLink = document.createElement('li');
        galleryLink.className = 'navbar-galerie';
        galleryLink.innerHTML = '<a href="' + link.href + '" class="px-4 py-2 justify-self-start pr-60 mr-60 text-white hover:text-gray-200">Galerie</a>';

        const navbarItems = document.querySelector('.md\\:flex');
        navbarItems.insertBefore(galleryLink, navbarItems.childNodes[Math.floor(navbarItems.childNodes.length / 2)]);

        localStorage.setItem('galleryUrl', link.href);
    });
});

document.addEventListener('DOMContentLoaded', function() {
    const galleryUrl = localStorage.getItem('galleryUrl');
    if (galleryUrl) {
        const existingGalleryLink = document.querySelector('.navbar-galerie');
        if (existingGalleryLink) existingGalleryLink.remove();

        const galleryLink = document.createElement('li');
        galleryLink.className = 'navbar-galerie';
        galleryLink.innerHTML = '<a href="' + galleryUrl + '" class="px-4 py-2 justify-self-start pr-60 mr-60 text-white hover:text-gray-200">Galerie</a>';

        const navbarItems = document.querySelector('.md\\:flex');
        navbarItems.insertBefore(galleryLink, navbarItems.childNodes[Math.floor(navbarItems.childNodes.length / 2)]);
    }
});

