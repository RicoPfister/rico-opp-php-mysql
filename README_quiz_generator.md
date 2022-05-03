## Overview

Goal: Create a desktop/mobile self-sufficient quiz with questions 
from a database. You are able to do the following 3 things directly 
on the webpage:

do random generated quizzes, study a detailed evaluation;  
add, change or hide questions; 

## Features/Notes:

* Randomly generated quiz every time you reload the webpage. Number of questions are adjustable.
* Add a new question with a maximum of 4 answers
* Evaluation of the entire quiz and each individual question
* Validations: user answers, new quiz, add questions
* What I used to realize to project: Bootstrap, HTML; CSS; JS; PHP; SQL; PHPmyAdmin
* How to open the developer console which shows $_SESSION and last $_POST: ctrl + alt + y
* Hide instead of deleting of database entries
* Mobile second (sort of)

## Problems

* A lot of duplicate code. More use of php include and loops.
* If a question has less than the default 4 answers caused a lot 
more problems to solve and more code to write
* Evaluation formula: big problems with division by zero

## Versions

1. test

## Misc
* Valdidation gibt Warnung aus bei: Keine Antwort ausgewählt; Fragelimit unter- oder überschritten; geplant: weniger als 2 Antworten (bei hiding)
* Highscore fehlt


