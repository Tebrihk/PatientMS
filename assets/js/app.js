// Add hover effects or small dynamic behaviors
document.addEventListener("DOMContentLoaded", function() {
    // File upload preview
    const fileInput = document.querySelector("#fileUpload");
    const preview = document.querySelector("#filePreview");
    
    if (fileInput && preview) {
        fileInput.addEventListener("change", function() {
            if (this.files && this.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                };
                reader.readAsDataURL(this.files[0]);
            }
        });
    }
});
