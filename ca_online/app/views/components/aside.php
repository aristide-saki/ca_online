<aside>

    <div class="logo">
        CA ONLINE
    </div>

    <nav>
        <ul>
            <li>
                <a href="<?=BASE_URL?>/" class="<?=isset($pageName) && $pageName === "formulaire" ? 'active' : '';?>">
                    <span class="material-symbols-outlined">edit</span>
                    <span>Formulaire</span>
                </a>
            </li>
            <li>
                <a href="<?=BASE_URL?>/enregistrements"
                    class="<?=isset($pageName) && $pageName === "enregistrements" ? 'active' : '';?>">
                    <span class="material-symbols-outlined">list</span>
                    <span>Enregistrements</span>
                </a>
            </li>

        </ul>
    </nav>

</aside>