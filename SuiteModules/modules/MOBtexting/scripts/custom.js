
function numberValidation() {
    alert("Number is not a valid");
    return false;
}

function alertMessage(icon, title, text) {
    Swal.fire({
        icon: icon,
        title: title,
        text: text,
    });
}