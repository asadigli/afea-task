<!-- source: https://www.bootdey.com/snippets/view/profile-with-data-and-skills#html -->

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= assets("styles/master.css") ?>">
    <title><?= Auth::full_name() ?></title>
  </head>
  <body>
    <div class="container">
      <div class="main-body">

            <!-- Breadcrumb -->
            <nav aria-label="breadcrumb" class="main-breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url() ?>">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page"><?= Auth::full_name() ?></li>
              </ol>
            </nav>
            <!-- /Breadcrumb -->

            <div class="row gutters-sm">
              <div class="col-md-4 mb-3">
                <div class="card">
                  <div class="card-body">
                    <div class="d-flex flex-column align-items-center text-center">
                      <img src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="Admin" class="rounded-circle" width="150">
                      <div class="mt-3">
                        <h4><?= Auth::full_name() ?></h4>
                        <!-- <p class="text-secondary mb-1">Full Stack Developer</p>
                        <p class="text-muted font-size-sm">Bay Area, San Francisco, CA</p>
                        <button class="btn btn-primary">Follow</button>
                        <button class="btn btn-outline-primary">Message</button> -->
                        <hr>
                        <a href="<?= base_url("logout") ?>">Log out</a>
                      </div>
                    </div>
                  </div>
                </div>

              </div>
              <div class="col-md-8">
                <div class="card mb-3">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-sm-3">
                        <h6 class="mb-0">Full Name</h6>
                      </div>
                      <div class="col-sm-9 text-secondary">
                        <?= Auth::full_name() ?>
                      </div>
                    </div>
                    <hr>
                    <div class="row">
                      <div class="col-sm-3">
                        <h6 class="mb-0">Email</h6>
                      </div>
                      <div class="col-sm-9 text-secondary">
                        <?= Auth::email() ?>
                      </div>
                    </div>
                    <hr>
                    <div class="row">
                      <div class="col-sm-3">
                        <h6 class="mb-0">Posts</h6>
                      </div>
                      <div class="col-sm-9 text-secondary">
                        <a href="<?= base_url("timeline") ?>">go to posts</a>
                      </div>
                    </div>

                  </div>
                </div>



              </div>
            </div>

          </div>
      </div>
  </body>
</html>
