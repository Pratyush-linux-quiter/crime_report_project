function validateForm() {
    let name = document.getElementById("name").value;
    let email = document.getElementById("email").value;
    let phone = document.getElementById("phone").value;
    let crime_type = document.getElementById("crime_type").value;
    let description = document.getElementById("description").value;

    if (name === "" || email === "" || phone === "" || crime_type === "" || description === "") {
        alert("All fields are required!");
        return false;
    }

    if (phone.length !== 10 || isNaN(phone)) {
        alert("Please enter a valid 10-digit phone number.");
        return false;
    }

    return true;
}