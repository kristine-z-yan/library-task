<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Library App</title>

    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css"
          integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link href="https://vjs.zencdn.net/7.18.1/video-js.css" rel="stylesheet" />
    <link
        rel="stylesheet"
        href="https://unpkg.com/videojs-overlay-buttons@latest/dist/videojs-overlay-buttons.css"
    />
    <link rel="stylesheet" type="text/css" href="/css/app.css">

</head>
<body>
<nav class="navbar navbar-light bg-light">
    <a class="navbar-brand" href="#">Library</a>
</nav>
<div class="m-5">
    <h2>Books Table</h2>
    <table class="table table-striped" id="books-table">
        <thead class="books-thead">
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Title</th>
            <th scope="col">Description</th>
            <th scope="col">Authors</th>
            <th scope="col">Created At</th>
            <th scope="col">Actions</th>
        </tr>
        </thead>
        <tbody class="books-tbody">
        </tbody>
    </table>
</div>
<!-- Modal -->
<div class="modal fade" id="viewBookModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Book</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div>
                    <video
                        id="video-player"
                        class="video-js vjs-big-play-centered"
                        data-setup="{}"
                    >
                        <source src="https://static.videezy.com/system/resources/previews/000/038/524/original/2018-01-7-_29_.mp4" type="video/mp4" />
                    </video>
                </div>
                <div class="my-4 list-group text-left">
                    <div class="list-group-item">Titile: Cras justo odio</div>
                    <div class="list-group-item">Description: Dapibus ac facilisis in</div>
                    <div class="list-group-item">Authors: Morbi leo risus</div>
                    <div class="list-group-item">Created at: 08 April 2022</div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
</body>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<script src="https://vjs.zencdn.net/7.18.1/video.min.js"></script>
<script src="https://unpkg.com/videojs-overlay-buttons@latest/dist/videojs-overlay-buttons.min.js"></script>

{{--    <script type="text/javascript" src="/js/app.js"></script>--}}
<script>
    $.ajax({
        url: 'http://127.0.0.1:8000/api/books',
        success: function(res) {
            $.each(res, function (key, value) {
                let authors='';
                $.each(value.authors, function (key2, value2) {
                    authors += value2.firstname + ' ' + value2.lastname;
                    if (key2 < value.authors.length-1) authors += ', ';
                })
                let date = new Date(value.created_at);
                date = date.toISOString().split("T")[0];

                $('#books-table .books-tbody').append("<tr>\
										<td>"+value.id+"</td>\
										<td>"+value.title+"</td>\
										<td>"+value.description+"</td>\
										<td>"+authors+"</td>\
										<td>"+date+"</td>\
										<td><button type='button' class='btn btn-primary' data-toggle='modal' data-id="+value.id+" data-target='#viewBookModal'>View </button></td>\
										</tr>");
            })
        }
    })

    var videoPlayer = videojs('video-player', {
        autoplay: 'muted',
        controls: true,
        preload: "auto",
        width: "680",
        height: "300",
        poster: "https://experitour.com/wp-content/uploads/2017/12/erawan-falls-fifth-tier-768x511.jpg",
        playbackRates: [0.25, 0.5, 1, 1.5, 2],

    })
    videoPlayer.touchOverlay();
</script>
</html>
