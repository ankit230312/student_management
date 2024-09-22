</div>
</div>
</div>

<script src="assets/plugins/jquery/jquery-3.4.1.min.js"></script>
<script src="https://unpkg.com/@popperjs/core@2"></script>
<script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>
<script src="https://unpkg.com/feather-icons"></script>
<script src="assets/plugins/perfectscroll/perfect-scrollbar.min.js"></script>
<script src="assets/plugins/pace/pace.min.js"></script>
<script src="assets/js/main.min.js"></script>
<script>
    function togglePasswordVisibility(id,icon) {
        var passwordField = document.getElementById(id);
        var toggleIcon = document.getElementById(icon);

       
        if (passwordField.type === "password") {
            passwordField.type = "text";
            toggleIcon.classList.remove("fa-eye");
            toggleIcon.classList.add("fa-eye-slash");
        } else {
            passwordField.type = "password";
            toggleIcon.classList.remove("fa-eye-slash");
            toggleIcon.classList.add("fa-eye");
        }
    }
</script>
<script>
    setTimeout(function() {
        var successMsg = document.getElementById('successMessage');
        var errorMsg = document.getElementById('errorMessage');

        if (successMsg) {
            successMsg.style.display = 'none';
        }
        if (errorMsg) {
            errorMsg.style.display = 'none';
        }
    }, 10000);
</script>
</body>


</html>