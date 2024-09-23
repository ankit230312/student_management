<script src="../assets/plugins/jquery/jquery-3.4.1.min.js"></script>
<script src="https://unpkg.com/@popperjs/core@2"></script>
<script src="../assets/plugins/bootstrap/js/bootstrap.min.js"></script>
<script src="https://unpkg.com/feather-icons"></script>
<script src="../assets/plugins/perfectscroll/perfect-scrollbar.min.js"></script>
<script src="https://cdn.datatables.net/2.1.7/js/dataTables.js"></script>
<script src="../assets/plugins/pace/pace.min.js"></script>
<script src="../assets/js/main.min.js"></script>
<script>
    toastr.options = {
        "closeButton": true,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "timeOut": "5000"
    };
</script>

<script>
    (function() {
        'use strict';
        var forms = document.querySelectorAll('.needs-validation');

        Array.prototype.slice.call(forms)
            .forEach(function(form) {
                form.addEventListener('submit', function(event) {
                    if (!form.checkValidity()) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
    })();
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
    }, 2000);
</script>

<script>
    setTimeout(function() {
        var successMsgs = document.getElementsByClassName('alert');  
        
        for (var i = 0; i < successMsgs.length; i++) {
            successMsgs[i].style.display = 'none';
        }

    }, 2000); 
</script>

<script>
  $(document).ready(function() {
    $('.status-toggle').change(function() {
      var studentId = $(this).data('id');
      var status = this.checked ? 'Active' : 'Inactive';

      $.ajax({
        url: 'ajax/update_status.php',  
        type: 'POST',
        data: { id: studentId, status: status },
        success: function(response) {
          if (response == 'success') {
            alert('Student ' + status);
           
          } else {
            alert('Failed to update status');
          }
        }
      });
    });
  });
</script>

<script>
   let table = new DataTable('#student_data', {
    columnDefs: [
        { 
            targets: -1,  
            width: '200px' 
        }
    ]
});

</script>
</body>


</html>