let checkCheat=0;

document.addEventListener('keydown', function (event) { // opens the dev console
    if (event.ctrlKey && event.altKey && event.key == 'y' && checkCheat===0) {

        document.getElementById("devConsole").style.display = "block";
        checkCheat=1;
    } else if (event.ctrlKey && event.altKey && event.key == 'y' && checkCheat===1) {document.getElementById("devConsole").style.display = "none"; checkCheat=0;}
});