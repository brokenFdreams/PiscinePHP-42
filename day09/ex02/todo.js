


function newTodo() {
	var todo = prompt("Please enter new event", "");
	if (todo !== '')
		addTodo(todo);
}

function addTodo(todo) {
	var div = document.createElement("div");
	div.innerHTML = todo;
	div.addEventListener("click", removeTodo);
	document.getElementById("ft_list").appendChild(div);
}

function removeTodo() {
	if (confirm("Are you sure to remove this element?"))
		this.parentElement.removeChild(this);
}