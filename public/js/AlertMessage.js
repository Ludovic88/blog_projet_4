AlertMessage = function(){

	this.createDivAlert = function(elt, className, text){
		var element = document.createElement(elt);
		element.setAttribute("class", className);
		element.textContent = text;
		return element;
	}

	this.newPost = function(){
		this.createDivAlert("div", "alert alert-success visible", "Chapitre ajouté avec succès");
		var divAlertElt = document.querySelector(".alert");
		var container = document.querySelector(".block_page");
		container.appendChild(divAlertElt);
		setTimeout(function () {
	        divAlertElt.classList.remove("visible");
	        divAlertElt.textContent = "";
        }, 5000);  
	}

	this.init = function(){
		document.getElementById('new-post').addEventListener("click", this.newPost.bind(this));
	}

	this.init();


}

var alertMessage = new AlertMessage();