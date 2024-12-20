function validateForm() {
    var name = document.getElementById("name").value;
    var email = document.getElementById("email").value;
    var message = document.getElementById("message").value;
    var emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;

    if (name.trim() === "") {
        alert("Name must be filled out");
        return false;
    }
    if (!emailPattern.test(email)) {
        alert("Please enter a valid email address");
        return false;
    }
    if (message.trim() === "") {
        alert("Message must be filled out");
        return false;
    }
    return true;
}