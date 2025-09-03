// Theme JS for Apple-like interactions
document.addEventListener("DOMContentLoaded", function () {
    // Ripple effect on buttons
    document.querySelectorAll(".btn").forEach(btn => {
        btn.addEventListener("click", function (e) {
            let circle = document.createElement("span");
            circle.classList.add("ripple");
            this.appendChild(circle);

            let d = Math.max(this.clientWidth, this.clientHeight);
            circle.style.width = circle.style.height = d + "px";
            circle.style.left = e.clientX - this.offsetLeft - d / 2 + "px";
            circle.style.top = e.clientY - this.offsetTop - d / 2 + "px";

            setTimeout(() => circle.remove(), 600);
        });
    });

    // Auto-dismiss alerts
    const alerts = document.querySelectorAll(".alert-dismissible");
    alerts.forEach(alert => {
        setTimeout(() => {
            alert.classList.add("fade");
            setTimeout(() => alert.remove(), 500);
        }, 4000);
    });
});

