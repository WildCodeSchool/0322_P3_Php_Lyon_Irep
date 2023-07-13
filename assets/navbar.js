document.querySelector('[data-collapse-toggle="navbar-hamburger"]').addEventListener('click', function() {
    const burgerMenu = document.getElementById('navbar-hamburger');
    burgerMenu.classList.toggle('hidden');
});

document.querySelectorAll('.group ul a').forEach(function(link) {
    link.addEventListener('click', function(event) {
        event.preventDefault();

        const exhibitionId = event.currentTarget.getAttribute('data-exhibition-id');
        const exhibitionName = event.currentTarget.getAttribute('data-exhibition-name');
        const linkHref = link.href;

        fetch('/save-exhibition-id', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                exhibitionId: exhibitionId
            })
        })
            .then(() => {
                const existingGalleryLink = document.querySelector('.navbar-galerie');
                if (existingGalleryLink) existingGalleryLink.remove();
    
                const galleryLink = document.createElement('li');
                galleryLink.className = 'navbar-galerie animate-slide-in-center';
    
                galleryLink.innerHTML = '<a href="' + linkHref + '" class="px-4 py-2 justify-self-start text-white hover:text-gray-200">' + exhibitionName + ' | Galerie</a>';
    
                const navbarItems = document.querySelector('.justify-between');
                navbarItems.insertBefore(galleryLink, navbarItems.childNodes[navbarItems.childNodes.length - 2]);
    
                localStorage.setItem('galleryUrl', linkHref);
                localStorage.setItem('exhibitionName', exhibitionName);
            });
    });
});

document.addEventListener('DOMContentLoaded', function() {
    const galleryUrl = localStorage.getItem('galleryUrl');
    const exhibitionName = localStorage.getItem('exhibitionName');
  
    if (galleryUrl && exhibitionName) {
        const existingGalleryLink = document.querySelector('.navbar-galerie');
        if (existingGalleryLink) existingGalleryLink.remove();
    
        const galleryLink = document.createElement('li');
        galleryLink.className = 'navbar-galerie animate-slide-in-center';
    
        galleryLink.innerHTML = '<a href="' + galleryUrl + '" class="px-4 py-2 justify-self-start text-white hover:text-gray-200">' + exhibitionName + ' | Galerie</a>';
    
        const navbarItems = document.querySelector('.justify-between');
        navbarItems.insertBefore(galleryLink, navbarItems.childNodes[navbarItems.childNodes.length - 2]);
    }
});
