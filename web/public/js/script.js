function shineLinks() {
    try {
        // var el = document.getElementById(id).getElementsByTagName('a'); //ищем наш div в <span class="caps">DOM</span>
        let elemets = document.querySelectorAll('a');
        let change = document.querySelectorAll('li');
        let url = document.location.href; //палим текущий урл

        for (let i = 0; i < elemets.length; i++)
        {
            if (url == elemets[i].href) {
                change[i].className = 'aside-nav__item active'; //если урл==текущий, добавляем класс
            }
            ;
        }
        ;
    } catch (e) {
    }
};

shineLinks()