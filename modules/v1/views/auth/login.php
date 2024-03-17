<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= assets("styles/auth.css") ?>">
  </head>
<body>
  <div class="container">
    <div class="row">
      <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
        <div class="card border-0 shadow rounded-3 my-5">
          <div class="card-body p-4 p-sm-5">
            <h5 class="card-title text-center mb-5 fw-light fs-5">Sign In</h5>
            <?php if ($this->session->flashdata("message")): ?>
              <div class="alert alert-<?= $this->session->flashdata("type") ?>" role="alert">
                <?= $this->session->flashdata("message") ?>
              </div>
            <?php endif; ?>
            <form action="<?= base_url("login-action") ?>" method="POST">
              <div class="form-floating mb-3">
                <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email">
                <label for="email">Email address</label>
              </div>
              <div class="form-floating mb-3">
                <input type="password" class="form-control" id="password" name="password" placeholder="Enter password">
                <label for="password">Password</label>
              </div>

              <div class="d-grid">
                <button class="btn btn-primary btn-login text-uppercase fw-bold" type="submit">Sign in</button>
              </div>
              <hr class="my-4">
              <div class="d-grid mb-2">
                <a class="text-uppercase fw-bold" href="<?= base_url("register") ?>">
                  <i class="fab fa-google me-2"></i> Register now
                </a>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>

</html>
