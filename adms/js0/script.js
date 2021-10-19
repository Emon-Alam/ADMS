var formEl = document.querySelector("form");
formEl.userName.addEventListener("keyup", (e) => {
	if (formEl.userName.value == "")
		document.getElementById("uErr").style.display = "inline";
	else
		document.getElementById("uErr").style.display = "none";
});
formEl.password.addEventListener("keyup", (e) => {
	if (formEl.password.value == "")
		document.getElementById("pErr").style.display = "inline";
	else
		document.getElementById("pErr").style.display = "none";
});
document.querySelectorAll("input[type=radio]").forEach(el => {
	el.addEventListener("change", e => {
		if (formEl.type.value == "") {
			document.getElementById("tErr").style.display = "inline";
		}
		else
			document.getElementById("tErr").style.display = "none";
	});
});

formEl.addEventListener("submit", e => {
	if (formEl.type.value == "") {
		e.preventDefault();
		document.getElementById("tErr").style.display = "inline";
	}
	else
		document.getElementById("tErr").style.display = "none";
	if (formEl.userName.value == "") {
		e.preventDefault();
		document.getElementById("uErr").style.display = "inline";
	}
	else
		document.getElementById("uErr").style.display = "none";
	if (formEl.password.value == "") {
		e.preventDefault();
		document.getElementById("pErr").style.display = "inline";
	}
	else
		document.getElementById("pErr").style.display = "none";
});
