function select (element) {
    return document.querySelector(element)
}
function selectAll (element) {
    return document.querySelectorAll(element)
}

let checkBox = select('.checkbox-theme')
let discord = select('iframe')

if (localStorage.getItem('black-theme') == 'true') {
    if (discord)
    {
        discord.setAttribute('src', 'https://discord.com/widget?id=249297598530191361&theme=dark')
    }
    theme.setAttribute('href', '/public/css/black_style.css')
    if (checkBox) {
        checkBox.checked = true
    }
}

if (checkBox) {
    checkBox.onchange = function () {
        if(this.checked) {
            localStorage.setItem('black-theme', true)
            if (discord){
                discord.setAttribute('src', 'https://discord.com/widget?id=249297598530191361&theme=dark')
            }
            theme.setAttribute('href', '/public/css/black_style.css')
        } else {
            localStorage.setItem('black-theme', false)
            if (discord){
                discord.setAttribute('src', 'https://discord.com/widget?id=249297598530191361&theme=light')
            }
            theme.setAttribute('href', '/public/css/style.css')
        }
    }
}