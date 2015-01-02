//single player
//you are supposed to tap all the numbers in their order before time runs out

function timeRush() {
    //loadInterface();
    var secs=game.time%60;
    var mins=Math.floor(game.time/60);
    startTimer(mins, secs);
    loadNumbers(game.highestNo);
    removeOne();
    $(".number").on("click", function() {
        clickedNum = $(this);
        if (clickedNum.html() == game.currentNo) {
            if(game.currentNo==game.highestNo){
                stopTimer();
            }
            clickedNum.css("box-shadow", "0 0 12px orangered").css("background-color", "orangered");
            game.currentNo++;
            $("#current-no").html(game.currentNo);
        }
    });
}
function fineTune(){
                var username = prompt("Create username", "");
                $("#username").html(username);
                alert("Instructions: tap all the numbers in their order before the time runs out");
                seed = Math.random() * 1000;
                game.currentNo = 1;
                winH = window.innerHeight - 40;
                winW = window.innerWidth;
                game.highestNo=findHighestNo(winH,winW);
                game.time=game.highestNo*3;
                $("#game").css("width", winW + "px").css("height", winH + "px");
            }

            function removeOne() {
    var arr = document.getElementsByClassName("number");
    for (i = 0; i < arr.length; i++) {
        if (arr[i].innerHTML == "2") {
           
            arr[i].style.display = "none";
            break;
        }
    }
}
var TimeLeft = {
}
function startTimer(mins, secs) {
    TimeLeft.mins = mins;
    TimeLeft.secs = secs;
    c = setInterval('displayTime()', 1000);
}
function displayTime() {
    $("#timer").html(TimeLeft.mins + " : " + TimeLeft.secs);
    if (TimeLeft.secs === 0 && TimeLeft.mins === 0) {
        stopTimer();
    }
    else {
        if (TimeLeft.secs == 0) {
            TimeLeft.secs = 59;
            TimeLeft.mins -= 1;
        }
        else {
            TimeLeft.secs -= 1;
        }
    }
}
function stopTimer() {
    clearInterval(c);
    if(game.currentNo==game.highestNo){
        alert("you win");
    }
    else{
        alert("game over");
    }
}