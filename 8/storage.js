let formData = {};
const form = document.querySelector("form");
const LS = localStorage;

form.addEventListener("input", function (event) {
    formData[event.target.name] = event.target.value;
    LS.setItem("formData", JSON.stringify(formData));
});

if (LS.getItem("formData")) {
    formData = JSON.parse(LS.getItem("formData"));
    for (let key in formData) {
        if (
            form.elements[key].type === "checkBox" &&
            form.elements[key].value === "on"
        ) {
            form.elements[key].checked = true;
        } else {
            form.elements[key].value = formData[key];
        }
    }
}