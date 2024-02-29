<div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed">
    <div class="position-relative overflow-hidden radial-gradient min-vh-100 d-flex align-items-center justify-content-center">
        <div class="d-flex align-items-center justify-content-center w-100">
            <div class="row justify-content-center w-100">
                <div class="col-md-8 col-lg-4 col-xxl-3">
                    <div class="card mb-0">
                        <div class="card-body">
                            <div class="text-nowrap logo-img text-center d-block py-3 w-100">
                                <img src="<?= base_url() ?>/assets/images/logo/lambangkecil.png" width="180" alt="">
                            </div>
                            <?= $this->session->flashdata('message'); ?>
                            <form action="<?= base_url() ?>" method="POST">
                                <div class="mb-3">
                                    <label for="username" class="form-label">Username</label>
                                    <input type="text" class="form-control" id="username" name="username" aria-describedby="emailHelp">
                                </div>
                                <div class="mb-4">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" class="form-control" id="password" name="password">
                                    <p id="output_text" style="color: red;font-size: 12px;font-style: italic;display: none;">Caps lock is ON.</p>  
                                </div>
                                <hr class="mt-3 mb-3">
                                <button type="submit" class="btn btn-primary w-100 py-8 fs-4 mb-4 rounded-2">Sign In</button>
                                <div class="d-flex align-items-center justify-content-center">
                                </div>
                                <div class="d-flex justify-content-center gap-2">
                                    <a href="<?= base_url("monitoring/operasi") ?>">
                                        <div class="card">
                                            <div class="card-body text-center">
                                                <img src="<?= base_url("assets/images/spyware.png") ?>" class="mb-3" width="10%">
                                                <p style="font-size: 14px;font-weight: bold;">MONITORING PASIEN OPERASI</p>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function() {
    var output_text = document.getElementById("output_text");

    document.addEventListener("keydown", function(event) {
        var capsLockState = event.getModifierState("CapsLock");
        if (capsLockState) {
            output_text.style.display = "block";
        } else {
            output_text.style.display = "none";
        }
    });
});
</script>
