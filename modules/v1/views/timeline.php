<!-- source: https://bbbootstrap.com/snippets/single-listing-of-items-profiles-81642019 -->
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootswatch/4.3.1/flatly/bootstrap.min.css"> -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= assets("styles/timeline.css") ?>">
    <link href="https://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">


    <title>Timeline</title>
  </head>
  <body>
    <div class="container">
      <div class="card" >
        <div class="card-body">
          <form action="<?= base_url("share-post") ?>" method="post">
            <div class="form-group">
              <input type="text" class="form-control" name="title" placeholder="Enter title">
            </div>
            <div class="form-group mt-3">
              <input type="file" class="form-control" name="image" onchange="encodeImageFileAsURL(this)">
            </div>
            <div class="form-group mt-3">
              <input type="text" class="form-control" name="tagsinput" value="" placeholder="Please enter keywords seperated by comma">
            </div>
            <div class="form-group mt-3">
              <textarea class="form-control" placeholder="Enter detailed" name="body" rows="8" cols="80"></textarea>
            </div>
            <div class="form-group mt-3">
              <button type="button" class="btn btn-primary" id="share_post">Share</button>
            </div>
          </form>
        </div>
      </div>
      <!-- post starts here -->
      <div id="timeline_body" class="mb-5">
        <img class="timeline-loader" src="https://icon-library.com/images/loading-icon-transparent-background/loading-icon-transparent-background-12.jpg" alt="">
      </div>

    <!-- post ends here -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            ...
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Save changes</button>
          </div>
        </div>
      </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="<?= assets("scripts/post.js") ?>"></script>
    <script type="text/javascript">
      function encodeImageFileAsURL(element) {
        let file = element.files[0];
        let reader = new FileReader();
        reader.onloadend = function(e) {
           element.setAttribute("data-value", reader.result);
        }
        reader.readAsDataURL(file);
      }
    </script>
</div>
  </body>
</html>
