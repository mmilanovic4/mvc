/**
 * Тестирање да ли ЈаваСкрипт модули и API позив раде
 */
window.onload = function () {
	let xhr = new XMLHttpRequest();
	xhr.open('GET', 'http://localhost/dev/MVC/api/tasks');

	xhr.onreadystatechange = function () {
		if (this.readyState === 4 && this.status === 200) {
			let data = JSON.parse(this.responseText);
			console.log(data);
		}
	};

	xhr.send();
};
