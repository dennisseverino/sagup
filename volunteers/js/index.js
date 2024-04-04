// Function to update program description based on the selected program
function updateProgramDescription() {
    var programSelect = document.getElementById("program_name");
    var programDescriptionInput = document.getElementById("program_description");

    // Get the selected value of the program_name dropdown
    var selectedProgram = programSelect.value;

    // Update the program_description field based on the selected program
    if (selectedProgram === "herozero") {
        programDescriptionInput.value = "Helps Vendors";
    } else if (selectedProgram === "foodwastemitigation") {
        programDescriptionInput.value = "Helps clean the environment.";
    } else if (selectedProgram === "foodpantry") {
        programDescriptionInput.value = "Help provide food for those in need.";
    }
}

// Call the function when the DOM content is loaded
document.addEventListener("DOMContentLoaded", function() {
    updateProgramDescription(); // Initialize program description
});

