<div class="card">
    <div class="card-header py-3 d-flex justify-content-between align-items-center">
        <h6 class="m-0 font-weight-bold text-primary">TAMBAH ADMIN</h6>
    </div>
    <div class="card-body">
        <?= $this->session->flashdata('message'); ?>
        <form action="<?= base_url($url) ?>" method="POST">
            <div class="mb-3">
                <label for="username" class="form-label">USERNAME</label>
                <input type="text" class="form-control" id="username" name="username" value="<?= isset($account->username) ? $account->username : '' ?>">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">PASSWORD</label>
                <div class="input-group">
                    <input type="password" class="form-control" id="password" name="password" value="">
                    <span class=" input-group-text" style="cursor: pointer;" id="togglePassword">
                        <i class="ti ti-eye-off"></i>
                    </span>
                </div>
            </div>
            <div class="mb-3">
                <label for="role-access" class="form-label">ROLE ACCESS</label>
                <select id="role-access" class="form-select" name="role_access">
                    <option value="">Pilih Access</option>
                    <option value="1" <?= (isset($account->role_access) && $account->role_access == "1") ? "selected" : "" ?>>JADWAL</option>
                    <option value="2" <?= (isset($account->role_access) && $account->role_access == "2") ? "selected" : "" ?>>OPERATOR</option>
                </select>
            </div>
            <div class="mb-3">
                <button class="btn btn-info col-12" type="submit" id="submitBtn">SIMPAN</button>
            </div>
        </form>
    </div>
</div>

<script>
    const togglePassword = document.getElementById("togglePassword");
    const password = document.getElementById("password");
    const submitBtn = document.getElementById("submitBtn");

    togglePassword.addEventListener("click", function() {
        const type = password.getAttribute("type") === "password" ? "text" : "password";
        password.setAttribute("type", type);

        // toggle the icon
        this.querySelector("i").classList.toggle("ti-eye-off");
        this.querySelector("i").classList.toggle("ti-eye");
    });
</script>