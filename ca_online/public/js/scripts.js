function confirmDelete(id) {
    document.querySelector("#confirmDelete #input-id").value = id;
    showModal('#confirmDelete');
}

function letDelete(id) {
    fetch(`${baseOfUrl}/app/treatments/supprimer.php?id=${id}`)
        .then(resp => resp.text())
        .then(data => {
            // console.log(data);
            if (data === 'success') {
                fechData();
                closeConfirmDelete();
            } else {
                console.log(data);
            }
        })
        .catch(err => {
            console.log(err);
        })
}

function closeConfirmDelete() {
    dismissModal('#confirmDelete');
    document.querySelector("#confirmDelete #input-id").value = '';
}


function fechData() {
    fetch(`${baseOfUrl}/app/treatments/selectionner.php`)
        .then(resp => resp.text())
        .then(data => {
            // console.log(data);
            document.querySelector('#data-container').innerHTML = data;
        })
        .catch(err => {
            console.log(err);
        })
}


function toast(type, message) {
    const toast = document.createElement('div');
    toast.classList.add('toast', 'active', type);

    const iconType = type === 'success' ? 'check' : 'close';
    toast.innerHTML = `<p><span class="material-symbols-outlined">${iconType}</span><span>${message}</span></p>`;

    document.body.appendChild(toast);

    setTimeout(() => {
        toast.classList.remove('active');
        setTimeout(() => {
            document.body.removeChild(toast);
        }, 300); // Wait for CSS transition to complete before removing the toast
    }, 5000);
}



function calculateTimeDifference() {
    // Get the input values
    const dateReception = document.getElementById('date_reception').value;
    const dateReponse = document.getElementById('date_reponse').value;
    const tempsField = document.getElementById('temps');

    // Check if both dates are provided
    if (dateReception && dateReponse) {
        // Parse the input values to Date objects
        const receptionDate = new Date(dateReception);
        const reponseDate = new Date(dateReponse);

        // Calculate the difference in milliseconds
        const timeDifference = reponseDate - receptionDate;

        // Convert the difference to a more readable format (e.g., hours, minutes, seconds)
        const diffHours = Math.floor(timeDifference / (1000 * 60 * 60));
        const diffMinutes = Math.floor((timeDifference % (1000 * 60 * 60)) / (1000 * 60));
        const diffSeconds = Math.floor((timeDifference % (1000 * 60)) / 1000);

        // Format the result
        // const formattedDifference = `${diffHours} hours, ${diffMinutes} minutes, ${diffSeconds} seconds`;
        const formattedDifference = `${diffHours}:${diffMinutes}:${diffSeconds}`;

        // Set the result in the "temps" field
        tempsField.value = formattedDifference;
    } else {
        // tempsField.value = 'Please provide both dates.';
        tempsField.value = 0;
    }
}

async function infosByContact(contact) {
    if (contact.length === 10) {
        try {
            const contactData = new FormData();
            contactData.append('contact', contact);

            const response = await fetch(`${baseOfUrl}/app/treatments/select.php`, {
                method: 'POST',
                body: contactData
            });

            if (!response.ok) {
                throw new Error(`HTTP error! Status: ${response.status}`);
            }

            const data = await response.json();

            // if (data.length > 0) {
            if (data != []) {
                // console.log(data.length);
                const fields = [
                    { id: '#nom', value: data.nom },
                    { id: '#prenom', value: data.prenom },
                    { id: '#entreprise', value: data.entreprise },
                    { id: '#zone_intervention', value: data.zone_intervention },
                    { id: '#ticket', value: data.ticket },
                    // { id: '#nd', value: data.nd },
                    // { id: '#date_reception', value: data.date_reception },
                    // { id: '#date_reponse', value: data.date_reponse },
                    // { id: '#temps', value: data.temps },
                    // { id: '#commentaire_1', value: data.commentaire_1 },
                    // { id: '#noeud_ressource_hs', value: data.noeud_ressource_hs },
                    // { id: '#ressource_hs', value: data.ressource_hs },
                    // { id: '#etat_ressource_hs', value: data.etat_ressource_hs },
                    // { id: '#nd_occupant', value: data.nd_occupant },
                    // { id: '#agent_ca', value: data.agent_ca }
                ];

                // Set text and datetime-local fields
                fields.forEach(field => {
                    if (field.value !== undefined && field.value !== null) {
                        document.querySelector(field.id).value = field.value;
                    }
                });

                // Set select fields
                const selectFields = [
                    // { id: '#signalisation', value: data.signalisation },
                    // { id: '#action_corrective', value: data.action_corrective },
                    // { id: '#statut', value: data.statut },
                    // { id: '#segment', value: data.segment },
                    // { id: '#acteur', value: data.acteur },
                    // { id: '#commentaire_2', value: data.commentaire_2 }
                ];

                selectFields.forEach(field => {
                    if (field.value !== undefined && field.value !== null) {
                        const option = document.querySelector(`${field.id} option[value="${field.value}"]`);
                        if (option) {
                            option.selected = true;
                        }
                    }
                });
            } else {
                console.log('No data found for the provided contact.');

                // console.log(data);
            }
        } catch (error) {
            console.error('Fetch error:', error);
        }
    } else {
        // console.error('Invalid contact length:', contact);
    }
}





function filterTable(inputId, tableId) {
    // Récupérer la valeur saisie dans l'élément d'entrée
    var input = document.getElementById(inputId);
    var filter = input.value.toUpperCase();

    // Récupérer le tableau et ses lignes
    var table = document.getElementById(tableId);
    var rows = table.getElementsByTagName("tr");

    // Parcourir toutes les lignes du tableau, et masquer celles qui ne correspondent pas à la recherche
    for (var i = 0; i < rows.length; i++) {
        var cells = rows[i].getElementsByTagName("td");
        var found = false;
        for (var j = 0; j < cells.length; j++) {
            var cell = cells[j];
            if (cell) {
                var txtValue = cell.textContent || cell.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    found = true;
                    break;
                }
            }
        }
        if (found) {
            rows[i].style.display = "";
        } else {
            rows[i].style.display = "none";
        }
    }
}






window.addEventListener('DOMContentLoaded', () => {
    // Exemple d'utilisation
    // startCountdown('countdown1', '2024-05-24 10:49:00');
    // startCountdown('countdown2', '2024-05-24 10:50:00');
    // startCountdown('countdown3', '2024-05-24 10:51:00');
    // startCountdown('countdown4', '2024-05-24 10:52:00');


    // Ecouter sur les elements pour afficher les modals
    const showModalBtns = document.querySelectorAll('[data-modal]');
    showModalBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            const modalId = btn.getAttribute('data-modal');
            showModal(modalId);
        });
    });

    // Ecouter sur les elements pour fermer les modals
    const dismissModalBtns = document.querySelectorAll('.close-modal');
    dismissModalBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            const modalParent = btn.closest('.modal');
            modalParent.classList.remove('active');
            if (modalParent.id == '#timeElapsedModal') {
                modalParent.querySelector('.notifs').innerHTML = "";
            }
        });
    });



    const form = document.querySelector('#form');
    if (form) {
        form.addEventListener('submit', (e) => {

            e.preventDefault();

            const formData = new FormData(form);

            fetch(`${baseOfUrl}/app/treatments/enregistrer.php`, {
                method: 'POST',
                body: formData
            })
                .then(resp => resp.text())
                .then(data => {
                    console.log(data);
                    const responseMsg = document.querySelector('#responseMsg');
                    if (data === "success") {
                        form.reset();
                        toast('success', 'Enregistrement réussi');
                    } else {
                        toast('danger', 'Echec d\'enregistrement.');
                    }
                })
                .catch(err => {
                    console.log(err);
                })
        })
    }


    const contactInput = document.querySelector('#contact');
    if (contactInput) {
        contactInput.addEventListener('input', () => {
            infosByContact(contactInput.value);
        })
    }

    // const enregistre = document.querySelector('#enregistre');
    // if (enregistre) {
    //     enregistre.addEventListener('click', ()=> {
    //         alert('Go')
    //         form.submit();
    //     });
    // }


    if (document.querySelector('#data-container'))
        fechData();


    // Confirmer la suppression
    const confirmDeleteForm = document.querySelector('#confirm-delete');
    if (confirmDeleteForm) {
        confirmDeleteForm.addEventListener('submit', (e) => {
            e.preventDefault();

            const id = confirmDeleteForm.querySelector('#input-id').value;
            letDelete(id);
        })
    }

})