
let openContact = document.querySelector('.open-modal');
let modalContact = document.querySelector('.modal-contact');
let closeContact = modalContact.querySelector('.modal-contact__close');

if (modalContact) {
    let formContact = modalContact.querySelector('.modal-contact__form');

    openContact.addEventListener('click', function (event) {
        event.preventDefault();
        modalContact.classList.add('modal-contact--show');


    });

    formContact.addEventListener('submit', function (event) {
        let number = $('input').val();
        event.preventDefault();
        $.ajax({
            url: 'server.php',
            type: 'POST',
            data: {number:number}
        }).done(data => {
            alert(data)
        })
    });

    closeContact.addEventListener('click', function (event) {
        event.preventDefault();
        modalContact.classList.remove('modal-contact--show');

    });

};