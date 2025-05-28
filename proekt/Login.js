document.addEventListener("DOMContentLoaded", function() {
        const forma = document.getElementById("loginForm");

        forma.addEventListener("submit", (e) => {
        e.preventDefault(); 
                const formData = new FormData(e.target);
        const formObject = Object.fromEntries(formData.entries());

                fetch(e.target.action, {
            method: e.target.method,
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify(formObject),
        })
        .then(res => {
                        if (res.redirected) {
                window.location.href = res.url;
                return;
            }
                        return res.json();
        })
        .then(json => {
                        if (json.error) {
                const errorEl = document.createElement("p");
                errorEl.className = "error-message";
                errorEl.textContent = json.error;
                errorEl.style.color = "red";
                errorEl.style.fontSize = "0.8rem";
                                forma.insertBefore(errorEl, forma.firstChild);
            }
        })
        .catch(err => console.error(err));     });
});
