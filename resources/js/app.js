// In your app.js
document.addEventListener("click", (e) => {
    if (e.target.matches('[data-action="hide-alert"]')) {
        e.target.parentElement.style.display = "none";
    }
});
