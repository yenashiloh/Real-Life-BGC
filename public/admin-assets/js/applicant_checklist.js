const documentTypes = [
    { type: "Signed Application Form", checkboxId: "flexCheckDefault1" },
    { type: "Birth Certificate", checkboxId: "flexCheckDefault2" },
    { type: "Character Evaluation Forms", checkboxId: "flexCheckDefault3" },
    { type: "Proof of Financial Status", checkboxId: "flexCheckDefault4" },
    { type: "Application Form", checkboxId: "flexCheckDefault5" },
    { type: "Two Reference Forms", checkboxId: "flexCheckDefault6" },
    { type: "Home Visitation Form", checkboxId: "flexCheckDefault7" },
    { type: "Report Card / Grades", checkboxId: "flexCheckDefault8" },
    { type: "Tuition Projection", checkboxId: "flexCheckDefault9" },
    { type: "Admission Slip", checkboxId: "flexCheckDefault10" },
    { type: "Character References", checkboxId: "flexCheckDefault11" },
    { type: "Official Grading System", checkboxId: "flexCheckDefault12" },
    { type: "Prospectus", checkboxId: "flexCheckDefault13" }
];



//checkbox not clickable
document.addEventListener('DOMContentLoaded', function () {
    const checkboxes = document.querySelectorAll('.non-clickable-checkbox');
    checkboxes.forEach(checkbox => {
        checkbox.addEventListener('click', function (e) {
            e.preventDefault(); // Prevent the checkbox from being checked/unchecked
        });
        checkbox.style.cursor = 'not-allowed'; // Change cursor to indicate non-clickable
    });
});
