function evaluateAddQuestion(){

    let addAnswer = document.querySelectorAll("input[id*=aa]");    

    let countFilledAnswers = 0;

    if (document.getElementById("qq").value === ""){
        /*alert("ok");*/
        document.getElementById("infoBar").innerHTML = '&#10083; A Question and at least 2 answers are required &#10083; ';
        document.getElementById("infoBar").style.color = "red";
        return false;
    }

    for(let i=0; i<addAnswer.length; i++) {

        if (addAnswer[i].value != "") {
            
            countFilledAnswers++;
        }
    }

    if (countFilledAnswers < 2){

        document.getElementById("infoBar").innerHTML= "&#10083; A Question and at least 2 answers are required &#10083; ";
        document.getElementById("infoBar").style.color = 'red';
        countFilledAnswers = 0;
        return false;
    }

    return true;
}

function evaluateAnswer() { // user validation

    //alert("ok3");

    if(document.querySelectorAll("input[id*=qr]").length > 0){        

        let radioButton = document.querySelectorAll("input[id*=qr]:checked");

        if(radioButton.length === 0) {

            document.getElementById("infoBar").innerHTML = "&#10083; Please choose an answer &#10083; ";
            document.getElementById("infoBar").style.color = 'red';
            return false;
        }

    }

    return true;
}

function evaluateNewQuizLimit(){

        if (parseInt(document.getElementById('userNewQuiz').value) < 1){
        document.getElementById("infoBar").innerHTML = "&#10083; Minimum 1 question required &#10083; ";
        document.getElementById("infoBar").style.color = 'red';
        document.getElementById("userNewQuiz").value = "";
        return false;
    }
    
    if(parseInt(document.getElementById('userNewQuiz').value) > parseInt(document.getElementById('totalQuizQuestions').innerText)) {

        document.getElementById("infoBar").innerHTML = "&#10083; Maximum "+document.getElementById('totalQuizQuestions').innerText+" questions available &#10083;";
        document.getElementById("infoBar").style.color = 'red';
        document.getElementById('userNewQuiz').value = "";
        return false;
    }

    return true;

}

