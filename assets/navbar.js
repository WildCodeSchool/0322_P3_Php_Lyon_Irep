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
    
                galleryLink.innerHTML = '<div class="flex items-center"><span class="px-4 py-2 justify-self-start text-accentcolor hidden md:block">' + exhibitionName + '</span> | <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 inline-flex text-white"><path stroke-linecap="round" stroke-linejoin="round" d="M17.25 8.25L21 12m0 0l-3.75 3.75M21 12H3" /></svg><a href="' + linkHref + '" class="px-4 py-2 justify-self-start text-white hover:text-gray-200">Galerie</a></div>'; 
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
    
        galleryLink.innerHTML = '<div class="flex items-center"><span class="px-4 py-2 justify-self-start text-accentcolor hidden md:block">' + exhibitionName + '</span> | <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 inline-flex text-white"><path stroke-linecap="round" stroke-linejoin="round" d="M17.25 8.25L21 12m0 0l-3.75 3.75M21 12H3" /></svg><a href="' + galleryUrl + '" class="px-4 py-2 justify-self-start text-white hover:text-gray-200">Galerie</a></div>';
        const navbarItems = document.querySelector('.justify-between');
        navbarItems.insertBefore(galleryLink, navbarItems.childNodes[navbarItems.childNodes.length - 2]);
    }
});
