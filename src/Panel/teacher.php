<?php

    if(!isset($user)) header("Location: ../"); 

?>

<aside>
    <nav>
        <ul class="nav">       
            <li aria-value="messages">Wiadomości</li>
            <li aria-value="groups">Grupy</li>
            <li aria-value="singOut">Wyloguj</li>
        </ul>
    </nav>
</aside>

<script>
    const navItems = document.querySelectorAll('nav li');
    navItems.forEach(navItem => {
        navItem.addEventListener('click', () => {
            let site = navItem.getAttribute('aria-value');
            window.location.replace(`./?site=${site}`)
        });
    });
</script>