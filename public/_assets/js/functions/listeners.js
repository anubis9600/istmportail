
let myDiv = document.querySelector('div.menu-entrance')
let myButton = document.querySelector('.item-menu .icon-menu')
let iconDown = document.getElementById('down')
let iconUp = document.getElementById('up')

var listenerFunctions = {
    manageMenu: (event)=>{
        if (myDiv.style.display == "none" && iconDown.style.display == "block" && iconUp.style.display == "none"){
            myDiv.style.display = "block"
            iconDown.style.display = "none"
            iconUp.style.display = "block"
        }else{
            myDiv.style.display = "none"
            iconDown.style.display = "block"
            iconUp.style.display = "none"
        }
        
    }
}

var setupListeners = () =>{
    myButton.onmousedown = listenerFunctions.manageMenu
}