## Overview

Goal: Create a desktop/mobile self-sufficient quiz with questions 
from a database. You are able to do the following 3 things directly 
on the webpage:

do random generated quizzes, study a detailed evaluation;  
add, change or hide questions; 

## Features/Notes:

* Randomly generated quiz every time you reload the webpage. Number of questions are adjustable.
* Add a new question with a maximum of 4 answers
* 2 answer typee: radio and check boxes
* Evaluation each individual question; use of svg to display the result graphically
* Validation of: user answers, new quiz, add questions
* I used to following tools t to to create the project: Bootstrap, HTML; CSS; JS; PHP; SQL; PHPmyAdmin
* How to open the developer console which shows $_SESSION and $_POST: ctrl + alt + y
* Hide instead of deleting of database entries
* Mobile second (sort of)

## Problems

* A lot of duplicate code. More use of php include and loops.
* If a question has less than the default 4 answers caused a lot 
more problems to solve and more code to write
* Evaluation formula: big problems with division by zero

## Versions

Day 1-2     Bootstrap grid; Show questions (PHP/SQL: SELECT); Evaluation text and formula
Day 3-4     Randomize order (rand(0); array "pointer")
Day 5-6     Add questions (PHP/SQL: INSERT; prepate; execute)
Day 7-8     Change questions (PHP/SQL: UPDATE; "hide" database entries)
Day 9-10    Validation
Day 10-11   General improvements (add evaluation svg diagram; formula adjustments; more validations)

## Misc
* Valdidation gibt Warnung aus bei: Keine Antwort ausgewählt; Fragelimit unter- oder überschritten; geplant: weniger als 2 Antworten (bei hiding)
* Highscore fehlt


