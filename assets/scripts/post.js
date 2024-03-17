$(function(){

  const postComponent = (id,image,title,body,added_date,tags) => {
    return `<div class="card mt-5 border-5 pt-2 active pb-0 px-3">
        <div class="card-body ">
            <div class="row">
                <div class="col-12 ">
                    <h4 class="card-title "><b>${title}</b></h4>
                </div>
                <div class="col">
                    <h6 class="card-subtitle mb-2 text-muted">
                    ${image ? `<img src="${image}" class="post-image mb-3">` : ""}
                        <p class="card-text text-muted small ">
                          ${body}
                        </p>
                        ${tags ? `<div class="post-tags">
                          ${tags.map(v =>  `<span>${v}</span>`).join(" ")}
                        </div>` : ""}
                    </h6>
                </div>
            </div>
        </div>
        <div class="card-footer bg-white px-0 ">
            <div class="row">
                <div class=" col-md-auto ">
                  <a href="/post/edit/${id}" class="btn btn-outlined btn-black text-muted bg-transparent" data-wow-delay="0.7s">
                    <img src="https://img.icons8.com/ios/50/000000/settings.png" width="19" height="19">
                    <small>Edit</small>
                  </a>
                  <i class="mdi mdi-settings-outline"></i>
                  <a class="btn-outlined btn-black text-muted">
                    <img src="/assets/images/date.png" width="20" height="17" id="plus">
                    <small>${added_date}</small>
                  </a>
                  <a href="javascript:void(0)" data-id="${id}" data-role="delete-post" class="ml-3" data-wow-delay="0.7s">
                    Delete
                  </a>
                </div>
            </div>
        </div>
    </div>`;
  }
  const getPosts = () => {
    let keyword = url.searchParams.get("q") ? url.searchParams.get("q") : null;
    $.get({
      url: `/posts-live`,
      data: {keyword},
      success: function(d){
        console.log(d);
        let html = "";
        if (d.code === 200) {
          d.data.map(v => {
            html += postComponent(v.id,v.image,v.title,v.body,v.added_date,v.tags);
          })
        }
        $("#timeline_body").html(html);
      },
      error: function (d){
        console.error(d);
      },
      complete: function (){

      }
    })
  }
  const url_string = window.location.href;
  const url = new URL(url_string);
  getPosts();

  $(document).on("click","#share_post",function(){
    let image = $(`[name="image"]`).data("value");

    let data = {
      title: $(`[name="title"]`).val(),
      image,
      tags: $(`[name="tagsinput"]`).val(),
      body: $(`[name="body"]`).val(),
    };
    console.log(data.tags);
    $.post({
      url: `/share-post`,
      data,
      success: function(d){
        if (d.code === 201) {
          $(`[name="image"]`).data("value","")
          $(`[name="title"],[name="tagsinput"],[name="body"]`).val("");
        }
      },
      error: function(d){
        console.error(d);
      },
      complete: function(){
        getPosts();
      }
    })
  });


  $(document).on("click",`[data-role="delete-post"]`,function(){
    let id = $(this).data("id");
    $.ajax({
      url: `/post/${id}/delete`,
      type: "delete",
      success: function(d){
        if (d.code === 200) {
          getPosts();
        }
      },
      error: function (d){
        console.error(d);
      }
    })
  })
})
