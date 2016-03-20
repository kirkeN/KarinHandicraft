window.onload = function(){
	if (document.getElementById('tootedmenu') != null ) { 
		pics = document.getElementsByClassName("tootepilt");
			for (var i = 0; i < pics.length; i++){
				pics[i].onclick = function(){
					showDetails(this);
					return false; //muidu laetakse leht ümber
				}
			}		
	}	
}

window.onresize=function() {
	suurpilt=document.getElementById("suurpilt");
	suurus(suurpilt);
}

function showDetails(el){
	hoidja=document.getElementById('hoidja');
	if (hoidja != null) {
		suurpilt=document.getElementById("suurpilt");
		suurpilt.src=el.src; //annan suurele pildile tema lingi
		suurpilt.onload=function(){
			suurus(this);
		}
		document.getElementById("inf").innerHTML=el.alt;
		hoidja.style.display="initial";
	}
}
	
function showRandom (){
	pics = document.getElementsByClassName("tootepilt");
	showDetails(pics[Math.floor((Math.random() * pics.length) + 1)]);
}


function hideDetails() {
	document.getElementById('hoidja').style.display="none";
}
			
function suurus(el){
	el.removeAttribute("height");
	el.removeAttribute("width");
	if (el.width>window.innerWidth || el.height>window.innerHeight){
// ainult liiga suure pildi korral
		if (window.innerWidth >= window.innerHeight){
			el.height=window.innerHeight*0.9;
//console.log('ekraan on lapik')
// kas element läheb ikka üle piiri?
			if (el.width>window.innerWidth){
				el.removeAttribute("height");
				el.width=window.innerWidth*0.9;
			}
		} else {
			el.width=window.innerWidth*0.9;	
//console.log("ekraan on piklik")
// kas element läheb ikka üle piiri?
			if (el.height>window.innerHeight){
				el.removeAttribute("width");
				el.height=window.innerHeight*0.9;
			}
		}
	}
}		