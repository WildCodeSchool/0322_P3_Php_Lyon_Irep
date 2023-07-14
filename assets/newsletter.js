// Newsletter confirmation of subscription

const toast = document.getElementById('toast-success');
let emailInput= document.getElementById('newsletter_email');
const form = document.getElementById('newsletter');
const url = '/';

form.addEventListener('submit', function(event){ 
    event.preventDefault();   
    let emailRecord = document.getElementById('newsletter_email').value;
    let exhibitionChoice = document.getElementById('newsletter_exhibition');
    let exhibitionId= exhibitionChoice.options[exhibitionChoice.selectedIndex].value;
    let newsletterToken= document.getElementById('newsletter__token').value;

    let formData = new FormData();
    formData.append('newsletter[email]:', emailRecord);
    formData.append('newsletter[exhibition]:', exhibitionId);
    formData.append('newsletter[_token]:', newsletterToken);
 
    fetch (url,{
        method: "POST",
        body: formData,
    })

        .then(response => {
            if(response.status != 200 ) alert("Erreur");
            emailInput.value = '';
            toast.style.opacity = '100';

            setTimeout(function() {
                toast.style.display = 'none';
            }, 5000);
        })
});