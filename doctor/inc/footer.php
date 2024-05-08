</div>
    </div>

    <?php include "../inc/js_link.php"; ?>
</body>
<script>
    $(document).ready(function() {
        $("#departmentId").on("click", function() {
            $("#departmentId #arrow").toggleClass("fa-solid fa-chevron-right").addClass("fa-solid fa-chevron-down");
        });

        $("#doctorId").on("click", function() {
            $("#doctorId #arrow").toggleClass("fa-solid fa-chevron-right").addClass("fa-solid fa-chevron-down");
        });

    });
</script>

</html>