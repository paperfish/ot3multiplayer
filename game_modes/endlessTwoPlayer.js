//when a number is peressed it is replaced by the current highest number plus one
//two player endless

function endlessTwoPlayer(){
    //alert(getNumber(1));
	    Log("<br>game started");
    setColors();
    Log("<br>colors set");
    updateHolder=setInterval('updateEndless()',300);
    Log("<br>update started");
    $(".number").on("click",function(){
        
        var num=$(this);
         Log("<br>clicked "+num.html());
         num.css("background-color",game.myColor);
        $.ajax({type:"get",url:"game_php/check_no.php",data:{no:num.html()},success:function(reply){
            if(reply==1){
                //num.css("background-color",game.myColor);
                updateEndless();
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
function updateEndless(){
	$.ajax({type:"get",url:"game_php/update.php",success:function(reply){
        var obj=JSON.parse(reply);
        game.currentNo=obj.data.current_no;
        game.points1=obj.data.points1;
        game.points2=obj.data.points2;
        game.prevNoOwner=obj.data.prev_no_owner;
        Log("<br>updated "+game.currentNo);
        applyUpdate();
        if(existNumber(game.currentNo-1)){
        setTimeout(function(){
                    var num=createNumber(game.highestNo+1);
                    num.style.left=getNumber(game.currentNo-1).style.left;
                    num.style.top=getNumber(game.currentNo-1).style.top;
                    getNumber(game.currentNo-1).remove();
                    addNumber(num);
                    //$("#game").append(num);
                    game.highestNo++;
        },1000);
    }

    }});

}
function existNumber(num){
    var arr=document.getElementsByClassName("number");
    for(var i=0;i<arr.length;i++){
        if(arr[i].innerHTML==num){
            return true;
        }
    }
    return false;
}
function getNumber(num){
       var arr=document.getElementsByClassName("number");
    for(var i=0;i<arr.length;i++){
        if(arr[i].innerHTML==num){
            return arr[i];
        }
    }
    return null;
}
