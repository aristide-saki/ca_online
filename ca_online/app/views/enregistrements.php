<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CA ONLINE</title>
    <link rel="stylesheet" href="public/css/styles.css">
    <script src="public/js/xlsx.full.min.js"></script>
</head>

<body>

    <?php require('app/views/components/aside.php'); ?>
    <?php require('app/views/components/header.php'); ?>

    <main>

        <div class="action-btns-container">
            <h3>ENREGISTREMENT CA ONLINE</h3>
            <!-- <button class="button-primary" data-modal="#reservationModal"><span
                    class="material-symbols-outlined">add_circle</span>
                Nouvel enregistrement</button> -->
            <!-- <button class="button-primary" data-modal="#checkInModal"><span
                    class="material-symbols-outlined">add_circle</span>
                Nouvel enregistrement</button> -->
            <!-- <button class="button-secondary" data-modal="#reservationModal"><span
                    class="material-symbols-outlined">timer</span>
                Nouvelle réservation</button> -->
        </div>

        <div class="card-container mt-3" style="">

            <div class="flex-sb">
                <a href="<?= BASE_URL ?>/" class="button button-primary">Nouvel enregistrement</a>
                <!-- <button type="button" class="success">Exporter</button> -->
            </div>
            <div class="" id="data-container">
                <p>Chargement en cours...</p>
            </div>

        </div>



    </main>

    <!-- Modals -->



    <div class="modal" id="confirmDelete">
        <div class="modal-content">
            <div class="modal-head">
                <h3>Suppression</h3>
                <span class="material-symbols-outlined close-modal">close</span>
            </div>
            <div class="modal-body">

                <form action="" method="post" id="confirm-delete">
                    <p>Êtes-vous sûr de bien vouloir supprimer cet enregistrement ?</p>
                    <input type="hidden" name="" id="input-id">
                    <div class="flex-a-center gap-2 mt-2">
                        <button class="button-success" type="submit">Oui</button>
                        <button class="button-danger" type="button" onclick="dismissModal('#confirmDelete')">Non</button>
                    </div>
                </form>

            </div>
            <div class="modal-foot"></div>
        </div>
    </div>




    <footer class="mt-2">
        <div class="text-center">
            &copy; 2024 - Tout droit réservé.
        </div>
    </footer>

    <script src="public/js/functions.js"></script>
    <script src="public/js/scripts.js"></script>
    <script>
        // const recap = document.querySelector('.recap');
        // if (localStorage.getItem('recap') === 'reduce') {
        //     recap.classList.add('reduce');
        // }

        function telechargerTableau() {

            var table = document.getElementById("tableau");
            var workbook = XLSX.utils.table_to_book(table, {
                sheet: "ca_online"
            });
            var wbout = XLSX.write(workbook, {
                bookType: 'xlsx',
                type: 'binary'
            });

            function s2ab(s) {
                var buf = new ArrayBuffer(s.length);
                var view = new Uint8Array(buf);
                for (var i = 0; i < s.length; i++) {
                    view[i] = s.charCodeAt(i) & 0xFF;
                }
                return buf;
            }

            var blob = new Blob([s2ab(wbout)], {
                type: "application/octet-stream"
            });
            var link = document.createElement("a");
            link.href = URL.createObjectURL(blob);
            link.download = "enregistrements_ca_online.xlsx";

            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);


        }
    </script>
</body>

</html>