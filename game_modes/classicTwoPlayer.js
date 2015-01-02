var winW;
var winH;
//main game
var updateHolder;
function classicTwoPlayer(){ 
    Log("<br>game started");
    setColors();
    Log("<br>colors set");
    updateHolder=setInterval('update()',300);
    Log("<br>update started");
    $(".number").on("click",function(){
        
        var num=$(this);
         Log("<br>clicked "+num.html());
         num.css("background-color",game.myColor);
        $.ajax({type:"get",url:"game_php/check_no.php",data:{no:num.html()},success:function(reply){
            if(reply==1){
                //num.css("background-color",game.myColor);
                update();
                Log("<br>"+num.html()+" accepted");
            }
            else if (reply==0){
                //flashColor(num);
                num.css("background-color","white");
                Log("<br>"+num.html()+" denied");
            }
        },error:function(){
            alert("acceptance of number press error from server")
        }});
    });

}

function update(){
    $.ajax({type:"get",url:"game_php/update.php",success:function(reply){
        var obj=JSON.parse(reply);
        game.currentNo=obj.data.current_no;
        game.points1=obj.data.points1;
        game.points2=obj.data.points2;
        game.prevNoOwner=obj.data.prev_no_owner;
        Log("<br>updated "+game.currentNo);
        applyUpdate();
        if(game.currentNo==game.highestNo+1){
            clearInterval(updateHolder);
            Log("<br>game ends");
            showWinner();
        }
    }});
}

function applyUpdate(){
    $("#points1").html(game.points1);
    $("#points2").html(game.points2);
    $("#current-no").html(game.currentNo);
    var arr=document.getElementsByClassName("number");
    if(game.prevNoOwner==1){
       for(var i=0;i<arr.length;i++){
        if(arr[i].innerHTML==game.currentNo-1)
    arr[i].style.backgroundColor=game.color1;
}
}
else{
    for(var i=0;i<arr.length;i++){
        if(arr[i].innerHTML==game.currentNo-1)
    arr[i].style.backgroundColor=game.color2;
}

}
}
function setColors(){
    if(game.playerNo==1){
        game.myColor=game.color1;
        game.oppColor=game.color2;
    }
    else if(game.playerNo==2){
        game.myColor=game.color2;
        game.oppColor=game.color1;
    }
}

    function flashColor(num){
        var o_color=num.css("background-color");
    num.css("background","red");
    setTimeout(function(){
       num.css("background",o_color);
    },200);
}



//functions to load game

function loadLayout(){
    //send #game area dimensions to the server and set winH, winW and game.highestNo
    var gameW=window.innerWidth;
    var gameH=window.innerHeight-40;
    Log("<br>sending ajax to get smallest window size "+"<br>player no "+game.playerNo);
    $.ajax({type:"get",async:false,url:"php/get_game_area_dimensions.php",data:{gameH:gameH,gameW:gameW},success:function(reply){
        if(reply==""){
            setTimeout(function(){
                loadLayout();
            },500);
        }
        else{
        Log("<br>ajax success");
        var obj=JSON.parse(reply);
        Log("<br>parse successful<br>smallest size is"+reply+"<br>test width "+obj.size.width);
        winW=obj.size.width;
        winH=obj.size.height;
          $("#game").css("width", winW + "px").css("height", winH + "px");
        game.highestNo=findHighestNo(winH,winW);
        Log("<br>highestno "+game.highestNo);
        loadGame();
    }
    },error:function(){
        Log("<br>ajax error");
    }});
}

function loadPlayerReady(){
    Log("<br>waiting for players to accept playing");
    var pReady=document.getElementById("player"+game.playerNo);
    pReady.getElementsByClassName("name-ready")[0]=game.myName;
    pReady.getElementsByClassName("wait-status")[0].style.display="none";
    var oReady=document.getElementById("player"+game.oppNo);
    oReady.getElementsByClassName("name-ready")[0]=game.oppName;
    oReady.getElementsByClassName("wait-status")[0].innerHTML+=game.oppName+"...";
    oReady.getElementsByClassName("ready-status")[0].style.display="none";
    oReady.getElementsByClassName("ready-button")[0].style.display="none";
    Log("<br>loaded the interface for accepting match");
    $(".ready-button").on("click",function(){
        $.ajax({type:"get",async:false,url:"php/set_ready_to_play.php",success:function(reply){
            Log("<br>"+game.myName+" ready to play");
            pReady.getElementsByClassName("ready-button")[0].style.display="none";
            pReady.getElementsByClassName("ready-status")[0].style.display="none";
            pReady.getElementsByClassName("wait-status")[0].style.display="block";         
            pReady.getElementsByClassName("wait-status")[0].innerHTML="READY";
        }});
    });
    checkReadyToPlay();
}
function checkReadyToPlay(){
    $.ajax({type:"get",async:false,url:"php/check_ready_to_play.php",success:function(reply){
        var obj=JSON.parse(reply);
        if(obj.states.opp1=="ready_play" && obj.states.opp2=="ready_play"){
            //oReady.getElementsByClassName("wait-status").innerHTML="READY";
            //setTimeout('function(){}',100);
            Log("<br>both oppoents accepted");
            $("#hide-game").css("display","none");
        }
        else{
            if(obj.states.opp1=="ready_play" && game.oppNo==1){
                var oReady=document.getElementById("player"+game.oppNo);
                oReady.getElementsByClassName("wait-status")[0].innerHTML="READY";
                Log("<br>"+game.oppName+" ready to play");
            }
            else if(obj.states.opp2=="ready_play" && game.oppNo==2){
                var oReady=document.getElementById("player"+game.oppNo);
                oReady.getElementsByClassName("wait-status")[0].innerHTML="READY";
                Log("<br>"+game.oppName+" ready to play");
            }
            setTimeout('checkReadyToPlay()',100);
        }
    },error:function(){
        alert("error from server");
    }});
}

function bothOpponentsReady() {
   
                var isready = false;
                $.ajax({type: 'get', async: false, url: "php/both_opponents_ready.php", success: function(reply) {
                        if (reply == "ready") {
                            Log("<br>"+reply);
                            //$("#feedback").html("Loading..");
                            isready = true;
                        }
                        else {
                            Log("<br>"+reply);
                            //$("#feedback").html("Waiting for other opponent..");
                        }
                    }});
                return isready;
            }