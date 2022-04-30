function evaluateAddQuestion(){

    let addAnswer = document.querySelectorAll("input[id*=aa]");    

    let countFilledAnswers = 0;

    if (document.getElementById("qq").value === ""){
        document.getElementById("validationMessage").innerText = "A Question and at least 2 answers are required";
        return false;
    }

    for(let i=0; i<addAnswer.length; i++) {

        if (addAnswer[i].value != "") {
            
            countFilledAnswers++;
        }
    }

    if (countFilledAnswers < 2){

        document.getElementById("validationMessage").innerText = "A Question and at least 2 answers are required";
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

            document.getElementById("validationMessage").innerText = "Please choose an answer (put a tick)";
            return false;
        }

    }

    return true;
}

function evaluateNewQuizLimit(){

    if (parseInt(document.getElementById('userNewQuiz').value) < 1){
        document.getElementById("validationMessage").innerText = "Minimum 1 question required";
        document.getElementById('userNewQuiz').value = "";
        return false;
    }
   
    if(parseInt(document.getElementById('userNewQuiz').value) > parseInt(document.getElementById('totalQuestions').innerText)) {
        document.getElementById("validationMessage").innerText = "Maximum "+document.getElementById('totalQuestions').innerText+" questions available";
        document.getElementById('userNewQuiz').value = "";
        return false;
    }

    return true;

}

