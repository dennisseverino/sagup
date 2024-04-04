function updateRoleDescription() {
    var roleSelect = document.getElementById("role_name");
    var roleDescriptionInput = document.getElementById("role_description");

    // Get the selected value of the role_name dropdown
    var selectedRole = roleSelect.value;

    // Update the role_description field based on the selected role
    if (selectedRole === "Member") {
        roleDescriptionInput.value = "Main Workforce of the organization";
    } else if (selectedRole === "Secretary") {
        roleDescriptionInput.value = "Responsible for administrative tasks";
    } else if (selectedRole === "Admin") {
        roleDescriptionInput.value = "Oversees the website";
    }
}
