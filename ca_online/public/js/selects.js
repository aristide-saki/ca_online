window.addEventListener('DOMContentLoaded', () => {

    fetch(`${baseOfUrl}/lib/selects.json`)
        .then(response => response.json())
        .then(data => {
            // console.log(data)
            const signalisation_container = document.querySelector('#signalisation');
            const commentaire_2_container = document.querySelector('#commentaire_2');
            const action_corrective_container = document.querySelector('#action_corrective');
            const acteur_container = document.querySelector('#acteur');
            const segment_container = document.querySelector('#segment');
            const statut_container = document.querySelector('#statut');

            const signalisations = data.signalisation;
            signalisations.forEach(signalisation => {
                signalisation_container.innerHTML += `<option value="${signalisation}">${signalisation}</option>`;
            });

            const action_correctives = data.action_corrective;
            action_correctives.forEach(action => {
                action_corrective_container.innerHTML += `<option value="${action}">${action}</option>`;
            });

            const acteurs = data.acteur;
            acteurs.forEach(acteur => {
                acteur_container.innerHTML += `<option value="${acteur}">${acteur}</option>`;
            });

            const segments = data.segment;
            segments.forEach(segment => {
                segment_container.innerHTML += `<option value="${segment}">${segment}</option>`;
            });

            const statuts = data.statut;
            statuts.forEach(statut => {
                statut_container.innerHTML += `<option value="${statut}">${statut}</option>`;
            });

            const commentaires = data.commentaire_2;
            commentaires.forEach(commentaire => {
                commentaire_2_container.innerHTML += `<option value="${commentaire}">${commentaire}</option>`;
            });
        })
        .catch(err => {
            console.log(err)
        })

})