<!-- <div class="py-6 px-6 text-center">
    <p class="mb-0 fs-4">Design and Developed by <a href="https://www.my-alopedia.com/" target="_blank" class="pe-1 text-primary text-decoration-underline">Alopedia</a></p>
</div> -->
</div>
</div>
</div>
<script src="<?= base_url() ?>/assets/libs/jquery/dist/jquery.min.js"></script>
<script src="<?= base_url() ?>/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<script src="<?= base_url() ?>/assets/js/sidebarmenu.js"></script>
<script src="<?= base_url() ?>/assets/js/app.min.js"></script>
<script src="<?= base_url() ?>/assets/libs/simplebar/dist/simplebar.js"></script>
<script src="<?= base_url() ?>/assets/js/dashboard.js"></script>

<!-- ====================================================== -->
<!-- ======================= SELECT2 ====================== -->
<!-- ====================================================== -->

<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha256-7dA7lq5P94hkBsWdff7qobYkp9ope/L5LQy2t/ljPLo=" crossorigin="anonymous"></script>
<!-- select2 -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js" integrity="sha256-AFAYEOkzB6iIKnTYZOdUf9FFje6lOTYdwRJKwTN5mks=" crossorigin="anonymous"></script>

<!-- ===================================================== -->
<!-- ===================  DATATABLES  ==================== -->
<!-- ===================================================== -->

<script src="<?= base_url() ?>/assets/libs/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url() ?>/assets/libs/datatables/dataTables.bootstrap4.min.js"></script>
<script src="<?= base_url() ?>/assets/js/datatables-demo.js"></script>

<!-- ===================================================== -->
<!-- ===================  FULLCALENDAR  ================== -->
<!-- ===================================================== -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script>

<!-- ====================================================== -->
<!-- ======================= SCRIPT ======================= -->
<!-- ====================================================== -->

<script>
    $('#select_ruangan,#select_spesialis, #select_tindakan,#select_sub_spesialis, #alat-alat, #jns-kelamin, #dokter-bedah, #dokter-bius, #hari-praktek,  #dokter-asisten-bius, #dokter-asisten-operator, #nama-pasien-dropdown').select2({
        theme: 'bootstrap4',
        width: '100%', // You can customize the width here
        allowClear: true,
    });
</script>

</body>

</html>