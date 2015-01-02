 function initSVG(){
                var svgdoc=null;
                var svgobj=document.getElementById("menu-obj");
                if(svgobj && svgobj.contentDocument){
                    svgdoc=svgobj.contentDocument;
                }
                else try{
                    svgdoc=svgobj.getSVGDocument();
                }
                catch(e){
                    alert("could not get svg"+e.message);
                }
                var svgBtn=svgdoc.getElementById("icon-menu");
                svgBtn.addEventListener("click",function(){
                    $("#menu-box").css("visibility","visible");
                    $("#main").css("visibility","hidden");
                });
               

                 var svgdoc=null;
                var svgobj=document.getElementById("close-obj");
                if(svgobj && svgobj.contentDocument){
                    svgdoc=svgobj.contentDocument;
                }
                else try{
                    svgdoc=svgobj.getSVGDocument();
                }
                catch(e){
                    alert("could not get svg"+e.message);
                }
            
                var svgX=svgdoc.getElementById("icon-close");
                svgX.addEventListener("click",function(){
                    $("#menu-box").css("visibility","hidden");
                    $("#main").css("visibility","visible");
                });
            }
            $(function(){
                $("#sign-out").on("click",function(){
                    window.location.href="php/logout.php"
                })
            });
            window.onload=function(){
                initSVG();
            }